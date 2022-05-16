<?php
error_reporting(0);
session_start();

include('../login/db_connection_class.php');
$obj = new DB_Connection_Class();
$obj->connection();

//$trf_id=$_GET['trf'];
$all_data=$_GET['all_data'];
$split_all_data=explode("?fs?", $all_data);
$trf_id=$split_all_data[0];
$version_id=$split_all_data[1];
$pp_number=$split_all_data[2];
$process_id=$split_all_data[3];
$process_name=$split_all_data[4];
$style_name=$split_all_data[5];
$finish_width_in_inch=$split_all_data[6];
$before_trolley_number_or_batcher_number=$split_all_data[7];
$after_trolley_number_or_batcher_number=$split_all_data[8];

$process_name;


/*$sql_for_trf = "select * from `partial_test_for_test_result_info` where `trf_id`='$trf_id' or (version_id='$version_id' and pp_number='$pp_number' and process_id='$process_id' and `style`='$style_name' and `finish_width_in_inch`='$finish_width_in_inch')";*/
 $sql_for_trf = "select * from partial_test_for_test_result_info ptftri
left join pp_wise_version_creation_info  pwvci on ptftri.pp_number=pwvci.pp_number and ptftri.version_id=pwvci.version_id and ptftri.style=pwvci.style_name and ptftri.finish_width_in_inch=pwvci.finish_width_in_inch
left join process_program_info ppi on ptftri.pp_number=ppi.pp_number
 where ptftri.trf_id='$trf_id' or (ptftri.version_id='$version_id' and ptftri.pp_number='$pp_number' and ptftri.process_id='$process_id'  and ptftri.`finish_width_in_inch`='$finish_width_in_inch' and ptftri.`before_trolley_number_or_batcher_number`='$before_trolley_number_or_batcher_number' and ptftri.`after_trolley_number_or_batcher_number`='$after_trolley_number_or_batcher_number')";

$result_for_trf= mysqli_query($con,$sql_for_trf) or die(mysqli_error($con));
$row_for_trf=mysqli_fetch_assoc($result_for_trf);

// $sql_for_pp_version="SELECT * FROM  pp_wise_version_creation_info WHERE pp_number='$pp_number' and version_id='$version_id' and style_name='$style_name' and finish_width_in_inch='$finish_width_in_inch'";

// $result_for_pp_version= mysqli_query($con,$sql_for_pp_version) or die(mysqli_error($con));
// $row_for_pp_version=mysqli_fetch_array($result_for_pp_version);


// $sql_for_pp_info="SELECT * FROM  process_program_info WHERE pp_number='$pp_number'";

// $result_for_pp_info= mysqli_query($con,$sql_for_pp_info) or die(mysqli_error($con));
// $row_for_pp_info=mysqli_fetch_array($result_for_pp_info);

?>


<style>

#element {
    
    background-color: white;
}
div
{
	width: 800;
	margin: 0; 
	padding: 0;
}

.form-group		/* This is for reducing Gap among Form's Fields */
{

	margin-bottom: 0px;
	margin-top: 0px;
	

}
hr
{
	margin-bottom: 5px;
	margin-top: 5px;
}


table {
    font-size: 12px;
    font-family:Calibri;
	/* margin-left: 0px;
	padding-left: 0px; */
	border-collapse: collapse;
	border: 1px solid black;
}
thead { display: table-header-group; } 
tfoot { display: table-row-group;} 
tr
{ 
	page-break-inside: avoid;
	
 }
 
label {
    font-size: 11px;
    font-family:Calibri;
}


</style>

<script>



	

       document.getElementById("datetime").innerHTML= (`${da}-${mo}-${ye}`);


	
</script>

<script>


	/*function printContent(el){
    var restorepage = document.body.innerHTML;
    var printcontent = document.getElementById(el).innerHTML;
    document.body.innerHTML = printcontent;
    window.print();
    document.body.innerHTML = restorepage;
}*/

/*function generate_pdf_for_all_test(){
    



   

     let nbPages = 1;
    let sourceHtml = $('#element');

    
    html2pdf(sourceHtml[0], {
      margin: 1,
      filename: 'partial_test_pass_fail_report.pdf',
      image: { type: 'jpeg', quality: 0.98 },
     
      html2canvas: { dpi: 600, letterRendering: true, width: 1500, height: 3000  },
      jsPDF: { unit: 'pt', format: 'a4', orientation: 'portrait' }
    });  
}
*/
/*$(function() {

      var doc = new jsPDF('p', 'pt', 'a4');
      var specialElementHandlers = {

      };

      $('#print').click(function() {

        doc.fromHTML($('#element').get(0), 10, 10, {
          'width': 500,
          'margin': 0,
          'pagesplit': true,
          'elementHandlers': specialElementHandlers
        });

        doc.save('sample-file.pdf');
      });

    });*/




