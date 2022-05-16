<?php
session_start();
/*require_once("../login/session.php");*/
include('../login/db_connection_class.php');
$obj = new DB_Connection_Class();
$obj->connection();

// $pp_number = $_GET['pp_number'];
// $version_id = $_GET['version_number'];

$pp_number = '';
$version_id = '';
$model_standard = '';

if (isset($_GET['pp_number'])) 
{
	$pp_number = $_GET['pp_number'];
}

if (isset($_GET['version_number'])) 
{
	$version_id = $_GET['version_number'];
}

if (isset($_GET['model_standard'])) 
{
	$customer = $_GET['customer_name'];
	$splitted_customer = explode('?fs?', $customer);
	$customer_id = $splitted_customer[0];
	$customer_name = $splitted_customer[1];

	$version_number = $_GET['version_name'];
   
	$color_name = $_GET['color'];

	$process_details = $_GET['process_name'];
	$splitted_process = explode('?fs?', $process_details);
	$process_id = $splitted_process[0];
	$process_name = $splitted_process[1];
   
	$process_serial = $_GET['process_serial'];
	$process_technique_name = $_GET['process_technique_name'];
	$model_standard = $_GET['model_standard'];
	
}


?>




<script type='text/javascript' src='process_program/defining_qc_standard_for_washing_process_form_validation.js'></script>
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

function reset_dropdown(select_element)
{

	  document.getElementById(select_element).selectedIndex = 0;

}
</script>

<script>

