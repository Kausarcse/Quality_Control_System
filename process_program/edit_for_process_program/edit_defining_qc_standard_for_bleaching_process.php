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
$bleaching_process_id=$_GET['bleaching_id'];
$sql_for_bleaching_process="select * from defining_qc_standard_for_bleaching_process where `id`='$bleaching_process_id'";
$result_for_bleaching_process= mysqli_query($con,$sql_for_bleaching_process) or die(mysqli_error($con));
$row_for_bleaching_process = mysqli_fetch_array( $result_for_bleaching_process);
?>
<script type='text/javascript' src='process_program/defining_qc_standard_for_bleaching_process_form_validation.js'></script>
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
  document.getElementById('standard_for_which_process').value='Bleaching'; 
  document.getElementById('process_id').value='proc_3'; 

  var value_for_data= 'customer_id='+splitted_version_details[5];

   $.ajax({
			 		url: 'process_program/return_test_name_method.php',
			 		dataType: 'text',
			 		type: 'post',
			 		contentType: 'application/x-www-form-urlencoded',
			 		data: value_for_data,
			 		      
			 		success: function( data, textStatus, jQxhr )
			 		{       
			 			    

                    //alert(data);

                    var split_all_data= data.split('method');
                    var data= split_all_data[0];
                    var test_method_id=split_all_data[1];
                    var test_name_method=split_all_data[2];
                  

                  
                    var test_method_id= test_method_id.split(',');


                    var test_name_method= test_name_method.split(',');

                    var test_method_for_all='';
                    var table_length = 0;


                    $("#checking_data").val(data);

                    var splitted_data= data.split('?fs?');

                   /* if($('#div_cf_to_rubbing') && $('#div_whiteness') )
                    {
                     alert($('#div_cf_to_rubbing').length);
                     alert($('#div_whiteness').length);
                    }
                   */
                   for(var i =0; i<splitted_data.length; i++) {
                    

//For Dimensional Stability To Washing

                     if((splitted_data.includes('2') || splitted_data.includes('116') || splitted_data.includes('160') || splitted_data.includes('175') || splitted_data.includes('188') || splitted_data.includes('202') || splitted_data.includes('231') || splitted_data.includes('245') || splitted_data.includes('264') || splitted_data.includes('276') || splitted_data.includes('284')) && $('#div_dimensional_stability_to_washing').length !== 0) 
                     {
                        
                        test_method_for_all+=test_method_id[i]+',';
                      
                        $(".full_page_load").show();
                        $("#div_dimensional_stability_to_washing").show();


                        $("#for_dimensional_stability_to_warp_washing_before_iron_test_name_label").html(test_name_method[i]);
                        $("#for_dimensional_stability_to_warp_washing_before_iron_test_name_label").hide();
                        table_length++;
                          
                     } 
           
 // For div_yarn_count  

                     if((splitted_data.includes('3') || splitted_data.includes('291')) && $('#div_yarn_count').length !== 0 )  
                     {
                        
                        test_method_for_all+=test_method_id[i]+',';
                    
                        $(".full_page_load").show();
                        $("#div_yarn_count").show();  


                        $("#for_warp_yarn_count_test_name_label").html(test_name_method[i]);
                        $("#warp_yarn_count_test_method").hide(); 
                        table_length++;
                        
                     }  
           
           
// For div_number_of_threads_per_unit_length 

                     if((splitted_data.includes('4') || splitted_data.includes('113')|| splitted_data.includes('122')|| splitted_data.includes('146')|| splitted_data.includes('183')|| splitted_data.includes('213')|| splitted_data.includes('221')|| splitted_data.includes('254')|| splitted_data.includes('283')|| splitted_data.includes('299')) && $('#div_number_of_threads_per_unit_length').length !== 0) 
                     {
                        
                        test_method_for_all+=test_method_id[i]+',';
                      
                        $(".full_page_load").show();
                        $("#div_number_of_threads_per_unit_length").show();

                         $("#for_no_of_threads_in_warp_test_name_label").html(test_name_method[i]);
                        $("#no_of_threads_in_warp_test_method").hide(); 
                        table_length++;
                        
                     }
           
// For Mass Per Unit Area

                     if((splitted_data.includes('5') || splitted_data.includes('114') || splitted_data.includes('123') || splitted_data.includes('134') || splitted_data.includes('147') || splitted_data.includes('199') || splitted_data.includes('300') || splitted_data.includes('229') || splitted_data.includes('301')) && $('#div_mass_per_unit_area').length !== 0) 
                     {
                        
                        test_method_for_all+=test_method_id[i]+',';
                      
                        $(".full_page_load").show();
                        $("#div_mass_per_unit_area").show();
            
             $("#for_mass_per_unit_per_area_test_name_label").html(test_name_method[i]);
                        $("#mass_per_unit_per_area_test_method").hide(); 
                        table_length++;
            
                     }

//For div_tensile_properties

                     if((splitted_data.includes('7') || splitted_data.includes('115') || splitted_data.includes('263') || splitted_data.includes('274') || splitted_data.includes('302')) && $('#div_tensile_properties').length !== 0)  
                     {
                        
                        test_method_for_all+=test_method_id[i]+',';

                   
                        $(".full_page_load").show();
                        $("#div_tensile_properties").show();
            
            $("#for_tensile_properties_in_warp_test_name_label").html(test_name_method[i]);
                        $("#tensile_properties_in_warp_test_method").hide();
                        table_length++;
                        
                     }     
 //For div_tear_force

                      if((splitted_data.includes('8') || splitted_data.includes('135') || splitted_data.includes('148') || splitted_data.includes('201') || splitted_data.includes('275') || splitted_data.includes('303')) && $('#div_tear_force').length !== 0) 
                     {
                        
                        
                        test_method_for_all+=test_method_id[i]+',';
                        
                        $(".full_page_load").show();
                        $("#div_tear_force").show();
            
            $("#for_tear_force_in_warp_test_name_label").html(test_name_method[i]);
                        $("#tear_force_in_warp_test_method").hide();
                        table_length++;
                        
                        
                     }     
// For div_seam_slippage

                     if((splitted_data.includes('9') || splitted_data.includes('186') || splitted_data.includes('230')) && $('#div_seam_slippage').length !== 0)
                     {
                        
                        test_method_for_all+=test_method_id[i]+',';
                       
                        $(".full_page_load").show();
                        $("#div_seam_slippage").show();
            
            $("#for_seam_slippage_resistance_in_warp_test_name_label ").html(test_name_method[i]);
                        $("#seam_slippage_resistance_in_warp_test_method").hide();
                        table_length++;
                        
                     }
 // for   div_bowing_and_skew
                     if(splitted_data.includes('10') && $('#div_bowing_and_skew').length !== 0)
                     {
                        test_method_for_all+=test_method_id[i]+',';
                       
                        $(".full_page_load").show();
                        $("#div_bowing_and_skew").show(); 
                        table_length++;

                     }
           
// For div_seam_strength
                     if((splitted_data.includes('11') || splitted_data.includes('149') || splitted_data.includes('187') || splitted_data.includes('244') || splitted_data.includes('304')) && $('#div_seam_strength').length !== 0)
                     {
                        test_method_for_all+=test_method_id[i]+',';
                        
                        $(".full_page_load").show();
                        $("#div_seam_strength").show();
            
             $("#for_seam_strength_in_warp_test_name_label").html(test_name_method[i]);
                        $("#seam_strength_in_warp_test_method").hide();
                           table_length++;

                     }
           
//div_seam_properties

                     if(splitted_data.includes('12') && $('#div_seam_properties').length !== 0)
                     {
                        test_method_for_all+=test_method_id[i]+',';
                      
                        $(".full_page_load").show();
                        $("#div_seam_properties").show();
                        table_length++;

                     }
//mass loss in abrasion
                     if(splitted_data.includes('13') && $('#div_mass_loss_in_abrasion').length !== 0)
                     {
                        test_method_for_all+=test_method_id[i]+',';
                        
                        $(".full_page_load").show();
                        $("#div_mass_loss_in_abrasion").show();
                        table_length++;
  
                     }
//For  abrasion div_abrasion_resistance
                     if((splitted_data.includes('13') || splitted_data.includes('138') || splitted_data.includes('173')) && $('#div_abrasion_resistance').length !== 0)
                     {
                        test_method_for_all+=test_method_id[i]+',';
                        
                        $(".full_page_load").show();
                        $("#div_abrasion_resistance").show();
            
             $("#for_abrasion_resistance_no_of_thread_break_test_name_label").html(test_name_method[i]);
                         $("#abrasion_resistance_no_of_thread_break_test_method").hide();
                         table_length++;
  
                     }  
// For div_color_fastness_to_washing

                     if((splitted_data.includes('15') ||splitted_data.includes('59')||splitted_data.includes('119')||splitted_data.includes('128')||splitted_data.includes('155')||splitted_data.includes('165')||splitted_data.includes('223')||splitted_data.includes('227')||splitted_data.includes('177')||splitted_data.includes('292'))  && $('#div_color_fastness_to_washing').length !== 0)
                     {
                        test_method_for_all+=test_method_id[i]+',';
                      
                        $(".full_page_load").show();
                        $("#div_color_fastness_to_washing").show();
            
             $("#for_cf_to_washing_color_change_test_name_label").html(test_name_method[i]);
                         $("#cf_to_washing_color_change_test_method").hide();
                         table_length++;
                     }
           
// For  div_cf_to_dry_cleaning
                     if((splitted_data.includes('16') || splitted_data.includes('145')) && $('#div_cf_to_dry_cleaning').length !== 0)
                     {
                        test_method_for_all+=test_method_id[i]+',';
                       
                        $(".full_page_load").show();
                        $("#div_cf_to_dry_cleaning").show();
            
            $("#for_cf_to_dry_cleaning_color_change_test_name_label").html(test_name_method[i]);
                        $("#cf_to_washing_color_change_test_method").hide();
                        table_length++;

                     }

//----------------------------------------------------Only div -----------------------------------------------------------------------------------

 // div_cf_to_perspiration_acid 17,61,
                     if((splitted_data.includes('17') || splitted_data.includes('61')) && $('#div_cf_to_perspiration_acid').length !== 0)
                     {
                        test_method_for_all+=test_method_id[i]+',';
                       
                        $(".full_page_load").show();
                        $("#div_cf_to_perspiration_acid").show();
            
            $("#for_perspiration_acid_color_change_test_name_label").html(test_name_method[i]);
                        $("#perspiration_acid_color_change_test_method").hide();
                        table_length++;

                     }
           
// div_cf_to_perspiration_alkali  id> 120,62,18,129,194,269

                     if((splitted_data.includes('18') || splitted_data.includes('120') || splitted_data.includes('62') || splitted_data.includes('18') || splitted_data.includes('129') || splitted_data.includes('194') || splitted_data.includes('269')) && $('#div_cf_to_perspiration_alkali').length !== 0)
                     {
                        test_method_for_all+=test_method_id[i]+',';
                  
                        $(".full_page_load").show();
                        $("#div_cf_to_perspiration_alkali").show();
            
            $("#for_cf_to_perspiration_alkali_color_change_test_name_label").html(test_name_method[i]);
                        $("#cf_to_perspiration_alkali_color_change_test_method").hide();
                        table_length++;

                     }
           
           
// for div_color_fastness_to_water 121,141,167,228

                     if((splitted_data.includes('19') || splitted_data.includes('121') || splitted_data.includes('141') || splitted_data.includes('167') || splitted_data.includes('228')) && $('#div_color_fastness_to_water').length !== 0)
                     {
                        test_method_for_all+=test_method_id[i]+',';
                       
                        $(".full_page_load").show();
                        $("#div_color_fastness_to_water").show();
            
            $("#for_cf_to_water_color_change_test_name_label").html(test_name_method[i]);
                        $("#cf_to_water_color_change_test_method").hide();
                        table_length++;

                     }

// for div_color_fastness_to_water_spotting  20,65,196
                     if((splitted_data.includes('20') || splitted_data.includes('65') || splitted_data.includes('196')) && $('#div_color_fastness_to_water_spotting').length !== 0)
                     {
                        test_method_for_all+=test_method_id[i]+',';
                       
                        $(".full_page_load").show();
                        $("#div_color_fastness_to_water_spotting").show();
            
            $("#for_cf_to_water_spotting_surface_test_name_label").html(test_name_method[i]);
                        $("#cf_to_water_spotting_surface_test_method").hide();
                        table_length++;


                     }
           
           
//for   div_resistance_to_surface_wetting  206,21,22,66      
            if((splitted_data.includes('21') || splitted_data.includes('206') || splitted_data.includes('22') || splitted_data.includes('66')) && $('#div_resistance_to_surface_wetting').length !== 0)
                     {
                        test_method_for_all+=test_method_id[i]+',';
                        
                        $(".full_page_load").show();
                        $("#div_resistance_to_surface_wetting").show();
            
            $("#for_resistance_to_surface_wetting_before_wash_test_name_label").html(test_name_method[i]);
                        $("#resistance_to_surface_wetting_before_wash_test_method").hide();
                        table_length++;

                     }
           
//for div_cf_to_hydrolysis_of_reactive_dyes  23,67
              if((splitted_data.includes('23') || splitted_data.includes('67')) && $('#div_cf_to_hydrolysis_of_reactive_dyes').length !== 0)
                     {
                        test_method_for_all+=test_method_id[i]+',';
                      
                        $(".full_page_load").show();
                        $("#div_cf_to_hydrolysis_of_reactive_dyes").show();
            
            $("#for_cf_to_hydrolysis_of_reactive_dyes_color_change_test_name_label").html(test_name_method[i]);
                        $("#cf_to_hydrolysis_of_reactive_dyes_color_change_test_method").hide();
                        table_length++;

                     }

// for div_cf_to_oxidative_bleach_damage 24,68
                     if((splitted_data.includes('24')|| splitted_data.includes('68')) && $('#div_cf_to_oxidative_bleach_damage').length !== 0)
                     {
                        test_method_for_all+=test_method_id[i]+',';
                        
                        $(".full_page_load").show();
                        $("#div_cf_to_oxidative_bleach_damage").show();
            
            $("#for_cf_to_oxidative_bleach_damage_color_change_test_name_label").html(test_name_method[i]);
                        $("#cf_to_oxidative_bleach_damage_color_change").hide();
                        table_length++;

                     }
// for div_cf_to_phenolic_yellowing 158,25,69
                     if((splitted_data.includes('25') || splitted_data.includes('158') || splitted_data.includes('69')) && $('#div_cf_to_phenolic_yellowing').length !== 0)
                     {
                        test_method_for_all+=test_method_id[i]+',';
                        
                        $(".full_page_load").show();
                        $("#div_cf_to_phenolic_yellowing").show();
            
            $("#for_cf_to_phenolic_yellowing_staining_test_name_label").html(test_name_method[i]);
                        $("#cf_to_phenolic_yellowing_staining_test_method").hide();
                        table_length++;

                     }
//for div_migration_of_color_into_pvc 132,169,143,26,70,195,211,
                     if((splitted_data.includes('26') || splitted_data.includes('132') || splitted_data.includes('169') || splitted_data.includes('143') || splitted_data.includes('26') || splitted_data.includes('70') || splitted_data.includes('195') || splitted_data.includes('211')) && $('#div_migration_of_color_into_pvc').length !== 0)
                     {
                        test_method_for_all+=test_method_id[i]+',';
                       
                        $(".full_page_load").show();
                        $("#div_migration_of_color_into_pvc").show();
            
            $("#for_cf_to_pvc_migration_staining_test_name_label").html(test_name_method[i]);
                        $("#cf_to_pvc_migration_staining_test_method").hide();
                        table_length++;

                     }
           
//for div_cf_to_saliva 27,71,168,156,
                     if((splitted_data.includes('27') || splitted_data.includes('71') || splitted_data.includes('168') || splitted_data.includes('156')) && $('#div_cf_to_saliva').length !== 0)
                     {
                        test_method_for_all+=test_method_id[i]+',';
                     
                        $(".full_page_load").show();
                        $("#div_cf_to_saliva").show();
            
            $("#for_cf_to_saliva_color_change_test_name_label").html(test_name_method[i]);
                        $("#cf_to_saliva_color_change_test_method").hide();
                        table_length++;

                     }
//for div_cf_to_chlorinated_water 210,224,28,72,142
                     if((splitted_data.includes('28') || splitted_data.includes('210') || splitted_data.includes('224') || splitted_data.includes('72') || splitted_data.includes('142') ) && $('#div_cf_to_chlorinated_water').length !== 0)
                     {
                        test_method_for_all+=test_method_id[i]+',';
                       
                        $(".full_page_load").show();
                        $("#div_cf_to_chlorinated_water").show();
            
            $("#for_cf_to_chlorinated_water_color_change_test_name_label").html(test_name_method[i]);
                        $("#cf_to_chlorinated_water_color_change_test_method").hide();
                        table_length++;
            
                     }
//for div_cf_to_chlorine_bleach 241,29,73,285
                     if((splitted_data.includes('29') || splitted_data.includes('241') || splitted_data.includes('73') || splitted_data.includes('285')) && $('#div_cf_to_chlorine_bleach').length !== 0)
                     {
                        test_method_for_all+=test_method_id[i]+',';
                     
                        $(".full_page_load").show();
                        $("#div_cf_to_chlorine_bleach").show();
            
            $("#for_cf_to_cholorine_bleach_color_change_test_name_label").html(test_name_method[i]);
                        $("#cf_to_cholorine_bleach_color_change_test_method").hide();
                        table_length++;

                     }
//30,75
                      if((splitted_data.includes('30') || splitted_data.includes('75')) && $('#div_cf_to_peroxide_bleach').length !== 0)
                     {
                        test_method_for_all+=test_method_id[i]+',';
                       
                        $(".full_page_load").show();
                        $("#div_cf_to_peroxide_bleach").show();
            
            $("#for_cf_to_peroxide_bleach_color_change_test_name_label").html(test_name_method[i]);
                        $("#cf_to_peroxide_bleach_color_change_test_method").hide();
                        table_length++;

                     }
//31,76
                     if((splitted_data.includes('31') || splitted_data.includes('76')) && $('#div_cross_staining').length !== 0)
                     {
                        test_method_for_all+=test_method_id[i]+',';
                        
                        $(".full_page_load").show();
                        $("#div_cross_staining").show();
            
            $("#for_cross_staining_test_name_label").html(test_name_method[i]);
                        $("#cross_staining_test_method").hide();
                        table_length++;

                     }
//for div_formaldehyde_content 118,170,32,77,235,258
                      if((splitted_data.includes('32') || splitted_data.includes('118') || splitted_data.includes('170') || splitted_data.includes('77') || splitted_data.includes('235') || splitted_data.includes('258')) && $('#div_formaldehyde_content').length !== 0)
                     {
                        test_method_for_all+=test_method_id[i]+',';
                        
                        $(".full_page_load").show();
                        $("#div_formaldehyde_content").show();
            
            $("#for_formaldehyde_content_test_name_label").html(test_name_method[i]);
                        $("#formaldehyde_content_test_method").hide();
                        table_length++;

                     }


// for div 109,33,78,237,170
                     if((splitted_data.includes('33') || splitted_data.includes('109') || splitted_data.includes('78') || splitted_data.includes('237') || splitted_data.includes('170')) && $('#div_ph').length !== 0)
                     {
                        test_method_for_all+=test_method_id[i]+',';
                        $(".full_page_load").show();
                        $("#div_ph").show();
            
                       $("#for_ph_test_name_label").html(test_name_method[i]);
                        $("#ph_test_method").hide();
                        table_length++;
                     }
//191,34,89
                      if((splitted_data.includes('34') || splitted_data.includes('191') || splitted_data.includes('89')) && $('#div_water_absorption').length !== 0)
                     {
                        test_method_for_all+=test_method_id[i]+',';
                        
                        $(".full_page_load").show();
                        $("#div_water_absorption").show();
            
                       $("#for_water_absorption_test_name_label").html(test_name_method[i]);
                        $("#water_absorption_test_method").hide();
                        table_length++;
                     }
//35,80
                     if((splitted_data.includes('35') || splitted_data.includes('80')) && $('#div_wicking_test').length !== 0)
                     {
                        test_method_for_all+=test_method_id[i]+',';
                      
                        $(".full_page_load").show();
                        $("#div_wicking_test").show();
            
                         $("#for_wicking_test_test_name_label").html(test_name_method[i]);
                        $("#for_wicking_test_test_method").hide();
                        table_length++;
                     }
//190,36,81,163,214
                     if((splitted_data.includes('36') || splitted_data.includes('190') || splitted_data.includes('81') || splitted_data.includes('163') || splitted_data.includes('214')) && $('#div_spirality').length !== 0)
                     {
                        test_method_for_all+=test_method_id[i]+',';
                       
                        $(".full_page_load").show();
                        $("#div_spirality").show();
            
                          $("#for_spirality_test_name_label").html(test_name_method[i]);
                        $("#spirality_test_method").hide();
                        table_length++;
                     }
//236,282,82,37,267;
                     if((splitted_data.includes('37') || splitted_data.includes('282')|| splitted_data.includes('82')|| splitted_data.includes('37')|| splitted_data.includes('267')) && $('#div_smoothness_appearance').length !== 0)
                     {
                        test_method_for_all+=test_method_id[i]+',';
                       
                        $(".full_page_load").show();
                        $("#div_smoothness_appearance").show();
            
            $("#for_smoothness_appearance_test_name_label").html(test_name_method[i]);
                        $("#smoothness_appearance_test_method").hide();
                        table_length++;
                     }
//234,38,83
                     if((splitted_data.includes('38') || splitted_data.includes('234') || splitted_data.includes('83')) && $('#div_print_durability').length !== 0)
                     {
                        test_method_for_all+=test_method_id[i]+',';
                       
                        $(".full_page_load").show();
                        $("#div_print_durability").show();
            
            $("#for_print_durability_test_name_label").html(test_name_method[i]);
                        $("#print_durability_test_method").hide();
                        table_length++;
                     }

// 39,84,233
                     if((splitted_data.includes('39') || splitted_data.includes('84') || splitted_data.includes('233')) && $('#div_iron_ability_of_woven_fabric').length !== 0)
                     {
                        test_method_for_all+=test_method_id[i]+',';
                        
                        $(".full_page_load").show();
                        $("#div_iron_ability_of_woven_fabric").show();
            
                        $("#for_iron_ability_of_woven_fabric_test_name_label").html(test_name_method[i]);
                        $("#iron_ability_of_woven_fabric_test_method").hide();
                        table_length++;
                     }
// 159,133,40,86,182,238,297,220,273,172,198,174,270,243,111
                      if((splitted_data.includes('40') || splitted_data.includes('159') || splitted_data.includes('133') || splitted_data.includes('86') || splitted_data.includes('182') || splitted_data.includes('238')  || splitted_data.includes('297') || splitted_data.includes('220') || splitted_data.includes('172') || splitted_data.includes('198')|| splitted_data.includes('174')|| splitted_data.includes('270')|| splitted_data.includes('243')|| splitted_data.includes('111')) && $('#div_cf_to_artificial_day_light').length !== 0)
                     {
                        test_method_for_all+=test_method_id[i]+',';
                       
                        $(".full_page_load").show();
                        $("#div_cf_to_artificial_day_light").show();
            
            $("#for_cf_to_artificial_day_light_test_name_label").html(test_name_method[i]);
                        $("#cf_to_artificial_day_light_test_method").hide();
                        table_length++;
                     }
//41,87
                      if((splitted_data.includes('41') || splitted_data.includes('87'))&& $('#div_moisture_content').length !== 0)
                     {
                        test_method_for_all+=test_method_id[i]+',';
                        
                        $(".full_page_load").show();
                        $("#div_moisture_content").show();
            
			            $("#for_moisture_content_test_name_label").html(test_name_method[i]);
			            table_length++;
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
                        table_length++;
                     }
//225,296,110,180,43,89
                     if((splitted_data.includes('43') || splitted_data.includes('225') || splitted_data.includes('296') || splitted_data.includes('110') || splitted_data.includes('180') || splitted_data.includes('89') ) && $('#div_fiber_content').length !== 0)
                     {
                        test_method_for_all+=test_method_id[i]+',';
                        
                        $(".full_page_load").show();
                        $("#div_fiber_content").show();
            
                       $("#for_total_cotton_content_test_name_label").html(test_name_method[i]);
                        $("#total_cotton_content_test_method").hide();table_length++;
                     }
//44,90
                     if((splitted_data.includes('44') || splitted_data.includes('90')) && $('#div_greige_width').length !== 0)
                     {
                        test_method_for_all+=test_method_id[i]+',';
                        
                        $(".full_page_load").show();
                        $("#div_greige_width").show();
                        table_length++;
            
                     }
//45,91
                     if((splitted_data.includes('45') || splitted_data.includes('91')) && $('#div_flame_intensity').length !== 0)
                     {
                        test_method_for_all+=test_method_id[i]+',';
                       
                        $(".full_page_load").show();
                        $("#div_flame_intensity").show();
                        table_length++;
            
            

                     }
//46,92          
                if((splitted_data.includes('46') || splitted_data.includes('92')) && $('#div_machine_speed').length !== 0)
                     {
                        test_method_for_all+=test_method_id[i]+',';
                        
                        $(".full_page_load").show();
                        $("#div_machine_speed").show();
            
                        table_length++;

                     }
//47,93          
               if((splitted_data.includes('47') || splitted_data.includes('93'))&& $('#div_bath_temparature').length !== 0)
                     {
                        test_method_for_all+=test_method_id[i]+',';
                        
                        $(".full_page_load").show();
                        $("#div_bath_temparature").show();
                        table_length++;
            
            
                     }
//48,94
               if((splitted_data.includes('48') || splitted_data.includes('94')) && $('#div_bath_ph').length !== 0)
                     {
                        test_method_for_all+=test_method_id[i]+',';
                        
                        $(".full_page_load").show();
                        $("#div_bath_ph").show();
                        table_length++;
            
            
                     }
//49,95 Whiteness- Berger
                     if((splitted_data.includes('49') || splitted_data.includes('95')) && $('#div_whiteness').length !== 0)  //whiteness
                     {
                        
                        test_method_for_all+=test_method_id[i]+',';
                        $(".full_page_load").show();
                        $("#div_whiteness").show();
                        table_length++;
                        //$('#row_num').val();
            
            
                        
                     }
//50,97
                     if((splitted_data.includes('50')|| splitted_data.includes('97')) && $('#div_residual_sizing_material').length !== 0) //residual_sizing_material_test_method
                     {
                        
                        test_method_for_all+=test_method_id[i]+',';
                        

                        $(".full_page_load").show();
                        $("#div_residual_sizing_material").show();
                           table_length++;
          
                        
                        
                     }
//51,98
                     if((splitted_data.includes('51') || splitted_data.includes('98'))  && $('#div_absorbency_test_method').length !== 0)  // div_absorbency_test_method
                     {
                     
                        test_method_for_all+=test_method_id[i]+',';
                        

                        $(".full_page_load").show();
                        $("#div_absorbency_test_method").show();
                        table_length++;

                        
                     }

//52,99
                     if((splitted_data.includes('52') || splitted_data.includes('99')) && $('#div_rubbing_dry').length !== 0)
                     {
                        test_method_for_all+=test_method_id[i]+',';
                        

                        $(".full_page_load").show();
                        $("#div_rubbing_dry").show();
                        table_length++;
            
            

                     }
// 53, 100
                if((splitted_data.includes('53') || splitted_data.includes('100')) && $('#div_rubbing_wet').length !== 0)
                     {
                        test_method_for_all+=test_method_id[i]+',';
                       
                        
                        $(".full_page_load").show();
                        $("#div_rubbing_wet").show();
                        table_length++;
          
                     }



                   }   /*End of  for(var i =0; i<splitted_data.length; i++)*/


                   
                     $("#test_method_id").val(test_method_for_all);

                 

                    var rows = '<table><thead><tr><th>PP</th><th>Test Name</th><th>Max</th> </tr>';
				for( var i = 1; i <= 10; i++ )
					{
						rows += '<tr id = "row' + row_num + '"><td><input type="text" name="pp_'+ pp_number +'" id="pp_'+ pp_number +'" value="'+pp_number+'"/>  <td><input type="hidden" name="test_'+ row_num +'" id="test_'+ row_num +'" value=""/></td> <td><input type="hidden" name="max_'+ row_num +'" id="max_'+ row_num +'" /></td></tr>';
					}
					document.getElementById( 'table' ).innerHTML = rows;
           

							
			 		},
			 		error: function( jqXhr, textStatus, errorThrown )
			 		{       
			 				
			 				alert(errorThrown);
			 		}
			}); // End of $.ajax({
}/* End of function fill_up_qc_standard_additional_info(version_details)*/

