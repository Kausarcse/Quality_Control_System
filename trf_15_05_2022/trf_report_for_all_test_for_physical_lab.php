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

$result=mysql_query($sql) or die(mysqli_error($con));
if(mysql_num_rows($result)<1)
{

	header('Location:logout.php');

}
*/
$customer_id=$_GET['customer_id'];

$splitted_data=explode('?fs?', $customer_id);


$customer_id=$splitted_data[0];
$trf_id=$splitted_data[1];

//  echo $trf_id;
// exit();


/*$sql_for_trf="select * from `all_test_for_trf_info`,`test_method_for_customer` where `all_test_for_trf_info`.`customer_id`='$customer_id' OR `test_method_for_customer`.`customer_id`='$customer_id' OR `all_test_for_trf_info`.`trf_id`='$trf_id' ";*/
//$sql_for_trf="select * from `all_test_for_trf_info`,`test_method_for_customer` where `all_test_for_trf_info`.`trf_id`='$trf_id' OR `test_method_for_customer`.`customer_id`='$customer_id'";

$sql_for_trf="select * from `partial_test_for_trf_info` where `partial_test_for_trf_info`.`trf_id`='$trf_id'";

$res_for_trf = mysqli_query($con, $sql_for_trf);

$row = mysqli_fetch_assoc($res_for_trf);

?>


<style>

.form-group		/* This is for reducing Gap among Form's Fields */
{

	margin-bottom: 5px;

}

#barcode_div img[type="image"]
{
 width:200px;
 height:50px;
 border:none;
 padding-left:10px;
 font-size:50px;
}

</style>

<script>


	/*function printContent(el){
    var restorepage = document.body.innerHTML;
    var printcontent = document.getElementById(el).innerHTML;
    document.body.innerHTML = printcontent;
    window.print();
    document.body.innerHTML = restorepage;

}*/

function generate_pdf(){
    var element = document.getElementById("element")

    html2pdf(element,{
        margin: 10,
        filename: 'all_test_for_physical_lab.pdf',
        image: {type: 'jpeg',  quality: 0.98 },
        html2canvas: {scale: 2, logging: true, dpi: 200, letterRendering: true },
        jsPDF: {unit: 'mm', format: 'a4', orientation: 'portrait'}
    });
}

