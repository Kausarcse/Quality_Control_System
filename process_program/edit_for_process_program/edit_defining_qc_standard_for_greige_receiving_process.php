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

$greige_receiving_id=$_GET['greige_receiving_id'];
$sql_for_greige_receiving="select * from defining_qc_standard_for_greige_receiving_process where `id`='$greige_receiving_id'";
$result_for_greige_receiving= mysqli_query($con,$sql_for_greige_receiving) or die(mysqli_error($con));
$row_for_greige_receiving = mysqli_fetch_array( $result_for_greige_receiving);




?>
<script type='text/javascript' src='process_program/defining_qc_standard_for_greige_receiving_process_form_validation.js'></script>
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
			 			    document.getElementById('greige_width').value=splitted_data[2]; 
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
*/document.getElementById('color').value=splitted_version_details[1];
  document.getElementById('finish_width_in_inch').value=splitted_version_details[2]; 
  document.getElementById('customer_name').value=splitted_version_details[3]; 
  document.getElementById('customer_id').value=splitted_version_details[5];
  document.getElementById('standard_for_which_process').value='Greige Receiving'; 


  var value_for_data= 'customer_id='+splitted_version_details[5];
  $.ajax({
			 		url: 'process_program/return_test_name_method.php',
			 		dataType: 'text',
			 		type: 'post',
			 		contentType: 'application/x-www-form-urlencoded',
			 		data: value_for_data,
			 		      
			 		success: function( data, textStatus, jQxhr )
			 		{       
			 			    
                     //
                    var splitted_data= data.split('?fs?');
                    
                   

                    if(splitted_data.includes('1'))  
                     {
                     	
                     	
                     	$(".full_page_load").show();
                     	$("#div_cf_to_rubbing").show();
                     	
                     }

                     if(splitted_data.includes('2')) 
                     {
                        
                        
                        $(".full_page_load").show();
                        $("#div_dimensional_stability_to_washing").show();
                        
                     }

                     if(splitted_data.includes('3'))  
                     {
                        
                        
                        $(".full_page_load").show();
                        $("#div_yarn_count").show();
                        
                     }

                     if(splitted_data.includes('4')) 
                     {
                        
                        
                        $(".full_page_load").show();
                        $("#div_number_of_threads_per_unit_length").show();
                        
                     }

                     if(splitted_data.includes('5')) 
                     {
                        
                        
                        $(".full_page_load").show();
                        $("#div_mass_per_unit_area").show();
                        
                     }

                     if(splitted_data.includes('6')) 
                     {
                        
                        
                        $(".full_page_load").show();
                        $("#div_resistance_to_surface_fuzzing_and_pilling").show();
                        
                     }

                     if(splitted_data.includes('7'))  
                     {
                        
                        
                        $(".full_page_load").show();
                        $("#div_tensile_properties").show();
                        
                     }

                      if(splitted_data.includes('8')) 
                     {
                     	
                     	
                     	
                     	$(".full_page_load").show();
                     	$("#div_tear_force").show();
                     	
                     	
                     }


                     if(splitted_data.includes('7'))
                     {
                     	
                     	
                     	$(".full_page_load").show();
                     	$("#div_tensile_properties").show();
                     	
                     	
                     }

                     if(splitted_data.includes('8'))
                     {
                     	
                     	
                     	$(".full_page_load").show();
                     	$("#div_tear_force_value").show();
                     	
                     	
                     }


                     if(splitted_data.includes('9'))
                     {
                        
                        
                        $(".full_page_load").show();
                        $("#div_seam_slippage").show();
                        
                        
                     }


                      if(splitted_data.includes('10'))
                     {
                     	
                     	$(".full_page_load").show();
                     	$("#div_bowing_and_skew").show();

                     }

                     if(splitted_data.includes('11'))
                     {
                        
                        $(".full_page_load").show();
                        $("#div_seam_strength").show();

                     }

                     if(splitted_data.includes('12'))
                     {
                        
                        $(".full_page_load").show();
                        $("#div_seam_properties").show();

                     }


                     if(splitted_data.includes('13'))
                     {
                        
                        $(".full_page_load").show();
                        $("#div_mass_loss_in_abrasion").show();

                     }

                     

                     if(splitted_data.includes('14'))
                     {
                        
                        $(".full_page_load").show();
                        $("#div_mass_loss_in_abrasion").show();

                     }

                     if(splitted_data.includes('15'))
                     {
                        
                        $(".full_page_load").show();
                        $("#div_color_fastness_to_washing").show();

                     }

                     if(splitted_data.includes('16'))
                     {
                        
                        $(".full_page_load").show();
                        $("#div_cf_to_dry_cleaning").show();

                     }

                     if(splitted_data.includes('17'))
                     {
                        
                        $(".full_page_load").show();
                        $("#div_cf_to_perspiration_acid").show();

                     }


                     if(splitted_data.includes('18'))
                     {
                        
                        $(".full_page_load").show();
                        $("#div_cf_to_perspiration_alkali").show();

                     }


                     if(splitted_data.includes('19'))
                     {
                        
                        $(".full_page_load").show();
                        $("#div_color_fastness_to_water").show();

                     }


                     if(splitted_data.includes('20'))
                     {
                        
                        $(".full_page_load").show();
                        $("#div_color_fastness_to_water_spotting").show();

                     }

                     if(splitted_data.includes('21'))
                     {
                        
                        $(".full_page_load").show();
                        $("#div_resistance_to_surface_wetting").show();

                     }

                     

                     if(splitted_data.includes('22'))
                     {
                        
                        $(".full_page_load").show();
                        $("#div_resistance_to_surface_wetting").show();

                     }

                     if(splitted_data.includes('23'))
                     {
                        
                        $(".full_page_load").show();
                        $("#div_cf_to_hydrolysis_of_reactive_dyes").show();

                     }


                     if(splitted_data.includes('24'))
                     {
                        
                        $(".full_page_load").show();
                        $("#div_cf_to_oxidative_bleach_damage").show();

                     }

                     if(splitted_data.includes('25'))
                     {
                        
                        $(".full_page_load").show();
                        $("#div_cf_to_phenolic_yellowing").show();

                     }

                     if(splitted_data.includes('26'))
                     {
                        
                        $(".full_page_load").show();
                        $("#div_migration_of_color_into_pvc").show();

                     }

                     if(splitted_data.includes('27'))
                     {
                        
                        $(".full_page_load").show();
                        $("#div_cf_to_saliva").show();

                     }

                     if(splitted_data.includes('28'))
                     {
                        
                        $(".full_page_load").show();
                        $("#div_cf_to_chlorinated_water").show();

                     }

                     if(splitted_data.includes('29'))
                     {
                        
                        $(".full_page_load").show();
                        $("#div_cf_to_chlorine_bleach").show();

                     }

                      if(splitted_data.includes('30'))
                     {
                        
                        $(".full_page_load").show();
                        $("#div_cf_to_peroxide_bleach").show();

                     }

                     if(splitted_data.includes('31'))
                     {
                        
                        $(".full_page_load").show();
                        $("#div_cross_staining").show();

                     }

                      if(splitted_data.includes('32'))
                     {
                        
                        $(".full_page_load").show();
                        $("#div_formaldehyde_content").show();

                     }



                     if(splitted_data.includes('33'))
                     {
                     	
                     	$(".full_page_load").show();
                     	$("#div_ph").show();
                     }

                      if(splitted_data.includes('34'))
                     {
                        
                        $(".full_page_load").show();
                        $("#div_water_absorption").show();
                     }

                     if(splitted_data.includes('35'))
                     {
                        
                        $(".full_page_load").show();
                        $("#div_wicking_test").show();
                     }

                     if(splitted_data.includes('36'))
                     {
                        
                        $(".full_page_load").show();
                        $("#div_spirality").show();
                     }

                     if(splitted_data.includes('37'))
                     {
                        
                        $(".full_page_load").show();
                        $("#div_smoothness_appearance").show();
                     }

                     if(splitted_data.includes('38'))
                     {
                        
                        $(".full_page_load").show();
                        $("#div_print_durability").show();
                     }


                     if(splitted_data.includes('39'))
                     {
                        
                        $(".full_page_load").show();
                        $("#div_iron_ability_of_woven_fabric").show();
                     }

                      if(splitted_data.includes('40'))
                     {
                        
                        $(".full_page_load").show();
                        $("#div_cf_to_artificial_day_light").show();
                     }

                      if(splitted_data.includes('41'))
                     {
                        
                        $(".full_page_load").show();
                        $("#div_moisture_content").show();
                     }

                     if(splitted_data.includes('42'))
                     {
                        
                        $(".full_page_load").show();
                        $("#div_evaporation_rate").show();
                     }

                     if(splitted_data.includes('43'))
                     {
                        
                        $(".full_page_load").show();
                        $("#div_fiber_content").show();
                     }

                     if(splitted_data.includes('44'))
                     {
                        
                        $(".full_page_load").show();
                        $("#div_greige_width").show();
                     }

                     if(splitted_data.includes('45'))
                     {
                     	
                     	$(".full_page_load").show();
                     	$("#div_flame_intensity").show();

                     }
					 if(splitted_data.includes('46'))
                     {
                     	
                     	$(".full_page_load").show();
                     	$("#div_machine_speed").show();

                     }
					if(splitted_data.includes('47'))
                     {
                     	
                     	$(".full_page_load").show();
                     	$("#div_bath_temparature").show();
                     }

					if(splitted_data.includes('48'))
                     {
                     	
                     	$(".full_page_load").show();
                     	$("#div_bath_ph").show();
                     }

                     if(splitted_data.includes('49'))  //whiteness
                     {
                     	
                     	
                     	$(".full_page_load").show();
                     	$("#div_whiteness").show();
                     	
                     	
                     }

                     if(splitted_data.includes('50')) //residual_sizing_material_test_method
                     {
                     	
                     	
                     	$(".full_page_load").show();
                     	$("#div_residual_sizing_material").show();
                     	
                     	
                     }

                     if(splitted_data.includes('51'))  // div_absorbency_test_method
                     {
                     
                     	
                     	$(".full_page_load").show();
                     	$("#div_absorbency_test_method").show();
                     	
                     	
                     }


                     if(splitted_data.includes('52'))
                     {
                     	
                     	$(".full_page_load").show();
                     	$("#div_rubbing_dry").show();

                     }
					 if(splitted_data.includes('53'))
                     {
                     	
                     	$(".full_page_load").show();
                     	$("#div_rubbing_wet").show();

                     }

                    
			 		},
			 		error: function( jqXhr, textStatus, errorThrown )
			 		{       
			 				
			 				alert(errorThrown);
			 		}
			}); // End of $.ajax({
}/* End of function fill_up_qc_standard_additional_info(version_details)*/

 function sending_data_of_defining_qc_standard_for_greige_receiving_process_form_for_saving_in_database()
 {


       var validate = Greige_Receiving_Form_Validation();
       var url_encoded_form_data = $("#defining_qc_standard_for_greige_receiving_process_form").serialize(); //This will read all control elements value of the form	
       if(validate != false)
	   {


		  	 $.ajax({
			 		url: 'process_program/edit_defining_qc_standard_for_greige_receiving_process_saving.php',
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

 }//End of function sending_data_of_defining_qc_standard_for_greige_receiving_process_form_for_saving_in_database()

</script>
<div class="col-sm-12 col-md-12 col-lg-12">

		<div class="panel panel-default"> <!-- This div will create a block/panel for FORM -->

				<div class="panel-heading" style="color:#191970;"><b>Edit Defining Qc Standard For Greige Receiving Process</b></div> <!-- This will create a upper block for FORM (Just Beautification) -->

                         

                 <div class="row" data-toggle="collapse" data-target="#search_form_collpapsible_div_1" onClick="change_up_down_arrow_icon_1(this.childNodes[5].childNodes[1].id)">


                       <div align="right" style="padding-right:13px;" id='test'> <i class="glyphicon glyphicon-chevron-up text-right"  id='panel_heading_icon_1'></i>
                      </div>


                    </div>   <!-- End of <div class="row" data-toggle="collapse" data-target="#search_form_collpapsible_div" > -->
                     

                <div id='search_form_collpapsible_div_1' class="collapse in"> <!-- For Making Collapsible Section -->



                     <form class="form-horizontal" action="" style="margin-top:10px;" name="defining_qc_standard_for_greige_receiving_process_form_view" id="defining_qc_standard_for_greige_receiving_process_form_view" data-toggle="collapse" data-target="#search_form_collpapsible_div">
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
                                          $standard_for_which_process='Greige Receiving';
                                          $sql_for_greige_receiving = "SELECT * FROM `defining_qc_standard_for_greige_receiving_process` WHERE `standard_for_which_process`='$standard_for_which_process' ORDER BY id ASC";

                                          $res_for_greige_receiving = mysqli_query($con, $sql_for_greige_receiving);

                                          while ($row = mysqli_fetch_assoc($res_for_greige_receiving))
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

                              <button type="submit" id="edit_greige_receiving" name="edit_greige_receiving"  class="btn btn-primary btn-xs" onclick="load_page('process_program/edit_defining_qc_standard_for_greige_receiving_process.php?greige_receiving_id=<?php echo $row['id'] ?>')"> Edit </button>

                              <button type="submit" id="delete_greige_receiving" name="delete_greige_receiving"  class="btn btn-danger btn-xs" onclick="load_page('process_program/deleting_greige_receiving_process_standard.php?greige_receiving_id=<?php echo $row['id'] ?>')"> Delete </button>
                               </td>
                              <?php

                              $s1++;
                                               }
                               ?>
                           </tr>
                        </tbody>
                       </table>

                    </div>

               </form>    <!-- End of <form class="form-horizontal" action="" style="margin-top:10px;" name="defining_qc_standard_for_greige_receiving_process_form" id="defining_qc_standard_for_greige_receiving_process_form"> -->

            </div> <!-- End of <div class="panel-heading" style="color:#191970;"><b> greige_receiving Standard Process List</b></div>  -->

            <form class="form-horizontal" action="" style="margin-top:10px;" name="defining_qc_standard_for_greige_receiving_process_form" id="defining_qc_standard_for_greige_receiving_process_form">

    <div class="form-group form-group-sm" id="form-group_for_pp_number">
        <!--	<label class="control-label col-sm-4" for="pp_number" style="margin-right:0px; color:#00008B;">PP Number:</label>-->
                
            <input type="hidden" id="pp_number" name="pp_number" value="<?php echo $row_for_greige_receiving['pp_number']?>" >
            <input type="hidden" id="version_number" name="version_number" value="<?php echo $row_for_greige_receiving['version_number']?>" >
            <input type="hidden" id="customer_name" name="customer_name" value="<?php echo $row_for_greige_receiving['customer_name']?>">
            <input type="hidden" id="customer_id" name="customer_id" value="<?php echo $row_for_greige_receiving['customer_id']?>">
            <input type="hidden" id="color" name="color" value="<?php echo $row_for_greige_receiving['color']?>" >
            <input type="hidden" id="finish_width_in_inch" name="finish_width_in_inch"  value="<?php echo $row_for_greige_receiving['finish_width_in_inch']?>">
            <input type="hidden" id="standard_for_which_process" name="standard_for_which_process"  value="<?php echo $row_for_greige_receiving['standard_for_which_process']?>">
            <input type="hidden" id="process_id" name="process_id"  value="proc_1">
            <input type="hidden" id="test_method_id" name="test_method_id"  value="">
            

            <input type="hidden" id="checking_data" name="checking_data"  value="">

            

						
<!-- *********************************** Designing Tabular Formar (Multi-Column Form Elements Here (Start))*********************************** -->

<div class="full_page_load" id="full_page_load">


	<div class="form-group form-group-sm">
		     
			    <!-- <div class="col-sm-1 text-center">
					
				</div> -->


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
                       



<!-- Start of yarn_count -->

<div id="div_yarn_count">
	  
	  <div class="form-group form-group-sm">
		    
		

			<div class="col-sm-3 text-center">
				 <label class="control-label" for="warp_yarn_count_value" style="color:#00008B;"><span id="for_warp_yarn_count_test_name_label">Yarn Count</span><span id="warp_yarn_count_test_method">(ISO 7211-5)</span></label>
			</div>
			 
			 <div class="col-sm-2 text-center">
	              <!-- <label for="description_or_type" style="font-size:12px; color:#000066;">Direction/Type</label> -->
	              <label class="control-label" for="description_or_type" style="color:#00008B;"> Warp </label>
	              
	         </div>

	         <div class="col-sm-1 text-center">
		            <input type="text" class="form-control" id="warp_yarn_count_value" name="warp_yarn_count_value" value="<?php echo $row_for_greige_receiving['warp_yarn_count_value']?>" onchange="warp_yarn_count_cal()" required>
		         
		     </div>
		        
		         
          <div class="col-sm-1 text-center">
             <select  class="form-control" id="warp_yarn_count_tolerance_range_math_operator" name="warp_yarn_count_tolerance_range_math_operator" onchange="warp_yarn_count_cal()">
                      <option select="selected" value="select">Select Warp Yarn CountTolerance Range Math Operator</option>
                      
                      <?php
                                      $warp_yarn_count_tolerance_range_math_operator = $row_for_greige_receiving['warp_yarn_count_tolerance_range_math_operator'];
                                     ?>
                                     <?php 
                                          if($warp_yarn_count_tolerance_range_math_operator=='+')
                                          {
                                       ?>
                                          <option value="+" selected> +</option>
                                          <option value="-"> -</option>
                                          <option value="+/-">+/-</option>
                                      <?php
                                          }
                                          else if($warp_yarn_count_tolerance_range_math_operator=='-')
                                          {
                                         ?>
                                          <option value="+">+</option>
                                          <option value="-" selected>-</option>
                                          <option value="+/-">+/-</option>
                                       <?php
                                          }
                                          else
                                          {
                                         ?>
                                          <option value="+">+</option>
                                          <option value="-">-</option>
                                          <option value="+/-" selected>+/-</option>
                                       <?php
                                          }
                                       ?>
               </select>
              
           </div>
	          
	               <!--Add Input/Select Field Here No Dive Only Input/Select/Radio Button/Checkbox/Textarea -->
		          
          <div class="col-sm-1" for="tolerance">

             <input type="text" class="form-control" id="warp_yarn_count_tolerance_value" name="warp_yarn_count_tolerance_value" value="<?php echo $row_for_greige_receiving['warp_yarn_count_tolerance_value']?>" onchange="warp_yarn_count_cal()" required>

          </div>

          <div class="col-sm-1" for="unit">
          	<select  class="form-control" id="uom_of_warp_yarn_count_value" name="uom_of_warp_yarn_count_value">
                      <option select="selected" value="select">Select Uom Of Warp Yarn Tensile Properties</option>

                       
                      <?php
                                      $uom_of_warp_yarn_count_value = $row_for_greige_receiving['uom_of_warp_yarn_count_value'];
                                     ?>
                                     <?php 
                                          if($uom_of_warp_yarn_count_value=='Ne')
                                          {
                                       ?>
                                          <option value="Ne" selected>Ne</option>
                                          <option value="Nm">Nm</option>
                                          <option value="Den">Den</option>
                                          <option value="tex">tex</option>
                                          <option value="dtex">dtex</option>
                                      <?php
                                          }
                                          else if($uom_of_warp_yarn_count_value=='Nm')
                                          {
                                         ?>
                                          <option value="Ne">Ne</option>
                                          <option value="Nm" selected>Nm</option>
                                          <option value="Den">Den</option>
                                          <option value="tex">tex</option>
                                          <option value="dtex">dtex</option>
                                       <?php
                                          }
                                          else if($uom_of_warp_yarn_count_value=='Den')
                                          {
                                         ?>
                                          <option value="Ne">Ne</option>
                                          <option value="Nm" >Nm</option>
                                          <option value="Den" selected>Den</option>
                                          <option value="tex">tex</option>
                                          <option value="dtex">dtex</option>
                                       <?php
                                          }
                                          else if($uom_of_warp_yarn_count_value=='tex')
                                          {
                                         ?>
                                          <option value="Ne">Ne</option>
                                          <option value="Nm" >Nm</option>
                                          <option value="Den" >Den</option>
                                          <option value="tex" selected>tex</option>
                                          <option value="dtex">dtex</option>
                                       <?php
                                          }
                                          else
                                          {
                                         ?>
                                         <option value="Ne">Ne</option>
                                          <option value="Nm" >Nm</option>
                                          <option value="Den" >Den</option>
                                          <option value="tex" >tex</option>
                                          <option value="dtex" selected>dtex</option>
                                       <?php
                                          }
                                       ?>
            </select>
          </div>

		        
          <div class="col-sm-1 text-center" for="min_value">

          	<input type="text" class="form-control" id="warp_yarn_count_min_value" name="warp_yarn_count_min_value" value="<?php echo $row_for_greige_receiving['warp_yarn_count_min_value']?>" required>
             
          </div>
		          
          <div class="col-sm-1 text-center">
              
            <input type="text" class="form-control" id="warp_yarn_count_max_value" name="warp_yarn_count_max_value" value="<?php echo $row_for_greige_receiving['warp_yarn_count_max_value']?>" required>

           </div>
		            
		        

     </div><!-- End of <div class="form-group form-group-sm" warp_yarn_count -->




      <div class="form-group form-group-sm" for="weft_yarn_count">
		    
			<div class="col-sm-3 text-center">
				 <label class="control-label" for="weft_yarn_count_value" style="color:#00008B;"><span id="for_weft_yarn_count_test_name_label" style="display: none;">Yarn Count</span><span id="weft_yarn_count_test_method" style="display: none;">(ISO 7211-5)</span></label>
			</div>
			 
			 <div class="col-sm-2 text-center">
	              <!-- <label for="description_or_type" style="font-size:12px; color:#000066;">Direction/Type</label> -->
	              <label class="control-label" for="description_or_type" style="color:#00008B;"> Weft </label>
	              
	         </div>


	         <div class="col-sm-1 text-center">
		            <input type="text" class="form-control" id="weft_yarn_count_value" name="weft_yarn_count_value" value="<?php echo $row_for_greige_receiving['weft_yarn_count_value']?>" onchange="weft_yarn_count_cal()" required>
		         
		     </div>
		        
		         
          <div class="col-sm-1 text-center">
             <select  class="form-control" id="weft_yarn_count_tolerance_range_math_operator" name="weft_yarn_count_tolerance_range_math_operator" onchange="weft_yarn_count_cal()">
                      <option select="selected" value="select">Select weft Yarn CountTolerance Range Math Operator</option>
                      <?php
                                      $weft_yarn_count_tolerance_range_math_operator = $row_for_greige_receiving['weft_yarn_count_tolerance_range_math_operator'];
                                     ?>
                                     <?php 
                                          if($weft_yarn_count_tolerance_range_math_operator=='+')
                                          {
                                       ?>
                                          <option value="+" selected> +</option>
                                          <option value="-"> -</option>
                                          <option value="+/-">+/-</option>
                                      <?php
                                          }
                                          else if($weft_yarn_count_tolerance_range_math_operator=='-')
                                          {
                                         ?>
                                          <option value="+">+</option>
                                          <option value="-" selected>-</option>
                                          <option value="+/-">+/-</option>
                                       <?php
                                          }
                                          else
                                          {
                                         ?>
                                          <option value="+">+</option>
                                          <option value="-">-</option>
                                          <option value="+/-" selected>+/-</option>
                                       <?php
                                          }
                                       ?>
               </select>
              
           </div>
	          
	               <!--Add Input/Select Field Here No Dive Only Input/Select/Radio Button/Checkbox/Textarea -->
		          
          <div class="col-sm-1" for="tolerance">

             <input type="text" class="form-control" id="weft_yarn_count_tolerance_value" name="weft_yarn_count_tolerance_value" value="<?php echo $row_for_greige_receiving['weft_yarn_count_tolerance_value']?>" onchange="weft_yarn_count_cal()" required>

          </div>

          <div class="col-sm-1" for="unit">
          	<select  class="form-control" id="uom_of_weft_yarn_count_value" name="uom_of_weft_yarn_count_value">
                      <option select="selected" value="select">Select Uom Of weft Yarn Tensile Properties</option>
                      <?php
                                      $uom_of_weft_yarn_count_value = $row_for_greige_receiving['uom_of_weft_yarn_count_value'];
                                     ?>
                                     <?php 
                                          if($uom_of_weft_yarn_count_value=='Ne')
                                          {
                                       ?>
                                          <option value="Ne" selected>Ne</option>
                                          <option value="Nm">Nm</option>
                                          <option value="Den">Den</option>
                                          <option value="tex">tex</option>
                                          <option value="dtex">dtex</option>
                                      <?php
                                          }
                                          else if($uom_of_weft_yarn_count_value=='Nm')
                                          {
                                         ?>
                                          <option value="Ne">Ne</option>
                                          <option value="Nm" selected>Nm</option>
                                          <option value="Den">Den</option>
                                          <option value="tex">tex</option>
                                          <option value="dtex">dtex</option>
                                       <?php
                                          }
                                          else if($uom_of_weft_yarn_count_value=='Den')
                                          {
                                         ?>
                                          <option value="Ne">Ne</option>
                                          <option value="Nm" >Nm</option>
                                          <option value="Den" selected>Den</option>
                                          <option value="tex">tex</option>
                                          <option value="dtex">dtex</option>
                                       <?php
                                          }
                                          else if($uom_of_weft_yarn_count_value=='tex')
                                          {
                                         ?>
                                          <option value="Ne">Ne</option>
                                          <option value="Nm" >Nm</option>
                                          <option value="Den" >Den</option>
                                          <option value="tex" selected>tex</option>
                                          <option value="dtex">dtex</option>
                                       <?php
                                          }
                                          else
                                          {
                                         ?>
                                         <option value="Ne">Ne</option>
                                          <option value="Nm" >Nm</option>
                                          <option value="Den" >Den</option>
                                          <option value="tex" >tex</option>
                                          <option value="dtex" selected>dtex</option>
                                       <?php
                                          }
                                       ?>
            </select>
          </div>

		        
          <div class="col-sm-1 text-center" for="min_value">

          	<input type="text" class="form-control" id="weft_yarn_count_min_value" name="weft_yarn_count_min_value" value="<?php echo $row_for_greige_receiving['weft_yarn_count_min_value']?>" required>
             
          </div>
		          
          <div class="col-sm-1 text-center">
              
            <input type="text" class="form-control" id="weft_yarn_count_max_value" name="weft_yarn_count_max_value" value="<?php echo $row_for_greige_receiving['weft_yarn_count_max_value']?>" required>

           </div>
		            
		        

     </div><!-- End of <div class="form-group form-group-sm" weft_yarn_count -->



</div>  <!-- End of <div id="div_yarn_count" style="display: none"> -->





<div id="div_number_of_threads_per_unit_length">

	 <div class="form-group form-group-sm" for="no_of_threads_in_warp_value">
		  

			<div class="col-sm-3 text-center">
				 <label class="control-label" for="weft_yarn_count_value" style="color:#00008B;"><span id="for_no_of_threads_in_warp_test_name_label">Number of Threads Per Unit Length</span><span id="no_of_threads_in_warp_test_method">(ISO 7211-2)</span></label>
			</div>
			 
			 <div class="col-sm-2 text-center">
	              <!-- <label for="description_or_type" style="font-size:12px; color:#000066;">Direction/Type</label> -->
	              <label class="control-label" for="description_or_type" style="color:#00008B;"> Warp </label>
	              
	         </div>

	         
	         <div class="col-sm-1 text-center">
		            <input type="text" class="form-control" id="no_of_threads_in_warp_value" name="no_of_threads_in_warp_value" value="<?php echo $row_for_greige_receiving['no_of_threads_in_warp_value']?>" onchange="no_of_threads_in_warp_cal()" required>
		         
		     </div>
		        
		         
          <div class="col-sm-1 text-center">
             <select  class="form-control" id="no_of_threads_in_warp_tolerance_range_math_operator" name="no_of_threads_in_warp_tolerance_range_math_operator" onchange="no_of_threads_in_warp_cal()">
                      <option select="selected" value="select">Select No of Threads Count Tolerance Range Math Operator</option>
                      <?php
                                      $no_of_threads_in_warp_tolerance_range_math_operator = $row_for_greige_receiving['no_of_threads_in_warp_tolerance_range_math_operator'];
                                     ?>
                                     <?php 
                                          if($no_of_threads_in_warp_tolerance_range_math_operator=='+')
                                          {
                                       ?>
                                          <option value="+" selected> +</option>
                                          <option value="-"> -</option>
                                          <option value="+/-">+/-</option>
                                      <?php
                                          }
                                          else if($no_of_threads_in_warp_tolerance_range_math_operator=='-')
                                          {
                                         ?>
                                          <option value="+">+</option>
                                          <option value="-" selected>-</option>
                                          <option value="+/-">+/-</option>
                                       <?php
                                          }
                                          else
                                          {
                                         ?>
                                          <option value="+">+</option>
                                          <option value="-">-</option>
                                          <option value="+/-" selected>+/-</option>
                                       <?php
                                          }
                                       ?>
                </select>
              
           </div>
	          
	               <!--Add Input/Select Field Here No Dive Only Input/Select/Radio Button/Checkbox/Textarea -->
		          
          <div class="col-sm-1" for="tolerance">

             <input type="text" class="form-control" id="no_of_threads_in_warp_tolerance_value" name="no_of_threads_in_warp_tolerance_value" value="<?php echo $row_for_greige_receiving['no_of_threads_in_warp_tolerance_value']?>" onchange="no_of_threads_in_warp_cal()" required>

          </div>

          <div class="col-sm-1" for="unit">
          	<select  class="form-control" id="uom_of_no_of_threads_in_warp_value" name="uom_of_no_of_threads_in_warp_value">
                      <option select="selected" value="select">Select Uom Of No of Threads in Warp Properties</option>
                      
                      <?php
                                      $uom_of_no_of_threads_in_warp_value = $row_for_greige_receiving['uom_of_no_of_threads_in_warp_value'];
                                     ?>
                                     <?php 
                                          if($uom_of_no_of_threads_in_warp_value=='th/inch')
                                          {
                                       ?>
                                          <option value="th/inch" selected> th/inch</option>
                                          <option value="th/cm"> th/cm</option>
                                          
                                      <?php
                                          }
                                          else
                                          {
                                         ?>
                                          <option value="th/inch" > th/inch</option>
                                          <option value="th/cm" selected> th/cm</option>
                                       <?php
                                          }
                                       ?>
                      
            </select>
          </div>

		        
          <div class="col-sm-1 text-center" for="min_value">

          	<input type="text" class="form-control" id="no_of_threads_in_warp_min_value" name="no_of_threads_in_warp_min_value" value="<?php echo $row_for_greige_receiving['no_of_threads_in_warp_min_value']?>" required>
          </div>
		          
          <div class="col-sm-1 text-center">
              
            <input type="text" class="form-control" id="no_of_threads_in_warp_max_value" name="no_of_threads_in_warp_max_value" value="<?php echo $row_for_greige_receiving['no_of_threads_in_warp_max_value']?>" required>

           </div>
		            
		        

      </div><!-- End of <div class="form-group form-group-sm" no_of_threads_in_warp-->



      <div class="form-group form-group-sm" for="no_of_threads_in_warp_value">
		  

			<div class="col-sm-3 text-center">
				 <label class="control-label" for="weft_yarn_count_value" style="color:#00008B;"><span id="for_no_of_threads_in_weft_test_name_label" style="display: none;">Number of Threads Per Unit Length</span><span id="no_of_threads_in_weft_test_method" style="display: none;"> (ISO 7211-2)</span></label>
			</div>
			 
			 <div class="col-sm-2 text-center">
	              <!-- <label for="description_or_type" style="font-size:12px; color:#000066;">Direction/Type</label> -->
	              <label class="control-label" for="description_or_type" style="color:#00008B;"> Weft </label>
	              
	         </div>

	        

	         <div class="col-sm-1 text-center">
		            <input type="text" class="form-control" id="no_of_threads_in_weft_value" name="no_of_threads_in_weft_value" value="<?php echo $row_for_greige_receiving['no_of_threads_in_weft_value']?>" onchange="no_of_threads_in_weft_cal()" required>
		         
		     </div>
		        
		         
          <div class="col-sm-1 text-center">
              <select  class="form-control" id="no_of_threads_in_weft_tolerance_range_math_operator" name="no_of_threads_in_weft_tolerance_range_math_operator" onchange="no_of_threads_in_weft_cal()">
                      <option select="selected" value="select">Select No of Threads Count Tolerance Range Math Operator</option>
                      <?php
                                      $no_of_threads_in_weft_tolerance_range_math_operator = $row_for_greige_receiving['no_of_threads_in_weft_tolerance_range_math_operator'];
                                     ?>
                                     <?php 
                                          if($no_of_threads_in_weft_tolerance_range_math_operator=='+')
                                          {
                                       ?>
                                          <option value="+" selected> +</option>
                                          <option value="-"> -</option>
                                          <option value="+/-">+/-</option>
                                      <?php
                                          }
                                          else if($no_of_threads_in_weft_tolerance_range_math_operator=='-')
                                          {
                                         ?>
                                          <option value="+">+</option>
                                          <option value="-" selected>-</option>
                                          <option value="+/-">+/-</option>
                                       <?php
                                          }
                                          else
                                          {
                                         ?>
                                          <option value="+">+</option>
                                          <option value="-">-</option>
                                          <option value="+/-" selected>+/-</option>
                                       <?php
                                          }
                                       ?>
                </select>
              
           </div>
	          
	               <!--Add Input/Select Field Here No Dive Only Input/Select/Radio Button/Checkbox/Textarea -->
		          
          <div class="col-sm-1" for="tolerance">

              <input type="text" class="form-control" id="no_of_threads_in_weft_tolerance_value" name="no_of_threads_in_weft_tolerance_value" value="<?php echo $row_for_greige_receiving['no_of_threads_in_weft_tolerance_value']?>" onchange="no_of_threads_in_weft_cal()" required>

          </div>

          <div class="col-sm-1" for="unit">
          	 <select  class="form-control" id="uom_of_no_of_threads_in_weft_value" name="uom_of_no_of_threads_in_weft_value" >
                      <option select="selected" value="select">Select Uom Of No of Threads in Weft Properties</option>
                      <?php
                                      $uom_of_no_of_threads_in_weft_value = $row_for_greige_receiving['uom_of_no_of_threads_in_weft_value'];
                                     ?>
                                     <?php 
                                          if($uom_of_no_of_threads_in_weft_value=='th/inch')
                                          {
                                       ?>
                                          <option value="th/inch" selected> th/inch</option>
                                          <option value="th/cm"> th/cm</option>
                                          
                                      <?php
                                          }
                                          else
                                          {
                                         ?>
                                          <option value="th/inch" > th/inch</option>
                                          <option value="th/cm" selected> th/cm</option>
                                       <?php
                                          }
                                       ?>
                      
                      
                </select>
          </div>

		        
          <div class="col-sm-1 text-center" for="min_value">

          	<input type="text" class="form-control" id="no_of_threads_in_weft_min_value" name="no_of_threads_in_weft_min_value"  value="<?php echo $row_for_greige_receiving['no_of_threads_in_weft_min_value']?>" required>
          </div>
		          
          <div class="col-sm-1 text-center">
              
            <input type="text" class="form-control" id="no_of_threads_in_weft_max_value" name="no_of_threads_in_weft_max_value" value="<?php echo $row_for_greige_receiving['no_of_threads_in_weft_max_value']?>" required>

           </div>
		            
		        

     </div><!-- End of <div class="form-group form-group-sm" no_of_threads_in_weft-->

</div>   <!-- End of <div id="div_number_of_threads_per_unit_length" style="display: none"> -->






<div id="div_mass_per_unit_area">


     <div class="form-group form-group-sm" for="mass_per_unit_per_area_value">
		  

			<div class="col-sm-3 text-center">
				 <label class="control-label" for="weft_yarn_count_value" style="color:#00008B;"><span id="for_mass_per_unit_per_area_test_name_label">Mass Per Unit Area</span><span id="mass_per_unit_per_area_test_method"> (ISO 3801)</span></label>
			</div>
			 
			 <div class="col-sm-2 text-center">
	             
	              <!-- <label class="control-label" for="description_or_type" style="color:#00008B;"> </label> -->
	              <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:10px;"/>
	         </div>

	         

	         <div class="col-sm-1 text-center">
		            <input type="text" class="form-control" id="mass_per_unit_per_area_value" name="mass_per_unit_per_area_value" value="<?php echo $row_for_greige_receiving['mass_per_unit_per_area_value']?>" onchange="mass_per_unit_per_area_cal()" required>
		         
		     </div>
		        
		         
          <div class="col-sm-1 text-center">
              <select class="form-control" id="mass_per_unit_per_area_tolerance_range_math_operator" name="mass_per_unit_per_area_tolerance_range_math_operator"  required>
              <option select="selected" value="select">Select No of Threads Count Tolerance Range Math Operator</option>
                      <?php
                                      $mass_per_unit_per_area_tolerance_range_math_operator = $row_for_greige_receiving['mass_per_unit_per_area_tolerance_range_math_operator'];
                                     ?>
                                     <?php 
                                          if($mass_per_unit_per_area_tolerance_range_math_operator=='+')
                                          {
                                       ?>
                                          <option value="+" selected> +</option>
                                          <option value="-"> -</option>
                                          <option value="+/-">+/-</option>
                                      <?php
                                          }
                                          else if($mass_per_unit_per_area_tolerance_range_math_operator=='-')
                                          {
                                         ?>
                                          <option value="+">+</option>
                                          <option value="-" selected>-</option>
                                          <option value="+/-">+/-</option>
                                       <?php
                                          }
                                          else
                                          {
                                         ?>
                                          <option value="+">+</option>
                                          <option value="-">-</option>
                                          <option value="+/-" selected>+/-</option>
                                       <?php
                                          }
                                       ?>
           </div>
	          
	               <!--Add Input/Select Field Here No Dive Only Input/Select/Radio Button/Checkbox/Textarea -->
		          
          <div class="col-sm-1" for="tolerance">

              <input type="text" class="form-control" id="mass_per_unit_per_area_tolerance_value" name="mass_per_unit_per_area_tolerance_value" onchange="mass_per_unit_per_area_cal()" value="<?php echo $row_for_greige_receiving['mass_per_unit_per_area_tolerance_value']?>" required>

          </div>

          <div class="col-sm-1" for="unit">
          	 <select  class="form-control" id="uom_of_mass_per_unit_per_area_value" name="uom_of_mass_per_unit_per_area_value">
                      <option select="selected" value="select">Select Uom Of Mass Per Unit per Area </option>
                      
                      <?php
                                      $uom_of_mass_per_unit_per_area_value = $row_for_greige_receiving['uom_of_mass_per_unit_per_area_value'];
                                     ?>
                                     <?php 
                                          if($uom_of_mass_per_unit_per_area_value=='gm/m2')
                                          {
                                       ?>
                                          <option value="gm/m2" selected> gm/m2</option>
                                          <option value="oz/yd2">oz/yd2</option>
                                          
                                      <?php
                                          }
                                          else
                                          {
                                         ?>
                                          <option value="gm/m2" > gm/m2</option>
                                          <option value="oz/yd2" selected>oz/yd2</option>
                                       <?php
                                          }
                                       ?>
                </select>
          </div>

		        
          <div class="col-sm-1 text-center" for="min_value">

          	<input type="text" class="form-control" id="mass_per_unit_per_area_min_value" name="mass_per_unit_per_area_min_value" value="<?php echo $row_for_greige_receiving['mass_per_unit_per_area_min_value']?>" required>
          </div>
		          
          <div class="col-sm-1 text-center" for="max_value">
              
            <input type="text" class="form-control" id="mass_per_unit_per_area_max_value" name="mass_per_unit_per_area_max_value" value="<?php echo $row_for_greige_receiving['mass_per_unit_per_area_max_value']?>" required>

           </div>

           
		            
		        

     </div><!-- End of <div class="form-group form-group-sm" no_of_threads_in_warp-->


</div>   <!-- ENd of <div id="div_mass_per_unit_area" style="display: none"> -->



<div id="div_greige_width">



	 <div class="form-group form-group-sm" >
      

        <div class="col-sm-3 text-center">
           <label class="control-label"  style="color:#00008B;">Greige Width</label>
        </div>
       
        <div class="col-sm-2 text-center">
                <!-- <label for="description_or_type" style="font-size:12px; color:#000066;">Direction/Type</label> -->
                <label class="control-label" for="description_or_type" style="color:#00008B;"> </label>

                <input type="hidden" class="form-control" id="test_method_for_greige_width" name="greige_width" value="ISO 2819">
                
        </div>

          

           <div class="col-sm-1 text-center">
                <input type="text" class="form-control" id="greige_width_value" name="greige_width_value" value="<?php echo $row_for_greige_receiving['greige_width_value']?>" onchange="greige_width_cal()" required>
             
           </div>
            
             
          <div class="col-sm-1 text-center">
              
      
                  <select  class="form-control" id="greige_width_range_math_operator" name="greige_width_range_math_operator" onchange="greige_width_cal()">
                      <option select="selected" value="select">Select Greige Width Range Math Operator</option>
                      <?php
                                      $mass_per_unit_per_area_tolerance_range_math_operator = $row_for_greige_receiving['mass_per_unit_per_area_tolerance_range_math_operator'];
                                     ?>
                                     <?php 
                                          if($mass_per_unit_per_area_tolerance_range_math_operator=='+')
                                          {
                                       ?>
                                          <option value="+" selected> +</option>
                                          <option value="-"> -</option>
                                          <option value="+/-">+/-</option>
                                      <?php
                                          }
                                          else if($mass_per_unit_per_area_tolerance_range_math_operator=='-')
                                          {
                                         ?>
                                          <option value="+">+</option>
                                          <option value="-" selected>-</option>
                                          <option value="+/-">+/-</option>
                                       <?php
                                          }
                                          else
                                          {
                                         ?>
                                          <option value="+">+</option>
                                          <option value="-">-</option>
                                          <option value="+/-" selected>+/-</option>
                                       <?php
                                          }
                                       ?>
                  </select>
        
              
           </div>
            
                 <!--Add Input/Select Field Here No Dive Only Input/Select/Radio Button/Checkbox/Textarea -->
              
          <div class="col-sm-1" for="tolerance">

            <input type="text" class="form-control" id="greige_width_tolerance_value" name="greige_width_tolerance_value" value="<?php echo $row_for_greige_receiving['greige_width_tolerance_value']?>" onchange="greige_width_cal()" required>
          </div>

          <div class="col-sm-1" for="unit">
             Inch
            <input type="hidden" class="form-control" id="uom_of_greige_width_value" name="uom_of_greige_width_value" value="inch">
          </div>

            
          <div class="col-sm-1 text-center" for="min_value">

            <input type="text" class="form-control" id="greige_width_min_value" name="greige_width_min_value" value="<?php echo $row_for_greige_receiving['greige_width_min_value']?>" required>
          </div>
              
          <div class="col-sm-1 text-center">
              
           <input type="text" class="form-control" id="greige_width_max_value" name="greige_width_max_value" value="<?php echo $row_for_greige_receiving['greige_width_max_value']?>" required>

           </div>
                
       
     </div><!-- End of <div class="form-group form-group-sm" greige_width_max_value-->


</div>   <!-- End of <div id="div_greige_width" style="display: none"> -->




<div class="form-group form-group-sm" id="div_fiber_content" style="display: none">



   <div class="form-group form-group-sm" >
      

      <div class="col-sm-3 text-center">
         <label class="control-label"  style="color:#00008B;"><span id="for_total_cotton_content_test_name_label">Fiber Content</span><span id="total_cotton_content_test_method">(In house test method)</span></label>
      </div>
       
       <div class="col-sm-2 text-center">
                <!-- <label for="description_or_type" style="font-size:12px; color:#000066;">Direction/Type</label> -->
                <label class="control-label" for="description_or_type" style="color:#00008B;">Cotton (Total) </label>
                <input type="hidden" class="form-control" id="test_method_for_total_cotton_content" name="test_method_for_total_cotton_content" value="In house test method">
                
           </div>

       

           <div class="col-sm-1 text-center">
                 <input type="text" class="form-control" id="percentage_of_total_cotton_content_value" name="percentage_of_total_cotton_content_value" placeholder="Enter Value" onchange="percentage_of_total_cotton_content_cal()" required>
             
         </div>
            
             
          <div class="col-sm-1 text-center">
               <select  class="form-control" id="percentage_of_total_cotton_content_tolerance_range_math_operator" name="percentage_of_total_cotton_content_tolerance_range_math_operator" onchange="percentage_of_total_cotton_content_cal()">
                      <option select="selected" value="select">Select Percentage of Total Cotton Content Math Operator</option>
                      <option value="+">+</option>
                      <option value="-"> - </option>
                      <option value="+/-"> +/- </option>
                </select>
              
           </div>
            
                 <!--Add Input/Select Field Here No Dive Only Input/Select/Radio Button/Checkbox/Textarea -->
              
          <div class="col-sm-1" for="tolerance">

             
              <input type="text" class="form-control" id="percentage_of_total_cotton_content_tolerance_value" name="percentage_of_total_cotton_content_tolerance_value" placeholder="Enter Tolerance Value" onchange="percentage_of_total_cotton_content_cal()" required>
          </div>

          <div class="col-sm-1" for="unit">

             %
            <input type="hidden" class="form-control" id="uom_of_percentage_of_total_cotton_content" name="uom_of_percentage_of_total_cotton_content" value="%" >
          </div>

            
          <div class="col-sm-1 text-center" for="min_value">

             <input type="text" class="form-control" id="percentage_of_total_cotton_content_min_value" name="percentage_of_total_cotton_content_min_value" placeholder="Enter  Min Value" required>

          </div>
              
          <div class="col-sm-1 text-center">
              
           <input type="text" class="form-control" id="percentage_of_total_cotton_content_max_value" name="percentage_of_total_cotton_content_max_value" placeholder="Enter  Max Value" required>

          </div>
                
       
    </div><!-- End of <div class="form-group form-group-sm" percentage_of_total_cotton_content_max_value-->




      <div class="form-group form-group-sm" >
      

	      <div class="col-sm-3 text-center">
	         <label class="control-label"  style="color:#00008B;"><span id="for_total_Polyester_content_test_name_label" style="display: none;">Fiber Content</span><span id="total_Polyester_content_test_method" style="display: none;">(In house test method)</span></label>
	      </div>
	       
	       <div class="col-sm-2 text-center">
	                <!-- <label for="description_or_type" style="font-size:12px; color:#000066;">Direction/Type</label> -->
	                <label class="control-label" for="description_or_type" style="color:#00008B;">Polyester (Total) </label>
	                <input type="hidden" class="form-control" id="percentage_of_total_polyester_content_value" name="percentage_of_total_polyester_content_value" value="In house test method">
	                
           </div>

       

           <div class="col-sm-1 text-center">
                 <input type="text" class="form-control" id="percentage_of_total_polyester_content_value" name="percentage_of_total_polyester_content_value" placeholder="Enter Value" onchange="percentage_of_total_polyester_content_cal()" required>
             
         </div>
            
             
          <div class="col-sm-1 text-center">
               <select  class="form-control" id="percentage_of_total_polyester_content_tolerance_range_math_op" name="percentage_of_total_polyester_content_tolerance_range_math_op" onchange="percentage_of_total_polyester_content_cal()">
                      <option select="selected" value="select">Select Percentage of Total polyeste Content Math Operator</option>
                      <option value="+">+</option>
                      <option value="-"> - </option>
                      <option value="+/-"> +/- </option>
                </select>
              
           </div>
            
                 <!--Add Input/Select Field Here No Dive Only Input/Select/Radio Button/Checkbox/Textarea -->
              
          <div class="col-sm-1" for="tolerance">

             
              <input type="text" class="form-control" id="percentage_of_total_polyester_content_tolerance_value" name="percentage_of_total_polyester_content_tolerance_value" placeholder="Enter Tolerance Value" onchange="percentage_of_total_polyester_content_cal()" required>
          </div>

          <div class="col-sm-1" for="unit">

             %
            <input type="hidden" class="form-control" id="uom_of_percentage_of_total_polyester_content" name="uom_of_percentage_of_total_polyester_content" value="%" >
          </div>

            
          <div class="col-sm-1 text-center" for="min_value">

             <input type="text" class="form-control" id="percentage_of_total_polyester_content_min_value" name="percentage_of_total_polyester_content_min_value" placeholder="Enter  Min Value" required>

          </div>
              
          <div class="col-sm-1 text-center">
              
           <input type="text" class="form-control" id="percentage_of_total_polyester_content_max_value" name="percentage_of_total_polyester_content_max_value" placeholder="Enter  Max Value" required>

         </div>
                
       
     </div><!-- End of <div class="form-group form-group-sm" percentage_of_total_polyester_content_max_value-->



     <div class="form-group form-group-sm" >
      

	      <div class="col-sm-3 text-center">
	         <label class="control-label"  style="color:#00008B;"><span id="for_total_other_fiber_test_name_label" style="display: none;">Fiber Content</span><span id="total_other_fiberr_content_test_method" style="display: none;">(In house test method)</span></label>
	      </div>
	       
	       <div class="col-sm-2 text-center">
	                <!-- <label for="description_or_type" style="font-size:12px; color:#000066;">Direction/Type</label> -->
	               <!--  <label class="control-label" for="description_or_type" style="color:#00008B;">Other Fiber  (Total) </label> -->

	                <select  class="form-control" id="description_or_type_for_total_other_fiber" name="description_or_type_for_total_other_fiber">
							<option select="selected" value="Null">Select total Other Fiber</option>
							<option value="Tencel">Lyocell</option>
							<option value="Tencel">Viscore</option>
							<option value="Tencel">Tencel</option>
							<option value="Lycra">Lycra</option>
							<option value="Linen">Linen</option>
							<option value="Bamboo">Bamboo</option>
							<option value="Recycled Cotton">Recycled Cotton</option>
							<option value="Recycled Polyester">Recycled Polyester</option>
							<option value="Jute">Jute</option>
							<option value="Modal">Modal</option>
							<option value="Rayon">Rayon</option>
					</select>
	                <input type="hidden" class="form-control" id="test_method_for_total_other_fiber_content" name="test_method_for_total_other_fiber_content" value="In house test method">
                
           </div>

       

           <div class="col-sm-1 text-center">
                 <input type="text" class="form-control" id="percentage_of_total_other_fiber_content_value" name="percentage_of_total_other_fiber_content_value" placeholder="Enter Value" onchange="percentage_of_total_other_fiber_content_cal()" required>
             
          </div>
            
             
          <div class="col-sm-1 text-center">
               <select  class="form-control" id="percentage_of_total_other_fiber_content_tolerance_range_math_op" name="percentage_of_total_other_fiber_content_tolerance_range_math_op" onchange="percentage_of_total_other_fiber_content_cal()">
                      <option select="selected" value="select">Select Percentage of Total other_fiber Content Math Operator</option>
                      <option value="+">+</option>
                      <option value="-"> - </option>
                      <option value="+/-"> +/- </option>
                </select>
              
           </div>
            
                 <!--Add Input/Select Field Here No Dive Only Input/Select/Radio Button/Checkbox/Textarea -->
              
          <div class="col-sm-1" for="tolerance">

             
              <input type="text" class="form-control" id="percentage_of_total_other_fiber_content_tolerance_value" name="percentage_of_total_other_fiber_content_tolerance_value" placeholder="Enter Tolerance Value" onchange="percentage_of_total_other_fiber_content_cal()" required>
          </div>

          <div class="col-sm-1" for="unit">

             %
            <input type="hidden" class="form-control" id="uom_of_percentage_of_total_other_fiber_content" name="uom_of_percentage_of_total_other_fiber_content" value="%" >
          </div>

            
          <div class="col-sm-1 text-center" for="min_value">

             <input type="text" class="form-control" id="percentage_of_total_other_fiber_content_min_value" name="percentage_of_total_other_fiber_content_min_value" placeholder="Enter  Min Value" required>

          </div>
              
          <div class="col-sm-1 text-center">
              
           <input type="text" class="form-control" id="percentage_of_total_other_fiber_content_max_value" name="percentage_of_total_other_fiber_content_max_value" placeholder="Enter  Max Value" required>

         </div>
                
       
     </div><!-- End of <div class="form-group form-group-sm" percentage_of_total_other_fiber_content_max_value-->



     <div class="form-group form-group-sm" >
      

        <div class="col-sm-3 text-center">
           <label class="control-label"  style="color:#00008B;"><span id="for_total_other_fiberr_test_name_label" style="display: none;">Fiber Content</span><span id="total_other_fiberr_content_test_method" style="display: none;">(In house test method)</span></label>
        </div>
         
         <div class="col-sm-2 text-center">
                  <!-- <label for="description_or_type" style="font-size:12px; color:#000066;">Description/Type</label> -->
                 <!--  <label class="control-label" for="description_or_type" style="color:#00008B;">Other Fiber  (Total) </label> -->

                  <select  class="form-control" id="description_or_type_for_total_other_fiber_1" name="description_or_type_for_total_other_fiber_1">
		              	<option select="selected" value="Null">Select total Other Fiber</option>
		              	<option value="Tencel">Lyocell</option>
						<option value="Tencel">Viscore</option>
						<option value="Tencel">Tencel</option>
						<option value="Lycra">Lycra</option>
						<option value="Linen">Linen</option>
						<option value="Bamboo">Bamboo</option>
						<option value="Recycled Cotton">Recycled Cotton</option>
						<option value="Recycled Polyester">Recycled Polyester</option>
						<option value="Jute">Jute</option>
						<option value="Modal">Modal</option>
						<option value="Rayon">Rayon</option>
	              </select>

           <!-- <select  class="form-control" id="description_or_type_for_total_other_fiber_1" name="description_or_type_for_total_other_fiber_1">
		              <option select="selected" value="Null">Select Other Fiber</option>
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
		              
                 </select> -->
                  <input type="hidden" class="form-control" id="test_method_for_total_other_fiber_content_1" name="test_method_for_total_other_fiber_content_1" value="In house test method">
                
           </div>

       

           <div class="col-sm-1 text-center">
                 <input type="text" class="form-control" id="percentage_of_total_other_fiber_content_1_value" name="percentage_of_total_other_fiber_content_1_value" placeholder="Enter Value" onchange="percentage_of_total_other_fiber_content_1_cal()" required>
             
           </div>
            
             
           <div class="col-sm-1 text-center">
               <select  class="form-control" id="percentage_of_total_other_fiber_content_1_tol_range_math_op" name="percentage_of_total_other_fiber_content_1_tol_range_math_op" onchange="percentage_of_total_other_fiber_content_1_cal()">
                      <option select="selected" value="select">Select Percentage of Total other_fiber Content Math Operator</option>
                      <option value="+">+</option>
                      <option value="-"> - </option>
                      <option value="+/-"> +/- </option>
                </select>
              
           </div>
            
                 <!--Add Input/Select Field Here No Dive Only Input/Select/Radio Button/Checkbox/Textarea -->
              
          <div class="col-sm-1" for="tolerance">

              <input type="text" class="form-control" id="percentage_of_total_other_fiber_content_1_tolerance_value" name="percentage_of_total_other_fiber_content_1_tolerance_value" placeholder="Enter Tolerance Value" onchange="percentage_of_total_other_fiber_content_1_cal()" required>
          </div>

          <div class="col-sm-1" for="unit">

             %
            <input type="hidden" class="form-control" id="uom_of_percentage_of_total_other_fiber_content_1" name="uom_of_percentage_of_total_other_fiber_content_1" value="%" >
          </div>

            
          <div class="col-sm-1 text-center" for="min_value">

             <input type="text" class="form-control" id="percentage_of_total_other_fiber_content_1_min_value" name="percentage_of_total_other_fiber_content_1_min_value" placeholder="Enter  Min Value" required>

          </div>
              
          <div class="col-sm-1 text-center">
              
           <input type="text" class="form-control" id="percentage_of_total_other_fiber_content_1_max_value" name="percentage_of_total_other_fiber_content_1_max_value" placeholder="Enter  Max Value" required>

         </div>
                
       
     </div><!-- End of <div class="form-group form-group-sm" percentage_of_total_other_fiber_content_1_max_value-->




     <div class="form-group form-group-sm" >
      

         <div class="col-sm-3 text-center">
           <label class="control-label"  style="color:#00008B;"><span id="for_warp_cotton_content_test_name_label">Fiber Content</span><span id="warp_cotton_content_test_method">(In house test method)</span></label>
         </div>
         
         <div class="col-sm-2 text-center">
                  <!-- <label for="description_or_type" style="font-size:12px; color:#000066;">Direction/Type</label> -->
                  <label class="control-label" for="description_or_type" style="color:#00008B;">Cotton (Warp) </label>
                  <input type="hidden" class="form-control" id="test_method_for_warp_cotton_content" name="test_method_for_warp_cotton_content" value="In house test method">
                
         </div>

          <div class="col-sm-1 text-center">
                 <input type="text" class="form-control" id="percentage_of_warp_cotton_content_value" name="percentage_of_warp_cotton_content_value" placeholder="Enter Value" onchange="percentage_of_warp_cotton_content_cal()" required>
             
          </div>
            
             
          <div class="col-sm-1 text-center">
               <select  class="form-control" id="percentage_of_warp_cotton_content_tolerance_range_math_operator" name="percentage_of_warp_cotton_content_tolerance_range_math_operator" onchange="percentage_of_warp_cotton_content_cal()">
                      <option select="selected" value="select">Select Percentage of Total other_fiber Content Math Operator</option>
                      <option value="+">+</option>
                      <option value="-"> - </option>
                      <option value="+/-"> +/- </option>
                </select>
              
           </div>
            
                 <!--Add Input/Select Field Here No Dive Only Input/Select/Radio Button/Checkbox/Textarea -->
              
          <div class="col-sm-1" for="tolerance">

            
              <input type="text" class="form-control" id="percentage_of_warp_cotton_content_tolerance_value" name="percentage_of_warp_cotton_content_tolerance_value" placeholder="Enter Tolerance Value" onchange="percentage_of_warp_cotton_content_cal()" required>
          </div>

          <div class="col-sm-1" for="unit">

             %
            <input type="hidden" class="form-control" id="uom_of_percentage_of_warp_cotton_content" name="uom_of_percentage_of_warp_cotton_content" value="%" >
          </div>

            
          <div class="col-sm-1 text-center" for="min_value">

             <input type="text" class="form-control" id="percentage_of_warp_cotton_content_min_value" name="percentage_of_warp_cotton_content_min_value" placeholder="Enter  Min Value" required>

          </div>
              
          <div class="col-sm-1 text-center">
              
           <input type="text" class="form-control" id="percentage_of_warp_cotton_content_max_value" name="percentage_of_warp_cotton_content_max_value" placeholder="Enter  Max Value" required>

          </div>
                
       
     </div><!-- End of <div class="form-group form-group-sm" percentage_of_warp_cotton_content_max_value-->



     <div class="form-group form-group-sm" >
      

        <div class="col-sm-3 text-center">
           <label class="control-label"  style="color:#00008B;"><span id="for_warp_polyester_content_test_name_label" style="display: none;">Fiber Content</span><span id="warp_polyester_content_test_method" style="display: none;">(In house test method)</span></label>
        </div>
         
         <div class="col-sm-2 text-center">
                  <!-- <label for="description_or_type" style="font-size:12px; color:#000066;">Direction/Type</label> -->
                  <label class="control-label" for="description_or_type" style="color:#00008B;">polyester (Warp) </label>
                  <input type="hidden" class="form-control" id="test_method_for_warp_polyester_content" name="test_method_for_warp_polyester_content" value="In house test method">
                
           </div>

       

           <div class="col-sm-1 text-center">
                 <input type="text" class="form-control" id="percentage_of_warp_polyester_content_value" name="percentage_of_warp_polyester_content_value" placeholder="Enter Value" onchange="percentage_of_warp_polyester_content_cal()" required>
             
         </div>
            
             
          <div class="col-sm-1 text-center">
               <select  class="form-control" id="percentage_of_warp_polyester_content_tolerance_range_math_op" name="percentage_of_warp_polyester_content_tolerance_range_math_op" onchange="percentage_of_warp_polyester_content_cal()">
                      <option select="selected" value="select">Select Percentage of Total other_fiber Content Math Operator</option>
                      <option value="+">+</option>
                      <option value="-"> - </option>
                      <option value="+/-"> +/- </option>
                </select>
              
           </div>
            
                 <!--Add Input/Select Field Here No Dive Only Input/Select/Radio Button/Checkbox/Textarea -->
              
          <div class="col-sm-1" for="tolerance">

            
              <input type="text" class="form-control" id="percentage_of_warp_polyester_content_tolerance_value" name="percentage_of_warp_polyester_content_tolerance_value" placeholder="Enter Tolerance Value" onchange="percentage_of_warp_polyester_content_cal()" required>
          </div>

          <div class="col-sm-1" for="unit">

             %
            <input type="hidden" class="form-control" id="uom_of_percentage_of_warp_polyester_content" name="uom_of_percentage_of_warp_polyester_content" value="%" >
          </div>

            
          <div class="col-sm-1 text-center" for="min_value">

             <input type="text" class="form-control" id="percentage_of_warp_polyester_content_min_value" name="percentage_of_warp_polyester_content_min_value" placeholder="Enter  Min Value" required>

          </div>
              
          <div class="col-sm-1 text-center">
              
           <input type="text" class="form-control" id="percentage_of_warp_polyester_content_max_value" name="percentage_of_warp_polyester_content_max_value" placeholder="Enter  Max Value" required>

         </div>
                
       
     </div><!-- End of <div class="form-group form-group-sm" percentage_of_warp_polyester_content_max_value-->



     <div class="form-group form-group-sm" >
      

        <div class="col-sm-3 text-center">
           <label class="control-label"  style="color:#00008B;"><span id="for_warp_polyester_content_test_name_label" style="display: none;">Fiber Content</span>   <span id="warp_polyester_content_test_method" style="display: none;">(In house test method)</span></label>
        </div>
         
         <div class="col-sm-2 text-center">
                  <!-- <label for="description_or_type" style="font-size:12px; color:#000066;">Direction/Type</label> -->
         <select  class="form-control" id="description_or_type_for_warp_other_fiber" name="description_or_type_for_warp_other_fiber">
              <option select="selected" value="Null">Select Other Fiber in Warp</option>
              <option value="Tencel">Lyocell</option>
				<option value="Tencel">Viscore</option>
				<option value="Tencel">Tencel</option>
				<option value="Lycra">Lycra</option>
				<option value="Linen">Linen</option>
				<option value="Bamboo">Bamboo</option>
				<option value="Recycled Cotton">Recycled Cotton</option>
				<option value="Recycled Polyester">Recycled Polyester</option>
				<option value="Jute">Jute</option>
				<option value="Modal">Modal</option>
				<option value="Rayon">Rayon</option>
          </select>
                  <input type="hidden" class="form-control" id="test_method_for__warp_other_fiber" name="test_method_for_warp_other_fiber" value="In house test method">
                
           </div>

       

           <div class="col-sm-1 text-center">
                 <input type="text" class="form-control" id="percentage_of_warp_other_fiber_content_value" name="percentage_of_warp_other_fiber_content_value" placeholder="Enter Value" onchange="percentage_of_warp_other_fiber_content_cal()" required>
             
         </div>
            
             
          <div class="col-sm-1 text-center">
               <select  class="form-control" id="percentage_of_warp_other_fiber_content_tolerance_range_math_op" name="percentage_of_warp_other_fiber_content_tolerance_range_math_op" onchange="percentage_of_warp_other_fiber_content_cal()">
                      <option select="selected" value="select">Select Percentage of  other fiber Content Math Operator</option>
                      <option value="+">+</option>
                      <option value="-"> - </option>
                      <option value="+/-"> +/- </option>
                </select>
              
           </div>
            
                 <!--Add Input/Select Field Here No Dive Only Input/Select/Radio Button/Checkbox/Textarea -->
              
          <div class="col-sm-1" for="tolerance">

            
              <input type="text" class="form-control" id="percentage_of_warp_other_fiber_content_tolerance_value" name="percentage_of_warp_other_fiber_content_tolerance_value" placeholder="Enter Tolerance Value" onchange="percentage_of_warp_other_fiber_content_cal()" required>
          </div>

          <div class="col-sm-1" for="unit">

             %
            <input type="hidden" class="form-control" id="uom_of_percentage_of_warp_other_fiber_content" name="uom_of_percentage_of_warp_other_fiber_content" value="%" >
          </div>

            
          <div class="col-sm-1 text-center" for="min_value">

             <input type="text" class="form-control" id="percentage_of_warp_other_fiber_content_min_value" name="percentage_of_warp_other_fiber_content_min_value" placeholder="Enter  Min Value" required>

          </div>
              
          <div class="col-sm-1 text-center">
              
           <input type="text" class="form-control" id="percentage_of_warp_other_fiber_content_max_value" name="percentage_of_warp_other_fiber_content_max_value" placeholder="Enter  Max Value" required>

         </div>
                
       
     </div><!-- End of <div class="form-group form-group-sm" percentage_of_warp_other_fiber_value-->






    <div class="form-group form-group-sm" >
      

         <div class="col-sm-3 text-center">
           <label class="control-label"  style="color:#00008B;"><span id="for_warp_other_fiberr_test_name_label" style="display: none;">Fiber Content</span>   <span id="warp_other_fiberr_content_test_method" style="display: none;">(In house test method)</span></label>
         </div>
         
         <div class="col-sm-2 text-center">
                  <!-- <label for="description_or_type" style="font-size:12px; color:#000066;">Description/Type</label> -->
                 <!--  <label class="control-label" for="description_or_type" style="color:#00008B;">Other Fiber  (warp) </label> -->

                  <select  class="form-control" id="description_or_type_for_warp_other_fiber_1" name="description_or_type_for_warp_other_fiber_1">
		              <option select="selected" value="Null">Select Other Fiber in warp</option>
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
			              
			      </select>

         
                  <input type="hidden" class="form-control" id="test_method_for_warp_other_fiber_content_1" name="test_method_for_warp_other_fiber_content_1" value="In house test method">
                
           </div>

       

           <div class="col-sm-1 text-center">
                 <input type="text" class="form-control" id="percentage_of_warp_other_fiber_content_1_value" name="percentage_of_warp_other_fiber_content_1_value" placeholder="Enter Value" onchange="percentage_of_warp_other_fiber_content_1_cal()" required>
             
         </div>
            
             
          <div class="col-sm-1 text-center">
               <select  class="form-control" id="percentage_of_warp_other_fiber_content_1_tolerance_range_math_op" name="percentage_of_warp_other_fiber_content_1_tolerance_range_math_op" onchange="percentage_of_warp_other_fiber_content_1_cal()">
                      <option select="selected" value="select">Select Percentage of warp other_fiber Content Math Operator</option>
                      <option value="+">+</option>
                      <option value="-"> - </option>
                      <option value="+/-"> +/- </option>
                </select>
              
           </div>
            
                 <!--Add Input/Select Field Here No Dive Only Input/Select/Radio Button/Checkbox/Textarea -->
              
          <div class="col-sm-1" for="tolerance">

             
              <input type="text" class="form-control" id="percentage_of_warp_other_fiber_content_1_tolerance_value" name="percentage_of_warp_other_fiber_content_1_tolerance_value" placeholder="Enter Tolerance Value" onchange="percentage_of_warp_other_fiber_content_1_cal()" required>
          </div>

          <div class="col-sm-1" for="unit">

             %
            <input type="hidden" class="form-control" id="uom_of_percentage_of_warp_other_fiber_content_1" name="uom_of_percentage_of_warp_other_fiber_content_1" value="%" >
          </div>

            
          <div class="col-sm-1 text-center" for="min_value">

             <input type="text" class="form-control" id="percentage_of_warp_other_fiber_content_1_min_value" name="percentage_of_warp_other_fiber_content_1_min_value" placeholder="Enter  Min Value" required>

          </div>
              
          <div class="col-sm-1 text-center">
              
           <input type="text" class="form-control" id="percentage_of_warp_other_fiber_content_1_max_value" name="percentage_of_warp_other_fiber_content_1_max_value" placeholder="Enter  Max Value" required>

         </div>
                
       
     </div><!-- End of <div class="form-group form-group-sm" percentage_of_warp_other_fiber_content_1_max_value-->


     <div class="form-group form-group-sm" >
      

        <div class="col-sm-3 text-center">
           <label class="control-label"  style="color:#00008B;"><span id="for_weft_cotton_content_test_name_label">Fiber Content</span><span id="weft_cotton_content_test_method">(In house test method)</span></label>
        </div>
         
         <div class="col-sm-2 text-center">
                  <!-- <label for="description_or_type" style="font-size:12px; color:#000066;">Direction/Type</label> -->
                  <label class="control-label" for="description_or_type" style="color:#00008B;">cotton (weft) </label>
                  <input type="hidden" class="form-control" id="test_method_for_weft_cotton_content" name="test_method_for_weft_cotton_content" value="In house test method">
                
           </div>

       

           <div class="col-sm-1 text-center">
                 <input type="text" class="form-control" id="percentage_of_weft_cotton_content_value" name="percentage_of_weft_cotton_content_value" placeholder="Enter Value" onchange="percentage_of_weft_cotton_content_cal()" required>
             
         </div>
            
             
          <div class="col-sm-1 text-center">
               <select  class="form-control" id="percentage_of_weft_cotton_content_tolerance_range_math_op" name="percentage_of_weft_cotton_content_tolerance_range_math_op" onchange="percentage_of_weft_cotton_content_cal()">
                      <option select="selected" value="select">Select Percentage of Total other_fiber Content Math Operator</option>
                      <option value="+">+</option>
                      <option value="-"> - </option>
                      <option value="+/-"> +/- </option>
                </select>
              
           </div>
            
                 <!--Add Input/Select Field Here No Dive Only Input/Select/Radio Button/Checkbox/Textarea -->
              
          <div class="col-sm-1" for="tolerance">

            
              <input type="text" class="form-control" id="percentage_of_weft_cotton_content_tolerance_value" name="percentage_of_weft_cotton_content_tolerance_value" placeholder="Enter Tolerance Value" onchange="percentage_of_weft_cotton_content_cal()" required>
          </div>

          <div class="col-sm-1" for="unit">

             %
            <input type="hidden" class="form-control" id="uom_of_percentage_of_weft_cotton_content" name="uom_of_percentage_of_weft_cotton_content" value="%" >
          </div>

            
          <div class="col-sm-1 text-center" for="min_value">

             <input type="text" class="form-control" id="percentage_of_weft_cotton_content_min_value" name="percentage_of_weft_cotton_content_min_value" placeholder="Enter  Min Value" required>

          </div>
              
          <div class="col-sm-1 text-center">
              
           <input type="text" class="form-control" id="percentage_of_weft_cotton_content_max_value" name="percentage_of_weft_cotton_content_max_value" placeholder="Enter  Max Value" required>

         </div>
                
       
     </div><!-- End of <div class="form-group form-group-sm" percentage_of_weft_cotton_content_max_value-->

    <div class="form-group form-group-sm" >
      

        <div class="col-sm-3 text-center">
           <label class="control-label"  style="color:#00008B;"><span id="for_weft_polyester_content_test_name_label" style="display: none;">Fiber Content</span><span id="weft_polyester_content_test_method" style="display: none;">(In house test method)</span></label>
        </div>
         
         <div class="col-sm-2 text-center">
                  <!-- <label for="description_or_type" style="font-size:12px; color:#000066;">Direction/Type</label> -->
                  <label class="control-label" for="description_or_type" style="color:#00008B;">polyester (weft) </label>
                  <input type="hidden" class="form-control" id="test_method_for_weft_polyester_content" name="test_method_for_weft_polyester_content" value="In house test method">
                
           </div>

       

           <div class="col-sm-1 text-center">
                 <input type="text" class="form-control" id="percentage_of_weft_polyester_content_value" name="percentage_of_weft_polyester_content_value" placeholder="Enter Value" onchange="percentage_of_weft_polyester_content_cal()" required>
             
         </div>
            
             
          <div class="col-sm-1 text-center">
               <select  class="form-control" id="percentage_of_weft_polyester_content_tolerance_range_math_op" name="percentage_of_weft_polyester_content_tolerance_range_math_op" onchange="percentage_of_weft_polyester_content_cal()">
                      <option select="selected" value="select">Select Percentage of Total other_fiber Content Math Operator</option>
                      <option value="+">+</option>
                      <option value="-"> - </option>
                      <option value="+/-"> +/- </option>
                </select>
              
           </div>
            
                 <!--Add Input/Select Field Here No Dive Only Input/Select/Radio Button/Checkbox/Textarea -->
              
          <div class="col-sm-1" for="tolerance">

            
              <input type="text" class="form-control" id="percentage_of_weft_polyester_content_tolerance_value" name="percentage_of_weft_polyester_content_tolerance_value" placeholder="Enter Tolerance Value" onchange="percentage_of_weft_polyester_content_cal()" required>
          </div>

          <div class="col-sm-1" for="unit">

             %
            <input type="hidden" class="form-control" id="uom_of_percentage_of_weft_polyester_content" name="uom_of_percentage_of_weft_polyester_content" value="%" >
          </div>

            
          <div class="col-sm-1 text-center" for="min_value">

             <input type="text" class="form-control" id="percentage_of_weft_polyester_content_min_value" name="percentage_of_weft_polyester_content_min_value" placeholder="Enter  Min Value" required>

          </div>
              
          <div class="col-sm-1 text-center">
              
           <input type="text" class="form-control" id="percentage_of_weft_polyester_content_max_value" name="percentage_of_weft_polyester_content_max_value" placeholder="Enter  Max Value" required>

         </div>
                
       
     </div><!-- End of <div class="form-group form-group-sm" percentage_of_weft_polyester_content_max_value-->

      <div class="form-group form-group-sm" >
      

        <div class="col-sm-3 text-center">
           <label class="control-label"  style="color:#00008B;"><span id="for_weft_polyester_content_test_name_label" style="display: none;">Fiber Content   <span id="weft_polyester_content_test_method" style="display: none;">(In house test method)</span></label>
        </div>
         
         <div class="col-sm-2 text-center">
                  <!-- <label for="description_or_type" style="font-size:12px; color:#000066;">Direction/Type</label> -->
         <select  class="form-control" id="description_or_type_for_weft_other_fiber" name="description_or_type_for_weft_other_fiber">
              <option select="selected" value="Null">Select Other Fiber in weft</option>
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
              <option value="Lycra">Lycra</option>
          </select>
                  <input type="hidden" class="form-control" id="test_method_for_weft_other_fiber" name="test_method_for_weft_other_fiber" value="In house test method">
                
           </div>

       

           <div class="col-sm-1 text-center">
                 <input type="text" class="form-control" id="percentage_of_weft_other_fiber_content_value" name="percentage_of_weft_other_fiber_content_value" placeholder="Enter Value" onchange="percentage_of_weft_other_fiber_content_cal()" required>
             
         </div>
            
             
          <div class="col-sm-1 text-center">
               <select  class="form-control" id="percentage_of_weft_other_fiber_content_tolerance_range_math_op" name="percentage_of_weft_other_fiber_content_tolerance_range_math_op" onchange="percentage_of_weft_other_fiber_content_cal()">
                      <option select="selected" value="select">Select Percentage of  other fiber Content Math Operator</option>
                      <option value="+">+</option>
                      <option value="-"> - </option>
                      <option value="+/-"> +/- </option>
                </select>
              
           </div>
            
                 <!--Add Input/Select Field Here No Dive Only Input/Select/Radio Button/Checkbox/Textarea -->
              
          <div class="col-sm-1" for="tolerance">

            
              <input type="text" class="form-control" id="percentage_of_weft_other_fiber_content_tolerance_value" name="percentage_of_weft_other_fiber_content_tolerance_value" placeholder="Enter Tolerance Value" onchange="percentage_of_weft_other_fiber_content_cal()" required>
          </div>

          <div class="col-sm-1" for="unit">

             %
            <input type="hidden" class="form-control" id="uom_of_percentage_of_weft_other_fiber_content" name="uom_of_percentage_of_weft_other_fiber_content" value="%" >
          </div>

            
          <div class="col-sm-1 text-center" for="min_value">

             <input type="text" class="form-control" id="percentage_of_weft_other_fiber_content_min_value" name="percentage_of_weft_other_fiber_content_min_value" placeholder="Enter  Min Value" required>

          </div>
              
          <div class="col-sm-1 text-center">
              
           <input type="text" class="form-control" id="percentage_of_weft_other_fiber_content_max_value" name="percentage_of_weft_other_fiber_content_max_value" placeholder="Enter  Max Value" required>

         </div>
                
       
     </div><!-- End of <div class="form-group form-group-sm" percentage_of_weft_other_fiber_value-->






   <div class="form-group form-group-sm" >
      

         <div class="col-sm-3 text-center">
           <label class="control-label"  style="color:#00008B;"><span id="for_weft_other_fiberr_test_name_label" style="display: none;">Fiber Content</span><span id="weft_other_fiberr_content_test_method" style="display: none;">(In house test method)</span></label>
         </div>
         
         <div class="col-sm-2 text-center">
                  <!-- <label for="description_or_type" style="font-size:12px; color:#000066;">Description/Type</label> -->
                 <!--  <label class="control-label" for="description_or_type" style="color:#00008B;">Other Fiber  (weft) </label> -->

                  <select  class="form-control" id="description_or_type_for_weft_other_fiber_1" name="description_or_type_for_weft_other_fiber_1">
		              <option select="selected" value="Null">Select Other Fiber in weft</option>
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
		              
		          </select>

           <!-- <select  class="form-control" id="description_or_type_for_weft_other_fiber_1_1" name="description_or_type_for_weft_other_fiber_1_1">
	              <option select="selected" value="Null">Select Other Fiber</option>
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
	              
	          </select> -->
                  <input type="hidden" class="form-control" id="test_method_for_weft_other_fiber_content_1" name="test_method_for_weft_other_fiber_content_1" value="In house test method">
                
           </div>

       

           <div class="col-sm-1 text-center">
                 <input type="text" class="form-control" id="percentage_of_weft_other_fiber_content_1_value" name="percentage_of_weft_other_fiber_content_1_value" placeholder="Enter Value" onchange="percentage_of_weft_other_fiber_content_1_cal()" required>
             
         </div>
            
             
          <div class="col-sm-1 text-center">
               <select  class="form-control" id="percentage_of_weft_other_fiber_content_1_tolerance_range_math_op" name="percentage_of_weft_other_fiber_content_1_tolerance_range_math_op" onchange="percentage_of_weft_other_fiber_content_1_cal()">
                      <option select="selected" value="select">Select Percentage of weft other_fiber Content Math Operator</option>
                      <option value="+">+</option>
                      <option value="-"> - </option>
                      <option value="+/-"> +/- </option>
                </select>
              
           </div>
            
                 <!--Add Input/Select Field Here No Dive Only Input/Select/Radio Button/Checkbox/Textarea -->
              
          <div class="col-sm-1" for="tolerance">

             
              <input type="text" class="form-control" id="percentage_of_weft_other_fiber_content_1_tolerance_value" name="percentage_of_weft_other_fiber_content_1_tolerance_value" placeholder="Enter Tolerance Value" onchange="percentage_of_weft_other_fiber_content_1_cal()" required>
          </div>

          <div class="col-sm-1" for="unit">

             %
            <input type="hidden" class="form-control" id="uom_of_percentage_of_weft_other_fiber_content_1" name="uom_of_percentage_of_weft_other_fiber_content_1" value="%" >
          </div>

            
          <div class="col-sm-1 text-center" for="min_value">

             <input type="text" class="form-control" id="percentage_of_weft_other_fiber_content_1_min_value" name="percentage_of_weft_other_fiber_content_1_min_value" placeholder="Enter  Min Value" required>

          </div>
              
          <div class="col-sm-1 text-center">
              
           <input type="text" class="form-control" id="percentage_of_weft_other_fiber_content_1_max_value" name="percentage_of_weft_other_fiber_content_1_max_value" placeholder="Enter  Max Value" required>

         </div>
                
       
     </div><!-- End of <div class="form-group form-group-sm" percentage_of_weft_other_fiber_content_1_max_value-->
 </div>   <!-- <div class="form-group form-group-sm" id="div_fiber_content" style="display: none"> -->





</div>   <!-- End of <div class="full_page_load" id="full_page_load" style="display :none"> -->





						<div class="form-group form-group-sm">
								<div class="col-sm-offset-3 col-sm-5">
									<button type="button" class="btn btn-primary" onClick="sending_data_of_defining_qc_standard_for_greige_receiving_process_form_for_saving_in_database()">Submit</button>
									<button type="reset" class="btn btn-success">Reset</button>
								</div>
						</div>

				</form>

		</div> <!-- End of <div class="panel panel-default"> -->

   </div> <!-- End of <div class="col-sm-12 col-md-12 col-lg-12"> -->