function fill_all_value_for_table(row_num)
{ 
	$("#pp_"+row_num).val();


}




 function sending_data_of_defining_qc_standard_for_bleaching_process_form_for_saving_in_database()
 {


       var validate = Bleaching_Form_Validation();
       var url_encoded_form_data = $("#defining_qc_standard_for_bleaching_process_form").serialize(); //This will read all control elements value of the form	

       if(validate != false)
	   {


		  	 $.ajax({
			 		url: 'process_program/edit_defining_qc_standard_for_bleaching_process_form_saving.php',
			 		dataType: 'text',
			 		type: 'post',
			 		contentType: 'application/x-www-form-urlencoded',
			 		data: url_encoded_form_data,
			 		success: function( data, textStatus, jQxhr )
			 		{
			 				alert(data);
			 				/*$("#defining_qc_standard_for_bleaching_process_form_new").load("process_program/view_qc_standard_for_bleaching_process.php");*/
			 				
			 		},
			 		error: function( jqXhr, textStatus, errorThrown )
			 		{
			 				//console.log( errorThrown );
			 				alert(errorThrown);
			 		}
			 }); // End of $.ajax({

       }//End of if(validate != false)

 }//End of function sending_data_of_defining_qc_standard_for_bleaching_process_form_for_saving_in_database()


 function delete_bleaching_process(bleaching_id)
{
    var value_for_data= 'bleaching_id='+bleaching_id;
    
/*    $('#version_number').html='<option>This is test </option>';
*/  /*document.getElementById('version_number').innerHTML='<option> option 1</option> <option> option 2</option> ';*/
            $.ajax({
                    url: 'process_program/deleting_bleaching_standard.php',
                    dataType: 'text',
                    type: 'post',
                    contentType: 'application/x-www-form-urlencoded',
                    data: value_for_data,
                          
                    success: function( data, textStatus, jQxhr )
                    {       
                            
                           alert(data);
                           alert(location.pathname);
                           if(data=='Bleaching Standard is successfully Deleted.')
                           {


                            success_alert(data,"process_program/defining_qc_standard_for_bleaching_process.php","Success!");

                            /* $('#for_full_form').load(document.URL + ' #for_full_form');*/
                             /*$('#for_full_form').load('process_program/quickly_defining_qc_standard_for_individual_process.php');*/
                           }
                           
                            
                    },
                    error: function( jqXhr, textStatus, errorThrown )
                    {       
                            //console.log( errorThrown );
                            alert(errorThrown);
                    }
            }); // End of $.ajax({
}   /*End of function Fill_Value_Of_Version_Number_Field(bleaching_id)*/


