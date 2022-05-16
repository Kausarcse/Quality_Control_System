<?php

session_start();
require_once("../login/session.php");
include('../login/db_connection_class.php');
$obj = new DB_Connection_Class();
$obj->connection();


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


$trf_pp_number= $result_for_trf['pp_number'];
$trf_process_name= $result_for_trf['process_name'];
$trf_version_name= $result_for_trf['version_name'];
// echo $trf_style= $result_for_trf['style'];
// echo $trf_design= $result_for_trf['design'];
$trf_color= $result_for_trf['color'];
$trf_finish_width_in_inch= $result_for_trf['finish_width_in_inch'];


// $sql_qc_ready_for_printing="select id from qc_result_for_ready_for_printing_process where pp_number = '$trf_pp_number'";
// $res_sql_qc_ready_for_printing=mysqli_query($con,$sql_qc_ready_for_printing) or die(mysqli_error($con));
// $row_for_id=mysqli_fetch_assoc($res_sql_qc_ready_for_printing);

// $ready_for_printing_id = $row_for_id['id'];


$sql_for_ready_for_printing="select * from qc_result_for_ready_for_printing_process where pp_number = '$trf_pp_number' and 
standard_for_which_process = '$trf_process_name' and version_number = '$trf_version_name' and color = '$trf_color' and 
finish_width_in_inch = '$trf_finish_width_in_inch'";
$result_for_ready_for_printing= mysqli_query($con,$sql_for_ready_for_printing) or die(mysqli_error($con));
$row_for_ready_for_printing = mysqli_fetch_array( $result_for_ready_for_printing);


?>



<script type='text/javascript' src='process_qc_result/qc_result_for_ready_for_printing_process_form_validation.js'></script>

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
	var db_table_name="defining_qc_standard_for_ready_for_printing_process";
    var value_for_data= 'pp_number_value='+pp_number &'table_name='+db_table_name;


            $.ajax({
			 		url: 'process_qc_result/returning_version_number_details_for_qc_result.php',
			 		dataType: 'text',
			 		type: 'post',
			 		contentType: 'application/x-www-form-urlencoded',
			 		data:  {pp_number_value:pp_number,table_name:db_table_name},
			 		      
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
*/  
  document.getElementById('color').value=splitted_version_details[1];
  document.getElementById('finish_width_in_inch').value=splitted_version_details[2]; 
  document.getElementById('customer_name').value=splitted_version_details[3]; 
  document.getElementById('standard_for_which_process').value='Ready For Printing'; 

}/* End of function fill_up_qc_standard_additional_info(version_details)*/
 function sending_data_of_qc_result_for_ready_for_printing_process_form_for_saving_in_database()
 {


       var validate = Ready_For_Printing_Form_Validation();
       var url_encoded_form_data = $("#qc_result_for_ready_for_printing_process_form").serialize(); //This will read all control elements value of the form	
       if(validate != false)
	   {


		  	 $.ajax({
			 		url: 'process_qc_result/edit_qc_result_for_ready_for_printing_process_saving.php',
			 		dataType: 'text',
			 		type: 'post',
			 		contentType: 'application/x-www-form-urlencoded',
			 		data: url_encoded_form_data,
			 		success: function( data, textStatus, jQxhr )
			 		{
			 				alert(data);
			 				if(data=='Data is successfully updated.')
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
			 					/*$('#edit_test_report').show();*/
			 				}
			 		},
			 		error: function( jqXhr, textStatus, errorThrown )
			 		{
			 				//console.log( errorThrown );
			 				alert(errorThrown);
			 		}
			 }); // End of $.ajax({

       }//End of if(validate != false)

 }//End of function sending_data_of_qc_result_for_ready_for_printing_process_form_for_saving_in_database()

