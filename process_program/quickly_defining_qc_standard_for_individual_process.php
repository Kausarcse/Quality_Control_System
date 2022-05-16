<?php

error_reporting(0);
session_start();
include('../login/db_connection_class.php');
$obj = new DB_Connection_Class();
$obj->connection();




$pp_number=$_GET['pp_number'];

if(isset($pp_number))
{
   $split_pp_number=explode('?dataseperator?',$pp_number);
   $pp_with_version=$split_pp_number[0];

   $split_with_version=explode('?vsp?',$pp_with_version);
   $pp_number=$split_with_version[0];
   $version_id=$split_with_version[1];

   $option = '';

   // selected version provide in dom

   $sql = "select * FROM `process_program_info`,`pp_wise_version_creation_info` WHERE `process_program_info`.pp_number=`pp_wise_version_creation_info`.pp_number AND
   `process_program_info`.pp_number='$pp_number' AND `pp_wise_version_creation_info`.version_id = '$version_id' ";

   $result= mysqli_query($con,$sql) or die(mysqli_error($con));

   $row = mysqli_fetch_array( $result);
      
   $customer=$row['customer_name'];
   $color=$row['color'];
   $finish_width_in_inch=$row['finish_width_in_inch'];
   $option=$option.'<option value="'.$row['version_name']."?fs?".$row['color']."?fs?".$row['finish_width_in_inch']."?fs?".$row['customer_name']."?fs?".$row['version_id']."?fs?".$row['customer_id']."?fs?".$row['style_name']."?fs?".'"> Version:'.$row['version_name'].', Style: '.$row['style_name'].', Color: '.$row['color'].', Finish Width:'.$row['finish_width_in_inch'].' ,Customer:'.$row['customer_name'].'</option>';
   $option.="?ffss?".$row['version_id']."?fds?".$row['version_name']."?fds?".$row['color']."?fds?".$row['finish_width_in_inch'];

   $version_details=$split_pp_number[1];
}


?>

<script type='text/javascript' src='process_program/quickly_defining_qc_standard_for_individual_process_form_validation.js'></script>


<style>

.form-group		/* This is for reducing Gap among Form's Fields */
{

	margin-bottom: 5px;

}

</style>

<script>

	document.getElementById('version_number_for_searching').innerHTML='<?php echo $option ?>';
	if(document.getElementById('version_number_for_searching').value != '')
   {
      select_attached_proces_of_version();
   }


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



function Fill_Value_Of_Version_Number_Field_For_Searching(pp_number_for_searching)
{
    		//alert(pp_number_for_searching);
			// alert(pp_number_for_searching);
			var value_for_data= 'pp_number_value='+pp_number_for_searching;

            $.ajax({
			 		url: 'process_program/returning_version_number_details.php',
			 		dataType: 'text',
			 		type: 'post',
			 		contentType: 'application/x-www-form-urlencoded',
			 		data: value_for_data,
			 		      
			 		success: function( data, textStatus, jQxhr )
			 		{       
			 			    

                            
			 				document.getElementById('version_number_for_searching').innerHTML=data;
			 				
							
							
			 		},
			 		error: function( jqXhr, textStatus, errorThrown )
			 		{       
			 				//console.log( errorThrown );
			 				alert(errorThrown);
			 		}
			}); // End of $.ajax({
}   /*End of function Fill_Value_Of_Version_Number_Field(pp_number)*/

function select_attached_proces_of_version()
{
			
	var pp_number = document.getElementById('pp_number_for_searching').value;
	var version_value = document.getElementById('version_number_for_searching').value;
	var splitted_version_value = version_value.split("?fs?");
	var version_name = splitted_version_value[0];
	var color = splitted_version_value[1];
	var version_id = splitted_version_value[4];
 
	//alert(pp_number+" "+version_number);
    $.ajax({
	 		url: 'process_program/returning_attached_proces_of_version.php',
	 		dataType: 'text',
	 		type: 'post',
	 		contentType: 'application/x-www-form-urlencoded',
	 		data: {pp_number_value:pp_number,version_number_value:version_name,
	 			version_id : version_id,
	 			color_value:color},
	 		      
	 		success: function( data, textStatus, jQxhr )
	 		{       
	 			    

	 				document.getElementById('standard_for_for_searching').innerHTML=data;

					
	 		},
	 		error: function( jqXhr, textStatus, errorThrown )
	 		{       
	 				//console.log( errorThrown );
	 				alert(errorThrown);
	 		}
	}); // End of $.ajax({
	
	
}