</script>
<div class="for_full_form"> 

<div class="col-sm-12 col-md-12 col-lg-12 full">

		<div class="panel panel-default"> <!-- This div will create a block/panel for FORM -->

				<div class="panel-heading" style="color:#191970;"><b> Defining Qc Standard For Bleaching Process / Edit </b></div> <!-- This will create a upper block for FORM (Just Beautification) -->

                     

                      <div class="row" data-toggle="collapse" data-target="#search_form_collpapsible_div_1" onClick="change_up_down_arrow_icon_1(this.childNodes[5].childNodes[1].id)">
                         

                     	 <div align="right" style="padding-right:13px;" id='test'> <i class="glyphicon glyphicon-chevron-up text-right"  id='panel_heading_icon_1'></i>
	                    </div>


	                  </div>   <!-- End of <div class="row" data-toggle="collapse" data-target="#search_form_collpapsible_div" > -->

                      <div id='search_form_collpapsible_div_1' class="collapse in"> <!-- For Making Collapsible Section -->

                      	   

					    <form class="form-horizontal" action="" style="margin-top:10px;" name="defining_qc_standard_for_bleaching_process_form_view" id="defining_qc_standard_for_bleaching_process_form_view" data-toggle="collapse" data-target="#search_form_collpapsible_div">

							  <div class="panel-heading" style="color:#191970;"><b> Bleaching Standard Process List</b></div> <!-- This will create a upper block for FORM (Just Beautification) -->

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
							                            $standard_for_which_process='Bleaching';
							                            $sql_for_bleaching = "SELECT * FROM `defining_qc_standard_for_bleaching_process` WHERE `standard_for_which_process`='$standard_for_which_process' ORDER BY id ASC";

							                            $res_for_bleaching = mysqli_query($con, $sql_for_bleaching);

							                            while ($row = mysqli_fetch_assoc($res_for_bleaching)) 
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
							                      
							                        
							                        <!-- <button type="submit" id="edit_bleaching" name="edit_bleaching"  class="btn btn-primary btn-xs" onclick="load_page('settings/edit_bleaching.php?bleaching_id=<?php echo $row['id'] ?>')"> Edit </button>
							                       <span>  </span> -->
							                         <?php
                                                        $id=$row['id'];
                                                     ?>
							                         <button type="submit" id="edit_bleaching" name="edit_bleaching"  class="btn btn-primary btn-xs" onclick="load_page('process_program/edit_defining_qc_standard_for_bleaching_process.php?bleaching_id=<?php echo $id; ?>')"> Edit </button>
							                         <button type="submit" id="delete_bleaching" name="delete_bleaching"  class="btn btn-danger btn-xs" onclick="delete_bleaching_process(<?php echo $id;?>)" > Delete </button>
                                                     <!-- 
                                                     <button type="submit" id="delete_bleaching" name="delete_bleaching"  class="btn btn-danger btn-xs" onclick="delete_bleaching_process(<? $row['id']?>)" onclick="load_page('process_program/deleting_bleaching_standard.php?bleaching_id=<?php echo $row['id'] ?>')"> Delete </button> -->
							                 </td>
							                <?php
							                              
							                $s1++;
							                                 }
							                 ?> 
							             </tr>
							          </tbody>
							         </table>

					          </div>

						</form>    <!-- End of <form class="form-horizontal" action="" style="margin-top:10px;" name="defining_qc_standard_for_bleaching_process_form" id="defining_qc_standard_for_bleaching_process_form"> -->

				     </div>




				<form class="form-horizontal" action="" style="margin-top:10px;" name="defining_qc_standard_for_bleaching_process_form" id="defining_qc_standard_for_bleaching_process_form">

                        <input type="hidden" id="pp_number" name="pp_number" value="<?php echo $row_for_bleaching_process['pp_number']?>">
                        <input type="hidden" id="version_number" name="version_number" value="<?php echo $row_for_bleaching_process['version_number']?>" >
                        <input type="hidden" id="customer_name" name="customer_name" value="<?php echo $row_for_bleaching_process['customer_name']?>">
                        <input type="hidden" id="customer_id" name="customer_id" value="<?php echo $row_for_bleaching_process['customer_id']?>">
                        <input type="hidden" id="color" name="color" value="<?php echo $row_for_bleaching_process['color']?>" >
                        <input type="hidden" id="finish_width_in_inch" name="finish_width_in_inch"  value="<?php echo $row_for_bleaching_process['finish_width_in_inch']?>">
                        <input type="hidden" id="standard_for_which_process" name="standard_for_which_process"  value="<?php echo $row_for_bleaching_process['standard_for_which_process']?>">
                        <input type="hidden" id="process_id" name="process_id"  value="proc_1">
                        <input type="hidden" id="test_method_id" name="test_method_id"  value="">
                        

                        <input type="hidden" id="checking_data" name="checking_data"  value="">
						