function send_data_for_supplimentery_report()
{


    var value='<?php echo $row_for_trf['pp_number']?>'+'?fs?'+'<?php echo $row_for_trf['version_number']?>'+'?fs?'+'<?php echo $row_for_trf['customer_name']?>'+'?fs?'+'<?php echo $row_for_trf['customer_id']?>'+'?fs?'+'<?php echo $row_for_trf['style']?>'+'?fs?'+'<?php echo $row_for_trf['finish_width_in_inch']?>'+'?fs?'+'<?php echo $row_for_trf['before_trolley_number_or_batcher_number']?>'+'?fs?'+'<?php echo $row_for_trf['after_trolley_number_or_batcher_number']?>';

    /*$('#for_test_result').load('report/all_test_report_for_finishing_process.php?value='+value);*/
    
    $('#element').load('report/all_test_report_for_finishing_process.php?value='+encodeURIComponent(value));

    $('#information_div').hide();
    $('#next_process').hide();
    $('#supplimentery_report').hide();
    $('#pdf_file_for_all_test_report').hide();/*
    $('#print').hide();*/
    


}


function send_data_for_supplimentery_report_for_finishing()
{
    /*$_GET['pp_number']=$row_for_trf['pp_number']; $_GET['version_number']=$row_for_trf['version_number']; $_GET['customer_name']=$row_for_trf['customer_name']; $_GET['style']=$row_for_trf['style'];  $_GET['finish_width_in_inch']=$row_for_trf['finish_width_in_inch'];$_GET['before_trolley_number_or_batcher_number']=$row_for_trf['before_trolley_number_or_batcher_number'];$_GET['after_trolley_number_or_batcher_number']=$row_for_trf['after_trolley_number_or_batcher_number'];  */

    var value='<?php echo $row_for_trf['pp_number']?>'+'?fs?'+'<?php echo $row_for_trf['version_number']?>'+'?fs?'+'<?php echo $row_for_trf['customer_name']?>'+'?fs?'+'<?php echo $row_for_trf['customer_id']?>'+'?fs?'+'<?php echo $row_for_trf['style']?>'+'?fs?'+'<?php echo $row_for_trf['finish_width_in_inch']?>'+'?fs?'+'<?php echo $row_for_trf['before_trolley_number_or_batcher_number']?>'+'?fs?'+'<?php echo $row_for_trf['after_trolley_number_or_batcher_number']?>';

    /*$('#for_test_result').load('report/all_test_report_for_finishing_process.php?value='+value);*/

    /*alert(value);*/
    $('#for_getting_supplimentery_div').load('report/pass_fail_report_for_supplimentery_process.php?value='+encodeURIComponent(value));

    $('#next_process').show();
    $('#supplimentery_report').hide();
    $('#print').hide();
   

}
</script>


<div id="all_test">