function fetching_qc_standard_defining_form()
{
	
       var validate = Quickly_Defining_QC_Standard_For_Individual_Process_Form_Validation();

       if(validate != false)
	   {

         var selected_pp_number_value = document.getElementById('pp_number_for_searching').value;
         var selected_version_value = document.getElementById('version_number_for_searching').value;
         var splitted_selected_version_number_value = selected_version_value.split('?fs?');
         var version_number = splitted_selected_version_number_value[4];

			var process_name = document.getElementById('standard_for_for_searching').value;

         // var qc_standard_all_data = selected_pp_number_value+'?divider?'+selected_version_value+'?divider?'+process_name;
         // alert(qc_standard_all_data);
         //var singe_and_desizing = "process_program\\defining_qc_standard_for_singe_and_desize_process.php?pp_number=" + selected_pp_number_value+"&version_number="+version_number;
         // "Singeing & Desizing"   : "process_program\\defining_qc_standard_for_singe_and_desize_process.php?pp_number=" + selected_pp_number_value+"&version_number="+version_number,

			var mapping_fetchable_form = 
			{   
				"Singeing & Desizing"   : "process_program\\defining_qc_standard_for_singe_and_desize_process.php?pp_number=" + encodeURIComponent(selected_pp_number_value)+"&version_number="+version_number,
            "Singeing"	            : "process_program\\defining_qc_standard_for_singeing_process.php?pp_number=" + encodeURIComponent(selected_pp_number_value)+"&version_number="+version_number,
				"Desizing"	            : "process_program\\defining_qc_standard_for_desizing_process.php?pp_number=" + encodeURIComponent(selected_pp_number_value)+"&version_number="+version_number,
				"Bleaching"		 	      : "process_program\\defining_qc_standard_for_bleaching_process.php?pp_number=" + encodeURIComponent(selected_pp_number_value)+"&version_number="+version_number, 
				"Mercerize"			      : "process_program\\defining_qc_standard_for_mercerize_proces.php?pp_number=" + encodeURIComponent(selected_pp_number_value)+"&version_number="+version_number,
				"Ready For Mercerize"   : "process_program\\defining_qc_standard_for_ready_for_mercerize_process.php?pp_number=" + encodeURIComponent(selected_pp_number_value)+"&version_number="+version_number,
				"Equalize"              : "process_program\\defining_qc_standard_for_equalize_process.php?pp_number=" + encodeURIComponent(selected_pp_number_value)+"&version_number="+version_number,
				"Printing"              : "process_program\\defining_qc_standard_for_printing_process.php?pp_number=" + encodeURIComponent(selected_pp_number_value)+"&version_number="+version_number,
				"Curing"		 	         : "process_program\\defining_qc_standard_for_curing_process.php?pp_number=" + encodeURIComponent(selected_pp_number_value)+"&version_number="+version_number, 
				"Washing"		 	      : "process_program\\defining_qc_standard_for_washing_process.php?pp_number=" + encodeURIComponent(selected_pp_number_value)+"&version_number="+version_number, 
				"Finishing"		 	      : "process_program\\defining_qc_standard_for_finishing_process.php?pp_number=" + encodeURIComponent(selected_pp_number_value)+"&version_number="+version_number, 
				"Calander"		 	      : "process_program\\defining_qc_standard_for_calendering_process.php?pp_number=" + encodeURIComponent(selected_pp_number_value)+"&version_number="+version_number, 
				"Sanforizing"		 	   : "process_program\\defining_qc_standard_for_sanforizing_process.php?pp_number=" + encodeURIComponent(selected_pp_number_value)+"&version_number="+version_number, 
				"Raising"		 	      : "process_program\\defining_qc_standard_for_raising_process.php?pp_number=" + encodeURIComponent(selected_pp_number_value)+"&version_number="+version_number, 
				"Scouring & Bleaching"	: "process_program\\defining_qc_standard_for_scouring_bleaching_process.php?pp_number=" + encodeURIComponent(selected_pp_number_value)+"&version_number="+version_number, 
				"Scouring"		 	      : "process_program\\defining_qc_standard_for_scouring_process.php?pp_number=" + encodeURIComponent(selected_pp_number_value)+"&version_number="+version_number, 
				"Ready For Print"		 	: "process_program\\defining_qc_standard_for_ready_for_printing_process.php?pp_number=" + encodeURIComponent(selected_pp_number_value)+"&version_number="+version_number, 
            "Ready For Dyeing"		: "process_program\\defining_qc_standard_for_ready_for_dying_process.php?pp_number=" + encodeURIComponent(selected_pp_number_value)+"&version_number="+version_number, 
				"Ready For Raising"		: "process_program\\defining_qc_standard_for_ready_for_raising_process.php?pp_number=" + encodeURIComponent(selected_pp_number_value)+"&version_number="+version_number, 
				"Greige Receiving"		: "process_program\\defining_qc_standard_for_greige_receiving_process.php?pp_number=" + encodeURIComponent(selected_pp_number_value)+"&version_number="+version_number,
            "Steaming"		         : "process_program\\defining_qc_standard_for_steaming_process.php?pp_number=" + encodeURIComponent(selected_pp_number_value)+"&version_number="+version_number,
            "Dyeing"		            : "process_program\\defining_qc_standard_for_dyeing_process.php?pp_number=" + encodeURIComponent(selected_pp_number_value)+"&version_number="+version_number,
            "Dyeing-Finish"		   : "process_program\\defining_qc_standard_for_dyeing_finish_process.php?pp_number=" + encodeURIComponent(selected_pp_number_value)+"&version_number="+version_number

			};
			
			//alert(mapping_fetchable_form[process_name]);
			
			var process_page_to_be_loaded = mapping_fetchable_form[process_name];
			$("#row_for_qc_standard_defining_form_loading").empty();
			$("#row_for_qc_standard_defining_form_loading").load(process_page_to_be_loaded,function() 
			{

				//var selected_pp_number_value = document.getElementById('pp_number_for_searching').value;

				/*alert(selected_pp_number_value);

				var selected_pp_number_text = $("#pp_number_for_searching").html();
				var option_for_pp='<option value="'+selected_pp_number_text+'" >'+selected_pp_number_text+'</option>';*/

			    document.getElementById('pp_number_value').value= selected_pp_number_value;
				document.getElementById('form-group_for_pp_number').style.display = "display";



				//var selected_version_value = document.getElementById('version_number_for_searching').value;

				var selected_version_text = $("#version_number_for_searching option:selected").html();
				var option_for_version='<option value="'+selected_version_value+'">'+selected_version_text+'</option>';
				document.getElementById('version_number').innerHTML=option_for_version;
				document.getElementById('form-group_for_version_number').style.display = "none";



				
				
				var process_name_list = document.getElementById('standard_for_for_searching').value;
				document.getElementById('standard_for_which_process').value=process_name_list;	
				document.getElementById('form-group_for_standard_for_which_process').style.display = "none";
				
				
				
				//var splitted_selected_version_number_value = selected_version_value.split('?fs?');
				var selected_color = splitted_selected_version_number_value[1];
				document.getElementById('color_name').value=selected_color;
					
				var selected_finish_width_in_inch = splitted_selected_version_number_value[2];
				document.getElementById('finish_width_in_inch').value=selected_finish_width_in_inch;
				
				var selected_customer = splitted_selected_version_number_value[3];
				document.getElementById('customer_name').value = selected_customer;
            document.getElementById('customer_id').value = splitted_selected_version_number_value[5];


            //document.getElementById('customer_id').value = splitted_selected_version_number_value[5];
            //document.getElementById('process_id').value = "proc_9";

				
				 var value_for_data= 'customer_id='+splitted_selected_version_number_value[5];

				 //alert(value_for_data);

     
     $.ajax({
               url: 'process_program/return_test_name_method.php',
               dataType: 'text',
               type: 'post',
               contentType: 'application/x-www-form-urlencoded',
               data: value_for_data,
                     
               success: function( data, textStatus, jQxhr )
               {       
                    
                  //  alert(data);
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
                    
                  
               for(var i =0; i<splitted_data.length; i++) 
               {
					    
					    for(var j =0; j<splitted_data.length; j++) 
                    {
							if(i!=j) splitted_data[j]="";
						   }
 // Color Fastness To Rubbing
                  //  if((splitted_data.includes('1')) && $('#div_cf_to_rubbing').length !== 0) 
                  if((splitted_data.includes('1') || splitted_data.includes('240') || splitted_data.includes('105') || splitted_data.includes('164') || splitted_data.includes('207') || splitted_data.includes('247') || splitted_data.includes('259') || splitted_data.includes('298')) && $('#div_cf_to_rubbing').length !== 0) 
                     {
                        
                        test_method_for_all+=test_method_id[i]+',';
                      
                        $(".full_page_load").show();
                        $("#div_cf_to_rubbing").show();


                        $("#for_cf_to_rubbing_dry_test_name_label").html(test_name_method[i]);
                        $("#cf_to_rubbing_dry_test_method").hide();
                          
                     } 
						
//For Dimensional Stability To Washing

                     // if((splitted_data.includes('2')) && $('#div_dimensional_stability_to_washing').length !== 0) 
                     if((splitted_data.includes('2') || splitted_data.includes('64') || splitted_data.includes('116') || splitted_data.includes('160') || splitted_data.includes('175') || splitted_data.includes('188') || splitted_data.includes('202') || splitted_data.includes('231') || splitted_data.includes('245') || splitted_data.includes('264') || splitted_data.includes('276') || splitted_data.includes('284')) && $('#div_dimensional_stability_to_washing').length !== 0) 
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

                        $("#for_bowing_and_skew_test_name_label").html(test_name_method[i]);
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

				
			
			}

			); //End of $("#row_for_qc_standard_defining_form_loading").load(process_page_to_be_loaded,function()
			
		  	 
       }//End of if(validate != false)	
	
} // End of function fetching_qc_standard_defining_form()

function change_up_down_arrow_icon(icon_lcation)
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
	
	
} // End of function change_up_down_arrow_icon(icon_lcation)


/***************************************************** FOR AUTO COMPLETE********************************************************************/

$('.for_auto_complete').chosen();


/***************************************************** FOR AUTO COMPLETE********************************************************************/



</script>


<div class="col-sm-12 col-md-12 col-lg-12">

	<div class="panel panel-default"> <!-- This div will create a block/panel for FORM -->

		<div class="panel-heading" style="color:#191970;font-size:20px;font-weight:bold">

	      <div class="row" data-toggle="collapse" data-target="#search_form_collpapsible_div" onClick="change_up_down_arrow_icon(this.childNodes[5].childNodes[1].id)"> <!-- Row for Panel Heading and Chevron Up Alingment -->
            <span class="col-sm-11" style="text-align:center;"><b>Defining QC Standard For Individual Process Form</b></span>
            <div  style="text-align:right; padding-right:10px;" id='test'> 
               <i class="glyphicon glyphicon-chevron-up text-right"  id='panel_heading_icon'></i>
            </div>
         </div> <!-- End of <div class="row" data-toggle="collapse" href="#demo"  Row for Panel Heading and Chevron Up Alingment -->
         
       </div> <!-- End of <div class="panel-heading" style="color:#191970;"> -->
           
		<div id='search_form_collpapsible_div' class="collapse in"> <!-- For Making Collapsible Section -->
				<form class="form-horizontal " action="" style="margin-top:10px;" name="quickly_defining_qc_standard_for_individual_process_form" id="quickly_defining_qc_standard_for_individual_process_form">


					<div class="form-group form-group-sm" id="form-group_for_pp_number_for_searching">
						    <label class="control-label col-sm-3" for="pp_number_for_searching" style="margin-right:0px; color:#00008B;">PP Number:</label>
							<div class="col-sm-5">
								<select  class="form-control for_auto_complete" id="pp_number_for_searching" name="pp_number_for_searching" onchange="Fill_Value_Of_Version_Number_Field_For_Searching(this.value)">
											
											<option  value="<?php echo $pp_number ?>" select="selected"> <?php echo $pp_number ?></option>
											<?php 
												 $sql = 'select pp_number from `process_program_info` order by `pp_number`';
												 $result= mysqli_query($con,$sql) or die(mysqli_error($con));
												 while( $row = mysqli_fetch_array( $result))
												 {

													 echo '<option value="'.$row['pp_number'].'">'.$row['pp_number'].'</option>';

												 }

											 ?> 
								</select>

							</div> <!-- End of <div class="col-sm-5"> -->
						</div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_pp_number"> -->
                  

						<div class="form-group form-group-sm" id="form-group_for_version_number_for_searching">
						<label class="control-label col-sm-3" for="version_number_for_searching" style="margin-right:0px; color:#00008B;">Version Number:</label>
							<div class="col-sm-5">
								<select  class="form-control" id="version_number_for_searching" name="version_number_for_searching" onchange="select_attached_proces_of_version()">
                        <option selected="selected" value="select">Select version number</option>

											<?php 
												 $sql = 'select version_id, version_name from `pp_wise_version_creation_info` order by `version_name`';
												 $result= mysqli_query($con,$sql) or die(mysqli_error($con));
												 while( $row = mysqli_fetch_array( $result))
												 {

													 echo '<option value="'.$row['version_name'].'">'.$row['version_name'].'</option>';

												 }

											 ?>
								</select>
							</div>
						</div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_version_number"> -->
			
						
                        <div class="form-group form-group-sm" id="form-group_for_standard_for_for_searching">
						<label class="control-label col-sm-3" for="standard_for_for_searching" style="margin-right:0px; color:#00008B;">Standard For:</label>
							<div class="col-sm-5">
								<select  class="form-control" id="standard_for_for_searching" name="standard_for_for_searching">
											<option selected="selected" value="select">Select Standard For</option>
											<?php 
												 $sql = 'select process_name from `process_name` order by `row_id`';
												 $result= mysqli_query($con,$sql) or die(mysqli_error($con));
												 while( $row = mysqli_fetch_array($result))
												 {

													 echo '<option value="'.$row['process_name'].'">'.$row['process_name'].'</option>';

												 }

											 ?>
								</select>
							</div>
								<i class="glyphicon glyphicon-remove" onclick="reset_dropdown('standard_for_for_searching')" style="margin-top:6px;"></i>
						</div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_standard_for"> -->
                        
						<div class="form-group form-group-sm">
								<div class="col-sm-offset-3 col-sm-5">
									<button type="button" class="btn btn-primary" onClick="fetching_qc_standard_defining_form()" >Search</button>
									<button type="reset" class="btn btn-success">Reset</button>
								</div>
						</div>

				</form>
                
             </div> <!-- End of <div id='demo' class="show">  For Making Collapsible Section -->
			
		</div> <!-- End of <div class="panel panel-default"> -->
        
        <div class="row" id="row_for_qc_standard_defining_form_loading" >
						   
			<!-- This is Display Section. --> 
            <div style="text-align:center;margin-top:140px;"> Welcome to Defining QC Standard For Individual Process</div>
               
						 
		</div> <!-- End of <div id="row_for_qc_standard_defining_form_loading"> -->

</div> <!-- End of <div class="col-sm-12 col-md-12 col-lg-12"> -->