</script>

     <div class="col-sm-12 col-md-12 col-lg-12">
       <div class="panel panel-default">

		  <body id="target">
           	 <div id="element">

                    
              
				<form class="form-horizontal" action="" style="margin-top:10px;" name="trf_form" id="trf_form"> 

					    <div class="form-group form-group-sm" id="form-group_for_trf" id="for_logo">

					    	    <div class="col-sm-3">
                                     <img src="img/zz_logo.png" alt="..." class="control-label img-rounded" style="width: 100px; height:60px; margin-bottom: 6px; background: #ffffff;">
								</div>

								<div class="col-sm-7">
                                     <label><h5><b>Zaber & Zubir Quality Control Processing Laboratory</b></h5></label>
								</div>  
								<!-- <label class="control-label col-sm-4" for="trf" ><h2>Test Request Form</h2></label> -->


						</div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_trf"> -->




						<div class="form-group form-group-sm" id="form-group_for_trf" style="text-align: center;">

					    	   <div class="col-sm-10">  
								<label class="control-label"  for="trf" ><h2><b>Test Request Form</b></h2></label>
                               </div>

						</div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_trf"> -->



						<div class="form-group form-group-sm" id="form-group_for_fiber_composition" style="text-align: left;">

					    	   <div class="col-sm-10">  
								<label class="control-label"  for="fiber_name" >Fiber Composision :<?php echo $row['fiber_composition'] ?></label>
                               </div>

						</div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_fiber_composition"> -->

						

                     


						<div class="form-group form-group-sm" id="form-group_for_recording_time" style="text-align: left;">

					    	   <div class="col-sm-8">  
								<label class="control-label"  for="recording_time" >Submitted Date: <?php echo $row['recording_time'] ?></label>
                               </div>

                                <div class="col-sm-4" >
                              
                               	 	<!-- <?php /*echo "<img type='image' alt='testing' src='barcode/barcode.php?codetype=Code39&size=40&text='.$trf_id.'&print=true'/>"*/; ?> -->

	                               	 	<?php 
	                                       include '../barcode/barcode.php';
	                               	 	?>
	                               	 	<?php  echo "<p class='inline'><span ><b>TRF ID:".bar128(stripcslashes($trf_id))."</b></span></p>&nbsp&nbsp&nbsp&nbsp"; ?>
                               	
                               </div> <!--  ENd of <div class="col-sm-7" style="text-align: right;"> -->

						</div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_trf"> -->
	              





                   <div class="form-group" id="form-group_for_care_instruction">

                      <fieldset class="col-sm-6 col-sm-offset-1"  style="border: 2px solid black; border-radius: 12px">
                      	<legend></legend>
					     
                                 <label class="control-label col-sm-4" for="care_instruction" >Care Instruction </label>


                                 <img src="<?php echo $row['washing'] ?>" alt="..." class="img-circle profile_img" style="width: 30px; height:30px; margin-bottom: 4px; background: #ffffff;">
                                 <img src="<?php echo $row['bleaching']; ?>" alt="..." class="img-circle profile_img" style="width: 30px; height:30px; margin-bottom: 4px; background: #ffffff;">
                                 <img src="<?php echo $row['ironing']; ?>" alt="..." class="img-circle profile_img" style="width: 30px; height:30px; margin-bottom: 4px; background: #ffffff;">
                                 <img src="<?php echo $row['dry_cleaning']; ?>" alt="..." class="img-circle profile_img" style="width: 30px; height:30px; margin-bottom: 4px; background: #ffffff;">
                                 <img src="<?php echo $row['drying']; ?>" alt="..." class="img-circle profile_img" style="width: 30px; height:30px; margin-bottom: 4px; background: #ffffff;">
					   	   
								
						 
					   </fieldset>

					   <fieldset class="form-group col-sm-1 ">
                      	<legend></legend> 
                       </fieldset> 


					   <fieldset class=" col-sm-3" style="border: 2px solid black; border-radius: 12px">
                      	<legend></legend>
					           
                                 <label class="control-label col-sm-offset-1" for="care_instruction">Service Type: REGULAR </label>
                       </fieldset>


                     </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_recording_time"> --> 



                    <div class="panel panel-default" style="background-color:#ffcc00;border: 2px solid; border-radius: 12px;text-align: center;margin:0 auto;">

	                     <div class="form-group form-group-sm" id="form-group_for_report_type" >
	                     	
									<label class="control-label" for="report_type" ><h5><b>Test Report Type:ALL Test</b></h5></label>
						


						</div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_report_type"> -->
                    </div>  <!-- End of <div class="panel panel-default"> -->

                    


				   
                 <div class="panel panel-default" style="background-color:#ffff00;border: 2px solid ; border-radius: 12px;text-align: center;margin:0 auto;">

			         <div class="form-group form-group-sm" style="text-align: center">
			         	<h5><b><?php echo $row['process_name'] ?> Process</b></h5>
			         </div> <!-- This will create a upper block for FORM (Just Beautification) -->
			     </div>


                  <div class="panel panel-default" style="background-color:#3399ff;border: 2px solid; border-radius: 12px;text-align: center;">

			         <div class="form-group form-group-sm" id="form-group_for_report_type">
								<label class="control-label" for="report_type" ><h5><b>Required Test(Physical Lab)</b> </h5></label>
						

					 </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_report_type"> -->
				   </div>




                       <table class="table table-hover table-stripped">

                       <thead>
                       	<tr>
	                       	<th>Tests Name</th>
	                       	<th>Tests Method</th>
	                       	<th>Remarks</th>
	                    </tr>
                       </thead>

                       <tbody>
                       	   <?php 
                       	    $customer_id=$_GET['customer_id'];
							$splitted_data=explode('?fs?', $customer_id);

							$customer_id=$splitted_data[0];
							$trf_id=$splitted_data[1];
							$process_id=$splitted_data[2];
							$pp_number=$splitted_data[3];
							$version_id=$splitted_data[4];
							$value= $row['customer_id']."?fs?".$row['trf_id']."?fs?".$row['process_id']."?fs?".$row['pp_number']."?fs?".$row['version_id'];
                            $s1 = 1;

                       
                            /*$sql_for_trf="select DISTINCT `test_method_for_customer`.`test_name`,`test_method_for_customer`.`test_method_name`,`test_method_name`.`criteria_or_testing_lab` from `partial_test_for_trf_info`,`test_method_for_customer`,`test_method_name`,`adding_process_to_version` where `test_method_for_customer`.`customer_id`=`partial_test_for_trf_info`.`customer_id` AND `test_method_for_customer`.`test_id`=`test_method_name`.`test_id` AND `partial_test_for_trf_info`.`trf_id`='$trf_id' AND `partial_test_for_trf_info`.`process_id`='$process_id'  AND `adding_process_to_version`.`process_id`='$process_id' ";*/



                            $sql_for_trf="SELECT DISTINCT tmfc.test_name,tmfc.test_method_name,tmn.criteria_or_testing_lab from
										data_for_all_standard das 
										INNER JOIN test_method_for_customer tmfc on das.test_method_id=tmfc.test_method_id  and das.customer_id=tmfc.customer_id
										INNER JOIN test_method_name tmn on tmn.test_method_id = tmfc.test_method_id
										WHERE das.pp_number='$pp_number' and das.customer_id='$customer_id'  and das.process_id='$process_id' and das.version_id='$version_id' ";
										
							$res_for_trf = mysqli_query($con, $sql_for_trf);



							while($row = mysqli_fetch_assoc($res_for_trf))
							{
								if($row['criteria_or_testing_lab']=='Physical Lab'){

							?>
                       	
                       	<tr>
                       		

                       		
                       		<td><?php echo $row['test_name']?></td>
                       		<td><?php echo $row['test_method_name']?></td>
                       		<td></td>

                       		
                       	</tr>

                       	  <?php
                               }  /*end of if($row['criteria_or_testing_lab'])*/
                       		}
                       		?>
                       </tbody>

                       </table>
					
				 


					<div class="form-group form-group-sm" id="form-group_for_recording_time">
								<label class="col-sm-6" for="recording_time" ></label>
					</div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_recording_time"> -->	


					<div class="form-group form-group-sm" id="form-group_for_recording_time">
								<label class="col-sm-6" for="recording_time" ></label>
					</div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_recording_time"> -->	

                     
					<div class="form-group form-group-sm" id="form-group_for_recording_time">
								<label class=" col-sm-6" for="recording_time" >Submitted By: _ _ _ _ _ _ _ _ _ _ _ _ _</label>
					</div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_recording_time"> -->	

				</form>
			</div> <!-- end of <div id="element"> -->

		</body> <!--  end of body -->
		
				  <div class="form-group form-group-sm row">
								<div class="col-sm-offset-3 col-sm-4">
									<!-- <button type="button" class="btn btn-primary" onclick="generate_pdf()">Print</button> -->
									<a href="trf/pdf_file_for_all_test_trf_physical_lab.php?customer_id=<?php echo $value; ?>">
										<button type="button" id="pdf_file_for_all_test_trf_physical_lab" name="pdf_file_for_all_test_trf_physical_lab"  class="btn btn-success">Generate pdf file</button>
									</a>
									<!-- <button type="reset" class="btn btn-success">EDIT</button> -->
								</div>
								<div class=" col-sm-4">
								<?php 
								
								//echo $value;
								?>
								
								
							   
								<!-- <button type="reset" class="btn btn-success">EDIT</button> -->
								</div>
				  </div>


         </div>   <!-- End of <div class="panel panel-default"> -->
     </div>   <!-- End of <div class="col-sm-12 col-md-12 col-lg-12"> -->