<div class="col-sm-10 col-md-10 col-lg-10 " id="for_all_test_div">
       <div class="panel panel-default">
       	   <body id="target">
           	 <div id="element">


				<form class="form-horizontal" action="" name="all_test_pass_fail_form" id="all_test_pass_fail_form">

				

                   <div class="form-group col-lg-12" id="form-group_for_trf_pass_fail" >

						<div class="form-group form-group-sm" >
							<label class=" col-sm-10 text-left"  for="name" style="font-size: 18px;  margin-left: 30px;">Zaber & Zubair Quality Control Processing Labortory </label>
							
						</div>

						<div class="col-sm-1">
							<img  src="img/zz_logo.png" alt="..." class="control-label img-rounded" style="width: 80px; height:50px; margin-bottom: 0px; background: #ffffff;"> 

						</div>

						<div class="col-sm-5">
							<label label class="col-sm-8" for="name" style="font-size: 10px; margin-left: 10px">PAGAR, TONGI, GAZIPUR, BANGLADESH </label><br>
							<label label class="col-sm-8" for="name" style="font-size: 10px; margin-left: 10px">Contact Info : (+8802) 9801012, 9801146 Visit us at www.znzfab.com,</label>
							<label label class="col-sm-8" for="name" style="font-size: 10px; margin-left: 10px">E-mail : ftslab@znzfab.com</label>
						</div>
						<!-- <label class="control-label col-sm-4" for="trf" ><h2>Test Request Form</h2></label> -->
						

						<!-- <label class="control-label col-sm-4" for="trf" ><h2>Test Request Form</h2></label> -->
												

						<div class="form-group col-sm-6">
							
							<label class="control-label" for="name" style="float: right">Date of Publish: <span id="datetime"></span></label>
								
						</div>

						<div class="form-group col-sm-6" >
								<?php 
									$get_date=$row_for_trf['partial_test_for_test_result_creation_date'];
									$date=explode('-',$get_date);
									$merge_date=$date[2].'-'.$date[1].'-'.$date[0];


								?>
								<label class="control-label" for="name" style="float: right">Date of Testing: <?php echo $merge_date;?> </label>
						</div>

						

						
						<?php
							if($row_for_trf['trf_id']=='select')
							{

							}
							else
							{


						?>

						<div class="form-group col-sm-6" >    
							<input type="hidden" name="trf_id" id="trf_id" value="<?php echo $row_for_trf['trf_id']; ?>">

											
								<!--  <label></label> -->
									<!-- TRF ID : <svg id="barcode"></svg> -->
									<img type='image' style="padding: 0; margin: 0;float: right;  width : 200px;" id="barcode"></img>
	                               	 	
	                               	 	
	                               	 	

	                               	

	                               	 	<script>
	                               	 		
                                             var trf_id=document.getElementById('trf_id').value;
											 var trf=trf_id;
											 
	                               	 		JsBarcode("#barcode", trf,{
	                               	 			height: 60
	                               	 		});
	                               	 		
										
									</script>
						</div>
							<?php

								}

							?>

					</div>
					


					
			<content>	

				<div class="from-group row">       <!--row for form heading -->
                  

                     <div class="form-group col-lg-12" id="form-group_for_process_name" >
                
							<div style="margin-left: 10px">
								
									<label class=" col-sm-6" for="name"  ><h3><b>All Test Report -  <?php echo $row_for_trf['process_name']?></b></h3></label>

							</div>
					</div>
		

					<div class="form-group form-group-sm" id="form-group_for_trf_pass_fail">
						<label class=" col-sm-6" for="name" style="font-size: 20px;margin-left: 10px;" >Result Summary:

						<label class="label label-success" id="pass" name="pass" style="display: none; padding: 0; margin: 0;" >Pass</label>
						<label class="label label-danger" id="fail" name="fail" style="display: none; padding: 0; margin: 0;" >Fail</label>
						
						</label>
					</div>

			    </div>   <!--end row for form heading -->
					<hr/>


         <div id="for_getting_supplimentery_div">

                    <div id="information_div">
						<div class="form-group form-group-sm" id="form-group_for_trf_pass_fail" style="padding-top: 0;">
							<label class="col-sm-8" for="name" style="font-size: 20px; margin-left: 15px" >Sample Information :</label>
														
						</div>
						
						<div class="form-group form-group-sm" id="form-group_for_trf_pass_fail">
							
						<div class="col-sm-11" style="margin-left: 30px">
								<table class="table table-bordered">
									<tr>
										<td colspan="3"><b>Sample Details(PP Description)</b></td>
										<td colspan="1">:</td>
										<td colspan="3"><?php echo $row_for_trf['pp_description']?></td>

										<td colspan="3"><b>Fiber Composition</b></td>
										<td colspan="1">:</td>
										<!-- <td colspan="3"><?php echo $row_for_trf['fiber_composition']?></td> -->
									 <td colspan="3"><b> <?php echo 'Cotton :'.$row_for_trf['percentage_of_cotton_content'].' Polyester :'.$row_for_trf['percentage_of_polyester_content'];if($row_for_trf['other_fiber_in_yarn']=='Null'){echo '';}else{echo ' '.$row_for_trf['other_fiber_in_yarn'].':'.$row_for_trf['percentage_of_other_fiber_content'];}?> </b></td> 
									</tr>

								    <tr>
									    <td colspan="3"><b>PP No.</b></td>
									    <td colspan="1">:</td>
									    <td colspan="3"><?php echo $row_for_trf['pp_number']?></td>

									    <td colspan="3"><b>Process Technique</b></td>
									    <td colspan="1">:</td>
									    <td colspan="3"><?php echo $row_for_trf['process_technique_name']?></td>

									    
								    </tr>


								    <tr>
								    	<td colspan="3"><b>Week</b></td>
									    <td colspan="1">:</td>
									    <td colspan="3"><?php echo $row_for_trf['week_in_year']?></td>

									    <td colspan="3"><b>After Trolley/Batcher</b></td>
									    <td colspan="1">:</td>
									    <td colspan="3"><?php echo $row_for_trf['after_trolley_number_or_batcher_number']?></td>
								    </tr>

									<tr>

										<td colspan="3"><b>Design</b></td>
									    <td colspan="1">:</td>
									    <td colspan="3"><?php echo $row_for_trf['design']?></td>

									    <td colspan="3"><b>Machine</b></td>
									    <td colspan="1">:</td>
									    <td colspan="3"><?php echo $row_for_trf['machine_name']?></td>

										
									</tr>

									<tr>
										<td colspan="3"><b>Version</b></td>
									    <td colspan="1">:</td>
									    <td colspan="3"><?php echo $row_for_trf['version_number']?></td>

									    <td colspan="3"><b>Shift</b></td>
									    <td colspan="1">:</td>
									    <td colspan="3"><?php echo $row_for_trf['shift']?></td>       

									   
							 	    </tr>

								 	<tr>
								 		<td colspan="3"><b>Style</b></td>
									    <td colspan="1">:</td>
									    <td colspan="3"><?php echo $row_for_trf['style_name']?></td>

									    <td colspan="3"><b>Finish Width(Inch)</b></td>
									    <td colspan="1">:</td>
									    <td colspan="3"><?php echo $row_for_trf['finish_width_in_inch']?></td>
									</tr>

									<tr>

										<td colspan="3"><b>Color</b></td>
									    <td colspan="1">:</td>
									    <td colspan="3"><?php echo $row_for_trf['color']?></td>

										<td colspan="3"><b>Quantity(mtr.)</b></td>
									    <td colspan="1">:</td>
									    <td colspan="3"><?php echo $row_for_trf['after_trolley_or_batcher_qty']?></td>
									</tr>

									<tr>
										<td colspan="3"><b>Construction</b></td>
									    <td colspan="1">:</td>
									    <td colspan="3"><?php echo $row_for_trf['construction_name']?></td>

									    <td colspan="3"><b>Care Instruction</b></td>
									    <td colspan="1">:</td>
									    <td colspan="3"><img src="<?php echo $row_for_trf['washing']?>" width="30" height="20"> <img src="<?php echo $row_for_trf['bleaching']?>" width="30" height="20"> <img src="<?php echo $row_for_trf['ironing']?>" width="30" height="20"> <img src="<?php echo $row_for_trf['dry_cleaning']?>" width="30" height="20"> <img src="<?php echo $row_for_trf['drying']?>" width="30" height="20"></td>

									</tr>
									
								</table>					
							</div>
													
						</div>
						
                    </div>  <!-- End of <div id="information_div"> -->


                
                    

					<div class="form-group form-group-sm" id="form-group_for_trf_pass_fail">				   
								<!-- <label class=" col-sm-12" for="name" style="font-size: 20px;  margin-left: 10px;" >Test Report:
								</label> -->
						
								<label class="col-sm-8" for="name" style="font-size: 20px;  margin-left: 30px;" >Test Result :</label>
							
                          <div class="col-sm-11" style="margin-left: 30px">
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
                                             <?php  $_GET['pp_number']=$row_for_trf['pp_number']; 
											 $_GET['version_number']=$row_for_trf['version_number']; 
											 $_GET['customer_id']=$row_for_trf['customer_id']; 
											 $_GET['customer_name']=$row_for_trf['customer_name']; 
											 $_GET['style']=$row_for_trf['style'];  
											 $_GET['finish_width_in_inch']=$row_for_trf['finish_width_in_inch'];
											 $_GET['before_trolley_number_or_batcher_number']=$row_for_trf['before_trolley_number_or_batcher_number'];
											 $_GET['after_trolley_number_or_batcher_number']=$row_for_trf['after_trolley_number_or_batcher_number'];    
											 include('../report/pass_fail_report_for_finishing_process.php'); ?> 



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
						    			
										
						</div> 


            </div>  <!-- End of <div id="for_getting_supplimentery_div"> -->


         </content>

                    <footer>
						<div class="form-group form-group-sm row" id="form-group_for_signature">
						
						  <div class="col-sm-5" style="margin-left: 0px;">
							<label for="signature"><b>Reported By:</b> <u><span><?php echo $row_for_trf['employee_name'] ?></span></u></label> 
						  </div>

						  <div class="col-sm-5" style="float: right;">

						   	<!-- <label for="signature">Verified By: <b><u> <span><?php //echo $row_for_qc['recording_person_name'] ?></u></b></span></label>  -->
							   <label for="signature">Verified By: <span><img id="sample_image" name="sample_image"  alt="image" src="img/<?php echo $row_for_trf['verified_signature']?>"  width="150" height="40"></span></label>	
								    <!-- <span><input type="file" id="verified_signature" name="verified_signature" onchange="readURL(this);"></span>	 -->

					      </div>
					   </div> <!--  End of <div class="form-group form-group-sm" id="form-group_for_signature"> -->
			        </footer>


				</form>


			</div>  <!-- End of <div id="element"> -->
           	 
		</body>   <!-- End of <body id="target"> -->


    </div>   <!-- End of <div class="panel panel-default"> -->
