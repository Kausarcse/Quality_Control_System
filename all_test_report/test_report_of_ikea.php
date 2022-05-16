<?php
error_reporting(0);
session_start();

include('../login/db_connection_class.php');
$obj = new DB_Connection_Class();
$obj->connection();


?>


<style>

.form-group		/* This is for reducing Gap among Form's Fields */
{

	margin-bottom: 5px;

}

</style>

<script>



function generate_pdf(){
    var element = document.getElementById("element")
    var element_for_test = document.getElementById("element_for_test")

    html2pdf(element,{
        margin: 10,
        filename: 'partial_test_for_physical_lab.pdf',
        image: {type: 'jpeg',  quality: 0.98 },
        html2canvas: {scale: 2, logging: true, dpi: 200, letterRendering: true },
        jsPDF: {unit: 'mm', format: 'a4', orientation: 'portrait'}
    });

     html2pdf(element_for_test,{
        margin: 0,
        filename: 'partial_test_for_physical_lab.pdf',
        image: {type: 'jpeg',  quality: 0.98 },
        html2canvas: {scale: 1, logging: true, dpi: 200, letterRendering: true },
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
							<label class=" col-sm-10 text-center" for="name" style="font-size: 30px;  margin-left: 20px;" >Test Report of IKEA / ikea Test Report</label>
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
						
						<div class="form-group form-group-sm" id="form-group_for_test_report_of_ikea">
							<div class="row from-group" style="margin-bottom: 5px;" >
                                <div class="col-sm-4"><strong style="margin-left: 50px;">REPORT NUMBER</strong></div>
                                <div class="col-sm-1"><strong>:</strong></div>
                                <div class="col-sm-7">ZZZFL_AT_11</div>
                            </div>

                            <div class="row from-group" style="margin-bottom: 5px;" >
                                <div class="col-sm-4"><strong style="margin-left: 50px;">SAMPLE DETAILS / PP DETAILS</strong></div>
                                <div class="col-sm-1"><strong>:</strong></div>
                                <div class="col-sm-7">PIGMENT PRINT, LXL</div>
                            </div>

                            <div class="row from-group" style="margin-bottom: 5px;">
                                <div class="col-sm-4"><strong style="margin-left: 50px;">PP NO.</strong></div>
                                <div class="col-sm-1"><strong>:</strong></div>
                                <div class="col-sm-7">761/21</div>
                            </div>

                            <div class="row from-group" style="margin-bottom: 5px;">
                                <div class="col-sm-4"><strong style="margin-left: 50px;">DESIGN</strong></div>
                                <div class="col-sm-1"><strong>:</strong></div>
                                <div class="col-sm-7">LENAST</div>
                            </div>

                            <div class="row from-group" style="margin-bottom: 5px;">
                                <div class="col-sm-4"><strong style="margin-left: 50px;">COLOR</strong></div>
                                <div class="col-sm-1"><strong>:</strong></div>
                                <div class="col-sm-7">GRAY</div>
                            </div>

                            <div class="row from-group" style="margin-bottom: 5px;">
                                <div class="col-sm-4"><strong style="margin-left: 50px;">CONSTRUCTION</strong></div>
                                <div class="col-sm-1"><strong>:</strong></div>
                                <div class="col-sm-7">40.40/110.80</div>
                            </div>

                            <div class="row from-group" style="margin-bottom: 5px;">
                                <div class="col-sm-4"><strong style="margin-left: 50px;">VERSION</strong></div>
                                <div class="col-sm-1"><strong>:</strong></div>
                                <div class="col-sm-7">QC</div>
                            </div>

                            <div class="row" style="margin-bottom: 5px;">
                                <div class="col-sm-4"><strong style="margin-left: 50px;">STYLE</strong></div>
                                <div class="col-sm-1"><strong>:</strong></div>
                                <div class="col-sm-7">LXL</div>
                            </div>

                            <div class="row from-group" style="margin-bottom: 5px;">
                                <div class="col-sm-4"><strong style="margin-left: 50px;">WEEK</strong></div>
                                <div class="col-sm-1"><strong>:</strong></div>
                                <div class="col-sm-7">2113</div>
                            </div>

                            <div class="row from-group" style="margin-bottom: 5px;">
                                <div class="col-sm-4"><strong style="margin-left: 50px;">FIBER COMPOSITION</strong></div>
                                <div class="col-sm-1"><strong>:</strong></div>
                                <div class="col-sm-7">80% COTTON, 20% VISCOSE</div>
                            </div>

                            <div class="row from-group" style="margin-bottom: 5px;">
                                <div class="col-sm-4"><strong style="margin-left: 50px;">PROCESS TECHNIQUE</strong></div>
                                <div class="col-sm-1"><strong>:</strong></div>
                                <div class="col-sm-7">FIGMENT PRINT</div>
                            </div>

                            <div class="row from-group" style="margin-bottom: 5px;">
                                <div class="col-sm-4"><strong style="margin-left: 50px;">CARE INSTRUCTION</strong></div>
                                <div class="col-sm-1"><strong>:</strong></div>
                                <div class="col-sm-7"></div>
                            </div>

                            <div class="row from-group" style="margin-bottom: 5px;">
                                <div class="col-sm-4"><strong style="margin-left: 50px;">SAMPLE PICTURE</strong></div>
                                <div class="col-sm-1"><strong>:</strong></div>
                                <div class="col-sm-7"><input type="file"></div>
                            </div>
                            						
						</div>
						<hr/>

						<div class="row form-group form-group-sm" id="form-group_for_test_report_of_ikea">
                            <div class="col-sm-2"><label class="text-end">REPORT BY:</label></div>
                            <div class="col-sm-2"><label>____________________</label></div>
                            <div class="col-sm-2"><label class="text-end">CHECKED BY</label></div>
                            <div class="col-sm-2"><label>____________________</label></div>
                            <div class="col-sm-2"><label class="text-end">VERIFIED BY</label></div>
                            <div class="col-sm-2"><label>____________________</label></div>
						</div>
					
				</form>


			</div>  <!-- End of <div id="element"> -->
           	 
		</body>   <!-- End of <body id="target"> -->


         </div>   <!-- End of <div class="panel panel-default"> -->



         <div class="panel panel-default">

           <body id="target_for_test">
             <div id="element_for_test">


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
                            <label class=" col-sm-10" for="name" style="font-size: 20px;  margin-left: 30px;" >TEST DETAILS</label>
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
                        
                        <div class="form-group form-group-sm" id="form-group_for_test_report_of_ikea">
                        <label class=" col-sm-12" for="name" style="font-size: 20px;" >1.  Color Fastness to Rubbing (ISO 105 x12, IOS-TM-007) : </label>
                            <div class="col-sm-10">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th class="text-center" colspan="3">Result</th>
                                    <th class="text-center" rowspan="2">Requirements</th>
                                    
                                </tr>
                                <tr>
                                    <th class="text-center" colspan="3">Gray</th>
                                    
                                </tr>
                                <tr>
                                    <th class="text-center">Direction</th>
                                    <th class="text-center">Warp</th>
                                    <th class="text-center">Weft</th>
                                    <td class="text-center"></td>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <th class="text-center">Dry</th>
                                    <td class="text-center"></td>
                                    <td class="text-center"></td>
                                    <td class="text-center"></td>
                                   
                                </tr>
                                <tr>
                                    <th class="text-center">Wet</th>
                                    <td class="text-center"></td>
                                    <td class="text-center"></td>
                                    <td class="text-center"></td>
                                    
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="form-group form-group-sm" id="form-group_for_test_report_of_ikea">
                        <label class=" col-sm-12" for="name" style="font-size: 20px;" >2.  Color Fastness to Washing (ISO 105 CO6, IOS-TM-007) : </label>
                            <div class="col-sm-10">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th class="text-center" colspan="7">Result</th>
                                    <th class="text-center" colspan="2">Requirements</th>                                   
                                </tr>
                                <tr>
                                    <th class="text-center" rowspan="2">Color Change</th>
                                    <th class="text-center" colspan="6">Staining on to mulifiber</th>
                                    <th class="text-center" rowspan="2">Color Change</th>
                                    <th class="text-center" rowspan="2">Staining</th>
                                </tr>
                                <tr>
                                    
                                    <th class="text-center">Acetate</th>
                                    <th class="text-center">Cotton</th>
                                    <th class="text-center">Mylon</th>
                                    <th class="text-center">Polyester</th>
                                    <th class="text-center">Acrylic</th>
                                    <th class="text-center">Wool</th>
                                    

                                </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="text-center">4</td>
                                        <td class="text-center"></td>
                                        <td class="text-center"></td>
                                        <td class="text-center"></td>
                                        <td class="text-center"></td>
                                        <td class="text-center"></td>
                                        <td class="text-center"></td>
                                        <td class="text-center"></td>
                                        <td class="text-center"></td>
                                    </tr>

                                    <tr>
                                        <td class="text-center">4</td>
                                        <td class="text-center"></td>
                                        <td class="text-center"></td>
                                        <td class="text-center"></td>
                                        <td class="text-center"></td>
                                        <td class="text-center"></td>
                                        <td class="text-center"></td>
                                        <td class="text-center"></td>
                                        <td class="text-center"></td>
                                    </tr>
                                
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="form-group form-group-sm" id="form-group_for_test_report_of_ikea">
                        <label class=" col-sm-12" for="name" style="font-size: 20px;" >3.  Color Fastness to Perspiration Acid (ISO 105 E04, IOS-TM-007) : </label>
                            <div class="col-sm-10">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th class="text-center" colspan="7">Result</th>
                                    <th class="text-center" colspan="2">Requirements</th>                                   
                                </tr>
                                <tr>
                                    <th class="text-center" rowspan="2">Color Change</th>
                                    <th class="text-center" colspan="6">Staining on to mulifiber</th>
                                    <th class="text-center" rowspan="2">Color Change</th>
                                    <th class="text-center" rowspan="2">Staining</th>
                                </tr>
                                <tr>
                                    
                                    <th class="text-center">Acetate</th>
                                    <th class="text-center">Cotton</th>
                                    <th class="text-center">Mylon</th>
                                    <th class="text-center">Polyester</th>
                                    <th class="text-center">Acrylic</th>
                                    <th class="text-center">Wool</th>
                                    

                                </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="text-center">4</td>
                                        <td class="text-center"></td>
                                        <td class="text-center"></td>
                                        <td class="text-center"></td>
                                        <td class="text-center"></td>
                                        <td class="text-center"></td>
                                        <td class="text-center"></td>
                                        <td class="text-center"></td>
                                        <td class="text-center"></td>
                                    </tr>

                                    <tr>
                                        <td class="text-center">4</td>
                                        <td class="text-center"></td>
                                        <td class="text-center"></td>
                                        <td class="text-center"></td>
                                        <td class="text-center"></td>
                                        <td class="text-center"></td>
                                        <td class="text-center"></td>
                                        <td class="text-center"></td>
                                        <td class="text-center"></td>
                                    </tr>
                                
                                </tbody>
                            </table>
                        </div>
                    </div>
                    
                    <div class="form-group form-group-sm" id="form-group_for_test_report_of_ikea">
                        <label class=" col-sm-12" for="name" style="font-size: 20px;" >4.  Color Fastness to Perspiration Alkali (ISO 105 E04, IOS-TM-007) : </label>
                            <div class="col-sm-10">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th class="text-center" colspan="7">Result</th>
                                    <th class="text-center" colspan="2">Requirements</th>                                   
                                </tr>
                                <tr>
                                    <th class="text-center" rowspan="2">Color Change</th>
                                    <th class="text-center" colspan="6">Staining on to mulifiber</th>
                                    <th class="text-center" rowspan="2">Color Change</th>
                                    <th class="text-center" rowspan="2">Staining</th>
                                </tr>
                                <tr>
                                    
                                    <th class="text-center">Acetate</th>
                                    <th class="text-center">Cotton</th>
                                    <th class="text-center">Mylon</th>
                                    <th class="text-center">Polyester</th>
                                    <th class="text-center">Acrylic</th>
                                    <th class="text-center">Wool</th>
                                    

                                </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="text-center">4</td>
                                        <td class="text-center"></td>
                                        <td class="text-center"></td>
                                        <td class="text-center"></td>
                                        <td class="text-center"></td>
                                        <td class="text-center"></td>
                                        <td class="text-center"></td>
                                        <td class="text-center"></td>
                                        <td class="text-center"></td>
                                    </tr>

                                    <tr>
                                        <td class="text-center">4</td>
                                        <td class="text-center"></td>
                                        <td class="text-center"></td>
                                        <td class="text-center"></td>
                                        <td class="text-center"></td>
                                        <td class="text-center"></td>
                                        <td class="text-center"></td>
                                        <td class="text-center"></td>
                                        <td class="text-center"></td>
                                    </tr>
                                
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="form-group form-group-sm" id="form-group_for_test_report_of_ikea">
                        <label class=" col-sm-12" for="name" style="font-size: 20px;" >5.  Color Fastness to Water (ISO 105 E01, IOS-TM-007) : </label>
                            <div class="col-sm-10">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th class="text-center" colspan="7">Result</th>
                                    <th class="text-center" colspan="2">Requirements</th>                                   
                                </tr>
                                <tr>
                                    <th class="text-center" rowspan="2">Color Change</th>
                                    <th class="text-center" colspan="6">Staining on to mulifiber</th>
                                    <th class="text-center" rowspan="2">Color Change</th>
                                    <th class="text-center" rowspan="2">Staining</th>
                                </tr>
                                <tr>
                                    
                                    <th class="text-center">Acetate</th>
                                    <th class="text-center">Cotton</th>
                                    <th class="text-center">Mylon</th>
                                    <th class="text-center">Polyester</th>
                                    <th class="text-center">Acrylic</th>
                                    <th class="text-center">Wool</th>
                                    

                                </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="text-center">4</td>
                                        <td class="text-center"></td>
                                        <td class="text-center"></td>
                                        <td class="text-center"></td>
                                        <td class="text-center"></td>
                                        <td class="text-center"></td>
                                        <td class="text-center"></td>
                                        <td class="text-center"></td>
                                        <td class="text-center"></td>
                                    </tr>

                                    <tr>
                                        <td class="text-center">4</td>
                                        <td class="text-center"></td>
                                        <td class="text-center"></td>
                                        <td class="text-center"></td>
                                        <td class="text-center"></td>
                                        <td class="text-center"></td>
                                        <td class="text-center"></td>
                                        <td class="text-center"></td>
                                        <td class="text-center"></td>
                                    </tr>
                                
                                </tbody>
                            </table>
                        </div>
                    </div>
                    
                    <div class="form-group form-group-sm" id="form-group_for_test_report_of_ikea">
                        <label class=" col-sm-12" for="name" style="font-size: 20px;" >6.  Color Fastness to Saliva (ISO 105 E04, IOS-TM-007) : </label>
                            <div class="col-sm-10">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th class="text-center" colspan="7">Result</th>
                                    <th class="text-center" colspan="2">Requirements</th>                                   
                                </tr>
                                <tr>
                                    <th class="text-center" rowspan="2">Color Change</th>
                                    <th class="text-center" colspan="6">Staining on to mulifiber</th>
                                    <th class="text-center" rowspan="2">Color Change</th>
                                    <th class="text-center" rowspan="2">Staining</th>
                                </tr>
                                <tr>
                                    
                                    <th class="text-center">Acetate</th>
                                    <th class="text-center">Cotton</th>
                                    <th class="text-center">Mylon</th>
                                    <th class="text-center">Polyester</th>
                                    <th class="text-center">Acrylic</th>
                                    <th class="text-center">Wool</th>
                                    

                                </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="text-center">4</td>
                                        <td class="text-center"></td>
                                        <td class="text-center"></td>
                                        <td class="text-center"></td>
                                        <td class="text-center"></td>
                                        <td class="text-center"></td>
                                        <td class="text-center"></td>
                                        <td class="text-center"></td>
                                        <td class="text-center"></td>
                                    </tr>

                                    <tr>
                                        <td class="text-center">4</td>
                                        <td class="text-center"></td>
                                        <td class="text-center"></td>
                                        <td class="text-center"></td>
                                        <td class="text-center"></td>
                                        <td class="text-center"></td>
                                        <td class="text-center"></td>
                                        <td class="text-center"></td>
                                        <td class="text-center"></td>
                                    </tr>
                                
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="form-group form-group-sm" id="form-group_for_test_report_of_ikea">
                        <label class=" col-sm-12" for="name" style="font-size: 20px;" >7.  Migration of Colours Into PVC (ISO 105 X10, IOS-TM-007) : </label>
                            <div class="col-sm-10">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th class="text-center" colspan="2">Color Change</th>
                                    <th class="text-center">Requirements</th>                                   
                                </tr>
                               
                                </thead>
                                <tbody>
                                <tr>
                                    <th class="text-center" rowspan="2">Staining</th>
                                    <th class="text-center" >Colors</th>
                                    <td class="text-center" rowspan="2"></td>
                                </tr>
                                    <tr>
                                  
                                        <td class="text-center">1</td>
                                      
                                    </tr>
                                
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="form-group form-group-sm" id="form-group_for_test_report_of_ikea">
                        <label class=" col-sm-12" for="name" style="font-size: 20px;" >8.  Color Fastness to Light (ISO 105 B02, IOS-TM-007) : </label>
                        <label class=" col-sm-12" for="name" style="font-size: 14px;" >Method 3, Modified, Xenon-Arc Lamp, Deutsche Echheitskommission Blue Wool Reference (<a class="text-warning" href="#">Manual Input here</a>) </label>
                            <div class="col-sm-10">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th class="text-center" colspan="7">Result</th>
                                    <th class="text-center" colspan="2">Requirements</th>                                   
                                </tr>
                                <tr>
                                    <th class="text-center" rowspan="2">Color Change</th>
                                    <th class="text-center" colspan="6">Staining on to mulifiber</th>
                                    <th class="text-center" rowspan="2">Color Change</th>
                                    <th class="text-center" rowspan="2">Staining</th>
                                </tr>
                                <tr>
                                    
                                    <th class="text-center">Acetate</th>
                                    <th class="text-center">Cotton</th>
                                    <th class="text-center">Mylon</th>
                                    <th class="text-center">Polyester</th>
                                    <th class="text-center">Acrylic</th>
                                    <th class="text-center">Wool</th>
                                    

                                </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="text-center">4</td>
                                        <td class="text-center"></td>
                                        <td class="text-center"></td>
                                        <td class="text-center"></td>
                                        <td class="text-center"></td>
                                        <td class="text-center"></td>
                                        <td class="text-center"></td>
                                        <td class="text-center"></td>
                                        <td class="text-center"></td>
                                    </tr>

                                    <tr>
                                        <td class="text-center">4</td>
                                        <td class="text-center"></td>
                                        <td class="text-center"></td>
                                        <td class="text-center"></td>
                                        <td class="text-center"></td>
                                        <td class="text-center"></td>
                                        <td class="text-center"></td>
                                        <td class="text-center"></td>
                                        <td class="text-center"></td>
                                    </tr>
                                
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="form-group form-group-sm" id="form-group_for_test_report_of_ikea">
                        <label class=" col-sm-12" for="name" style="font-size: 20px;" >9. Yarn Count (ISO 7211-5, IOS-TM-007) : </label>
                            <div class="col-sm-10">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th class="text-center" colspan="2">Result</th>
                                    <th class="text-center">Requirements</th>                                   
                                </tr>
                               
                                </thead>
                                <tbody>
                                <tr>
                                    <th class="text-center">Warp</th>
                                    <td class="text-center" ></td>
                                    <td class="text-center"></td>
                                </tr>
                                <tr>
                                    <th class="text-center">Warp</th>
                                    <td class="text-center" ></td>
                                    <td class="text-center"></td>
                                </tr>
                                
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="form-group form-group-sm" id="form-group_for_test_report_of_ikea">
                        <label class=" col-sm-12" for="name" style="font-size: 20px;" >10. Number of Threads per Unit Length (ISO 7211-2, IOS-TM-007) : </label>
                            <div class="col-sm-10">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th class="text-center" colspan="2">Result</th>
                                    <th class="text-center">Requirements</th>                                   
                                </tr>
                               
                                </thead>
                                <tbody>
                                <tr>
                                    <th class="text-center">EPI</th>
                                    <td class="text-center" ></td>
                                    <td class="text-center"></td>
                                </tr>
                                <tr>
                                    <th class="text-center">PPI</th>
                                    <td class="text-center" ></td>
                                    <td class="text-center"></td>
                                </tr>
                                
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="form-group form-group-sm" id="form-group_for_test_report_of_ikea">
                        <label class=" col-sm-12" for="name" style="font-size: 20px;" >11. Deviation from Indicated Weight (EN 12127) : </label>
                            <div class="col-sm-10">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th class="text-center">Result (g/m<sup>2</sup> )</th>
                                    <th class="text-center">Requirements</th>                                   
                                </tr>
                               
                                </thead>
                                <tbody>
                                <tr>
                                    <td class="text-center" >1</td>
                                    <td class="text-center">1</td>
                                </tr>
                                
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="form-group form-group-sm" id="form-group_for_test_report_of_ikea">
                        <label class=" col-sm-12" for="name" style="font-size: 20px;" >12. Dimensional Stability to Washing (ISO 6330, ISO 3759,ISO 5077, IOS-TM-0007) : </label>
                        <label class=" col-sm-12" for="name" style="font-size: 14px;" >Wascator Washing Machine-Front-Loading Horizontal Rotating Drum Type, Tesh Programme 6N, 60&#176;C With 100% Cotton 2 kg Total Load, <br> In 20g Non-Phosphate Reference Detergent 3, Followed by tumble Dry (<a class="text-warning" href="#">Manual Input here</a>) </label>

                            <div class="col-sm-10">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th class="text-center">Direction</th>
                                    <th class="text-center">Result (%)</th>
                                    <th class="text-center">Requirements (%)</th>                                   
                                </tr>
                               
                                </thead>
                                <tbody>
                                <tr>
                                    <th class="text-center">Average Warp</th>
                                    <td class="text-center" ></td>
                                    <td class="text-center"></td>
                                </tr>
                                <tr>
                                    <th class="text-center">Average Weft</th>
                                    <td class="text-center" ></td>
                                    <td class="text-center"></td>
                                </tr>
                                
                                </tbody>
                            </table>
                        </div>
                    </div>



                    <div class="form-group form-group-sm" id="form-group_for_test_report_of_ikea">
                        <label class=" col-sm-12" for="name" style="font-size: 20px;" >13. Appearance After Wash (ISO 6330, ISO 3759,ISO 5077, IOS-TM-0007) : </label>
                        <label class=" col-sm-12" for="name" style="font-size: 14px;" >Wascator Washing Machine-Front-Loading Horizontal Rotating Drum Type, Tesh Programme 6N, 60&#176;C With 100% Cotton 2 kg Total Load, <br> In 20g Non-Phosphate Reference Detergent 3, Followed by tumble Dry (<a class="text-warning" href="#">Manual Input here</a>) </label>

                            <div class="col-sm-10">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th class="text-center">Assessment Criteria</th>
                                    <th class="text-center">Result / Comments</th>
                                    <th class="text-center">Requirements (%)</th>                                   
                                </tr>
                               
                                </thead>
                                <tbody>
                                <tr>
                                    <th class="text-center">Color Change (Widthout Suppressor)</th>
                                    <td class="text-center" ></td>
                                    <td class="text-center"></td>
                                </tr>
                                <tr>
                                    <th class="text-center">Color Change (Without Suppressor)</th>
                                    <td class="text-center" >Not Applicable</td>
                                    <td class="text-center">-</td>
                                </tr>
                                <tr>
                                    <th class="text-center">Cross Staining</th>
                                    <td class="text-center" ></td>
                                    <td class="text-center"></td>
                                </tr>
                                <tr>
                                    <th class="text-center">Differential Shrinkage (%)</th>
                                    <td class="text-center" >Not Applicable</td>
                                    <td class="text-center">-</td>
                                </tr>

                                <tr>
                                    <th class="text-center">Surface Fuzzing</th>
                                    <td class="text-center" ></td>
                                    <td class="text-center"></td>
                                </tr>
                                <tr>
                                    <th class="text-center">Surface Pilling</th>
                                    <td class="text-center" ></td>
                                    <td class="text-center"></td>
                                </tr>
                                <tr>
                                    <th class="text-center">Crease</th>
                                    <td class="text-center" ></td>
                                    <td class="text-center"></td>
                                </tr>
                                <tr>
                                    <th class="text-center">Abrasive Mark</th>
                                    <td class="text-center" >No</td>
                                    <td class="text-center">No</td>
                                </tr>
                                <tr>
                                    <th class="text-center">Seam Breakdown</th>
                                    <td class="text-center" >No</td>
                                    <td class="text-center">No</td>
                                </tr>
                                <tr>
                                    <th class="text-center">Seam puckering or roping</th>
                                    <td class="text-center" ></td>
                                    <td class="text-center"></td>
                                </tr>
                                <tr>
                                    <th class="text-center">Detachment of interlinings / fused components</th>
                                    <td class="text-center" >Not Applicable</td>
                                    <td class="text-center">-</td>
                                </tr>

                                <tr>
                                    <th class="text-center">Change in handle or appearance.</th>
                                    <td class="text-center" >Not Change in Apprearance was observed</td>
                                    <td class="text-center">-</td>
                                </tr>
                                <tr>
                                    <th class="text-center">Effect on accessories such as buttons, zips etc.</th>
                                    <td class="text-center" >Not Applicable</td>
                                    <td class="text-center"></td>
                                </tr>
                                <tr>
                                    <th class="text-center">Spirality (%)</th>
                                    <td class="text-center" >0%</td>
                                    <td class="text-center"></td>
                                </tr>
                                <tr>
                                    <th class="text-center">Detachment or Fraying of ribbons / trims</th>
                                    <td class="text-center" >Not Applicable</td>
                                    <td class="text-center"></td>
                                </tr>
                                <tr>
                                    <th class="text-center">Loss of print</th>
                                    <td class="text-center" >No</td>
                                    <td class="text-center">No</td>
                                </tr>
                                <tr>
                                    <th class="text-center">Odor</th>
                                    <td class="text-center" >No bad odor was found</td>
                                    <td class="text-center"></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                   
                </form>
            </div>  <!-- End of <div id="element_for_test"> -->
             
        </body>   <!-- End of <body id="element_for_test"> -->


         </div>   <!-- End of <div class="panel panel-default"> -->



         	 <button id="print" class="btn btn-primary align-center" name="print" onclick="generate_pdf()">Print</button>

     </div>   <!-- End of <div class="col-sm-12 col-md-12 col-lg-12"> -->





