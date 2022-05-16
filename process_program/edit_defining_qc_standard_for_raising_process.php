<?php
error_reporting(0);
session_start();
require_once("../login/session.php");
include('../login/db_connection_class.php');
$obj = new DB_Connection_Class();
$obj->connection();


if(isset($_GET['raising_id']))
{
   $raising_process_id=$_GET['raising_id'];
   $sql_for_raising_process="select * from defining_qc_standard_for_raising_process where `id`='$raising_process_id'";
   $result_for_raising_process= mysqli_query($con,$sql_for_raising_process) or die(mysqli_error($con));
   $row_for_raising_process = mysqli_fetch_array( $result_for_raising_process);
}
else
{
   $standard_for_which_process='Raising';
   $pp_number = $_GET['pp_number'];
   $version_id = $_GET['version_number'];
   $sql_for_raising_process = "SELECT * FROM `defining_qc_standard_for_raising_process`
   WHERE `standard_for_which_process`='$standard_for_which_process' and `pp_number` = '$pp_number' and `version_id`='$version_id'  ORDER BY id ASC";
   $result_for_raising_process= mysqli_query($con,$sql_for_raising_process) or die(mysqli_error($con));
   $row_for_raising_process = mysqli_fetch_array( $result_for_raising_process);
}



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

function load_full_form(customer_id)
{  


  $('#buttn_for_load_form').hide();

  var value_for_data= 'customer_id='+customer_id;

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
                   if((splitted_data.includes('1')) && $('#div_cf_to_rubbing').length !== 0) 
                     {
                        
                        test_method_for_all+=test_method_id[i]+',';
                      
                        $(".full_page_load").show();
                        $("#div_cf_to_rubbing").show();


                        $("#for_cf_to_rubbing_dry_test_name_label").html(test_name_method[i]);
                        $("#cf_to_rubbing_dry_test_method").hide();
                          
                     } 
                        
//For Dimensional Stability To Washing

                     if((splitted_data.includes('2')) && $('#div_dimensional_stability_to_washing').length !== 0) 
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

                     if( (splitted_data.includes('74')) && $('#div_yarn_count').length !== 0 )  
                     {
                        
                        test_method_for_all+=test_method_id[i]+',';
                    
                        $(".full_page_load").show();
                        $("#div_yarn_count").show();  
                       
                         
                        $("#for_warp_yarn_count_test_name_label").html(test_name_method[i]);
                        $("#warp_yarn_count_test_method").hide(); 
                        
                     }  
           
           
// For div_number_of_threads_per_unit_length 

                     if((splitted_data.includes('4')) && $('#div_number_of_threads_per_unit_length').length !== 0) 
                     {
                        
                        test_method_for_all+=test_method_id[i]+',';
                      
                        $(".full_page_load").show();
                        $("#div_number_of_threads_per_unit_length").show();

                         $("#for_no_of_threads_in_warp_test_name_label").html(test_name_method[i]);
                        $("#no_of_threads_in_warp_test_method").hide(); 
                        
                     }
           
// For Mass Per Unit Area

                     if((splitted_data.includes('5')) && $('#div_mass_per_unit_area').length !== 0) 
                     {
                        
                        test_method_for_all+=test_method_id[i]+',';
                      
                        $(".full_page_load").show();
                        $("#div_mass_per_unit_area").show();
            
                        $("#for_mass_per_unit_per_area_test_name_label").html(test_name_method[i]);
                        $("#mass_per_unit_per_area_test_method").hide(); 
            
                     }

//For div_tensile_properties

                     if((splitted_data.includes('7')) && $('#div_tensile_properties').length !== 0)  
                     {
                        
                        test_method_for_all+=test_method_id[i]+',';

                   
                        $(".full_page_load").show();
                        $("#div_tensile_properties").show();
            
            $("#for_tensile_properties_in_warp_test_name_label").html(test_name_method[i]);
                        $("#tensile_properties_in_warp_test_method").hide();
                        
                     }     
 //For div_tear_force

                      if((splitted_data.includes('8')) && $('#div_tear_force').length !== 0) 
                     {
                        
                        
                        test_method_for_all+=test_method_id[i]+',';
                        
                        $(".full_page_load").show();
                        $("#div_tear_force").show();
            
            $("#for_tear_force_in_warp_test_name_label").html(test_name_method[i]);
                        $("#tear_force_in_warp_test_method").hide();
                        
                        
                     }     
// For div_seam_slippage

                     if((splitted_data.includes('9')) && $('#div_seam_slippage').length !== 0)
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
                     if((splitted_data.includes('11')) && $('#div_seam_strength').length !== 0)
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

                     if((splitted_data.includes('15') ||splitted_data.includes('59'))  && $('#div_color_fastness_to_washing').length !== 0)
                     {
                        test_method_for_all+=test_method_id[i]+',';
                      
                        $(".full_page_load").show();
                        $("#div_color_fastness_to_washing").show();
            
             $("#for_cf_to_washing_color_change_test_name_label").html(test_name_method[i]);
                         $("#cf_to_washing_color_change_test_method").hide();
                     }
           
// For  div_cf_to_dry_cleaning
                     if((splitted_data.includes('16')) && $('#div_cf_to_dry_cleaning').length !== 0)
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

     

    
} // End of function fetching_qc_standard_defining_form()

 function sending_data_of_defining_qc_standard_for_raising_process_form_for_saving_in_database()
 {


      // var validate = Raising_Form_Validation();
       var url_encoded_form_data = $("#defining_qc_standard_for_raising_process_form").serialize(); //This will read all control elements value of the form	
       
      //  if(validate != false)
	   // {


		  	 $.ajax({
			 		url: 'process_program/edit_defining_qc_standard_for_raising_process_saving.php',
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

    //   }//End of if(validate != false)

 }//End of function sending_data_of_defining_qc_standard_for_raising_process_form_for_saving_in_database()

 function delete_raising_process(raising_id)
{
   var value_for_data= 'raising_id='+raising_id;
    
				$.ajax({
						url: 'process_program/deleting_raising_process_standard.php',
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

				<div class="panel-heading" style="color:#191970;"><b>Edit Defining Qc Standard for Raising Process / Edit</b></div> <!-- This will create a upper block for FORM (Just Beautification) -->
                   
               <div class="row" data-toggle="collapse" data-target="#search_form_collpapsible_div_1" onClick="change_up_down_arrow_icon_1(this.childNodes[5].childNodes[1].id)">


                       <div align="right" style="padding-right:13px;" id='test'> <i class="glyphicon glyphicon-chevron-up text-right"  id='panel_heading_icon_1'></i>
                      </div>


                </div>   <!-- End of <div class="row" data-toggle="collapse" data-target="#search_form_collpapsible_div" > -->

                <div id='search_form_collpapsible_div_1' class="collapse in"> <!-- For Making Collapsible Section -->



                     <form class="form-horizontal" action="" style="margin-top:10px;" name="defining_qc_standard_for_raising_process_form_view" id="defining_qc_standard_for_raising_process_form_view" data-toggle="collapse" data-target="#search_form_collpapsible_div">

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
                                          $standard_for_which_process='Raising';

                                          if(isset($raising_process_id))
                                          {
                                             $sql_for_raising = "SELECT * FROM `defining_qc_standard_for_raising_process` WHERE `id`='$raising_process_id'";
                                          }
                                          else
                                          {
                                             $sql_for_raising = "SELECT * FROM `defining_qc_standard_for_raising_process`
                                             WHERE `standard_for_which_process`='$standard_for_which_process' and `pp_number` = '$pp_number' and `version_id`='$version_id'  ORDER BY id ASC";
                                          }


                                          $res_for_raising = mysqli_query($con, $sql_for_raising);

                                          while ($row = mysqli_fetch_assoc($res_for_raising))
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


                                 

                               <button type="submit" id="edit_raising" name="edit_raising"  class="btn btn-primary btn-xs" onclick="load_page('process_program/edit_defining_qc_standard_for_raising_process.php?raising_id=<?php echo $row['id'] ?>')"> Edit </button>
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
                                                   <button type="button" id="delete_raising" name="delete_raising"  class="btn btn-danger btn-xs" onclick="delete_raising_process(<?php echo $row['id'];?>)" > Delete </button>
                                                <?php
                                             } 
                                       ?>
                                       <!-- <button type="submit" id="delete_raising" name="delete_raising"  class="btn btn-danger btn-xs" onclick="load_page('process_program/deleting_raising_process_standard.php?raising_id=<?php echo $row['id'] ?>')"> Delete </button> -->
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


             <button type="button" class="btn btn-info" id="buttn_for_load_form" onclick="load_full_form('<?php echo $row_for_raising_process['customer_id']?>')">Load Form</button>




           <div class="full_page_load" id="full_page_load" style="display: none;">


				
                   <form class="form-horizontal" action="" style="margin-top:10px;" name="defining_qc_standard_for_raising_process_form" id="defining_qc_standard_for_raising_process_form">
                   

                   <label>PP Number :<?php echo $row_for_raising_process['pp_number']?><input type="hidden" class="form-control" id="pp_number" name="pp_number" value="<?php echo $row_for_raising_process['pp_number']?>" readonly></label>  ,
                        

                        <label>Version Name :<?php echo $row_for_raising_process['version_number']?><input type="hidden" id="version_number" name="version_number" value="<?php echo $row_for_raising_process['version_number']?>" >  </label>  ,
                       

                       <label>Customer Name :<?php echo $row_for_raising_process['customer_name']?><input type="hidden" id="customer_name" name="customer_name" value="<?php echo $row_for_raising_process['customer_name']?>"> </label>   ,
                       
                       <input type="hidden" id="customer_id" name="customer_id" value="<?php echo $row_for_raising_process['customer_id']?>">

                       <label>Color :<?php echo $row_for_raising_process['color']?><input type="hidden" id="color" name="color" value="<?php echo $row_for_raising_process['color']?>" > </label>    ,
                       

                       <label>Finish Width :<?php echo $row_for_raising_process['finish_width_in_inch']?><input type="hidden" id="finish_width_in_inch" name="finish_width_in_inch"  value="<?php echo $row_for_raising_process['finish_width_in_inch']?>"> </label>

                       <input type="hidden" id="standard_for_which_process" name="standard_for_which_process"  value="<?php echo $row_for_raising_process['standard_for_which_process']?>">

                       <input type="hidden" id="version_id" name="version_id" value="<?php echo $row_for_raising_process['version_id']?>" >


                       <input type="hidden" id="test_method_id" name="test_method_id"  value="">
                       
                       <input type="hidden" id="process_id" name="process_id"  value="proc_14">

                       <input type="hidden" id="checking_data" name="checking_data"  value="">


                     <!-- start     <div class="form-group form-group-sm" id="form-group_for_yarn_count_warp_for_tolarance_value"> -->



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
    <div id="div_tensile_properties">

        <div class="form-group form-group-sm" for="tensile_properties_in_warp">
		  

			<div class="col-sm-3 text-center">
				 <label class="control-label" for="tensile_properties_in_warp" style="color:#00008B;"><span id="for_tensile_properties_in_warp_test_name_label">Tensile Properties</span> <span id="tensile_properties_in_warp_test_method"></span></label>
			</div>
			 
			 <div class="col-sm-2 text-center">
	              <!-- <label for="description_or_type" style="font-size:12px; color:#000066;">Description/Type</label> -->
	              <label class="control-label" for="description_or_type" style="color:#00008B;"> Warp </label>

	              <input type="hidden" class="form-control" id="test_method_for_tensile_properties_in_warp" name="test_method_for_tensile_properties_in_warp" value="ISO 13934-1">
	              
	         </div>

	         

	         <div class="col-sm-1 text-center">
		             <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
		         
		     </div>
		        
		         
          <div class="col-sm-1 text-center" >
              <select  class="form-control" id="tensile_properties_in_warp_value_tolerance_range_math_operator" name="tensile_properties_in_warp_value_tolerance_range_math_operator" onchange="tensile_properties_in_warp()">
                      <option value="">Select Tensile Properties In Warp Value Tolerance Range Math Operator</option>
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
                                          else if($tensile_properties_in_warp_value_tolerance_range_math_operator=='<')
                                          {
                                         ?>
                                             <option value="≥">≥</option>
                                             <option value="≤"> ≤ </option>
                                             <option value=">"> > </option>
                                             <option value="<" selected> < </option>
                                       <?php
                                          }
                                          else 
                                          {
                                             ?>

                                             <option value="≥">≥</option>
                                             <option value="≤"> ≤ </option>
                                             <option value=">" > > </option>
                                             <option value="<"> < </option>

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
                      <option value="">Select Uom Of Warp Yarn Tensile Properties</option>
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
                                          else if($uom_of_tensile_properties_in_warp_value=='daN')
                                          {
                                         ?>
                                             <option value="N">N</option>
                                             <option value="kg">kg</option>
                                             <option value="lbf" >lbf</option>
                                             <option value="daN" selected>daN</option>
                                       <?php
                                          }
                                          else 
                                          {
                                             ?>

                                             <option value="N">N</option>
                                             <option value="kg">kg</option>
                                             <option value="lbf">lbf</option>
                                             <option value="daN">daN</option>

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
				 <label class="control-label" for="tensile_properties_in_weft" style="display: none"><span id="for_tensile_properties_in_weft_test_name_label" style="display: none">Tensile Properties</span>   <span id="tensile_properties_in_weft_test_method" style="display: none">(ISO 13934-1)</span></label>
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
                                          else if($tensile_properties_in_weft_value_tolerance_range_math_operator=='<')
                                          {
                                         ?>
                                             <option value="≥">≥</option>
                                             <option value="≤"> ≤ </option>
                                             <option value=">"> > </option>
                                             <option value="<" selected> < </option>
                                       <?php
                                          }
                                          else 
                                          {
                                             ?>

                                             <option value="≥">≥</option>
                                             <option value="≤"> ≤ </option>
                                             <option value=">" > > </option>
                                             <option value="<"> < </option>

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
                      <option value="">Select Uom Of weft Yarn Tensile Properties</option>
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
                                          else if($uom_of_tensile_properties_in_weft_value=='daN')
                                          {
                                         ?>
                                             <option value="N">N</option>
                                             <option value="kg">kg</option>
                                             <option value="lbf">lbf</option>
                                             <option value="daN" selected>daN</option>
                                       <?php
                                          }
                                          else 
                                          {
                                             ?>

                                             <option value="N">N</option>
                                             <option value="kg">kg</option>
                                             <option value="lbf">lbf</option>
                                             <option value="daN">daN</option>

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
 <div id="div_tear_force">

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
                      <option value="">Select Warp Yarn Tear Force Tolerance Range Math Operator</option>
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
                                          else if($tear_force_in_warp_value_tolerance_range_math_operator=='<')
                                          {
                                         ?>
                                             <option value="≥">≥</option>
                                             <option value="≤"> ≤ </option>
                                             <option value=">"> > </option>
                                             <option value="<" selected> < </option>
                                       <?php
                                          }
                                          else 
                                          {
                                             ?>

                                             <option value="≥">≥</option>
                                             <option value="≤"> ≤ </option>
                                             <option value=">" > > </option>
                                             <option value="<"> < </option>

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
                      <option value="">Select Uom Of Warp Yarn Tear Force Properties</option>
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
                                          else if($uom_of_tear_force_in_warp_value=='oz')
                                          {
                                             ?>

                                             <option value="N">N</option>
                                             <option value="kg">kg</option>
                                             <option value="lbf">lbf</option>
                                             <option value="gm" >gm</option>
                                             <option value="daN">daN</option>
                                             <option value="oz" selected>oz</option>

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
                                             <option value="oz">oz</option>

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
	         <label class="control-label" for="tear_force_in_weft_value" style="display: none"><span id="for_tear_force_in_warp_test_name_label" style="display: none">Tear Force</span> <span id="tear_force_in_weft_test_method" style="display: none">(ISO 13937-2)</span></label>
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
                      <?php
                                      $tear_force_in_weft_value_tolerance_range_math_operator = $row_for_raising_process['tear_force_in_weft_value_tolerance_range_math_operator'];
                                 
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
                                          else if($tear_force_in_weft_value_tolerance_range_math_operator=='<')
                                          {
                                         ?>
                                             <option value="≥">≥</option>
                                             <option value="≤"> ≤ </option>
                                             <option value=">" > > </option>
                                             <option value="<" selected> < </option>
                                       <?php
                                          }
                                          else 
                                          {
                                             ?>

                                             <option value="≥">≥</option>
                                             <option value="≤"> ≤ </option>
                                             <option value=">" > > </option>
                                             <option value="<" > < </option>

                                             <?php
                                          }
                                       ?>
               </select>
              
           </div>
            
                 <!--Add Input/Select Field Here No Dive Only Input/Select/Radio Button/Checkbox/Textarea -->
              
          <div class="col-sm-1" for="tolerance">

             <input type="text" class="form-control" id="tear_force_in_weft_value_tolerance_value" name="tear_force_in_weft_value_tolerance_value" value="<?php echo $row_for_raising_process['tear_force_in_weft_value_tolerance_value']?>" onchange="tear_force_in_weft_cal()" required>
          </div>

          <div class="col-sm-1" for="unit">
             <select  class="form-control" id="uom_of_tear_force_in_weft_value" name="uom_of_tear_force_in_weft_value">
                      <option value="">Select Uom Of weft Yarn Tear Force Properties</option>
                      <?php
                                      $uom_of_tear_force_in_weft_value = $row_for_raising_process['uom_of_tear_force_in_weft_value'];
                                 
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
                                          else if($uom_of_tear_force_in_weft_value=='oz')
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
                                          else 
                                          {
                                             ?>

                                             <option value="N">N</option>
                                             <option value="kg">kg</option>
                                             <option value="lbf">lbf</option>
                                             <option value="gm" >gm</option>
                                             <option value="daN" >daN</option>
                                             <option value="oz" >oz</option>

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

  </div>     <!-- div_tear_force-->    

            <div class="form-group form-group-sm">
                            <div class="col-sm-offset-4 col-sm-5">
                                <button type="button" class="btn btn-primary" onClick="sending_data_of_defining_qc_standard_for_raising_process_form_for_saving_in_database()">Save</button>
                                    <button type="reset" class="btn btn-success">Reset</button>
                            </div>
            </div>


 </div>    <!-- End of <div class="full_page_load" id="full_page_load" style="display: none;"> -->   




       

					

				</form>
			

		</div> <!-- End of <div class="panel panel-default"> -->

</div> <!-- End of <div class="col-sm-12 col-md-12 col-lg-12"> -->