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
$singe_and_desize_id=$_GET['singe_and_desize_id'];
$sql_for_singe_desige="select * from defining_qc_standard_for_singe_and_desize_process where `id`='$singe_and_desize_id'";
$result_for_singe_desige= mysqli_query($con,$sql_for_singe_desige) or die(mysqli_error($con));
$row_for_singe_desige = mysqli_fetch_array( $result_for_singe_desige);

?>
<script type='text/javascript' src='process_program/defining_qc_standard_for_singe_and_desize_process_form_validation.js'></script>
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


	 document.getElementById('color').value='red';
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

/*  document.getElementById('version_name').value=splitted_version_details[0];
*/ document.getElementById('color').value=splitted_version_details[1];
  document.getElementById('finish_width_in_inch').value=splitted_version_details[2];
  document.getElementById('customer_name').value=splitted_version_details[3];
  document.getElementById('customer_id').value=splitted_version_details[5];
  document.getElementById('standard_for_which_process').value='Singeing & Desizing';
  document.getElementById('process_id').value='proc_4';

	var value_for_data= 'customer_id='+splitted_version_details[5];

   $.ajax({
			 		url: 'process_program/return_test_name_method.php',
			 		dataType: 'text',
			 		type: 'post',
			 		contentType: 'application/x-www-form-urlencoded',
			 		data: value_for_data,

			 		success: function( data, textStatus, jQxhr )
			 		{

                     var split_all_data= data.split('method');
                    var data= split_all_data[0];
                    var test_method_id=split_all_data[1];

                    
                    
                    

                    var test_method_id= test_method_id.split(',');

                    var test_method_for_all='';


                    $("#checking_data").val(data);

                    var splitted_data= data.split('?fs?');



                     if(splitted_data.includes('45'))
                     {
                     	//alert(data);

                     	test_method_for_all+=test_method_id[splitted_data.indexOf('45')]+',';
                     	$(".full_page_load").show();
                     	$("#div_flame_intensity").show();




                     }
					 if(splitted_data.includes('46'))
                     {
                     	//alert(data);

                     	test_method_for_all+=test_method_id[splitted_data.indexOf('46')]+',';
                     	$(".full_page_load").show();
                     	$("#div_machine_speed").show();

                     }
					if(splitted_data.includes('47'))
                     {
                     	//alert(data);
                     	test_method_for_all+=test_method_id[splitted_data.indexOf('47')]+',';
                     	$(".full_page_load").show();
                     	$("#div_bath_temparature").show();
                     }

					if(splitted_data.includes('48'))
                     {
                     	//alert(data);
                     	test_method_for_all+=test_method_id[splitted_data.indexOf('48')]+',';
                     	$(".full_page_load").show();
                     	$("#div_bath_ph").show();
                     }

                     $("#test_method_id").val(test_method_for_all);

			 		},
			 		error: function( jqXhr, textStatus, errorThrown )
			 		{

			 				alert(errorThrown);
			 		}
			}); // End of $.ajax({
}/* End of function fill_up_qc_standard_additional_info(version_details)*/



 function sending_data_of_defining_qc_standard_for_singe_and_desize_process_form_for_saving_in_database()
 {


       var validate = Singing_Desizing_Form_Validation();
	     var validate =true;
       var url_encoded_form_data = $("#defining_qc_standard_for_singe_and_desize_process_form").serialize(); //This will read all control elements value of the form
	   //alert(url_encoded_form_data);
       if(validate != false)
	   {


		  	 $.ajax({
			 		url: 'process_program/edit_defining_qc_standard_for_singe_and_desize_process_saving.php',
			 		dataType: 'text',
			 		type: 'post',
			 		contentType: 'application/x-www-form-urlencoded',
			 		data: url_encoded_form_data,
			 		success: function( data, textStatus, jQxhr )
			 		{
			 				alert(data);

							//document.getElementById('test').innerHTML=data;

			 		},
			 		error: function( jqXhr, textStatus, errorThrown )
			 		{
			 				//console.log( errorThrown );
			 				alert(errorThrown);
			 		}
			 }); // End of $.ajax({

       }//End of if(validate != false)

 }//End of function sending_data_of_defining_qc_standard_for_singe_and_desize_process_form_for_saving_in_database()

</script>
<div id='test'>

</div>