<!-- *********************************** Designing Tabular Formar (Multi-Column Form Elements Here (Start))*********************************** -->

                     <!-- start     <div class="form-group form-group-sm" id="form-group_for_yarn_count_warp_for_tolarance_value"> -->

<!-- For Full Entry Form -->
<div class="full_page_load" id="full_page_load" >     


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

						

 <!-- Start of whiteness -->

 <div id="div_whiteness" >


		<div class="form-group form-group-sm" >
      

	      <div class="col-sm-3 text-center">
	         <label class="control-label"  style="color:#00008B;"><span id="test_name_for_whiteness">Whiteness-</span> <span id="whiteness_test_method">Berger</span> </label>
	      </div>
	       
	       <div class="col-sm-2 text-center">
	                <!-- <label for="description_or_type" style="font-size:12px; color:#000066;">Direction/Type</label> -->
	                <label class="control-label" for="description_or_type" style="color:#00008B;"> </label>
	                <input type="hidden" class="form-control" id="test_method_for_whiteness" name="test_method_for_whiteness" value="Berger">


	                <input type="hidden" id="test_id_for_whiteness" name="test_id_for_whiteness" >

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

	             (°)
	            <input type="hidden" id="uom_of_whiteness" name="uom_of_whiteness"  value="°">
	          </div>

	            
	          <div class="col-sm-1 text-center" for="min_value">

	            <input type="text" class="form-control" id="whiteness_min_value" name="whiteness_min_value" onblur="fill_all_value_for_table(1)"  value="<?php echo $row_for_bleaching_process['whiteness_min_value']?>" required>

	          </div>
	              
	          <div class="col-sm-1 text-center">
	              
	           <input type="text" class="form-control" id="whiteness_max_value" name="whiteness_max_value" onblur="fill_all_value_for_table(1)" value="<?php echo $row_for_bleaching_process['whiteness_max_value']?>" required>

	         </div>
                
       
     </div><!-- End of <div class="form-group form-group-sm" whiteness_max_value-->