function Fill_Value_Of_Version_Number_Field(pp_number)
{
    var value_for_data= 'pp_number_value='+pp_number;
/*    $('#version_number').html='<option>This is test </option>';
*/	/*document.getElementById('version_number').innerHTML='<option> option 1</option> <option> option 2</option> ';*/
            $.ajax({
			 		/*url: 'process_program/returning_version_number_details.php',*/
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
*/  document.getElementById('color').value=splitted_version_details[1];
  document.getElementById('finish_width_in_inch').value=splitted_version_details[2]; 
  document.getElementById('customer_name').value=splitted_version_details[3]; 
  document.getElementById('customer_id').value=splitted_version_details[5];
  document.getElementById('standard_for_which_process').value='Washing'; 

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


 function sending_data_of_defining_qc_standard_for_washing_process_form_for_saving_in_database()
 {


       var validate = Washing_Form_Validation();
       var url_encoded_form_data = $("#defining_qc_standard_for_washing_process_form").serialize(); //This will read all control elements value of the form	
       if(validate != false)
	   {


		  	 $.ajax({
			 		url: 'process_program/defining_qc_standard_for_washing_process_saving.php',
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

 }//End of function sending_data_of_defining_qc_standard_for_washing_process_form_for_saving_in_database()


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

function delete_washing_process(washing_id)
{
   var value_for_data= 'washing_id='+washing_id;
    
				$.ajax({
						url: 'process_program/deleting_washing_process_standard.php',
						dataType: 'text',
						type: 'post',
						contentType: 'application/x-www-form-urlencoded',
						data: value_for_data,
							  
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


</script>
<div class="col-sm-12 col-md-12 col-lg-12">

		<div class="panel panel-default"> <!-- This div will create a block/panel for FORM -->

      <?php 
			if ($model_standard == 'model_standard') 
			{
				?>
				<div class="panel-heading" style="color:#191970;"><b>Model For Washing Process</b></div> 

				<div class="row" data-toggle="collapse" data-target="#search_form_collpapsible_div_1" onClick="change_up_down_arrow_icon_1(this.childNodes[5].childNodes[1].id)">
					<div style="padding-right:13px;text-align:center" id='test'> <i class="glyphicon glyphicon-chevron-up text-right"  id='panel_heading_icon_1'></i></div>
				</div>  
				
				<div id='search_form_collpapsible_div_1' class="collapse in"> 
					
					<form class="form-horizontal" action="" style="margin-top:10px;" name="defining_qc_standard_for_washing_process_form_view" id="defining_qc_standard_for_washing_process_form_view" data-toggle="collapse" data-target="#search_form_collpapsible_div">
						<div class="panel panel-default">
							<table id="datatable-buttons" class="table table-striped table-bordered">
								<thead>
									<tr>
									<th>SI</th>
									<th>Customer Name</th>
									<th>Version Name</th>
									<th>Color</th>
									<th>Process Name</th>
									<th>Process Serial</th>
									<th>Process Technique</th>
									<th>Action</th>
									</tr>
								</thead>
								<tbody>
									<?php
									$s1 = 1;
									$standard_for_which_process='Washing';
									$sql_for_washing = "SELECT * FROM `model_defining_qc_standard_for_washing_process` 
																WHERE `process_name`='$standard_for_which_process' and 
																`customer_id` = '$customer_id' and
																`customer_name` = '$customer_name' and 
																`version_number`='$version_number' and 
											`process_technique`= '$process_technique_name'  ORDER BY id ASC";

									$res_for_washing = mysqli_query($con, $sql_for_washing);

									while ($row = mysqli_fetch_assoc($res_for_washing))
									{
										$customer_id=$row['customer_id'];
										$customer_name=$row['customer_name'];
										$version_number=$row['version_number'];
										$color_name=$row['color'];
										$process_id=$row['process_id'];
										$process_name=$row['process_name'];
										$process_serial_db=$row['process_serial'];
										$process_technique_name=$row['process_technique'];

										//   echo $row_for_pp_style['style_name'];
										?>

										<tr>
											<td><?php echo $s1; ?></td>
											<td width="300"><?php echo $customer_name; ?></td>
											<td><?php echo $version_number; ?></td>
											<td><?php echo $color_name; ?></td>
											<td><?php echo $process_name; ?></td>
											<td><?php echo $process_serial_db; ?></td>
											<td><?php echo $process_technique_name; ?></td>
											<td>

											<button type="submit" id="edit_model_washing" name="edit_model_washing"  class="btn btn-info btn-xs" onclick="load_page('auto_sync/edit_model_defining_qc_standard_for_washing_process.php?model_washing_id=<?php echo $row['id'] ?>')"> Edit </button>

											</td>
										</tr>
										<?php

										$s1++;
									}
										?>
											
								</tbody>
							</table>

						</div>

					</form>
				</div>   
				<?php
			}
			else
			{ 
				?>
            <div class="panel-heading" style="color:#191970;"><b>Defining Qc Standard For Washing Process</b></div> <!-- This will create a upper block for FORM (Just Beautification) -->
                

                <div class="row" data-toggle="collapse" data-target="#search_form_collpapsible_div_1" onClick="change_up_down_arrow_icon_1(this.childNodes[5].childNodes[1].id)">


                       <div align="right" style="padding-right:13px;" id='test'> <i class="glyphicon glyphicon-chevron-up text-right"  id='panel_heading_icon_1'></i>
                      </div>


                    </div>   <!-- End of <div class="row" data-toggle="collapse" data-target="#search_form_collpapsible_div" > -->

                <div id='search_form_collpapsible_div_1' class="collapse in"> <!-- For Making Collapsible Section -->

                     <form class="form-horizontal" action="" style="margin-top:10px;" name="defining_qc_standard_for_washing_process_form_view" id="defining_qc_standard_for_washing_process_form_view" data-toggle="collapse" data-target="#search_form_collpapsible_div">

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
                                  <th>Style</th>
                                  <th>Finish Width</th>
                                  <th>Action</th>
                                  </tr>
                             </thead>
                             <tbody>
                             <?php
                                          $s1 = 1;
                                          $standard_for_which_process='Washing';
                                          $sql_for_washing = "SELECT * FROM `defining_qc_standard_for_washing_process` 
                                          										  WHERE `standard_for_which_process`='$standard_for_which_process' and `pp_number` = '$pp_number' and `version_id`='$version_id'  ORDER BY id ASC";

                                          $res_for_washing = mysqli_query($con, $sql_for_washing);

                                          while ($row = mysqli_fetch_assoc($res_for_washing))
                                          {
                                             $pp_numbers=$row['pp_number'];
                                             $version_number=$row['version_number'];
                                             $color=$row['color'];
                                             $finish_width_in_inch=$row['finish_width_in_inch'];
                                 
                                             $sql_for_pp_style = "SELECT style_name FROM adding_process_to_version WHERE pp_number = '$pp_numbers' AND version_name = '$version_number' AND 
                                                            finish_width_in_inch ='$finish_width_in_inch' AND color = '$color' AND process_name = '$standard_for_which_process'";
                                             $result_for_pp_style= mysqli_query($con,$sql_for_pp_style) or die(mysqli_error($con));
                                             $row_for_pp_style=mysqli_fetch_assoc($result_for_pp_style);

                                             //   echo $row_for_pp_style['style_name'];
                           ?>

                           <tr>
                              <td><?php echo $s1; ?></td>
                              <td width="300"><?php echo $row['pp_number']; ?></td>
                              <td><?php echo $row['version_id']; ?></td>
                              <td><?php echo $row['version_number']; ?></td>
                              <td><?php echo $row['customer_name']; ?></td>
                              <td><?php echo $row['color']; ?></td>
                              <td><?php echo $row_for_pp_style['style_name']; ?></td>
                              <td><?php echo $row['finish_width_in_inch']; ?></td>
                              <td>


                                      <button type="button" id="edit_washing" name="edit_washing"  class="btn btn-info btn-xs" onclick="load_page('process_program/edit_defining_qc_standard_for_washing_process.php?washing_id=<?php echo $row['id'] ?>')"> Edit </button>
                                       
                                      <?php 
                                             $version_id = $row['version_id'];
                                             $pp_number = $row['pp_number'];
                                             $finish_width_in_inch = $row['finish_width_in_inch']; 
                                             $process_name = $standard_for_which_process;
                                             //$process_id = $row['process_id']; 

                                             $sql_for_pp_wise_version ="SELECT * FROM `partial_test_for_test_result_info` WHERE pp_number = '$pp_number' and version_id = '$version_id' and process_name = '$process_name' 
                                                      and finish_width_in_inch = '$finish_width_in_inch'";
                                             $result_for_pp_wise_version =  mysqli_query($con, $sql_for_pp_wise_version);

                                             $row_number_for_pp_wise_version = mysqli_num_rows($result_for_pp_wise_version);

                                             if($row_number_for_pp_wise_version >0)
                                             {
                                                   
                                             }
                                             else
                                             {
                                                ?>
                                                   <button type="button" id="delete_washing" name="delete_washing"  class="btn btn-danger btn-xs" onclick="delete_washing_process(<?php echo $row['id'];?>)" > Delete </button>
                                                <?php
                                             } 
                                       ?>

                                       <!-- <button type="submit" id="delete_washing" name="delete_washing"  class="btn btn-danger btn-xs" onclick="load_page('process_program/deleting_washing_process_standard.php?washing_id=<?php echo $row['id'] ?>')"> Delete </button> -->
                               </td>
                              <?php

                              $s1++;
                                               }
                               ?>
                           </tr>
                        </tbody>
                       </table>

                    </div>

                </form>    <!-- End of <form class="form-horizontal" action="" style="margin-top:10px;" name="defining_qc_standard_for_washing_process_form" id="defining_qc_standard_for_washing_process_form"> -->

             </div> <!-- End of <div class="panel-heading" style="color:#191970;"><b> washing Standard Process List</b></div>  -->

            <?php
         }
            ?>    
				<form class="form-horizontal" action="" style="margin-top:10px;" name="defining_qc_standard_for_washing_process_form" id="defining_qc_standard_for_washing_process_form">

            <?php
                  // echo $version_number;

                  if (isset($_GET['model_standard'])) 
                  {
                     
                     ?>
                     
                     <input type="hidden" id="model_standard" name="model_standard"  value="model_standard">

                     <input type="hidden" id="finish_width_in_inch" name="finish_width_in_inch"  value="">
                     <input class="form-control" type="hidden" name="pp_number_value" id="pp_number_value" value="">
                     <input type="hidden" id="process_id" name="process_id"  value="proc_13">
                     <input type="hidden" id="test_method_id" name="test_method_id"  value="">
                     <input type="hidden" id="checking_data" name="checking_data"  value="">
                     
                     <!-------------- for model standard (start) -------------->
                     <input type="hidden" class="form-control" id="version_id" name="version_id" value="<?php echo $version_id; ?>">
                     <input type="hidden" class="form-control" id="customer_id" name="customer_id" value="<?php echo $customer_id; ?>">
                     <input type="hidden" id="customer_name" name="customer_name" value="<?php echo $customer_name; ?>">
                     <input type="hidden" class="form-control" id="version_number" name="version_number" value="<?php echo $version_number; ?>">
                     <input type="hidden" class="form-control" id="color_name" name="color_name" value="<?php echo $color_name; ?>">
                     <input type="hidden" class="form-control" id="process_name" name="process_name" value="<?php echo $process_name; ?>">
                     <input type="hidden" class="form-control" id="process_serial" name="process_serial" value="<?php echo $process_serial; ?>">
                     <input type="hidden" class="form-control" id="process_technique_name" name="process_technique_name" value="<?php echo $process_technique_name; ?>">
                     <!-------------- for model standard (end) -------------->
                     <?php
                  }
                  else
                  {
                     ?>
                     <div class="form-group form-group-sm" id="form-group_for_pp_number" style="display: none;">
						      <label class="control-label col-sm-4" for="pp_number" style="margin-right:0px; color:#00008B;">PP Number:</label>
                        <div class="col-sm-5">
                           <input class="form-control" type="hidden" name="pp_number_value" id="pp_number_value" value="">
                        </div>
						   </div> 

						   <div class="form-group form-group-sm" id="form-group_for_version_number" style="display: none;">
						      <label class="control-label col-sm-4" for="version_number" style="margin-right:0px; color:#00008B;">Version Number:</label>
							   <div class="col-sm-5">
								   <select  class="form-control" id="version_number" name="version_number" onchange="fill_up_qc_standard_additional_info(this.value)">
										<option value="">Select Version Number</option>
											<?php 
												 $sql = 'select version_name from `pp_wise_version_creation_info` order by `version_name`';
												 $result= mysqli_query($con,$sql) or die(mysqli_error($con));
												 while( $row = mysqli_fetch_array( $result))
												 {

													 echo '<option value="'.$row['version_name'].'">'.$row['version_name'].'</option>';

												 }

											 ?>
								      </select>
							   </div>
						   </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_version_number"> -->

                     <input type="hidden" id="customer_name" name="customer_name" value="">
                     <input type="hidden" id="customer_id" name="customer_id" value="">
                     <input type="hidden" id="color_name" name="color_name" value="" >
                     <input type="hidden" id="finish_width_in_inch" name="finish_width_in_inch"  value="">
                     <input type="hidden" id="process_id" name="process_id"  value="proc_13">
                     <input type="hidden" id="test_method_id" name="test_method_id"  value="">
                     

                     <input type="hidden" id="checking_data" name="checking_data"  value="">

                     <div class="form-group form-group-sm" id="form-group_for_standard_for_which_process" style="display: none;">
                        <label class="control-label col-sm-4" for="standard_for_which_process" style="margin-right:0px; color:#00008B;">Standard For Which Process:</label>
                        <div class="col-sm-5">
                        <input  type="text" class="form-control"  id="standard_for_which_process" name="standard_for_which_process"  value="" readonly>
                        </div>
                     </div> 
                     <?php
                  }
                  ?>
                  <br>
						
<!-- *********************************** Designing Tabular Formar (Multi-Column Form Elements Here (Start))*********************************** -->

<div class="full_page_load" id="full_page_load" style="display :none">




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



 <div id="div_cf_to_rubbing" style="display: none">


     <div class="form-group form-group-sm">
		    
			<!-- <div class="col-sm-1 text-center">
					
			</div> -->

			<div class="col-sm-3 text-center">
				 <label class="control-label" for="cf_to_rubbing_dry_value" style="color:#00008B; margin-top:23px;"><span id="cf_to_rubbing_dry_test_name_label">Color Fastness to Rubbing</span> <span id="cf_to_rubbing_dry_test_method">(ISO 105 X12)</span></label>
			</div>
			 
			 <div class="col-sm-2 text-center">
	              <!-- <label for="description_or_type" style="font-size:12px; color:#000066;">Description/Type</label> -->
	              <label class="control-label" for="description_or_type" style="color:#00008B; margin-top:23px;"> Dry </label>
	              <input type="hidden" class="form-control" id="test_method_for_cf_to_rubbing_dry" name="test_method_for_cf_to_rubbing_dry" value="ISO 105 X12">

	         </div>


	        
	         <div class="col-sm-1 text-center">
		            <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:35px;"/>
		     </div>
		        
		         
          <div class="col-sm-1 text-center">
              <select  class="form-control" id="cf_to_rubbing_dry_tolerance_range_math_operator" name="cf_to_rubbing_dry_tolerance_range_math_operator" style="color:#00008B; margin-top:23px;" onchange="cf_to_rubbing_dry_cal()">
                  <option value="">Select Color Fastness to Rubbing Dry Tolerance Range Math Operator</option>
	              <option value="≥">≥</option>
	              <option value="≤"> ≤ </option>
	              <option value=">"> > </option>
	              <option value="<"> < </option>
            </select>
              
           </div>
	          
	               <!--Add Input/Select Field Here No Dive Only Input/Select/Radio Button/Checkbox/Textarea -->
		          
          <div class="col-sm-1" for="tolerance">

            <input type="text" class="form-control" id="cf_to_rubbing_dry_tolerance_value" name="cf_to_rubbing_dry_tolerance_value" placeholder="Enter Color Fastness to Rubbing Dry Value"  required onchange="cf_to_rubbing_dry_cal()" style="color:#00008B; margin-top:23px;">

          </div>

          <div class="col-sm-1" for="unit">
          	<hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:35px;"/>
            <input type="hidden" id="uom_of_cf_to_rubbing_dry" name="uom_of_cf_to_rubbing_dry"  value="">
          </div>

		        
          <div class="col-sm-1 text-center" for="min_value">

          	<input type="text" class="form-control" id="cf_to_rubbing_dry_min_value" name="cf_to_rubbing_dry_min_value" style="color:#00008B; margin-top:23px;" placeholder="Enter Color Fastness to Rubbing Dry Min Value" required>
             
          </div>
		          
          <div class="col-sm-1 text-center">
              
            <input type="text" class="form-control" id="cf_to_rubbing_dry_max_value" name="cf_to_rubbing_dry_max_value" style="color:#00008B; margin-top:23px;" placeholder="Enter Color Fastness to Rubbing Dry Max Value" required>

           </div>
		            
		        

     </div><!-- End of <div class="form-group form-group-sm" cf_to_rubbing_dry -->



      <div class="form-group form-group-sm">
		    
			<!-- <div class="col-sm-1 text-center">
					
			</div> -->

			<div class="col-sm-3 text-center">
				 <label class="hidden" for="cf_to_rubbing_dry_value" style="color:#00008B;"><span id="cf_to_rubbing_wet_test_name_label" style="display: none;">Color Fastness to Rubbing</span> <span id="cf_to_rubbing_wet_test_method" style="display: none;">(ISO 105 X12)</span></label>
			</div>
			 
			 <div class="col-sm-2 text-center">
	              <!-- <label for="description_or_type" style="font-size:12px; color:#000066;">Description/Type</label> -->
	              <label class="control-label" for="description_or_type" style="color:#00008B;"> Wet </label>
	              <input type="hidden" class="form-control" id="test_method_for_cf_to_rubbing_wet" name="test_method_for_cf_to_rubbing_wet" value="ISO 105 X12">
	              
	         </div>

	         
	         <div class="col-sm-1 text-center">
		            <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
		          
		     </div>
		        
		         
          <div class="col-sm-1 text-center">
              <select  class="form-control" id="cf_to_rubbing_wet_tolerance_range_math_operator" name="cf_to_rubbing_wet_tolerance_range_math_operator" onchange="cf_to_rubbing_wet_cal()">
                      <option value="">Select Color Fastness to Rubbing Wet Tolerance Range Math Operator</option>
                      <option value="≥">≥</option>
                      <option value="≤"> ≤ </option>
                      <option value=">"> > </option>
	                  <option value="<"> < </option>
                </select>
              
           </div>
	          
	               <!--Add Input/Select Field Here No Dive Only Input/Select/Radio Button/Checkbox/Textarea -->
		          
          <div class="col-sm-1" for="tolerance">

            <input type="text" class="form-control" id="cf_to_rubbing_wet_tolerance_value" name="cf_to_rubbing_wet_tolerance_value" placeholder="Enter Tolerance Value" onchange="cf_to_rubbing_wet_cal()" required>

          </div>

          <div class="col-sm-1" for="unit">
          	<hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
            <input type="hidden" id="uom_of_cf_to_rubbing_wet" name="uom_of_cf_to_rubbing_wet"  value="">
          </div>

		        
          <div class="col-sm-1 text-center" for="min_value">

          	<input type="text" class="form-control" id="cf_to_rubbing_wet_min_value" name="cf_to_rubbing_wet_min_value" placeholder="Enter Color Fastness to Rubbing Wet Min Value" required>
             
          </div>
		          
          <div class="col-sm-1 text-center">
              
            <input type="text" class="form-control" id="cf_to_rubbing_wet_max_value" name="cf_to_rubbing_wet_max_value" placeholder="Enter Color Fastness to Rubbing Wet Max Value" required>

           </div>
		            
		        

     </div><!-- End of <div class="form-group form-group-sm" cf_to_rubbing_wet -->




   </div>     <!--  End of <div id="div_cf_to_rubbing" style="display: none"> -->



<!-- Start of cf_to_washing -->

<div id="div_color_fastness_to_washing" style="display: none">

     <div class="form-group form-group-sm">
		    

    			<div class="col-sm-3 text-center">
    				 <label class="control-label" for="cf_to_washing_color_change_value" style="color:#00008B;"><span id="cf_to_washing_color_change_test_name_label"> Color Fastness to Washing</span> <span id="cf_to_washing_color_change_test_method">(ISO 105 C6)</span>
    				 </label>
    			</div>
    			 
    			 <div class="col-sm-2 text-center">
    	              
    	              <label class="control-label" for="description_or_type" style="color:#00008B;"> Color Change</label>

    	              <input type="hidden" class="form-control" id="test_method_for_cf_to_washing_color_change" name="test_method_for_cf_to_washing_color_change" value="ISO 105 C6">
    	              
    	         </div>

    	         <div class="col-sm-1 text-center">
    	         	 
    	         	   <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
    		      </div>

    	         <div class="col-sm-1 text-center">
    	         	  
    		          <select  class="form-control" id="cf_to_washing_color_change_tolerance_range_math_operator" name="cf_to_washing_color_change_tolerance_range_math_operator" onchange="cf_to_washing_color_change_cal()">
                      <option value="">Select CF To Washing Color Change Range Math Operator</option>
                      <option value="≥">≥</option>
                      <option value="≤"> ≤ </option>
                      <option value=">"> > </option>
	                  <option value="<"> < </option>
                </select>
    		      </div>


    		      <div class="col-sm-1 text-center">
    	         	 <select  class="form-control" id="cf_to_washing_color_change_tolerance_value" name="cf_to_washing_color_change_tolerance_value" onchange="cf_to_washing_color_change_cal()">
                    <option value="">Select Tolerance Value</option>
                      <option value="1.0">1</option>
                      <option value="1.5">1-2</option>
                      <option value="2.0"> 2 </option>
                      <option value="2.5"> 2-3 </option>
                      <option value="3.0">3</option>
                      <option value="3.5">3-4</option>
                      <option value="4.0"> 4 </option>
                      <option value="4.5"> 4-5 </option>
                      <option value="5.0"> 5 </option>
                  </select>
    		      </div> 

    		      

    	         
              <div class="col-sm-1" for="unit">
              	 <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
                <input type="hidden" class="form-control" id="uom_of_cf_to_washing_color_change" name="uom_of_cf_to_washing_color_change" value="%" >
              </div>

    		        
              <div class="col-sm-1 text-center" for="min_value">

              	  <input type="text" class="form-control" id="cf_to_washing_color_change_min_value" name="cf_to_washing_color_change_min_value" placeholder="Enter  Min Value" required>
              </div>
    		          
              <div class="col-sm-1 text-center">
                  
                  <input type="text" class="form-control" id="cf_to_washing_color_change_max_value" name="cf_to_washing_color_change_max_value" placeholder="Enter  Max Value" required>

               </div>
		            
		        

     </div><!-- End of <div class="form-group form-group-sm" cf_to_washing_color_change-->


      <div class="form-group form-group-sm">
		    

    			<div class="col-sm-3 text-center">
    				 <label class="control-label" for="mass_loss_in_abrasion_test_value" style="color:#00008B;"><span id="cf_to_washing_staining_test_name_label" style="display: none;"> Color Fastness to Washing</span> <span id="cf_to_washing_staining_test_method" style="display: none;">(ISO 105 C6)</span>
    				 </label>
    			</div>
    			 
    			  <div class="col-sm-2 text-center">
    	              
    	              <label class="control-label" for="description_or_type" style="color:#00008B;"> Staining</label>

    	              <input type="hidden" class="form-control" id="test_method_for_cf_to_washing_staining" name="test_method_for_cf_to_washing_staining" value="ISO 105 C6">
    	              
    	        </div>

    	         
               <div class="col-sm-1 text-center">
    	         	   <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
    		      </div>

    	       <div class="col-sm-1 text-center">
    	         	  
    		         <select  class="form-control" id="cf_to_washing_staining_tolerance_range_math_operator" name="cf_to_washing_staining_tolerance_range_math_operator" onchange="cf_to_washing_staining_cal()">
                      <option value="">Select CF To Dry Cleaning Staining Range Math Operator</option>
                      <option value="≥">≥</option>
                      <option value="≤"> ≤ </option>
                      <option value=">"> > </option>
	                  <option value="<"> < </option>
                </select>
    		      </div>


    		      <div class="col-sm-1 text-center">
    	         	  <select  class="form-control" id="cf_to_washing_staining_tolerance_value" name="cf_to_washing_staining_tolerance_value" onchange="cf_to_washing_staining_cal()">
	                      <option value="">Select Tolerance Value</option>
	                      <option value="1.0">1</option>
	                      <option value="1.5">1-2</option>
	                      <option value="2.0"> 2 </option>
	                      <option value="2.5"> 2-3 </option>
	                      <option value="3.0">3</option>
	                      <option value="3.5">3-4</option>
	                      <option value="4.0"> 4 </option>
	                      <option value="4.5"> 4-5 </option>
	                      <option value="5.0"> 5 </option>
                     </select>
                  </div>

    		      

    	         
              <div class="col-sm-1" for="unit">
              	 <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
                <input type="hidden" class="form-control" id="uom_of_cf_to_washing_staining" name="uom_of_cf_to_washing_staining" value="%" >
              </div>

    		        
              <div class="col-sm-1 text-center" for="min_value">

              	  
                   <input type="text" class="form-control" id="cf_to_washing_staining_min_value" name="cf_to_washing_staining_min_value" placeholder="Enter  Min Value" required>
                 
              </div>
    		          
              <div class="col-sm-1 text-center">
                  
                  <input type="text" class="form-control" id="cf_to_washing_staining_max_value" name="cf_to_washing_staining_max_value" placeholder="Enter  Max Value" required>

               </div>
		            
		        

     </div><!-- End of <div class="form-group form-group-sm" cf_to_washing_staining-->



     <div class="form-group form-group-sm">
        

          <div class="col-sm-3 text-center">
             <label class="control-label" for="mass_loss_in_abrasion_test_value" style="color:#00008B;"><span id="cf_to_washing_cross_staining_test_name_label" style="display: none;"> Color Fastness to Washing</span> <span id="cf_to_washing_cross_staining_test_method" style="display: none;">(ISO 105 C6)</span>
             </label>
          </div>
           
            <div class="col-sm-2 text-center">
                    
                    <label class="control-label" for="description_or_type" style="color:#00008B;"> Cross Staining</label>

                     <input type="hidden" class="form-control" id="test_method_for_cf_to_washing_cross_staining" name="test_method_for_cf_to_washing_cross_staining" value="ISO 105 C6">
                    
            </div>

             <div class="col-sm-1 text-center">
                   <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
              </div>  

             <div class="col-sm-1 text-center">
                  
                 <select  class="form-control" id="cf_to_washing_cross_staining_tolerance_range_math_operator" name="cf_to_washing_cross_staining_tolerance_range_math_operator" onchange="cf_to_washing_cross_staining_cal()">
                      <option value="">Select CF To Dry Cleaning cross staining Range Math Operator</option>
                      <option value="≥">≥</option>
                      <option value="≤"> ≤ </option>
                      <option value=">"> > </option>
	                  <option value="<"> < </option>
                </select>
              </div>


              <div class="col-sm-1 text-center">
                  <select  class="form-control" id="cf_to_washing_cross_staining_tolerance_value" name="cf_to_washing_cross_staining_tolerance_value" onchange="cf_to_washing_cross_staining_cal()">
                      <option value="">Select Tolerance Value</option>
                      <option value="1.0">1</option>
                      <option value="1.5">1-2</option>
                      <option value="2.0"> 2 </option>
                      <option value="2.5"> 2-3 </option>
                      <option value="3.0">3</option>
                      <option value="3.5">3-4</option>
                      <option value="4.0"> 4 </option>
                      <option value="4.5"> 4-5 </option>
                      <option value="5.0"> 5 </option>
                  </select>
              </div>

              

               
              <div class="col-sm-1" for="unit">
                 <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
                <input type="hidden" class="form-control" id="uom_of_cf_to_washing_cross_staining" name="uom_of_cf_to_washing_cross_staining" value="%" >
              </div>

                
              <div class="col-sm-1 text-center" for="min_value">

                  
                   <input type="text" class="form-control" id="cf_to_washing_cross_staining_min_value" name="cf_to_washing_cross_staining_min_value" placeholder="Enter  Min Value" required>
                 
              </div>
                  
              <div class="col-sm-1 text-center">
                  
                  <input type="text" class="form-control" id="cf_to_washing_cross_staining_max_value" name="cf_to_washing_cross_staining_max_value" placeholder="Enter  Max Value" required>

               </div>
                
            

     </div><!-- End of <div class="form-group form-group-sm" cf_to_washing_cross_staining-->



</div>  <!-- End of <div id="div_color_fastness_to_washing" style="display: none"> -->

    

<!-- Start of cf_to_dry_cleaning -->

<div id="div_cf_to_dry_cleaning" style="display: none">

     <div class="form-group form-group-sm">
        

                <div class="col-sm-3 text-center">
                   <label class="control-label" for="test_name_and_method" style="color:#00008B;"><span id="cf_to_dry_cleaning_color_change_test_name_label"> Color Fastness to Dry-cleaning</span><span id="cf_to_dry_cleaning_color_change_test_method"></span>(ISO 105 D01)
                   </label>
                </div>
             
                <div class="col-sm-2 text-center">
                        
                        <label class="control-label" for="description_or_type" style="color:#00008B;">Color Change</label>

                        <input type="hidden" class="form-control" id="test_method_for_cf_to_dry_cleaning_color_change" name="test_method_for_cf_to_dry_cleaning_color_change" value="ISO 105 D01">
                        
                </div>

                <div class="col-sm-1 text-center">
                     <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
                </div> 

                 <div class="col-sm-1 text-center">
                      
                    <select  class="form-control" id="cf_to_dry_cleaning_color_change_tolerance_range_math_operator" name="cf_to_dry_cleaning_color_change_tolerance_range_math_operator" onchange="cf_to_dry_cleaning_color_change_cal()">
                      <option value="">Select CF To Dry Cleaning Color Change Range Math Operator</option>
                      <option value="≥">≥</option>
                      <option value="≤"> ≤ </option>
                      <option value=">"> > </option>
	                  <option value="<"> < </option>
                   </select>
                </div>


                <div class="col-sm-1 text-center">
                     <select  class="form-control" id="cf_to_dry_cleaning_color_change_tolerance_value" name="cf_to_dry_cleaning_color_change_tolerance_value" onchange="cf_to_dry_cleaning_color_change_cal()">
                        <option value="">Select Tolerance Value</option>
                        <option value="1.0">1</option>
                        <option value="1.5">1-2</option>
                        <option value="2.0"> 2 </option>
                        <option value="2.5"> 2-3 </option>
                        <option value="3.0">3</option>
                        <option value="3.5">3-4</option>
                        <option value="4.0"> 4 </option>
                        <option value="4.5"> 4-5 </option>
                        <option value="5.0"> 5 </option>
                  </select>
                </div>

                

               
              <div class="col-sm-1" for="unit">
                 <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
                <input type="hidden" class="form-control" id="uom_of_cf_to_dry_cleaning_color_change" name="uom_of_cf_to_dry_cleaning_color_change" value="" >
              </div>

                
              <div class="col-sm-1 text-center" for="min_value">

                  
                   <input type="text" class="form-control" id="cf_to_dry_cleaning_color_change_min_value" name="cf_to_dry_cleaning_color_change_min_value" placeholder="Enter  Min Value"  required>
                
                 
              </div>
                  
              <div class="col-sm-1 text-center">
                  
                  <input type="text" class="form-control" id="cf_to_dry_cleaning_color_change_max_value" name="cf_to_dry_cleaning_color_change_max_value" placeholder="Enter  Max Value" required>
               </div>
                
            

     </div><!-- End of <div class="form-group form-group-sm" cf_to_dry_cleaning_color_change-->




     <div class="form-group form-group-sm">
        

                <div class="col-sm-3 text-center">
                   <label class="control-label" for="test_name_and_method" style="color:#00008B;"><span id="cf_to_dry_cleaning_staining_test_name_label" style="display: none;"> Color Fastness to Dry-cleaning</span><span id="cf_to_dry_cleaning_staining_test_method" style="display: none;">(ISO 105 D01)</span>
                   </label>
                </div>
             
                <div class="col-sm-2 text-center">
                        
                        <label class="control-label" for="description_or_type" style="color:#00008B;">Staining</label>

                        <input type="hidden" class="form-control" id="test_method_for_cf_to_dry_cleaning_staining" name="test_method_for_cf_to_dry_cleaning_staining" value="ISO 105 D01">
                        
                </div>

                 <div class="col-sm-1 text-center">
                     <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
                </div> 

                 <div class="col-sm-1 text-center">
                      
                    <select  class="form-control" id="cf_to_dry_cleaning_staining_tolerance_range_math_operator" name="cf_to_dry_cleaning_staining_tolerance_range_math_operator" onchange="cf_to_dry_cleaning_staining_cal()">
                      <option value="">Select CF To Dry Cleaning Staining Range Math Operator</option>
                      <option value="≥">≥</option>
                      <option value="≤"> ≤ </option>
                      <option value=">"> > </option>
	                  <option value="<"> < </option>
                  </select>
                </div>


                <div class="col-sm-1 text-center">
                     <select  class="form-control" id="cf_to_dry_cleaning_staining_tolerance_value" name="cf_to_dry_cleaning_staining_tolerance_value" onchange="cf_to_dry_cleaning_staining_cal()">
                        <option value="">Select Tolerance Value</option>
                        <option value="1.0">1</option>
                        <option value="1.5">1-2</option>
                        <option value="2.0"> 2 </option>
                        <option value="2.5"> 2-3 </option>
                        <option value="3.0">3</option>
                        <option value="3.5">3-4</option>
                        <option value="4.0"> 4 </option>
                        <option value="4.5"> 4-5 </option>
                        <option value="5.0"> 5 </option>
                   </select>
                </div>

               

               
              <div class="col-sm-1" for="unit">
                 <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
                <input type="hidden" class="form-control" id="uom_of_cf_to_dry_cleaning_staining" name="uom_of_cf_to_dry_cleaning_staining" value="" >
              </div>

                
              <div class="col-sm-1 text-center" for="min_value">

                  
                    <input type="text" class="form-control" id="cf_to_dry_cleaning_staining_min_value" name="cf_to_dry_cleaning_staining_min_value" placeholder="Enter  Min Value" required>
                 
              </div>
                  
              <div class="col-sm-1 text-center">
                  
                  <input type="text" class="form-control" id="cf_to_dry_cleaning_staining_max_value" name="cf_to_dry_cleaning_staining_max_value" placeholder="Enter  Max Value" required>

               </div>
                
            

     </div><!-- End of <div class="form-group form-group-sm" cf_to_dry_cleaning_staining-->




</div>  <!-- End of <div id="div_cf_to_dry_cleaning" style="display: none"> -->



<!-- Start of cf_to_perception_acid -->

<div id="div_cf_to_perspiration_acid" style="display: none"> 

     <div class="form-group form-group-sm">
        

                <div class="col-sm-3 text-center">
                   <label class="control-label" for="test_name_and_method" style="color:#00008B;"><span id="perspiration_acid_color_change_test_name_label"> Color Fastness to Perspiration Acid</span> <span id="perspiration_acid_color_change_test_method">(ISO 105 E04)</span>
                   </label>
                </div>
             
                <div class="col-sm-2 text-center">
                        
                        <label class="control-label" for="description_or_type" style="color:#00008B;">Color Change</label>

                        <input type="hidden" class="form-control" id="test_method_for_perspiration_acid_color_change" name="test_method_for_perspiration_acid_color_change" value="ISO 105 E04" >
                        
                </div>

                <div class="col-sm-1 text-center">
                     <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
                </div> 

                 <div class="col-sm-1 text-center">
                      
                    <select  class="form-control" id="cf_to_perspiration_acid_color_change_tolerance_range_math_op" name="cf_to_perspiration_acid_color_change_tolerance_range_math_op" onchange="cf_to_perspiration_acid_color_change_cal()">
                      <option value="">Select CF To Perspiration Acid Color Change Range Math Operator</option>
                      <option value="≥">≥</option>
                      <option value="≤"> ≤ </option>
                      <option value=">"> > </option>
	                  <option value="<"> < </option>
                  </select>
                </div>


                <div class="col-sm-1 text-center">
                  <select  class="form-control" id="cf_to_perspiration_acid_color_change_tolerance_value" name="cf_to_perspiration_acid_color_change_tolerance_value" onchange="cf_to_perspiration_acid_color_change_cal()">
                    <option value="">Select Tolerance Value</option>
                    <option value="1.0">1</option>
                    <option value="1.5">1-2</option>
                    <option value="2.0"> 2 </option>
                    <option value="2.5"> 2-3 </option>
                    <option value="3.0">3</option>
                    <option value="3.5">3-4</option>
                    <option value="4.0"> 4 </option>
                    <option value="4.5"> 4-5 </option>
                    <option value="5.0"> 5 </option>
                  </select>
                </div>

                

               
              <div class="col-sm-1" for="unit">
                 <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
                 <input type="hidden" class="form-control" id="uom_of_cf_to_perspiration_acid_color_change" name="uom_of_cf_to_perspiration_acid_color_change" value="" >
              </div>

                
              <div class="col-sm-1 text-center" for="min_value">

                  
                   <input type="text" class="form-control" id="cf_to_perspiration_acid_color_change_min_value" name="cf_to_perspiration_acid_color_change_min_value" placeholder="Enter  Min Value" required>
                
                 
              </div>
                  
              <div class="col-sm-1 text-center">
                  
                  <input type="text" class="form-control" id="cf_to_perspiration_acid_color_change_max_value" name="cf_to_perspiration_acid_color_change_max_value" placeholder="Enter  Max Value" required>
               </div>
                
            

     </div><!-- End of <div class="form-group form-group-sm" cf_to_perspiration_acid_color_change-->




     <div class="form-group form-group-sm">
        

                <div class="col-sm-3 text-center">
                   <label class="control-label" for="test_name_and_method" style="color:#00008B;"><span id="cf_to_perspiration_acid_staining_test_name_label" style="display: none;"> Color Fastness to Perspiration Acid</span> <span id="cf_to_perspiration_acid_staining_test_method" style="display: none;">(ISO 105 E04)</span>
                   </label>
                </div>
             
                <div class="col-sm-2 text-center">
                        
                        <label class="control-label" for="description_or_type" style="color:#00008B;">Staining</label>

                         <input type="hidden" class="form-control" id="test_method_for_cf_to_perspiration_acid_staining" name="test_method_for_cf_to_perspiration_acid_staining" value="ISO 105 E04" >
                        
                </div>

                 <div class="col-sm-1 text-center">
                     <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
                </div>

                 <div class="col-sm-1 text-center">
                      
                   <select  class="form-control" id="cf_to_perspiration_acid_staining_tolerance_range_math_operator" name="cf_to_perspiration_acid_staining_tolerance_range_math_operator" onchange="cf_to_perspiration_acid_staining_cal()">
                      <option value="">Select CF To Perspiration Acid Staining Range Math Operator</option>
                      <option value="≥">≥</option>
                      <option value="≤"> ≤ </option>
                      <option value=">"> > </option>
	                  <option value="<"> < </option>
                  </select>
                </div>

                 

                <div class="col-sm-1 text-center">
                     <select  class="form-control" id="cf_to_perspiration_acid_staining_value" name="cf_to_perspiration_acid_staining_value" onchange="cf_to_perspiration_acid_staining_cal()">
                        <option value="">Select Tolerance Value</option>
                        <option value="1.0">1</option>
                        <option value="1.5">1-2</option>
                        <option value="2.0"> 2 </option>
                        <option value="2.5"> 2-3 </option>
                        <option value="3.0">3</option>
                        <option value="3.5">3-4</option>
                        <option value="4.0"> 4 </option>
                        <option value="4.5"> 4-5 </option>
                        <option value="5.0"> 5 </option>
                      </select>
                </div>

               

               
              <div class="col-sm-1" for="unit">
                 <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
                 <input type="hidden" class="form-control" id="uom_of_cf_to_perspiration_acid_staining" name="uom_of_cf_to_perspiration_acid_staining" value="" >
              </div>

                
              <div class="col-sm-1 text-center" for="min_value">

                  
                    <input type="text" class="form-control" id="cf_to_perspiration_acid_staining_min_value" name="cf_to_perspiration_acid_staining_min_value" placeholder="Enter  Min Value" required>
                
                 
              </div>
                  
              <div class="col-sm-1 text-center">
                  
                   <input type="text" class="form-control" id="cf_to_perspiration_acid_staining_max_value" name="cf_to_perspiration_acid_staining_max_value" placeholder="Enter  Max Value" required>
               </div>
                
            

     </div><!-- End of <div class="form-group form-group-sm" cf_to_perspiration_acid_staining-->


     <div class="form-group form-group-sm">
        

                <div class="col-sm-3 text-center">
                   <label class="control-label" for="test_name_and_method" style="color:#00008B;"> <span id="cf_to_perspiration_acid_cross_staining_test_name_label" style="display: none;">Color Fastness to Perspiration Acid</span> <span id="cf_to_perspiration_acid_cross_staining_test_method" style="display: none;">(ISO 105 E04)</span>
                   </label>
                </div>
             
                <div class="col-sm-2 text-center">
                        
                        <label class="control-label" for="description_or_type" style="color:#00008B;">Cross Staining</label>

                         <input type="hidden" class="form-control" id="test_method_for_cf_to_perspiration_acid_cross_staining" name="test_method_for_cf_to_perspiration_acid_cross_staining" value="ISO 105 E04" >
                        
                </div>

                  <div class="col-sm-1 text-center">
                     <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
                </div>
 
                 <div class="col-sm-1 text-center">
                      
                   <select  class="form-control" id="cf_to_perspiration_acid_cross_staining_tolerance_range_math_op" name="cf_to_perspiration_acid_cross_staining_tolerance_range_math_op" onchange="cf_to_perspiration_acid_cross_staining_cal()">
                      <option value="">Select CF To Perspiration Acid cross_staining Range Math Operator</option>
                      <option value="≥">≥</option>
                      <option value="≤"> ≤ </option>
                      <option value=">"> > </option>
	                  <option value="<"> < </option>
                  </select>
                </div>
                
               


                <div class="col-sm-1 text-center">
                     <select  class="form-control" id="cf_to_perspiration_acid_cross_staining_tolerance_value" name="cf_to_perspiration_acid_cross_staining_tolerance_value" onchange="cf_to_perspiration_acid_cross_staining_cal()">
                        <option value="">Select Tolerance Value</option>
                        <option value="1.0">1</option>
                        <option value="1.5">1-2</option>
                        <option value="2.0"> 2 </option>
                        <option value="2.5"> 2-3 </option>
                        <option value="3.0">3</option>
                        <option value="3.5">3-4</option>
                        <option value="4.0"> 4 </option>
                        <option value="4.5"> 4-5 </option>
                        <option value="5.0"> 5 </option>
                      </select>
                </div>

                
               
              <div class="col-sm-1" for="unit">
                 <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
                 <input type="hidden" class="form-control" id="uom_of_cf_to_perspiration_acid_cross_staining" name="uom_of_cf_to_perspiration_acid_cross_staining" value="" >
              </div>

                
              <div class="col-sm-1 text-center" for="min_value">

                  
                    <input type="text" class="form-control" id="cf_to_perspiration_acid_cross_staining_min_value" name="cf_to_perspiration_acid_cross_staining_min_value" placeholder="Enter  Min Value" required>
                
                 
              </div>
                  
              <div class="col-sm-1 text-center">
                  
                   <input type="text" class="form-control" id="cf_to_perspiration_acid_cross_staining_max_value" name="cf_to_perspiration_acid_cross_staining_max_value" placeholder="Enter  Max Value" required>
               </div>
                
            

     </div><!-- End of <div class="form-group form-group-sm" cf_to_perspiration_acid_cross_staining-->

</div> <!-- End of <div id="div_cf_to_perspiration_acid" style="display: none">  -->




<!-- Start of cf_to_perspiration_alkali -->

<div id="div_cf_to_perspiration_alkali" style="display: none"> 	

     <div class="form-group form-group-sm">
        

                <div class="col-sm-3 text-center">
                   <label class="control-label" for="test_name_and_method" style="color:#00008B;"><span id="cf_to_perspiration_alkali_color_change_test_name_label">Color Fastness to Perspiration Alkali</span> <span id="cf_to_perspiration_alkali_color_change_test_method">(ISO 105 E04)</span>
                   </label>
                </div>
             
                <div class="col-sm-2 text-center">
                        
                        <label class="control-label" for="description_or_type" style="color:#00008B;">Color Change</label>


                        <input type="hidden" class="form-control" id="test_method_for_cf_to_perspiration_alkali_color_change" name="test_method_for_cf_to_perspiration_alkali_color_change" value="ISO 105 E04" >
                        
                </div>

                <div class="col-sm-1 text-center">
                     <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
                </div>

                 <div class="col-sm-1 text-center">
                  
                   <select  class="form-control" id="cf_to_perspiration_alkali_color_change_tolerance_range_math_op" name="cf_to_perspiration_alkali_color_change_tolerance_range_math_op" onchange="cf_to_perspiration_alkali_color_change_cal()">
                      <option value="">Select CF To Perspiration Alkali Color Change Range Math Operator</option>
                      <option value="≥">≥</option>
                      <option value="≤"> ≤ </option>
                      <option value=">"> > </option>
	                  <option value="<"> < </option>
                   </select>

                </div>
                


                <div class="col-sm-1 text-center">
                      <select  class="form-control" id="cf_to_perspiration_alkali_color_change_tolerance_value" name="cf_to_perspiration_alkali_color_change_tolerance_value" onchange="cf_to_perspiration_alkali_color_change_cal()">
                            <option value="">Select Tolerance Value</option>
                            <option value="1.0">1</option>
                            <option value="1.5">1-2</option>
                            <option value="2.0"> 2 </option>
                            <option value="2.5"> 2-3 </option>
                            <option value="3.0">3</option>
                            <option value="3.5">3-4</option>
                            <option value="4.0"> 4 </option>
                            <option value="4.5"> 4-5 </option>
                            <option value="5.0"> 5 </option>
                      </select>
                </div>

                

               
              <div class="col-sm-1" for="unit">
                 <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
                <input type="hidden" class="form-control" id="uom_of_cf_to_perspiration_alkali_color_change" name="uom_of_cf_to_perspiration_alkali_color_change" value="" >
              </div>

                
              <div class="col-sm-1 text-center" for="min_value">

                  
                    
                  <input type="text" class="form-control" id="cf_to_perspiration_alkali_color_change_min_value" name="cf_to_perspiration_alkali_color_change_min_value" placeholder="Enter  Min Value" required>
                
                 
              </div>
                  
              <div class="col-sm-1 text-center">
                  
                   
                  <input type="text" class="form-control" id="cf_to_perspiration_alkali_color_change_max_value" name="cf_to_perspiration_alkali_color_change_max_value" placeholder="Enter  Max Value" required>
              </div>
                
            

     </div><!-- End of <div class="form-group form-group-sm" cf_to_perspiration_alkali_color_change-->




     <div class="form-group form-group-sm">
        

                <div class="col-sm-3 text-center">
                   <label class="control-label" for="test_name_and_method" style="color:#00008B;"><span id="cf_to_perspiration_alkali_staining_test_name_label" style="display: none;"> Color Fastness to Perspiration Alkali</span>  <span id="cf_to_perspiration_alkali_staining_test_method" style="display: none;">(ISO 105 E04)</span>
                   </label>
                </div>
             
                <div class="col-sm-2 text-center">
                        
                        <label class="control-label" for="description_or_type" style="color:#00008B;">Staining</label>

                        <input type="hidden" class="form-control" id="test_method_for_cf_to_perspiration_alkali_staining" name="test_method_for_cf_to_perspiration_alkali_staining" value="ISO 105 E04" >
                        
                </div>

                <div class="col-sm-1 text-center">
                     <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
                </div> 

                 <div class="col-sm-1 text-center">
                  
                   <select  class="form-control" id="cf_to_perspiration_alkali_staining_tolerance_range_math_op" name="cf_to_perspiration_alkali_staining_tolerance_range_math_op" onchange="cf_to_perspiration_alkali_staining_cal()">
                      <option value="">Select CF To Perspiration Alkali Color Change Range Math Operator</option>
                      <option value="≥">≥</option>
                      <option value="≤"> ≤ </option>
                      <option value=">"> > </option>
	                  <option value="<"> < </option>
                   </select>

                </div>
                 
                 

                <div class="col-sm-1 text-center">
                      <select  class="form-control" id="cf_to_perspiration_alkali_staining_tolerance_value" name="cf_to_perspiration_alkali_staining_tolerance_value" onchange="cf_to_perspiration_alkali_staining_cal()">
                            <option value="">Select Tolerance Value</option>
                            <option value="1.0">1</option>
                            <option value="1.5">1-2</option>
                            <option value="2.0"> 2 </option>
                            <option value="2.5"> 2-3 </option>
                            <option value="3.0">3</option>
                            <option value="3.5">3-4</option>
                            <option value="4.0"> 4 </option>
                            <option value="4.5"> 4-5 </option>
                            <option value="5.0"> 5 </option>
                      </select>
                </div>

                

               
              <div class="col-sm-1" for="unit">
                 <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
                <input type="hidden" class="form-control" id="uom_of_cf_to_perspiration_alkali_staining" name="uom_of_cf_to_perspiration_alkali_staining" value="" >
              </div>

                
              <div class="col-sm-1 text-center" for="min_value">

                  
                    
                  <input type="text" class="form-control" id="cf_to_perspiration_alkali_staining_min_value" name="cf_to_perspiration_alkali_staining_min_value" placeholder="Enter  Min Value" required>
                
                 
              </div>
                  
              <div class="col-sm-1 text-center">
                  
                   
                  <input type="text" class="form-control" id="cf_to_perspiration_alkali_staining_max_value" name="cf_to_perspiration_alkali_staining_max_value" placeholder="Enter  Max Value" required>
              </div>
                
            

     </div><!-- End of <div class="form-group form-group-sm" cf_to_perspiration_alkali_staining-->


    
     <div class="form-group form-group-sm">
        

                <div class="col-sm-3 text-center">
                   <label class="control-label" for="test_name_and_method" style="color:#00008B;"><span id="cf_to_perspiration_alkali_cross_staining_test_name_label" style="display: none;"> Color Fastness to Perspiration Alkali</span> <span id="cf_to_perspiration_alkali_cross_staining_test_method" style="display: none;">(ISO 105 E04)</span>
                   </label>
                </div>
             
                <div class="col-sm-2 text-center">
                        
                        <label class="control-label" for="description_or_type" style="color:#00008B;">Cross Staining</label>

                        <input type="hidden" class="form-control" id="test_method_for_cf_to_perspiration_alkali_cross_staining" name="test_method_for_cf_to_perspiration_alkali_cross_staining" value="ISO 105 E04" >
                        
                </div>

                 
                 <div class="col-sm-1 text-center">
                     <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
                </div>

                 <div class="col-sm-1 text-center">
                  
                   <select  class="form-control" id="cf_to_perspiration_alkali_cross_staining_tolerance_range_math_op" name="cf_to_perspiration_alkali_cross_staining_tolerance_range_math_op" onchange="cf_to_perspiration_alkali_cross_staining_cal()">
                      <option value="">Select CF To Perspiration Alkali Color Change Range Math Operator</option>
                      <option value="≥">≥</option>
                      <option value="≤"> ≤ </option>
                      <option value=">"> > </option>
	                  <option value="<"> < </option>
                   </select>

                </div>


                <div class="col-sm-1 text-center">
                      <select  class="form-control" id="cf_to_perspiration_alkali_cross_staining_tolerance_value" name="cf_to_perspiration_alkali_cross_staining_tolerance_value" onchange="cf_to_perspiration_alkali_cross_staining_cal()">
                            <option value="">Select Tolerance Value</option>
                            <option value="1.0">1</option>
                            <option value="1.5">1-2</option>
                            <option value="2.0"> 2 </option>
                            <option value="2.5"> 2-3 </option>
                            <option value="3.0">3</option>
                            <option value="3.5">3-4</option>
                            <option value="4.0"> 4 </option>
                            <option value="4.5"> 4-5 </option>
                            <option value="5.0"> 5 </option>
                      </select>
                </div>

               

               
              <div class="col-sm-1" for="unit">
                 <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
                <input type="hidden" class="form-control" id="uom_of_cf_to_perspiration_alkali_cross_staining" name="uom_of_cf_to_perspiration_alkali_cross_staining" value="" >
              </div>

                
              <div class="col-sm-1 text-center" for="min_value">

                  
                    
                  <input type="text" class="form-control" id="cf_to_perspiration_alkali_cross_staining_min_value" name="cf_to_perspiration_alkali_cross_staining_min_value" placeholder="Enter  Min Value" required>
                
                 
              </div>
                  
              <div class="col-sm-1 text-center">
                  
                   
                  <input type="text" class="form-control" id="cf_to_perspiration_alkali_cross_staining_max_value" name="cf_to_perspiration_alkali_cross_staining_max_value" placeholder="Enter  Max Value" required>
              </div>
                
            

     </div><!-- End of <div class="form-group form-group-sm" cf_to_perspiration_alkali_cross_staining-->

</div> <!--  End of <div id="div_cf_to_perspiration_alkali" style="display: none"> 	 -->






<!-- start of cf_to_water -->

<div id="div_color_fastness_to_water" style="display: none">



     <div class="form-group form-group-sm">
        

                <div class="col-sm-3 text-center">
                   <label class="control-label" for="test_name_and_method" style="color:#00008B;"> <span id="cf_to_water_color_change_test_name_label">Color Fastness to Water</span> <span id="cf_to_water_color_change_test_method">(ISO 105 E01)</span>
                   </label>
                </div>
             
                <div class="col-sm-2 text-center">
                        
                        <label class="control-label" for="description_or_type" style="color:#00008B;">Color Change</label>

                        <input type="hidden" class="form-control" id="test_method_for_cf_to_water_color_change" name="test_method_for_cf_to_water_color_change" value="ISO 105 E01" >
                        
                </div>

                <div class="col-sm-1 text-center">
                     <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
                </div> 

                 <div class="col-sm-1 text-center">
                  
                   <select  class="form-control" id="cf_to_water_color_change_tolerance_range_math_operator" name="cf_to_water_color_change_tolerance_range_math_operator" onchange="cf_to_water_color_change_cal()">
                      <option value="">Select CF To Water Color Change Range Math Operator</option>
                      <option value="≥">≥</option>
                      <option value="≤"> ≤ </option>
                      <option value=">"> > </option>
	                  <option value="<"> < </option>
                  </select>

                </div>


                <div class="col-sm-1 text-center">
                      <select  class="form-control" id="cf_to_water_color_change_tolerance_value" name="cf_to_water_color_change_tolerance_value" onchange="cf_to_water_color_change_cal()">
                        <option value="">Select Tolerance Value</option>
                       <option value="1.0">1</option>
                            <option value="1.5">1-2</option>
                            <option value="2.0"> 2 </option>
                            <option value="2.5"> 2-3 </option>
                            <option value="3.0">3</option>
                            <option value="3.5">3-4</option>
                            <option value="4.0"> 4 </option>
                            <option value="4.5"> 4-5 </option>
                            <option value="5.0"> 5 </option>
                      </select>
                </div>

                

               
              <div class="col-sm-1" for="unit">
                 <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>

                <input type="hidden" class="form-control" id="uom_of_cf_to_water_color_change" name="uom_of_cf_to_water_color_change" value="" >
              </div>

                
              <div class="col-sm-1 text-center" for="min_value">

                   <input type="text" class="form-control" id="cf_to_water_color_change_min_value" name="cf_to_water_color_change_min_value" placeholder="Enter  Min Value" required>
                 
              </div>
                  
              <div class="col-sm-1 text-center">
                  
                    <input type="text" class="form-control" id="cf_to_water_color_change_max_value" name="cf_to_water_color_change_max_value" placeholder="Enter  Max Value" required>
              </div>
                
            

     </div><!-- End of <div class="form-group form-group-sm" cf_to_water_color_change-->


     <div class="form-group form-group-sm">
        

                <div class="col-sm-3 text-center">
                   <label class="control-label" for="test_name_and_method" style="color:#00008B;"><span id="cf_to_water_staining_test_name_label" style="display: none;">Color Fastness to Water</span> <span id="cf_to_water_staining_test_method" style="display: none;">(ISO 105 E01)</span>
                   </label>
                </div>
             
                <div class="col-sm-2 text-center">
                        
                        <label class="control-label" for="description_or_type" style="color:#00008B;">Staining</label>

                        <input type="hidden" class="form-control" id="test_method_for_cf_to_water_staining" name="test_method_for_cf_to_water_staining" value="ISO 105 E01" >
                        
                </div>

                 <div class="col-sm-1 text-center">
                     <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
                </div>


                 <div class="col-sm-1 text-center">
                  
                   <select  class="form-control" id="cf_to_water_staining_tolerance_range_math_operator" name="cf_to_water_staining_tolerance_range_math_operator" onchange="cf_to_water_staining_cal()">
                      <option value="">Select CF To Water Color Change Range Math Operator</option>
                      <option value="≥">≥</option>
                      <option value="≤"> ≤ </option>
                      <option value=">"> > </option>
	                  <option value="<"> < </option>
                  </select>

                </div>
        

                <div class="col-sm-1 text-center">
                      <select  class="form-control" id="cf_to_water_staining_tolerance_value" name="cf_to_water_staining_tolerance_value" onchange="cf_to_water_staining_cal()">
                        <option value="">Select Tolerance Value</option>
                        <option value="1.0">1</option>
                            <option value="1.5">1-2</option>
                            <option value="2.0"> 2 </option>
                            <option value="2.5"> 2-3 </option>
                            <option value="3.0">3</option>
                            <option value="3.5">3-4</option>
                            <option value="4.0"> 4 </option>
                            <option value="4.5"> 4-5 </option>
                            <option value="5.0"> 5 </option>
                      </select>
                </div>

                
               
              <div class="col-sm-1" for="unit">
                 <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>

                <input type="hidden" class="form-control" id="uom_of_cf_to_water_staining" name="uom_of_cf_to_water_staining" value="" >
              </div>

                
              <div class="col-sm-1 text-center" for="min_value">

                   <input type="text" class="form-control" id="cf_to_water_staining_min_value" name="cf_to_water_staining_min_value" placeholder="Enter  Min Value" required>
                 
              </div>
                  
              <div class="col-sm-1 text-center">
                  
                    <input type="text" class="form-control" id="cf_to_water_staining_max_value" name="cf_to_water_staining_max_value" placeholder="Enter  Max Value" required>
              </div>
                
            

     </div><!-- End of <div class="form-group form-group-sm" cf_to_water_staining-->


     <div class="form-group form-group-sm">
        

                <div class="col-sm-3 text-center">
                   <label class="control-label" for="test_name_and_method" style="color:#00008B;"><span id="cf_to_water_cross_staining_test_name_label" style="display: none;"> Color Fastness to Water</span> <span id="cf_to_water_cross_staining_test_method" style="display: none;">(ISO 105 E01)</span>
                   </label>
                </div>
             
                <div class="col-sm-2 text-center">
                        
                        <label class="control-label" for="description_or_type" style="color:#00008B;">Cross Staining</label>

                         <input type="hidden" class="form-control" id="test_method_for_cf_to_water_cross_staining" name="test_method_for_cf_to_water_cross_staining" value="ISO 105 E01" >
                        
                </div>

                 <div class="col-sm-1 text-center">
                     <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
                </div>

                 <div class="col-sm-1 text-center">
                  
                   <select  class="form-control" id="cf_to_water_cross_staining_tolerance_range_math_operator" name="cf_to_water_cross_staining_tolerance_range_math_operator" onchange="cf_to_water_cross_staining_cal()">
                      <option value="">Select CF To Water Color Change Range Math Operator</option>
                      <option value="≥">≥</option>
                      <option value="≤"> ≤ </option>
                      <option value=">"> > </option>
	                  <option value="<"> < </option>
                  </select>

                </div>


                <div class="col-sm-1 text-center">
                      <select  class="form-control" id="cf_to_water_cross_staining_tolerance_value" name="cf_to_water_cross_staining_tolerance_value" onchange="cf_to_water_cross_staining_cal()">
                        <option value="">Select Tolerance Value</option>
                        <<option value="1.0">1</option>
                            <option value="1.5">1-2</option>
                            <option value="2.0"> 2 </option>
                            <option value="2.5"> 2-3 </option>
                            <option value="3.0">3</option>
                            <option value="3.5">3-4</option>
                            <option value="4.0"> 4 </option>
                            <option value="4.5"> 4-5 </option>
                            <option value="5.0"> 5 </option>
                      </select>
                </div>

                

               
              <div class="col-sm-1" for="unit">
                 <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>

                <input type="hidden" class="form-control" id="uom_of_cf_to_water_cross_staining" name="uom_of_cf_to_water_cross_staining" value="" >
              </div>

                
              <div class="col-sm-1 text-center" for="min_value">

                   <input type="text" class="form-control" id="cf_to_water_cross_staining_min_value" name="cf_to_water_cross_staining_min_value" placeholder="Enter  Min Value" required>
                 
              </div>
                  
              <div class="col-sm-1 text-center">
                  
                    <input type="text" class="form-control" id="cf_to_water_cross_staining_max_value" name="cf_to_water_cross_staining_max_value" placeholder="Enter  Max Value" required>
              </div>
                
            

     </div><!-- End of <div class="form-group form-group-sm" cf_to_water_cross_staining-->



 </div>  <!-- End of <div id="div_color_fastness_to_water" style="display: none"> -->






<!-- Start of cf_to_water_spotting -->
<div id="div_color_fastness_to_water_spotting" style="display: none">



     <div class="form-group form-group-sm">
        

                <div class="col-sm-3 text-center">
                   <label class="control-label" for="test_name_and_method" style="color:#00008B;"><span id="cf_to_water_spotting_surface_test_name_label"> Color fastness to Water Spotting</span> <span id="cf_to_water_spotting_surface_test_method"></span>
                   </label>
                </div>
             
                <div class="col-sm-2 text-center">
                        
                         <label class="control-label" for="description_or_type" style="color:#00008B;"> Surface(Color Change)</label>

                         <input type="hidden" class="form-control" id="test_method_for_cf_to_water_spotting_surface" name="test_method_for_cf_to_water_spotting_surface" value="None" >
                        
                </div>
               
                <div class="col-sm-1 text-center">
                     <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
                </div>


                 <div class="col-sm-1 text-center">
                  
                   <select  class="form-control" id="cf_to_water_spotting_surface_tolerance_range_math_op" name="cf_to_water_spotting_surface_tolerance_range_math_op" onchange="cf_to_water_spotting_surface_cal()">
                      <option value="">Select Math Operator</option>
                      <option value="≥">≥</option>
                      <option value="≤"> ≤ </option>
                      <option value=">"> > </option>
	                  <option value="<"> < </option>

                  </select>

                </div>


                <div class="col-sm-1 text-center">
                      <select  class="form-control" id="cf_to_water_spotting_surface_tolerance_value" name="cf_to_water_spotting_surface_tolerance_value" onchange="cf_to_water_spotting_surface_cal()">
                        <option value="">Select Tolerance Value</option>
                        <option value="1.0">1</option>
                        <option value="1.5">1-2</option>
                        <option value="2.0"> 2 </option>
                        <option value="2.5"> 2-3 </option>
                        <option value="3.0">3</option>
                        <option value="3.5">3-4</option>
                        <option value="4.0"> 4 </option>
                        <option value="4.5"> 4-5 </option>
                        <option value="5.0"> 5 </option>
                      </select>
                </div>

                

               
              <div class="col-sm-1" for="unit">
                 <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
                <input type="hidden" class="form-control" id="uom_of_cf_to_water_spotting_surface" name="uom_of_cf_to_water_spotting_surface" value="" >
              </div>

                
              <div class="col-sm-1 text-center" for="min_value">

                   <input type="text" class="form-control" id="cf_to_water_spotting_surface_min_value" name="cf_to_water_spotting_surface_min_value" placeholder="Enter  Min Value" required>
                 
              </div>
                  
              <div class="col-sm-1 text-center">
                  
                    <input type="text" class="form-control" id="cf_to_water_spotting_surface_max_value" name="cf_to_water_spotting_surface_max_value" placeholder="Enter  Max Value" required>
              </div>
                
            

     </div><!-- End of <div class="form-group form-group-sm" cf_to_water_spotting_surface-->


      <div class="form-group form-group-sm">
        

                <div class="col-sm-3 text-center">
                   <label class="control-label" for="test_name_and_method" style="color:#00008B;"><span id="cf_to_water_spotting_edge_test_name_label" style="display: none;"> Color fastness to Water Spotting</span> <span id="cf_to_water_spotting_edge_test_method" style="display: none;"></span>
                   </label>
                </div>
             
                <div class="col-sm-2 text-center">
                        
                        <label class="control-label" for="description_or_type" style="color:#00008B;">Edge (Color Change)</label>


                        <input type="hidden" class="form-control" id="test_method_for_cf_to_water_spotting_edge" name="test_method_for_cf_to_water_spotting_edge" value="None" >
                        
                </div>

                  <div class="col-sm-1 text-center">
                     <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
                </div>

                 <div class="col-sm-1 text-center">
                  
                   <select  class="form-control" id="cf_to_water_spotting_edge_tolerance_range_math_op" name="cf_to_water_spotting_edge_tolerance_range_math_op" onchange="cf_to_water_spotting_edge_cal()">
                      <option value="">Select Math Operator</option>
                      <option value="≥">≥</option>
                      <option value="≤"> ≤ </option>
                      <option value=">"> > </option>
	                  <option value="<"> < </option>
                  </select>

                </div>


                <div class="col-sm-1 text-center">
                      <select  class="form-control" id="cf_to_water_spotting_edge_tolerance_value" name="cf_to_water_spotting_edge_tolerance_value" onchange="cf_to_water_spotting_edge_cal()">
                        <option value="">Select Tolerance Value</option>
                        <option value="1.0">1</option>
                        <option value="1.5">1-2</option>
                        <option value="2.0"> 2 </option>
                        <option value="2.5"> 2-3 </option>
                        <option value="3.0">3</option>
                        <option value="3.5">3-4</option>
                        <option value="4.0"> 4 </option>
                        <option value="4.5"> 4-5 </option>
                        <option value="5.0"> 5 </option>
                      </select>
                </div>

               

               
              <div class="col-sm-1" for="unit">
                 <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
                <input type="hidden" class="form-control" id="uom_of_cf_to_water_spotting_edge" name="uom_of_cf_to_water_spotting_edge" value="" >
              </div>

                
              <div class="col-sm-1 text-center" for="min_value">

                   <input type="text" class="form-control" id="cf_to_water_spotting_edge_min_value" name="cf_to_water_spotting_edge_min_value" placeholder="Enter  Min Value" required>
                 
              </div>
                  
              <div class="col-sm-1 text-center">
                  
                    <input type="text" class="form-control" id="cf_to_water_spotting_edge_max_value" name="cf_to_water_spotting_edge_max_value" placeholder="Enter  Max Value" required>
              </div>
                
            

     </div><!-- End of <div class="form-group form-group-sm" cf_to_water_spotting_edge-->



     <div class="form-group form-group-sm">
        

                <div class="col-sm-3 text-center">
                   <label class="control-label" for="test_name_and_method" style="color:#00008B;"><span id="cf_to_water_spotting_cross_staining_test_name_label" style="display: none;"> Color fastness to Water Spotting</span> <span id="cf_to_water_spotting_cross_staining_test_method" style="display: none;"></span>
                   </label>
                </div>
             
                <div class="col-sm-2 text-center">
                        
                        <label class="control-label" for="description_or_type" style="color:#00008B;">Cross Staining(Color Change)</label>

                        <input type="hidden" class="form-control" id="test_method_for_cf_to_water_spotting_cross_staining" name="test_method_for_cf_to_water_spotting_cross_staining" value="value" >
                        
                </div>

                  <div class="col-sm-1 text-center">
                     <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
                </div>

                 <div class="col-sm-1 text-center">
                  
                   <select  class="form-control" id="cf_to_water_spotting_cross_staining_tolerance_range_math_op" name="cf_to_water_spotting_cross_staining_tolerance_range_math_op" onchange="cf_to_water_spotting_cross_staining_cal()">
                      <option value="">Select Math Operator</option>
                      <option value="≥">≥</option>
                      <option value="≤"> ≤ </option>
                      <option value=">"> > </option>
	                  <option value="<"> < </option>
                  </select>

                </div>


                <div class="col-sm-1 text-center">
                      <select  class="form-control" id="cf_to_water_spotting_cross_staining_tolerance_value" name="cf_to_water_spotting_cross_staining_tolerance_value" onchange="cf_to_water_spotting_cross_staining_cal()">
                        <option value="">Select Tolerance Value</option>
                        <option value="1.0">1</option>
                        <option value="1.5">1-2</option>
                        <option value="2.0"> 2 </option>
                        <option value="2.5"> 2-3 </option>
                        <option value="3.0">3</option>
                        <option value="3.5">3-4</option>
                        <option value="4.0"> 4 </option>
                        <option value="4.5"> 4-5 </option>
                        <option value="5.0"> 5 </option>
                      </select>
                </div>

                

               
              <div class="col-sm-1" for="unit">
                 <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>

                <input type="hidden" class="form-control" id="uom_of_cf_to_water_spotting_cross_staining" name="uom_of_cf_to_water_spotting_cross_staining" value="" >
              </div>

                
              <div class="col-sm-1 text-center" for="min_value">

                   <input type="text" class="form-control" id="cf_to_water_spotting_cross_staining_min_value" name="cf_to_water_spotting_cross_staining_min_value" placeholder="Enter  Min Value" required>
                 
              </div>
                  
              <div class="col-sm-1 text-center">
                  
                    <input type="text" class="form-control" id="cf_to_water_spotting_cross_staining_max_value" name="cf_to_water_spotting_cross_staining_max_value" placeholder="Enter  Max Value" required>
              </div>
                
            

     </div><!-- End of <div class="form-group form-group-sm" cf_to_water_spotting_cross_staining-->

</div>  <!-- End of <div id="div_color_fastness_to_water_spotting" style="display: none"> -->





<!-- Start of cf_to_hydrolysis_of_reactive_dyes -->

<div id="div_cf_to_hydrolysis_of_reactive_dyes" style="display: none">

      <div class="form-group form-group-sm">
        

                <div class="col-sm-3 text-center">
                   <label class="control-label" for="test_name_and_method" style="color:#00008B;"><span id="cf_to_hydrolysis_of_reactive_dyes_color_change_test_name_label"> Color fastness to Hydrolysis of Reactive Dyes</span> <span id="cf_to_hydrolysis_of_reactive_dyes_color_change_test_method">(C11)</span>
                   </label>
                </div>
             
                <div class="col-sm-2 text-center">
                        
                        <label class="control-label" for="description_or_type" style="color:#00008B;">Color Change</label>

                        <input type="hidden" class="form-control" id="test_method_for_cf_to_hydrolysis_of_reactive_dyes_color_change" name="test_method_for_cf_to_hydrolysis_of_reactive_dyes_color_change" value="C11" >
                        
                </div>

                 <div class="col-sm-1 text-center">
                     <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
                </div>

                 <div class="col-sm-1 text-center">
                  
                   <select  class="form-control" id="cf_to_hydrolysis_of_reactive_dyes_color_change_tol_rang_mat_op" name="cf_to_hydrolysis_of_reactive_dyes_color_change_tol_rang_mat_op" onchange="cf_to_hydrolysis_of_reactive_dyes_color_change_cal()">
                      <option value="">Select Math Operator</option>
                      <option value="≥">≥</option>
                      <option value="≤"> ≤ </option>
                      <option value=">"> > </option>
	                  <option value="<"> < </option>
                  </select>

                </div>


                <div class="col-sm-1 text-center">
                      <select  class="form-control" id="cf_to_hydrolysis_of_reactive_dyes_color_change_tolerance_value" name="cf_to_hydrolysis_of_reactive_dyes_color_change_tolerance_value" onchange="cf_to_hydrolysis_of_reactive_dyes_color_change_cal()">
                        <option value="">Select Tolerance Value</option>
                        <option value="1.0">1</option>
                        <option value="1.5">1-2</option>
                        <option value="2.0"> 2 </option>
                        <option value="2.5"> 2-3 </option>
                        <option value="3.0">3</option>
                        <option value="3.5">3-4</option>
                        <option value="4.0"> 4 </option>
                        <option value="4.5"> 4-5 </option>
                        <option value="5.0"> 5 </option>
                      </select>
                </div>

                

               
              <div class="col-sm-1" for="unit">
                 <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
                <input type="hidden" class="form-control" id="uom_of_cf_to_hydrolysis_of_reactive_dyes_color_change" name="uom_of_cf_to_hydrolysis_of_reactive_dyes_color_change" value="" >
              </div>

                
              <div class="col-sm-1 text-center" for="min_value">

                   <input type="text" class="form-control" id="cf_to_hydrolysis_of_reactive_dyes_color_change_min_value" name="cf_to_hydrolysis_of_reactive_dyes_color_change_min_value" placeholder="Enter  Min Value" required>
                 
              </div>
                  
              <div class="col-sm-1 text-center">
                  
                    <input type="text" class="form-control" id="cf_to_hydrolysis_of_reactive_dyes_color_change_max_value" name="cf_to_hydrolysis_of_reactive_dyes_color_change_max_value" placeholder="Enter  Max Value" required>
              </div>
                
            

     </div><!-- End of <div class="form-group form-group-sm" cf_to_hydrolysis_of_reactive_dyes_color_change-->

</div>  <!-- End of <div id="div_cf_to_hydrolysis_of_reactive_dyes" style="display: none"> -->




<!-- Start of cf_to_oxidative_bleach_damage -->	
<div id="div_cf_to_oxidative_bleach_damage" style="display: none">


     <div class="form-group form-group-sm">
        

                <div class="col-sm-3 text-center">
                   <label class="control-label" for="test_name_and_method" style="color:#00008B;"><span id="cf_to_oxidative_bleach_damage_color_change_test_name_label">  Color Fastness to Oxidative Bleach Damage</span> <span id="cf_to_oxidative_bleach_damage_color_change">(C10A)</span>
                   </label>
                </div>
             
                <div class="col-sm-2 text-center">
                        
                        <label class="control-label" for="description_or_type" style="color:#00008B;">Color Change</label>

                        <input type="hidden" class="form-control" id="test_method_for_cf_to_oxidative_bleach_damage_color_cange" name="test_method_for_cf_to_oxidative_bleach_damage_color_cange" value="C10A" >
                        
                </div>

                 <div class="col-sm-1 text-center">
                     <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
                </div>

                 <div class="col-sm-1 text-center">
                  
                   
                <select  class="form-control" id="cf_to_oxidative_bleach_damage_color_change_tol_range_math_op" name="cf_to_oxidative_bleach_damage_color_change_tol_range_math_op" onchange="cf_to_oxidative_bleach_damage_color_change_cal()">
                      <option value="">Select CF To Oidative Bleach Damage Color Change Math Operator</option>
                      <option value="≥">≥</option>
                      <option value="≤"> ≤ </option>
                      <option value=">"> > </option>
	                  <option value="<"> < </option>
                </select>

                </div>


                <div class="col-sm-1 text-center">
                      <select  class="form-control" id="cf_to_oxidative_bleach_damage_color_change_tolerance_value" name="cf_to_oxidative_bleach_damage_color_change_tolerance_value" onchange="cf_to_oxidative_bleach_damage_color_change_cal()">
                        <option value="">Select Tolerance Value</option>
                        <option value="1.0">1</option>
                        <option value="1.5">1-2</option>
                        <option value="2.0"> 2 </option>
                        <option value="2.5"> 2-3 </option>
                        <option value="3.0">3</option>
                        <option value="3.5">3-4</option>
                        <option value="4.0"> 4 </option>
                        <option value="4.5"> 4-5 </option>
                        <option value="5.0"> 5 </option>
                      </select>
                </div>

               

               
              <div class="col-sm-1" for="unit">
                 <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
                 <input type="hidden" class="form-control" id="uom_of_cf_to_oxidative_bleach_damage_color_change" name="uom_of_cf_to_oxidative_bleach_damage_color_change" value="" >
              </div>

                
              <div class="col-sm-1 text-center" for="min_value">

                  <input type="text" class="form-control" id="cf_to_oxidative_bleach_damage_color_change_min_value" name="cf_to_oxidative_bleach_damage_color_change_min_value" placeholder="Enter  Min Value" required>
                 
              </div>
                  
              <div class="col-sm-1 text-center">
                  
                    <input type="text" class="form-control" id="cf_to_oxidative_bleach_damage_color_change_max_value" name="cf_to_oxidative_bleach_damage_color_change_max_value" placeholder="Enter  Max Value" required>
              </div>
                
            

     </div><!-- End of <div class="form-group form-group-sm" cf_to_oxidative_bleach_damage_color_change-->



     <div class="form-group form-group-sm">
        

                <div class="col-sm-3 text-center">
                   <label class="control-label" for="test_name_and_method" style="color:#00008B;"> <span id="cf_to_oxidative_bleach_damage_name_label" style="display: none;">Color Fastness to Oxidative Bleach Damage</span> <span id="cf_to_oxidative_bleach_damage_test_method" style="display: none;"> (C10A)</span>
                   </label>
                </div>
             
                <div class="col-sm-2 text-center">
                        
                        <label class="control-label" for="description_or_type" style="color:#00008B;">Tone</label>
                        
                </div>

                 

                 <div class="col-sm-1 text-center">
                  
                  <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>

                </div>


                <div class="col-sm-1 text-center">
                      <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
                </div>

                <div class="col-sm-1 text-center">
                     <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
                </div>

               
              <div class="col-sm-1" for="unit">
                 <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
                <!-- <input type="hidden" class="form-control" id="uom_of_cf_to_water_spotting_cross_staining" name="uom_of_cf_to_water_spotting_cross_staining" value="value" > -->
              </div>

              <div class="col-sm-2 text-center">
                     On Tone
                    <input type="hidden" class="form-control" id="cf_to_oxidative_bleach_damage_value" name="cf_to_oxidative_bleach_damage_value" value="on tone">
              </div>
                
            

     </div><!-- End of <div class="form-group form-group-sm" cf_to_water_spotting_cross_staining-->
</div>   <!-- End of <div id="div_cf_to_oxidative_bleach_damage" style="display: none"> -->





    <div id="div_cf_to_phenolic_yellowing" style="display: none">
		<div class="form-group form-group-sm">
        

                <div class="col-sm-3 text-center">
                   <label class="control-label" for="test_name_and_method" style="color:#00008B;"><span id="cf_to_phenolic_yellowing_staining_test_name_label"> Color Fastness to Phenolic Yellowing</span> <span id="cf_to_phenolic_yellowing_staining_test_method"></span>
                   </label>
                </div>
             
                <div class="col-sm-2 text-center">
                        
                        <label class="control-label" for="description_or_type" style="color:#00008B;">Staining</label>


                        <input type="hidden" class="form-control" id="test_method_for_cf_to_phenolic_yellowing_staining" name="test_method_for_cf_to_phenolic_yellowing_staining" value="ISO 105 X 18" >
                        
                </div>

                  <div class="col-sm-1 text-center">
                     <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
                </div>

                <div class="col-sm-1 text-center">
                    <select  class="form-control" id="cf_to_phenolic_yellowing_staining_tolerance_range_math_operator" name="cf_to_phenolic_yellowing_staining_tolerance_range_math_operator" onchange="cf_to_phenolic_yellowing_staining_cal()">
                          <option value="">Select CF To Phenolic Yellowing Staining Math Operator</option>
                          <option value="≥">≥</option>
                          <option value="≤"> ≤ </option>
                          <option value=">"> > </option>
	                      <option value="<"> < </option>
                    </select>
                </div>


                <div class="col-sm-1 text-center">
                 <select  class="form-control" id="cf_to_phenolic_yellowing_staining_tolerance_value" name="cf_to_phenolic_yellowing_staining_tolerance_value" onchange="cf_to_phenolic_yellowing_staining_cal()">
                            <option value="">Select Tolerance Value</option>
                            <option value="1.0">1</option>
                            <option value="1.5">1-2</option>
                            <option value="2.0"> 2 </option>
                            <option value="2.5"> 2-3 </option>
                            <option value="3.0">3</option>
                            <option value="3.5">3-4</option>
                            <option value="4.0"> 4 </option>
                            <option value="4.5"> 4-5 </option>
                            <option value="5.0"> 5 </option>
                  </select>
                </div>

               

               
              <div class="col-sm-1" for="unit">
                 <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
                 <input type="hidden" class="form-control" id="uom_of_cf_to_phenolic_yellowing_staining" name="uom_of_cf_to_phenolic_yellowing_staining" value="" >
              </div>

                
              <div class="col-sm-1 text-center" for="min_value">

                 <input type="text" class="form-control" id="cf_to_phenolic_yellowing_staining_min_value" name="cf_to_phenolic_yellowing_staining_min_value" placeholder="Enter  Min Value" required>
                 
              </div>
                  
              <div class="col-sm-1 text-center">
                  
                    <input type="text" class="form-control" id="cf_to_phenolic_yellowing_staining_max_value" name="cf_to_phenolic_yellowing_staining_max_value" placeholder="Enter  Max Value" required>
              </div>
                
         </div>   

     


	   <div class="form-group form-group-sm">
	        

	            <div class="col-sm-3 text-center">
                   <label class="control-label" for="test_name_and_method" style="color:#00008B;"> <span id="cf_to_pvc_migration_staining_test_name_label" >Migration of Color into PVC</span> <span id="cf_to_pvc_migration_staining_test_method" style="display: none;">(ISO 105 X 10)</span>
                   </label>
                </div>
             
                <div class="col-sm-2 text-center">
                        
                        <label class="control-label" for="description_or_type" style="color:#00008B;">Staining</label>


                        <input type="hidden" class="form-control" id="test_method_for_cf_to_pvc_migration_staining" name="test_method_for_cf_to_pvc_migration_staining" value="ISO 105 X 10" >
                        
                </div>

	                 <div class="col-sm-1 text-center">
	                     <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
	                </div>

	                <div class="col-sm-1 text-center">
	                    <select  class="form-control" id="cf_to_pvc_migration_staining_tolerance_range_math_operator" name="cf_to_pvc_migration_staining_tolerance_range_math_operator" onchange="cf_to_pvc_migration_staining_cal()">
	                      <option value="">Select CF To Pvc Migration Staining Math Operator</option>
	                      <option value="≥">≥</option>
	                      <option value="≤"> ≤ </option>
	                      <option value=">"> > </option>
	                      <option value="<"> < </option>
	                    </select>
	                </div>


	                <div class="col-sm-1 text-center">
	                 <select  class="form-control" id="cf_to_pvc_migration_staining_tolerance_value" name="cf_to_pvc_migration_staining_tolerance_value" onchange="cf_to_pvc_migration_staining_cal()">
	                      <option value="">Select Tolerance Value</option>
	                      <option value="1.0">1</option>
	                      <option value="1.5">1-2</option>
	                      <option value="2.0"> 2 </option>
	                      <option value="2.5"> 2-3 </option>
	                      <option value="3.0">3</option>
	                      <option value="3.5">3-4</option>
	                      <option value="4.0"> 4 </option>
	                      <option value="4.5"> 4-5 </option>
	                      <option value="5.0"> 5 </option>
	                  </select>
	                </div>

	                

	               
	              <div class="col-sm-1" for="unit">
	                 <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
	                 <input type="hidden" class="form-control" id="uom_of_cf_to_pvc_migration_staining" name="uom_of_cf_to_pvc_migration_staining" value="" >
	              </div>

	                
	              <div class="col-sm-1 text-center" for="min_value">

	                 <input type="text" class="form-control" id="cf_to_pvc_migration_staining_min_value" name="cf_to_pvc_migration_staining_min_value" placeholder="Enter  Min Value" required>
	                 
	              </div>
	                  
	              <div class="col-sm-1 text-center">
	                  
	                   <input type="text" class="form-control" id="cf_to_pvc_migration_staining_max_value" name="cf_to_pvc_migration_staining_max_value" placeholder="Enter  Max Value" required>
	              </div>
	                
	            

	     </div><!-- End of <div class="form-group form-group-sm" cf_to_pvc_migration_staining-->


</div><!-- End of <div class="form-group form-group-sm" id="div_cf_to_phenolic_yellowing" style="display: none" -->




 <div class="form-group form-group-sm" id="div_cf_to_saliva" style="display: none">
	     <div class="form-group form-group-sm" >
        

                <div class="col-sm-3 text-center">
                   <label class="control-label" for="test_name_and_method" style="color:#00008B;"><span id="cf_to_saliva_color_change_test_name_label"> Color Fastness to Saliva</span> <span id="cf_to_saliva_color_change_test_method">(DIN V 53160-1)</span> 
                   </label>
                </div>
             
                <div class="col-sm-2 text-center">
                        
                        <label class="control-label" for="description_or_type" style="color:#00008B;">Color Change</label>

                        <input type="hidden" class="form-control" id="test_method_for_cf_to_saliva_color_change" name="test_method_for_cf_to_saliva_color_change" value="DIN V 53160-1" >
                        
                </div>
                
                <div class="col-sm-1 text-center">
                     <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
                </div>
                 

                <div class="col-sm-1 text-center">
                     <select  class="form-control" id="cf_to_saliva_color_change_tolerance_range_math_operator" name="cf_to_saliva_color_change_tolerance_range_math_operator" onchange="cf_to_saliva_color_change_cal()">
                      <option value="">Select CF To Saliva Staining Math Operator</option>
                      <option value="≥">≥</option>
                      <option value="≤"> ≤ </option>
                      <option value=">"> > </option>
	                  <option value="<"> < </option>
                     </select>
                </div>


                <div class="col-sm-1 text-center">
                   <select  class="form-control" id="cf_to_saliva_color_change_tolerance_value" name="cf_to_saliva_color_change_tolerance_value" onchange="cf_to_saliva_color_change_cal()">
                      <option value="">Select Tolerance Value</option>
                      <option value="1.0">1</option>
                      <option value="1.5">1-2</option>
                      <option value="2.0"> 2 </option>
                      <option value="2.5"> 2-3 </option>
                      <option value="3.0">3</option>
                      <option value="3.5">3-4</option>
                      <option value="4.0"> 4 </option>
                      <option value="4.5"> 4-5 </option>
                      <option value="5.0"> 5 </option>
                  </select>
                </div>

                

               
              <div class="col-sm-1" for="unit">
                 <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
                 <input type="hidden" class="form-control" id="uom_of_cf_to_saliva_color_change" name="uom_of_cf_to_saliva_color_change" value="" >
              </div>

                
              <div class="col-sm-1 text-center" for="min_value">
                 <input type="text" class="form-control" id="cf_to_saliva_color_change_staining_min_value" name="cf_to_saliva_color_change_staining_min_value" placeholder="Enter  Min Value" required>
                 
              </div>
                  
              <div class="col-sm-1 text-center">
                  
                    <input type="text" class="form-control" id="cf_to_saliva_color_change_max_value" name="cf_to_saliva_color_change_max_value" placeholder="Enter  Max Value" required>
              </div>
                
            

     </div><!-- End of <div class="form-group form-group-sm" id="div_cf_to_saliva" -->




	     <div class="form-group form-group-sm">
        

                <div class="col-sm-3 text-center">
                   <label class="control-label" for="test_name_and_method" style="color:#00008B;"><span id="cf_to_saliva_staining_test_name_label" style="display: none;"> Color Fastness to Saliva </span><span id="cf_to_saliva_staining_test_method" style="display: none;">(DIN V 53160-1) </span>
                   </label>
                </div>
             
                <div class="col-sm-2 text-center">
                        
                        <label class="control-label" for="description_or_type" style="color:#00008B;">Staining</label>


                        <input type="hidden" class="form-control" id="test_method_for_cf_to_saliva_staining" name="test_method_for_cf_to_saliva_staining" value="DIN V 53160-1" >
                        
                </div>

                  <div class="col-sm-1 text-center">
                     <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
                </div> 

                <div class="col-sm-1 text-center">
                     <select  class="form-control" id="cf_to_saliva_staining_tolerance_range_math_operator" name="cf_to_saliva_staining_tolerance_range_math_operator" onchange="cf_to_saliva_staining_cal()">
                      <option value="">Select CF To Saliva Staining Math Operator</option>
                      <option value="≥">≥</option>
                      <option value="≤"> ≤ </option>
                      <option value=">"> > </option>
	                  <option value="<"> < </option>
                     </select>
                </div>


                <div class="col-sm-1 text-center">
                   <select  class="form-control" id="cf_to_saliva_staining_tolerance_value" name="cf_to_saliva_staining_tolerance_value" onchange="cf_to_saliva_staining_cal()">
                      <option value="">Select Tolerance Value</option>
                      <option value="1.0">1</option>
                      <option value="1.5">1-2</option>
                      <option value="2.0"> 2 </option>
                      <option value="2.5"> 2-3 </option>
                      <option value="3.0">3</option>
                      <option value="3.5">3-4</option>
                      <option value="4.0"> 4 </option>
                      <option value="4.5"> 4-5 </option>
                      <option value="5.0"> 5 </option>
                  </select>
                </div>

               

               
              <div class="col-sm-1" for="unit">
                 <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
                 <input type="hidden" class="form-control" id="uom_of_cf_to_saliva_staining" name="uom_of_cf_to_saliva_staining" value="" >
              </div>

                
              <div class="col-sm-1 text-center" for="min_value">
                 <input type="text" class="form-control" id="cf_to_saliva_staining_staining_min_value" name="cf_to_saliva_staining_staining_min_value" placeholder="Enter  Min Value" required>
                 
              </div>
                  
              <div class="col-sm-1 text-center">
                  
                    <input type="text" class="form-control" id="cf_to_saliva_staining_max_value" name="cf_to_saliva_staining_max_value" placeholder="Enter  Max Value" required>
              </div>
                
            

      </div><!-- End of <div class="form-group form-group-sm" id="div_cf_to_saliva" style="display: none"-->
 </div> <!-- End of <div class="form-group form-group-sm" id="div_cf_to_saliva" style="display: none"> -->


 

 <div class="form-group form-group-sm" id="div_cf_to_chlorinated_water" style="display: none">
        

                <div class="col-sm-3 text-center">
                   <label class="control-label" for="test_name_and_method" style="color:#00008B;"><span id="cf_to_chlorinated_water_color_change_test_name_label">Color Fastness to Chlorinated Water</span><span id="cf_to_chlorinated_water_color_change_test_method">(ISO 105 E03)</span>
                   </label>
                </div>
             
                <div class="col-sm-2 text-center">
                        
                        <label class="control-label" for="description_or_type" style="color:#00008B;">Color Change</label>

                        <input type="hidden" class="form-control" id="test_method_for_cf_to_chlorinated_water_color_change" name="test_method_for_cf_to_chlorinated_water_color_change" value="ISO 105 E03" >
                        
                </div>

                  <div class="col-sm-1 text-center">
                     <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
                </div>

                 <div class="col-sm-1 text-center">
                  
                   
                       <select  class="form-control" id="cf_to_chlorinated_water_color_change_tolerance_range_math_op" name="cf_to_chlorinated_water_color_change_tolerance_range_math_op" onchange="cf_to_chlorinated_water_color_change_cal()">
                            <option value="">Select CF To Chlorinated Water Color Change Math Operator</option>
                            <option value="≥">≥</option>
                            <option value="≤"> ≤ </option>
                            <option value=">"> > </option>
	                        <option value="<"> < </option>
                      </select>

                </div>


                <div class="col-sm-1 text-center">
                       <select  class="form-control" id="cf_to_chlorinated_water_color_change_tolerance_value" name="cf_to_chlorinated_water_color_change_tolerance_value" onchange="cf_to_chlorinated_water_color_change_cal()">
                          <option value="">Select Tolerance Value</option>
                          <option value="1.0">1</option>
                          <option value="1.5">1-2</option>
                          <option value="2.0"> 2 </option>
                          <option value="2.5"> 2-3 </option>
                          <option value="3.0">3</option>
                          <option value="3.5">3-4</option>
                          <option value="4.0"> 4 </option>
                          <option value="4.5"> 4-5 </option>
                          <option value="5.0"> 5 </option>
                      </select>
                </div>

               

               
              <div class="col-sm-1" for="unit">
                 <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
                  <input type="hidden" class="form-control" id="uom_of_cf_to_chlorinated_water_color_change" name="uom_of_cf_to_chlorinated_water_color_change" value="" >
              </div>

                
              <div class="col-sm-1 text-center" for="min_value">

                     <input type="text" class="form-control" id="cf_to_chlorinated_water_color_change_min_value" name="cf_to_chlorinated_water_color_change_min_value" placeholder="Enter  Min Value" required>
                 
              </div>
                  
              <div class="col-sm-1 text-center">
                  
                     <input type="text" class="form-control" id="cf_to_chlorinated_water_color_change_max_value" name="cf_to_chlorinated_water_color_change_max_value" placeholder="Enter  Max Value" required>
              </div>
                
            

     </div><!-- End of <div class="form-group form-group-sm" cf_to_oxidative_bleach_damage_color_change-->


  
 <div class="form-group form-group-sm" id="div_cf_to_chlorine_bleach" style="display: none">
        

                <div class="col-sm-3 text-center">
                   <label class="control-label" for="test_name_and_method" style="color:#00008B;"><span id="cf_to_cholorine_bleach_color_change_test_name_label">Color Fastness to Chlorine Bleach</span> <span id="cf_to_cholorine_bleach_color_change_test_method">(ISO 105 N01)</span>
                   </label>
                </div>
             
                <div class="col-sm-2 text-center">
                        
                        <label class="control-label" for="description_or_type" style="color:#00008B;">Color Change</label>


                         <input type="hidden" class="form-control" id="test_method_for_cf_to_cholorine_bleach_color_change" name="test_method_for_cf_to_cholorine_bleach_color_change" value="ISO 105 N01" >
                        
                </div>

                  <div class="col-sm-1 text-center">
                     <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
                </div>
                
                 <div class="col-sm-1 text-center">
                  
                   
                       <select  class="form-control" id="cf_to_cholorine_bleach_color_change_tolerance_range_math_op" name="cf_to_cholorine_bleach_color_change_tolerance_range_math_op" onchange="cf_to_cholorine_bleach_color_change_cal()">
                          <option value="">Select CF To Cholorine Bleach Color Change Math Operator</option>
                          <option value="≥">≥</option>
                          <option value="≤"> ≤ </option>
                          <option value=">"> > </option>
	                      <option value="<"> < </option>
                       </select>

                </div>


                <div class="col-sm-1 text-center">
                        <select  class="form-control" id="cf_to_cholorine_bleach_color_change_tolerance_value" name="cf_to_cholorine_bleach_color_change_tolerance_value" onchange="cf_to_cholorine_bleach_color_change_cal()">
                            <option value="">Select Tolerance Value</option>
                            <option value="1.0">1</option>
                            <option value="1.5">1-2</option>
                            <option value="2.0"> 2 </option>
                            <option value="2.5"> 2-3 </option>
                            <option value="3.0">3</option>
                            <option value="3.5">3-4</option>
                            <option value="4.0"> 4 </option>
                            <option value="4.5"> 4-5 </option>
                            <option value="5.0"> 5 </option>
                        </select>
                </div>

               

               
              <div class="col-sm-1" for="unit">
                 <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
                   <input type="hidden" class="form-control" id="uom_of_cf_to_cholorine_bleach_color_change" name="uom_of_cf_to_cholorine_bleach_color_change" value="" >
              </div>

                
              <div class="col-sm-1 text-center" for="min_value">
                <input type="text" class="form-control" id="cf_to_cholorine_bleach_color_change_min_value" name="cf_to_cholorine_bleach_color_change_min_value" placeholder="Enter  Min Value" required>
                 
              </div>
                  
              <div class="col-sm-1 text-center">
                  
                      <input type="text" class="form-control" id="cf_to_cholorine_bleach_color_change_max_value" name="cf_to_cholorine_bleach_color_change_max_value" placeholder="Enter  Max Value" required>
              </div>
                
            

     </div><!-- End of <div class="form-group form-group-sm" id="div_cf_to_chlorine_bleach" style="display: none"-->


     <div class="form-group form-group-sm" id="div_cf_to_peroxide_bleach" style="display: none">
        

                <div class="col-sm-3 text-center">
                   <label class="control-label" for="test_name_and_method" style="color:#00008B;"><span id="cf_to_peroxide_bleach_color_change_test_name_label">Color Fastness to Peroxide Bleach </span><span id="cf_to_peroxide_bleach_color_change_test_method">(ISO 105 N02)</span>
                   </label>
                </div>
             
                <div class="col-sm-2 text-center">
                        
                        <label class="control-label" for="description_or_type" style="color:#00008B;">Color Change</label>

                        <input type="hidden" class="form-control" id="test_method_for_cf_to_peroxide_bleach_color_change" name="test_method_for_cf_to_peroxide_bleach_color_change" value="ISO 105 N02" >
                        
                </div>
                
                  <div class="col-sm-1 text-center">
                     <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
                </div>

                 <div class="col-sm-1 text-center">
                  
                   
                       <select  class="form-control" id="cf_to_peroxide_bleach_color_change_tolerance_range_math_operator" name="cf_to_peroxide_bleach_color_change_tolerance_range_math_operator" onchange="cf_to_peroxide_bleach_cal()">
                          <option value="">Select CF To Peroxide Bleach Color Change Math Operator</option>
                          <option value="≥">≥</option>
                          <option value="≤"> ≤ </option>
                          <option value=">"> > </option>
	                      <option value="<"> < </option>
                      </select>

                </div>


                <div class="col-sm-1 text-center">
                         <select  class="form-control" id="cf_to_peroxide_bleach_color_change_tolerance_value" name="cf_to_peroxide_bleach_color_change_tolerance_value" onchange="cf_to_peroxide_bleach_cal()">
                            <option value="">Select Tolerance Value</option>
                            <option value="1.0">1</option>
                            <option value="1.5">1-2</option>
                            <option value="2.0"> 2 </option>
                            <option value="2.5"> 2-3 </option>
                            <option value="3.0">3</option>
                            <option value="3.5">3-4</option>
                            <option value="4.0"> 4 </option>
                            <option value="4.5"> 4-5 </option>
                            <option value="5.0"> 5 </option>
                        </select>
                </div>

               

               
              <div class="col-sm-1" for="unit">
                 <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
                    <input type="hidden" class="form-control" id="uom_of_cf_to_peroxide_bleach_color_change" name="uom_of_cf_to_peroxide_bleach_color_change" value="" >
              </div>

                
              <div class="col-sm-1 text-center" for="min_value">
                <input type="text" class="form-control" id="cf_to_peroxide_bleach_color_change_min_value" name="cf_to_peroxide_bleach_color_change_min_value" placeholder="Enter  Min Value" required>
                 
              </div>
                  
              <div class="col-sm-1 text-center">
                  
                       <input type="text" class="form-control" id="cf_to_peroxide_bleach_color_change_max_value" name="cf_to_peroxide_bleach_color_change_max_value" placeholder="Enter  Max Value" required>
              </div>
                
            

     </div><!-- End of <div class="form-group form-group-sm" id="div_cf_to_peroxide_bleach" style="display: none"-->



      <div class="form-group form-group-sm" id="div_cross_staining" style="display: none">
        

                <div class="col-sm-3 text-center">
                   <label class="control-label" for="test_name_and_method" style="color:#00008B;"><span id="cross_staining_test_name_label">Cross Staining</span> <span id="cross_staining_test_method"></span>
                   </label>
                </div>
             
                <div class="col-sm-2 text-center">
                        
                        <label class="control-label" for="description_or_type" style="color:#00008B;">Staining</label>

                        <input type="hidden" class="form-control" id="test_method_for_cross_staining" name="test_method_for_cross_staining" value="Null" >
                        
                </div>

                <div class="col-sm-1 text-center">
                     <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
                </div>

                 <div class="col-sm-1 text-center">
                  
                   
                      <select  class="form-control" id="cross_staining_tolerance_range_math_operator" name="cross_staining_tolerance_range_math_operator" onchange="cross_staining_cal()">
                        <option value="">Select Cross Staining Math Operator</option>
                        <option value="≥">≥</option>
                        <option value="≤"> ≤ </option>
                        <option value=">"> > </option>
	                    <option value="<"> < </option>
                      </select>

                </div>


                <div class="col-sm-1 text-center">
                       <select  class="form-control" id="cross_staining_tolerance_value" name="cross_staining_tolerance_value" onchange="cross_staining_cal()">
                            <option value="">Select Tolerance Value</option>
                            <option value="1.0">1</option>
                            <option value="1.5">1-2</option>
                            <option value="2.0"> 2 </option>
                            <option value="2.5"> 2-3 </option>
                            <option value="3.0">3</option>
                            <option value="3.5">3-4</option>
                            <option value="4.0"> 4 </option>
                            <option value="4.5"> 4-5 </option>
                            <option value="5.0"> 5 </option>
                      </select>
                </div>

              

               
              <div class="col-sm-1" for="unit">
                 <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
                     <input type="hidden" class="form-control" id="uom_of_cross_staining" name="uom_of_cross_staining" value="" >
              </div>

                
              <div class="col-sm-1 text-center" for="min_value">
                 <input type="text" class="form-control" id="cross_staining_min_value" name="cross_staining_min_value" placeholder="Enter  Min Value" required>
                 
              </div>
                  
              <div class="col-sm-1 text-center">
                  
                       <input type="text" class="form-control" id="cross_staining_max_value" name="cross_staining_max_value" placeholder="Enter  Max Value" required>
              </div>
                
            

      </div><!-- End of <div class="form-group form-group-sm" id="div_cross_staining" style="display: none"-->


       
    <div class="form-group form-group-sm" id="div_ph" style="display: none">
       <div class="form-group form-group-sm">
        

                <div class="col-sm-3 text-center">
                   <label class="control-label" for="test_name_and_method" style="color:#00008B;"><span id="ph_test_name_label">pH</span> <span id="ph_test_method">(ISO 3071)</span>
                   </label>
                </div>
             
                <div class="col-sm-2 text-center">
                        
                        <!-- <label class="control-label" for="description_or_type" style="color:#00008B;"></label> -->
                        <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>

                         <input type="hidden" class="form-control" id="test_method_for_ph" name="test_method_for_ph" value="ISO 3071" >
                </div>

                 <div class="col-sm-1 text-center">
                     <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
                </div>

                 <div class="col-sm-1 text-center">
                  
                   <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
                    <!-- <select  class="form-control" id="ph_value_tolerance_range_math_operator" name="ph_value_tolerance_range_math_operator" onchange="ph_value_cal_without_value()">
                      <option value="">Select Ph Value Math Operator</option>
                      <option value="≥">≥</option>
                      <option value="≤"> ≤ </option>
                      <option value=">"> > </option>
	                  <option value="<"> < </option>
                   </select> -->

                </div>


                <div class="col-sm-1 text-center">
                      <!--Add Input/Select Field Here No Dive Only Input/Select/Radio Button/Checkbox/Textarea -->
                  <!-- <input type="text" class="form-control" id="ph_value_tolerance_value" name="ph_value_tolerance_value" placeholder="Enter Tolerance Value" onchange="ph_value_cal_without_value()" required>
 -->
                  
                      <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>

                       <input type="hidden" class="form-control" id="ph_value_tolerance_range_math_operator" name="ph_value_tolerance_range_math_operator" value="0" >

                        <input type="hidden" class="form-control" id="ph_value_tolerance_value" name="ph_value_tolerance_value" value="0" >

                   <!-- <select  class="form-control" id="ph_value_tolerance_value" name="ph_value_tolerance_value" onchange="ph_value_cal_without_value()">
                      <option value="">Select Ph Value Math Operator</option>
                      <option value="5">5</option>
                      <option value="5.5"> 5-6 </option>
                      <option value="6"> 6 </option>
	                  <option value="6.5">6-7 </option>
	                  <option value="7"> 7 </option>
                   </select> -->
                </div>

                

               
              <div class="col-sm-1" for="unit">
                 <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
                  <input type="hidden" class="form-control" id="uom_of_ph_value" name="uom_of_ph_value" value="%" >
              </div>

                
              <div class="col-sm-1 text-center" for="min_value">
                  <input type="text" class="form-control" id="ph_value_min_value" name="ph_value_min_value" placeholder="Enter  Min Value" required>
                 
              </div>
                  
              <div class="col-sm-1 text-center">
                  <input type="text" class="form-control" id="ph_value_max_value" name="ph_value_max_value" placeholder="Enter  Max Value" required>
              </div>
                
            

     </div><!-- End of <div class="form-group form-group-sm" ph_value-->

   </div>  <!-- End of <div class="form-group form-group-sm" id="div_ph" style="display: none"> -->					




</div>   <!-- END OF <div class="full_page_load" id="full_page_load" style="display :none"> -->




						<div class="form-group form-group-sm">
								<div class="col-sm-offset-4 col-sm-5">
									<button type="button" class="btn btn-primary" onClick="sending_data_of_defining_qc_standard_for_washing_process_form_for_saving_in_database()">Submit</button>
									<button type="reset" class="btn btn-success">Reset</button>
								</div>
						</div>

				</form>

		</div> <!-- End of <div class="panel panel-default"> -->

</div> <!-- End of <div class="col-sm-12 col-md-12 col-lg-12"> -->