<?php
session_start();
require_once("../login/session.php");
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
<script type='text/javascript' src='process_program/defining_qc_standard_for_curing_process_form_validation.js'></script>
<script type='text/javascript' src='process_program/calculate_data_for_standards.js'></script>

<style>

.form-group		/* This is for reducing Gap among Form's Fields */
{

	margin-bottom: 5px;

}

</style>

<script>


$('#test_method_for_resistance_to_surface_wetting_before_wash').on('change', function(){
    $('#resistance_to_surface_wetting_before_wash_tolerance_value').html('');
    if($('#test_method_for_resistance_to_surface_wetting_before_wash').val()=="ISO 4920"){

    	$('#resistance_to_surface_wetting_before_wash_tolerance_value').append('<option value="1">1</option>');
        $('#resistance_to_surface_wetting_before_wash_tolerance_value').append('<option value="1.5">1-2</option>');
        $('#resistance_to_surface_wetting_before_wash_tolerance_value').append('<option value="2">2</option>');
        $('#resistance_to_surface_wetting_before_wash_tolerance_value').append('<option value="2.5">2-3</option>');
        $('#resistance_to_surface_wetting_before_wash_tolerance_value').append('<option value="3">3</option>');
        $('#resistance_to_surface_wetting_before_wash_tolerance_value').append('<option value="3.5">3-4</option>');
        $('#resistance_to_surface_wetting_before_wash_tolerance_value').append('<option value="4">4</option>');
        $('#resistance_to_surface_wetting_before_wash_tolerance_value').append('<option value="4.5">4-5</option>');
        $('#resistance_to_surface_wetting_before_wash_tolerance_value').append('<option value="5">5</option>');

    }else{

    	
        $('#resistance_to_surface_wetting_before_wash_tolerance_value').append('<option value="50">50</option>');
        $('#resistance_to_surface_wetting_before_wash_tolerance_value').append('<option value="70">60</option>');
        $('#resistance_to_surface_wetting_before_wash_tolerance_value').append('<option value="70">70</option>');
        $('#resistance_to_surface_wetting_before_wash_tolerance_value').append('<option value="75">75</option>');
        $('#resistance_to_surface_wetting_before_wash_tolerance_value').append('<option value="80">80</option>');
        $('#resistance_to_surface_wetting_before_wash_tolerance_value').append('<option value="90">90</option>'); 
        $('#resistance_to_surface_wetting_before_wash_tolerance_value').append('<option value="95">95</option>'); 
        $('#resistance_to_surface_wetting_before_wash_tolerance_value').append('<option value="100">100</option>'); 
        
    }
});



$('#test_method_for_resistance_to_surface_wetting_after_one_wash').on('change', function(){
    $('#resistance_to_surface_wetting_after_one_wash_tolerance_value').html('');
    if($('#test_method_for_resistance_to_surface_wetting_after_one_wash').val()=="ISO 4920"){

        $('#resistance_to_surface_wetting_after_one_wash_tolerance_value').append('<option value="1">1</option>');
        $('#resistance_to_surface_wetting_after_one_wash_tolerance_value').append('<option value="1.5">1-2</option>');
        $('#resistance_to_surface_wetting_after_one_wash_tolerance_value').append('<option value="2">2</option>');
        $('#resistance_to_surface_wetting_after_one_wash_tolerance_value').append('<option value="2.5">2-3</option>');
        $('#resistance_to_surface_wetting_after_one_wash_tolerance_value').append('<option value="3">3</option>');
        $('#resistance_to_surface_wetting_after_one_wash_tolerance_value').append('<option value="3.5">3-4</option>');
        $('#resistance_to_surface_wetting_after_one_wash_tolerance_value').append('<option value="4">4</option>');
        $('#resistance_to_surface_wetting_after_one_wash_tolerance_value').append('<option value="4.5">4-5</option>');
        $('#resistance_to_surface_wetting_after_one_wash_tolerance_value').append('<option value="5">5</option>');

    }else{

        $('#resistance_to_surface_wetting_after_one_wash_tolerance_value').append('<option value="50">50</option>');
        $('#resistance_to_surface_wetting_after_one_wash_tolerance_value').append('<option value="70">60</option>');
        $('#resistance_to_surface_wetting_after_one_wash_tolerance_value').append('<option value="70">70</option>');
        $('#resistance_to_surface_wetting_after_one_wash_tolerance_value').append('<option value="75">75</option>');
        $('#resistance_to_surface_wetting_after_one_wash_tolerance_value').append('<option value="80">80</option>');
        $('#resistance_to_surface_wetting_after_one_wash_tolerance_value').append('<option value="90">90</option>'); 
        $('#resistance_to_surface_wetting_after_one_wash_tolerance_value').append('<option value="95">95</option>'); 
        $('#resistance_to_surface_wetting_after_one_wash_tolerance_value').append('<option value="100">100</option>'); 
       
    }
});


$('#test_method_for_resistance_to_surface_wetting_after_five_wash').on('change', function(){
    $('#resistance_to_surface_wetting_after_five_wash_tolerance_value').html('');
    if($('#test_method_for_resistance_to_surface_wetting_after_five_wash').val()=="ISO 4920"){

        $('#resistance_to_surface_wetting_after_five_wash_tolerance_value').append('<option value="1">1</option>');
        $('#resistance_to_surface_wetting_after_five_wash_tolerance_value').append('<option value="1.5">1-2</option>');
        $('#resistance_to_surface_wetting_after_five_wash_tolerance_value').append('<option value="2">2</option>');
        $('#resistance_to_surface_wetting_after_five_wash_tolerance_value').append('<option value="2.5">2-3</option>');
        $('#resistance_to_surface_wetting_after_five_wash_tolerance_value').append('<option value="3">3</option>');
        $('#resistance_to_surface_wetting_after_five_wash_tolerance_value').append('<option value="3.5">3-4</option>');
        $('#resistance_to_surface_wetting_after_five_wash_tolerance_value').append('<option value="4">4</option>');
        $('#resistance_to_surface_wetting_after_five_wash_tolerance_value').append('<option value="4.5">4-5</option>');
        $('#resistance_to_surface_wetting_after_five_wash_tolerance_value').append('<option value="5">5</option>');

    }else{

        $('#resistance_to_surface_wetting_after_five_wash_tolerance_value').append('<option value="50">50</option>');
        $('#resistance_to_surface_wetting_after_five_wash_tolerance_value').append('<option value="70">60</option>');
        $('#resistance_to_surface_wetting_after_five_wash_tolerance_value').append('<option value="70">70</option>');
        $('#resistance_to_surface_wetting_after_five_wash_tolerance_value').append('<option value="75">75</option>');
        $('#resistance_to_surface_wetting_after_five_wash_tolerance_value').append('<option value="80">80</option>');
        $('#resistance_to_surface_wetting_after_five_wash_tolerance_value').append('<option value="90">90</option>'); 
        $('#resistance_to_surface_wetting_after_five_wash_tolerance_value').append('<option value="95">95</option>'); 
        $('#resistance_to_surface_wetting_after_five_wash_tolerance_value').append('<option value="100">100</option>'); 
       
    }
});



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

function appearance_after_wash_fabric_check()
{
         var checkbox = document.getElementById("test_method_for_appearance_after_wash_fabric");
         var appearance_after_wash_fabric = document.getElementById("div_appearance_after_wash_fabric");
         var appearance_after_wash_garments = document.getElementById("div_appearance_after_wash_garments");
         if(checkbox.checked == true)
         {
            appearance_after_wash_fabric.style.display = "block";
            appearance_after_wash_garments.style.display = "none";
         }
         else{
            appearance_after_wash_fabric.style.display = "none";

         }
}