</div>  <!-- End of <div id="div_whiteness" style="display: none"> -->


<!-- Start of residual_sizing_material -->
<div id="div_residual_sizing_material"> 						
     
     <div class="form-group form-group-sm" >
      

		      <div class="col-sm-3 text-center">
		         <label class="control-label"  style="color:#00008B;">Residual Sizing Material <span id="residual_sizing_material_test_method">(Drop test method)</span></label>
		      </div>

	       
		       <div class="col-sm-2 text-center">
		                <!-- <label for="description_or_type" style="font-size:12px; color:#000066;">Direction/Type</label> -->
		                <label class="control-label" for="description_or_type" style="color:#00008B;"> </label>
		                <input type="hidden" class="form-control" id="test_method_for_residual_sizing_material" name="test_method_for_residual_sizing_material" value="Drop test method">
		                

		                <input type="hidden" id="test_id_for_residual_sizing_material" name="test_id_for_residual_sizing_material" value="">
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

	             <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
	            <input type="hidden" name="uom_of_residual_sizing_material" id="uom_of_residual_sizing_material" value="%">
	          </div>

	            
	          <div class="col-sm-1 text-center" for="min_value">

	           <input type="text" class="form-control" id="residual_sizing_material_min_value" name="residual_sizing_material_min_value" onblur="fill_all_value_for_table(2)" value="<?php echo $row_for_bleaching_process['residual_sizing_material_min_value']?>" required>

	          </div>
	              
	          <div class="col-sm-1 text-center">
	              
	           <input type="text" class="form-control" id="residual_sizing_material_max_value" name="residual_sizing_material_max_value" onblur="fill_all_value_for_table(2)" value="<?php echo $row_for_bleaching_process['residual_sizing_material_max_value']?>" required>

	         </div>
                
       
     </div><!-- End of <div class="form-group form-group-sm" bath_residual_sizing_material_max_value-->
                       
