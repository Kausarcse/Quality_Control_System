<?php

session_start();
require_once("../login/session.php");
include('../login/db_connection_class.php');
$obj = new DB_Connection_Class();
$obj->connection();

// $trf_id = isset($_GET['trf_data']) ? $_GET['trf_data'] : '';

$trf_data=$_GET['trf_data'];
$splitted_data=explode('?fs?', $trf_data);
$test_result_id=$splitted_data[0];
$test_result_table=$splitted_data[1];
$test_result_table_column=$splitted_data[2];

$sql="select ptftri.partial_test_for_test_result_creation_date, ptftri.alternate_partial_test_for_test_result_creation_date_time,ptftri.process_id, ptftri.process_name,ptftri.style, 
ptftri.pp_number,pwvci.version_id, pwvci.version_name, ptftri.design, ptftri.customer_id, ptftri.customer_name, ptftri.fiber_composition, ptftri.before_trolley_number_or_batcher_number,
ptftri.after_trolley_number_or_batcher_number, ptftri.machine_name, ptftri.after_trolley_or_batcher_qty, pwvci.color,pwvci.greige_width_in_inch, ptftri.finish_width_in_inch, 
pwvci.pp_quantity, ( ((pwvci.pp_quantity - ptftri.after_trolley_or_batcher_qty) * 100)/ pwvci.pp_quantity) short_excess from $test_result_table ptftri, pp_wise_version_creation_info pwvci where ptftri.pp_number = pwvci.pp_number and ptftri.version_id = pwvci.version_id 
and ptftri.$test_result_table_column = '$test_result_id'";


$result=mysqli_query($con,$sql) or die(mysqli_error($con));
$result_for_trf = mysqli_fetch_array($result);




?>




<script type='text/javascript' src='process_qc_result/qc_result_for_calendering_process_form_validation.js'></script>

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
	var db_table_name="defining_qc_standard_for_calendering_process";
    var value_for_data= 'pp_number_value='+pp_number &'table_name='+db_table_name;