<div class="col-sm-12 col-md-12 col-lg-12">

		<div class="panel panel-default"> <!-- This div will create a block/panel for FORM -->

				<div class="panel-heading" style="color:#191970;"><b>Defining Standard For Singe And Desize Process</b></div> <!-- This will create a upper block for FORM (Just Beautification) -->

				<div class="row" data-toggle="collapse" data-target="#search_form_collpapsible_div_1" onClick="change_up_down_arrow_icon_1(this.childNodes[5].childNodes[1].id)">


                       <div align="right" style="padding-right:13px;" id='test'> <i class="glyphicon glyphicon-chevron-up text-right"  id='panel_heading_icon_1'></i>
                      </div>


                    </div>   <!-- End of <div class="row" data-toggle="collapse" data-target="#search_form_collpapsible_div" > -->

                <div id='search_form_collpapsible_div_1' class="collapse in"> <!-- For Making Collapsible Section -->



                     <form class="form-horizontal" action="" style="margin-top:10px;" name="defining_qc_standard_for_singe_and_desize_process_form_view" id="defining_qc_standard_for_singe_and_desize_process_form_view" data-toggle="collapse" data-target="#search_form_collpapsible_div">
<!--
	                <div class="panel-heading" style="color:#191970;"><b> Singeing & Desizing Standard Process List</b></div> --> <!-- This will create a upper block for FORM (Just Beautification) -->

	                    <div class="panel panel-default">
	                       <table id="datatable-buttons" class="table table-striped table-bordered">
	                        <thead>
	                               <tr>
	                               <th>SI</th>
	                               <th>PP Number</th>
	                               <th>Version ID</th>
	                               <th>Version Name</th>
	                               <th>Customer Name</th>
	                               <th>Color</th>
	                               <th>Finish Width</th>
	                               <th>Action</th>
	                               </tr>
	                          </thead>
	                          <tbody>
	                          <?php
                                          $s1 = 1;
                                          $standard_for_which_process='Singeing & Desizing';
                                          $sql_for_singe_and_desize = "SELECT * FROM `defining_qc_standard_for_singe_and_desize_process` WHERE `standard_for_which_process`='$standard_for_which_process' ORDER BY id ASC";

                                          $res_for_singe_and_desize = mysqli_query($con, $sql_for_singe_and_desize);

                                          while ($row = mysqli_fetch_assoc($res_for_singe_and_desize))
                                          {
                           ?>

                           <tr>
                              <td><?php echo $s1; ?></td>
                              <td width="300"><?php echo $row['pp_number']; ?></td>
                              <td><?php echo $row['version_id']; ?></td>
                              <td><?php echo $row['version_number']; ?></td>
                              <td><?php echo $row['customer_name']; ?></td>
                              <td><?php echo $row['color']; ?></td>
                              <td><?php echo $row['finish_width_in_inch']; ?></td>
                              <td>


                                      <button type="submit" id="edit_singe_and_desize" name="edit_singe_and_desize"  class="btn btn-primary btn-xs" onclick="load_page('process_program/edit_defining_qc_standard_for_singe_and_desize_process.php?singe_and_desize_id=<?php echo $row['id'] ?>')"> Edit </button>
                                     <span>  </span>


                                       <button type="submit" id="delete_singe_and_desize" name="delete_singe_and_desize"  class="btn btn-danger btn-xs" onclick="load_page('process_program/deleting_singe_and_desize_process_standard.php?singe_and_desize_id=<?php echo $row['id'] ?>')"> Delete </button>
                               </td>
                              <?php

                              $s1++;
                                               }
                               ?>
                           </tr>
                        </tbody>
                       </table>

                    </div>

               </form>    <!-- End of <form class="form-horizontal" action="" style="margin-top:10px;" name="defining_qc_standard_for_singe_and_desize_process_form" id="defining_qc_standard_for_singe_and_desize_process_form"> -->

	</div> <!-- End of <div class="panel-heading" style="color:#191970;"><b> singe_and_desize Standard Process List</b></div>  -->

	<form class="form-horizontal" action="" style="margin-top:10px;" name="defining_qc_standard_for_singe_and_desize_process_form" id="defining_qc_standard_for_singe_and_desize_process_form">

			<div class="form-group form-group-sm" id="form-group_for_pp_number">
					<!--	<label class="control-label col-sm-4" for="pp_number" style="margin-right:0px; color:#00008B;">PP Number:</label>-->
							
                        <input type="hidden" id="pp_number" name="pp_number" value="<?php echo $row_for_singe_desige['pp_number']?>" >
                        <input type="hidden" id="version_number" name="version_number" value="<?php echo $row_for_singe_desige['version_number']?>" >
						<input type="hidden" id="customer_name" name="customer_name" value="<?php echo $row_for_singe_desige['customer_name']?>">
						<input type="hidden" id="customer_id" name="customer_id" value="<?php echo $row_for_singe_desige['customer_id']?>">
						<input type="hidden" id="color" name="color" value="<?php echo $row_for_singe_desige['color']?>" >
						<input type="hidden" id="finish_width_in_inch" name="finish_width_in_inch"  value="<?php echo $row_for_singe_desige['finish_width_in_inch']?>">
                        <input type="hidden" id="standard_for_which_process" name="standard_for_which_process"  value="<?php echo $row_for_singe_desige['standard_for_which_process']?>">
						<input type="hidden" id="process_id" name="process_id"  value="proc_1">
			            <input type="hidden" id="test_method_id" name="test_method_id"  value="">
			            

			            <input type="hidden" id="checking_data" name="checking_data"  value="">

						
				<!-- *********************************** Designing Tabular FoYarn Countrmar (Multi-Column Form Elements Here (Start))*********************************** -->


 			<div class="form-group form-group-sm full_page_load"   id="full_page_load">



				<div class="col-sm-3 text-center">
					<label for="test_name_and_method" style="font-size:12px; color:#008000;">Test Name & Method</label>


				</div>

				 <div class="col-sm-1 text-center">
		              <label for="description_or_type" style="font-size:12px; color:#008000;">Direction/Type</label>

		         </div>

	           <div class="col-sm-1 text-center">
		             <!-- Gap Creation -->
		       </div>

		        <div class="col-sm-1 text-center">
		              <label for="value" style="font-size:12px; color:#008000;">Value</label>

		        </div>

	               <!--Add Input/Select Field Here No Dive Only Input/Select/Radio Button/Checkbox/Textarea -->

			   <div class="col-sm-1 text-center">
			         <label for="math_op_value" style="font-size:12px; color:#008000;">Math OP.</label>

			   </div>



	          <div class="col-sm-1 text-center" for="line_creation_between_min_and_max">

	          	<label for="tolerance_value" style="font-size:12px; color:#008000;">Tolerance</label>


	          </div>

	          <div class="col-sm-1 text-center">
	              <label for="min_value" style="font-size:12px; color:#008000;">Unit</label>

	          </div>

		               <!--Add Input/Select Field Here No Dive Only Input/Select/Radio Button/Checkbox/Textarea -->


	          <div class="col-sm-1" for="remaining_two_spans_of_bootstrap">

	             <label for="max_value" style="font-size:12px; color:#008000;">Minimum</label>

	          </div>

	          <div class="col-sm-1">

	             <label for="max_value" style="font-size:12px; color:#008000;">Maximum</label>

	          </div>


       </div><!-- End of <div class="form-group form-group-sm"  -->




	 <div class="form-group form-group-sm" for="flame_intensity" id="div_flame_intensity" >


	      <div class="col-sm-3 text-center">
	         <label class="control-label"  style="color:#00008B;">Flame Intensity </label>
	      </div>

       <div class="col-sm-2 text-center">
                <!-- <label for="description_or_type" style="font-size:12px; color:#000066;">Direction/Type</label> -->
                <label class="control-label" for="description_or_type" style="color:#00008B;"> </label>
                <input type="hidden" id="test_method_for_flame_intensitytest_method_for_flame_intensity" name="test_method_for_flame_intensity" value="intensity">
           </div>



           <div class="col-sm-1 text-center">
                 <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>

         </div>


          <div class="col-sm-1 text-center">
               <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>

           </div>

                 <!--Add Input/Select Field Here No Dive Only Input/Select/Radio Button/Checkbox/Textarea -->

          <div class="col-sm-1" for="tolerance">

             <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
          </div>

          <div class="col-sm-1" for="unit">
          	  mbar
             <input type="hidden" class="form-control" id="uom_of_flame_intensity" name="uom_of_flame_intensity" value="mbar">
          </div>


          <div class="col-sm-1 text-center" for="min_value">

           <input type="text" class="form-control" id="flame_intensity_min_value" name="flame_intensity_min_value" value="<?php echo $row_for_singe_desige['flame_intensity_min_value']?>" required>

          </div>

          <div class="col-sm-1 text-center">

            <input type="text" class="form-control" id="flame_intensity_max_value" name="flame_intensity_max_value" value="<?php echo $row_for_singe_desige['flame_intensity_max_value']?>"  required>

         </div>


     </div><!-- End of <div class="form-group form-group-sm" tensile_properties_in_weft_value_max_value-->



		<div class="form-group form-group-sm" id="div_machine_speed" >


      <div class="col-sm-3 text-center">
         <label class="control-label"  style="color:#00008B;">Machine Speed </label>
      </div>

       <div class="col-sm-2 text-center">
                <!-- <label for="description_or_type" style="font-size:12px; color:#000066;">Direction/Type</label> -->
                <label class="control-label" for="description_or_type" style="color:#00008B;"> </label>
                <input type="hidden" id="test_method_for_machine_speed" name="test_method_for_machine_speed" value="machine speed">

           </div>



           <div class="col-sm-1 text-center">
                 <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>

         </div>


          <div class="col-sm-1 text-center">
               <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>

           </div>

                 <!--Add Input/Select Field Here No Dive Only Input/Select/Radio Button/Checkbox/Textarea -->

          <div class="col-sm-1" for="tolerance">

             <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
          </div>

          <div class="col-sm-1" for="unit">

             Meter/Minute
             <input type="hidden"  id="uom_of_machine_speed" name="uom_of_machine_speed" value="Meter/Minute">
          </div>


          <div class="col-sm-1 text-center" for="min_value">

          <input type="text" class="form-control" id="machine_speed_min_value" name="machine_speed_min_value" value="<?php echo $row_for_singe_desige['machine_speed_min_value']?>" required>

          </div>

          <div class="col-sm-1 text-center">

            <input type="text" class="form-control" id="machine_speed_max_value" name="machine_speed_max_value" value="<?php echo $row_for_singe_desige['machine_speed_max_value']?>" required>

         </div>


     </div><!-- End of <div class="form-group form-group-sm" machine_speed_max_value-->






	<div class="form-group form-group-sm" id="div_bath_temparature">


	      <div class="col-sm-3 text-center">
	         <label class="control-label"  style="color:#00008B;">Bath Temperature </label>
	      </div>

	       <div class="col-sm-2 text-center">
	                <!-- <label for="description_or_type" style="font-size:12px; color:#000066;">Direction/Type</label> -->
	                <label class="control-label" for="description_or_type" style="color:#00008B;"> </label>
	                 <input type="hidden" id="test_method_for_bath_temperature" name="test_method_for_bath_temperature" value="bath">
	       </div>



           <div class="col-sm-1 text-center">
                 <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>

         </div>


          <div class="col-sm-1 text-center">
               <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>

           </div>

                 <!--Add Input/Select Field Here No Dive Only Input/Select/Radio Button/Checkbox/Textarea -->

          <div class="col-sm-1" for="tolerance">

             <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
          </div>

          <div class="col-sm-1" for="unit">

             ??C
            <input type="hidden" id="uom_of_bath_temperature" name="uom_of_bath_temperature" value="??C">
          </div>


          <div class="col-sm-1 text-center" for="min_value">

            <input type="text" class="form-control" id="bath_temperature_min_value" name="bath_temperature_min_value" value="<?php echo $row_for_singe_desige['bath_temperature_min_value']?>" required>

          </div>

          <div class="col-sm-1 text-center">

            <input type="text" class="form-control" id="bath_temperature_max_value" name="bath_temperature_max_value" value="<?php echo $row_for_singe_desige['bath_temperature_max_value']?>" required>

         </div>


     </div><!-- End of <div class="form-group form-group-sm" bath_temperature_max_value-->

