<?php
session_start();
require_once("../login/session.php");
include('../login/db_connection_class.php');
$obj = new DB_Connection_Class();
$obj->connection();

if(isset($_GET['greige_receiving_id']))
{
   $greige_receiving_id=$_GET['greige_receiving_id'];
   $sql_for_greige_receiving="select * from defining_qc_standard_for_greige_receiving_process where `id`='$greige_receiving_id'";
   $result_for_greige_receiving= mysqli_query($con,$sql_for_greige_receiving) or die(mysqli_error($con));
   $row_for_greige_receiving = mysqli_fetch_array( $result_for_greige_receiving);
}
else
{
   $standard_for_which_process='Greige Receiving';
   $pp_number = $_GET['pp_number'];
   $version_id = $_GET['version_number'];
   $sql_for_greige_receiving = "SELECT * FROM `defining_qc_standard_for_greige_receiving_process`
   WHERE `standard_for_which_process`='$standard_for_which_process' and `pp_number` = '$pp_number' and `version_id`='$version_id'  ORDER BY id ASC";
   $result_for_greige_receiving= mysqli_query($con,$sql_for_greige_receiving) or die(mysqli_error($con));
   $row_for_greige_receiving = mysqli_fetch_array( $result_for_greige_receiving);
}





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

 function sending_data_of_defining_qc_standard_for_greige_receiving_process_form_for_saving_in_database()
 {


      // var validate = Greige_Receiving_Form_Validation();
       var url_encoded_form_data = $("#defining_qc_standard_for_greige_receiving_process_form").serialize(); //This will read all control elements value of the form	
      //  if(validate != false)
	   // {


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

      //  }//End of if(validate != false)

 }//End of function sending_data_of_defining_qc_standard_for_greige_receiving_process_form_for_saving_in_database()

 function delete_greige_receiving_process(greige_receiving_id)
      {
         var value_for_data= 'greige_receiving_id='+greige_receiving_id;
         
                  $.ajax({
                        url: 'process_program/deleting_greige_receiving_process_standard.php',
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

				<div class="panel-heading" style="color:#191970;"><b>Edit Defining Qc Standard For Greige Receiving Process</b></div> <!-- This will create a upper block for FORM (Just Beautification) -->

                         

                 <div class="row" data-toggle="collapse" data-target="#search_form_collpapsible_div_1" onClick="change_up_down_arrow_icon_1(this.childNodes[5].childNodes[1].id)">


                       <div align="right" style="padding-right:13px;" id='test'> <i class="glyphicon glyphicon-chevron-up text-right"  id='panel_heading_icon_1'></i>
                      </div>


                    </div>   <!-- End of <div class="row" data-toggle="collapse" data-target="#search_form_collpapsible_div" > -->
                     

                <div id='search_form_collpapsible_div_1' class="collapse in"> <!-- For Making Collapsible Section -->



                     <form class="form-horizontal" action="" style="margin-top:10px;" name="defining_qc_standard_for_greige_receiving_process_form_view" id="defining_qc_standard_for_greige_receiving_process_form_view" data-toggle="collapse" data-target="#search_form_collpapsible_div">

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
                                          $standard_for_which_process='Greige Receiving';
                                         
                                          if(isset($greige_receiving_id))
                                          {
                                             $sql_for_greige_receiving = "SELECT * FROM `defining_qc_standard_for_greige_receiving_process` 
                                             WHERE `id`='$greige_receiving_id'"; 
                                          }
                                          else
                                          {
                                             $sql_for_greige_receiving = "SELECT * FROM `defining_qc_standard_for_greige_receiving_process`
                                             WHERE `standard_for_which_process`='$standard_for_which_process' and `pp_number` = '$pp_number' and `version_id`='$version_id'  ORDER BY id ASC";
                                          }
                                          

                                          $res_for_greige_receiving = mysqli_query($con, $sql_for_greige_receiving);

                                          while ($row = mysqli_fetch_assoc($res_for_greige_receiving))
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

                                                <button type="submit" id="edit_greige_receiving" name="edit_greige_receiving"  class="btn btn-primary btn-xs" onclick="load_page('process_program/edit_defining_qc_standard_for_greige_receiving_process.php?greige_receiving_id=<?php echo $row['id'] ?>')"> Edit </button>
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
                                                      <button type="button" id="delete_greige_receiving" name="delete_greige_receiving"  class="btn btn-danger btn-xs" onclick="delete_greige_receiving_process(<?php echo $row['id'];?>)" > Delete </button>
                                                   <?php
                                                } 
                                                         ?>
                                                <!-- <button type="submit" id="delete_greige_receiving" name="delete_greige_receiving"  class="btn btn-danger btn-xs" onclick="load_page('process_program/deleting_greige_receiving_process_standard.php?greige_receiving_id=<?php echo $row['id'] ?>')"> Delete </button> -->
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
            <button type="button" class="btn btn-info" id="buttn_for_load_form" onclick="load_full_form('<?php echo $row_for_greige_receiving['customer_id']?>')">Load Form</button>


         <div class="full_page_load" id="full_page_load" style="display: none;"> 
            <form class="form-horizontal" action="" style="margin-top:10px;" name="defining_qc_standard_for_greige_receiving_process_form" id="defining_qc_standard_for_greige_receiving_process_form">

         <div class="form-group form-group-sm" id="form-group_for_pp_number">
          
            <label>PP Number :<?php echo $row_for_greige_receiving['pp_number']?>
               <input type="hidden" class="form-control" id="pp_number" name="pp_number" value="<?php echo $row_for_greige_receiving['pp_number']?>" readonly>
            </label>  ,
            <label>Version Name :<?php echo $row_for_greige_receiving['version_number']?>
               <input type="hidden" class="form-control" id="version_number" name="version_number" value="<?php echo $row_for_greige_receiving['version_number']?>" >  
            </label>  ,
            <label>Customer Name :<?php echo $row_for_greige_receiving['customer_name']?>
               <input type="hidden" class="form-control" id="customer_name" name="customer_name" value="<?php echo $row_for_greige_receiving['customer_name']?>"> 
            </label>   ,
            <input type="hidden" class="form-control" id="customer_id" name="customer_id" value="<?php echo $row_for_greige_receiving['customer_id']?>">
            <label>Color :<?php echo $row_for_greige_receiving['color']?>
               <input type="hidden" class="form-control" id="color" name="color" value="<?php echo $row_for_greige_receiving['color']?>" > 
            </label>    ,
            <label>Finish Width :<?php echo $row_for_greige_receiving['finish_width_in_inch']?>
               <input type="hidden" class="form-control" id="finish_width_in_inch" name="finish_width_in_inch"  value="<?php echo $row_for_greige_receiving['finish_width_in_inch']?>"> 
            </label>
            <input type="hidden" id="version_id" name="version_id" value="<?php echo $row_for_greige_receiving['version_id']?>" >

            <input type="hidden" class="form-control" id="standard_for_which_process" name="standard_for_which_process"  value="<?php echo $row_for_greige_receiving['standard_for_which_process']?>">
            <input type="hidden" class="form-control" id="process_id" name="process_id"  value="proc_20">
            <input type="hidden" class="form-control" id="test_method_id" name="test_method_id"  value="">
            <input type="hidden" class="form-control" id="checking_data" name="checking_data"  value="">


						
<!-- *********************************** Designing Tabular Formar (Multi-Column Form Elements Here (Start))*********************************** -->
 <!-- For Loading_pages -->


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

<div id="div_yarn_count" style="display : none">
	  
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
                      <option value="">Select Warp Yarn CountTolerance Range Math Operator</option>
                      
                      <?php
                                      $warp_yarn_count_tolerance_range_math_operator = $row_for_greige_receiving['warp_yarn_count_tolerance_range_math_operator'];
                                     ?>
                                     <?php 
                                          if($warp_yarn_count_tolerance_range_math_operator=='+')
                                          {
                                       ?>
                                          <option value="+" selected> +</option>
                                          <option value="-"> -</option>
                                          <option value="±">±</option>
                                      <?php
                                          }
                                          else if($warp_yarn_count_tolerance_range_math_operator=='-')
                                          {
                                         ?>
                                          <option value="+">+</option>
                                          <option value="-" selected>-</option>
                                          <option value="±">±</option>
                                       <?php
                                          }
                                        else if($warp_yarn_count_tolerance_range_math_operator=='±')
                                          {
                                         ?>
                                          <option value="+">+</option>
                                          <option value="-" >-</option>
                                          <option value="±" selected>±</option>
                                       <?php
                                          }
                                          else
                                          {
                                         ?>
                                          <option value="+">+</option>
                                          <option value="-">-</option>
                                          <option value="±" >±</option>
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
                      <option value="">Select Uom Of Warp Yarn Tensile Properties</option>

                       
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
                                          else if($uom_of_warp_yarn_count_value=='dtex')
                                          {
                                         ?>
                                          <option value="Ne">Ne</option>
                                          <option value="Nm" >Nm</option>
                                          <option value="Den" >Den</option>
                                          <option value="tex" >tex</option>
                                          <option value="dtex" selected>dtex</option>
                                       <?php
                                          }
                                          else
                                          {
                                         ?>
                                         <option value="Ne">Ne</option>
                                          <option value="Nm" >Nm</option>
                                          <option value="Den" >Den</option>
                                          <option value="tex" >tex</option>
                                          <option value="dtex">dtex</option>
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
                      <option value="">Select weft Yarn CountTolerance Range Math Operator</option>
                      <?php
                                      $weft_yarn_count_tolerance_range_math_operator = $row_for_greige_receiving['weft_yarn_count_tolerance_range_math_operator'];
                                     ?>
                                     <?php 
                                          if($weft_yarn_count_tolerance_range_math_operator=='+')
                                          {
                                       ?>
                                          <option value="+" selected> +</option>
                                          <option value="-"> -</option>
                                          <option value="±">±</option>
                                      <?php
                                          }
                                          else if($weft_yarn_count_tolerance_range_math_operator=='-')
                                          {
                                         ?>
                                          <option value="+">+</option>
                                          <option value="-" selected>-</option>
                                          <option value="±">±</option>
                                       <?php
                                          }
                                          else if($weft_yarn_count_tolerance_range_math_operator=='±')
                                          {
                                         ?>
                                          <option value="+">+</option>
                                          <option value="-" >-</option>
                                          <option value="±" selected>±</option>
                                       <?php
                                          }
                                          else
                                          {
                                         ?>
                                          <option value="+">+</option>
                                          <option value="-">-</option>
                                          <option value="±" >±</option>
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
                      <option value="">Select Uom Of weft Yarn Tensile Properties</option>
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
                                          else if($uom_of_weft_yarn_count_value=='dtex')
                                          {
                                         ?>
                                          <option value="Ne">Ne</option>
                                          <option value="Nm" >Nm</option>
                                          <option value="Den" >Den</option>
                                          <option value="tex" >tex</option>
                                          <option value="dtex" selected>dtex</option>
                                       <?php
                                          }
                                          else
                                          {
                                         ?>
                                         <option value="Ne">Ne</option>
                                          <option value="Nm" >Nm</option>
                                          <option value="Den" >Den</option>
                                          <option value="tex" >tex</option>
                                          <option value="dtex" >dtex</option>
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





<div id="div_number_of_threads_per_unit_length" style="display : none">

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
                      <option value="">Select No of Threads Count Tolerance Range Math Operator</option>
                      <?php
                                      $no_of_threads_in_warp_tolerance_range_math_operator = $row_for_greige_receiving['no_of_threads_in_warp_tolerance_range_math_operator'];
                                     ?>
                                     <?php 
                                          if($no_of_threads_in_warp_tolerance_range_math_operator=='+')
                                          {
                                       ?>
                                          <option value="+" selected> +</option>
                                          <option value="-"> -</option>
                                          <option value="±">±</option>
                                      <?php
                                          }
                                          else if($no_of_threads_in_warp_tolerance_range_math_operator=='-')
                                          {
                                         ?>
                                          <option value="+">+</option>
                                          <option value="-" selected>-</option>
                                          <option value="±">±</option>
                                       <?php
                                          }
                                          else if($no_of_threads_in_warp_tolerance_range_math_operator=='±')
                                          {
                                         ?>
                                          <option value="+">+</option>
                                          <option value="-" >-</option>
                                          <option value="±" selected>±</option>
                                       <?php
                                          }
                                          else
                                          {
                                         ?>
                                          <option value="+">+</option>
                                          <option value="-">-</option>
                                          <option value="±" >±</option>
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
                      <option value="">Select Uom Of No of Threads in Warp Properties</option>
                      
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
                                          else if($uom_of_no_of_threads_in_warp_value=='th/cm')
                                          {
                                       ?>
                                          <option value="th/inch" > th/inch</option>
                                          <option value="th/cm" selected> th/cm</option>
                                          
                                      <?php
                                          }
                                          else
                                          {
                                         ?>
                                          <option value="th/inch" > th/inch</option>
                                          <option value="th/cm" > th/cm</option>
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
                      <option value="">Select No of Threads Count Tolerance Range Math Operator</option>
                      <?php
                                      $no_of_threads_in_weft_tolerance_range_math_operator = $row_for_greige_receiving['no_of_threads_in_weft_tolerance_range_math_operator'];
                                     ?>
                                     <?php 
                                          if($no_of_threads_in_weft_tolerance_range_math_operator=='+')
                                          {
                                       ?>
                                          <option value="+" selected> +</option>
                                          <option value="-"> -</option>
                                          <option value="±">±</option>
                                      <?php
                                          }
                                          else if($no_of_threads_in_weft_tolerance_range_math_operator=='-')
                                          {
                                         ?>
                                          <option value="+">+</option>
                                          <option value="-" selected>-</option>
                                          <option value="±">±</option>
                                       <?php
                                          }
                                          else if($no_of_threads_in_weft_tolerance_range_math_operator=='±')
                                          {
                                         ?>
                                          <option value="+">+</option>
                                          <option value="-" >-</option>
                                          <option value="±" selected>±</option>
                                       <?php
                                          }
                                          else
                                          {
                                         ?>
                                          <option value="+">+</option>
                                          <option value="-">-</option>
                                          <option value="±" >±</option>
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
                      <option value="">Select Uom Of No of Threads in Weft Properties</option>
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
                                          else if($uom_of_no_of_threads_in_weft_value=='th/cm')
                                          {
                                       ?>
                                          <option value="th/inch" > th/inch</option>
                                          <option value="th/cm" selected> th/cm</option>
                                          
                                      <?php
                                          }
                                          else
                                          {
                                         ?>
                                          <option value="th/inch" > th/inch</option>
                                          <option value="th/cm" > th/cm</option>
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






<div id="div_mass_per_unit_area" style="display : none">


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
              <input type="text" class="form-control" id="mass_per_unit_per_area_tolerance_range_math_operator" name="mass_per_unit_per_area_tolerance_range_math_operator" onchange="mass_per_unit_per_area_cal()" value="<?php echo $row_for_greige_receiving['mass_per_unit_per_area_tolerance_range_math_operator']?>" required>
              
           </div>
	          
	               <!--Add Input/Select Field Here No Dive Only Input/Select/Radio Button/Checkbox/Textarea -->
		          
          <div class="col-sm-1" for="tolerance">

              <input type="text" class="form-control" id="mass_per_unit_per_area_tolerance_value" name="mass_per_unit_per_area_tolerance_value" onchange="mass_per_unit_per_area_cal()" value="<?php echo $row_for_greige_receiving['mass_per_unit_per_area_tolerance_value']?>" required>

          </div>

          <div class="col-sm-1" for="unit">
          	 <select  class="form-control" id="uom_of_mass_per_unit_per_area_value" name="uom_of_mass_per_unit_per_area_value">
                      <option value="">Select Uom Of Mass Per Unit per Area </option>
                      
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
                                          else if($uom_of_mass_per_unit_per_area_value=='oz/yd2')
                                          {
                                       ?>
                                          <option value="gm/m2" > gm/m2</option>
                                          <option value="oz/yd2" selected>oz/yd2</option>
                                          
                                      <?php
                                          }
                                          else
                                          {
                                         ?>
                                          <option value="gm/m2" > gm/m2</option>
                                          <option value="oz/yd2" >oz/yd2</option>
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

                <input type="hidden" class="form-control" class="form-control" id="test_method_for_greige_width" name="greige_width" value="ISO 2819">
                
        </div>

          

           <div class="col-sm-1 text-center">
                <input type="text" class="form-control" id="greige_width_value" name="greige_width_value" value="<?php echo $row_for_greige_receiving['greige_width_value']?>" onchange="greige_width_cal()" required>
             
           </div>
            
             
          <div class="col-sm-1 text-center">
              
      
                  <select  class="form-control" id="greige_width_range_math_operator" name="greige_width_range_math_operator" onchange="greige_width_cal()">
                      <option value="">Select Greige Width Range Math Operator</option>
                      <?php
                                      $greige_width_range_math_operator = $row_for_greige_receiving['greige_width_range_math_operator'];
                                     ?>
                                     <?php 
                                          if($greige_width_range_math_operator=='+')
                                          {
                                       ?>
                                          <option value="+" selected> +</option>
                                          <option value="-"> -</option>
                                          <option value="±">±</option>
                                      <?php
                                          }
                                          else if($greige_width_range_math_operator=='-')
                                          {
                                         ?>
                                          <option value="+">+</option>
                                          <option value="-" selected>-</option>
                                          <option value="±">±</option>
                                       <?php
                                          }
                                          else if($greige_width_range_math_operator=='±')
                                          {
                                         ?>
                                          <option value="+">+</option>
                                          <option value="-" >-</option>
                                          <option value="±" selected>±</option>
                                       <?php
                                          }
                                          else
                                          {
                                         ?>
                                          <option value="+">+</option>
                                          <option value="-">-</option>
                                          <option value="±" >±</option>
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
            <input type="hidden" class="form-control" class="form-control" id="uom_of_greige_width_value" name="uom_of_greige_width_value" value="inch">
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
                <input type="hidden" class="form-control" class="form-control" id="test_method_for_total_cotton_content" name="test_method_for_total_cotton_content" value="In house test method">
                
           </div>

       

           <div class="col-sm-1 text-center">
                 <input type="text" class="form-control" id="percentage_of_total_cotton_content_value" name="percentage_of_total_cotton_content_value" value="<?php echo $row_for_greige_receiving['percentage_of_total_cotton_content_value']?>" onchange="percentage_of_total_cotton_content_cal()" required>
             
         </div>
            
             
          <div class="col-sm-1 text-center">
               <select  class="form-control" id="percentage_of_total_cotton_content_tolerance_range_math_operator" name="percentage_of_total_cotton_content_tolerance_range_math_operator" onchange="percentage_of_total_cotton_content_cal()">
                      <option value="">Select Percentage of Total Cotton Content Math Operator</option>
                      <?php
                                      $percentage_of_total_cotton_content_tolerance_range_math_operator = $row_for_greige_receiving['percentage_of_total_cotton_content_tolerance_range_math_operator'];
                                     ?>
                                     <?php 
                                          if($percentage_of_total_cotton_content_tolerance_range_math_operator=='+')
                                          {
                                       ?>
                                          <option value="+" selected> +</option>
                                          <option value="-"> -</option>
                                          <option value="±">±</option>
                                      <?php
                                          }
                                          else if($percentage_of_total_cotton_content_tolerance_range_math_operator=='-')
                                          {
                                         ?>
                                          <option value="+">+</option>
                                          <option value="-" selected>-</option>
                                          <option value="±">±</option>
                                       <?php
                                          }
                                          else if($percentage_of_total_cotton_content_tolerance_range_math_operator=='±')
                                          {
                                         ?>
                                          <option value="+">+</option>
                                          <option value="-" >-</option>
                                          <option value="±" selected>±</option>
                                       <?php
                                          }
                                          else
                                          {
                                         ?>
                                          <option value="+">+</option>
                                          <option value="-">-</option>
                                          <option value="±" >±</option>
                                       <?php
                                          }
                                       ?>
                </select>
              
           </div>
            
                 <!--Add Input/Select Field Here No Dive Only Input/Select/Radio Button/Checkbox/Textarea -->
              
          <div class="col-sm-1" for="tolerance">

             
              <input type="text" class="form-control" id="percentage_of_total_cotton_content_tolerance_value" name="percentage_of_total_cotton_content_tolerance_value" value="<?php echo $row_for_greige_receiving['percentage_of_total_cotton_content_tolerance_value']?>" onchange="percentage_of_total_cotton_content_cal()" required>
          </div>

          <div class="col-sm-1" for="unit">

             %
            <input type="hidden" class="form-control" class="form-control" id="uom_of_percentage_of_total_cotton_content" name="uom_of_percentage_of_total_cotton_content" value="%" >
          </div>

            
          <div class="col-sm-1 text-center" for="min_value">

             <input type="text" class="form-control" id="percentage_of_total_cotton_content_min_value" name="percentage_of_total_cotton_content_min_value" value="<?php echo $row_for_greige_receiving['percentage_of_total_cotton_content_min_value']?>" required>

          </div>
              
          <div class="col-sm-1 text-center">
              
           <input type="text" class="form-control" id="percentage_of_total_cotton_content_max_value" name="percentage_of_total_cotton_content_max_value" value="<?php echo $row_for_greige_receiving['percentage_of_total_cotton_content_max_value']?>" required>

          </div>
                
       
    </div><!-- End of <div class="form-group form-group-sm" percentage_of_total_cotton_content_max_value-->




      <div class="form-group form-group-sm" >
      

	      <div class="col-sm-3 text-center">
	         <label class="control-label"  style="color:#00008B;"><span id="for_total_Polyester_content_test_name_label" style="display: none;">Fiber Content</span><span id="total_Polyester_content_test_method" style="display: none;">(In house test method)</span></label>
	      </div>
	       
	       <div class="col-sm-2 text-center">
	                <!-- <label for="description_or_type" style="font-size:12px; color:#000066;">Direction/Type</label> -->
	                <label class="control-label" for="description_or_type" style="color:#00008B;">Polyester (Total) </label>
	                <input type="hidden" class="form-control" class="form-control" id="test_method_for_total_polyester_content" name="test_method_for_total_polyester_content" value="In house test method">
	                
           </div>

       

           <div class="col-sm-1 text-center">
                 <input type="text" class="form-control" id="percentage_of_total_polyester_content_value" name="percentage_of_total_polyester_content_value" value="<?php echo $row_for_greige_receiving['percentage_of_total_polyester_content_value']?>" onchange="percentage_of_total_polyester_content_cal()" required>
             
         </div>
            
             
          <div class="col-sm-1 text-center">
               <select  class="form-control" id="percentage_of_total_polyester_content_tolerance_range_math_op" name="percentage_of_total_polyester_content_tolerance_range_math_op" onchange="percentage_of_total_polyester_content_cal()">
                      <option value="">Select Percentage of Total polyeste Content Math Operator</option>
                      <?php
                                      $percentage_of_total_polyester_content_tolerance_range_math_op = $row_for_greige_receiving['percentage_of_total_polyester_content_tolerance_range_math_op'];
                                     ?>
                                     <?php 
                                          if($percentage_of_total_polyester_content_tolerance_range_math_op=='+')
                                          {
                                       ?>
                                          <option value="+" selected> +</option>
                                          <option value="-"> -</option>
                                          <option value="±">±</option>
                                      <?php
                                          }
                                          else if($percentage_of_total_polyester_content_tolerance_range_math_op=='-')
                                          {
                                         ?>
                                          <option value="+">+</option>
                                          <option value="-" selected>-</option>
                                          <option value="±">±</option>
                                       <?php
                                          }
                                          else if($percentage_of_total_polyester_content_tolerance_range_math_op=='±')
                                          {
                                         ?>
                                          <option value="+">+</option>
                                          <option value="-" >-</option>
                                          <option value="±" selected>±</option>
                                       <?php
                                          }
                                          else
                                          {
                                         ?>
                                          <option value="+">+</option>
                                          <option value="-">-</option>
                                          <option value="±" >±</option>
                                       <?php
                                          }
                                       ?>
                </select>
              
           </div>
            
                 <!--Add Input/Select Field Here No Dive Only Input/Select/Radio Button/Checkbox/Textarea -->
              
          <div class="col-sm-1" for="tolerance">

             
              <input type="text" class="form-control" id="percentage_of_total_polyester_content_tolerance_value" name="percentage_of_total_polyester_content_tolerance_value" value="<?php echo $row_for_greige_receiving['percentage_of_total_polyester_content_tolerance_value']?>" onchange="percentage_of_total_polyester_content_cal()" required>
          </div>

          <div class="col-sm-1" for="unit">

             %
            <input type="hidden" class="form-control" class="form-control" id="uom_of_percentage_of_total_polyester_content" name="uom_of_percentage_of_total_polyester_content" value="%" >
          </div>

            
          <div class="col-sm-1 text-center" for="min_value">

             <input type="text" class="form-control" id="percentage_of_total_polyester_content_min_value" name="percentage_of_total_polyester_content_min_value" value="<?php echo $row_for_greige_receiving['percentage_of_total_polyester_content_min_value']?>" required>

          </div>
              
          <div class="col-sm-1 text-center">
              
           <input type="text" class="form-control" id="percentage_of_total_polyester_content_max_value" name="percentage_of_total_polyester_content_max_value" value="<?php echo $row_for_greige_receiving['percentage_of_total_polyester_content_max_value']?>" required>

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
							<option value="">Select total Other Fiber</option>
							<?php
                                      $description_or_type_for_total_other_fiber = $row_for_greige_receiving['description_or_type_for_total_other_fiber'];
                                 
                                          if($description_or_type_for_total_other_fiber=='Lyocell')
                                          {
                                       ?>
                                             <option value="Lyocell" selected>Lyocell</option>
                                             <option value="Viscose">Viscose</option>
                                             <option value="Tencel">Tencel</option>
                                             <option value="Lycra">Lycra</option>
                                             <option value="Linen">Linen</option>
                                             <option value="Bamboo">Bamboo</option>
                                             <option value="Recycled Cotton">Recycled Cotton</option>
                                             <option value="Recycled Polyester">Recycled Polyester</option>
                                             <option value="Jute">Jute</option>
                                             <option value="Modal">Modal</option>
                                             <option value="Rayon">Rayon</option>
                                      <?php
                                          }
                                          else if($description_or_type_for_total_other_fiber=='Viscose')
                                          {
                                         ?>
                                             <option value="Lyocell">Lyocell</option>
                                             <option value="Viscose" selected>Viscose</option>
                                             <option value="Tencel">Tencel</option>
                                             <option value="Lycra">Lycra</option>
                                             <option value="Linen">Linen</option>
                                             <option value="Bamboo">Bamboo</option>
                                             <option value="Recycled Cotton">Recycled Cotton</option>
                                             <option value="Recycled Polyester">Recycled Polyester</option>
                                             <option value="Jute">Jute</option>
                                             <option value="Modal">Modal</option>
                                             <option value="Rayon">Rayon</option>
                                       <?php
                                          }
                                          else if($description_or_type_for_total_other_fiber=='Tencel')
                                          {
                                         ?>
                                             <option value="Lyocell">Lyocell</option>
                                             <option value="Viscose">Viscose</option>
                                             <option value="Tencel" selected>Tencel</option>
                                             <option value="Lycra">Lycra</option>
                                             <option value="Linen">Linen</option>
                                             <option value="Bamboo">Bamboo</option>
                                             <option value="Recycled Cotton">Recycled Cotton</option>
                                             <option value="Recycled Polyester">Recycled Polyester</option>
                                             <option value="Jute">Jute</option>
                                             <option value="Modal">Modal</option>
                                             <option value="Rayon">Rayon</option>
                                       <?php
                                          }
                                          else if($description_or_type_for_total_other_fiber=='Lycra')
                                          {
                                         ?>
                                             <option value="Lyocell">Lyocell</option>
                                             <option value="Viscose">Viscose</option>
                                             <option value="Tencel">Tencel</option>
                                             <option value="Lycra" selected>Lycra</option>
                                             <option value="Linen">Linen</option>
                                             <option value="Bamboo">Bamboo</option>
                                             <option value="Recycled Cotton">Recycled Cotton</option>
                                             <option value="Recycled Polyester">Recycled Polyester</option>
                                             <option value="Jute">Jute</option>
                                             <option value="Modal">Modal</option>
                                             <option value="Rayon">Rayon</option>
                                       <?php
                                          }
                                          else if($description_or_type_for_total_other_fiber=='Linen')
                                          {
                                         ?>
                                             <option value="Lyocell">Lyocell</option>
                                             <option value="Viscose">Viscose</option>
                                             <option value="Tencel">Tencel</option>
                                             <option value="Lycra">Lycra</option>
                                             <option value="Linen" selected>Linen</option>
                                             <option value="Bamboo">Bamboo</option>
                                             <option value="Recycled Cotton">Recycled Cotton</option>
                                             <option value="Recycled Polyester">Recycled Polyester</option>
                                             <option value="Jute">Jute</option>
                                             <option value="Modal">Modal</option>
                                             <option value="Rayon">Rayon</option>
                                       <?php
                                          }
                                          else if($description_or_type_for_total_other_fiber=='Bamboo')
                                          {
                                         ?>
                                             <option value="Lyocell">Lyocell</option>
                                             <option value="Viscose">Viscose</option>
                                             <option value="Tencel">Tencel</option>
                                             <option value="Lycra">Lycra</option>
                                             <option value="Linen">Linen</option>
                                             <option value="Bamboo" selected>Bamboo</option>
                                             <option value="Recycled Cotton">Recycled Cotton</option>
                                             <option value="Recycled Polyester">Recycled Polyester</option>
                                             <option value="Jute">Jute</option>
                                             <option value="Modal">Modal</option>
                                             <option value="Rayon">Rayon</option>
                                       <?php
                                          }
                                          else if($description_or_type_for_total_other_fiber=='Recycled Cotton')
                                          {
                                         ?>
                                             <option value="Lyocell">Lyocell</option>
                                             <option value="Viscose">Viscose</option>
                                             <option value="Tencel">Tencel</option>
                                             <option value="Lycra">Lycra</option>
                                             <option value="Linen">Linen</option>
                                             <option value="Bamboo">Bamboo</option>
                                             <option value="Recycled Cotton" selected>Recycled Cotton</option>
                                             <option value="Recycled Polyester">Recycled Polyester</option>
                                             <option value="Jute">Jute</option>
                                             <option value="Modal">Modal</option>
                                             <option value="Rayon">Rayon</option>
                                       <?php
                                          }
                                          else if($description_or_type_for_total_other_fiber=='Recycled Polyester')
                                          {
                                         ?>
                                             <option value="Lyocell">Lyocell</option>
                                             <option value="Viscose">Viscose</option>
                                             <option value="Tencel">Tencel</option>
                                             <option value="Lycra">Lycra</option>
                                             <option value="Linen">Linen</option>
                                             <option value="Bamboo">Bamboo</option>
                                             <option value="Recycled Cotton">Recycled Cotton</option>
                                             <option value="Recycled Polyester" selected>Recycled Polyester</option>
                                             <option value="Jute">Jute</option>
                                             <option value="Modal">Modal</option>
                                             <option value="Rayon">Rayon</option>
                                       <?php
                                          }
                                          else if($description_or_type_for_total_other_fiber=='Jute')
                                          {
                                         ?>
                                             <option value="Lyocell">Lyocell</option>
                                             <option value="Viscose">Viscose</option>
                                             <option value="Tencel">Tencel</option>
                                             <option value="Lycra">Lycra</option>
                                             <option value="Linen">Linen</option>
                                             <option value="Bamboo">Bamboo</option>
                                             <option value="Recycled Cotton">Recycled Cotton</option>
                                             <option value="Recycled Polyester">Recycled Polyester</option>
                                             <option value="Jute" selected>Jute</option>
                                             <option value="Modal">Modal</option>
                                             <option value="Rayon">Rayon</option>
                                       <?php
                                          }
                                          else if($description_or_type_for_total_other_fiber=='Modal')
                                          {
                                         ?>
                                             <option value="Lyocell">Lyocell</option>
                                             <option value="Viscose">Viscose</option>
                                             <option value="Tencel">Tencel</option>
                                             <option value="Lycra">Lycra</option>
                                             <option value="Linen">Linen</option>
                                             <option value="Bamboo">Bamboo</option>
                                             <option value="Recycled Cotton">Recycled Cotton</option>
                                             <option value="Recycled Polyester">Recycled Polyester</option>
                                             <option value="Jute">Jute</option>
                                             <option value="Modal" selected>Modal</option>
                                             <option value="Rayon">Rayon</option>
                                       <?php
                                          }
                                          else if($description_or_type_for_total_other_fiber=='Rayon')
                                          {
                                         ?>
                                             <option value="Lyocell">Lyocell</option>
                                             <option value="Viscose">Viscose</option>
                                             <option value="Tencel">Tencel</option>
                                             <option value="Lycra">Lycra</option>
                                             <option value="Linen">Linen</option>
                                             <option value="Bamboo">Bamboo</option>
                                             <option value="Recycled Cotton">Recycled Cotton</option>
                                             <option value="Recycled Polyester">Recycled Polyester</option>
                                             <option value="Jute">Jute</option>
                                             <option value="Modal" >Modal</option>
                                             <option value="Rayon" selected>Rayon</option>
                                       <?php
                                          }
                                          else
                                          {
                                         ?>
                                             <option value="Lyocell">Lyocell</option>
                                             <option value="Viscose">Viscose</option>
                                             <option value="Tencel">Tencel</option>
                                             <option value="Lycra">Lycra</option>
                                             <option value="Linen">Linen</option>
                                             <option value="Bamboo">Bamboo</option>
                                             <option value="Recycled Cotton">Recycled Cotton</option>
                                             <option value="Recycled Polyester">Recycled Polyester</option>
                                             <option value="Jute">Jute</option>
                                             <option value="Modal">Modal</option>
                                             <option value="Rayon" >Rayon</option>
                                       <?php
                                          }
                                        
                                       ?>
		              
					</select>
	                <input type="hidden" class="form-control" class="form-control" id="test_method_for_total_other_fiber_content" name="test_method_for_total_other_fiber_content" value="In house test method">
                
           </div>

       

           <div class="col-sm-1 text-center">
                 <input type="text" class="form-control" id="percentage_of_total_other_fiber_content_value" name="percentage_of_total_other_fiber_content_value" value="<?php echo $row_for_greige_receiving['percentage_of_total_other_fiber_content_value']?>" onchange="percentage_of_total_other_fiber_content_cal()" required>
             
          </div>
            
             
          <div class="col-sm-1 text-center">
               <select  class="form-control" id="percentage_of_total_other_fiber_content_tolerance_range_math_op" name="percentage_of_total_other_fiber_content_tolerance_range_math_op" onchange="percentage_of_total_other_fiber_content_cal()">
                      <option value="">Select Percentage of Total other_fiber Content Math Operator</option>
                      <?php
                                      $percentage_of_total_other_fiber_content_tolerance_range_math_op = $row_for_greige_receiving['percentage_of_total_other_fiber_content_tolerance_range_math_op'];
                                     ?>
                                     <?php 
                                          if($percentage_of_total_other_fiber_content_tolerance_range_math_op=='+')
                                          {
                                       ?>
                                          <option value="+" selected> +</option>
                                          <option value="-"> -</option>
                                          <option value="±">±</option>
                                      <?php
                                          }
                                          else if($percentage_of_total_other_fiber_content_tolerance_range_math_op=='-')
                                          {
                                         ?>
                                          <option value="+">+</option>
                                          <option value="-" selected>-</option>
                                          <option value="±">±</option>
                                       <?php
                                          }
                                          else if($percentage_of_total_other_fiber_content_tolerance_range_math_op=='±')
                                          {
                                         ?>
                                          <option value="+">+</option>
                                          <option value="-" >-</option>
                                          <option value="±" selected>±</option>
                                       <?php
                                          }
                                          else
                                          {
                                         ?>
                                          <option value="+">+</option>
                                          <option value="-">-</option>
                                          <option value="±" >±</option>
                                       <?php
                                          }
                                       ?>
                </select>
              
           </div>
            
                 <!--Add Input/Select Field Here No Dive Only Input/Select/Radio Button/Checkbox/Textarea -->
              
          <div class="col-sm-1" for="tolerance">

             
              <input type="text" class="form-control" id="percentage_of_total_other_fiber_content_tolerance_value" name="percentage_of_total_other_fiber_content_tolerance_value" value="<?php echo $row_for_greige_receiving['percentage_of_total_other_fiber_content_tolerance_value']?>" onchange="percentage_of_total_other_fiber_content_cal()" required>
          </div>

          <div class="col-sm-1" for="unit">

             %
            <input type="hidden" class="form-control" class="form-control" id="uom_of_percentage_of_total_other_fiber_content" name="uom_of_percentage_of_total_other_fiber_content" value="%" >
          </div>

            
          <div class="col-sm-1 text-center" for="min_value">

             <input type="text" class="form-control" id="percentage_of_total_other_fiber_content_min_value" name="percentage_of_total_other_fiber_content_min_value" value="<?php echo $row_for_greige_receiving['percentage_of_total_other_fiber_content_min_value']?>" required>

          </div>
              
          <div class="col-sm-1 text-center">
              
           <input type="text" class="form-control" id="percentage_of_total_other_fiber_content_max_value" name="percentage_of_total_other_fiber_content_max_value" value="<?php echo $row_for_greige_receiving['percentage_of_total_other_fiber_content_max_value']?>" required>

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
		              	<option value="">Select total Other Fiber</option>
                       <?php
                                      $description_or_type_for_total_other_fiber_1 = $row_for_greige_receiving['description_or_type_for_total_other_fiber_1'];
                                 
                                          if($description_or_type_for_total_other_fiber_1=='Lyocell')
                                          {
                                       ?>
                                             <option value="Lyocell" selected>Lyocell</option>
                                             <option value="Viscose">Viscose</option>
                                             <option value="Tencel">Tencel</option>
                                             <option value="Lycra">Lycra</option>
                                             <option value="Linen">Linen</option>
                                             <option value="Bamboo">Bamboo</option>
                                             <option value="Recycled Cotton">Recycled Cotton</option>
                                             <option value="Recycled Polyester">Recycled Polyester</option>
                                             <option value="Jute">Jute</option>
                                             <option value="Modal">Modal</option>
                                             <option value="Rayon">Rayon</option>
                                      <?php
                                          }
                                          else if($description_or_type_for_total_other_fiber_1=='Viscose')
                                          {
                                         ?>
                                             <option value="Lyocell">Lyocell</option>
                                             <option value="Viscose" selected>Viscose</option>
                                             <option value="Tencel">Tencel</option>
                                             <option value="Lycra">Lycra</option>
                                             <option value="Linen">Linen</option>
                                             <option value="Bamboo">Bamboo</option>
                                             <option value="Recycled Cotton">Recycled Cotton</option>
                                             <option value="Recycled Polyester">Recycled Polyester</option>
                                             <option value="Jute">Jute</option>
                                             <option value="Modal">Modal</option>
                                             <option value="Rayon">Rayon</option>
                                       <?php
                                          }
                                          else if($description_or_type_for_total_other_fiber_1=='Tencel')
                                          {
                                         ?>
                                             <option value="Lyocell">Lyocell</option>
                                             <option value="Viscose">Viscose</option>
                                             <option value="Tencel" selected>Tencel</option>
                                             <option value="Lycra">Lycra</option>
                                             <option value="Linen">Linen</option>
                                             <option value="Bamboo">Bamboo</option>
                                             <option value="Recycled Cotton">Recycled Cotton</option>
                                             <option value="Recycled Polyester">Recycled Polyester</option>
                                             <option value="Jute">Jute</option>
                                             <option value="Modal">Modal</option>
                                             <option value="Rayon">Rayon</option>
                                       <?php
                                          }
                                          else if($description_or_type_for_total_other_fiber_1=='Lycra')
                                          {
                                         ?>
                                             <option value="Lyocell">Lyocell</option>
                                             <option value="Viscose">Viscose</option>
                                             <option value="Tencel">Tencel</option>
                                             <option value="Lycra" selected>Lycra</option>
                                             <option value="Linen">Linen</option>
                                             <option value="Bamboo">Bamboo</option>
                                             <option value="Recycled Cotton">Recycled Cotton</option>
                                             <option value="Recycled Polyester">Recycled Polyester</option>
                                             <option value="Jute">Jute</option>
                                             <option value="Modal">Modal</option>
                                             <option value="Rayon">Rayon</option>
                                       <?php
                                          }
                                          else if($description_or_type_for_total_other_fiber_1=='Linen')
                                          {
                                         ?>
                                             <option value="Lyocell">Lyocell</option>
                                             <option value="Viscose">Viscose</option>
                                             <option value="Tencel">Tencel</option>
                                             <option value="Lycra">Lycra</option>
                                             <option value="Linen" selected>Linen</option>
                                             <option value="Bamboo">Bamboo</option>
                                             <option value="Recycled Cotton">Recycled Cotton</option>
                                             <option value="Recycled Polyester">Recycled Polyester</option>
                                             <option value="Jute">Jute</option>
                                             <option value="Modal">Modal</option>
                                             <option value="Rayon">Rayon</option>
                                       <?php
                                          }
                                          else if($description_or_type_for_total_other_fiber_1=='Bamboo')
                                          {
                                         ?>
                                             <option value="Lyocell">Lyocell</option>
                                             <option value="Viscose">Viscose</option>
                                             <option value="Tencel">Tencel</option>
                                             <option value="Lycra">Lycra</option>
                                             <option value="Linen">Linen</option>
                                             <option value="Bamboo" selected>Bamboo</option>
                                             <option value="Recycled Cotton">Recycled Cotton</option>
                                             <option value="Recycled Polyester">Recycled Polyester</option>
                                             <option value="Jute">Jute</option>
                                             <option value="Modal">Modal</option>
                                             <option value="Rayon">Rayon</option>
                                       <?php
                                          }
                                          else if($description_or_type_for_total_other_fiber_1=='Recycled Cotton')
                                          {
                                         ?>
                                             <option value="Lyocell">Lyocell</option>
                                             <option value="Viscose">Viscose</option>
                                             <option value="Tencel">Tencel</option>
                                             <option value="Lycra">Lycra</option>
                                             <option value="Linen">Linen</option>
                                             <option value="Bamboo">Bamboo</option>
                                             <option value="Recycled Cotton" selected>Recycled Cotton</option>
                                             <option value="Recycled Polyester">Recycled Polyester</option>
                                             <option value="Jute">Jute</option>
                                             <option value="Modal">Modal</option>
                                             <option value="Rayon">Rayon</option>
                                       <?php
                                          }
                                          else if($description_or_type_for_total_other_fiber_1=='Recycled Polyester')
                                          {
                                         ?>
                                             <option value="Lyocell">Lyocell</option>
                                             <option value="Viscose">Viscose</option>
                                             <option value="Tencel">Tencel</option>
                                             <option value="Lycra">Lycra</option>
                                             <option value="Linen">Linen</option>
                                             <option value="Bamboo">Bamboo</option>
                                             <option value="Recycled Cotton">Recycled Cotton</option>
                                             <option value="Recycled Polyester" selected>Recycled Polyester</option>
                                             <option value="Jute">Jute</option>
                                             <option value="Modal">Modal</option>
                                             <option value="Rayon">Rayon</option>
                                       <?php
                                          }
                                          else if($description_or_type_for_total_other_fiber_1=='Jute')
                                          {
                                         ?>
                                             <option value="Lyocell">Lyocell</option>
                                             <option value="Viscose">Viscose</option>
                                             <option value="Tencel">Tencel</option>
                                             <option value="Lycra">Lycra</option>
                                             <option value="Linen">Linen</option>
                                             <option value="Bamboo">Bamboo</option>
                                             <option value="Recycled Cotton">Recycled Cotton</option>
                                             <option value="Recycled Polyester">Recycled Polyester</option>
                                             <option value="Jute" selected>Jute</option>
                                             <option value="Modal">Modal</option>
                                             <option value="Rayon">Rayon</option>
                                       <?php
                                          }
                                          else if($description_or_type_for_total_other_fiber_1=='Modal')
                                          {
                                         ?>
                                             <option value="Lyocell">Lyocell</option>
                                             <option value="Viscose">Viscose</option>
                                             <option value="Tencel">Tencel</option>
                                             <option value="Lycra">Lycra</option>
                                             <option value="Linen">Linen</option>
                                             <option value="Bamboo">Bamboo</option>
                                             <option value="Recycled Cotton">Recycled Cotton</option>
                                             <option value="Recycled Polyester">Recycled Polyester</option>
                                             <option value="Jute">Jute</option>
                                             <option value="Modal" selected>Modal</option>
                                             <option value="Rayon">Rayon</option>
                                       <?php
                                          }
                                          else if($description_or_type_for_total_other_fiber_1=='Rayon')
                                          {
                                         ?>
                                             <option value="Lyocell">Lyocell</option>
                                             <option value="Viscose">Viscose</option>
                                             <option value="Tencel">Tencel</option>
                                             <option value="Lycra">Lycra</option>
                                             <option value="Linen">Linen</option>
                                             <option value="Bamboo">Bamboo</option>
                                             <option value="Recycled Cotton">Recycled Cotton</option>
                                             <option value="Recycled Polyester">Recycled Polyester</option>
                                             <option value="Jute">Jute</option>
                                             <option value="Modal" >Modal</option>
                                             <option value="Rayon" selected>Rayon</option>
                                       <?php
                                          }
                                          else
                                          {
                                         ?>
                                             <option value="Lyocell">Lyocell</option>
                                             <option value="Viscose">Viscose</option>
                                             <option value="Tencel">Tencel</option>
                                             <option value="Lycra">Lycra</option>
                                             <option value="Linen">Linen</option>
                                             <option value="Bamboo">Bamboo</option>
                                             <option value="Recycled Cotton">Recycled Cotton</option>
                                             <option value="Recycled Polyester">Recycled Polyester</option>
                                             <option value="Jute">Jute</option>
                                             <option value="Modal">Modal</option>
                                             <option value="Rayon" >Rayon</option>
                                       <?php
                                          }
                                        
                                       ?>
		              
	              </select>

           <!-- <select  class="form-control" id="description_or_type_for_total_other_fiber_1" name="description_or_type_for_total_other_fiber_1">
		              <option value="">Select Other Fiber</option>
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
                  <input type="hidden" class="form-control" class="form-control" id="test_method_for_total_other_fiber_content_1" name="test_method_for_total_other_fiber_content_1" value="In house test method">
                
           </div>

       

           <div class="col-sm-1 text-center">
                 <input type="text" class="form-control" id="percentage_of_total_other_fiber_content_1_value" name="percentage_of_total_other_fiber_content_1_value" value="<?php echo $row_for_greige_receiving['percentage_of_total_other_fiber_content_1_value']?>" onchange="percentage_of_total_other_fiber_content_1_cal()" required>
             
           </div>
            
             
           <div class="col-sm-1 text-center">
               <select  class="form-control" id="percentage_of_total_other_fiber_content_1_tol_range_math_op" name="percentage_of_total_other_fiber_content_1_tol_range_math_op" onchange="percentage_of_total_other_fiber_content_1_cal()">
                      <option value="">Select Percentage of Total other_fiber Content Math Operator</option>
                      <?php
                                      $percentage_of_total_other_fiber_content_1_tol_range_math_op = $row_for_greige_receiving['percentage_of_total_other_fiber_content_1_tol_range_math_op'];
                                     ?>
                                     <?php 
                                          if($percentage_of_total_other_fiber_content_1_tol_range_math_op=='+')
                                          {
                                       ?>
                                          <option value="+" selected> +</option>
                                          <option value="-"> -</option>
                                          <option value="±">±</option>
                                      <?php
                                          }
                                          else if($percentage_of_total_other_fiber_content_1_tol_range_math_op=='-')
                                          {
                                         ?>
                                          <option value="+">+</option>
                                          <option value="-" selected>-</option>
                                          <option value="±">±</option>
                                       <?php
                                          }
                                          else if($percentage_of_total_other_fiber_content_1_tol_range_math_op=='±')
                                          {
                                         ?>
                                          <option value="+">+</option>
                                          <option value="-" >-</option>
                                          <option value="±" selected>±</option>
                                       <?php
                                          }
                                          else
                                          {
                                         ?>
                                          <option value="+">+</option>
                                          <option value="-">-</option>
                                          <option value="±" >±</option>
                                       <?php
                                          }
                                       ?>
                </select>
              
           </div>
            
                 <!--Add Input/Select Field Here No Dive Only Input/Select/Radio Button/Checkbox/Textarea -->
              
          <div class="col-sm-1" for="tolerance">

              <input type="text" class="form-control" id="percentage_of_total_other_fiber_content_1_tolerance_value" name="percentage_of_total_other_fiber_content_1_tolerance_value" value="<?php echo $row_for_greige_receiving['percentage_of_total_other_fiber_content_1_tolerance_value']?>" onchange="percentage_of_total_other_fiber_content_1_cal()" required>
          </div>

          <div class="col-sm-1" for="unit">

             %
            <input type="hidden" class="form-control" class="form-control" id="uom_of_percentage_of_total_other_fiber_content_1" name="uom_of_percentage_of_total_other_fiber_content_1" value="%" >
          </div>

            
          <div class="col-sm-1 text-center" for="min_value">

             <input type="text" class="form-control" id="percentage_of_total_other_fiber_content_1_min_value" name="percentage_of_total_other_fiber_content_1_min_value" value="<?php echo $row_for_greige_receiving['percentage_of_total_other_fiber_content_1_min_value']?>" required>

          </div>
              
          <div class="col-sm-1 text-center">
              
           <input type="text" class="form-control" id="percentage_of_total_other_fiber_content_1_max_value" name="percentage_of_total_other_fiber_content_1_max_value" value="<?php echo $row_for_greige_receiving['percentage_of_total_other_fiber_content_1_max_value']?>" required>

         </div>
                
       
     </div><!-- End of <div class="form-group form-group-sm" percentage_of_total_other_fiber_content_1_max_value-->




     <div class="form-group form-group-sm" >
      

         <div class="col-sm-3 text-center">
           <label class="control-label"  style="color:#00008B;"><span id="for_warp_cotton_content_test_name_label">Fiber Content</span><span id="warp_cotton_content_test_method">(In house test method)</span></label>
         </div>
         
         <div class="col-sm-2 text-center">
                  <!-- <label for="description_or_type" style="font-size:12px; color:#000066;">Direction/Type</label> -->
                  <label class="control-label" for="description_or_type" style="color:#00008B;">Cotton (Warp) </label>
                  <input type="hidden" class="form-control" class="form-control" id="test_method_for_warp_cotton_content" name="test_method_for_warp_cotton_content" value="In house test method">
                
         </div>

          <div class="col-sm-1 text-center">
                 <input type="text" class="form-control" id="percentage_of_warp_cotton_content_value" name="percentage_of_warp_cotton_content_value"  value="<?php echo $row_for_greige_receiving['percentage_of_warp_cotton_content_value']?>" onchange="percentage_of_warp_cotton_content_cal()" required>
             
          </div>
            
             
          <div class="col-sm-1 text-center">
               <select  class="form-control" id="percentage_of_warp_cotton_content_tolerance_range_math_operator" name="percentage_of_warp_cotton_content_tolerance_range_math_operator" onchange="percentage_of_warp_cotton_content_cal()">
                      <option value="">Select Percentage of Total other_fiber Content Math Operator</option>
                      <?php
                                      $percentage_of_warp_cotton_content_tolerance_range_math_operator = $row_for_greige_receiving['percentage_of_warp_cotton_content_tolerance_range_math_operator'];
                                     ?>
                                     <?php 
                                          if($percentage_of_warp_cotton_content_tolerance_range_math_operator=='+')
                                          {
                                       ?>
                                          <option value="+" selected> +</option>
                                          <option value="-"> -</option>
                                          <option value="±">±</option>
                                      <?php
                                          }
                                          else if($percentage_of_warp_cotton_content_tolerance_range_math_operator=='-')
                                          {
                                         ?>
                                          <option value="+">+</option>
                                          <option value="-" selected>-</option>
                                          <option value="±">±</option>
                                       <?php
                                          }
                                          else if($percentage_of_warp_cotton_content_tolerance_range_math_operator=='±')
                                          {
                                         ?>
                                          <option value="+">+</option>
                                          <option value="-" >-</option>
                                          <option value="±" selected> ±</option>
                                       <?php
                                          }
                                          else
                                          {
                                         ?>
                                          <option value="+">+</option>
                                          <option value="-">-</option>
                                          <option value="±" >±</option>
                                       <?php
                                          }
                                       ?>
                </select>
              
           </div>
            
                 <!--Add Input/Select Field Here No Dive Only Input/Select/Radio Button/Checkbox/Textarea -->
              
          <div class="col-sm-1" for="tolerance">

            
              <input type="text" class="form-control" id="percentage_of_warp_cotton_content_tolerance_value" name="percentage_of_warp_cotton_content_tolerance_value" value="<?php echo $row_for_greige_receiving['percentage_of_warp_cotton_content_tolerance_value']?>" onchange="percentage_of_warp_cotton_content_cal()" required>
          </div>

          <div class="col-sm-1" for="unit">

             %
            <input type="hidden" class="form-control" class="form-control" id="uom_of_percentage_of_warp_cotton_content" name="uom_of_percentage_of_warp_cotton_content" value="%" >
          </div>

            
          <div class="col-sm-1 text-center" for="min_value">

             <input type="text" class="form-control" id="percentage_of_warp_cotton_content_min_value" name="percentage_of_warp_cotton_content_min_value" value="<?php echo $row_for_greige_receiving['percentage_of_warp_cotton_content_min_value']?>" required>

          </div>
              
          <div class="col-sm-1 text-center">
              
           <input type="text" class="form-control" id="percentage_of_warp_cotton_content_max_value" name="percentage_of_warp_cotton_content_max_value" value="<?php echo $row_for_greige_receiving['percentage_of_warp_cotton_content_max_value']?>" required>

          </div>
                
       
     </div><!-- End of <div class="form-group form-group-sm" percentage_of_warp_cotton_content_max_value-->



     <div class="form-group form-group-sm" >
      

        <div class="col-sm-3 text-center">
           <label class="control-label"  style="color:#00008B;"><span id="for_warp_polyester_content_test_name_label" style="display: none;">Fiber Content</span><span id="warp_polyester_content_test_method" style="display: none;">(In house test method)</span></label>
        </div>
         
         <div class="col-sm-2 text-center">
                  <!-- <label for="description_or_type" style="font-size:12px; color:#000066;">Direction/Type</label> -->
                  <label class="control-label" for="description_or_type" style="color:#00008B;">polyester (Warp) </label>
                  <input type="hidden" class="form-control" class="form-control" id="test_method_for_warp_polyester_content" name="test_method_for_warp_polyester_content" value="In house test method">
                
           </div>

       

           <div class="col-sm-1 text-center">
                 <input type="text" class="form-control" id="percentage_of_warp_polyester_content_value" name="percentage_of_warp_polyester_content_value" value="<?php echo $row_for_greige_receiving['percentage_of_warp_polyester_content_value']?>" onchange="percentage_of_warp_polyester_content_cal()" required>
             
         </div>
            
             
          <div class="col-sm-1 text-center">
               <select  class="form-control" id="percentage_of_warp_polyester_content_tolerance_range_math_op" name="percentage_of_warp_polyester_content_tolerance_range_math_op" onchange="percentage_of_warp_polyester_content_cal()">
                      <option value="">Select Percentage of Total other_fiber Content Math Operator</option>
                      <?php
                                      $percentage_of_warp_polyester_content_tolerance_range_math_op = $row_for_greige_receiving['percentage_of_warp_polyester_content_tolerance_range_math_op'];
                                     ?>
                                     <?php 
                                          if($percentage_of_warp_polyester_content_tolerance_range_math_op=='+')
                                          {
                                       ?>
                                          <option value="+" selected> +</option>
                                          <option value="-"> -</option>
                                          <option value="±">±</option>
                                      <?php
                                          }
                                          else if($percentage_of_warp_polyester_content_tolerance_range_math_op=='-')
                                          {
                                         ?>
                                          <option value="+">+</option>
                                          <option value="-" selected>-</option>
                                          <option value="±">±</option>
                                       <?php
                                          }
                                          else if($percentage_of_warp_polyester_content_tolerance_range_math_op=='±')
                                          {
                                         ?>
                                          <option value="+">+</option>
                                          <option value="-" >-</option>
                                          <option value="±" selected>±</option>
                                       <?php
                                          }
                                          else
                                          {
                                         ?>
                                          <option value="+">+</option>
                                          <option value="-">-</option>
                                          <option value="±" >±</option>
                                       <?php
                                          }
                                       ?>
                </select>
              
           </div>
            
                 <!--Add Input/Select Field Here No Dive Only Input/Select/Radio Button/Checkbox/Textarea -->
              
          <div class="col-sm-1" for="tolerance">

            
              <input type="text" class="form-control" id="percentage_of_warp_polyester_content_tolerance_value" name="percentage_of_warp_polyester_content_tolerance_value" value="<?php echo $row_for_greige_receiving['percentage_of_warp_polyester_content_tolerance_value']?>" onchange="percentage_of_warp_polyester_content_cal()" required>
          </div>

          <div class="col-sm-1" for="unit">

             %
            <input type="hidden" class="form-control" class="form-control" id="uom_of_percentage_of_warp_polyester_content" name="uom_of_percentage_of_warp_polyester_content" value="%" >
          </div>

            
          <div class="col-sm-1 text-center" for="min_value">

             <input type="text" class="form-control" id="percentage_of_warp_polyester_content_min_value" name="percentage_of_warp_polyester_content_min_value" value="<?php echo $row_for_greige_receiving['percentage_of_warp_polyester_content_min_value']?>" required>

          </div>
              
          <div class="col-sm-1 text-center">
              
           <input type="text" class="form-control" id="percentage_of_warp_polyester_content_max_value" name="percentage_of_warp_polyester_content_max_value" value="<?php echo $row_for_greige_receiving['percentage_of_warp_polyester_content_max_value']?>" required>

         </div>
                
       
     </div><!-- End of <div class="form-group form-group-sm" percentage_of_warp_polyester_content_max_value-->



     <div class="form-group form-group-sm" >
      

        <div class="col-sm-3 text-center">
           <label class="control-label"  style="color:#00008B;"><span id="for_warp_polyester_content_test_name_label" style="display: none;">Fiber Content</span>   <span id="warp_polyester_content_test_method" style="display: none;">(In house test method)</span></label>
        </div>
         
         <div class="col-sm-2 text-center">
                  <!-- <label for="description_or_type" style="font-size:12px; color:#000066;">Direction/Type</label> -->
         <select  class="form-control" id="description_or_type_for_warp_other_fiber" name="description_or_type_for_warp_other_fiber">
              <option value="">Select Other Fiber in Warp</option>
              <?php
                                      $description_or_type_for_warp_other_fiber = $row_for_greige_receiving['description_or_type_for_warp_other_fiber'];
                                 
                                          if($description_or_type_for_warp_other_fiber=='Lyocell')
                                          {
                                       ?>
                                             <option value="Lyocell" selected>Lyocell</option>
                                             <option value="Viscose">Viscose</option>
                                             <option value="Tencel">Tencel</option>
                                             <option value="Lycra">Lycra</option>
                                             <option value="Linen">Linen</option>
                                             <option value="Bamboo">Bamboo</option>
                                             <option value="Recycled Cotton">Recycled Cotton</option>
                                             <option value="Recycled Polyester">Recycled Polyester</option>
                                             <option value="Jute">Jute</option>
                                             <option value="Modal">Modal</option>
                                             <option value="Rayon">Rayon</option>
                                      <?php
                                          }
                                          else if($description_or_type_for_warp_other_fiber=='Viscose')
                                          {
                                         ?>
                                             <option value="Lyocell">Lyocell</option>
                                             <option value="Viscose" selected>Viscose</option>
                                             <option value="Tencel">Tencel</option>
                                             <option value="Lycra">Lycra</option>
                                             <option value="Linen">Linen</option>
                                             <option value="Bamboo">Bamboo</option>
                                             <option value="Recycled Cotton">Recycled Cotton</option>
                                             <option value="Recycled Polyester">Recycled Polyester</option>
                                             <option value="Jute">Jute</option>
                                             <option value="Modal">Modal</option>
                                             <option value="Rayon">Rayon</option>
                                       <?php
                                          }
                                          else if($description_or_type_for_warp_other_fiber=='Tencel')
                                          {
                                         ?>
                                             <option value="Lyocell">Lyocell</option>
                                             <option value="Viscose">Viscose</option>
                                             <option value="Tencel" selected>Tencel</option>
                                             <option value="Lycra">Lycra</option>
                                             <option value="Linen">Linen</option>
                                             <option value="Bamboo">Bamboo</option>
                                             <option value="Recycled Cotton">Recycled Cotton</option>
                                             <option value="Recycled Polyester">Recycled Polyester</option>
                                             <option value="Jute">Jute</option>
                                             <option value="Modal">Modal</option>
                                             <option value="Rayon">Rayon</option>
                                       <?php
                                          }
                                          else if($description_or_type_for_warp_other_fiber=='Lycra')
                                          {
                                         ?>
                                             <option value="Lyocell">Lyocell</option>
                                             <option value="Viscose">Viscose</option>
                                             <option value="Tencel">Tencel</option>
                                             <option value="Lycra" selected>Lycra</option>
                                             <option value="Linen">Linen</option>
                                             <option value="Bamboo">Bamboo</option>
                                             <option value="Recycled Cotton">Recycled Cotton</option>
                                             <option value="Recycled Polyester">Recycled Polyester</option>
                                             <option value="Jute">Jute</option>
                                             <option value="Modal">Modal</option>
                                             <option value="Rayon">Rayon</option>
                                       <?php
                                          }
                                          else if($description_or_type_for_warp_other_fiber=='Linen')
                                          {
                                         ?>
                                             <option value="Lyocell">Lyocell</option>
                                             <option value="Viscose">Viscose</option>
                                             <option value="Tencel">Tencel</option>
                                             <option value="Lycra">Lycra</option>
                                             <option value="Linen" selected>Linen</option>
                                             <option value="Bamboo">Bamboo</option>
                                             <option value="Recycled Cotton">Recycled Cotton</option>
                                             <option value="Recycled Polyester">Recycled Polyester</option>
                                             <option value="Jute">Jute</option>
                                             <option value="Modal">Modal</option>
                                             <option value="Rayon">Rayon</option>
                                       <?php
                                          }
                                          else if($description_or_type_for_warp_other_fiber=='Bamboo')
                                          {
                                         ?>
                                             <option value="Lyocell">Lyocell</option>
                                             <option value="Viscose">Viscose</option>
                                             <option value="Tencel">Tencel</option>
                                             <option value="Lycra">Lycra</option>
                                             <option value="Linen">Linen</option>
                                             <option value="Bamboo" selected>Bamboo</option>
                                             <option value="Recycled Cotton">Recycled Cotton</option>
                                             <option value="Recycled Polyester">Recycled Polyester</option>
                                             <option value="Jute">Jute</option>
                                             <option value="Modal">Modal</option>
                                             <option value="Rayon">Rayon</option>
                                       <?php
                                          }
                                          else if($description_or_type_for_warp_other_fiber=='Recycled Cotton')
                                          {
                                         ?>
                                             <option value="Lyocell">Lyocell</option>
                                             <option value="Viscose">Viscose</option>
                                             <option value="Tencel">Tencel</option>
                                             <option value="Lycra">Lycra</option>
                                             <option value="Linen">Linen</option>
                                             <option value="Bamboo">Bamboo</option>
                                             <option value="Recycled Cotton" selected>Recycled Cotton</option>
                                             <option value="Recycled Polyester">Recycled Polyester</option>
                                             <option value="Jute">Jute</option>
                                             <option value="Modal">Modal</option>
                                             <option value="Rayon">Rayon</option>
                                       <?php
                                          }
                                          else if($description_or_type_for_warp_other_fiber=='Recycled Polyester')
                                          {
                                         ?>
                                             <option value="Lyocell">Lyocell</option>
                                             <option value="Viscose">Viscose</option>
                                             <option value="Tencel">Tencel</option>
                                             <option value="Lycra">Lycra</option>
                                             <option value="Linen">Linen</option>
                                             <option value="Bamboo">Bamboo</option>
                                             <option value="Recycled Cotton">Recycled Cotton</option>
                                             <option value="Recycled Polyester" selected>Recycled Polyester</option>
                                             <option value="Jute">Jute</option>
                                             <option value="Modal">Modal</option>
                                             <option value="Rayon">Rayon</option>
                                       <?php
                                          }
                                          else if($description_or_type_for_warp_other_fiber=='Jute')
                                          {
                                         ?>
                                             <option value="Lyocell">Lyocell</option>
                                             <option value="Viscose">Viscose</option>
                                             <option value="Tencel">Tencel</option>
                                             <option value="Lycra">Lycra</option>
                                             <option value="Linen">Linen</option>
                                             <option value="Bamboo">Bamboo</option>
                                             <option value="Recycled Cotton">Recycled Cotton</option>
                                             <option value="Recycled Polyester">Recycled Polyester</option>
                                             <option value="Jute" selected>Jute</option>
                                             <option value="Modal">Modal</option>
                                             <option value="Rayon">Rayon</option>
                                       <?php
                                          }
                                          else if($description_or_type_for_warp_other_fiber=='Modal')
                                          {
                                         ?>
                                             <option value="Lyocell">Lyocell</option>
                                             <option value="Viscose">Viscose</option>
                                             <option value="Tencel">Tencel</option>
                                             <option value="Lycra">Lycra</option>
                                             <option value="Linen">Linen</option>
                                             <option value="Bamboo">Bamboo</option>
                                             <option value="Recycled Cotton">Recycled Cotton</option>
                                             <option value="Recycled Polyester">Recycled Polyester</option>
                                             <option value="Jute">Jute</option>
                                             <option value="Modal" selected>Modal</option>
                                             <option value="Rayon">Rayon</option>
                                       <?php
                                          }
                                          else if($description_or_type_for_warp_other_fiber=='Rayon')
                                          {
                                         ?>
                                             <option value="Lyocell">Lyocell</option>
                                             <option value="Viscose">Viscose</option>
                                             <option value="Tencel">Tencel</option>
                                             <option value="Lycra">Lycra</option>
                                             <option value="Linen">Linen</option>
                                             <option value="Bamboo">Bamboo</option>
                                             <option value="Recycled Cotton">Recycled Cotton</option>
                                             <option value="Recycled Polyester">Recycled Polyester</option>
                                             <option value="Jute">Jute</option>
                                             <option value="Modal" >Modal</option>
                                             <option value="Rayon" selected>Rayon</option>
                                       <?php
                                          }
                                          else
                                          {
                                         ?>
                                             <option value="Lyocell">Lyocell</option>
                                             <option value="Viscose">Viscose</option>
                                             <option value="Tencel">Tencel</option>
                                             <option value="Lycra">Lycra</option>
                                             <option value="Linen">Linen</option>
                                             <option value="Bamboo">Bamboo</option>
                                             <option value="Recycled Cotton">Recycled Cotton</option>
                                             <option value="Recycled Polyester">Recycled Polyester</option>
                                             <option value="Jute">Jute</option>
                                             <option value="Modal">Modal</option>
                                             <option value="Rayon" >Rayon</option>
                                       <?php
                                          }
                                        
                                       ?>
		              
          </select>
                  <input type="hidden" class="form-control" class="form-control" id="test_method_for__warp_other_fiber" name="test_method_for_warp_other_fiber" value="In house test method">
                
           </div>

       

           <div class="col-sm-1 text-center">
                 <input type="text" class="form-control" id="percentage_of_warp_other_fiber_content_value" name="percentage_of_warp_other_fiber_content_value" value="<?php echo $row_for_greige_receiving['percentage_of_warp_other_fiber_content_value']?>" onchange="percentage_of_warp_other_fiber_content_cal()" required>
             
         </div>
            
             
          <div class="col-sm-1 text-center">
               <select  class="form-control" id="percentage_of_warp_other_fiber_content_tolerance_range_math_op" name="percentage_of_warp_other_fiber_content_tolerance_range_math_op" onchange="percentage_of_warp_other_fiber_content_cal()">
                      <option value="">Select Percentage of  other fiber Content Math Operator</option>
                      <?php
                                      $percentage_of_warp_other_fiber_content_tolerance_range_math_op = $row_for_greige_receiving['percentage_of_warp_other_fiber_content_tolerance_range_math_op'];
                                     ?>
                                     <?php 
                                          if($percentage_of_warp_other_fiber_content_tolerance_range_math_op=='+')
                                          {
                                       ?>
                                          <option value="+" selected> +</option>
                                          <option value="-"> -</option>
                                          <option value="±">±</option>
                                      <?php
                                          }
                                          else if($percentage_of_warp_other_fiber_content_tolerance_range_math_op=='-')
                                          {
                                         ?>
                                          <option value="+">+</option>
                                          <option value="-" selected>-</option>
                                          <option value="±">±</option>
                                       <?php
                                          }
                                          else if($percentage_of_warp_other_fiber_content_tolerance_range_math_op=='±')
                                          {
                                         ?>
                                          <option value="+">+</option>
                                          <option value="-" >-</option>
                                          <option value="±" selected>±</option>
                                       <?php
                                          }
                                          else
                                          {
                                         ?>
                                          <option value="+">+</option>
                                          <option value="-">-</option>
                                          <option value="±" >±</option>
                                       <?php
                                          }
                                       ?>
                </select>
              
           </div>
            
                 <!--Add Input/Select Field Here No Dive Only Input/Select/Radio Button/Checkbox/Textarea -->
              
          <div class="col-sm-1" for="tolerance">

            
              <input type="text" class="form-control" id="percentage_of_warp_other_fiber_content_tolerance_value" name="percentage_of_warp_other_fiber_content_tolerance_value" value="<?php echo $row_for_greige_receiving['percentage_of_warp_other_fiber_content_tolerance_value']?>" onchange="percentage_of_warp_other_fiber_content_cal()" required>
          </div>

          <div class="col-sm-1" for="unit">

             %
            <input type="hidden" class="form-control" class="form-control" id="uom_of_percentage_of_warp_other_fiber_content" name="uom_of_percentage_of_warp_other_fiber_content" value="%" >
          </div>

            
          <div class="col-sm-1 text-center" for="min_value">

             <input type="text" class="form-control" id="percentage_of_warp_other_fiber_content_min_value" name="percentage_of_warp_other_fiber_content_min_value" value="<?php echo $row_for_greige_receiving['percentage_of_warp_other_fiber_content_min_value']?>" required>

          </div>
              
          <div class="col-sm-1 text-center">
              
           <input type="text" class="form-control" id="percentage_of_warp_other_fiber_content_max_value" name="percentage_of_warp_other_fiber_content_max_value" value="<?php echo $row_for_greige_receiving['percentage_of_warp_other_fiber_content_max_value']?>" required>

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
		              <option value="">Select Other Fiber in warp</option>
                    <?php
                                      $description_or_type_for_warp_other_fiber_1 = $row_for_greige_receiving['description_or_type_for_warp_other_fiber_1'];
                                 
                                          if($description_or_type_for_warp_other_fiber_1=='Lyocell')
                                          {
                                       ?>
                                             <option value="Lyocell" selected>Lyocell</option>
                                             <option value="Viscose">Viscose</option>
                                             <option value="Tencel">Tencel</option>
                                             <option value="Lycra">Lycra</option>
                                             <option value="Linen">Linen</option>
                                             <option value="Bamboo">Bamboo</option>
                                             <option value="Recycled Cotton">Recycled Cotton</option>
                                             <option value="Recycled Polyester">Recycled Polyester</option>
                                             <option value="Jute">Jute</option>
                                             <option value="Modal">Modal</option>
                                             <option value="Rayon">Rayon</option>
                                      <?php
                                          }
                                          else if($description_or_type_for_warp_other_fiber_1=='Viscose')
                                          {
                                         ?>
                                             <option value="Lyocell">Lyocell</option>
                                             <option value="Viscose" selected>Viscose</option>
                                             <option value="Tencel">Tencel</option>
                                             <option value="Lycra">Lycra</option>
                                             <option value="Linen">Linen</option>
                                             <option value="Bamboo">Bamboo</option>
                                             <option value="Recycled Cotton">Recycled Cotton</option>
                                             <option value="Recycled Polyester">Recycled Polyester</option>
                                             <option value="Jute">Jute</option>
                                             <option value="Modal">Modal</option>
                                             <option value="Rayon">Rayon</option>
                                       <?php
                                          }
                                          else if($description_or_type_for_warp_other_fiber_1=='Tencel')
                                          {
                                         ?>
                                             <option value="Lyocell">Lyocell</option>
                                             <option value="Viscose">Viscose</option>
                                             <option value="Tencel" selected>Tencel</option>
                                             <option value="Lycra">Lycra</option>
                                             <option value="Linen">Linen</option>
                                             <option value="Bamboo">Bamboo</option>
                                             <option value="Recycled Cotton">Recycled Cotton</option>
                                             <option value="Recycled Polyester">Recycled Polyester</option>
                                             <option value="Jute">Jute</option>
                                             <option value="Modal">Modal</option>
                                             <option value="Rayon">Rayon</option>
                                       <?php
                                          }
                                          else if($description_or_type_for_warp_other_fiber_1=='Lycra')
                                          {
                                         ?>
                                             <option value="Lyocell">Lyocell</option>
                                             <option value="Viscose">Viscose</option>
                                             <option value="Tencel">Tencel</option>
                                             <option value="Lycra" selected>Lycra</option>
                                             <option value="Linen">Linen</option>
                                             <option value="Bamboo">Bamboo</option>
                                             <option value="Recycled Cotton">Recycled Cotton</option>
                                             <option value="Recycled Polyester">Recycled Polyester</option>
                                             <option value="Jute">Jute</option>
                                             <option value="Modal">Modal</option>
                                             <option value="Rayon">Rayon</option>
                                       <?php
                                          }
                                          else if($description_or_type_for_warp_other_fiber_1=='Linen')
                                          {
                                         ?>
                                             <option value="Lyocell">Lyocell</option>
                                             <option value="Viscose">Viscose</option>
                                             <option value="Tencel">Tencel</option>
                                             <option value="Lycra">Lycra</option>
                                             <option value="Linen" selected>Linen</option>
                                             <option value="Bamboo">Bamboo</option>
                                             <option value="Recycled Cotton">Recycled Cotton</option>
                                             <option value="Recycled Polyester">Recycled Polyester</option>
                                             <option value="Jute">Jute</option>
                                             <option value="Modal">Modal</option>
                                             <option value="Rayon">Rayon</option>
                                       <?php
                                          }
                                          else if($description_or_type_for_warp_other_fiber_1=='Bamboo')
                                          {
                                         ?>
                                             <option value="Lyocell">Lyocell</option>
                                             <option value="Viscose">Viscose</option>
                                             <option value="Tencel">Tencel</option>
                                             <option value="Lycra">Lycra</option>
                                             <option value="Linen">Linen</option>
                                             <option value="Bamboo" selected>Bamboo</option>
                                             <option value="Recycled Cotton">Recycled Cotton</option>
                                             <option value="Recycled Polyester">Recycled Polyester</option>
                                             <option value="Jute">Jute</option>
                                             <option value="Modal">Modal</option>
                                             <option value="Rayon">Rayon</option>
                                       <?php
                                          }
                                          else if($description_or_type_for_warp_other_fiber_1=='Recycled Cotton')
                                          {
                                         ?>
                                             <option value="Lyocell">Lyocell</option>
                                             <option value="Viscose">Viscose</option>
                                             <option value="Tencel">Tencel</option>
                                             <option value="Lycra">Lycra</option>
                                             <option value="Linen">Linen</option>
                                             <option value="Bamboo">Bamboo</option>
                                             <option value="Recycled Cotton" selected>Recycled Cotton</option>
                                             <option value="Recycled Polyester">Recycled Polyester</option>
                                             <option value="Jute">Jute</option>
                                             <option value="Modal">Modal</option>
                                             <option value="Rayon">Rayon</option>
                                       <?php
                                          }
                                          else if($description_or_type_for_warp_other_fiber_1=='Recycled Polyester')
                                          {
                                         ?>
                                             <option value="Lyocell">Lyocell</option>
                                             <option value="Viscose">Viscose</option>
                                             <option value="Tencel">Tencel</option>
                                             <option value="Lycra">Lycra</option>
                                             <option value="Linen">Linen</option>
                                             <option value="Bamboo">Bamboo</option>
                                             <option value="Recycled Cotton">Recycled Cotton</option>
                                             <option value="Recycled Polyester" selected>Recycled Polyester</option>
                                             <option value="Jute">Jute</option>
                                             <option value="Modal">Modal</option>
                                             <option value="Rayon">Rayon</option>
                                       <?php
                                          }
                                          else if($description_or_type_for_warp_other_fiber_1=='Jute')
                                          {
                                         ?>
                                             <option value="Lyocell">Lyocell</option>
                                             <option value="Viscose">Viscose</option>
                                             <option value="Tencel">Tencel</option>
                                             <option value="Lycra">Lycra</option>
                                             <option value="Linen">Linen</option>
                                             <option value="Bamboo">Bamboo</option>
                                             <option value="Recycled Cotton">Recycled Cotton</option>
                                             <option value="Recycled Polyester">Recycled Polyester</option>
                                             <option value="Jute" selected>Jute</option>
                                             <option value="Modal">Modal</option>
                                             <option value="Rayon">Rayon</option>
                                       <?php
                                          }
                                          else if($description_or_type_for_warp_other_fiber_1=='Modal')
                                          {
                                         ?>
                                             <option value="Lyocell">Lyocell</option>
                                             <option value="Viscose">Viscose</option>
                                             <option value="Tencel">Tencel</option>
                                             <option value="Lycra">Lycra</option>
                                             <option value="Linen">Linen</option>
                                             <option value="Bamboo">Bamboo</option>
                                             <option value="Recycled Cotton">Recycled Cotton</option>
                                             <option value="Recycled Polyester">Recycled Polyester</option>
                                             <option value="Jute">Jute</option>
                                             <option value="Modal" selected>Modal</option>
                                             <option value="Rayon">Rayon</option>
                                       <?php
                                          }
                                          else if($description_or_type_for_warp_other_fiber_1=='Rayon')
                                          {
                                         ?>
                                             <option value="Lyocell">Lyocell</option>
                                             <option value="Viscose">Viscose</option>
                                             <option value="Tencel">Tencel</option>
                                             <option value="Lycra">Lycra</option>
                                             <option value="Linen">Linen</option>
                                             <option value="Bamboo">Bamboo</option>
                                             <option value="Recycled Cotton">Recycled Cotton</option>
                                             <option value="Recycled Polyester">Recycled Polyester</option>
                                             <option value="Jute">Jute</option>
                                             <option value="Modal" >Modal</option>
                                             <option value="Rayon" selected>Rayon</option>
                                       <?php
                                          }
                                          else
                                          {
                                         ?>
                                             <option value="Lyocell">Lyocell</option>
                                             <option value="Viscose">Viscose</option>
                                             <option value="Tencel">Tencel</option>
                                             <option value="Lycra">Lycra</option>
                                             <option value="Linen">Linen</option>
                                             <option value="Bamboo">Bamboo</option>
                                             <option value="Recycled Cotton">Recycled Cotton</option>
                                             <option value="Recycled Polyester">Recycled Polyester</option>
                                             <option value="Jute">Jute</option>
                                             <option value="Modal">Modal</option>
                                             <option value="Rayon" >Rayon</option>
                                       <?php
                                          }
                                        
                                       ?>
		              
			              
			      </select>

         
                  <input type="hidden" class="form-control" class="form-control" id="test_method_for_warp_other_fiber_content_1" name="test_method_for_warp_other_fiber_content_1" value="In house test method">
                
           </div>

       

           <div class="col-sm-1 text-center">
                 <input type="text" class="form-control" id="percentage_of_warp_other_fiber_content_1_value" name="percentage_of_warp_other_fiber_content_1_value" value="<?php echo $row_for_greige_receiving['percentage_of_warp_other_fiber_content_1_value']?>" onchange="percentage_of_warp_other_fiber_content_1_cal()" required>
             
         </div>
            
             
          <div class="col-sm-1 text-center">
               <select  class="form-control" id="percentage_of_warp_other_fiber_content_1_tolerance_range_math_op" name="percentage_of_warp_other_fiber_content_1_tolerance_range_math_op" onchange="percentage_of_warp_other_fiber_content_1_cal()">
                      <option value="">Select Percentage of warp other_fiber Content Math Operator</option>
                      <?php
                                      $percentage_of_warp_other_fiber_content_1_tolerance_range_math_op = $row_for_greige_receiving['percentage_of_warp_other_fiber_content_1_tolerance_range_math_op'];
                                     ?>
                                     <?php 
                                          if($percentage_of_warp_other_fiber_content_1_tolerance_range_math_op=='+')
                                          {
                                       ?>
                                          <option value="+" selected> +</option>
                                          <option value="-"> -</option>
                                          <option value="±">±</option>
                                      <?php
                                          }
                                          else if($percentage_of_warp_other_fiber_content_1_tolerance_range_math_op=='-')
                                          {
                                         ?>
                                          <option value="+">+</option>
                                          <option value="-" selected>-</option>
                                          <option value="±">±</option>
                                       <?php
                                          }
                                          else if($percentage_of_warp_other_fiber_content_1_tolerance_range_math_op=='±')
                                          {
                                         ?>
                                          <option value="+">+</option>
                                          <option value="-" >-</option>
                                          <option value="±" selected>±</option>
                                       <?php
                                          }
                                          else
                                          {
                                         ?>
                                          <option value="+">+</option>
                                          <option value="-">-</option>
                                          <option value="±" >±</option>
                                       <?php
                                          }
                                       ?>
                </select>
              
           </div>
            
                 <!--Add Input/Select Field Here No Dive Only Input/Select/Radio Button/Checkbox/Textarea -->
              
          <div class="col-sm-1" for="tolerance">

             
              <input type="text" class="form-control" id="percentage_of_warp_other_fiber_content_1_tolerance_value" name="percentage_of_warp_other_fiber_content_1_tolerance_value" value="<?php echo $row_for_greige_receiving['percentage_of_warp_other_fiber_content_1_tolerance_value']?>" onchange="percentage_of_warp_other_fiber_content_1_cal()" required>
          </div>

          <div class="col-sm-1" for="unit">

             %
            <input type="hidden" class="form-control" class="form-control" id="uom_of_percentage_of_warp_other_fiber_content_1" name="uom_of_percentage_of_warp_other_fiber_content_1" value="%" >
          </div>

            
          <div class="col-sm-1 text-center" for="min_value">

             <input type="text" class="form-control" id="percentage_of_warp_other_fiber_content_1_min_value" name="percentage_of_warp_other_fiber_content_1_min_value" value="<?php echo $row_for_greige_receiving['percentage_of_warp_other_fiber_content_1_min_value']?>" required>

          </div>
              
          <div class="col-sm-1 text-center">
              
           <input type="text" class="form-control" id="percentage_of_warp_other_fiber_content_1_max_value" name="percentage_of_warp_other_fiber_content_1_max_value" value="<?php echo $row_for_greige_receiving['percentage_of_warp_other_fiber_content_1_max_value']?>" required>

         </div>
                
       
     </div><!-- End of <div class="form-group form-group-sm" percentage_of_warp_other_fiber_content_1_max_value-->


     <div class="form-group form-group-sm" >
      

        <div class="col-sm-3 text-center">
           <label class="control-label"  style="color:#00008B;"><span id="for_weft_cotton_content_test_name_label">Fiber Content</span><span id="weft_cotton_content_test_method">(In house test method)</span></label>
        </div>
         
         <div class="col-sm-2 text-center">
                  <!-- <label for="description_or_type" style="font-size:12px; color:#000066;">Direction/Type</label> -->
                  <label class="control-label" for="description_or_type" style="color:#00008B;">cotton (weft) </label>
                  <input type="hidden" class="form-control" class="form-control" id="test_method_for_weft_cotton_content" name="test_method_for_weft_cotton_content" value="In house test method">
                
           </div>

       

           <div class="col-sm-1 text-center">
                 <input type="text" class="form-control" id="percentage_of_weft_cotton_content_value" name="percentage_of_weft_cotton_content_value" value="<?php echo $row_for_greige_receiving['percentage_of_weft_cotton_content_value']?>" onchange="percentage_of_weft_cotton_content_cal()" required>
             
         </div>
            
             
          <div class="col-sm-1 text-center">
               <select  class="form-control" id="percentage_of_weft_cotton_content_tolerance_range_math_op" name="percentage_of_weft_cotton_content_tolerance_range_math_op" onchange="percentage_of_weft_cotton_content_cal()">
                      <option value="">Select Percentage of Total other_fiber Content Math Operator</option>
                      <?php
                                      $percentage_of_weft_cotton_content_tolerance_range_math_op = $row_for_greige_receiving['percentage_of_weft_cotton_content_tolerance_range_math_op'];
                                     ?>
                                     <?php 
                                          if($percentage_of_weft_cotton_content_tolerance_range_math_op=='+')
                                          {
                                       ?>
                                          <option value="+" selected> +</option>
                                          <option value="-"> -</option>
                                          <option value="±">±</option>
                                      <?php
                                          }
                                          else if($percentage_of_weft_cotton_content_tolerance_range_math_op=='-')
                                          {
                                         ?>
                                          <option value="+">+</option>
                                          <option value="-" selected>-</option>
                                          <option value="±">±</option>
                                       <?php
                                          }
                                          else if($percentage_of_weft_cotton_content_tolerance_range_math_op=='±')
                                          {
                                         ?>
                                          <option value="+">+</option>
                                          <option value="-" >-</option>
                                          <option value="±" selected>±</option>
                                       <?php
                                          }
                                          else
                                          {
                                         ?>
                                          <option value="+">+</option>
                                          <option value="-">-</option>
                                          <option value="±" >±</option>
                                       <?php
                                          }
                                       ?>
                </select>
              
           </div>
            
                 <!--Add Input/Select Field Here No Dive Only Input/Select/Radio Button/Checkbox/Textarea -->
              
          <div class="col-sm-1" for="tolerance">

            
              <input type="text" class="form-control" id="percentage_of_weft_cotton_content_tolerance_value" name="percentage_of_weft_cotton_content_tolerance_value" value="<?php echo $row_for_greige_receiving['percentage_of_weft_cotton_content_tolerance_value']?>" onchange="percentage_of_weft_cotton_content_cal()" required>
          </div>

          <div class="col-sm-1" for="unit">

             %
            <input type="hidden" class="form-control" class="form-control" id="uom_of_percentage_of_weft_cotton_content" name="uom_of_percentage_of_weft_cotton_content" value="%" >
          </div>

            
          <div class="col-sm-1 text-center" for="min_value">

             <input type="text" class="form-control" id="percentage_of_weft_cotton_content_min_value" name="percentage_of_weft_cotton_content_min_value" value="<?php echo $row_for_greige_receiving['percentage_of_weft_cotton_content_min_value']?>" required>

          </div>
              
          <div class="col-sm-1 text-center">
              
           <input type="text" class="form-control" id="percentage_of_weft_cotton_content_max_value" name="percentage_of_weft_cotton_content_max_value" value="<?php echo $row_for_greige_receiving['percentage_of_weft_cotton_content_max_value']?>" required>

         </div>
                
       
     </div><!-- End of <div class="form-group form-group-sm" percentage_of_weft_cotton_content_max_value-->

    <div class="form-group form-group-sm" >
      

        <div class="col-sm-3 text-center">
           <label class="control-label"  style="color:#00008B;"><span id="for_weft_polyester_content_test_name_label" style="display: none;">Fiber Content</span><span id="weft_polyester_content_test_method" style="display: none;">(In house test method)</span></label>
        </div>
         
         <div class="col-sm-2 text-center">
                  <!-- <label for="description_or_type" style="font-size:12px; color:#000066;">Direction/Type</label> -->
                  <label class="control-label" for="description_or_type" style="color:#00008B;">polyester (weft) </label>
                  <input type="hidden" class="form-control" class="form-control" id="test_method_for_weft_polyester_content" name="test_method_for_weft_polyester_content" value="In house test method">
                
           </div>

       

           <div class="col-sm-1 text-center">
                 <input type="text" class="form-control" id="percentage_of_weft_polyester_content_value" name="percentage_of_weft_polyester_content_value" value="<?php echo $row_for_greige_receiving['percentage_of_weft_polyester_content_value']?>" onchange="percentage_of_weft_polyester_content_cal()" required>
             
         </div>
            
             
          <div class="col-sm-1 text-center">
               <select  class="form-control" id="percentage_of_weft_polyester_content_tolerance_range_math_op" name="percentage_of_weft_polyester_content_tolerance_range_math_op" onchange="percentage_of_weft_polyester_content_cal()">
                      <option value="">Select Percentage of Total other_fiber Content Math Operator</option>
                      <?php
                                      $percentage_of_weft_polyester_content_tolerance_range_math_op = $row_for_greige_receiving['percentage_of_weft_polyester_content_tolerance_range_math_op'];
                                     ?>
                                     <?php 
                                          if($percentage_of_weft_polyester_content_tolerance_range_math_op=='+')
                                          {
                                       ?>
                                          <option value="+" selected> +</option>
                                          <option value="-"> -</option>
                                          <option value="±">±</option>
                                      <?php
                                          }
                                          else if($percentage_of_weft_polyester_content_tolerance_range_math_op=='-')
                                          {
                                         ?>
                                          <option value="+">+</option>
                                          <option value="-" selected>-</option>
                                          <option value="±">±</option>
                                       <?php
                                          }
                                          else if($percentage_of_weft_polyester_content_tolerance_range_math_op=='±')
                                          {
                                         ?>
                                          <option value="+">+</option>
                                          <option value="-" >-</option>
                                          <option value="±" selected>±</option>
                                       <?php
                                          }
                                          else
                                          {
                                         ?>
                                          <option value="+">+</option>
                                          <option value="-">-</option>
                                          <option value="±" >±</option>
                                       <?php
                                          }
                                       ?>
                </select>
              
           </div>
            
                 <!--Add Input/Select Field Here No Dive Only Input/Select/Radio Button/Checkbox/Textarea -->
              
          <div class="col-sm-1" for="tolerance">

            
              <input type="text" class="form-control" id="percentage_of_weft_polyester_content_tolerance_value" name="percentage_of_weft_polyester_content_tolerance_value" value="<?php echo $row_for_greige_receiving['percentage_of_weft_polyester_content_tolerance_value']?>" onchange="percentage_of_weft_polyester_content_cal()" required>
          </div>

          <div class="col-sm-1" for="unit">

             %
            <input type="hidden" class="form-control" class="form-control" id="uom_of_percentage_of_weft_polyester_content" name="uom_of_percentage_of_weft_polyester_content" value="%" >
          </div>

            
          <div class="col-sm-1 text-center" for="min_value">

             <input type="text" class="form-control" id="percentage_of_weft_polyester_content_min_value" name="percentage_of_weft_polyester_content_min_value" value="<?php echo $row_for_greige_receiving['percentage_of_weft_polyester_content_min_value']?>" required>

          </div>
              
          <div class="col-sm-1 text-center">
              
           <input type="text" class="form-control" id="percentage_of_weft_polyester_content_max_value" name="percentage_of_weft_polyester_content_max_value" value="<?php echo $row_for_greige_receiving['percentage_of_weft_polyester_content_max_value']?>" required>

         </div>
                
       
     </div><!-- End of <div class="form-group form-group-sm" percentage_of_weft_polyester_content_max_value-->

      <div class="form-group form-group-sm" >
      

        <div class="col-sm-3 text-center">
           <label class="control-label"  style="color:#00008B;"><span id="for_weft_polyester_content_test_name_label" style="display: none;">Fiber Content   <span id="weft_polyester_content_test_method" style="display: none;">(In house test method)</span></label>
        </div>
         
         <div class="col-sm-2 text-center">
                  <!-- <label for="description_or_type" style="font-size:12px; color:#000066;">Direction/Type</label> -->
         <select  class="form-control" id="description_or_type_for_weft_other_fiber" name="description_or_type_for_weft_other_fiber">
              <option value="">Select Other Fiber in weft</option>
              <?php
                                      $description_or_type_for_weft_other_fiber = $row_for_greige_receiving['description_or_type_for_weft_other_fiber'];
                                 
                                          if($description_or_type_for_weft_other_fiber=='Lyocell')
                                          {
                                       ?>
                                             <option value="Lyocell" selected>Lyocell</option>
                                             <option value="Viscose">Viscose</option>
                                             <option value="Tencel">Tencel</option>
                                             <option value="Lycra">Lycra</option>
                                             <option value="Linen">Linen</option>
                                             <option value="Bamboo">Bamboo</option>
                                             <option value="Recycled Cotton">Recycled Cotton</option>
                                             <option value="Recycled Polyester">Recycled Polyester</option>
                                             <option value="Jute">Jute</option>
                                             <option value="Modal">Modal</option>
                                             <option value="Rayon">Rayon</option>
                                      <?php
                                          }
                                          else if($description_or_type_for_weft_other_fiber=='Viscose')
                                          {
                                         ?>
                                             <option value="Lyocell">Lyocell</option>
                                             <option value="Viscose" selected>Viscose</option>
                                             <option value="Tencel">Tencel</option>
                                             <option value="Lycra">Lycra</option>
                                             <option value="Linen">Linen</option>
                                             <option value="Bamboo">Bamboo</option>
                                             <option value="Recycled Cotton">Recycled Cotton</option>
                                             <option value="Recycled Polyester">Recycled Polyester</option>
                                             <option value="Jute">Jute</option>
                                             <option value="Modal">Modal</option>
                                             <option value="Rayon">Rayon</option>
                                       <?php
                                          }
                                          else if($description_or_type_for_weft_other_fiber=='Tencel')
                                          {
                                         ?>
                                             <option value="Lyocell">Lyocell</option>
                                             <option value="Viscose">Viscose</option>
                                             <option value="Tencel" selected>Tencel</option>
                                             <option value="Lycra">Lycra</option>
                                             <option value="Linen">Linen</option>
                                             <option value="Bamboo">Bamboo</option>
                                             <option value="Recycled Cotton">Recycled Cotton</option>
                                             <option value="Recycled Polyester">Recycled Polyester</option>
                                             <option value="Jute">Jute</option>
                                             <option value="Modal">Modal</option>
                                             <option value="Rayon">Rayon</option>
                                       <?php
                                          }
                                          else if($description_or_type_for_weft_other_fiber=='Lycra')
                                          {
                                         ?>
                                             <option value="Lyocell">Lyocell</option>
                                             <option value="Viscose">Viscose</option>
                                             <option value="Tencel">Tencel</option>
                                             <option value="Lycra" selected>Lycra</option>
                                             <option value="Linen">Linen</option>
                                             <option value="Bamboo">Bamboo</option>
                                             <option value="Recycled Cotton">Recycled Cotton</option>
                                             <option value="Recycled Polyester">Recycled Polyester</option>
                                             <option value="Jute">Jute</option>
                                             <option value="Modal">Modal</option>
                                             <option value="Rayon">Rayon</option>
                                       <?php
                                          }
                                          else if($description_or_type_for_weft_other_fiber=='Linen')
                                          {
                                         ?>
                                             <option value="Lyocell">Lyocell</option>
                                             <option value="Viscose">Viscose</option>
                                             <option value="Tencel">Tencel</option>
                                             <option value="Lycra">Lycra</option>
                                             <option value="Linen" selected>Linen</option>
                                             <option value="Bamboo">Bamboo</option>
                                             <option value="Recycled Cotton">Recycled Cotton</option>
                                             <option value="Recycled Polyester">Recycled Polyester</option>
                                             <option value="Jute">Jute</option>
                                             <option value="Modal">Modal</option>
                                             <option value="Rayon">Rayon</option>
                                       <?php
                                          }
                                          else if($description_or_type_for_weft_other_fiber=='Bamboo')
                                          {
                                         ?>
                                             <option value="Lyocell">Lyocell</option>
                                             <option value="Viscose">Viscose</option>
                                             <option value="Tencel">Tencel</option>
                                             <option value="Lycra">Lycra</option>
                                             <option value="Linen">Linen</option>
                                             <option value="Bamboo" selected>Bamboo</option>
                                             <option value="Recycled Cotton">Recycled Cotton</option>
                                             <option value="Recycled Polyester">Recycled Polyester</option>
                                             <option value="Jute">Jute</option>
                                             <option value="Modal">Modal</option>
                                             <option value="Rayon">Rayon</option>
                                       <?php
                                          }
                                          else if($description_or_type_for_weft_other_fiber=='Recycled Cotton')
                                          {
                                         ?>
                                             <option value="Lyocell">Lyocell</option>
                                             <option value="Viscose">Viscose</option>
                                             <option value="Tencel">Tencel</option>
                                             <option value="Lycra">Lycra</option>
                                             <option value="Linen">Linen</option>
                                             <option value="Bamboo">Bamboo</option>
                                             <option value="Recycled Cotton" selected>Recycled Cotton</option>
                                             <option value="Recycled Polyester">Recycled Polyester</option>
                                             <option value="Jute">Jute</option>
                                             <option value="Modal">Modal</option>
                                             <option value="Rayon">Rayon</option>
                                       <?php
                                          }
                                          else if($description_or_type_for_weft_other_fiber=='Recycled Polyester')
                                          {
                                         ?>
                                             <option value="Lyocell">Lyocell</option>
                                             <option value="Viscose">Viscose</option>
                                             <option value="Tencel">Tencel</option>
                                             <option value="Lycra">Lycra</option>
                                             <option value="Linen">Linen</option>
                                             <option value="Bamboo">Bamboo</option>
                                             <option value="Recycled Cotton">Recycled Cotton</option>
                                             <option value="Recycled Polyester" selected>Recycled Polyester</option>
                                             <option value="Jute">Jute</option>
                                             <option value="Modal">Modal</option>
                                             <option value="Rayon">Rayon</option>
                                       <?php
                                          }
                                          else if($description_or_type_for_weft_other_fiber=='Jute')
                                          {
                                         ?>
                                             <option value="Lyocell">Lyocell</option>
                                             <option value="Viscose">Viscose</option>
                                             <option value="Tencel">Tencel</option>
                                             <option value="Lycra">Lycra</option>
                                             <option value="Linen">Linen</option>
                                             <option value="Bamboo">Bamboo</option>
                                             <option value="Recycled Cotton">Recycled Cotton</option>
                                             <option value="Recycled Polyester">Recycled Polyester</option>
                                             <option value="Jute" selected>Jute</option>
                                             <option value="Modal">Modal</option>
                                             <option value="Rayon">Rayon</option>
                                       <?php
                                          }
                                          else if($description_or_type_for_weft_other_fiber=='Modal')
                                          {
                                         ?>
                                             <option value="Lyocell">Lyocell</option>
                                             <option value="Viscose">Viscose</option>
                                             <option value="Tencel">Tencel</option>
                                             <option value="Lycra">Lycra</option>
                                             <option value="Linen">Linen</option>
                                             <option value="Bamboo">Bamboo</option>
                                             <option value="Recycled Cotton">Recycled Cotton</option>
                                             <option value="Recycled Polyester">Recycled Polyester</option>
                                             <option value="Jute">Jute</option>
                                             <option value="Modal" selected>Modal</option>
                                             <option value="Rayon">Rayon</option>
                                       <?php
                                          }
                                          else if($description_or_type_for_weft_other_fiber=='Rayon')
                                          {
                                         ?>
                                             <option value="Lyocell">Lyocell</option>
                                             <option value="Viscose">Viscose</option>
                                             <option value="Tencel">Tencel</option>
                                             <option value="Lycra">Lycra</option>
                                             <option value="Linen">Linen</option>
                                             <option value="Bamboo">Bamboo</option>
                                             <option value="Recycled Cotton">Recycled Cotton</option>
                                             <option value="Recycled Polyester">Recycled Polyester</option>
                                             <option value="Jute">Jute</option>
                                             <option value="Modal" >Modal</option>
                                             <option value="Rayon" selected>Rayon</option>
                                       <?php
                                          }
                                          else
                                          {
                                         ?>
                                             <option value="Lyocell">Lyocell</option>
                                             <option value="Viscose">Viscose</option>
                                             <option value="Tencel">Tencel</option>
                                             <option value="Lycra">Lycra</option>
                                             <option value="Linen">Linen</option>
                                             <option value="Bamboo">Bamboo</option>
                                             <option value="Recycled Cotton">Recycled Cotton</option>
                                             <option value="Recycled Polyester">Recycled Polyester</option>
                                             <option value="Jute">Jute</option>
                                             <option value="Modal">Modal</option>
                                             <option value="Rayon" >Rayon</option>
                                       <?php
                                          }
                                        
                                       ?>
		              
          </select>
                  <input type="hidden" class="form-control" class="form-control" id="test_method_for_weft_other_fiber" name="test_method_for_weft_other_fiber" value="In house test method">
                
           </div>

       

           <div class="col-sm-1 text-center">
                 <input type="text" class="form-control" id="percentage_of_weft_other_fiber_content_value" name="percentage_of_weft_other_fiber_content_value" value="<?php echo $row_for_greige_receiving['percentage_of_weft_other_fiber_content_value']?>" onchange="percentage_of_weft_other_fiber_content_cal()" required>
             
         </div>
            
             
          <div class="col-sm-1 text-center">
               <select  class="form-control" id="percentage_of_weft_other_fiber_content_tolerance_range_math_op" name="percentage_of_weft_other_fiber_content_tolerance_range_math_op" onchange="percentage_of_weft_other_fiber_content_cal()">
                      <option value="">Select Percentage of  other fiber Content Math Operator</option>
                      <?php
                                      $percentage_of_weft_other_fiber_content_tolerance_range_math_op = $row_for_greige_receiving['percentage_of_weft_other_fiber_content_tolerance_range_math_op'];
                                     ?>
                                     <?php 
                                          if($percentage_of_weft_other_fiber_content_tolerance_range_math_op=='+')
                                          {
                                       ?>
                                          <option value="+" selected> +</option>
                                          <option value="-"> -</option>
                                          <option value="±">±</option>
                                      <?php
                                          }
                                          else if($percentage_of_weft_other_fiber_content_tolerance_range_math_op=='-')
                                          {
                                         ?>
                                          <option value="+">+</option>
                                          <option value="-" selected>-</option>
                                          <option value="±">±</option>
                                       <?php
                                          }
                                          else if($percentage_of_weft_other_fiber_content_tolerance_range_math_op=='±')
                                          {
                                         ?>
                                          <option value="+">+</option>
                                          <option value="-" >-</option>
                                          <option value="±" selected>±</option>
                                       <?php
                                          }
                                          else
                                          {
                                         ?>
                                          <option value="+">+</option>
                                          <option value="-">-</option>
                                          <option value="±" >±</option>
                                       <?php
                                          }
                                       ?>
                </select>
              
           </div>
            
                 <!--Add Input/Select Field Here No Dive Only Input/Select/Radio Button/Checkbox/Textarea -->
              
          <div class="col-sm-1" for="tolerance">

            
              <input type="text" class="form-control" id="percentage_of_weft_other_fiber_content_tolerance_value" name="percentage_of_weft_other_fiber_content_tolerance_value" value="<?php echo $row_for_greige_receiving['percentage_of_weft_other_fiber_content_tolerance_value']?>" onchange="percentage_of_weft_other_fiber_content_cal()" required>
          </div>

          <div class="col-sm-1" for="unit">

             %
            <input type="hidden" class="form-control" class="form-control" id="uom_of_percentage_of_weft_other_fiber_content" name="uom_of_percentage_of_weft_other_fiber_content" value="%" >
          </div>

            
          <div class="col-sm-1 text-center" for="min_value">

             <input type="text" class="form-control" id="percentage_of_weft_other_fiber_content_min_value" name="percentage_of_weft_other_fiber_content_min_value" value="<?php echo $row_for_greige_receiving['percentage_of_weft_other_fiber_content_min_value']?>" required>

          </div>
              
          <div class="col-sm-1 text-center">
              
           <input type="text" class="form-control" id="percentage_of_weft_other_fiber_content_max_value" name="percentage_of_weft_other_fiber_content_max_value" value="<?php echo $row_for_greige_receiving['percentage_of_weft_other_fiber_content_max_value']?>" required>

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
		              <option value="">Select Other Fiber in weft</option>
                    <?php
                                      $description_or_type_for_weft_other_fiber_1 = $row_for_greige_receiving['description_or_type_for_weft_other_fiber_1'];
                                 
                                          if($description_or_type_for_weft_other_fiber_1=='Lyocell')
                                          {
                                       ?>
                                             <option value="Lyocell" selected>Lyocell</option>
                                             <option value="Viscose">Viscose</option>
                                             <option value="Tencel">Tencel</option>
                                             <option value="Lycra">Lycra</option>
                                             <option value="Linen">Linen</option>
                                             <option value="Bamboo">Bamboo</option>
                                             <option value="Recycled Cotton">Recycled Cotton</option>
                                             <option value="Recycled Polyester">Recycled Polyester</option>
                                             <option value="Jute">Jute</option>
                                             <option value="Modal">Modal</option>
                                             <option value="Rayon">Rayon</option>
                                      <?php
                                          }
                                          else if($description_or_type_for_weft_other_fiber_1=='Viscose')
                                          {
                                         ?>
                                             <option value="Lyocell">Lyocell</option>
                                             <option value="Viscose" selected>Viscose</option>
                                             <option value="Tencel">Tencel</option>
                                             <option value="Lycra">Lycra</option>
                                             <option value="Linen">Linen</option>
                                             <option value="Bamboo">Bamboo</option>
                                             <option value="Recycled Cotton">Recycled Cotton</option>
                                             <option value="Recycled Polyester">Recycled Polyester</option>
                                             <option value="Jute">Jute</option>
                                             <option value="Modal">Modal</option>
                                             <option value="Rayon">Rayon</option>
                                       <?php
                                          }
                                          else if($description_or_type_for_weft_other_fiber_1=='Tencel')
                                          {
                                         ?>
                                             <option value="Lyocell">Lyocell</option>
                                             <option value="Viscose">Viscose</option>
                                             <option value="Tencel" selected>Tencel</option>
                                             <option value="Lycra">Lycra</option>
                                             <option value="Linen">Linen</option>
                                             <option value="Bamboo">Bamboo</option>
                                             <option value="Recycled Cotton">Recycled Cotton</option>
                                             <option value="Recycled Polyester">Recycled Polyester</option>
                                             <option value="Jute">Jute</option>
                                             <option value="Modal">Modal</option>
                                             <option value="Rayon">Rayon</option>
                                       <?php
                                          }
                                          else if($description_or_type_for_weft_other_fiber_1=='Lycra')
                                          {
                                         ?>
                                             <option value="Lyocell">Lyocell</option>
                                             <option value="Viscose">Viscose</option>
                                             <option value="Tencel">Tencel</option>
                                             <option value="Lycra" selected>Lycra</option>
                                             <option value="Linen">Linen</option>
                                             <option value="Bamboo">Bamboo</option>
                                             <option value="Recycled Cotton">Recycled Cotton</option>
                                             <option value="Recycled Polyester">Recycled Polyester</option>
                                             <option value="Jute">Jute</option>
                                             <option value="Modal">Modal</option>
                                             <option value="Rayon">Rayon</option>
                                       <?php
                                          }
                                          else if($description_or_type_for_weft_other_fiber_1=='Linen')
                                          {
                                         ?>
                                             <option value="Lyocell">Lyocell</option>
                                             <option value="Viscose">Viscose</option>
                                             <option value="Tencel">Tencel</option>
                                             <option value="Lycra">Lycra</option>
                                             <option value="Linen" selected>Linen</option>
                                             <option value="Bamboo">Bamboo</option>
                                             <option value="Recycled Cotton">Recycled Cotton</option>
                                             <option value="Recycled Polyester">Recycled Polyester</option>
                                             <option value="Jute">Jute</option>
                                             <option value="Modal">Modal</option>
                                             <option value="Rayon">Rayon</option>
                                       <?php
                                          }
                                          else if($description_or_type_for_weft_other_fiber_1=='Bamboo')
                                          {
                                         ?>
                                             <option value="Lyocell">Lyocell</option>
                                             <option value="Viscose">Viscose</option>
                                             <option value="Tencel">Tencel</option>
                                             <option value="Lycra">Lycra</option>
                                             <option value="Linen">Linen</option>
                                             <option value="Bamboo" selected>Bamboo</option>
                                             <option value="Recycled Cotton">Recycled Cotton</option>
                                             <option value="Recycled Polyester">Recycled Polyester</option>
                                             <option value="Jute">Jute</option>
                                             <option value="Modal">Modal</option>
                                             <option value="Rayon">Rayon</option>
                                       <?php
                                          }
                                          else if($description_or_type_for_weft_other_fiber_1=='Recycled Cotton')
                                          {
                                         ?>
                                             <option value="Lyocell">Lyocell</option>
                                             <option value="Viscose">Viscose</option>
                                             <option value="Tencel">Tencel</option>
                                             <option value="Lycra">Lycra</option>
                                             <option value="Linen">Linen</option>
                                             <option value="Bamboo">Bamboo</option>
                                             <option value="Recycled Cotton" selected>Recycled Cotton</option>
                                             <option value="Recycled Polyester">Recycled Polyester</option>
                                             <option value="Jute">Jute</option>
                                             <option value="Modal">Modal</option>
                                             <option value="Rayon">Rayon</option>
                                       <?php
                                          }
                                          else if($description_or_type_for_weft_other_fiber_1=='Recycled Polye')
                                          {
                                         ?>
                                             <option value="Lyocell">Lyocell</option>
                                             <option value="Viscose">Viscose</option>
                                             <option value="Tencel">Tencel</option>
                                             <option value="Lycra">Lycra</option>
                                             <option value="Linen">Linen</option>
                                             <option value="Bamboo">Bamboo</option>
                                             <option value="Recycled Cotton">Recycled Cotton</option>
                                             <option value="Recycled Polyester" selected>Recycled Polyester</option>
                                             <option value="Jute">Jute</option>
                                             <option value="Modal">Modal</option>
                                             <option value="Rayon">Rayon</option>
                                       <?php
                                          }
                                          else if($description_or_type_for_weft_other_fiber_1=='Jute')
                                          {
                                         ?>
                                             <option value="Lyocell">Lyocell</option>
                                             <option value="Viscose">Viscose</option>
                                             <option value="Tencel">Tencel</option>
                                             <option value="Lycra">Lycra</option>
                                             <option value="Linen">Linen</option>
                                             <option value="Bamboo">Bamboo</option>
                                             <option value="Recycled Cotton">Recycled Cotton</option>
                                             <option value="Recycled Polyester">Recycled Polyester</option>
                                             <option value="Jute" selected>Jute</option>
                                             <option value="Modal">Modal</option>
                                             <option value="Rayon">Rayon</option>
                                       <?php
                                          }
                                          else if($description_or_type_for_weft_other_fiber_1=='Modal')
                                          {
                                         ?>
                                             <option value="Lyocell">Lyocell</option>
                                             <option value="Viscose">Viscose</option>
                                             <option value="Tencel">Tencel</option>
                                             <option value="Lycra">Lycra</option>
                                             <option value="Linen">Linen</option>
                                             <option value="Bamboo">Bamboo</option>
                                             <option value="Recycled Cotton">Recycled Cotton</option>
                                             <option value="Recycled Polyester">Recycled Polyester</option>
                                             <option value="Jute">Jute</option>
                                             <option value="Modal" selected>Modal</option>
                                             <option value="Rayon">Rayon</option>
                                       <?php
                                          }
                                          else if($description_or_type_for_weft_other_fiber_1=='Rayon')
                                          {
                                         ?>
                                             <option value="Lyocell">Lyocell</option>
                                             <option value="Viscose">Viscose</option>
                                             <option value="Tencel">Tencel</option>
                                             <option value="Lycra">Lycra</option>
                                             <option value="Linen">Linen</option>
                                             <option value="Bamboo">Bamboo</option>
                                             <option value="Recycled Cotton">Recycled Cotton</option>
                                             <option value="Recycled Polyester">Recycled Polyester</option>
                                             <option value="Jute">Jute</option>
                                             <option value="Modal" >Modal</option>
                                             <option value="Rayon" selected>Rayon</option>
                                       <?php
                                          }
                                          else
                                          {
                                         ?>
                                             <option value="Lyocell">Lyocell</option>
                                             <option value="Viscose">Viscose</option>
                                             <option value="Tencel">Tencel</option>
                                             <option value="Lycra">Lycra</option>
                                             <option value="Linen">Linen</option>
                                             <option value="Bamboo">Bamboo</option>
                                             <option value="Recycled Cotton">Recycled Cotton</option>
                                             <option value="Recycled Polyester">Recycled Polyester</option>
                                             <option value="Jute">Jute</option>
                                             <option value="Modal">Modal</option>
                                             <option value="Rayon" >Rayon</option>
                                       <?php
                                          }
                                        
                                       ?>
		              
		          </select>

                  <input type="hidden" class="form-control" class="form-control" id="test_method_for_weft_other_fiber_content_1" name="test_method_for_weft_other_fiber_content_1" value="In house test method">
                
           </div>

       

           <div class="col-sm-1 text-center">
                 <input type="text" class="form-control" id="percentage_of_weft_other_fiber_content_1_value" name="percentage_of_weft_other_fiber_content_1_value" value="<?php echo $row_for_greige_receiving['percentage_of_weft_other_fiber_content_1_value']?>" onchange="percentage_of_weft_other_fiber_content_1_cal()" required>
             
         </div>
            
             
          <div class="col-sm-1 text-center">
               <select  class="form-control" id="percentage_of_weft_other_fiber_content_1_tolerance_range_math_op" name="percentage_of_weft_other_fiber_content_1_tolerance_range_math_op" onchange="percentage_of_weft_other_fiber_content_1_cal()">
                      <option value="">Select Percentage of weft other_fiber Content Math Operator</option>
                      <?php
                                      $percentage_of_weft_other_fiber_content_1_tolerance_range_math_op = $row_for_greige_receiving['percentage_of_weft_other_fiber_content_1_tolerance_range_math_op'];
                                     ?>
                                     <?php 
                                          if($percentage_of_weft_other_fiber_content_1_tolerance_range_math_op=='+')
                                          {
                                       ?>
                                          <option value="+" selected> +</option>
                                          <option value="-"> -</option>
                                          <option value="±">±</option>
                                      <?php
                                          }
                                          else if($percentage_of_weft_other_fiber_content_1_tolerance_range_math_op=='-')
                                          {
                                         ?>
                                          <option value="+">+</option>
                                          <option value="-" selected>-</option>
                                          <option value="±">±</option>
                                       <?php
                                          }
                                          else if($percentage_of_weft_other_fiber_content_1_tolerance_range_math_op=='±')
                                          {
                                         ?>
                                          <option value="+">+</option>
                                          <option value="-" >-</option>
                                          <option value="±" selected>±</option>
                                       <?php
                                          }
                                          else
                                          {
                                         ?>
                                          <option value="+">+</option>
                                          <option value="-">-</option>
                                          <option value="±" >±</option>
                                       <?php
                                          }
                                       ?>
                </select>
              
           </div>
            
                 <!--Add Input/Select Field Here No Dive Only Input/Select/Radio Button/Checkbox/Textarea -->
              
          <div class="col-sm-1" for="tolerance">

             
              <input type="text" class="form-control" id="percentage_of_weft_other_fiber_content_1_tolerance_value" name="percentage_of_weft_other_fiber_content_1_tolerance_value" value="<?php echo $row_for_greige_receiving['percentage_of_weft_other_fiber_content_1_tolerance_value']?>" onchange="percentage_of_weft_other_fiber_content_1_cal()" required>
          </div>

          <div class="col-sm-1" for="unit">

             %
            <input type="hidden" class="form-control" class="form-control" id="uom_of_percentage_of_weft_other_fiber_content_1" name="uom_of_percentage_of_weft_other_fiber_content_1" value="%" >
          </div>

            
          <div class="col-sm-1 text-center" for="min_value">

             <input type="text" class="form-control" id="percentage_of_weft_other_fiber_content_1_min_value" name="percentage_of_weft_other_fiber_content_1_min_value" value="<?php echo $row_for_greige_receiving['percentage_of_weft_other_fiber_content_1_min_value']?>" required>

          </div>
              
          <div class="col-sm-1 text-center">
              
           <input type="text" class="form-control" id="percentage_of_weft_other_fiber_content_1_max_value" name="percentage_of_weft_other_fiber_content_1_max_value" value="<?php echo $row_for_greige_receiving['percentage_of_weft_other_fiber_content_1_max_value']?>" required>

         </div>
                
       
     </div><!-- End of <div class="form-group form-group-sm" percentage_of_weft_other_fiber_content_1_max_value-->
 </div>   <!-- <div class="form-group form-group-sm" id="div_fiber_content" style="display: none"> -->


 <div class="form-group form-group-sm">
								<div class="col-sm-offset-3 col-sm-5">
									<button type="button" class="btn btn-primary" onClick="sending_data_of_defining_qc_standard_for_greige_receiving_process_form_for_saving_in_database()">Save</button>
									<button type="reset" class="btn btn-success">Reset</button>
								</div>
						</div>


</div>   <!-- End of <div class="full_page_load" id="full_page_load" style="display :none"> -->





						

				</form>

		</div> <!-- End of <div class="panel panel-default"> -->

   </div> <!-- End of <div class="col-sm-12 col-md-12 col-lg-12"> -->