<script>
	
	// function readURL(input) {
    //         if (input.files && input.files[0]) {
    //             var reader = new FileReader();

    //             reader.onload = function (e) {
    //                 $('#sample_image').attr('src', e.target.result);
					
	// 				$('#verified_signature').hide();
    //             };

    //             reader.readAsDataURL(input.files[0]);
    //         }

	// 		var signature= document.getElementById('verified_signature').value;
	// 		alert(signature);
	//    		$.ajax({
	// 		 		url: 'report/pdf_file_for_pass_fail_report_for_all_test.php',
	// 		 		type: 'post',
	// 		 		data: {signature : signature},
	// 		 		processData: false,
	// 		 		contentType: false,
	// 		 		success: function( data, textStatus, jQxhr )
	// 		 		{
	// 		 				//alert(data);
	// 		 		},
	// 		 		error: function( jqXhr, textStatus, errorThrown )
	// 		 		{
	// 		 				//console.log( errorThrown );
	// 		 				alert(errorThrown);
	// 		 		}
	// 		 }); // End of $.ajax
    //     }
</script>


         	 <!-- <button id="print" class="btn btn-primary btn-xs" name="print" onclick="generate_pdf_for_all_test()">Print</button>
 -->
         	 <?php  $_GET['pp_number']=$row_for_trf['pp_number']; $_GET['version_number']=$row_for_trf['version_number']; $_GET['customer_name']=$row_for_trf['customer_name']; $_GET['style']=$row_for_trf['style'];  $_GET['finish_width_in_inch']=$row_for_trf['finish_width_in_inch'];$_GET['before_trolley_number_or_batcher_number']=$row_for_trf['before_trolley_number_or_batcher_number'];$_GET['after_trolley_number_or_batcher_number']=$row_for_trf['after_trolley_number_or_batcher_number'];  ?> 
         	 
         	 <button id="next_process" class="btn btn-danger btn-xs" name="next_process" onclick="send_data_for_supplimentery_report()">Merge Report </button>

         	 <button id="supplimentery_report" class="btn btn-info btn-xs" name="next_process" onclick="send_data_for_supplimentery_report_for_finishing()">Supplimentery Report </button>

         	  <a href="report/pdf_file_for_pass_fail_report_for_all_test.php?all_data=<?php echo $all_data; ?>" target="_blank">
                        <button type="button" id="pdf_file_for_all_test_report" name="pdf_file_for_all_test_report"  class="btn btn-primary btn-xs">Generate pdf file</button>
               </a>
                

             <!-- <?php $value=$row_for_trf['version_number']+'?fs?'+$row_for_trf['customer_name']+'?fs?'+$row_for_trf['style']+'?fs?'+$row_for_trf['finish_width_in_inch']+'?fs?'+$row_for_trf['before_trolley_number_or_batcher_number']+'?fs?'+$row_for_trf['after_trolley_number_or_batcher_number'];  ?>

         	 <button id="supplimentery_report" class="btn btn-success" name="print" onclick="load_page('report/pass_fail_report_for_supplimentery_process.php?value=<?php echo $value;?>')">Supplimentery Report</button> -->

     </div>   <!-- End of <div class="col-sm-12 col-md-12 col-lg-12"> -->
	 </div>




