<?php
error_reporting(0);
session_start();

include('../login/db_connection_class.php');
$obj = new DB_Connection_Class();
$obj->connection();

//$trf_id=$_GET['trf'];
// $all_data=$_GET['all_data'];
// $split_all_data=explode("?fs?", $all_data);
// $trf_id=$split_all_data[0];
// $version_id=$split_all_data[1];
// $pp_number=$split_all_data[2];
// $process_id=$split_all_data[3];
// $process_name=$split_all_data[4];
// $process_name;


// $sql_for_trf = "select * from `partial_test_for_test_result_info` where `trf_id`='$trf_id' or (version_id='$version_id' and pp_number='$pp_number' and process_name='$process_name')";
// $result_for_trf= mysqli_query($con,$sql_for_trf) or die(mysqli_error());
// $row_for_trf=mysqli_fetch_array($result_for_trf);
?>


<style>

.form-group		/* This is for reducing Gap among Form's Fields */
{

	margin-bottom: 5px;

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
        filename: 'partial_test_for_physical_lab.pdf',
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


				<form class="form-horizontal" action="" name="test_report_of_ikea_form" id="test_report_of_ikea_form"> 

					    <div class="form-group form-group-sm" id="form-group_for_test_report">
                        <div class="form-group form-group-sm" id="form-group_for_test_report" style="fort-size: 30px; p-2 m-auto">
									<label class=" col-lg-12 text-center"  for="name" style="font-size: 20px;  margin-left: 20px;">Zaber & Zubair Quality Control Processing Labortory </label>
									
								</div>
					    	    <div class="col-sm-2">
                                     <img  src="img/zz_logo.png" alt="..." class="control-label img-rounded" style="width: 100px; height:60px; margin-bottom: 6px; background: #ffffff;"> 

								</div>
                                <div>
                                <label label class="col-sm-8" for="name" style="font-size: 12px;" >PAGAR, TONGI, GAZIPUR, BANGLADESH </label><br>
                                <label label class="col-sm-8" for="name" style="font-size: 12px;" >Contact Info : (+8802) 9801012, 9801146 Visit us at www.znzfab.com,</label>
                                <label label class="col-sm-8" for="name" style="font-size: 12px;" >E-mail : ftslab@znzfab.com</label>
                                </div>
								<!-- <label class="control-label col-sm-4" for="trf" ><h2>Test Request Form</h2></label> -->
								

						</div>
                        </br></br>
						 <div class="form-group form-group-sm" id="form-group_for_test_report_of_ikea">
							<label class=" col-sm-10" for="name" style="font-size: 20px;  margin-left: 30px;" >TEST CONCLUSION :</label>
                            <label class=" col-sm-4" for="name" style="float: right;" >ISSUE DATE: <?php echo "..................."?> </label>
							<!-- <div class="col-sm-4" style="float: right"> -->
                              
                               	 	<!-- <?php /*echo "<img type='image' alt='testing' src='barcode/barcode.php?codetype=Code39&size=40&text='.$trf_id.'&print=true'/>"*/; ?> -->

	                               	 	<!-- <?php 
	                                       //include '../barcode/barcode.php';
	                               	 	?>
	                               	 	<?php  //echo "<p class='inline'><span ><b>TRF ID".bar128(stripcslashes($row_for_trf['trf_id']))."</b></span></p>&nbsp&nbsp&nbsp&nbsp"; ?> -->
                               	
                             <!-- </div>  ENd of <div class="col-sm-7" style="text-align: right;"> -->
						</div>

						<hr/>
						<!-- <br/><br/> -->
						
						<div class="container form-group form-group-sm" id="form-group_for_test_report_of_ikea">
                        
							<div class="col-sm-10">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th class="text-center">TEST NAME</th>
                                    <th class="text-center">METHOD</th>
                                    <th class="text-center">PASS</th>
                                    <th class="text-center">FAIL</th>
                                    <th class="text-center">DATA</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <th class="text-center">Color Fastness to Rubbing</th>
                                    <th class="text-center">ISO 105 X12, IOS-TM-007</th>
                                    <td class="text-center">X</td>
                                    <td class="text-center"></td>
                                    <td class="text-center"></td>
                                </tr>
                                <tr>
                                    <th class="text-center">Color Fastness to Washing</th>
                                    <th class="text-center">ISO 105 CO6, IOS-TM-007</th>
                                    <td class="text-center">X</td>
                                    <td class="text-center"></td>
                                    <td class="text-center"></td>
                                </tr>
                                <tr>
                                    <th class="text-center">Color Fastness to Perspiration Acid</th>
                                    <th class="text-center">ISO 105 E04, IOS-TM-007</th>
                                    <td class="text-center">X</td>
                                    <td class="text-center"></td>
                                    <td class="text-center"></td>
                                </tr>
                                <tr>
                                    <th class="text-center">Color Fastness to Perspiration Alkali</th>
                                    <th class="text-center">ISO 105 E04, IOS-TM-007</th>
                                    <td class="text-center">X</td>
                                    <td class="text-center"></td>
                                    <td class="text-center"></td>
                                </tr>
                                <tr>
                                    <th class="text-center">Color Fastness to Water</th>
                                    <th class="text-center">ISO 105 E01, IOS-TM-007</th>
                                    <td class="text-center">X</td>
                                    <td class="text-center"></td>
                                    <td class="text-center"></td>
                                </tr>
                                <tr>
                                    <th class="text-center">Color Fastness to Saliva</th>
                                    <th class="text-center">ISO 105 E04, IOS-TM-007</th>
                                    <td class="text-center">X</td>
                                    <td class="text-center"></td>
                                    <td class="text-center"></td>
                                </tr>
                                <tr>
                                    <th class="text-center">Migration of Colours Into PVC</th>
                                    <th class="text-center">ISO 105 X10, IOS-TM-007</th>
                                    <td class="text-center">X</td>
                                    <td class="text-center"></td>
                                    <td class="text-center"></td>
                                </tr>
                                <tr>
                                    <th class="text-center">Color Fastness to Light</th>
                                    <th class="text-center">ISO 105 B02, IOS-TM-007</th>
                                    <td class="text-center">Waiting</td>
                                    <td class="text-center"></td>
                                    <td class="text-center"></td>
                                </tr>
                                <tr>
                                    <th class="text-center">Yarn Count</th>
                                    <th class="text-center">ISO 7211-5, IOS-TM-007</th>
                                    <td class="text-center">X</td>
                                    <td class="text-center"></td>
                                    <td class="text-center"></td>
                                </tr>
                                <tr>
                                    <th class="text-center">Color Fastness to Number of Threads per Unit Length</th>
                                    <th class="text-center">ISO 105 7211-2, IOS-TM-007</th>
                                    <td class="text-center">X</td>
                                    <td class="text-center"></td>
                                    <td class="text-center"></td>
                                </tr>
                                <tr>
                                    <th class="text-center">Deviation from indicated weight</th>
                                    <th class="text-center">EN 12127</th>
                                    <td class="text-center">X</td>
                                    <td class="text-center"></td>
                                    <td class="text-center"></td>
                                </tr>
                                <tr>
                                    <th class="text-center">Dimensional Stability to Washing</th>
                                    <th class="text-center">ISO 6330, ISO 3759,ISO 5077, IOS-TM-007</th>
                                    <td class="text-center"></td>
                                    <td class="text-center">X</td>
                                    <td class="text-center"></td>
                                </tr>
                                <tr>
                                    <th class="text-center">Appearance After Wash</th>
                                    <th class="text-center">ISO 6330, ISO 3759,ISO 5077, IOS-TM-007</th>
                                    <td class="text-center">X</td>
                                    <td class="text-center"></td>
                                    <td class="text-center"></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                                
                                </tbody>
                            </table>
                        </div>
					</div>

				</form>
			</div>  <!-- End of <div id="element"> -->
           	 
		</body>   <!-- End of <body id="target"> -->


         </div>   <!-- End of <div class="panel panel-default"> -->



         	 <button id="print" class="btn btn-primary align-center" name="print" onclick="generate_pdf()">Print</button>

     </div>   <!-- End of <div class="col-sm-12 col-md-12 col-lg-12"> -->





