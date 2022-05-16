<?php
error_reporting(0);
session_start();
require_once("../login/session.php");
include('../login/db_connection_class.php');
$obj = new DB_Connection_Class();
$obj->connection();

$date = date("d-m-Y");


$user_name=$_SESSION['user_name'];

//$trf_id=$_GET['trf'];
 $all_data=$_GET['all_data'];
 //echo $all_data;
$split_all_data=explode("?fs?", $all_data);
//$split_all_data=preg_split("@[\s+　]@u", $all_data);;

$trf_id=$split_all_data[0];
$version_id=$split_all_data[1];
$pp_number=$split_all_data[2];
$process_id=$split_all_data[3];
$style_name=$split_all_data[4];
$finish_width_in_inch=$split_all_data[5];
$before_trolley_number_or_batcher_number=$split_all_data[6];
$after_trolley_number_or_batcher_number=$split_all_data[7];
$after_trolley_or_batcher_qty_direct=$split_all_data[8];


$sql_for_trf = "select * from partial_test_for_test_result_info ptftri
left join pp_wise_version_creation_info  pwvci on ptftri.pp_number=pwvci.pp_number and ptftri.version_id=pwvci.version_id and ptftri.style=pwvci.style_name and ptftri.finish_width_in_inch=pwvci.finish_width_in_inch
left join process_program_info ppi on ptftri.pp_number=ppi.pp_number
 where ptftri.trf_id='$trf_id' or (ptftri.version_id='$version_id' and ptftri.pp_number='$pp_number' and ptftri.process_id='$process_id'  and ptftri.`finish_width_in_inch`='$finish_width_in_inch' and ptftri.`before_trolley_number_or_batcher_number`='$before_trolley_number_or_batcher_number' and ptftri.`after_trolley_number_or_batcher_number`='$after_trolley_number_or_batcher_number')";


$result_for_trf= mysqli_query($con,$sql_for_trf) or die(mysqli_error($con));
$row_for_trf=mysqli_fetch_array($result_for_trf);

?>
<script type='text/javascript' src='process_program/process_program_info_form_validation.js'></script>

<style>