/*    $('#version_number').html='<option>This is test </option>';
*/	/*document.getElementById('version_number').innerHTML='<option> option 1</option> <option> option 2</option> ';*/
            $.ajax({
			 		url: 'process_qc_result/returning_version_number_details_for_qc_result.php',
			 		dataType: 'text',
			 		type: 'post',
			 		contentType: 'application/x-www-form-urlencoded',
			 		data:  {pp_number_value:pp_number,table_name:db_table_name},
			 		      
			 		success: function( data, textStatus, jQxhr )
			 		{       
			 			    

                            /*var splitted_data= data.split('?fs?');*/
			 			    /*document.getElementById('customer_name').value=splitted_data[0]; 
			 			    document.getElementById('color').value=splitted_data[1]; 
			 			    document.getElementById('finish_width_in_inch').value=splitted_data[2]; 
			 			    document.getElementById('version_number').innerHTML=splitted_data[3]; */
			 			    /*alert(data);*/
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
*/  
  document.getElementById('color').value=splitted_version_details[1];
  document.getElementById('finish_width_in_inch').value=splitted_version_details[2]; 
  document.getElementById('customer_name').value=splitted_version_details[3]; 
  document.getElementById('standard_for_which_process').value='Calendering'; 

}/* End of function fill_up_qc_standard_additional_info(version_details)*/
 function sending_data_of_qc_result_for_calendering_process_form_for_saving_in_database()
 {


       var validate = Calendering_Form_Validation();
       var url_encoded_form_data = $("#qc_result_for_calendering_process_form").serialize(); //This will read all control elements value of the form	
       if(validate != false)
	   {


		  	 $.ajax({
			 		url: 'process_qc_result/qc_result_for_calendering_process_saving.php',
			 		dataType: 'text',
			 		type: 'post',
			 		contentType: 'application/x-www-form-urlencoded',
			 		data: url_encoded_form_data,
			 		success: function( data, textStatus, jQxhr )
			 		{
			 				alert(data);
			 				if(data=='Data is successfully saved.')
			 				{   

			 					var version_id=document.getElementById('version_id').value;
			 					var pp_number=document.getElementById('pp_number').value; 
			 					var process_id=document.getElementById('process_id').value; 
                         var process_name=document.getElementById('process_name').value; 

			 					var style_name=document.getElementById('style_name').value; 
			 					var finish_width_in_inch=document.getElementById('finish_width_in_inch').value; 
			 					var before_trolley_number_or_batcher_number=document.getElementById('before_trolley_number_or_batcher_number').value; 
			 					var after_trolley_number_or_batcher_number=document.getElementById('after_trolley_number_or_batcher_number').value; 

			 					get_all_data='?fs?'+version_id+'?fs?'+pp_number+'?fs?'+process_id+'?fs?'+process_name+'?fs?'+style_name+'?fs?'+finish_width_in_inch+"?fs?"+before_trolley_number_or_batcher_number+"?fs?"+after_trolley_number_or_batcher_number;

			 					$('#element').load('report/pass_fail_report_for_partial_test.php?all_data='+encodeURIComponent(get_all_data));
			 					/*$('#edit_test_report').show();
*/			 				}
			 		},
			 		error: function( jqXhr, textStatus, errorThrown )
			 		{
			 				//console.log( errorThrown );
			 				alert(errorThrown);
			 		}
			 }); // End of $.ajax({

       }//End of if(validate != false)

 }//End of function sending_data_of_qc_result_for_calendering_process_form_for_saving_in_database()

</script>
<div class="col-sm-12 col-md-12 col-lg-12">

		<div class="panel panel-default"> <!-- This div will create a block/panel for FORM -->

			<body id="target">
           	 <div id="element">

				<div class="panel-heading" style="color:#191970;"><b>Qc Result For Calendering Process</b></div> <!-- This will create a upper block for FORM (Just Beautification) -->


				<form class="form-horizontal" action="" style="margin-top:10px;" name="qc_result_for_calendering_process_form" id="qc_result_for_calendering_process_form">

            <div class="form-group form-group-sm" id="form-group_for_pp_number" onchange="Fill_Value_Of_Version_Number_Field(this.value)">
						<label class="control-label col-sm-3" for="pp_number" style="margin-right:0px; color:#00008B;">PP Number:</label>
							<div class="col-sm-5">
								<input type="text" class="form-control" id="pp_number" name="pp_number" value="<?php if (isset($result_for_trf['pp_number'])) echo $result_for_trf['pp_number']?>"  readonly required>
							</div>
						</div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_pp_number"> -->

							<input type="hidden" name="version_id" id="version_id" value="<?php echo $result_for_trf['version_id'];?>">
                           <input type="hidden" name="customer_id" id="customer_id" value="<?php echo $result_for_trf['customer_id'];?>">
                           <input type="hidden" name="style_name" id="style_name" value="<?php echo $result_for_trf['style'];?>">
                           <input type="hidden" name="process_id" id="process_id" value="<?php echo $result_for_trf['process_id'];?>">
                           <input type="hidden" name="process_name" id="process_name" value="<?php echo $result_for_trf['process_name'];?>">



						<div class="form-group form-group-sm" id="form-group_for_version_number">
						<label class="control-label col-sm-3" for="version_number" style="margin-right:0px; color:#00008B;">Version Number:</label>
							<div class="col-sm-5">
								<select  class="form-control" id="version_number" name="version_number" readonly onchange="fill_up_qc_standard_additional_info(this.value)">
											<!-- <option select="selected" value="select">Select Version Number</option> -->
											<?php
												 $sql = 'select distinct version_name as version_name from `pp_wise_version_creation_info` order by `version_name`';
												 $result= mysqli_query($con,$sql) or die(mysqli_error($con));
												 while( $row = mysqli_fetch_array( $result))
												 {
												 	if ($row['version_name']==$result_for_trf['version_name']) {

												 		echo '<option selected="selected" value="'.$row['version_name'].'">'.$row['version_name'].'</option>';
												 		
												 	}
													//  echo '<option value="'.$row['version_name'].'">'.$row['version_name'].'</option>';

												 }

											 ?>
								</select>
							</div>
						</div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_version_number"> -->

						<div class="form-group form-group-sm" id="form-group_for_customer_name">
								<label class="control-label col-sm-3" for="customer_name" style="color:#00008B;">Customer Name:</label>
								<div class="col-sm-5" style="padding-right:4px;">
											<input type="text" class="form-control" id="customer_name" name="customer_name" value="<?php if (isset($result_for_trf['customer_name'])) echo $result_for_trf['customer_name']?>" placeholder="Enter Customer Name" readonly required>
								</div>								
						</div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_"> -->

						<div class="form-group form-group-sm" id="form-group_for_color">
								<label class="control-label col-sm-3" for="color" style="color:#00008B;">Color:</label>
								<div class="col-sm-5" style="padding-right:4px;">
									<input type="text" class="form-control" id="color" name="color" value="<?php if (isset($result_for_trf['color'])) echo $result_for_trf['color']?>" placeholder="Enter Color" readonly required>
								</div>
						</div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_"> -->

						<div class="form-group form-group-sm" id="form-group_for_finish_width_in_inch">
								<label class="control-label col-sm-3" for="finish_width_in_inch" style="color:#00008B;">Finish Width:</label>
								<div class="col-sm-5" style="padding-right:4px;">
									<input type="text" class="form-control" id="finish_width_in_inch" name="finish_width_in_inch" value="<?php if (isset($result_for_trf['finish_width_in_inch'])) echo $result_for_trf['finish_width_in_inch']?>" placeholder="Enter Finish Width" readonly required>
								</div>
						</div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_"> -->

						<div class="form-group form-group-sm" id="form-group_for_standard_for_which_process">
								<label class="control-label col-sm-3" for="standard_for_which_process" style="color:#00008B;">Standard For Which Process:</label>
								<div class="col-sm-5" style="padding-right:4px;">
									<input type="text" class="form-control" id="standard_for_which_process" name="standard_for_which_process" value="<?php if (isset($result_for_trf['process_name'])) echo $result_for_trf['process_name']?>" placeholder="Enter Standard For Which Process" readonly required>
								</div>
						</div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_"> -->

						<div class="form-group form-group-sm" id="form-group_for_date">
								<label class="control-label col-sm-3" for="date" style="color:#00008B;">Date:</label>
								<div class="col-sm-2">
									<input type="text" class="form-control" id="date" name="date" value="<?php if (isset($result_for_trf['partial_test_for_test_result_creation_date'])) echo $result_for_trf['partial_test_for_test_result_creation_date']?>" placeholder="Enter Date" required readonly>
								</div>
								<div class="col-sm-3" style="padding-right:4px;">
									<input type="text" class="form-control" id="alternate_date" name="alternate_date" value="<?php if (isset($result_for_trf['alternate_partial_test_for_test_result_creation_date_time'])) echo $result_for_trf['alternate_partial_test_for_test_result_creation_date_time']?>" readonly>
								</div>
						</div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_date"> -->
								

						<div class="form-group form-group-sm" id="form-group_for_before_trolley_number_or_batcher_number">
								<label class="control-label col-sm-3" for="before_trolley_number_or_batcher_number" style="color:#00008B;">Before Trolley Number Or Batcher Number:</label>
								<div class="col-sm-5" style="padding-right:4px;">
									<input type="text" class="form-control" id="before_trolley_number_or_batcher_number" name="before_trolley_number_or_batcher_number" value="<?php if (isset($result_for_trf['before_trolley_number_or_batcher_number'])) echo $result_for_trf['before_trolley_number_or_batcher_number']?>" placeholder="Enter Before Trolley Number Or Batcher Number" readonly required>
								</div>
						</div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_"> -->

						<div class="form-group form-group-sm" id="form-group_for_after_trolley_number_or_batcher_number">
								<label class="control-label col-sm-3" for="after_trolley_number_or_batcher_number" style="color:#00008B;">After Trolley Number Or Batcher Number:</label>
								<div class="col-sm-5" style="padding-right:4px;">
									<input type="text" class="form-control" id="after_trolley_number_or_batcher_number" name="after_trolley_number_or_batcher_number" value="<?php if (isset($result_for_trf['after_trolley_number_or_batcher_number'])) echo $result_for_trf['after_trolley_number_or_batcher_number']?>" placeholder="Enter After Trolley Number Or Batcher Number" readonly required>
								</div>
						</div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_"> -->
						
						<div class="form-group form-group-sm" id="form-group_for_received_quantity_in_meter">
								<label class="control-label col-sm-3" for="received_quantity_in_meter" style="color:#00008B;">Received Quantity in Meter:</label>
								<div class="col-sm-5" style="padding-right:4px;">
									<input type="text" class="form-control" id="received_quantity_in_meter" name="received_quantity_in_meter" value="<?php if (isset($result_for_trf['after_trolley_or_batcher_qty'])) echo $result_for_trf['after_trolley_or_batcher_qty']?>" placeholder="Enter Total Program Quantity" readonly required>
								</div>
						</div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_"> -->

						<?php

						    $pp_number = $result_for_trf['pp_number'];
							$sql_pp_quantity ="SELECT sum(pp_quantity) total_pp_quantity FROM pp_wise_version_creation_info WHERE pp_number = '$pp_number'";

							$result_pp_quantity =mysqli_query($con,$sql_pp_quantity) or die(mysqli_error($con));
							$row_pp_quantity = mysqli_fetch_array($result_pp_quantity);

						?>


						<div class="form-group form-group-sm" id="form-group_for_total_quantity_in_meter">
								<label class="control-label col-sm-3" for="total_quantity_in_meter" style="color:#00008B;">Total Quantity In Meter:</label>
								<div class="col-sm-5" style="padding-right:4px;">
									<input type="text" class="form-control" id="total_quantity_in_meter" name="total_quantity_in_meter" value="<?php echo $row_pp_quantity['total_pp_quantity']?>" readonly required>
								</div>
						</div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_"> -->

							<div class="form-group form-group-sm" id="form-group_for_short_or_excess_in_percentage">
								<label class="control-label col-sm-3" for="short_or_excess_in_percentage" style="color:#00008B;">Short Or Excess In Percentage:</label>
								<div class="col-sm-5" style="padding-right:4px;">
									<input type="text" class="form-control" id="short_or_excess_in_percentage" name="short_or_excess_in_percentage" value="<?php if (isset($result_for_trf['short_excess'])) echo $result_for_trf['short_excess']?> %" placeholder="Enter Short Or Excess In Percentage" readonly required>
								</div>
						</div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_"> -->


						<div class="form-group form-group-sm" id="form-group_for_received_quantity_in_meter">
								<label class="control-label col-sm-3" for="pp_quantity_in_meter" style="color:#00008B;">PP Order Quantity in Meter:</label>
								<div class="col-sm-5" style="padding-right:4px;">
									<input type="text" class="form-control" id="pp_quantity_in_meter" name="pp_quantity_in_meter" value="<?php echo $result_for_trf['pp_quantity']?>" readonly>
								</div>
						</div> 

						<div class="form-group form-group-sm" id="form-group_for_machine_name">
								<label class="control-label col-sm-3" for="machine_name" style="color:#00008B;">Machine Name:</label>
								<div class="col-sm-5" style="padding-right:4px;">
									<input type="text" class="form-control" id="machine_name" name="machine_name" value="<?php if (isset($result_for_trf['machine_name'])) echo $result_for_trf['machine_name']?>" placeholder="Enter Machine Name" readonly required>


									<input type="hidden" class="form-control" id="style_name" name="style_name" value="<?php echo $result_for_trf['style']?>">

								</div>
						</div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_"> -->





                                     
                                  <!--    For Test Result Entry Form -->

  <div class="form-group form-group-sm">
         
          <!-- <div class="col-sm-1 text-center">
          
        </div> -->


        <div class="col-sm-4 text-center">
          <label for="test_name_and_method" style="font-size:12px; color:#000066;">Test Name & Method</label>
          
                
        </div>
       
         <div class="col-sm-1 text-center">
                  <label for="description_or_type" style="font-size:12px; color:#000066;">Direction/Type</label>
                  
             </div>

             <div class="col-sm-1 text-center">
                 <!-- Gap Creation -->
           </div>
             
            <div class="col-sm-3 text-center">
                  <label for="value" style="font-size:12px; color:#000066;">Result</label>
                  
            </div>
            
                 <!--Add input/Select Field Here No Dive Only input/Select/Radio Button/Checkbox/Textarea -->
             

  </div><!-- End of <div class="form-group form-group-sm"  -->



  <?php 


$customer_id = $result_for_trf['customer_id'];
// $sql_for_customer="SELECT distinct tnm.id,tmc.test_method_id,  IF(tmc.test_method_name <> 'Other',concat(tmc.test_name,'(',tmc.test_method_name,')'),tmc.test_name) test_name_method
// from test_name_and_method_for_all_process tnm 
// INNER JOIN transaction_test_name_and_method ttnm on tnm.id = ttnm.test_name_and_method_for_process_id
// INNER JOIN test_method_for_customer tmc on tmc.iso_or_aatcc = ttnm.iso_or_aatcc and tmc.test_id=ttnm.test_name_id and tmc.test_method_id=ttnm.test_method_id
// where tmc.customer_id = '$customer_id'  ORDER BY tnm.id asc";

$sql_for_customer = "SELECT DISTINCT tnmp.id, tmn.test_method_id, IF(tmn.test_method_name <> 'Other',concat(tmn.test_name,'(',tmn.test_method_name,')'),tmn.test_name) test_name_method
FROM test_name_and_method_for_all_process tnmp
INNER JOIN test_method_name tmn ON tnmp.id = tmn.test_name_and_method_for_process_id 
INNER JOIN transaction_test_name_and_method ttnm ON ttnm.test_name_and_method_for_process_id = tmn.test_name_and_method_for_process_id
INNER JOIN test_method_for_customer tmc ON tmc.test_id = ttnm.test_name_id AND tmc.test_method_id = tmn.test_method_id
WHERE tmc.customer_id = '$customer_id' ORDER BY ttnm.test_name_and_method_for_process_id ASC";

$result_for_customer=mysqli_query($con,$sql_for_customer) or die(mysqli_error($con));
while($row = mysqli_fetch_array($result_for_customer))
{
   if (in_array($row['id'], ['1','240','105','164','207','247','259','298']))
   {
      echo "<script>$('#div_cf_to_rubbing').show()</script>";
   }
   if (in_array($row['id'], ['2','116','160','175','188','202','231','245','264','276','284']))
   {
      echo "<script>$('#div_dimensional_stability_to_washing').show()</script>";
   }
   if (in_array($row['id'], ['3']))
   {
      echo "<script>$('#div_appearance_after_wash_full').show()</script>";
   }
   if (in_array($row['id'], ['74','112']))
   {
      echo "<script>$('#div_yarn_count').show()</script>";
   }
   if (in_array($row['id'], ['4','113','122','146','183','202','213','221','254','283','299']))
   {
      echo "<script>$('#div_no_of_threads').show()</script>";
   }

   if (in_array($row['id'], ['5','114','123','134','147','199','300','301','229']))
   {
      echo "<script>$('#div_mass_per_unit_area').show()</script>";
   }
   if (in_array($row['id'], ['7','115','263','274','302']))
   {
      echo "<script>$('#div_tensile_properties').show()</script>";
   }
   if (in_array($row['id'], ['8','135','148','201','275','303']))
   {
      echo "<script>$('#div_tear_force').show()</script>";
   }
   if (in_array($row['id'], ['9','186','230']))
   {
      echo "<script>$('#div_seam_slippage').show()</script>";
   }
   if (in_array($row['id'], ['10']))
   {
      echo "<script>$('#div_bowing_and_skew').show()</script>";
   }
   if (in_array($row['id'], ['11','187','149','244','304']))
   {
      echo "<script>$('#div_seam_strength').show()</script>";
   }
   if (in_array($row['id'], ['12']))
   {
      echo "<script>$('#div_seam_properties').show()</script>";
   }
   if (in_array($row['id'], ['13']))
   {
      echo "<script>$('#div_mass_loss_in_abrasion').show()</script>";
   }
   if (in_array($row['id'], ['13','138','173']))
   {
      echo "<script>$('#div_abrasion_resistance').show()</script>";
   }
   if (in_array($row['id'], ['15','59','119','128','155','165','223','227','177','292']))
   {
      echo "<script>$('#div_color_fastness_to_washing').show()</script>";
   }
   if (in_array($row['id'], ['16','145']))
   {
      echo "<script>$('#div_cf_to_dry_cleaning').show()</script>";
   }
   if (in_array($row['id'], ['17','61']))
   {
      echo "<script>$('#div_cf_to_perspiration_acid').show()</script>";
   }
   if (in_array($row['id'], ['18','62','120','129','194','269']))
   {
      echo "<script>$('#div_cf_to_perspiration_alkali').show()</script>";
   }
   if (in_array($row['id'], ['19','121','141','167','228']))
   {
      echo "<script>$('#div_cf_to_water').show()</script>";
   }
   if (in_array($row['id'], ['20','65','196']))
   {
      echo "<script>$('#div_color_fastness_to_water_spotting').show()</script>";
   }
   if (in_array($row['id'], ['21','22','66','206']))
   {
      echo "<script>$('#div_resistance_to_surface_wetting').show()</script>";
   }
   if (in_array($row['id'], ['23','67']))
   {
      echo "<script>$('#div_cf_to_hydrolysis_of_reactive_dyes').show()</script>";
   }
   if (in_array($row['id'], ['24','68']))
   {
      echo "<script>$('#div_cf_to_oxidative_bleach_damage').show()</script>";
   }
   if (in_array($row['id'], ['25','69','158']))
   {
      echo "<script>$('#div_cf_to_phenolic_yellowing').show()</script>";
   }
   if (in_array($row['id'], ['26','132','169','70','143','195','211']))
   {
      echo "<script>$('#div_migration_of_color_into_pvc').show()</script>";
   }
   if (in_array($row['id'], ['27','156','168','71']))
   {
      echo "<script>$('#div_cf_to_saliva').show()</script>";
   }
   if (in_array($row['id'], ['28','210','224','72']))
   {
      echo "<script>$('#div_cf_to_chlorine_water').show()</script>";
   }
   if (in_array($row['id'], ['29','73','241','285']))
   {
      echo "<script>$('#div_cf_to_chlorine_bleach').show()</script>";
   }
   if (in_array($row['id'], ['30','75']))
   {
      echo "<script>$('#div_cf_to_peroxide_bleach').show()</script>";
   }
   if (in_array($row['id'], ['31','76']))
   {
      echo "<script>$('#div_cross_staining').show()</script>";
   }
   if (in_array($row['id'], ['32','77','118','235','258']))
   {
      echo "<script>$('#div_formaldehyde_content').show()</script>";
   }
   if (in_array($row['id'], ['33','78','109','170','237']))
   {
      echo "<script>$('#div_ph').show()</script>";
   }
   if (in_array($row['id'], ['34','89','191']))
   {
      echo "<script>$('#div_water_absorption').show()</script>";
   }
   if (in_array($row['id'], ['35','80']))
   {
      echo "<script>$('#div_wicking_test').show()</script>";
   }
   if (in_array($row['id'], ['36','81','163','190','214']))
   {
      echo "<script>$('#div_spirality').show()</script>";
   }
   if (in_array($row['id'], ['37','82','267','282']))
   {
      echo "<script>$('#div_smoothness_appearance').show()</script>";
   }
   if (in_array($row['id'], ['38','83','234']))
   {
      echo "<script>$('#div_print_durability').show()</script>";
   }
   if (in_array($row['id'], ['39','84','233']))
   {
      echo "<script>$('#div_iron_ability_of_woven_fabric').show()</script>";
   }
   if (in_array($row['id'], ['40','86','133','159','182','238','297','220','172','198','174','270','243','111']))
   {
      echo "<script>$('#div_cf_to_artificial_day_light').show()</script>";
   }
   if (in_array($row['id'], ['41','87']))
   {
      echo "<script>$('#div_moisture_content').show()</script>";
   }
   if (in_array($row['id'], ['42','88']))
   {
      echo "<script>$('#div_evaporation_rate').show()</script>";
   }
   if (in_array($row['id'], ['43','89']))
   {
      echo "<script>$('#div_fiber_content').show()</script>";
   }
   if (in_array($row['id'], ['44','90']))
   {
      echo "<script>$('#div_greige_width').show()</script>";
   }
   if (in_array($row['id'], ['45','91']))
   {
      echo "<script>$('#div_flame_intensity').show()</script>";
   }
   if (in_array($row['id'], ['46','92']))
   {
      echo "<script>$('#div_machine_speed').show()</script>";
   }
   if (in_array($row['id'], ['47','93']))
   {
      echo "<script>$('#div_bath_temparature').show()</script>";
   }
   if (in_array($row['id'], ['48','94']))
   {
      echo "<script>$('#div_bath_ph').show()</script>";
   }
   if (in_array($row['id'], ['49','95']))
   {
      echo "<script>$('#div_whiteness').show()</script>";
   }
   if (in_array($row['id'], ['50','97']))
   {
      echo "<script>$('#div_residual_sizing_material').show()</script>";
   }
   if (in_array($row['id'], ['6','101']))
   {
      echo "<script>$('#div_resistance_to_surface_fuzzing_and_pilling').show()</script>";
   }
   if (in_array($row['id'], ['51','98']))
   {
      echo "<script>$('#div_absorbency_test_method').show()</script>";
   }
   if (in_array($row['id'], ['52','99']))
   {
      echo "<script>$('#div_rubbing_dry').show()</script>";
   }
   if (in_array($row['id'], ['53','100']))
   {
      echo "<script>$('#div_rubbing_wet').show()</script>";
   }
   
}
?>

<div id="div_cf_to_rubbing" style="display: none;">


   <div class="form-group form-group-sm">
        


      <div class="col-sm-3 text-center">
         <label class="control-label" for="cf_to_rubbing_dry" style="color:#00008B; margin-top:23px;"><span id="for_cf_to_rubbing_dry_test_name_label">Color Fastness to Rubbing</span> <span id="cf_to_rubbing_dry_test_method"></span></label>
      </div>


       <div class="col-sm-1 text-center">
                 <!-- Gap Creation -->
       </div>

       
      <div class="col-sm-2 text-center">
                <!-- <label for="description_or_type" style="font-size:12px; color:#000066;">Description/Type</label> -->
                <label class="control-label" for="description_or_type" style="color:#00008B; margin-top:23px;"> Dry </label>
                <input type="hidden" class="form-control" id="test_method_for_cf_to_rubbing_dry" name="test_method_for_cf_to_rubbing_dry" value="ISO 105 X12">

      </div>



     <div class="col-sm-1 text-center">
                 <!-- Gap Creation -->
      </div>

         
     <div class="col-sm-2" for="value">

            <input type="text" class="form-control" id="cf_to_rubbing_dry_value" name="cf_to_rubbing_dry_value" placeholder="Enter Value"   style="color:#00008B; margin-top:23px;">

     </div>

              <input type="hidden" id="uom_of_cf_to_rubbing_dry" name="uom_of_cf_to_rubbing_dry"  value="uom_of_cf_to_rubbing_dry">

   
            

     </div><!-- End of <div class="form-group form-group-sm" cf_to_rubbing_dry -->



     


      <div class="form-group form-group-sm">
        


      <div class="col-sm-3 text-center">
         <label class="hidden" for="cf_to_rubbing_dry_value" style="color:#00008B;"><span id="for_cf_to_rubbing_wet_test_name_label" style="display: none;">Color Fastness to Rubbing <span id="cf_to_rubbing_wet_test_method" style="display: none;"></span></label>
      </div>

      <div class="col-sm-1 text-center">
                 <!-- Gap Creation -->
      </div>  
       
       <div class="col-sm-2 text-center">
                <!-- <label for="description_or_type" style="font-size:12px; color:#000066;">Description/Type</label> -->
                <label class="control-label" for="description_or_type" style="color:#00008B;"> Wet </label>
                <input type="hidden" class="form-control" id="test_method_for_cf_to_rubbing_wet" name="test_method_for_cf_to_rubbing_wet" value="ISO 105 X12">
                
      </div>

           
      <div class="col-sm-1 text-center">
                 <!-- Gap Creation -->
      </div>   
              
      <div class="col-sm-2" for="value">

            <input type="text" class="form-control" id="cf_to_rubbing_wet_value" name="cf_to_rubbing_wet_value" placeholder="Enter  Value">

       </div>

  
            <input type="hidden" id="uom_of_cf_to_rubbing_wet" name="uom_of_cf_to_rubbing_wet"  value="uom_of_cf_to_rubbing_wet">

            

     </div><!-- End of <div class="form-group form-group-sm" cf_to_rubbing_wet -->




  </div>     <!--  End of <div id="div_cf_to_rubbing" style="display: none"> -->


 <div id="div_dimensional_stability_to_washing" style="display: none;">


   <div class="form-group form-group-sm">
        

      <div class="col-sm-3 text-center">
         <label class="control-label" for="dimensional_stability_to_warp_washing_before_iron" style="color:#00008B; margin-top:23px;"><span id="for_dimensional_stability_to_warp_washing_before_iron_test_name_label">Dimensional Stability to Washing</span> <span id="dimensional_stability_to_warp_washing_before_iron_test_method"></span></label>
      </div>


       <div class="col-sm-1 text-center">
                 <!-- Gap Creation -->
       </div>

       
      <div class="col-sm-2 text-center">
                <!-- <label for="description_or_type" style="font-size:12px; color:#000066;">Description/Type</label> -->
                <label class="control-label" for="description_or_type" style="color:#00008B; margin-top:23px;"> Warp(Before Iron) </label>
                <input type="hidden" class="form-control" id="test_method_for_dimensional_stability_to_warp_washing_before_iron" name="test_method_for_dimensional_stability_to_warp_washing_before_iron" value="ISO 105 X12">

      </div>



     <div class="col-sm-1 text-center">
                 <!-- Gap Creation -->
      </div>

         
     <div class="col-sm-2" for="value">

            <input type="text" class="form-control" id="dimensional_stability_to_warp_washing_before_iron_value" name="dimensional_stability_to_warp_washing_before_iron_value" placeholder="Enter Value"   style="color:#00008B; margin-top:23px;">

     </div>

              <input type="hidden" id="uom_of_dimensional_stability_to_warp_washing_before_iron" name="uom_of_dimensional_stability_to_warp_washing_before_iron"  value="uom_of_dimensional_stability_to_warp_washing_before_iron">

   
            
  </div><!-- End of <div class="form-group form-group-sm" dimensional_stability_to_warp_washing_before_iron -->



     


   <div class="form-group form-group-sm">
       


      <div class="col-sm-3 text-center">
         <label class="hidden" for="dimensional_stability_to_weft_washing_before_iron" style="color:#00008B;"><span id="for_dimensional_stability_to_weft_washing_before_iron_test_name_label" style="display: none;">Dimensional Stability to Washing <span id="dimensional_stability_to_weft_washing_before_iron_test_method" style="display: none;"></span></label>
      </div>

      <div class="col-sm-1 text-center">
                 <!-- Gap Creation -->
      </div>  
       
       <div class="col-sm-2 text-center">
                <!-- <label for="description_or_type" style="font-size:12px; color:#000066;">Description/Type</label> -->
                <label class="control-label" for="description_or_type" style="color:#00008B;"> Weft(Before Iron) </label>
                <input type="hidden" class="form-control" id="test_method_for_dimensional_stability_to_weft_washing_before_iron" name="test_method_for_dimensional_stability_to_weft_washing_before_iron" value="ISO 105 X12">
                
      </div>

           
      <div class="col-sm-1 text-center">
                 <!-- Gap Creation -->
      </div>   
              
      <div class="col-sm-2" for="value">

            <input type="text" class="form-control" id="dimensional_stability_to_weft_washing_before_iron_value" name="dimensional_stability_to_weft_washing_before_iron_value" placeholder="Enter  Value">

       </div>

  
            <input type="hidden" id="uom_of_dimensional_stability_to_weft_washing_before_iron" name="uom_of_dimensional_stability_to_weft_washing_before_iron"  value="uom_of_dimensional_stability_to_weft_washing_before_iron">

            

     </div><!-- End of <div class="form-group form-group-sm" dimensional_stability_to_weft_washing_before_iron -->

  


   <div class="form-group form-group-sm">
        

      <div class="col-sm-3 text-center">
         <label class="control-label" for="dimensional_stability_to_warp_washing_after_iron" style="color:#00008B; margin-top:23px;"><span id="for_dimensional_stability_to_warp_washing_after_iron_test_name_label">Dimensional Stability to Washing</span> <span id="dimensional_stability_to_warp_washing_after_iron_test_method"></span></label>
      </div>


       <div class="col-sm-1 text-center">
                 <!-- Gap Creation -->
       </div>

       
      <div class="col-sm-2 text-center">
                <!-- <label for="description_or_type" style="font-size:12px; color:#000066;">Description/Type</label> -->
                <label class="control-label" for="description_or_type" style="color:#00008B; margin-top:23px;"> Warp(After Iron) </label>
                <input type="hidden" class="form-control" id="test_method_for_dimensional_stability_to_warp_washing_after_iron" name="test_method_for_dimensional_stability_to_warp_washing_after_iron" value="ISO 105 X12">

      </div>



     <div class="col-sm-1 text-center">
                 <!-- Gap Creation -->
      </div>

         
     <div class="col-sm-2" for="value">

            <input type="text" class="form-control" id="dimensional_stability_to_warp_washing_after_iron_value" name="dimensional_stability_to_warp_washing_after_iron_value" placeholder="Enter Value"   style="color:#00008B; margin-top:23px;">

     </div>

              <input type="hidden" id="uom_of_dimensional_stability_to_warp_washing_after_iron" name="uom_of_dimensional_stability_to_warp_washing_after_iron"  value="uom_of_dimensional_stability_to_warp_washing_after_iron">

   
            
  </div><!-- End of <div class="form-group form-group-sm" dimensional_stability_to_warp_washing_after_iron -->


     


   <div class="form-group form-group-sm">
       


      <div class="col-sm-3 text-center">
         <label class="hidden" for="dimensional_stability_to_weft_washing_after_iron" style="color:#00008B;"><span id="for_dimensional_stability_to_weft_washing_after_iron_test_name_label" style="display: none;">Dimensional Stability to Washing <span id="dimensional_stability_to_weft_washing_after_iron_test_method" style="display: none;"></span></label>
      </div>

      <div class="col-sm-1 text-center">
                 <!-- Gap Creation -->
      </div>  
       
       <div class="col-sm-2 text-center">
                <!-- <label for="description_or_type" style="font-size:12px; color:#000066;">Description/Type</label> -->
                <label class="control-label" for="description_or_type" style="color:#00008B;"> Weft(After Iron) </label>
                <input type="hidden" class="form-control" id="test_method_for_dimensional_stability_to_weft_washing_after_iron" name="test_method_for_dimensional_stability_to_weft_washing_after_iron" value="ISO 105 X12">
                
      </div>

           
      <div class="col-sm-1 text-center">
                 <!-- Gap Creation -->
      </div>   
              
      <div class="col-sm-2" for="value">

            <input type="text" class="form-control" id="dimensional_stability_to_weft_washing_after_iron_value" name="dimensional_stability_to_weft_washing_after_iron_value" placeholder="Enter  Value">

       </div>

  
            <input type="hidden" id="uom_of_dimensional_stability_to_weft_washing_after_iron" name="uom_of_dimensional_stability_to_weft_washing_after_iron"  value="uom_of_dimensional_stability_to_weft_washing_after_iron">

            

     </div><!-- End of <div class="form-group form-group-sm" dimensional_stability_to_weft_washing_after_iron -->


  </div>     <!--  End of <div id="div_dimensional_stability_to_washing" style="display: none"> -->


<div id="div_yarn_count" style="display: none;">


   <div class="form-group form-group-sm">
        

      <div class="col-sm-3 text-center">
         <label class="control-label" for="warp_yarn_count" style="color:#00008B; margin-top:23px;"><span id="for_warp_yarn_count_test_name_label">Yarn Count</span> <span id="warp_yarn_count_test_method"></span></label>
      </div>


       <div class="col-sm-1 text-center">
                 <!-- Gap Creation -->
       </div>

       
      <div class="col-sm-2 text-center">
                <!-- <label for="description_or_type" style="font-size:12px; color:#000066;">Description/Type</label> -->
                <label class="control-label" for="description_or_type" style="color:#00008B; margin-top:23px;"> Warp</label>
                <input type="hidden" class="form-control" id="test_method_for_warp_yarn_count" name="test_method_for_warp_yarn_count" value="ISO 105 X12">

      </div>



     <div class="col-sm-1 text-center">
                 <!-- Gap Creation -->
      </div>

         
     <div class="col-sm-2" for="value">

            <input type="text" class="form-control" id="warp_yarn_count_value" name="warp_yarn_count_value" placeholder="Enter Value"   style="color:#00008B; margin-top:23px;">

     </div>

              <input type="hidden" id="uom_of_warp_yarn_count" name="uom_of_warp_yarn_count"  value="uom_of_warp_yarn_count">

   
           
  </div><!-- End of <div class="form-group form-group-sm" warp_yarn_count -->




   <div class="form-group form-group-sm">
       


      <div class="col-sm-3 text-center">
         <label class="hidden" for="weft_yarn_count" style="color:#00008B;"><span id="for_weft_yarn_count_test_name_label" style="display: none;">Yarn Count <span id="weft_yarn_count_test_method" style="display: none;"></span></label>
      </div>

      <div class="col-sm-1 text-center">
                 <!-- Gap Creation -->
      </div>  
       
       <div class="col-sm-2 text-center">
                <!-- <label for="description_or_type" style="font-size:12px; color:#000066;">Description/Type</label> -->
                <label class="control-label" for="description_or_type" style="color:#00008B;"> Weft </label>
                <input type="hidden" class="form-control" id="test_method_for_weft_yarn_count" name="test_method_for_weft_yarn_count" value="ISO 105 X12">
                
      </div>

           
      <div class="col-sm-1 text-center">
                 <!-- Gap Creation -->
      </div>   
              
      <div class="col-sm-2" for="value">

            <input type="text" class="form-control" id="weft_yarn_count_value" name="weft_yarn_count_value" placeholder="Enter  Value">

       </div>

  
            <input type="hidden" id="uom_of_weft_yarn_count" name="uom_of_weft_yarn_count"  value="uom_of_weft_yarn_count">

            

     </div><!-- End of <div class="form-group form-group-sm" weft_yarn_count -->

     


</div>     <!--  End of <div id="div_yarn_count" style="display: none"> -->




  <div id="div_no_of_threads" style="display: none;">


   <div class="form-group form-group-sm">
        

      <div class="col-sm-3 text-center">
         <label class="control-label" for="no_of_threads_in_warp" style="color:#00008B; margin-top:23px;"><span id="for_no_of_threads_in_warp_test_name_label">Number of Threads Per Unit Length</span> <span id="no_of_threads_in_warp_test_method"></span></label>
      </div>


       <div class="col-sm-1 text-center">
                 <!-- Gap Creation -->
       </div>

       
      <div class="col-sm-2 text-center">
                <!-- <label for="description_or_type" style="font-size:12px; color:#000066;">Description/Type</label> -->
                <label class="control-label" for="description_or_type" style="color:#00008B; margin-top:23px;"> Warp</label>
                <input type="hidden" class="form-control" id="no_of_threads_in_warp_value" name="no_of_threads_in_warp_value" value="ISO 105 X12">

      </div>



     <div class="col-sm-1 text-center">
                 <!-- Gap Creation -->
      </div>

         
     <div class="col-sm-2" for="value">

            <input type="text" class="form-control" id="no_of_threads_in_warp_value" name="no_of_threads_in_warp_value" placeholder="Enter Value"   style="color:#00008B; margin-top:23px;">

     </div>

              <input type="hidden" id="uom_of_no_of_threads_in_warp" name="uom_of_no_of_threads_in_warp"  value="uom_of_no_of_threads_in_warp">

   
            
  </div><!-- End of <div class="form-group form-group-sm" no_of_threads_in_warp -->



     


   <div class="form-group form-group-sm">
       


      <div class="col-sm-3 text-center">
         <label class="hidden" for="no_of_threads_in_weft" style="color:#00008B;"><span id="for_no_of_threads_in_weft_test_name_label" style="display: none;">Number of Threads Per Unit Length <span id="no_of_threads_in_weft_test_method" style="display: none;"></span></label>
      </div>

      <div class="col-sm-1 text-center">
                 <!-- Gap Creation -->
      </div>  
       
       <div class="col-sm-2 text-center">
                <!-- <label for="description_or_type" style="font-size:12px; color:#000066;">Description/Type</label> -->
                <label class="control-label" for="description_or_type" style="color:#00008B;"> Weft </label>
                <input type="hidden" class="form-control" id="test_method_for_no_of_threads_in_weft" name="test_method_for_no_of_threads_in_weft" value="ISO 105 X12">
                
      </div>

           
      <div class="col-sm-1 text-center">
                 <!-- Gap Creation -->
      </div>   
              
      <div class="col-sm-2" for="value">

            <input type="text" class="form-control" id="no_of_threads_in_weft_value" name="no_of_threads_in_weft_value" placeholder="Enter  Value">

       </div>

  
            <input type="hidden" id="uom_of_no_of_threads_in_weft" name="uom_of_no_of_threads_in_weft"  value="uom_of_no_of_threads_in_weft">

            

     </div><!-- End of <div class="form-group form-group-sm" no_of_threads_in_weft -->

     


  </div>     <!--  End of <div id="div_no_of_threads" style="display: none"> -->



<div id="div_mass_per_unit_area" style="display: none;">


   <div class="form-group form-group-sm">
        

      <div class="col-sm-3 text-center">
         <label class="control-label" for="mass_per_unit_per_area" style="color:#00008B; margin-top:23px;"><span id="for_mass_per_unit_per_area_test_name_label">Mass Per Unit Area</span> <span id="mass_per_unit_per_area_test_method"></span></label>
      </div>


       <div class="col-sm-1 text-center">
                 <!-- Gap Creation -->
       </div>

       
      <div class="col-sm-2 text-center">
                <!-- <label for="description_or_type" style="font-size:12px; color:#000066;">Description/Type</label> -->
                <label class="control-label" for="description_or_type" style="color:#00008B; margin-top:23px;"> </label>
                <input type="hidden" class="form-control" id="test_method_for_mass_per_unit_per_area" name="test_method_for_mass_per_unit_per_area" value="ISO 105 X12">

      </div>



     <div class="col-sm-1 text-center">
                 <!-- Gap Creation -->
      </div>

         
     <div class="col-sm-2" for="value">

            <input type="text" class="form-control" id="mass_per_unit_per_area_value" name="mass_per_unit_per_area_value" placeholder="Enter Value"   style="color:#00008B; margin-top:23px;">

     </div>

              <input type="hidden" id="uom_of_mass_per_unit_per_area" name="uom_of_mass_per_unit_per_area"  value="uom_of_mass_per_unit_per_area">

   
            
   </div><!-- End of <div class="form-group form-group-sm" mass_per_unit_per_area -->
 

 </div>     <!--  End of <div id="div_mass_per_unit_area" style="display: none"> -->


<div id="div_resistance_to_surface_fuzzing_and_pilling" style="display: none;">


   <div class="form-group form-group-sm">
        

      <div class="col-sm-3 text-center">
         <label class="control-label" for="surface_fuzzing_and_pilling" style="color:#00008B; margin-top:23px;"><span id="for_surface_fuzzing_and_pilling_test_name_label">Resistance to Surface Fuzzing & Pilling</span> <span id="surface_fuzzing_and_pilling_test_method"></span></label>
      </div>


       <div class="col-sm-1 text-center">
                 <!-- Gap Creation -->
       </div>

       
      <div class="col-sm-2 text-center">
                <!-- <label for="description_or_type" style="font-size:12px; color:#000066;">Description/Type</label> -->
                <label class="control-label" for="description_or_type" style="color:#00008B; margin-top:23px;"> </label>
                <input type="hidden" class="form-control" id="test_method_for_surface_fuzzing_and_pilling" name="test_method_for_surface_fuzzing_and_pilling" value="ISO 105 X12">

      </div>



     <div class="col-sm-1 text-center">
                 <!-- Gap Creation -->
      </div>

         
     <div class="col-sm-2" for="value">

            <input type="text" class="form-control" id="surface_fuzzing_and_pilling_value" name="surface_fuzzing_and_pilling_value" placeholder="Enter Value"   style="color:#00008B; margin-top:23px;">

     </div>

              <input type="hidden" id="uom_of_surface_fuzzing_and_pilling" name="uom_of_surface_fuzzing_and_pilling"  value="uom_of_surface_fuzzing_and_pilling">

   
            
  </div><!-- End of <div class="form-group form-group-sm" surface_fuzzing_and_pilling -->

</div>     <!--  End of <div id="div_surface_fuzzing_and_pilling" style="display: none"> -->



<div id="div_tensile_properties" style="display: none;">


   <div class="form-group form-group-sm">
        

      <div class="col-sm-3 text-center">
         <label class="control-label" for="tensile_properties_in_warp" style="color:#00008B; margin-top:23px;"><span id="for_tensile_properties_in_warp_test_name_label">Tensile Properties</span> <span id="tensile_properties_in_warp_test_method"></span></label>
      </div>


       <div class="col-sm-1 text-center">
                 <!-- Gap Creation -->
       </div>

       
      <div class="col-sm-2 text-center">
                <!-- <label for="description_or_type" style="font-size:12px; color:#000066;">Description/Type</label> -->
                <label class="control-label" for="description_or_type" style="color:#00008B; margin-top:23px;"> Warp</label>
                <input type="hidden" class="form-control" id="test_method_for_tensile_properties_in_warp" name="test_method_for_tensile_properties_in_warp" value="ISO 105 X12">

      </div>



     <div class="col-sm-1 text-center">
                 <!-- Gap Creation -->
      </div>

         
     <div class="col-sm-2" for="value">

            <input type="text" class="form-control" id="tensile_properties_in_warp_value" name="tensile_properties_in_warp_value" placeholder="Enter Value"   style="color:#00008B; margin-top:23px;">

     </div>

              <input type="hidden" id="uom_of_tensile_properties_in_warp" name="uom_of_tensile_properties_in_warp"  value="uom_of_tensile_properties_in_warp">

   
            
  </div><!-- End of <div class="form-group form-group-sm" tensile_properties_in_warp -->



     


   <div class="form-group form-group-sm">
       


      <div class="col-sm-3 text-center">
         <label class="hidden" for="tensile_properties_in_weft" style="color:#00008B;"><span id="for_tensile_properties_in_weft_test_name_label" style="display: none;">Tensile Properties <span id="tensile_properties_in_weft_test_method" style="display: none;"></span></label>
      </div>

      <div class="col-sm-1 text-center">
                 <!-- Gap Creation -->
      </div>  
       
       <div class="col-sm-2 text-center">
                <!-- <label for="description_or_type" style="font-size:12px; color:#000066;">Description/Type</label> -->
                <label class="control-label" for="description_or_type" style="color:#00008B;"> Weft </label>
                <input type="hidden" class="form-control" id="test_method_for_tensile_properties_in_weft" name="test_method_for_tensile_properties_in_weft" value="ISO 105 X12">
                
      </div>

           
      <div class="col-sm-1 text-center">
                 <!-- Gap Creation -->
      </div>   
              
      <div class="col-sm-2" for="value">

            <input type="text" class="form-control" id="tensile_properties_in_weft_value" name="tensile_properties_in_weft_value" placeholder="Enter  Value">

       </div>

  
            <input type="hidden" id="uom_of_tensile_properties_in_weft" name="uom_of_tensile_properties_in_weft"  value="uom_of_tensile_properties_in_weft">

            

     </div><!-- End of <div class="form-group form-group-sm" tensile_properties_in_weft -->

     
  </div>     <!--  End of <div id="div_tensile_properties" style="display: none"> -->



  <div id="div_tear_force" style="display: none;">


   <div class="form-group form-group-sm">
        

      <div class="col-sm-3 text-center">
         <label class="control-label" for="tear_force_in_warp" style="color:#00008B; margin-top:23px;"><span id="for_tear_force_in_warp_test_name_label">Tear Force</span> <span id="tear_force_in_warp_test_method"></span></label>
      </div>


       <div class="col-sm-1 text-center">
                 <!-- Gap Creation -->
       </div>

       
      <div class="col-sm-2 text-center">
                <!-- <label for="description_or_type" style="font-size:12px; color:#000066;">Description/Type</label> -->
                <label class="control-label" for="description_or_type" style="color:#00008B; margin-top:23px;"> Warp</label>
                <input type="hidden" class="form-control" id="test_method_for_tear_force_in_warp" name="test_method_for_tear_force_in_warp" value="ISO 105 X12">

      </div>



     <div class="col-sm-1 text-center">
                 <!-- Gap Creation -->
      </div>

         
     <div class="col-sm-2" for="value">

            <input type="text" class="form-control" id="tear_force_in_warp_value" name="tear_force_in_warp_value" placeholder="Enter Value"   style="color:#00008B; margin-top:23px;">

     </div>

              <input type="hidden" id="uom_of_tear_force_in_warp" name="uom_of_tear_force_in_warp"  value="uom_of_tear_force_in_warp">

   
            
  </div><!-- End of <div class="form-group form-group-sm" tear_force_in_warp -->

<div class="form-group form-group-sm">
       


      <div class="col-sm-3 text-center">
         <label class="hidden" for="tear_force_in_weft" style="color:#00008B;"><span id="for_tear_force_in_weft_test_name_label" style="display: none;">Tear Force <span id="tear_force_in_weft_test_method" style="display: none;"></span></label>
      </div>

      <div class="col-sm-1 text-center">
                 <!-- Gap Creation -->
      </div>  
       
       <div class="col-sm-2 text-center">
                <!-- <label for="description_or_type" style="font-size:12px; color:#000066;">Description/Type</label> -->
                <label class="control-label" for="description_or_type" style="color:#00008B;"> Weft </label>
                <input type="hidden" class="form-control" id="test_method_for_tear_force_in_weft" name="test_method_for_tear_force_in_weft" value="ISO 105 X12">
                
      </div>

           
      <div class="col-sm-1 text-center">
                 <!-- Gap Creation -->
      </div>   
              
      <div class="col-sm-2" for="value">

            <input type="text" class="form-control" id="tear_force_in_weft_value" name="tear_force_in_weft_value" placeholder="Enter  Value">

       </div>

  
            <input type="hidden" id="uom_of_tear_force_in_weft" name="uom_of_tear_force_in_weft"  value="uom_of_tear_force_in_weft">

            

     </div><!-- End of <div class="form-group form-group-sm" tear_force_in_weft -->

     


  </div>     <!--  End of <div id="div_tear_force" style="display: none"> -->




 <div id="div_seam_slippage" style="display: none;">


   <div class="form-group form-group-sm">
        

      <div class="col-sm-3 text-center">
         <label class="control-label" for="seam_slippage_resistance_in_warp" style="color:#00008B; margin-top:23px;"><span id="for_seam_slippage_resistance_in_warp_test_name_label">Seam Slippage</span> <span id="seam_slippage_resistance_in_warp_test_method"></span></label>
      </div>


       <div class="col-sm-1 text-center">
                 <!-- Gap Creation -->
       </div>

       
      <div class="col-sm-2 text-center">
                <!-- <label for="description_or_type" style="font-size:12px; color:#000066;">Description/Type</label> -->
                <label class="control-label" for="description_or_type" style="color:#00008B; margin-top:23px;"> Warp</label>
                <input type="hidden" class="form-control" id="test_method_for_seam_slippage_resistance_in_warp" name="test_method_for_seam_slippage_resistance_in_warp" value="ISO 105 X12">

      </div>



     <div class="col-sm-1 text-center">
                 <!-- Gap Creation -->
      </div>

         
     <div class="col-sm-2" for="value">

            <input type="text" class="form-control" id="seam_slippage_resistance_in_warp_value" name="seam_slippage_resistance_in_warp_value" placeholder="Enter Value"   style="color:#00008B; margin-top:23px;">

     </div>

              <input type="hidden" id="uom_of_seam_slippage_resistance_in_warp" name="uom_of_seam_slippage_resistance_in_warp"  value="uom_of_seam_slippage_resistance_in_warp">

   
            
  </div><!-- End of <div class="form-group form-group-sm" seam_slippage_resistance_in_warp -->



     


   <div class="form-group form-group-sm">
       


      <div class="col-sm-3 text-center">
         <label class="hidden" for="seam_slippage_resistance_in_weft" style="color:#00008B;"><span id="for_seam_slippage_resistance_in_weft_test_name_label" style="display: none;">Seam Slippage <span id="seam_slippage_resistance_in_weft_test_method" style="display: none;"></span></label>
      </div>

      <div class="col-sm-1 text-center">
                 <!-- Gap Creation -->
      </div>  
       
       <div class="col-sm-2 text-center">
                <!-- <label for="description_or_type" style="font-size:12px; color:#000066;">Description/Type</label> -->
                <label class="control-label" for="description_or_type" style="color:#00008B;"> Weft </label>
                <input type="hidden" class="form-control" id="test_method_for_seam_slippage_resistance_in_weft" name="test_method_for_seam_slippage_resistance_in_weft" value="ISO 105 X12">
                
      </div>

           
      <div class="col-sm-1 text-center">
                 <!-- Gap Creation -->
      </div>   
              
      <div class="col-sm-2" for="value">

            <input type="text" class="form-control" id="seam_slippage_resistance_in_weft_value" name="seam_slippage_resistance_in_weft_value" placeholder="Enter  Value">

       </div>

  
            <input type="hidden" id="uom_of_seam_slippage_resistance_in_weft" name="uom_of_seam_slippage_resistance_in_weft"  value="uom_of_seam_slippage_resistance_in_weft">

            

     </div><!-- End of <div class="form-group form-group-sm" seam_slippage_resistance_in_weft -->



     <div class="form-group form-group-sm">
        

      <div class="col-sm-3 text-center">
         <label class="control-label" for="seam_slippage_resistance_iso_2_in_warp" style="color:#00008B; margin-top:23px;"><span id="for_seam_slippage_resistance_iso_2_in_warp_test_name_label">Seam Slippage</span> <span id="seam_slippage_resistance_iso_2_in_warp_test_method"></span></label>
      </div>


       <div class="col-sm-1 text-center">
                 <!-- Gap Creation -->
       </div>

       
      <div class="col-sm-2 text-center">
                <!-- <label for="description_or_type" style="font-size:12px; color:#000066;">Description/Type</label> -->
                <label class="control-label" for="description_or_type" style="color:#00008B; margin-top:23px;"> Warp</label>
                <input type="hidden" class="form-control" id="test_method_for_seam_slippage_resistance_iso_2_in_warp" name="test_method_for_seam_slippage_resistance_iso_2_in_warp" value="ISO 105 X12">

      </div>



     <div class="col-sm-1 text-center">
                 <!-- Gap Creation -->
      </div>

         
     <div class="col-sm-2" for="value">

            <input type="text" class="form-control" id="seam_slippage_resistance_iso_2_in_warp_value" name="seam_slippage_resistance_iso_2_in_warp_value" placeholder="Enter Value"   style="color:#00008B; margin-top:23px;">

     </div>

              <input type="hidden" id="uom_of_seam_slippage_resistance_iso_2_in_warp" name="uom_of_seam_slippage_resistance_iso_2_in_warp"  value="uom_of_seam_slippage_resistance_iso_2_in_warp">

   
            
  </div><!-- End of <div class="form-group form-group-sm" seam_slippage_resistance_iso_2_in_warp -->



     


   <div class="form-group form-group-sm">
       


      <div class="col-sm-3 text-center">
         <label class="hidden" for="seam_slippage_resistance_iso_2_in_weft" style="color:#00008B;"><span id="for_seam_slippage_resistance_iso_2_in_weft_test_name_label" style="display: none;">Seam Slippage <span id="seam_slippage_resistance_iso_2_in_weft_test_method" style="display: none;"></span></label>
      </div>

      <div class="col-sm-1 text-center">
                 <!-- Gap Creation -->
      </div>  
       
       <div class="col-sm-2 text-center">
                <!-- <label for="description_or_type" style="font-size:12px; color:#000066;">Description/Type</label> -->
                <label class="control-label" for="description_or_type" style="color:#00008B;"> Weft </label>
                <input type="hidden" class="form-control" id="test_method_for_seam_slippage_resistance_iso_2_in_weft" name="test_method_for_seam_slippage_resistance_iso_2_in_weft" value="ISO 105 X12">
                
      </div>

           
      <div class="col-sm-1 text-center">
                 <!-- Gap Creation -->
      </div>   
              
      <div class="col-sm-2" for="value">

            <input type="text" class="form-control" id="seam_slippage_resistance_iso_2_in_weft_value" name="seam_slippage_resistance_iso_2_in_weft_value" placeholder="Enter  Value">

       </div>

  
            <input type="hidden" id="uom_of_seam_slippage_resistance_iso_2_in_weft" name="uom_of_seam_slippage_resistance_iso_2_in_weft"  value="uom_of_seam_slippage_resistance_iso_2_in_weft">

            

     </div><!-- End of <div class="form-group form-group-sm" seam_slippage_resistance_iso_2_in_weft -->

     


 </div>     <!--  End of <div id="div_seam_slippage" style="display: none"> -->




<div id="div_seam_strength" style="display: none;">


   <div class="form-group form-group-sm">
        

      <div class="col-sm-3 text-center">
         <label class="control-label" for="seam_strength_in_warp" style="color:#00008B; margin-top:23px;"><span id="for_seam_strength_in_warp_test_name_label">Seam Strength</span> <span id="seam_strength_in_warp_test_method"></span></label>
      </div>


       <div class="col-sm-1 text-center">
                 <!-- Gap Creation -->
       </div>

       
      <div class="col-sm-2 text-center">
                <!-- <label for="description_or_type" style="font-size:12px; color:#000066;">Description/Type</label> -->
                <label class="control-label" for="description_or_type" style="color:#00008B; margin-top:23px;"> Warp</label>
                <input type="hidden" class="form-control" id="test_method_for_seam_strength_in_warp" name="test_method_for_seam_strength_in_warp" value="ISO 105 X12">

      </div>



     <div class="col-sm-1 text-center">
                 <!-- Gap Creation -->
      </div>

         
     <div class="col-sm-2" for="value">

            <input type="text" class="form-control" id="seam_strength_in_warp_value" name="seam_strength_in_warp_value" placeholder="Enter Value"   style="color:#00008B; margin-top:23px;">

     </div>

              <input type="hidden" id="uom_of_seam_strength_in_warp" name="uom_of_seam_strength_in_warp"  value="uom_of_seam_strength_in_warp">

   
            
  </div><!-- End of <div class="form-group form-group-sm" seam_strength_in_warp -->



     


   <div class="form-group form-group-sm">
       


      <div class="col-sm-3 text-center">
         <label class="hidden" for="seam_strength_in_weft" style="color:#00008B;"><span id="for_seam_strength_in_weft_test_name_label" style="display: none;">Seam Strength <span id="seam_strength_in_weft_test_method" style="display: none;"></span></label>
      </div>

      <div class="col-sm-1 text-center">
                 <!-- Gap Creation -->
      </div>  
       
       <div class="col-sm-2 text-center">
                <!-- <label for="description_or_type" style="font-size:12px; color:#000066;">Description/Type</label> -->
                <label class="control-label" for="description_or_type" style="color:#00008B;"> Weft </label>
                <input type="hidden" class="form-control" id="test_method_for_seam_strength_in_weft" name="test_method_for_seam_strength_in_weft" value="ISO 105 X12">
                
      </div>

           
      <div class="col-sm-1 text-center">
                 <!-- Gap Creation -->
      </div>   
              
      <div class="col-sm-2" for="value">

            <input type="text" class="form-control" id="seam_strength_in_weft_value" name="seam_strength_in_weft_value" placeholder="Enter  Value">

       </div>

  
            <input type="hidden" id="uom_of_seam_strength_in_weft" name="uom_of_seam_strength_in_weft"  value="uom_of_seam_strength_in_weft">

            

     </div><!-- End of <div class="form-group form-group-sm" seam_strength_in_weft -->

     


  </div>     <!--  End of <div id="div_seam_strength" style="display: none"> -->




<div id="div_seam_properties" style="display: none;">


   <div class="form-group form-group-sm">
        

      <div class="col-sm-3 text-center">
         <label class="control-label" for="seam_properties_seam_slippage_iso_astm_d_in_warp" style="color:#00008B; margin-top:23px;"><span id="for_seam_properties_seam_slippage_iso_astm_d_in_warp_test_name_label">Seam Properties</span> <span id="seam_properties_seam_slippage_iso_astm_d_in_warp_test_method"></span></label>
      </div>


       <div class="col-sm-1 text-center">
                 <!-- Gap Creation -->
       </div>

       
      <div class="col-sm-2 text-center">
                <!-- <label for="description_or_type" style="font-size:12px; color:#000066;">Description/Type</label> -->
                <label class="control-label" for="description_or_type" style="color:#00008B; margin-top:23px;"> Warp(Seam Slippage) </label>
                <input type="hidden" class="form-control" id="test_method_for_seam_properties_seam_slippage_iso_astm_d_in_warp" name="test_method_for_seam_properties_seam_slippage_iso_astm_d_in_warp" value="ISO 105 X12">

      </div>



     <div class="col-sm-1 text-center">
                 <!-- Gap Creation -->
      </div>

         
     <div class="col-sm-2" for="value">

            <input type="text" class="form-control" id="seam_properties_seam_slippage_iso_astm_d_in_warp_value" name="seam_properties_seam_slippage_iso_astm_d_in_warp_value" placeholder="Enter Value"   style="color:#00008B; margin-top:23px;">

     </div>

              <input type="hidden" id="uom_of_seam_properties_seam_slippage_iso_astm_d_in_warp" name="uom_of_seam_properties_seam_slippage_iso_astm_d_in_warp"  value="uom_of_seam_properties_seam_slippage_iso_astm_d_in_warp">

   
            
  </div><!-- End of <div class="form-group form-group-sm" seam_properties_seam_slippage_iso_astm_d_in_warp -->



     


   <div class="form-group form-group-sm">
       


      <div class="col-sm-3 text-center">
         <label class="hidden" for="seam_properties_seam_slippage_iso_astm_d_in_weft" style="color:#00008B;"><span id="for_seam_properties_seam_slippage_iso_astm_d_in_weft_test_name_label" style="display: none;">Seam Properties <span id="seam_properties_seam_slippage_iso_astm_d_in_weft_test_method" style="display: none;"></span></label>
      </div>

      <div class="col-sm-1 text-center">
                 <!-- Gap Creation -->
      </div>  
       
       <div class="col-sm-2 text-center">
                <!-- <label for="description_or_type" style="font-size:12px; color:#000066;">Description/Type</label> -->
                <label class="control-label" for="description_or_type" style="color:#00008B;"> Weft(Seam Slippage)</label>
                <input type="hidden" class="form-control" id="test_method_for_seam_properties_seam_slippage_iso_astm_d_in_weft" name="test_method_for_seam_properties_seam_slippage_iso_astm_d_in_weft" value="ISO 105 X12">
                
      </div>

           
      <div class="col-sm-1 text-center">
                 <!-- Gap Creation -->
      </div>   
              
      <div class="col-sm-2" for="value">

            <input type="text" class="form-control" id="seam_properties_seam_slippage_iso_astm_d_in_weft_value" name="seam_properties_seam_slippage_iso_astm_d_in_weft_value" placeholder="Enter  Value">

       </div>

  
            <input type="hidden" id="uom_of_seam_properties_seam_slippage_iso_astm_d_in_weft" name="uom_of_seam_properties_seam_slippage_iso_astm_d_in_weft"  value="uom_of_seam_properties_seam_slippage_iso_astm_d_in_weft">

            

     </div><!-- End of <div class="form-group form-group-sm" seam_properties_seam_slippage_iso_astm_d_in_weft -->



   <div class="form-group form-group-sm">
        

      <div class="col-sm-3 text-center">
         <label class="control-label" for="seam_properties_seam_strength_iso_astm_d_in_warp" style="color:#00008B; margin-top:23px;"><span id="for_seam_properties_seam_strength_iso_astm_d_in_warp_test_name_label">Seam Properties</span> <span id="seam_properties_seam_strength_iso_astm_d_in_warp_test_method"></span></label>
      </div>


       <div class="col-sm-1 text-center">
                 <!-- Gap Creation -->
       </div>

       
      <div class="col-sm-2 text-center">
                <!-- <label for="description_or_type" style="font-size:12px; color:#000066;">Description/Type</label> -->
                <label class="control-label" for="description_or_type" style="color:#00008B; margin-top:23px;"> Warp(Seam Strength) </label>
                <input type="hidden" class="form-control" id="test_method_for_seam_properties_seam_strength_iso_astm_d_in_warp" name="test_method_for_seam_properties_seam_strength_iso_astm_d_in_warp" value="ASTM D 1683">

      </div>



     <div class="col-sm-1 text-center">
                 <!-- Gap Creation -->
      </div>

         
     <div class="col-sm-2" for="value">

            <input type="text" class="form-control" id="seam_properties_seam_strength_iso_astm_d_in_warp_value" name="seam_properties_seam_strength_iso_astm_d_in_warp_value" placeholder="Enter Value"   style="color:#00008B; margin-top:23px;">

     </div>

              <input type="hidden" id="uom_of_seam_properties_seam_strength_iso_astm_d_in_warp" name="uom_of_seam_properties_seam_strength_iso_astm_d_in_warp"  value="uom_of_seam_properties_seam_strength_iso_astm_d_in_warp">

   
            
  </div><!-- End of <div class="form-group form-group-sm" seam_properties_seam_strength_iso_astm_d_in_warp -->



     


   <div class="form-group form-group-sm">
       


      <div class="col-sm-3 text-center">
         <label class="hidden" for="seam_properties_seam_strength_iso_astm_d_in_weft" style="color:#00008B;"><span id="for_seam_properties_seam_strength_iso_astm_d_in_weft_test_name_label" style="display: none;">Seam Properties <span id="seam_properties_seam_strength_iso_astm_d_in_weft_test_method" style="display: none;"></span></label>
      </div>

      <div class="col-sm-1 text-center">
                 <!-- Gap Creation -->
      </div>  
       
       <div class="col-sm-2 text-center">
                <!-- <label for="description_or_type" style="font-size:12px; color:#000066;">Description/Type</label> -->
                <label class="control-label" for="description_or_type" style="color:#00008B;"> Weft(Seam Strength)</label>
                <input type="hidden" class="form-control" id="test_method_for_seam_properties_seam_strength_iso_astm_d_in_weft" name="test_method_for_seam_properties_seam_strength_iso_astm_d_in_weft" value="ASTM D 1683">
                
      </div>

           
      <div class="col-sm-1 text-center">
                 <!-- Gap Creation -->
      </div>   
              
      <div class="col-sm-2" for="value">

            <input type="text" class="form-control" id="seam_properties_seam_strength_iso_astm_d_in_weft_value" name="seam_properties_seam_strength_iso_astm_d_in_weft_value" placeholder="Enter  Value">

       </div>

  
            <input type="hidden" id="uom_of_seam_properties_seam_strength_iso_astm_d_in_weft" name="uom_of_seam_properties_seam_strength_iso_astm_d_in_weft"  value="uom_of_seam_properties_seam_strength_iso_astm_d_in_weft">

            

     </div><!-- End of <div class="form-group form-group-sm" seam_properties_seam_strength_iso_astm_d_in_weft -->     


  </div>     <!--  End of <div id="div_seam_properties_seam_slippage_iso_astm_d" style="display: none"> -->



     


					
                        <div class="form-group form-group-sm" id="form-group_for_hand_feel">
				            <label class="control-label col-sm-3" for="hand_feel" style="margin-right:15px;color:#00008B;">Hand Feel:</label>
				                <input type="radio" class="form-check-input"  value="OK" id="hand_feel" name="hand_feel">
				                <label class="form-check-label control-label" for="hand_feel" style="margin-right:15px;">OK</label>
				                <input type="radio" class="form-check-input"  value="Not OK" id="hand_feel" name="hand_feel">
				                <label class="form-check-label control-label" for="hand_feel" style="margin-right:15px;">Not OK</label>
				            </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_hand_feel"> -->

						<div class="form-group form-group-sm" id="form-group_for_status">
						<label class="control-label col-sm-3" for="status" style="margin-right:15px;color:#00008B;">Status:</label>
								<input type="radio" class="form-check-input"  value="OK" id="status" name="status" checked>
								<label class="form-check-label control-label" for="status" style="margin-right:15px;">OK</label>
								<input type="radio" class="form-check-input"  value="Not OK" id="status" name="status">
								<label class="form-check-label control-label" for="status" style="margin-right:15px;">Not OK</label>
						</div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_status"> -->

							
						<div class="form-group form-group-sm" id="form-group_for_remarks">
								<label class="control-label col-sm-3" for="remarks" style="color:#00008B;">Remarks:</label>
								<div class="col-sm-6">
									<textarea class='form-control' id='remarks' name='remarks' rows='5' placeholder="Enter Remarks"></textarea>
								</div>
						</div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_remarks"> -->

						<div class="form-group form-group-sm" id="form-group_for_current_state">
						<label class="control-label col-sm-3" for="current_state" style="margin-right:15px;color:#00008B;">NOTE(IS IT A LAST PROCESS):</label>
								<input type="radio" class="form-check-input"  value="PP Completed" id="current_state" name="current_state">
								<label class="form-check-label control-label" for="current_state" style="margin-right:15px;">Yes</label>
								<input type="radio" class="form-check-input"  value="PP in progress" id="current_state" name="current_state" checked>
								<label class="form-check-label control-label" for="current_state" style="margin-right:15px;">No</label>
						</div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_current_state"> -->
                     
						<div class="form-group form-group-sm">
								<div class="col-sm-offset-3 col-sm-6">
									<button type="button" class="btn btn-primary" onClick="sending_data_of_qc_result_for_calendering_process_form_for_saving_in_database()">Submit</button>
									<button type="reset" class="btn btn-success">Reset</button>
								</div>
						</div>

				</form>
		</body>
		</div> <!-- Finish element -->
		        <div id="edit_test_report" style="display: none;">
					<button type="button" class="btn btn-success">Edit Report</button>
				</div>


		</div> <!-- End of <div class="panel panel-default"> -->

</div> <!-- End of <div class="col-sm-12 col-md-12 col-lg-12"> -->