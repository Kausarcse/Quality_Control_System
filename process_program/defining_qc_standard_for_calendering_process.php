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
<script type='text/javascript' src='process_program/defining_qc_standard_for_calendering_process_form_validation.js'></script>
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

  var splitted_version_details= version_details.split('?fs?');

/*  document.getElementById('version_name').value=splitted_version_details[0];
*/ document.getElementById('color').value=splitted_version_details[1];
  document.getElementById('finish_width_in_inch').value=splitted_version_details[2]; 
  document.getElementById('customer_name').value=splitted_version_details[3]; 
  document.getElementById('customer_id').value=splitted_version_details[5];
  document.getElementById('standard_for_which_process').value='Calendering'; 

   var value_for_data= 'customer_id='+splitted_version_details[5];
 $.ajax({
               url: 'process_program/return_test_name_method.php',
               dataType: 'text',
               type: 'post',
               contentType: 'application/x-www-form-urlencoded',
               data: value_for_data,
                     
               success: function( data, textStatus, jQxhr )
               {       
                      
                   
                     
                    var split_all_data= data.split('?met?');
                    var data= split_all_data[0];
                    var test_method_id=split_all_data[1];
                    var test_name_method=split_all_data[2];
                  
                  
                    var test_method_id= test_method_id.split('?tnm?');


                    var test_name_method= test_name_method.split('?tnm?');
                    //alert(test_name_method[1]);

                    var test_method_for_all='';


                    $("#checking_data").val(data);

                    var splitted_data= data.split('?fs?');

                   /* if($('#div_cf_to_rubbing') && $('#div_whiteness') )
                    {
                     alert($('#div_cf_to_rubbing').length);
                     alert($('#div_whiteness').length);
                    }
                   */
                    var temp_arr = data.split('?fs?');
                    data=data+'?fs?';
                    
                  
                   for(var i =0; i<splitted_data.length; i++) {
                        
                        for(var j =0; j<splitted_data.length; j++) {
                            if(i!=j) splitted_data[j]="";
                        }
 // Color Fastness To Rubbing
                   if((splitted_data.includes('1') || splitted_data.includes('240') || splitted_data.includes('105') || splitted_data.includes('164') || splitted_data.includes('207') || splitted_data.includes('247') || splitted_data.includes('259') || splitted_data.includes('298')) && $('#div_cf_to_rubbing').length !== 0) 
                     {
                        
                        test_method_for_all+=test_method_id[i]+',';
                      
                        $(".full_page_load").show();
                        $("#div_cf_to_rubbing").show();


                        $("#for_cf_to_rubbing_dry_test_name_label").html(test_name_method[i]);
                        $("#cf_to_rubbing_dry_test_method").hide();
                          
                     } 
                        
//For Dimensional Stability To Washing

                     if((splitted_data.includes('2') || splitted_data.includes('116') || splitted_data.includes('160') || splitted_data.includes('175') || splitted_data.includes('188') || splitted_data.includes('202') || splitted_data.includes('231') || splitted_data.includes('245') || splitted_data.includes('264') || splitted_data.includes('276') || splitted_data.includes('284')) && $('#div_dimensional_stability_to_washing').length !== 0) 
                     {
                        
                        test_method_for_all+=test_method_id[i]+',';
                      
                        $(".full_page_load").show();
                        $("#div_dimensional_stability_to_washing").show();

                       
                        $("#for_dimensional_stability_to_warp_washing_before_iron_test_name_label").html(test_name_method[i]);
                        $("#dimensional_stability_to_warp_washing_before_iron_test_method").hide();
                          
                     } 

                     //yarn count

                      if((splitted_data.includes('3')) && $('#div_appearance_after_wash_full').length !== 0 )  
                     {
                        
                        test_method_for_all+=test_method_id[i]+',';
                    
                        $(".full_page_load").show();
                        $("#div_appearance_after_wash_full").show();  
                       
                         
                        $("#appearance_after_wash_label").html(test_name_method[i]);
                        $("#appearance_after_wash_test_method").hide(); 
                        
                     }  
           
 // For div_yarn_count  

                     if( (splitted_data.includes('74')  || splitted_data.includes('112')) && $('#div_yarn_count').length !== 0 )  
                     {
                        
                        test_method_for_all+=test_method_id[i]+',';
                    
                        $(".full_page_load").show();
                        $("#div_yarn_count").show();  
                       
                         
                        $("#for_warp_yarn_count_test_name_label").html(test_name_method[i]);
                        $("#warp_yarn_count_test_method").hide(); 
                        
                     }  
           
           
// For div_number_of_threads_per_unit_length 

                     if((splitted_data.includes('4') || splitted_data.includes('113')|| splitted_data.includes('122')|| splitted_data.includes('146')|| splitted_data.includes('183')|| splitted_data.includes('213')|| splitted_data.includes('221')|| splitted_data.includes('254')|| splitted_data.includes('283')|| splitted_data.includes('299')) && $('#div_number_of_threads_per_unit_length').length !== 0) 
                     {
                        
                        test_method_for_all+=test_method_id[i]+',';
                      
                        $(".full_page_load").show();
                        $("#div_number_of_threads_per_unit_length").show();

                         $("#for_no_of_threads_in_warp_test_name_label").html(test_name_method[i]);
                        $("#no_of_threads_in_warp_test_method").hide(); 
                        
                     }
           
// For Mass Per Unit Area

                     if((splitted_data.includes('5') || splitted_data.includes('114') || splitted_data.includes('123') || splitted_data.includes('134') || splitted_data.includes('147') || splitted_data.includes('199') || splitted_data.includes('300') || splitted_data.includes('229') || splitted_data.includes('301')) && $('#div_mass_per_unit_area').length !== 0) 
                     {
                        
                        test_method_for_all+=test_method_id[i]+',';
                      
                        $(".full_page_load").show();
                        $("#div_mass_per_unit_area").show();
            
             $("#for_mass_per_unit_per_area_test_name_label").html(test_name_method[i]);
                        $("#mass_per_unit_per_area_test_method").hide(); 
            
                     }

//For div_tensile_properties

                     if((splitted_data.includes('7') || splitted_data.includes('115') || splitted_data.includes('263') || splitted_data.includes('274') || splitted_data.includes('302')) && $('#div_tensile_properties').length !== 0)  
                     {
                        
                        test_method_for_all+=test_method_id[i]+',';

                   
                        $(".full_page_load").show();
                        $("#div_tensile_properties").show();
            
            $("#for_tensile_properties_in_warp_test_name_label").html(test_name_method[i]);
                        $("#tensile_properties_in_warp_test_method").hide();
                        
                     }     
 //For div_tear_force

                      if((splitted_data.includes('8') || splitted_data.includes('135') || splitted_data.includes('148') || splitted_data.includes('201') || splitted_data.includes('275') || splitted_data.includes('303')) && $('#div_tear_force').length !== 0) 
                     {
                        
                        
                        test_method_for_all+=test_method_id[i]+',';
                        
                        $(".full_page_load").show();
                        $("#div_tear_force").show();
            
            $("#for_tear_force_in_warp_test_name_label").html(test_name_method[i]);
                        $("#tear_force_in_warp_test_method").hide();
                        
                        
                     }     
// For div_seam_slippage

                     if((splitted_data.includes('9') || splitted_data.includes('186') || splitted_data.includes('230')) && $('#div_seam_slippage').length !== 0)
                     {
                        
                        test_method_for_all+=test_method_id[i]+',';
                       
                        $(".full_page_load").show();
                        $("#div_seam_slippage").show();
            
                      $("#for_seam_slippage_resistance_in_warp_test_name_label ").html(test_name_method[i]);
                        $("#seam_slippage_resistance_in_warp_test_method").hide();
                        
                     }
 // for   div_bowing_and_skew
                     if(splitted_data.includes('10') && $('#div_bowing_and_skew').length !== 0)
                     {
                        test_method_for_all+=test_method_id[i]+',';
                       
                        $(".full_page_load").show();
                        $("#div_bowing_and_skew").show();

                        $("#for_bowing_and_skew_test_name_lable").html(test_name_method[i]);
                        $("#bowing_and_skew_test_method").hide();

                     }
           
// For div_seam_strength
                     if((splitted_data.includes('11') || splitted_data.includes('149') || splitted_data.includes('187') || splitted_data.includes('244') || splitted_data.includes('304')) && $('#div_seam_strength').length !== 0)
                     {
                        test_method_for_all+=test_method_id[i]+',';
                        
                        $(".full_page_load").show();
                        $("#div_seam_strength").show();
            
                     $("#for_seam_strength_in_warp_test_name_label").html(test_name_method[i]);
                        $("#seam_strength_in_warp_test_method").hide();

                     }
           
//div_seam_properties

                     if(splitted_data.includes('12') && $('#div_seam_properties').length !== 0)
                     {
                        test_method_for_all+=test_method_id[i]+',';
                      
                        $(".full_page_load").show();
                        $("#div_seam_properties").show();

                         $("#for_seam_properties_seam_slippage_iso_astm_d_in_warp_test_name_label").html(test_name_method[i]);
                        $("#seam_properties_seam_slippage_iso_astm_d_in_warp_test_method").hide();
                         

                     }
//mass loss in abrasion
                     if(splitted_data.includes('13') && $('#div_mass_loss_in_abrasion').length !== 0)
                     {
                        test_method_for_all+=test_method_id[i]+',';
                        
                        $(".full_page_load").show();
                        $("#div_mass_loss_in_abrasion").show();     

                        $("#for_mass_loss_in_abrasion_test_name_label").html(test_name_method[i]);
                        $("#mass_loss_in_abrasion_test_method").hide();
  
                     }
//For  abrasion div_abrasion_resistance
                     if((splitted_data.includes('13') || splitted_data.includes('138') || splitted_data.includes('173')) && $('#div_abrasion_resistance').length !== 0)
                     {
                        test_method_for_all+=test_method_id[i]+',';
                        
                        $(".full_page_load").show();
                        $("#div_abrasion_resistance").show();
            
             $("#for_abrasion_resistance_no_of_thread_break_test_name_label").html(test_name_method[i]);
                         $("#abrasion_resistance_no_of_thread_break_test_method").hide();
  
                     }  
// For div_color_fastness_to_washing

                     if((splitted_data.includes('15') ||splitted_data.includes('59')||splitted_data.includes('119')||splitted_data.includes('128')||splitted_data.includes('155')||splitted_data.includes('165')||splitted_data.includes('223')||splitted_data.includes('227')||splitted_data.includes('177')||splitted_data.includes('292'))  && $('#div_color_fastness_to_washing').length !== 0)
                     {
                        test_method_for_all+=test_method_id[i]+',';
                      
                        $(".full_page_load").show();
                        $("#div_color_fastness_to_washing").show();
            
             $("#for_cf_to_washing_color_change_test_name_label").html(test_name_method[i]);
                         $("#cf_to_washing_color_change_test_method").hide();
                     }
           
// For  div_cf_to_dry_cleaning
                     if((splitted_data.includes('16') || splitted_data.includes('145')) && $('#div_cf_to_dry_cleaning').length !== 0)
                     {
                        test_method_for_all+=test_method_id[i]+',';
                       
                        $(".full_page_load").show();
                        $("#div_cf_to_dry_cleaning").show();
            
            $("#for_cf_to_dry_cleaning_color_change_test_name_label").html(test_name_method[i]);
                        $("#cf_to_washing_color_change_test_method").hide();

                     }

//----------------------------------------------------Only div -----------------------------------------------------------------------------------

 // div_cf_to_perspiration_acid 17,61,
                     if((splitted_data.includes('17') || splitted_data.includes('61')) && $('#div_cf_to_perspiration_acid').length !== 0)
                     {
                        test_method_for_all+=test_method_id[i]+',';
                       
                        $(".full_page_load").show();
                        $("#div_cf_to_perspiration_acid").show();
                        /*alert(i);
                        alert(test_name_method['21']);
                        alert(test_name_method);*/
                        $("#for_perspiration_acid_color_change_test_name_label").html(test_name_method[i]);
                        $("#perspiration_acid_color_change_test_method").hide();

                     }
           
// div_cf_to_perspiration_alkali  id> 120,62,18,129,194,269

                     if((splitted_data.includes('18') || splitted_data.includes('120') || splitted_data.includes('62') || splitted_data.includes('18') || splitted_data.includes('129') || splitted_data.includes('194') || splitted_data.includes('269')) && $('#div_cf_to_perspiration_alkali').length !== 0)
                     {
                        test_method_for_all+=test_method_id[i]+',';
                  
                        $(".full_page_load").show();
                        $("#div_cf_to_perspiration_alkali").show();
            
            $("#for_cf_to_perspiration_alkali_color_change_test_name_label").html(test_name_method[i]);
                        $("#cf_to_perspiration_alkali_color_change_test_method").hide();

                     }
           
           
// for div_color_fastness_to_water 121,141,167,228

                     if((splitted_data.includes('19') || splitted_data.includes('121') || splitted_data.includes('141') || splitted_data.includes('167') || splitted_data.includes('228')) && $('#div_color_fastness_to_water').length !== 0)
                     {
                        test_method_for_all+=test_method_id[i]+',';
                       
                        $(".full_page_load").show();
                        $("#div_color_fastness_to_water").show();
            
            $("#for_cf_to_water_color_change_test_name_label").html(test_name_method[i]);
                        $("#cf_to_water_color_change_test_method").hide();

                     }

// for div_color_fastness_to_water_spotting  20,65,196
                     if((splitted_data.includes('20') || splitted_data.includes('65') || splitted_data.includes('196')) && $('#div_color_fastness_to_water_spotting').length !== 0)
                     {
                        test_method_for_all+=test_method_id[i]+',';
                       
                        $(".full_page_load").show();
                        $("#div_color_fastness_to_water_spotting").show();
            
            $("#for_cf_to_water_spotting_surface_test_name_label").html(test_name_method[i]);
                        $("#cf_to_water_spotting_surface_test_method").hide();


                     }
           
           
//for   div_resistance_to_surface_wetting  206,21,22,66      
            if((splitted_data.includes('21') || splitted_data.includes('206') || splitted_data.includes('22') || splitted_data.includes('66')) && $('#div_resistance_to_surface_wetting').length !== 0)
                     {
                        test_method_for_all+=test_method_id[i]+',';
                        
                        $(".full_page_load").show();
                        $("#div_resistance_to_surface_wetting").show();
            
            $("#for_resistance_to_surface_wetting_before_wash_test_name_label").html(test_name_method[i]);
                        $("#resistance_to_surface_wetting_before_wash_test_method").hide();

                     }
           
//for div_cf_to_hydrolysis_of_reactive_dyes  23,67
              if((splitted_data.includes('23') || splitted_data.includes('67')) && $('#div_cf_to_hydrolysis_of_reactive_dyes').length !== 0)
                     {
                        test_method_for_all+=test_method_id[i]+',';
                      
                        $(".full_page_load").show();
                        $("#div_cf_to_hydrolysis_of_reactive_dyes").show();
            
            $("#for_cf_to_hydrolysis_of_reactive_dyes_color_change_test_name_label").html(test_name_method[i]);
                        $("#cf_to_hydrolysis_of_reactive_dyes_color_change_test_method").hide();

                     }

// for div_cf_to_oxidative_bleach_damage 24,68
                     if((splitted_data.includes('24')|| splitted_data.includes('68')) && $('#div_cf_to_oxidative_bleach_damage').length !== 0)
                     {
                        test_method_for_all+=test_method_id[i]+',';
                        
                        $(".full_page_load").show();
                        $("#div_cf_to_oxidative_bleach_damage").show();
            
                        $("#for_cf_to_oxidative_bleach_damage_color_change_test_name_label").html(test_name_method[i]);
                        $("#cf_to_oxidative_bleach_damage_color_change").hide();

                     }
// for div_cf_to_phenolic_yellowing 158,25,69
                     if((splitted_data.includes('25') || splitted_data.includes('158') || splitted_data.includes('69')) && $('#div_cf_to_phenolic_yellowing').length !== 0)
                     {
                        test_method_for_all+=test_method_id[i]+',';
                        
                        $(".full_page_load").show();
                        $("#div_cf_to_phenolic_yellowing").show();
            
            $("#for_cf_to_phenolic_yellowing_staining_test_name_label").html(test_name_method[i]);
                        $("#cf_to_phenolic_yellowing_staining_test_method").hide();

                     }
//for div_migration_of_color_into_pvc 132,169,143,26,70,195,211,
                     if((splitted_data.includes('26') || splitted_data.includes('132') || splitted_data.includes('169') || splitted_data.includes('143') || splitted_data.includes('26') || splitted_data.includes('70') || splitted_data.includes('195') || splitted_data.includes('211')) && $('#div_migration_of_color_into_pvc').length !== 0)
                     {
                        test_method_for_all+=test_method_id[i]+',';
                       
                        $(".full_page_load").show();
                        $("#div_migration_of_color_into_pvc").show();
            
            $("#for_cf_to_pvc_migration_staining_test_name_label").html(test_name_method[i]);
                        $("#cf_to_pvc_migration_staining_test_method").hide();

                     }
           
//for div_cf_to_saliva 27,71,168,156,
                     if((splitted_data.includes('27') || splitted_data.includes('71') || splitted_data.includes('168') || splitted_data.includes('156')) && $('#div_cf_to_saliva').length !== 0)
                     {
                        test_method_for_all+=test_method_id[i]+',';
                     
                        $(".full_page_load").show();
                        $("#div_cf_to_saliva").show();
            
            $("#for_cf_to_saliva_color_change_test_name_label").html(test_name_method[i]);
                        $("#cf_to_saliva_color_change_test_method").hide();

                     }
//for div_cf_to_chlorinated_water 210,224,28,72,142
                     if((splitted_data.includes('28') || splitted_data.includes('210') || splitted_data.includes('224') || splitted_data.includes('72') || splitted_data.includes('142') ) && $('#div_cf_to_chlorinated_water').length !== 0)
                     {
                        test_method_for_all+=test_method_id[i]+',';
                       
                        $(".full_page_load").show();
                        $("#div_cf_to_chlorinated_water").show();
            
            $("#for_cf_to_chlorinated_water_color_change_test_name_label").html(test_name_method[i]);
                        $("#cf_to_chlorinated_water_color_change_test_method").hide();
            
                     }
//for div_cf_to_chlorine_bleach 241,29,73,285
                     if((splitted_data.includes('29') || splitted_data.includes('241') || splitted_data.includes('73') || splitted_data.includes('285')) && $('#div_cf_to_chlorine_bleach').length !== 0)
                     {
                        test_method_for_all+=test_method_id[i]+',';
                     
                        $(".full_page_load").show();
                        $("#div_cf_to_chlorine_bleach").show();
            
            $("#for_cf_to_cholorine_bleach_color_change_test_name_label").html(test_name_method[i]);
                        $("#cf_to_cholorine_bleach_color_change_test_method").hide();

                     }
//30,75
                      if((splitted_data.includes('30') || splitted_data.includes('75')) && $('#div_cf_to_peroxide_bleach').length !== 0)
                     {
                        test_method_for_all+=test_method_id[i]+',';
                       
                        $(".full_page_load").show();
                        $("#div_cf_to_peroxide_bleach").show();
            
            $("#for_cf_to_peroxide_bleach_color_change_test_name_label").html(test_name_method[i]);
                        $("#cf_to_peroxide_bleach_color_change_test_method").hide();

                     }
//31,76
                     if((splitted_data.includes('31') || splitted_data.includes('76')) && $('#div_cross_staining').length !== 0)
                     {
                        test_method_for_all+=test_method_id[i]+',';
                        
                        $(".full_page_load").show();
                        $("#div_cross_staining").show();
            
            $("#for_cross_staining_test_name_label").html(test_name_method[i]);
                        $("#cross_staining_test_method").hide();

                     }
//for div_formaldehyde_content 118,170,32,77,235,258
                      if((splitted_data.includes('32') || splitted_data.includes('118') || splitted_data.includes('77') || splitted_data.includes('235') || splitted_data.includes('258')) && $('#div_formaldehyde_content').length !== 0)
                     {
                        test_method_for_all+=test_method_id[i]+',';
                        
                        $(".full_page_load").show();
                        $("#div_formaldehyde_content").show();
                       
            
                        $("#for_formaldehyde_content_test_name_label").html(test_name_method[i]);
                        $("#formaldehyde_content_test_method").hide();

                     }


// for div 109,33,78,237,170
                     if((splitted_data.includes('33') || splitted_data.includes('109') || splitted_data.includes('78') || splitted_data.includes('237') || splitted_data.includes('170')) && $('#div_ph').length !== 0)
                     {
                        test_method_for_all+=test_method_id[i]+',';
                        $(".full_page_load").show();
                        $("#div_ph").show();
            
                       $("#for_ph_test_name_label").html(test_name_method[i]);
                        $("#ph_test_method").hide();
                     }
//191,34,89
                      if((splitted_data.includes('34') || splitted_data.includes('191') || splitted_data.includes('89')) && $('#div_water_absorption').length !== 0)
                     {
                        test_method_for_all+=test_method_id[i]+',';
                        
                        $(".full_page_load").show();
                        $("#div_water_absorption").show();
            
                       $("#for_water_absorption_test_name_label").html(test_name_method[i]);
                        $("#water_absorption_test_method").hide();
                     }
//35,80
                     if((splitted_data.includes('35') || splitted_data.includes('80')) && $('#div_wicking_test').length !== 0)
                     {
                        test_method_for_all+=test_method_id[i]+',';
                      
                        $(".full_page_load").show();
                        $("#div_wicking_test").show();
            
                         $("#for_wicking_test_test_name_label").html(test_name_method[i]);
                        $("#for_wicking_test_test_method").hide();
                     }
//190,36,81,163,214
                     if((splitted_data.includes('36') || splitted_data.includes('190') || splitted_data.includes('81') || splitted_data.includes('163') || splitted_data.includes('214')) && $('#div_spirality').length !== 0)
                     {
                        test_method_for_all+=test_method_id[i]+',';
                       
                        $(".full_page_load").show();
                        $("#div_spirality").show();
            
                          $("#for_spirality_test_name_label").html(test_name_method[i]);
                        $("#spirality_test_method").hide();
                     }
//236,282,82,37,267;
                     if((splitted_data.includes('37') || splitted_data.includes('282')|| splitted_data.includes('82')|| splitted_data.includes('37')|| splitted_data.includes('267')) && $('#div_smoothness_appearance').length !== 0)
                     {
                        test_method_for_all+=test_method_id[i]+',';
                       
                        $(".full_page_load").show();
                        $("#div_smoothness_appearance").show();
            
            $("#for_smoothness_appearance_test_name_label").html(test_name_method[i]);
                        $("#smoothness_appearance_test_method").hide();
                     }
//234,38,83
                     if((splitted_data.includes('38') || splitted_data.includes('234') || splitted_data.includes('83')) && $('#div_print_durability').length !== 0)
                     {
                        test_method_for_all+=test_method_id[i]+',';
                       
                        $(".full_page_load").show();
                        $("#div_print_durability").show();
            
            $("#for_print_durability_test_name_label").html(test_name_method[i]);
                        $("#print_durability_test_method").hide();
                     }

// 39,84,233
                     if((splitted_data.includes('39') || splitted_data.includes('84') || splitted_data.includes('233')) && $('#div_iron_ability_of_woven_fabric').length !== 0)
                     {
                        test_method_for_all+=test_method_id[i]+',';
                        
                        $(".full_page_load").show();
                        $("#div_iron_ability_of_woven_fabric").show();
            
                        $("#for_iron_ability_of_woven_fabric_test_name_label").html(test_name_method[i]);
                        $("#iron_ability_of_woven_fabric_test_method").hide();
                     }
// 159,133,40,86,182,238,297,220,273,172,198,174,270,243,111
                      if((splitted_data.includes('40') || splitted_data.includes('159') || splitted_data.includes('133') || splitted_data.includes('86') || splitted_data.includes('182') || splitted_data.includes('238')  || splitted_data.includes('297') || splitted_data.includes('220') || splitted_data.includes('172') || splitted_data.includes('198')|| splitted_data.includes('174')|| splitted_data.includes('270')|| splitted_data.includes('243')|| splitted_data.includes('111')) && $('#div_cf_to_artificial_day_light').length !== 0)
                     {
                        test_method_for_all+=test_method_id[i]+',';
                       
                        $(".full_page_load").show();
                        $("#div_cf_to_artificial_day_light").show();
            
            $("#for_cf_to_artificial_day_light_test_name_label").html(test_name_method[i]);
                        $("#cf_to_artificial_day_light_test_method").hide();
                     }
//41,87
                      if((splitted_data.includes('41') || splitted_data.includes('87'))&& $('#div_moisture_content').length !== 0)
                     {
                        test_method_for_all+=test_method_id[i]+',';
                        
                        $(".full_page_load").show();
                        $("#div_moisture_content").show();
            
                       $("#for_moisture_content_test_name_label").html(test_name_method[i]);
                       // $("#cf_to_washing_color_change_test_method").hide();
                     }
//257,42,88
                     if((splitted_data.includes('42') || splitted_data.includes('257')|| splitted_data.includes('88')) && $('#div_evaporation_rate').length !== 0)
                     {
                        test_method_for_all+=test_method_id[i]+',';
                        
                        $(".full_page_load").show();
                        $("#div_evaporation_rate").show();
            
            $("#for_evaporation_rate_test_name_label").html(test_name_method[i]);
                         $("#evaporation_rate_test_method").hide();
                     }
//225,296,110,180,43,89
                     if((splitted_data.includes('43') || splitted_data.includes('225') || splitted_data.includes('296') || splitted_data.includes('110') || splitted_data.includes('180') || splitted_data.includes('89') ) && $('#div_fiber_content').length !== 0)
                     {
                        test_method_for_all+=test_method_id[i]+',';
                        
                        $(".full_page_load").show();
                        $("#div_fiber_content").show();
            
                       $("#for_total_cotton_content_test_name_label").html(test_name_method[i]);
                        $("#total_cotton_content_test_method").hide();
                     }
//44,90
                     if((splitted_data.includes('44') || splitted_data.includes('90')) && $('#div_greige_width').length !== 0)
                     {
                        test_method_for_all+=test_method_id[i]+',';
                        
                        $(".full_page_load").show();
                        $("#div_greige_width").show();
            
                     }
//45,91
                     if((splitted_data.includes('45') || splitted_data.includes('91')) && $('#div_flame_intensity').length !== 0)
                     {
                        test_method_for_all+=test_method_id[i]+',';
                       
                        $(".full_page_load").show();
                        $("#div_flame_intensity").show();
            
            

                     }
//46,92          
                if((splitted_data.includes('46') || splitted_data.includes('92')) && $('#div_machine_speed').length !== 0)
                     {
                        test_method_for_all+=test_method_id[i]+',';
                        
                        $(".full_page_load").show();
                        $("#div_machine_speed").show();
            
          

                     }
//47,93          
               if((splitted_data.includes('47') || splitted_data.includes('93'))&& $('#div_bath_temparature').length !== 0)
                     {
                        test_method_for_all+=test_method_id[i]+',';
                        
                        $(".full_page_load").show();
                        $("#div_bath_temparature").show();
            
            
                     }
//48,94
               if((splitted_data.includes('48') || splitted_data.includes('94')) && $('#div_bath_ph').length !== 0)
                     {
                        test_method_for_all+=test_method_id[i]+',';
                        
                        $(".full_page_load").show();
                        $("#div_bath_ph").show();
            
            
                     }
//49,95 Whiteness- Berger
                     if((splitted_data.includes('49') || splitted_data.includes('95')) && $('#div_whiteness').length !== 0)  //whiteness
                     {
                        
                        test_method_for_all+=test_method_id[i]+',';
                        $(".full_page_load").show();
                        $("#div_whiteness").show();
            
            
                        
                     }
//50,97
                     if((splitted_data.includes('50')|| splitted_data.includes('97')) && $('#div_residual_sizing_material').length !== 0) //residual_sizing_material_test_method
                     {
                        
                        test_method_for_all+=test_method_id[i]+',';
                        

                        $(".full_page_load").show();
                        $("#div_residual_sizing_material").show();
            
           
                        
                     }



//Surface_fuzzing Miss  

                     if((splitted_data.includes('6') || splitted_data.includes('101')) && $('#div_resistance_to_surface_fuzzing_and_pilling').length !== 0)
                     {
                        
                        test_method_for_all+=test_method_id[i]+',';
                      
                        $(".full_page_load").show();
                        $("#div_resistance_to_surface_fuzzing_and_pilling").show();
                        
                         $("#for_surface_fuzzing_and_pilling_test_name_label").html(test_name_method[i]);
                        $("#surface_fuzzing_and_pilling_test_method").hide(); 
                        
                     }  


                     
//51,98
                     if((splitted_data.includes('51') || splitted_data.includes('98'))  && $('#div_absorbency_test_method').length !== 0)  // div_absorbency_test_method
                     {
                     
                        test_method_for_all+=test_method_id[i]+',';
                        

                        $(".full_page_load").show();
                        $("#div_absorbency_test_method").show();
            

                        
                     }

//52,99
                     if((splitted_data.includes('52') || splitted_data.includes('99')) && $('#div_rubbing_dry').length !== 0)
                     {
                        test_method_for_all+=test_method_id[i]+',';
                        

                        $(".full_page_load").show();
                        $("#div_rubbing_dry").show();
            
                         $("#for_rubbing_dry_test_name_label").html(test_name_method[i]);
                        $("#rubbing_dry_test_method").hide(); 

                     }
// 53, 100
                if((splitted_data.includes('53') || splitted_data.includes('100')) && $('#div_rubbing_wet').length !== 0)
                     {
                        test_method_for_all+=test_method_id[i]+',';
                       

                        $(".full_page_load").show();
                        $("#div_rubbing_wet").show();

                         $("#for_rubbing_wet_test_name_label").html(test_name_method[i]);
                        $("#rubbing_wet_test_method").hide(); 
          
                     }

                    splitted_data=[];
                    splitted_data=data.split('?fs?');
                    
                
                    
                   }   /*End of  for(var i =0; i<splitted_data.length; i++)*/

                    
                     $("#test_method_id").val(test_method_for_all);
                        //alert (test_method_for_all);
                     

               },
               error: function( jqXhr, textStatus, errorThrown )
               {       
                     
                     alert(errorThrown);
               }
         }); // End of $.ajax({
}/* End of function fill_up_qc_standard_additional_info(version_details)*/