function appearance_after_wash_garments_check()
{
         var checkbox = document.getElementById("test_method_for_appearance_after_wash_garments");
         var appearance_after_wash_garments = document.getElementById("div_appearance_after_wash_garments");
         var appearance_after_wash_fabric = document.getElementById("div_appearance_after_wash_fabric");

         if(checkbox.checked == true)
         {
            appearance_after_wash_garments.style.display = "block";
            appearance_after_wash_fabric.style.display = "none";

         }
         else{
            appearance_after_wash_garments.style.display = "none";
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
			 			    

			 				document.getElementById('version_number').innerHTML=data;
			 				
							
							
							
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
   // alert(version_details);
  var splitted_version_details= version_details.split('?fs?');

/*  document.getElementById('version_name').value=splitted_version_details[0];
*/  document.getElementById('color').value=splitted_version_details[1];
  document.getElementById('finish_width_in_inch').value=splitted_version_details[2]; 
  document.getElementById('customer_name').value=splitted_version_details[3]; 
  document.getElementById('customer_id').value=splitted_version_details[5];
  document.getElementById('standard_for_which_process').value='Curing'; 

   var value_for_data= 'customer_id='+splitted_version_details[5];

   $.ajax({
               url: 'process_program/return_test_name_method.php',
               dataType: 'text',
               type: 'post',
               contentType: 'application/x-www-form-urlencoded',
               data: value_for_data,
                     
               success: function( data, textStatus, jQxhr )
               {       
                      
                  //  alert(data);
                    var split_all_data= data.split('method');
                    var data= split_all_data[0];
                    var test_method_id=split_all_data[1];
                    var test_method_name=split_all_data[2];

                  
                    var test_method_id= test_method_id.split(',');

                    var test_method_for_all='';


                    $("#checking_data").val(data);
                    alert(data);

                    var splitted_data= data.split('?fs?');


                    if(splitted_data.includes('1') && $('#div_cf_to_rubbing').length !== 0 )  
                     {
                        
                        test_method_for_all+=test_method_id[splitted_data.indexOf('1')]+',';
                    
                        $(".full_page_load").show();
                        $("#div_cf_to_rubbing").show();


                        $("#for_cf_to_rubbing_test_name_label").html('Color Fastness to Rubbing');
                        
                     }

                    


                     if(splitted_data.includes('2') && $('#div_dimensional_stability_to_washing').length !== 0) 
                     {
                        
                        test_method_for_all+=test_method_id[splitted_data.indexOf('2')]+',';
                      
                        $(".full_page_load").show();
                        $("#div_dimensional_stability_to_washing").show();
                        
                     }

                     if(splitted_data.includes('74') && $('#div_yarn_count').length !== 0) 
                     {
                        
                        test_method_for_all+=test_method_id[splitted_data.indexOf('2')]+',';
                      
                        $(".full_page_load").show();
                        $("#div_yarn_count").show();
                        
                     }

                     if(splitted_data.includes('3') && $('#div_appearance_after_wash_full').length !== 0 )  
                     {
                        
                        test_method_for_all+=test_method_id[splitted_data.indexOf('3')]+',';
                    
                        $(".full_page_load").show();
                        $("#div_appearance_after_wash_full").show();

                        // $("#appearance_after_wash_label").html(test_name_method[i]);
                        // $("#appearance_after_wash_test_method").hide(); 
                        
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
                     
                      alert(test_method_for_all);
               },
               error: function( jqXhr, textStatus, errorThrown )
               {       
                     
                     alert(errorThrown);
               }
         }); // End of $.ajax({

}/* End of function fill_up_qc_standard_additional_info(version_details)*/

 function sending_data_of_defining_qc_standard_for_curing_process_form_for_saving_in_database()
 {


       var validate = Curing_Form_Validation();
      
       var url_encoded_form_data = $("#defining_qc_standard_for_curing_process_form").serialize(); //This will read all control elements value of the form	
      //  alert(url_encoded_form_data);
      //  exit();      
       if(validate != false)
	   {


		  	 $.ajax({
			 		url: 'process_program/defining_qc_standard_for_curing_form_saving.php',
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

 }//End of function sending_data_of_defining_qc_standard_for_curing_process_form_for_saving_in_database()


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

function delete_curing_process(curing_id)
{
   var value_for_data= 'curing_id='+curing_id;
    
				$.ajax({
						url: 'process_program/deleting_curing_process_standard.php',
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
				<div class="panel-heading" style="color:#191970;"><b>Model For Curing Process</b></div> 

				<div class="row" data-toggle="collapse" data-target="#search_form_collpapsible_div_1" onClick="change_up_down_arrow_icon_1(this.childNodes[5].childNodes[1].id)">
					<div style="padding-right:13px;text-align:center" id='test'> <i class="glyphicon glyphicon-chevron-up text-right"  id='panel_heading_icon_1'></i></div>
				</div>  
				
				<div id='search_form_collpapsible_div_1' class="collapse in"> 
					
					<form class="form-horizontal" action="" style="margin-top:10px;" name="defining_qc_standard_for_curing_process_form_view" id="defining_qc_standard_for_curing_process_form_view" data-toggle="collapse" data-target="#search_form_collpapsible_div">
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
									$standard_for_which_process='Curing';
									$sql_for_curing = "SELECT * FROM `model_defining_qc_standard_for_curing_process` 
																WHERE `process_name`='$standard_for_which_process' and 
																`customer_id` = '$customer_id' and
																`customer_name` = '$customer_name' and 
																`version_number`='$version_number' and
											`process_technique`= '$process_technique_name'  ORDER BY id ASC";

									$res_for_curing = mysqli_query($con, $sql_for_curing);

									while ($row = mysqli_fetch_assoc($res_for_curing))
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

											<button type="submit" id="edit_model_curing" name="edit_model_curing"  class="btn btn-info btn-xs" onclick="load_page('auto_sync/edit_model_defining_qc_standard_for_curing_process.php?model_curing_id=<?php echo $row['id'] ?>')"> Edit </button>

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
				<div class="panel-heading" style="color:#191970;"><b>Defining Qc Standard For Curing Process</b></div> <!-- This will create a upper block for FORM (Just Beautification) -->


                  <div class="row" data-toggle="collapse" data-target="#search_form_collpapsible_div_1" onClick="change_up_down_arrow_icon_1(this.childNodes[5].childNodes[1].id)">
                         

                         <div align="right" style="padding-right:13px;" id='test'> <i class="glyphicon glyphicon-chevron-up text-right"  id='panel_heading_icon_1'></i>
                       </div>


                  </div>   <!-- End of <div class="row" data-toggle="collapse" data-target="#search_form_collpapsible_div" > -->

                  <div id='search_form_collpapsible_div_1' class="collapse in"> <!-- For Making Collapsible Section -->

                        
                   <form class="form-horizontal" action="" style="margin-top:10px;" name="defining_qc_standard_for_curing_process_form_view" id="defining_qc_standard_for_curing_process_form_view" data-toggle="collapse" data-target="#search_form_collpapsible_div">

                       <div class="panel-heading" style="color:#191970;"><b> Curing Standard Process List</b></div> <!-- This will create a upper block for FORM (Just Beautification) -->

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
                                                 $standard_for_which_process='Curing';
                                                 $sql_for_curing = "SELECT * FROM `defining_qc_standard_for_curing_process` 										  
                                                 WHERE `standard_for_which_process`='$standard_for_which_process' and `pp_number` = '$pp_number' and `version_id`='$version_id'  ORDER BY id ASC";

                                                 $res_for_curing = mysqli_query($con, $sql_for_curing);

                                                 while ($row = mysqli_fetch_assoc($res_for_curing)) 
                                                 {
                                                   $pp_number=$row['pp_number'];
                                                   $version_number=$row['version_number'];
                                                   $color=$row['color'];
                                                   $finish_width_in_inch=$row['finish_width_in_inch'];
                                   
                                                   $sql_for_pp_style = "SELECT style_name FROM adding_process_to_version WHERE pp_number = '$pp_number' AND version_name = '$version_number' AND 
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
                                           
                                             
                                            <button type="button" id="edit_curing" name="edit_curing"  class="btn btn-primary btn-xs" onclick="load_page('process_program/edit_defining_qc_standard_for_curing_process.php?curing_id=<?php echo $row['id'] ?>')"> Edit </button>
                                            
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
                                                      <button type="button" id="delete_curing" name="delete_curing"  class="btn btn-danger btn-xs" onclick="delete_curing_process(<?php echo $row['id'];?>)" > Delete </button>
                                                   <?php
                                                } 
                                          ?>
                                            
                                            

                                            
                                              <!-- <button type="submit" id="delete_curing" name="delete_curing"  class="btn btn-danger btn-xs" onclick="load_page('process_program/deleting_curing_process_standard.php?curing_id=<?php echo $row['id'] ?>')"> Delete </button> -->
                                      </td>
                                     <?php
                                                   
                                     $s1++;
                                                      }
                                      ?> 
                                  </tr>
                               </tbody>
                              </table>

                         </div>

                  </form>    <!-- End of <form class="form-horizontal" action="" style="margin-top:10px;" name="defining_qc_standard_for_curing_process_form" id="defining_qc_standard_for_curing_process_form"> -->

            </div>

            <?php
         }
            ?>



<form class="form-horizontal" action="" style="margin-top:10px;" name="defining_qc_standard_for_curing_process_form" id="defining_qc_standard_for_curing_process_form">

<?php
                  // echo $version_number;

                  if (isset($_GET['model_standard'])) 
                  {
                     
                     ?>
                     
                     <input type="hidden" id="model_standard" name="model_standard"  value="model_standard">

                     <input type="hidden" id="finish_width_in_inch" name="finish_width_in_inch"  value="">
                     <input class="form-control" type="hidden" name="pp_number_value" id="pp_number_value" value="">
                     <input type="hidden" id="process_id" name="process_id"  value="proc_9">
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
                     <input type="hidden" id="process_id" name="process_id"  value="proc_9">
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
						<br/>
           
						
      <!-- *********************************** Designing Tabular Formar (Multi-Column Form Elements Here (Start))*********************************** -->

                     <!-- start     <div class="form-group form-group-sm" id="form-group_for_yarn_count_warp_for_tolarance_value"> -->

      <div class="full_page_load" id="full_page_load" style="display :none">



        <div class="form-group form-group-sm">
		     
			    <!-- <div class="col-sm-1 text-center">
					
				</div> -->


				<div class="col-sm-3 text-center">
					<label for="test_name_and_method" style="font-size:12px; color:#000066;">Test Name & Method</label>
					
			          
				</div>
			 
				 <div class="col-sm-1 text-center">
		              <label for="description_or_type" style="font-size:12px; color:#000066;">Direction/Type</label>
		              
		         </div>

	           <div class="col-sm-1 text-center">
		             <!-- Gap Creation -->
		       </div>
		         
		        <div class="col-sm-1 text-center">
		              <label for="value" style="font-size:12px; color:#000066;">Value</label>
		              
		        </div>
	          
	               <!--Add Input/Select Field Here No Dive Only Input/Select/Radio Button/Checkbox/Textarea -->
		         
			   <div class="col-sm-1 text-center">
			         <label for="math_op_value" style="font-size:12px; color:#000066;">Math OP.</label>
			            
			   </div>
		            
		               
		        
	          <div class="col-sm-1 text-center" for="line_creation_between_min_and_max">

	          	<label for="tolerance_value" style="font-size:12px; color:#000066;">Tolerance</label>
	            
	            
	          </div>
		          
	          <div class="col-sm-1 text-center">
	              <label for="min_value" style="font-size:12px; color:#000066;">Unit</label>
	            
	          </div>
		            
		               <!--Add Input/Select Field Here No Dive Only Input/Select/Radio Button/Checkbox/Textarea -->
		          
	          
	          <div class="col-sm-1" for="remaining_two_spans_of_bootstrap">
	          
	             <label for="max_value" style="font-size:12px; color:#000066;">Minimum</label>
	          
	          </div>

	          <div class="col-sm-1">
	          
	             <label for="max_value" style="font-size:12px; color:#000066;">Maximum</label>
	          
	          </div>
		          

       </div><!-- End of <div class="form-group form-group-sm"  -->

          


  <div id="div_cf_to_rubbing" style="display: none">
  

        <div class="form-group form-group-sm">
		    
			<!-- <div class="col-sm-1 text-center">
					
			</div> -->

			<div class="col-sm-3 text-center">
				 <label class="control-label" for="cf_to_rubbing_dry_value" style="color:#00008B; margin-top:23px;"><span id="for_cf_to_rubbing_dry_test_name_label">Color Fastness to Rubbing</span> <span id="cf_to_rubbing_dry_test_method"> (ISO 105 X12)</span></label>
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
				 <label class="hidden" for="cf_to_rubbing_dry_value" style="display: none"><span id="for_cf_to_rubbing_wet_test_name_label"> Color Fastness to Rubbing </span> <span class="hidden" id="cf_to_rubbing_wet_test_method"> (ISO 105 X12)</span></label>
			</div>
			 
			 <div class="col-sm-2 text-center">
	              <!-- <label for="description_or_type" style="font-size:12px; color:#000066;">Description/Type</label> -->
	              <label class="control-label" for="description_or_type" style="color:#00008B;"> Wet </label>
	              <input type="hidden" class="form-control" id="test_method_for_cf_to_rubbing_wet" name="test_method_for_cf_to_rubbing_wet" value="ISO 105 X12">
	              
	         </div>

	         
	         <div class="col-sm-1 text-center">
		            <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
		            <input type="hidden" name="uom_of_cf_to_rubbing_wet" id="uom_of_cf_to_rubbing_wet" value="">
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
            <input type="hidden" id="uom_of_cf_to_rubbing_dry" name="uom_of_cf_to_rubbing_dry"  value="">
          </div>

		        
          <div class="col-sm-1 text-center" for="min_value">

          	<input type="text" class="form-control" id="cf_to_rubbing_wet_min_value" name="cf_to_rubbing_wet_min_value" placeholder="Enter Color Fastness to Rubbing Wet Min Value" required>
             
          </div>
		          
          <div class="col-sm-1 text-center">
              
            <input type="text" class="form-control" id="cf_to_rubbing_wet_max_value" name="cf_to_rubbing_wet_max_value" placeholder="Enter Color Fastness to Rubbing Wet Max Value" required>

           </div>
		            
		        

     </div><!-- End of <div class="form-group form-group-sm" cf_to_rubbing_wet -->

 </div> <!--  End of <div id="div_cf_to_rubbing" style="display: none"> -->




<div id="div_dimensional_stability_to_washing" style="display: none">


       <div class="form-group form-group-sm">
		    

			<div class="col-sm-3 text-center">
				 <label class="control-label" for="dimensional_stability_to_warp_washing_before_iron" style="color:#00008B; margin-top:35px;"><span id="for_dimensional_stability_to_warp_washing_before_iron_test_name_label">Dimensional Stability to Washing</span>
			    <span id="dimensional_stability_to_warp_washing_before_iron_test_method"> (ISO 6330, ISO 5077, 3759)</span>
				 </label>
			</div>
			 
			 <div class="col-sm-2 text-center">
	              
	              <label class="control-label" for="description_or_type" style="color:#00008B;margin-top:35px;"> Warp(Before Iron)</label>

	              <input type="hidden" class="form-control" id="test_method_for_dimensional_stability_to_warp_washing_b_iron" name="test_method_for_dimensional_stability_to_warp_washing_b_iron" value="ISO 6330, ISO 5077, 3759">
	              
	         </div>

	        

	         <div class="col-sm-2 text-center">
	         	  <label class="control-label" for="washing_cycle" style="color:#00008B;margin-top:13px;">Washing Cycle</label>
		          <input type="text" class="form-control" id="washing_cycle_for_warp_for_washing_before_iron" name="washing_cycle_for_warp_for_washing_before_iron" placeholder="Enter Change in Warp for Washing Cycle" required>
		      </div>


		      <!-- <div class="col-sm-1 text-center">
	         	 <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:50px;"/>
		      </div>  -->

		      <div class="col-sm-1 text-center">
	         	 <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:50px;"/>
		      </div>

	         
          <div class="col-sm-1" for="unit">
          	 <hr style="color:#FF0000;border-top: 2px #FF0000; margin-top:20px;"/>
          	 %
            <input type="hidden" id="uom_of_dimensional_stability_to_warp_washing_before_iron" name="uom_of_dimensional_stability_to_warp_washing_before_iron"  value="celcius">
          </div>

		        
          <div class="col-sm-1 text-center" for="min_value">

          	<input type="text" class="form-control" id="dimensional_stability_to_warp_washing_before_iron_min_value" name="dimensional_stability_to_warp_washing_before_iron_min_value" style="color:#00008B;margin-top:35px;" placeholder="Enter Change in Wrp for Washing Before Iron Value Min Value" required>
             
          </div>
		          
          <div class="col-sm-1 text-center">
              
            <input type="text" class="form-control" id="dimensional_stability_to_warp_washing_before_iron_max_value" name="dimensional_stability_to_warp_washing_before_iron_max_value" style="color:#00008B;margin-top:35px;" placeholder="Enter Wrp for Washing Before Iron  Max Value" required>

           </div>
		            
		        

     </div><!-- End of <div class="form-group form-group-sm" dimensional_stability_to_warp_washing_before_iron-->



     <div class="form-group form-group-sm">
		    

			
			<div class="col-sm-3 text-center">
				 <label class="control-label" for="dimensional_stability_to_weft_washing_before_iron" style="display: none"><span id="for_dimensional_stability_to_weft_washing_before_iron_test_name_label">Dimensional Stability to Washing</span>
				<span id="dimensional_stability_to_weft_washing_before_iron_test_method"> (ISO 6330, ISO 5077, 3759)</span>
				 </label>
			</div>
			 
			 <div class="col-sm-2 text-center">
	              
	              <label class="control-label" for="description_or_type" style="color:#00008B;"> Weft(Before Iron)</label>


	              <input type="hidden" class="form-control" id="test_method_for_dimensional_stability_to_weft_washing_b_iron" name="test_method_for_dimensional_stability_to_weft_washing_b_iron" value="ISO 6330, ISO 5077, 3759">
	              
	         </div>

	         
	         <div class="col-sm-2 text-center">
	         	  
		          <input type="text" class="form-control" id="washing_cycle_for_weft_for_washing_before_iron" name="washing_cycle_for_weft_for_washing_before_iron" placeholder="Enter Change in Weft for Washing Cycle" required>
		      </div>


		      <!-- <div class="col-sm-1 text-center">
	         	 <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
		      </div> 
 -->
		      <div class="col-sm-1 text-center">
	         	 <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
		      </div>

	         
          <div class="col-sm-1" for="unit">
          	 %
            <input type="hidden" id="uom_of_dimensional_stability_to_weft_washing_before_iron" name="uom_of_dimensional_stability_to_weft_washing_before_iron"  value="celcius">
          </div>

		        
          <div class="col-sm-1 text-center" for="min_value">

          	<input type="text" class="form-control" id="dimensional_stability_to_weft_washing_before_iron_min_value" name="dimensional_stability_to_weft_washing_before_iron_min_value" style="color:#00008B;" placeholder="Enter Change in Wrp for Washing Before Iron Value Min Value" required>
             
          </div>
		          
          <div class="col-sm-1 text-center">
              
            <input type="text" class="form-control" id="dimensional_stability_to_weft_washing_before_iron_max_value" name="dimensional_stability_to_weft_washing_before_iron_max_value" style="color:#00008B;" placeholder="Enter Wrp for Washing Before Iron  Max Value" required>

           </div>
		            
		        

     </div><!-- End of <div class="form-group form-group-sm" dimensional_stability_to_weft_washing_before_iron-->

  </div>  <!-- End of <div id="div_dimensional_stability_to_washing" style="display: none">  -->  

   


  <div id="div_yarn_count" style="display: none">



      <div class="form-group form-group-sm">
		    
			<!-- <div class="col-sm-1 text-center">
					
			</div> -->

			<div class="col-sm-3 text-center">
				 <label class="control-label" for="warp_yarn_count_value" style="color:#00008B;"><span id="for_warp_yarn_count_test_name_label">Yarn Count</span> <span id="warp_yarn_count_test_method"> (ISO 7211-5)</span></label>
			</div>
			 
			 <div class="col-sm-2 text-center">
	              <!-- <label for="description_or_type" style="font-size:12px; color:#000066;">Description/Type</label> -->
	              <label class="control-label" for="description_or_type" style="color:#00008B;"> Warp </label>

	               <input type="hidden" class="form-control" id="test_method_for_warp_yarn_count" name="test_method_for_warp_yarn_count" value="ISO 7211-5">
	              
	         </div>

	         <div class="col-sm-1 text-center">
		            <input type="text" class="form-control" id="warp_yarn_count_value" name="warp_yarn_count_value" placeholder="Enter Warp Yarn Count Value" onchange="warp_yarn_count_cal()" required>
		         
		     </div>
		        
		         
          <div class="col-sm-1 text-center">
             <select  class="form-control" id="warp_yarn_count_tolerance_range_math_operator" name="warp_yarn_count_tolerance_range_math_operator" onchange="warp_yarn_count_cal()">
                      <option value="">Select Warp Yarn CountTolerance Range Math Operator</option>
                      <option value="+">+</option>
                      <option value="-">-</option>
                      <option value="±">±</option>
               </select>
              
           </div>
	          
	               <!--Add Input/Select Field Here No Dive Only Input/Select/Radio Button/Checkbox/Textarea -->
		          
          <div class="col-sm-1" for="tolerance">

             <input type="text" class="form-control" id="warp_yarn_count_tolerance_value" name="warp_yarn_count_tolerance_value" placeholder="Enter Tolerance Value" onchange="warp_yarn_count_cal()" required>

          </div>

          <div class="col-sm-1" for="unit">
          	<select  class="form-control" id="uom_of_warp_yarn_count_value" name="uom_of_warp_yarn_count_value">
                      <option value="">Select Uom Of Warp Yarn Tensile Properties</option>
                      <option value="Ne">Ne</option>
                      <option value="Nm">Nm</option>
                      <option value="Den">Den</option>
                      <option value="tex">tex</option>
                      <option value="dtex">dtex</option>
            </select>
          </div>

		        
          <div class="col-sm-1 text-center" for="min_value">

          	<input type="text" class="form-control" id="warp_yarn_count_min_value" name="warp_yarn_count_min_value" placeholder="Enter Warp Yarn CountMin Value" required>
             
          </div>
		          
          <div class="col-sm-1 text-center">
              
            <input type="text" class="form-control" id="warp_yarn_count_max_value" name="warp_yarn_count_max_value" placeholder="Enter Warp Yarn CountMax Value" required>

           </div>
		            
		        

     </div><!-- End of <div class="form-group form-group-sm" warp_yarn_count -->




      <div class="form-group form-group-sm" for="weft_yarn_count">
		    
			

			<div class="col-sm-3 text-center">
				 <label class="control-label" for="weft_yarn_count_value" style="display: none"><span id="for_weft_yarn_count_test_name_label">Yarn Count</span><span id="weft_yarn_count_test_method"> (ISO 7211-5)</span></label>
			</div>
			 
			 <div class="col-sm-2 text-center">
	              <!-- <label for="description_or_type" style="font-size:12px; color:#000066;">Description/Type</label> -->
	              <label class="control-label" for="description_or_type" style="color:#00008B;"> Weft </label>

	              <input type="hidden" class="form-control" id="test_method_for_weft_yarn_count" name="test_method_for_weft_yarn_count" value="ISO 7211-5">
	              
	         </div>


	         <div class="col-sm-1 text-center">
		            <input type="text" class="form-control" id="weft_yarn_count_value" name="weft_yarn_count_value" placeholder="Enter weft Yarn Count Value" onchange="weft_yarn_count_cal()" required>
		         
		     </div>
		        
		         
          <div class="col-sm-1 text-center">
             <select  class="form-control" id="weft_yarn_count_tolerance_range_math_operator" name="weft_yarn_count_tolerance_range_math_operator" onchange="weft_yarn_count_cal()">
                      <option value="">Select weft Yarn CountTolerance Range Math Operator</option>
                      <option value="+">+</option>
                      <option value="-">-</option>
                      <option value="±">±</option>
               </select>
              
           </div>
	          
	               <!--Add Input/Select Field Here No Dive Only Input/Select/Radio Button/Checkbox/Textarea -->
		          
          <div class="col-sm-1" for="tolerance">

             <input type="text" class="form-control" id="weft_yarn_count_tolerance_value" name="weft_yarn_count_tolerance_value" placeholder="Enter Tolerance Value" onchange="weft_yarn_count_cal()" required>

          </div>

          <div class="col-sm-1" for="unit">
          	<select  class="form-control" id="uom_of_weft_yarn_count_value" name="uom_of_weft_yarn_count_value">
                      <option value="">Select Uom Of weft Yarn Tensile Properties</option>
                      <option value="Ne">Ne</option>
                      <option value="Nm">Nm</option>
                      <option value="Den">Den</option>
                      <option value="tex">tex</option>
                      <option value="dtex">dtex</option>
            </select>
          </div>

		        
          <div class="col-sm-1 text-center" for="min_value">

          	<input type="text" class="form-control" id="weft_yarn_count_min_value" name="weft_yarn_count_min_value" placeholder="Enter weft Yarn CountMin Value" required>
             
          </div>
		          
          <div class="col-sm-1 text-center">
              
            <input type="text" class="form-control" id="weft_yarn_count_max_value" name="weft_yarn_count_max_value" placeholder="Enter weft Yarn CountMax Value" required>

           </div>
		            
		        

     </div><!-- End of <div class="form-group form-group-sm" weft_yarn_count -->

 </div>  <!-- End of <div id="div_yarn_count" style="display: none"> -->




 
 <div id="div_number_of_threads_per_unit_length" style="display: none">	

     <div class="form-group form-group-sm" for="no_of_threads_in_warp_value">
		  

			<div class="col-sm-3 text-center">
				 <label class="control-label" for="weft_yarn_count_value" style="color:#00008B;"><span id="for_no_of_threads_in_warp_test_name_label">Number of Threads Per Unit Length</span> <span id="no_of_threads_in_warp_test_method">(ISO 7211-2)</span></label>
			</div>
			 
			 <div class="col-sm-2 text-center">
	              <!-- <label for="description_or_type" style="font-size:12px; color:#000066;">Description/Type</label> -->
	              <label class="control-label" for="description_or_type" style="color:#00008B;"> Warp </label>

	               <input type="hidden" class="form-control" id="test_method_for_no_of_threads_in_warp" name="test_method_for_no_of_threads_in_warp" value="ISO 7211-2">
	              
	         </div>

	         
	         <div class="col-sm-1 text-center">
		            <input type="text" class="form-control" id="no_of_threads_in_warp_value" name="no_of_threads_in_warp_value" placeholder="Enter No of Threads in Warp Yarn Count" onchange="no_of_threads_in_warp_cal_for_finishing()" required>
		         
		     </div>
		        
		         
          <div class="col-sm-1 text-center">
             <select  class="form-control" id="no_of_threads_in_warp_tolerance_range_math_operator" name="no_of_threads_in_warp_tolerance_range_math_operator" onchange="no_of_threads_in_warp_cal_for_finishing()">
                      <option value="">Select No of Threads Count Tolerance Range Math Operator</option>
                      <option value="+">+</option>
                      <option value="-">-</option>
                      <option value="±">±</option>
                </select>
              
           </div>
	          
	               <!--Add Input/Select Field Here No Dive Only Input/Select/Radio Button/Checkbox/Textarea -->
		          
          <div class="col-sm-1" for="tolerance">

             <input type="text" class="form-control" id="no_of_threads_in_warp_tolerance_value" name="no_of_threads_in_warp_tolerance_value" placeholder="Enter Tolerance Value" onchange="no_of_threads_in_warp_cal_for_finishing()" required>

          </div>

          <div class="col-sm-1" for="unit">
          	<select  class="form-control" id="uom_of_no_of_threads_in_warp_value" name="uom_of_no_of_threads_in_warp_value">
                      <option value="">Select Uom Of No of Threads in Warp Properties</option>
                      <option value="th/inch">th/inch</option>
                      <option value="th/cm">th/cm</option>
                      
            </select>
          </div>

		        
          <div class="col-sm-1 text-center" for="min_value">

          	<input type="text" class="form-control" id="no_of_threads_in_warp_min_value" name="no_of_threads_in_warp_min_value" placeholder="Enter No of  Threads in Warp Min Value" required>
          </div>
		          
          <div class="col-sm-1 text-center">
              
            <input type="text" class="form-control" id="no_of_threads_in_warp_max_value" name="no_of_threads_in_warp_max_value" placeholder="Enter No of Threads in Warp Max Value" required>

           </div>
		            
		        

     </div><!-- End of <div class="form-group form-group-sm" no_of_threads_in_warp-->



     <div class="form-group form-group-sm" for="no_of_threads_in_weft_value">
		  

			<div class="col-sm-3 text-center">
				 <label class="control-label" for="weft_yarn_count_value" style="display: none"><span id="no_of_threads_in_weft_test_name_label">Number of Threads Per Unit Length</span> <span id="no_of_threads_in_weft_test_method"></span>(ISO 7211-2)</label>
			</div>
			 
			 <div class="col-sm-2 text-center">
	              <!-- <label for="description_or_type" style="font-size:12px; color:#000066;">Description/Type</label> -->
	              <label class="control-label" for="description_or_type" style="color:#00008B;"> Weft </label>
	               <input type="hidden" class="form-control" id="test_method_for_no_of_threads_in_weft" name="test_method_for_no_of_threads_in_weft" value="ISO 7211-2">
	              
	         </div>

	        

	         <div class="col-sm-1 text-center">
		            <input type="text" class="form-control" id="no_of_threads_in_weft_value" name="no_of_threads_in_weft_value" placeholder="Enter No of Threads in Warp Yarn Count" onchange="no_of_threads_in_weft_cal_for_finishing()" required>
		         
		     </div>
		        
		         
          <div class="col-sm-1 text-center">
              <select  class="form-control" id="no_of_threads_in_weft_tolerance_range_math_operator" name="no_of_threads_in_weft_tolerance_range_math_operator" onchange="no_of_threads_in_weft_cal_for_finishing()">
                      <option value="">Select No of Threads Count Tolerance Range Math Operator</option>
                      <option value="+">+</option>
                      <option value="-">-</option>
                      <option value="±">±</option>
                </select>
              
           </div>
	          
	               <!--Add Input/Select Field Here No Dive Only Input/Select/Radio Button/Checkbox/Textarea -->
		          
          <div class="col-sm-1" for="tolerance">

              <input type="text" class="form-control" id="no_of_threads_in_weft_tolerance_value" name="no_of_threads_in_weft_tolerance_value" placeholder="Enter Tolerance Value" onchange="no_of_threads_in_weft_cal_for_finishing()" required>

          </div>

          <div class="col-sm-1" for="unit">
          	 <select  class="form-control" id="uom_of_no_of_threads_in_weft_value" name="uom_of_no_of_threads_in_weft_value" >
                      <option select="selected" value="">Select Uom Of No of Threads in Weft Properties</option>
                      <option value="th/inch">th/inch</option>
                      <option value="th/cm">th/cm</option>
                      
                </select>
          </div>

		        
          <div class="col-sm-1 text-center" for="min_value">

          	<input type="text" class="form-control" id="no_of_threads_in_weft_min_value" name="no_of_threads_in_weft_min_value"  placeholder="Enter No of  Threads in Weft Min Value" required>
          </div>
		          
          <div class="col-sm-1 text-center">
              
            <input type="text" class="form-control" id="no_of_threads_in_weft_max_value" name="no_of_threads_in_weft_max_value" placeholder="Enter No of Threads in Weft Max Value" required>

           </div>
		            
		        

     </div><!-- End of <div class="form-group form-group-sm" no_of_threads_in_weft-->

 </div>  <!-- End of <div id="div_number_of_threads_per_unit_length" style="display: none"> -->



 <div id="div_mass_per_unit_area" style="display: none">

      <div class="form-group form-group-sm" for="mass_per_unit_per_area_value">
		  

			<div class="col-sm-3 text-center">
				 <label class="control-label" for="mass_per_unit_per_area_value" style="color:#00008B;"><span id="for_mass_per_unit_per_area_test_name_label">Mass Per Unit Area</span> <span id="mass_per_unit_per_area_test_method"> (ISO 3801)</span></label>
			</div>
			 
			 <div class="col-sm-2 text-center">
	             
	              <!-- <label class="control-label" for="description_or_type" style="color:#00008B;"> </label> -->
	              <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>

	              <input type="hidden" class="form-control" id="test_method_for_mass_per_unit_per_area" name="test_method_for_mass_per_unit_per_area" value="ISO 3801">

	         </div>

	         

	         <div class="col-sm-1 text-center">
		            <input type="text" class="form-control" id="mass_per_unit_per_area_value" name="mass_per_unit_per_area_value" placeholder="Mass Per Area Value" onchange="mass_per_unit_per_area_cal()" required>
		         
		     </div>
		        
		         
          <div class="col-sm-1 text-center">
              <input type="text" class="form-control" id="mass_per_unit_per_area_tolerance_range_math_operator" name="mass_per_unit_per_area_tolerance_range_math_operator" onchange="mass_per_unit_per_area_cal()" placeholder="For +" required>
              
           </div>
	          
	               <!--Add Input/Select Field Here No Dive Only Input/Select/Radio Button/Checkbox/Textarea -->
		          
          <div class="col-sm-1" for="tolerance">

              <input type="text" class="form-control" id="mass_per_unit_per_area_tolerance_value" name="mass_per_unit_per_area_tolerance_value" onchange="mass_per_unit_per_area_cal()" placeholder="For -" required>

          </div>

          <div class="col-sm-1" for="unit">
          	 <select  class="form-control" id="uom_of_mass_per_unit_per_area_value" name="uom_of_mass_per_unit_per_area_value">
                      <option value="">Select Uom Of Mass Per Unit per Area </option>
                      <option value="gm/m2">gm/m2</option>
                      <option value="oz/yd2 ">oz/yd2 </option>
                      
                </select>
          </div>

		        
          <div class="col-sm-1 text-center" for="min_value">

          	<input type="text" class="form-control" id="mass_per_unit_per_area_min_value" name="mass_per_unit_per_area_min_value" placeholder="Enter Mass Per Unit per Area Min Value" required>
          </div>
		          
          <div class="col-sm-1 text-center">
              
            <input type="text" class="form-control" id="mass_per_unit_per_area_max_value" name="mass_per_unit_per_area_max_value" placeholder="Enter Mass Per Unit per Area Max Value" required>

           </div>
		            
		        

     </div><!-- End of <div class="form-group form-group-sm" no_of_threads_in_warp-->

 </div>  <!-- End of <div id="div_mass_per_unit_area" style="display: none"> -->




  <div id="div_resistance_to_surface_fuzzing_and_pilling" style="display: none"> 


      <div class="form-group form-group-sm" for="mass_per_unit_per_area_value">
		  

			<div class="col-sm-3 text-center">
				 <label class="control-label" for="surface_fuzzing_and_pilling_tolerance_range_math_operator" style="color:#00008B;"><span id="for_surface_fuzzing_and_pilling_test_name_label">Resistance to Surface Fuzzing & Pilling</span> <span id="surface_fuzzing_and_pilling_test_method"> (ISO 12945-2)</span></label>
			</div>
			 
			 <div class="col-sm-2 text-center">
	             
	              <!-- <label class="control-label" for="description_or_type" style="color:#00008B;">  </label> -->
	              <!-- <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/> -->

	              <select  class="form-control" id="description_or_type_for_surface_fuzzing_and_pilling" name="description_or_type_for_surface_fuzzing_and_pilling" >
					<option value="">Select Direction/Type Surface Fuzzing and Pilling</option>
					<option value="Before Wash">Before Wash</option>
					<option value="After Wash"> After Wash </option>
					
				  </select>

	               <input type="hidden" class="form-control" id="test_method_for_surface_fuzzing_and_pilling" name="test_method_for_surface_fuzzing_and_pilling" value="ISO 12945-2">
	         </div>

	        

	         
		         
          <div class="col-sm-1 text-center">
              <select  class="form-control" id="surface_fuzzing_and_pilling_tolerance_range_math_operator" name="surface_fuzzing_and_pilling_tolerance_range_math_operator" onchange="surface_fuzzing_and_pilling_cal()">
				<option value="">Select Surface Fuzzing and Pilling Tolerance Range Math Operator</option>
				<option value="≥">≥</option>
				<option value="≤"> ≤ </option>
				<option value=">"> > </option>
	            <option value="<"> < </option>
			 </select>
              
           </div>
	          
	               <!--Add Input/Select Field Here No Dive Only Input/Select/Radio Button/Checkbox/Textarea -->
		          
          <div class="col-sm-1" for="tolerance">

              <select  class="form-control" id="surface_fuzzing_and_pilling_tolerance_value" name="surface_fuzzing_and_pilling_tolerance_value" onchange="surface_fuzzing_and_pilling_cal()">
					<option value="">Select Surface Fuzzing and Pilling Tolerance Value</option>
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


          <div class="col-sm-1 text-center">
		     <input type="text" class="form-control" id="rubs_for_surface_fuzzing_and_pilling" name="rubs_for_surface_fuzzing_and_pilling" placeholder="Rubs Value" required>
		         
		  </div>
		        

          <div class="col-sm-1" for="unit">
          	  RUBS
             <!-- <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/> --> 

             	<input type="hidden" class="form-control" id="uom_of_surface_fuzzing_and_pilling_value" name="uom_of_surface_fuzzing_and_pilling_value" value="">
          </div>

		        
          <div class="col-sm-1 text-center" for="min_value">

          	<input type="text" class="form-control" id="surface_fuzzing_and_pilling_min_value" name="surface_fuzzing_and_pilling_min_value" placeholder="Enter Surface Fuzzing and Pilling Min Value" required>
          </div>
		          
          <div class="col-sm-1 text-center">
              
            <input type="text" class="form-control" id="surface_fuzzing_and_pilling_max_value" name="surface_fuzzing_and_pilling_max_value" placeholder="Enter Surface Fuzzing and Pilling Max Value" required>

           </div>
		            
		    <input type="hidden" name="uom_of_surface_fuzzing_and_pilling_value" id="uom_of_surface_fuzzing_and_pilling_value" value="">    

     </div><!-- End of <div class="form-group form-group-sm" surface_fuzzing_and_pilling-->

  </div>  <!-- End of <div id="div_resistance_to_surface_fuzzing_and_pilling" style="display: none">  -->




  <div id="div_tensile_properties" style="display: none"> 


      <div class="form-group form-group-sm" for="tensile_properties_in_warp">
		  

			<div class="col-sm-3 text-center">
				 <label class="control-label" for="tensile_properties_in_warp" style="color:#00008B;"><span id="for_tensile_properties_in_warp_test_name_label">Tensile Properties</span> <span id="tensile_properties_in_weft_test_method"> (ISO 13934-1)</span></label>
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
                      <option value="">Select Tensile Properties In Warp Value Tolerance Range Math Operator</option>
                      <option value="≥">≥</option>
                      <option value="≤"> ≤ </option>
                      <option value=">"> > </option>
	                  <option value="<"> < </option>
                </select>
              
           </div>
	          
	               <!--Add Input/Select Field Here No Dive Only Input/Select/Radio Button/Checkbox/Textarea -->
		          
          <div class="col-sm-1" for="tolerance">

             <input type="text" class="form-control" id="tensile_properties_in_warp_value_tolerance_value" name="tensile_properties_in_warp_value_tolerance_value" placeholder="Enter Tolerance Value" onchange="tensile_properties_in_warp()" required>
          </div>

          <div class="col-sm-1" for="unit">
             <select  class="form-control" id="uom_of_tensile_properties_in_warp_value" name="uom_of_tensile_properties_in_warp_value">
                      <option value="">Select Uom Of Warp Yarn Tensile Properties</option>
                      <option value="N">N</option>
                      <option value="kg">kg</option>
                      <option value="lbf">lbf</option>
                      <option value="daN">daN</option>
                      
              </select>
          </div>

		        
          <div class="col-sm-1 text-center" for="min_value">

          	<input type="text" class="form-control" id="tensile_properties_in_warp_value_min_value" name="tensile_properties_in_warp_value_min_value" placeholder="Enter Warp Yarn Tensile Properties Min Value" required>
          </div>
		          
          <div class="col-sm-1 text-center">
              
            <input type="text" class="form-control" id="tensile_properties_in_warp_value_max_value" name="tensile_properties_in_warp_value_max_value" placeholder="Enter Warp Yarn Tensile Properties Max Value" required>

           </div>
		            
		   
     </div><!-- End of <div class="form-group form-group-sm" tensile_properties_in_warp_value_max_value-->



      <div class="form-group form-group-sm" for="tensile_properties_in_weft">
		  

			<div class="col-sm-3 text-center">
				 <label class="control-label" for="tensile_properties_in_weft" style="display: none"><span id="tensile_properties_in_weft_test_name_label">Tensile Properties</span> <span id="tensile_properties_in_weft_test_method"> (ISO 13934-1)</span></label>
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
                      <option value="">Select Tensile Properties In weft Value Tolerance Range Math Operator</option>
                      <option value="≥">≥</option>
                      <option value="≤"> ≤ </option>
                      <option value=">"> > </option>
	                  <option value="<"> < </option>
                </select>
              
           </div>
	          
	               <!--Add Input/Select Field Here No Dive Only Input/Select/Radio Button/Checkbox/Textarea -->
		          
          <div class="col-sm-1" for="tolerance">

             <input type="text" class="form-control" id="tensile_properties_in_weft_value_tolerance_value" name="tensile_properties_in_weft_value_tolerance_value" placeholder="Enter Tolerance Value" onchange="tensile_properties_in_weft()" required>
          </div>

          <div class="col-sm-1" for="unit">
             <select  class="form-control" id="uom_of_tensile_properties_in_weft_value" name="uom_of_tensile_properties_in_weft_value">
                      <option value="">Select Uom Of weft Yarn Tensile Properties</option>
                      <option value="N">N</option>
                      <option value="kg">kg</option>
                      <option value="lbf">lbf</option>
                      <option value="daN">daN</option>
                      
              </select>
          </div>

		        
          <div class="col-sm-1 text-center" for="min_value">

          	<input type="text" class="form-control" id="tensile_properties_in_weft_value_min_value" name="tensile_properties_in_weft_value_min_value" placeholder="Enter weft Yarn Tensile Properties Min Value" required>
          </div>
		          
          <div class="col-sm-1 text-center">
              
            <input type="text" class="form-control" id="tensile_properties_in_weft_value_max_value" name="tensile_properties_in_weft_value_max_value" placeholder="Enter weft Yarn Tensile Properties Max Value" required>

           </div>
		            
		   
     </div><!-- End of <div class="form-group form-group-sm" tensile_properties_in_weft_value_max_value-->


 </div>  <!-- End of <div id="div_tensile_properties" style="display: none">  -->



  

  <div id="div_tear_force" style="display: none"> 


      <div class="form-group form-group-sm" for="tear_force_in_warp_value">
		  

			<div class="col-sm-3 text-center">
				 <label class="control-label" for="tear_force_in_warp_value" style="color:#00008B;"><span id="for_tear_force_in_warp_test_name_label">Tear Force</span> <span id="tear_force_in_warp_test_method"> (ISO 13937-2)</span></label>
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
                      <option value="">Select Warp Yarn Tear Force Tolerance Range Math Operator</option>
                      <option value="≥">≥</option>
                      <option value="≤"> ≤ </option>
                      <option value=">"> > </option>
	                  <option value="<"> < </option>
               </select>
              
           </div>
	          
	               <!--Add Input/Select Field Here No Dive Only Input/Select/Radio Button/Checkbox/Textarea -->
		          
          <div class="col-sm-1" for="tolerance">

             <input type="text" class="form-control" id="tear_force_in_warp_value_tolerance_value" name="tear_force_in_warp_value_tolerance_value" placeholder="Enter Tolerance Value" onchange="tear_force_in_warp_cal()" required>
          </div>

          <div class="col-sm-1" for="unit">
             <select  class="form-control" id="uom_of_tear_force_in_warp_value" name="uom_of_tear_force_in_warp_value">
                      <option value="">Select Uom Of Warp Yarn Tear Force Properties</option>
                      <option value="N">N</option>
                      <option value="kg">kg</option>
                      <option value="lbf">lbf</option>
                      <option value="gm">gm</option>
                      <option value="daN">daN</option>
                      <option value="oz">oz</option>
              </select>
          </div>

		        
          <div class="col-sm-1 text-center" for="min_value">

          	<input type="text" class="form-control" id="tear_force_in_warp_value_min_value" name="tear_force_in_warp_value_min_value" placeholder="Enter Warp Yarn Tear Force Min Value" required>
          </div>
		          
          <div class="col-sm-1 text-center">
              
            <input type="text" class="form-control" id="tear_force_in_warp_value_max_value" name="tear_force_in_warp_value_max_value" placeholder="Enter Warp Yarn Tear ForceMax Value" required>

           </div>
		            
		   
     </div><!-- End of <div class="form-group form-group-sm" tear_force_in_warp_value-->



     <div class="form-group form-group-sm" for="tear_force_in_weft_value">
      

            <div class="col-sm-3 text-center">
	         <label class="control-label" for="tear_force_in_weft_value" style="display: none"><span id="tear_force_in_weft_test_name_label">Tear Force</span> <span id="tear_force_in_weft_test_method"> (ISO 13937-2)</span></label>
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
                      <option value="">Select weft Yarn Tear Force Tolerance Range Math Operator</option>
                      <option value="≥">≥</option>
                      <option value="≤"> ≤ </option>
                      <option value=">"> > </option>
                    <option value="<"> < </option>
               </select>
              
           </div>
            
                 <!--Add Input/Select Field Here No Dive Only Input/Select/Radio Button/Checkbox/Textarea -->
              
          <div class="col-sm-1" for="tolerance">

             <input type="text" class="form-control" id="tear_force_in_weft_value_tolerance_value" name="tear_force_in_weft_value_tolerance_value" placeholder="Enter Tolerance Value" onchange="tear_force_in_weft_cal()" required>
          </div>

          <div class="col-sm-1" for="unit">
             <select  class="form-control" id="uom_of_tear_force_in_weft_value" name="uom_of_tear_force_in_weft_value">
                      <option value="">Select Uom Of weft Yarn Tear Force Properties</option>
                      <option value="N">N</option>
                      <option value="kg">kg</option>
                      <option value="lbf">lbf</option>
                      <option value="gm">gm</option>
                      <option value="daN">daN</option>
                      <option value="oz">oz</option>
              </select>
          </div>

            
          <div class="col-sm-1 text-center" for="min_value">

            <input type="text" class="form-control" id="tear_force_in_weft_value_min_value" name="tear_force_in_weft_value_min_value" placeholder="Enter weft Yarn Tear Force Min Value" required>
          </div>
              
          <div class="col-sm-1 text-center">
              
            <input type="text" class="form-control" id="tear_force_in_weft_value_max_value" name="tear_force_in_weft_value_max_value" placeholder="Enter weft Yarn Tear ForceMax Value" required>

           </div>
                
       
     </div><!-- End of <div class="form-group form-group-sm" tensile_properties_in_weft_value_max_value-->

 
 </div> <!--  End of <div id="div_tear_force" style="display: none">  -->

 


 <div id="div_resistance_to_surface_wetting" style="display: none">


     <div class="form-group form-group-sm">
        

                <div class="col-sm-3 text-center">
                   <label class="control-label" for="test_name_and_method" style="color:#00008B;"><span id="for_resistance_to_surface_wetting_before_wash_test_name_label">Resistance to Surface Wetting</span> 
                   	<span id="resistance_to_surface_wetting_before_wash_test_method"> 

                    <select  class="form-control" id="test_method_for_resistance_to_surface_wetting_before_wash" name="test_method_for_resistance_to_surface_wetting_before_wash" onchange="resistance_to_surface_wetting_before_wash_cal()">
                       <option select="selected" value="ISO 4920">ISO 4920</option>
		               <option value="AATCC 22"> AATCC 22 </option>
                   </select>
                   </span>
                   </label>
                </div>
             
                <div class="col-sm-2 text-center">
                        
                        <label class="control-label" for="description_or_type" style="color:#00008B;">Before Wash</label>
                       

                       <!-- <input type="hidden" class="form-control" id="test_method_for_resistance_to_surface_wetting_before_wash" name="test_method_for_resistance_to_surface_wetting_before_wash" value="ISO 4920" >  -->
                        
                </div>

                  <div class="col-sm-1 text-center">
                     <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
                </div>

                 <div class="col-sm-1 text-center">
                  
                   <select  class="form-control" id="resistance_to_surface_wetting_before_wash_tol_range_math_op" name="resistance_to_surface_wetting_before_wash_tol_range_math_op" onchange="resistance_to_surface_wetting_before_wash_cal()">
                      <option value="">Select CF To Surface Wetting Staining Range Math Operator</option>
                      <option value="≥">≥</option>
                      <option value="≤"> ≤ </option>
                      <option value=">"> > </option>
	                  <option value="<"> < </option>
                   </select>

                </div>


                <div class="col-sm-1 text-center">
                      <select  class="form-control" id="resistance_to_surface_wetting_before_wash_tolerance_value" name="resistance_to_surface_wetting_before_wash_tolerance_value" onchange="resistance_to_surface_wetting_before_wash_cal()">
                    <option value="">Select Tolerance Value</option>
                     <!--  <option value="50">1</option>
                      <option value="70"> 2 </option>
                      <option value="80">3</option>
                      <option value="90"> 4 </option>
                      <option value="10"> 5 </option> -->

                      <option value="1">1</option>
                      <option value="1.5">1-2</option>
                      <option value="2"> 2 </option>
                      <option value="2.5"> 2-3 </option>
                      <option value="3">3</option>
                      <option value="3.5">3-4</option>
                      <option value="4"> 4 </option>
                      <option value="4.5"> 4-5 </option>
                      <option value="5"> 5 </option>
                  </select>
                </div>

               

               
              <div class="col-sm-1" for="unit">
                 <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>

               <input type="hidden" class="form-control" id="uom_of_resistance_to_surface_wetting_before_wash" name="uom_of_resistance_to_surface_wetting_before_wash" value="" >
              </div>

                
              <div class="col-sm-1 text-center" for="min_value">

                 <input type="text" class="form-control" id="resistance_to_surface_wetting_before_wash_min_value" name="resistance_to_surface_wetting_before_wash_min_value" placeholder="Enter  Min Value" required>
                 
              </div>
                  
              <div class="col-sm-1 text-center">
                  
                  <input type="text" class="form-control" id="resistance_to_surface_wetting_before_wash_max_value" name="resistance_to_surface_wetting_before_wash_max_value" placeholder="Enter  Max Value" required>
              </div>
                
            

     </div><!-- End of <div class="form-group form-group-sm" resistance_to_surface_wetting_before_wash-->





     <div class="form-group form-group-sm">
        

                <div class="col-sm-3 text-center">
                   <label class="control-label" for="test_name_and_method" style="display: none"><span id="resistance_to_surface_wetting_after_one_wash_test_name_label">Resistance to Surface Wetting</span> <span id="resistance_to_surface_wetting_after_one_wash_test_method">

                   	<select  class="form-control" id="test_method_for_resistance_to_surface_wetting_after_one_wash" name="test_method_for_resistance_to_surface_wetting_after_one_wash" onchange="resistance_to_surface_wetting_after_one_wash_cal()">
                       <option select="selected" value="ISO 4920">ISO 4920</option>
		               <option value="AATCC 22"> AATCC 22 </option>
                   </select>
                  </span>
                   </label>
                </div>
             
                <div class="col-sm-2 text-center">
                        
                        <label class="control-label" for="description_or_type" style="color:#00008B;">After One Wash</label>

                        <!-- <input type="hidden" class="form-control" id="test_method_for_resistance_to_surface_wetting_after_one_wash" name="test_method_for_resistance_to_surface_wetting_after_one_wash" value="ISO 4920" > -->
                        
                </div>

                  <div class="col-sm-1 text-center">
                     <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
                </div>

                 <div class="col-sm-1 text-center">
                  
                   <select  class="form-control" id="resistance_to_surface_wetting_after_one_wash_tol_range_math_op" name="resistance_to_surface_wetting_after_one_wash_tol_range_math_op" onchange="resistance_to_surface_wetting_after_one_wash_cal()">
                      <option value="">Select CF To Surface Wetting Staining Range Math Operator</option>
                      <option value="≥">≥</option>
                      <option value="≤"> ≤ </option>
                      <option value=">"> > </option>
	                  <option value="<"> < </option>
                   </select>

                </div>


                <div class="col-sm-1 text-center">
                      <select  class="form-control" id="resistance_to_surface_wetting_after_one_wash_tolerance_value" name="resistance_to_surface_wetting_after_one_wash_tolerance_value" onchange="resistance_to_surface_wetting_after_one_wash_cal()">
                    <option value="">Select Tolerance Value</option>
                      <option value="1">1</option>
                      <option value="1.5">1-2</option>
                      <option value="2"> 2 </option>
                      <option value="2.5"> 2-3 </option>
                      <option value="3">3</option>
                      <option value="3.5">3-4</option>
                      <option value="4"> 4 </option>
                      <option value="4.5"> 4-5 </option>
                      <option value="5"> 5 </option>
                  </select>
                </div>

               

               
              <div class="col-sm-1" for="unit">
                 <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
               <input type="hidden" class="form-control" id="uom_of_resistance_to_surface_wetting_after_one_wash" name="uom_of_resistance_to_surface_wetting_after_one_wash" value="" >
              </div>

                
              <div class="col-sm-1 text-center" for="min_value">

                 <input type="text" class="form-control" id="resistance_to_surface_wetting_after_one_wash_min_value" name="resistance_to_surface_wetting_after_one_wash_min_value" placeholder="Enter  Min Value" required>
                 
              </div>
                  
              <div class="col-sm-1 text-center">
                  
                  <input type="text" class="form-control" id="resistance_to_surface_wetting_after_one_wash_max_value" name="resistance_to_surface_wetting_after_one_wash_max_value" placeholder="Enter  Max Value" required>
              </div>
                
            

     </div><!-- End of <div class="form-group form-group-sm" resistance_to_surface_wetting_after_one_wash-->



     <div class="form-group form-group-sm">
        

                <div class="col-sm-3 text-center">
                   <label class="control-label" for="test_name_and_method" style="display: none"><span id="resistance_to_surface_wetting_after_five_wash_test_name_label">Resistance to Surface Wetting</span>

	                   	<span id="resistance_to_surface_wetting_after_five_wash_test_method">
	                   	  <select  class="form-control" id="test_method_for_resistance_to_surface_wetting_after_five_wash" name="test_method_for_resistance_to_surface_wetting_after_five_wash" onchange="resistance_to_surface_wetting_after_five_wash_cal()">
		                    
		                      <option select="selected" value="ISO 4920">ISO 4920</option>
		                      <option value="AATCC 22"> AATCC 22 </option>
		                   </select>
	                   </span>
                   </label>
                </div>
             
                <div class="col-sm-2 text-center">
                        
                        <label class="control-label" for="description_or_type" style="color:#00008B;">After five Wash</label>

                       <!--  <input type="hidden" class="form-control" id="test_method_for_resistance_to_surface_wetting_after_five_wash" name="test_method_for_resistance_to_surface_wetting_after_five_wash" value="ISO 4920" > -->
                        
                </div>

                  <div class="col-sm-1 text-center">
                     <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
                </div>

                 <div class="col-sm-1 text-center">
                  
                   <select  class="form-control" id="resistance_to_surface_wetting_after_five_wash_tol_range_math_op" name="resistance_to_surface_wetting_after_five_wash_tol_range_math_op" onchange="resistance_to_surface_wetting_after_five_wash_cal()">
                      <option value="">Select CF To Surface Wetting Staining Range Math Operator</option>
                      <option value="≥">≥</option>
                      <option value="≤"> ≤ </option>
                      <option value=">"> > </option>
	                  <option value="<"> < </option>
                   </select>

                </div>


                <div class="col-sm-1 text-center">
                      <select  class="form-control" id="resistance_to_surface_wetting_after_five_wash_tolerance_value" name="resistance_to_surface_wetting_after_five_wash_tolerance_value" onchange="resistance_to_surface_wetting_after_five_wash_cal()">
                      <option value="">Select Tolerance Value</option>
                      <option value="1">1</option>
                      <option value="1.5">1-2</option>
                      <option value="2"> 2 </option>
                      <option value="2.5"> 2-3 </option>
                      <option value="3">3</option>
                      <option value="3.5">3-4</option>
                      <option value="4"> 4 </option>
                      <option value="4.5"> 4-5 </option>
                      <option value="5"> 5 </option>
                  </select>
                  </select>
                </div>

               

               
              <div class="col-sm-1" for="unit">
                 <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>

               <input type="hidden" class="form-control" id="uom_of_resistance_to_surface_wetting_after_five_wash" name="uom_of_resistance_to_surface_wetting_after_five_wash" value="" >
              </div>

                
              <div class="col-sm-1 text-center" for="min_value">

                 <input type="text" class="form-control" id="resistance_to_surface_wetting_after_five_wash_min_value" name="resistance_to_surface_wetting_after_five_wash_min_value" placeholder="Enter  Min Value" required>
                 
              </div>
                  
              <div class="col-sm-1 text-center">
                  
                  <input type="text" class="form-control" id="resistance_to_surface_wetting_after_five_wash_max_value" name="resistance_to_surface_wetting_after_five_wash_max_value" placeholder="Enter  Max Value" required>
              </div>
                
            

     </div><!-- End of <div class="form-group form-group-sm" resistance_to_surface_wetting_after_five_wash-->


 </div>  <!-- End of <div id="div_resistance_to_surface_wetting" style="display: none"> -->



  <div class="form-group form-group-sm" id="div_formaldehyde_content" style="display: none">


      <div class="form-group form-group-sm">
        

                <div class="col-sm-3 text-center">
                   <label class="control-label" for="test_name_and_method" style="color:#00008B;"><span id="for_formaldehyde_content_test_name_label">Formaldehyde Content</span> <span id="formaldehyde_content_test_method">(ISO 14184-1)</span>
                   </label>
                </div>
             
                <div class="col-sm-2 text-center">
                        
                        <!-- <label class="control-label" for="description_or_type" style="color:#00008B;"></label> -->
                        <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>

                         <input type="hidden" class="form-control" id="test_method_formaldehyde_content" name="test_method_formaldehyde_content" value="(ISO 14184-1">
                </div>

                <div class="col-sm-1 text-center">
                     <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
                </div>
           
                 <div class="col-sm-1 text-center">
                  
                   
                    <select  class="form-control" id="formaldehyde_content_tolerance_range_math_operator" name="formaldehyde_content_tolerance_range_math_operator" onchange="formaldehyde_content_Cal()">
                      <option value="">Select Formaldehyde Content Tolerance Range Math Operator</option>
                      <option value="≥"> ≥ </option>
                      <option value="≤"> ≤ </option>
                      <option value=">"> > </option>
	                  <option value="<"> < </option>
                    </select>

                </div>


                <div class="col-sm-1 text-center">
                      <input type="text" class="form-control" id="formaldehyde_content_tolerance_value" name="formaldehyde_content_tolerance_value" placeholder="Enter Tolerance Value" onchange="formaldehyde_content_Cal()" required>
                </div>

                

               
              <div class="col-sm-1" for="unit">
                 <!-- <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/> -->
                 <select  class="form-control" id="uom_of_formaldehyde_content" name="uom_of_formaldehyde_content">
                      <option value="">Select uom_of_formaldehyde_content </option>
                      <option value="PPM">PPM</option>
                      <option value="Mg/Kg">Mg/Kg</option>
                             
                </select>
              </div>

                
              <div class="col-sm-1 text-center" for="min_value">
                  <input type="text" class="form-control" id="formaldehyde_content_min_value" name="formaldehyde_content_min_value" placeholder="Enter  Min Value" required>
                 
              </div>
                  
              <div class="col-sm-1 text-center">
                   <input type="text" class="form-control" id="formaldehyde_content_max_value" name="formaldehyde_content_max_value" placeholder="Enter  Max Value" required>
              </div>
                
            

     </div><!-- End of <div class="form-group form-group-sm" formaldehyde_content-->

 </div>  <!-- End of  <div class="form-group form-group-sm" id="div_formaldehyde_content" style="display: none"> -->



  <div class="form-group form-group-sm" id="div_ph" style="display: none">


     <div class="form-group form-group-sm">
        

                <div class="col-sm-3 text-center">
                   <label class="control-label" for="test_name_and_method" style="color:#00008B;"><span id="for_ph_test_name_label">pH</span> <span id="ph_test_method"> (ISO 3071)</span>
                   </label>
                </div>
             
                <div class="col-sm-2 text-center">
                        
                        <!-- <label class="control-label" for="description_or_type" style="color:#00008B;"></label> -->
                        <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>

                         <input type="hidden" class="form-control" id="test_method_for_ph" name="test_method_for_ph"  value="ISO 3071">

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
                   </select>
 -->
                </div>


                <div class="col-sm-1 text-center">
                      <!--Add Input/Select Field Here No Dive Only Input/Select/Radio Button/Checkbox/Textarea -->
                  <!-- <input type="text" class="form-control" id="ph_value_tolerance_value" name="ph_value_tolerance_value" placeholder="Enter Tolerance Value" onchange="ph_value_cal_without_value()" required>




 -->
                  <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
                  <!--  <select  class="form-control" id="ph_value_tolerance_value" name="ph_value_tolerance_value" onchange="ph_value_cal_without_value()">
                      <option value="">Select Ph Value Math Operator</option>
                      <option value="5">5</option>
                      <option value="5.5"> 5-6 </option>
                      <option value="6"> 6 </option>
	                  <option value="6.5">6-7 </option>
	                  <option value="7"> 7 </option>
                   </select> -->
                    <input type="hidden" class="form-control" id="ph_value_tolerance_range_math_operator" name="ph_value_tolerance_range_math_operator"  value="0">

                   <input type="hidden" class="form-control" id="ph_value_tolerance_value" name="ph_value_tolerance_value" onchange="ph_value_cal_without_value()" value="0">
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
 
 </div> <!--  End of <div class="form-group form-group-sm" id="div_ph" style="display: none"> -->




   <div class="form-group form-group-sm" id="div_smoothness_appearance" style="display: none">
        

          <div class="col-sm-3 text-center">
          <label class="control-label" for="" style="color:#00008B;"></label><br>
             <label class="control-label"  style="color:#00008B;">Smoothness Appearance <span id="smoothness_appearance_test_method">(AATCC 124)</span> </label>
             <input type="hidden" class="form-control" id="test_method_for_smoothness_appearance" name="test_method_for_smoothness_appearance"  value="AATCC 124">

          </div>
           
          <div class="col-sm-2 text-center">
            <label class="control-label" for="washing_cycle" style="color:#00008B;">Washing Cycle</label>
		          <input type="text" class="form-control" id="smoothness_appearance_tolerance_washing_cycle" name="smoothness_appearance_tolerance_washing_cycle" placeholder="Enter Washing Cycle" required>
		      </div>

            <div class="col-sm-1 text-center">
                    
                    <!--  <label class="control-label" for="description_or_type" style="color:#00008B;"></label> -->
                    <label class="control-label" for="" style="color:#00008B;"></label>
                     <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
 
             </div>

             <div class="col-sm-1 text-center">
             <label class="control-label" for="" style="color:#00008B;"></label>
                 <select  class="form-control" id="smoothness_appearance_tolerance_range_math_op" name="smoothness_appearance_tolerance_range_math_op" onchange="smoothness_appearance_cal()">
                      <option value="">Select CF To Dry Cleaning cross staining Range Math Operator</option>
                      <option value="≥">≥</option>
                      <option value="≤"> ≤ </option>
                      <option value=">"> > </option>
                    <option value="<"> < </option>
                </select>
              </div>


              <div class="col-sm-1 text-center">
              <label class="control-label" for="" style="color:#00008B;"></label>
                  <select  class="form-control" id="smoothness_appearance_tolerance_value" name="smoothness_appearance_tolerance_value" onchange="smoothness_appearance_cal()">
                      <option value="">Select Tolerance Value</option>
                      <option value="1">1</option>
                      <option value="2"> 2 </option>
                      <option value="3">3</option>
                      <option value="3.5">3.5</option>
                      <option value="4"> 4 </option>
                      <option value="5"> 5 </option>
                  </select>
              </div>

              

               
              <div class="col-sm-1" for="unit">
              <label class="control-label" for="" style="color:#00008B;"></label>
                <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
                <input type="hidden" class="form-control" id="uom_of_smoothness_appearance" name="uom_of_smoothness_appearance" value="%" >
              </div>

                
              <div class="col-sm-1 text-center" for="min_value">
              <label class="control-label" for="" style="color:#00008B;"></label>
                   <input type="text" class="form-control" id="smoothness_appearance_min_value" name="smoothness_appearance_min_value" placeholder="Enter  Min Value" required>
                 
              </div>
                  
              <div class="col-sm-1 text-center">
              <label class="control-label" for="" style="color:#00008B;"></label>
                  <input type="text" class="form-control" id="smoothness_appearance_max_value" name="smoothness_appearance_max_value" placeholder="Enter  Max Value" required>

               </div>
                
            

     </div><!-- End of <div class="form-group form-group-sm" id="div_smoothness_appearance" style="display: none">-->


<!-- -------------------------------------------------------------------------------Appearance after wash---------------------------------------------------------------------------------------------------------------------- -->

<div id="div_appearance_after_wash_full" style="display: none;">

<div id="div_appearance_after_wash">

<div class="form-group form-group-sm">

<div class="col-sm-3 text-center">
         <label class="control-label" for="appearance_after_wash_value" style="color:#00008B;"><span id="appearance_after_wash_label"> Appearance After Wash</span> <span id="appearance_after_wash_test_method"></span>
         </label>
      </div>
      
         <div class="col-sm-2">
                  <label class="control-label checkbox-inline" for="appearance_after_wash_fabric_checkbox" style="color:#00008B;">            
                  <!-- <input type="checkbox" id="test_method_for_appearance_after_wash_fabric" name="test_method_for_appearance_after_wash_fabric[]" value="Fabric (Mock up)" onclick="appearance_after_wash_fabric_check()"> -->
                  <input type="radio" id="test_method_for_appearance_after_wash_fabric" name="test_method_for_appearance_after_wash" value="Fabric (Mock up)" onclick="appearance_after_wash_fabric_check()">
                  <strong>Fabric (Mock up)</strong>
                  </label>      
         </div>

         <div class="col-sm-2">
                  <label class="control-label checkbox-inline" for="appearance_after_wash_garments_checkbox" style="color:#00008B;">            
                  <!-- <input type="checkbox" id="test_method_for_appearance_after_wash_garments" name="test_method_for_appearance_after_wash_fabric[]" value="Garments" onclick="appearance_after_wash_garments_check()"> -->
                  <input type="radio" id="test_method_for_appearance_after_wash_garments" name="test_method_for_appearance_after_wash" value="Garments" onclick="appearance_after_wash_garments_check()">
                  <strong>Garments</strong></label>   
                  
         </div>    
</div><!-- End of <div class="form-group form-group-sm" appearance_after_wash_value -->
</div>  <!-- End of <div id="div_appearance_after_wash" style="display: none"> -->




<div id="div_appearance_after_wash_fabric" style="display: none">         <!--div appearance after wash fabric------------------------------------------------------------------->
      
            <div class="form-group form-group-sm">
                  <div class="col-sm-3 text-center">
                        <label class="control-label" for="appearance_after_wash_washing_cycle_fabric" style="color:#00008B;">
                        <span id="appearance_after_wash_washing_cycle_fabric_label" > Select Washing Cycle:</span>
                        </label>
                  </div>
                  <div class="col-sm-2">
                     <label class="control-label checkbox-inline" for="appearance_after_washing_fabric_wash1_checkbox" style="color:#00008B;">            
                     <input type="checkbox" id="appearance_after_washing_cycle_fabric_wash1" name="appearance_after_washing_cycle_fabric_wash" value="1 wash">
                     <strong>1 Wash</strong></label>      
                  </div>

                  <div class="col-sm-2">
                     <label class="control-label checkbox-inline" for="appearance_after_washing_fabric_wash3_checkbox" style="color:#00008B;">            
                     <input type="checkbox" id="appearance_after_washing_cycle_fabric_wash3" name="appearance_after_washing_cycle_fabric_wash" value="3 wash">
                     <strong>3 Wash</strong></label>      
                  </div>

                  <div class="col-sm-2">
                     <label class="control-label checkbox-inline" for="appearance_after_washing_fabric_wash5_checkbox" style="color:#00008B;">            
                     <input type="checkbox" id="appearance_after_washing_cycle_fabric_wash5" name="appearance_after_washing_cycle_fabric_wash" value="5 wash">
                     <strong>5 Wash</strong></label>      
                  </div>

                  <div class="col-sm-2">
                     <label class="control-label checkbox-inline" for="appearance_after_washing_fabric_wash10_checkbox" style="color:#00008B;">            
                     <input type="checkbox" id="appearance_after_washing_cycle_fabric_wash10" name="appearance_after_washing_cycle_fabric_wash" value="10 wash">
                     <strong>10 Wash</strong></label>      
                  </div>
         </div><!-- End of <div class="form-group form-group-sm" select_washing_cycle_fabric -->

      <div class="form-group form-group-sm">
            <div class="col-sm-3 text-center">
                  <label class="control-label" for="appearance_after_wash_washing_cycle_fabric" style="color:#00008B;">
                  <span id="appearance_after_wash_washing_cycle_fabric_label" style="display: none;"> Select Washing Cycle:</span>
                  </label>
            </div>
            
            <div class="col-sm-2 text-center">
                     
                     <label class="control-label" for="description_or_type" style="color:#00008B;"> Color Change</label>

                     <input type="hidden" class="form-control" id="test_method_for_appearance_after_washing_fabric_color_change" name="test_method_for_appearance_after_washing_fabric_color_change" value="ISO 105 C6">
                     
               </div>

               <div class="col-sm-1 text-center">
                  
                  <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
               </div>

               <div class="col-sm-1 text-center">
                  
                  <select  class="form-control" id="appearance_after_washing_fabric_color_change_tolerance_range_math_operator" name="appearance_after_washing_fabric_color_change_tolerance_range_math_operator" onchange="appearance_after_washing_color_change_fabric_cal()">
                     <option value="">Select appearance after Washing Color Change Range Math Operator</option>
                     <option value="≥">≥</option>
                     <option value="≤"> ≤ </option>
                     <option value=">"> > </option>
                     <option value="<"> < </option>
               </select>
               </div>


               <div class="col-sm-1 text-center">
                  <select  class="form-control" id="appearance_after_washing_fabric_color_change_tolerance_value" name="appearance_after_washing_fabric_color_change_tolerance_value" onchange="appearance_after_washing_color_change_fabric_cal()">
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
               <input type="hidden" class="form-control" id="uom_of_appearance_after_washing_fabric_color_change" name="uom_of_appearance_after_washing_fabric_color_change" value="%" >
               </div>

               
               <div class="col-sm-1 text-center" for="min_value">

                  <input type="text" class="form-control" id="appearance_after_washing_fabric_color_change_min_value" name="appearance_after_washing_fabric_color_change_min_value" placeholder="Enter  Min Value" required>
               </div>
                  
               <div class="col-sm-1 text-center">
                  
                  <input type="text" class="form-control" id="appearance_after_washing_fabric_color_change_max_value" name="appearance_after_washing_fabric_color_change_max_value" placeholder="Enter  Max Value" required>

               </div>
               
            

      </div><!-- End of <div class="form-group form-group-sm" appearance_after_washing_fabric_color_change-->

   <div class="form-group form-group-sm">
   

         <div class="col-sm-3 text-center">
                  <label class="control-label" for="appearance_after_wash_washing_fabric_cycle_fabric" style="color:#00008B;">
                  <span id="appearance_after_wash_washing_cycle_fabric_label" style="display: none;"> Select Washing Cycle:</span>
                  </label>
         </div>
      
       <div class="col-sm-2 text-center">
               
               <label class="control-label" for="description_or_type" style="color:#00008B;"> Cross Staining</label>

                <input type="hidden" class="form-control" id="test_method_for_appearance_after_washing_fabric_cross_staining" name="test_method_for_appearance_after_washing_fabric_cross_staining" value="ISO 105 C6">
               
       </div>

        <div class="col-sm-1 text-center">
              <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
         </div>  

        <div class="col-sm-1 text-center">
             
            <select  class="form-control" id="appearance_after_washing_fabric_cross_staining_tolerance_range_math_operator" name="appearance_after_washing_fabric_cross_staining_tolerance_range_math_operator" onchange="appearance_after_washing_cross_staining_fabric_cal()">
                 <option value="">Select appearance after washing cross staining Range Math Operator</option>
                 <option value="≥">≥</option>
                 <option value="≤"> ≤ </option>
                 <option value=">"> > </option>
               <option value="<"> < </option>
           </select>
         </div>


         <div class="col-sm-1 text-center">
             <select  class="form-control" id="appearance_after_washing_fabric_cross_staining_tolerance_value" name="appearance_after_washing_fabric_cross_staining_tolerance_value" onchange="appearance_after_washing_cross_staining_fabric_cal()">
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
           <input type="hidden" class="form-control" id="uom_of_appearance_after_washing_fabric_cross_staining" name="uom_of_appearance_after_washing_fabric_cross_staining" value="%" >
         </div>

           
         <div class="col-sm-1 text-center" for="min_value">

             
              <input type="text" class="form-control" id="appearance_after_washing_fabric_cross_staining_min_value" name="appearance_after_washing_fabric_cross_staining_min_value" placeholder="Enter  Min Value" required>
            
         </div>
             
         <div class="col-sm-1 text-center">
             
             <input type="text" class="form-control" id="appearance_after_washing_fabric_cross_staining_max_value" name="appearance_after_washing_fabric_cross_staining_max_value" placeholder="Enter  Max Value" required>

          </div>
           
       

</div><!-- End of <div class="form-group form-group-sm" appearance_after_washing_fabric_cross_staining-->

<div class="form-group form-group-sm">
   

         <div class="col-sm-3 text-center">
                  <label class="control-label" for="appearance_after_wash_washing_fabric_cycle_fabric" style="color:#00008B;">
                  <span id="appearance_after_wash_washing_cycle_fabric_label" style="display: none;"> Select Washing Cycle:</span>
                  </label>
         </div>
      
       <div class="col-sm-2 text-center">
               
               <label class="control-label" for="description_or_type" style="color:#00008B;"> Surface Fuzzing</label>

                <input type="hidden" class="form-control" id="test_method_for_appearance_after_washing_fabric_surface_fuzzing" name="test_method_for_appearance_after_washing_fabric_surface_fuzzing" value="ISO 105 C6">
               
       </div>

        <div class="col-sm-1 text-center">
              <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
         </div>  

        <div class="col-sm-1 text-center">
             
            <select  class="form-control" id="appearance_after_washing_fabric_surface_fuzzing_tolerance_range_math_operator" name="appearance_after_washing_fabric_surface_fuzzing_tolerance_range_math_operator" onchange="appearance_after_washing_surface_fuzzing_fabric_cal()">
                 <option value="">Select appearance after washing fabric surface fuzzing Range Math Operator</option>
                 <option value="≥">≥</option>
                 <option value="≤"> ≤ </option>
                 <option value=">"> > </option>
               <option value="<"> < </option>
           </select>
         </div>


         <div class="col-sm-1 text-center">
             <select  class="form-control" id="appearance_after_washing_fabric_surface_fuzzing_tolerance_value" name="appearance_after_washing_fabric_surface_fuzzing_tolerance_value" onchange="appearance_after_washing_surface_fuzzing_fabric_cal()">
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
           <input type="hidden" class="form-control" id="uom_of_appearance_after_washing_fabric_surface_fuzzing" name="uom_of_appearance_after_washing_fabric_surface_fuzzing" value="%" >
         </div>

           
         <div class="col-sm-1 text-center" for="min_value">

             
              <input type="text" class="form-control" id="appearance_after_washing_fabric_surface_fuzzing_min_value" name="appearance_after_washing_fabric_surface_fuzzing_min_value" placeholder="Enter  Min Value" required>
            
         </div>
             
         <div class="col-sm-1 text-center">
             
             <input type="text" class="form-control" id="appearance_after_washing_fabric_surface_fuzzing_max_value" name="appearance_after_washing_fabric_surface_fuzzing_max_value" placeholder="Enter  Max Value" required>

          </div>
           
       

      </div><!-- End of <div class="form-group form-group-sm" appearance_after_washing_fabric_surface_fuzzing-->

      <div class="form-group form-group-sm">
   

         <div class="col-sm-3 text-center">
                  <label class="control-label" for="appearance_after_wash_washing_cycle_fabric" style="color:#00008B;">
                  <span id="appearance_after_wash_washing_cycle_fabric_label" style="display: none;"> Select Washing Cycle:</span>
                  </label>
         </div>
      
       <div class="col-sm-2 text-center">
               
               <label class="control-label" for="description_or_type" style="color:#00008B;"> Surface Pilling</label>

                <input type="hidden" class="form-control" id="test_method_for_appearance_after_washing_fabric_surface_pilling" name="test_method_for_appearance_after_washing_fabric_surface_pilling" value="ISO 105 C6">
               
       </div>

        <div class="col-sm-1 text-center">
              <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
         </div>  

        <div class="col-sm-1 text-center">
             
            <select  class="form-control" id="appearance_after_washing_fabric_surface_pilling_tolerance_range_math_operator" name="appearance_after_washing_fabric_surface_pilling_tolerance_range_math_operator" onchange="appearance_after_washing_surface_pilling_fabric_cal()">
                 <option value="">Select appearance after washing surface pilling Range Math Operator</option>
                 <option value="≥">≥</option>
                 <option value="≤"> ≤ </option>
                 <option value=">"> > </option>
               <option value="<"> < </option>
           </select>
         </div>


         <div class="col-sm-1 text-center">
             <select  class="form-control" id="appearance_after_washing_fabric_surface_pilling_tolerance_value" name="appearance_after_washing_fabric_surface_pilling_tolerance_value" onchange="appearance_after_washing_surface_pilling_fabric_cal()">
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
           <input type="hidden" class="form-control" id="uom_of_appearance_after_washing_fabric_surface_pilling" name="uom_of_appearance_after_washing_fabric_surface_pilling" value="%" >
         </div>

           
         <div class="col-sm-1 text-center" for="min_value">

             
              <input type="text" class="form-control" id="appearance_after_washing_fabric_surface_pilling_min_value" name="appearance_after_washing_fabric_surface_pilling_min_value" placeholder="Enter  Min Value" required>
            
         </div>
             
         <div class="col-sm-1 text-center">
             
             <input type="text" class="form-control" id="appearance_after_washing_fabric_surface_pilling_max_value" name="appearance_after_washing_fabric_surface_pilling_max_value" placeholder="Enter  Max Value" required>

          </div>
           
       

</div><!-- End of <div class="form-group form-group-sm" appearance_after_washing_fabric_surface_pilling-->

 <div class="form-group form-group-sm">
   

   <div class="col-sm-3 text-center">
            <label class="control-label" for="appearance_after_wash_washing_cycle_fabric" style="color:#00008B;">
            <span id="appearance_after_wash_washing_cycle_fabric_label" style="display: none;"> Select Washing Cycle:</span>
            </label>
   </div>

 <div class="col-sm-2 text-center">
         
         <label class="control-label" for="description_or_type" style="color:#00008B;"> Crease Before Ironing</label>

          <input type="hidden" class="form-control" id="test_method_for_appearance_after_washing_fabric_crease_before_ironing" name="test_method_for_appearance_after_washing_fabric_crease_before_ironing" value="ISO 105 C6">
         
 </div>

  <div class="col-sm-1 text-center">
        <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
   </div>  

  <div class="col-sm-1 text-center">
       
      <select  class="form-control" id="appearance_after_washing_fabric_crease_before_ironing_tolerance_range_math_operator" name="appearance_after_washing_fabric_crease_before_ironing_tolerance_range_math_operator" onchange="appearance_after_washing_crease_before_ironing_fabric_cal()">
           <option value="">Select appearance after washing fabric crease before ironing Range Math Operator</option>
           <option value="≥">≥</option>
           <option value="≤"> ≤ </option>
           <option value=">"> > </option>
         <option value="<"> < </option>
     </select>
   </div>


   <div class="col-sm-1 text-center">
       <select  class="form-control" id="appearance_after_washing_fabric_crease_before_ironing_tolerance_value" name="appearance_after_washing_fabric_crease_before_ironing_tolerance_value" onchange="appearance_after_washing_crease_before_ironing_fabric_cal()">
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
     <input type="hidden" class="form-control" id="uom_of_appearance_after_washing_fabric_crease_before_ironing" name="uom_of_appearance_after_washing_fabric_crease_before_ironing" value="%" >
   </div>

     
   <div class="col-sm-1 text-center" for="min_value">

       
        <input type="text" class="form-control" id="appearance_after_washing_fabric_crease_before_ironing_min_value" name="appearance_after_washing_fabric_crease_before_ironing_min_value" placeholder="Enter  Min Value" required>
      
   </div>
       
   <div class="col-sm-1 text-center">
       
       <input type="text" class="form-control" id="appearance_after_washing_fabric_crease_before_ironing_max_value" name="appearance_after_washing_fabric_crease_before_ironing_max_value" placeholder="Enter  Max Value" required>

    </div>
     
 

</div><!-- End of <div class="form-group form-group-sm" appearance_after_washing_fabric_crease_before_ironing-->

<div class="form-group form-group-sm">
   

   <div class="col-sm-3 text-center">
            <label class="control-label" for="appearance_after_wash_washing_cycle_fabric" style="color:#00008B;">
            <span id="appearance_after_wash_washing_cycle_fabric_label" style="display: none;"> Select Washing Cycle:</span>
            </label>
   </div>

 <div class="col-sm-2 text-center">
         
         <label class="control-label" for="description_or_type" style="color:#00008B;"> Crease After Ironing</label>

          <input type="hidden" class="form-control" id="test_method_for_appearance_after_washing_fabric_crease_after_ironing" name="test_method_for_appearance_after_washing_fabric_crease_after_ironing" value="ISO 105 C6">
         
 </div>

  <div class="col-sm-1 text-center">
        <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
   </div>  

  <div class="col-sm-1 text-center">
       
      <select  class="form-control" id="appearance_after_washing_fabric_crease_after_ironing_tolerance_range_math_operator" name="appearance_after_washing_fabric_crease_after_ironing_tolerance_range_math_operator" onchange="appearance_after_washing_crease_after_ironing_fabric_cal()">
           <option value="">Select appearance after washing surface pilling Range Math Operator</option>
           <option value="≥">≥</option>
           <option value="≤"> ≤ </option>
           <option value=">"> > </option>
         <option value="<"> < </option>
     </select>
   </div>


   <div class="col-sm-1 text-center">
       <select  class="form-control" id="appearance_after_washing_fabric_crease_after_ironing_tolerance_value" name="appearance_after_washing_fabric_crease_after_ironing_tolerance_value" onchange="appearance_after_washing_crease_after_ironing_fabric_cal()">
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
     <input type="hidden" class="form-control" id="uom_of_appearance_after_washing_fabric_crease_after_ironing" name="uom_of_appearance_after_washing_fabric_crease_after_ironing" value="%" >
   </div>

     
   <div class="col-sm-1 text-center" for="min_value">

       
        <input type="text" class="form-control" id="appearance_after_washing_fabric_crease_after_ironing_min_value" name="appearance_after_washing_fabric_crease_after_ironing_min_value" placeholder="Enter  Min Value" required>
      
   </div>
       
   <div class="col-sm-1 text-center">
       
       <input type="text" class="form-control" id="appearance_after_washing_fabric_crease_after_ironing_max_value" name="appearance_after_washing_fabric_crease_after_ironing_max_value" placeholder="Enter  Max Value" required>

    </div>
     
 

</div><!-- End of <div class="form-group form-group-sm" appearance_after_washing_fabric_crease_after_ironing-->

<div class="form-group form-group-sm">
   

   <div class="col-sm-3 text-center">
            <label class="control-label" for="appearance_after_wash_washing_cycle_fabric" style="color:#00008B;">
            <span id="appearance_after_wash_washing_cycle_fabric_label" style="display: none;"> Select Washing Cycle:</span>
            </label>
   </div>

 <div class="col-sm-2 text-center">
         
         <label class="control-label" for="description_or_type" style="color:#00008B;"> Loss of Print</label>

          <input type="hidden" class="form-control" id="test_method_for_appearance_after_washing_fabric_loss_of_print" name="test_method_for_appearance_after_washing_fabric_loss_of_print" value="ISO 105 C6">
         
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

   

    
   <div class="col-sm-1 text-center">
        <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
   </div> 

     
   <div class="col-sm-2 text-center">
        <input type="text"  class="form-control" id="appearance_after_washing_loss_of_print_fabric" name="appearance_after_washing_loss_of_print_fabric" placeholder="Enter loss of print" required>
   </div> 
       
 
     
 

</div><!-- End of <div class="form-group form-group-sm" appearance_after_washing_fabric_loss_of_print-->

<div class="form-group form-group-sm">
   

   <div class="col-sm-3 text-center">
            <label class="control-label" for="appearance_after_wash_washing_cycle_fabric" style="color:#00008B;">
            <span id="appearance_after_wash_washing_cycle_fabric_label" style="display: none;"> Select Washing Cycle:</span>
            </label>
   </div>

 <div class="col-sm-2 text-center">
         
         <label class="control-label" for="description_or_type" style="color:#00008B;"> Abrasive Mark</label>

          <input type="hidden" class="form-control" id="test_method_for_appearance_after_washing_fabric_abrasive_mark" name="test_method_for_appearance_after_washing_fabric_abrasive_mark" value="ISO 105 C6">
         
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

   

    
   <div class="col-sm-1 text-center">
        <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
   </div> 

     
   <div class="col-sm-2 text-center">
       
       <select  class="form-control" id="appearance_after_washing_fabric_abrasive_mark" name="appearance_after_washing_fabric_abrasive_mark">
            <option value="">Select appearance after washing abrasive mark</option>
            <option value="No">No</option>
            <option value="Negligible"> Negligible </option>
            <option value="Slight"> Slight </option>
      </select>
    </div>
     
 

</div><!-- End of <div class="form-group form-group-sm" appearance_after_washing_fabric_abrasive_mark-->

<div class="form-group form-group-sm">
   

   <div class="col-sm-3 text-center">
            <label class="control-label" for="appearance_after_wash_washing_cycle_fabric" style="color:#00008B;">
            <span id="appearance_after_wash_washing_cycle_fabric_label" style="display: none;"> Select Washing Cycle:</span>
            </label>
   </div>

 <div class="col-sm-2 text-center">
         
         <label class="control-label" for="description_or_type" style="color:#00008B;"> Odor</label>

          <input type="hidden" class="form-control" id="test_method_for_appearance_after_washing_fabric_odor" name="test_method_for_appearance_after_washing_fabric_odor" value="ISO 105 C6">
         
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

   

    
   <div class="col-sm-1 text-center">
        <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
   </div> 

     
   <div class="col-sm-2 text-center">
        <input type="text"  class="form-control" id="appearance_after_washing_odor_fabric" name="appearance_after_washing_odor_fabric" placeholder="Enter odor" required>
   </div> 
     
 

</div><!-- End of <div class="form-group form-group-sm" appearance_after_washing_fabric_odor-->

<!-- Start Test name for appearance after washing for fabric for other observation-->
<div class="form-group form-group-sm">
   

   <div class="col-sm-3 text-center">
            <label class="control-label" for="appearance_after_wash_washing_cycle_fabric" style="color:#00008B;">
            <span id="appearance_after_wash_washing_cycle_fabric_label" style="display: none;"> Select Washing Cycle:</span>
            </label>
   </div>

 <div class="col-sm-2 text-center">
         
         <label class="control-label" for="other_observation" style="color:#00008B;"> Other Observation</label>

          <input type="hidden" class="form-control" id="test_method_for_appearance_after_washing_fabric_other_observation" name="test_method_for_appearance_after_washing_fabric_other_observation" value="">
         
 </div>

     
   <div class="col-sm-6 text-center">
      <textarea class="form-control" name="appearance_after_washing_other_observation_fabric" id="appearance_after_washing_other_observation_fabric" cols="30" rows="2" placeholder="Enter other observation" required></textarea>
   </div> 
     
 

</div>         
<!-- End of <div class="form-group form-group-sm" appearance_after_washing_fabric_other_observation-->
<!-- End Test name for appearance after washing for fabric for other observation-->


</div>       <!--------------------------end of div appearance after washing fabric--------------------------------->



<div id="div_appearance_after_wash_garments" style="display: none">         <!--start div appearance after wash garments------------------------------------------------------------------->
      
      <div class="form-group form-group-sm">
            <div class="col-sm-3 text-center">
                  <label class="control-label" for="appearance_after_wash_washing_cycle_garments" style="color:#00008B;">
                  <span id="appearance_after_wash_washing_cycle_garments_label" > Select Washing Cycle:</span>
                  </label>
            </div>
            <div class="col-sm-2">
               <label class="control-label checkbox-inline" for="appearance_after_washing_garments_wash1_checkbox" style="color:#00008B;">            
               <input type="checkbox" id="appearance_after_washing_cycle_garments_wash1" name="appearance_after_washing_cycle_garments_wash" value="1 wash">
               <strong>1 Wash</strong></label>      
            </div>

            <div class="col-sm-2">
               <label class="control-label checkbox-inline" for="appearance_after_washing_garments_wash3_checkbox" style="color:#00008B;">            
               <input type="checkbox" id="appearance_after_washing_cycle_garments_wash3" name="appearance_after_washing_cycle_garments_wash" value="3 wash">
               <strong>3 Wash</strong></label>      
            </div>

            <div class="col-sm-2">
               <label class="control-label checkbox-inline" for="appearance_after_washing_garments_wash5_checkbox" style="color:#00008B;">            
               <input type="checkbox" id="appearance_after_washing_cycle_garments_wash5" name="appearance_after_washing_cycle_garments_wash" value="5 wash">
               <strong>5 Wash</strong></label>      
            </div>

            <div class="col-sm-2">
               <label class="control-label checkbox-inline" for="appearance_after_washing_garments_wash10_checkbox" style="color:#00008B;">            
               <input type="checkbox" id="appearance_after_washing_cycle_garments_wash10" name="appearance_after_washing_cycle_garments_wash" value="10 wash">
               <strong>10 Wash</strong></label>      
            </div>
      </div><!-- End of <div class="form-group form-group-sm" select_washing_cycle_garments -->
         

      <div class="form-group form-group-sm">
            <div class="col-sm-3 text-center">
                  <label class="control-label" for="appearance_after_wash_washing_cycle_garments" style="color:#00008B;">
                  <span id="appearance_after_wash_washing_cycle_garments_label" style="display: none;"> Select Washing Cycle:</span>
                  </label>
            </div>
            
            <div class="col-sm-2 text-center">
                     
                     <label class="control-label" for="description_or_type" style="color:#00008B;"> Color Change (Without Suppressor)</label>

                     <input type="hidden" class="form-control" id="test_method_for_appearance_after_washing_garments_color_change_without_suppressor" name="test_method_for_appearance_after_washing_garments_color_change_without_suppressor" value="ISO 105 C6">
                     
               </div>

               <div class="col-sm-1 text-center">
                  
                  <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
               </div>

               <div class="col-sm-1 text-center">
                  
                  <select  class="form-control" id="appearance_after_washing_garments_color_change_without_suppressor_tolerance_range_math_operator" name="appearance_after_washing_garments_color_change_without_suppressor_tolerance_range_math_operator" onchange="appearance_after_washing_color_change_without_suppressor_garments_cal()">
                     <option value="">Select appearance after Washing Color Change Range Math Operator</option>
                     <option value="≥">≥</option>
                     <option value="≤"> ≤ </option>
                     <option value=">"> > </option>
                     <option value="<"> < </option>
               </select>
               </div>


               <div class="col-sm-1 text-center">
                  <select  class="form-control" id="appearance_after_washing_garments_color_change_without_suppressor_tolerance_value" name="appearance_after_washing_garments_color_change_without_suppressor_tolerance_value" onchange="appearance_after_washing_color_change_without_suppressor_garments_cal()">
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
               <input type="hidden" class="form-control" id="uom_of_appearance_after_washing_garments_color_change_without_suppressor" name="uom_of_appearance_after_washing_garments_color_change_without_suppressor" value="%" >
               </div>

               
               <div class="col-sm-1 text-center" for="min_value">

                  <input type="text" class="form-control" id="appearance_after_washing_garments_color_change_without_suppressor_min_value" name="appearance_after_washing_garments_color_change_without_suppressor_min_value" placeholder="Enter  Min Value" required>
               </div>
                  
               <div class="col-sm-1 text-center">
                  
                  <input type="text" class="form-control" id="appearance_after_washing_garments_color_change_without_suppressor_max_value" name="appearance_after_washing_garments_color_change_without_suppressor_max_value" placeholder="Enter  Max Value" required>

               </div>
               
            

      </div><!-- End of <div class="form-group form-group-sm" appearance_after_washing_garments_color_change_without_suppressor-->

      <div class="form-group form-group-sm">
            <div class="col-sm-3 text-center">
                  <label class="control-label" for="appearance_after_wash_washing_garments_cycle_fabric" style="color:#00008B;">
                  <span id="appearance_after_wash_washing_cycle_garments_label" style="display: none;"> Select Washing Cycle:</span>
                  </label>
            </div>
            
            <div class="col-sm-2 text-center">
                     
                     <label class="control-label" for="description_or_type" style="color:#00008B;"> Color Change (With Suppressor)</label>

                     <input type="hidden" class="form-control" id="test_method_for_appearance_after_washing_garments_color_change_with_suppressor" name="test_method_for_appearance_after_washing_garments_color_change_with_suppressor" value="ISO 105 C6">
                     
               </div>

               <div class="col-sm-1 text-center">
                  
                  <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
               </div>

               <div class="col-sm-1 text-center">
                  
                  <select  class="form-control" id="appearance_after_washing_garments_color_change_with_suppressor_tolerance_range_math_operator" name="appearance_after_washing_garments_color_change_with_suppressor_tolerance_range_math_operator" onchange="appearance_after_washing_color_change_with_suppressor_garments_cal()">
                     <option value="">Select appearance after Washing garments Color Change Range Math Operator</option>
                     <option value="≥">≥</option>
                     <option value="≤"> ≤ </option>
                     <option value=">"> > </option>
                     <option value="<"> < </option>
               </select>
               </div>


               <div class="col-sm-1 text-center">
                  <select  class="form-control" id="appearance_after_washing_garments_color_change_with_suppressor_tolerance_value" name="appearance_after_washing_garments_color_change_with_suppressor_tolerance_value" onchange="appearance_after_washing_color_change_with_suppressor_garments_cal()">
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
               <input type="hidden" class="form-control" id="uom_of_appearance_after_washing_garments_color_change_with_suppressor" name="uom_of_appearance_after_washing_garments_color_change_with_suppressor" value="%" >
               </div>

               
               <div class="col-sm-1 text-center" for="min_value">

                  <input type="text" class="form-control" id="appearance_after_washing_garments_color_change_with_suppressor_min_value" name="appearance_after_washing_garments_color_change_with_suppressor_min_value" placeholder="Enter  Min Value" required>
               </div>
                  
               <div class="col-sm-1 text-center">
                  
                  <input type="text" class="form-control" id="appearance_after_washing_garments_color_change_with_suppressor_max_value" name="appearance_after_washing_garments_color_change_with_suppressor_max_value" placeholder="Enter  Max Value" required>

               </div>
               
            

      </div><!-- End of <div class="form-group form-group-sm" appearance_after_washing_garments_color_change_with_suppresson-->


   <div class="form-group form-group-sm">
   

         <div class="col-sm-3 text-center">
                  <label class="control-label" for="appearance_after_wash_washing_cycle_garments" style="color:#00008B;">
                  <span id="appearance_after_wash_washing_cycle_garments_label" style="display: none;"> Select Washing Cycle:</span>
                  </label>
         </div>
      
       <div class="col-sm-2 text-center">
               
               <label class="control-label" for="description_or_type" style="color:#00008B;"> Cross Staining</label>

                <input type="hidden" class="form-control" id="test_method_for_appearance_after_washing_garments_cross_staining" name="test_method_for_appearance_after_washing_garments_cross_staining" value="ISO 105 C6">
               
       </div>

        <div class="col-sm-1 text-center">
              <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
         </div>  

        <div class="col-sm-1 text-center">
             
            <select  class="form-control" id="appearance_after_washing_garments_cross_staining_tolerance_range_math_operator" name="appearance_after_washing_garments_cross_staining_tolerance_range_math_operator" onchange="appearance_after_washing_cross_staining_garments_cal()">
                 <option value="">Select appearance after washing garments cross staining Range Math Operator</option>
                 <option value="≥">≥</option>
                 <option value="≤"> ≤ </option>
                 <option value=">"> > </option>
               <option value="<"> < </option>
           </select>
         </div>


         <div class="col-sm-1 text-center">
             <select  class="form-control" id="appearance_after_washing_garments_cross_staining_tolerance_value" name="appearance_after_washing_garments_cross_staining_tolerance_value" onchange="appearance_after_washing_cross_staining_garments_cal()">
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
           <input type="hidden" class="form-control" id="uom_of_appearance_after_washing_garments_cross_staining" name="uom_of_appearance_after_washing_garments_cross_staining" value="%" >
         </div>

           
         <div class="col-sm-1 text-center" for="min_value">

             
              <input type="text" class="form-control" id="appearance_after_washing_garments_cross_staining_min_value" name="appearance_after_washing_garments_cross_staining_min_value" placeholder="Enter  Min Value" required>
            
         </div>
             
         <div class="col-sm-1 text-center">
             
             <input type="text" class="form-control" id="appearance_after_washing_garments_cross_staining_max_value" name="appearance_after_washing_garments_cross_staining_max_value" placeholder="Enter  Max Value" required>

          </div>
           
       

</div><!-- End of <div class="form-group form-group-sm" appearance_after_washing_garments_cross_staining-->


<div class="form-group form-group-sm">
   

   <div class="col-sm-3 text-center">
            <label class="control-label" for="appearance_after_wash_washing_cycle_garments" style="color:#00008B;">
            <span id="appearance_after_wash_washing_cycle_garments_label" style="display: none;"> Select Washing Cycle:</span>
            </label>
   </div>

 <div class="col-sm-2 text-center">
         
         <label class="control-label" for="description_or_type" style="color:#00008B;"> Differential Shrinkage (%)</label>

          <input type="hidden" class="form-control" id="test_method_for_appearance_after_washing_garments_differential_shrinkage" name="test_method_for_appearance_after_washing_garments_differential_shrinkage" value="ISO 105 C6">
         
 </div>

  <div class="col-sm-1 text-center">
        <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
   </div>  

  <div class="col-sm-1 text-center">
       
      <select  class="form-control" id="appearance_after_washing_garments_differential_shrinkage_tolerance_range_math_operator" name="appearance_after_washing_garments_differential_shrinkage_tolerance_range_math_operator" onchange="appearance_after_washing_differential_shrinkage_garments_cal()">
           <option value="">Select appearance after washing garments differential shrinkage Range Math Operator</option>
           <option value="+">+</option>
           <option value="-"> - </option>
           <option value=">"> ± </option>
     </select>
   </div>


   <div class="col-sm-1 text-center">
       <select  class="form-control" id="appearance_after_washing_garments__differential_shrinkage_tolerance_value" name="appearance_after_washing_garments__differential_shrinkage_tolerance_value" onchange="appearance_after_washing_differential_shrinkage_garments_cal()">
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
     <input type="hidden" class="form-control" id="uom_of_appearance_after_washing_garments__differential_shrinkage" name="uom_of_appearance_after_washing_garments__differential_shrinkage" value="%" >
   </div>

     
   <div class="col-sm-1 text-center" for="min_value">

       
        <input type="text" class="form-control" id="appearance_after_washing_garments__differential_shrinkage_min_value" name="appearance_after_washing_garments__differential_shrinkage_min_value" placeholder="Enter  Min Value" required>
      
   </div>
       
   <div class="col-sm-1 text-center">
       
       <input type="text" class="form-control" id="appearance_after_washing_garments__differential_shrinkage_max_value" name="appearance_after_washing_garments__differential_shrinkage_max_value" placeholder="Enter  Max Value" required>

    </div>
     
 

</div><!-- End of <div class="form-group form-group-sm" appearance_after_washing_garments__differential_shrinkage-->

<div class="form-group form-group-sm">
   

         <div class="col-sm-3 text-center">
                  <label class="control-label" for="appearance_after_wash_washing_cycle_garments" style="color:#00008B;">
                  <span id="appearance_after_wash_washing_cycle_garments_label" style="display: none;"> Select Washing Cycle:</span>
                  </label>
         </div>
      
       <div class="col-sm-2 text-center">
               
               <label class="control-label" for="description_or_type" style="color:#00008B;"> Surface Fuzzing</label>

                <input type="hidden" class="form-control" id="test_method_for_appearance_after_washing_garments_surface_fuzzing" name="test_method_for_appearance_after_washing_garments_surface_fuzzing" value="ISO 105 C6">
               
       </div>

        <div class="col-sm-1 text-center">
              <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
         </div>  

        <div class="col-sm-1 text-center">
             
            <select  class="form-control" id="appearance_after_washing_garments_surface_fuzzing_tolerance_range_math_operator" name="appearance_after_washing_garments_surface_fuzzing_tolerance_range_math_operator" onchange="appearance_after_washing_surface_fuzzing_garments_cal()">
                 <option value="">Select appearance after washing garments surface fuzzing Range Math Operator</option>
                 <option value="≥">≥</option>
                 <option value="≤"> ≤ </option>
                 <option value=">"> > </option>
               <option value="<"> < </option>
           </select>
         </div>


         <div class="col-sm-1 text-center">
             <select  class="form-control" id="appearance_after_washing_garments_surface_fuzzing_tolerance_value" name="appearance_after_washing_garments_surface_fuzzing_tolerance_value" onchange="appearance_after_washing_surface_fuzzing_garments_cal()">
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
           <input type="hidden" class="form-control" id="uom_of_appearance_after_washing_garments_surface_fuzzing" name="uom_of_appearance_after_washing_garments_surface_fuzzing" value="%" >
         </div>

           
         <div class="col-sm-1 text-center" for="min_value">

             
              <input type="text" class="form-control" id="appearance_after_washing_garments_surface_fuzzing_min_value" name="appearance_after_washing_garments_surface_fuzzing_min_value" placeholder="Enter  Min Value" required>
            
         </div>
             
         <div class="col-sm-1 text-center">
             
             <input type="text" class="form-control" id="appearance_after_washing_garments_surface_fuzzing_max_value" name="appearance_after_washing_garments_surface_fuzzing_max_value" placeholder="Enter  Max Value" required>

          </div>
           
       

      </div><!-- End of <div class="form-group form-group-sm" appearance_after_washing_garments_surface_fuzzing-->

      <div class="form-group form-group-sm">
   

         <div class="col-sm-3 text-center">
                  <label class="control-label" for="appearance_after_wash_washing_cycle_garments" style="color:#00008B;">
                  <span id="appearance_after_wash_washing_cycle_garments_label" style="display: none;"> Select Washing Cycle:</span>
                  </label>
         </div>
      
       <div class="col-sm-2 text-center">
               
               <label class="control-label" for="description_or_type" style="color:#00008B;"> Surface Pilling</label>

                <input type="hidden" class="form-control" id="test_method_for_appearance_after_washing_garments_surface_pilling" name="test_method_for_appearance_after_washing_garments_surface_pilling" value="ISO 105 C6">
               
       </div>

        <div class="col-sm-1 text-center">
              <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
         </div>  

        <div class="col-sm-1 text-center">
             
            <select  class="form-control" id="appearance_after_washing_garments_surface_pilling_tolerance_range_math_operator" name="appearance_after_washing_garments_surface_pilling_tolerance_range_math_operator" onchange="appearance_after_washing_surface_pilling_garments_cal()">
                 <option value="">Select appearance after washing surface pilling Range Math Operator</option>
                 <option value="≥">≥</option>
                 <option value="≤"> ≤ </option>
                 <option value=">"> > </option>
               <option value="<"> < </option>
           </select>
         </div>


         <div class="col-sm-1 text-center">
             <select  class="form-control" id="appearance_after_washing_garments_surface_pilling_tolerance_value" name="appearance_after_washing_garments_surface_pilling_tolerance_value" onchange="appearance_after_washing_surface_pilling_garments_cal()">
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
           <input type="hidden" class="form-control" id="uom_of_appearance_after_washing_garments_surface_pilling" name="uom_of_appearance_after_washing_garments_surface_pilling" value="%" >
         </div>

           
         <div class="col-sm-1 text-center" for="min_value">

             
              <input type="text" class="form-control" id="appearance_after_washing_garments_surface_pilling_min_value" name="appearance_after_washing_garments_surface_pilling_min_value" placeholder="Enter  Min Value" required>
            
         </div>
             
         <div class="col-sm-1 text-center">
             
             <input type="text" class="form-control" id="appearance_after_washing_garments_surface_pilling_max_value" name="appearance_after_washing_garments_surface_pilling_max_value" placeholder="Enter  Max Value" required>

          </div>
           
       

</div><!-- End of <div class="form-group form-group-sm" appearance_after_washing_garments_surface_pilling-->

 

<div class="form-group form-group-sm">
   

   <div class="col-sm-3 text-center">
            <label class="control-label" for="appearance_after_wash_washing_cycle_garments" style="color:#00008B;">
            <span id="appearance_after_wash_washing_cycle_garments_label" style="display: none;"> Select Washing Cycle:</span>
            </label>
   </div>

 <div class="col-sm-2 text-center">
         
         <label class="control-label" for="description_or_type" style="color:#00008B;"> Crease After Ironing</label>

          <input type="hidden" class="form-control" id="test_method_for_appearance_after_washing_garments_crease_after_ironing" name="test_method_for_appearance_after_washing_garments_crease_after_ironing" value="ISO 105 C6">
         
 </div>

  <div class="col-sm-1 text-center">
        <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
   </div>  

  <div class="col-sm-1 text-center">
       
      <select  class="form-control" id="appearance_after_washing_garments_crease_after_ironing_tolerance_range_math_operator" name="appearance_after_washing_garments_crease_after_ironing_tolerance_range_math_operator" onchange="appearance_after_washing_crease_after_ironing_garments_cal()">
           <option value="">Select appearance after washing garments surface pilling Range Math Operator</option>
           <option value="≥">≥</option>
           <option value="≤"> ≤ </option>
           <option value=">"> > </option>
         <option value="<"> < </option>
     </select>
   </div>


   <div class="col-sm-1 text-center">
       <select  class="form-control" id="appearance_after_washing_garments_crease_after_ironing_tolerance_value" name="appearance_after_washing_garments_crease_after_ironing_tolerance_value" onchange="appearance_after_washing_crease_after_ironing_garments_cal()">
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
     <input type="hidden" class="form-control" id="uom_of_appearance_after_washing_garments_crease_after_ironing" name="uom_of_appearance_after_washing_garments_crease_after_ironing" value="%" >
   </div>

     
   <div class="col-sm-1 text-center" for="min_value">

       
        <input type="text" class="form-control" id="appearance_after_washing_garments_crease_after_ironing_min_value" name="appearance_after_washing_garments_crease_after_ironing_min_value" placeholder="Enter  Min Value" required>
      
   </div>
       
   <div class="col-sm-1 text-center">
       
       <input type="text" class="form-control" id="appearance_after_washing_garments_crease_after_ironing_max_value" name="appearance_after_washing_garments_crease_after_ironing_max_value" placeholder="Enter  Max Value" required>

    </div>
     
 

</div><!-- End of <div class="form-group form-group-sm" appearance_after_washing_garments_crease_after_ironing-->


<div class="form-group form-group-sm">
   

   <div class="col-sm-3 text-center">
            <label class="control-label" for="appearance_after_wash_washing_cycle_garments" style="color:#00008B;">
            <span id="appearance_after_wash_washing_cycle_garments_label" style="display: none;"> Select Washing Cycle:</span>
            </label>
   </div>

 <div class="col-sm-2 text-center">
         
         <label class="control-label" for="description_or_type" style="color:#00008B;"> Abrasive Mark</label>

          <input type="hidden" class="form-control" id="test_method_for_appearance_after_washing_garments_abrasive_mark" name="test_method_for_appearance_after_washing_garments_abrasive_mark" value="ISO 105 C6">
         
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

   

    
   <div class="col-sm-1 text-center">
        <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
   </div> 

     
   <div class="col-sm-2 text-center">
       
       <select  class="form-control" id="appearance_after_washing_garments_abrasive_mark" name="appearance_after_washing_garments_abrasive_mark">
            <option value="">Select appearance after washing abrasive mark</option>
            <option value="No">No</option>
            <option value="Negligible"> Negligible </option>
            <option value="Slight"> Slight </option>
      </select>
    </div>
     
 

</div><!-- End of <div class="form-group form-group-sm" appearance_after_washing_garments_abrasive_mark-->

<div class="form-group form-group-sm">
   

   <div class="col-sm-3 text-center">
            <label class="control-label" for="appearance_after_wash_washing_cycle_garments" style="color:#00008B;">
            <span id="appearance_after_wash_washing_cycle_garments_label" style="display: none;"> Select Washing Cycle:</span>
            </label>
   </div>

 <div class="col-sm-2 text-center">
         
         <label class="control-label" for="description_or_type" style="color:#00008B;"> Seam Breakdown</label>

          <input type="hidden" class="form-control" id="test_method_for_appearance_after_washing_garments_seam_breakdown" name="test_method_for_appearance_after_washing_garments_seam_breakdown" value="ISO 105 C6">
         
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

   

    
   <div class="col-sm-1 text-center">
        <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
   </div> 

     
   <div class="col-sm-2 text-center">
        <input type="text"  class="form-control" id="seam_breakdown_garments" name="seam_breakdown_garments" placeholder="Enter seam breakdown" required>
   </div> 
     
 

</div><!-- End of <div class="form-group form-group-sm" appearance_after_washing_garments_seam_breakdown-->

<div class="form-group form-group-sm">
   

   <div class="col-sm-3 text-center">
            <label class="control-label" for="appearance_after_wash_washing_cycle_garments" style="color:#00008B;">
            <span id="appearance_after_wash_washing_cycle_garments_label" style="display: none;"> Select Washing Cycle:</span>
            </label>
   </div>

 <div class="col-sm-2 text-center">
         
         <label class="control-label" for="description_or_type" style="color:#00008B;"> Seam puckering or roping After Iron</label>

          <input type="hidden" class="form-control" id="test_method_for_appearance_after_washing_garments_seam_puckering_roping_after_iron" name="test_method_for_appearance_after_washing_garments_seam_puckering_roping_after_iron" value="ISO 105 C6">
         
 </div>

  <div class="col-sm-1 text-center">
        <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
   </div>  

  <div class="col-sm-1 text-center">
       
      <select  class="form-control" id="appearance_after_washing_garments_seam_puckering_roping_after_iron_tolerance_range_math_operator" name="appearance_after_washing_garments_seam_puckering_roping_after_iron_tolerance_range_math_operator" onchange="appearance_after_washing_seam_puckering_garments_cal()">
           <option value="">Select appearance after washing garments seam puckering roping after iron surface pilling Range Math Operator</option>
           <option value="≥">≥</option>
           <option value="≤"> ≤ </option>
           <option value=">"> > </option>
         <option value="<"> < </option>
     </select>
   </div>


   <div class="col-sm-1 text-center">
       <select  class="form-control" id="appearance_after_washing_garments_seam_puckering_roping_after_iron_tolerance_value" name="appearance_after_washing_garments_seam_puckering_roping_after_iron_tolerance_value" onchange="appearance_after_washing_seam_puckering_garments_cal()">
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
     <input type="hidden" class="form-control" id="uom_of_appearance_after_washing_garments_seam_puckering_roping_after_iron" name="uom_of_appearance_after_washing_garments_seam_puckering_roping_after_iron" value="%" >
   </div>

     
   <div class="col-sm-1 text-center" for="min_value">

       
        <input type="text" class="form-control" id="appearance_after_washing_garments_seam_puckering_roping_after_iron_min_value" name="appearance_after_washing_garments_seam_puckering_roping_after_iron_min_value" placeholder="Enter  Min Value" required>
      
   </div>
       
   <div class="col-sm-1 text-center">
       
       <input type="text" class="form-control" id="appearance_after_washing_garments_seam_puckering_roping_after_iron_max_value" name="appearance_after_washing_garments_seam_puckering_roping_after_iron_max_value" placeholder="Enter  Max Value" required>

    </div>
     
 

</div><!-- End of <div class="form-group form-group-sm" appearance_after_washing_garments_seam_puckering_roping_after_iron-->

<div class="form-group form-group-sm">
   

   <div class="col-sm-3 text-center">
            <label class="control-label" for="appearance_after_wash_washing_cycle_garments" style="color:#00008B;">
            <span id="appearance_after_wash_washing_cycle_garments_label" style="display: none;"> Select Washing Cycle:</span>
            </label>
   </div>

 <div class="col-sm-2 text-center">
         
         <label class="control-label" for="description_or_type" style="color:#00008B;"> Detachment of interlinings / fused components</label>

          <input type="hidden" class="form-control" id="test_method_for_appearance_after_washing_garments_detachment_of_interlining" name="test_method_for_appearance_after_washing_garments_detachment_of_interlining" value="ISO 105 C6">
         
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

   

    
   <div class="col-sm-1 text-center">
        <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
   </div> 

      
   <div class="col-sm-2 text-center">
        <input type="text"  class="form-control" id="detachment_of_interlinings_fused_components_garments" name="detachment_of_interlinings_fused_components_garments" placeholder="Enter detachment of interlinings / fused components" required>
   </div> 
     
 

</div><!-- End of <div class="form-group form-group-sm" appearance_after_washing_garments_detachment_of_interlining-------->

<div class="form-group form-group-sm">
   

   <div class="col-sm-3 text-center">
            <label class="control-label" for="appearance_after_wash_washing_cycle_garments" style="color:#00008B;">
            <span id="appearance_after_wash_washing_cycle_garments_label" style="display: none;"> Select Washing Cycle:</span>
            </label>
   </div>

 <div class="col-sm-2 text-center">
         
         <label class="control-label" for="description_or_type" style="color:#00008B;"> Change in handle or appearance</label>

          <input type="hidden" class="form-control" id="test_method_for_appearance_after_washing_garments_change_in_handle_or_appearance" name="test_method_for_appearance_after_washing_garments_change_in_handle_or_appearance" value="ISO 105 C6">
         
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

   

    
   <div class="col-sm-1 text-center">
        <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
   </div> 

     
     
   <div class="col-sm-2 text-center">
        <input type="text"  class="form-control" id="change_id_handle_or_appearance" name="change_id_handle_or_appearance" placeholder="Enter change in handle or appearance" required>
   </div> 
     
 

</div><!-- End of <div class="form-group form-group-sm" appearance_after_washing_garments_in_handle_or_appearance-------->

<div class="form-group form-group-sm">
   

   <div class="col-sm-3 text-center">
            <label class="control-label" for="appearance_after_wash_washing_cycle_garments" style="color:#00008B;">
            <span id="appearance_after_wash_washing_cycle_garments_label" style="display: none;"> Select Washing Cycle:</span>
            </label>
   </div>

 <div class="col-sm-2 text-center">
         
         <label class="control-label" for="description_or_type" style="color:#00008B;"> Effect on accessories such as buttons, zips etc.</label>

          <input type="hidden" class="form-control" id="test_method_for_appearance_after_washing_garments_effect_accessories" name="test_method_for_appearance_after_washing_garments_effect_accessories" value="ISO 105 C6">
         
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

   

    
   <div class="col-sm-1 text-center">
        <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
   </div> 

   <div class="col-sm-2 text-center">
        <input type="text"  class="form-control" id="effect_on_accessories_such_as_buttons" name="effect_on_accessories_such_as_buttons" placeholder="Enter Effect on accessories such as buttons, zips ete." required>
   </div>
     
 

</div><!-- End of <div class="form-group form-group-sm" appearance_after_washing_garments_effect_accessories-------->

<div class="form-group form-group-sm">
   

   <div class="col-sm-3 text-center">
            <label class="control-label" for="appearance_after_wash_washing_cycle_garments" style="color:#00008B;">
            <span id="appearance_after_wash_washing_cycle_garments_label" style="display: none;"> Select Washing Cycle:</span>
            </label>
   </div>

 <div class="col-sm-2 text-center">
         
         <label class="control-label" for="description_or_type" style="color:#00008B;"> Spirality (%)</label>

          <input type="hidden" class="form-control" id="test_method_for_appearance_after_washing_garments_spirality" name="test_method_for_appearance_after_washing_garments_spirality" value="ISO 105 C6">
         
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

   

    
   <div class="col-sm-1 text-center">
        <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
   </div>

     
   <div class="col-sm-1 text-center" for="min_value">

       
        <input type="text" class="form-control" id="appearance_after_washing_garments_spirality_min_value" name="appearance_after_washing_garments_spirality_min_value" placeholder="Enter  Min Value" required>
      
   </div>
       
   <div class="col-sm-1 text-center">
       
       <input type="text" class="form-control" id="appearance_after_washing_garments_spirality_max_value" name="appearance_after_washing_garments_spirality_max_value" placeholder="Enter  Max Value" required>

    </div>
     
 

</div><!-- End of <div class="form-group form-group-sm" appearance_after_washing_garments_spirality-->

<div class="form-group form-group-sm">
   

   <div class="col-sm-3 text-center">
            <label class="control-label" for="appearance_after_wash_washing_cycle_garments" style="color:#00008B;">
            <span id="appearance_after_wash_washing_cycle_garments_label" style="display: none;"> Select Washing Cycle:</span>
            </label>
   </div>

 <div class="col-sm-2 text-center">
         
         <label class="control-label" for="description_or_type" style="color:#00008B;"> Detachment or Fraying of ribbons / trims</label>

          <input type="hidden" class="form-control" id="test_method_for_appearance_after_washing_garments_detachment_or_fraying_of_ribbons" name="test_method_for_appearance_after_washing_garments_detachment_or_fraying_of_ribbons" value="ISO 105 C6">
         
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

   

    
   <div class="col-sm-1 text-center">
        <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
   </div> 

   <div class="col-sm-2 text-center">
        <input type="text"  class="form-control" id="detachment_or_fraying_of_ribbons" name="detachment_or_fraying_of_ribbons" placeholder="Enter detachment or fraying of ribbons / trims" required>
   </div>
     
 

</div><!-- End of <div class="form-group form-group-sm" appearance_after_washing_garments_detachment_or_fraying_of_ribbons-------->

<div class="form-group form-group-sm">
   

   <div class="col-sm-3 text-center">
            <label class="control-label" for="appearance_after_wash_washing_cycle_garments" style="color:#00008B;">
            <span id="appearance_after_wash_washing_cycle_garments_label" style="display: none;"> Select Washing Cycle:</span>
            </label>
   </div>

 <div class="col-sm-2 text-center">
         
         <label class="control-label" for="description_or_type" style="color:#00008B;"> Loss of Print</label>

          <input type="hidden" class="form-control" id="test_method_for_appearance_after_washing_garments_loss_of_print" name="test_method_for_appearance_after_washing_garments_loss_of_print" value="ISO 105 C6">
         
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

   

    
   <div class="col-sm-1 text-center">
        <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
   </div> 

     
   <div class="col-sm-2 text-center">
        <input type="text"  class="form-control" id="loss_of_print_garments" name="loss_of_print_garments" placeholder="Enter loss of prints" required>
   </div>
     
 

</div><!-- End of <div class="form-group form-group-sm" appearance_after_washing_garments_loss_of_print-------->

<div class="form-group form-group-sm">
   

   <div class="col-sm-3 text-center">
            <label class="control-label" for="appearance_after_wash_washing_cycle_garments" style="color:#00008B;">
            <span id="appearance_after_wash_washing_cycle_garments_label" style="display: none;"> Select Washing Cycle:</span>
            </label>
   </div>

 <div class="col-sm-2 text-center">
         
         <label class="control-label" for="description_or_type" style="color:#00008B;"> Care Level</label>

          <input type="hidden" class="form-control" id="test_method_for_appearance_after_washing_garments_care_level" name="test_method_for_appearance_after_washing_garments_care_level" value="ISO 105 C6">
         
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

   

    
   <div class="col-sm-1 text-center">
        <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
   </div> 

     
     
   <div class="col-sm-2 text-center">
        <input type="text"  class="form-control" id="care_level_garments" name="care_level_garments" placeholder="Enter care levels" required>
   </div>
     
 

</div><!-- End of <div class="form-group form-group-sm" appearance_after_washing_garments_care_level-------->

<div class="form-group form-group-sm">
   

   <div class="col-sm-3 text-center">
            <label class="control-label" for="appearance_after_wash_washing_cycle_garments" style="color:#00008B;">
            <span id="appearance_after_wash_washing_cycle_garments_label" style="display: none;"> Select Washing Cycle:</span>
            </label>
   </div>

 <div class="col-sm-2 text-center">
         
         <label class="control-label" for="description_or_type" style="color:#00008B;"> Odor</label>

          <input type="hidden" class="form-control" id="test_method_for_appearance_after_washing_garments_odor" name="test_method_for_appearance_after_washing_garments_odor" value="ISO 105 C6">
         
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

   

    
   <div class="col-sm-1 text-center">
        <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
   </div> 

     
   <div class="col-sm-2 text-center">
        <input type="text"  class="form-control" id="odor_garments" name="odor_garments" placeholder="Enter odor" required>
   </div> 
     
 

</div>
<!-- End of <div class="form-group form-group-sm" appearance_after_washing_garments_odor-->

<!-- Start Test name for appearance after washing for garments for other observation-->
<div class="form-group form-group-sm">
   

   <div class="col-sm-3 text-center">
            <label class="control-label" for="appearance_after_wash_washing_cycle_garments" style="color:#00008B;">
            <span id="appearance_after_wash_washing_cycle_garments_label" style="display: none;"> Select Washing Cycle:</span>
            </label>
   </div>

 <div class="col-sm-2 text-center">
         
         <label class="control-label" for="other_observation" style="color:#00008B;"> Other Observation</label>

          <input type="hidden" class="form-control" id="test_method_for_appearance_after_washing_garments_other_observation" name="test_method_for_appearance_after_washing_garments_other_observation" value="">
         
 </div>

     
   <div class="col-sm-6 text-center">
      <textarea class="form-control" name="appearance_after_washing_other_observation_garments" id="appearance_after_washing_other_observation_garments" cols="30" rows="2" placeholder="Enter other observation" required></textarea>
   </div> 
     
 

</div>
<!-- End of <div class="form-group form-group-sm" appearance_after_washing_garments_other_observation-->
<!-- End Test name for appearance after washing for garments for other observation-->

</div>                <!--end div appearance after wash garments------------------------------------------------------------------->

</div> <!--  End of <div id="div_appearance_after_wash_full" style="display: none;"> -->
<!-- -------------------------------------------------------------------------------Appearance after wash end---------------------------------------------------------------------------------------------------------------------- -->


</div>  <!-- End of <div class="full_page_load" id="full_page_load" style="display :none"> -->
						



						<div class="form-group form-group-sm">
								<div class="col-sm-offset-3 col-sm-5">
									<button type="button" class="btn btn-primary" onClick="sending_data_of_defining_qc_standard_for_curing_process_form_for_saving_in_database()">Submit</button>
									<button type="reset" class="btn btn-success">Reset</button>
		                       </div>
						</div>

</form>

		</div> <!-- End of <div class="panel panel-default"> -->

</div> <!-- End of <div class="col-sm-12 col-md-12 col-lg-12"> -->