</div>  <!-- End of <div id="div_residual_sizing_material" style="display: none"> 	 -->



<!-- Start of absorbency_test_method -->

<div id="div_absorbency_test_method" > 	



	 <div class="form-group form-group-sm" >
      

	      <div class="col-sm-3 text-center">
	         <label class="control-label"  style="color:#00008B;">Absorbency  <span id="absorbency_test_method">(Capillary Method)</span></label>
	      </div>
	       
	       <div class="col-sm-2 text-center">
	                <!-- <label for="description_or_type" style="font-size:12px; color:#000066;">Direction/Type</label> -->
	                <label class="control-label" for="description_or_type" style="color:#00008B;"> At 60 Sec</label>
	                <input type="hidden" class="form-control" id="test_method_for_absorbency" name="test_method_for_absorbency" value="Capillary Method">
	                

	                 <input type="hidden" id="test_id_for_absorbency" name="test_id_for_absorbency" value="">
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

	            mm
	            <input type="hidden" name="uom_of_absorbency" id="uom_of_absorbency" value="mm">
	          </div>

	            
	          <div class="col-sm-1 text-center" for="min_value">

	           <input type="text" class="form-control" id="absorbency_min_value" name="absorbency_min_value" onblur="fill_all_value_for_table(3)" value="<?php echo $row_for_bleaching_process['absorbency_min_value']?>" required>

	          </div>
	              
	          <div class="col-sm-1 text-center">
	              
	           <input type="text" class="form-control" id="absorbency_max_value" name="absorbency_max_value" onblur="fill_all_value_for_table(3)" value="<?php echo $row_for_bleaching_process['absorbency_max_value']?>" required>

	         </div>
	                
       
     </div><!-- End of <div class="form-group form-group-sm" bath_absorbency_max_value-->