function delete_calendering_process(calendering_id)
{
	var value_for_data= 'calendering_id='+calendering_id;
    
				$.ajax({
						url: 'process_program/deleting_calendering_process_standard.php',
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

 function sending_data_of_defining_qc_standard_for_calendering_process_form_for_saving_in_database()
 {


       var validate = Calendering_Form_Validation();
       var url_encoded_form_data = $("#defining_qc_standard_for_calendering_process_form").serialize(); //This will read all control elements value of the form	
       if(validate != false)
	   {


		  	 $.ajax({
			 		url: 'process_program/defining_qc_standard_for_calendering_process_form_saving.php',
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

 }//End of function sending_data_of_defining_qc_standard_for_calendering_process_form_for_saving_in_database()
 
 
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
<div class="col-sm-12 col-md-12 col-lg-12">

		<div class="panel panel-default"> <!-- This div will create a block/panel for FORM -->

      <?php 
			if ($model_standard == 'model_standard') 
			{
				?>
				<div class="panel-heading" style="color:#191970;"><b>Model For Calendering Process</b></div> 

				<div class="row" data-toggle="collapse" data-target="#search_form_collpapsible_div_1" onClick="change_up_down_arrow_icon_1(this.childNodes[5].childNodes[1].id)">
					<div style="padding-right:13px;text-align:center" id='test'> <i class="glyphicon glyphicon-chevron-up text-right"  id='panel_heading_icon_1'></i></div>
				</div>  
				
				<div id='search_form_collpapsible_div_1' class="collapse in"> 
					
					<form class="form-horizontal" action="" style="margin-top:10px;" name="defining_qc_standard_for_calendering_process_form_view" id="defining_qc_standard_for_calendering_process_form_view" data-toggle="collapse" data-target="#search_form_collpapsible_div">
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
									$standard_for_which_process = 'Calander';
									$sql_for_calendering = "SELECT * FROM `model_defining_qc_standard_for_calendering_process` WHERE 
                                                `process_name`='$standard_for_which_process' and 
																`customer_id` = '$customer_id' and
																`customer_name` = '$customer_name' and 
																`version_number`='$version_number' and
											               `process_technique`= '$process_technique_name'  ORDER BY id ASC";

									$res_for_calendering = mysqli_query($con, $sql_for_calendering);

									while ($row = mysqli_fetch_assoc($res_for_calendering))
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

											<button type="submit" id="edit_model_calendering" name="edit_model_calendering"  class="btn btn-info btn-xs" onclick="load_page('auto_sync/edit_model_defining_qc_standard_for_calendering_process.php?model_calendering_id=<?php echo $row['id'] ?>')"> Edit </button>

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
				<div class="panel-heading" style="color:#191970;"><b>Defining Qc Standard For Calendering Process</b></div> <!-- This will create a upper block for FORM (Just Beautification) -->


                <div class="row" data-toggle="collapse" data-target="#search_form_collpapsible_div_1" onClick="change_up_down_arrow_icon_1(this.childNodes[5].childNodes[1].id)">
                         

                         <div align="right" style="padding-right:13px;" id='test'> <i class="glyphicon glyphicon-chevron-up text-right"  id='panel_heading_icon_1'></i>
                       </div>


                     </div>   <!-- End of <div class="row" data-toggle="collapse" data-target="#search_form_collpapsible_div" > -->

                      <div id='search_form_collpapsible_div_1' class="collapse in"> <!-- For Making Collapsible Section -->

                           

                   <form class="form-horizontal" action="" style="margin-top:10px;" name="defining_qc_standard_for_calendering_process_form_view" id="defining_qc_standard_for_calendering_process_form_view" data-toggle="collapse" data-target="#search_form_collpapsible_div">

                       <div class="panel-heading" style="color:#191970;"><b> calendering Standard Process List</b></div> <!-- This will create a upper block for FORM (Just Beautification) -->

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
                                                 $standard_for_which_process='Calander';
                                                 $sql_for_calendering = "SELECT * FROM `defining_qc_standard_for_calendering_process` 
                                                 										  WHERE `standard_for_which_process`='$standard_for_which_process' and `pp_number` = '$pp_number' and `version_id`='$version_id'  ORDER BY id ASC";

                                                 $res_for_calendering = mysqli_query($con, $sql_for_calendering);

                                                 while($row = mysqli_fetch_assoc($res_for_calendering)) 
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
                                           
                                             
                                             <button type="button" id="edit_calendering" name="edit_calendering"  class="btn btn-primary btn-xs" onclick="load_page('process_program/edit_defining_qc_standard_for_calendering_process.php?calendering_id=<?php echo $row['id'] ?>')"> Edit </button>
                                            <span>  </span>

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
                                                         <button type="button" id="delete_calendering" name="delete_calendering"  class="btn btn-danger btn-xs" onclick="delete_calendering_process(<?php echo $row['id'];?>)" > Delete </button>
                                                      <?php
                                                   } 
                                             ?>


                                            

                                            
                                              <!-- <button type="button" id="delete_calendering" name="delete_calendering"  class="btn btn-danger btn-xs" onclick="load_page('process_program/deleting_calendering_process_standard.php?calendering_id=<?php //echo $row['id'] ?>')"> Delete </button> -->
                                      </td>
                                     <?php
                                                   
                                     $s1++;
                                                      }
                                      ?> 
                                  </tr>
                               </tbody>
                              </table>

                         </div>

                  </form>    <!-- End of <form class="form-horizontal" action="" style="margin-top:10px;" name="defining_qc_standard_for_calendering_process_form" id="defining_qc_standard_for_calendering_process_form"> -->

                 </div>
                 <?php
			}
				?>

				<form class="form-horizontal" action="" style="margin-top:10px;" name="defining_qc_standard_for_calendering_process_form" id="defining_qc_standard_for_calendering_process_form">

						
            <?php
                  // echo $version_number;

                  if (isset($_GET['model_standard'])) 
                  {
                     
                     ?>
                     
                     <input type="hidden" id="model_standard" name="model_standard"  value="model_standard">

                     <input type="hidden" id="finish_width_in_inch" name="finish_width_in_inch"  value="">
                     <input class="form-control" type="hidden" name="pp_number_value" id="pp_number_value" value="">
                     <input type="hidden" id="process_id" name="process_id"  value="proc_17">
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
                     <input type="hidden" id="process_id" name="process_id"  value="proc_17">
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
				 <label class="control-label" for="cf_to_rubbing_dry_value" style="color:#00008B; margin-top:23px;"><span id="for_cf_to_rubbing_dry_test_name_label">Color Fastness to Rubbing</span> <span id="cf_to_rubbing_dry_test_method">(ISO 105 X12)</span></label>
			</div>
			 
			 <div class="col-sm-2 text-center">
	              <!-- <label for="description_or_type" style="font-size:12px; color:#000066;">Direction/Type</label> -->
	              <label class="control-label" for="description_or_type" style="color:#00008B; margin-top:23px;"> Dry </label>
	              <input type="hidden" class="form-control" id="test_method_for_cf_to_rubbing_dry" name="test_method_for_cf_to_rubbing_dry" value="ISO 105 X12">

	         </div>

	        
	         <div class="col-sm-1 text-center">
		            <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:35px;"/>
		     </div>
		        
		         
          <div class="col-sm-1 text-center">
              <select  class="form-control" id="cf_to_rubbing_dry_tolerance_range_math_operator" name="cf_to_rubbing_dry_tolerance_range_math_operator" style="color:#00008B; margin-top:23px;" onchange="cf_to_rubbing_dry_cal()">
                  <option value="">Select Color Fastness to Rubbing Dry Tolerance Range Math Operator</option>
	              <option value="???">???</option>
	              <option value="???"> ??? </option>
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
				 <label class="control-label" for="cf_to_rubbing_dry_value" style="display: none"><span id="for_cf_to_rubbing_wet_test_name_label">Color Fastness to Rubbing</span> <span id="cf_to_rubbing_wet_test_method">(ISO 105 X12)</span></label>
			</div>
			 
			 <div class="col-sm-2 text-center">
	              <!-- <label for="description_or_type" style="font-size:12px; color:#000066;">Direction/Type</label> -->
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
                      <option value="???">???</option>
                      <option value="???"> ??? </option>
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
                <span id="dimensional_stability_to_warp_washing_before_iron_test_method">(ISO 6330, ISO 5077, 3759)</span>
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
            <input type="hidden" id="uom_of_dimensional_stability_to_warp_washing_before_iron" name="uom_of_dimensional_stability_to_warp_washing_before_iron"  value="%">
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
                 <label class="hidden" for="dimensional_stability_to_weft_washing_before_iron" style="color:#00008B;"><span id="for_dimensional_stability_to_weft_washing_before_iron_test_name_label" style="display: none;">Dimensional Stability to Washing
                <span id="dimensional_stability_to_weft_washing_before_iron_test_method" style="display: none;">(ISO 6330, ISO 5077, 3759)</span>
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
            <input type="hidden" id="uom_of_dimensional_stability_to_weft_washing_before_iron" name="uom_of_dimensional_stability_to_weft_washing_before_iron"  value="%">
          </div>

                
          <div class="col-sm-1 text-center" for="min_value">

            <input type="text" class="form-control" id="dimensional_stability_to_weft_washing_before_iron_min_value" name="dimensional_stability_to_weft_washing_before_iron_min_value" style="color:#00008B;" placeholder="Enter Change in Wrp for Washing Before Iron Value Min Value" required>
             
          </div>
                  
          <div class="col-sm-1 text-center">
              
            <input type="text" class="form-control" id="dimensional_stability_to_weft_washing_before_iron_max_value" name="dimensional_stability_to_weft_washing_before_iron_max_value" style="color:#00008B;" placeholder="Enter Wrp for Washing Before Iron  Max Value" required>

           </div>
                    
                

     </div><!-- End of <div class="form-group form-group-sm" dimensional_stability_to_weft_washing_before_iron-->




     <div class="form-group form-group-sm">
            

            <div class="col-sm-3 text-center">
                 <label class="hidden" for="dimensional_stability_to_warp_washing_after_iron" style="color:#00008B;"><span id="for_dimensional_stability_to_warp_washing_after_iron_test_name_label">Dimensional Stability to Washing</span>
                <span id="dimensional_stability_to_warp_washing_after_iron_test_method">(ISO 6330, ISO 5077, 3759)</span>
                 </label>
            </div>
             
             <div class="col-sm-2 text-center">
                  
                  <label class="control-label" for="description_or_type" style="color:#00008B;"> Warp(After Iron)</label>

                  <input type="hidden" class="form-control" id="test_method_for_dimensional_stability_to_warp_washing_after_iron" name="test_method_for_dimensional_stability_to_warp_washing_after_iron" value="ISO 6330, ISO 5077, 3759">
                  
             </div>

             
             <div class="col-sm-2 text-center">
                  
                  <input type="text" class="form-control" id="washing_cycle_for_warp_for_washing_after_iron" name="washing_cycle_for_warp_for_washing_after_iron" placeholder="Enter Change in Warp for Washing Cycle" required>
              </div>


             <!--  <div class="col-sm-1 text-center">
                 <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
              </div>  -->

              <div class="col-sm-1 text-center">
                 <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
              </div>

             
          <div class="col-sm-1" for="unit">
             %
            <input type="hidden" id="uom_of_dimensional_stability_to_warp_washing_after_iron" name="uom_of_dimensional_stability_to_warp_washing_after_iron"  value="%">
          </div>

                
          <div class="col-sm-1 text-center" for="min_value">

            <input type="text" class="form-control" id="dimensional_stability_to_warp_washing_after_iron_min_value" name="dimensional_stability_to_warp_washing_after_iron_min_value" style="color:#00008B;" placeholder="Enter Change in Wrp for Washing after Iron Value Min Value" required>
             
          </div>
                  
          <div class="col-sm-1 text-center">
              
            <input type="text" class="form-control" id="dimensional_stability_to_warp_washing_after_iron_max_value" name="dimensional_stability_to_warp_washing_after_iron_max_value" style="color:#00008B;" placeholder="Enter Wrp for Washing after Iron  Max Value" required>

           </div>
                    
                

     </div><!-- End of <div class="form-group form-group-sm" dimensional_stability_to_warp_washing_after_iron-->



     <div class="form-group form-group-sm">
            

            <div class="col-sm-3 text-center">
                 <label class="hidden" for="dimensional_stability_to_weft_washing_after_iron" style="color:#00008B;"><span id="for_dimensional_stability_to_weft_washing_after_iron_test_name_label" style="display: none;">Dimensional Stability to Washing</span>
                 <span id="dimensional_stability_to_weft_washing_after_iron_test_method" style="display: none;">(ISO 6330, ISO 5077, 3759)</span>
                 </label>
            </div>
             
             <div class="col-sm-2 text-center">
                  
                  <label class="control-label" for="description_or_type" style="color:#00008B;"> Weft(After Iron)</label>

                  <input type="hidden" class="form-control" id="test_method_for_dimensional_stability_to_weft_washing_after_iron" name="test_method_for_dimensional_stability_to_weft_washing_after_iron" value="ISO 6330, ISO 5077, 3759">
                  
             </div>

             

             <div class="col-sm-2 text-center">
                  
                  <input type="text" class="form-control" id="washing_cycle_for_weft_for_washing_after_iron" name="washing_cycle_for_weft_for_washing_after_iron" placeholder="Enter Change in Weft for Washing Cycle" required>
              </div>


              <!-- <div class="col-sm-1 text-center">
                 <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
              </div>  -->

              <div class="col-sm-1 text-center">
                 <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
              </div>

             
          <div class="col-sm-1" for="unit">
              %
            <input type="hidden" id="uom_of_dimensional_stability_to_weft_washing_after_iron" name="uom_of_dimensional_stability_to_weft_washing_after_iron"  value="%">
          </div>

                
          <div class="col-sm-1 text-center" for="min_value">

            <input type="text" class="form-control" id="dimensional_stability_to_weft_washing_after_iron_min_value" name="dimensional_stability_to_weft_washing_after_iron_min_value" style="color:#00008B;" placeholder="Enter Change in Wrp for Washing after Iron Value Min Value" required>
             
          </div>
                  
          <div class="col-sm-1 text-center">
              
            <input type="text" class="form-control" id="dimensional_stability_to_weft_washing_after_iron_max_value" name="dimensional_stability_to_weft_washing_after_iron_max_value" style="color:#00008B;" placeholder="Enter Wrp for Washing after Iron  Max Value" required>

           </div>
                    
                

     </div><!-- End of <div class="form-group form-group-sm" dimensional_stability_to_weft_washing_after_iron-->

  </div>  <!-- End of <div id="div_dimensional_stability_to_washing" style="display: none"> -->  





  <div id="div_yarn_count" style="display: none">	

      <div class="form-group form-group-sm">
		    
			<!-- <div class="col-sm-1 text-center">
					
			</div> -->

			<div class="col-sm-3 text-center">
				 <label class="control-label" for="warp_yarn_count_value" style="color:#00008B;"><span id="for_warp_yarn_count_test_name_label">Yarn Count </span><span id="warp_yarn_count_test_method">(ISO 7211-5)</span></label>
			</div>
			 
			 <div class="col-sm-2 text-center">
	              <!-- <label for="description_or_type" style="font-size:12px; color:#000066;">Direction/Type</label> -->
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
                      <option value="??">??</option>
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
				 <label class="control-label" for="weft_yarn_count_value" style="display: none"><span id="for_weft_yarn_count_test_name_label">Yarn Count</span><span id="weft_yarn_count_test_method">(ISO 7211-5)</span></label>
			</div>
			 
			 <div class="col-sm-2 text-center">
	              <!-- <label for="description_or_type" style="font-size:12px; color:#000066;">Direction/Type</label> -->
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
                      <option value="??">??</option>
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
	              <!-- <label for="description_or_type" style="font-size:12px; color:#000066;">Direction/Type</label> -->
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
                      <option value="??">??</option>
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



     <div class="form-group form-group-sm" for="no_of_threads_in_warp_value">
		  

			<div class="col-sm-3 text-center">
				 <label class="control-label" for="weft_yarn_count_value" style="display: none"><span id="for_no_of_threads_in_weft_test_name_label">Number of Threads Per Unit Length</span> <span id="no_of_threads_in_weft_test_method">(ISO 7211-2)</span></label>
			</div>
			 
			 <div class="col-sm-2 text-center">
	              <!-- <label for="description_or_type" style="font-size:12px; color:#000066;">Direction/Type</label> -->
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
                      <option value="??">??</option>
                </select>
              
           </div>
	          
	               <!--Add Input/Select Field Here No Dive Only Input/Select/Radio Button/Checkbox/Textarea -->
		          
          <div class="col-sm-1" for="tolerance">

              <input type="text" class="form-control" id="no_of_threads_in_weft_tolerance_value" name="no_of_threads_in_weft_tolerance_value" placeholder="Enter Tolerance Value" onchange="no_of_threads_in_weft_cal_for_finishing()" required>

          </div>

          <div class="col-sm-1" for="unit">
          	 <select  class="form-control" id="uom_of_no_of_threads_in_weft_value" name="uom_of_no_of_threads_in_weft_value" >
                      <option value="">Select Uom Of No of Threads in Weft Properties</option>
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

</div> <!-- End of <div id="div_number_of_threads_per_unit_length" style="display: none"> -->



  <div id="div_mass_per_unit_area" style="display: none">


      <div class="form-group form-group-sm" for="mass_per_unit_per_area_value">
		  

			<div class="col-sm-3 text-center">
				 <label class="control-label" for="mass_per_unit_per_area_value" style="color:#00008B;"><span id="for_mass_per_unit_per_area_test_name_label">Mass Per Unit Area </span><span id="mass_per_unit_per_area_test_method"></span>(ISO 3801)</label>
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
				 <label class="control-label" for="surface_fuzzing_and_pilling_tolerance_range_math_operator" style="color:#00008B;"><span id="for_surface_fuzzing_and_pilling_test_name_label">Resistance to Surface Fuzzing & Pilling</span> <span id="surface_fuzzing_and_pilling_test_method"></span>(ISO 12945-2)</label>
			</div>
			 
			 <div class="col-sm-2 text-center">
	             
	              <!-- <label class="control-label" for="description_or_type" style="color:#00008B;">  </label> -->
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
				<option value="???">???</option>
				<option value="???"> ??? </option>
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
            <!--  <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>  -->

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
				 <label class="control-label" for="tensile_properties_in_warp" style="color:#00008B;"><span id="for_tensile_properties_in_warp_test_name_label">Tensile Properties</span> <span id="tensile_properties_in_warp_test_method"></span>(ISO 13934-1)</label>
			</div>
			 
			 <div class="col-sm-2 text-center">
	              <!-- <label for="description_or_type" style="font-size:12px; color:#000066;">Direction/Type</label> -->
	              <label class="control-label" for="description_or_type" style="color:#00008B;"> Warp </label>

	              <input type="hidden" class="form-control" id="test_method_for_tensile_properties_in_warp" name="test_method_for_tensile_properties_in_warp" value="ISO 13934-1">
	              
	         </div>

	         

	         <div class="col-sm-1 text-center">
		             <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
		         
		     </div>
		        
		         
          <div class="col-sm-1 text-center">
              <select  class="form-control" id="tensile_properties_in_warp_value_tolerance_range_math_operator" name="tensile_properties_in_warp_value_tolerance_range_math_operator" onchange="tensile_properties_in_warp()">
                      <option value="">Select Tensile Properties In Warp Value Tolerance Range Math Operator</option>
                      <option value="???">???</option>
                      <option value="???"> ??? </option>
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
				 <label class="control-label" for="tensile_properties_in_weft" style="display: none"><span id="for_tensile_properties_in_weft_test_name_label">Tensile Properties </span> <span id="tensile_properties_in_weft_test_method">(ISO 13934-1)</span></label>
			</div>
			 
			 <div class="col-sm-2 text-center">
	              <!-- <label for="description_or_type" style="font-size:12px; color:#000066;">Direction/Type</label> -->
	              <label class="control-label" for="description_or_type" style="color:#00008B;"> Weft </label>

	               <input type="hidden" class="form-control" id="test_method_for_tensile_properties_in_weft" name="test_method_for_tensile_properties_in_weft" value="ISO 13934-1">
	              
	         </div>

	       
	         <div class="col-sm-1 text-center">
		             <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
		         
		     </div>
		        
		         
          <div class="col-sm-1 text-center">
              <select  class="form-control" id="tensile_properties_in_weft_value_tolerance_range_math_operator" name="tensile_properties_in_weft_value_tolerance_range_math_operator" onchange="tensile_properties_in_weft()">
                      <option value="">Select Tensile Properties In weft Value Tolerance Range Math Operator</option>
                      <option value="???">???</option>
                      <option value="???"> ??? </option>
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
				 <label class="control-label" for="tear_force_in_warp_value" style="color:#00008B;"><span id="for_tear_force_in_warp_test_name_label">Tear Force</span> <span id="tear_force_in_warp_test_method">(ISO 13937-2)</span></label>
			</div>
			 
			 <div class="col-sm-2 text-center">
	              <!-- <label for="description_or_type" style="font-size:12px; color:#000066;">Direction/Type</label> -->
	              <label class="control-label" for="description_or_type" style="color:#00008B;"> Warp </label>

	              <input type="hidden" class="form-control" id="test_method_for_tear_force_in_warp" name="test_method_for_tear_force_in_warp" value="ISO 13937-2">
	              
	         </div>

	     

	         <div class="col-sm-1 text-center">
		             <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
		         
		     </div>
		        
		         
          <div class="col-sm-1 text-center">
              <select  class="form-control" id="tear_force_in_warp_value_tolerance_range_math_operator" name="tear_force_in_warp_value_tolerance_range_math_operator" onchange="tear_force_in_warp_cal()">
                      <option value="">Select Warp Yarn Tear Force Tolerance Range Math Operator</option>
                      <option value="???">???</option>
                      <option value="???"> ??? </option>
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
		            
		   
     </div><!-- End of <div class="form-group form-group-sm" tensile_properties_in_weft_value_max_value-->


     <div class="form-group form-group-sm" for="tear_force_in_weft_value">
      

	      <div class="col-sm-3 text-center">
	         <label class="control-label" for="tear_force_in_weft_value" style="display: none"><span id="for_tear_force_in_weft_test_name_label">Tear Force</span> <span id="tear_force_in_weft_test_method">(ISO 13937-2)</span></label>
	      </div>
	       
	        <div class="col-sm-2 text-center">
	                <!-- <label for="description_or_type" style="font-size:12px; color:#000066;">Direction/Type</label> -->
	                <label class="control-label" for="description_or_type" style="color:#00008B;"> weft </label>

	                 <input type="hidden" class="form-control" id="test_method_for_tear_force_in_weft" name="test_method_for_tear_force_in_weft" value="ISO 13937-2">
	                
	        </div>

       

	       <div class="col-sm-1 text-center">
	             <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
	         
	       </div>
            
             
          <div class="col-sm-1 text-center">
              <select  class="form-control" id="tear_force_in_weft_value_tolerance_range_math_operator" name="tear_force_in_weft_value_tolerance_range_math_operator" onchange="tear_force_in_weft_cal()">
                      <option value="">Select weft Yarn Tear Force Tolerance Range Math Operator</option>
                      <option value="???">???</option>
                      <option value="???"> ??? </option>
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
                
       
     </div><!-- End of <div class="form-group form-group-sm" -->

</div> <!--  End of <div id="div_tear_force" style="display: none">  -->



 <div id="div_seam_slippage" style="display: none">

      <div class="form-group form-group-sm" for="seam_slippage_resistance_in_warp">
		  

			<div class="col-sm-3 text-center">
				 <label class="control-label" for="seam_slippage_resistance_in_warp" style="color:#00008B;"><span id="for_seam_slippage_resistance_in_warp_test_name_label">Seam Slippage</span><span id="seam_slippage_resistance_in_warp_test_method"></span>(ISO 13936-1)</label>
			</div>
			 
			 <div class="col-sm-2 text-center">
	              <!-- <label for="description_or_type" style="font-size:12px; color:#000066;">Direction/Type</label> -->
	              <label class="control-label" for="description_or_type" style="color:#00008B;"> warp </label>

	              <input type="hidden" class="form-control" id="test_method_for_seam_slippage_resistance_in_warp" name="test_method_for_seam_slippage_resistance_in_warp" value="ISO 13936-1">
	              
	         </div>

	         

	         <div class="col-sm-1 text-center">
		             <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
		         
		     </div>
		        
		         
          <div class="col-sm-1 text-center">
              <select  class="form-control" id="seam_slippage_resistance_in_warp_tolerance_range_math_operator" name="seam_slippage_resistance_in_warp_tolerance_range_math_operator" onchange="seam_slippage_resistance_in_warp_cal()">
					<option value="">Select Tolerance Value</option>
					<option value="1">1mm</option>
					<option value="2"> 2mm </option>
					<option value="3">3mm</option>
					<option value="4"> 4mm </option>
					<option value="5"> 5mm</option>
					<option value="5"> 6mm</option>
			 </select>
              
           </div>
	          
	               <!--Add Input/Select Field Here No Dive Only Input/Select/Radio Button/Checkbox/Textarea -->
		          
          <div class="col-sm-1" for="tolerance">

            <input type="text" class="form-control" id="seam_slippage_resistance_in_warp_tolerance_value" name="seam_slippage_resistance_in_warp_tolerance_value" placeholder="Enter Tolerance Value" onchange="seam_slippage_resistance_in_warp_cal()" required>
          </div>

          <div class="col-sm-1" for="unit">
             <select  class="form-control" id="uom_of_seam_slippage_resistance_in_warp" name="uom_of_seam_slippage_resistance_in_warp">
                      <option value="">Select Uom </option>
                      <option value="N">N</option>
                      <option value="kg">kg</option>
                      <option value="lbf">lbf</option>
                      <option value="daN">daN</option>
              </select>
          </div>

		        
          <div class="col-sm-1 text-center" for="min_value">

          	<input type="text" class="form-control" id="seam_slippage_resistance_in_warp_min_value" name="seam_slippage_resistance_in_warp_min_value" placeholder="Enter  Min Value" required>
          </div>
		          
          <div class="col-sm-1 text-center">
              
            <input type="text" class="form-control" id="seam_slippage_resistance_in_warp_max_value" name="seam_slippage_resistance_in_warp_max_value" placeholder="Enter  Max Value" required>
           </div>
		            
		   
     </div><!-- End of <div class="form-group form-group-sm" seam_slippage_warp_resistance-->


      <div class="form-group form-group-sm" for="seam_slippage_resistance_in_weft_value">
		  

			<div class="col-sm-3 text-center">
				 <label class="control-label" for="seam_slippage_resistance_in_weft_value" style="display: none"><span id="for_seam_slippage_resistance_in_weft_test_name_label">Seam Slippage </span><span id="seam_slippage_resistance_in_weft_test_method"></span>(ISO 13936-1)</label>
			</div>
			 
			 <div class="col-sm-2 text-center">
	              <!-- <label for="description_or_type" style="font-size:12px; color:#000066;">Direction/Type</label> -->
	              <label class="control-label" for="description_or_type" style="color:#00008B;"> Weft </label>

	              <input type="hidden" class="form-control" id="test_method_for_seam_slippage_resistance_in_weft" name="test_method_for_seam_slippage_resistance_in_weft" value="ISO 13936-1">
	              
	         </div>

	        

	         <div class="col-sm-1 text-center">
		             <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
		         
		     </div>
		        
		         
          <div class="col-sm-1 text-center">
              <select  class="form-control" id="seam_slippage_resistance_in_weft_tolerance_range_math_operator" name="seam_slippage_resistance_in_weft_tolerance_range_math_operator" onchange="seam_slippage_resistance_in_weft_cal()">
                      <option value="">Select weft Yarn Tear Force Tolerance Range Math Operator</option>
                      <option value="1">1mm</option>
					<option value="2"> 2mm </option>
					<option value="3">3mm</option>
					<option value="4"> 4mm </option>
					<option value="5"> 5mm</option>
					<option value="5"> 6mm</option>
               </select>
              
           </div>
	          
	               <!--Add Input/Select Field Here No Dive Only Input/Select/Radio Button/Checkbox/Textarea -->
		          
          <div class="col-sm-1" for="tolerance">

             <input type="text" class="form-control" id="seam_slippage_resistance_in_weft_tolerance_value" name="seam_slippage_resistance_in_weft_tolerance_value" placeholder="Enter Tolerance Value" onchange="seam_slippage_resistance_in_weft_cal()" required>
          </div>

          <div class="col-sm-1" for="unit">
             <select  class="form-control" id="uom_of_seam_slippage_resistance_in_weft" name="uom_of_seam_slippage_resistance_in_weft">
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

          	<input type="text" class="form-control" id="seam_slippage_resistance_in_weft_min_value" name="seam_slippage_resistance_in_weft_min_value" placeholder="Enter weft Yarn Tear Force Min Value" required>
          </div>
		          
          <div class="col-sm-1 text-center">
              
            <input type="text" class="form-control" id="seam_slippage_resistance_in_weft_max_value" name="seam_slippage_resistance_in_weft_max_value" placeholder="Enter weft Yarn Tear ForceMax Value" required>

           </div>
		            
		   
     </div><!-- End of <div class="form-group form-group-sm" tensile_properties_in_weft_value_max_value-->

    

     <!-- 	 <div class="form-group form-group-sm" for="seam_slippage_resistance_in_weft">
		  

			<div class="col-sm-3 text-center">
				 <label class="control-label" for="seam_slippage_resistance_in_weft" style="color:#00008B;">Seam Slippage (ISO 13936-1)</label>
			</div>
			 
			 <div class="col-sm-2 text-center">
	              
	              <label class="control-label" for="description_or_type" style="color:#00008B;"> weft </label>
	              
	         </div>

	         

	         <div class="col-sm-1 text-center">
		             <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
		         
		     </div>
		        
		         
          <div class="col-sm-1 text-center">
              <select  class="form-control" id="seam_slippage_resistance_in_weft_tolerance_range_math_operator" name="seam_slippage_resistance_in_weft_tolerance_range_math_operator" onchange="seam_slippage_resistance_in_weft_cal()">
					<option value="">Select  Tolerance Value</option>
					<option value="1">1mm</option>
					<option value="2"> 2mm </option>
					<option value="3">3mm</option>
					<option value="4"> 4mm </option>
					<option value="5"> 5mm</option>
					<option value="6"> 6mm</option>
			 </select>
              
           </div>
	          
	            
		          
          <div class="col-sm-1" for="tolerance">

            <input type="text" class="form-control" id="seam_slippage_resistance_in_weft_tolerance_value" name="seam_slippage_resistance_in_weft_tolerance_value" placeholder="Enter Tolerance Value" onchange="seam_slippage_resistance_in_weft_cal()" required>
          </div>

          <div class="col-sm-1" for="unit">
             <select  class="form-control" id="uom_of_seam_slippage_resistance_in_weft" name="uom_of_seam_slippage_resistance_in_weft">
                      <option value="">Select Uom </option>
                      <option value="N">N</option>
                      <option value="kg">kg</option>
                      <option value="lbf">lbf</option>
                      <option value="daN">daN</option>
              </select>
          </div>

		        
          <div class="col-sm-1 text-center" for="min_value">

          	<input type="text" class="form-control" id="seam_slippage_resistance_in_weft_min_value" name="seam_slippage_resistance_in_weft_min_value" placeholder="Enter  Min Value" required>
          </div>
		          
          <div class="col-sm-1 text-center">
              
            <input type="text" class="form-control" id="seam_slippage_resistance_in_weft_max_value" name="seam_slippage_resistance_in_weft_max_value" placeholder="Enter  Max Value" required>
           </div>
		            
		   
     </div> --><!-- End of <div class="form-group form-group-sm" seam_slippage_resistance_in_weft-->




    

     <div class="form-group form-group-sm" for="seam_slippage_resistance_iso_2_in_warp">
      

	      <div class="col-sm-3 text-center">
	         <label class="control-label" for="seam_slippage_resistance_iso_2_in_warp" style="color:#00008B;"><span id="for_seam_slippage_resistance_iso_2_in_warp_test_name_label">Seam Slippage</span> <span id="seam_slippage_resistance_iso_2_warp">(ISO 13936-2)</span></label>
	      </div>
       
         <div class="col-sm-2 text-center">
                <!-- <label for="description_or_type" style="font-size:12px; color:#000066;">Description/Type</label> -->
                <label class="control-label" for="description_or_type" style="color:#00008B;"> Warp </label>

                <input type="hidden" class="form-control" id="test_method_for_seam_slippage_resistance_iso_2_in_warp" name="test_method_for_seam_slippage_resistance_iso_2_in_warp" value="ISO 13936-2">
                
           </div>

           

          
            
             
          <div class="col-sm-1 text-center">
              <select  class="form-control" id="seam_slippage_resistance_iso_2_in_warp_tolerance_range_math_op" name="seam_slippage_resistance_iso_2_in_warp_tolerance_range_math_op" onchange="seam_slippage_resistance_iso_2_in_warp_cal()">
                <option value="">Select operator Value</option>
                <option value="???">???</option>
                     
             </select>
              
           </div>


            <div class="col-sm-1 text-center">
                 <select  class="form-control" id="uom_of_seam_slippage_resistance_iso_2_in_warp_for_load" name="uom_of_seam_slippage_resistance_iso_2_in_warp_for_load">
                      <option value="">Select Uom </option>
                      <option value="N">N</option>
                      <option value="kg">kg</option>
                      <option value="lbf">lbf</option>
                      <option value="daN">daN</option>
              </select>
             
           </div>
            
                 <!--Add Input/Select Field Here No Dive Only Input/Select/Radio Button/Checkbox/Textarea -->
              
          <div class="col-sm-1" for="tolerance">

             <select  class="form-control" id="seam_slippage_resistance_iso_2_in_warp_tolerance_value" name="seam_slippage_resistance_iso_2_in_warp_tolerance_value" onchange="seam_slippage_resistance_iso_2_in_warp_cal()">
                <option value="">Select  Tolerance Value</option>
                <option value="1">1mm</option>
                <option value="2"> 2mm </option>
                <option value="3">3mm</option>
                <option value="4"> 4mm </option>
                <option value="5"> 5mm</option>
                <option value="6"> 6mm</option>
             </select>
          </div>

          <div class="col-sm-1" for="unit">
             <!-- <select  class="form-control" id="uom_of_seam_slippage_resistance_iso_2_in_warp" name="uom_of_seam_slippage_resistance_iso_2_in_warp">
                      <option value="">Select Uom </option>
                      <option value="N">N</option>
                      <option value="kg">kg</option>
                      <option value="lbf">lbf</option>
                      <option value="daN">daN</option>
                      <option value="mm">mm</option>
              </select> -->
                mm
               <input type="hidden" class="form-control" id="uom_of_seam_slippage_resistance_iso_2_in_warp" name="uom_of_seam_slippage_resistance_iso_2_in_warp" value="mm">
          </div>

            
          <div class="col-sm-1 text-center" for="min_value">

            <input type="text" class="form-control" id="seam_slippage_resistance_iso_2_in_warp_min_value" name="seam_slippage_resistance_iso_2_in_warp_min_value" placeholder="Enter  Min Value" required>
          </div>
              
          <div class="col-sm-1 text-center">
              
            <input type="text" class="form-control" id="seam_slippage_resistance_iso_2_in_warp_max_value" name="seam_slippage_resistance_iso_2_in_warp_max_value" placeholder="Enter  Max Value" required>
           </div>
                
       
     </div><!-- End of <div class="form-group form-group-sm" seam_slippage_warp_resistance-->





     <div class="form-group form-group-sm" for="seam_slippage_resistance_iso_2_in_weft">
      

	      <div class="col-sm-3 text-center">
	         <label class="control-label" for="seam_slippage_resistance_iso_2_in_weft" style="color:#00008B;"><span id="for_seam_slippage_resistance_iso_2_in_weft_test_name_label">Seam Slippage</span> <span id="seam_slippage_resistance_iso_2_weft_test_method">(ISO 13936-2)</span></label>
	      </div>
	       
	       <div class="col-sm-2 text-center">
	                <!-- <label for="description_or_type" style="font-size:12px; color:#000066;">Description/Type</label> -->
	                <label class="control-label" for="description_or_type" style="color:#00008B;"> Weft </label>

	                <input type="hidden" class="form-control" id="test_method_for_seam_slippage_resistance_iso_2_in_weft" name="test_method_for_seam_slippage_resistance_iso_2_in_weft" value="ISO 13936-2">
                
           </div>

            
             
          <div class="col-sm-1 text-center">
              <select  class="form-control" id="seam_slippage_resistance_iso_2_in_weft_tolerance_range_math_op" name="seam_slippage_resistance_iso_2_in_weft_tolerance_range_math_op" onchange="seam_slippage_resistance_iso_2_in_weft_cal()">
                <option value="">Select operator Value</option>
                <option value="???">???</option>
                     
             </select>
              
           </div>


           <div class="col-sm-1 text-center">
                 <select  class="form-control" id="uom_of_seam_slippage_resistance_iso_2_in_weft_for_load" name="uom_of_seam_slippage_resistance_iso_2_in_weft_for_load">
                      <option value="">Select Uom</option>
                      <option value="N">N</option>
                      <option value="kg">kg</option>
                      <option value="lbf">lbf</option>
                      <option value="daN">daN</option>
                </select>

             
          </div>
            
                 <!--Add Input/Select Field Here No Dive Only Input/Select/Radio Button/Checkbox/Textarea -->
              
          <div class="col-sm-1" for="tolerance">

             <select  class="form-control" id="seam_slippage_resistance_iso_2_in_weft_tolerance_value" name="seam_slippage_resistance_iso_2_in_weft_tolerance_value" onchange="seam_slippage_resistance_iso_2_in_weft_cal()">
                <option value="">Select Tolerance Value</option>
                <option value="1">1mm</option>
                <option value="2"> 2mm </option>
                <option value="3">3mm</option>
                <option value="4"> 4mm </option>
                <option value="5"> 5mm</option>
                <option value="6"> 6mm</option>
             </select>
          </div>

          <div class="col-sm-1" for="unit">
            
                 mm
               <input type="hidden" class="form-control" id="uom_of_seam_slippage_resistance_iso_2_in_weft" name="uom_of_seam_slippage_resistance_iso_2_in_weft" value="mm">
          </div>

            
          <div class="col-sm-1 text-center" for="min_value">

            <input type="text" class="form-control" id="seam_slippage_resistance_iso_2_in_weft_min_value" name="seam_slippage_resistance_iso_2_in_weft_min_value" placeholder="Enter  Min Value" required>
          </div>
              
          <div class="col-sm-1 text-center">
              
            <input type="text" class="form-control" id="seam_slippage_resistance_iso_2_in_weft_max_value" name="seam_slippage_resistance_iso_2_in_weft_max_value" placeholder="Enter  Max Value" required>
          </div>
                
       
     </div><!-- End of <div class="form-group form-group-sm" seam_slippage_warp_resistance-->

 </div>  <!-- End of <div id="div_seam_slippage" style="display: none"> -->



<div id="div_seam_strength" style="display: none">


      <div class="form-group form-group-sm" for="seam_strength_in_warp_value">
		  

			<div class="col-sm-3 text-center">
				 <label class="control-label" for="seam_strength_in_warp_value" style="color:#00008B;"><span id="for_seam_strength_in_warp_test_name_label">Seam Strength</span> <span id="seam_strength_in_warp_test_method">(ISO 13935-2)</span></label>
			</div>
			 
			 <div class="col-sm-2 text-center">
	              <!-- <label for="description_or_type" style="font-size:12px; color:#000066;">Direction/Type</label> -->
	              <label class="control-label" for="description_or_type" style="color:#00008B;"> Warp </label>

	               <input type="hidden" class="form-control" id="test_method_for_seam_strength_in_warp" name="test_method_for_seam_strength_in_warp" value="ISO 13935-2">
	              
	         </div>

	        

	         <div class="col-sm-1 text-center">
		             <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
		         
		     </div>
		        
		         
          <div class="col-sm-1 text-center">
              
			

			  <select  class="form-control" id="seam_strength_in_warp_value_tolerance_range_math_operator" name="seam_strength_in_warp_value_tolerance_range_math_operator" onchange="seam_strength_in_warp_cal()">
                      <option value="">Select Seam Strength in Warp Math Operator</option>
                      <option value="???">???</option>
                      <option value="???"> ??? </option>
                      <option value=">"> > </option>
	                  <option value="<"> < </option>
                </select>
              
           </div>
	          
	               <!--Add Input/Select Field Here No Dive Only Input/Select/Radio Button/Checkbox/Textarea -->
		          
          <div class="col-sm-1" for="tolerance">

            <input type="text" class="form-control" id="seam_strength_in_warp_value_tolerance_value" name="seam_strength_in_warp_value_tolerance_value" placeholder="Enter Tolerance Value" onchange="seam_strength_in_warp_cal()" required>
          </div>

          <div class="col-sm-1" for="unit">
             <select  class="form-control" id="uom_of_seam_strength_in_warp_value" name="uom_of_seam_strength_in_warp_value">
                      <option value="">Select Uom Of Seam Strength in Warp Properties</option>
                      <option value="N">N</option>
                      <option value="kg">kg</option>
                      <option value="gm">gm</option>
                      <option value="lbf">lbf</option>
                      <option value="oz">oz</option>
                      <option value="daN">daN</option>
              </select>
          </div>

		        
          <div class="col-sm-1 text-center" for="min_value">

          	<input type="text" class="form-control" id="seam_strength_in_warp_value_min_value" name="seam_strength_in_warp_value_min_value" placeholder="Enter Seam Strength in Warp Min Value" required>
          </div>
		          
          <div class="col-sm-1 text-center">
              
            <input type="text" class="form-control" id="seam_strength_in_warp_value_max_value" name="seam_strength_in_warp_value_max_value" placeholder="Enter Seam Strength in Warp Max Value" required>

           </div>
		            
		   
     </div><!-- End of <div class="form-group form-group-sm" seam_strength_in_warp_value-->


     <div class="form-group form-group-sm" for="seam_strength_in_weft_value">
		  

			<div class="col-sm-3 text-center">
				 <label class="control-label" for="seam_strength_in_weft_value" style="color:#00008B;"><span id="for_seam_strength_in_weft_test_name_label">Seam Strength</span> <span id="seam_strength_in_weft_test_method">(ISO 13935-2)</span></label>
			</div>
			 
			 <div class="col-sm-2 text-center">
	              <!-- <label for="description_or_type" style="font-size:12px; color:#000066;">Direction/Type</label> -->
	              <label class="control-label" for="description_or_type" style="color:#00008B;"> Weft </label>

	               <input type="hidden" class="form-control" id="test_method_for_seam_strength_in_weft" name="test_method_for_seam_strength_in_weft" value="ISO 13935-2">
	              
	         </div>

	         

	         <div class="col-sm-1 text-center">
		             <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
		         
		     </div>
		        
		         
          <div class="col-sm-1 text-center">
              

			  <select  class="form-control" id="seam_strength_in_weft_value_tolerance_range_math_operator" name="seam_strength_in_weft_value_tolerance_range_math_operator" onchange="seam_strength_in_weft_cal()">
                      <option value="">Select  Math Operator</option>
                      <option value="???">???</option>
                      <option value="???"> ??? </option>
                      <option value=">"> > </option>
	                  <option value="<"> < </option>
                </select>
              
           </div>
	          
	               <!--Add Input/Select Field Here No Dive Only Input/Select/Radio Button/Checkbox/Textarea -->
		          
          <div class="col-sm-1" for="tolerance">

            <input type="text" class="form-control" id="seam_strength_in_weft_value_tolerance_value" name="seam_strength_in_weft_value_tolerance_value" placeholder="Enter Tolerance Value" onchange="seam_strength_in_weft_cal()" required>
          </div>

          <div class="col-sm-1" for="unit">
             <select  class="form-control" id="uom_of_seam_strength_in_weft_value" name="uom_of_seam_strength_in_weft_value">
                      <option value="">Select Uom </option>
                      <option value="N">N</option>
                      <option value="kg">kg</option>
                      <option value="gm">gm</option>
                      <option value="lbf">lbf</option>
                      <option value="oz">oz</option>
                      <option value="daN">daN</option>
              </select>
          </div>

		        
          <div class="col-sm-1 text-center" for="min_value">

          	<input type="text" class="form-control" id="seam_strength_in_weft_value_min_value" name="seam_strength_in_weft_value_min_value" placeholder="Enter Seam Strength in weft Min Value" required>
          </div>
		          
          <div class="col-sm-1 text-center">
              
            <input type="text" class="form-control" id="seam_strength_in_weft_value_max_value" name="seam_strength_in_weft_value_max_value" placeholder="Enter Seam Strength in weft Max Value" required>

           </div>
		            
		   
     </div><!-- End of <div class="form-group form-group-sm" seam_strength_in_weft_value-->



</div> <!--  End of <div id="div_seam_strength" style="display: none"> -->




<div id="div_seam_properties" style="display: none">

      <div class="form-group form-group-sm" for="seam_properties_seam_slippage_iso_astm_d_in_warp">
      

      <div class="col-sm-3 text-center">
         <label class="control-label" for="seam_properties_seam_slippage_iso_astm_d_in_warp" style="color:#00008B;"><span id="for_seam_properties_seam_slippage_iso_astm_d_in_warp_test_name_label">Seam Properties </span><span id="seam_properties_seam_slippage_iso_astm_d_in_warp_test_method">(ASTM D 1683)</span></label>
      </div>
       
       <div class="col-sm-2 text-center">
                <!-- <label for="description_or_type" style="font-size:12px; color:#000066;">Direction/Type</label> -->
                <label class="control-label" for="description_or_type" style="color:#00008B;"> Warp(Seam Slippage) </label>

                 <input type="hidden" class="form-control" id="test_method_for_seam_properties_seam_slippage_iso_astm_d_in_warp" name="test_method_for_seam_properties_seam_slippage_iso_astm_d_in_warp" value="ASTM D 1683">
                
           </div>

           

           <div class="col-sm-1 text-center">
                 <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
             
         </div>
            
             
          <div class="col-sm-1 text-center">
                <select  class="form-control" id="seam_properties_seam_slippage_iso_astm_d_in_warp_tol_range_mt_op" name="seam_properties_seam_slippage_iso_astm_d_in_warp_tol_range_mt_op" onchange="seam_properties_seam_slippage_iso_astm_d_in_warp_cal()">
                   <option value="">Select Tolerance Value</option>
	                <option value="1">1mm</option>
	                <option value="2"> 2mm </option>
	                <option value="3">3mm</option>
	                <option value="4"> 4mm </option>
	                <option value="5"> 5mm</option>
	                <option value="6"> 6mm</option>
	             </select>
              
           </div>
            
                 <!--Add Input/Select Field Here No Dive Only Input/Select/Radio Button/Checkbox/Textarea -->
              
          <div class="col-sm-1" for="tolerance">

              <input type="text" class="form-control" id="seam_properties_seam_slippage_iso_astm_d_in_warp_tolerance_value" name="seam_properties_seam_slippage_iso_astm_d_in_warp_tolerance_value" placeholder="Enter  Tolerance Value" onchange="seam_properties_seam_slippage_iso_astm_d_in_warp_cal()" required>
          </div>

          <div class="col-sm-1" for="unit">
             <select  class="form-control" id="uom_of_seam_properties_seam_slippage_iso_astm_d_in_warp" name="uom_of_seam_properties_seam_slippage_iso_astm_d_in_warp">
                      <option value="">Select Uom </option>
                      <option value="N">N</option>
                      <option value="kg">kg</option>
                      <option value="lbf">lbf</option>
                      <option value="daN">daN</option>
                      <option value="mm">mm</option>
              </select>
          </div>

            
          <div class="col-sm-1 text-center" for="min_value">

            <input type="text" class="form-control" id="seam_properties_seam_slippage_iso_astm_d_in_warp_min_value" name="seam_properties_seam_slippage_iso_astm_d_in_warp_min_value" placeholder="Enter  Min Value" required>
          </div>
              
          <div class="col-sm-1 text-center">
              
            <input type="text" class="form-control" id="seam_properties_seam_slippage_iso_astm_d_in_warp_max_value" name="seam_properties_seam_slippage_iso_astm_d_in_warp_max_value" placeholder="Enter  Max Value" required>
           </div>
                
       
     </div><!-- End of <div class="form-group form-group-sm" seam_properties_seam_slippage_iso_astm_d_in_warp-->



     <div class="form-group form-group-sm" for="seam_properties_seam_slippage_iso_astm_d_in_weft">
      

      <div class="col-sm-3 text-center">
         <label class="control-label" for="seam_properties_seam_slippage_iso_astm_d_in_weft" style="display: none"><span id="for_seam_properties_seam_slippage_iso_astm_d_in_weft_test_name_label">Seam Properties </span><span id="seam_properties_seam_slippage_iso_astm_d_in_weft_test_method">(ASTM D 1683)</span></label>
      </div>
       
       <div class="col-sm-2 text-center">
                <!-- <label for="description_or_type" style="font-size:12px; color:#000066;">Direction/Type</label> -->
                <label class="control-label" for="description_or_type" style="color:#00008B;"> Weft(Seam Slippage) </label>

                <input type="hidden" class="form-control" id="test_method_for_seam_properties_seam_slippage_iso_astm_d_in_weft" name="test_method_for_seam_properties_seam_slippage_iso_astm_d_in_weft" value="ASTM D 1683">
                
           </div>

           

           <div class="col-sm-1 text-center">
                 <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
             
         </div>
            
             
          <div class="col-sm-1 text-center">
              <select  class="form-control" id="seam_properties_seam_slippage_iso_astm_d_in_weft_tol_range_mt_op" name="seam_properties_seam_slippage_iso_astm_d_in_weft_tol_range_mt_op" onchange="seam_properties_seam_slippage_iso_astm_d_in_weft_cal()">
                <option value="">Select  Tolerance Value</option>
                <option value="1">1mm</option>
                <option value="2"> 2mm </option>
                <option value="3">3mm</option>
                <option value="4"> 4mm </option>
                <option value="5"> 5mm</option>
                <option value="6"> 6mm</option>
             </select>
              
           </div>
            
                 <!--Add Input/Select Field Here No Dive Only Input/Select/Radio Button/Checkbox/Textarea -->
              
          <div class="col-sm-1" for="tolerance">

             <input type="text" class="form-control" id="seam_properties_seam_slippage_iso_astm_d_in_weft_tolerance_value" name="seam_properties_seam_slippage_iso_astm_d_in_weft_tolerance_value" placeholder="Enter  Tolerance Value" onchange="seam_properties_seam_slippage_iso_astm_d_in_weft_cal()" required>
          </div>

          <div class="col-sm-1" for="unit">
             <select  class="form-control" id="uom_of_seam_properties_seam_slippage_iso_astm_d_in_weft" name="uom_of_seam_properties_seam_slippage_iso_astm_d_in_weft">
                      <option value="">Select Uom </option>
                      <option value="N">N</option>
                      <option value="kg">kg</option>
                      <option value="lbf">lbf</option>
                      <option value="daN">daN</option>
                      <option value="mm">mm</option>
              </select>
          </div>

            
          <div class="col-sm-1 text-center" for="min_value">

            <input type="text" class="form-control" id="seam_properties_seam_slippage_iso_astm_d_in_weft_min_value" name="seam_properties_seam_slippage_iso_astm_d_in_weft_min_value" placeholder="Enter  Min Value" required>
          </div>
              
          <div class="col-sm-1 text-center">
              
            <input type="text" class="form-control" id="seam_properties_seam_slippage_iso_astm_d_in_weft_max_value" name="seam_properties_seam_slippage_iso_astm_d_in_weft_max_value" placeholder="Enter  Max Value" required>
           </div>
                
       
     </div><!-- End of <div class="form-group form-group-sm" seam_properties_seam_slippage_iso_astm_d_in_weft-->




     <div class="form-group form-group-sm" for="seam_properties_seam_strength_iso_astm_d_in_warp">
      

      <div class="col-sm-3 text-center">
         <label class="control-label" for="seam_properties_seam_strength_iso_astm_d_in_warp" style="display: none"><span id="for_seam_properties_seam_slippage_iso_astm_d_in_warp_test_name_label">Seam Properties</span> <span id="seam_properties_seam_strength_iso_astm_d_in_warp_test_method">(ASTM D 1683)</span></label>
      </div>
       
       <div class="col-sm-2 text-center">
                <!-- <label for="description_or_type" style="font-size:12px; color:#000066;">Direction/Type</label> -->
                <label class="control-label" for="description_or_type" style="color:#00008B;"> Warp(Seam Strength) </label>


                 <input type="hidden" class="form-control" id="test_method_for_seam_properties_seam_strength_iso_astm_d_in_warp" name="test_method_for_seam_properties_seam_strength_iso_astm_d_in_warp" value="ASTM D 1683">
                
           </div>

          

           <div class="col-sm-1 text-center">
                 <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
             
         </div>
            
             
          <div class="col-sm-1 text-center">
              
      

        <select  class="form-control" id="seam_properties_seam_strength_iso_astm_d_in_warp_tol_range_op" name="seam_properties_seam_strength_iso_astm_d_in_warp_tol_range_op" onchange="seam_properties_seam_strength_iso_astm_d_in_warp_cal()">
                      <option value="">Select Math Operator</option>
                      <option value="???">???</option>
                      <option value="???"> ??? </option>
                      <option value=">"> > </option>
                    <option value="<"> < </option>
                </select>
              
           </div>
            
                 <!--Add Input/Select Field Here No Dive Only Input/Select/Radio Button/Checkbox/Textarea -->
              
          <div class="col-sm-1" for="tolerance">

            <input type="text" class="form-control" id="seam_properties_seam_strength_iso_astm_d_in_warp_tolerance_value" name="seam_properties_seam_strength_iso_astm_d_in_warp_tolerance_value" placeholder="Enter Tolerance Value" onchange="seam_properties_seam_strength_iso_astm_d_in_warp_cal()" required>
          </div>

          <div class="col-sm-1" for="unit">
             <select  class="form-control" id="uom_of_seam_properties_seam_strength_iso_astm_d_in_warp" name="uom_of_seam_properties_seam_strength_iso_astm_d_in_warp">
                      <option value="">Select Uom </option>
                      <option value="N">N</option>
                      <option value="kg">kg</option>
                      <option value="gm">gm</option>
                      <option value="lbf">lbf</option>
                      <option value="oz">oz</option>
                      <option value="daN">daN</option>
              </select>
          </div>

            
          <div class="col-sm-1 text-center" for="min_value">

            <input type="text" class="form-control" id="seam_properties_seam_strength_iso_astm_d_in_warp_min_value" name="seam_properties_seam_strength_iso_astm_d_in_warp_min_value" placeholder="Enter Seam Strength in Warp Min Value" required>
          </div>
              
          <div class="col-sm-1 text-center">
              
            <input type="text" class="form-control" id="seam_properties_seam_strength_iso_astm_d_in_warp_max_value" name="seam_properties_seam_strength_iso_astm_d_in_warp_max_value" placeholder="Enter Seam Strength in Warp Max Value" required>

           </div>
                
       
     </div><!-- End of <div class="form-group form-group-sm" seam_properties_seam_strength_iso_astm_d_in_warp-->






     <div class="form-group form-group-sm" for="seam_properties_seam_strength_iso_astm_d_in_weft">
      

      <div class="col-sm-3 text-center">
         <label class="control-label" for="seam_properties_seam_strength_iso_astm_d_in_weft" style="display: none"><span id="for_seam_properties_seam_slippage_iso_astm_d_in_weft_test_name_label">Seam Properties</span> <span id="seam_properties_seam_strength_iso_astm_d_in_weft_test_method">(ASTM D 1683)</span></label>
      </div>
       
       <div class="col-sm-2 text-center">
                <!-- <label for="description_or_type" style="font-size:12px; color:#000066;">Direction/Type</label> -->
                <label class="control-label" for="description_or_type" style="color:#00008B;"> Weft(Seam Strength) </label>


                 <input type="hidden" class="form-control" id="test_method_for_seam_properties_seam_strength_iso_astm_d_in_weft" name="test_method_for_seam_properties_seam_strength_iso_astm_d_in_weft" value="ASTM D 1683">
                
           </div>

          

           <div class="col-sm-1 text-center">
                 <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
             
         </div>
            
             
          <div class="col-sm-1 text-center">
              
      

        <select  class="form-control" id="seam_properties_seam_strength_iso_astm_d_in_weft_tol_range_op" name="seam_properties_seam_strength_iso_astm_d_in_weft_tol_range_op" onchange="seam_properties_seam_strength_iso_astm_d_in_weft_cal()">
                      <option value="">Select Math Operator</option>
                      <option value="???">???</option>
                      <option value="???"> ??? </option>
                      <option value=">"> > </option>
                    <option value="<"> < </option>
                </select>
              
           </div>
            
                 <!--Add Input/Select Field Here No Dive Only Input/Select/Radio Button/Checkbox/Textarea -->
              
          <div class="col-sm-1" for="tolerance">

            <input type="text" class="form-control" id="seam_properties_seam_strength_iso_astm_d_in_weft_tolerance_value" name="seam_properties_seam_strength_iso_astm_d_in_weft_tolerance_value" placeholder="Enter Tolerance Value" onchange="seam_properties_seam_strength_iso_astm_d_in_weft_cal()" required>
          </div>

          <div class="col-sm-1" for="unit">
             <select  class="form-control" id="uom_of_seam_properties_seam_strength_iso_astm_d_in_weft" name="uom_of_seam_properties_seam_strength_iso_astm_d_in_weft">
                      <option value="">Select Uom </option>
                      <option value="N">N</option>
                      <option value="kg">kg</option>
                      <option value="gm">gm</option>
                      <option value="lbf">lbf</option>
                      <option value="oz">oz</option>
                      <option value="daN">daN</option>
              </select>
          </div>

            
          <div class="col-sm-1 text-center" for="min_value">

            <input type="text" class="form-control" id="seam_properties_seam_strength_iso_astm_d_in_weft_min_value" name="seam_properties_seam_strength_iso_astm_d_in_weft_min_value" placeholder="Enter Seam Strength in weft Min Value" required>
          </div>
              
          <div class="col-sm-1 text-center">
              
            <input type="text" class="form-control" id="seam_properties_seam_strength_iso_astm_d_in_weft_max_value" name="seam_properties_seam_strength_iso_astm_d_in_weft_max_value" placeholder="Enter Seam Strength in weft Max Value" required>

           </div>
                
       
     </div><!-- End of <div class="form-group form-group-sm" seam_properties_seam_strength_iso_astm_d_in_weft-->

  </div>  <!-- End of <div id="div_seam_properties" style="display: none"> -->




</div>  <!-- End of <div class="full_page_load" id="full_page_load" style="display :none"> -->


     
                  

						<div class="form-group form-group-sm">
								<div class="col-sm-offset-3 col-sm-5">
									<button type="button" class="btn btn-primary" onClick="sending_data_of_defining_qc_standard_for_calendering_process_form_for_saving_in_database()">Submit</button>
									<button type="reset" class="btn btn-success">Reset</button>
								</div>
						</div>   <!-- end of <div class="form-group form-group-sm" id="form-group_for_change_in_weft_for_dry_cleaning_value">-->
     
				</form>

		</div> <!-- End of <div class="panel panel-default">
 -->
</div> <!-- End of <div class="col-sm-12 col-md-12 col-lg-12"> -->