<!-------------- Bath Temperature (End ) -------------->


<!-------------- PH (Start) -------------->

	<div class="form-group form-group-sm" id="div_bath_ph">


	      <div class="col-sm-3 text-center">
	         <label class="control-label"  style="color:#00008B;">Bath pH (Merck Universal Indicator)</label>
	      </div>

	       <div class="col-sm-2 text-center">
	                <!-- <label for="description_or_type" style="font-size:12px; color:#000066;">Direction/Type</label> -->
	                <label class="control-label" for="description_or_type" style="color:#00008B;"> </label>
	                <input type="hidden" id="test_method_for_bath_ph" name="test_method_for_bath_ph" value="Merck Universal Indicator">

           </div>



           <div class="col-sm-1 text-center">
                 <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>

         </div>


          <div class="col-sm-1 text-center">
               <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>

           </div>

                 <!--Add Input/Select Field Here No Dive Only Input/Select/Radio Button/Checkbox/Textarea -->

          <div class="col-sm-1" for="tolerance">

             <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
          </div>

          <div class="col-sm-1" for="unit">


            <input type="hidden" id="uom_of_bath_ph" name="uom_of_bath_ph" value="??C">
          </div>


          <div class="col-sm-1 text-center" for="min_value">

            <input type="text" class="form-control" id="bath_ph_min_value" name="bath_ph_min_value" value="<?php echo $row_for_singe_desige['bath_ph_min_value']?>" required>

          </div>

          <div class="col-sm-1 text-center">

            <input type="text" class="form-control" id="bath_ph_max_value" name="bath_ph_max_value" value="<?php echo $row_for_singe_desige['bath_ph_max_value']?>" required>

         </div>


     </div><!-- End of <div class="form-group form-group-sm" bath_ph_max_value-->


<!-------------- PH (End) -------------->

<!-- *********************************** Designing Tabular Formar (Multi-Column Form Elements Here (End))*********************************** -->

						<div class="form-group form-group-sm">
								<div class="col-sm-offset-3 col-sm-5">
									<button type="button" class="btn btn-primary" onClick="sending_data_of_defining_qc_standard_for_singe_and_desize_process_form_for_saving_in_database()">Submit</button>
									<button type="reset" class="btn btn-success">Reset</button>
								</div>
						</div>

				</form>

		</div> <!-- End of <div class="panel panel-default"> -->

</div> <!-- End of <div class="col-sm-12 col-md-12 col-lg-12"> -->