</div> <!--  End of <div id="div_absorbency_test_method" style="display: none"> --> 

	
				
<!--  Start of resistance_to_surface_fuzzing_and_pilling -->    

<div id="div_resistance_to_surface_fuzzing_and_pilling"> 

      <div class="form-group form-group-sm" for="surface_fuzzing_and_pilling_value">
          

            <div class="col-sm-3 text-center">
                 <label class="control-label" for="surface_fuzzing_and_pilling_tolerance_range_math_operator" style="color:#00008B;"><span id="for_surface_fuzzing_and_pilling_test_name_label">Resistance to Surface Fuzzing & Pilling</span><span id="surface_fuzzing_and_pilling_test_method">(ISO 12945-2)</span></label>
            </div>
             
             <div class="col-sm-2 text-center">
                 
                  <!-- <label class="control-label" for="description_or_type" style="color:#00008B;">  </label> -->
                  <!-- <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/> -->

                  <select  class="form-control" id="description_or_type_for_surface_fuzzing_and_pilling" name="description_or_type_for_surface_fuzzing_and_pilling" >
                    <option select="selected" value="select">Select Direction/Type Surface Fuzzing and Pilling</option>

                    <?php
                                      $description_or_type_for_surface_fuzzing_and_pilling = $row_for_bleaching_process['description_or_type_for_surface_fuzzing_and_pilling'];
                                     ?>
                                     <?php 
                                          if($description_or_type_for_surface_fuzzing_and_pilling=='Before Wash')
                                          {
                                       ?>
                                          <option value="Before Wash" selected> Before Wash</option>
                                          <option value="After Wash">After Wash</option>
                                      <?php
                                          }
                                          else
                                          {
                                         ?>
                                          <option value="Before Wash" > Before Wash</option>
                                          <option value="After Wash" selected>After Wash</option>
                                       <?php
                                          }
                                       ?>
                    
                 </select>

                   <input type="hidden" class="form-control" id="test_method_for_resistance_to_surface_fuzzing_and_pilling" name="test_method_for_resistance_to_surface_fuzzing_and_pilling" value="ISO 12945-2">
                   <input type="hidden" class="form-control" id="test_id_for_resistance_to_surface_fuzzing_and_pilling" name="test_id_for_resistance_to_surface_fuzzing_and_pilling" value="0">
             </div>

            

             
                 
          <div class="col-sm-1 text-center">
              <select  class="form-control" id="surface_fuzzing_and_pilling_tolerance_range_math_operator" name="surface_fuzzing_and_pilling_tolerance_range_math_operator" onchange="surface_fuzzing_and_pilling_cal()">
                <option select="selected" value="select">Select Surface Fuzzing and Pilling Tolerance Range Math Operator</option>
               
                <?php
                                      $surface_fuzzing_and_pilling_tolerance_range_math_operator = $row_for_bleaching_process['surface_fuzzing_and_pilling_tolerance_range_math_operator'];
                                 
                                          if($surface_fuzzing_and_pilling_tolerance_range_math_operator=='≥')
                                          {
                                       ?>
                                             <option value="≥" selected>≥</option>
                                             <option value="≤"> ≤ </option>
                                             <option value=">"> > </option>
                                             <option value="<"> < </option>
                                      <?php
                                          }
                                          else if($surface_fuzzing_and_pilling_tolerance_range_math_operator=='≤')
                                          {
                                         ?>
                                          <option value="≥">≥</option>
                                          <option value="≤" selected> ≤ </option>
                                          <option value=">"> > </option>
                                          <option value="<"> < </option>
                                       <?php
                                          }
                                          else if($surface_fuzzing_and_pilling_tolerance_range_math_operator=='>')
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

              <select  class="form-control" id="surface_fuzzing_and_pilling_tolerance_value" name="surface_fuzzing_and_pilling_tolerance_value" onchange="surface_fuzzing_and_pilling_cal()">
                    <option select="selected" value="select">Select Surface Fuzzing and Pilling Tolerance Value</option>
                    
                <?php
                                      $surface_fuzzing_and_pilling_tolerance_value = $row_for_bleaching_process['surface_fuzzing_and_pilling_tolerance_value'];
                                     ?>
                                     <?php 
                                          if($surface_fuzzing_and_pilling_tolerance_value=='1.0')
                                          {
                                       ?>
                                            <option value="1.0" selected>1</option>
                                             <option value="1.5">1-2</option>
                                             <option value="2.0"> 2 </option>
                                             <option value="2.5"> 2-3 </option>
                                             <option value="3.0">3</option>
                                             <option value="3.5">3-4</option>
                                             <option value="4.0"> 4 </option>
                                             <option value="4.5"> 4-5 </option>
                                             <option value="5.0"> 5 </option>
                                      <?php
                                          }
                                          else if($surface_fuzzing_and_pilling_tolerance_value=='1.5')
                                          {
                                         ?>
                                         <option value="1.0">1</option>
                                          <option value="1.5" selected>1-2</option>
                                          <option value="2.0"> 2 </option>
                                          <option value="2.5"> 2-3 </option>
                                          <option value="3.0">3</option>
                                          <option value="3.5">3-4</option>
                                          <option value="4.0"> 4 </option>
                                          <option value="4.5"> 4-5 </option>
                                          <option value="5.0"> 5 </option>
                                       <?php
                                          }
                                          else if($surface_fuzzing_and_pilling_tolerance_value=='2.0')
                                          {
                                         ?>
                                             <option value="1.0">1</option>
                                             <option value="1.5">1-2</option>
                                             <option value="2.0" selected> 2 </option>
                                             <option value="2.5"> 2-3 </option>
                                             <option value="3.0">3</option>
                                             <option value="3.5">3-4</option>
                                             <option value="4.0"> 4 </option>
                                             <option value="4.5"> 4-5 </option>
                                             <option value="5.0"> 5 </option>
                                       <?php
                                          }
                                          else if($surface_fuzzing_and_pilling_tolerance_value=='2.5')
                                          {
                                          ?>
                                             <option value="1.0">1</option>
                                             <option value="1.5">1-2</option>
                                             <option value="2.0"> 2 </option>
                                             <option value="2.5" seleted> 2-3 </option>
                                             <option value="3.0">3</option>
                                             <option value="3.5">3-4</option>
                                             <option value="4.0"> 4 </option>
                                             <option value="4.5"> 4-5 </option>
                                             <option value="5.0"> 5 </option>
                                          <?php
                                          }
                                          else if($surface_fuzzing_and_pilling_tolerance_value=='3.0')
                                          {
                                             ?>
                                             <option value="1.0">1</option>
                                             <option value="1.5">1-2</option>
                                             <option value="2.0"> 2 </option>
                                             <option value="2.5"> 2-3 </option>
                                             <option value="3.0" seleted>3</option>
                                             <option value="3.5">3-4</option>
                                             <option value="4.0"> 4 </option>
                                             <option value="4.5"> 4-5 </option>
                                             <option value="5.0"> 5 </option>
                                          <?php
                                          }
                                          else if($surface_fuzzing_and_pilling_tolerance_value=='3.5')
                                          {
                                             ?>
                                             <option value="1.0">1</option>
                                             <option value="1.5">1-2</option>
                                             <option value="2.0"> 2 </option>
                                             <option value="2.5"> 2-3 </option>
                                             <option value="3.0">3</option>
                                             <option value="3.5" selected>3-4</option>
                                             <option value="4.0"> 4 </option>
                                             <option value="4.5"> 4-5 </option>
                                             <option value="5.0"> 5 </option>
                                          <?php
                                          }
                                          else if($surface_fuzzing_and_pilling_tolerance_value=='4.0')
                                          {
                                             ?>
                                             <option value="1.0">1</option>
                                             <option value="1.5">1-2</option>
                                             <option value="2.0"> 2 </option>
                                             <option value="2.5"> 2-3 </option>
                                             <option value="3.0">3</option>
                                             <option value="3.5">3-4</option>
                                             <option value="4.0" selected> 4 </option>
                                             <option value="4.5"> 4-5 </option>
                                             <option value="5.0"> 5 </option>
                                          <?php
                                          }
                                          else if($surface_fuzzing_and_pilling_tolerance_value=='4.5')
                                          {
                                             ?>
                                             <option value="1.0">1</option>
                                             <option value="1.5">1-2</option>
                                             <option value="2.0"> 2 </option>
                                             <option value="2.5"> 2-3 </option>
                                             <option value="3.0">3</option>
                                             <option value="3.5">3-4</option>
                                             <option value="4.0"> 4 </option>
                                             <option value="4.5" seleted> 4-5 </option>
                                             <option value="5.0"> 5 </option>
                                          <?php
                                          }
                                          else 
                                          {
                                             ?>
                                             
                                             <option value="1.0">1</option>
                                             <option value="1.5">1-2</option>
                                             <option value="2.0"> 2 </option>
                                             <option value="2.5"> 2-3 </option>
                                             <option value="3.0">3</option>
                                             <option value="3.5">3-4</option>
                                             <option value="4.0"> 4 </option>
                                             <option value="4.5"> 4-5 </option>
                                             <option value="5.0" selected> 5 </option>

                                             <?php
                                          }
                                       ?>
             </select>

          </div>


          <div class="col-sm-1 text-center">
             <input type="text" class="form-control" id="rubs_for_surface_fuzzing_and_pilling" name="rubs_for_surface_fuzzing_and_pilling" value="<?php echo $row_for_bleaching_process['rubs_for_surface_fuzzing_and_pilling']?>" required>
                 
          </div>
                

          <div class="col-sm-1" for="unit">
            RUBS
             <!-- <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/> -->
          </div>

                
          <div class="col-sm-1 text-center" for="min_value">

            <input type="text" class="form-control" id="surface_fuzzing_and_pilling_min_value" name="surface_fuzzing_and_pilling_min_value" value="<?php echo $row_for_bleaching_process['surface_fuzzing_and_pilling_min_value']?>" required>
          </div>
                  
          <div class="col-sm-1 text-center">
              
            <input type="text" class="form-control" id="surface_fuzzing_and_pilling_max_value" name="surface_fuzzing_and_pilling_max_value" value="<?php echo $row_for_bleaching_process['surface_fuzzing_and_pilling_max_value']?>" required>

           </div>
                    
            <input type="hidden" name="uom_of_resistance_to_surface_fuzzing_and_pilling" id="uom_of_resistance_to_surface_fuzzing_and_pilling" value="meter/min">    

     </div><!-- End of <div class="form-group form-group-sm" surface_fuzzing_and_pilling-->