</script>
<div class="col-sm-12 col-md-12 col-lg-12">

		<div class="panel panel-default"> <!-- This div will create a block/panel for FORM -->

			<body id="target">
           	 <div id="element">

				<div class="panel-heading" style="color:#191970;"><b>Qc Result For Ready For Printing Process / <a href="#">Edit</a></b></div> <!-- This will create a upper block for FORM (Just Beautification) -->

				<form class="form-horizontal" action="" style="margin-top:10px;" name="qc_result_for_ready_for_printing_process_form" id="qc_result_for_ready_for_printing_process_form">

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


						<div class="form-group form-group-sm" id="form-group_for_total_quantity_in_meter">
								<label class="control-label col-sm-3" for="total_quantity_in_meter" style="color:#00008B;">Total Quantity In Meter:</label>
								<div class="col-sm-5" style="padding-right:4px;">
									<input type="text" class="form-control" id="total_quantity_in_meter" name="total_quantity_in_meter" value="<?php if (isset($result_for_trf['pp_quantity'])) echo $result_for_trf['pp_quantity']?>" placeholder="Enter Total Quantity In Meter" readonly required>
								</div>
						</div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_"> -->

							<div class="form-group form-group-sm" id="form-group_for_short_or_excess_in_percentage">
								<label class="control-label col-sm-3" for="short_or_excess_in_percentage" style="color:#00008B;">Short Or Excess In Percentage:</label>
								<div class="col-sm-5" style="padding-right:4px;">
									<input type="text" class="form-control" id="short_or_excess_in_percentage" name="short_or_excess_in_percentage" value="<?php if (isset($result_for_trf['short_excess'])) echo $result_for_trf['short_excess']?> %" placeholder="Enter Short Or Excess In Percentage" readonly required>
								</div>
						</div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_"> -->

					<!-- 	<div class="form-group form-group-sm" id="form-group_for_total_short_or_excess_in_percentage">
								<label class="control-label col-sm-3" for="total_short_or_excess_in_percentage" style="color:#00008B;">Total Short Or Excess In Percentage:</label>
								<div class="col-sm-5" style="padding-right:4px;">
									<input type="text" class="form-control" id="total_short_or_excess_in_percentage" name="total_short_or_excess_in_percentage" placeholder="Enter Total Short Or Excess In Percentage" required>
								</div>
						</div> --> <!-- End of <div class="form-group form-group-sm" id="form-group_for_"> -->

						<div class="form-group form-group-sm" id="form-group_for_machine_name">
								<label class="control-label col-sm-3" for="machine_name" style="color:#00008B;">Machine Name:</label>
								<div class="col-sm-5" style="padding-right:4px;">
									<input type="text" class="form-control" id="machine_name" name="machine_name" value="<?php if (isset($result_for_trf['machine_name'])) echo $result_for_trf['machine_name']?>" placeholder="Enter Machine Name" readonly required>
								</div>
						</div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_"> -->


							                                       <!-- Start of Test Result Entry -->




						<div class="form-group form-group-sm" id="form-group_for_whiteness_value">

			              <label class="control-label col-sm-3" for="whiteness_value" style="color:#00008B; margin-top:23px;"><span id="for_whiteness_value_test_name_label">Whiteness-Berger :</span></label>
			              
			              <div class="col-sm-2 text-center">
			                <label for="whiteness_value" style="font-size:12px; color:#000066;">Left</label>
			                <input type="text" class="form-control" id="whiteness_left_value" name="whiteness_left_value" value="<?php echo $row_for_ready_for_printing['whiteness_left_value'] ?>" style="padding-right:4px;" required>
			              </div>
			              
			              
			              <div class="col-sm-2 text-center">
			                <label for="whiteness_value" style="font-size:12px; color:#000066;">Center</label>
			                <input type="text" class="form-control" id="whiteness_center_value" name="whiteness_center_value" value="<?php echo $row_for_ready_for_printing['whiteness_center_value'] ?>" style="padding-right:4px;" required>
			              </div>

			              <div class="col-sm-2 text-center">
			                <label for="whiteness_value" style="font-size:12px; color:#000066;">Right</label>
			                <input type="text" class="form-control" id="whiteness_right_value" name="whiteness_right_value" value="<?php echo $row_for_ready_for_printing['whiteness_right_value'] ?>" style="padding-right:4px;" required>
			              </div>

			           
			          </div>  <!-- End <div class="form-group form-group-sm" id="form-group_for_whiteness_value"> -->

            <div class="form-group form-group-sm" id="form-group_for_uom_of_whiteness">
                <!-- <label class="control-label col-sm-3" for="uom_of_whiteness" style="color:#00008B;">Uom Of Whiteness</sup>:</label> -->
                <div class="col-sm-6" style="padding-right:4px;">
                  <input type="hidden" class="form-control" id="uom_of_whiteness" name="uom_of_whiteness" placeholder="Enter Uom Of whiteness" value="(°)">
                </div>
            </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_"> -->



			          	<div class="form-group form-group-sm" id="form-group_for_bowing_and_skew">
			                <label class="control-label col-sm-3" for="bowing_and_skew" style="color:#00008B;"><span id="for_bowing_and_skew_test_name_label">Bowing and Skew</span><span id="for_bowing_and_skew_test_method"> (ISO 2819): </label>
			                <div class="col-sm-6" style="padding-right:4px;">
			                  <input type="text" class="form-control" id="bowing_and_skew_value" name="bowing_and_skew_value" value="<?php echo $row_for_ready_for_printing['bowing_and_skew_value'] ?>" required>
			                </div>
			            </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_"> -->

						
                        <div class="form-group form-group-sm" id="form-group_for_uom_of_bowing_and_skew">
			                <!-- <label class="control-label col-sm-3" for="uom_of_bowing_and_skew" style="color:#00008B;">Uom Bowing and Skew:</label> -->
			                <div class="col-sm-6" style="padding-right:4px;">
			                  <input type="hidden" class="form-control" id="uom_of_bowing_and_skew" name="uom_of_bowing_and_skew" placeholder="Enter Uom Of Bowing Skew" value="%">
			                </div>
			            </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_"> -->


						<div class="form-group form-group-sm" id="form-group_for_ph_value">

				              <label class="control-label col-sm-3" for="ph_value" style="color:#00008B; margin-top:23px;"><span id="for_ph_value_test_name_label">P<sup>H</sup></span><span id="for_ph_value_test_name_label"> (Drop Test Method):</span></label>
				              
				              <div class="col-sm-2 text-center">
				                <label for="whiteness_value" style="font-size:12px; color:#000066;">Left</label>
				                <input type="text" class="form-control" id="ph_left_value" name="ph_left_value" value="<?php echo $row_for_ready_for_printing['ph_left_value'] ?>" style="padding-right:4px;" required>
				              </div>
				              
				              
				              <div class="col-sm-2 text-center">
				                <label for="whiteness_value" style="font-size:12px; color:#000066;">Center</label>
				                <input type="text" class="form-control" id="ph_center_value" name="ph_center_value"  value="<?php echo $row_for_ready_for_printing['ph_center_value'] ?>" style="padding-right:4px;" required>
				              </div>

				              <div class="col-sm-2 text-center">
				                <label for="whiteness_value" style="font-size:12px; color:#000066;">Right</label>
				                <input type="text" class="form-control" id="ph_right_value" name="ph_right_value"  value="<?php echo $row_for_ready_for_printing['ph_right_value'] ?>" style="padding-right:4px;" required>
				              </div>

				           
				          </div>  <!-- End <div class="form-group form-group-sm" id="form-group_for_whiteness_value"> -->


				          	<div class="form-group form-group-sm" id="form-group_for_uom_of_ph">
				                <!-- <label class="control-label col-sm-3" for="uom_of_ph" style="color:#00008B;">Uom Of P<sup>H</sup>:</label> -->
				                <div class="col-sm-6" style="padding-right:4px;">
				                  <input type="hidden" class="form-control" id="uom_of_ph" name="uom_of_ph" placeholder="Enter Uom Of PH" required>
				                </div>
				            </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_"> -->



						<div class="form-group form-group-sm" id="form-group_for_status">
						<label class="control-label col-sm-3" for="status" style="margin-right:15px;color:#00008B;">Status:</label>
								<input type="radio" class="form-check-input"  value="OK" id="status" name="status" <?php if($row_for_ready_for_printing['status']=="OK"){ echo "checked";}?>>
								<label class="form-check-label control-label" for="status" style="margin-right:15px;">OK</label>
								<input type="radio" class="form-check-input"  value="Not OK" id="status" name="status" <?php if($row_for_ready_for_printing['status']=="Not OK"){ echo "checked";}?>>
								<label class="form-check-label control-label" for="status" style="margin-right:15px;">Not OK</label>
						</div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_status"> -->

						<div class="form-group form-group-sm" id="form-group_for_remarks">
								<label class="control-label col-sm-3" for="remarks" style="color:#00008B;">Remarks:</label>
								<div class="col-sm-6">
									<textarea class='form-control' id='remarks' name='remarks' rows='5' value="<?php echo $row_for_ready_for_printing['remarks'] ?>"><?php echo $row_for_ready_for_printing['remarks'] ?></textarea>
								</div>
						</div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_remarks"> -->

						<div class="form-group form-group-sm" id="form-group_for_current_state">
						   <label class="control-label col-sm-3" for="current_state" style="margin-right:15px;color:#00008B;">NOTE(IS IT A LAST PROCESS):</label>
								<input type="radio" class="form-check-input"  value="PP Completed" id="current_state" name="current_state" <?php if($row_for_ready_for_printing['current_state']=="PP Completed"){ echo "checked";}?>>
								<label class="form-check-label control-label" for="current_state" style="margin-right:15px;">Yes</label>
								<input type="radio" class="form-check-input"  value="PP in progress" id="current_state" name="current_state" <?php if($row_for_ready_for_printing['current_state']=="PP in progress"){ echo "checked";}?>>
								<label class="form-check-label control-label" for="current_state" style="margin-right:15px;">No</label>
						</div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_current_state"> -->

						<div class="form-group form-group-sm">
								<div class="col-sm-offset-3 col-sm-6">
									<button type="button" class="btn btn-primary" onClick="sending_data_of_qc_result_for_ready_for_printing_process_form_for_saving_in_database()">Save</button>
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