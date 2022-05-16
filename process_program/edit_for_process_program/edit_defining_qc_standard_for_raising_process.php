<?php
session_start();
require_once("../login/session.php");
include('../login/db_connection_class.php');
$obj = new DB_Connection_Class();
$obj->connection();


/*$user_name ="Iftekhar";
$user_id ="Iftekhar";
$password ="1234";*/

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

$raising_process_id=$_GET['raising_id'];
$sql_for_raising_process="select * from defining_qc_standard_for_raising_process where `id`='$raising_process_id'";
$result_for_raising_process= mysqli_query($con,$sql_for_raising_process) or die(mysqli_error($con));
$row_for_raising_process = mysqli_fetch_array( $result_for_raising_process);
?>
<script type='text/javascript' src='process_program/defining_qc_standard_for_raising_process_form_validation.js'></script>
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
*/  document.getElementById('color').value=splitted_version_details[1];
  document.getElementById('finish_width_in_inch').value=splitted_version_details[2]; 
  document.getElementById('customer_name').value=splitted_version_details[3]; 
  document.getElementById('customer_id').value=splitted_version_details[5];
  document.getElementById('standard_for_which_process').value='Raising'; 

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

                   /* if($('#div_cf_to_rubbing') && $('#div_whiteness') )
                    {
                     alert($('#div_cf_to_rubbing').length);
                     alert($('#div_whiteness').length);
                    }
                   */

                    if(splitted_data.includes('1') && $('#div_cf_to_rubbing').length !== 0 )  
                     {
                        
                        test_method_for_all+=test_method_id[splitted_data.indexOf('1')]+',';
                    
                        $(".full_page_load").show();
                        $("#div_cf_to_rubbing").show();
                        
                     }

                     if(splitted_data.includes('2') && $('#div_yarn_count').length !== 0) 
                     {
                        
                        test_method_for_all+=test_method_id[splitted_data.indexOf('2')]+',';
                      
                        $(".full_page_load").show();
                        $("#div_dimensional_stability_to_washing").show();
                        
                     }

                     if(splitted_data.includes('3') && $('#div_cf_to_rubbing').length !== 0 )  
                     {
                        
                        test_method_for_all+=test_method_id[splitted_data.indexOf('3')]+',';
                    
                        $(".full_page_load").show();
                        $("#div_yarn_count").show();
                        
                     }

                     if(splitted_data.includes('4') && $('#div_number_of_threads_per_unit_length').length !== 0) 
                     {
                        
                        test_method_for_all+=test_method_id[splitted_data.indexOf('4')]+',';
                      
                        $(".full_page_load").show();
                        $("#div_number_of_threads_per_unit_length").show();
                        
                     }

                     if(splitted_data.includes('5') && $('#div_mass_per_unit_area').length !== 0) 
                     {
                        
                        test_method_for_all+=test_method_id[splitted_data.indexOf('5')]+',';
                      
                        $(".full_page_load").show();
                        $("#div_mass_per_unit_area").show();
                        
                     }

                     if(splitted_data.includes('6') && $('#div_resistance_to_surface_fuzzing_and_pilling').length !== 0) 
                     {
                        
                        test_method_for_all+=test_method_id[splitted_data.indexOf('6')]+',';
                       
                        $(".full_page_load").show();
                        $("#div_resistance_to_surface_fuzzing_and_pilling").show();
                        
                     }

                     if(splitted_data.includes('7') && $('#div_tensile_properties').length !== 0)  
                     {
                        
                        test_method_for_all+=test_method_id[splitted_data.indexOf('7')]+',';

                   
                        $(".full_page_load").show();
                        $("#div_tensile_properties").show();
                        
                     }

                      if(splitted_data.includes('8') && $('#div_tear_force').length !== 0) 
                     {
                        
                        
                        test_method_for_all+=test_method_id[splitted_data.indexOf('8')]+',';
                        
                        $(".full_page_load").show();
                        $("#div_tear_force").show();
                        
                        
                     }




                     if(splitted_data.includes('9') && $('#div_seam_slippage').length !== 0)
                     {
                        
                        test_method_for_all+=test_method_id[splitted_data.indexOf('9')]+',';
                       
                        $(".full_page_load").show();
                        $("#div_seam_slippage").show();
                        
                        
                     }


                      if(splitted_data.includes('10') && $('#div_bowing_and_skew').length !== 0)
                     {
                        test_method_for_all+=test_method_id[splitted_data.indexOf('10')]+',';
                       
                        $(".full_page_load").show();
                        $("#div_bowing_and_skew").show();

                     }

                     if(splitted_data.includes('11') && $('#div_seam_strength').length !== 0)
                     {
                        test_method_for_all+=test_method_id[splitted_data.indexOf('11')]+',';
                        
                        $(".full_page_load").show();
                        $("#div_seam_strength").show();

                     }

                     if(splitted_data.includes('12') && $('#div_seam_properties').length !== 0)
                     {
                        test_method_for_all+=test_method_id[splitted_data.indexOf('12')]+',';
                      
                        $(".full_page_load").show();
                        $("#div_seam_properties").show();

                     }


                     if(splitted_data.includes('13') && $('#div_mass_loss_in_abrasion').length !== 0)
                     {
                        test_method_for_all+=test_method_id[splitted_data.indexOf('13')]+',';
                        
                        $(".full_page_load").show();
                        $("#div_mass_loss_in_abrasion").show();

                     }

                     

                     if(splitted_data.includes('14') && $('#div_mass_loss_in_abrasion').length !== 0)
                     {
                        test_method_for_all+=test_method_id[splitted_data.indexOf('14')]+',';
                       
                        $(".full_page_load").show();
                        $("#div_mass_loss_in_abrasion").show();

                     }

                     if(splitted_data.includes('15') && $('#div_color_fastness_to_washing').length !== 0)
                     {
                        test_method_for_all+=test_method_id[splitted_data.indexOf('15')]+',';
                      
                        $(".full_page_load").show();
                        $("#div_color_fastness_to_washing").show();

                     }

                     if(splitted_data.includes('16') && $('#div_cf_to_dry_cleaning').length !== 0)
                     {
                        test_method_for_all+=test_method_id[splitted_data.indexOf('16')]+',';
                       
                        $(".full_page_load").show();
                        $("#div_cf_to_dry_cleaning").show();

                     }

                     if(splitted_data.includes('17') && $('#div_cf_to_perspiration_acid').length !== 0)
                     {
                        test_method_for_all+=test_method_id[splitted_data.indexOf('17')]+',';
                       
                        $(".full_page_load").show();
                        $("#div_cf_to_perspiration_acid").show();

                     }


                     if(splitted_data.includes('18') && $('#div_cf_to_perspiration_alkali').length !== 0)
                     {
                        test_method_for_all+=test_method_id[splitted_data.indexOf('18')]+',';
                  
                        $(".full_page_load").show();
                        $("#div_cf_to_perspiration_alkali").show();

                     }


                     if(splitted_data.includes('19') && $('#div_color_fastness_to_water').length !== 0)
                     {
                        test_method_for_all+=test_method_id[splitted_data.indexOf('19')]+',';
                       
                        $(".full_page_load").show();
                        $("#div_color_fastness_to_water").show();

                     }


                     if(splitted_data.includes('20') && $('#div_color_fastness_to_water_spotting').length !== 0)
                     {
                        test_method_for_all+=test_method_id[splitted_data.indexOf('20')]+',';
                       
                        $(".full_page_load").show();
                        $("#div_color_fastness_to_water_spotting").show();

                     }

                     if(splitted_data.includes('21') && $('#div_resistance_to_surface_wetting').length !== 0)
                     {
                        test_method_for_all+=test_method_id[splitted_data.indexOf('21')]+',';
                        
                        $(".full_page_load").show();
                        $("#div_resistance_to_surface_wetting").show();

                     }

                     

                     if(splitted_data.includes('22') && $('#div_resistance_to_surface_wetting').length !== 0)
                     {
                        test_method_for_all+=test_method_id[splitted_data.indexOf('22')]+',';
                      
                        $(".full_page_load").show();
                        $("#div_resistance_to_surface_wetting").show();

                     }

                     if(splitted_data.includes('23') && $('#div_cf_to_hydrolysis_of_reactive_dyes').length !== 0)
                     {
                        test_method_for_all+=test_method_id[splitted_data.indexOf('23')]+',';
                      
                        $(".full_page_load").show();
                        $("#div_cf_to_hydrolysis_of_reactive_dyes").show();

                     }


                     if(splitted_data.includes('24') && $('#div_cf_to_oxidative_bleach_damage').length !== 0)
                     {
                        test_method_for_all+=test_method_id[splitted_data.indexOf('24')]+',';
                        
                        $(".full_page_load").show();
                        $("#div_cf_to_oxidative_bleach_damage").show();

                     }

                     if(splitted_data.includes('25') && $('#div_cf_to_phenolic_yellowing').length !== 0)
                     {
                        test_method_for_all+=test_method_id[splitted_data.indexOf('25')]+',';
                        
                        $(".full_page_load").show();
                        $("#div_cf_to_phenolic_yellowing").show();

                     }

                     if(splitted_data.includes('26') && $('#div_migration_of_color_into_pvc').length !== 0)
                     {
                        test_method_for_all+=test_method_id[splitted_data.indexOf('26')]+',';
                       
                        $(".full_page_load").show();
                        $("#div_migration_of_color_into_pvc").show();

                     }

                     if(splitted_data.includes('27') && $('#div_cf_to_saliva').length !== 0)
                     {
                        test_method_for_all+=test_method_id[splitted_data.indexOf('27')]+',';
                     
                        $(".full_page_load").show();
                        $("#div_cf_to_saliva").show();

                     }

                     if(splitted_data.includes('28') && $('#div_cf_to_chlorinated_water').length !== 0)
                     {
                        test_method_for_all+=test_method_id[splitted_data.indexOf('28')]+',';
                       
                        $(".full_page_load").show();
                        $("#div_cf_to_chlorinated_water").show();

                     }

                     if(splitted_data.includes('29') && $('#div_cf_to_chlorine_bleach').length !== 0)
                     {
                        test_method_for_all+=test_method_id[splitted_data.indexOf('29')]+',';
                     
                        $(".full_page_load").show();
                        $("#div_cf_to_chlorine_bleach").show();

                     }

                      if(splitted_data.includes('30') && $('#div_cf_to_peroxide_bleach').length !== 0)
                     {
                        test_method_for_all+=test_method_id[splitted_data.indexOf('30')]+',';
                       
                        $(".full_page_load").show();
                        $("#div_cf_to_peroxide_bleach").show();

                     }

                     if(splitted_data.includes('31') && $('#div_cross_staining').length !== 0)
                     {
                        test_method_for_all+=test_method_id[splitted_data.indexOf('31')]+',';
                        
                        $(".full_page_load").show();
                        $("#div_cross_staining").show();

                     }

                      if(splitted_data.includes('32') && $('#div_formaldehyde_content').length !== 0)
                     {
                        test_method_for_all+=test_method_id[splitted_data.indexOf('32')]+',';
                        
                        $(".full_page_load").show();
                        $("#div_formaldehyde_content").show();

                     }



                     if(splitted_data.includes('33') && $('#div_ph').length !== 0)
                     {
                        test_method_for_all+=test_method_id[splitted_data.indexOf('33')]+',';
                        $(".full_page_load").show();
                        $("#div_ph").show();
                     }

                      if(splitted_data.includes('34') && $('#div_water_absorption').length !== 0)
                     {
                        test_method_for_all+=test_method_id[splitted_data.indexOf('34')]+',';
                        
                        $(".full_page_load").show();
                        $("#div_water_absorption").show();
                     }

                     if(splitted_data.includes('35') && $('#div_wicking_test').length !== 0)
                     {
                        test_method_for_all+=test_method_id[splitted_data.indexOf('35')]+',';
                      
                        $(".full_page_load").show();
                        $("#div_wicking_test").show();
                     }

                     if(splitted_data.includes('36') && $('#div_spirality').length !== 0)
                     {
                        test_method_for_all+=test_method_id[splitted_data.indexOf('36')]+',';
                       
                        $(".full_page_load").show();
                        $("#div_spirality").show();
                     }

                     if(splitted_data.includes('37') && $('#div_smoothness_appearance').length !== 0)
                     {
                        test_method_for_all+=test_method_id[splitted_data.indexOf('37')]+',';
                       
                        $(".full_page_load").show();
                        $("#div_smoothness_appearance").show();
                     }

                     if(splitted_data.includes('38') && $('#div_print_durability').length !== 0)
                     {
                        test_method_for_all+=test_method_id[splitted_data.indexOf('38')]+',';
                       
                        $(".full_page_load").show();
                        $("#div_print_durability").show();
                     }


                     if(splitted_data.includes('39') && $('#div_iron_ability_of_woven_fabric').length !== 0)
                     {
                        test_method_for_all+=test_method_id[splitted_data.indexOf('39')]+',';
                        
                        $(".full_page_load").show();
                        $("#div_iron_ability_of_woven_fabric").show();
                     }

                      if(splitted_data.includes('40') && $('#div_cf_to_artificial_day_light').length !== 0)
                     {
                        test_method_for_all+=test_method_id[splitted_data.indexOf('40')]+',';
                       
                        $(".full_page_load").show();
                        $("#div_cf_to_artificial_day_light").show();
                     }

                      if(splitted_data.includes('41') && $('#div_moisture_content').length !== 0)
                     {
                        test_method_for_all+=test_method_id[splitted_data.indexOf('41')]+',';
                        
                        $(".full_page_load").show();
                        $("#div_moisture_content").show();
                     }

                     if(splitted_data.includes('42') && $('#div_evaporation_rate').length !== 0)
                     {
                        test_method_for_all+=test_method_id[splitted_data.indexOf('42')]+',';
                        
                        $(".full_page_load").show();
                        $("#div_evaporation_rate").show();
                     }

                     if(splitted_data.includes('43') && $('#div_fiber_content').length !== 0)
                     {
                        test_method_for_all+=test_method_id[splitted_data.indexOf('43')]+',';
                        
                        $(".full_page_load").show();
                        $("#div_fiber_content").show();
                     }

                     if(splitted_data.includes('44') && $('#div_greige_width').length !== 0)
                     {
                        test_method_for_all+=test_method_id[splitted_data.indexOf('44')]+',';
                        
                        $(".full_page_load").show();
                        $("#div_greige_width").show();
                     }

                     if(splitted_data.includes('45') && $('#div_flame_intensity').length !== 0)
                     {
                        test_method_for_all+=test_method_id[splitted_data.indexOf('45')]+',';
                       
                        $(".full_page_load").show();
                        $("#div_flame_intensity").show();

                     }
                if(splitted_data.includes('46') && $('#div_machine_speed').length !== 0)
                     {
                        test_method_for_all+=test_method_id[splitted_data.indexOf('46')]+',';
                        
                        $(".full_page_load").show();
                        $("#div_machine_speed").show();

                     }
               if(splitted_data.includes('47')&& $('#div_bath_temparature').length !== 0)
                     {
                        test_method_for_all+=test_method_id[splitted_data.indexOf('47')]+',';
                        
                        $(".full_page_load").show();
                        $("#div_bath_temparature").show();
                     }

               if(splitted_data.includes('48') && $('#div_bath_ph').length !== 0)
                     {
                        test_method_for_all+=test_method_id[splitted_data.indexOf('48')]+',';
                        
                        $(".full_page_load").show();
                        $("#div_bath_ph").show();
                     }

                     if(splitted_data.includes('49') && $('#div_whiteness').length !== 0)  //whiteness
                     {
                        
                        test_method_for_all+=test_method_id[splitted_data.indexOf('49')]+',';
                        $(".full_page_load").show();
                        $("#div_whiteness").show();
                        
                        
                     }

                     if(splitted_data.includes('50') && $('#div_residual_sizing_material').length !== 0) //residual_sizing_material_test_method
                     {
                        
                        test_method_for_all+=test_method_id[splitted_data.indexOf('50')]+',';
                        

                        $(".full_page_load").show();
                        $("#div_residual_sizing_material").show();
                        
                        
                     }

                     if(splitted_data.includes('51')  && $('#div_absorbency_test_method').length !== 0)  // div_absorbency_test_method
                     {
                     
                        test_method_for_all+=test_method_id[splitted_data.indexOf('51')]+',';
                        

                        $(".full_page_load").show();
                        $("#div_absorbency_test_method").show();
                        
                        
                     }


                     if(splitted_data.includes('52') && $('#div_rubbing_dry').length !== 0)
                     {
                        test_method_for_all+=test_method_id[splitted_data.indexOf('52')]+',';
                        

                        $(".full_page_load").show();
                        $("#div_rubbing_dry").show();

                     }
                if(splitted_data.includes('53') && $('#div_rubbing_wet').length !== 0)
                     {
                        test_method_for_all+=test_method_id[splitted_data.indexOf('53')]+',';
                       

                        $(".full_page_load").show();
                        $("#div_rubbing_wet").show();

                     }

                     $("#test_method_id").val(test_method_for_all);
                     

               },
               error: function( jqXhr, textStatus, errorThrown )
               {       
                     
                     alert(errorThrown);
               }
         }); // End of $.ajax({
}/* End of function fill_up_qc_standard_additional_info(version_details)*/
 function sending_data_of_defining_qc_standard_for_raising_process_form_for_saving_in_database()
 {


       var validate = Raising_Form_Validation();
       var url_encoded_form_data = $("#defining_qc_standard_for_raising_process_form").serialize(); //This will read all control elements value of the form	
       
       if(validate != false)
	   {


		  	 $.ajax({
			 		url: 'process_program/edit_defining_qc_standard_for_ready_for_raising_process_saving.php',
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

 }//End of function sending_data_of_defining_qc_standard_for_raising_process_form_for_saving_in_database()

</script>
<div class="col-sm-12 col-md-12 col-lg-12">

		<div class="panel panel-default"> <!-- This div will create a block/panel for FORM -->

				<div class="panel-heading" style="color:#191970;"><b>Defining Qc Standard for Raising Process</b></div> <!-- This will create a upper block for FORM (Just Beautification) -->
                   
               <div class="row" data-toggle="collapse" data-target="#search_form_collpapsible_div_1" onClick="change_up_down_arrow_icon_1(this.childNodes[5].childNodes[1].id)">


                       <div align="right" style="padding-right:13px;" id='test'> <i class="glyphicon glyphicon-chevron-up text-right"  id='panel_heading_icon_1'></i>
                      </div>


                </div>   <!-- End of <div class="row" data-toggle="collapse" data-target="#search_form_collpapsible_div" > -->

                <div id='search_form_collpapsible_div_1' class="collapse in"> <!-- For Making Collapsible Section -->



                     <form class="form-horizontal" action="" style="margin-top:10px;" name="defining_qc_standard_for_raising_process_form_view" id="defining_qc_standard_for_raising_process_form_view" data-toggle="collapse" data-target="#search_form_collpapsible_div">
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
                                          $standard_for_which_process='Raising';
                                          $sql_for_raising = "SELECT * FROM `defining_qc_standard_for_raising_process` WHERE `standard_for_which_process`='$standard_for_which_process' ORDER BY id ASC";

                                          $res_for_raising = mysqli_query($con, $sql_for_raising);

                                          while ($row = mysqli_fetch_assoc($res_for_raising))
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


                                 

                              <button type="submit" id="edit_ready_for_raising" name="edit_ready_for_raising"  class="btn btn-primary btn-xs" onclick="load_page('process_program/edit_defining_qc_standard_for_ready_for_raising_process.php?raising_id=<?php echo $row['id'] ?>')"> Edit </button>

                                       <button type="submit" id="delete_raising" name="delete_raising"  class="btn btn-danger btn-xs" onclick="load_page('process_program/deleting_raising_process_standard.php?raising_id=<?php echo $row['id'] ?>')"> Delete </button>
                               </td>
                              <?php

                              $s1++;
                                               }
                               ?>
                           </tr>
                        </tbody>
                       </table>

                    </div>

                 </form>    <!-- End of <form class="form-horizontal" action="" style="margin-top:10px;" name="defining_qc_standard_for_raising_process_form" id="defining_qc_standard_for_raising_process_form"> -->

               </div> <!-- End of <div class="panel-heading" style="color:#191970;"><b> raising Standard Process List</b></div>  -->
				
                   <form class="form-horizontal" action="" style="margin-top:10px;" name="defining_qc_standard_for_raising_process_form" id="defining_qc_standard_for_raising_process_form">
                   

                        <input type="hidden" id="pp_number" name="pp_number" value="<?php echo $row_for_raising_process['pp_number']?>" >
                        <input type="hidden" id="version_number" name="version_number" value="<?php echo $row_for_raising_process['version_number']?>" >
                        <input type="hidden" id="customer_name" name="customer_name" value="<?php echo $row_for_raising_process['customer_name']?>">
                        <input type="hidden" id="customer_id" name="customer_id" value="<?php echo $row_for_raising_process['customer_id']?>">
                        <input type="hidden" id="color" name="color" value="<?php echo $row_for_raising_process['color']?>" >
                        <input type="hidden" id="finish_width_in_inch" name="finish_width_in_inch"  value="<?php echo $row_for_raising_process['finish_width_in_inch']?>">
                        <input type="hidden" id="standard_for_which_process" name="standard_for_which_process"  value="<?php echo $row_for_raising_process['standard_for_which_process']?>">
                        <input type="hidden" id="process_id" name="process_id"  value="proc_1">
                        <input type="hidden" id="test_method_id" name="test_method_id"  value="">
                        <input type="hidden" id="checking_data" name="checking_data"  value="">


                     <!-- start     <div class="form-group form-group-sm" id="form-group_for_yarn_count_warp_for_tolarance_value"> -->
<!-- For Full Entry Form -->
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
		

<!-- Start div_tensile_properties -->		
    <div id="div_tensile_properties" >

        <div class="form-group form-group-sm" for="tensile_properties_in_warp">
		  

			<div class="col-sm-3 text-center">
				 <label class="control-label" for="tensile_properties_in_warp" style="color:#00008B;"><span id="for_tensile_properties_in_warp_test_name_label">Tensile Properties</span> <span id="tensile_properties_in_warp_test_method"></span>(ISO 13934-1)</label>
			</div>
			 
			 <div class="col-sm-2 text-center">
	              <!-- <label for="description_or_type" style="font-size:12px; color:#000066;">Description/Type</label> -->
	              <label class="control-label" for="description_or_type" style="color:#00008B;"> Warp </label>

	              <input type="hidden" class="form-control" id="test_method_for_tensile_properties_in_warp" name="test_method_for_tensile_properties_in_warp" value="ISO 13934-1">
	              
	         </div>

	         

	         <div class="col-sm-1 text-center">
		             <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
		         
		     </div>
		        
		         
          <div class="col-sm-1 text-center">
              <select  class="form-control" id="tensile_properties_in_warp_value_tolerance_range_math_operator" name="tensile_properties_in_warp_value_tolerance_range_math_operator" onchange="tensile_properties_in_warp()">
                      <option select="selected" value="select">Select Tensile Properties In Warp Value Tolerance Range Math Operator</option>
                      <?php
                                      $tensile_properties_in_warp_value_tolerance_range_math_operator = $row_for_raising_process['tensile_properties_in_warp_value_tolerance_range_math_operator'];
                                 
                                          if($tensile_properties_in_warp_value_tolerance_range_math_operator=='≥')
                                          {
                                       ?>
                                             <option value="≥" selected>≥</option>
                                             <option value="≤"> ≤ </option>
                                             <option value=">"> > </option>
                                             <option value="<"> < </option>
                                      <?php
                                          }
                                          else if($tensile_properties_in_warp_value_tolerance_range_math_operator=='≤')
                                          {
                                         ?>
                                          <option value="≥">≥</option>
                                          <option value="≤" selected> ≤ </option>
                                          <option value=">"> > </option>
                                          <option value="<"> < </option>
                                       <?php
                                          }
                                          else if($tensile_properties_in_warp_value_tolerance_range_math_operator=='>')
                                          {
                                         ?>
                                             <option value="≥">≥</option>
                                             <option value="≤"> ≤ </option>
                                             <option value=">" selected> > </option>
                                             <option value="<"> < </option>
                                       <?php
                                          }
                                          else 
                                          {
                                             ?>

                                             <option value="≥">≥</option>
                                             <option value="≤"> ≤ </option>
                                             <option value=">" > > </option>
                                             <option value="<" selected> < </option>

                                             <?php
                                          }
                                       ?>
                </select>
              
           </div>
	          
	               <!--Add Input/Select Field Here No Dive Only Input/Select/Radio Button/Checkbox/Textarea -->
		          
          <div class="col-sm-1" for="tolerance">

             <input type="text" class="form-control" id="tensile_properties_in_warp_value_tolerance_value" name="tensile_properties_in_warp_value_tolerance_value" value="<?php echo $row_for_raising_process['tensile_properties_in_warp_value_tolerance_value']?>" onchange="tensile_properties_in_warp()" required>
          </div>

          <div class="col-sm-1" for="unit">
             <select  class="form-control" id="uom_of_tensile_properties_in_warp_value" name="uom_of_tensile_properties_in_warp_value">
                      <option select="selected" value="select">Select Uom Of Warp Yarn Tensile Properties</option>
                      <?php
                                      $uom_of_tensile_properties_in_warp_value = $row_for_raising_process['uom_of_tensile_properties_in_warp_value'];
                                 
                                          if($uom_of_tensile_properties_in_warp_value=='N')
                                          {
                                       ?>
                                              <option value="N" selected>N</option>
                                             <option value="kg">kg</option>
                                             <option value="lbf">lbf</option>
                                             <option value="daN">daN</option>
                                      <?php
                                          }
                                          else if($uom_of_tensile_properties_in_warp_value=='kg')
                                          {
                                         ?>
                                          <option value="N">N</option>
                                             <option value="kg" selected>kg</option>
                                             <option value="lbf">lbf</option>
                                             <option value="daN">daN</option>
                                       <?php
                                          }
                                          else if($uom_of_tensile_properties_in_warp_value=='lbf')
                                          {
                                         ?>
                                             <option value="N">N</option>
                                             <option value="kg">kg</option>
                                             <option value="lbf" selected>lbf</option>
                                             <option value="daN">daN</option>
                                       <?php
                                          }
                                          else 
                                          {
                                             ?>

                                             <option value="N">N</option>
                                             <option value="kg">kg</option>
                                             <option value="lbf">lbf</option>
                                             <option value="daN" selected>daN</option>

                                             <?php
                                          }
                                       ?>
                      
              </select>
          </div>

		        
          <div class="col-sm-1 text-center" for="min_value">

          	<input type="text" class="form-control" id="tensile_properties_in_warp_value_min_value" name="tensile_properties_in_warp_value_min_value" value="<?php echo $row_for_raising_process['tensile_properties_in_warp_value_min_value']?>" required>
          </div>
		          
          <div class="col-sm-1 text-center">
              
            <input type="text" class="form-control" id="tensile_properties_in_warp_value_max_value" name="tensile_properties_in_warp_value_max_value" value="<?php echo $row_for_raising_process['tensile_properties_in_warp_value_max_value']?>" required>

           </div>
		            
		   
     </div><!-- End of <div class="form-group form-group-sm" tensile_properties_in_warp_value_max_value-->




     <div class="form-group form-group-sm" for="tensile_properties_in_weft">
		  

			<div class="col-sm-3 text-center">
				 <label class="control-label" for="tensile_properties_in_weft" style="display: none"><span id="for_tensile_properties_in_weft_test_name_label">Tensile Properties</span>   <span id="tensile_properties_in_weft_test_method">(ISO 13934-1)</span></label>
			</div>
			 
			 <div class="col-sm-2 text-center">
	              <!-- <label for="description_or_type" style="font-size:12px; color:#000066;">Description/Type</label> -->
	              <label class="control-label" for="description_or_type" style="color:#00008B;"> Weft </label>

	               <input type="hidden" class="form-control" id="test_method_for_tensile_properties_in_weft" name="test_method_for_tensile_properties_in_weft" value="ISO 13934-1">
	              
	         </div>

	       
	         <div class="col-sm-1 text-center">
		             <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
		         
		     </div>
		        
		         
          <div class="col-sm-1 text-center">
              <select  class="form-control" id="tensile_properties_in_weft_value_tolerance_range_math_operator" name="tensile_properties_in_weft_value_tolerance_range_math_operator" onchange="tensile_properties_in_weft()">
                      <option select="selected" value="select">Select Tensile Properties In weft Value Tolerance Range Math Operator</option>
                      <?php
                                      $tensile_properties_in_weft_value_tolerance_range_math_operator = $row_for_raising_process['tensile_properties_in_weft_value_tolerance_range_math_operator'];
                                 
                                          if($tensile_properties_in_weft_value_tolerance_range_math_operator=='≥')
                                          {
                                       ?>
                                             <option value="≥" selected>≥</option>
                                             <option value="≤"> ≤ </option>
                                             <option value=">"> > </option>
                                             <option value="<"> < </option>
                                      <?php
                                          }
                                          else if($tensile_properties_in_weft_value_tolerance_range_math_operator=='≤')
                                          {
                                         ?>
                                          <option value="≥">≥</option>
                                          <option value="≤" selected> ≤ </option>
                                          <option value=">"> > </option>
                                          <option value="<"> < </option>
                                       <?php
                                          }
                                          else if($tensile_properties_in_weft_value_tolerance_range_math_operator=='>')
                                          {
                                         ?>
                                             <option value="≥">≥</option>
                                             <option value="≤"> ≤ </option>
                                             <option value=">" selected> > </option>
                                             <option value="<"> < </option>
                                       <?php
                                          }
                                          else 
                                          {
                                             ?>

                                             <option value="≥">≥</option>
                                             <option value="≤"> ≤ </option>
                                             <option value=">" > > </option>
                                             <option value="<" selected> < </option>

                                             <?php
                                          }
                                       ?>
                </select>
              
           </div>
	          
	               <!--Add Input/Select Field Here No Dive Only Input/Select/Radio Button/Checkbox/Textarea -->
		          
          <div class="col-sm-1" for="tolerance">

             <input type="text" class="form-control" id="tensile_properties_in_weft_value_tolerance_value" name="tensile_properties_in_weft_value_tolerance_value" value="<?php echo $row_for_raising_process['tensile_properties_in_weft_value_tolerance_value']?>" onchange="tensile_properties_in_weft()" required>
          </div>

          <div class="col-sm-1" for="unit">
             <select  class="form-control" id="uom_of_tensile_properties_in_weft_value" name="uom_of_tensile_properties_in_weft_value">
                      <option select="selected" value="select">Select Uom Of weft Yarn Tensile Properties</option>
                      <?php
                                      $uom_of_tensile_properties_in_weft_value = $row_for_raising_process['uom_of_tensile_properties_in_weft_value'];
                                 
                                          if($uom_of_tensile_properties_in_weft_value=='N')
                                          {
                                       ?>
                                              <option value="N" selected>N</option>
                                             <option value="kg">kg</option>
                                             <option value="lbf">lbf</option>
                                             <option value="daN">daN</option>
                                      <?php
                                          }
                                          else if($uom_of_tensile_properties_in_weft_value=='kg')
                                          {
                                         ?>
                                          <option value="N">N</option>
                                             <option value="kg" selected>kg</option>
                                             <option value="lbf">lbf</option>
                                             <option value="daN">daN</option>
                                       <?php
                                          }
                                          else if($uom_of_tensile_properties_in_weft_value=='lbf')
                                          {
                                         ?>
                                             <option value="N">N</option>
                                             <option value="kg">kg</option>
                                             <option value="lbf" selected>lbf</option>
                                             <option value="daN">daN</option>
                                       <?php
                                          }
                                          else 
                                          {
                                             ?>

                                             <option value="N">N</option>
                                             <option value="kg">kg</option>
                                             <option value="lbf">lbf</option>
                                             <option value="daN" selected>daN</option>

                                             <?php
                                          }
                                       ?>
                      
              </select>
          </div>

		        
          <div class="col-sm-1 text-center" for="min_value">

          	<input type="text" class="form-control" id="tensile_properties_in_weft_value_min_value" name="tensile_properties_in_weft_value_min_value" value="<?php echo $row_for_raising_process['tensile_properties_in_weft_value_min_value']?>" required>
          </div>
		          
          <div class="col-sm-1 text-center">
              
            <input type="text" class="form-control" id="tensile_properties_in_weft_value_max_value" name="tensile_properties_in_weft_value_max_value" value="<?php echo $row_for_raising_process['tensile_properties_in_weft_value_max_value']?>" required>

           </div>
		            
		   
     </div><!-- End of <div class="form-group form-group-sm" tensile_properties_in_weft_value_max_value-->



 </div>  <!-- End of div_tensile_properties-->    




<!-- Start div_tear_force_in_warp_value -->		
 <div id="div_tear_force_value">

      <div class="form-group form-group-sm" for="tear_force_in_warp_value">
		  

			<div class="col-sm-3 text-center">
				 <label class="control-label" for="tear_force_in_warp_value" style="color:#00008B;"><span id="for_tear_force_in_warp_test_name_label">Tear Force</span> <span id="tear_force_in_warp_test_method">(ISO 13937-2)</span></label>
			</div>
			 
			 <div class="col-sm-2 text-center">
	              <!-- <label for="description_or_type" style="font-size:12px; color:#000066;">Description/Type</label> -->
	              <label class="control-label" for="description_or_type" style="color:#00008B;"> Warp </label>

	              <input type="hidden" class="form-control" id="test_method_for_tear_force_in_warp" name="test_method_for_tear_force_in_warp" value="ISO 13937-2">
	              
	         </div>

	     

	         <div class="col-sm-1 text-center">
		             <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
		         
		     </div>
		        
		         
          <div class="col-sm-1 text-center">
              <select  class="form-control" id="tear_force_in_warp_value_tolerance_range_math_operator" name="tear_force_in_warp_value_tolerance_range_math_operator" onchange="tear_force_in_warp_cal()">
                      <option select="selected" value="select">Select Warp Yarn Tear Force Tolerance Range Math Operator</option>
                      <?php
                                      $tear_force_in_warp_value_tolerance_range_math_operator = $row_for_raising_process['tear_force_in_warp_value_tolerance_range_math_operator'];
                                 
                                          if($tear_force_in_warp_value_tolerance_range_math_operator=='≥')
                                          {
                                       ?>
                                             <option value="≥" selected>≥</option>
                                             <option value="≤"> ≤ </option>
                                             <option value=">"> > </option>
                                             <option value="<"> < </option>
                                      <?php
                                          }
                                          else if($tear_force_in_warp_value_tolerance_range_math_operator=='≤')
                                          {
                                         ?>
                                          <option value="≥">≥</option>
                                          <option value="≤" selected> ≤ </option>
                                          <option value=">"> > </option>
                                          <option value="<"> < </option>
                                       <?php
                                          }
                                          else if($tear_force_in_warp_value_tolerance_range_math_operator=='>')
                                          {
                                         ?>
                                             <option value="≥">≥</option>
                                             <option value="≤"> ≤ </option>
                                             <option value=">" selected> > </option>
                                             <option value="<"> < </option>
                                       <?php
                                          }
                                          else 
                                          {
                                             ?>

                                             <option value="≥">≥</option>
                                             <option value="≤"> ≤ </option>
                                             <option value=">" > > </option>
                                             <option value="<" selected> < </option>

                                             <?php
                                          }
                                       ?>
               </select>
              
           </div>
	          
	               <!--Add Input/Select Field Here No Dive Only Input/Select/Radio Button/Checkbox/Textarea -->
		          
          <div class="col-sm-1" for="tolerance">

             <input type="text" class="form-control" id="tear_force_in_warp_value_tolerance_value" name="tear_force_in_warp_value_tolerance_value" value="<?php echo $row_for_raising_process['tear_force_in_warp_value_tolerance_value']?>" onchange="tear_force_in_warp_cal()" required>
          </div>

          <div class="col-sm-1" for="unit">
             <select  class="form-control" id="uom_of_tear_force_in_warp_value" name="uom_of_tear_force_in_warp_value">
                      <option select="selected" value="select">Select Uom Of Warp Yarn Tear Force Properties</option>
                      <?php
                                      $uom_of_tear_force_in_warp_value = $row_for_raising_process['uom_of_tear_force_in_warp_value'];
                                 
                                          if($uom_of_tear_force_in_warp_value=='N')
                                          {
                                       ?>
                                             <option value="N" selected>N</option>
                                             <option value="kg">kg</option>
                                             <option value="lbf">lbf</option>
                                             <option value="gm">gm</option>
                                             <option value="daN">daN</option>
                                             <option value="oz">oz</option>
                                      <?php
                                          }
                                          else if($uom_of_tear_force_in_warp_value=='kg')
                                          {
                                         ?>
                                             <option value="N">N</option>
                                             <option value="kg" selected>kg</option>
                                             <option value="lbf">lbf</option>
                                             <option value="gm">gm</option>
                                             <option value="daN">daN</option>
                                             <option value="oz">oz</option>
                                       <?php
                                          }
                                          else if($uom_of_tear_force_in_warp_value=='lbf')
                                          {
                                         ?>
                                             <option value="N">N</option>
                                             <option value="kg">kg</option>
                                             <option value="lbf" selected>lbf</option>
                                             <option value="gm">gm</option>
                                             <option value="daN">daN</option>
                                             <option value="oz">oz</option>
                                       <?php
                                          }
                                          else if($uom_of_tear_force_in_warp_value=='gm')
                                          {
                                             ?>

                                             <option value="N">N</option>
                                             <option value="kg">kg</option>
                                             <option value="lbf">lbf</option>
                                             <option value="gm" selected>gm</option>
                                             <option value="daN">daN</option>
                                             <option value="oz">oz</option>

                                       <?php
                                          }
                                          else if($uom_of_tear_force_in_warp_value=='daN')
                                          {
                                             ?>

                                             <option value="N">N</option>
                                             <option value="kg">kg</option>
                                             <option value="lbf">lbf</option>
                                             <option value="gm" >gm</option>
                                             <option value="daN" selected>daN</option>
                                             <option value="oz">oz</option>

                                       <?php
                                          }
                                          else 
                                          {
                                             ?>

                                             <option value="N">N</option>
                                             <option value="kg">kg</option>
                                             <option value="lbf">lbf</option>
                                             <option value="gm" >gm</option>
                                             <option value="daN" >daN</option>
                                             <option value="oz" selected>oz</option>

                                       <?php
                                          }
                                       ?>
              </select>
          </div>

		        
          <div class="col-sm-1 text-center" for="min_value">

          	<input type="text" class="form-control" id="tear_force_in_warp_value_min_value" name="tear_force_in_warp_value_min_value" value="<?php echo $row_for_raising_process['tear_force_in_warp_value_min_value']?>" required>
          </div>
		          
          <div class="col-sm-1 text-center">
              
            <input type="text" class="form-control" id="tear_force_in_warp_value_max_value" name="tear_force_in_warp_value_max_value" value="<?php echo $row_for_raising_process['tear_force_in_warp_value_max_value']?>" required>

           </div>
		            
		   
     </div><!-- End of <div class="form-group form-group-sm" tear_force_in_warp_value-->     	



     <div class="form-group form-group-sm" for="tear_force_in_weft_value">
      

            <div class="col-sm-3 text-center">
	         <label class="control-label" for="tear_force_in_weft_value" style="display: none"><span id="for_tear_force_in_warp_test_name_label">Tear Force</span> <span id="tear_force_in_weft_test_method">(ISO 13937-2)</span></label>
	        </div>
	       
	        <div class="col-sm-2 text-center">
	                <!-- <label for="description_or_type" style="font-size:12px; color:#000066;">Description/Type</label> -->
	                <label class="control-label" for="description_or_type" style="color:#00008B;"> Weft </label>

	                 <input type="hidden" class="form-control" id="test_method_for_tear_force_in_weft" name="test_method_for_tear_force_in_weft" value="ISO 13937-2">
	                
	        </div>

       

           <div class="col-sm-1 text-center">
                 <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
             
         </div>
            
             
          <div class="col-sm-1 text-center">
              <select  class="form-control" id="tear_force_in_weft_value_tolerance_range_math_operator" name="tear_force_in_weft_value_tolerance_range_math_operator" onchange="tear_force_in_weft_cal()">
                      <option select="selected" value="select">Select weft Yarn Tear Force Tolerance Range Math Operator</option>
                      <?php
                                      $tear_force_in_weft_value_tolerance_range_math_operator = $row_for_ready_for_raising_process['tear_force_in_weft_value_tolerance_range_math_operator'];
                                 
                                          if($tear_force_in_weft_value_tolerance_range_math_operator=='≥')
                                          {
                                       ?>
                                             <option value="≥" selected>≥</option>
                                             <option value="≤"> ≤ </option>
                                             <option value=">"> > </option>
                                             <option value="<"> < </option>
                                      <?php
                                          }
                                          else if($tear_force_in_weft_value_tolerance_range_math_operator=='≤')
                                          {
                                         ?>
                                          <option value="≥">≥</option>
                                          <option value="≤" selected> ≤ </option>
                                          <option value=">"> > </option>
                                          <option value="<"> < </option>
                                       <?php
                                          }
                                          else if($tear_force_in_weft_value_tolerance_range_math_operator=='>')
                                          {
                                         ?>
                                             <option value="≥">≥</option>
                                             <option value="≤"> ≤ </option>
                                             <option value=">" selected> > </option>
                                             <option value="<"> < </option>
                                       <?php
                                          }
                                          else 
                                          {
                                             ?>

                                             <option value="≥">≥</option>
                                             <option value="≤"> ≤ </option>
                                             <option value=">" > > </option>
                                             <option value="<" selected> < </option>

                                             <?php
                                          }
                                       ?>
               </select>
              
           </div>
            
                 <!--Add Input/Select Field Here No Dive Only Input/Select/Radio Button/Checkbox/Textarea -->
              
          <div class="col-sm-1" for="tolerance">

             <input type="text" class="form-control" id="tear_force_in_weft_value_tolerance_value" name="tear_force_in_weft_value_tolerance_value" value="<?php echo $row_for_ready_for_raising_process['tear_force_in_weft_value_tolerance_value']?>" onchange="tear_force_in_weft_cal()" required>
          </div>

          <div class="col-sm-1" for="unit">
             <select  class="form-control" id="uom_of_tear_force_in_weft_value" name="uom_of_tear_force_in_weft_value">
                      <option select="selected" value="select">Select Uom Of weft Yarn Tear Force Properties</option>
                      <?php
                                      $uom_of_tear_force_in_weft_value = $row_for_ready_for_raising_process['uom_of_tear_force_in_weft_value'];
                                 
                                          if($uom_of_tear_force_in_weft_value=='N')
                                          {
                                       ?>
                                             <option value="N" selected>N</option>
                                             <option value="kg">kg</option>
                                             <option value="lbf">lbf</option>
                                             <option value="gm">gm</option>
                                             <option value="daN">daN</option>
                                             <option value="oz">oz</option>
                                      <?php
                                          }
                                          else if($uom_of_tear_force_in_weft_value=='kg')
                                          {
                                         ?>
                                             <option value="N">N</option>
                                             <option value="kg" selected>kg</option>
                                             <option value="lbf">lbf</option>
                                             <option value="gm">gm</option>
                                             <option value="daN">daN</option>
                                             <option value="oz">oz</option>
                                       <?php
                                          }
                                          else if($uom_of_tear_force_in_weft_value=='lbf')
                                          {
                                         ?>
                                             <option value="N">N</option>
                                             <option value="kg">kg</option>
                                             <option value="lbf" selected>lbf</option>
                                             <option value="gm">gm</option>
                                             <option value="daN">daN</option>
                                             <option value="oz">oz</option>
                                       <?php
                                          }
                                          else if($uom_of_tear_force_in_weft_value=='gm')
                                          {
                                             ?>

                                             <option value="N">N</option>
                                             <option value="kg">kg</option>
                                             <option value="lbf">lbf</option>
                                             <option value="gm" selected>gm</option>
                                             <option value="daN">daN</option>
                                             <option value="oz">oz</option>

                                       <?php
                                          }
                                          else if($uom_of_tear_force_in_weft_value=='daN')
                                          {
                                             ?>

                                             <option value="N">N</option>
                                             <option value="kg">kg</option>
                                             <option value="lbf">lbf</option>
                                             <option value="gm" >gm</option>
                                             <option value="daN" selected>daN</option>
                                             <option value="oz">oz</option>

                                       <?php
                                          }
                                          else 
                                          {
                                             ?>

                                             <option value="N">N</option>
                                             <option value="kg">kg</option>
                                             <option value="lbf">lbf</option>
                                             <option value="gm" >gm</option>
                                             <option value="daN" >daN</option>
                                             <option value="oz" selected>oz</option>

                                       <?php
                                          }
                                       ?>
              </select>
          </div>

            
          <div class="col-sm-1 text-center" for="min_value">

            <input type="text" class="form-control" id="tear_force_in_weft_value_min_value" name="tear_force_in_weft_value_min_value" value="<?php echo $row_for_raising_process['tear_force_in_weft_value_min_value']?>" required>
          </div>
              
          <div class="col-sm-1 text-center">
              
            <input type="text" class="form-control" id="tear_force_in_weft_value_max_value" name="tear_force_in_weft_value_max_value" value="<?php echo $row_for_raising_process['tear_force_in_weft_value_max_value']?>" required>

           </div>
                
       
     </div><!-- End of <div class="form-group form-group-sm" tensile_properties_in_weft_value_max_value-->  

  </div>     <!-- div_tear_force_value-->    




 </div>    <!-- End of <div class="full_page_load" id="full_page_load" style="display: none;"> -->   




       

					<div class="form-group form-group-sm">
							<div class="col-sm-offset-4 col-sm-5">
								<button type="button" class="btn btn-primary" onClick="sending_data_of_defining_qc_standard_for_raising_process_form_for_saving_in_database()">Submit</button>
									<button type="reset" class="btn btn-success">Reset</button>
							</div>
					</div>

				</form>
			

		</div> <!-- End of <div class="panel panel-default"> -->

</div> <!-- End of <div class="col-sm-12 col-md-12 col-lg-12"> -->