</div>  <!-- End of <div id="div_resistance_to_surface_fuzzing_and_pilling" style="display: none">  -->





 <!-- For PH Start -->
<div id="div_ph" > 
	<div class="form-group form-group-sm" >
      

	      <div class="col-sm-3 text-center">
	         <label class="control-label"  style="color:#00008B;">pH (Drop test method)<span id="ph_test_method"></span> </label>
	      </div>

	       
	       <div class="col-sm-2 text-center">
	                <!-- <label for="description_or_type" style="font-size:12px; color:#000066;">Direction/Type</label> -->
	                <label class="control-label" for="description_or_type" style="color:#00008B;"> </label>
	                <input type="hidden" class="form-control" id="test_method_for_ph" name="test_method_for_ph" value="Berger">


	                 <input type="hidden" id="test_id_for_ph" name="test_id_for_ph" value="">
	                
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

            <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
            <input type="hidden" name="uom_of_ph" id="uom_of_ph" value="%">
          </div>

	            
          <div class="col-sm-1 text-center" for="min_value">

           <input type="text" class="form-control" id="ph_min_value" name="ph_min_value" onblur="fill_all_value_for_table(5)"value="<?php echo $row_for_bleaching_process['ph_min_value']?>" required>

          </div>
	              
          <div class="col-sm-1 text-center">
              
           <input type="text" class="form-control" id="ph_max_value" name="ph_max_value" onblur="fill_all_value_for_table(5)" value="<?php echo $row_for_bleaching_process['ph_max_value']?>" required>

         </div>
                
       
     </div><!-- End of <div class="form-group form-group-sm" bath_ph_max_value-->

 </div>   <!-- End of <div id="div_ph" style="display: none"> --> 




</div>    <!-- End of <div class="full_page_load" id="full_page_load" style="display: none;"> -->

					

						<div class="form-group form-group-sm">
								<div class="col-sm-offset-3 col-sm-5">
									<button type="button" class="btn btn-primary" onClick="sending_data_of_defining_qc_standard_for_bleaching_process_form_for_saving_in_database()">Submit</button>
									<button type="reset" class="btn btn-success">Reset</button>
		                       </div>
						</div>


						<div id="table"></div>

		</form>



		</div> <!-- End of <div class="panel panel-default"> -->



</div> <!-- End of <div class="col-sm-12 col-md-12 col-lg-12"> -->


</div>  <!-- End of <div class="for_full_form"> -->