.form-group		/* This is for reducing Gap among Form's Fields */
{

	margin-bottom: 5px;

}
.row.no-gutter {
  margin-left: 0;
  margin-right: 0;
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




function approved_for_check()
{
         var checkbox = document.getElementById("approved_check");
         var waiting_for_folding = document.getElementById("div_waiting_for_folding");
         if(checkbox.checked == true)
         {
            waiting_for_folding.style.display = "block";
         }
         else{
            waiting_for_folding.style.display = "none";
         }
}


function rework_for_check()
{
         var checkbox = document.getElementById("rework_check");
         var waiting_for_rework = document.getElementById("div_waitnig_for_rework");
         if(checkbox.checked == true)
         {
            waiting_for_rework.style.display = "block";
         }
         else{
            waiting_for_rework.style.display = "none";
         }
}


function sending_data_of_approved_for_folding_form_for_saving_in_database()
 {
   var quantity_for_rework= $("#returing_quantity_for_folding").val();

    //  alert(quantity_for_rework);
       var url_encoded_form_data = $("#waiting_for_folding_form").serialize(); //This will read all control elements value of the form	
// alert(url_encoded_form_data);
		  	 $.ajax({
			 		url: 'inspection_and_folding/inspection_and_folding_info_saving.php',
			 		dataType: 'text',
			 		type: 'post',
			 		contentType: 'application/x-www-form-urlencoded',
			 		data: url_encoded_form_data,
			 		success: function( data, textStatus, jQxhr )
			 		{
			 				alert(data);
                            // console.log(data);
                            var for_returing_quantity = document.getElementById('returing_quantity_for_folding').value;
                            document.getElementById('quantity_for_rework').value = for_returing_quantity;
                            document.getElementById('for_folding').value = " ";
                            document.getElementById('returing_quantity_for_folding').value = " ";
                            // alert(for_returing_quantity);
                            if(for_returing_quantity >0)
                            {
                                $('#div_waitnig_for_rework').show();
                            }
                           
                             
			 		},
			 		error: function( jqXhr, textStatus, errorThrown )
			 		{
			 				//console.log( errorThrown );
			 				alert(errorThrown);
			 		}
			 }); // End of $.ajax({

       
       

 }//End of function sending_data_of_customer_form_for_saving_in_database()
 

 function sending_data_of_approved_for_rework_form_for_saving_in_database()
 {


       var url_encoded_form_data = $("#waiting_for_rework_form").serialize(); //This will read all control elements value of the form	

		  	 $.ajax({
			 		url: 'inspection_and_folding/inspection_and_folding_info_for_rework_saving.php',
			 		dataType: 'text',
			 		type: 'post',
			 		contentType: 'application/x-www-form-urlencoded',
			 		data: url_encoded_form_data,
			 		success: function( data, textStatus, jQxhr )
			 		{
			 				alert(data);


                             var quantity_for_rework = document.getElementById('quantity_for_rework').value;
                            document.getElementById('quantity_for_folding').value = quantity_for_rework;
                            // alert(for_returing_quantity);
                           document.getElementById('for_corrective_action_of_rework').value = "";
                            $('#div_waitnig_for_rework').hide();
                            $('#div_waiting_for_folding').show();
                            // $('#div_waiting_for_Re_folding').show();
			 		},
			 		error: function( jqXhr, textStatus, errorThrown )
			 		{
			 				//console.log( errorThrown );
			 				alert(errorThrown);
			 		}
			 }); // End of $.ajax({

 }//End of function sending_data_of_customer_form_for_saving_in_database()





</script>

                            <div class="col-sm-11" style="display: none;"  >
								<?php

						        
                               $version_number=$row_for_trf['version_number'];
                               $customer_name=$row_for_trf['customer_name'];
                              

	                                  $version_wise_process_name=$row_for_trf['process_name'];  
	                                  
	                                  
	                                  if($version_wise_process_name=='Bleaching')
	                                  {     
	                                  	     ?>
                                             <?php  $_GET['pp_number']=$row_for_trf['pp_number']; $_GET['version_number']=$row_for_trf['version_number']; $_GET['customer_name']=$row_for_trf['customer_name']; $_GET['style']=$row_for_trf['style'];  $_GET['finish_width_in_inch']=$row_for_trf['finish_width_in_inch'];$_GET['before_trolley_number_or_batcher_number']=$row_for_trf['before_trolley_number_or_batcher_number'];$_GET['after_trolley_number_or_batcher_number']=$row_for_trf['after_trolley_number_or_batcher_number'];   include('../report/pass_fail_report_for_bleaching_process.php'); ?> 



                                              <?php
                                              if($total_test == $p)
                                                  {
                                                     /* echo "pass";*/ echo "<script>$('#pass').show();</script>";
                                                  }
                                                 else
                                                 {
                                                 	echo "<script>$('#fail').show();</script>";
                                                 }
	                                  	
	                                  }/* End of  if($version_wise_process_name=='Bleaching')*/
	                                  if($version_wise_process_name=='Scouring')
	                                  {
                                       ?>
                                             <?php  $_GET['pp_number']=$row_for_trf['pp_number']; $_GET['version_number']=$row_for_trf['version_number']; $_GET['customer_name']=$row_for_trf['customer_name']; $_GET['style']=$row_for_trf['style'];  $_GET['finish_width_in_inch']=$row_for_trf['finish_width_in_inch'];$_GET['before_trolley_number_or_batcher_number']=$row_for_trf['before_trolley_number_or_batcher_number'];$_GET['after_trolley_number_or_batcher_number']=$row_for_trf['after_trolley_number_or_batcher_number'];   include('../report/pass_fail_report_for_scouring_process.php'); ?> 



                                              <?php
                                              if($total_test == $p)
                                                  {
                                                     /* echo "pass";*/ echo "<script>$('#pass').show();</script>";
                                                  }
                                                 else
                                                 {
                                                 	echo "<script>$('#fail').show();</script>";
                                                 }
	                                  }

	                                  

	                                  if($version_wise_process_name=='Calander')
	                                  {
                                       ?>
                                             <?php  $_GET['pp_number']=$row_for_trf['pp_number']; $_GET['version_number']=$row_for_trf['version_number']; $_GET['customer_name']=$row_for_trf['customer_name']; $_GET['style']=$row_for_trf['style'];  $_GET['finish_width_in_inch']=$row_for_trf['finish_width_in_inch'];$_GET['before_trolley_number_or_batcher_number']=$row_for_trf['before_trolley_number_or_batcher_number'];$_GET['after_trolley_number_or_batcher_number']=$row_for_trf['after_trolley_number_or_batcher_number'];   include('../report/pass_fail_report_for_calendering_process.php'); ?> 



                                              <?php
                                              if($total_test == $p)
                                                  {
                                                     /* echo "pass";*/ echo "<script>$('#pass').show();</script>";
                                                  }
                                                 else
                                                 {
                                                 	echo "<script>$('#fail').show();</script>";
                                                 }
	                                  }

	                                  if($version_wise_process_name=='Curing')
	                                  {
                                       ?>
                                             <?php  $_GET['pp_number']=$row_for_trf['pp_number']; $_GET['version_number']=$row_for_trf['version_number']; $_GET['customer_name']=$row_for_trf['customer_name']; $_GET['style']=$row_for_trf['style'];  $_GET['finish_width_in_inch']=$row_for_trf['finish_width_in_inch'];$_GET['before_trolley_number_or_batcher_number']=$row_for_trf['before_trolley_number_or_batcher_number'];$_GET['after_trolley_number_or_batcher_number']=$row_for_trf['after_trolley_number_or_batcher_number'];   include('../report/pass_fail_report_for_curing_process.php'); ?> 



                                              <?php

                                               
                                              if($total_test == $p)
                                                  {
                                                     /* echo "pass";*/ echo "<script>$('#pass').show();</script>";
                                                  }
                                                 else
                                                 {
                                                 	echo "<script>$('#fail').show();</script>";
                                                 }
	                                  }

	                                  if($version_wise_process_name=='Finishing')
	                                  {
                                       ?>
                                             <?php  $_GET['pp_number']=$row_for_trf['pp_number']; $_GET['version_number']=$row_for_trf['version_number']; $_GET['customer_name']=$row_for_trf['customer_name']; $_GET['style']=$row_for_trf['style'];  $_GET['finish_width_in_inch']=$row_for_trf['finish_width_in_inch'];$_GET['before_trolley_number_or_batcher_number']=$row_for_trf['before_trolley_number_or_batcher_number'];$_GET['after_trolley_number_or_batcher_number']=$row_for_trf['after_trolley_number_or_batcher_number'];    include('../report/pass_fail_report_for_finishing_process.php'); ?> 



                                              <?php
                                              if($total_test == $p)
                                                  {
                                                     /* echo "pass";*/ echo "<script>$('#pass').show();</script>";
                                                  }
                                                 else
                                                 {
                                                 	echo "<script>$('#fail').show();</script>";
                                                 }
	                                  }

	                                  if($version_wise_process_name=='Mercerize')
	                                  {
                                       ?>
                                             <?php  $_GET['pp_number']=$row_for_trf['pp_number']; $_GET['version_number']=$row_for_trf['version_number']; $_GET['customer_name']=$row_for_trf['customer_name']; $_GET['style']=$row_for_trf['style'];  $_GET['finish_width_in_inch']=$row_for_trf['finish_width_in_inch'];$_GET['before_trolley_number_or_batcher_number']=$row_for_trf['before_trolley_number_or_batcher_number'];$_GET['after_trolley_number_or_batcher_number']=$row_for_trf['after_trolley_number_or_batcher_number'];   include('../report/pass_fail_report_for_mercerize_process.php'); ?> 



                                              <?php
                                              if($total_test == $p)
                                                  {
                                                     /* echo "pass";*/ echo "<script>$('#pass').show();</script>";
                                                  }
                                                 else
                                                 {
                                                 	echo "<script>$('#fail').show();</script>";
                                                 }
	                                  }

		                             if($version_wise_process_name=='Printing')
		                                  {
	                                       ?>
	                                             <?php  $_GET['pp_number']=$row_for_trf['pp_number']; $_GET['version_number']=$row_for_trf['version_number']; $_GET['customer_name']=$row_for_trf['customer_name']; $_GET['style']=$row_for_trf['style'];  $_GET['finish_width_in_inch']=$row_for_trf['finish_width_in_inch'];$_GET['before_trolley_number_or_batcher_number']=$row_for_trf['before_trolley_number_or_batcher_number'];$_GET['after_trolley_number_or_batcher_number']=$row_for_trf['after_trolley_number_or_batcher_number'];    include('../report/pass_fail_report_for_printing_process.php'); ?> 



	                                              <?php
	                                              if($total_test == $p)
                                                  {
                                                     /* echo "pass";*/ echo "<script>$('#pass').show();</script>";
                                                  }
                                                 else
                                                 {
                                                 	echo "<script>$('#fail').show();</script>";
                                                 }
		                                  }
		                             if($version_wise_process_name=='Raising')
			                                  {
		                                       ?>
		                                             <?php  $_GET['pp_number']=$row_for_trf['pp_number']; $_GET['version_number']=$row_for_trf['version_number']; $_GET['customer_name']=$row_for_trf['customer_name']; $_GET['style']=$row_for_trf['style'];  $_GET['finish_width_in_inch']=$row_for_trf['finish_width_in_inch'];$_GET['before_trolley_number_or_batcher_number']=$row_for_trf['before_trolley_number_or_batcher_number'];$_GET['after_trolley_number_or_batcher_number']=$row_for_trf['after_trolley_number_or_batcher_number'];   include('../report/pass_fail_report_for_raising_process.php'); ?> 



		                                              <?php
		                                              if($total_test == $p)
	                                                  {
	                                                     /* echo "pass";*/ echo "<script>$('#pass').show();</script>";
	                                                  }
	                                                 else
	                                                 {
	                                                 	echo "<script>$('#fail').show();</script>";
	                                                 }
			                                  }

		                             if($version_wise_process_name=='Ready For Dyeing')
			                                  {
		                                       ?>
		                                             <?php  $_GET['pp_number']=$row_for_trf['pp_number']; $_GET['version_number']=$row_for_trf['version_number']; $_GET['customer_name']=$row_for_trf['customer_name']; $_GET['style']=$row_for_trf['style'];  $_GET['finish_width_in_inch']=$row_for_trf['finish_width_in_inch'];$_GET['before_trolley_number_or_batcher_number']=$row_for_trf['before_trolley_number_or_batcher_number'];$_GET['after_trolley_number_or_batcher_number']=$row_for_trf['after_trolley_number_or_batcher_number'];    include('../report/pass_fail_report_for_ready_for_dying_process.php'); ?> 



		                                              <?php
		                                              if($total_test == $p)
	                                                  {
	                                                     /* echo "pass";*/ echo "<script>$('#pass').show();</script>";
	                                                  }
	                                                 else
	                                                 {
	                                                 	echo "<script>$('#fail').show();</script>";
	                                                 }
			                                  }

		                             if($version_wise_process_name=='Ready For Mercerize')
			                                  {
		                                       ?>
		                                             <?php  $_GET['pp_number']=$row_for_trf['pp_number']; $_GET['version_number']=$row_for_trf['version_number']; $_GET['customer_name']=$row_for_trf['customer_name']; $_GET['style']=$row_for_trf['style'];  $_GET['finish_width_in_inch']=$row_for_trf['finish_width_in_inch'];$_GET['before_trolley_number_or_batcher_number']=$row_for_trf['before_trolley_number_or_batcher_number'];$_GET['after_trolley_number_or_batcher_number']=$row_for_trf['after_trolley_number_or_batcher_number'];   include('../report/pass_fail_report_for_ready_for_mercerize_process.php'); ?> 



		                                              <?php

			                                          if($total_test == $p)
	                                                  {
	                                                     /* echo "pass";*/ echo "<script>$('#pass').show();</script>";
	                                                  }
	                                                 else
	                                                 {
	                                                 	echo "<script>$('#fail').show();</script>";
	                                                 }
			                                  }
		                             if($version_wise_process_name=='Ready For Print')
			                                  {
		                                       ?>
		                                             <?php  $_GET['pp_number']=$row_for_trf['pp_number']; $_GET['version_number']=$row_for_trf['version_number']; $_GET['customer_name']=$row_for_trf['customer_name']; $_GET['style']=$row_for_trf['style'];  $_GET['finish_width_in_inch']=$row_for_trf['finish_width_in_inch'];$_GET['before_trolley_number_or_batcher_number']=$row_for_trf['before_trolley_number_or_batcher_number'];$_GET['after_trolley_number_or_batcher_number']=$row_for_trf['after_trolley_number_or_batcher_number'];   include('../report/pass_fail_report_for_ready_for_printing_process.php'); ?> 



		                                              <?php

		                                              if($total_test == $p)
	                                                  {
	                                                     /* echo "pass";*/ echo "<script>$('#pass').show();</script>";
	                                                  }
	                                                 else
	                                                 {
	                                                 	echo "<script>$('#fail').show();</script>";
	                                                 }
			                                  }
		                              if($version_wise_process_name=='Ready For Raising')
			                                  {
		                                       ?>
		                                             <?php  $_GET['pp_number']=$row_for_trf['pp_number']; $_GET['version_number']=$row_for_trf['version_number']; $_GET['customer_name']=$row_for_trf['customer_name']; $_GET['style']=$row_for_trf['style'];  $_GET['finish_width_in_inch']=$row_for_trf['finish_width_in_inch'];$_GET['before_trolley_number_or_batcher_number']=$row_for_trf['before_trolley_number_or_batcher_number'];$_GET['after_trolley_number_or_batcher_number']=$row_for_trf['after_trolley_number_or_batcher_number'];   include('../report/pass_fail_report_for_ready_for_raising_process.php'); ?> 



		                                              <?php

		                                              if($total_test == $p)
	                                                  {
	                                                     /* echo "pass";*/ echo "<script>$('#pass').show();</script>";
	                                                  }
	                                                 else
	                                                 {
	                                                 	echo "<script>$('#fail').show();</script>";
	                                                 }
			                                  }
		                             if($version_wise_process_name=='Sanforizing')
			                                  { 
		                                       ?>
		                                             <?php  $_GET['pp_number']=$row_for_trf['pp_number']; $_GET['version_number']=$row_for_trf['version_number']; $_GET['customer_name']=$row_for_trf['customer_name']; $_GET['style']=$row_for_trf['style'];  $_GET['finish_width_in_inch']=$row_for_trf['finish_width_in_inch'];$_GET['before_trolley_number_or_batcher_number']=$row_for_trf['before_trolley_number_or_batcher_number'];$_GET['after_trolley_number_or_batcher_number']=$row_for_trf['after_trolley_number_or_batcher_number'];   include('../report/pass_fail_report_for_sanforizing_process.php'); ?> 



		                                              <?php

		                                              if($total_test == $p)
	                                                  {
	                                                     /* echo "pass";*/ echo "<script>$('#pass').show();</script>";
	                                                  }
	                                                 else
	                                                 {
	                                                 	echo "<script>$('#fail').show();</script>";
	                                                 }
			                                  }
		                              if($version_wise_process_name=='Scouring & Bleaching')
			                                  {
		                                       ?>
		                                             <?php  $_GET['pp_number']=$row_for_trf['pp_number']; $_GET['version_number']=$row_for_trf['version_number']; $_GET['customer_name']=$row_for_trf['customer_name']; $_GET['style']=$row_for_trf['style'];  $_GET['finish_width_in_inch']=$row_for_trf['finish_width_in_inch'];$_GET['before_trolley_number_or_batcher_number']=$row_for_trf['before_trolley_number_or_batcher_number'];$_GET['after_trolley_number_or_batcher_number']=$row_for_trf['after_trolley_number_or_batcher_number'];   include('../report/pass_fail_report_for_scouring_bleaching_process.php'); ?> 



		                                              <?php
		                                              if($total_test == $p)
	                                                  {     
	                                                     /* echo "pass";*/ echo "<script>$('#pass').show();</script>";
	                                                  }
	                                                 else
	                                                 {  
	                                                 	echo "<script>$('#fail').show();</script>";
	                                                 }
			                                  }
		                             if($version_wise_process_name=='Singeing & Desizing')
			                                  {
		                                       ?>
		                                             <?php  $_GET['pp_number']=$row_for_trf['pp_number']; $_GET['version_number']=$row_for_trf['version_number']; $_GET['customer_name']=$row_for_trf['customer_name']; $_GET['style']=$row_for_trf['style'];  $_GET['finish_width_in_inch']=$row_for_trf['finish_width_in_inch'];$_GET['before_trolley_number_or_batcher_number']=$row_for_trf['before_trolley_number_or_batcher_number'];$_GET['after_trolley_number_or_batcher_number']=$row_for_trf['after_trolley_number_or_batcher_number'];   include('../report/pass_fail_report_for_singe_and_desize_process.php'); ?> 



		                                              <?php
		                                              
	                                                  	     
		                                              if($total_test == $p)
	                                                  {   
	                                                     /* echo "pass";*/ echo "<script>$('#pass').show();</script>";
	                                                  }
	                                                 else
	                                                 {
	                                                 	echo "<script>$('#fail').show();</script>";
	                                                 }
			                                  }
		                             if($version_wise_process_name=='Washing')
			                                  {
		                                       ?>
		                                             <?php  $_GET['pp_number']=$row_for_trf['pp_number']; $_GET['version_number']=$row_for_trf['version_number']; $_GET['customer_name']=$row_for_trf['customer_name']; $_GET['style']=$row_for_trf['style'];  $_GET['finish_width_in_inch']=$row_for_trf['finish_width_in_inch'];$_GET['before_trolley_number_or_batcher_number']=$row_for_trf['before_trolley_number_or_batcher_number'];$_GET['after_trolley_number_or_batcher_number']=$row_for_trf['after_trolley_number_or_batcher_number'];   include('../report/pass_fail_report_for_washing_process.php'); ?> 



		                                              <?php
		                                              if($total_test == $p)
	                                                  {
	                                                     /* echo "pass";*/ echo "<script>$('#pass').show();</script>";
	                                                  }
	                                                 else
	                                                 {
	                                                 	echo "<script>$('#fail').show();</script>";
	                                                 }
			                                  }
		                             if($version_wise_process_name=='Greige Receiving')
			                                  {
		                                       ?>
		                                             <?php  $_GET['pp_number']=$row_for_trf['pp_number']; $_GET['version_number']=$row_for_trf['version_number']; $_GET['customer_name']=$row_for_trf['customer_name']; $_GET['style']=$row_for_trf['style'];  $_GET['finish_width_in_inch']=$row_for_trf['finish_width_in_inch'];$_GET['before_trolley_number_or_batcher_number']=$row_for_trf['before_trolley_number_or_batcher_number'];$_GET['after_trolley_number_or_batcher_number']=$row_for_trf['after_trolley_number_or_batcher_number'];    include('../report/pass_fail_report_for_greige_receiving_process.php'); ?> 



		                                              <?php

		                                              if($total_test == $p)
	                                                  {
	                                                     /* echo "pass";*/ echo "<script>$('#pass').show();</script>";
	                                                  }
	                                                 else
	                                                 {
	                                                 	echo "<script>$('#fail').show();</script>";
	                                                 }
			                                  }
						         ?>
                           </div>   <!-- End of div -->

<div class="col-sm-12 col-md-12 col-lg-12">

	  <div class="panel panel-default" id="div_table">

        <div class="form-group form-group-sm" id="div_waiting_for_lab_approval_for_folding">
            <form class="form-horizontal" action="" method="POST" name="waiting_for_lab_approval_for_folding_form" id="waiting_for_lab_approval_for_folding_form">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <td colspan="9"
                                style="text-align: center; font-size: 25px; color: black; font-weight: bold; border: 1px solid">
                                Waiting For Lab Approval For Folding  (Table 0)</td>
                        </tr>
                    </thead>
                </table>

                    <div id="overflow_for_waiting_for_lab_approval" style="overflow: auto;"> 
                        <table id="datatable_for_waiting_for_lab_approval" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th rowspan="2">Date</th>    
                                    <th rowspan="2">Shift</th>
                                    <th rowspan="2">TRF No.</th>
                                    <th rowspan="2">PP No.</th>
                                    <th rowspan="2">Customer</th>
                                    <th rowspan="2">Design</th>
                                    <th rowspan="2">Version</th>
                                    <th rowspan="2">Style</th>
                                    <th rowspan="2">Color</th>
                                    <th rowspan="2">Construction</th>
                                    <th rowspan="2">Process Step</th>
                                    <th rowspan="2">Trolly</th>
                                    <th rowspan="2">Finish Width (Inch)</th>
                                    <th rowspan="2">Quantity (mtr.)</th>
                                    <th>Test Status</th>
                                    <th rowspan="2">Remarks</th>
                                    <th rowspan="2">Authorized By</th>
                                    <th colspan="2" style="text-align: center;">Action</th>
                                </tr>
                                <tr>
                                    <th>Pass/Fail</th>
                                    <th>Approved</th>
                                    <th>Rework</th>
                                    
                                </tr>
                            </thead>

                            <tbody>
                                    <td><?php echo $date ?></td>
                                    <td><?php echo $row_for_trf['shift']?></td>
                                    <td><?php echo $row_for_trf['trf_id']?></td>
                                    <td><?php echo $row_for_trf['pp_number']?></td>
                                    <td><?php echo $row_for_trf['customer_name']?></td>
                                    <td><?php echo $row_for_trf['design']?></td>
                                    <td><?php echo $row_for_trf['version_number']?></td>
                                    <td><?php echo $row_for_trf['style_name']?></td>
                                    <td><?php echo $row_for_trf['color']?></td>
                                    <td><?php echo $row_for_trf['construction_name']?></td>
                                    <td><?php echo $row_for_trf['process_name']?></td>
                                    <td><?php echo $row_for_trf['after_trolley_number_or_batcher_number']?></td>
                                    <td><?php echo $row_for_trf['finish_width_in_inch']?></td>
                                    <td><?php 
                                        
                                            echo $row_for_trf['after_trolley_or_batcher_qty'];
                                        
                                    ?></td>
                                    <td>
                                        <label id="pass" name="pass" style="display: none; padding: 0; margin: 0;" >Pass</label>
                                        <label id="fail" name="fail" style="display: none; padding: 0; margin: 0;" >Fail</label>
                                    </td>
                                    <td><input type="text" size="10" style="border: none;" id="lab_approval_for_folding" name="lab_approval_for_folding"></td>
                                    <td><?php echo $user_name?></td>
                                    <td><input type="checkbox" style="text-align: center" id="approved_check" name="approved" value="approved"  onclick="approved_for_check()"></td>
                                    <td><input type="checkbox" style="text-align: center" id="rework_check" name="rework" value="rework" onclick="rework_for_check()"> </td>
                            </tbody>
                        </table>
                </div>
            </form>
        </div>  <!-- <div class="form-group form-group-sm" id="div_waiting_for_lab_approval_for_folding"> -->
        
        

        <div class="form-group form-group-sm" id="div_waiting_for_folding" style="display: none;">
            <form class="form-horizontal" action="" method="POST" name="waiting_for_folding_form" id="waiting_for_folding_form">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <td colspan="9"
                                style="text-align: center; font-size: 25px; color: black; font-weight: bold; border: 1px solid">
                                Waiting For Folding  (Table 1)</td>
                        </tr>
                    </thead>
                </table>
                <div id="overflow_folding" style="overflow: auto;"> 
                    <table id="datatable_for_folding" class="table table-bordered">
                        <thead>
                            <tr>
                                <th rowspan="2">Date</th>    
                                <th rowspan="2">Shift</th>
                                <th rowspan="2">TRF No.</th>
                                <th rowspan="2">PP</th>
                                <th rowspan="2">Customer</th>
                                <th rowspan="2">Design</th>
                                <th rowspan="2">Version</th>
                                <th rowspan="2">Style</th>
                                <th rowspan="2">Color</th>
                                <th rowspan="2">Construction</th>
                                <th rowspan="2">Process Step</th>
                                <th rowspan="2">Trolly</th>
                                <th rowspan="2">Finish Width (Inch)</th>
                                <th rowspan="2">Quantity (mtr.)</th>
                                <th rowspan="2">Authorized By</th>
                                <th colspan="3" style="text-align: center;">Action</th>
                                <th rowspan="2">Remarks</th>
                                <th rowspan="2">Confirm Action</th>
                            </tr>
                            <tr>
                                <th>Inspection Report Status</th>
                                <th>Folding (mtr.)</th>
                                <th>Returing   Quantity (mtr.)</th>
                            </tr>
                        </thead>

                        <tbody>
                                <td><?php echo $date ?></td>
                                <td><input type="text" size="1" style="border: none;" id="shift_for_folding" name="shift_for_folding" value="<?php echo $row_for_trf['shift']?>" readonly></td>
                                <td><input type="text" size="10" style="border: none;" id="trf_id_for_folding" name="trf_id_for_folding" value="<?php echo $row_for_trf['trf_id']?>" readonly></td>
                                <td><input type="text" size="15" style="border: none;" id="pp_number_for_folding" name="pp_number_for_folding" value="<?php echo $row_for_trf['pp_number']?>" readonly></td>
                                <td><input type="text" size="6" style="border: none;" id="customer_name_for_folding" name="customer_name_for_folding" value="<?php echo $row_for_trf['customer_name']?>"readonly></td>
                                <td><input type="text" size="6" style="border: none;" id="design_for_folding" name="design_for_folding" value="<?php echo $row_for_trf['design']?>" readonly></td>
                                <td><input type="text" size="6" style="border: none;" id="version_number_for_folding" name="version_number_for_folding" value="<?php echo $row_for_trf['version_number']?>" readonly></td>
                                <td><input type="text" size="6" style="border: none;" id="style_name_for_folding" name="style_name_for_folding" value="<?php echo $row_for_trf['style_name']?>" readonly></td>
                                <td><input type="text" size="6" style="border: none;" id="color_for_folding" name="color_for_folding" value="<?php echo $row_for_trf['color']?>" readonly></td>
                                <td><input type="text" size="6" style="border: none;" id="construction_name_for_folding" name="construction_name_for_folding" value="<?php echo $row_for_trf['construction_name']?>" readonly></td>
                                <td><input type="text" size="6" style="border: none;" id="process_name_for_folding" name="process_name_for_folding" value="<?php echo $row_for_trf['process_name']?>" readonly></td>
                                <td><input type="text" size="4" style="border: none;" id="trolly_for_folding" name="trolly_for_folding" value="<?php echo $row_for_trf['after_trolley_number_or_batcher_number']?>" readonly></td>
                                <td><input type="text" size="4" style="border: none;" id="finish_width_for_folding" name="finish_width_for_folding" value="<?php echo $row_for_trf['finish_width_in_inch']?>" readonly></td>
                                <td><input type="text" size="4" style="border: none;" id="quantity_for_folding" name="quantity_for_folding" value="<?php echo $row_for_trf['after_trolley_or_batcher_qty']?>"readonly></td>
                                <td><?php echo $user_name?></td>
                                <td><input type="text" size="6" style="border: none;" id="inspection_report_status_for_folding" name="inspection_report_status_for_folding"></td>
                                <td><input type="text" size="6" style="border: none;" id="for_folding" name="for_folding"></td>
                                <td><input type="text" size="6" style="border: none;" id="returing_quantity_for_folding" name="returing_quantity_for_folding"></td>
                                <td><input type="text" size="6" style="border: none;" id="remarks_for_folding" name="remarks_for_folding"></td>
                                <td>
                                    <button type="button" class="btn btn-primary" onClick="sending_data_of_approved_for_folding_form_for_saving_in_database()">Approved</button>
                                    <!-- <button type="button" class="btn btn-primary" onClick="for_rework()">Rework</button> -->

                                </td>

                        </tbody>
                    </table>
                </div>
            </form>
        </div>       <!-- <div class="form-group form-group-sm" id="div_waiting_for_folding"> -->


        
        <div class="form-group form-group-sm" id="div_waitnig_for_rework" style="display: none;">
            <form class="form-horizontal" action="" method="POST" name="waiting_for_rework_form" id="waiting_for_rework_form">

                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <td colspan="9"
                                style="text-align: center; font-size: 25px; color: black; font-weight: bold; border: 1px solid">
                                Waiting For Rework  (Table 2)</td>
                        </tr>
                    </thead>
                </table>
                 <div id="overflow_rework" style="overflow: auto;">                        
                <table id="datatable_for_rework" class="table table-bordered">
                    <thead>
                        <tr>
                            <th rowspan="2">Date</th>    
                            <th rowspan="2">Shift</th>
                            <th rowspan="2">TRF No.</th>
                            <th rowspan="2">PP</th>
                            <th rowspan="2">Customer</th>
                            <th rowspan="2">Design</th>
                            <th rowspan="2">Version</th>
                            <th rowspan="2">Style</th>
                            <th rowspan="2">Color</th>
                            <th rowspan="2">Construction</th>
                            <th rowspan="2">Process Step</th>
                            <th rowspan="2">Trolly</th>
                            <th rowspan="2">Finish Width (Inch)</th>
                            <th rowspan="2">Quantity (mtr.)</th>
                            <th rowspan="2">Authorized By</th>
                            <th colspan="2" style="text-align: center;">Action</th>
                            <th rowspan="2">Confirm Action</th>
                            <th rowspan="2">Status</th>
                        </tr>
                        <tr>
                            <th>Reason of Rework</th>
                            <th>Corrective Action</th>
                            
                        </tr>
                    </thead>
<?php


?>
                    <tbody>
                            <td><?php echo $date ?></td>
                            <td><input type="text" size="1" style="border: none;" id="shift_for_rework" name="shift_for_rework" value="<?php echo $row_for_trf['shift']?>" readonly></td>
                            <td><input type="text" size="10" style="border: none;" id="trf_id_for_rework" name="trf_id_for_rework" value="<?php echo $row_for_trf['trf_id']?>" readonly></td>
                            <td><input type="text" size="15" style="border: none;" id="pp_number_for_rework" name="pp_number_for_rework" value="<?php echo $row_for_trf['pp_number']?>" readonly></td>
                            <td><input type="text" size="6" style="border: none;" id="customer_name_for_rework" name="customer_name_for_rework" value="<?php echo $row_for_trf['customer_name']?>"readonly></td>
                            <td><input type="text" size="6" style="border: none;" id="design_for_rework" name="design_for_rework" value="<?php echo $row_for_trf['design']?>" readonly></td>
                            <td><input type="text" size="6" style="border: none;" id="version_number_for_rework" name="version_number_for_rework" value="<?php echo $row_for_trf['version_number']?>" readonly></td>
                            <td><input type="text" size="6" style="border: none;" id="style_name_for_rework" name="style_name_for_rework" value="<?php echo $row_for_trf['style_name']?>" readonly></td>
                            <td><input type="text" size="6" style="border: none;" id="color_for_rework" name="color_for_rework" value="<?php echo $row_for_trf['color']?>" readonly></td>
                            <td><input type="text" size="6" style="border: none;" id="construction_name_for_rework" name="construction_name_for_rework" value="<?php echo $row_for_trf['construction_name']?>" readonly></td>
                            <td><input type="text" size="6" style="border: none;" id="process_name_for_rework" name="process_name_for_rework" value="<?php echo $row_for_trf['process_name']?>" readonly></td>
                            <td><input type="text" size="4" style="border: none;" id="trolly_for_rework" name="trolly_for_rework" value="<?php echo $row_for_trf['after_trolley_number_or_batcher_number']?>" readonly></td>
                            <td><input type="text" size="4" style="border: none;" id="finish_width_for_rework" name="finish_width_for_rework" value="<?php echo $row_for_trf['finish_width_in_inch']?>" readonly></td>
                            <td><input type="text" size="4" style="border: none;" id="quantity_for_rework" name="quantity_for_rework" value=" "></td>
                            <td><?php echo $user_name?></td>
                            <td><input type="text" size="4" style="border: none;" id="for_reason_of_rework" name="for_reason_of_rework"></td>
                            <td><input type="text" size="4" style="border: none;" id="for_corrective_action_of_rework" name="for_corrective_action_of_rework"></td>
                            <td>
                                <button type="button" class="btn btn-primary" onClick="sending_data_of_approved_for_rework_form_for_saving_in_database()">Approved</button>
                            </td>
                    </tbody>
                </table>
                </div>     
            </form>
        </div>    <!-- <div class="form-group form-group-sm" id="div_waitnig_for_rework"> -->

    </div>  <!-- End of <div class="panel panel-default"> -->

</div> <!-- End of <div class="col-sm-12 col-md-12 col-lg-12"> -->


<script>
 $(document).ready(function() {
    // $('#datatable_for_waiting_for_lab_approval').DataTable( {
    //     scrollY: "500px",
    //     scrollX:        true,
    //     scrollCollapse: true,
    //     paging:         false,
    //     columnDefs: [
    //         { width: '0%', targets: 0 }
    //         ],
    //     fixedColumns: {
    //                     leftColumns: 2,
    //                     rightColumns: 1
    //                 }
    // } );

    // $('#datatable_for_folding').DataTable( {
    //     scrollY: "500px",
    //     scrollX:        true,
    //     scrollCollapse: true,
    //     paging:         false,
    //     columnDefs: [
    //         { width: '0%', targets: 0 }
    //         ],
    //     fixedColumns: {
    //                     leftColumns: 2,
    //                     rightColumns: 1
    //                 }
    // } );

    // $('#datatable_for_rework').DataTable( {
    //     scrollY: "500px",
    //     scrollX:        true,
    //     scrollCollapse: true,
    //     paging:         false,
    //     columnDefs: [
    //         { width: '0%', targets: 0 }
    //         ],
    //     fixedColumns: {
    //                     leftColumns: 2,
    //                     rightColumns: 1
    //                 }
    // } );
    
} );
</script>