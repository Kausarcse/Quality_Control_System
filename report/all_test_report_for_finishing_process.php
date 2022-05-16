<?php
error_reporting(0);
session_start();

include('../login/db_connection_class.php');
$obj = new DB_Connection_Class();
$obj->connection();

 $value=$_GET['value'];

$splitted_value=explode("?fs?", $value);
 $pp_number=$splitted_value[0];
$version_number=$splitted_value[1];
$version_number = mysqli_real_escape_string($con, $version_number);
$customer_name=$splitted_value[2];
$customer_id=$splitted_value[3];
$style=$splitted_value[4];
$finish_width_in_inch=$splitted_value[5];
$before_trolley_number_or_batcher_number=$splitted_value[6];
$after_trolley_number_or_batcher_number=$splitted_value[7];

 
$get_value=$pp_number.'?fs?'.$version_number.'?fs?'.$customer_name.'?fs?'.$customer_id.'?fs?'.$style.'?fs?'.$finish_width_in_inch.'?fs?'.$before_trolley_number_or_batcher_number.'?fs?'.$after_trolley_number_or_batcher_number;
$form="";


    


    /***************** Displaying Result from qc_standard table [Start] *****************/
    $sql_for_finishing_process="select * from defining_qc_standard_for_finishing_process WHERE customer_name='$customer_name' and pp_number= '$pp_number' and version_number='$version_number'";

    
    $report_for_finishing_process=mysqli_query($con,$sql_for_finishing_process) or die(mysqli_error($con));
    $row_for_defining_process=mysqli_fetch_array($report_for_finishing_process);

    /***************** Displaying Result from qc_standard table [END] *****************/


    /************ Displaying Result from qc_result table [Start] ************/
    $sql_for_finishing_process_qc_result="select * from qc_result_for_finishing_process WHERE customer_name='$customer_name' and pp_number= '$pp_number' and version_number='$version_number' and `finish_width_in_inch`='$finish_width_in_inch' and `before_trolley_number_or_batcher_number`='$before_trolley_number_or_batcher_number' and `after_trolley_number_or_batcher_number`='$after_trolley_number_or_batcher_number'";

    
        
    // $sql_for_finishing_process_qc_result="select * from qc_result_for_finishing_process WHERE customer_name='Ikea' and pp_number= '5893/2020' and version_number='Qc Back'";
    $report_for_finishing_process_qc=mysqli_query($con,$sql_for_finishing_process_qc_result) or die(mysqli_error($con));
    $row_for_qc=mysqli_fetch_array($report_for_finishing_process_qc);
   

   /*For sanforizing Process*/


    $sql_for_sanforizing_process_qc_result="select * from qc_result_for_sanforizing_process WHERE customer_name='$customer_name' and pp_number= '$pp_number' and version_number='$version_number' and `finish_width_in_inch`='$finish_width_in_inch' and  current_state='PP Completed'";

    $report_for_sanforizing_process_qc=mysqli_query($con,$sql_for_sanforizing_process_qc_result) or die(mysqli_error($con));
    $row_for_qc_for_sanforizing=mysqli_fetch_array($report_for_sanforizing_process_qc);

    

    $sql_for_calendering_process_qc_result="select * from qc_result_for_calendering_process WHERE customer_name='$customer_name' and pp_number= '$pp_number' and version_number='$version_number' and `finish_width_in_inch`='$finish_width_in_inch' and current_state='PP Completed'";

     $report_for_calendering_process_qc=mysqli_query($con,$sql_for_calendering_process_qc_result) or die(mysqli_error($con));
     $row_for_qc_for_calendering=mysqli_fetch_array($report_for_calendering_process_qc);

    
    if($row_for_qc_for_sanforizing['current_state']=='PP Completed')
    {

          $sql_for_sanforizing_process_qc_result_supplimentery="select * from qc_result_for_sanforizing_process WHERE customer_name='$customer_name' and pp_number= '$pp_number' and version_number='$version_number' and `finish_width_in_inch`='$finish_width_in_inch' and current_state='PP Completed'";



        $report_for_sanforizing_process_qc_supplimentery=mysqli_query($con,$sql_for_sanforizing_process_qc_result_supplimentery) or die(mysqli_error($con));
        $row_for_qc_supplimentery=mysqli_fetch_array($report_for_sanforizing_process_qc_supplimentery);


    }
    else if($row_for_qc_for_calendering['current_state']=='PP Completed')
    {
     

          $sql_for_calendering_process_qc_result_supplimentery="select * from qc_result_for_calendering_process WHERE customer_name='$customer_name' and pp_number= '$pp_number' and version_number='$version_number' and `finish_width_in_inch`='$finish_width_in_inch' and current_state='PP Completed'";

         $report_for_calendering_process_qc_supplimentery=mysqli_query($con,$sql_for_calendering_process_qc_result_supplimentery) or die(mysqli_error($con));
         $row_for_qc_supplimentery=mysqli_fetch_array($report_for_calendering_process_qc_supplimentery);

    }
    else if($row_for_qc['current_state']=='PP Completed')

    {  

     $sql_for_finishing_process_qc_result_supplimentery="select * from qc_result_for_finishing_process WHERE customer_name='$customer_name' and pp_number= '$pp_number' and version_number='$version_number' and `finish_width_in_inch`='$finish_width_in_inch'and current_state='PP Completed'";

    
            
        // $sql_for_finishing_process_qc_result="select * from qc_result_for_finishing_process WHERE customer_name='Ikea' and pp_number= '5893/2020' and version_number='Qc Back'";
        $report_for_finishing_process_qc_supplimentery=mysqli_query($con,$sql_for_finishing_process_qc_result_supplimentery) or die(mysqli_error($con));
        $row_for_qc_supplimentery=mysqli_fetch_array($report_for_finishing_process_qc_supplimentery);

        

    }

  
    /************ Displaying Result from qc_result table [End] ************/



   /***************** Displaying Result from process_program_info table [Start] *****************/
    $sql_for_process_program_info="SELECT distinct * FROM process_program_info ppi
    INNER JOIN pp_wise_version_creation_info pwvci on ppi.pp_number=pwvci.pp_number
    INNER JOIN partial_test_for_test_result_info ptftri  on ppi.pp_number=ptftri.pp_number and  pwvci.version_name=ptftri.version_number and pwvci.style_name=ptftri.style and pwvci.finish_width_in_inch=ptftri.finish_width_in_inch
     WHERE ppi.customer_name='$customer_name' and ppi.pp_number= '$pp_number' and pwvci.version_name='$version_number' and pwvci.`style_name`='$style' and pwvci.`finish_width_in_inch`='$finish_width_in_inch' and ptftri.process_id='proc_16'";
   
   
    $report_for_process_program_info=mysqli_query($con,$sql_for_process_program_info) or die(mysqli_error($con));
    $row_for_process_program_info=mysqli_fetch_array($report_for_process_program_info);




    /*$sql_for_process_program_info="SELECT * FROM partial_test_for_test_result_info ptftri
    INNER JOIN pp_wise_version_creation_info pwvci on ptftri.pp_number=pwvci.pp_number
     WHERE ptftri.customer_name='$customer_name' and ptftri.pp_number= '$pp_number' and ptftri.version_number='$version_number' and ptftri.`style`='$style' and ptftri.`finish_width_in_inch`='$finish_width_in_inch'";
   
    
    $report_for_process_program_info=mysqli_query($con,$sql_for_process_program_info) or die(mysqli_error($con));
    $row_for_process_program_info=mysqli_fetch_array($report_for_process_program_info);*/

    /***************** Displaying Result from process_program_info table [END] *****************/
    
    //  $sql="SELECT distinct tnm.id,tmc.test_method_id,  IF(tmc.test_method_name <> 'Other',concat(tmc.test_name,'(',tmc.test_method_name,')'),tmc.test_name) test_name_method
    // from test_name_and_method_for_all_process tnm 
    // INNER JOIN transaction_test_name_and_method ttnm on tnm.id = ttnm.test_name_and_method_for_process_id
    // INNER JOIN test_method_for_customer tmc on tmc.iso_or_aatcc = ttnm.iso_or_aatcc and tmc.test_id=ttnm.test_name_id and tmc.test_method_id=ttnm.test_method_id
    // where tmc.customer_name = '$customer_name' ORDER BY tnm.id asc";

   $sql = "SELECT DISTINCT tnmp.id, tmn.test_method_id, IF(tmn.test_method_name <> 'Other',concat(tmn.test_name,'(',tmn.test_method_name,')'),tmn.test_name) test_name_method
    FROM test_name_and_method_for_all_process tnmp
    INNER JOIN test_method_name tmn ON tnmp.id = tmn.test_name_and_method_for_process_id 
    INNER JOIN transaction_test_name_and_method ttnm ON ttnm.test_name_and_method_for_process_id = tmn.test_name_and_method_for_process_id
    INNER JOIN test_method_for_customer tmc ON tmc.test_id = ttnm.test_name_id AND tmc.test_method_id = tmn.test_method_id
    WHERE tmc.customer_name = '$customer_name' ORDER BY ttnm.test_name_and_method_for_process_id ASC";


$sql_for_customer = "SELECT customer_type from customer WHERE customer_id = '$customer_id' AND customer_name = '$customer_name'";
	$result_for_customer = mysqli_query($con, $sql_for_customer) or die(mysqli_error($con));
	$row_for_customer = mysqli_fetch_assoc($result_for_customer);
	
	 $customer_type =  $row_for_customer['customer_type'];
    
?>


<style>

.form-group     /* This is for reducing Gap among Form's Fields */
{

    margin-bottom: 5px;

}

.table
{
    font-size: 12px;
    font-family:Calibri;
    
}
</style>

<script>




function generate_pdf_for_all_test(){
    var element = document.getElementById("element")
    var element_for_test = document.getElementById("element_for_test")

    html2pdf(element,{
        margin: 10,
        filename: 'partial_test_for_all_test.pdf',
        image: {type: 'jpeg',  quality: 0.98 },
        html2canvas: {scale: 2, logging: true, dpi: 200, letterRendering: true },
        jsPDF: {unit: 'mm', format: 'a4', orientation: 'portrait'}

    });

}


// function readURL(input) {
//             if (input.files && input.files[0]) {
//                 var reader = new FileReader();

//                 reader.onload = function (e) {
//                     $('#sample_image')
//                         .attr('src', e.target.result);
//                 };

//                 reader.readAsDataURL(input.files[0]);
//             }
//         }



</script>


<!-- For time -->
<script>
    /*var dt = new Date();
    document.getElementById("datetime").innerHTML = dt.toLocaleString();
    document.getElementById("datetime_test").innerHTML = dt.toLocaleString();
    document.getElementById("datetime_test_conclusion").innerHTML = dt.toLocaleString();*/

    document.getElementById("datetime").innerHTML= (`${da}-${mo}-${ye}`);
    document.getElementById("datetime_test").innerHTML= (`${da}-${mo}-${ye}`);
    document.getElementById("datetime_test_conclusion").innerHTML= (`${da}-${mo}-${ye}`);

</script>


       


<div class="col-sm-12 col-md-12 col-lg-12">
    <div class="panel panel-default">

           <body id="target">
             <div id="element">


                <form class="form-horizontal" action="" name="test_report_of_ikea_form" id="test_report_of_ikea_form"> 

                        <div class="form-group form-group-sm" id="form-group_for_test_report">
                        <div class="form-group form-group-sm" id="form-group_for_test_report" style="fort-size: 30px; p-2 m-auto">
                                    <label class=" col-lg-12 text-center"  for="name" style="font-size: 20px; margin-left: 20px;">Zaber & Zubair Quality Control Processing Labortory </label>
                                    
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

                        <div class="form-group form-group-sm" id="form-group_for_trf">
                                       <label class=" col-sm-4" for="name" style="float: right;" >Report No: <?php echo $row_for_process_program_info['trf_id']; ?></label>
                        </div>
                        
                         <div class="form-group form-group-sm" id="form-group_for_test_report_of_ikea">

                            <label class=" col-sm-4" for="name" style="float: right;" >ISSUE DATE:<span id="datetime"></span></label>
                            
                            <label class=" col-sm-10 text-center" for="name" style="font-size: 30px;  margin-left: 20px;" >Test Report for <?php echo $row_for_process_program_info['customer_name']; ?></label>
                            
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
                        
                        <!-- <div class="form-group form-group-sm" id="form-group_for_test_report_of_ikea">
                            <div class="row from-group" style="margin-bottom: 5px;" >
                                <div class="col-sm-4"><strong style="margin-left: 50px;">REPORT NUMBER</strong></div>
                                <div class="col-sm-1"><strong>:</strong></div>
                                <div class="col-sm-7"><?php echo $row_for_qc['report_serial_no']?></div>
                            </div> -->

                            <div class="row from-group" style="margin-bottom: 5px;" >
                                <div class="col-sm-4"><strong style="margin-left: 50px;"> SAMPLE DETAILS/PP DETAILS</strong></div>
                                <div class="col-sm-1"><strong>:</strong></div>
                                <div class="col-sm-7"><?php echo $row_for_process_program_info['pp_description']?></div>
                            </div>

                            <div class="row from-group" style="margin-bottom: 5px;">
                                <div class="col-sm-4"><strong style="margin-left: 50px;">PP NO.</strong></div>
                                <div class="col-sm-1"><strong>:</strong></div>
                                <div class="col-sm-7"><?php echo $pp_number?></div>
                            </div>

                            <div class="row from-group" style="margin-bottom: 5px;">
                                <div class="col-sm-4"><strong style="margin-left: 50px;">DESIGN</strong></div>
                                <div class="col-sm-1"><strong>:</strong></div>
                                <div class="col-sm-7"><?php echo $row_for_process_program_info['design']?></div>
                            </div>

                            <div class="row from-group" style="margin-bottom: 5px;">
                                <div class="col-sm-4"><strong style="margin-left: 50px;">COLOR</strong></div>
                                <div class="col-sm-1"><strong>:</strong></div>
                                <div class="col-sm-7"><?php echo $row_for_process_program_info['color']?></div>
                            </div>

                            <div class="row from-group" style="margin-bottom: 5px;">
                                <div class="col-sm-4"><strong style="margin-left: 50px;">CONSTRUCTION</strong></div>
                                <div class="col-sm-1"><strong>:</strong></div>
                                <div class="col-sm-7" id="ppp"><?php echo $row_for_process_program_info['construction_name']?></div>
                            </div>

                            <div class="row from-group" style="margin-bottom: 5px;">
                                <div class="col-sm-4"><strong style="margin-left: 50px;">VERSION</strong></div>
                                <div class="col-sm-1"><strong>:</strong></div>
                                <div class="col-sm-7"><?php echo $row_for_process_program_info['version_name']?></div>
                            </div>

                            <div class="row" style="margin-bottom: 5px;">
                                <div class="col-sm-4"><strong style="margin-left: 50px;">STYLE</strong></div>
                                <div class="col-sm-1"><strong>:</strong></div>
                                <div class="col-sm-7"><?php echo $row_for_process_program_info['style_name']?></div>
                            </div>

                            <div class="row from-group" style="margin-bottom: 5px;">
                                <div class="col-sm-4"><strong style="margin-left: 50px;">WEEK</strong></div>
                                <div class="col-sm-1"><strong>:</strong></div>
                                <div class="col-sm-7"><?php echo $row_for_process_program_info['week_in_year']?></div>
                            </div>

                            <div class="row from-group" style="margin-bottom: 5px;">
                                <div class="col-sm-4"><strong style="margin-left: 50px;">FIBER COMPOSITION</strong></div>
                                <div class="col-sm-1"><strong>:</strong></div>
                                <div class="col-sm-7"><?php echo $row_for_process_program_info['percentage_of_cotton_content'].'% Cotton '.$row_for_process_program_info['percentage_of_polyester_content'].'% Polyester';
                                if($row_for_pp_version['other_fiber_in_yarn']=='Null')
                                {
                                    echo '';
                                }
                                else
                                {
                                    echo ' '.$row_for_process_program_info['percentage_of_other_fiber_content'].'% '.$row_for_process_program_info['other_fiber_in_yarn'];
                                }?></div>
                            </div>

                            <div class="row from-group" style="margin-bottom: 5px;">
                                <div class="col-sm-4"><strong style="margin-left: 50px;">PROCESS TECHNIQUE</strong></div>
                                <div class="col-sm-1"><strong>:</strong></div>
                                <div class="col-sm-7"><?php echo $row_for_process_program_info['process_technique_name']?></div>
                            </div>

                            <div class="row from-group" style="margin-bottom: 5px;">
                                <div class="col-sm-4"><strong style="margin-left: 50px;">CARE INSTRUCTION</strong></div>
                                <div class="col-sm-1"><strong>:</strong></div>
                                <div class="col-sm-7"> <!-- <img id="sample_image" src="" alt="image" /> --> <?php echo '<img type="image" alt="image" src="'.$row_for_process_program_info['washing'].'" width="30" height="20"/>'.'  '.'<img type="image" src="'.$row_for_process_program_info['bleaching'].'"  width="30" height="20"/>'.'  '.'<img type="image" src="'.$row_for_process_program_info['ironing'].'"  width="30" height="20"/> '. '  '.'<img type="image" src="'.$row_for_process_program_info['dry_cleaning'].'"  width="30" height="20"/>'.'  '.'<img type="image" src="'.$row_for_process_program_info['drying'].'"  width="30" height="20"/>'; ?></div> 
                            </div>

                            <div class="row from-group" style="margin-bottom: 5px;">
                                <div class="col-sm-4"><strong style="margin-left: 50px;">SAMPLE PICTURE</strong></div>
                                <div class="col-sm-1"><strong>:</strong></div>
                                <div class="col-sm-7"><img id="sample_image" name="sample_image"  alt="image" src="img/<?php echo $row_for_process_program_info['sample_picture']?>"  width="150" height="150"></div>
                            </div>
                                                    
                        </div>
                        <hr/>
                        <br/>
                        <br/>
                        
                        

                        <div class="row form-group form-group-sm" id="form-group_for_test_report_of_ikea">
                            <div class="col-sm-4" style="margin-left: 15;"><label class="text-end">Reported By:<u><?php echo $row_for_process_program_info['employee_name']?></u></label></div>
                            
                            <div class="col-sm-4"><label class="text-end"><u><?php //echo $row_for_qc['recording_person_name'] ?></u></label></div>

                           
                            <div class="col-sm-4">						   		
                                <label for="signature">Verified By: <span><img id="sample_image" name="sample_image"  alt="image" src="img/<?php echo $row_for_process_program_info['verified_signature']?>"  width="150" height="40"></span></label>	
                            </div>
                          
                        </div>


                        
                    
                </form>


            </div>  <!-- End of <div id="element"> -->
             
        </body>   <!-- End of <body id="target"> -->


    </div>   <!-- End of <div class="panel panel-default"> -->


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

                        <div class="form-group form-group-sm" id="form-group_for_trf">
                                       <label class=" col-sm-4" for="name" style="float: right;" >Report No:<?php echo $row_for_process_program_info['trf_id']; ?></label>
                        </div>
                       
                        <div class="form-group form-group-sm" id="form-group_for_test_report_of_ikea">
                            
                            <label class=" col-sm-4" for="name" style="float: right;" >ISSUE DATE:<span id="datetime_test_conclusion"></span></label>

                            <label class=" col-sm-10" for="name" style="font-size: 20px;  margin-left: 30px;" >TEST CONCLUSION :</label>
                            <!-- <div class="col-sm-4" style="float: right"> -->
                              
                                    <!-- <?php /*echo "<img type='image' alt='testing' src='barcode/barcode.php?codetype=Code39&size=40&text='.$trf_id.'&print=true'/>"*/; ?> -->

                                        <!-- <?php 
                                           //include '../barcode/barcode.php';
                                        ?>
                                        <?php  //echo "<p class='inline'><span ><b>TRF ID".bar128(stripcslashes($row_for_trf['trf_id']))."</b></span></p>&nbsp&nbsp&nbsp&nbsp"; ?> -->
                                
                             <!-- </div>  ENd of <div class="col-sm-7" style="text-align: right;"> -->
                        </div>

                       

                            <?php
                            $table="<div class='form-group form-group-sm'>
                               <div class='col-sm-12'>
                                 <table class='table table-bordered'>
                            <thead><tr>
                                    <th>TEST NAME</th>
                                    <th>METHOD</th>
                                    <th>PASS</th>
                                    <th>FAIL</th>
                                    <th>DATA</th>
                            </tr></thead>
                            <tbody> 
                            ";
                            
                            $total_test=0;
                            $p=0;
                            $f=0;
                           
                            $data="";
                            $data_for_test_method_id="";
                            $test_name_method="";
                            $result= mysqli_query($con,$sql) or die(mysqli_error($con));
                                         while( $row = mysqli_fetch_array( $result))
                                         {
                                            
                                            if(in_array($row['id'],['1']))
                                            {
                                                if ($row_for_defining_process['cf_to_rubbing_dry_max_value']<>0 && $row_for_defining_process['cf_to_rubbing_wet_max_value']<>0 && $row_for_qc['cf_to_rubbing_dry_value']<>0 && $row_for_qc['cf_to_rubbing_dry_value']<>0 ) 
                                                {   
                        
                        
                                                    $total_test++;
                        
                                                    $split=explode('(', $row['test_name_method']);
                                                            $test_name=$split[0];
                                                            $test_method_name=$split[1];
                        
                                                    if($row_for_defining_process['cf_to_rubbing_dry_min_value']<=$row_for_qc['cf_to_rubbing_dry_value'] && $row_for_defining_process['cf_to_rubbing_dry_max_value']>=$row_for_qc['cf_to_rubbing_dry_value'] && $row_for_defining_process['cf_to_rubbing_wet_min_value']<=$row_for_qc['cf_to_rubbing_wet_value'] && $row_for_defining_process['cf_to_rubbing_wet_max_value']>=$row_for_qc['cf_to_rubbing_wet_value'])
                                                    {
                                                        $p++;
                                                        
                                                            
                                                        $table.="<tr>
                                                            <td>".$test_name."</td>
                                                            <td>".'('.$test_method_name."</td>
                                                            <td>X</td>
                                                            <td></td>
                                                            <td></td>
                                                            </tr>";
                                                    }
                                                    else 
                                                    {
                                                        $f++;
                                                        
                                                        $table.="<tr>
                                                            <td>".$test_name.' (Dry)'."</td>
                                                            <td>".'('.$test_method_name."</td>
                                                            <td></td>
                                                            <td>X</td>
                                                            <td></td>
                                                            </tr>";
                                                    }
                                                } 
                                             }  /* End of   if(in_array($row['id'],['1']))*/
                                               
                                            
                                            if (in_array($row['id'], ['2']))
                                            {
                                                
                                                if ($row_for_defining_process['dimensional_stability_to_warp_washing_before_iron_max_value']<>0 && $row_for_defining_process['dimensional_stability_to_weft_washing_before_iron_max_value']<>0 && $row_for_qc_supplimentery['dimensional_stability_to_warp_washing_before_iron_value']<>0 && $row_for_qc_supplimentery['dimensional_stability_to_warp_washing_before_iron_value']<>0) 
                                                {   
                                                    $total_test++;
                        
                                                    $split=explode('(', $row['test_name_method']);
                                                            $test_name=$split[0];
                                                            $test_method_name=$split[1];
                        
                                                    if($row_for_defining_process['dimensional_stability_to_warp_washing_before_iron_min_value']<=$row_for_qc_supplimentery['dimensional_stability_to_warp_washing_before_iron_value'] && $row_for_defining_process['dimensional_stability_to_warp_washing_before_iron_max_value']>=$row_for_qc_supplimentery['dimensional_stability_to_warp_washing_before_iron_value'] && $row_for_defining_process['dimensional_stability_to_weft_washing_before_iron_min_value']<=$row_for_qc_supplimentery['dimensional_stability_to_weft_washing_before_iron_value'] && $row_for_defining_process['dimensional_stability_to_weft_washing_before_iron_max_value']>=$row_for_qc_supplimentery['dimensional_stability_to_weft_washing_before_iron_value'])
                                                    {
                                                        $p++;  
                                                        $table.="<tr>
                                                            <td>".$test_name."</td>
                                                            <td>".'('.$test_method_name.")</td>
                                                            <td>X</td>
                                                            <td></td>
                                                            <td></td>
                                                            </tr>";
                                                    }
                                                    else 
                                                    {
                                                        $f++;
                                                        $table.="<tr>
                                                            <td>".$test_name.'(Before Iron)'."</td>
                                                            <td>".'('.$test_method_name.")</td>
                                                            <td></td>
                                                            <td>X</td>
                                                           <td></td>
                                                            </tr>";
                                                    }
                        
                        
                                                }

                                               
                                                
                                                if ($row_for_defining_process['dimensional_stability_to_warp_washing_after_iron_max_value']<>0 && $row_for_defining_process['dimensional_stability_to_weft_washing_after_iron_max_value']<>0 && $row_for_qc_supplimentery['dimensional_stability_to_warp_washing_after_iron_value']<>0 && $row_for_qc_supplimentery['dimensional_stability_to_weft_washing_after_iron_value']<>0) 
                                                {   
                                                    $total_test++;
                        
                                                    $split=explode('(', $row['test_name_method']);
                                                            $test_name=$split[0];
                                                            $test_method_name=$split[1];
                        
                                                    if($row_for_defining_process['dimensional_stability_to_warp_washing_after_iron_min_value']<=$row_for_qc_supplimentery['dimensional_stability_to_warp_washing_after_iron_value'] && $row_for_defining_process['dimensional_stability_to_warp_washing_after_iron_max_value']>=$row_for_qc_supplimentery['dimensional_stability_to_warp_washing_after_iron_value'] && $row_for_defining_process['dimensional_stability_to_weft_washing_after_iron_min_value']<=$row_for_qc_supplimentery['dimensional_stability_to_weft_washing_after_iron_value'] && $row_for_defining_process['dimensional_stability_to_weft_washing_after_iron_max_value']>=$row_for_qc_supplimentery['dimensional_stability_to_weft_washing_after_iron_value'])
                                                    {
                                                        $p++;  
                                                        $table.="<tr>
                                                            <td>".$test_name.'(After Iron)'."</td>
                                                            <td>".'('.$test_method_name."</td>
                                                            <td>X</td>
                                                            <td></td>
                                                             <td></td>
                                                            </tr>";
                                                    }
                                                    else 
                                                    {
                                                        $f++;
                                                        $table.="<tr>
                                                            <td>".$test_name.'(After Iron-Warp)'."</td>
                                                            <td>".'('.$test_method_name."</td>
                                                            <td></td>
                                                            <td>X</td>
                                                            <td></td>
                                                            </tr>";
                                                    }
                                                }

                                               

                                            } /* End of if (in_array($row['id'], ['2']))*/
                                            
                                            if (in_array($row['id'], ['74']))
                                            {
                                                
                                                if ($row_for_defining_process['warp_yarn_count_max_value']<>0 && $row_for_defining_process['weft_yarn_count_max_value']<>0 && $row_for_qc['warp_yarn_count_value']<>0 && $row_for_qc['weft_yarn_count_value']<>0) 
                                                {   
                        
                        
                                                    $total_test++;
                        
                                                    $split=explode('(', $row['test_name_method']);
                                                            $test_name=$split[0];
                                                            $test_method_name=$split[1];
                        
                                                    if($row_for_defining_process['warp_yarn_count_min_value']<=$row_for_qc['warp_yarn_count_value'] && $row_for_defining_process['warp_yarn_count_max_value']>=$row_for_qc['warp_yarn_count_value'] && $row_for_defining_process['weft_yarn_count_min_value']<=$row_for_qc['weft_yarn_count_value'] && $row_for_defining_process['weft_yarn_count_max_value']>=$row_for_qc['weft_yarn_count_value'])
                                                    {
                                                        $p++;
                                                        $table.="<tr>
                                                            <td>".$test_name."</td>
                                                            <td>".'('.$test_method_name.")</td>
                                                            <td>X</td>
                                                            <td></td>
                                                            <td></td>
                                                            </tr>";
                                                    }
                                                    else 
                                                    {
                                                        $f++;
                                                        
                                                        $table.="<tr>
                                                            <td>".$test_name.'(Warp)'."</td>
                                                            <td>".'('.$test_method_name.")</td>
                                                            <td></td>
                                                            <td>X</td>
                                                            <td></td>
                                                            </tr>";
                                                    }
                                                }

                                               
                                            } /* End of if (in_array($row['id'], ['74']))*/


                                            if (in_array($row['id'], ['4']))
                                            {
                                                
                                                if ($row_for_defining_process['no_of_threads_in_warp_max_value']<>0  && $row_for_defining_process['no_of_threads_in_weft_max_value']<>0 && $row_for_qc_supplimentery['no_of_threads_in_warp_value']<>0 && $row_for_qc_supplimentery['no_of_threads_in_weft_value']<>0 ) 
                                                {   
                        
                        
                                                    $total_test++;
                        
                                                    $split=explode('(', $row['test_name_method']);
                                                            $test_name=$split[0];
                                                            $test_method_name=$split[1];
                        
                                                    if($row_for_defining_process['no_of_threads_in_warp_min_value']<=$row_for_qc_supplimentery['no_of_threads_in_warp_value'] && $row_for_defining_process['no_of_threads_in_warp_max_value']>=$row_for_qc_supplimentery['no_of_threads_in_warp_value'] && $row_for_defining_process['no_of_threads_in_weft_min_value']<=$row_for_qc_supplimentery['no_of_threads_in_weft_value'] && $row_for_defining_process['no_of_threads_in_weft_max_value']>=$row_for_qc_supplimentery['no_of_threads_in_weft_value'])
                                                    {
                                                        $p++;
                                                        $table.="<tr>
                                                            <td>".$test_name."</td>
                                                            <td>".'('.$test_method_name."</td>
                                                            <td>X</td>
                                                            <td></td>
                                                            <td></td>
                                                            </tr>";
                                                    }
                                                    else 
                                                    {
                                                        $f++;
                                                        
                                                        $table.="<tr>
                                                            <td>".$test_name."</td>
                                                            <td>".'('.$test_method_name."</td>
                                                            <td></td>
                                                            <td>X</td>
                                                            <td></td>
                                                            </tr>";
                                                    }
                                                }

                                              
                                            } /* End of if (in_array($row['id'], ['4']))*/

                                            
                                            if (in_array($row['id'], ['5']))
                                            {
                                                
                                                if ($row_for_defining_process['mass_per_unit_per_area_max_value']<>0 && $row_for_qc_supplimentery['mass_per_unit_per_area_value']<>0) 
                                                {   
                        
                        
                                                    $total_test++;
                        
                                                    $split=explode('(', $row['test_name_method']);
                                                            $test_name=$split[0];
                                                            $test_method_name=$split[1];
                        
                                                    if($row_for_defining_process['mass_per_unit_per_area_min_value']<=$row_for_qc_supplimentery['mass_per_unit_per_area_value'] && $row_for_defining_process['mass_per_unit_per_area_max_value']>=$row_for_qc_supplimentery['mass_per_unit_per_area_value'])
                                                    {
                                                        $p++;
                                                        $table.="<tr>
                                                            <td>".$test_name."</td>
                                                            <td>".'('.$test_method_name."</td>
                                                            <td>X</td>
                                                            <td></td>
                                                            <td></td>
                                                            </tr>";
                                                    }
                                                    else 
                                                    {
                                                        $f++;
                                                        
                                                        $table.="<tr>
                                                            <td>".$test_name."</td>
                                                            <td>".'('.$test_method_name."</td>
                                                            <td></td>
                                                            <td>X</td>
                                                            <td></td>
                                                            </tr>";
                                                    }
                                                }

                                            } /* End of if (in_array($row['id'], ['5']))*/



                                            if (in_array($row['id'], ['6']))
                                            {
                                                
                                                if ($row_for_defining_process['surface_fuzzing_and_pilling_max_value']<>0 && $row_for_qc['surface_fuzzing_and_pilling_value']<>0 ) 
                                                {   
                        
                        
                                                    $total_test++;
                        
                                                    $split=explode('(', $row['test_name_method']);
                                                            $test_name=$split[0];
                                                            $test_method_name=$split[1];
                        
                                                    if($row_for_defining_process['surface_fuzzing_and_pilling_min_value']<=$row_for_qc['surface_fuzzing_and_pilling_value'] && $row_for_defining_process['surface_fuzzing_and_pilling_max_value']>=$row_for_qc['surface_fuzzing_and_pilling_value'])
                                                    {
                                                        $p++;
                                                        
                                                            
                                                        $table.="<tr>
                                                            <td>".$test_name."</td>
                                                            <td>".'('.$test_method_name."</td>
                                                            <td>X</td>
                                                            <td></td>
                                                             <td></td>
                                                            </tr>";
                                                    }
                                                    else 
                                                    {
                                                        $f++;
                                                        
                                                        $table.="<tr>
                                                            <td>".$test_name."</td>
                                                            <td>".'('.$test_method_name."</td>
                                                            <td></td>
                                                            <td>X</td>
                                                            <td></td>
                                                            </tr>";
                                                    }
                        
                        
                                                }
                                            } /* End of if (in_array($row['id'], ['6', '101']))*/

                                            if (in_array($row['id'], ['7']))
                                            {
                                                
                                                if ($row_for_defining_process['tensile_properties_in_warp_value_max_value']<>0 && $row_for_defining_process['tensile_properties_in_weft_value_max_value']<>0 && $row_for_qc['tensile_properties_in_warp_value']<>0 && $row_for_qc['tensile_properties_in_weft_value']<>0) 
                                                {   
                        
                        
                                                    $total_test++;
                        
                                                    $split=explode('(', $row['test_name_method']);
                                                            $test_name=$split[0];
                                                            $test_method_name=$split[1];
                        
                                                    if($row_for_defining_process['tensile_properties_in_warp_value_min_value']<=$row_for_qc['tensile_properties_in_warp_value'] && $row_for_defining_process['tensile_properties_in_warp_value_max_value']>=$row_for_qc['tensile_properties_in_warp_value'] && $row_for_defining_process['tensile_properties_in_weft_value_min_value']<=$row_for_qc['tensile_properties_in_weft_value'] && $row_for_defining_process['tensile_properties_in_weft_value_max_value']>=$row_for_qc['tensile_properties_in_weft_value'])
                                                    {
                                                        $p++;
                                                        $table.="<tr>
                                                            <td>".$test_name."</td>
                                                            <td>".'('.$test_method_name."</td>
                                                            <td>X</td>
                                                            <td></td>
                                                            <td></td>
                                                            </tr>";
                                                    }
                                                    else 
                                                    {
                                                        $f++;
                                                        
                                                        $table.="<tr>
                                                            <td>".$test_name."</td>
                                                            <td>".'('.$test_method_name."</td>
                                                            <td></td>
                                                            <td>X</td>
                                                            <td></td>
                                                            </tr>";
                                                    }
                                                }

                                               
                                            } /*End of if (in_array($row['id'], ['7', '115', '263', '274', '302']))*/



                                            if (in_array($row['id'], ['8']))
                                            {
                                                
                                                if ($row_for_defining_process['tear_force_in_warp_value_max_value']<>0 && $row_for_defining_process['tear_force_in_weft_value_max_value']<>0 && $row_for_qc['tear_force_in_warp_value']<>0 && $row_for_qc['tear_force_in_weft_value']<>0 ) 
                                                {   
                        
                        
                                                    $total_test++;
                        
                                                    $split=explode('(', $row['test_name_method']);
                                                            $test_name=$split[0];
                                                            $test_method_name=$split[1];
                        
                                                    if($row_for_defining_process['tear_force_in_warp_value_min_value']<=$row_for_qc['tear_force_in_warp_value'] && $row_for_defining_process['tear_force_in_warp_value_max_value']>=$row_for_qc['tear_force_in_warp_value'] && $row_for_defining_process['tear_force_in_weft_value_min_value']<=$row_for_qc['tear_force_in_weft_value'] && $row_for_defining_process['tear_force_in_weft_value_max_value']>=$row_for_qc['tear_force_in_weft_value'])
                                                    {
                                                        $p++;
                                                        $table.="<tr>
                                                            <td>".$test_name."</td>
                                                            <td>".'('.$test_method_name."</td>
                                                            <td>X</td>
                                                            <td></td>
                                                           <td></td>
                                                            </tr>";
                                                    }
                                                    else 
                                                    {
                                                        $f++;
                                                        
                                                        $table.="<tr>
                                                            <td>".$test_name."</td>
                                                            <td>".'('.$test_method_name."</td>
                                                            <td></td>
                                                            <td>X</td>
                                                            <td></td>
                                                            </tr>";
                                                    }
                                                }

                                               
                                            }  /* End of  if (in_array($row['id'], ['8', '135', '148', '201', '275', '303']))*/

                                            if (in_array($row['id'], ['9']))
                                            {
                                                
                                                if ($row_for_defining_process['seam_slippage_resistance_in_warp_max_value']<>0 && $row_for_defining_process['seam_slippage_resistance_in_weft_max_value']<>0 && $row_for_qc['seam_slippage_resistance_in_warp_value']<>0 && $row_for_qc['seam_slippage_resistance_in_weft_value']<>0 ) 
                                                {   
                        
                        
                                                    $total_test++;
                        
                                                    $split=explode('(', $row['test_name_method']);
                                                            $test_name=$split[0];
                                                            $test_method_name=$split[1];
                        
                                                            if($row_for_defining_process['seam_slippage_resistance_in_warp_min_value']<=$row_for_qc['seam_slippage_resistance_in_warp_value'] && $row_for_defining_process['seam_slippage_resistance_in_warp_max_value']>=$row_for_qc['seam_slippage_resistance_in_warp_value'] && $row_for_defining_process['seam_slippage_resistance_in_weft_min_value']<=$row_for_qc['seam_slippage_resistance_in_weft_value'] && $row_for_defining_process['seam_slippage_resistance_in_weft_max_value']>=$row_for_qc['seam_slippage_resistance_in_weft_value'])
                                                            {
                                                        $p++;
                                                        $table.="<tr>
                                                            <td>".$test_name."</td>
                                                            <td>".'('.$test_method_name."</td>
                                                            <td>X</td>
                                                            <td></td>
                                                            <td></td>
                                                            </tr>";
                                                    }
                                                    else 
                                                    {
                                                        $f++;
                                                        
                                                        $table.="<tr>
                                                            <td>".$test_name."</td>
                                                            <td>".'('.$test_method_name."</td>
                                                            <td></td>
                                                            <td>X</td>
                                                            <td></td>
                                                            </tr>";
                                                    }
                                                }

                                                
                                            }  /* End of  if (in_array($row['id'], ['9', '135', '148', '201', '275', '303']))*/

                                           /* if (in_array($row['id'], ['9']))
                                            {
                                                
                                                if ($row_for_defining_process['seam_slippage_resistance_iso_2_in_warp_max_value']<>0 ) 
                                                {   
                        
                        
                                                    $total_test++;
                        
                                                    $split=explode('(', $row['test_name_method']);
                                                            $test_name=$split[0];
                                                            $test_method_name=$split[1];
                        
                                                            if($row_for_defining_process['seam_slippage_resistance_iso_2_in_warp_min_value']<=$row_for_qc['seam_slippage_resistance_iso_2_in_warp_value'] && $row_for_defining_process['seam_slippage_resistance_iso_2_in_warp_max_value']>=$row_for_qc['seam_slippage_resistance_iso_2_in_warp_value'])
                                                            {
                                                        $p++;
                                                        $table.="<tr>
                                                            <td>".$test_name.'(Warp)'."</td>
                                                            <td>".'('.$test_method_name."</td>
                                                            <td>X</td>
                                                            <td></td>
                                                            <td>".$row_for_qc['seam_slippage_resistance_iso_2_in_warp_value'].' '.$row_for_defining_process['uom_of_seam_slippage_resistance_iso_2_in_warp']."</td>
                                                            </tr>";
                                                    }
                                                    else 
                                                    {
                                                        $f++;
                                                        
                                                        $table.="<tr>
                                                            <td>".$test_name.'(Warp)'."</td>
                                                            <td>".'('.$test_method_name."</td>
                                                            <td></td>
                                                            <td>X</td>
                                                            <td>".$row_for_qc['seam_slippage_resistance_iso_2_in_warp_value'].' '.$row_for_defining_process['uom_of_seam_slippage_resistance_iso_2_in_warp']."</td>
                                                            </tr>";
                                                    }
                                                }

                                                if () 
                                                {   
                        
                        
                                                    $total_test++;
                        
                                                    $split=explode('(', $row['test_name_method']);
                                                            $test_name=$split[0];
                                                            $test_method_name=$split[1];
                        
                                                            if($row_for_defining_process['seam_slippage_resistance_iso_2_in_weft_min_value']<=$row_for_qc['seam_slippage_resistance_iso_2_in_weft_value'] && $row_for_defining_process['seam_slippage_resistance_iso_2_in_weft_max_value']>=$row_for_qc['seam_slippage_resistance_iso_2_in_weft_value'])
                                                            {
                                                        $p++;
                                                        $table.="<tr>
                                                            <td>".$test_name.'(Weft)'."</td>
                                                            <td>".'('.$test_method_name."</td>
                                                            <td>X</td>
                                                            <td></td>
                                                            <td>".$row_for_qc['seam_slippage_resistance_iso_2_in_weft_value'].' '.$row_for_defining_process['uom_of_seam_slippage_resistance_iso_2_in_weft']."</td>
                                                            </tr>";
                                                    }
                                                    else 
                                                    {
                                                        $f++;
                                                        
                                                        $table.="<tr>
                                                            <td>".$test_name.'(Weft)'."</td>
                                                            <td>".'('.$test_method_name."</td>
                                                            <td></td>
                                                            <td>X</td>
                                                            <td>".$row_for_qc['seam_slippage_resistance_iso_2_in_weft_value'].' '.$row_for_defining_process['uom_of_seam_slippage_resistance_iso_2_in_weft']."</td>
                                                            </tr>";
                                                    }
                                                }
                                            }  *//* End of  if (in_array($row['id'], ['9', '135', '148', '201', '275', '303']))*/

                                            if (in_array($row['id'], ['11']))
                                            {
                                                
                                                if ($row_for_defining_process['seam_strength_in_warp_value_max_value']<>0 && $row_for_defining_process['seam_strength_in_weft_value_max_value']<>0 && $row_for_qc['seam_strength_in_warp_value']<>0 && $row_for_qc['seam_strength_in_weft_value']<>0 ) 
                                                {   
                        
                        
                                                    $total_test++;
                        
                                                    $split=explode('(', $row['test_name_method']);
                                                            $test_name=$split[0];
                                                            $test_method_name=$split[1];
                        
                                                            if($row_for_defining_process['seam_strength_in_warp_value_min_value']<=$row_for_qc['seam_strength_in_warp_value'] && $row_for_defining_process['seam_strength_in_warp_value_max_value']>=$row_for_qc['seam_strength_in_warp_value'] && $row_for_defining_process['seam_strength_in_weft_value_min_value']<=$row_for_qc['seam_strength_in_weft_value'] && $row_for_defining_process['seam_strength_in_weft_value_max_value']>=$row_for_qc['seam_strength_in_weft_value'])
                                                            {
                                                        $p++;
                                                        $table.="<tr>
                                                            <td>".$test_name."</td>
                                                            <td>".'('.$test_method_name."</td>
                                                            <td>X</td>
                                                            <td></td>
                                                            <td></td>
                                                            </tr>";
                                                    }
                                                    else 
                                                    {
                                                        $f++;
                                                        
                                                        $table.="<tr>
                                                            <td>".$test_name."</td>
                                                            <td>".'('.$test_method_name."</td>
                                                            <td></td>
                                                            <td>X</td>
                                                            <td></td>
                                                            </tr>";
                                                    }
                                                }

                                               
                                            }  /* End of  if (in_array($row['id'], ['11', '135', '148', '201', '275', '303']))*/

                                            if (in_array($row['id'], ['12']))
                                            {
                                                
                                                if ($row_for_defining_process['seam_properties_seam_slippage_iso_astm_d_in_warp_max_value']<>0 && $row_for_defining_process['seam_properties_seam_slippage_iso_astm_d_in_weft_max_value']<>0 && $row_for_qc['seam_properties_seam_slippage_iso_astm_d_in_warp_value']<>0 && $row_for_qc['seam_properties_seam_slippage_iso_astm_d_in_weft_value']<>0 ) 
                                                {   
                        
                        
                                                    $total_test++;
                        
                                                    $split=explode('(', $row['test_name_method']);
                                                            $test_name=$split[0];
                                                            $test_method_name=$split[1];
                        
                                                            if($row_for_defining_process['seam_properties_seam_slippage_iso_astm_d_in_warp_min_value']<=$row_for_qc['seam_properties_seam_slippage_iso_astm_d_in_warp_value'] && $row_for_defining_process['seam_properties_seam_slippage_iso_astm_d_in_warp_max_value']>=$row_for_qc['seam_properties_seam_slippage_iso_astm_d_in_warp_value'] && $row_for_defining_process['seam_properties_seam_slippage_iso_astm_d_in_weft_min_value']<=$row_for_qc['seam_properties_seam_slippage_iso_astm_d_in_weft_value'] && $row_for_defining_process['seam_properties_seam_slippage_iso_astm_d_in_weft_max_value']>=$row_for_qc['seam_properties_seam_slippage_iso_astm_d_in_weft_value'])
                                                            {
                                                        $p++;
                                                        $table.="<tr>
                                                            <td>".$test_name."</td>
                                                            <td>".'('.$test_method_name."</td>
                                                            <td>X</td>
                                                            <td></td>
                                                            <td></td>
                                                            </tr>";
                                                    }
                                                    else 
                                                    {
                                                        $f++;
                                                        
                                                        $table.="<tr>
                                                            <td>".$test_name."</td>
                                                            <td>".'('.$test_method_name."</td>
                                                            <td></td>
                                                            <td>X</td>
                                                            <td></td>
                                                            </tr>";
                                                    }
                                                }

                                               

                                                
                                            }  /* End of  if (in_array($row['id'], ['12', '135', '148', '201', '275', '303']))*/

                                            if (in_array($row['id'], ['13']))
                                            {
                                                
                                                if ($row_for_defining_process['abrasion_resistance_no_of_thread_break_max_value']<>0 && $row_for_defining_process['abrasion_resistance_c_change_value_max_value']<>0 && $row_for_qc['abrasion_resistance_no_of_thread_break_value']<>0 && $row_for_qc['abrasion_resistance_c_change_value']<>0 ) 
                                                {   
                        
                        
                                                    $total_test++;
                        
                                                    $split=explode('(', $row['test_name_method']);
                                                            $test_name=$split[0];
                                                            $test_method_name=$split[1];
                        
                                                            if($row_for_defining_process['abrasion_resistance_no_of_thread_break_min_value']<=$row_for_qc['abrasion_resistance_no_of_thread_break_value'] && $row_for_defining_process['abrasion_resistance_no_of_thread_break_max_value']>=$row_for_qc['abrasion_resistance_no_of_thread_break_value'] && $row_for_defining_process['abrasion_resistance_c_change_value_min_value']<=$row_for_qc['abrasion_resistance_c_change_value'] && $row_for_defining_process['abrasion_resistance_c_change_value_max_value']>=$row_for_qc['abrasion_resistance_c_change_value'])
                                                            {
                                                        $p++;
                                                        $table.="<tr>
                                                            <td>".$test_name."</td>
                                                            <td>".'('.$test_method_name."</td>
                                                            <td>X</td>
                                                            <td></td>
                                                            <td></td>
                                                            </tr>";
                                                    }
                                                    else 
                                                    {
                                                        $f++;
                                                        
                                                        $table.="<tr>
                                                            <td>".$test_name."</td>
                                                            <td>".'('.$test_method_name."</td>
                                                            <td></td>
                                                            <td>X</td>
                                                            <td></td>
                                                            </tr>";
                                                    }
                                                }

                                                
                                            }  /* End of  if (in_array($row['id'], ['13', '135', '148', '201', '275', '303']))*/

                                            if (in_array($row['id'], ['14']))
                                            {
                                                
                                                if ($row_for_defining_process['mass_loss_in_abrasion_test_value_max_value']<>0) 
                                                {   
                        
                        
                                                    $total_test++;
                        
                                                    $split=explode('(', $row['test_name_method']);
                                                            $test_name=$split[0];
                                                            $test_method_name=$split[1];
                        
                                                            if($row_for_defining_process['mass_loss_in_abrasion_test_value_min_value']<=$row_for_qc['mass_loss_in_abrasion_value'] && $row_for_defining_process['mass_loss_in_abrasion_test_value_max_value']>=$row_for_qc['mass_loss_in_abrasion_value'])
                                                            {
                                                        $p++;
                                                        $table.="<tr>
                                                            <td>".$test_name."</td>
                                                            <td>".'('.$test_method_name."</td>
                                                            <td>X</td>
                                                            <td></td>
                                                            <td></td>
                                                            </tr>";
                                                    }
                                                    else 
                                                    {
                                                        $f++;
                                                        
                                                        $table.="<tr>
                                                            <td>".$test_name."</td>
                                                            <td>".'('.$test_method_name."</td>
                                                            <td></td>
                                                            <td>X</td>
                                                            <td></td>
                                                            </tr>";
                                                    }
                                                }

                                            }  /* End of  if (in_array($row['id'], ['14', '135', '148', '201', '275', '303']))*/

                                            if (in_array($row['id'], ['15','59']))
                                            {
                                                
                                                if ($row_for_defining_process['cf_to_washing_color_change_max_value']<>0 && $row_for_defining_process['cf_to_washing_staining_max_value']<>0 && $row_for_defining_process['cf_to_washing_staining_max_value']<>0) 
                                                {   
                        
                        
                                                    $total_test++;
                        
                                                    $split=explode('(', $row['test_name_method']);
                                                            $test_name=$split[0];
                                                            $test_method_name=$split[1];
                        
                                                            if($row_for_defining_process['cf_to_washing_color_change_min_value']<=$row_for_qc['cf_to_washing_color_change_value'] && $row_for_defining_process['cf_to_washing_color_change_max_value']>=$row_for_qc['cf_to_washing_color_change_value'] && $row_for_defining_process['cf_to_washing_staining_min_value']<=$row_for_qc['cf_to_washing_staining_value'] && $row_for_defining_process['cf_to_washing_staining_max_value']>=$row_for_qc['cf_to_washing_staining_value'] && $row_for_defining_process['cf_to_washing_cross_staining_min_value']<=$row_for_qc['cf_to_washing_cross_staining_value'] && $row_for_defining_process['cf_to_washing_cross_staining_max_value']>=$row_for_qc['cf_to_washing_cross_staining_value'])
                                                            {
                                                        $p++;
                                                        $table.="<tr>
                                                            <td>".$test_name."</td>
                                                            <td>".'('.$test_method_name."</td>
                                                            <td>X</td>
                                                            <td></td>
                                                            <td></td>
                                                            </tr>";
                                                    }
                                                    else 
                                                    {
                                                        $f++;
                                                        
                                                        $table.="<tr>
                                                            <td>".$test_name."</td>
                                                            <td>".'('.$test_method_name."</td>
                                                            <td></td>
                                                            <td>X</td>
                                                            <td></td>
                                                            </tr>";
                                                    }
                                                }

                                             
                                               

                                            }  /* End of  if in_array($row['id'], ['15','59'])*/

                                            if (in_array($row['id'], ['16']))
                                            {
                                                
                                                if ($row_for_defining_process['cf_to_dry_cleaning_color_change_max_value']<>0) 
                                                {   
                        
                        
                                                    $total_test++;
                        
                                                    $split=explode('(', $row['test_name_method']);
                                                            $test_name=$split[0];
                                                            $test_method_name=$split[1];
                        
                                                            if($row_for_defining_process['cf_to_dry_cleaning_color_change_min_value']<=$row_for_qc['cf_to_dry_cleaning_color_change_value'] && $row_for_defining_process['cf_to_dry_cleaning_color_change_max_value']>=$row_for_qc['cf_to_dry_cleaning_color_change_value'] && $row_for_defining_process['cf_to_dry_cleaning_staining_min_value']<=$row_for_qc['cf_to_dry_cleaning_staining_value'] && $row_for_defining_process['cf_to_dry_cleaning_staining_max_value']>=$row_for_qc['cf_to_dry_cleaning_staining_value'])
                                                            {
                                                        $p++;
                                                        $table.="<tr>
                                                            <td>".$test_name."</td>
                                                            <td>".'('.$test_method_name."</td>
                                                            <td>X</td>
                                                            <td></td>
                                                            <td></td>
                                                            </tr>";
                                                    }
                                                    else 
                                                    {
                                                        $f++;
                                                        
                                                        $table.="<tr>
                                                            <td>".$test_name."</td>
                                                            <td>".'('.$test_method_name."</td>
                                                            <td></td>
                                                            <td>X</td>
                                                            <td></td>
                                                            </tr>";
                                                    }
                                                }


                                            }  /* End of  if in_array($row['id'], ['16'])*/

                                            if (in_array($row['id'], ['17']))
                                            {
                                                
                                                if ($row_for_defining_process['cf_to_perspiration_acid_color_change_max_value']<>0) 
                                                {   
                                                    $total_test++;
                        
                                                    $split=explode('(', $row['test_name_method']);
                                                            $test_name=$split[0];
                                                            $test_method_name=$split[1];
                        
                                                            if($row_for_defining_process['cf_to_perspiration_acid_color_change_min_value']<=$row_for_qc['cf_to_perspiration_acid_color_change_value'] && $row_for_defining_process['cf_to_perspiration_acid_color_change_max_value']>=$row_for_qc['cf_to_perspiration_acid_color_change_value'] && $row_for_defining_process['cf_to_perspiration_acid_staining_min_value']<=$row_for_qc['cf_to_perspiration_acid_staining_value'] && $row_for_defining_process['cf_to_perspiration_acid_staining_max_value']>=$row_for_qc['cf_to_perspiration_acid_staining_value'] && $row_for_defining_process['cf_to_perspiration_acid_cross_staining_min_value']<=$row_for_qc['cf_to_perspiration_acid_cross_staining_value'] && $row_for_defining_process['cf_to_perspiration_acid_cross_staining_max_value']>=$row_for_qc['cf_to_perspiration_acid_cross_staining_value'])
                                                            {
                                                        $p++;
                                                        $table.="<tr>
                                                            <td>".$test_name."</td>
                                                            <td>".'('.$test_method_name."</td>
                                                            <td>X</td>
                                                            <td></td>
                                                            <<td></td>
                                                            </tr>";
                                                    }
                                                    else 
                                                    {
                                                        $f++;
                                                        
                                                        $table.="<tr>
                                                            <td>".$test_name."</td>
                                                            <td>".'('.$test_method_name."</td>
                                                            <td></td>
                                                            <td>X</td>
                                                            <td></td>
                                                            </tr>";
                                                    }
                                                }



                                            }  /*End of f (in_array($row['id'], ['17','61']))*/


                                            if (in_array($row['id'], ['18']))
                                            {
                                                
                                                if ($row_for_defining_process['cf_to_perspiration_alkali_color_change_max_value']<>0) 
                                                {   
                                                    $total_test++;
                        
                                                    $split=explode('(', $row['test_name_method']);
                                                            $test_name=$split[0];
                                                            $test_method_name=$split[1];
                        
                                                            if($row_for_defining_process['cf_to_perspiration_alkali_color_change_min_value']<=$row_for_qc['cf_to_perspiration_alkali_color_change_value'] && $row_for_defining_process['cf_to_perspiration_alkali_color_change_max_value']>=$row_for_qc['cf_to_perspiration_alkali_color_change_value'] && $row_for_defining_process['cf_to_perspiration_alkali_staining_min_value']<=$row_for_qc['cf_to_perspiration_alkali_staining_value'] && $row_for_defining_process['cf_to_perspiration_alkali_staining_max_value']>=$row_for_qc['cf_to_perspiration_alkali_staining_value'] && $row_for_defining_process['cf_to_perspiration_alkali_cross_staining_min_value']<=$row_for_qc['cf_to_perspiration_alkali_cross_staining_value'] && $row_for_defining_process['cf_to_perspiration_alkali_cross_staining_max_value']>=$row_for_qc['cf_to_perspiration_alkali_cross_staining_value'])
                                                            {
                                                                $p++;
                                                                $table.="<tr>
                                                                    <td>".$test_name."</td>
                                                                    <td>".'('.$test_method_name."</td>
                                                                    <td>X</td>
                                                                    <td></td>
                                                                    <td></td>
                                                                    </tr>";
                                                            }
                                                            else 
                                                                {
                                                                    $f++;
                                                                    $table.="<tr>
                                                                        <td>".$test_name."</td>
                                                                        <td>".'('.$test_method_name."</td>
                                                                        <td></td>
                                                                        <td>X</td>
                                                                        <td></td>
                                                                        </tr>";
                                                                }
                                                }

                                                

                                            }  /*End of if (in_array($row['id'], ['18', '120', '62', '18', '129', '194', '269']))*/

                                            if (in_array($row['id'], ['19']))
                                            {
                                                
                                                if ($row_for_defining_process['cf_to_water_color_change_max_value']<>0) 
                                                {   
                                                    $total_test++;
                        
                                                    $split=explode('(', $row['test_name_method']);
                                                            $test_name=$split[0];
                                                            $test_method_name=$split[1];
                        
                                                            if($row_for_defining_process['cf_to_water_color_change_min_value']<=$row_for_qc['cf_to_water_color_change_value'] && $row_for_defining_process['cf_to_water_color_change_max_value']>=$row_for_qc['cf_to_water_color_change_value'] && $row_for_defining_process['cf_to_water_cross_staining_min_value']<=$row_for_qc['cf_to_water_cross_staining_value'] && $row_for_defining_process['cf_to_water_cross_staining_max_value']>=$row_for_qc['cf_to_water_cross_staining_value'])
                                                            {
                                                        $p++;
                                                        $table.="<tr>
                                                            <td>".$test_name."</td>
                                                            <td>".'('.$test_method_name."</td>
                                                            <td>X</td>
                                                            <td></td>
                                                            <td></td>
                                                            </tr>";
                                                    }
                                                    else 
                                                    {
                                                        $f++;
                                                        
                                                        $table.="<tr>
                                                            <td>".$test_name."</td>
                                                            <td>".'('.$test_method_name."</td>
                                                            <td></td>
                                                            <td>X</td>
                                                            <td></td>
                                                            </tr>";
                                                    }
                                                }

                                                

                                            }  /*End of  if (in_array($row['id'], ['19', '121', '141', '167', '228']))*/ 

                                            if (in_array($row['id'], ['20', '65']))
                                            {
                                                
                                                if ($row_for_defining_process['cf_to_water_spotting_surface_max_value']<>0) 
                                                {   
                                                    $total_test++;
                        
                                                    $split=explode('(', $row['test_name_method']);
                                                            $test_name=$split[0];
                                                            $test_method_name=$split[1];
                        
                                                            if($row_for_defining_process['cf_to_water_spotting_surface_min_value']<=$row_for_qc['cf_to_water_spotting_surface_value'] && $row_for_defining_process['cf_to_water_spotting_surface_max_value']>=$row_for_qc['cf_to_water_spotting_surface_value'] && $row_for_defining_process['cf_to_water_spotting_edge_min_value']<=$row_for_qc['cf_to_water_spotting_edge_value'] && $row_for_defining_process['cf_to_water_spotting_edge_max_value']>=$row_for_qc['cf_to_water_spotting_edge_value'] && $row_for_defining_process['cf_to_water_spotting_cross_staining_min_value']<=$row_for_qc['cf_to_water_spotting_cross_staining_value'] && $row_for_defining_process['cf_to_water_spotting_cross_staining_max_value']>=$row_for_qc['cf_to_water_spotting_cross_staining_value'])
                                                            {
                                                        $p++;
                                                        $table.="<tr>
                                                            <td>".$test_name."</td>
                                                            <td>".'('.$test_method_name."</td>
                                                            <td>X</td>
                                                            <td></td>
                                                            <td></td>
                                                            </tr>";
                                                    }
                                                    else 
                                                    {
                                                        $f++;
                                                        
                                                        $table.="<tr>
                                                            <td>".$test_name."</td>
                                                            <td>".'('.$test_method_name."</td>
                                                            <td></td>
                                                            <td>X</td>
                                                            <td></td>
                                                            </tr>";
                                                    }
                                                }

                                            }  /* End of if (in_array($row['id'], ['20', '65', '196']))*/

                                            if (in_array($row['id'], ['21','22', '66']))
                                            {
                                                
                                                if ($row_for_defining_process['resistance_to_surface_wetting_before_wash_max_value']<>0) 
                                                {   
                                                    $total_test++;
                        
                                                    $split=explode('(', $row['test_name_method']);
                                                            $test_name=$split[0];
                                                            $test_method_name=$split[1];
                        
                                                            if($row_for_defining_process['resistance_to_surface_wetting_before_wash_min_value']<=$row_for_qc['resistance_to_surface_wetting_before_wash_value'] && $row_for_defining_process['resistance_to_surface_wetting_before_wash_max_value']>=$row_for_qc['resistance_to_surface_wetting_before_wash_value'] && $row_for_defining_process['resistance_to_surface_wetting_after_one_wash_min_value']<=$row_for_qc['resistance_to_surface_wetting_after_one_wash_value'] && $row_for_defining_process['resistance_to_surface_wetting_after_one_wash_max_value']>=$row_for_qc['resistance_to_surface_wetting_after_one_wash_value'] && $row_for_defining_process['resistance_to_surface_wetting_after_five_wash_min_value']<=$row_for_qc['resistance_to_surface_wetting_after_five_wash_value'] && $row_for_defining_process['resistance_to_surface_wetting_after_five_wash_max_value']>=$row_for_qc['resistance_to_surface_wetting_after_five_wash_value'])
                                                            {
                                                        $p++;
                                                        $table.="<tr>
                                                            <td>".$test_name."</td>
                                                            <td>".'('.$test_method_name."</td>
                                                            <td>X</td>
                                                            <td></td>
                                                            <td></td>
                                                            </tr>";
                                                    }
                                                    else 
                                                    {
                                                        $f++;
                                                        
                                                        $table.="<tr>
                                                            <td>".$test_name."</td>
                                                            <td>".'('.$test_method_name."</td>
                                                            <td></td>
                                                            <td>X</td>
                                                            <td></td>
                                                            </tr>";
                                                    }
                                                }


                                            }  /*End of if (in_array($row['id'], ['21', '206', '22', '66']))*/



                                            if (in_array($row['id'], ['23', '67']))
                                            {
                                                
                                                if ($row_for_defining_process['cf_to_hydrolysis_of_reactive_dyes_color_change_max_value']<>0) 
                                                {   
                                                    $total_test++;
                        
                                                    $split=explode('(', $row['test_name_method']);
                                                            $test_name=$split[0];
                                                            $test_method_name=$split[1];
                        
                                                            if($row_for_defining_process['cf_to_hydrolysis_of_reactive_dyes_color_change_min_value']<=$row_for_qc['cf_to_hydrolysis_of_reactive_dyes_color_change_value'] && $row_for_defining_process['cf_to_hydrolysis_of_reactive_dyes_color_change_max_value']>=$row_for_qc['cf_to_hydrolysis_of_reactive_dyes_color_change_value'])
                                                            {
                                                        $p++;
                                                        $table.="<tr>
                                                            <td>".$test_name."</td>
                                                            <td>".'('.$test_method_name."</td>
                                                            <td>X</td>
                                                            <td></td>
                                                            <td></td>
                                                            </tr>";
                                                    }
                                                    else 
                                                    {
                                                        $f++;
                                                        
                                                        $table.="<tr>
                                                            <td>".$test_name."</td>
                                                            <td>".'('.$test_method_name."</td>
                                                            <td></td>
                                                            <td>X</td>
                                                            <<td></td>
                                                            </tr>";
                                                    }
                                                }
                                            }  /* End of if (in_array($row['id'], ['23', '67']))*/



                                            if (in_array($row['id'], ['24', '68']))
                                            {
                                                
                                                if ($row_for_defining_process['cf_to_oxidative_bleach_damage_color_change_max_value']<>0) 
                                                {   
                                                    $total_test++;
                        
                                                    $split=explode('(', $row['test_name_method']);
                                                            $test_name=$split[0];
                                                            $test_method_name=$split[1];
                        
                                                    if($row_for_defining_process['cf_to_oxidative_bleach_damage_color_change_min_value']<=$row_for_qc['cf_to_oxidative_bleach_damage_color_change_value'] && $row_for_defining_process['cf_to_oxidative_bleach_damage_color_change_max_value']>=$row_for_qc['cf_to_oxidative_bleach_damage_color_change_value'] && $row_for_defining_process['cf_to_oxidative_bleach_damage_min_value']<=$row_for_qc['cf_to_oxidative_bleach_damage_value'] && $row_for_defining_process['cf_to_oxidative_bleach_damage_max_value']>=$row_for_qc['cf_to_oxidative_bleach_damage_value'])
                                                    {
                                                        $p++;
                                                        $table.="<tr>
                                                            <td>".$test_name."</td>
                                                            <td>".'('.$test_method_name."</td>
                                                            <td>X</td>
                                                            <td></td>
                                                            <td></td>
                                                            </tr>";
                                                    }
                                                    else 
                                                    {
                                                        $f++;
                                                        
                                                        $table.="<tr>
                                                            <td>".$test_name.'(Color Change)'."</td>
                                                            <td>".'('.$test_method_name."</td>
                                                            <td></td>
                                                            <td>X</td>
                                                            <td></td>
                                                            </tr>";
                                                    }
                                                }

                                               
                                            }  /* End of if (in_array($row['id'], ['24', '68']))*/

                                            if (in_array($row['id'], ['25','69']))
                                            {
                                                
                                                if ($row_for_defining_process['cf_to_phenolic_yellowing_staining_max_value']<>0) 
                                                {   
                                                    $total_test++;
                        
                                                    $split=explode('(', $row['test_name_method']);
                                                            $test_name=$split[0];
                                                            $test_method_name=$split[1];
                        
                                                    if($row_for_defining_process['cf_to_phenolic_yellowing_staining_min_value']<=$row_for_qc['cf_to_phenolic_yellowing_staining_value'] && $row_for_defining_process['cf_to_phenolic_yellowing_staining_max_value']>=$row_for_qc['cf_to_phenolic_yellowing_staining_value'])
                                                    {
                                                        $p++;
                                                        $table.="<tr>
                                                            <td>".$test_name."</td>
                                                            <td>".'('.$test_method_name."</td>
                                                            <td>X</td>
                                                            <td></td>
                                                            <<td></td>
                                                            </tr>";
                                                    }
                                                    else 
                                                    {
                                                        $f++;
                                                        
                                                        $table.="<tr>
                                                            <td>".$test_name.'(Staining)'."</td>
                                                            <td>".'('.$test_method_name."</td>
                                                            <td></td>
                                                            <td>X</td>
                                                            <td></td>
                                                            </tr>";
                                                    }
                                                }
                                            }  /* End of if (in_array($row['id'], ['25','69']))*/

                                            if (in_array($row['id'], ['26', '70']))
                                            {
                                                
                                                if ($row_for_defining_process['cf_to_pvc_migration_staining_max_value']<>0) 
                                                {   
                                                    $total_test++;
                        
                                                    $split=explode('(', $row['test_name_method']);
                                                            $test_name=$split[0];
                                                            $test_method_name=$split[1];
                        
                                                            if($row_for_defining_process['cf_to_pvc_migration_staining_min_value']<=$row_for_qc['cf_to_pvc_migration_staining_value'] && $row_for_defining_process['cf_to_pvc_migration_staining_max_value']>=$row_for_qc['cf_to_pvc_migration_staining_value'])
                                                            {
                                                        $p++;
                                                        $table.="<tr>
                                                            <td>".$test_name."</td>
                                                            <td>".'('.$test_method_name."</td>
                                                            <td>X</td>
                                                            <td></td>
                                                           <td></td>
                                                            </tr>";
                                                    }
                                                    else 
                                                    {
                                                        $f++;
                                                        
                                                        $table.="<tr>
                                                            <td>".$test_name."</td>
                                                            <td>".'('.$test_method_name."</td>
                                                            <td></td>
                                                            <td>X</td>
                                                            <td></td>
                                                            </tr>";
                                                    }
                                                }
                                            }  /* End of if (in_array($row['id'], ['26', '70']))*/

                                            if (in_array($row['id'], ['27', '71']))
                                            {
                                                
                                                if ($row_for_defining_process['cf_to_saliva_color_change_max_value']<>0) 
                                                {   
                                                    $total_test++;
                        
                                                    $split=explode('(', $row['test_name_method']);
                                                            $test_name=$split[0];
                                                            $test_method_name=$split[1];
                        
                                                            if($row_for_defining_process['cf_to_saliva_color_change_min_value']<=$row_for_qc['cf_to_saliva_color_change_value'] && $row_for_defining_process['cf_to_saliva_color_change_max_value']>=$row_for_qc['cf_to_saliva_color_change_value'] && $row_for_defining_process['cf_to_saliva_staining_min_value']<=$row_for_qc['cf_to_saliva_staining_value'] && $row_for_defining_process['cf_to_saliva_staining_max_value']>=$row_for_qc['cf_to_saliva_staining_value'])
                                                            {
                                                                $p++;
                                                                $table.="<tr>
                                                                    <td>".$test_name."</td>
                                                                    <td>".'('.$test_method_name."</td>
                                                                    <td>X</td>
                                                                    <td></td>
                                                                    <td></td>
                                                                    </tr>";
                                                            }
                                                             else 
                                                                {
                                                                    $f++;
                                                                    
                                                                    $table.="<tr>
                                                                        <td>".$test_name."</td>
                                                                        <td>".'('.$test_method_name."</td>
                                                                        <td></td>
                                                                        <td>X</td>
                                                                        <td></td>
                                                                        </tr>";
                                                                }
                                                }

                                                

                                            }  /* End of if (in_array($row['id'], ['27', '71']))*/

                                            if (in_array($row['id'], ['28', '72']))
                                            {
                                                
                                                if ($row_for_defining_process['cf_to_chlorinated_water_color_change_max_value']<>0) 
                                                {   
                                                    $total_test++;
                        
                                                    $split=explode('(', $row['test_name_method']);
                                                            $test_name=$split[0];
                                                            $test_method_name=$split[1];
                        
                                                            if($row_for_defining_process['cf_to_chlorinated_water_color_change_min_value']<=$row_for_qc['cf_to_chlorinated_water_color_change_change_value'] && $row_for_defining_process['cf_to_chlorinated_water_color_change_max_value']>=$row_for_qc['cf_to_chlorinated_water_color_change_value'])
                                                            {
                                                        $p++;
                                                        $table.="<tr>
                                                            <td>".$test_name."</td>
                                                            <td>".'('.$test_method_name."</td>
                                                            <td>X</td>
                                                            <td></td>
                                                            <td></td>
                                                            </tr>";
                                                    }
                                                    else 
                                                    {
                                                        $f++;
                                                        
                                                        $table.="<tr>
                                                            <td>".$test_name."</td>
                                                            <td>".'('.$test_method_name."</td>
                                                            <td></td>
                                                            <td>X</td>
                                                            <td></td>
                                                            </tr>";
                                                    }
                                                }
                                            }  /* End of if (in_array($row['id'], ['28', '72']))*/

                                            if (in_array($row['id'], ['29', '73']))
                                            {
                                                
                                                if ($row_for_defining_process['cf_to_cholorine_bleach_color_change_max_value']<>0) 
                                                {   
                                                    $total_test++;
                        
                                                    $split=explode('(', $row['test_name_method']);
                                                            $test_name=$split[0];
                                                            $test_method_name=$split[1];
                        
                                                            if($row_for_defining_process['cf_to_cholorine_bleach_color_change_min_value']<=$row_for_qc['cf_to_cholorine_bleach_color_change_value'] && $row_for_defining_process['cf_to_cholorine_bleach_color_change_max_value']>=$row_for_qc['cf_to_cholorine_bleach_color_change_value'])
                                                            {
                                                        $p++;
                                                        $table.="<tr>
                                                            <td>".$test_name."</td>
                                                            <td>".'('.$test_method_name."</td>
                                                            <td>X</td>
                                                            <td></td>
                                                            <td></td>
                                                            </tr>";
                                                    }
                                                    else 
                                                    {
                                                        $f++;
                                                        
                                                        $table.="<tr>
                                                            <td>".$test_name."</td>
                                                            <td>".'('.$test_method_name."</td>
                                                            <td></td>
                                                            <td>X</td>
                                                            <td></td>
                                                            </tr>";
                                                    }
                                                }
                                            }  /* End of if (in_array($row['id'], ['29', '73']))*/

                                            if (in_array($row['id'], ['30']))
                                            {
                                                
                                                if ($row_for_defining_process['cf_to_peroxide_bleach_color_change_max_value']<>0) 
                                                {   
                                                    $total_test++;
                        
                                                    $split=explode('(', $row['test_name_method']);
                                                            $test_name=$split[0];
                                                            $test_method_name=$split[1];
                        
                                                            if($row_for_defining_process['cf_to_peroxide_bleach_color_change_min_value']<=$row_for_qc['cf_to_peroxide_bleach_color_change_value'] && $row_for_defining_process['cf_to_peroxide_bleach_color_change_max_value']>=$row_for_qc['cf_to_peroxide_bleach_color_change_value'])
                                                            {
                                                        $p++;
                                                        $table.="<tr>
                                                            <td>".$test_name."</td>
                                                            <td>".'('.$test_method_name."</td>
                                                            <td>X</td>
                                                            <td></td>
                                                            <td></td>
                                                            </tr>";
                                                    }
                                                    else 
                                                    {
                                                        $f++;
                                                        
                                                        $table.="<tr>
                                                            <td>".$test_name."</td>
                                                            <td>".'('.$test_method_name."</td>
                                                            <td></td>
                                                            <td>X</td>
                                                            <<td></td>
                                                            </tr>";
                                                    }
                                                }
                                            }  /* End of if (in_array($row['id'], ['30']))*/

                                            if (in_array($row['id'], ['31']))
                                            {
                                                
                                                if ($row_for_defining_process['cross_staining_max_value']<>0) 
                                                {   
                                                    $total_test++;
                        
                                                    $split=explode('(', $row['test_name_method']);
                                                            $test_name=$split[0];
                                                            $test_method_name=$split[1];
                        
                                                            if($row_for_defining_process['cross_staining_min_value']<=$row_for_qc['cross_staining_value'] && $row_for_defining_process['cross_staining_max_value']>=$row_for_qc['cross_staining_value'])
                                                            {
                                                        $p++;
                                                        $table.="<tr>
                                                            <td>".$test_name."</td>
                                                            <td>".'('.$test_method_name."</td>
                                                            <td>X</td>
                                                            <td></td>
                                                            <td></td>
                                                            </tr>";
                                                    }
                                                    else 
                                                    {
                                                        $f++;
                                                        
                                                        $table.="<tr>
                                                            <td>".$test_name."</td>
                                                            <td>".'('.$test_method_name."</td>
                                                            <td></td>
                                                            <td>X</td>
                                                            <td></td>
                                                            </tr>";
                                                    }
                                                }
                                            }  /* End of if (in_array($row['id'], ['31']))*/

                                            if (in_array($row['id'], ['32']))
                                            {
                                                
                                                if ($row_for_defining_process['formaldehyde_content_max_value']<>0) 
                                                {   
                                                    $total_test++;
                        
                                                    $split=explode('(', $row['test_name_method']);
                                                            $test_name=$split[0];
                                                            $test_method_name=$split[1];
                        
                                                            if(($row_for_defining_process['formaldehyde_content_min_value']<=$row_for_qc['formaldehyde_content_value'] && $row_for_defining_process['formaldehyde_content_max_value']>=$row_for_qc['formaldehyde_content_value']) ||  $row_for_qc['formaldehyde_content_value']=='N.D.' )
                                                            {
                                                        $p++;
                                                        $table.="<tr>
                                                            <td>".$test_name."</td>
                                                            <td>".'('.$test_method_name."</td>
                                                            <td>X</td>
                                                            <td></td>
                                                            <td></td>
                                                            </tr>";
                                                    }
                                                    else 
                                                    {
                                                        $f++;
                                                        
                                                        $table.="<tr>
                                                            <td>".$test_name."</td>
                                                            <td>".'('.$test_method_name."</td>
                                                            <td></td>
                                                            <td>X</td>
                                                            <td></td>
                                                            </tr>";
                                                    }
                                                }
                                            }  /* End of if (in_array($row['id'], ['32']))*/

                                            if (in_array($row['id'], ['33']))
                                            {
                                                
                                                if ($row_for_defining_process['ph_value_max_value']<>0) 
                                                {   
                                                    $total_test++;
                        
                                                    $split=explode('(', $row['test_name_method']);
                                                            $test_name=$split[0];
                                                            $test_method_name=$split[1];
                        
                                                            if($row_for_defining_process['ph_value_min_value']<=$row_for_qc['ph_value'] && $row_for_defining_process['ph_value_max_value']>=$row_for_qc['ph_value'])
                                                            {
                                                        $p++;
                                                        $table.="<tr>
                                                            <td>".$test_name."</td>
                                                            <td>".'('.$test_method_name."</td>
                                                            <td>X</td>
                                                            <td></td>
                                                            <td></td>
                                                            </tr>";
                                                    }
                                                    else 
                                                    {
                                                        $f++;
                                                        
                                                        $table.="<tr>
                                                            <td>".$test_name."</td>
                                                            <td>".'('.$test_method_name."</td>
                                                            <td></td>
                                                            <td>X</td>
                                                            <td></td>
                                                            </tr>";
                                                    }
                                                }
                                            }  /* End of if (in_array($row['id'], ['33']))*/

                                            if (in_array($row['id'], ['34']))
                                            {
                                                
                                                if ($row_for_defining_process['water_absorption_value_max_value']<>0) 
                                                {   
                                                    $total_test++;
                        
                                                    $split=explode('(', $row['test_name_method']);
                                                            $test_name=$split[0];
                                                            $test_method_name=$split[1];
                        
                                                            if($row_for_defining_process['water_absorption_value_min_value']<=$row_for_qc['water_absorption_value'] && $row_for_defining_process['water_absorption_value_max_value']>=$row_for_qc['water_absorption_value'] && $row_for_defining_process['water_absorption_b_wash_thirty_sec_min_value']<=$row_for_qc['water_absorption_b_wash_thirty_sec_value'] && $row_for_defining_process['water_absorption_b_wash_thirty_sec_max_value']>=$row_for_qc['water_absorption_b_wash_thirty_sec_value'] && $row_for_defining_process['water_absorption_b_wash_max_min_value']<=$row_for_qc['water_absorption_b_wash_max_value'] && $row_for_defining_process['water_absorption_b_wash_max_max_value']>=$row_for_qc['water_absorption_b_wash_max_value'] && $row_for_defining_process['water_absorption_a_wash_thirty_sec_min_value']<=$row_for_qc['water_absorption_a_wash_thirty_sec_value'] && $row_for_defining_process['water_absorption_a_wash_thirty_sec_max_value']>=$row_for_qc['cf_to_perspiration_acid_color_change_value'])
                                                            {
                                                        $p++;
                                                        $table.="<tr>
                                                            <td>".$test_name."</td>
                                                            <td>".'('.$test_method_name."</td>
                                                            <td>X</td>
                                                            <td></td>
                                                            <td></td>
                                                            </tr>";
                                                    }
                                                    else 
                                                    {
                                                        $f++;
                                                        
                                                        $table.="<tr>
                                                            <td>".$test_name."</td>
                                                            <td>".'('.$test_method_name."</td>
                                                            <td></td>
                                                            <td>X</td>
                                                            <td></td>
                                                            </tr>";
                                                    }
                                                }

                                                 
                                                 
                                            }  /* End of if (in_array($row['id'], ['34']))*/

                                            if (in_array($row['id'], ['35']))
                                            {
                                                
                                                if ($row_for_defining_process['wicking_test_max_value']<>0) 
                                                {   
                                                    $total_test++;
                        
                                                    $split=explode('(', $row['test_name_method']);
                                                            $test_name=$split[0];
                                                            $test_method_name=$split[1];
                        
                                                            if($row_for_defining_process['wicking_test_min_value']<=$row_for_qc['wicking_test_value'] && $row_for_defining_process['wicking_test_max_value']>=$row_for_qc['wicking_test_value'])
                                                            {
                                                        $p++;
                                                        $table.="<tr>
                                                            <td>".$test_name."</td>
                                                            <td>".'('.$test_method_name."</td>
                                                            <td>X</td>
                                                            <td></td>
                                                            <td></td>
                                                            </tr>";
                                                    }
                                                    else 
                                                    {
                                                        $f++;
                                                        
                                                        $table.="<tr>
                                                            <td>".$test_name."</td>
                                                            <td>".'('.$test_method_name."</td>
                                                            <td></td>
                                                            <td>X</td>
                                                            <td></td>
                                                            </tr>";
                                                    }
                                                }
                                            }  /* End of if (in_array($row['id'], ['35']))*/

                                            if (in_array($row['id'], ['36']))
                                            {
                                                
                                                if ($row_for_defining_process['spirality_value_max_value']<>0) 
                                                {   
                                                    $total_test++;
                        
                                                    $split=explode('(', $row['test_name_method']);
                                                            $test_name=$split[0];
                                                            $test_method_name=$split[1];
                        
                                                            if($row_for_defining_process['spirality_value_min_value']<=$row_for_qc['spirality_value'] && $row_for_defining_process['spirality_value_max_value']>=$row_for_qc['spirality_value_value'])
                                                            {
                                                        $p++;
                                                        $table.="<tr>
                                                            <td>".$test_name."</td>
                                                            <td>".'('.$test_method_name."</td>
                                                            <td>X</td>
                                                            <td></td>
                                                            <td></td>
                                                            </tr>";
                                                    }
                                                    else 
                                                    {
                                                        $f++;
                                                        
                                                        $table.="<tr>
                                                            <td>".$test_name."</td>
                                                            <td>".'('.$test_method_name."</td>
                                                            <td></td>
                                                            <td>X</td>
                                                            <td></td>
                                                            </tr>";
                                                    }
                                                }
                                            }  /* End of if (in_array($row['id'], ['36']))*/

                                            if (in_array($row['id'], ['37']))
                                            {
                                                
                                                if ($row_for_defining_process['smoothness_appearance_max_value']<>0) 
                                                {   
                                                    $total_test++;
                        
                                                    $split=explode('(', $row['test_name_method']);
                                                            $test_name=$split[0];
                                                            $test_method_name=$split[1];
                        
                                                            if($row_for_defining_process['smoothness_appearance_min_value']<=$row_for_qc['smoothness_appearance_value'] && $row_for_defining_process['smoothness_appearance_max_value']>=$row_for_qc['smoothness_appearance_value'])
                                                            {
                                                        $p++;
                                                        $table.="<tr>
                                                            <td>".$test_name."</td>
                                                            <td>".'('.$test_method_name."</td>
                                                            <td>X</td>
                                                            <td></td>
                                                            <td></td>
                                                            </tr>";
                                                    }
                                                    else 
                                                    {
                                                        $f++;
                                                        
                                                        $table.="<tr>
                                                            <td>".$test_name."</td>
                                                            <td>".'('.$test_method_name."</td>
                                                            <td></td>
                                                            <td>X</td>
                                                            <td></td>
                                                            </tr>";
                                                    }
                                                }
                                            }  /* End of if (in_array($row['id'], ['37']))*/

                                            if (in_array($row['id'], ['38']))
                                            {
                                                
                                                if ($row_for_defining_process['print_duribility_m_s_c_15_value']<>0) 
                                                {   
                                                    $total_test++;
                        
                                                    $split=explode('(', $row['test_name_method']);
                                                            $test_name=$split[0];
                                                            $test_method_name=$split[1];
                    
                                                        $table.="<tr>
                                                            <td>".$test_name."</td>
                                                            <td>".'('.$test_method_name."</td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            </tr>";
                                                }
                                            }  /* End of if (in_array($row['id'], ['38']))*/

                                            if (in_array($row['id'], ['39']))
                                            {
                                                
                                                if ($row_for_defining_process['iron_ability_of_woven_fabric_max_value']<>0) 
                                                {   
                                                    $total_test++;
                        
                                                    $split=explode('(', $row['test_name_method']);
                                                            $test_name=$split[0];
                                                            $test_method_name=$split[1];
                        
                                                            if($row_for_defining_process['iron_ability_of_woven_fabric_min_value']<=$row_for_qc['iron_ability_of_woven_fabric_value'] && $row_for_defining_process['iron_ability_of_woven_fabric_max_value']>=$row_for_qc['iron_ability_of_woven_fabric_value'])
                                                            {
                                                        $p++;
                                                        $table.="<tr>
                                                            <td>".$test_name."</td>
                                                            <td>".'('.$test_method_name."</td>
                                                            <td>X</td>
                                                            <td></td>
                                                            <td></td>
                                                            </tr>";
                                                    }
                                                    else 
                                                    {
                                                        $f++;
                                                        
                                                        $table.="<tr>
                                                            <td>".$test_name."</td>
                                                            <td>".'('.$test_method_name."</td>
                                                            <td></td>
                                                            <td>X</td>
                                                            <td></td>
                                                            </tr>";
                                                    }
                                                }
                                            }  /* End of if (in_array($row['id'], ['39']))*/

                                            if (in_array($row['id'], ['40']))
                                            {
                                                
                                                if($row_for_defining_process['color_fastess_to_artificial_daylight_max_value']<>0 && $row_for_qc['cf_to_artificial_day_light_value']<>0)
                                                {   
                                                    $total_test++;
                        
                                                    $split=explode('(', $row['test_name_method']);
                                                            $test_name=$split[0];
                                                            $test_method_name=$split[1];
                        
                                                            if($row_for_defining_process['color_fastess_to_artificial_daylight_min_value']<=$row_for_qc['cf_to_artificial_day_light_value'] && $row_for_defining_process['color_fastess_to_artificial_daylight_max_value']>=$row_for_qc['cf_to_artificial_day_light_value'])
                                                            {
                                                        $p++;
                                                        $table.="<tr>
                                                            <td>".$test_name."</td>
                                                            <td>".'('.$test_method_name."</td>
                                                            <td>X</td>
                                                            <td></td>
                                                            <td></td>
                                                            </tr>";
                                                    }
                                                    else 
                                                    {
                                                        $f++;
                                                        
                                                        $table.="<tr>
                                                            <td>".$test_name."</td>
                                                            <td>".'('.$test_method_name."</td>
                                                            <td></td>
                                                            <td>X</td>
                                                            <td></td>
                                                            </tr>";
                                                    }
                                                }
                                            }  /* End of if (in_array($row['id'], ['40']))*/

                                            if (in_array($row['id'], ['41']))
                                            {
                                                
                                                if ($row_for_defining_process['moisture_content_max_value']<>0) 
                                                {   
                                                    $total_test++;
                        
                                                    $split=explode('(', $row['test_name_method']);
                                                            $test_name=$split[0];
                                                            $test_method_name=$split[1];
                        
                                                            if($row_for_defining_process['moisture_content_min_value']<=$row_for_qc['moisture_content_value'] && $row_for_defining_process['moisture_content_max_value']>=$row_for_qc['moisture_content_value'])
                                                            {
                                                        $p++;
                                                        $table.="<tr>
                                                            <td>".$test_name."</td>
                                                            <td>".'('.$test_method_name."</td>
                                                            <td>X</td>
                                                            <td></td>
                                                            <td></td>
                                                            </tr>";
                                                    }
                                                    else 
                                                    {
                                                        $f++;
                                                        
                                                        $table.="<tr>
                                                            <td>".$test_name."</td>
                                                            <td>".'('.$test_method_name."</td>
                                                            <td></td>
                                                            <td>X</td>
                                                            <td></td>
                                                            </tr>";
                                                    }
                                                }
                                            }  /* End of if (in_array($row['id'], ['41']))*/

                                            if (in_array($row['id'], ['42']))
                                            {
                                                
                                                if ($row_for_defining_process['evaporation_rate_quick_drying_max_value']<>0) 
                                                {   
                                                    $total_test++;
                        
                                                    $split=explode('(', $row['test_name_method']);
                                                            $test_name=$split[0];
                                                            $test_method_name=$split[1];
                        
                                                            if($row_for_defining_process['evaporation_rate_quick_drying_min_value']<=$row_for_qc['evaporation_rate_quick_drying_value'] && $row_for_defining_process['evaporation_rate_quick_drying_max_value']>=$row_for_qc['evaporation_rate_quick_drying_value'])
                                                            {
                                                        $p++;
                                                        $table.="<tr>
                                                            <td>".$test_name."</td>
                                                            <td>".'('.$test_method_name."</td>
                                                            <td>X</td>
                                                            <td></td>
                                                           <td></td>
                                                            </tr>";
                                                    }
                                                    else 
                                                    {
                                                        $f++;
                                                        
                                                        $table.="<tr>
                                                            <td>".$test_name."</td>
                                                            <td>".'('.$test_method_name."</td>
                                                            <td></td>
                                                            <td>X</td>
                                                            <td></td>
                                                            </tr>";
                                                    }
                                                }
                                            }  /* End of if (in_array($row['id'], ['42']))*/

                                            if (in_array($row['id'], ['43']))
                                            {
                                                
                                                if ($row_for_defining_process['percentage_of_total_cotton_content_max_value']<>0 && $row_for_qc['total_cotton_content_value']<>0) 
                                                {   
                                                    $total_test++;
                        
                                                    $split=explode('(', $row['test_name_method']);
                                                            $test_name=$split[0];
                                                            $test_method_name=$split[1];
                        
                                                            if($row_for_defining_process['percentage_of_total_cotton_content_min_value']<=$row_for_qc['total_cotton_content_value'] && $row_for_defining_process['percentage_of_total_cotton_content_max_value']>=$row_for_qc['total_cotton_content_value'])
                                                            {
                                                        $p++;
                                                        $table.="<tr>
                                                            <td>".$test_name.'(Total Cotton)'."</td>
                                                            <td>".'('.$test_method_name."</td>
                                                            <td>X</td>
                                                            <td></td>
                                                           <td></td>
                                                            </tr>";
                                                    }
                                                    else 
                                                    {
                                                        $f++;
                                                        
                                                        $table.="<tr>
                                                            <td>".$test_name.'(Total Cotton)'."</td>
                                                            <td>".'('.$test_method_name."</td>
                                                            <td></td>
                                                            <td>X</td>
                                                            <td></td>
                                                            </tr>";
                                                    }
                                                }

                                                if ($row_for_defining_process['percentage_of_total_polyester_content_max_value']<>0 && $row_for_qc['total_total_Polyester_content_value']<>0) 
                                                {   
                                                    $total_test++;
                        
                                                    $split=explode('(', $row['test_name_method']);
                                                            $test_name=$split[0];
                                                            $test_method_name=$split[1];
                        
                                                            if($row_for_defining_process['percentage_of_total_polyester_content_min_value']<=$row_for_qc['total_total_Polyester_content_value'] && $row_for_defining_process['percentage_of_total_polyester_content_max_value']>=$row_for_qc['total_total_Polyester_content_value'])
                                                            {
                                                        $p++;
                                                        $table.="<tr>
                                                            <td>".$test_name.'(Total Polyester)'."</td>
                                                            <td>".'('.$test_method_name."</td>
                                                            <td>X</td>
                                                            <td></td>
                                                            <td></td>
                                                            </tr>";
                                                    }
                                                    else 
                                                    {
                                                        $f++;
                                                        
                                                        $table.="<tr>
                                                            <td>".$test_name.'(Total Polyester)'."</td>
                                                            <td>".'('.$test_method_name."</td>
                                                            <td></td>
                                                            <td>X</td>
                                                            <td></td>
                                                            </tr>";
                                                    }
                                                }

                                                if ($row_for_defining_process['percentage_of_total_other_fiber_content_max_value']<>0 && $row_for_qc['total_other_fiber_value']<>0) 
                                                {   
                                                    $total_test++;
                        
                                                    $split=explode('(', $row['test_name_method']);
                                                            $test_name=$split[0];
                                                            $test_method_name=$split[1];
                        
                                                            if($row_for_defining_process['percentage_of_total_other_fiber_content_min_value']<=$row_for_qc['total_other_fiber_value'] && $row_for_defining_process['percentage_of_total_other_fiber_content_max_value']>=$row_for_qc['total_other_fiber_value'])
                                                            {
                                                        $p++;
                                                        $table.="<tr>
                                                            <td>".$test_name.'(Total Other Fiber)'."</td>
                                                            <td>".'('.$test_method_name."</td>
                                                            <td>X</td>
                                                            <td></td>
                                                            <td></td>
                                                            </tr>";
                                                    }
                                                    else 
                                                    {
                                                        $f++;
                                                        
                                                        $table.="<tr>
                                                            <td>".$test_name.'(Total Other Fiber)'."</td>
                                                            <td>".'('.$test_method_name."</td>
                                                            <td></td>
                                                            <td>X</td>
                                                            <td></td>
                                                            </tr>";
                                                    }
                                                }

                                                if ($row_for_defining_process['percentage_of_warp_cotton_content_max_value']<>0 && $row_for_qc['warp_cotton_content_value']<>0) 
                                                {   
                                                    $total_test++;
                        
                                                    $split=explode('(', $row['test_name_method']);
                                                            $test_name=$split[0];
                                                            $test_method_name=$split[1];
                        
                                                            if($row_for_defining_process['percentage_of_warp_cotton_content_min_value']<=$row_for_qc['warp_cotton_content_value'] && $row_for_defining_process['percentage_of_warp_cotton_content_max_value']>=$row_for_qc['warp_cotton_content_value'])
                                                            {
                                                        $p++;
                                                        $table.="<tr>
                                                            <td>".$test_name.'(Warp Cotton)'."</td>
                                                            <td>".'('.$test_method_name."</td>
                                                            <td>X</td>
                                                            <td></td>
                                                            <td></td>
                                                            </tr>";
                                                    }
                                                    else 
                                                    {
                                                        $f++;
                                                        
                                                        $table.="<tr>
                                                            <td>".$test_name.'(Warp Cotton)'."</td>
                                                            <td>".'('.$test_method_name."</td>
                                                            <td></td>
                                                            <td>X</td>
                                                            <td></td>
                                                            </tr>";
                                                    }
                                                }

                                                if ($row_for_defining_process['percentage_of_warp_polyester_content_max_value']<>0 && $row_for_qc['warp_Polyester_content_value']<>0) 
                                                {   
                                                    $total_test++;
                        
                                                    $split=explode('(', $row['test_name_method']);
                                                            $test_name=$split[0];
                                                            $test_method_name=$split[1];
                        
                                                            if($row_for_defining_process['percentage_of_warp_polyester_content_min_value']<=$row_for_qc['warp_Polyester_content_value'] && $row_for_defining_process['percentage_of_warp_polyester_content_max_value']>=$row_for_qc['warp_Polyester_content_value'])
                                                            {
                                                        $p++;
                                                        $table.="<tr>
                                                            <td>".$test_name.'(Warp Polyester)'."</td>
                                                            <td>".'('.$test_method_name."</td>
                                                            <td>X</td>
                                                            <td></td>
                                                            <td></td>
                                                            </tr>";
                                                    }
                                                    else 
                                                    {
                                                        $f++;
                                                        
                                                        $table.="<tr>
                                                            <td>".$test_name.'(Warp Polyester)'."</td>
                                                            <td>".'('.$test_method_name."</td>
                                                            <td></td>
                                                            <td>X</td>
                                                            <td></td>
                                                            </tr>";
                                                    }
                                                }

                                                if ($row_for_defining_process['percentage_of_warp_other_fiber_content_max_value']<>0 && $row_for_qc['warp_other_fiber_value']<>0) 
                                                {   
                                                    $total_test++;
                        
                                                    $split=explode('(', $row['test_name_method']);
                                                            $test_name=$split[0];
                                                            $test_method_name=$split[1];
                        
                                                            if($row_for_defining_process['percentage_of_warp_other_fiber_content_min_value']<=$row_for_qc['warp_other_fiber_value'] && $row_for_defining_process['percentage_of_warp_other_fiber_content_max_value']>=$row_for_qc['warp_other_fiber_value'])
                                                            {
                                                        $p++;
                                                        $table.="<tr>
                                                            <td>".$test_name.'(Warp Other Fiber)'."</td>
                                                            <td>".'('.$test_method_name."</td>
                                                            <td>X</td>
                                                            <td></td>
                                                            <td></td>
                                                            </tr>";
                                                    }
                                                    else 
                                                    {
                                                        $f++;
                                                        
                                                        $table.="<tr>
                                                            <td>".$test_name.'(Warp Other Fiber)'."</td>
                                                            <td>".'('.$test_method_name."</td>
                                                            <td></td>
                                                            <td>X</td>
                                                           <td></td>
                                                            </tr>";
                                                    }
                                                }

                                                if ($row_for_defining_process['percentage_of_weft_cotton_content_max_value']<>0 && $row_for_qc['weft_cotton_content_value']<>0) 
                                                {   
                                                    $total_test++;
                        
                                                    $split=explode('(', $row['test_name_method']);
                                                            $test_name=$split[0];
                                                            $test_method_name=$split[1];
                        
                                                            if($row_for_defining_process['percentage_of_weft_cotton_content_min_value']<=$row_for_qc['weft_cotton_content_value'] && $row_for_defining_process['percentage_of_weft_cotton_content_max_value']>=$row_for_qc['weft_cotton_content_value'])
                                                            {
                                                        $p++;
                                                        $table.="<tr>
                                                            <td>".$test_name.'(Weft Cotton)'."</td>
                                                            <td>".'('.$test_method_name."</td>
                                                            <td>X</td>
                                                            <td></td>
                                                            <td></td>
                                                            </tr>";
                                                    }
                                                    else 
                                                    {
                                                        $f++;
                                                        
                                                        $table.="<tr>
                                                            <td>".$test_name.'(Weft Cotton)'."</td>
                                                            <td>".'('.$test_method_name."</td>
                                                            <td></td>
                                                            <td>X</td>
                                                            <td></td>
                                                            </tr>";
                                                    }
                                                }

                                                if ($row_for_defining_process['percentage_of_weft_polyester_content_max_value']<>0  && $row_for_qc['weft_Polyester_content_value']<>0) 
                                                {   
                                                    $total_test++;
                        
                                                    $split=explode('(', $row['test_name_method']);
                                                            $test_name=$split[0];
                                                            $test_method_name=$split[1];
                        
                                                            if($row_for_defining_process['percentage_of_weft_polyester_content_min_value']<=$row_for_qc['weft_Polyester_content_value'] && $row_for_defining_process['percentage_of_weft_polyester_content_max_value']>=$row_for_qc['weft_Polyester_content_value'])
                                                            {
                                                        $p++;
                                                        $table.="<tr>
                                                            <td>".$test_name.'(Weft Polyester)'."</td>
                                                            <td>".'('.$test_method_name."</td>
                                                            <td>X</td>
                                                            <td></td>
                                                            <td></td>
                                                            </tr>";
                                                    }
                                                    else 
                                                    {
                                                        $f++;
                                                        
                                                        $table.="<tr>
                                                            <td>".$test_name.'(Weft Polyester)'."</td>
                                                            <td>".'('.$test_method_name."</td>
                                                            <td></td>
                                                            <td>X</td>
                                                            <td></td>
                                                            </tr>";
                                                    }
                                                }

                                                if ($row_for_defining_process['percentage_of_weft_other_fiber_content_max_value']<>0 && $row_for_qc['weft_other_fiber_value']<>0) 
                                                {   
                                                    $total_test++;
                        
                                                    $split=explode('(', $row['test_name_method']);
                                                            $test_name=$split[0];
                                                            $test_method_name=$split[1];
                        
                                                            if($row_for_defining_process['percentage_of_weft_other_fiber_content_min_value']<=$row_for_qc['weft_other_fiber_value'] && $row_for_defining_process['percentage_of_weft_other_fiber_content_max_value']>=$row_for_qc['weft_other_fiber_value'])
                                                            {
                                                        $p++;
                                                        $table.="<tr>
                                                            <td>".$test_name.'(Weft Other Fiber)'."</td>
                                                            <td>".'('.$test_method_name."</td>
                                                            <td>X</td>
                                                            <td></td>
                                                            <td></td>
                                                            </tr>";
                                                    }
                                                    else 
                                                    {
                                                        $f++;
                                                        
                                                        $table.="<tr>
                                                            <td>".$test_name.'(Weft Other Fiber)'."</td>
                                                            <td>".'('.$test_method_name."</td>
                                                            <td></td>
                                                            <td>X</td>
                                                            <td></td>
                                                            </tr>";
                                                    }
                                                }
                                            }  /* End of if (in_array($row['id'], ['43']))*/

                                            if (in_array($row['id'], ['3']))
                                            {
                                                if($row_for_defining_process['test_method_for_appearance_after_wash_fabric'] == 'Fabric (Mock up)' && $row_for_qc['test_method_for_appearance_after_wash'] == 'Fabric (Mock up)')
                                                {
                                                if ($row_for_defining_process['appearance_after_washing_fabric_color_change_max_value']<>0) 
                                                {   
                                                    $total_test++;
                        
                                                    $split=explode('(', $row['test_name_method']);
                                                            $test_name=$split[0];
                                                            $test_method_name=$split[1];
                        
                                                            if($row_for_defining_process['appearance_after_washing_fabric_color_change_min_value']<=$row_for_qc['appear_after_wash_fabric_color_change_value'] && $row_for_defining_process['appearance_after_washing_fabric_color_change_max_value']>=$row_for_qc['appear_after_wash_fabric_color_change_value'] && $row_for_defining_process['appearance_after_washing_fabric_cross_staining_min_value']<=$row_for_qc['appearance_after_washing_fabric_cross_staining_value'] && $row_for_defining_process['appearance_after_washing_fabric_cross_staining_max_value']>=$row_for_qc['appearance_after_washing_fabric_cross_staining_value'] && $row_for_defining_process['appearance_after_washing_fabric_surface_fuzzing_min_value']<=$row_for_qc['appearance_after_washing_fabric_surface_fuzzing_value'] && $row_for_defining_process['appearance_after_washing_fabric_surface_fuzzing_max_value']>=$row_for_qc['appearance_after_washing_fabric_surface_fuzzing_value'] && $row_for_defining_process['appearance_after_washing_fabric_surface_pilling_min_value']<=$row_for_qc['appearance_after_washing_fabric_surface_pilling_value'] && $row_for_defining_process['appearance_after_washing_fabric_surface_pilling_max_value']>=$row_for_qc['appearance_after_washing_fabric_surface_pilling_value'] && $row_for_defining_process['appearance_after_washing_fabric_crease_before_ironing_min_value']<=$row_for_qc['appearance_after_washing_fabric_crease_before_ironing_value'] && $row_for_defining_process['appearance_after_washing_fabric_crease_before_ironing_max_value']>=$row_for_qc['appearance_after_washing_fabric_crease_before_ironing_value'] && $row_for_defining_process['appearance_after_washing_fabric_crease_after_ironing_min_value']<=$row_for_qc['appearance_after_washing_fabric_crease_after_ironing_value'] && $row_for_defining_process['appearance_after_washing_fabric_crease_after_ironing_max_value']>=$row_for_qc['appearance_after_washing_fabric_crease_after_ironing_value'])
                                                            {
                                                        $p++;
                                                        $table.="<tr>
                                                            <td>".$test_name.'(Fabric)'."</td>
                                                            <td>".$test_method_name."</td>
                                                            <td>X</td>
                                                            <td></td>
                                                            <td></td>
                                                            </tr>";
                                                    }
                                                    else 
                                                    {
                                                        $f++;
                                                        
                                                        $table.="<tr>
                                                            <td>".$test_name.'(Fabric)'."</td>
                                                            <td>".$test_method_name."</td>
                                                            <td></td>
                                                            <td>X</td>
                                                            <td></td>
                                                            </tr>";
                                                    }
                                                }
                                            }
                                              
                                               


                                                
                                            if($row_for_defining_process['test_method_for_appearance_after_wash_fabric'] == 'Garments' && $row_for_qc['test_method_for_appearance_after_wash'] == 'Garments')
                                            {
                                                if ($row_for_defining_process['appear_after_washing_garments_color_change_with_sup_max_value']<>0) 
                                                {   
                                                    $total_test++;
                        
                                                    $split=explode('(', $row['test_name_method']);
                                                            $test_name=$split[0];
                                                            $test_method_name=$split[1];
                        
                                                            if($row_for_defining_process['appear_after_washing_garments_color_change_without_sup_min_value']<=$row_for_qc['appear_after_wash_garments_color_change_without_sup_value'] && $row_for_defining_process['appear_after_washing_garments_color_change_without_sup_max_val']>=$row_for_qc['appear_after_wash_garments_color_change_without_sup_value'] && $row_for_defining_process['appear_after_washing_garments_color_change_with_sup_min_value']<=$row_for_qc['appear_after_wash_garments_color_change_with_sup_value'] && $row_for_defining_process['appear_after_washing_garments_color_change_with_sup_max_value']>=$row_for_qc['appear_after_wash_garments_color_change_with_sup_value'] && $row_for_defining_process['appearance_after_washing_garments_cross_staining_min_value']<=$row_for_qc['appearance_after_washing_garments_cross_staining_value'] && $row_for_defining_process['appearance_after_washing_garments_cross_staining_max_value']>=$row_for_qc['appearance_after_washing_garments_cross_staining_value'] && $row_for_defining_process['appearance_after_washing_garments__differential_shrink_min_value']<=$row_for_qc['appearance_after_washing_garments_differential_shrinkage_value'] && $row_for_defining_process['appearance_after_washing_garments__differential_shrink_max_value']>=$row_for_qc['appearance_after_washing_garments_differential_shrinkage_value'] && $row_for_defining_process['appearance_after_washing_garments_surface_fuzzing_min_value']<=$row_for_qc['appearance_after_washing_garments_surface_fuzzing_value'] && $row_for_defining_process['appearance_after_washing_garments_surface_fuzzing_max_value']>=$row_for_qc['appearance_after_washing_garments_surface_fuzzing_value'] && $row_for_defining_process['appearance_after_washing_garments_surface_pilling_min_value']<=$row_for_qc['appearance_after_washing_garments_surface_pilling_value'] && $row_for_defining_process['appearance_after_washing_garments_surface_pilling_max_value']>=$row_for_qc['appearance_after_washing_garments_surface_pilling_value'] && $row_for_defining_process['appearance_after_washing_garments_crease_after_ironing_min_value']<=$row_for_qc['appearance_after_washing_garments_crease_after_ironing_value'] && $row_for_defining_process['appearance_after_washing_garments_crease_after_ironing_max_value']>=$row_for_qc['appearance_after_washing_garments_crease_after_ironing_value'] && $row_for_defining_process['appear_after_washing_garments_seam_pucker_rop_iron_min_value']<=$row_for_qc['appearance_after_washing_garments_seam_puckering_roping_after_ir'] && $row_for_defining_process['appear_after_washing_garments_seam_pucker_rop_iron_max_value']>=$row_for_qc['appearance_after_washing_garments_seam_puckering_roping_after_ir'] && $row_for_defining_process['appearance_after_washing_garments_spirality_min_value']<=$row_for_qc['appearance_after_washing_garments_spirality_value'] && $row_for_defining_process['appearance_after_washing_garments_spirality_max_value']>=$row_for_qc['appearance_after_washing_garments_spirality_value'])
                                                            {
                                                        $p++;
                                                        $table.="<tr>
                                                            <td>".$test_name. '(Garments)'."</td>
                                                            <td>".$test_method_name."</td>
                                                            <td>X</td>
                                                            <td></td>
                                                            <td></td>
                                                            </tr>";
                                                    }
                                                    else 
                                                    {
                                                        $f++;
                                                        
                                                        $table.="<tr>
                                                            <td>".$test_name. '(Garments)'."</td>
                                                            <td>".$test_method_name."</td>
                                                            <td></td>
                                                            <td>X</td>
                                                            <td></td>
                                                            </tr>";
                                                    }
                                                }
                                            }

                                               

                                            }  /* End of if (in_array($row['id'], ['3']))*/

                                         }   // End While loop
                        



                            $table.="</tbody>
                               </table>
                             </div>
                            </div>";
                            echo $table;
                            ?>

                          
                </form>
            </div>  <!-- End of <div id="element"> -->
        </body>   <!-- End of <body id="target"> -->
    </div>   <!-- End of <div class="panel panel-default"> -->


    
             
    <!-- <div class='html2pdf__page-break'></div> -->


<!-- 
    <a href="report/pdf_file_for_all_test_report_for_finish_process.php?value_pdf=<?php //echo urlencode($get_value) ?>">
                        <button type="button" id="pdf_file_for_all_test_report_for_finishing" name="pdf_file_for_all_test_report_for_finishing"  class="btn btn-primary btn-xs">Generate pdf file</button>
            </a>
                             -->
                   
                
     <div class="panel panel-default">

           <body id="target_for_test">
             <div id="element_for_test">


                <form class="form-horizontal" name="test_report_of_ikea_form" id="test_report_of_ikea_form"> 

                        <div class="form-group form-group-sm" id="form-group_for_test_report">
                        <div class="form-group form-group-sm" id="form-group_for_test_report" style="font-size: 30px p-2 m-auto">
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


                        <div class="form-group form-group-sm" id="form-group_for_trf">
                                       <label class=" col-sm-4" for="name" style="float: right;" >Report No:<?php echo $row_for_process_program_info['trf_id']; ?></label>
                        </div>


                         <div class="form-group form-group-sm" id="form-group_for_test_report_of_ikea">
                           
                            <label class=" col-sm-4" for="name" style="float: right;" >ISSUE DATE:<span id="datetime_test"></span></label>

                             <label class=" col-sm-10" for="name" style="font-size: 20px;  margin-left: 30px;" >TEST DETAILS</label>
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

                        <?php
                        $sql="SELECT DISTINCT tnmp.id, tmn.test_method_id, IF(tmn.test_method_name <> 'Other',concat(tmn.test_name,'(',tmn.test_method_name,')'),tmn.test_name) test_name_method
                        FROM test_name_and_method_for_all_process tnmp
                        INNER JOIN test_method_name tmn ON tnmp.id = tmn.test_name_and_method_for_process_id 
                        INNER JOIN transaction_test_name_and_method ttnm ON ttnm.test_name_and_method_for_process_id = tmn.test_name_and_method_for_process_id
                        INNER JOIN test_method_for_customer tmc ON tmc.test_id = ttnm.test_name_id AND tmc.test_method_id = tmn.test_method_id
                        WHERE tmc.customer_name = '$customer_name' ORDER BY ttnm.test_name_and_method_for_process_id ASC";
                       

                        $data="";
                        $data_for_test_method_id="";
                        $test_name_method="";
                        $serial="";
                        $form = "";
                        $result= mysqli_query($con,$sql) or die(mysqli_error($con));
                        while( $row = mysqli_fetch_array( $result))
                        {
                            if (in_array($row['id'], ['1']))
                            {
                                    
                              
                                if (($row_for_defining_process['cf_to_rubbing_dry_max_value']<>0 && $row_for_qc['cf_to_rubbing_dry_value']<>0) || ($row_for_defining_process['cf_to_rubbing_wet_max_value']<>0 && $row_for_qc['cf_to_rubbing_wet_value']<>0) ) 
                                { 
                                    $serial+=1;
                                    $form.= "
                                    <div class='form-group from-group-sm row'>
                                        <div class='col-sm-1'><b style='font-size: 20px;' >".$serial.".</b></div>
                                        <div class='col-sm-11' id='form-group_for_test_report_of_ikea'>
                                            <div class='col-sm-10'>
                                            
                                                <table class='table table-bordered'>
                                                <thead>
                                                <tr>
                                                <label class='col-sm-12' style='font-size: 20px;' > ".$row['test_name_method'].": </label>
                                                </tr>
                                                <tr>
                                                    <th class='text-center' colspan='4'>Result</th>
                                                    <th class='text-center' rowspan='2'>Requirements</th>
                                                    
                                                </tr>
                                            
                                                <tr>
                                                    <th class='text-center'  colspan='2'>Direction</th>
                                                    <th class='text-center'  colspan='2'>Gray</th>
                                                    
                                                </tr>
                                                </thead>
                                                <tbody>";
                                                
                                            if ($row_for_defining_process['cf_to_rubbing_dry_max_value']<>0 && $row_for_qc['cf_to_rubbing_dry_value']<>0) 
                                            {
                                                if($customer_type == 'american')
                                                {
                                                    $cf_to_rubbing_dry_tolerance_value = $row_for_defining_process['cf_to_rubbing_dry_tolerance_value'];
                                                    $cf_to_rubbing_dry_value = $row_for_qc['cf_to_rubbing_dry_value'];
                                                }
                
                                                if($customer_type == 'european')
                                                {
                                                    $cf_to_rubbing_dry_tolerance = $row_for_defining_process['cf_to_rubbing_dry_tolerance_value'];
                                                    if($cf_to_rubbing_dry_tolerance == 1.0)
                                                    {
                                                        $cf_to_rubbing_dry_tolerance_value = '1';
                                                    }
                                                    elseif($cf_to_rubbing_dry_tolerance == 1.5)
                                                    {
                                                        $cf_to_rubbing_dry_tolerance_value = '1-2';
                                                    }
                                                    elseif($cf_to_rubbing_dry_tolerance == 2.0)
                                                    {
                                                        $cf_to_rubbing_dry_tolerance_value = '2';
                                                    }
                                                    elseif($cf_to_rubbing_dry_tolerance == 2.5)
                                                    {
                                                        $cf_to_rubbing_dry_tolerance_value = '2-3';
                                                    }
                                                    elseif($cf_to_rubbing_dry_tolerance == 3.0)
                                                    {
                                                        $cf_to_rubbing_dry_tolerance_value = '3';
                                                    }
                                                    elseif($cf_to_rubbing_dry_tolerance == 3.5)
                                                    {
                                                        $cf_to_rubbing_dry_tolerance_value = '3-5';
                                                    }
                                                    elseif($cf_to_rubbing_dry_tolerance == 4.0)
                                                    {
                                                        $cf_to_rubbing_dry_tolerance_value = '4';
                                                    }
                                                    elseif($cf_to_rubbing_dry_tolerance == 4.5)
                                                    {
                                                        $cf_to_rubbing_dry_tolerance_value = '4-5';
                                                    }
                                                    elseif($cf_to_rubbing_dry_tolerance == 5.0)
                                                    {
                                                        $cf_to_rubbing_dry_tolerance_value = '5';
                                                    } // for define
                
                                                    $cf_to_rubbing_dry = $row_for_qc['cf_to_rubbing_dry_value'];
                                                    if($cf_to_rubbing_dry == 1.0)
                                                    {
                                                        $cf_to_rubbing_dry_value = '1';
                                                    }
                                                    elseif($cf_to_rubbing_dry == 1.5)
                                                    {
                                                        $cf_to_rubbing_dry_value = '1-2';
                                                    }
                                                    elseif($cf_to_rubbing_dry == 2.0)
                                                    {
                                                        $cf_to_rubbing_dry_value = '2';
                                                    }
                                                    elseif($cf_to_rubbing_dry == 2.5)
                                                    {
                                                        $cf_to_rubbing_dry_value = '2-3';
                                                    }
                                                    elseif($cf_to_rubbing_dry == 3.0)
                                                    {
                                                        $cf_to_rubbing_dry_value = '3';
                                                    }
                                                    elseif($cf_to_rubbing_dry == 3.5)
                                                    {
                                                        $cf_to_rubbing_dry_value = '3-5';
                                                    }
                                                    elseif($cf_to_rubbing_dry == 4.0)
                                                    {
                                                        $cf_to_rubbing_dry_value = '4';
                                                    }
                                                    elseif($cf_to_rubbing_dry == 4.5)
                                                    {
                                                        $cf_to_rubbing_dry_value = '4-5';
                                                    }
                                                    elseif($cf_to_rubbing_dry == 5.0)
                                                    {
                                                        $cf_to_rubbing_dry_value = '5';
                                                    }  // for test result
                                                }
                
                                                    $form.=" <tr>
                                                        <th class='text-center' colspan='2'>Dry</th>
                                                        <td class='text-center' colspan='2'>".$cf_to_rubbing_dry_value."</td>
                                                        <td class='text-center'>".$row_for_defining_process['cf_to_rubbing_dry_tolerance_range_math_operator'].$cf_to_rubbing_dry_tolerance_value."</td>
                                                    
                                                    </tr>";
                                            }
                                            if ($row_for_defining_process['cf_to_rubbing_wet_max_value']<>0 && $row_for_qc['cf_to_rubbing_wet_value']<>0) 
                                            {
                                                if($customer_type == 'american')
                                                {
                                                    $cf_to_rubbing_wet_tolerance_value = $row_for_defining_process['cf_to_rubbing_wet_tolerance_value'];
                                                    $cf_to_rubbing_wet_value = $row_for_qc['cf_to_rubbing_wet_value'];
                                                }
                
                                                if($customer_type == 'european')
                                                {
                                                    $cf_to_rubbing_wet_tolerance = $row_for_defining_process['cf_to_rubbing_wet_tolerance_value'];
                                                    if($cf_to_rubbing_wet_tolerance == 1.0)
                                                    {
                                                        $cf_to_rubbing_wet_tolerance_value = '1';
                                                    }
                                                    elseif($cf_to_rubbing_wet_tolerance == 1.5)
                                                    {
                                                        $cf_to_rubbing_wet_tolerance_value = '1-2';
                                                    }
                                                    elseif($cf_to_rubbing_wet_tolerance == 2.0)
                                                    {
                                                        $cf_to_rubbing_wet_tolerance_value = '2';
                                                    }
                                                    elseif($cf_to_rubbing_wet_tolerance == 2.5)
                                                    {
                                                        $cf_to_rubbing_wet_tolerance_value = '2-3';
                                                    }
                                                    elseif($cf_to_rubbing_wet_tolerance == 3.0)
                                                    {
                                                        $cf_to_rubbing_wet_tolerance_value = '3';
                                                    }
                                                    elseif($cf_to_rubbing_wet_tolerance == 3.5)
                                                    {
                                                        $cf_to_rubbing_wet_tolerance_value = '3-5';
                                                    }
                                                    elseif($cf_to_rubbing_wet_tolerance == 4.0)
                                                    {
                                                        $cf_to_rubbing_wet_tolerance_value = '4';
                                                    }
                                                    elseif($cf_to_rubbing_wet_tolerance == 4.5)
                                                    {
                                                        $cf_to_rubbing_wet_tolerance_value = '4-5';
                                                    }
                                                    elseif($cf_to_rubbing_wet_tolerance == 5.0)
                                                    {
                                                        $cf_to_rubbing_wet_tolerance_value = '5';
                                                    } // for define
                
                                                    $cf_to_rubbing_wet = $row_for_qc['cf_to_rubbing_wet_value'];
                                                    if($cf_to_rubbing_wet == 1.0)
                                                    {
                                                        $cf_to_rubbing_wet_value = '1';
                                                    }
                                                    elseif($cf_to_rubbing_wet == 1.5)
                                                    {
                                                        $cf_to_rubbing_wet_value = '1-2';
                                                    }
                                                    elseif($cf_to_rubbing_wet == 2.0)
                                                    {
                                                        $cf_to_rubbing_wet_value = '2';
                                                    }
                                                    elseif($cf_to_rubbing_wet == 2.5)
                                                    {
                                                        $cf_to_rubbing_wet_value = '2-3';
                                                    }
                                                    elseif($cf_to_rubbing_wet == 3.0)
                                                    {
                                                        $cf_to_rubbing_wet_value = '3';
                                                    }
                                                    elseif($cf_to_rubbing_wet == 3.5)
                                                    {
                                                        $cf_to_rubbing_wet_value = '3-5';
                                                    }
                                                    elseif($cf_to_rubbing_wet == 4.0)
                                                    {
                                                        $cf_to_rubbing_wet_value = '4';
                                                    }
                                                    elseif($cf_to_rubbing_wet == 4.5)
                                                    {
                                                        $cf_to_rubbing_wet_value = '4-5';
                                                    }
                                                    elseif($cf_to_rubbing_wet == 5.0)
                                                    {
                                                        $cf_to_rubbing_wet_value = '5';
                                                    }  // for test result
                                                }

                                                $form.=" <tr>
                                                    <th class='text-center' colspan='2'>Wet</th>
                                                    <td class='text-center' colspan='2'>".$cf_to_rubbing_wet_value."</td>
                                                    <td class='text-center' >".$row_for_defining_process['cf_to_rubbing_wet_tolerance_range_math_operator'].$cf_to_rubbing_wet_tolerance_value."</td>
                                                
                                                </tr>";
                                            }
                                                
                                                    $form.="</tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>";
                                   
                                }
                                echo $form;
                                $form = "";
                            }  /*End of if (in_array($row['id'], ['1']))*/
                        

                            if (in_array($row['id'], ['15','59']))
                            {

                                if ($row_for_defining_process['cf_to_washing_color_change_max_value']<>0 && $row_for_qc['cf_to_washing_color_change_value']<>0) 
                                {
                                    
                                    $serial+=1;
                                    if($customer_type == 'american')
                                    {
                                        $cf_to_washing_color_change_tolerance_value = $row_for_defining_process['cf_to_washing_color_change_tolerance_value'];
                                        $cf_to_washing_staining_tolerance_value = $row_for_defining_process['cf_to_washing_staining_tolerance_value'];
                                        $cf_to_washing_color_change_value = $row_for_qc['cf_to_washing_color_change_value'];
                                        $cf_to_washing_staining_value_for_acetate = $row_for_qc['cf_to_washing_staining_value_for_acetate'];
                                        $cf_to_washing_staining_value_for_cotton = $row_for_qc['cf_to_washing_staining_value_for_cotton'];
                                        $cf_to_washing_staining_value_for_mylon = $row_for_qc['cf_to_washing_staining_value_for_mylon'];
                                        $cf_to_washing_staining_value_for_polyester = $row_for_qc['cf_to_washing_staining_value_for_polyester'];
                                        $cf_to_washing_staining_value_for_acrylic = $row_for_qc['cf_to_washing_staining_value_for_acrylic'];
                                        $cf_to_washing_staining_value_for_wool = $row_for_qc['cf_to_washing_staining_value_for_wool'];

                                    }
                                    if($customer_type == 'european')
                                    {
                                            // defining for color change
                                        $cf_to_washing_color_change_tolerance = $row_for_defining_process['cf_to_washing_color_change_tolerance_value'];
                                    
                                            if($cf_to_washing_color_change_tolerance ==1.0)
                                            {
                                                $cf_to_washing_color_change_tolerance_value = '1';
                                            }
                                            elseif($cf_to_washing_color_change_tolerance ==1.5)
                                            {
                                                $cf_to_washing_color_change_tolerance_value = '1-2';
                                            }
                                            elseif($cf_to_washing_color_change_tolerance ==2.0)
                                            {
                                                $cf_to_washing_color_change_tolerance_value = '2';
                                            }
                                            elseif($cf_to_washing_color_change_tolerance ==2.5)
                                            {
                                                $cf_to_washing_color_change_tolerance_value = '2-3';
                                            }
                                            elseif($cf_to_washing_color_change_tolerance ==3.0)
                                            {
                                                $cf_to_washing_color_change_tolerance_value = '3';
                                            }
                                            elseif($cf_to_washing_color_change_tolerance ==3.5)
                                            {
                                                $cf_to_washing_color_change_tolerance_value = '3-4';
                                            }
                                            elseif($cf_to_washing_color_change_tolerance ==4.0)
                                            {
                                                $cf_to_washing_color_change_tolerance_value = '4';
                                            }
                                            elseif($cf_to_washing_color_change_tolerance ==4.5)
                                            {
                                                $cf_to_washing_color_change_tolerance_value = '4-5';
                                            }
                                            elseif($cf_to_washing_color_change_tolerance ==5.0)
                                            {
                                                $cf_to_washing_color_change_tolerance_value = '5';
                                            }  			
                                            // defining for staining
                                            $cf_to_washing_staining_tolerance = $row_for_defining_process['cf_to_washing_staining_tolerance_value'];
                                    
                                            if($cf_to_washing_staining_tolerance ==1.0)
                                            {
                                                $cf_to_washing_staining_tolerance_value = '1';
                                            }
                                            elseif($cf_to_washing_staining_tolerance ==1.5)
                                            {
                                                $cf_to_washing_staining_tolerance_value = '1-2';
                                            }
                                            elseif($cf_to_washing_staining_tolerance ==2.0)
                                            {
                                                $cf_to_washing_staining_tolerance_value = '2';
                                            }
                                            elseif($cf_to_washing_staining_tolerance ==2.5)
                                            {
                                                $cf_to_washing_staining_tolerance_value = '2-3';
                                            }
                                            elseif($cf_to_washing_staining_tolerance ==3.0)
                                            {
                                                $cf_to_washing_staining_tolerance_value = '3';
                                            }
                                            elseif($cf_to_washing_staining_tolerance ==3.5)
                                            {
                                                $cf_to_washing_staining_tolerance_value = '3-4';
                                            }
                                            elseif($cf_to_washing_staining_tolerance ==4.0)
                                            {
                                                $cf_to_washing_staining_tolerance_value = '4';
                                            }
                                            elseif($cf_to_washing_staining_tolerance ==4.5)
                                            {
                                                $cf_to_washing_staining_tolerance_value = '4-5';
                                            }
                                            elseif($cf_to_washing_staining_tolerance ==5.0)
                                            {
                                                $cf_to_washing_staining_tolerance_value = '5';
                                            }
                                            

                                            // color change for qc
                                        $cf_to_washing_color_change = $row_for_qc['cf_to_washing_color_change_value'];
                                    
                                            if($cf_to_washing_color_change ==1.0)
                                            {
                                                $cf_to_washing_color_change_value = '1';
                                            }
                                            elseif($cf_to_washing_color_change ==1.5)
                                            {
                                                $cf_to_washing_color_change_value = '1-2';
                                            }
                                            elseif($cf_to_washing_color_change ==2.0)
                                            {
                                                $cf_to_washing_color_change_value = '2';
                                            }
                                            elseif($cf_to_washing_color_change ==2.5)
                                            {
                                                $cf_to_washing_color_change_value = '2-3';
                                            }
                                            elseif($cf_to_washing_color_change ==3.0)
                                            {
                                                $cf_to_washing_color_change_value = '3';
                                            }
                                            elseif($cf_to_washing_color_change ==3.5)
                                            {
                                                $cf_to_washing_color_change_value = '3-4';
                                            }
                                            elseif($cf_to_washing_color_change ==4.0)
                                            {
                                                $cf_to_washing_color_change_value = '4';
                                            }
                                            elseif($cf_to_washing_color_change ==4.5)
                                            {
                                                $cf_to_washing_color_change_value = '4-5';
                                            }
                                            elseif($cf_to_washing_color_change ==5.0)
                                            {
                                                $cf_to_washing_color_change_value = '5';
                                            }
                                                // acetate
                                            $cf_to_washing_staining_acetate = $row_for_qc['cf_to_washing_staining_value_for_acetate'];
                                            
                                            if($cf_to_washing_staining_acetate ==1.0)
                                            {
                                                $cf_to_washing_staining_value_for_acetate = '1';
                                            }
                                            elseif($cf_to_washing_staining_acetate ==1.5)
                                            {
                                                $cf_to_washing_staining_value_for_acetate = '1-2';
                                            }
                                            elseif($cf_to_washing_staining_acetate ==2.0)
                                            {
                                                $cf_to_washing_staining_value_for_acetate = '2';
                                            }
                                            elseif($cf_to_washing_staining_acetate ==2.5)
                                            {
                                                $cf_to_washing_staining_value_for_acetate = '2-3';
                                            }
                                            elseif($cf_to_washing_staining_acetate ==3.0)
                                            {
                                                $cf_to_washing_staining_value_for_acetate = '3';
                                            }
                                            elseif($cf_to_washing_staining_acetate ==3.5)
                                            {
                                                $cf_to_washing_staining_value_for_acetate = '3-4';
                                            }
                                            elseif($cf_to_washing_staining_acetate ==4.0)
                                            {
                                                $cf_to_washing_staining_value_for_acetate = '4';
                                            }
                                            elseif($cf_to_washing_staining_acetate ==4.5)
                                            {
                                                $cf_to_washing_staining_value_for_acetate = '4-5';
                                            }
                                            elseif($cf_to_washing_staining_acetate ==5.0)
                                            {
                                                $cf_to_washing_staining_value_for_acetate = '5';
                                            } 
                                            // cotton
                                            $cf_to_washing_staining_cotton = $row_for_qc['cf_to_washing_staining_value_for_cotton'];
                                            
                                            if($cf_to_washing_staining_cotton ==1.0)
                                            {
                                                $cf_to_washing_staining_value_for_cotton = '1';
                                            }
                                            elseif($cf_to_washing_staining_cotton ==1.5)
                                            {
                                                $cf_to_washing_staining_value_for_cotton = '1-2';
                                            }
                                            elseif($cf_to_washing_staining_cotton ==2.0)
                                            {
                                                $cf_to_washing_staining_value_for_cotton = '2';
                                            }
                                            elseif($cf_to_washing_staining_cotton ==2.5)
                                            {
                                                $cf_to_washing_staining_value_for_cotton = '2-3';
                                            }
                                            elseif($cf_to_washing_staining_cotton ==3.0)
                                            {
                                                $cf_to_washing_staining_value_for_cotton = '3';
                                            }
                                            elseif($cf_to_washing_staining_cotton ==3.5)
                                            {
                                                $cf_to_washing_staining_value_for_cotton = '3-4';
                                            }
                                            elseif($cf_to_washing_staining_cotton ==4.0)
                                            {
                                                $cf_to_washing_staining_value_for_cotton = '4';
                                            }
                                            elseif($cf_to_washing_staining_cotton ==4.5)
                                            {
                                                $cf_to_washing_staining_value_for_cotton = '4-5';
                                            }
                                            elseif($cf_to_washing_staining_cotton ==5.0)
                                            {
                                                $cf_to_washing_staining_value_for_cotton = '5';
                                            } 
                                                // nylon
                                            $cf_to_washing_staining_mylon = $row_for_qc['cf_to_washing_staining_value_for_mylon'];
                                            
                                            if($cf_to_washing_staining_mylon ==1.0)
                                            {
                                                $cf_to_washing_staining_value_for_mylon = '1';
                                            }
                                            elseif($cf_to_washing_staining_mylon ==1.5)
                                            {
                                                $cf_to_washing_staining_value_for_mylon = '1-2';
                                            }
                                            elseif($cf_to_washing_staining_mylon ==2.0)
                                            {
                                                $cf_to_washing_staining_value_for_mylon = '2';
                                            }
                                            elseif($cf_to_washing_staining_mylon ==2.5)
                                            {
                                                $cf_to_washing_staining_value_for_mylon = '2-3';
                                            }
                                            elseif($cf_to_washing_staining_mylon ==3.0)
                                            {
                                                $cf_to_washing_staining_value_for_mylon = '3';
                                            }
                                            elseif($cf_to_washing_staining_mylon ==3.5)
                                            {
                                                $cf_to_washing_staining_value_for_mylon = '3-4';
                                            }
                                            elseif($cf_to_washing_staining_mylon ==4.0)
                                            {
                                                $cf_to_washing_staining_value_for_mylon = '4';
                                            }
                                            elseif($cf_to_washing_staining_mylon ==4.5)
                                            {
                                                $cf_to_washing_staining_value_for_mylon = '4-5';
                                            }
                                            elseif($cf_to_washing_staining_mylon ==5.0)
                                            {
                                                $cf_to_washing_staining_value_for_mylon = '5';
                                            } 
                                            // polyester
                                            $cf_to_washing_staining_polyester = $row_for_qc['cf_to_washing_staining_value_for_polyester'];
                                            
                                            if($cf_to_washing_staining_polyester ==1.0)
                                            {
                                                $cf_to_washing_staining_value_for_polyester = '1';
                                            }
                                            elseif($cf_to_washing_staining_polyester ==1.5)
                                            {
                                                $cf_to_washing_staining_value_for_polyester = '1-2';
                                            }
                                            elseif($cf_to_washing_staining_polyester ==2.0)
                                            {
                                                $cf_to_washing_staining_value_for_polyester = '2';
                                            }
                                            elseif($cf_to_washing_staining_polyester ==2.5)
                                            {
                                                $cf_to_washing_staining_value_for_polyester = '2-3';
                                            }
                                            elseif($cf_to_washing_staining_polyester ==3.0)
                                            {
                                                $cf_to_washing_staining_value_for_polyester = '3';
                                            }
                                            elseif($cf_to_washing_staining_polyester ==3.5)
                                            {
                                                $cf_to_washing_staining_value_for_polyester = '3-4';
                                            }
                                            elseif($cf_to_washing_staining_polyester ==4.0)
                                            {
                                                $cf_to_washing_staining_value_for_polyester = '4';
                                            }
                                            elseif($cf_to_washing_staining_polyester ==4.5)
                                            {
                                                $cf_to_washing_staining_value_for_polyester = '4-5';
                                            }
                                            elseif($cf_to_washing_staining_polyester ==5.0)
                                            {
                                                $cf_to_washing_staining_value_for_polyester = '5';
                                            } 
                                            // acrylic
                                            $cf_to_washing_staining_acrylic = $row_for_qc['cf_to_washing_staining_value_for_acrylic'];
                                            
                                            if($cf_to_washing_staining_acrylic ==1.0)
                                            {
                                                $cf_to_washing_staining_value_for_acrylic = '1';
                                            }
                                            elseif($cf_to_washing_staining_acrylic ==1.5)
                                            {
                                                $cf_to_washing_staining_value_for_acrylic = '1-2';
                                            }
                                            elseif($cf_to_washing_staining_acrylic ==2.0)
                                            {
                                                $cf_to_washing_staining_value_for_acrylic = '2';
                                            }
                                            elseif($cf_to_washing_staining_acrylic ==2.5)
                                            {
                                                $cf_to_washing_staining_value_for_acrylic = '2-3';
                                            }
                                            elseif($cf_to_washing_staining_acrylic ==3.0)
                                            {
                                                $cf_to_washing_staining_value_for_acrylic = '3';
                                            }
                                            elseif($cf_to_washing_staining_acrylic ==3.5)
                                            {
                                                $cf_to_washing_staining_value_for_acrylic = '3-4';
                                            }
                                            elseif($cf_to_washing_staining_acrylic ==4.0)
                                            {
                                                $cf_to_washing_staining_value_for_acrylic = '4';
                                            }
                                            elseif($cf_to_washing_staining_acrylic ==4.5)
                                            {
                                                $cf_to_washing_staining_value_for_acrylic = '4-5';
                                            }
                                            elseif($cf_to_washing_staining_acrylic ==5.0)
                                            {
                                                $cf_to_washing_staining_value_for_acrylic = '5';
                                            } 
                                                // wool
                                            $cf_to_washing_staining_wool = $row_for_qc['cf_to_washing_staining_value_for_wool'];
                                            
                                            if($cf_to_washing_staining_wool ==1.0)
                                            {
                                                $cf_to_washing_staining_value_for_wool = '1';
                                            }
                                            elseif($cf_to_washing_staining_wool ==1.5)
                                            {
                                                $cf_to_washing_staining_value_for_wool = '1-2';
                                            }
                                            elseif($cf_to_washing_staining_wool ==2.0)
                                            {
                                                $cf_to_washing_staining_value_for_wool = '2';
                                            }
                                            elseif($cf_to_washing_staining_wool ==2.5)
                                            {
                                                $cf_to_washing_staining_value_for_wool = '2-3';
                                            }
                                            elseif($cf_to_washing_staining_wool ==3.0)
                                            {
                                                $cf_to_washing_staining_value_for_wool = '3';
                                            }
                                            elseif($cf_to_washing_staining_wool ==3.5)
                                            {
                                                $cf_to_washing_staining_value_for_wool = '3-4';
                                            }
                                            elseif($cf_to_washing_staining_wool ==4.0)
                                            {
                                                $cf_to_washing_staining_value_for_wool = '4';
                                            }
                                            elseif($cf_to_washing_staining_wool ==4.5)
                                            {
                                                $cf_to_washing_staining_value_for_wool = '4-5';
                                            }
                                            elseif($cf_to_washing_staining_wool ==5.0)
                                            {
                                                $cf_to_washing_staining_value_for_wool = '5';
                                            } 
                                            // for test result

                                            
                                    }
 
                                    $form.="
                                    <div class='form-group from-group-sm row'>
                                    <div class='col-sm-1'><b style='font-size: 20px;' >".$serial.".</b></div>
                                    <div class='col-sm-11' id='form-group_for_test_report_of_ikea'>
                                        <div class='col-sm-10'>
                                                <table class='table table-bordered'>
                                                    <thead>
                                                    <tr>
                                                            <label class='col-sm-12' for='name' style='font-size: 20px;' >  ".$row['test_name_method'].": </label>
                                                    </tr>
                                                    <tr>
                                                        <th class='text-center' colspan='7'>Result</th>
                                                        <th class='text-center' colspan='2'>Requirements</th>                                   
                                                    </tr>
                                                    <tr>
                                                        <th class='text-center' rowspan='2'>Color Change</th>
                                                        <th class='text-center' colspan='6'>Staining on to mulifiber</th>
                                                        <th class='text-center' rowspan='2'>Color Change</th>
                                                        <th class='text-center' rowspan='2'>Staining</th>
                                                    </tr>
                                                    <tr>
                                                        
                                                        <th id='acetate' class='text-center'>Acetate</th>
                                                        <th id='cotton' class='text-center'>Cotton</th>
                                                        <th id='mylon' class='text-center'>Mylon</th>
                                                        <th id='polyester' class='text-center'>Polyester</th>
                                                        <th id='acrylic' class='text-center'>Acrylic</th>
                                                        <th id='wool' class='text-center'>Wool</th>
                                                        

                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr >   

                                                            <td class='text-center'>".$cf_to_washing_color_change_value."</td>
                                                            <td class='text-center'>".$cf_to_washing_staining_value_for_acetate."</td>
                                                            <td class='text-center'>".$cf_to_washing_staining_value_for_cotton."</td>
                                                            <td class='text-center'>".$cf_to_washing_staining_value_for_mylon."</td>
                                                            <td class='text-center'>".$cf_to_washing_staining_value_for_polyester."</td>
                                                            <td class='text-center'>".$cf_to_washing_staining_value_for_acrylic."</td>
                                                            <td class='text-center'>".$cf_to_washing_staining_value_for_wool."</td>
                                                            <td class='text-center'>".$row_for_defining_process['cf_to_washing_color_change_tolerance_range_math_operator'].$cf_to_washing_color_change_tolerance_value."</td>
                                                            <td class='text-center'>".$row_for_defining_process['cf_to_washing_staining_tolerance_range_math_operator'].$cf_to_washing_staining_tolerance_value."</td>
                                                        </tr>

                                                    
                                                    
                                                    </tbody>
                                                </table>
                                            </div>
                                            </div>
                                        </div>";

                                }
                                echo $form;
                                $form = "";

                            }  /*End of if (in_array($row['id'], ['15','59']))*/

                            if (in_array($row['id'], ['16']))
                            {
                                
                                if($row_for_defining_process['cf_to_dry_cleaning_color_change_max_value']<>0 && $row_for_qc['cf_to_dry_cleaning_color_change_value']<>0)
                                { 

                                    $serial+=1;

                                    if($customer_type == 'american')
                                    {
                                        $cf_to_dry_cleaning_color_change_tolerance_value = $row_for_defining_process['cf_to_dry_cleaning_color_change_tolerance_value'];
                                        $cf_to_dry_cleaning_staining_tolerance_value = $row_for_defining_process['cf_to_dry_cleaning_staining_tolerance_value'];
                                        $cf_to_dry_cleaning_color_change_value = $row_for_qc['cf_to_dry_cleaning_color_change_value'];
                                        $cf_to_dry_cleaning_staining_value_for_acetate = $row_for_qc['cf_to_dry_cleaning_staining_value_for_acetate'];
                                        $cf_to_dry_cleaning_staining_value_for_cotton = $row_for_qc['cf_to_dry_cleaning_staining_value_for_cotton'];
                                        $cf_to_dry_cleaning_staining_value_for_mylon = $row_for_qc['cf_to_dry_cleaning_staining_value_for_mylon'];
                                        $cf_to_dry_cleaning_staining_value_for_polyester = $row_for_qc['cf_to_dry_cleaning_staining_value_for_polyester'];
                                        $cf_to_dry_cleaning_staining_value_for_acrylic = $row_for_qc['cf_to_dry_cleaning_staining_value_for_acrylic'];
                                        $cf_to_dry_cleaning_staining_value_for_wool = $row_for_qc['cf_to_dry_cleaning_staining_value_for_wool'];

                                    }
                                    if($customer_type == 'european')
                                    {
                                            // defining for color change
                                        $cf_to_dry_cleaning_color_change_tolerance = $row_for_defining_process['cf_to_dry_cleaning_color_change_tolerance_value'];
                                    
                                            if($cf_to_dry_cleaning_color_change_tolerance ==1.0)
                                            {
                                                $cf_to_dry_cleaning_color_change_tolerance_value = '1';
                                            }
                                            elseif($cf_to_dry_cleaning_color_change_tolerance ==1.5)
                                            {
                                                $cf_to_dry_cleaning_color_change_tolerance_value = '1-2';
                                            }
                                            elseif($cf_to_dry_cleaning_color_change_tolerance ==2.0)
                                            {
                                                $cf_to_dry_cleaning_color_change_tolerance_value = '2';
                                            }
                                            elseif($cf_to_dry_cleaning_color_change_tolerance ==2.5)
                                            {
                                                $cf_to_washing_color_change_tolerance_value = '2-3';
                                            }
                                            elseif($cf_to_dry_cleaning_color_change_tolerance ==3.0)
                                            {
                                                $cf_to_dry_cleaning_color_change_tolerance_value = '3';
                                            }
                                            elseif($cf_to_dry_cleaning_color_change_tolerance ==3.5)
                                            {
                                                $cf_to_dry_cleaning_color_change_tolerance_value = '3-4';
                                            }
                                            elseif($cf_to_dry_cleaning_color_change_tolerance ==4.0)
                                            {
                                                $cf_to_dry_cleaning_color_change_tolerance_value = '4';
                                            }
                                            elseif($cf_to_dry_cleaning_color_change_tolerance ==4.5)
                                            {
                                                $cf_to_dry_cleaning_color_change_tolerance_value = '4-5';
                                            }
                                            elseif($cf_to_dry_cleaning_color_change_tolerance ==5.0)
                                            {
                                                $cf_to_dry_cleaning_color_change_tolerance_value = '5';
                                            }  			
                                            // defining for staining
                                            $cf_to_dry_cleaning_staining_tolerance = $row_for_defining_process['cf_to_dry_cleaning_staining_tolerance_value'];
                                    
                                            if($cf_to_dry_cleaning_staining_tolerance ==1.0)
                                            {
                                                $cf_to_dry_cleaning_staining_tolerance_value = '1';
                                            }
                                            elseif($cf_to_dry_cleaning_staining_tolerance ==1.5)
                                            {
                                                $cf_to_dry_cleaning_staining_tolerance_value = '1-2';
                                            }
                                            elseif($cf_to_dry_cleaning_staining_tolerance ==2.0)
                                            {
                                                $cf_to_dry_cleaning_staining_tolerance_value = '2';
                                            }
                                            elseif($cf_to_dry_cleaning_staining_tolerance ==2.5)
                                            {
                                                $cf_to_dry_cleaning_staining_tolerance_value = '2-3';
                                            }
                                            elseif($cf_to_dry_cleaning_staining_tolerance ==3.0)
                                            {
                                                $cf_to_dry_cleaning_staining_tolerance_value = '3';
                                            }
                                            elseif($cf_to_dry_cleaning_staining_tolerance ==3.5)
                                            {
                                                $cf_to_dry_cleaning_staining_tolerance_value = '3-4';
                                            }
                                            elseif($cf_to_dry_cleaning_staining_tolerance ==4.0)
                                            {
                                                $cf_to_dry_cleaning_staining_tolerance_value = '4';
                                            }
                                            elseif($cf_to_dry_cleaning_staining_tolerance ==4.5)
                                            {
                                                $cf_to_dry_cleaning_staining_tolerance_value = '4-5';
                                            }
                                            elseif($cf_to_dry_cleaning_staining_tolerance ==5.0)
                                            {
                                                $cf_to_dry_cleaning_staining_tolerance_value = '5';
                                            }
                                            

                                            // color change for qc
                                        $cf_to_dry_cleaning_color_change = $row_for_qc['cf_to_dry_cleaning_color_change_value'];
                                    
                                            if($cf_to_dry_cleaning_color_change ==1.0)
                                            {
                                                $cf_to_dry_cleaning_color_change_value = '1';
                                            }
                                            elseif($cf_to_dry_cleaning_color_change ==1.5)
                                            {
                                                $cf_to_dry_cleaning_color_change_value = '1-2';
                                            }
                                            elseif($cf_to_dry_cleaning_color_change ==2.0)
                                            {
                                                $cf_to_dry_cleaning_color_change_value = '2';
                                            }
                                            elseif($cf_to_dry_cleaning_color_change ==2.5)
                                            {
                                                $cf_to_dry_cleaning_color_change_value = '2-3';
                                            }
                                            elseif($cf_to_dry_cleaning_color_change ==3.0)
                                            {
                                                $cf_to_dry_cleaning_color_change_value = '3';
                                            }
                                            elseif($cf_to_dry_cleaning_color_change ==3.5)
                                            {
                                                $cf_to_dry_cleaning_color_change_value = '3-4';
                                            }
                                            elseif($cf_to_dry_cleaning_color_change ==4.0)
                                            {
                                                $cf_to_dry_cleaning_color_change_value = '4';
                                            }
                                            elseif($cf_to_dry_cleaning_color_change ==4.5)
                                            {
                                                $cf_to_dry_cleaning_color_change_value = '4-5';
                                            }
                                            elseif($cf_to_dry_cleaning_color_change ==5.0)
                                            {
                                                $cf_to_dry_cleaning_color_change_value = '5';
                                            }
                                                // acetate
                                                $cf_to_dry_cleaning_staining_acetate = $row_for_qc['cf_to_dry_cleaning_staining_value_for_acetate'];
                                                            
                                                if($cf_to_dry_cleaning_staining_acetate ==1.0)
                                                {
                                                    $cf_to_dry_cleaning_staining_value_for_acetate = '1';
                                                }
                                                elseif($cf_to_dry_cleaning_staining_acetate ==1.5)
                                                {
                                                    $cf_to_dry_cleaning_staining_value_for_acetate = '1-2';
                                                }
                                                elseif($cf_to_dry_cleaning_staining_acetate ==2.0)
                                                {
                                                    $cf_to_dry_cleaning_staining_value_for_acetate = '2';
                                                }
                                                elseif($cf_to_dry_cleaning_staining_acetate ==2.5)
                                                {
                                                    $cf_to_dry_cleaning_staining_value_for_acetate = '2-3';
                                                }
                                                elseif($cf_to_dry_cleaning_staining_acetate ==3.0)
                                                {
                                                    $cf_to_dry_cleaning_staining_value_for_acetate = '3';
                                                }
                                                elseif($cf_to_dry_cleaning_staining_acetate ==3.5)
                                                {
                                                    $cf_to_dry_cleaning_staining_value_for_acetate = '3-4';
                                                }
                                                elseif($cf_to_dry_cleaning_staining_acetate ==4.0)
                                                {
                                                    $cf_to_dry_cleaning_staining_value_for_acetate = '4';
                                                }
                                                elseif($cf_to_dry_cleaning_staining_acetate ==4.5)
                                                {
                                                    $cf_to_dry_cleaning_staining_value_for_acetate = '4-5';
                                                }
                                                elseif($cf_to_dry_cleaning_staining_acetate ==5.0)
                                                {
                                                    $cf_to_dry_cleaning_staining_value_for_acetate = '5';
                                                } 
                                            // cotton
                                            $cf_to_dry_cleaning_staining_cotton = $row_for_qc['cf_to_dry_cleaning_staining_value_for_cotton'];
                                            
                                            if($cf_to_dry_cleaning_staining_cotton ==1.0)
                                            {
                                                $cf_to_dry_cleaning_staining_value_for_cotton = '1';
                                            }
                                            elseif($cf_to_dry_cleaning_staining_cotton ==1.5)
                                            {
                                                $cf_to_dry_cleaning_staining_value_for_cotton = '1-2';
                                            }
                                            elseif($cf_to_dry_cleaning_staining_cotton ==2.0)
                                            {
                                                $cf_to_dry_cleaning_staining_value_for_cotton = '2';
                                            }
                                            elseif($cf_to_dry_cleaning_staining_cotton ==2.5)
                                            {
                                                $cf_to_dry_cleaning_staining_value_for_cotton = '2-3';
                                            }
                                            elseif($cf_to_dry_cleaning_staining_cotton ==3.0)
                                            {
                                                $cf_to_dry_cleaning_staining_value_for_cotton = '3';
                                            }
                                            elseif($cf_to_dry_cleaning_staining_cotton ==3.5)
                                            {
                                                $cf_to_dry_cleaning_staining_value_for_cotton = '3-4';
                                            }
                                            elseif($cf_to_dry_cleaning_staining_cotton ==4.0)
                                            {
                                                $cf_to_dry_cleaning_staining_value_for_cotton = '4';
                                            }
                                            elseif($cf_to_dry_cleaning_staining_cotton ==4.5)
                                            {
                                                $cf_to_dry_cleaning_staining_value_for_cotton = '4-5';
                                            }
                                            elseif($cf_to_dry_cleaning_staining_cotton ==5.0)
                                            {
                                                $cf_to_dry_cleaning_staining_value_for_cotton = '5';
                                            } 
                                                // nylon
                                            $cf_to_dry_cleaning_staining_mylon = $row_for_qc['cf_to_dry_cleaning_staining_value_for_mylon'];
                                            
                                            if($cf_to_dry_cleaning_staining_mylon ==1.0)
                                            {
                                                $cf_to_dry_cleaning_staining_value_for_mylon = '1';
                                            }
                                            elseif($cf_to_dry_cleaning_staining_mylon ==1.5)
                                            {
                                                $cf_to_dry_cleaning_staining_value_for_mylon = '1-2';
                                            }
                                            elseif($cf_to_dry_cleaning_staining_mylon ==2.0)
                                            {
                                                $cf_to_dry_cleaning_staining_value_for_mylon = '2';
                                            }
                                            elseif($cf_to_dry_cleaning_staining_mylon ==2.5)
                                            {
                                                $cf_to_dry_cleaning_staining_value_for_mylon = '2-3';
                                            }
                                            elseif($cf_to_dry_cleaning_staining_mylon ==3.0)
                                            {
                                                $cf_to_dry_cleaning_staining_value_for_mylon = '3';
                                            }
                                            elseif($cf_to_dry_cleaning_staining_mylon ==3.5)
                                            {
                                                $cf_to_dry_cleaning_staining_value_for_mylon = '3-4';
                                            }
                                            elseif($cf_to_dry_cleaning_staining_mylon ==4.0)
                                            {
                                                $cf_to_dry_cleaning_staining_value_for_mylon = '4';
                                            }
                                            elseif($cf_to_dry_cleaning_staining_mylon ==4.5)
                                            {
                                                $cf_to_dry_cleaning_staining_value_for_mylon = '4-5';
                                            }
                                            elseif($cf_to_dry_cleaning_staining_mylon ==5.0)
                                            {
                                                $cf_to_dry_cleaning_staining_value_for_mylon = '5';
                                            } 
                                            // polyester
                                            $cf_to_dry_cleaning_staining_polyester = $row_for_qc['cf_to_dry_cleaning_staining_value_for_polyester'];
                                            
                                            if($cf_to_dry_cleaning_staining_polyester ==1.0)
                                            {
                                                $cf_to_dry_cleaning_staining_value_for_polyester = '1';
                                            }
                                            elseif($cf_to_dry_cleaning_staining_polyester ==1.5)
                                            {
                                                $cf_to_dry_cleaning_staining_value_for_polyester = '1-2';
                                            }
                                            elseif($cf_to_dry_cleaning_staining_polyester ==2.0)
                                            {
                                                $cf_to_dry_cleaning_staining_value_for_polyester = '2';
                                            }
                                            elseif($cf_to_dry_cleaning_staining_polyester ==2.5)
                                            {
                                                $cf_to_dry_cleaning_staining_value_for_polyester = '2-3';
                                            }
                                            elseif($cf_to_dry_cleaning_staining_polyester ==3.0)
                                            {
                                                $cf_to_dry_cleaning_staining_value_for_polyester = '3';
                                            }
                                            elseif($cf_to_dry_cleaning_staining_polyester ==3.5)
                                            {
                                                $cf_to_dry_cleaning_staining_value_for_polyester = '3-4';
                                            }
                                            elseif($cf_to_dry_cleaning_staining_polyester ==4.0)
                                            {
                                                $cf_to_dry_cleaning_staining_value_for_polyester = '4';
                                            }
                                            elseif($cf_to_dry_cleaning_staining_polyester ==4.5)
                                            {
                                                $cf_to_dry_cleaning_staining_value_for_polyester = '4-5';
                                            }
                                            elseif($cf_to_dry_cleaning_staining_polyester ==5.0)
                                            {
                                                $cf_to_dry_cleaning_staining_value_for_polyester = '5';
                                            } 
                                            // acrylic
                                            $cf_to_dry_cleaning_staining_acrylic = $row_for_qc['cf_to_dry_cleaning_staining_value_for_acrylic'];
                                            
                                            if($cf_to_dry_cleaning_staining_acrylic ==1.0)
                                            {
                                                $cf_to_dry_cleaning_staining_value_for_acrylic = '1';
                                            }
                                            elseif($cf_to_dry_cleaning_staining_acrylic ==1.5)
                                            {
                                                $cf_to_dry_cleaning_staining_value_for_acrylic = '1-2';
                                            }
                                            elseif($cf_to_dry_cleaning_staining_acrylic ==2.0)
                                            {
                                                $cf_to_dry_cleaning_staining_value_for_acrylic = '2';
                                            }
                                            elseif($cf_to_dry_cleaning_staining_acrylic ==2.5)
                                            {
                                                $cf_to_dry_cleaning_staining_value_for_acrylic = '2-3';
                                            }
                                            elseif($cf_to_dry_cleaning_staining_acrylic ==3.0)
                                            {
                                                $cf_to_dry_cleaning_staining_value_for_acrylic = '3';
                                            }
                                            elseif($cf_to_dry_cleaning_staining_acrylic ==3.5)
                                            {
                                                $cf_to_dry_cleaning_staining_value_for_acrylic = '3-4';
                                            }
                                            elseif($cf_to_dry_cleaning_staining_acrylic ==4.0)
                                            {
                                                $cf_to_dry_cleaning_staining_value_for_acrylic = '4';
                                            }
                                            elseif($cf_to_dry_cleaning_staining_acrylic ==4.5)
                                            {
                                                $cf_to_dry_cleaning_staining_value_for_acrylic = '4-5';
                                            }
                                            elseif($cf_to_dry_cleaning_staining_acrylic ==5.0)
                                            {
                                                $cf_to_dry_cleaning_staining_value_for_acrylic = '5';
                                            } 
                                                // wool
                                            $cf_to_dry_cleaning_staining_wool = $row_for_qc['cf_to_dry_cleaning_staining_value_for_wool'];
                                            
                                            if($cf_to_dry_cleaning_staining_wool ==1.0)
                                            {
                                                $cf_to_dry_cleaning_staining_value_for_wool = '1';
                                            }
                                            elseif($cf_to_dry_cleaning_staining_wool ==1.5)
                                            {
                                                $cf_to_dry_cleaning_staining_value_for_wool = '1-2';
                                            }
                                            elseif($cf_to_dry_cleaning_staining_wool ==2.0)
                                            {
                                                $cf_to_dry_cleaning_staining_value_for_wool = '2';
                                            }
                                            elseif($cf_to_dry_cleaning_staining_wool ==2.5)
                                            {
                                                $cf_to_dry_cleaning_staining_value_for_wool = '2-3';
                                            }
                                            elseif($cf_to_dry_cleaning_staining_wool ==3.0)
                                            {
                                                $cf_to_dry_cleaning_staining_value_for_wool = '3';
                                            }
                                            elseif($cf_to_dry_cleaning_staining_wool ==3.5)
                                            {
                                                $cf_to_dry_cleaning_staining_value_for_wool = '3-4';
                                            }
                                            elseif($cf_to_dry_cleaning_staining_wool ==4.0)
                                            {
                                                $cf_to_dry_cleaning_staining_value_for_wool = '4';
                                            }
                                            elseif($cf_to_dry_cleaning_staining_wool ==4.5)
                                            {
                                                $cf_to_dry_cleaning_staining_value_for_wool = '4-5';
                                            }
                                            elseif($cf_to_dry_cleaning_staining_wool ==5.0)
                                            {
                                                $cf_to_dry_cleaning_staining_value_for_wool = '5';
                                            } 
                                            // for test result

                                            
                                    }


                                    $form.="
                                    <div class='form-group from-group-sm row'>
                                    <div class='col-sm-1'><b style='font-size: 20px;' >".$serial.".</b></div>
                                    <div class='col-sm-11' id='form-group_for_test_report_of_ikea'>
                                        <div class='col-sm-10'>
                                                    <table class='table table-bordered'>
                                                        <thead>
                                                        <tr>
                                                            <label class='col-sm-12' for='name' style='font-size: 20px;'>".$row['test_name_method'].": </label>
                                                        </tr>
                                                        <tr>
                                                            <th class='text-center' colspan='7'>Result</th>
                                                            <th class='text-center' colspan='2'>Requirements</th>                                   
                                                        </tr>
                                                        <tr>
                                                            <th class='text-center' rowspan='2'>Color Change</th>
                                                            <th class='text-center' colspan='6'>Staining on to mulifiber</th>
                                                            <th class='text-center' rowspan='2'>Color Change</th>
                                                            <th class='text-center' rowspan='2'>Staining</th>
                                                        </tr>
                                                        <tr>
                                                            
                                                            <th class='text-center'>Acetate</th>
                                                            <th class='text-center'>Cotton</th>
                                                            <th class='text-center'>Mylon</th>
                                                            <th class='text-center'>Polyester</th>
                                                            <th class='text-center'>Acrylic</th>
                                                            <th class='text-center'>Wool</th>
                                                            

                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td class='text-center'>".$cf_to_dry_cleaning_color_change_value."</td>
                                                                <td class='text-center'>".$cf_to_dry_cleaning_staining_value_for_acetate."</td>
                                                                <td class='text-center'>".$cf_to_dry_cleaning_staining_value_for_cotton."</td>
                                                                <td class='text-center'>".$cf_to_dry_cleaning_staining_value_for_mylon."</td>
                                                                <td class='text-center'>".$cf_to_dry_cleaning_staining_value_for_polyester."</td>
                                                                <td class='text-center'>".$cf_to_dry_cleaning_staining_value_for_acrylic."</td>
                                                                <td class='text-center'>".$cf_to_dry_cleaning_staining_value_for_wool."</td>
                                                                <td class='text-center'>".$row_for_defining_process['cf_to_dry_cleaning_color_change_tolerance_range_math_operator'].' '.$cf_to_dry_cleaning_color_change_tolerance_value.' '.$row_for_defining_process['uom_of_cf_to_dry_cleaning_color_change']."</td>
                                                                <td class='text-center'>".$row_for_defining_process['cf_to_dry_cleaning_staining_tolerance_range_math_operator'].' '.$cf_to_dry_cleaning_staining_tolerance_value.' '.$row_for_defining_process['uom_of_cf_to_dry_cleaning_staining']."</td>
                                                                </tr>

                                                        
                                                        
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>";
                                }
                                echo $form;
                                $form = "";

                            } /* ENd of if (in_array($row['id'], ['16']))*/
                            

                            if (in_array($row['id'], ['17']))
                            {
                                
                                if($row_for_defining_process['cf_to_perspiration_acid_color_change_max_value']<>0 && $row_for_qc['cf_to_perspiration_acid_color_change_value']<>0)
                                { 

                                    $serial+=1;
                                    if($customer_type == 'american')
                                    {
                                        $cf_to_perspiration_acid_color_change_tolerance_value = $row_for_defining_process['cf_to_perspiration_acid_color_change_tolerance_value'];
                                        $cf_to_perspiration_acid_staining_value = $row_for_defining_process['cf_to_perspiration_acid_staining_value'];
                                        $cf_to_perspiration_acid_color_change_value = $row_for_qc['cf_to_perspiration_acid_color_change_value'];
                                        $cf_to_perspiration_acid_staining_value_for_acetate = $row_for_qc['cf_to_perspiration_acid_staining_value_for_acetate'];
                                        $cf_to_perspiration_acid_staining_value_for_cotton = $row_for_qc['cf_to_perspiration_acid_staining_value_for_cotton'];
                                        $cf_to_perspiration_acid_staining_value_for_mylon = $row_for_qc['cf_to_perspiration_acid_staining_value_for_mylon'];
                                        $cf_to_perspiration_acid_staining_value_for_polyester = $row_for_qc['cf_to_perspiration_acid_staining_value_for_polyester'];
                                        $cf_to_perspiration_acid_staining_value_for_acrylic = $row_for_qc['cf_to_perspiration_acid_staining_value_for_acrylic'];
                                        $cf_to_perspiration_acid_staining_value_for_wool = $row_for_qc['cf_to_perspiration_acid_staining_value_for_wool'];

                                    }
                                    if($customer_type == 'european')
                                    {
                                        // defining for color change
                                        $cf_to_perspiration_acid_color_change_tolerance = $row_for_defining_process['cf_to_perspiration_acid_color_change_tolerance_value'];
                                
                                        if($cf_to_perspiration_acid_color_change_tolerance ==1.0)
                                        {
                                            $cf_to_perspiration_acid_color_change_tolerance_value = '1';
                                        }
                                        elseif($cf_to_perspiration_acid_color_change_tolerance ==1.5)
                                        {
                                            $cf_to_perspiration_acid_color_change_tolerance_value = '1-2';
                                        }
                                        elseif($cf_to_perspiration_acid_color_change_tolerance ==2.0)
                                        {
                                            $cf_to_perspiration_acid_color_change_tolerance_value = '2';
                                        }
                                        elseif($cf_to_perspiration_acid_color_change_tolerance ==2.5)
                                        {
                                            $cf_to_perspiration_acid_color_change_tolerance_value = '2-3';
                                        }
                                        elseif($cf_to_perspiration_acid_color_change_tolerance ==3.0)
                                        {
                                            $cf_to_perspiration_acid_color_change_tolerance_value = '3';
                                        }
                                        elseif($cf_to_perspiration_acid_color_change_tolerance ==3.5)
                                        {
                                            $cf_to_perspiration_acid_color_change_tolerance_value = '3-4';
                                        }
                                        elseif($cf_to_perspiration_acid_color_change_tolerance ==4.0)
                                        {
                                            $cf_to_perspiration_acid_color_change_tolerance_value = '4';
                                        }
                                        elseif($cf_to_perspiration_acid_color_change_tolerance ==4.5)
                                        {
                                            $cf_to_perspiration_acid_color_change_tolerance_value = '4-5';
                                        }
                                        elseif($cf_to_perspiration_acid_color_change_tolerance ==5.0)
                                        {
                                            $cf_to_perspiration_acid_color_change_tolerance_value = '5';
                                        }  			
                                        // defining for staining
                                        $cf_to_perspiration_acid_staining = $row_for_defining_process['cf_to_perspiration_acid_staining_value'];
                                
                                        if($cf_to_perspiration_acid_staining ==1.0)
                                        {
                                            $cf_to_perspiration_acid_staining_value = '1';
                                        }
                                        elseif($cf_to_perspiration_acid_staining ==1.5)
                                        {
                                            $cf_to_perspiration_acid_staining_value = '1-2';
                                        }
                                        elseif($cf_to_perspiration_acid_staining ==2.0)
                                        {
                                            $cf_to_perspiration_acid_staining_value = '2';
                                        }
                                        elseif($cf_to_perspiration_acid_staining ==2.5)
                                        {
                                            $cf_to_perspiration_acid_staining_value = '2-3';
                                        }
                                        elseif($cf_to_perspiration_acid_staining ==3.0)
                                        {
                                            $cf_to_perspiration_acid_staining_value = '3';
                                        }
                                        elseif($cf_to_perspiration_acid_staining ==3.5)
                                        {
                                            $cf_to_perspiration_acid_staining_value = '3-4';
                                        }
                                        elseif($cf_to_perspiration_acid_staining ==4.0)
                                        {
                                            $cf_to_perspiration_acid_staining_value = '4';
                                        }
                                        elseif($cf_to_perspiration_acid_staining ==4.5)
                                        {
                                            $cf_to_perspiration_acid_staining_value = '4-5';
                                        }
                                        elseif($cf_to_perspiration_acid_staining ==5.0)
                                        {
                                            $cf_to_perspiration_acid_staining_value = '5';
                                        }
                                    

                                        // color change for qc
                                            $cf_to_perspiration_acid_color_change = $row_for_qc['cf_to_perspiration_acid_color_change_value'];
                                
                                        if($cf_to_perspiration_acid_color_change ==1.0)
                                        {
                                            $cf_to_perspiration_acid_color_change_value = '1';
                                        }
                                        elseif($cf_to_perspiration_acid_color_change ==1.5)
                                        {
                                            $cf_to_perspiration_acid_color_change_value = '1-2';
                                        }
                                        elseif($cf_to_perspiration_acid_color_change ==2.0)
                                        {
                                            $cf_to_perspiration_acid_color_change_value = '2';
                                        }
                                        elseif($cf_to_perspiration_acid_color_change ==2.5)
                                        {
                                            $cf_to_perspiration_acid_color_change_value = '2-3';
                                        }
                                        elseif($cf_to_perspiration_acid_color_change ==3.0)
                                        {
                                            $cf_to_perspiration_acid_color_change_value = '3';
                                        }
                                        elseif($cf_to_perspiration_acid_color_change ==3.5)
                                        {
                                            $cf_to_perspiration_acid_color_change_value = '3-4';
                                        }
                                        elseif($cf_to_perspiration_acid_color_change ==4.0)
                                        {
                                            $cf_to_perspiration_acid_color_change_value = '4';
                                        }
                                        elseif($cf_to_perspiration_acid_color_change ==4.5)
                                        {
                                            $cf_to_perspiration_acid_color_change_value = '4-5';
                                        }
                                        elseif($cf_to_perspiration_acid_color_change ==5.0)
                                        {
                                            $cf_to_perspiration_acid_color_change_value = '5';
                                        }
                                        // acetate
                                        $cf_to_perspiration_acid_staining_acetate = $row_for_qc['cf_to_perspiration_acid_staining_value_for_acetate'];
                                        
                                        if($cf_to_perspiration_acid_staining_acetate ==1.0)
                                        {
                                            $cf_to_perspiration_acid_staining_value_for_acetate = '1';
                                        }
                                        elseif($cf_to_perspiration_acid_staining_acetate ==1.5)
                                        {
                                            $cf_to_perspiration_acid_staining_value_for_acetate = '1-2';
                                        }
                                        elseif($cf_to_perspiration_acid_staining_acetate ==2.0)
                                        {
                                            $cf_to_perspiration_acid_staining_value_for_acetate = '2';
                                        }
                                        elseif($cf_to_perspiration_acid_staining_acetate ==2.5)
                                        {
                                            $cf_to_perspiration_acid_staining_value_for_acetate = '2-3';
                                        }
                                        elseif($cf_to_perspiration_acid_staining_acetate ==3.0)
                                        {
                                            $cf_to_perspiration_acid_staining_value_for_acetate = '3';
                                        }
                                        elseif($cf_to_perspiration_acid_staining_acetate ==3.5)
                                        {
                                            $cf_to_perspiration_acid_staining_value_for_acetate = '3-4';
                                        }
                                        elseif($cf_to_perspiration_acid_staining_acetate ==4.0)
                                        {
                                            $cf_to_perspiration_acid_staining_value_for_acetate = '4';
                                        }
                                        elseif($cf_to_perspiration_acid_staining_acetate ==4.5)
                                        {
                                            $cf_to_perspiration_acid_staining_value_for_acetate = '4-5';
                                        }
                                        elseif($cf_to_perspiration_acid_staining_acetate ==5.0)
                                        {
                                            $cf_to_perspiration_acid_staining_value_for_acetate = '5';
                                        } 
                                        // cotton
                                        $cf_to_perspiration_acid_staining_cotton = $row_for_qc['cf_to_perspiration_acid_staining_value_for_cotton'];
                                        
                                        if($cf_to_perspiration_acid_staining_cotton ==1.0)
                                        {
                                            $cf_to_perspiration_acid_staining_value_for_cotton = '1';
                                        }
                                        elseif($cf_to_perspiration_acid_staining_cotton ==1.5)
                                        {
                                            $cf_to_perspiration_acid_staining_value_for_cotton = '1-2';
                                        }
                                        elseif($cf_to_perspiration_acid_staining_cotton ==2.0)
                                        {
                                            $cf_to_perspiration_acid_staining_value_for_cotton = '2';
                                        }
                                        elseif($cf_to_perspiration_acid_staining_cotton ==2.5)
                                        {
                                            $cf_to_perspiration_acid_staining_value_for_cotton = '2-3';
                                        }
                                        elseif($cf_to_perspiration_acid_staining_cotton ==3.0)
                                        {
                                            $cf_to_perspiration_acid_staining_value_for_cotton = '3';
                                        }
                                        elseif($cf_to_perspiration_acid_staining_cotton ==3.5)
                                        {
                                            $cf_to_perspiration_acid_staining_value_for_cotton = '3-4';
                                        }
                                        elseif($cf_to_perspiration_acid_staining_cotton ==4.0)
                                        {
                                            $cf_to_perspiration_acid_staining_value_for_cotton = '4';
                                        }
                                        elseif($cf_to_perspiration_acid_staining_cotton ==4.5)
                                        {
                                            $cf_to_perspiration_acid_staining_value_for_cotton = '4-5';
                                        }
                                        elseif($cf_to_perspiration_acid_staining_cotton ==5.0)
                                        {
                                            $cf_to_perspiration_acid_staining_value_for_cotton = '5';
                                        } 
                                            // nylon
                                        $cf_to_perspiration_acid_staining_mylon = $row_for_qc['cf_to_perspiration_acid_staining_value_for_mylon'];
                                        
                                        if($cf_to_perspiration_acid_staining_mylon ==1.0)
                                        {
                                            $cf_to_perspiration_acid_staining_value_for_mylon = '1';
                                        }
                                        elseif($cf_to_perspiration_acid_staining_mylon ==1.5)
                                        {
                                            $cf_to_perspiration_acid_staining_value_for_mylon = '1-2';
                                        }
                                        elseif($cf_to_perspiration_acid_staining_mylon ==2.0)
                                        {
                                            $cf_to_perspiration_acid_staining_value_for_mylon = '2';
                                        }
                                        elseif($cf_to_perspiration_acid_staining_mylon ==2.5)
                                        {
                                            $cf_to_perspiration_acid_staining_value_for_mylon = '2-3';
                                        }
                                        elseif($cf_to_perspiration_acid_staining_mylon ==3.0)
                                        {
                                            $cf_to_perspiration_acid_staining_value_for_mylon = '3';
                                        }
                                        elseif($cf_to_perspiration_acid_staining_mylon ==3.5)
                                        {
                                            $cf_to_perspiration_acid_staining_value_for_mylon = '3-4';
                                        }
                                        elseif($cf_to_perspiration_acid_staining_mylon ==4.0)
                                        {
                                            $cf_to_perspiration_acid_staining_value_for_mylon = '4';
                                        }
                                        elseif($cf_to_perspiration_acid_staining_mylon ==4.5)
                                        {
                                            $cf_to_perspiration_acid_staining_value_for_mylon = '4-5';
                                        }
                                        elseif($cf_to_perspiration_acid_staining_mylon ==5.0)
                                        {
                                            $cf_to_perspiration_acid_staining_value_for_mylon = '5';
                                        } 
                                        // polyester
                                        $cf_to_perspiration_acid_staining_polyester = $row_for_qc['cf_to_perspiration_acid_staining_value_for_polyester'];
                                        
                                        if($cf_to_perspiration_acid_staining_polyester ==1.0)
                                        {
                                            $cf_to_perspiration_acid_staining_value_for_polyester = '1';
                                        }
                                        elseif($cf_to_perspiration_acid_staining_polyester ==1.5)
                                        {
                                            $cf_to_perspiration_acid_staining_value_for_polyester = '1-2';
                                        }
                                        elseif($cf_to_perspiration_acid_staining_polyester ==2.0)
                                        {
                                            $cf_to_perspiration_acid_staining_value_for_polyester = '2';
                                        }
                                        elseif($cf_to_perspiration_acid_staining_polyester ==2.5)
                                        {
                                            $cf_to_perspiration_acid_staining_value_for_polyester = '2-3';
                                        }
                                        elseif($cf_to_perspiration_acid_staining_polyester ==3.0)
                                        {
                                            $cf_to_perspiration_acid_staining_value_for_polyester = '3';
                                        }
                                        elseif($cf_to_perspiration_acid_staining_polyester ==3.5)
                                        {
                                            $cf_to_perspiration_acid_staining_value_for_polyester = '3-4';
                                        }
                                        elseif($cf_to_perspiration_acid_staining_polyester ==4.0)
                                        {
                                            $cf_to_perspiration_acid_staining_value_for_polyester = '4';
                                        }
                                        elseif($cf_to_perspiration_acid_staining_polyester ==4.5)
                                        {
                                            $cf_to_perspiration_acid_staining_value_for_polyester = '4-5';
                                        }
                                        elseif($cf_to_perspiration_acid_staining_polyester ==5.0)
                                        {
                                            $cf_to_perspiration_acid_staining_value_for_polyester = '5';
                                        } 
                                        // acrylic
                                        $cf_to_perspiration_acid_staining_acrylic = $row_for_qc['cf_to_perspiration_acid_staining_value_for_acrylic'];
                                        
                                        if($cf_to_perspiration_acid_staining_acrylic ==1.0)
                                        {
                                            $cf_to_perspiration_acid_staining_value_for_acrylic = '1';
                                        }
                                        elseif($cf_to_perspiration_acid_staining_acrylic ==1.5)
                                        {
                                            $cf_to_perspiration_acid_staining_value_for_acrylic = '1-2';
                                        }
                                        elseif($cf_to_perspiration_acid_staining_acrylic ==2.0)
                                        {
                                            $cf_to_perspiration_acid_staining_value_for_acrylic = '2';
                                        }
                                        elseif($cf_to_perspiration_acid_staining_acrylic ==2.5)
                                        {
                                            $cf_to_perspiration_acid_staining_value_for_acrylic = '2-3';
                                        }
                                        elseif($cf_to_perspiration_acid_staining_acrylic ==3.0)
                                        {
                                            $cf_to_perspiration_acid_staining_value_for_acrylic = '3';
                                        }
                                        elseif($cf_to_perspiration_acid_staining_acrylic ==3.5)
                                        {
                                            $cf_to_perspiration_acid_staining_value_for_acrylic = '3-4';
                                        }
                                        elseif($cf_to_perspiration_acid_staining_acrylic ==4.0)
                                        {
                                            $cf_to_perspiration_acid_staining_value_for_acrylic = '4';
                                        }
                                        elseif($cf_to_perspiration_acid_staining_acrylic ==4.5)
                                        {
                                            $cf_to_perspiration_acid_staining_value_for_acrylic = '4-5';
                                        }
                                        elseif($cf_to_perspiration_acid_staining_acrylic ==5.0)
                                        {
                                            $cf_to_perspiration_acid_staining_value_for_acrylic = '5';
                                        } 
                                            // wool
                                        $cf_to_perspiration_acid_staining_wool = $row_for_qc['cf_to_perspiration_acid_staining_value_for_wool'];
                                        
                                        if($cf_to_perspiration_acid_staining_wool ==1.0)
                                        {
                                            $cf_to_perspiration_acid_staining_value_for_wool = '1';
                                        }
                                        elseif($cf_to_perspiration_acid_staining_wool ==1.5)
                                        {
                                            $cf_to_perspiration_acid_staining_value_for_wool = '1-2';
                                        }
                                        elseif($cf_to_perspiration_acid_staining_wool ==2.0)
                                        {
                                            $cf_to_perspiration_acid_staining_value_for_wool = '2';
                                        }
                                        elseif($cf_to_perspiration_acid_staining_wool ==2.5)
                                        {
                                            $cf_to_perspiration_acid_staining_value_for_wool = '2-3';
                                        }
                                        elseif($cf_to_perspiration_acid_staining_wool ==3.0)
                                        {
                                            $cf_to_perspiration_acid_staining_value_for_wool = '3';
                                        }
                                        elseif($cf_to_perspiration_acid_staining_wool ==3.5)
                                        {
                                            $cf_to_perspiration_acid_staining_value_for_wool = '3-4';
                                        }
                                        elseif($cf_to_perspiration_acid_staining_wool ==4.0)
                                        {
                                            $cf_to_perspiration_acid_staining_value_for_wool = '4';
                                        }
                                        elseif($cf_to_perspiration_acid_staining_wool ==4.5)
                                        {
                                            $cf_to_perspiration_acid_staining_value_for_wool = '4-5';
                                        }
                                        elseif($cf_to_perspiration_acid_staining_wool ==5.0)
                                        {
                                            $cf_to_perspiration_acid_staining_value_for_wool = '5';
                                        } 
                                        // for test result        
                                    }

                                    $form.="
                                    <div class='form-group from-group-sm row'>
                                    <div class='col-sm-1'><b style='font-size: 20px;' >".$serial.".</b></div>
                                    <div class='col-sm-11' id='form-group_for_test_report_of_ikea'>
                                        <div class='col-sm-10'>
                                                    <table class='table table-bordered'>
                                                        <thead>
                                                        <tr>
                                                            <label class='col-sm-12' for='name' style='font-size: 20px;'>".$row['test_name_method'].": </label>
                                                        </tr>
                                                        <tr>
                                                            <th class='text-center' colspan='7'>Result</th>
                                                            <th class='text-center' colspan='2'>Requirements</th>                                   
                                                        </tr>
                                                        <tr>
                                                            <th class='text-center' rowspan='2'>Color Change</th>
                                                            <th class='text-center' colspan='6'>Staining on to mulifiber</th>
                                                            <th class='text-center' rowspan='2'>Color Change</th>
                                                            <th class='text-center' rowspan='2'>Staining</th>
                                                        </tr>
                                                        <tr>
                                                            
                                                            <th class='text-center'>Acetate</th>
                                                            <th class='text-center'>Cotton</th>
                                                            <th class='text-center'>Mylon</th>
                                                            <th class='text-center'>Polyester</th>
                                                            <th class='text-center'>Acrylic</th>
                                                            <th class='text-center'>Wool</th>
                                                            

                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td class='text-center'>".$cf_to_perspiration_acid_color_change_value."</td>
                                                                <td class='text-center'>".$cf_to_perspiration_acid_staining_value_for_acetate."</td>
                                                                <td class='text-center'>".$cf_to_perspiration_acid_staining_value_for_cotton."</td>
                                                                <td class='text-center'>".$cf_to_perspiration_acid_staining_value_for_mylon."</td>
                                                                <td class='text-center'>".$cf_to_perspiration_acid_staining_value_for_polyester."</td>
                                                                <td class='text-center'>".$cf_to_perspiration_acid_staining_value_for_acrylic."</td>
                                                                <td class='text-center'>".$cf_to_perspiration_acid_staining_value_for_wool."</td>
                                                                <td class='text-center'>".$row_for_defining_process['cf_to_perspiration_acid_color_change_tolerance_range_math_op'].''.$cf_to_perspiration_acid_color_change_tolerance_value."</td>
                                                                <td class='text-center'>".$row_for_defining_process['cf_to_perspiration_acid_staining_tolerance_range_math_operator'].''.$cf_to_perspiration_acid_staining_value."</td>
                                                            </tr>

                                                        
                                                        
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>";
                                }
                                echo $form;
                                $form = "";

                            } /* ENd of if (in_array($row['id'], ['17']))*/
                            

                            if (in_array($row['id'], ['18'])) 
                            {
                                    
                                if($row_for_defining_process['cf_to_perspiration_alkali_color_change_max_value']<>0 && $row_for_qc['cf_to_perspiration_alkali_color_change_value']<>0)
                                {
                                    $serial+=1;

                                    if($customer_type == 'american')
                                    {
                                        $cf_to_perspiration_alkali_color_change_tolerance_value = $row_for_defining_process['cf_to_perspiration_alkali_color_change_tolerance_value'];
                                        $cf_to_perspiration_alkali_staining_tolerance_value = $row_for_defining_process['cf_to_perspiration_alkali_staining_tolerance_value'];
                                        $cf_to_perspiration_alkali_color_change_value = $row_for_qc['cf_to_perspiration_alkali_color_change_value'];
                                        $cf_to_perspiration_alkali_staining_value_for_acetate = $row_for_qc['cf_to_perspiration_alkali_staining_value_for_acetate'];
                                        $cf_to_perspiration_alkali_staining_value_for_cotton = $row_for_qc['cf_to_perspiration_alkali_staining_value_for_cotton'];
                                        $cf_to_perspiration_alkali_staining_value_for_mylon = $row_for_qc['cf_to_perspiration_alkali_staining_value_for_mylon'];
                                        $cf_to_perspiration_alkali_staining_value_for_polyester = $row_for_qc['cf_to_perspiration_alkali_staining_value_for_polyester'];
                                        $cf_to_perspiration_alkali_staining_value_for_acrylic = $row_for_qc['cf_to_perspiration_alkali_staining_value_for_acrylic'];
                                        $cf_to_perspiration_alkali_staining_value_for_wool = $row_for_qc['cf_to_perspiration_alkali_staining_value_for_wool'];

                                    }
                                    if($customer_type == 'european')
                                    {
                                        // defining for color change
                                        $cf_to_perspiration_alkali_color_change_tolerance = $row_for_defining_process['cf_to_perspiration_alkali_color_change_tolerance_value'];
                                
                                        if($cf_to_perspiration_alkali_color_change_tolerance ==1.0)
                                        {
                                            $cf_to_perspiration_alkali_color_change_tolerance_value = '1';
                                        }
                                        elseif($cf_to_perspiration_alkali_color_change_tolerance ==1.5)
                                        {
                                            $cf_to_perspiration_alkali_color_change_tolerance_value = '1-2';
                                        }
                                        elseif($cf_to_perspiration_alkali_color_change_tolerance ==2.0)
                                        {
                                            $cf_to_perspiration_alkali_color_change_tolerance_value = '2';
                                        }
                                        elseif($cf_to_perspiration_alkali_color_change_tolerance ==2.5)
                                        {
                                            $cf_to_perspiration_alkali_color_change_tolerance_value = '2-3';
                                        }
                                        elseif($cf_to_perspiration_alkali_color_change_tolerance ==3.0)
                                        {
                                            $cf_to_perspiration_alkali_color_change_tolerance_value = '3';
                                        }
                                        elseif($cf_to_perspiration_alkali_color_change_tolerance ==3.5)
                                        {
                                            $cf_to_perspiration_alkali_color_change_tolerance_value = '3-4';
                                        }
                                        elseif($cf_to_perspiration_alkali_color_change_tolerance ==4.0)
                                        {
                                            $cf_to_perspiration_alkali_color_change_tolerance_value = '4';
                                        }
                                        elseif($cf_to_perspiration_alkali_color_change_tolerance ==4.5)
                                        {
                                            $cf_to_perspiration_alkali_color_change_tolerance_value = '4-5';
                                        }
                                        elseif($cf_to_perspiration_alkali_color_change_tolerance ==5.0)
                                        {
                                            $cf_to_perspiration_alkali_color_change_tolerance_value = '5';
                                        }  			
                                        // defining for staining
                                        $cf_to_perspiration_alkali_staining_tolerance = $row_for_defining_process['cf_to_perspiration_alkali_staining_tolerance_value'];
                                
                                        if($cf_to_perspiration_alkali_staining_tolerance ==1.0)
                                        {
                                            $cf_to_perspiration_alkali_staining_tolerance_value = '1';
                                        }
                                        elseif($cf_to_perspiration_alkali_staining_tolerance ==1.5)
                                        {
                                            $cf_to_perspiration_alkali_staining_tolerance_value = '1-2';
                                        }
                                        elseif($cf_to_perspiration_alkali_staining_tolerance ==2.0)
                                        {
                                            $cf_to_perspiration_alkali_staining_tolerance_value = '2';
                                        }
                                        elseif($cf_to_perspiration_alkali_staining_tolerance ==2.5)
                                        {
                                            $cf_to_perspiration_alkali_staining_tolerance_value = '2-3';
                                        }
                                        elseif($cf_to_perspiration_alkali_staining_tolerance ==3.0)
                                        {
                                            $cf_to_perspiration_alkali_staining_tolerance_value = '3';
                                        }
                                        elseif($cf_to_perspiration_alkali_staining_tolerance ==3.5)
                                        {
                                            $cf_to_perspiration_alkali_staining_tolerance_value = '3-4';
                                        }
                                        elseif($cf_to_perspiration_alkali_staining_tolerance ==4.0)
                                        {
                                            $cf_to_perspiration_alkali_staining_tolerance_value = '4';
                                        }
                                        elseif($cf_to_perspiration_alkali_staining_tolerance ==4.5)
                                        {
                                            $cf_to_perspiration_alkali_staining_tolerance_value = '4-5';
                                        }
                                        elseif($cf_to_perspiration_alkali_staining_tolerance ==5.0)
                                        {
                                            $cf_to_perspiration_alkali_staining_tolerance_value = '5';
                                        }
                                        

                                        // color change for qc
                                        $cf_to_perspiration_alkali_color_change = $row_for_qc['cf_to_perspiration_alkali_color_change_value'];
                                
                                        if($cf_to_perspiration_alkali_color_change ==1.0)
                                        {
                                            $cf_to_perspiration_alkali_color_change_value = '1';
                                        }
                                        elseif($cf_to_perspiration_alkali_color_change ==1.5)
                                        {
                                            $cf_to_perspiration_alkali_color_change_value = '1-2';
                                        }
                                        elseif($cf_to_perspiration_alkali_color_change ==2.0)
                                        {
                                            $cf_to_perspiration_alkali_color_change_value = '2';
                                        }
                                        elseif($cf_to_perspiration_alkali_color_change ==2.5)
                                        {
                                            $cf_to_perspiration_alkali_color_change_value = '2-3';
                                        }
                                        elseif($cf_to_perspiration_alkali_color_change ==3.0)
                                        {
                                            $cf_to_perspiration_alkali_color_change_value = '3';
                                        }
                                        elseif($cf_to_perspiration_alkali_color_change ==3.5)
                                        {
                                            $cf_to_perspiration_alkali_color_change_value = '3-4';
                                        }
                                        elseif($cf_to_perspiration_alkali_color_change ==4.0)
                                        {
                                            $cf_to_perspiration_alkali_color_change_value = '4';
                                        }
                                        elseif($cf_to_perspiration_alkali_color_change ==4.5)
                                        {
                                            $cf_to_perspiration_alkali_color_change_value = '4-5';
                                        }
                                        elseif($cf_to_perspiration_alkali_color_change ==5.0)
                                        {
                                            $cf_to_perspiration_alkali_color_change_value = '5';
                                        }
                                            // acetate
                                        $cf_to_perspiration_alkali_staining_acetate = $row_for_qc['cf_to_perspiration_alkali_staining_value_for_acetate'];
                                        
                                        if($cf_to_perspiration_alkali_staining_acetate ==1.0)
                                        {
                                            $cf_to_perspiration_alkali_staining_value_for_acetate = '1';
                                        }
                                        elseif($cf_to_perspiration_alkali_staining_acetate ==1.5)
                                        {
                                            $cf_to_perspiration_alkali_staining_value_for_acetate = '1-2';
                                        }
                                        elseif($cf_to_perspiration_alkali_staining_acetate ==2.0)
                                        {
                                            $cf_to_perspiration_alkali_staining_value_for_acetate = '2';
                                        }
                                        elseif($cf_to_perspiration_alkali_staining_acetate ==2.5)
                                        {
                                            $cf_to_perspiration_alkali_staining_value_for_acetate = '2-3';
                                        }
                                        elseif($cf_to_perspiration_alkali_staining_acetate ==3.0)
                                        {
                                            $cf_to_perspiration_alkali_staining_value_for_acetate = '3';
                                        }
                                        elseif($cf_to_perspiration_alkali_staining_acetate ==3.5)
                                        {
                                            $cf_to_perspiration_alkali_staining_value_for_acetate = '3-4';
                                        }
                                        elseif($cf_to_perspiration_alkali_staining_acetate ==4.0)
                                        {
                                            $cf_to_perspiration_alkali_staining_value_for_acetate = '4';
                                        }
                                        elseif($cf_to_perspiration_alkali_staining_acetate ==4.5)
                                        {
                                            $cf_to_perspiration_alkali_staining_value_for_acetate = '4-5';
                                        }
                                        elseif($cf_to_perspiration_alkali_staining_acetate ==5.0)
                                        {
                                            $cf_to_perspiration_alkali_staining_value_for_acetate = '5';
                                        } 
                                        // cotton
                                        $cf_to_perspiration_alkali_staining_cotton = $row_for_qc['cf_to_perspiration_alkali_staining_value_for_cotton'];
                                        
                                        if($cf_to_perspiration_alkali_staining_cotton ==1.0)
                                        {
                                            $cf_to_perspiration_alkali_staining_value_for_cotton = '1';
                                        }
                                        elseif($cf_to_perspiration_alkali_staining_cotton ==1.5)
                                        {
                                            $cf_to_perspiration_alkali_staining_value_for_cotton = '1-2';
                                        }
                                        elseif($cf_to_perspiration_alkali_staining_cotton ==2.0)
                                        {
                                            $cf_to_perspiration_alkali_staining_value_for_cotton = '2';
                                        }
                                        elseif($cf_to_perspiration_alkali_staining_cotton ==2.5)
                                        {
                                            $cf_to_perspiration_alkali_staining_value_for_cotton = '2-3';
                                        }
                                        elseif($cf_to_perspiration_alkali_staining_cotton ==3.0)
                                        {
                                            $cf_to_perspiration_alkali_staining_value_for_cotton = '3';
                                        }
                                        elseif($cf_to_perspiration_alkali_staining_cotton ==3.5)
                                        {
                                            $cf_to_perspiration_alkali_staining_value_for_cotton = '3-4';
                                        }
                                        elseif($cf_to_perspiration_alkali_staining_cotton ==4.0)
                                        {
                                            $cf_to_perspiration_alkali_staining_value_for_cotton = '4';
                                        }
                                        elseif($cf_to_perspiration_alkali_staining_cotton ==4.5)
                                        {
                                            $cf_to_perspiration_alkali_staining_value_for_cotton = '4-5';
                                        }
                                        elseif($cf_to_perspiration_alkali_staining_cotton ==5.0)
                                        {
                                            $cf_to_perspiration_alkali_staining_value_for_cotton = '5';
                                        } 
                                            // nylon
                                        $cf_to_perspiration_alkali_staining_mylon = $row_for_qc['cf_to_perspiration_alkali_staining_value_for_mylon'];
                                        
                                        if($cf_to_perspiration_alkali_staining_mylon ==1.0)
                                        {
                                            $cf_to_perspiration_alkali_staining_value_for_mylon = '1';
                                        }
                                        elseif($cf_to_perspiration_alkali_staining_mylon ==1.5)
                                        {
                                            $cf_to_perspiration_alkali_staining_value_for_mylon = '1-2';
                                        }
                                        elseif($cf_to_perspiration_alkali_staining_mylon ==2.0)
                                        {
                                            $cf_to_perspiration_alkali_staining_value_for_mylon = '2';
                                        }
                                        elseif($cf_to_perspiration_alkali_staining_mylon ==2.5)
                                        {
                                            $cf_to_perspiration_alkali_staining_value_for_mylon = '2-3';
                                        }
                                        elseif($cf_to_perspiration_alkali_staining_mylon ==3.0)
                                        {
                                            $cf_to_perspiration_alkali_staining_value_for_mylon = '3';
                                        }
                                        elseif($cf_to_perspiration_alkali_staining_mylon ==3.5)
                                        {
                                            $cf_to_perspiration_alkali_staining_value_for_mylon = '3-4';
                                        }
                                        elseif($cf_to_perspiration_alkali_staining_mylon ==4.0)
                                        {
                                            $cf_to_perspiration_alkali_staining_value_for_mylon = '4';
                                        }
                                        elseif($cf_to_perspiration_alkali_staining_mylon ==4.5)
                                        {
                                            $cf_to_perspiration_alkali_staining_value_for_mylon = '4-5';
                                        }
                                        elseif($cf_to_perspiration_alkali_staining_mylon ==5.0)
                                        {
                                            $cf_to_perspiration_alkali_staining_value_for_mylon = '5';
                                        } 
                                        // polyester
                                        $cf_to_perspiration_alkali_staining_polyester = $row_for_qc['cf_to_perspiration_alkali_staining_value_for_polyester'];
                                        
                                        if($cf_to_perspiration_alkali_staining_polyester ==1.0)
                                        {
                                            $cf_to_perspiration_alkali_staining_value_for_polyester = '1';
                                        }
                                        elseif($cf_to_perspiration_alkali_staining_polyester ==1.5)
                                        {
                                            $cf_to_perspiration_alkali_staining_value_for_polyester = '1-2';
                                        }
                                        elseif($cf_to_perspiration_alkali_staining_polyester ==2.0)
                                        {
                                            $cf_to_perspiration_alkali_staining_value_for_polyester = '2';
                                        }
                                        elseif($cf_to_perspiration_alkali_staining_polyester ==2.5)
                                        {
                                            $cf_to_perspiration_alkali_staining_value_for_polyester = '2-3';
                                        }
                                        elseif($cf_to_perspiration_alkali_staining_polyester ==3.0)
                                        {
                                            $cf_to_perspiration_alkali_staining_value_for_polyester = '3';
                                        }
                                        elseif($cf_to_perspiration_alkali_staining_polyester ==3.5)
                                        {
                                            $cf_to_perspiration_alkali_staining_value_for_polyester = '3-4';
                                        }
                                        elseif($cf_to_perspiration_alkali_staining_polyester ==4.0)
                                        {
                                            $cf_to_perspiration_alkali_staining_value_for_polyester = '4';
                                        }
                                        elseif($cf_to_perspiration_alkali_staining_polyester ==4.5)
                                        {
                                            $cf_to_perspiration_alkali_staining_value_for_polyester = '4-5';
                                        }
                                        elseif($cf_to_perspiration_alkali_staining_polyester ==5.0)
                                        {
                                            $cf_to_perspiration_alkali_staining_value_for_polyester = '5';
                                        } 
                                        // acrylic
                                        $cf_to_perspiration_alkali_staining_acrylic = $row_for_qc['cf_to_perspiration_alkali_staining_value_for_acrylic'];
                                        
                                        if($cf_to_perspiration_alkali_staining_acrylic ==1.0)
                                        {
                                            $cf_to_perspiration_alkali_staining_value_for_acrylic = '1';
                                        }
                                        elseif($cf_to_perspiration_alkali_staining_acrylic ==1.5)
                                        {
                                            $cf_to_perspiration_alkali_staining_value_for_acrylic = '1-2';
                                        }
                                        elseif($cf_to_perspiration_alkali_staining_acrylic ==2.0)
                                        {
                                            $cf_to_perspiration_alkali_staining_value_for_acrylic = '2';
                                        }
                                        elseif($cf_to_perspiration_alkali_staining_acrylic ==2.5)
                                        {
                                            $cf_to_perspiration_alkali_staining_value_for_acrylic = '2-3';
                                        }
                                        elseif($cf_to_perspiration_alkali_staining_acrylic ==3.0)
                                        {
                                            $cf_to_perspiration_alkali_staining_value_for_acrylic = '3';
                                        }
                                        elseif($cf_to_perspiration_alkali_staining_acrylic ==3.5)
                                        {
                                            $cf_to_perspiration_alkali_staining_value_for_acrylic = '3-4';
                                        }
                                        elseif($cf_to_perspiration_alkali_staining_acrylic ==4.0)
                                        {
                                            $cf_to_perspiration_alkali_staining_value_for_acrylic = '4';
                                        }
                                        elseif($cf_to_perspiration_alkali_staining_acrylic ==4.5)
                                        {
                                            $cf_to_perspiration_alkali_staining_value_for_acrylic = '4-5';
                                        }
                                        elseif($cf_to_perspiration_alkali_staining_acrylic ==5.0)
                                        {
                                            $cf_to_perspiration_alkali_staining_value_for_acrylic = '5';
                                        } 
                                            // wool
                                        $cf_to_perspiration_alkali_staining_wool = $row_for_qc['cf_to_perspiration_alkali_staining_value_for_wool'];
                                        
                                        if($cf_to_perspiration_alkali_staining_wool ==1.0)
                                        {
                                            $cf_to_perspiration_alkali_staining_value_for_wool = '1';
                                        }
                                        elseif($cf_to_perspiration_alkali_staining_wool ==1.5)
                                        {
                                            $cf_to_perspiration_alkali_staining_value_for_wool = '1-2';
                                        }
                                        elseif($cf_to_perspiration_alkali_staining_wool ==2.0)
                                        {
                                            $cf_to_perspiration_alkali_staining_value_for_wool = '2';
                                        }
                                        elseif($cf_to_perspiration_alkali_staining_wool ==2.5)
                                        {
                                            $cf_to_perspiration_alkali_staining_value_for_wool = '2-3';
                                        }
                                        elseif($cf_to_perspiration_alkali_staining_wool ==3.0)
                                        {
                                            $cf_to_perspiration_alkali_staining_value_for_wool = '3';
                                        }
                                        elseif($cf_to_perspiration_alkali_staining_wool ==3.5)
                                        {
                                            $cf_to_perspiration_alkali_staining_value_for_wool = '3-4';
                                        }
                                        elseif($cf_to_perspiration_alkali_staining_wool ==4.0)
                                        {
                                            $cf_to_perspiration_alkali_staining_value_for_wool = '4';
                                        }
                                        elseif($cf_to_perspiration_alkali_staining_wool ==4.5)
                                        {
                                            $cf_to_perspiration_alkali_staining_value_for_wool = '4-5';
                                        }
                                        elseif($cf_to_perspiration_alkali_staining_wool ==5.0)
                                        {
                                            $cf_to_perspiration_alkali_staining_value_for_wool = '5';
                                        } 
                                        // for test result
                                    }

                                    $form.="
                                    <div class='form-group from-group-sm row'>
                                    <div class='col-sm-1'><b style='font-size: 20px;' >".$serial.".</b></div>
                                    <div class='col-sm-11' id='form-group_for_test_report_of_ikea'>
                                        <div class='col-sm-10'>
                                                    <table class='table table-bordered'>
                                                        <thead>
                                                        <tr>
                                                            <label class='col-sm-12' for='name' style='font-size: 20px;' >  ".$row['test_name_method'].": </label>
                                                        </tr>
                                                        <tr>
                                                            <th class='text-center' colspan='7'>Result</th>
                                                            <th class='text-center' colspan='2'>Requirements</th>                                   
                                                        </tr>
                                                        <tr>
                                                            <th class='text-center' rowspan='2'>Color Change</th>
                                                            <th class='text-center' colspan='6'>Staining on to mulifiber</th>
                                                            <th class='text-center' rowspan='2'>Color Change</th>
                                                            <th class='text-center' rowspan='2'>Staining</th>
                                                        </tr>
                                                        <tr>
                                                            
                                                            <th class='text-center'>Acetate</th>
                                                            <th class='text-center'>Cotton</th>
                                                            <th class='text-center'>Mylon</th>
                                                            <th class='text-center'>Polyester</th>
                                                            <th class='text-center'>Acrylic</th>
                                                            <th class='text-center'>Wool</th>
                                                            

                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td class='text-center'>".$cf_to_perspiration_alkali_color_change_value."</td>
                                                                <td class='text-center'>".$cf_to_perspiration_alkali_staining_value_for_acetate."</td>
                                                                <td class='text-center'>".$cf_to_perspiration_alkali_staining_value_for_cotton."</td>
                                                                <td class='text-center'>".$cf_to_perspiration_alkali_staining_value_for_mylon."</td>
                                                                <td class='text-center'>".$cf_to_perspiration_alkali_staining_value_for_polyester."</td>
                                                                <td class='text-center'>".$cf_to_perspiration_alkali_staining_value_for_acrylic."</td>
                                                                <td class='text-center'>".$cf_to_perspiration_alkali_staining_value_for_wool."</td>
                                                                <td class='text-center'>".$row_for_defining_process['cf_to_perspiration_alkali_color_change_tolerance_range_math_op'].$cf_to_perspiration_alkali_color_change_tolerance_value."</td>
                                                                <td class='text-center'>".$row_for_defining_process['cf_to_perspiration_alkali_staining_tolerance_range_math_op'].$cf_to_perspiration_alkali_staining_tolerance_value."</td>
                                                            </tr>

                                                        
                                                        
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>";
                                }
                                echo $form;
                                $form = "";
                            } /* ENd of if (in_array($row['id'], ['18']))*/

                            if (in_array($row['id'], ['19']))
                            { 
                                
                                if($row_for_defining_process['cf_to_water_color_change_max_value']<>0 && $row_for_qc['cf_to_water_color_change_value']<>0)
                                {
                                    $serial+=1;

                                    if($customer_type == 'american')
                                    {
                                        $cf_to_water_color_change_tolerance_value = $row_for_defining_process['cf_to_water_color_change_tolerance_value'];
                                        $cf_to_water_staining_tolerance_value = $row_for_defining_process['cf_to_water_staining_tolerance_value'];
                                        $cf_to_water_color_change_value = $row_for_qc['cf_to_water_color_change_value'];
                                        $cf_to_water_staining_value_for_acetate = $row_for_qc['cf_to_water_staining_value_for_acetate'];
                                        $cf_to_water_staining_value_for_cotton = $row_for_qc['cf_to_water_staining_value_for_cotton'];
                                        $cf_to_water_staining_value_for_mylon = $row_for_qc['cf_to_water_staining_value_for_mylon'];
                                        $cf_to_water_staining_value_for_polyester = $row_for_qc['cf_to_water_staining_value_for_polyester'];
                                        $cf_to_water_staining_value_for_acrylic = $row_for_qc['cf_to_water_staining_value_for_acrylic'];
                                        $cf_to_water_staining_value_for_wool = $row_for_qc['cf_to_water_staining_value_for_wool'];

                                    }
                                    if($customer_type == 'european')
                                    {
                                        // defining for color change
                                        $cf_to_water_color_change_tolerance = $row_for_defining_process['cf_to_water_color_change_tolerance_value'];
                                
                                        if($cf_to_water_color_change_tolerance ==1.0)
                                        {
                                            $cf_to_water_color_change_tolerance_value = '1';
                                        }
                                        elseif($cf_to_water_color_change_tolerance ==1.5)
                                        {
                                            $cf_to_water_color_change_tolerance_value = '1-2';
                                        }
                                        elseif($cf_to_water_color_change_tolerance ==2.0)
                                        {
                                            $cf_to_water_color_change_tolerance_value = '2';
                                        }
                                        elseif($cf_to_water_color_change_tolerance ==2.5)
                                        {
                                            $cf_to_water_color_change_tolerance_value = '2-3';
                                        }
                                        elseif($cf_to_water_color_change_tolerance ==3.0)
                                        {
                                            $cf_to_water_color_change_tolerance_value = '3';
                                        }
                                        elseif($cf_to_water_color_change_tolerance ==3.5)
                                        {
                                            $cf_to_water_color_change_tolerance_value = '3-4';
                                        }
                                        elseif($cf_to_water_color_change_tolerance ==4.0)
                                        {
                                            $cf_to_water_color_change_tolerance_value = '4';
                                        }
                                        elseif($cf_to_water_color_change_tolerance ==4.5)
                                        {
                                            $cf_to_water_color_change_tolerance_value = '4-5';
                                        }
                                        elseif($cf_to_water_color_change_tolerance ==5.0)
                                        {
                                            $cf_to_water_color_change_tolerance_value = '5';
                                        }  			
                                        // defining for staining
                                        $cf_to_water_staining_tolerance = $row_for_defining_process['cf_to_water_staining_tolerance_value'];
                                
                                        if($cf_to_water_staining_tolerance ==1.0)
                                        {
                                            $cf_to_water_staining_tolerance_value = '1';
                                        }
                                        elseif($cf_to_water_staining_tolerance ==1.5)
                                        {
                                            $cf_to_water_staining_tolerance_value = '1-2';
                                        }
                                        elseif($cf_to_water_staining_tolerance ==2.0)
                                        {
                                            $cf_to_water_staining_tolerance_value = '2';
                                        }
                                        elseif($cf_to_water_staining_tolerance ==2.5)
                                        {
                                            $cf_to_water_staining_tolerance_value = '2-3';
                                        }
                                        elseif($cf_to_water_staining_tolerance ==3.0)
                                        {
                                            $cf_to_water_staining_tolerance_value = '3';
                                        }
                                        elseif($cf_to_water_staining_tolerance ==3.5)
                                        {
                                            $cf_to_water_staining_tolerance_value = '3-4';
                                        }
                                        elseif($cf_to_water_staining_tolerance ==4.0)
                                        {
                                            $cf_to_water_staining_tolerance_value = '4';
                                        }
                                        elseif($cf_to_water_staining_tolerance ==4.5)
                                        {
                                            $cf_to_water_staining_tolerance_value = '4-5';
                                        }
                                        elseif($cf_to_water_staining_tolerance ==5.0)
                                        {
                                            $cf_to_water_staining_tolerance_value = '5';
                                        }
                                        

                                        // color change for qc
                                        $cf_to_water_color_change = $row_for_qc['cf_to_water_color_change_value'];
                                
                                        if($cf_to_water_color_change ==1.0)
                                        {
                                            $cf_to_water_color_change_value = '1';
                                        }
                                        elseif($cf_to_water_color_change ==1.5)
                                        {
                                            $cf_to_water_color_change_value = '1-2';
                                        }
                                        elseif($cf_to_water_color_change ==2.0)
                                        {
                                            $cf_to_water_color_change_value = '2';
                                        }
                                        elseif($cf_to_water_color_change ==2.5)
                                        {
                                            $cf_to_water_color_change_value = '2-3';
                                        }
                                        elseif($cf_to_water_color_change ==3.0)
                                        {
                                            $cf_to_water_color_change_value = '3';
                                        }
                                        elseif($cf_to_water_color_change ==3.5)
                                        {
                                            $cf_to_water_color_change_value = '3-4';
                                        }
                                        elseif($cf_to_water_color_change ==4.0)
                                        {
                                            $cf_to_water_color_change_value = '4';
                                        }
                                        elseif($cf_to_water_color_change ==4.5)
                                        {
                                            $cf_to_water_color_change_value = '4-5';
                                        }
                                        elseif($cf_to_water_color_change ==5.0)
                                        {
                                            $cf_to_water_color_change_value = '5';
                                        }
                                            // acetate
                                        $cf_to_water_staining_acetate = $row_for_qc['cf_to_water_staining_value_for_acetate'];
                                        
                                        if($cf_to_water_staining_acetate ==1.0)
                                        {
                                            $cf_to_water_staining_value_for_acetate = '1';
                                        }
                                        elseif($cf_to_water_staining_acetate ==1.5)
                                        {
                                            $cf_to_water_staining_value_for_acetate = '1-2';
                                        }
                                        elseif($cf_to_water_staining_acetate ==2.0)
                                        {
                                            $cf_to_water_staining_value_for_acetate = '2';
                                        }
                                        elseif($cf_to_water_staining_acetate ==2.5)
                                        {
                                            $cf_to_water_staining_value_for_acetate = '2-3';
                                        }
                                        elseif($cf_to_water_staining_acetate ==3.0)
                                        {
                                            $cf_to_water_staining_value_for_acetate = '3';
                                        }
                                        elseif($cf_to_water_staining_acetate ==3.5)
                                        {
                                            $cf_to_water_staining_value_for_acetate = '3-4';
                                        }
                                        elseif($cf_to_water_staining_acetate ==4.0)
                                        {
                                            $cf_to_water_staining_value_for_acetate = '4';
                                        }
                                        elseif($cf_to_water_staining_acetate ==4.5)
                                        {
                                            $cf_to_water_staining_value_for_acetate = '4-5';
                                        }
                                        elseif($cf_to_water_staining_acetate ==5.0)
                                        {
                                            $cf_to_water_staining_value_for_acetate = '5';
                                        } 
                                        // cotton
                                        $cf_to_water_staining_cotton = $row_for_qc['cf_to_water_staining_value_for_cotton'];
                                        
                                        if($cf_to_water_staining_cotton ==1.0)
                                        {
                                            $cf_to_water_staining_value_for_cotton = '1';
                                        }
                                        elseif($cf_to_water_staining_cotton ==1.5)
                                        {
                                            $cf_to_water_staining_value_for_cotton = '1-2';
                                        }
                                        elseif($cf_to_water_staining_cotton ==2.0)
                                        {
                                            $cf_to_water_staining_value_for_cotton = '2';
                                        }
                                        elseif($cf_to_water_staining_cotton ==2.5)
                                        {
                                            $cf_to_water_staining_value_for_cotton = '2-3';
                                        }
                                        elseif($cf_to_water_staining_cotton ==3.0)
                                        {
                                            $cf_to_water_staining_value_for_cotton = '3';
                                        }
                                        elseif($cf_to_water_staining_cotton ==3.5)
                                        {
                                            $cf_to_water_staining_value_for_cotton = '3-4';
                                        }
                                        elseif($cf_to_water_staining_cotton ==4.0)
                                        {
                                            $cf_to_water_staining_value_for_cotton = '4';
                                        }
                                        elseif($cf_to_water_staining_cotton ==4.5)
                                        {
                                            $cf_to_water_staining_value_for_cotton = '4-5';
                                        }
                                        elseif($cf_to_water_staining_cotton ==5.0)
                                        {
                                            $cf_to_water_staining_value_for_cotton = '5';
                                        } 
                                            // nylon
                                        $cf_to_water_staining_mylon = $row_for_qc['cf_to_water_staining_value_for_mylon'];
                                        
                                        if($cf_to_water_staining_mylon ==1.0)
                                        {
                                            $cf_to_water_staining_value_for_mylon = '1';
                                        }
                                        elseif($cf_to_water_staining_mylon ==1.5)
                                        {
                                            $cf_to_water_staining_value_for_mylon = '1-2';
                                        }
                                        elseif($cf_to_water_staining_mylon ==2.0)
                                        {
                                            $cf_to_water_staining_value_for_mylon = '2';
                                        }
                                        elseif($cf_to_water_staining_mylon ==2.5)
                                        {
                                            $cf_to_water_staining_value_for_mylon = '2-3';
                                        }
                                        elseif($cf_to_water_staining_mylon ==3.0)
                                        {
                                            $cf_to_water_staining_value_for_mylon = '3';
                                        }
                                        elseif($cf_to_water_staining_mylon ==3.5)
                                        {
                                            $cf_to_water_staining_value_for_mylon = '3-4';
                                        }
                                        elseif($cf_to_water_staining_mylon ==4.0)
                                        {
                                            $cf_to_water_staining_value_for_mylon = '4';
                                        }
                                        elseif($cf_to_water_staining_mylon ==4.5)
                                        {
                                            $cf_to_water_staining_value_for_mylon = '4-5';
                                        }
                                        elseif($cf_to_water_staining_mylon ==5.0)
                                        {
                                            $cf_to_water_staining_value_for_mylon = '5';
                                        } 
                                        // polyester
                                        $cf_to_water_staining_polyester = $row_for_qc['cf_to_water_staining_value_for_polyester'];
                                        
                                        if($cf_to_water_staining_polyester ==1.0)
                                        {
                                            $cf_to_water_staining_value_for_polyester = '1';
                                        }
                                        elseif($cf_to_water_staining_polyester ==1.5)
                                        {
                                            $cf_to_water_staining_value_for_polyester = '1-2';
                                        }
                                        elseif($cf_to_water_staining_polyester ==2.0)
                                        {
                                            $cf_to_water_staining_value_for_polyester = '2';
                                        }
                                        elseif($cf_to_water_staining_polyester ==2.5)
                                        {
                                            $cf_to_water_staining_value_for_polyester = '2-3';
                                        }
                                        elseif($cf_to_water_staining_polyester ==3.0)
                                        {
                                            $cf_to_water_staining_value_for_polyester = '3';
                                        }
                                        elseif($cf_to_water_staining_polyester ==3.5)
                                        {
                                            $cf_to_water_staining_value_for_polyester = '3-4';
                                        }
                                        elseif($cf_to_water_staining_polyester ==4.0)
                                        {
                                            $cf_to_water_staining_value_for_polyester = '4';
                                        }
                                        elseif($cf_to_water_staining_polyester ==4.5)
                                        {
                                            $cf_to_water_staining_value_for_polyester = '4-5';
                                        }
                                        elseif($cf_to_water_staining_polyester ==5.0)
                                        {
                                            $cf_to_water_staining_value_for_polyester = '5';
                                        } 
                                        // acrylic
                                        $cf_to_water_staining_acrylic = $row_for_qc['cf_to_water_staining_value_for_acrylic'];
                                        
                                        if($cf_to_water_staining_acrylic ==1.0)
                                        {
                                            $cf_to_water_staining_value_for_acrylic = '1';
                                        }
                                        elseif($cf_to_water_staining_acrylic ==1.5)
                                        {
                                            $cf_to_water_staining_value_for_acrylic = '1-2';
                                        }
                                        elseif($cf_to_water_staining_acrylic ==2.0)
                                        {
                                            $cf_to_water_staining_value_for_acrylic = '2';
                                        }
                                        elseif($cf_to_water_staining_acrylic ==2.5)
                                        {
                                            $cf_to_water_staining_value_for_acrylic = '2-3';
                                        }
                                        elseif($cf_to_water_staining_acrylic ==3.0)
                                        {
                                            $cf_to_water_staining_value_for_acrylic = '3';
                                        }
                                        elseif($cf_to_water_staining_acrylic ==3.5)
                                        {
                                            $cf_to_water_staining_value_for_acrylic = '3-4';
                                        }
                                        elseif($cf_to_water_staining_acrylic ==4.0)
                                        {
                                            $cf_to_water_staining_value_for_acrylic = '4';
                                        }
                                        elseif($cf_to_water_staining_acrylic ==4.5)
                                        {
                                            $cf_to_water_staining_value_for_acrylic = '4-5';
                                        }
                                        elseif($cf_to_water_staining_acrylic ==5.0)
                                        {
                                            $cf_to_water_staining_value_for_acrylic = '5';
                                        } 
                                            // wool
                                        $cf_to_water_staining_wool = $row_for_qc['cf_to_water_staining_value_for_wool'];
                                        
                                        if($cf_to_water_staining_wool ==1.0)
                                        {
                                            $cf_to_water_staining_value_for_wool = '1';
                                        }
                                        elseif($cf_to_water_staining_wool ==1.5)
                                        {
                                            $cf_to_water_staining_value_for_wool = '1-2';
                                        }
                                        elseif($cf_to_water_staining_wool ==2.0)
                                        {
                                            $cf_to_water_staining_value_for_wool = '2';
                                        }
                                        elseif($cf_to_water_staining_wool ==2.5)
                                        {
                                            $cf_to_water_staining_value_for_wool = '2-3';
                                        }
                                        elseif($cf_to_water_staining_wool ==3.0)
                                        {
                                            $cf_to_water_staining_value_for_wool = '3';
                                        }
                                        elseif($cf_to_water_staining_wool ==3.5)
                                        {
                                            $cf_to_water_staining_value_for_wool = '3-4';
                                        }
                                        elseif($cf_to_water_staining_wool ==4.0)
                                        {
                                            $cf_to_water_staining_value_for_wool = '4';
                                        }
                                        elseif($cf_to_water_staining_wool ==4.5)
                                        {
                                            $cf_to_water_staining_value_for_wool = '4-5';
                                        }
                                        elseif($cf_to_water_staining_wool ==5.0)
                                        {
                                            $cf_to_water_staining_value_for_wool = '5';
                                        } 
                                        // for test result  
                                    }

                                    $form.="
                                    <div class='form-group from-group-sm row'>
                                    <div class='col-sm-1'><b style='font-size: 20px;' >".$serial.".</b></div>
                                    <div class='col-sm-11' id='form-group_for_test_report_of_ikea'>
                                        <div class='col-sm-10'>
                                                    <table class='table table-bordered'>
                                                        <thead>
                                                        <tr>
                                                            <label class='col-sm-12' for='name' style='font-size: 20px;' >  ".$row['test_name_method'].": </label>
                                                        </tr>
                                                        <tr>
                                                            <th class='text-center' colspan='7'>Result</th>
                                                            <th class='text-center' colspan='2'>Requirements</th>                                   
                                                        </tr>
                                                        <tr>
                                                            <th class='text-center' rowspan='2'>Color Change</th>
                                                            <th class='text-center' colspan='6'>Staining on to mulifiber</th>
                                                            <th class='text-center' rowspan='2'>Color Change</th>
                                                            <th class='text-center' rowspan='2'>Staining</th>
                                                        </tr>
                                                        <tr>
                                                            
                                                            <th class='text-center'>Acetate</th>
                                                            <th class='text-center'>Cotton</th>
                                                            <th class='text-center'>Mylon</th>
                                                            <th class='text-center'>Polyester</th>
                                                            <th class='text-center'>Acrylic</th>
                                                            <th class='text-center'>Wool</th>
                                                            

                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td class='text-center'>".$cf_to_water_color_change_value."</td>
                                                                <td class='text-center'>".$cf_to_water_staining_value_for_acetate."</td>
                                                                <td class='text-center'>".$cf_to_water_staining_value_for_cotton."</td>
                                                                <td class='text-center'>".$cf_to_water_staining_value_for_mylon."</td>
                                                                <td class='text-center'>".$cf_to_water_staining_value_for_polyester."</td>
                                                                <td class='text-center'>".$cf_to_water_staining_value_for_acrylic."</td>
                                                                <td class='text-center'>".$cf_to_water_staining_value_for_wool."</td>
                                                                <td class='text-center'>".$row_for_defining_process['cf_to_water_color_change_tolerance_range_math_operator'].$cf_to_water_color_change_tolerance_value."</td>
                                                                <td class='text-center'>".$row_for_defining_process['cf_to_water_staining_tolerance_range_math_operator'].$cf_to_water_staining_tolerance_value."</td>
                                                            </tr>

                                                        
                                                        
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>";
                                }
                                echo $form;
                                $form = "";
                            } /* ENd of if (in_array($row['id'], ['19']))*/

                            if (in_array($row['id'], ['23', '67']))
                            {
                                
                                if ($row_for_defining_process['cf_to_hydrolysis_of_reactive_dyes_color_change_max_value']<>0 && $row_for_qc['cf_to_hydrolysis_of_reactive_dyes_color_change_value']<>0) 
                                {
                                    $serial+=1;
                                    if($customer_type == 'american')
                                    {
                                        $cf_to_hydrolysis_of_reactive_dyes_color_change_tolerance_value = $row_for_defining_process['cf_to_hydrolysis_of_reactive_dyes_color_change_tolerance_value'];
                                        $cf_to_hydrolysis_of_reactive_dyes_color_change_value = $row_for_qc['cf_to_hydrolysis_of_reactive_dyes_color_change_value'];
                                    }

                                    if($customer_type == 'european')
                                    {
                                        $cf_to_hydrolysis_of_reactive_dyes_color_change_tolerance = $row_for_defining_process['cf_to_hydrolysis_of_reactive_dyes_color_change_tolerance_value'];
                                        
                                        if($cf_to_hydrolysis_of_reactive_dyes_color_change_tolerance ==1.0)
                                        {
                                            $cf_to_hydrolysis_of_reactive_dyes_color_change_tolerance_value = '1';
                                        }
                                        elseif($cf_to_hydrolysis_of_reactive_dyes_color_change_tolerance ==1.5)
                                        {
                                            $cf_to_hydrolysis_of_reactive_dyes_color_change_tolerance_value = '1-2';
                                        }
                                        elseif($cf_to_hydrolysis_of_reactive_dyes_color_change_tolerance ==2.0)
                                        {
                                            $cf_to_hydrolysis_of_reactive_dyes_color_change_tolerance_value = '2';
                                        }
                                        elseif($cf_to_hydrolysis_of_reactive_dyes_color_change_tolerance ==2.5)
                                        {
                                            $cf_to_hydrolysis_of_reactive_dyes_color_change_tolerance_value = '2-3';
                                        }
                                        elseif($cf_to_hydrolysis_of_reactive_dyes_color_change_tolerance ==3.0)
                                        {
                                            $cf_to_hydrolysis_of_reactive_dyes_color_change_tolerance_value = '3';
                                        }
                                        elseif($cf_to_hydrolysis_of_reactive_dyes_color_change_tolerance ==3.5)
                                        {
                                            $cf_to_hydrolysis_of_reactive_dyes_color_change_tolerance_value = '3-4';
                                        }
                                        elseif($cf_to_hydrolysis_of_reactive_dyes_color_change_tolerance ==4.0)
                                        {
                                            $cf_to_hydrolysis_of_reactive_dyes_color_change_tolerance_value = '4';
                                        }
                                        elseif($cf_to_hydrolysis_of_reactive_dyes_color_change_tolerance ==4.5)
                                        {
                                            $cf_to_hydrolysis_of_reactive_dyes_color_change_tolerance_value = '4-5';
                                        }
                                        elseif($cf_to_hydrolysis_of_reactive_dyes_color_change_tolerance ==5.0)
                                        {
                                            $cf_to_hydrolysis_of_reactive_dyes_color_change_tolerance_value = '5';
                                        }                             // for define

                                        $cf_to_hydrolysis_of_reactive_dyes_color_change_value = $row_for_qc['cf_to_hydrolysis_of_reactive_dyes_color_change_value'];
                                        if($cf_to_hydrolysis_of_reactive_dyes_color_change_value == 1.0)
                                        {
                                            $cf_to_hydrolysis_of_reactive_dyes_color_change_value = '1';
                                        }
                                        elseif($cf_to_hydrolysis_of_reactive_dyes_color_change_value == 1.5)
                                        {
                                            $cf_to_hydrolysis_of_reactive_dyes_color_change_value = '1-2';
                                        }
                                        elseif($cf_to_hydrolysis_of_reactive_dyes_color_change_value == 2.0)
                                        {
                                            $cf_to_hydrolysis_of_reactive_dyes_color_change_value = '2';
                                        }
                                        elseif($cf_to_hydrolysis_of_reactive_dyes_color_change_value == 2.5)
                                        {
                                            $cf_to_hydrolysis_of_reactive_dyes_color_change_value = '2-3';
                                        }
                                        elseif($cf_to_hydrolysis_of_reactive_dyes_color_change_value == 3.0)
                                        {
                                            $cf_to_hydrolysis_of_reactive_dyes_color_change_value = '3';
                                        }
                                        elseif($cf_to_hydrolysis_of_reactive_dyes_color_change_value == 3.5)
                                        {
                                            $cf_to_hydrolysis_of_reactive_dyes_color_change_value = '3-5';
                                        }
                                        elseif($cf_to_hydrolysis_of_reactive_dyes_color_change_value == 4.0)
                                        {
                                            $cf_to_hydrolysis_of_reactive_dyes_color_change_value = '4';
                                        }
                                        elseif($cf_to_hydrolysis_of_reactive_dyes_color_change_value == 4.5)
                                        {
                                            $cf_to_hydrolysis_of_reactive_dyes_color_change_value = '4-5';
                                        }
                                        elseif($cf_to_hydrolysis_of_reactive_dyes_color_change_value == 5.0)
                                        {
                                            $cf_to_hydrolysis_of_reactive_dyes_color_change_value = '5';
                                        }  // for test result
                                    }

                                    $form.="<div class='form-group from-group-sm row'>
                                    <div class='col-sm-1'><b style='font-size: 20px;' >".$serial.".</b></div>
                                    <div class='col-sm-11' id='form-group_for_test_report_of_ikea'>
                                        <div class='col-sm-10'>
                                                <table class='table table-bordered'>
                                                
                                                            <thead>
                                                            <tr>
                                                                <label class='col-sm-12' for='name' style='font-size: 20px;' >".$row['test_name_method']." : </label>
                                                            </tr>
                                                            <tr>
                                                                <th class='text-center'>Result (Color Change )</th>
                                                                <th class='text-center'>Requirements</th>                                   
                                                            </tr>
                                                            
                                                            </thead>
                                                            <tbody>
                                                            <tr>
                                                            <td class='text-center'>".$cf_to_hydrolysis_of_reactive_dyes_color_change_value.' '.$row_for_defining_process['uom_of_cf_to_hydrolysis_of_reactive_dyes_color_change']."</td>
                                                            <td class='text-center'>".$row_for_defining_process['cf_to_hydrolysis_of_reactive_dyes_color_change_tol_rang_mat_op'].' '.$cf_to_hydrolysis_of_reactive_dyes_color_change_tolerance_value.' '.$row_for_defining_process['uom_of_cf_to_hydrolysis_of_reactive_dyes_color_change']."</td>
                                                            </tr>
                                                            </tbody>
                                                        </table>
                                                    
                                                    </div>
                                                    </div>
                                                </div>";

                                }
                                echo $form;
                                $form = "";
                            }  /*End of if (in_array($row['id'], ['23', '67']))*/

                            if (in_array($row['id'], ['24', '68']))
                            {
                                
                                if ($row_for_defining_process['cf_to_oxidative_bleach_damage_color_change_max_value']<>0 && $row_for_qc['cf_to_oxidative_bleach_damage_color_change_value']<>0) 
                                {
                                    $serial+=1;
                                    

                                    if($customer_type == 'american')
                                    {
                                        $cf_to_oxidative_bleach_damage_color_change_tolerance_value = $row_for_defining_process['cf_to_oxidative_bleach_damage_color_change_tolerance_value'];
                                        $cf_to_oxidative_bleach_damage_color_change_value = $row_for_qc['cf_to_oxidative_bleach_damage_color_change_value'];
                                    }

                                    if($customer_type == 'european')
                                    {
                                    
                                        $cf_to_oxidative_bleach_damage_color_change_tolerance = $row_for_defining_process['cf_to_oxidative_bleach_damage_color_change_tolerance_value'];
                            
                                        if($cf_to_oxidative_bleach_damage_color_change_tolerance ==1.0)
                                        {
                                            $cf_to_oxidative_bleach_damage_color_change_tolerance_value = '1';
                                        }
                                        elseif($cf_to_oxidative_bleach_damage_color_change_tolerance ==1.5)
                                        {
                                            $cf_to_oxidative_bleach_damage_color_change_tolerance_value = '1-2';
                                        }
                                        elseif($cf_to_oxidative_bleach_damage_color_change_tolerance ==2.0)
                                        {
                                            $cf_to_oxidative_bleach_damage_color_change_tolerance_value = '2';
                                        }
                                        elseif($cf_to_oxidative_bleach_damage_color_change_tolerance ==2.5)
                                        {
                                            $cf_to_oxidative_bleach_damage_color_change_tolerance_value = '2-3';
                                        }
                                        elseif($cf_to_oxidative_bleach_damage_color_change_tolerance ==3.0)
                                        {
                                            $cf_to_oxidative_bleach_damage_color_change_tolerance_value = '3';
                                        }
                                        elseif($cf_to_oxidative_bleach_damage_color_change_tolerance ==3.5)
                                        {
                                            $cf_to_oxidative_bleach_damage_color_change_tolerance_value = '3-4';
                                        }
                                        elseif($cf_to_oxidative_bleach_damage_color_change_tolerance ==4.0)
                                        {
                                            $cf_to_oxidative_bleach_damage_color_change_tolerance_value = '4';
                                        }
                                        elseif($cf_to_oxidative_bleach_damage_color_change_tolerance ==4.5)
                                        {
                                            $cf_to_oxidative_bleach_damage_color_change_tolerance_value = '4-5';
                                        }
                                        elseif($cf_to_oxidative_bleach_damage_color_change_tolerance ==5.0)
                                        {
                                            $cf_to_oxidative_bleach_damage_color_change_tolerance_value = '5';
                                        }                             // for define

                                        $cf_to_oxidative_bleach_damage_color_change = $row_for_qc['cf_to_oxidative_bleach_damage_color_change_value'];
                                        if($cf_to_oxidative_bleach_damage_color_change == 1.0)
                                        {
                                            $cf_to_oxidative_bleach_damage_color_change_value = '1';
                                        }
                                        elseif($cf_to_oxidative_bleach_damage_color_change == 1.5)
                                        {
                                            $cf_to_oxidative_bleach_damage_color_change_value = '1-2';
                                        }
                                        elseif($cf_to_oxidative_bleach_damage_color_change == 2.0)
                                        {
                                            $cf_to_oxidative_bleach_damage_color_change_value = '2';
                                        }
                                        elseif($cf_to_oxidative_bleach_damage_color_change == 2.5)
                                        {
                                            $cf_to_oxidative_bleach_damage_color_change_value = '2-3';
                                        }
                                        elseif($cf_to_oxidative_bleach_damage_color_change == 3.0)
                                        {
                                            $cf_to_oxidative_bleach_damage_color_change_value = '3';
                                        }
                                        elseif($cf_to_oxidative_bleach_damage_color_change == 3.5)
                                        {
                                            $cf_to_oxidative_bleach_damage_color_change_value = '3-5';
                                        }
                                        elseif($cf_to_oxidative_bleach_damage_color_change == 4.0)
                                        {
                                            $cf_to_oxidative_bleach_damage_color_change_value = '4';
                                        }
                                        elseif($cf_to_oxidative_bleach_damage_color_change == 4.5)
                                        {
                                            $cf_to_oxidative_bleach_damage_color_change_value = '4-5';
                                        }
                                        elseif($cf_to_oxidative_bleach_damage_color_change == 5.0)
                                        {
                                            $cf_to_oxidative_bleach_damage_color_change_value = '5';
                                        }  // for test result
                                    }

                                        $form.="<div class='form-group from-group-sm row'>
                                        <div class='col-sm-1'><b style='font-size: 20px;' >".$serial.".</b></div>
                                        <div class='col-sm-11' id='form-group_for_test_report_of_ikea'>
                                            <div class='col-sm-10'>
                                                <table class='table table-bordered'>
                                                
                                                            <thead>
                                                            <tr>
                                                                <label class='col-sm-12' for='name' style='font-size: 20px;' >".$row['test_name_method']." : </label>
                                                            </tr>
                                                            <tr>
                                                                <th class='text-center'>Result (Color Change )</th>
                                                                <th class='text-center'>Requirements</th>                                   
                                                            </tr>
                                                            
                                                            </thead>
                                                            <tbody>
                                                            <tr>
                                                            <td class='text-center'>".$cf_to_oxidative_bleach_damage_color_change_value.' '.$row_for_defining_process['uom_of_cf_to_oxidative_bleach_damage_color_change']."</td>
                                                            <td class='text-center'>".$row_for_defining_process['cf_to_oxidative_bleach_damage_color_change_tol_range_math_op'].' '.$cf_to_oxidative_bleach_damage_color_change_tolerance_value.' '.$row_for_defining_process['uom_of_cf_to_oxidative_bleach_damage_color_change']."</td>
                                                            </tr>
                                                            </tbody>
                                                        </table>
                                                    
                                                    </div>
                                                    </div>
                                                </div>";

                                }
                                echo $form;
                                $form = "";
                            }  /*End of if (in_array($row['id'], ['24', '68']))*/

                            if (in_array($row['id'], ['25','69']))
                            {
                                
                                if ($row_for_defining_process['cf_to_phenolic_yellowing_staining_max_value']<>0 && $row_for_qc['cf_to_phenolic_yellowing_staining_value']<>0) 
                                {
                                    $serial+=1;
                                    if($customer_type == 'american')
                                    {
                                        $cf_to_phenolic_yellowing_staining_tolerance_value = $row_for_defining_process['cf_to_phenolic_yellowing_staining_tolerance_value'];
                                        $cf_to_phenolic_yellowing_staining_value = $row_for_qc['cf_to_phenolic_yellowing_staining_value'];
                                    }

                                    if($customer_type == 'european')
                                    {
                            
                                        $cf_to_phenolic_yellowing_staining_tolerance = $row_for_defining_process['cf_to_phenolic_yellowing_staining_tolerance_value'];
                            
                                        if($cf_to_phenolic_yellowing_staining_tolerance ==1.0)
                                        {
                                            $cf_to_phenolic_yellowing_staining_tolerance_value = '1';
                                        }
                                        elseif($cf_to_phenolic_yellowing_staining_tolerance ==1.5)
                                        {
                                            $cf_to_phenolic_yellowing_staining_tolerance_value = '1-2';
                                        }
                                        elseif($cf_to_phenolic_yellowing_staining_tolerance ==2.0)
                                        {
                                            $cf_to_phenolic_yellowing_staining_tolerance_value = '2';
                                        }
                                        elseif($cf_to_phenolic_yellowing_staining_tolerance ==2.5)
                                        {
                                            $cf_to_phenolic_yellowing_staining_tolerance_value = '2-3';
                                        }
                                        elseif($cf_to_phenolic_yellowing_staining_tolerance ==3.0)
                                        {
                                            $cf_to_phenolic_yellowing_staining_tolerance_value = '3';
                                        }
                                        elseif($cf_to_phenolic_yellowing_staining_tolerance ==3.5)
                                        {
                                            $cf_to_phenolic_yellowing_staining_tolerance_value = '3-4';
                                        }
                                        elseif($cf_to_phenolic_yellowing_staining_tolerance ==4.0)
                                        {
                                            $cf_to_phenolic_yellowing_staining_tolerance_value = '4';
                                        }
                                        elseif($cf_to_phenolic_yellowing_staining_tolerance ==4.5)
                                        {
                                            $cf_to_phenolic_yellowing_staining_tolerance_value = '4-5';
                                        }
                                        elseif($cf_to_phenolic_yellowing_staining_tolerance ==5.0)
                                        {
                                            $cf_to_phenolic_yellowing_staining_tolerance_value = '5';
                                        }                             // for define

                                        $cf_to_phenolic_yellowing_staining = $row_for_qc['cf_to_phenolic_yellowing_staining_value'];
                                        if($cf_to_phenolic_yellowing_staining == 1.0)
                                        {
                                            $cf_to_phenolic_yellowing_staining_value = '1';
                                        }
                                        elseif($cf_to_phenolic_yellowing_staining == 1.5)
                                        {
                                            $cf_to_phenolic_yellowing_staining_value = '1-2';
                                        }
                                        elseif($cf_to_phenolic_yellowing_staining == 2.0)
                                        {
                                            $cf_to_phenolic_yellowing_staining_value = '2';
                                        }
                                        elseif($cf_to_phenolic_yellowing_staining == 2.5)
                                        {
                                            $cf_to_phenolic_yellowing_staining_value = '2-3';
                                        }
                                        elseif($cf_to_phenolic_yellowing_staining == 3.0)
                                        {
                                            $cf_to_phenolic_yellowing_staining_value = '3';
                                        }
                                        elseif($cf_to_phenolic_yellowing_staining == 3.5)
                                        {
                                            $cf_to_phenolic_yellowing_staining_value = '3-5';
                                        }
                                        elseif($cf_to_phenolic_yellowing_staining == 4.0)
                                        {
                                            $cf_to_phenolic_yellowing_staining_value = '4';
                                        }
                                        elseif($cf_to_phenolic_yellowing_staining == 4.5)
                                        {
                                            $cf_to_phenolic_yellowing_staining_value = '4-5';
                                        }
                                        elseif($cf_to_phenolic_yellowing_staining == 5.0)
                                        {
                                            $cf_to_phenolic_yellowing_staining_value = '5';
                                        }  // for test result
                                    }

                                        $form.="<div class='form-group from-group-sm row'>
                                            <div class='col-sm-1'><b style='font-size: 20px;' >".$serial.".</b></div>
                                            <div class='col-sm-11' id='form-group_for_test_report_of_ikea'>
                                                <div class='col-sm-10'>
                                                <table class='table table-bordered'>
                                                
                                                            <thead>
                                                            <tr>
                                                                <label class='col-sm-12' for='name' style='font-size: 20px;' >".$row['test_name_method']." : </label>
                                                            </tr>
                                                            <tr>
                                                                <th class='text-center'>Result (Staining )</th>
                                                                <th class='text-center'>Requirements</th>                                   
                                                            </tr>
                                                            
                                                            </thead>
                                                            <tbody>
                                                            <tr>
                                                            <td>".$cf_to_phenolic_yellowing_staining_value.' '.$row_for_defining_process['uom_of_cf_to_phenolic_yellowing_staining']."</td>
                                                            <td>".$row_for_defining_process['cf_to_phenolic_yellowing_staining_tolerance_range_math_operator'].' '.$cf_to_phenolic_yellowing_staining_tolerance_value.' '.$row_for_defining_process['uom_of_cf_to_phenolic_yellowing_staining']."</td>
                                                            </tr>
                                                            </tbody>
                                                        </table>
                                                    
                                                    </div>
                                                    </div>
                                                </div>";

                                }
                                echo $form;
                                $form = "";
                            }  /*End of if (in_array($row['id'], ['25','69'))*/


                            if (in_array($row['id'], ['27', '71']))
                            {
                                if($row_for_defining_process['cf_to_saliva_color_change_max_value']<>0 && $row_for_qc['cf_to_saliva_color_change_value']<>0)
                                {
                                    $serial+=1;

                                    if($customer_type == 'american')
                                    {
                                        $cf_to_saliva_color_change_tolerance_value = $row_for_defining_process['cf_to_saliva_color_change_tolerance_value'];
                                        $cf_to_saliva_staining_tolerance_value = $row_for_defining_process['cf_to_saliva_staining_tolerance_value'];
                                        $cf_to_saliva_color_change_value = $row_for_qc['cf_to_saliva_color_change_value'];
                                        $cf_to_saliva_staining_value_for_acetate = $row_for_qc['cf_to_saliva_staining_value_for_acetate'];
                                        $cf_to_saliva_staining_value_for_cotton = $row_for_qc['cf_to_saliva_staining_value_for_cotton'];
                                        $cf_to_saliva_staining_value_for_mylon = $row_for_qc['cf_to_saliva_staining_value_for_mylon'];
                                        $cf_to_saliva_staining_value_for_polyester = $row_for_qc['cf_to_saliva_staining_value_for_polyester'];
                                        $cf_to_saliva_staining_value_for_acrylic = $row_for_qc['cf_to_saliva_staining_value_for_acrylic'];
                                        $cf_to_saliva_staining_value_for_wool = $row_for_qc['cf_to_saliva_staining_value_for_wool'];

                                    }
                                    if($customer_type == 'european')
                                    {
                                            // defining for color change
                                            $cf_to_saliva_color_change_tolerance = $row_for_defining_process['cf_to_saliva_color_change_tolerance_value'];
                                    
                                            if($cf_to_saliva_color_change_tolerance ==1.0)
                                            {
                                                $cf_to_saliva_color_change_tolerance_value = '1';
                                            }
                                            elseif($cf_to_saliva_color_change_tolerance ==1.5)
                                            {
                                                $cf_to_saliva_color_change_tolerance_value = '1-2';
                                            }
                                            elseif($cf_to_saliva_color_change_tolerance ==2.0)
                                            {
                                                $cf_to_saliva_color_change_tolerance_value = '2';
                                            }
                                            elseif($cf_to_saliva_color_change_tolerance ==2.5)
                                            {
                                                $cf_to_saliva_color_change_tolerance_value = '2-3';
                                            }
                                            elseif($cf_to_saliva_color_change_tolerance ==3.0)
                                            {
                                                $cf_to_saliva_color_change_tolerance_value = '3';
                                            }
                                            elseif($cf_to_saliva_color_change_tolerance ==3.5)
                                            {
                                                $cf_to_saliva_color_change_tolerance_value = '3-4';
                                            }
                                            elseif($cf_to_saliva_color_change_tolerance ==4.0)
                                            {
                                                $cf_to_saliva_color_change_tolerance_value = '4';
                                            }
                                            elseif($cf_to_saliva_color_change_tolerance ==4.5)
                                            {
                                                $cf_to_saliva_color_change_tolerance_value = '4-5';
                                            }
                                            elseif($cf_to_saliva_color_change_tolerance ==5.0)
                                            {
                                                $cf_to_saliva_color_change_tolerance_value = '5';
                                            }  			
                                            // defining for staining
                                            $cf_to_saliva_staining_tolerance = $row_for_defining_process['cf_to_saliva_staining_tolerance_value'];
                                    
                                            if($cf_to_saliva_staining_tolerance ==1.0)
                                            {
                                                $cf_to_saliva_staining_tolerance_value = '1';
                                            }
                                            elseif($cf_to_saliva_staining_tolerance ==1.5)
                                            {
                                                $cf_to_saliva_staining_tolerance_value = '1-2';
                                            }
                                            elseif($cf_to_saliva_staining_tolerance ==2.0)
                                            {
                                                $cf_to_saliva_staining_tolerance_value = '2';
                                            }
                                            elseif($cf_to_saliva_staining_tolerance ==2.5)
                                            {
                                                $cf_to_saliva_staining_tolerance_value = '2-3';
                                            }
                                            elseif($cf_to_saliva_staining_tolerance ==3.0)
                                            {
                                                $cf_to_saliva_staining_tolerance_value = '3';
                                            }
                                            elseif($cf_to_saliva_staining_tolerance ==3.5)
                                            {
                                                $cf_to_saliva_staining_tolerance_value = '3-4';
                                            }
                                            elseif($cf_to_saliva_staining_tolerance ==4.0)
                                            {
                                                $cf_to_saliva_staining_tolerance_value = '4';
                                            }
                                            elseif($cf_to_saliva_staining_tolerance ==4.5)
                                            {
                                                $cf_to_saliva_staining_tolerance_value = '4-5';
                                            }
                                            elseif($cf_to_saliva_staining_tolerance ==5.0)
                                            {
                                                $cf_to_saliva_staining_tolerance_value = '5';
                                            }
                                            
        
                                            // color change for qc
                                        $cf_to_saliva_color_change = $row_for_qc['cf_to_saliva_color_change_value'];
                                    
                                            if($cf_to_saliva_color_change ==1.0)
                                            {
                                                $cf_to_saliva_color_change_value = '1';
                                            }
                                            elseif($cf_to_saliva_color_change ==1.5)
                                            {
                                                $cf_to_saliva_color_change_value = '1-2';
                                            }
                                            elseif($cf_to_saliva_color_change ==2.0)
                                            {
                                                $cf_to_saliva_color_change_value = '2';
                                            }
                                            elseif($cf_to_saliva_color_change ==2.5)
                                            {
                                                $cf_to_saliva_color_change_value = '2-3';
                                            }
                                            elseif($cf_to_saliva_color_change ==3.0)
                                            {
                                                $cf_to_saliva_color_change_value = '3';
                                            }
                                            elseif($cf_to_saliva_color_change ==3.5)
                                            {
                                                $cf_to_saliva_color_change_value = '3-4';
                                            }
                                            elseif($cf_to_saliva_color_change ==4.0)
                                            {
                                                $cf_to_saliva_color_change_value = '4';
                                            }
                                            elseif($cf_to_saliva_color_change ==4.5)
                                            {
                                                $cf_to_saliva_color_change_value = '4-5';
                                            }
                                            elseif($cf_to_saliva_color_change ==5.0)
                                            {
                                                $cf_to_saliva_color_change_value = '5';
                                            }
                                                // acetate
                                            $cf_to_saliva_staining_acetate = $row_for_qc['cf_to_saliva_staining_value_for_acetate'];
                                            
                                            if($cf_to_saliva_staining_acetate ==1.0)
                                            {
                                                $cf_to_saliva_staining_value_for_acetate = '1';
                                            }
                                            elseif($cf_to_saliva_staining_acetate ==1.5)
                                            {
                                                $cf_to_saliva_staining_value_for_acetate = '1-2';
                                            }
                                            elseif($cf_to_saliva_staining_acetate ==2.0)
                                            {
                                                $cf_to_saliva_staining_value_for_acetate = '2';
                                            }
                                            elseif($cf_to_saliva_staining_acetate ==2.5)
                                            {
                                                $cf_to_saliva_staining_value_for_acetate = '2-3';
                                            }
                                            elseif($cf_to_saliva_staining_acetate ==3.0)
                                            {
                                                $cf_to_saliva_staining_value_for_acetate = '3';
                                            }
                                            elseif($cf_to_saliva_staining_acetate ==3.5)
                                            {
                                                $cf_to_saliva_staining_value_for_acetate = '3-4';
                                            }
                                            elseif($cf_to_saliva_staining_acetate ==4.0)
                                            {
                                                $cf_to_saliva_staining_value_for_acetate = '4';
                                            }
                                            elseif($cf_to_saliva_staining_acetate ==4.5)
                                            {
                                                $cf_to_saliva_staining_value_for_acetate = '4-5';
                                            }
                                            elseif($cf_to_saliva_staining_acetate ==5.0)
                                            {
                                                $cf_to_saliva_staining_value_for_acetate = '5';
                                            } 
                                            // cotton
                                            $cf_to_saliva_staining_cotton = $row_for_qc['cf_to_saliva_staining_value_for_cotton'];
                                            
                                            if($cf_to_saliva_staining_cotton ==1.0)
                                            {
                                                $cf_to_saliva_staining_value_for_cotton = '1';
                                            }
                                            elseif($cf_to_saliva_staining_cotton ==1.5)
                                            {
                                                $cf_to_saliva_staining_value_for_cotton = '1-2';
                                            }
                                            elseif($cf_to_saliva_staining_cotton ==2.0)
                                            {
                                                $cf_to_saliva_staining_value_for_cotton = '2';
                                            }
                                            elseif($cf_to_saliva_staining_cotton ==2.5)
                                            {
                                                $cf_to_saliva_staining_value_for_cotton = '2-3';
                                            }
                                            elseif($cf_to_saliva_staining_cotton ==3.0)
                                            {
                                                $cf_to_saliva_staining_value_for_cotton = '3';
                                            }
                                            elseif($cf_to_saliva_staining_cotton ==3.5)
                                            {
                                                $cf_to_saliva_staining_value_for_cotton = '3-4';
                                            }
                                            elseif($cf_to_saliva_staining_cotton ==4.0)
                                            {
                                                $cf_to_saliva_staining_value_for_cotton = '4';
                                            }
                                            elseif($cf_to_saliva_staining_cotton ==4.5)
                                            {
                                                $cf_to_saliva_staining_value_for_cotton = '4-5';
                                            }
                                            elseif($cf_to_saliva_staining_cotton ==5.0)
                                            {
                                                $cf_to_saliva_staining_value_for_cotton = '5';
                                            } 
                                                // nylon
                                            $cf_to_saliva_staining_mylon = $row_for_qc['cf_to_saliva_staining_value_for_mylon'];
                                            
                                            if($cf_to_saliva_staining_mylon ==1.0)
                                            {
                                                $cf_to_saliva_staining_value_for_mylon = '1';
                                            }
                                            elseif($cf_to_saliva_staining_mylon ==1.5)
                                            {
                                                $cf_to_saliva_staining_value_for_mylon = '1-2';
                                            }
                                            elseif($cf_to_saliva_staining_mylon ==2.0)
                                            {
                                                $cf_to_saliva_staining_value_for_mylon = '2';
                                            }
                                            elseif($cf_to_saliva_staining_mylon ==2.5)
                                            {
                                                $cf_to_saliva_staining_value_for_mylon = '2-3';
                                            }
                                            elseif($cf_to_saliva_staining_mylon ==3.0)
                                            {
                                                $cf_to_saliva_staining_value_for_mylon = '3';
                                            }
                                            elseif($cf_to_saliva_staining_mylon ==3.5)
                                            {
                                                $cf_to_saliva_staining_value_for_mylon = '3-4';
                                            }
                                            elseif($cf_to_saliva_staining_mylon ==4.0)
                                            {
                                                $cf_to_saliva_staining_value_for_mylon = '4';
                                            }
                                            elseif($cf_to_saliva_staining_mylon ==4.5)
                                            {
                                                $cf_to_saliva_staining_value_for_mylon = '4-5';
                                            }
                                            elseif($cf_to_saliva_staining_mylon ==5.0)
                                            {
                                                $cf_to_saliva_staining_value_for_mylon = '5';
                                            } 
                                            // polyester
                                            $cf_to_saliva_staining_polyester = $row_for_qc['cf_to_saliva_staining_value_for_polyester'];
                                            
                                            if($cf_to_saliva_staining_polyester ==1.0)
                                            {
                                                $cf_to_saliva_staining_value_for_polyester = '1';
                                            }
                                            elseif($cf_to_saliva_staining_polyester ==1.5)
                                            {
                                                $cf_to_saliva_staining_value_for_polyester = '1-2';
                                            }
                                            elseif($cf_to_saliva_staining_polyester ==2.0)
                                            {
                                                $cf_to_saliva_staining_value_for_polyester = '2';
                                            }
                                            elseif($cf_to_saliva_staining_polyester ==2.5)
                                            {
                                                $cf_to_saliva_staining_value_for_polyester = '2-3';
                                            }
                                            elseif($cf_to_saliva_staining_polyester ==3.0)
                                            {
                                                $cf_to_saliva_staining_value_for_polyester = '3';
                                            }
                                            elseif($cf_to_saliva_staining_polyester ==3.5)
                                            {
                                                $cf_to_saliva_staining_value_for_polyester = '3-4';
                                            }
                                            elseif($cf_to_saliva_staining_polyester ==4.0)
                                            {
                                                $cf_to_saliva_staining_value_for_polyester = '4';
                                            }
                                            elseif($cf_to_saliva_staining_polyester ==4.5)
                                            {
                                                $cf_to_saliva_staining_value_for_polyester = '4-5';
                                            }
                                            elseif($cf_to_saliva_staining_polyester ==5.0)
                                            {
                                                $cf_to_saliva_staining_value_for_polyester = '5';
                                            } 
                                            // acrylic
                                            $cf_to_saliva_staining_acrylic = $row_for_qc['cf_to_saliva_staining_value_for_acrylic'];
                                            
                                            if($cf_to_saliva_staining_acrylic ==1.0)
                                            {
                                                $cf_to_saliva_staining_value_for_acrylic = '1';
                                            }
                                            elseif($cf_to_saliva_staining_acrylic ==1.5)
                                            {
                                                $cf_to_saliva_staining_value_for_acrylic = '1-2';
                                            }
                                            elseif($cf_to_saliva_staining_acrylic ==2.0)
                                            {
                                                $cf_to_saliva_staining_value_for_acrylic = '2';
                                            }
                                            elseif($cf_to_saliva_staining_acrylic ==2.5)
                                            {
                                                $cf_to_saliva_staining_value_for_acrylic = '2-3';
                                            }
                                            elseif($cf_to_saliva_staining_acrylic ==3.0)
                                            {
                                                $cf_to_saliva_staining_value_for_acrylic = '3';
                                            }
                                            elseif($cf_to_saliva_staining_acrylic ==3.5)
                                            {
                                                $cf_to_saliva_staining_value_for_acrylic = '3-4';
                                            }
                                            elseif($cf_to_saliva_staining_acrylic ==4.0)
                                            {
                                                $cf_to_saliva_staining_value_for_acrylic = '4';
                                            }
                                            elseif($cf_to_saliva_staining_acrylic ==4.5)
                                            {
                                                $cf_to_saliva_staining_value_for_acrylic = '4-5';
                                            }
                                            elseif($cf_to_saliva_staining_acrylic ==5.0)
                                            {
                                                $cf_to_saliva_staining_value_for_acrylic = '5';
                                            } 
                                                // wool
                                            $cf_to_saliva_staining_wool = $row_for_qc['cf_to_saliva_staining_value_for_wool'];
                                            
                                            if($cf_to_saliva_staining_wool ==1.0)
                                            {
                                                $cf_to_saliva_staining_value_for_wool = '1';
                                            }
                                            elseif($cf_to_saliva_staining_wool ==1.5)
                                            {
                                                $cf_to_saliva_staining_value_for_wool = '1-2';
                                            }
                                            elseif($cf_to_saliva_staining_wool ==2.0)
                                            {
                                                $cf_to_saliva_staining_value_for_wool = '2';
                                            }
                                            elseif($cf_to_saliva_staining_wool ==2.5)
                                            {
                                                $cf_to_saliva_staining_value_for_wool = '2-3';
                                            }
                                            elseif($cf_to_saliva_staining_wool ==3.0)
                                            {
                                                $cf_to_saliva_staining_value_for_wool = '3';
                                            }
                                            elseif($cf_to_saliva_staining_wool ==3.5)
                                            {
                                                $cf_to_saliva_staining_value_for_wool = '3-4';
                                            }
                                            elseif($cf_to_saliva_staining_wool ==4.0)
                                            {
                                                $cf_to_saliva_staining_value_for_wool = '4';
                                            }
                                            elseif($cf_to_saliva_staining_wool ==4.5)
                                            {
                                                $cf_to_saliva_staining_value_for_wool = '4-5';
                                            }
                                            elseif($cf_to_saliva_staining_wool ==5.0)
                                            {
                                                $cf_to_saliva_staining_value_for_wool = '5';
                                            } 
                                            // for test result  
                                    }
                                        $form.="
                                        <div class='form-group from-group-sm row'>
                                        <div class='col-sm-1'><b style='font-size: 20px;' >".$serial.".</b></div>
                                        <div class='col-sm-11' id='form-group_for_test_report_of_ikea'>
                                            <div class='col-sm-10'>
                                                    <table class='table table-bordered'>
                                                        <thead>
                                                        <tr>
                                                            <label class='col-sm-12' for='name' style='font-size: 20px;' >  ".$row['test_name_method'].": </label>
                                                        </tr>
                                                        <tr>
                                                            <th class='text-center' colspan='7'>Result</th>
                                                            <th class='text-center' colspan='2'>Requirements</th>                                   
                                                        </tr>
                                                        <tr>
                                                            <th class='text-center' rowspan='2'>Color Change</th>
                                                            <th class='text-center' colspan='6'>Staining on to mulifiber</th>
                                                            <th class='text-center' rowspan='2'>Color Change</th>
                                                            <th class='text-center' rowspan='2'>Staining</th>
                                                        </tr>
                                                        <tr>
                                                            
                                                            <th class='text-center'>Acetate</th>
                                                            <th class='text-center'>Cotton</th>
                                                            <th class='text-center'>Mylon</th>
                                                            <th class='text-center'>Polyester</th>
                                                            <th class='text-center'>Acrylic</th>
                                                            <th class='text-center'>Wool</th>
                                                            

                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td class='text-center'>".$cf_to_saliva_color_change_value."</td>
                                                                <td class='text-center'>".$cf_to_saliva_staining_value_for_acetate."</td>
                                                                <td class='text-center'>".$cf_to_saliva_staining_value_for_cotton."</td>
                                                                <td class='text-center'>".$cf_to_saliva_staining_value_for_mylon."</td>
                                                                <td class='text-center'>".$cf_to_saliva_staining_value_for_polyester."</td>
                                                                <td class='text-center'>".$cf_to_saliva_staining_value_for_acrylic."</td>
                                                                <td class='text-center'>".$cf_to_saliva_staining_value_for_wool."</td>
                                                                <td class='text-center'>".$row_for_defining_process['cf_to_saliva_color_change_tolerance_range_math_operator'].$cf_to_saliva_color_change_tolerance_value."</td>
                                                                <td class='text-center'>".$row_for_defining_process['cf_to_saliva_staining_tolerance_range_math_operator'].$cf_to_saliva_staining_tolerance_value."</td>
                                                            </tr>

                                                        
                                                        
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>";

                                }
                                echo $form;
                                $form = "";
                            } /* ENd of if (in_array($row['id'], ['19']))*/


                            if (in_array($row['id'], ['28', '72']))
                            {
                                
                                if ($row_for_defining_process['cf_to_chlorinated_water_color_change_max_value']<>0 && $row_for_qc['cf_to_chlorinated_water_color_change_change_value']<>0) 
                                {
                                    $serial+=1;

                                    if($customer_type == 'american')
                                    {
                                        $cf_to_chlorinated_water_color_change_tolerance_value = $row_for_defining_process['cf_to_chlorinated_water_color_change_tolerance_value'];
                                        $cf_to_chlorinated_water_color_change_change_value = $row_for_qc['cf_to_chlorinated_water_color_change_change_value'];
                                    }

                                    if($customer_type == 'european')
                                    {
                            
                                        $cf_to_chlorinated_water_color_change_tolerance = $row_for_defining_process['cf_to_chlorinated_water_color_change_tolerance_value'];
                                        
                                        if($cf_to_chlorinated_water_color_change_tolerance ==1.0)
                                        {
                                            $cf_to_chlorinated_water_color_change_tolerance_value = '1';
                                        }
                                        elseif($cf_to_chlorinated_water_color_change_tolerance ==1.5)
                                        {
                                            $cf_to_chlorinated_water_color_change_tolerance_value = '1-2';
                                        }
                                        elseif($cf_to_chlorinated_water_color_change_tolerance ==2.0)
                                        {
                                            $cf_to_chlorinated_water_color_change_tolerance_value = '2';
                                        }
                                        elseif($cf_to_chlorinated_water_color_change_tolerance ==2.5)
                                        {
                                            $cf_to_chlorinated_water_color_change_tolerance_value = '2-3';
                                        }
                                        elseif($cf_to_chlorinated_water_color_change_tolerance ==3.0)
                                        {
                                            $cf_to_chlorinated_water_color_change_tolerance_value = '3';
                                        }
                                        elseif($cf_to_chlorinated_water_color_change_tolerance ==3.5)
                                        {
                                            $cf_to_chlorinated_water_color_change_tolerance_value = '3-4';
                                        }
                                        elseif($cf_to_chlorinated_water_color_change_tolerance ==4.0)
                                        {
                                            $cf_to_chlorinated_water_color_change_tolerance_value = '4';
                                        }
                                        elseif($cf_to_chlorinated_water_color_change_tolerance ==4.5)
                                        {
                                            $cf_to_chlorinated_water_color_change_tolerance_value = '4-5';
                                        }
                                        elseif($cf_to_chlorinated_water_color_change_tolerance ==5.0)
                                        {
                                            $cf_to_chlorinated_water_color_change_tolerance_value = '5';
                                        }                             // for define

                                        $cf_to_chlorinated_water_color_change_change = $row_for_qc['cf_to_chlorinated_water_color_change_change_value'];
                                        if($cf_to_chlorinated_water_color_change_change == 1.0)
                                        {
                                            $cf_to_chlorinated_water_color_change_change_value = '1';
                                        }
                                        elseif($cf_to_chlorinated_water_color_change_change == 1.5)
                                        {
                                            $cf_to_chlorinated_water_color_change_change_value = '1-2';
                                        }
                                        elseif($cf_to_chlorinated_water_color_change_change == 2.0)
                                        {
                                            $cf_to_chlorinated_water_color_change_change_value = '2';
                                        }
                                        elseif($cf_to_chlorinated_water_color_change_change == 2.5)
                                        {
                                            $cf_to_chlorinated_water_color_change_change_value = '2-3';
                                        }
                                        elseif($cf_to_chlorinated_water_color_change_change == 3.0)
                                        {
                                            $cf_to_chlorinated_water_color_change_change_value = '3';
                                        }
                                        elseif($cf_to_chlorinated_water_color_change_change == 3.5)
                                        {
                                            $cf_to_chlorinated_water_color_change_change_value = '3-5';
                                        }
                                        elseif($cf_to_chlorinated_water_color_change_change == 4.0)
                                        {
                                            $cf_to_chlorinated_water_color_change_change_value = '4';
                                        }
                                        elseif($cf_to_chlorinated_water_color_change_change == 4.5)
                                        {
                                            $cf_to_chlorinated_water_color_change_change_value = '4-5';
                                        }
                                        elseif($cf_to_chlorinated_water_color_change_change == 5.0)
                                        {
                                            $cf_to_chlorinated_water_color_change_change_value = '5';
                                        }  // for test result
                                    }

                                    $form.="<div class='form-group from-group-sm row'>
                                    <div class='col-sm-1'><b style='font-size: 20px;' >".$serial.".</b></div>
                                    <div class='col-sm-11' id='form-group_for_test_report_of_ikea'>
                                        <div class='col-sm-10'>
                                                <table class='table table-bordered'>
                                                
                                                            <thead>
                                                            <tr>
                                                                <label class='col-sm-12' for='name' style='font-size: 20px;' >".$row['test_name_method']." : </label>
                                                            </tr>
                                                            <tr>
                                                                <th class='text-center'>Result (Color Change )</th>
                                                                <th class='text-center'>Requirements</th>                                   
                                                            </tr>
                                                            
                                                            </thead>
                                                            <tbody>
                                                            <tr>
                                                            <td class='text-center'>".$cf_to_chlorinated_water_color_change_change_value."</td>
                                                            <td class='text-center'>".$row_for_defining_process['cf_to_chlorinated_water_color_change_tolerance_range_math_op'].' '.$cf_to_chlorinated_water_color_change_tolerance_value.' '.$row_for_defining_process['uom_of_cf_to_chlorinated_water_color_change']."</td>
                                                            </tr>
                                                            
                                                            </tbody>
                                                        </table>
                                                    
                                                    </div>
                                                    </div>
                                                </div>";

                                }
                                echo $form;
                                $form = "";
                            }  /*End of if (in_array($row['id'], ['28', '72']))*/

                            if (in_array($row['id'], ['29', '73']))
                            {
                                
                                if ($row_for_defining_process['cf_to_cholorine_bleach_color_change_max_value']<>0 && $row_for_qc['cf_to_cholorine_bleach_color_change_value']<>0) 
                                {
                                    $serial+=1;


                            
                                    if($customer_type == 'american')
                                    {
                                        $cf_to_cholorine_bleach_color_change_tolerance_value = $row_for_defining_process['cf_to_cholorine_bleach_color_change_tolerance_value'];
                                        $cf_to_cholorine_bleach_color_change_value = $row_for_qc['cf_to_cholorine_bleach_color_change_value'];
                                    }

                                    if($customer_type == 'european')
                                    {
                            
                                        $cf_to_cholorine_bleach_color_change_tolerance = $row_for_defining_process['cf_to_cholorine_bleach_color_change_tolerance_value'];
                                        
                                        if($cf_to_cholorine_bleach_color_change_tolerance ==1.0)
                                        {
                                            $cf_to_cholorine_bleach_color_change_tolerance_value = '1';
                                        }
                                        elseif($cf_to_cholorine_bleach_color_change_tolerance ==1.5)
                                        {
                                            $cf_to_cholorine_bleach_color_change_tolerance_value = '1-2';
                                        }
                                        elseif($cf_to_cholorine_bleach_color_change_tolerance ==2.0)
                                        {
                                            $cf_to_cholorine_bleach_color_change_tolerance_value = '2';
                                        }
                                        elseif($cf_to_cholorine_bleach_color_change_tolerance ==2.5)
                                        {
                                            $cf_to_cholorine_bleach_color_change_tolerance_value = '2-3';
                                        }
                                        elseif($cf_to_cholorine_bleach_color_change_tolerance ==3.0)
                                        {
                                            $cf_to_cholorine_bleach_color_change_tolerance_value = '3';
                                        }
                                        elseif($cf_to_cholorine_bleach_color_change_tolerance ==3.5)
                                        {
                                            $cf_to_cholorine_bleach_color_change_tolerance_value = '3-4';
                                        }
                                        elseif($cf_to_cholorine_bleach_color_change_tolerance ==4.0)
                                        {
                                            $cf_to_cholorine_bleach_color_change_tolerance_value = '4';
                                        }
                                        elseif($cf_to_cholorine_bleach_color_change_tolerance ==4.5)
                                        {
                                            $cf_to_cholorine_bleach_color_change_tolerance_value = '4-5';
                                        }
                                        elseif($cf_to_cholorine_bleach_color_change_tolerance ==5.0)
                                        {
                                            $cf_to_cholorine_bleach_color_change_tolerance_value = '5';
                                        }                             // for define

                                        $cf_to_cholorine_bleach_color_change = $row_for_qc['cf_to_cholorine_bleach_color_change_value'];
                                        if($cf_to_cholorine_bleach_color_change == 1.0)
                                        {
                                            $cf_to_cholorine_bleach_color_change_value = '1';
                                        }
                                        elseif($cf_to_cholorine_bleach_color_change == 1.5)
                                        {
                                            $cf_to_cholorine_bleach_color_change_value = '1-2';
                                        }
                                        elseif($cf_to_cholorine_bleach_color_change == 2.0)
                                        {
                                            $cf_to_cholorine_bleach_color_change_value = '2';
                                        }
                                        elseif($cf_to_cholorine_bleach_color_change == 2.5)
                                        {
                                            $cf_to_cholorine_bleach_color_change_value = '2-3';
                                        }
                                        elseif($cf_to_cholorine_bleach_color_change == 3.0)
                                        {
                                            $cf_to_cholorine_bleach_color_change_value = '3';
                                        }
                                        elseif($cf_to_cholorine_bleach_color_change == 3.5)
                                        {
                                            $cf_to_cholorine_bleach_color_change_value = '3-5';
                                        }
                                        elseif($cf_to_cholorine_bleach_color_change == 4.0)
                                        {
                                            $cf_to_cholorine_bleach_color_change_value = '4';
                                        }
                                        elseif($cf_to_cholorine_bleach_color_change == 4.5)
                                        {
                                            $cf_to_cholorine_bleach_color_change_value = '4-5';
                                        }
                                        elseif($cf_to_cholorine_bleach_color_change == 5.0)
                                        {
                                            $cf_to_cholorine_bleach_color_change_value = '5';
                                        }  // for test result
                                    }


                                    $form.="<div class='form-group from-group-sm row'>
                                    <div class='col-sm-1'><b style='font-size: 20px;' >".$serial.".</b></div>
                                    <div class='col-sm-11' id='form-group_for_test_report_of_ikea'>
                                        <div class='col-sm-10'>
                                                <table class='table table-bordered'>
                                                
                                                            <thead>
                                                            <tr>
                                                                <label class='col-sm-12' for='name' style='font-size: 20px;' >".$row['test_name_method']." : </label>
                                                            </tr>
                                                            <tr>
                                                                <th class='text-center'>Result (Color Change )</th>
                                                                <th class='text-center'>Requirements</th>                                   
                                                            </tr>
                                                            
                                                            </thead>
                                                            <tbody>
                                                            <tr>
                                                            <td class='text-center'>".$cf_to_cholorine_bleach_color_change_value.' '.$row_for_defining_process['uom_of_cf_to_cholorine_bleach_color_change']."</td>
                                                            <td class='text-center'>".$row_for_defining_process['cf_to_cholorine_bleach_color_change_tolerance_range_math_op'].' '.$cf_to_cholorine_bleach_color_change_tolerance_value.' '.$row_for_defining_process['uom_of_cf_to_cholorine_bleach_color_change']."</td>
                                                            </tr>
                                                            
                                                            </tbody>
                                                        </table>
                                                    
                                                    </div>
                                                    </div>
                                                </div>";

                                }
                                echo $form;
                                $form = "";
                            }  /*End of if (in_array($row['id'], ['29', '73']))*/

                            if (in_array($row['id'], ['30']))
                            {
                                
                                if ($row_for_defining_process['cf_to_peroxide_bleach_color_change_max_value']<>0 && $row_for_qc['cf_to_peroxide_bleach_color_change_value']<>0) 
                                {
                                    $serial+=1;

                                    
                                    if($customer_type == 'american')
                                    {
                                        $cf_to_peroxide_bleach_color_change_tolerance_value = $row_for_defining_process['cf_to_peroxide_bleach_color_change_tolerance_value'];
                                        $cf_to_peroxide_bleach_color_change_value = $row_for_qc['cf_to_peroxide_bleach_color_change_value'];
                                    }

                                    if($customer_type == 'european')
                                    {
                            
                                        $cf_to_peroxide_bleach_color_change_tolerance = $row_for_defining_process['cf_to_peroxide_bleach_color_change_tolerance_value'];
                                            
                                        if($cf_to_peroxide_bleach_color_change_tolerance ==1.0)
                                        {
                                            $cf_to_peroxide_bleach_color_change_tolerance_value = '1';
                                        }
                                        elseif($cf_to_peroxide_bleach_color_change_tolerance ==1.5)
                                        {
                                            $cf_to_peroxide_bleach_color_change_tolerance_value = '1-2';
                                        }
                                        elseif($cf_to_peroxide_bleach_color_change_tolerance ==2.0)
                                        {
                                            $cf_to_peroxide_bleach_color_change_tolerance_value = '2';
                                        }
                                        elseif($cf_to_peroxide_bleach_color_change_tolerance ==2.5)
                                        {
                                            $cf_to_peroxide_bleach_color_change_tolerance_value = '2-3';
                                        }
                                        elseif($cf_to_peroxide_bleach_color_change_tolerance ==3.0)
                                        {
                                            $cf_to_peroxide_bleach_color_change_tolerance_value = '3';
                                        }
                                        elseif($cf_to_peroxide_bleach_color_change_tolerance ==3.5)
                                        {
                                            $cf_to_peroxide_bleach_color_change_tolerance_value = '3-4';
                                        }
                                        elseif($cf_to_peroxide_bleach_color_change_tolerance ==4.0)
                                        {
                                            $cf_to_peroxide_bleach_color_change_tolerance_value = '4';
                                        }
                                        elseif($cf_to_peroxide_bleach_color_change_tolerance ==4.5)
                                        {
                                            $cf_to_peroxide_bleach_color_change_tolerance_value = '4-5';
                                        }
                                        elseif($cf_to_peroxide_bleach_color_change_tolerance ==5.0)
                                        {
                                            $cf_to_peroxide_bleach_color_change_tolerance_value = '5';
                                        }                             // for define

                                        $cf_to_peroxide_bleach_color_change = $row_for_qc['cf_to_peroxide_bleach_color_change_value'];
                                        if($cf_to_peroxide_bleach_color_change == 1.0)
                                        {
                                            $cf_to_peroxide_bleach_color_change_value = '1';
                                        }
                                        elseif($cf_to_peroxide_bleach_color_change == 1.5)
                                        {
                                            $cf_to_peroxide_bleach_color_change_value = '1-2';
                                        }
                                        elseif($cf_to_peroxide_bleach_color_change == 2.0)
                                        {
                                            $cf_to_peroxide_bleach_color_change_value = '2';
                                        }
                                        elseif($cf_to_peroxide_bleach_color_change == 2.5)
                                        {
                                            $cf_to_peroxide_bleach_color_change_value = '2-3';
                                        }
                                        elseif($cf_to_peroxide_bleach_color_change == 3.0)
                                        {
                                            $cf_to_peroxide_bleach_color_change_value = '3';
                                        }
                                        elseif($cf_to_peroxide_bleach_color_change == 3.5)
                                        {
                                            $cf_to_peroxide_bleach_color_change_value = '3-5';
                                        }
                                        elseif($cf_to_peroxide_bleach_color_change == 4.0)
                                        {
                                            $cf_to_peroxide_bleach_color_change_value = '4';
                                        }
                                        elseif($cf_to_peroxide_bleach_color_change == 4.5)
                                        {
                                            $cf_to_peroxide_bleach_color_change_value = '4-5';
                                        }
                                        elseif($cf_to_peroxide_bleach_color_change == 5.0)
                                        {
                                            $cf_to_peroxide_bleach_color_change_value = '5';
                                        }  // for test result
                                    }

                                    $form.="<div class='form-group from-group-sm row'>
                                    <div class='col-sm-1'><b style='font-size: 20px;' >".$serial.".</b></div>
                                    <div class='col-sm-11' id='form-group_for_test_report_of_ikea'>
                                        <div class='col-sm-10'>
                                                <table class='table table-bordered'>
                                                
                                                            <thead>
                                                            <tr>
                                                                <label class='col-sm-12' for='name' style='font-size: 20px;' >".$row['test_name_method']." : </label>
                                                            </tr>
                                                            <tr>
                                                                <th class='text-center'>Result (Color Change )</th>
                                                                <th class='text-center'>Requirements</th>                                   
                                                            </tr>
                                                            
                                                            </thead>
                                                            <tbody>
                                                            <tr>
                                                            <td class='text-center'>".$cf_to_peroxide_bleach_color_change_value.' '.$row_for_defining_process['uom_of_cf_to_peroxide_bleach_color_change']."</td>
                                                            <td class='text-center'>".$row_for_defining_process['cf_to_peroxide_bleach_color_change_tolerance_range_math_operator'].' '.$cf_to_peroxide_bleach_color_change_tolerance_value.' '.$row_for_defining_process['uom_of_cf_to_peroxide_bleach_color_change']."</td>                                                            </tr>
                                                            </tr>
                                                            </tbody>
                                                        </table>
                                                    
                                                    </div>
                                                    </div>
                                                </div>";

                                }
                                echo $form;
                                $form = "";
                            }  /*End of if (in_array($row['id'], ['30']))*/

                            if (in_array($row['id'], ['31']))
                            {
                                
                                if ($row_for_defining_process['cross_staining_max_value']<>0 && $row_for_qc['cross_staining_value']<>0) 
                                {
                                    $serial+=1;

                                    

                                    if($customer_type == 'american')
                                    {
                                        $cross_staining_tolerance_value = $row_for_defining_process['cross_staining_tolerance_value'];
                                        $cross_staining_value = $row_for_qc['cross_staining_value'];
                                    }

                                    if($customer_type == 'european')
                                    {
                            
                                        $cross_staining_tolerance = $row_for_defining_process['cross_staining_tolerance_value'];
                                            
                                        if($cross_staining_tolerance ==1.0)
                                        {
                                            $cross_staining_tolerance_value = '1';
                                        }
                                        elseif($cross_staining_tolerance ==1.5)
                                        {
                                            $cross_staining_tolerance_value = '1-2';
                                        }
                                        elseif($cross_staining_tolerance ==2.0)
                                        {
                                            $cross_staining_tolerance_value = '2';
                                        }
                                        elseif($cross_staining_tolerance ==2.5)
                                        {
                                            $cross_staining_tolerance_value = '2-3';
                                        }
                                        elseif($cross_staining_tolerance ==3.0)
                                        {
                                            $cross_staining_tolerance_value = '3';
                                        }
                                        elseif($cross_staining_tolerance ==3.5)
                                        {
                                            $cross_staining_tolerance_value = '3-4';
                                        }
                                        elseif($cross_staining_tolerance ==4.0)
                                        {
                                            $cross_staining_tolerance_value = '4';
                                        }
                                        elseif($cross_staining_tolerance ==4.5)
                                        {
                                            $cross_staining_tolerance_value = '4-5';
                                        }
                                        elseif($cross_staining_tolerance ==5.0)
                                        {
                                            $cross_staining_tolerance_value = '5';
                                        }                             // for define

                                        $cross_staining = $row_for_qc['cross_staining_value'];
                                        if($cross_staining == 1.0)
                                        {
                                            $cross_staining_value = '1';
                                        }
                                        elseif($cross_staining == 1.5)
                                        {
                                            $cross_staining_value = '1-2';
                                        }
                                        elseif($cross_staining == 2.0)
                                        {
                                            $cross_staining_value = '2';
                                        }
                                        elseif($cross_staining == 2.5)
                                        {
                                            $cross_staining_value = '2-3';
                                        }
                                        elseif($cross_staining == 3.0)
                                        {
                                            $cross_staining_value = '3';
                                        }
                                        elseif($cross_staining == 3.5)
                                        {
                                            $cross_staining_value = '3-5';
                                        }
                                        elseif($cross_staining == 4.0)
                                        {
                                            $cross_staining_value = '4';
                                        }
                                        elseif($cross_staining == 4.5)
                                        {
                                            $cross_staining_value = '4-5';
                                        }
                                        elseif($cross_staining == 5.0)
                                        {
                                            $cross_staining_value = '5';
                                        }  // for test result
                                    }


                                    $form.="<div class='form-group from-group-sm row'>
                                    <div class='col-sm-1'><b style='font-size: 20px;' >".$serial.".</b></div>
                                    <div class='col-sm-11' id='form-group_for_test_report_of_ikea'>
                                        <div class='col-sm-10'>
                                                <table class='table table-bordered'>
                                                
                                                            <thead>
                                                            <tr>
                                                                <label class='col-sm-12' for='name' style='font-size: 20px;' >".$row['test_name_method']." : </label>
                                                            </tr>
                                                            <tr>
                                                                <th class='text-center'>Result</th>
                                                                <th class='text-center'>Requirements</th>                                   
                                                            </tr>
                                                            
                                                            </thead>
                                                            <tbody>
                                                            <tr>
                                                            <td class='text-center'>".$cross_staining_value.' '.$row_for_defining_process['uom_of_cross_staining']."</td>
                                                            <td class='text-center'>".$row_for_defining_process['cross_staining_tolerance_range_math_operator'].' '.$cross_staining_tolerance_value.' '.$row_for_defining_process['uom_of_cross_staining']."</td>                                                            
                                                            </tr>
                                                            </tbody>
                                                        </table>
                                                    
                                                    </div>
                                                    </div>
                                                </div>";

                                }
                                echo $form;
                                $form = "";
                            }  /*End of if (in_array($row['id'], ['31']))*/

                            if (in_array($row['id'], ['32']))
                            {
                                
                                if ($row_for_defining_process['formaldehyde_content_max_value']<>0 && $row_for_qc['formaldehyde_content_value']<>0) 
                                {
                                    $serial+=1;
                                    $form.="<div class='form-group from-group-sm row'>
                                    <div class='col-sm-1'><b style='font-size: 20px;' >".$serial.".</b></div>
                                    <div class='col-sm-11' id='form-group_for_test_report_of_ikea'>
                                        <div class='col-sm-10'>
                                                <table class='table table-bordered'>
                                                
                                                            <thead>
                                                            <tr>
                                                                <label class='col-sm-12' for='name' style='font-size: 20px;' >".$row['test_name_method']." : </label>
                                                            </tr>
                                                            <tr>
                                                                <th class='text-center'>Result </th>
                                                                <th class='text-center'>Requirements</th>                                   
                                                            </tr>
                                                            
                                                            </thead>
                                                            <tbody>
                                                            <tr>
                                                            <td class='text-center'>".$row_for_qc['formaldehyde_content_value'].' '.$row_for_defining_process['uom_of_formaldehyde_content']."</td>
                                                            <td class='text-center'>".$row_for_defining_process['formaldehyde_content_tolerance_range_math_operator'].' '.$row_for_defining_process['formaldehyde_content_tolerance_value'].' '.$row_for_defining_process['uom_of_formaldehyde_content']."</td>
                                                            </tr>
                                                            </tbody>
                                                        </table>
                                                    
                                                    </div>
                                                    </div>
                                                </div>";

                                }
                                echo $form;
                                $form = "";
                            }  /*End of if (in_array($row['id'], ['32']))*/

                            if (in_array($row['id'], ['33']))
                            {
                                
                                if ($row_for_defining_process['ph_value_max_value']<>0 && $row_for_qc['ph_value']<>0) 
                                {
                                    $serial+=1;
                                    $form.="<div class='form-group from-group-sm row'>
                                    <div class='col-sm-1'><b style='font-size: 20px;' >".$serial.".</b></div>
                                    <div class='col-sm-11' id='form-group_for_test_report_of_ikea'>
                                        <div class='col-sm-10'>
                                                <table class='table table-bordered'>
                                                
                                                            <thead>
                                                            <tr>
                                                                <label class='col-sm-12' for='name' style='font-size: 20px;' >".$row['test_name_method']." : </label>
                                                            </tr>
                                                            <tr>
                                                                <th class='text-center'>Result </th>
                                                                <th class='text-center'>Requirements</th>                                   
                                                            </tr>
                                                            
                                                            </thead>
                                                            <tbody>
                                                            <tr>
                                                            <td class='text-center'>".$row_for_qc['ph_value']."</td>
                                                            <td class='text-center'>".$row_for_defining_process['ph_value_min_value'].' to '.$row_for_defining_process['ph_value_max_value']."</td>
                                                            </tr>
                                                            </tbody>
                                                        </table>
                                                    
                                                    </div>
                                                    </div>
                                                </div>";

                                }
                                echo $form;
                                $form = "";
                            }  /*End of if (in_array($row['id'], ['33']))*/

                            if (in_array($row['id'], ['34']))
                            {
                                
                                if ($row_for_defining_process['water_absorption_value_max_value']<>0 && $row_for_qc['water_absorption_value']<>0) 
                                {
                                    $serial+=1;
                                    $form.="<div class='form-group from-group-sm row'>
                                    <div class='col-sm-1'><b style='font-size: 20px;' >".$serial.".</b></div>
                                    <div class='col-sm-11' id='form-group_for_test_report_of_ikea'>
                                        <div class='col-sm-10'>
                                                <table class='table table-bordered'>
                                                
                                                            <thead>
                                                            <tr>
                                                                <label class='col-sm-12' for='name' style='font-size: 20px;' >".$row['test_name_method']." : </label>
                                                            </tr>
                                                            <tr>
                                                                <th class='text-center' colspan='2'>Result </th>
                                                                <th class='text-center'>Requirements</th>                                   
                                                            </tr>
                                                            
                                                            </thead>
                                                            <tbody>
                                                            <tr>
                                                                <th class='text-center' ></th>
                                                                <td class='text-center'>".$row_for_qc['water_absorption_value'].' '.$row_for_defining_process['uom_of_water_absorption_value']."</td>
                                                                <td class='text-center'>".$row_for_defining_process['water_absorption_value_tolerance_range_math_operator'].' '.$row_for_defining_process['water_absorption_value_tolerance_value'].' '.$row_for_defining_process['uom_of_water_absorption_value']."</td>
                                                            </tr>
                                                            <tr>
                                                                <th class='text-center' >Before Wash 30 Sec.</th>
                                                                <td class='text-center'>".$row_for_qc['water_absorption_b_wash_thirty_sec_value'].' '.$row_for_defining_process['uom_of_water_absorption_b_wash_thirty_sec']."</td>
                                                                <td class='text-center'>".$row_for_defining_process['water_absorption_b_wash_thirty_sec_tolerance_range_math_op'].' '.$row_for_defining_process['water_absorption_b_wash_thirty_sec_tolerance_value'].' '.$row_for_defining_process['uom_of_water_absorption_b_wash_thirty_sec']."</td>
                                                            </tr>
                                                            <tr>
                                                                <th class='text-center' >Before Wash</th>
                                                                <td class='text-center'>".$row_for_qc['water_absorption_b_wash_max_value'].' '.$row_for_defining_process['uom_of_water_absorption_b_wash_max']."</td>
                                                                <td class='text-center'>".$row_for_defining_process['water_absorption_b_wash_max_tolerance_range_math_op'].' '.$row_for_defining_process['water_absorption_b_wash_max_tolerance_value'].' '.$row_for_defining_process['uom_of_water_absorption_b_wash_max']."</td>
                                                            </tr>

                                                            <tr>
                                                                <th class='text-center' >After Wash 30 Sec.</th>
                                                                <td class='text-center'>".$row_for_qc['water_absorption_a_wash_thirty_sec_value'].' '.$row_for_defining_process['uom_of_water_absorption_a_wash_thirty_sec']."</td>
                                                                <td class='text-center'>".$row_for_defining_process['water_absorption_a_wash_thirty_sec_tolerance_range_math_op'].' '.$row_for_defining_process['water_absorption_a_wash_thirty_sec_tolerance_value'].' '.$row_for_defining_process['uom_of_water_absorption_a_wash_thirty_sec']."</td>
                                                            </tr>
                                                            </tbody>
                                                        </table>
                                                    
                                                    </div>
                                                    </div>
                                                </div>";

                                }
                                echo $form;
                                $form = "";
                            }  /*End of if (in_array($row['id'], ['34']))*/

                            if (in_array($row['id'], ['35']))
                            {
                                
                                if ($row_for_defining_process['wicking_test_max_value']<>0 && $row_for_qc['wicking_test_value']<>0) 
                                {
                                    $serial+=1;
                                    $form.="<div class='form-group from-group-sm row'>
                                    <div class='col-sm-1'><b style='font-size: 20px;' >".$serial.".</b></div>
                                    <div class='col-sm-11' id='form-group_for_test_report_of_ikea'>
                                        <div class='col-sm-10'>
                                                <table class='table table-bordered'>
                                                
                                                            <thead>
                                                            <tr>
                                                                <label class='col-sm-12' for='name' style='font-size: 20px;' >".$row['test_name_method']." : </label>
                                                            </tr>
                                                            <tr>
                                                                <th class='text-center'>Result </th>
                                                                <th class='text-center'>Requirements</th>                                   
                                                            </tr>
                                                            
                                                            </thead>
                                                            <tbody>
                                                            <tr>
                                                            <td class='text-center'>".$row_for_qc['wicking_test_value'].' '.$row_for_defining_process['uom_of_wicking_test']."</td>
                                                            <td class='text-center'>".$row_for_defining_process['wicking_test_tol_range_math_op'].' '.$row_for_defining_process['wicking_test_tolerance_value'].' '.$row_for_defining_process['uom_of_wicking_test']."</td>
                                                            </tr>
                                                            </tbody>
                                                        </table>
                                                    
                                                    </div>
                                                    </div>
                                                </div>";

                                }
                                echo $form;
                                $form = "";
                            }  /*End of if (in_array($row['id'], ['35']))*/

                            if (in_array($row['id'], ['36']))
                            {
                                
                                if ($row_for_defining_process['spirality_value_max_value']<>0 && $row_for_qc['spirality_value']<>0) 
                                {
                                    $serial+=1;
                                    $form.="<div class='form-group from-group-sm row'>
                                    <div class='col-sm-1'><b style='font-size: 20px;' >".$serial.".</b></div>
                                    <div class='col-sm-11' id='form-group_for_test_report_of_ikea'>
                                        <div class='col-sm-10'>
                                                <table class='table table-bordered'>
                                                
                                                            <thead>
                                                            <tr>
                                                                <label class='col-sm-12' for='name' style='font-size: 20px;' >".$row['test_name_method']." : </label>
                                                            </tr>
                                                            <tr>
                                                                <th class='text-center'>Result </th>
                                                                <th class='text-center'>Requirements</th>                                   
                                                            </tr>
                                                            
                                                            </thead>
                                                            <tbody>
                                                            <tr>
                                                            <td class='text-center'>".$row_for_qc['spirality_value'].' '.$row_for_defining_process['uom_of_spirality_value']."</td>
                                                            <td class='text-center'>".$row_for_defining_process['spirality_value_tolerance_range_math_operator'].' '.$row_for_defining_process['spirality_value_tolerance_value'].' '.$row_for_defining_process['uom_of_spirality_value']."</td>
                                                            </tr>
                                                            </tbody>
                                                        </table>
                                                    
                                                    </div>
                                                    </div>
                                                </div>";

                                }
                                echo $form;
                                $form = "";
                            }  /*End of if (in_array($row['id'], ['36']))*/

                            if (in_array($row['id'], ['37']))
                            {
                                
                                if ($row_for_defining_process['smoothness_appearance_max_value']<>0 && $row_for_qc['smoothness_appearance_value']<>0) 
                                {
                                    $serial+=1;
                                    $form.="<div class='form-group from-group-sm row'>
                                    <div class='col-sm-1'><b style='font-size: 20px;' >".$serial.".</b></div>
                                    <div class='col-sm-11' id='form-group_for_test_report_of_ikea'>
                                        <div class='col-sm-10'>
                                                <table class='table table-bordered'>
                                                
                                                            <thead>
                                                            <tr>
                                                                <label class='col-sm-12' for='name' style='font-size: 20px;' >".$row['test_name_method']." : </label>
                                                            </tr>
                                                            <tr>
                                                                <th class='text-center'>Result </th>
                                                                <th class='text-center'>Requirements</th>                                   
                                                            </tr>
                                                            
                                                            </thead>
                                                            <tbody>
                                                            <tr>
                                                            <td class='text-center'>".$row_for_qc['smoothness_appearance_value'].' '.$row_for_defining_process['uom_of_smoothness_appearance']."</td>
                                                            <td class='text-center'>".$row_for_defining_process['smoothness_appearance_tolerance_range_math_op'].' '.$row_for_defining_process['smoothness_appearance_tolerance_value'].' '.$row_for_defining_process['uom_of_smoothness_appearance']."</td>
                                                            </tr>
                                                            </tbody>
                                                        </table>
                                                    
                                                    </div>
                                                    </div>
                                                </div>";

                                }
                                echo $form;
                                $form = "";
                            }  /*End of if (in_array($row['id'], ['37']))*/

                            if (in_array($row['id'], ['38']))
                            {
                                
                                if ($row_for_defining_process['print_duribility_m_s_c_15_value']<>0 && $row_for_qc['print_duribility_value']<>0) 
                                {
                                    $serial+=1;
                                    $form.="<div class='form-group from-group-sm row'>
                                    <div class='col-sm-1'><b style='font-size: 20px;' >".$serial.".</b></div>
                                    <div class='col-sm-11' id='form-group_for_test_report_of_ikea'>
                                        <div class='col-sm-10'>
                                                <table class='table table-bordered'>
                                                
                                                            <thead>
                                                            <tr>
                                                                <label class='col-sm-12' for='name' style='font-size: 20px;' >".$row['test_name_method']." : </label>
                                                            </tr>
                                                            <tr>
                                                                <th class='text-center'>Result </th>
                                                                <th class='text-center'>Requirements</th>                                   
                                                            </tr>
                                                            
                                                            </thead>
                                                            <tbody>
                                                            <tr>
                                                            <td class='text-center'>".$row_for_qc['print_duribility_value']."</td>
                                                            <td class='text-center'>".$row_for_defining_process['print_duribility_m_s_c_15_value']."</td>
                                                            </tr>
                                                            </tbody>
                                                        </table>
                                                    
                                                    </div>
                                                    </div>
                                                </div>";

                                }
                                echo $form;
                                $form = "";
                            }  /*End of if (in_array($row['id'], ['38']))*/

                            if (in_array($row['id'], ['39']))
                            {
                                
                                if ($row_for_defining_process['iron_ability_of_woven_fabric_max_value']<>0 && $row_for_qc['iron_ability_of_woven_fabric_value']<>0) 
                                {
                                    $serial+=1;
                                    $form.="<div class='form-group from-group-sm row'>
                                    <div class='col-sm-1'><b style='font-size: 20px;' >".$serial.".</b></div>
                                    <div class='col-sm-11' id='form-group_for_test_report_of_ikea'>
                                        <div class='col-sm-10'>
                                                <table class='table table-bordered'>
                                                
                                                            <thead>
                                                            <tr>
                                                                <label class='col-sm-12' for='name' style='font-size: 20px;' >".$row['test_name_method']." : </label>
                                                            </tr>
                                                            <tr>
                                                                <th class='text-center'>Result </th>
                                                                <th class='text-center'>Requirements</th>                                   
                                                            </tr>
                                                            
                                                            </thead>
                                                            <tbody>
                                                            <tr>
                                                            <td class='text-center'>".$row_for_qc['iron_ability_of_woven_fabric_value'].' '.$row_for_defining_process['uom_of_iron_ability_of_woven_fabric']."</td>
                                                            <td class='text-center'>".$row_for_defining_process['iron_ability_of_woven_fabric_tolerance_range_math_op'].' '.$row_for_defining_process['iron_ability_of_woven_fabric_tolerance_value'].' '.$row_for_defining_process['uom_of_iron_ability_of_woven_fabric']."</td>
                                                            </tr>
                                                            </tbody>
                                                        </table>
                                                    
                                                    </div>
                                                    </div>
                                                </div>";

                                }
                                echo $form;
                                $form = "";
                            }  /*End of if (in_array($row['id'], ['39']))*/

                            if (in_array($row['id'], ['40']))
                            {
                                if($row_for_defining_process['color_fastess_to_artificial_daylight_max_value']<>0 && $row_for_qc['cf_to_artificial_day_light_value']<>0)
                                {   
                                    $serial+=1;
                                    if($customer_type == 'american')
                                    {
                                        $color_fastess_to_artificial_daylight_tolerance_value = $row_for_defining_process['color_fastess_to_artificial_daylight_tolerance_value'];
                                        $cf_to_artificial_day_light_value = $row_for_qc['cf_to_artificial_day_light_value'];
                                        $cf_to_light_shade_color_1_value = $row_for_qc['cf_to_light_shade_color_1_value'];
                                        $cf_to_light_shade_color_2_value = $row_for_qc['cf_to_light_shade_color_2_value'];
                                        $cf_to_light_shade_color_3_value = $row_for_qc['cf_to_light_shade_color_3_value'];
                                        $cf_to_light_shade_color_4_value = $row_for_qc['cf_to_light_shade_color_4_value'];
                                        $cf_to_light_shade_color_5_value = $row_for_qc['cf_to_light_shade_color_5_value'];
                                        $cf_to_light_shade_color_6_value = $row_for_qc['cf_to_light_shade_color_6_value'];
                                        $cf_to_light_shade_color_7_value = $row_for_qc['cf_to_light_shade_color_7_value'];


                                    }
                                    if($customer_type == 'european')
                                    {
                                        $color_fastess_to_artificial_daylight_tolerance = $row_for_defining_process['color_fastess_to_artificial_daylight_tolerance_value'];
                                        
                                        if($color_fastess_to_artificial_daylight_tolerance ==1.0)
                                        {
                                            $color_fastess_to_artificial_daylight_tolerance_value = '1';
                                        }
                                        elseif($color_fastess_to_artificial_daylight_tolerance ==1.5)
                                        {
                                            $color_fastess_to_artificial_daylight_tolerance_value = '1-2';
                                        }
                                        elseif($color_fastess_to_artificial_daylight_tolerance ==2.0)
                                        {
                                            $color_fastess_to_artificial_daylight_tolerance_value = '2';
                                        }
                                        elseif($color_fastess_to_artificial_daylight_tolerance ==2.5)
                                        {
                                            $color_fastess_to_artificial_daylight_tolerance_value = '2-3';
                                        }
                                        elseif($color_fastess_to_artificial_daylight_tolerance ==3.0)
                                        {
                                            $color_fastess_to_artificial_daylight_tolerance_value = '3';
                                        }
                                        elseif($color_fastess_to_artificial_daylight_tolerance ==3.5)
                                        {
                                            $color_fastess_to_artificial_daylight_tolerance_value = '3-4';
                                        }
                                        elseif($color_fastess_to_artificial_daylight_tolerance ==4.0)
                                        {
                                            $color_fastess_to_artificial_daylight_tolerance_value = '4';
                                        }
                                        elseif($color_fastess_to_artificial_daylight_tolerance ==4.5)
                                        {
                                            $color_fastess_to_artificial_daylight_tolerance_value = '4-5';
                                        }
                                        elseif($color_fastess_to_artificial_daylight_tolerance ==5.0)
                                        {
                                            $color_fastess_to_artificial_daylight_tolerance_value = '5';
                                        }
                                        elseif($color_fastess_to_artificial_daylight_tolerance ==5.5)
                                        {
                                            $color_fastess_to_artificial_daylight_tolerance_value = '5-6';
                                        }
                                        elseif($color_fastess_to_artificial_daylight_tolerance ==6.0)
                                        {
                                            $color_fastess_to_artificial_daylight_tolerance_value = '6';
                                        }
                                        elseif($color_fastess_to_artificial_daylight_tolerance ==6.5)
                                        {
                                            $color_fastess_to_artificial_daylight_tolerance_value = '6-7';
                                        }
                                        elseif($color_fastess_to_artificial_daylight_tolerance ==7.0)
                                        {
                                            $color_fastess_to_artificial_daylight_tolerance_value = '7';
                                        }
                                        elseif($color_fastess_to_artificial_daylight_tolerance ==7.5)
                                        {
                                            $color_fastess_to_artificial_daylight_tolerance_value = '7-8';
                                        }
                                        elseif($color_fastess_to_artificial_daylight_tolerance ==8.0)
                                        {
                                            $color_fastess_to_artificial_daylight_tolerance_value = '8';
                                        }               // defining value
            
                                        $cf_to_artificial_day_light = $row_for_qc['cf_to_artificial_day_light_value'];
                                
                                        if($cf_to_artificial_day_light ==1.0)
                                        {
                                            $cf_to_artificial_day_light_value = '1';
                                        }
                                        elseif($cf_to_artificial_day_light ==1.5)
                                        {
                                            $cf_to_artificial_day_light_value = '1-2';
                                        }
                                        elseif($cf_to_artificial_day_light ==2.0)
                                        {
                                            $cf_to_artificial_day_light_value = '2';
                                        }
                                        elseif($cf_to_artificial_day_light ==2.5)
                                        {
                                            $cf_to_artificial_day_light_value = '2-3';
                                        }
                                        elseif($cf_to_artificial_day_light ==3.0)
                                        {
                                            $cf_to_artificial_day_light_value = '3';
                                        }
                                        elseif($cf_to_artificial_day_light ==3.5)
                                        {
                                            $cf_to_artificial_day_light_value = '3-4';
                                        }
                                        elseif($cf_to_artificial_day_light ==4.0)
                                        {
                                            $cf_to_artificial_day_light_value = '4';
                                        }
                                        elseif($cf_to_artificial_day_light ==4.5)
                                        {
                                            $cf_to_artificial_day_light_value = '4-5';
                                        }
                                        elseif($cf_to_artificial_day_light ==5.0)
                                        {
                                            $cf_to_artificial_day_light_value = '5';
                                        } 	
                                        elseif($cf_to_artificial_day_light ==5.5)
                                        {
                                            $cf_to_artificial_day_light_value = '5-6';
                                        }
                                        elseif($cf_to_artificial_day_light ==6.0)
                                        {
                                            $cf_to_artificial_day_light_value = '6';
                                        }
                                        elseif($cf_to_artificial_day_light ==6.5)
                                        {
                                            $cf_to_artificial_day_light_value = '6-7';
                                        }
                                        elseif($cf_to_artificial_day_light ==7.0)
                                        {
                                            $cf_to_artificial_day_light_value = '7';
                                        } 
                                        elseif($cf_to_artificial_day_light ==7.5)
                                        {
                                            $cf_to_artificial_day_light_value = '7-8';
                                        }
                                        elseif($cf_to_artificial_day_light ==8.0)
                                        {
                                            $cf_to_artificial_day_light_value = '8';
                                        }		 // for test result

                                                        // color 1
                                        $cf_to_light_shade_color_1 = $row_for_qc['cf_to_light_shade_color_1_value'];
                                
                                        if($cf_to_light_shade_color_1 ==1.0)
                                        {
                                            $cf_to_light_shade_color_1_value = '1';
                                        }
                                        elseif($cf_to_light_shade_color_1 ==1.5)
                                        {
                                            $cf_to_light_shade_color_1_value = '1-2';
                                        }
                                        elseif($cf_to_light_shade_color_1 ==2.0)
                                        {
                                            $cf_to_light_shade_color_1_value = '2';
                                        }
                                        elseif($cf_to_light_shade_color_1 ==2.5)
                                        {
                                            $cf_to_light_shade_color_1_value = '2-3';
                                        }
                                        elseif($cf_to_light_shade_color_1 ==3.0)
                                        {
                                            $cf_to_light_shade_color_1_value = '3';
                                        }
                                        elseif($cf_to_light_shade_color_1 ==3.5)
                                        {
                                            $cf_to_light_shade_color_1_value = '3-4';
                                        }
                                        elseif($cf_to_light_shade_color_1 ==4.0)
                                        {
                                            $cf_to_light_shade_color_1_value = '4';
                                        }
                                        elseif($cf_to_light_shade_color_1 ==4.5)
                                        {
                                            $cf_to_light_shade_color_1_value = '4-5';
                                        }
                                        elseif($cf_to_light_shade_color_1 ==5.0)
                                        {
                                            $cf_to_light_shade_color_1_value = '5';
                                        } 	
                                        elseif($cf_to_light_shade_color_1 ==5.5)
                                        {
                                            $cf_to_light_shade_color_1_value = '5-6';
                                        }
                                        elseif($cf_to_light_shade_color_1 ==6.0)
                                        {
                                            $cf_to_light_shade_color_1_value = '6';
                                        }
                                        elseif($cf_to_light_shade_color_1 ==6.5)
                                        {
                                            $cf_to_light_shade_color_1_value = '6-7';
                                        }
                                        elseif($cf_to_light_shade_color_1 ==7.0)
                                        {
                                            $cf_to_light_shade_color_1_value = '7';
                                        } 
                                        elseif($cf_to_light_shade_color_1 ==7.5)
                                        {
                                            $cf_to_light_shade_color_1_value = '7-8';
                                        }
                                        elseif($cf_to_light_shade_color_1 ==8.0)
                                        {
                                            $cf_to_light_shade_color_1_value = '8';
                                        }

                                        // color 2
                                        $cf_to_light_shade_color_2 = $row_for_qc['cf_to_light_shade_color_2_value'];
                
                                        if($cf_to_light_shade_color_2 ==1.0)
                                        {
                                            $cf_to_light_shade_color_2_value = '1';
                                        }
                                        elseif($cf_to_light_shade_color_2 ==1.5)
                                        {
                                            $cf_to_light_shade_color_2_value = '1-2';
                                        }
                                        elseif($cf_to_light_shade_color_2 ==2.0)
                                        {
                                            $cf_to_light_shade_color_2_value = '2';
                                        }
                                        elseif($cf_to_light_shade_color_2 ==2.5)
                                        {
                                            $cf_to_light_shade_color_2_value = '2-3';
                                        }
                                        elseif($cf_to_light_shade_color_2 ==3.0)
                                        {
                                            $cf_to_light_shade_color_2_value = '3';
                                        }
                                        elseif($cf_to_light_shade_color_2 ==3.5)
                                        {
                                            $cf_to_light_shade_color_2_value = '3-4';
                                        }
                                        elseif($cf_to_light_shade_color_2 ==4.0)
                                        {
                                            $cf_to_light_shade_color_2_value = '4';
                                        }
                                        elseif($cf_to_light_shade_color_2 ==4.5)
                                        {
                                            $cf_to_light_shade_color_2_value = '4-5';
                                        }
                                        elseif($cf_to_light_shade_color_2 ==5.0)
                                        {
                                            $cf_to_light_shade_color_2_value = '5';
                                        } 	
                                        elseif($cf_to_light_shade_color_2 ==5.5)
                                        {
                                            $cf_to_light_shade_color_2_value = '5-6';
                                        }
                                        elseif($cf_to_light_shade_color_2 ==6.0)
                                        {
                                            $cf_to_light_shade_color_2_value = '6';
                                        }
                                        elseif($cf_to_light_shade_color_2 ==6.5)
                                        {
                                            $cf_to_light_shade_color_2_value = '6-7';
                                        }
                                        elseif($cf_to_light_shade_color_2 ==7.0)
                                        {
                                            $cf_to_light_shade_color_2_value = '7';
                                        } 
                                        elseif($cf_to_light_shade_color_2 ==7.5)
                                        {
                                            $cf_to_light_shade_color_2_value = '7-8';
                                        }
                                        elseif($cf_to_light_shade_color_2 ==8.0)
                                        {
                                            $cf_to_light_shade_color_2_value = '8';
                                        }

                                                                        // color 3
                                        $cf_to_light_shade_color_3 = $row_for_qc['cf_to_light_shade_color_3_value'];
                                
                                        if($cf_to_light_shade_color_3 ==1.0)
                                        {
                                            $cf_to_light_shade_color_3_value = '1';
                                        }
                                        elseif($cf_to_light_shade_color_3 ==1.5)
                                        {
                                            $cf_to_light_shade_color_3_value = '1-2';
                                        }
                                        elseif($cf_to_light_shade_color_3 ==2.0)
                                        {
                                            $cf_to_light_shade_color_3_value = '2';
                                        }
                                        elseif($cf_to_light_shade_color_3 ==2.5)
                                        {
                                            $cf_to_light_shade_color_3_value = '2-3';
                                        }
                                        elseif($cf_to_light_shade_color_3 ==3.0)
                                        {
                                            $cf_to_light_shade_color_3_value = '3';
                                        }
                                        elseif($cf_to_light_shade_color_3 ==3.5)
                                        {
                                            $cf_to_light_shade_color_3_value = '3-4';
                                        }
                                        elseif($cf_to_light_shade_color_3 ==4.0)
                                        {
                                            $cf_to_light_shade_color_3_value = '4';
                                        }
                                        elseif($cf_to_light_shade_color_3 ==4.5)
                                        {
                                            $cf_to_light_shade_color_3_value = '4-5';
                                        }
                                        elseif($cf_to_light_shade_color_3 ==5.0)
                                        {
                                            $cf_to_light_shade_color_3_value = '5';
                                        } 	
                                        elseif($cf_to_light_shade_color_3 ==5.5)
                                        {
                                            $cf_to_light_shade_color_3_value = '5-6';
                                        }
                                        elseif($cf_to_light_shade_color_3 ==6.0)
                                        {
                                            $cf_to_light_shade_color_3_value = '6';
                                        }
                                        elseif($cf_to_light_shade_color_3 ==6.5)
                                        {
                                            $cf_to_light_shade_color_3_value = '6-7';
                                        }
                                        elseif($cf_to_light_shade_color_3 ==7.0)
                                        {
                                            $cf_to_light_shade_color_3_value = '7';
                                        } 
                                        elseif($cf_to_light_shade_color_3 ==7.5)
                                        {
                                            $cf_to_light_shade_color_3_value = '7-8';
                                        }
                                        elseif($cf_to_light_shade_color_3 ==8.0)
                                        {
                                            $cf_to_light_shade_color_3_value = '8';
                                        }

                                        // color 4
                                        $cf_to_light_shade_color_4 = $row_for_qc['cf_to_light_shade_color_4_value'];
                
                                        if($cf_to_light_shade_color_4 ==1.0)
                                        {
                                            $cf_to_light_shade_color_4_value = '1';
                                        }
                                        elseif($cf_to_light_shade_color_4 ==1.5)
                                        {
                                            $cf_to_light_shade_color_4_value = '1-2';
                                        }
                                        elseif($cf_to_light_shade_color_4 ==2.0)
                                        {
                                            $cf_to_light_shade_color_4_value = '2';
                                        }
                                        elseif($cf_to_light_shade_color_4 ==2.5)
                                        {
                                            $cf_to_light_shade_color_4_value = '2-3';
                                        }
                                        elseif($cf_to_light_shade_color_4 ==3.0)
                                        {
                                            $cf_to_light_shade_color_4_value = '3';
                                        }
                                        elseif($cf_to_light_shade_color_4 ==3.5)
                                        {
                                            $cf_to_light_shade_color_4_value = '3-4';
                                        }
                                        elseif($cf_to_light_shade_color_4 ==4.0)
                                        {
                                            $cf_to_light_shade_color_4_value = '4';
                                        }
                                        elseif($cf_to_light_shade_color_4 ==4.5)
                                        {
                                            $cf_to_light_shade_color_4_value = '4-5';
                                        }
                                        elseif($cf_to_light_shade_color_4 ==5.0)
                                        {
                                            $cf_to_light_shade_color_4_value = '5';
                                        } 	
                                        elseif($cf_to_light_shade_color_4 ==5.5)
                                        {
                                            $cf_to_light_shade_color_4_value = '5-6';
                                        }
                                        elseif($cf_to_light_shade_color_4 ==6.0)
                                        {
                                            $cf_to_light_shade_color_4_value = '6';
                                        }
                                        elseif($cf_to_light_shade_color_4 ==6.5)
                                        {
                                            $cf_to_light_shade_color_4_value = '6-7';
                                        }
                                        elseif($cf_to_light_shade_color_4 ==7.0)
                                        {
                                            $cf_to_light_shade_color_4_value = '7';
                                        } 
                                        elseif($cf_to_light_shade_color_4 ==7.5)
                                        {
                                            $cf_to_light_shade_color_4_value = '7-8';
                                        }
                                        elseif($cf_to_light_shade_color_4 ==8.0)
                                        {
                                            $cf_to_light_shade_color_4_value = '8';
                                        }

                                                                        // color 5
                                        $cf_to_light_shade_color_5 = $row_for_qc['cf_to_light_shade_color_5_value'];
                                
                                        if($cf_to_light_shade_color_5 ==1.0)
                                        {
                                            $cf_to_light_shade_color_5_value = '1';
                                        }
                                        elseif($cf_to_light_shade_color_5 ==1.5)
                                        {
                                            $cf_to_light_shade_color_5_value = '1-2';
                                        }
                                        elseif($cf_to_light_shade_color_5 ==2.0)
                                        {
                                            $cf_to_light_shade_color_5_value = '2';
                                        }
                                        elseif($cf_to_light_shade_color_5 ==2.5)
                                        {
                                            $cf_to_light_shade_color_5_value = '2-3';
                                        }
                                        elseif($cf_to_light_shade_color_5 ==3.0)
                                        {
                                            $cf_to_light_shade_color_5_value = '3';
                                        }
                                        elseif($cf_to_light_shade_color_5 ==3.5)
                                        {
                                            $cf_to_light_shade_color_5_value = '3-4';
                                        }
                                        elseif($cf_to_light_shade_color_5 ==4.0)
                                        {
                                            $cf_to_light_shade_color_5_value = '4';
                                        }
                                        elseif($cf_to_light_shade_color_5 ==4.5)
                                        {
                                            $cf_to_light_shade_color_5_value = '4-5';
                                        }
                                        elseif($cf_to_light_shade_color_5 ==5.0)
                                        {
                                            $cf_to_light_shade_color_5_value = '5';
                                        } 	
                                        elseif($cf_to_light_shade_color_5 ==5.5)
                                        {
                                            $cf_to_light_shade_color_5_value = '5-6';
                                        }
                                        elseif($cf_to_light_shade_color_5 ==6.0)
                                        {
                                            $cf_to_light_shade_color_5_value = '6';
                                        }
                                        elseif($cf_to_light_shade_color_5 ==6.5)
                                        {
                                            $cf_to_light_shade_color_5_value = '6-7';
                                        }
                                        elseif($cf_to_light_shade_color_5 ==7.0)
                                        {
                                            $cf_to_light_shade_color_5_value = '7';
                                        } 
                                        elseif($cf_to_light_shade_color_5 ==7.5)
                                        {
                                            $cf_to_light_shade_color_5_value = '7-8';
                                        }
                                        elseif($cf_to_light_shade_color_5 ==8.0)
                                        {
                                            $cf_to_light_shade_color_5_value = '8';
                                        }

                                        // color 6
                                        $cf_to_light_shade_color_6 = $row_for_qc['cf_to_light_shade_color_6_value'];
                
                                        if($cf_to_light_shade_color_6 ==1.0)
                                        {
                                            $cf_to_light_shade_color_6_value = '1';
                                        }
                                        elseif($cf_to_light_shade_color_6 ==1.5)
                                        {
                                            $cf_to_light_shade_color_6_value = '1-2';
                                        }
                                        elseif($cf_to_light_shade_color_6 ==2.0)
                                        {
                                            $cf_to_light_shade_color_6_value = '2';
                                        }
                                        elseif($cf_to_light_shade_color_6 ==2.5)
                                        {
                                            $cf_to_light_shade_color_6_value = '2-3';
                                        }
                                        elseif($cf_to_light_shade_color_6 ==3.0)
                                        {
                                            $cf_to_light_shade_color_6_value = '3';
                                        }
                                        elseif($cf_to_light_shade_color_6 ==3.5)
                                        {
                                            $cf_to_light_shade_color_6_value = '3-4';
                                        }
                                        elseif($cf_to_light_shade_color_6 ==4.0)
                                        {
                                            $cf_to_light_shade_color_6_value = '4';
                                        }
                                        elseif($cf_to_light_shade_color_6 ==4.5)
                                        {
                                            $cf_to_light_shade_color_6_value = '4-5';
                                        }
                                        elseif($cf_to_light_shade_color_6 ==5.0)
                                        {
                                            $cf_to_light_shade_color_6_value = '5';
                                        } 	
                                        elseif($cf_to_light_shade_color_6 ==5.5)
                                        {
                                            $cf_to_light_shade_color_6_value = '5-6';
                                        }
                                        elseif($cf_to_light_shade_color_6 ==6.0)
                                        {
                                            $cf_to_light_shade_color_6_value = '6';
                                        }
                                        elseif($cf_to_light_shade_color_6 ==6.5)
                                        {
                                            $cf_to_light_shade_color_6_value = '6-7';
                                        }
                                        elseif($cf_to_light_shade_color_6 ==7.0)
                                        {
                                            $cf_to_light_shade_color_6_value = '7';
                                        } 
                                        elseif($cf_to_light_shade_color_6 ==7.5)
                                        {
                                            $cf_to_light_shade_color_6_value = '7-8';
                                        }
                                        elseif($cf_to_light_shade_color_6 ==8.0)
                                        {
                                            $cf_to_light_shade_color_6_value = '8';
                                        }

                                                                        // color 7
                                        $cf_to_light_shade_color_7 = $row_for_qc['cf_to_light_shade_color_7_value'];
                                
                                        if($cf_to_light_shade_color_7 ==1.0)
                                        {
                                            $cf_to_light_shade_color_7_value = '1';
                                        }
                                        elseif($cf_to_light_shade_color_7 ==1.5)
                                        {
                                            $cf_to_light_shade_color_7_value = '1-2';
                                        }
                                        elseif($cf_to_light_shade_color_7 ==2.0)
                                        {
                                            $cf_to_light_shade_color_7_value = '2';
                                        }
                                        elseif($cf_to_light_shade_color_7 ==2.5)
                                        {
                                            $cf_to_light_shade_color_7_value = '2-3';
                                        }
                                        elseif($cf_to_light_shade_color_7 ==3.0)
                                        {
                                            $cf_to_light_shade_color_7_value = '3';
                                        }
                                        elseif($cf_to_light_shade_color_7 ==3.5)
                                        {
                                            $cf_to_light_shade_color_7_value = '3-4';
                                        }
                                        elseif($cf_to_light_shade_color_7 ==4.0)
                                        {
                                            $cf_to_light_shade_color_7_value = '4';
                                        }
                                        elseif($cf_to_light_shade_color_7 ==4.5)
                                        {
                                            $cf_to_light_shade_color_7_value = '4-5';
                                        }
                                        elseif($cf_to_light_shade_color_7 ==5.0)
                                        {
                                            $cf_to_light_shade_color_7_value = '5';
                                        } 	
                                        elseif($cf_to_light_shade_color_7 ==5.5)
                                        {
                                            $cf_to_light_shade_color_7_value = '5-6';
                                        }
                                        elseif($cf_to_light_shade_color_7 ==6.0)
                                        {
                                            $cf_to_light_shade_color_7_value = '6';
                                        }
                                        elseif($cf_to_light_shade_color_7 ==6.5)
                                        {
                                            $cf_to_light_shade_color_7_value = '6-7';
                                        }
                                        elseif($cf_to_light_shade_color_7 ==7.0)
                                        {
                                            $cf_to_light_shade_color_7_value = '7';
                                        } 
                                        elseif($cf_to_light_shade_color_7 ==7.5)
                                        {
                                            $cf_to_light_shade_color_7_value = '7-8';
                                        }
                                        elseif($cf_to_light_shade_color_7 ==8.0)
                                        {
                                            $cf_to_light_shade_color_7_value = '8';
                                        }
                                    }
                                    $form.="
                                    <div class='form-group from-group-sm row'>
                                        <div class='col-sm-1'><b style='font-size: 20px;' >".$serial.".</b></div>
                                        <div class='col-sm-11' id='form-group_for_test_report_of_ikea'>
                                            <div class='col-sm-10'>
                                                    <table class='table table-bordered'>
                                                        <thead>
                                                        <tr>
                                                            <label class='col-sm-12' for='name' style='font-size: 20px;' >  ".$row['test_name_method'].": </label>
                                                        </tr>
                                                        <tr>
                                                            <th class='text-center' colspan='8'>Result</th>
                                                            <th class='text-center' colspan='2'>Requirements</th>                                   
                                                        </tr>
                                                        <tr>
                                                            <th class='text-center' rowspan='2'>Color Change</th>
                                                            <th class='text-center' colspan='7'>Shade Change</th>
                                                            <th class='text-center' rowspan='2'>Shade Change</th>
                                                        </tr>
                                                        <tr>
                                                            
                                                            <th class='text-center'>".$row_for_qc['cf_to_light_shade_color_1']."</th>
                                                            <th class='text-center'>".$row_for_qc['cf_to_light_shade_color_2']."</th>
                                                            <th class='text-center'>".$row_for_qc['cf_to_light_shade_color_3']."</th>
                                                            <th class='text-center'>".$row_for_qc['cf_to_light_shade_color_4']."</th>
                                                            <th class='text-center'>".$row_for_qc['cf_to_light_shade_color_5']."</th>
                                                            <th class='text-center'>".$row_for_qc['cf_to_light_shade_color_6']."</th>
                                                            <th class='text-center'>".$row_for_qc['cf_to_light_shade_color_7']."</th>


                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td class='text-center'>".$cf_to_artificial_day_light_value."</td>
                                                                <td class='text-center'>".$cf_to_light_shade_color_1_value."</td>
                                                                <td class='text-center'>".$cf_to_light_shade_color_2_value."</td>
                                                                <td class='text-center'>".$cf_to_light_shade_color_3_value."</td>
                                                                <td class='text-center'>".$cf_to_light_shade_color_4_value."</td>
                                                                <td class='text-center'>".$cf_to_light_shade_color_5_value."</td>
                                                                <td class='text-center'>".$cf_to_light_shade_color_6_value."</td>
                                                                <td class='text-center'>".$cf_to_light_shade_color_7_value."</td>

                                                                <td class='text-center'>".$row_for_defining_process['color_fastess_to_artificial_daylight_tolerance_range_math_op'].''.$color_fastess_to_artificial_daylight_tolerance_value."</td>
                                                            </tr>

                                                        
                                                        
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>";
        
                                }
                                echo $form;
                                $form = "";
                            }  /*End of if (in_array($row['id'], ['39']))*/

                            if (in_array($row['id'], ['41']))
                            {
                                
                                if ($row_for_defining_process['moisture_content_max_value']<>0 && $row_for_qc['moisture_content_value']<>0) 
                                {
                                    $serial+=1;
                                    $form.="<div class='form-group from-group-sm row'>
                                    <div class='col-sm-1'><b style='font-size: 20px;' >".$serial.".</b></div>
                                    <div class='col-sm-11' id='form-group_for_test_report_of_ikea'>
                                        <div class='col-sm-10'>
                                                <table class='table table-bordered'>
                                                
                                                            <thead>
                                                            <tr>
                                                                <label class='col-sm-12' for='name' style='font-size: 20px;' >".$row['test_name_method']." : </label>
                                                            </tr>
                                                            <tr>
                                                                <th class='text-center'>Result </th>
                                                                <th class='text-center'>Requirements</th>                                   
                                                            </tr>
                                                            
                                                            </thead>
                                                            <tbody>
                                                            <tr>
                                                            <td class='text-center'>".$row_for_qc['moisture_content_value'].' '.$row_for_defining_process['uom_of_moisture_content']."</td>
                                                            <td class='text-center'>".$row_for_defining_process['moisture_content_tolerance_range_math_op'].' '.$row_for_defining_process['moisture_content_tolerance_value'].' '.$row_for_defining_process['uom_of_moisture_content']."</td>
                                                            </tr>
                                                            </tbody>
                                                        </table>
                                                    
                                                    </div>
                                                    </div>
                                                </div>";

                                }
                                echo $form;
                                $form = "";
                            }  /*End of if (in_array($row['id'], ['41']))*/

                            if (in_array($row['id'], ['42']))
                            {
                                
                                if ($row_for_defining_process['evaporation_rate_quick_drying_max_value']<>0 && $row_for_qc['evaporation_rate_quick_drying_value']<>0) 
                                {
                                    $serial+=1;
                                    $form.="<div class='form-group from-group-sm row'>
                                    <div class='col-sm-1'><b style='font-size: 20px;' >".$serial.".</b></div>
                                    <div class='col-sm-11' id='form-group_for_test_report_of_ikea'>
                                        <div class='col-sm-10'>
                                                <table class='table table-bordered'>
                                                
                                                            <thead>
                                                            <tr>
                                                                <label class='col-sm-12' for='name' style='font-size: 20px;' >".$row['test_name_method']." : </label>
                                                            </tr>
                                                            <tr>
                                                                <th class='text-center'>Result </th>
                                                                <th class='text-center'>Requirements</th>                                   
                                                            </tr>
                                                            
                                                            </thead>
                                                            <tbody>
                                                            <tr>
                                                            <td class='text-center'>".$row_for_qc['evaporation_rate_quick_drying_value'].' '.$row_for_defining_process['uom_of_evaporation_rate_quick_drying']."</td>
                                                            <td class='text-center'>".$row_for_defining_process['evaporation_rate_quick_drying_tolerance_range_math_op'].' '.$row_for_defining_process['evaporation_rate_quick_drying_tolerance_value'].' '.$row_for_defining_process['uom_of_evaporation_rate_quick_drying']."</td>
                                                            </tr>
                                                            </tbody>
                                                        </table>
                                                    
                                                    </div>
                                                    </div>
                                                </div>";

                                }
                                echo $form;
                                $form = "";
                            }  /*End of if (in_array($row['id'], ['42']))*/

                            if (in_array($row['id'], ['43']))
                            {
                                if (($row_for_defining_process['percentage_of_total_cotton_content_max_value']<>0 && $row_for_qc['total_cotton_content_value']<>0) || ($row_for_defining_process['percentage_of_warp_cotton_content_max_value']<>0 && $row_for_qc['warp_cotton_content_value']<>0) || ($row_for_defining_process['percentage_of_weft_cotton_content_max_value']<>0 && $row_for_qc['weft_cotton_content_value']<>0) ) 
                                {
                                    $serial+=1;
                                    $form.="<div class='form-group from-group-sm row'>
                                                <div class='col-sm-1'><b style='font-size: 20px;' >".$serial.".</b></div>
                                                <div class='col-sm-11' id='form-group_for_test_report_of_ikea'>
                                                    <div class='col-sm-10'>
                                                    <table class='table table-bordered'>
                                                
                                                            <thead>
                                                            <tr>
                                                                <label class='col-sm-12' for='name' style='font-size: 20px;' >".$row['test_name_method']." : </label>
                                                            </tr>
                                                            <tr>
                                                            <th class='text-center' >Assessment Criteria </th>
                                                            <th class='text-center' >Result </th>
                                                                <th class='text-center'>Requirements</th>                                   
                                                            </tr>
                                                            
                                                            </thead>
                                                            <tbody>";
                                    

                                    if ($row_for_defining_process['percentage_of_total_cotton_content_max_value']<>0 && $row_for_qc['total_cotton_content_value']<>0)
                                    {
                                        $form.=" <tr>
                                                <th >Total Cotton </th>
                                                <td class='text-center'>".$row_for_qc['total_cotton_content_value'].' '.$row_for_defining_process['uom_of_percentage_of_total_cotton_content']."</td>
                                                <td class='text-center'>".$row_for_defining_process['percentage_of_total_cotton_content_value'].'  '.$row_for_defining_process['percentage_of_total_cotton_content_tolerance_range_math_operator'].'  '.$row_for_defining_process['percentage_of_total_cotton_content_tolerance_value']." %</td>
                                            </tr>
                                            <tr>
                                                <th >Total Polyester </th>
                                                <td class='text-center'>".$row_for_qc['total_total_Polyester_content_value'].' '.$row_for_defining_process['uom_of_percentage_of_total_polyester_content']."</td>
                                                <td class='text-center'>".$row_for_defining_process['percentage_of_total_polyester_content_value'].'  '.$row_for_defining_process['percentage_of_total_polyester_content_tolerance_range_math_op'].'  '.$row_for_defining_process['percentage_of_total_polyester_content_tolerance_value']." %</td>
                                            </tr>
                                            <tr>
                                                <th >Total Other Fiber </th>
                                                <td class='text-center'>".$row_for_qc['total_other_fiber_value'].' '.$row_for_defining_process['uom_of_percentage_of_total_other_fiber_content']."</td>
                                                <td class='text-center'>".$row_for_defining_process['percentage_of_total_other_fiber_content_value'].'  '.$row_for_defining_process['percentage_of_total_other_fiber_content_tolerance_range_math_op'].'  '.$row_for_defining_process['percentage_of_total_other_fiber_content_tolerance_value']." %</td>
                                            </tr>";
                                    }

                                    if ($row_for_defining_process['percentage_of_warp_cotton_content_max_value']<>0 && $row_for_qc['warp_cotton_content_value']<>0)
                                    {
                                        $form.="<tr>
                                        <th >Warp Cotton</th>
                                        <td class='text-center'>".$row_for_qc['warp_cotton_content_value'].' '.$row_for_defining_process['uom_of_percentage_of_warp_cotton_content']."</td>
                                        <td class='text-center'>".$row_for_defining_process['percentage_of_warp_cotton_content_value'].'  '.$row_for_defining_process['percentage_of_warp_cotton_content_tolerance_range_math_operator'].'  '.$row_for_defining_process['percentage_of_warp_cotton_content_tolerance_value']." %</td>
                                        </tr>

                                        <tr>
                                            <th >Warp Polyester</th>
                                            <td class='text-center'>".$row_for_qc['warp_Polyester_content_value'].' '.$row_for_defining_process['uom_of_percentage_of_warp_polyester_content']."</td>
                                            <td class='text-center'>".$row_for_defining_process['percentage_of_warp_polyester_content_value'].'  '.$row_for_defining_process['percentage_of_warp_polyester_content_tolerance_range_math_op'].'  '.$row_for_defining_process['percentage_of_warp_polyester_content_tolerance_value']." %</td>
                                        </tr>

                                        <tr>
                                            <th >Warp Other Fiber</th>
                                            <td class='text-center'>".$row_for_qc['warp_other_fiber_value'].' '.$row_for_defining_process['uom_of_percentage_of_warp_other_fiber_content']."</td>
                                            <td class='text-center'>".$row_for_defining_process['percentage_of_warp_other_fiber_content_value'].'  '.$row_for_defining_process['percentage_of_warp_other_fiber_content_tolerance_range_math_op'].'  '.$row_for_defining_process['percentage_of_warp_other_fiber_content_tolerance_value']." %</td>
                                        </tr>";
                                    }

                                    if ($row_for_defining_process['percentage_of_weft_cotton_content_max_value']<>0 && $row_for_qc['weft_cotton_content_value']<>0)
                                    {
                                        $form.="<tr>
                                        <th >(Weft Cotton</th>
                                        <td class='text-center'>".$row_for_qc['weft_cotton_content_value'].' '.$row_for_defining_process['uom_of_percentage_of_weft_cotton_content']."</td>
                                        <td class='text-center'>".$row_for_defining_process['percentage_of_weft_cotton_content_value'].'  '.$row_for_defining_process['percentage_of_weft_cotton_content_tolerance_range_math_op'].'  '.$row_for_defining_process['percentage_of_weft_cotton_content_tolerance_value']." %</td>
                                        </tr>
                                        <tr>
                                            <th >(Weft Polyester</th>
                                            <td class='text-center'>".$row_for_qc['weft_Polyester_content_value'].' '.$row_for_defining_process['uom_of_percentage_of_weft_polyester_content']."</td>
                                            <td class='text-center'>".$row_for_defining_process['percentage_of_weft_polyester_content_value'].'  '.$row_for_defining_process['percentage_of_weft_polyester_content_tolerance_range_math_op'].'  '.$row_for_defining_process['percentage_of_weft_polyester_content_tolerance_value']." %</td>
                                        </tr>
                                        <tr>
                                            <th >(Weft Other Fiber</th>
                                            <td class='text-center'>".$row_for_qc['weft_other_fiber_value'].' '.$row_for_defining_process['uom_of_percentage_of_weft_other_fiber_content']."</td>
                                            <td class='text-center'>".$row_for_defining_process['percentage_of_weft_other_fiber_content_value'].'  '.$row_for_defining_process['percentage_of_weft_other_fiber_content_tolerance_range_math_op'].'  '.$row_for_defining_process['percentage_of_weft_other_fiber_content_tolerance_value']." %</td>
                                        </tr>";
                                    }
                                    $form.="</tbody>
                                    </table>
                                                    
                                    </div>
                                    </div>
                                    </div>";

                                }
                                echo $form;
                                $form = "";
                            }  /*End of if (in_array($row['id'], ['43']))*/
                                
                            
                            if(in_array($row['id'], ['20', '65']))
                            {
                                //echo 'hello';
                                if (($row_for_defining_process['cf_to_water_spotting_surface_max_value']<>0 && $row_for_qc['cf_to_water_spotting_surface_value']<>0) || ($row_for_defining_process['cf_to_water_spotting_edge_max_value']<>0 && $row_for_qc['cf_to_water_spotting_edge_value']<>0) || ($row_for_defining_process['cf_to_water_spotting_cross_staining_max_value']<>0 && $row_for_qc['cf_to_water_spotting_cross_staining_value']<>0)  ) 
                                {
                                    $serial+=1;

                                    if($customer_type == 'american')
                                    {
                                        $cf_to_water_spotting_surface_tolerance_value = $row_for_defining_process['cf_to_water_spotting_surface_tolerance_value'];
                                        $cf_to_water_spotting_surface_value = $row_for_qc['cf_to_water_spotting_surface_value'];

                                        $cf_to_water_spotting_edge_tolerance_value = $row_for_defining_process['cf_to_water_spotting_edge_tolerance_value'];
                                        $cf_to_water_spotting_edge_value = $row_for_qc['cf_to_water_spotting_edge_value'];

                                        $cf_to_water_spotting_cross_staining_tolerance_value = $row_for_defining_process['cf_to_water_spotting_cross_staining_tolerance_value'];
                                        $cf_to_water_spotting_cross_staining_value = $row_for_qc['cf_to_water_spotting_cross_staining_value'];
                                    }
                                    if($customer_type == 'european')
                                    {
                                        // water spotting surface
                                        $cf_to_water_spotting_surface_tolerance = $row_for_defining_process['cf_to_water_spotting_surface_tolerance_value'];
                                        
                                        if($cf_to_water_spotting_surface_tolerance ==1.0)
                                        {
                                            $cf_to_water_spotting_surface_tolerance_value = '1';
                                        }
                                        elseif($cf_to_water_spotting_surface_tolerance ==1.5)
                                        {
                                            $cf_to_water_spotting_surface_tolerance_value = '1-2';
                                        }
                                        elseif($cf_to_water_spotting_surface_tolerance ==2.0)
                                        {
                                            $cf_to_water_spotting_surface_tolerance_value = '2';
                                        }
                                        elseif($cf_to_water_spotting_surface_tolerance ==2.5)
                                        {
                                            $cf_to_water_spotting_surface_tolerance_value = '2-3';
                                        }
                                        elseif($cf_to_water_spotting_surface_tolerance ==3.0)
                                        {
                                            $cf_to_water_spotting_surface_tolerance_value = '3';
                                        }
                                        elseif($cf_to_water_spotting_surface_tolerance ==3.5)
                                        {
                                            $cf_to_water_spotting_surface_tolerance_value = '3-4';
                                        }
                                        elseif($cf_to_water_spotting_surface_tolerance ==4.0)
                                        {
                                            $cf_to_water_spotting_surface_tolerance_value = '4';
                                        }
                                        elseif($cf_to_water_spotting_surface_tolerance ==4.5)
                                        {
                                            $cf_to_water_spotting_surface_tolerance_value = '4-5';
                                        }
                                        elseif($cf_to_water_spotting_surface_tolerance ==5.0)
                                        {
                                            $cf_to_water_spotting_surface_tolerance_value = '5';
                                        }										 // for defining

                                        $cf_to_water_spotting_surface = $row_for_qc['cf_to_water_spotting_surface_value'];
                                
                                        if($cf_to_water_spotting_surface ==1.0)
                                        {
                                            $cf_to_water_spotting_surface_value = '1';
                                        }
                                        elseif($cf_to_water_spotting_surface ==1.5)
                                        {
                                            $cf_to_water_spotting_surface_value = '1-2';
                                        }
                                        elseif($cf_to_water_spotting_surface ==2.0)
                                        {
                                            $cf_to_water_spotting_surface_value = '2';
                                        }
                                        elseif($cf_to_water_spotting_surface ==2.5)
                                        {
                                            $cf_to_water_spotting_surface_value = '2-3';
                                        }
                                        elseif($cf_to_water_spotting_surface ==3.0)
                                        {
                                            $cf_to_water_spotting_surface_value = '3';
                                        }
                                        elseif($cf_to_water_spotting_surface ==3.5)
                                        {
                                            $cf_to_water_spotting_surface_value = '3-4';
                                        }
                                        elseif($cf_to_water_spotting_surface ==4.0)
                                        {
                                            $cf_to_water_spotting_surface_value = '4';
                                        }
                                        elseif($cf_to_water_spotting_surface ==4.5)
                                        {
                                            $cf_to_water_spotting_surface_value = '4-5';
                                        }
                                        elseif($cf_to_water_spotting_surface ==5.0)
                                        {
                                            $cf_to_water_spotting_surface_value = '5';
                                        } 				// for test result

                                            // water spotting edge
                                        $cf_to_water_spotting_edge_tolerance = $row_for_defining_process['cf_to_water_spotting_edge_tolerance_value'];
                                        
                                        if($cf_to_water_spotting_edge_tolerance ==1.0)
                                        {
                                            $cf_to_water_spotting_edge_tolerance_value = '1';
                                        }
                                        elseif($cf_to_water_spotting_edge_tolerance ==1.5)
                                        {
                                            $cf_to_water_spotting_edge_tolerance_value = '1-2';
                                        }
                                        elseif($cf_to_water_spotting_edge_tolerance ==2.0)
                                        {
                                            $cf_to_water_spotting_edge_tolerance_value = '2';
                                        }
                                        elseif($cf_to_water_spotting_edge_tolerance ==2.5)
                                        {
                                            $cf_to_water_spotting_edge_tolerance_value = '2-3';
                                        }
                                        elseif($cf_to_water_spotting_edge_tolerance ==3.0)
                                        {
                                            $cf_to_water_spotting_edge_tolerance_value = '3';
                                        }
                                        elseif($cf_to_water_spotting_edge_tolerance ==3.5)
                                        {
                                            $cf_to_water_spotting_edge_tolerance_value = '3-4';
                                        }
                                        elseif($cf_to_water_spotting_edge_tolerance ==4.0)
                                        {
                                            $cf_to_water_spotting_edge_tolerance_value = '4';
                                        }
                                        elseif($cf_to_water_spotting_edge_tolerance ==4.5)
                                        {
                                            $cf_to_water_spotting_edge_tolerance_value = '4-5';
                                        }
                                        elseif($cf_to_water_spotting_edge_tolerance ==5.0)
                                        {
                                            $cf_to_water_spotting_edge_tolerance_value = '5';
                                        }								  // for defining

                                        $cf_to_water_spotting_edge = $row_for_qc['cf_to_water_spotting_edge_value'];
                                
                                        if($cf_to_water_spotting_edge ==1.0)
                                        {
                                            $cf_to_water_spotting_edge_value = '1';
                                        }
                                        elseif($cf_to_water_spotting_edge ==1.5)
                                        {
                                            $cf_to_water_spotting_edge_value = '1-2';
                                        }
                                        elseif($cf_to_water_spotting_edge ==2.0)
                                        {
                                            $cf_to_water_spotting_edge_value = '2';
                                        }
                                        elseif($cf_to_water_spotting_edge ==2.5)
                                        {
                                            $cf_to_water_spotting_edge_value = '2-3';
                                        }
                                        elseif($cf_to_water_spotting_edge ==3.0)
                                        {
                                            $cf_to_water_spotting_edge_value = '3';
                                        }
                                        elseif($cf_to_water_spotting_edge ==3.5)
                                        {
                                            $cf_to_water_spotting_edge_value = '3-4';
                                        }
                                        elseif($cf_to_water_spotting_edge ==4.0)
                                        {
                                            $cf_to_water_spotting_edge_value = '4';
                                        }
                                        elseif($cf_to_water_spotting_edge ==4.5)
                                        {
                                            $cf_to_water_spotting_edge_value = '4-5';
                                        }
                                        elseif($cf_to_water_spotting_edge ==5.0)
                                        {
                                            $cf_to_water_spotting_edge_value = '5';
                                        } 				// for test result

                                                    // water spotting cross staining
                                        $cf_to_water_spotting_cross_staining_tolerance = $row_for_defining_process['cf_to_water_spotting_cross_staining_tolerance_value'];
                            
                                        if($cf_to_water_spotting_cross_staining_tolerance ==1.0)
                                        {
                                            $cf_to_water_spotting_cross_staining_tolerance_value = '1';
                                        }
                                        elseif($cf_to_water_spotting_cross_staining_tolerance ==1.5)
                                        {
                                            $cf_to_water_spotting_cross_staining_tolerance_value = '1-2';
                                        }
                                        elseif($cf_to_water_spotting_cross_staining_tolerance ==2.0)
                                        {
                                            $cf_to_water_spotting_cross_staining_tolerance_value = '2';
                                        }
                                        elseif($cf_to_water_spotting_cross_staining_tolerance ==2.5)
                                        {
                                            $cf_to_water_spotting_cross_staining_tolerance_value = '2-3';
                                        }
                                        elseif($cf_to_water_spotting_cross_staining_tolerance ==3.0)
                                        {
                                            $cf_to_water_spotting_cross_staining_tolerance_value = '3';
                                        }
                                        elseif($cf_to_water_spotting_cross_staining_tolerance ==3.5)
                                        {
                                            $cf_to_water_spotting_cross_staining_tolerance_value = '3-4';
                                        }
                                        elseif($cf_to_water_spotting_cross_staining_tolerance ==4.0)
                                        {
                                            $cf_to_water_spotting_cross_staining_tolerance_value = '4';
                                        }
                                        elseif($cf_to_water_spotting_cross_staining_tolerance ==4.5)
                                        {
                                            $cf_to_water_spotting_cross_staining_tolerance_value = '4-5';
                                        }
                                        elseif($cf_to_water_spotting_cross_staining_tolerance ==5.0)
                                        {
                                            $cf_to_water_spotting_cross_staining_tolerance_value = '5';
                                        }							  // for defining

                                        $cf_to_water_spotting_cross_staining = $row_for_qc['cf_to_water_spotting_cross_staining_value'];
                                
                                        if($cf_to_water_spotting_cross_staining ==1.0)
                                        {
                                            $cf_to_water_spotting_cross_staining_value = '1';
                                        }
                                        elseif($cf_to_water_spotting_cross_staining ==1.5)
                                        {
                                            $cf_to_water_spotting_cross_staining_value = '1-2';
                                        }
                                        elseif($cf_to_water_spotting_cross_staining ==2.0)
                                        {
                                            $cf_to_water_spotting_cross_staining_value = '2';
                                        }
                                        elseif($cf_to_water_spotting_cross_staining ==2.5)
                                        {
                                            $cf_to_water_spotting_cross_staining_value = '2-3';
                                        }
                                        elseif($cf_to_water_spotting_cross_staining ==3.0)
                                        {
                                            $cf_to_water_spotting_cross_staining_value = '3';
                                        }
                                        elseif($cf_to_water_spotting_cross_staining ==3.5)
                                        {
                                            $cf_to_water_spotting_cross_staining_value = '3-4';
                                        }
                                        elseif($cf_to_water_spotting_cross_staining ==4.0)
                                        {
                                            $cf_to_water_spotting_cross_staining_value = '4';
                                        }
                                        elseif($cf_to_water_spotting_cross_staining ==4.5)
                                        {
                                            $cf_to_water_spotting_cross_staining_value = '4-5';
                                        }
                                        elseif($cf_to_water_spotting_cross_staining ==5.0)
                                        {
                                            $cf_to_water_spotting_cross_staining_value = '5';
                                        } 				// for test result
                                        
                                    }


                                    $form.="<div class='form-group from-group-sm row'>
                                    <div class='col-sm-1'><b style='font-size: 20px;' >".$serial.".</b></div>
                                    <div class='col-sm-11' id='form-group_for_test_report_of_ikea'>
                                        <div class='col-sm-10'>
                                                <table class='table table-bordered'>
                                                
                                                            <thead>
                                                            <tr>
                                                                <label class='col-sm-12' for='name' style='font-size: 20px;' >".$row['test_name_method']." : </label>
                                                            </tr>
                                                            <tr>
                                                            <th class='text-center' colspan='2'>Result </th>
                                                                <th class='text-center'>Requirements</th>                                   
                                                            </tr>
                                                            
                                                            </thead>
                                                            <tbody>
                                                            <tr>
                                                                <th class='text-center'>Surface </th>
                                                                <td>".$cf_to_water_spotting_surface_value.' '.$row_for_defining_process['uom_of_cf_to_water_spotting_surface']."</td>
                                                                <td>".$row_for_defining_process['cf_to_water_spotting_surface_tolerance_range_math_op'].' '.$cf_to_water_spotting_surface_tolerance_value.' '.$row_for_defining_process['uom_of_cf_to_water_spotting_surface']."</td>
                                                                </tr>
                                                            <tr>
                                                                <th class='text-center'>Edge </th>
                                                                <td>".$cf_to_water_spotting_edge_value.' '.$row_for_defining_process['uom_of_cf_to_water_spotting_edge']."</td>
                                                                <td>".$row_for_defining_process['cf_to_water_spotting_edge_tolerance_range_math_op'].' '.$cf_to_water_spotting_edge_tolerance_value.' '.$row_for_defining_process['uom_of_cf_to_water_spotting_edge']."</td>
                                                                </tr>
                                                            <tr>
                                                                <th class='text-center'>Cross Staining </th>
                                                                <td>".$cf_to_water_spotting_cross_staining_value.' '.$row_for_defining_process['uom_of_cf_to_water_spotting_cross_staining']."</td>
                                                                <td>".$row_for_defining_process['cf_to_water_spotting_cross_staining_tolerance_range_math_op'].' '.$cf_to_water_spotting_cross_staining_tolerance_value.' '.$row_for_defining_process['uom_of_cf_to_water_spotting_cross_staining']."</td>
                                                                </tr>
                                                            
                                                            </tbody>
                                                        </table>
                                                    
                                                    </div>
                                                    </div>
                                                </div>";

                                }
                                echo $form;
                                $form = "";
                            }  /*End of if (in_array($row['id'], ['20', '65']))*/

                            if (in_array($row['id'], ['21','22', '66']))
                            {
                                
                                if (($row_for_defining_process['resistance_to_surface_wetting_before_wash_max_value']<>0 && $row_for_qc['resistance_to_surface_wetting_before_wash_value']<>0) || ($row_for_defining_process['resistance_to_surface_wetting_after_one_wash_value']<>0 && $row_for_qc['resistance_to_surface_wetting_after_one_wash_value']<>0) || ($row_for_defining_process['resistance_to_surface_wetting_after_five_wash_max_value']<>0 && $row_for_qc['resistance_to_surface_wetting_after_five_wash_value']<>0) ) 
                                {
                                    $serial+=1;

                                    if($customer_type == 'american')
                                    {
                                        $resistance_to_surface_wetting_before_wash_tolerance_value = $row_for_defining_process['resistance_to_surface_wetting_before_wash_tolerance_value'];
                                        $resistance_to_surface_wetting_before_wash_value = $row_for_qc['resistance_to_surface_wetting_before_wash_value'];

                                        $resistance_to_surface_wetting_after_one_wash_tolerance_value = $row_for_defining_process['resistance_to_surface_wetting_after_one_wash_tolerance_value'];
                                        $resistance_to_surface_wetting_after_one_wash_value = $row_for_qc['resistance_to_surface_wetting_after_one_wash_value'];

                                        $resistance_to_surface_wetting_after_five_wash_tolerance_value = $row_for_defining_process['resistance_to_surface_wetting_after_five_wash_tolerance_value'];
                                        $resistance_to_surface_wetting_after_five_wash_value = $row_for_qc['resistance_to_surface_wetting_after_five_wash_value'];
            
            
                                    }
                                    if($customer_type == 'european')
                                    {
                                        // resistance_to_surface_wetting_before_wash
                                        $resistance_to_surface_wetting_before_wash_tolerance = $row_for_defining_process['resistance_to_surface_wetting_before_wash_tolerance_value'];
                                        
                                        if($resistance_to_surface_wetting_before_wash_tolerance ==1.0)
                                        {
                                            $resistance_to_surface_wetting_before_wash_tolerance_value = '1';
                                        }
                                        elseif($resistance_to_surface_wetting_before_wash_tolerance ==1.5)
                                        {
                                            $resistance_to_surface_wetting_before_wash_tolerance_value = '1-2';
                                        }
                                        elseif($resistance_to_surface_wetting_before_wash_tolerance ==2.0)
                                        {
                                            $resistance_to_surface_wetting_before_wash_tolerance_value = '2';
                                        }
                                        elseif($resistance_to_surface_wetting_before_wash_tolerance ==2.5)
                                        {
                                            $resistance_to_surface_wetting_before_wash_tolerance_value = '2-3';
                                        }
                                        elseif($resistance_to_surface_wetting_before_wash_tolerance ==3.0)
                                        {
                                            $resistance_to_surface_wetting_before_wash_tolerance_value = '3';
                                        }
                                        elseif($resistance_to_surface_wetting_before_wash_tolerance ==3.5)
                                        {
                                            $resistance_to_surface_wetting_before_wash_tolerance_value = '3-4';
                                        }
                                        elseif($resistance_to_surface_wetting_before_wash_tolerance ==4.0)
                                        {
                                            $resistance_to_surface_wetting_before_wash_tolerance_value = '4';
                                        }
                                        elseif($resistance_to_surface_wetting_before_wash_tolerance ==4.5)
                                        {
                                            $resistance_to_surface_wetting_before_wash_tolerance_value = '4-5';
                                        }
                                        elseif($resistance_to_surface_wetting_before_wash_tolerance ==5.0)
                                        {
                                            $resistance_to_surface_wetting_before_wash_tolerance_value = '5';
                                        }						  // for defining
        
                                        $resistance_to_surface_wetting_before_wash = $row_for_qc['resistance_to_surface_wetting_before_wash_value'];
                                
                                        if($resistance_to_surface_wetting_before_wash ==1.0)
                                        {
                                            $resistance_to_surface_wetting_before_wash_value = '1';
                                        }
                                        elseif($resistance_to_surface_wetting_before_wash ==1.5)
                                        {
                                            $resistance_to_surface_wetting_before_wash_value = '1-2';
                                        }
                                        elseif($resistance_to_surface_wetting_before_wash ==2.0)
                                        {
                                            $resistance_to_surface_wetting_before_wash_value = '2';
                                        }
                                        elseif($resistance_to_surface_wetting_before_wash ==2.5)
                                        {
                                            $resistance_to_surface_wetting_before_wash_value = '2-3';
                                        }
                                        elseif($resistance_to_surface_wetting_before_wash ==3.0)
                                        {
                                            $resistance_to_surface_wetting_before_wash_value = '3';
                                        }
                                        elseif($resistance_to_surface_wetting_before_wash ==3.5)
                                        {
                                            $resistance_to_surface_wetting_before_wash_value = '3-4';
                                        }
                                        elseif($resistance_to_surface_wetting_before_wash ==4.0)
                                        {
                                            $resistance_to_surface_wetting_before_wash_value = '4';
                                        }
                                        elseif($resistance_to_surface_wetting_before_wash ==4.5)
                                        {
                                            $resistance_to_surface_wetting_before_wash_value = '4-5';
                                        }
                                        elseif($resistance_to_surface_wetting_before_wash ==5.0)
                                        {
                                            $resistance_to_surface_wetting_before_wash_value = '5';
                                        } 				// for test result
        
                                            // resistance_to_surface_wetting_after_one_wash
                                        $resistance_to_surface_wetting_after_one_wash_tolerance = $row_for_defining_process['resistance_to_surface_wetting_after_one_wash_tolerance_value'];
                            
                                        if($resistance_to_surface_wetting_after_one_wash_tolerance ==1.0)
                                        {
                                            $resistance_to_surface_wetting_after_one_wash_tolerance_value = '1';
                                        }
                                        elseif($resistance_to_surface_wetting_after_one_wash_tolerance ==1.5)
                                        {
                                            $resistance_to_surface_wetting_after_one_wash_tolerance_value = '1-2';
                                        }
                                        elseif($resistance_to_surface_wetting_after_one_wash_tolerance ==2.0)
                                        {
                                            $resistance_to_surface_wetting_after_one_wash_tolerance_value = '2';
                                        }
                                        elseif($resistance_to_surface_wetting_after_one_wash_tolerance ==2.5)
                                        {
                                            $resistance_to_surface_wetting_after_one_wash_tolerance_value = '2-3';
                                        }
                                        elseif($resistance_to_surface_wetting_after_one_wash_tolerance ==3.0)
                                        {
                                            $resistance_to_surface_wetting_after_one_wash_tolerance_value = '3';
                                        }
                                        elseif($resistance_to_surface_wetting_after_one_wash_tolerance ==3.5)
                                        {
                                            $resistance_to_surface_wetting_after_one_wash_tolerance_value = '3-4';
                                        }
                                        elseif($resistance_to_surface_wetting_after_one_wash_tolerance ==4.0)
                                        {
                                            $resistance_to_surface_wetting_after_one_wash_tolerance_value = '4';
                                        }
                                        elseif($resistance_to_surface_wetting_after_one_wash_tolerance ==4.5)
                                        {
                                            $resistance_to_surface_wetting_after_one_wash_tolerance_value = '4-5';
                                        }
                                        elseif($resistance_to_surface_wetting_after_one_wash_tolerance ==5.0)
                                        {
                                            $resistance_to_surface_wetting_after_one_wash_tolerance_value = '5';
                                        }					  // for defining

                                        $resistance_to_surface_wetting_after_one_wash = $row_for_qc['resistance_to_surface_wetting_after_one_wash_value'];
                                
                                        if($resistance_to_surface_wetting_after_one_wash ==1.0)
                                        {
                                            $resistance_to_surface_wetting_after_one_wash_value = '1';
                                        }
                                        elseif($resistance_to_surface_wetting_after_one_wash ==1.5)
                                        {
                                            $resistance_to_surface_wetting_after_one_wash_value = '1-2';
                                        }
                                        elseif($resistance_to_surface_wetting_after_one_wash ==2.0)
                                        {
                                            $resistance_to_surface_wetting_after_one_wash_value = '2';
                                        }
                                        elseif($resistance_to_surface_wetting_after_one_wash ==2.5)
                                        {
                                            $resistance_to_surface_wetting_after_one_wash_value = '2-3';
                                        }
                                        elseif($resistance_to_surface_wetting_after_one_wash ==3.0)
                                        {
                                            $resistance_to_surface_wetting_after_one_wash_value = '3';
                                        }
                                        elseif($resistance_to_surface_wetting_after_one_wash ==3.5)
                                        {
                                            $resistance_to_surface_wetting_after_one_wash_value = '3-4';
                                        }
                                        elseif($resistance_to_surface_wetting_after_one_wash ==4.0)
                                        {
                                            $resistance_to_surface_wetting_after_one_wash_value = '4';
                                        }
                                        elseif($resistance_to_surface_wetting_after_one_wash ==4.5)
                                        {
                                            $resistance_to_surface_wetting_after_one_wash_value = '4-5';
                                        }
                                        elseif($resistance_to_surface_wetting_after_one_wash ==5.0)
                                        {
                                            $resistance_to_surface_wetting_after_one_wash_value = '5';
                                        } 				// for test result

                                            // resistance_to_surface_wetting_after_five_wash
                                        $resistance_to_surface_wetting_after_five_wash_tolerance = $row_for_defining_process['resistance_to_surface_wetting_after_five_wash_tolerance_value'];
                            
                                        if($resistance_to_surface_wetting_after_five_wash_tolerance ==1.0)
                                        {
                                            $resistance_to_surface_wetting_after_five_wash_tolerance_value = '1';
                                        }
                                        elseif($resistance_to_surface_wetting_after_five_wash_tolerance ==1.5)
                                        {
                                            $resistance_to_surface_wetting_after_five_wash_tolerance_value = '1-2';
                                        }
                                        elseif($resistance_to_surface_wetting_after_five_wash_tolerance ==2.0)
                                        {
                                            $resistance_to_surface_wetting_after_five_wash_tolerance_value = '2';
                                        }
                                        elseif($resistance_to_surface_wetting_after_five_wash_tolerance ==2.5)
                                        {
                                            $resistance_to_surface_wetting_after_five_wash_tolerance_value = '2-3';
                                        }
                                        elseif($resistance_to_surface_wetting_after_five_wash_tolerance ==3.0)
                                        {
                                            $resistance_to_surface_wetting_after_five_wash_tolerance_value = '3';
                                        }
                                        elseif($resistance_to_surface_wetting_after_five_wash_tolerance ==3.5)
                                        {
                                            $resistance_to_surface_wetting_after_five_wash_tolerance_value = '3-4';
                                        }
                                        elseif($resistance_to_surface_wetting_after_five_wash_tolerance ==4.0)
                                        {
                                            $resistance_to_surface_wetting_after_five_wash_tolerance_value = '4';
                                        }
                                        elseif($resistance_to_surface_wetting_after_five_wash_tolerance ==4.5)
                                        {
                                            $resistance_to_surface_wetting_after_five_wash_tolerance_value = '4-5';
                                        }
                                        elseif($resistance_to_surface_wetting_after_five_wash_tolerance ==5.0)
                                        {
                                            $resistance_to_surface_wetting_after_five_wash_tolerance_value = '5';
                                        }																	   // for defining

                                        $resistance_to_surface_wetting_after_five_wash = $row_for_qc['resistance_to_surface_wetting_after_five_wash_value'];
                                
                                        if($resistance_to_surface_wetting_after_five_wash ==1.0)
                                        {
                                            $resistance_to_surface_wetting_after_five_wash_value = '1';
                                        }
                                        elseif($resistance_to_surface_wetting_after_five_wash ==1.5)
                                        {
                                            $resistance_to_surface_wetting_after_five_wash_value = '1-2';
                                        }
                                        elseif($resistance_to_surface_wetting_after_five_wash ==2.0)
                                        {
                                            $resistance_to_surface_wetting_after_five_wash_value = '2';
                                        }
                                        elseif($resistance_to_surface_wetting_after_five_wash ==2.5)
                                        {
                                            $resistance_to_surface_wetting_after_five_wash_value = '2-3';
                                        }
                                        elseif($resistance_to_surface_wetting_after_five_wash ==3.0)
                                        {
                                            $resistance_to_surface_wetting_after_five_wash_value = '3';
                                        }
                                        elseif($resistance_to_surface_wetting_after_five_wash ==3.5)
                                        {
                                            $resistance_to_surface_wetting_after_five_wash_value = '3-4';
                                        }
                                        elseif($resistance_to_surface_wetting_after_five_wash ==4.0)
                                        {
                                            $resistance_to_surface_wetting_after_five_wash_value = '4';
                                        }
                                        elseif($resistance_to_surface_wetting_after_five_wash ==4.5)
                                        {
                                            $resistance_to_surface_wetting_after_five_wash_value = '4-5';
                                        }
                                        elseif($resistance_to_surface_wetting_after_five_wash ==5.0)
                                        {
                                            $resistance_to_surface_wetting_after_five_wash_value = '5';
                                        } 				// for test result
                                    }

                                    $form.="<div class='form-group from-group-sm row'>
                                    <div class='col-sm-1'><b style='font-size: 20px;' >".$serial.".</b></div>
                                    <div class='col-sm-11' id='form-group_for_test_report_of_ikea'>
                                        <div class='col-sm-10'>
                                                <table class='table table-bordered'>
                                                
                                                            <thead>
                                                            <tr>
                                                                <label class='col-sm-12' for='name' style='font-size: 20px;' >".$row['test_name_method']." : </label>
                                                            </tr>
                                                            <tr>
                                                            <th class='text-center' colspan='2'>Result </th>
                                                                <th class='text-center'>Requirements</th>                                   
                                                            </tr>
                                                            
                                                            </thead>
                                                            <tbody>
                                                            <tr>
                                                                <th class='text-center'>Before Wash </th>
                                                                <td>".$resistance_to_surface_wetting_before_wash_value.' '.$row_for_defining_process['uom_of_resistance_to_surface_wetting_before_wash']."</td>
                                                                <td>".$row_for_defining_process['resistance_to_surface_wetting_before_wash_tol_range_math_op'].' '.$resistance_to_surface_wetting_before_wash_tolerance_value.' '.$row_for_defining_process['uom_of_resistance_to_surface_wetting_before_wash']."</td>
                                                                </tr>
                                                            <tr>
                                                                <th class='text-center'>After One Wash </th>
                                                                <td>".$resistance_to_surface_wetting_after_one_wash_value.' '.$row_for_defining_process['uom_of_resistance_to_surface_wetting_after_one_wash']."</td>
                                                                <td>".$row_for_defining_process['resistance_to_surface_wetting_after_one_wash_tol_range_math_op'].' '.$resistance_to_surface_wetting_after_one_wash_tolerance_value.' '.$row_for_defining_process['uom_of_resistance_to_surface_wetting_after_one_wash']."</td>
                                                                </tr>
                                                            <tr>
                                                                <th class='text-center'>After Five Wash</th>
                                                                <td>".$resistance_to_surface_wetting_after_five_wash_value.' '.$row_for_defining_process['uom_of_resistance_to_surface_wetting_after_five_wash']."</td>
                                                                <td>".$row_for_defining_process['resistance_to_surface_wetting_after_five_wash_tol_range_math_op'].' '.$resistance_to_surface_wetting_after_five_wash_tolerance_value.' '.$row_for_defining_process['uom_of_resistance_to_surface_wetting_after_five_wash']."</td>
                                                                </tr>   
                                                            </tbody>
                                                        </table>
                                                    
                                                    </div>
                                                    </div>
                                                </div>";

                                }
                                echo $form;
                                $form = "";
                            }  /*End of if (in_array($row['id'], [['21','22', '66']))*/

                            if (in_array($row['id'], ['26', '70']))
                            {
                                
                                if($row_for_defining_process['cf_to_pvc_migration_staining_max_value']<>0 && $row_for_qc['cf_to_pvc_migration_staining_value']<>0)
                                {
                                    $serial+=1;
                                    if($customer_type == 'american')
                                    {
                                        $cf_to_pvc_migration_staining_tolerance_value = $row_for_defining_process['cf_to_pvc_migration_staining_tolerance_value'];
                                        $cf_to_pvc_migration_staining_value = $row_for_qc['cf_to_pvc_migration_staining_value'];
        
                                    }
                                    if($customer_type == 'european')
                                    {
                                        $cf_to_pvc_migration_staining_tolerance = $row_for_defining_process['cf_to_pvc_migration_staining_tolerance_value'];
                                        
                                        if($cf_to_pvc_migration_staining_tolerance ==1.0)
                                        {
                                            $cf_to_pvc_migration_staining_tolerance_value = '1';
                                        }
                                        elseif($cf_to_pvc_migration_staining_tolerance ==1.5)
                                        {
                                            $cf_to_pvc_migration_staining_tolerance_value = '1-2';
                                        }
                                        elseif($cf_to_pvc_migration_staining_tolerance ==2.0)
                                        {
                                            $cf_to_pvc_migration_staining_tolerance_value = '2';
                                        }
                                        elseif($cf_to_pvc_migration_staining_tolerance ==2.5)
                                        {
                                            $cf_to_pvc_migration_staining_tolerance_value = '2-3';
                                        }
                                        elseif($cf_to_pvc_migration_staining_tolerance ==3.0)
                                        {
                                            $cf_to_pvc_migration_staining_tolerance_value = '3';
                                        }
                                        elseif($cf_to_pvc_migration_staining_tolerance ==3.5)
                                        {
                                            $cf_to_pvc_migration_staining_tolerance_value = '3-4';
                                        }
                                        elseif($cf_to_pvc_migration_staining_tolerance ==4.0)
                                        {
                                            $cf_to_pvc_migration_staining_tolerance_value = '4';
                                        }
                                        elseif($cf_to_pvc_migration_staining_tolerance ==4.5)
                                        {
                                            $cf_to_pvc_migration_staining_tolerance_value = '4-5';
                                        }
                                        elseif($cf_to_pvc_migration_staining_tolerance ==5.0)
                                        {
                                            $cf_to_pvc_migration_staining_tolerance_value = '5';
                                        }
        
                                        $cf_to_pvc_migration_staining = $row_for_qc['cf_to_pvc_migration_staining_value'];
                                
                                        if($cf_to_pvc_migration_staining ==1.0)
                                        {
                                            $cf_to_pvc_migration_staining_value = '1';
                                        }
                                        elseif($cf_to_pvc_migration_staining ==1.5)
                                        {
                                            $cf_to_pvc_migration_staining_value = '1-2';
                                        }
                                        elseif($cf_to_pvc_migration_staining ==2.0)
                                        {
                                            $cf_to_pvc_migration_staining_value = '2';
                                        }
                                        elseif($cf_to_pvc_migration_staining ==2.5)
                                        {
                                            $cf_to_pvc_migration_staining_value = '2-3';
                                        }
                                        elseif($cf_to_pvc_migration_staining ==3.0)
                                        {
                                            $cf_to_pvc_migration_staining_value = '3';
                                        }
                                        elseif($cf_to_pvc_migration_staining ==3.5)
                                        {
                                            $cf_to_pvc_migration_staining_value = '3-4';
                                        }
                                        elseif($cf_to_pvc_migration_staining ==4.0)
                                        {
                                            $cf_to_pvc_migration_staining_value = '4';
                                        }
                                        elseif($cf_to_pvc_migration_staining ==4.5)
                                        {
                                            $cf_to_pvc_migration_staining_value = '4-5';
                                        }
                                        elseif($cf_to_pvc_migration_staining ==5.0)
                                        {
                                            $cf_to_pvc_migration_staining_value = '5';
                                        } 				// for test result
        
                                    }

                                    $form.="<div class='form-group from-group-sm row'>
                                                <div class='col-sm-1'><b style='font-size: 20px;' >".$serial.".</b></div>
                                                <div class='col-sm-11' id='form-group_for_test_report_of_ikea'>
                                                <label class='col-sm-12' for='name' style='font-size: 20px;' >".$row['test_name_method'].": </label>
                                                    <div class='col-sm-10'>
                                                    <table class='table table-bordered'>
                                                        <thead>
                                                        <tr>
                                                            <th class='text-center' colspan='2'>Color Change</th>
                                                            <th class='text-center'>Requirements</th>                                   
                                                        </tr>
                                                        
                                                        </thead>
                                                        <tbody>
                                                        <tr>
                                                            <th class='text-center' rowspan='2'>Staining</th>
                                                            <th class='text-center' >Colors</th>
                                                            <td class='text-center' rowspan='2'>".$row_for_defining_process['cf_to_pvc_migration_staining_tolerance_range_math_operator'].''.$cf_to_pvc_migration_staining_tolerance_value."</td>
                                                        </tr>
                                                            <tr>
                                                            
                                                                <td class='text-center'>".$cf_to_pvc_migration_staining_value."</td>
                                                                
                                                            </tr>
                                                        
                                                        </tbody>
                                                    </table>
                                                    </div>
                                                </div>
                                            </div>";
                                }
                                echo $form;
                                $form = "";
                            } /*End of if (in_array($row['id'], ['26', '26', '70']))*/

                            if (in_array($row['id'], ['74']))
                            {
                                if (($row_for_defining_process['warp_yarn_count_max_value']<>0 && $row_for_qc['warp_yarn_count_value']<>0) || ($row_for_defining_process['weft_yarn_count_max_value']<>0 && $row_for_qc['weft_yarn_count_value']<>0) )
                                {
                                    $serial+=1;
                                    $form.=" <div class='form-group from-group-sm row'>
                                                <div class='col-sm-1'><b style='font-size: 20px;' >".$serial.".</b></div>
                                                <div class='col-sm-11' id='form-group_for_test_report_of_ikea'>
                                                    <div class='col-sm-10'>
                                                        <table class='table table-bordered'>
                                                            <thead>
                                                            <tr>
                                                                <label class='col-sm-12' for=name' style='font-size: 20px;' >".$row['test_name_method'].": </label>

                                                            </tr>
                                                            <tr>
                                                                <th class='text-center' colspan='2'>Result</th>
                                                                <th class='text-center'>Requirements</th>                                   
                                                            </tr>
                                                            
                                                            </thead>
                                                            <tbody>
                                                            <tr>
                                                                <th class='text-center'>Warp</th>
                                                                <td class='text-center' >".$row_for_qc['warp_yarn_count_value'].' ' .$row_for_defining_process['uom_of_warp_yarn_count_value']."</td>
                                                                <td class='text-center'>".$row_for_defining_process['warp_yarn_count_value'].' ' .$row_for_defining_process['uom_of_warp_yarn_count_value']." (".$row_for_defining_process['warp_yarn_count_tolerance_range_math_operator'].' '.$row_for_defining_process['warp_yarn_count_tolerance_value'].")%</td>
                                                            </tr>

                                                            <tr>
                                                                <th class='text-center'>Weft</th>
                                                                <td class='text-center' >".$row_for_qc['weft_yarn_count_value'].' ' .$row_for_defining_process['uom_of_weft_yarn_count_value']."</td>
                                                                <td class='text-center'>".$row_for_defining_process['weft_yarn_count_value'].' ' .$row_for_defining_process['uom_of_weft_yarn_count_value']." (".$row_for_defining_process['weft_yarn_count_tolerance_range_math_operator'].' '.$row_for_defining_process['weft_yarn_count_tolerance_value'].")%</td>
                                                            </tr>
                                                        
                                                            
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div> ";

                                }
                                echo $form;
                                $form = "";
                                
                            } /*End of if (in_array($row['id'], ['74']))*/


                            if (in_array($row['id'], ['4']))
                            {
                                
                                if (($row_for_defining_process['no_of_threads_in_warp_max_value']<>0 && $row_for_qc_supplimentery['no_of_threads_in_warp_value']<>0) || ($row_for_defining_process['no_of_threads_in_weft_max_value']<>0 && $row_for_qc_supplimentery['no_of_threads_in_weft_value']<>0) ) 
                                {

                                    $serial+=1;
                                    $form.="<div class='form-group from-group-sm row'>
                                    <div class='col-sm-1'><b style='font-size: 20px;' >".$serial.".</b></div>
                                    <div class='col-sm-11' id='form-group_for_test_report_of_ikea'>
                                        <div class='col-sm-10'>
                                                    <table class='table table-bordered'>
                                                        <thead>

                                                        <tr>
                                                            <label class='col-sm-12' for='name' style='font-size: 20px;' >".$row['test_name_method']." : </label>
                                                        </tr>
                                                        <tr>
                                                            <th class='text-center' colspan='2'>Result</th>
                                                            <th class='text-center'>Requirements</th>                                   
                                                        </tr>
                                                        
                                                        </thead>
                                                        <tbody>
                                                        <tr>
                                                            <th class='text-center'>EPI</th>
                                                            <td class='text-center' >".$row_for_qc_supplimentery['no_of_threads_in_warp_value'].' ' .$row_for_defining_process['uom_of_no_of_threads_in_warp_value']."</td>
                                                            <td class='text-center'>".$row_for_defining_process['no_of_threads_in_warp_value'].' ' .$row_for_defining_process['uom_of_no_of_threads_in_warp_value']." (".$row_for_defining_process['no_of_threads_in_warp_tolerance_range_math_operator'].$row_for_defining_process['no_of_threads_in_warp_tolerance_value'].")%</td>
                                                        </tr>

                                                        <tr>
                                                            <th class='text-center'>PPI</th>
                                                            <td class='text-center' >".$row_for_qc_supplimentery['no_of_threads_in_weft_value'].' ' .$row_for_defining_process['uom_of_no_of_threads_in_weft_value']."</td>
                                                            <td class='text-center'>".$row_for_defining_process['no_of_threads_in_weft_value'].' ' .$row_for_defining_process['uom_of_no_of_threads_in_weft_value']." (".$row_for_defining_process['no_of_threads_in_weft_tolerance_range_math_operator'].$row_for_defining_process['no_of_threads_in_weft_tolerance_value'].")%</td>
                                                        </tr>
                                                        
                                                        </tbody>
                                                    </table>
                                                </div>
                                                </div>
                                            </div>";
                                }
                                echo $form;
                                $form = "";

                            }  /*End of if (in_array($row['id'], ['4']))*/

                            if (in_array($row['id'], ['5']))
                            {
                                
                                if ($row_for_defining_process['mass_per_unit_per_area_max_value']<>0 && $row_for_qc_supplimentery['mass_per_unit_per_area_value']<>0) 
                                {
                                    $serial+=1;
                                    if($row_for_defining_process['mass_per_unit_per_area_tolerance_range_math_operator'] == $row_for_defining_process['mass_per_unit_per_area_tolerance_value'])
                                    {
                                        $form.="<div class='form-group from-group-sm row'>
                                        <div class='col-sm-1'><b style='font-size: 20px;' >".$serial.".</b></div>
                                        <div class='col-sm-11' id='form-group_for_test_report_of_ikea'>
                                            <div class='col-sm-10'>
                                                        <table class='table table-bordered'>
                                                        
                                                                <thead>
                                                                <tr>
                                                                    <label class='col-sm-12' for='name' style='font-size: 20px;' >".$row['test_name_method']." : </label>
                                                                </tr>
                                                                <tr>
                                                                    <th class='text-center'>Result (g/m<sup>2</sup> )</th>
                                                                    <th class='text-center'>Requirements</th>                                   
                                                                </tr>
                                                                
                                                                </thead>
                                                                <tbody>
                                                                <tr>
                                                                    <td class='text-center' >".$row_for_qc_supplimentery['mass_per_unit_per_area_value']."</td>
                                                                    <td class='text-center'>".$row_for_defining_process['mass_per_unit_per_area_value'].' '.$row_for_defining_process['uom_of_mass_per_unit_per_area_value'].'  ('.' &#177; '.$row_for_defining_process['mass_per_unit_per_area_tolerance_value']."%)</td>
                                                                </tr>
                                                                
                                                                </tbody>
                                                            </table>
                                                            
                                                        </div>
                                                        </div>
                                                    </div>";
                                    }
                                    else
                                    {
                                        $form.="<div class='form-group from-group-sm row'>
                                        <div class='col-sm-1'><b style='font-size: 20px;' >".$serial.".</b></div>
                                        <div class='col-sm-11' id='form-group_for_test_report_of_ikea'>
                                            <div class='col-sm-10'>
                                                        <table class='table table-bordered'>
                                                        
                                                                <thead>
                                                                <tr>
                                                                    <label class='col-sm-12' for='name' style='font-size: 20px;' >".$row['test_name_method']." : </label>
                                                                </tr>
                                                                <tr>
                                                                    <th class='text-center'>Result (g/m<sup>2</sup> )</th>
                                                                    <th class='text-center'>Requirements</th>                                   
                                                                </tr>
                                                                
                                                                </thead>
                                                                <tbody>
                                                                <tr>
                                                                    <td class='text-center' >".$row_for_qc_supplimentery['mass_per_unit_per_area_value']."</td>
                                                                    <td class='text-center'>".$row_for_defining_process['mass_per_unit_per_area_value'].' '.$row_for_defining_process['uom_of_mass_per_unit_per_area_value'].'  (+'.$row_for_defining_process['mass_per_unit_per_area_tolerance_range_math_operator'].'% / -'.$row_for_defining_process['mass_per_unit_per_area_tolerance_value']."%)</td>
                                                                </tr>
                                                                
                                                                </tbody>
                                                            </table>
                                                            
                                                        </div>
                                                        </div>
                                                    </div>";
                                    }
                                    

                                }
                                echo $form;
                                $form = "";
                            }  /*End of if (in_array($row['id'], ['5']))*/

                            if (in_array($row['id'], ['6']))
                            {
                                
                                if ($row_for_defining_process['surface_fuzzing_and_pilling_max_value']<>0 && $row_for_qc['surface_fuzzing_and_pilling_value']<>0) 
                                {
                                    $serial+=1;

                                    if($customer_type == 'american')
                                    {
                                        $surface_fuzzing_and_pilling_tolerance_value = $row_for_defining_process['surface_fuzzing_and_pilling_tolerance_value'];
                                        $surface_fuzzing_and_pilling_value = $row_for_qc['surface_fuzzing_and_pilling_value'];
        
                                    }
                                    if($customer_type == 'european')
                                    {
                                        $surface_fuzzing_and_pilling_tolerance = $row_for_defining_process['surface_fuzzing_and_pilling_tolerance_value'];
                                    
                                        if($surface_fuzzing_and_pilling_tolerance ==1.0)
                                        {
                                            $surface_fuzzing_and_pilling_tolerance_value = '1';
                                        }
                                        elseif($surface_fuzzing_and_pilling_tolerance ==1.5)
                                        {
                                            $surface_fuzzing_and_pilling_tolerance_value = '1-2';
                                        }
                                        elseif($surface_fuzzing_and_pilling_tolerance ==2.0)
                                        {
                                            $surface_fuzzing_and_pilling_tolerance_value = '2';
                                        }
                                        elseif($surface_fuzzing_and_pilling_tolerance ==2.5)
                                        {
                                            $surface_fuzzing_and_pilling_tolerance_value = '2-3';
                                        }
                                        elseif($surface_fuzzing_and_pilling_tolerance ==3.0)
                                        {
                                            $surface_fuzzing_and_pilling_tolerance_value = '3';
                                        }
                                        elseif($surface_fuzzing_and_pilling_tolerance ==3.5)
                                        {
                                            $surface_fuzzing_and_pilling_tolerance_value = '3-4';
                                        }
                                        elseif($surface_fuzzing_and_pilling_tolerance ==4.0)
                                        {
                                            $surface_fuzzing_and_pilling_tolerance_value = '4';
                                        }
                                        elseif($surface_fuzzing_and_pilling_tolerance ==4.5)
                                        {
                                            $surface_fuzzing_and_pilling_tolerance_value = '4-5';
                                        }
                                        elseif($surface_fuzzing_and_pilling_tolerance ==5.0)
                                        {
                                            $surface_fuzzing_and_pilling_tolerance_value = '5';
                                        }  				// for defining
        
                                        $surface_fuzzing_and_pilling = $row_for_qc['surface_fuzzing_and_pilling_value'];
                                    
                                        if($surface_fuzzing_and_pilling ==1.0)
                                        {
                                            $surface_fuzzing_and_pilling_value = '1';
                                        }
                                        elseif($surface_fuzzing_and_pilling ==1.5)
                                        {
                                            $surface_fuzzing_and_pilling_value = '1-2';
                                        }
                                        elseif($surface_fuzzing_and_pilling ==2.0)
                                        {
                                            $surface_fuzzing_and_pilling_value = '2';
                                        }
                                        elseif($surface_fuzzing_and_pilling ==2.5)
                                        {
                                            $surface_fuzzing_and_pilling_value = '2-3';
                                        }
                                        elseif($surface_fuzzing_and_pilling ==3.0)
                                        {
                                            $surface_fuzzing_and_pilling_value = '3';
                                        }
                                        elseif($surface_fuzzing_and_pilling ==3.5)
                                        {
                                            $surface_fuzzing_and_pilling_value = '3-4';
                                        }
                                        elseif($surface_fuzzing_and_pilling ==4.0)
                                        {
                                            $surface_fuzzing_and_pilling_value = '4';
                                        }
                                        elseif($surface_fuzzing_and_pilling ==4.5)
                                        {
                                            $surface_fuzzing_and_pilling_value = '4-5';
                                        }
                                        elseif($surface_fuzzing_and_pilling ==5.0)
                                        {
                                            $surface_fuzzing_and_pilling_value = '5';
                                        } 				// for test result
        
                                    }

                                    $form.="<div class='form-group from-group-sm row'>
                                    <div class='col-sm-1'><b style='font-size: 20px;' >".$serial.".</b></div>
                                    <div class='col-sm-11' id='form-group_for_test_report_of_ikea'>
                                        <div class='col-sm-10'>
                                                <table class='table table-bordered'>
                                                
                                                            <thead>
                                                            <tr>
                                                                <label class='col-sm-12' for='name' style='font-size: 20px;' >".$row['test_name_method']." : </label>
                                                            </tr>
                                                            <tr>
                                                                <th class='text-center'>Result</th>
                                                                <th class='text-center'>Requirements</th>                                   
                                                            </tr>
                                                            
                                                            </thead>
                                                            <tbody>
                                                            <tr>
                                                                <td class='text-center' >".$surface_fuzzing_and_pilling_value."</td>
                                                                <td class='text-center'>".$row_for_defining_process['surface_fuzzing_and_pilling_tolerance_range_math_operator'].' '.$surface_fuzzing_and_pilling_tolerance_value."</td>
                                                            </tr>
                                                            
                                                            </tbody>
                                                        </table>
                                                    
                                                    </div>
                                                    </div>
                                                </div>";

                                }
                                echo $form;
                                $form = "";
                            }  /*End of if (in_array($row['id'], ['6']))*/

                            if (in_array($row['id'], ['7']))
                            {
                                
                                if (($row_for_defining_process['tensile_properties_in_warp_value_max_value']<>0 && $row_for_qc['tensile_properties_in_warp_value']<>0) || ($row_for_defining_process['tensile_properties_in_weft_value_max_value']<>0 && $row_for_qc['tensile_properties_in_weft_value']<>0) )
                                {
                                    
                                    $serial+=1;
                                    $form.="<div class='form-group from-group-sm row'>
                                    <div class='col-sm-1'><b style='font-size: 20px;' >".$serial.".</b></div>
                                    <div class='col-sm-11' id='form-group_for_test_report_of_ikea'>
                                        <div class='col-sm-10'>
                                                        <table class='table table-bordered'>
                                                            <thead>
                                                            <tr>
                                                                <label class='col-sm-12' for=name' style='font-size: 20px;' >".$row['test_name_method'].": </label>

                                                            </tr>
                                                            <tr>
                                                                <th class='text-center' colspan='2'>Result</th>
                                                                <th class='text-center'>Requirements</th>                                   
                                                            </tr>
                                                            
                                                            </thead>
                                                            <tbody>
                                                            <tr>
                                                                <th class='text-center'>Warp</th>
                                                                <td class='text-center' >".$row_for_qc['tensile_properties_in_warp_value'].' ' .$row_for_defining_process['uom_of_tensile_properties_in_warp_value']."</td>
                                                                <td class='text-center'>".$row_for_defining_process['tensile_properties_in_warp_value_tolerance_range_math_operator'].$row_for_defining_process['tensile_properties_in_warp_value_tolerance_value'].' ' .$row_for_defining_process['uom_of_tensile_properties_in_warp_value']."</td>
                                                            </tr>

                                                            <tr>
                                                                <th class='text-center'>Weft</th>
                                                                <td class='text-center' >".$row_for_qc['tensile_properties_in_weft_value'].' ' .$row_for_defining_process['uom_of_tensile_properties_in_weft_value']."</td>
                                                                <td class='text-center'>".$row_for_defining_process['tensile_properties_in_weft_value_tolerance_range_math_operator'].$row_for_defining_process['tensile_properties_in_weft_value_tolerance_value'].' ' .$row_for_defining_process['uom_of_tensile_properties_in_weft_value']."</td>
                                                            </tr>
                                                        
                                                            
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div> ";

                                }
                                echo $form;
                                $form = "";

                            } /*End of if (in_array($row['id'], ['7']))*/

                            if (in_array($row['id'], ['8']))
                            {
                                
                                if (($row_for_defining_process['tear_force_in_warp_value_max_value']<>0 && $row_for_qc['tear_force_in_warp_value']<>0 ) || ($row_for_defining_process['tear_force_in_weft_value_max_value']<>0 && $row_for_qc['tear_force_in_weft_value']<>0 ) ) 
                                {
                                    
                                    $serial+=1;
                                    $form.="<div class='form-group from-group-sm row'>
                                    <div class='col-sm-1'><b style='font-size: 20px;' >".$serial.".</b></div>
                                    <div class='col-sm-11' id='form-group_for_test_report_of_ikea'>
                                        <div class='col-sm-10'>
                                                        <table class='table table-bordered'>
                                                            <thead>
                                                            <tr>
                                                                <label class='col-sm-12' for=name' style='font-size: 20px;' >".$row['test_name_method'].": </label>

                                                            </tr>
                                                            <tr>
                                                                <th class='text-center' colspan='2'>Result</th>
                                                                <th class='text-center'>Requirements</th>                                   
                                                            </tr>
                                                            
                                                            </thead>
                                                            <tbody>
                                                            <tr>
                                                                <th class='text-center'>Warp</th>
                                                                <td class='text-center' >".$row_for_qc['tear_force_in_warp_value'].' ' .$row_for_defining_process['uom_of_tear_force_in_warp_value']."</td>
                                                                <td class='text-center'>".$row_for_defining_process['tear_force_in_warp_value_tolerance_range_math_operator'].$row_for_defining_process['tear_force_in_warp_value_tolerance_value'].' ' .$row_for_defining_process['uom_of_tear_force_in_warp_value']."</td>
                                                            </tr>

                                                            <tr>
                                                                <th class='text-center'>Weft</th>
                                                                <td class='text-center' >".$row_for_qc['tear_force_in_weft_value'].' ' .$row_for_defining_process['uom_of_tear_force_in_weft_value']."</td>
                                                                <td class='text-center'>".$row_for_defining_process['tear_force_in_weft_value_tolerance_range_math_operator'].$row_for_defining_process['tear_force_in_weft_value_tolerance_value'].' ' .$row_for_defining_process['uom_of_tear_force_in_weft_value']."</td>
                                                            </tr>
                                                        
                                                            
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div> ";

                                }
                                echo $form;
                                $form = "";

                            } /*End of if (in_array($row['id'], ['8']))*/

                            if (in_array($row['id'], ['9']))
                            {
                                
                                if (($row_for_defining_process['seam_slippage_resistance_in_warp_max_value']<>0 && $row_for_qc['seam_slippage_resistance_in_warp_value']<>0) || ($row_for_defining_process['seam_slippage_resistance_in_weft_max_value']<>0 && $row_for_qc['seam_slippage_resistance_in_weft_value'])<>0 ) 
                                {
                                    
                                    $serial+=1;
                                    $form.="<div class='form-group from-group-sm row'>
                                    <div class='col-sm-1'><b style='font-size: 20px;' >".$serial.".</b></div>
                                    <div class='col-sm-11' id='form-group_for_test_report_of_ikea'>
                                        <div class='col-sm-10'>
                                                        <table class='table table-bordered'>
                                                            <thead>
                                                            <tr>
                                                                <label class='col-sm-12' for=name' style='font-size: 20px;' >".$row['test_name_method'].": </label>

                                                            </tr>
                                                            <tr>
                                                                <th class='text-center' colspan='2'>Result</th>
                                                                <th class='text-center'>Requirements</th>                                   
                                                            </tr>
                                                            
                                                            </thead>
                                                            <tbody>
                                                            <tr>
                                                                <th class='text-center'>Warp</th>
                                                                <td class='text-center'>".$row_for_qc['seam_slippage_resistance_in_warp_value'].' '.$row_for_defining_process['uom_of_seam_slippage_resistance_in_warp']."</td>
                                                                <td class='text-center'>".$row_for_defining_process['seam_slippage_resistance_in_warp_tolerance_range_math_operator'].' '.$row_for_defining_process['seam_slippage_resistance_in_warp_tolerance_value'].' '.$row_for_defining_process['uom_of_seam_slippage_resistance_in_warp']."</td>
                                                                </tr>

                                                            <tr>
                                                                <th class='text-center'>Weft</th>
                                                                <td class='text-center'>".$row_for_qc['seam_slippage_resistance_in_weft_value'].' '.$row_for_defining_process['uom_of_seam_slippage_resistance_in_weft']."</td>
                                                                <td class='text-center'>".$row_for_defining_process['seam_slippage_resistance_in_weft_tolerance_range_math_operator'].' '.$row_for_defining_process['seam_slippage_resistance_in_weft_tolerance_value'].' '.$row_for_defining_process['uom_of_seam_slippage_resistance_in_weft']."</td>
                                                                </tr>
                                                        
                                                            
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div> ";

                                }
                                echo $form;
                                $form = "";

                            } /*End of if (in_array($row['id'], ['9']))*/

                            if (in_array($row['id'], ['9']))
                            {
                                
                                if (($row_for_defining_process['seam_slippage_resistance_iso_2_in_warp_max_value']<>0 && $row_for_qc['seam_slippage_resistance_iso_2_in_warp_value']<>0) || ($row_for_defining_process['seam_slippage_resistance_iso_2_in_weft_max_value']<>0 && $row_for_qc['seam_slippage_resistance_iso_2_in_weft_value'])<>0) 
                                {
                                    
                                    $serial+=1;
                                    $form.="<div class='form-group from-group-sm row'>
                                    <div class='col-sm-1'><b style='font-size: 20px;' >".$serial.".</b></div>
                                    <div class='col-sm-11' id='form-group_for_test_report_of_ikea'>
                                        <div class='col-sm-10'>
                                                        <table class='table table-bordered'>
                                                            <thead>
                                                            <tr>
                                                                <label class='col-sm-12' for=name' style='font-size: 20px;' >".$row['test_name_method'].": </label>

                                                            </tr>
                                                            <tr>
                                                                <th class='text-center' colspan='2'>Result</th>
                                                                <th class='text-center'>Requirements</th>                                   
                                                            </tr>
                                                            
                                                            </thead>
                                                            <tbody>
                                                            <tr>
                                                                <th class='text-center'>Warp</th>
                                                                <td class='text-center'>".$row_for_qc['seam_slippage_resistance_iso_2_in_warp_value'].' '.$row_for_defining_process['uom_of_seam_slippage_resistance_iso_2_in_warp']."</td>
                                                                <td class='text-center'>".$row_for_defining_process['seam_slippage_resistance_iso_2_in_warp_tolerance_range_math_operator'].' '.$row_for_defining_process['seam_slippage_resistance_iso_2_in_warp_tolerance_value'].' '.$row_for_defining_process['uom_of_seam_slippage_resistance_iso_2_in_warp']."</td>
                                                                </tr>

                                                            <tr>
                                                                <th class='text-center'>Weft</th>
                                                                <td class='text-center'>".$row_for_qc['seam_slippage_resistance_iso_2_in_weft_value'].' '.$row_for_defining_process['uom_of_seam_slippage_resistance_iso_2_in_weft']."</td>
                                                                <td class='text-center'>".$row_for_defining_process['seam_slippage_resistance_iso_2_in_weft_tolerance_range_math_operator'].' '.$row_for_defining_process['seam_slippage_resistance_iso_2_in_weft_tolerance_value'].' '.$row_for_defining_process['uom_of_seam_slippage_resistance_iso_2_in_weft']."</td>
                                                                </tr>
                                                        
                                                            
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div> ";

                                }
                                echo $form;
                                $form = "";

                            } /*End of if (in_array($row['id'], ['9']))*/

                            if (in_array($row['id'], ['11']))
                            {
                                
                                if (($row_for_defining_process['seam_strength_in_warp_value_max_value']<>0 && $row_for_qc['seam_strength_in_warp_value']<>0) || ($row_for_defining_process['seam_strength_in_weft_value_max_value']<>0 && $row_for_qc['seam_strength_in_weft_value']<>0) ) 
                                {
                                    
                                    $serial+=1;
                                    $form.="<div class='form-group from-group-sm row'>
                                    <div class='col-sm-1'><b style='font-size: 20px;' >".$serial.".</b></div>
                                    <div class='col-sm-11' id='form-group_for_test_report_of_ikea'>
                                        <div class='col-sm-10'>
                                                        <table class='table table-bordered'>
                                                            <thead>
                                                            <tr>
                                                                <label class='col-sm-12' for=name' style='font-size: 20px;' >".$row['test_name_method'].": </label>

                                                            </tr>
                                                            <tr>
                                                                <th class='text-center' colspan='2'>Result</th>
                                                                <th class='text-center'>Requirements</th>                                   
                                                            </tr>
                                                            
                                                            </thead>
                                                            <tbody>
                                                            <tr>
                                                                <th class='text-center'>Warp</th>
                                                                <td>".$row_for_qc['seam_strength_in_warp_value'].' '.$row_for_defining_process['uom_of_seam_strength_in_warp_value']."</td>
                                                                <td>".$row_for_defining_process['seam_strength_in_warp_value_tolerance_range_math_operator'].' '.$row_for_defining_process['seam_strength_in_warp_value_tolerance_value'].' '.$row_for_defining_process['uom_of_seam_strength_in_warp_value']."</td>
                                                                </tr>

                                                            <tr>
                                                                <th class='text-center'>Weft</th>
                                                                <td>".$row_for_qc['seam_strength_in_weft_value'].' '.$row_for_defining_process['uom_of_seam_strength_in_weft_value']."</td>
                                                                <td>".$row_for_defining_process['seam_strength_in_weft_value_tolerance_range_math_operator'].' '.$row_for_defining_process['seam_strength_in_weft_value_tolerance_value'].' '.$row_for_defining_process['uom_of_seam_strength_in_weft_value']."</td>
                                                                </tr>
                                                        
                                                            
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div> ";

                                }
                                echo $form;
                                $form = "";

                            } /*End of if (in_array($row['id'], ['11']))*/

                            if (in_array($row['id'], ['12']))
                            {
                                 

                                if (($row_for_defining_process['seam_properties_seam_slippage_iso_astm_d_in_warp_max_value']<>0 && $row_for_qc['seam_properties_seam_slippage_iso_astm_d_in_warp_value']<>0) ||($row_for_defining_process['seam_properties_seam_slippage_iso_astm_d_in_weft_max_value']<>0 && $row_for_qc['seam_properties_seam_slippage_iso_astm_d_in_weft_value']) ) 
                                {
                                    $serial+=1;
                                    $form.="<div class='form-group from-group-sm row'>
                                    <div class='col-sm-1'><b style='font-size: 20px;' >".$serial.".</b></div>
                                    <div class='col-sm-11' id='form-group_for_test_report_of_ikea'>
                                        <div class='col-sm-10'>
                                            <table class='table table-bordered'>
                                                <thead>
                                                <tr>
                                                    <label class='col-sm-12' for=name' style='font-size: 20px;' >".$row['test_name_method'].": </label>

                                                </tr>
                                                <tr>
                                                    <th class='text-center' colspan='2'>Result</th>
                                                    <th class='text-center'>Requirements</th>                                   
                                                </tr>
                                                
                                                </thead>
                                                <tbody>";
                                    $form.="<tr>
                                            <th class='text-center'>Warp</th>
                                            <td>".$row_for_qc['seam_properties_seam_slippage_iso_astm_d_in_warp_value'].' '.$row_for_defining_process['uom_of_seam_properties_seam_slippage_iso_astm_d_in_warp']."</td>
                                            <td>".$row_for_defining_process['seam_properties_seam_slippage_iso_astm_d_in_warp_tol_range_mt_op'].' '.$row_for_defining_process['seam_properties_seam_slippage_iso_astm_d_in_warp_tolerance_value'].' '.$row_for_defining_process['uom_of_seam_properties_seam_slippage_iso_astm_d_in_warp']."</td>
                                        </tr>

                                        <tr>
                                            <th class='text-center'>Weft</th>
                                            <td>".$row_for_qc['seam_properties_seam_slippage_iso_astm_d_in_weft_value'].' '.$row_for_defining_process['uom_of_seam_properties_seam_slippage_iso_astm_d_in_weft']."</td>
                                            <td>".$row_for_defining_process['seam_properties_seam_slippage_iso_astm_d_in_weft_tol_range_mt_op'].' '.$row_for_defining_process['seam_properties_seam_slippage_iso_astm_d_in_weft_tolerance_value'].' '.$row_for_defining_process['uom_of_seam_properties_seam_slippage_iso_astm_d_in_weft']."</td>
                                        </tr>";
                                    $form.="</tbody>
                                    </table>
                                        </div>
                                    </div>
                                    </div> ";
                                }

                                if (($row_for_defining_process['seam_properties_seam_strength_iso_astm_d_in_warp_max_value']<>0 && $row_for_qc['seam_properties_seam_strength_iso_astm_d_in_warp_value']<>0) ||($row_for_defining_process['seam_properties_seam_strength_iso_astm_d_in_warp_max_value']<>0 && $row_for_qc['seam_properties_seam_strength_iso_astm_d_in_weft_value']) ) 
                                {
                                    $serial+=1;
                                    $form.="<div class='form-group from-group-sm row'>
                                    <div class='col-sm-1'><b style='font-size: 20px;' >".$serial.".</b></div>
                                    <div class='col-sm-11' id='form-group_for_test_report_of_ikea'>
                                        <div class='col-sm-10'>
                                            <table class='table table-bordered'>
                                                <thead>
                                                <tr>
                                                    <label class='col-sm-12' for=name' style='font-size: 20px;' >".$row['test_name_method'].": </label>

                                                </tr>
                                                <tr>
                                                    <th class='text-center' colspan='2'>Result</th>
                                                    <th class='text-center'>Requirements</th>                                   
                                                </tr>
                                                
                                                </thead>
                                                <tbody>";

                                                $form.="<tr>
                                                    <th class='text-center'>Warp</th>
                                                    <td>".$row_for_qc['seam_properties_seam_strength_iso_astm_d_in_warp_value'].' '.$row_for_defining_process['uom_of_seam_properties_seam_strength_iso_astm_d_in_warp']."</td>
                                                    <td>".$row_for_defining_process['seam_properties_seam_strength_iso_astm_d_in_warp_tol_range_op'].' '.$row_for_defining_process['seam_properties_seam_strength_iso_astm_d_in_warp_tolerance_value'].' '.$row_for_defining_process['uom_of_seam_properties_seam_strength_iso_astm_d_in_warp']."</td>
                                                    </tr>

                                                <tr>
                                                    <th class='text-center'>Weft</th>
                                                    <td>".$row_for_qc['seam_properties_seam_strength_iso_astm_d_in_weft_value'].' '.$row_for_defining_process['uom_of_seam_properties_seam_strength_iso_astm_d_in_weft']."</td>
                                                    <td>".$row_for_defining_process['seam_properties_seam_strength_iso_astm_d_in_weft_tol_range_op'].' '.$row_for_defining_process['seam_properties_seam_strength_iso_astm_d_in_weft_tolerance_value'].' '.$row_for_defining_process['uom_of_seam_properties_seam_strength_iso_astm_d_in_weft']."</td>
                                                    </tr>";
                                    $form.="</tbody>
                                    </table>
                                        </div>
                                    </div>
                                    </div> ";       

                                }
                                           
                                echo $form;
                                $form = "";

                            } /*End of if (in_array($row['id'], ['12']))*/


                            if (in_array($row['id'], ['13']))
                            {
                                
                                if (($row_for_defining_process['abrasion_resistance_no_of_thread_break_max_value']<>0 && $row_for_qc['abrasion_resistance_no_of_thread_break_value']<>0) || ($row_for_defining_process['abrasion_resistance_c_change_max_value']<>0 && $row_for_qc['abrasion_resistance_c_change_value']<>0) ) 
                                {
                                    
                                    $serial+=1;
                                    if($customer_type == 'american')
                                    {
                                        $abrasion_resistance_c_change_value_tolerance_value = $row_for_defining_process['abrasion_resistance_c_change_value_tolerance_value'];
                                        $abrasion_resistance_c_change_value = $row_for_qc['abrasion_resistance_c_change_value'];

                                    }
                                    if($customer_type == 'european')
                                    {
                                                // for defining
                                        $abrasion_resistance_c_change_value_tolerance = $row_for_defining_process['abrasion_resistance_c_change_value_tolerance_value'];
                                    
                                        if($abrasion_resistance_c_change_value_tolerance ==1.0)
                                        {
                                            $abrasion_resistance_c_change_value_tolerance_value = '1';
                                        }
                                        elseif($abrasion_resistance_c_change_value_tolerance ==1.5)
                                        {
                                            $abrasion_resistance_c_change_value_tolerance_value = '1-2';
                                        }
                                        elseif($abrasion_resistance_c_change_value_tolerance ==2.0)
                                        {
                                            $abrasion_resistance_c_change_value_tolerance_value = '2';
                                        }
                                        elseif($abrasion_resistance_c_change_value_tolerance ==2.5)
                                        {
                                            $abrasion_resistance_c_change_value_tolerance_value = '2-3';
                                        }
                                        elseif($abrasion_resistance_c_change_value_tolerance ==3.0)
                                        {
                                            $abrasion_resistance_c_change_value_tolerance_value = '3';
                                        }
                                        elseif($abrasion_resistance_c_change_value_tolerance ==3.5)
                                        {
                                            $abrasion_resistance_c_change_value_tolerance_value = '3-4';
                                        }
                                        elseif($abrasion_resistance_c_change_value_tolerance ==4.0)
                                        {
                                            $abrasion_resistance_c_change_value_tolerance_value = '4';
                                        }
                                        elseif($abrasion_resistance_c_change_value_tolerance ==4.5)
                                        {
                                            $abrasion_resistance_c_change_value_tolerance_value = '4-5';
                                        }
                                        elseif($abrasion_resistance_c_change_value_tolerance ==5.0)
                                        {
                                            $abrasion_resistance_c_change_value_tolerance_value = '5';
                                        }
                                            // for test result
                                        $abrasion_resistance_c_change = $row_for_defining_process['abrasion_resistance_c_change_value'];
                                    
                                        if($abrasion_resistance_c_change ==1.0)
                                        {
                                            $abrasion_resistance_c_change_value = '1';
                                        }
                                        elseif($abrasion_resistance_c_change ==1.5)
                                        {
                                            $abrasion_resistance_c_change_value = '1-2';
                                        }
                                        elseif($abrasion_resistance_c_change ==2.0)
                                        {
                                            $abrasion_resistance_c_change_value = '2';
                                        }
                                        elseif($abrasion_resistance_c_change ==2.5)
                                        {
                                            $abrasion_resistance_c_change_value = '2-3';
                                        }
                                        elseif($abrasion_resistance_c_change ==3.0)
                                        {
                                            $abrasion_resistance_c_change_value = '3';
                                        }
                                        elseif($abrasion_resistance_c_change ==3.5)
                                        {
                                            $abrasion_resistance_c_change_value = '3-4';
                                        }
                                        elseif($abrasion_resistance_c_change ==4.0)
                                        {
                                            $abrasion_resistance_c_change_value = '4';
                                        }
                                        elseif($abrasion_resistance_c_change ==4.5)
                                        {
                                            $abrasion_resistance_c_change_value = '4-5';
                                        }
                                        elseif($abrasion_resistance_c_change ==5.0)
                                        {
                                            $abrasion_resistance_c_change_value = '5';
                                        }
                                    }


                                    $form.="<div class='form-group from-group-sm row'>
                                    <div class='col-sm-1'><b style='font-size: 20px;' >".$serial.".</b></div>
                                    <div class='col-sm-11' id='form-group_for_test_report_of_ikea'>
                                        <div class='col-sm-10'>
                                                        <table class='table table-bordered'>
                                                            <thead>
                                                            <tr>
                                                                <label class='col-sm-12' for=name' style='font-size: 20px;' >".$row['test_name_method'].": </label>

                                                            </tr>
                                                            <tr>
                                                                <th class='text-center' colspan='2'>Result</th>
                                                                <th class='text-center'>Requirements</th>                                   
                                                            </tr>
                                                            
                                                            </thead>
                                                            <tbody>
                                                            <tr>
                                                                <th class='text-center'>No. of thread</th>
                                                                <td>".$row_for_qc['abrasion_resistance_no_of_thread_break_value'].' '.$row_for_defining_process['uom_of_abrasion_resistance_no_of_thread_break']."</td>
                                                                <td>".$row_for_defining_process['abrasion_resistance_no_of_thread_break_min_value'].' to '.$row_for_defining_process['abrasion_resistance_no_of_thread_break_max_value'].' '.$row_for_defining_process['uom_of_seam_properties_seam_strength_iso_astm_d_in_weft']."</td>
                                                                </tr>

                                                            <tr>
                                                                <th class='text-center'>Color Change</th>
                                                                <td>".$abrasion_resistance_c_change_value.' '.$row_for_defining_process['uom_of_abrasion_resistance_c_change_value']."</td>
                                                                <td>".$row_for_defining_process['abrasion_resistance_c_change_value_math_op'].' '.$abrasion_resistance_c_change_value_tolerance_value.' '.$row_for_defining_process['uom_of_abrasion_resistance_c_change_value']."</td>
                                                                </tr>
                                                        
                                                            
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div> ";

                                }
                                echo $form;
                                $form = "";

                            } /*End of if (in_array($row['id'], ['13']))*/

                            if (in_array($row['id'], ['14']))
                            {
                                
                                if ($row_for_defining_process['mass_loss_in_abrasion_test_value_max_value']<>0 && $row_for_qc['mass_loss_in_abrasion_value']<>0) 
                                {
                                    
                                    $serial+=1;

                                    if($customer_type == 'american')
                                    {
                                        $mass_loss_in_abrasion_test_value_tolerance_value = $row_for_defining_process['mass_loss_in_abrasion_test_value_tolerance_value'];
                                        $mass_loss_in_abrasion_value = $row_for_qc['mass_loss_in_abrasion_value'];
        
                                    }
                                    if($customer_type == 'european')
                                    {
        
                                        $mass_loss_in_abrasion_test_value_tolerance = $row_for_defining_process['mass_loss_in_abrasion_test_value_tolerance_value'];
                                        
                                        if($mass_loss_in_abrasion_test_value_tolerance ==1)
                                        {
                                            $mass_loss_in_abrasion_test_value_tolerance_value = '1';
                                        }
                                        elseif($mass_loss_in_abrasion_test_value_tolerance ==1.5)
                                        {
                                            $mass_loss_in_abrasion_test_value_tolerance_value = '1-2';
                                        }
                                        elseif($mass_loss_in_abrasion_test_value_tolerance ==2)
                                        {
                                            $mass_loss_in_abrasion_test_value_tolerance_value = '2';
                                        }
                                        elseif($mass_loss_in_abrasion_test_value_tolerance ==2.5)
                                        {
                                            $mass_loss_in_abrasion_test_value_tolerance_value = '2-3';
                                        }
                                        elseif($mass_loss_in_abrasion_test_value_tolerance ==3)
                                        {
                                            $mass_loss_in_abrasion_test_value_tolerance_value = '3';
                                        }
                                        elseif($mass_loss_in_abrasion_test_value_tolerance ==3.5)
                                        {
                                            $mass_loss_in_abrasion_test_value_tolerance_value = '3-4';
                                        }
                                        elseif($mass_loss_in_abrasion_test_value_tolerance ==4)
                                        {
                                            $mass_loss_in_abrasion_test_value_tolerance_value = '4';
                                        }
                                        elseif($mass_loss_in_abrasion_test_value_tolerance ==4.5)
                                        {
                                            $mass_loss_in_abrasion_test_value_tolerance_value = '4-5';
                                        }
                                        elseif($mass_loss_in_abrasion_test_value_tolerance ==5)
                                        {
                                            $mass_loss_in_abrasion_test_value_tolerance_value = '5';
                                        }
                                        elseif($mass_loss_in_abrasion_test_value_tolerance ==5.5)
                                        {
                                            $mass_loss_in_abrasion_test_value_tolerance_value = '5-6';
                                        }
                                        elseif($mass_loss_in_abrasion_test_value_tolerance ==6)
                                        {
                                            $mass_loss_in_abrasion_test_value_tolerance_value = '6';
                                        }
                                        elseif($mass_loss_in_abrasion_test_value_tolerance ==6.5)
                                        {
                                            $mass_loss_in_abrasion_test_value_tolerance_value = '6-7';
                                        }
                                        elseif($mass_loss_in_abrasion_test_value_tolerance ==7)
                                        {
                                            $mass_loss_in_abrasion_test_value_tolerance_value = '7';
                                        }
                                        elseif($mass_loss_in_abrasion_test_value_tolerance ==7.5)
                                        {
                                            $mass_loss_in_abrasion_test_value_tolerance_value = '7-8';
                                        }
                                        elseif($mass_loss_in_abrasion_test_value_tolerance ==8)
                                        {
                                            $mass_loss_in_abrasion_test_value_tolerance_value = '8';
                                        }
                                        elseif($mass_loss_in_abrasion_test_value_tolerance ==8.5)
                                        {
                                            $mass_loss_in_abrasion_test_value_tolerance_value = '8-9';
                                        }
                                        elseif($mass_loss_in_abrasion_test_value_tolerance ==9)
                                        {
                                            $mass_loss_in_abrasion_test_value_tolerance_value = '9';
                                        }
                                        elseif($mass_loss_in_abrasion_test_value_tolerance ==9.5)
                                        {
                                            $mass_loss_in_abrasion_test_value_tolerance_value = '9-10';
                                        }
                                        elseif($mass_loss_in_abrasion_test_value_tolerance ==10)
                                        {
                                            $mass_loss_in_abrasion_test_value_tolerance_value = '10';
                                        }		// for defining
        
                                        $mass_loss_in_abrasion = $row_for_qc['mass_loss_in_abrasion_value'];
                                    
                                        if($mass_loss_in_abrasion ==1)
                                        {
                                            $mass_loss_in_abrasion_value = '1';
                                        }
                                        elseif($mass_loss_in_abrasion ==1.5)
                                        {
                                            $mass_loss_in_abrasion_value = '1-2';
                                        }
                                        elseif($mass_loss_in_abrasion ==2)
                                        {
                                            $mass_loss_in_abrasion_value = '2';
                                        }
                                        elseif($mass_loss_in_abrasion ==2.5)
                                        {
                                            $mass_loss_in_abrasion_value = '2-3';
                                        }
                                        elseif($mass_loss_in_abrasion ==3)
                                        {
                                            $mass_loss_in_abrasion_value = '3';
                                        }
                                        elseif($mass_loss_in_abrasion ==3.5)
                                        {
                                            $mass_loss_in_abrasion_value = '3-4';
                                        }
                                        elseif($mass_loss_in_abrasion ==4)
                                        {
                                            $mass_loss_in_abrasion_value = '4';
                                        }
                                        elseif($mass_loss_in_abrasion ==4.5)
                                        {
                                            $mass_loss_in_abrasion_value = '4-5';
                                        }
                                        elseif($mass_loss_in_abrasion ==5)
                                        {
                                            $mass_loss_in_abrasion_value = '5';
                                        }
                                        elseif($mass_loss_in_abrasion ==5.5)
                                        {
                                            $mass_loss_in_abrasion_value = '5-6';
                                        }
                                        elseif($mass_loss_in_abrasion ==6)
                                        {
                                            $mass_loss_in_abrasion_value = '6';
                                        }
                                        elseif($mass_loss_in_abrasion ==6.5)
                                        {
                                            $mass_loss_in_abrasion_value = '6-7';
                                        }
                                        elseif($mass_loss_in_abrasion ==7)
                                        {
                                            $mass_loss_in_abrasion_value = '7';
                                        }
                                        elseif($mass_loss_in_abrasion ==7.5)
                                        {
                                            $mass_loss_in_abrasion_value = '7-8';
                                        }
                                        elseif($mass_loss_in_abrasion ==8)
                                        {
                                            $mass_loss_in_abrasion_value = '8';
                                        }
                                        elseif($mass_loss_in_abrasion ==8.5)
                                        {
                                            $mass_loss_in_abrasion_value = '8-9';
                                        }
                                        elseif($mass_loss_in_abrasion ==9)
                                        {
                                            $mass_loss_in_abrasion_value = '9';
                                        }
                                        elseif($mass_loss_in_abrasion ==9.5)
                                        {
                                            $mass_loss_in_abrasion_value = '9-10';
                                        }
                                        elseif($mass_loss_in_abrasion ==10)
                                        {
                                            $mass_loss_in_abrasion_value = '10';
                                        }				// for test result
                                    }

                                    $form.="<div class='form-group from-group-sm row'>
                                    <div class='col-sm-1'><b style='font-size: 20px;' >".$serial.".</b></div>
                                    <div class='col-sm-11' id='form-group_for_test_report_of_ikea'>
                                        <div class='col-sm-10'>
                                                        <table class='table table-bordered'>
                                                            <thead>
                                                            <tr>
                                                                <label class='col-sm-12' for=name' style='font-size: 20px;' >".$row['test_name_method'].": </label>

                                                            </tr>
                                                            <tr>
                                                                <th class='text-center' colspan='2'>Result</th>
                                                                <th class='text-center'>Requirements</th>                                   
                                                            </tr>
                                                            
                                                            </thead>
                                                            <tbody>
                                                            <tr>
                                                                <th class='text-center'></th>
                                                                <td>".$mass_loss_in_abrasion_value.' '.$row_for_defining_process['uom_of_mass_loss_in_abrasion_test_value']."</td>
                                                                <td>".$row_for_defining_process['mass_loss_in_abrasion_test_value_tolerance_range_math_operator'].' '.$mass_loss_in_abrasion_test_value_tolerance_value.' '.$row_for_defining_process['uom_of_mass_loss_in_abrasion_test_value']."</td>
                                                                </tr>

                                                            
                                                            
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div> ";

                                }
                                echo $form;
                                $form = "";

                            } /*End of if (in_array($row['id'], ['14']))*/

                            if (in_array($row['id'], ['2']))
                            {  
                                if (($row_for_defining_process['dimensional_stability_to_warp_washing_before_iron_max_value']<>0 && $row_for_qc_supplimentery['dimensional_stability_to_warp_washing_before_iron_value']<>0) || ($row_for_defining_process['dimensional_stability_to_weft_washing_before_iron_max_value']<>0 && $row_for_qc_supplimentery['dimensional_stability_to_weft_washing_before_iron_value']<>0) )
                                {  
                                    $serial+=1;
                                    $form.="<div class='form-group from-group-sm row'>
                                    <div class='col-sm-1'><b style='font-size: 20px;' >".$serial.".</b></div>
                                    <div class='col-sm-11' id='form-group_for_test_report_of_ikea'>
                                        <div class='col-sm-10'>
                                                <table class='table table-bordered'>
                                                
                                                            <thead>
                                                            <tr>
                                                                <label class='col-sm-12' for='name' style='font-size: 20px;' >".$row['test_name_method']." : </label>
                                                                
                                                            </tr>

                                                            <tr>
                                                                
                                                                <textarea type='text' id='wool' class='col-sm-12' style='border: none;'> </textarea>
                                                            </tr>
                                                    
                                                            <tr>
                                                                <th class='text-center'>Direction</th>
                                                                <th class='text-center'>Result</th>
                                                                <th class='text-center'>Requirements</th>                                   
                                                            </tr>
                                                            
                                                            </thead>
                                                            <tbody>
                                                            <tr>
                                                                <th class='text-center'>Average Warp</th>
                                                                <td class='text-center' >".$row_for_qc_supplimentery['dimensional_stability_to_warp_washing_before_iron_value'].' ' .$row_for_defining_process['uom_of_dimensional_stability_to_warp_washing_before_iron']."</td>
                                                                <td class='text-center'>"."(".$row_for_defining_process['dimensional_stability_to_warp_washing_before_iron_min_value']." to ".$row_for_defining_process['dimensional_stability_to_warp_washing_before_iron_max_value'].') ' .$row_for_defining_process['uom_of_dimensional_stability_to_warp_washing_before_iron']."</td>
                                                            </tr>

                                                            <tr>
                                                                <th class='text-center'>Average Weft</th>
                                                                <td class='text-center' >".$row_for_qc_supplimentery['dimensional_stability_to_weft_washing_before_iron_value'].' ' .$row_for_defining_process['uom_of_dimensional_stability_to_weft_washing_before_iron']."</td>
                                                                <td class='text-center'>"."(".$row_for_defining_process['dimensional_stability_to_weft_washing_before_iron_min_value']." to ".$row_for_defining_process['dimensional_stability_to_weft_washing_before_iron_max_value'].') ' .$row_for_defining_process['uom_of_dimensional_stability_to_weft_washing_before_iron']."</td>
                                                            </tr>
                                                            
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>";
                                }
                                echo $form;
                                $form = "";
                            }  /*End of if (in_array($row['id'], ['2']))*/

                            if (in_array($row['id'], ['3','106']))
                            {
                                if($row_for_defining_process['test_method_for_appearance_after_wash_fabric'] == 'Fabric (Mock up)' && $row_for_qc['test_method_for_appearance_after_wash'] == 'Fabric (Mock up)')
                                {
                                    $serial+=1;

                                    $form.="<div class='form-group from-group-sm row'>
                                        <div class='col-sm-1'><b style='font-size: 20px;' >".$serial.".</b></div>
                                        <div class='col-sm-11' id='form-group_for_test_report_of_ikea'>
                                            <div class='col-sm-10'>
                                                    <table class='table table-bordered'>
                                                
                                                        <thead>
                                                        <tr>
                                                            <label class='col-sm-12' for='name' style='font-size: 20px;' >".$row['test_name_method']." : </label>
                                                            
                                                        </tr>
                                                        
                                                        <tr>
                                                            <textarea type='text' id='wool' class='col-sm-12' style='border: none;'> </textarea>
                                                        </tr>
                                                        <tr>
                                                        <th class='text-center'>Assessment Criteria</th>
                                                        <th class='text-center'>Result / Comments</th>
                                                        <th class='text-center'>Requirements</th>
                                                        </tr>

                                                        </thead>
                                                        <tbody>";

                                                    if($row_for_defining_process['appearance_after_washing_fabric_color_change_max_value']<>0 )
                                                    {
                                                        if($customer_type == 'american')
                                                        {
                                                            $appearance_after_washing_fabric_color_change_tolerance_value = $row_for_defining_process['appearance_after_washing_fabric_color_change_tolerance_value'];
                                                            $appear_after_wash_fabric_color_change_value = $row_for_qc['appear_after_wash_fabric_color_change_value'];
                                
                                                        }
                                                        if($customer_type == 'european')
                                                        {
                                                            $appearance_after_washing_fabric_color_change_tolerance = $row_for_defining_process['appearance_after_washing_fabric_color_change_tolerance_value'];
                                                        
                                                            if($appearance_after_washing_fabric_color_change_tolerance ==1.0)
                                                            {
                                                                $appearance_after_washing_fabric_color_change_tolerance_value = '1';
                                                            }
                                                            elseif($appearance_after_washing_fabric_color_change_tolerance ==1.5)
                                                            {
                                                                $appearance_after_washing_fabric_color_change_tolerance_value = '1-2';
                                                            }
                                                            elseif($appearance_after_washing_fabric_color_change_tolerance ==2.0)
                                                            {
                                                                $appearance_after_washing_fabric_color_change_tolerance_value = '2';
                                                            }
                                                            elseif($appearance_after_washing_fabric_color_change_tolerance ==2.5)
                                                            {
                                                                $appearance_after_washing_fabric_color_change_tolerance_value = '2-3';
                                                            }
                                                            elseif($appearance_after_washing_fabric_color_change_tolerance ==3.0)
                                                            {
                                                                $appearance_after_washing_fabric_color_change_tolerance_value = '3';
                                                            }
                                                            elseif($appearance_after_washing_fabric_color_change_tolerance ==3.5)
                                                            {
                                                                $appearance_after_washing_fabric_color_change_tolerance_value = '3-4';
                                                            }
                                                            elseif($appearance_after_washing_fabric_color_change_tolerance ==4.0)
                                                            {
                                                                $appearance_after_washing_fabric_color_change_tolerance_value = '4';
                                                            }
                                                            elseif($appearance_after_washing_fabric_color_change_tolerance ==4.5)
                                                            {
                                                                $appearance_after_washing_fabric_color_change_tolerance_value = '4-5';
                                                            }
                                                            elseif($appearance_after_washing_fabric_color_change_tolerance ==5.0)
                                                            {
                                                                $appearance_after_washing_fabric_color_change_tolerance_value = '5';
                                                            }
                                
                                
                                
                                                            $appear_after_wash_fabric_color_change = $row_for_qc['appear_after_wash_fabric_color_change_value'];
                                                    
                                                            if($appear_after_wash_fabric_color_change ==1.0)
                                                            {
                                                                $appear_after_wash_fabric_color_change_value = '1';
                                                            }
                                                            elseif($appear_after_wash_fabric_color_change ==1.5)
                                                            {
                                                                $appear_after_wash_fabric_color_change_value = '1-2';
                                                            }
                                                            elseif($appear_after_wash_fabric_color_change ==2.0)
                                                            {
                                                                $appear_after_wash_fabric_color_change_value = '2';
                                                            }
                                                            elseif($appear_after_wash_fabric_color_change ==2.5)
                                                            {
                                                                $appear_after_wash_fabric_color_change_value = '2-3';
                                                            }
                                                            elseif($appear_after_wash_fabric_color_change ==3.0)
                                                            {
                                                                $appear_after_wash_fabric_color_change_value = '3';
                                                            }
                                                            elseif($appear_after_wash_fabric_color_change ==3.5)
                                                            {
                                                                $appear_after_wash_fabric_color_change_value = '3-4';
                                                            }
                                                            elseif($appear_after_wash_fabric_color_change ==4.0)
                                                            {
                                                                $appear_after_wash_fabric_color_change_value = '4';
                                                            }
                                                            elseif($appear_after_wash_fabric_color_change ==4.5)
                                                            {
                                                                $appear_after_wash_fabric_color_change_value = '4-5';
                                                            }
                                                            elseif($appear_after_wash_fabric_color_change ==5.0)
                                                            {
                                                                $appear_after_wash_fabric_color_change_value = '5';
                                                            } 				// for test result
                                                        }
                                                        
                                                        $form.="<tr>
                                                            <th >Fabric (Color Change)</th>
                                                            <td class='text-center'>".$appear_after_wash_fabric_color_change_value."</td>
                                                            <td class='text-center'>".$row_for_defining_process['appearance_after_washing_fabric_color_change_math_op'].' '.$appearance_after_washing_fabric_color_change_tolerance_value."</td>
                                                            </tr>";
                                                    }
                                                    if($row_for_defining_process['appearance_after_washing_fabric_cross_staining_max_value']<>0 )
                                                    {
                                                            //$serial+=1;
                                                        if($customer_type == 'american')
                                                        {
                                                            $appearance_after_washing_fabric_cross_staining_tolerance_value = $row_for_defining_process['appearance_after_washing_fabric_cross_staining_tolerance_value'];
                                                            $appearance_after_washing_fabric_cross_staining_value = $row_for_qc['appearance_after_washing_fabric_cross_staining_value'];
                                
                                                        }
                                                        if($customer_type == 'european')
                                                        {
                                                            $appearance_after_washing_fabric_cross_staining_tolerance = $row_for_defining_process['appearance_after_washing_fabric_cross_staining_tolerance_value'];
                            
                                                            if($appearance_after_washing_fabric_cross_staining_tolerance ==1.0)
                                                            {
                                                                $appearance_after_washing_fabric_cross_staining_tolerance_value = '1';
                                                            }
                                                            elseif($appearance_after_washing_fabric_cross_staining_tolerance ==1.5)
                                                            {
                                                                $appearance_after_washing_fabric_cross_staining_tolerance_value = '1-2';
                                                            }
                                                            elseif($appearance_after_washing_fabric_cross_staining_tolerance ==2.0)
                                                            {
                                                                $appearance_after_washing_fabric_cross_staining_tolerance_value = '2';
                                                            }
                                                            elseif($appearance_after_washing_fabric_cross_staining_tolerance ==2.5)
                                                            {
                                                                $appearance_after_washing_fabric_cross_staining_tolerance_value = '2-3';
                                                            }
                                                            elseif($appearance_after_washing_fabric_cross_staining_tolerance ==3.0)
                                                            {
                                                                $appearance_after_washing_fabric_cross_staining_tolerance_value = '3';
                                                            }
                                                            elseif($appearance_after_washing_fabric_cross_staining_tolerance ==3.5)
                                                            {
                                                                $appearance_after_washing_fabric_cross_staining_tolerance_value = '3-4';
                                                            }
                                                            elseif($appearance_after_washing_fabric_cross_staining_tolerance ==4.0)
                                                            {
                                                                $appearance_after_washing_fabric_cross_staining_tolerance_value = '4';
                                                            }
                                                            elseif($appearance_after_washing_fabric_cross_staining_tolerance ==4.5)
                                                            {
                                                                $appearance_after_washing_fabric_cross_staining_tolerance_value = '4-5';
                                                            }
                                                            elseif($appearance_after_washing_fabric_cross_staining_tolerance ==5.0)
                                                            {
                                                                $appearance_after_washing_fabric_cross_staining_tolerance_value = '5';
                                                            }
                                
                                
                                                            $appearance_after_washing_fabric_cross_staining = $row_for_qc['appearance_after_washing_fabric_cross_staining_value'];
                                                    
                                                            if($appearance_after_washing_fabric_cross_staining ==1.0)
                                                            {
                                                                $appearance_after_washing_fabric_cross_staining_value = '1';
                                                            }
                                                            elseif($appearance_after_washing_fabric_cross_staining ==1.5)
                                                            {
                                                                $appearance_after_washing_fabric_cross_staining_value = '1-2';
                                                            }
                                                            elseif($appearance_after_washing_fabric_cross_staining ==2.0)
                                                            {
                                                                $appearance_after_washing_fabric_cross_staining_value = '2';
                                                            }
                                                            elseif($appearance_after_washing_fabric_cross_staining ==2.5)
                                                            {
                                                                $appearance_after_washing_fabric_cross_staining_value = '2-3';
                                                            }
                                                            elseif($appearance_after_washing_fabric_cross_staining ==3.0)
                                                            {
                                                                $appearance_after_washing_fabric_cross_staining_value = '3';
                                                            }
                                                            elseif($appearance_after_washing_fabric_cross_staining ==3.5)
                                                            {
                                                                $appearance_after_washing_fabric_cross_staining_value = '3-4';
                                                            }
                                                            elseif($appearance_after_washing_fabric_cross_staining ==4.0)
                                                            {
                                                                $appearance_after_washing_fabric_cross_staining_value = '4';
                                                            }
                                                            elseif($appearance_after_washing_fabric_cross_staining ==4.5)
                                                            {
                                                                $appearance_after_washing_fabric_cross_staining_value = '4-5';
                                                            }
                                                            elseif($appearance_after_washing_fabric_cross_staining ==5.0)
                                                            {
                                                                $appearance_after_washing_fabric_cross_staining_value = '5';
                                                            } 				// for test result
                                
                                                        }

                                                            $form.="<tr>
                                                            <th >Fabric (Cross Staining)</th>
                                                            <td class='text-center'>".$appearance_after_washing_fabric_cross_staining_value."</td>
                                                            <td class='text-center'>".$row_for_defining_process['appearance_after_washing_fabric_cross_staining_math_op'].' '.$appearance_after_washing_fabric_cross_staining_tolerance_value."</td>
                                                            </tr>";
                                                    }
                                                    if($row_for_defining_process['appearance_after_washing_fabric_surface_fuzzing_max_value']<>0)
                                                    {

                                                            if($customer_type == 'american')
                                                            {
                                                                $appearance_after_washing_fabric_surface_fuzzing_tolerance_value = $row_for_defining_process['appearance_after_washing_fabric_surface_fuzzing_tolerance_value'];
                                                                $appearance_after_washing_fabric_surface_fuzzing_value = $row_for_qc['appearance_after_washing_fabric_surface_fuzzing_value'];

                                                            }
                                                            if($customer_type == 'european')
                                                            {
                                                                $appearance_after_washing_fabric_surface_fuzzing_tolerance = $row_for_defining_process['appearance_after_washing_fabric_surface_fuzzing_tolerance_value'];

                                                                if($appearance_after_washing_fabric_surface_fuzzing_tolerance ==1.0)
                                                                {
                                                                    $appearance_after_washing_fabric_surface_fuzzing_tolerance_value = '1';
                                                                }
                                                                elseif($appearance_after_washing_fabric_surface_fuzzing_tolerance ==1.5)
                                                                {
                                                                    $appearance_after_washing_fabric_surface_fuzzing_tolerance_value = '1-2';
                                                                }
                                                                elseif($appearance_after_washing_fabric_surface_fuzzing_tolerance ==2.0)
                                                                {
                                                                    $appearance_after_washing_fabric_surface_fuzzing_tolerance_value = '2';
                                                                }
                                                                elseif($appearance_after_washing_fabric_surface_fuzzing_tolerance ==2.5)
                                                                {
                                                                    $appearance_after_washing_fabric_surface_fuzzing_tolerance_value = '2-3';
                                                                }
                                                                elseif($appearance_after_washing_fabric_surface_fuzzing_tolerance ==3.0)
                                                                {
                                                                    $appearance_after_washing_fabric_surface_fuzzing_tolerance_value = '3';
                                                                }
                                                                elseif($appearance_after_washing_fabric_surface_fuzzing_tolerance ==3.5)
                                                                {
                                                                    $appearance_after_washing_fabric_surface_fuzzing_tolerance_value = '3-4';
                                                                }
                                                                elseif($appearance_after_washing_fabric_surface_fuzzing_tolerance ==4.0)
                                                                {
                                                                    $appearance_after_washing_fabric_surface_fuzzing_tolerance_value = '4';
                                                                }
                                                                elseif($appearance_after_washing_fabric_surface_fuzzing_tolerance ==4.5)
                                                                {
                                                                    $appearance_after_washing_fabric_surface_fuzzing_tolerance_value = '4-5';
                                                                }
                                                                elseif($appearance_after_washing_fabric_surface_fuzzing_tolerance ==5.0)
                                                                {
                                                                    $appearance_after_washing_fabric_surface_fuzzing_tolerance_value = '5';
                                                                }
                                
                                
                                                                $appearance_after_washing_fabric_surface_fuzzing = $row_for_qc['appearance_after_washing_fabric_surface_fuzzing_value'];
                                                        
                                                                if($appearance_after_washing_fabric_surface_fuzzing ==1.0)
                                                                {
                                                                    $appearance_after_washing_fabric_surface_fuzzing_value = '1';
                                                                }
                                                                elseif($appearance_after_washing_fabric_surface_fuzzing ==1.5)
                                                                {
                                                                    $appearance_after_washing_fabric_surface_fuzzing_value = '1-2';
                                                                }
                                                                elseif($appearance_after_washing_fabric_surface_fuzzing ==2.0)
                                                                {
                                                                    $appearance_after_washing_fabric_surface_fuzzing_value = '2';
                                                                }
                                                                elseif($appearance_after_washing_fabric_surface_fuzzing ==2.5)
                                                                {
                                                                    $appearance_after_washing_fabric_surface_fuzzing_value = '2-3';
                                                                }
                                                                elseif($appearance_after_washing_fabric_surface_fuzzing ==3.0)
                                                                {
                                                                    $appearance_after_washing_fabric_surface_fuzzing_value = '3';
                                                                }
                                                                elseif($appearance_after_washing_fabric_surface_fuzzing ==3.5)
                                                                {
                                                                    $appearance_after_washing_fabric_surface_fuzzing_value = '3-4';
                                                                }
                                                                elseif($appearance_after_washing_fabric_surface_fuzzing ==4.0)
                                                                {
                                                                    $appearance_after_washing_fabric_surface_fuzzing_value = '4';
                                                                }
                                                                elseif($appearance_after_washing_fabric_surface_fuzzing ==4.5)
                                                                {
                                                                    $appearance_after_washing_fabric_surface_fuzzing_value = '4-5';
                                                                }
                                                                elseif($appearance_after_washing_fabric_surface_fuzzing ==5.0)
                                                                {
                                                                    $appearance_after_washing_fabric_surface_fuzzing_value = '5';
                                                                } 				// for test result

                                                            }

                                                            $form.="<tr>
                                                            <th >Fabric (Surface Fuzzing)</th>
                                                            <td class='text-center'> ".$appearance_after_washing_fabric_surface_fuzzing_value."</td>
                                                            <td class='text-center'> ".$row_for_defining_process['appearance_after_washing_fabric_surface_fuzzing_math_op'].' '.$appearance_after_washing_fabric_surface_fuzzing_tolerance_value."</td>
                                                            </tr>";
                                                    }

                                                    if($row_for_defining_process['appearance_after_washing_fabric_surface_pilling_max_value']<>0)
                                                    {
                                                        if($customer_type == 'american')
                                                        {
                                                            $appearance_after_washing_fabric_surface_pilling_tolerance_value = $row_for_defining_process['appearance_after_washing_fabric_surface_pilling_tolerance_value'];
                                                            $appearance_after_washing_fabric_surface_pilling_value = $row_for_qc['appearance_after_washing_fabric_surface_pilling_value'];
                            
                                                        }
                                                        if($customer_type == 'european')
                                                        {
                                                            $appearance_after_washing_fabric_surface_pilling_tolerance = $row_for_defining_process['appearance_after_washing_fabric_surface_pilling_tolerance_value'];
                                                        
                                                            if($appearance_after_washing_fabric_surface_pilling_tolerance ==1.0)
                                                            {
                                                                $appearance_after_washing_fabric_surface_pilling_tolerance_value = '1';
                                                            }
                                                            elseif($appearance_after_washing_fabric_surface_pilling_tolerance ==1.5)
                                                            {
                                                                $appearance_after_washing_fabric_surface_pilling_tolerance_value = '1-2';
                                                            }
                                                            elseif($appearance_after_washing_fabric_surface_pilling_tolerance ==2.0)
                                                            {
                                                                $appearance_after_washing_fabric_surface_pilling_tolerance_value = '2';
                                                            }
                                                            elseif($appearance_after_washing_fabric_surface_pilling_tolerance ==2.5)
                                                            {
                                                                $appearance_after_washing_fabric_surface_pilling_tolerance_value = '2-3';
                                                            }
                                                            elseif($appearance_after_washing_fabric_surface_pilling_tolerance ==3.0)
                                                            {
                                                                $appearance_after_washing_fabric_surface_pilling_tolerance_value = '3';
                                                            }
                                                            elseif($appearance_after_washing_fabric_surface_pilling_tolerance ==3.5)
                                                            {
                                                                $appearance_after_washing_fabric_surface_pilling_tolerance_value = '3-4';
                                                            }
                                                            elseif($appearance_after_washing_fabric_surface_pilling_tolerance ==4.0)
                                                            {
                                                                $appearance_after_washing_fabric_surface_pilling_tolerance_value = '4';
                                                            }
                                                            elseif($appearance_after_washing_fabric_surface_pilling_tolerance ==4.5)
                                                            {
                                                                $appearance_after_washing_fabric_surface_pilling_tolerance_value = '4-5';
                                                            }
                                                            elseif($appearance_after_washing_fabric_surface_pilling_tolerance ==5.0)
                                                            {
                                                                $appearance_after_washing_fabric_surface_pilling_tolerance_value = '5';
                                                            }
                                                            
                                                            $appearance_after_washing_fabric_surface_pilling = $row_for_qc['appearance_after_washing_fabric_surface_pilling_value'];
                                                                                    
                                                            if($appearance_after_washing_fabric_surface_pilling ==1.0)
                                                            {
                                                                $appearance_after_washing_fabric_surface_pilling_value = '1';
                                                            }
                                                            elseif($appearance_after_washing_fabric_surface_pilling ==1.5)
                                                            {
                                                                $appearance_after_washing_fabric_surface_pilling_value = '1-2';
                                                            }
                                                            elseif($appearance_after_washing_fabric_surface_pilling ==2.0)
                                                            {
                                                                $appearance_after_washing_fabric_surface_pilling_value = '2';
                                                            }
                                                            elseif($appearance_after_washing_fabric_surface_pilling ==2.5)
                                                            {
                                                                $appearance_after_washing_fabric_surface_pilling_value = '2-3';
                                                            }
                                                            elseif($appearance_after_washing_fabric_surface_pilling ==3.0)
                                                            {
                                                                $appearance_after_washing_fabric_surface_pilling_value = '3';
                                                            }
                                                            elseif($appearance_after_washing_fabric_surface_pilling ==3.5)
                                                            {
                                                                $appearance_after_washing_fabric_surface_pilling_value = '3-4';
                                                            }
                                                            elseif($appearance_after_washing_fabric_surface_pilling ==4.0)
                                                            {
                                                                $appearance_after_washing_fabric_surface_pilling_value = '4';
                                                            }
                                                            elseif($appearance_after_washing_fabric_surface_pilling ==4.5)
                                                            {
                                                                $appearance_after_washing_fabric_surface_pilling_value = '4-5';
                                                            }
                                                            elseif($appearance_after_washing_fabric_surface_pilling ==5.0)
                                                            {
                                                                $appearance_after_washing_fabric_surface_pilling_value = '5';
                                                            } 				// for test result
                            
                                                        }

                                                        $form.="<tr>
                                                        <th >Fabric (Surface Pilling)</th>
                                                        <td class='text-center'>".$appearance_after_washing_fabric_surface_pilling_value."</td>
                                                        <td class='text-center'>".$row_for_defining_process['appearance_after_washing_fabric_surface_pilling_math_op'].' '.$appearance_after_washing_fabric_surface_pilling_tolerance_value."</td>
                                                        </tr>";
                                                    }

                                                    if($row_for_defining_process['appearance_after_washing_fabric_crease_before_ironing_max_value']<>0)
                                                    {

                                                        if($customer_type == 'american')
                                                        {
                                                            $appearance_after_washing_fabric_crease_before_iron_tolerance_val = $row_for_defining_process['appearance_after_washing_fabric_crease_before_iron_tolerance_val'];
                                                            $appearance_after_washing_fabric_crease_before_ironing_value = $row_for_qc['appearance_after_washing_fabric_crease_before_ironing_value'];
                            
                                                        }
                                                        if($customer_type == 'european')
                                                        {
                                                            
                                                            $appearance_after_washing_fabric_crease_before_iron_tolerance = $row_for_defining_process['appearance_after_washing_fabric_crease_before_iron_tolerance_val'];
                            
                                                            if($appearance_after_washing_fabric_crease_before_iron_tolerance ==1.0)
                                                            {
                                                                $appearance_after_washing_fabric_crease_before_iron_tolerance_val = '1';
                                                            }
                                                            elseif($appearance_after_washing_fabric_crease_before_iron_tolerance ==1.5)
                                                            {
                                                                $appearance_after_washing_fabric_crease_before_iron_tolerance_val = '1-2';
                                                            }
                                                            elseif($appearance_after_washing_fabric_crease_before_iron_tolerance ==2.0)
                                                            {
                                                                $appearance_after_washing_fabric_crease_before_iron_tolerance_val = '2';
                                                            }
                                                            elseif($appearance_after_washing_fabric_crease_before_iron_tolerance ==2.5)
                                                            {
                                                                $appearance_after_washing_fabric_crease_before_iron_tolerance_val = '2-3';
                                                            }
                                                            elseif($appearance_after_washing_fabric_crease_before_iron_tolerance ==3.0)
                                                            {
                                                                $appearance_after_washing_fabric_crease_before_iron_tolerance_val = '3';
                                                            }
                                                            elseif($appearance_after_washing_fabric_crease_before_iron_tolerance ==3.5)
                                                            {
                                                                $appearance_after_washing_fabric_crease_before_iron_tolerance_val = '3-4';
                                                            }
                                                            elseif($appearance_after_washing_fabric_crease_before_iron_tolerance ==4.0)
                                                            {
                                                                $appearance_after_washing_fabric_crease_before_iron_tolerance_val = '4';
                                                            }
                                                            elseif($appearance_after_washing_fabric_crease_before_iron_tolerance ==4.5)
                                                            {
                                                                $appearance_after_washing_fabric_crease_before_iron_tolerance_val = '4-5';
                                                            }
                                                            elseif($appearance_after_washing_fabric_crease_before_iron_tolerance ==5.0)
                                                            {
                                                                $appearance_after_washing_fabric_crease_before_iron_tolerance_val = '5';
                                                            }
                                                            
                                                            $appearance_after_washing_fabric_crease_before_ironing = $row_for_qc['appearance_after_washing_fabric_crease_before_ironing_value'];
                                                                                    
                                                            if($appearance_after_washing_fabric_crease_before_ironing ==1.0)
                                                            {
                                                                $appearance_after_washing_fabric_crease_before_ironing_value = '1';
                                                            }
                                                            elseif($appearance_after_washing_fabric_crease_before_ironing ==1.5)
                                                            {
                                                                $appearance_after_washing_fabric_crease_before_ironing_value = '1-2';
                                                            }
                                                            elseif($appearance_after_washing_fabric_crease_before_ironing ==2.0)
                                                            {
                                                                $appearance_after_washing_fabric_crease_before_ironing_value = '2';
                                                            }
                                                            elseif($appearance_after_washing_fabric_crease_before_ironing ==2.5)
                                                            {
                                                                $appearance_after_washing_fabric_crease_before_ironing_value = '2-3';
                                                            }
                                                            elseif($appearance_after_washing_fabric_crease_before_ironing ==3.0)
                                                            {
                                                                $appearance_after_washing_fabric_crease_before_ironing_value = '3';
                                                            }
                                                            elseif($appearance_after_washing_fabric_crease_before_ironing ==3.5)
                                                            {
                                                                $appearance_after_washing_fabric_crease_before_ironing_value = '3-4';
                                                            }
                                                            elseif($appearance_after_washing_fabric_crease_before_ironing ==4.0)
                                                            {
                                                                $appearance_after_washing_fabric_crease_before_ironing_value = '4';
                                                            }
                                                            elseif($appearance_after_washing_fabric_crease_before_ironing ==4.5)
                                                            {
                                                                $appearance_after_washing_fabric_crease_before_ironing_value = '4-5';
                                                            }
                                                            elseif($appearance_after_washing_fabric_crease_before_ironing ==5.0)
                                                            {
                                                                $appearance_after_washing_fabric_crease_before_ironing_value = '5';
                                                            } 				// for test result
                                                        }
                                                        

                                                        $form.="<tr>
                                                        <th >Fabric (Crease before ironing)</th>
                                                        <td class='text-center'>".$appearance_after_washing_fabric_crease_before_ironing_value."</td>
                                                        <td class='text-center'>".$row_for_defining_process['appearance_after_washing_fabric_crease_before_iron_math_op'].' '.$appearance_after_washing_fabric_crease_before_iron_tolerance_val."</td>
                                                        </tr>";
                                                    }

                                                    if($row_for_defining_process['appearance_after_washing_fabric_crease_after_ironing_max_value']<>0)
                                                    {
                                                        if($customer_type == 'american')
                                                        {
                                                            $appearance_after_washing_fabric_crease_after_iron_tolerance_val = $row_for_defining_process['appearance_after_washing_fabric_crease_after_iron_tolerance_val'];
                                                            $appearance_after_washing_fabric_crease_after_ironing_value = $row_for_qc['appearance_after_washing_fabric_crease_after_ironing_value'];
                                                        }
                                                        if($customer_type == 'european')
                                                        {
                                                            $appearance_after_washing_fabric_crease_after_iron_tolerance = $row_for_defining_process['appearance_after_washing_fabric_crease_after_iron_tolerance_val'];

                                                            if($appearance_after_washing_fabric_crease_after_iron_tolerance ==1.0)
                                                            {
                                                                $appearance_after_washing_fabric_crease_after_iron_tolerance_val = '1';
                                                            }
                                                            elseif($appearance_after_washing_fabric_crease_after_iron_tolerance ==1.5)
                                                            {
                                                                $appearance_after_washing_fabric_crease_after_iron_tolerance_val = '1-2';
                                                            }
                                                            elseif($appearance_after_washing_fabric_crease_after_iron_tolerance ==2.0)
                                                            {
                                                                $appearance_after_washing_fabric_crease_after_iron_tolerance_val = '2';
                                                            }
                                                            elseif($appearance_after_washing_fabric_crease_after_iron_tolerance ==2.5)
                                                            {
                                                                $appearance_after_washing_fabric_crease_after_iron_tolerance_val = '2-3';
                                                            }
                                                            elseif($appearance_after_washing_fabric_crease_after_iron_tolerance ==3.0)
                                                            {
                                                                $appearance_after_washing_fabric_crease_after_iron_tolerance_val = '3';
                                                            }
                                                            elseif($appearance_after_washing_fabric_crease_after_iron_tolerance ==3.5)
                                                            {
                                                                $appearance_after_washing_fabric_crease_after_iron_tolerance_val = '3-4';
                                                            }
                                                            elseif($appearance_after_washing_fabric_crease_after_iron_tolerance ==4.0)
                                                            {
                                                                $appearance_after_washing_fabric_crease_after_iron_tolerance_val = '4';
                                                            }
                                                            elseif($appearance_after_washing_fabric_crease_after_iron_tolerance ==4.5)
                                                            {
                                                                $appearance_after_washing_fabric_crease_after_iron_tolerance_val = '4-5';
                                                            }
                                                            elseif($appearance_after_washing_fabric_crease_after_iron_tolerance ==5.0)
                                                            {
                                                                $appearance_after_washing_fabric_crease_after_iron_tolerance_val = '5';
                                                            }


                                                            $appearance_after_washing_fabric_crease_after_ironing = $row_for_qc['appearance_after_washing_fabric_crease_after_ironing_value'];
                                                    
                                                            if($appearance_after_washing_fabric_crease_after_ironing ==1.0)
                                                            {
                                                                $appearance_after_washing_fabric_crease_after_ironing_value = '1';
                                                            }
                                                            elseif($appearance_after_washing_fabric_crease_after_ironing ==1.5)
                                                            {
                                                                $appearance_after_washing_fabric_crease_after_ironing_value = '1-2';
                                                            }
                                                            elseif($appearance_after_washing_fabric_crease_after_ironing ==2.0)
                                                            {
                                                                $appearance_after_washing_fabric_crease_after_ironing_value = '2';
                                                            }
                                                            elseif($appearance_after_washing_fabric_crease_after_ironing ==2.5)
                                                            {
                                                                $appearance_after_washing_fabric_crease_after_ironing_value = '2-3';
                                                            }
                                                            elseif($appearance_after_washing_fabric_crease_after_ironing ==3.0)
                                                            {
                                                                $appearance_after_washing_fabric_crease_after_ironing_value = '3';
                                                            }
                                                            elseif($appearance_after_washing_fabric_crease_after_ironing ==3.5)
                                                            {
                                                                $appearance_after_washing_fabric_crease_after_ironing_value = '3-4';
                                                            }
                                                            elseif($appearance_after_washing_fabric_crease_after_ironing ==4.0)
                                                            {
                                                                $appearance_after_washing_fabric_crease_after_ironing_value = '4';
                                                            }
                                                            elseif($appearance_after_washing_fabric_crease_after_ironing ==4.5)
                                                            {
                                                                $appearance_after_washing_fabric_crease_after_ironing_value = '4-5';
                                                            }
                                                            elseif($appearance_after_washing_fabric_crease_after_ironing ==5.0)
                                                            {
                                                                $appearance_after_washing_fabric_crease_after_ironing_value = '5';
                                                            } 				// for test result
                                                        }

                                                        $form.="<tr>
                                                        <th >Fabric (Crease after ironing)</th>
                                                        <td class='text-center'>".$appearance_after_washing_fabric_crease_after_ironing_value."</td>
                                                        <td class='text-center'>".$row_for_defining_process['appearance_after_washing_fabric_crease_after_iron_math_op'].' '.$appearance_after_washing_fabric_crease_after_iron_tolerance_val."</td>
                                                        </tr>";
                                                    }

                                                    if($row_for_defining_process['appearance_after_washing_loss_of_print_fabric']<>'' && $row_for_qc['appearance_after_washing_fabric_loss_of_print_value']<>'')
                                                    {
                                                        $form.="<tr>
                                                        <th >Fabric (Loss of Print)</th>
                                                        <td class='text-center'>".$row_for_qc['appearance_after_washing_fabric_loss_of_print_value']."</td>
                                                        <td class='text-center'>".$row_for_defining_process['appearance_after_washing_loss_of_print_fabric']."</td>
                                                        </tr>";
                                                    }

                                                    if($row_for_defining_process['appearance_after_washing_fabric_abrasive_mark']<>'' && $row_for_qc['appearance_after_washing_fabric_abrasive_mark_value']<>'')
                                                    {
                                                        $form.="<tr>
                                                        <th >Fabric (Abrasive Mark)</th>
                                                        <td class='text-center'>".$row_for_qc['appearance_after_washing_fabric_abrasive_mark_value']."</td>
                                                        <td class='text-center'>".$row_for_defining_process['appearance_after_washing_fabric_abrasive_mark']."</td>
                                                        </tr>";
                                                    }

                                                    if($row_for_defining_process['appearance_after_washing_odor_fabric']<>'' && $row_for_qc['appearance_after_washing_fabric_odor_value']<>'')
                                                    {
                                                        $form.="<tr>
                                                        <th >Fabric (Odor)</th>
                                                        <td class='text-center'>".$row_for_qc['appearance_after_washing_fabric_odor_value']."</td>
                                                        <td class='text-center'>".$row_for_defining_process['appearance_after_washing_odor_fabric']."</td>
                                                        </tr>";
                                                    }
                                                    if($row_for_defining_process['appearance_after_washing_other_observation_fabric']<>'' && $row_for_qc['appearance_after_washing_other_observation_fabric']<>'')
                                                    {
                                                        $form.="<tr>
                                                        <th >Fabric (Other observation)</th>
                                                        <td class='text-center'>".$row_for_qc['appearance_after_washing_other_observation_fabric']."</td>
                                                        <td class='text-center'>".$row_for_defining_process['appearance_after_washing_other_observation_fabric']."</td>
                                                        </tr>";
                                                    }
                                                    $form.="</tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>";
                                }

                                if($row_for_defining_process['test_method_for_appearance_after_wash_fabric'] == 'Garments' && $row_for_qc['test_method_for_appearance_after_wash'] == 'Garments')
                                {
                                    $serial+=1;

                                    $form.="<div class='form-group from-group-sm row'>
                                        <div class='col-sm-1'><b style='font-size: 20px;' >".$serial.".</b></div>
                                        <div class='col-sm-11' id='form-group_for_test_report_of_ikea'>
                                            <div class='col-sm-10'>
                                                <table class='table table-bordered'>
                                            
                                                    <thead>
                                                    <tr>
                                                        <label class='col-sm-12' for='name' style='font-size: 20px;' >".$row['test_name_method']." : </label>
                                                        
                                                    </tr>
                                                    
                                                    <tr>
                                                        <textarea type='text' id='wool' class='col-sm-12' style='border: none;'> </textarea>
                                                    </tr>
                                                    <tr>
                                                    <th class='text-center'>Assessment Criteria</th>
                                                    <th class='text-center'>Result / Comments</th>
                                                    <th class='text-center'>Requirements</th>
                                                    </tr>

                                                    </thead>
                                                    <tbody>";

                                                if($row_for_defining_process['appear_after_washing_garments_color_change_without_sup_max_val']<>0)
                                                {
                                                                                            
                                                    if($customer_type == 'american')
                                                    {
                                                        $appear_after_washing_garments_color_change_without_sup_toler_val = $row_for_defining_process['appear_after_washing_garments_color_change_without_sup_toler_val'];
                                                        $appear_after_wash_garments_color_change_without_sup_value = $row_for_qc['appear_after_wash_garments_color_change_without_sup_value'];
                        
                                                    }
                                                    if($customer_type == 'european')
                                                    {
                                                        $appear_after_washing_garments_color_change_without_sup_toler = $row_for_defining_process['appear_after_washing_garments_color_change_without_sup_toler_val'];

                                                        if($appear_after_washing_garments_color_change_without_sup_toler ==1.0)
                                                        {
                                                            $appear_after_washing_garments_color_change_without_sup_toler_val = '1';
                                                        }
                                                        elseif($appear_after_washing_garments_color_change_without_sup_toler ==1.5)
                                                        {
                                                            $appear_after_washing_garments_color_change_without_sup_toler_val = '1-2';
                                                        }
                                                        elseif($appear_after_washing_garments_color_change_without_sup_toler ==2.0)
                                                        {
                                                            $appear_after_washing_garments_color_change_without_sup_toler_val = '2';
                                                        }
                                                        elseif($appear_after_washing_garments_color_change_without_sup_toler ==2.5)
                                                        {
                                                            $appear_after_washing_garments_color_change_without_sup_toler_val = '2-3';
                                                        }
                                                        elseif($appear_after_washing_garments_color_change_without_sup_toler ==3.0)
                                                        {
                                                            $appear_after_washing_garments_color_change_without_sup_toler_val = '3';
                                                        }
                                                        elseif($appear_after_washing_garments_color_change_without_sup_toler ==3.5)
                                                        {
                                                            $appear_after_washing_garments_color_change_without_sup_toler_val = '3-4';
                                                        }
                                                        elseif($appear_after_washing_garments_color_change_without_sup_toler ==4.0)
                                                        {
                                                            $appear_after_washing_garments_color_change_without_sup_toler_val = '4';
                                                        }
                                                        elseif($appear_after_washing_garments_color_change_without_sup_toler ==4.5)
                                                        {
                                                            $appear_after_washing_garments_color_change_without_sup_toler_val = '4-5';
                                                        }
                                                        elseif($appear_after_washing_garments_color_change_without_sup_toler ==5.0)
                                                        {
                                                            $appear_after_washing_garments_color_change_without_sup_toler_val = '5';
                                                        }

                                                        $appear_after_wash_garments_color_change_without_sup = $row_for_qc['appear_after_wash_garments_color_change_without_sup_value'];
                                                        
                                                        if($appear_after_wash_garments_color_change_without_sup ==1.0)
                                                        {
                                                            $appear_after_wash_garments_color_change_without_sup_value = '1';
                                                        }
                                                        elseif($appear_after_wash_garments_color_change_without_sup ==1.5)
                                                        {
                                                            $appear_after_wash_garments_color_change_without_sup_value = '1-2';
                                                        }
                                                        elseif($appear_after_wash_garments_color_change_without_sup ==2.0)
                                                        {
                                                            $appear_after_wash_garments_color_change_without_sup_value = '2';
                                                        }
                                                        elseif($appear_after_wash_garments_color_change_without_sup ==2.5)
                                                        {
                                                            $appear_after_wash_garments_color_change_without_sup_value = '2-3';
                                                        }
                                                        elseif($appear_after_wash_garments_color_change_without_sup ==3.0)
                                                        {
                                                            $appear_after_wash_garments_color_change_without_sup_value = '3';
                                                        }
                                                        elseif($appear_after_wash_garments_color_change_without_sup ==3.5)
                                                        {
                                                            $appear_after_wash_garments_color_change_without_sup_value = '3-4';
                                                        }
                                                        elseif($appear_after_wash_garments_color_change_without_sup ==4.0)
                                                        {
                                                            $appear_after_wash_garments_color_change_without_sup_value = '4';
                                                        }
                                                        elseif($appear_after_wash_garments_color_change_without_sup ==4.5)
                                                        {
                                                            $appear_after_wash_garments_color_change_without_sup_value = '4-5';
                                                        }
                                                        elseif($appear_after_wash_garments_color_change_without_sup ==5.0)
                                                        {
                                                            $appear_after_wash_garments_color_change_without_sup_value = '5';
                                                        } 				// for test result
                                                    }      
                                                    $form.="<tr>
                                                    <th >Garments (Color Change (Without Suppressor))</th>
                                                    <td class='text-center'>".$appear_after_wash_garments_color_change_without_sup_value."</td>
                                                    <td class='text-center'>".$row_for_defining_process['appear_after_washing_garments_color_change_without_sup_math_op'].' '.$appear_after_washing_garments_color_change_without_sup_toler_val."</td>
                                                    </tr>";
                                                }
                                                
                                                if($row_for_defining_process['appear_after_washing_garments_color_change_with_sup_max_value']<>0)
                                                {

                                                    if($customer_type == 'american')
                                                    {
                                                        $appear_after_washing_garments_color_change_with_sup_toler_value = $row_for_defining_process['appear_after_washing_garments_color_change_with_sup_toler_value'];
                                                        $appear_after_wash_garments_color_change_with_sup_value = $row_for_qc['appear_after_wash_garments_color_change_with_sup_value'];
                            
                                                    }
                                                    if($customer_type == 'european')
                                                    {
                                                        $appear_after_washing_garments_color_change_with_sup_toler = $row_for_defining_process['appear_after_washing_garments_color_change_with_sup_toler_value'];
                        
                                                        if($appear_after_washing_garments_color_change_with_sup_toler ==1.0)
                                                        {
                                                            $appear_after_washing_garments_color_change_with_sup_toler_value = '1';
                                                        }
                                                        elseif($appear_after_washing_garments_color_change_with_sup_toler ==1.5)
                                                        {
                                                            $appear_after_washing_garments_color_change_with_sup_toler_value = '1-2';
                                                        }
                                                        elseif($appear_after_washing_garments_color_change_with_sup_toler ==2.0)
                                                        {
                                                            $appear_after_washing_garments_color_change_with_sup_toler_value = '2';
                                                        }
                                                        elseif($appear_after_washing_garments_color_change_with_sup_toler ==2.5)
                                                        {
                                                            $appear_after_washing_garments_color_change_with_sup_toler_value = '2-3';
                                                        }
                                                        elseif($appear_after_washing_garments_color_change_with_sup_toler ==3.0)
                                                        {
                                                            $appear_after_washing_garments_color_change_with_sup_toler_value = '3';
                                                        }
                                                        elseif($appear_after_washing_garments_color_change_with_sup_toler ==3.5)
                                                        {
                                                            $appear_after_washing_garments_color_change_with_sup_toler_value = '3-4';
                                                        }
                                                        elseif($appear_after_washing_garments_color_change_with_sup_toler ==4.0)
                                                        {
                                                            $appear_after_washing_garments_color_change_with_sup_toler_value = '4';
                                                        }
                                                        elseif($appear_after_washing_garments_color_change_with_sup_toler ==4.5)
                                                        {
                                                            $appear_after_washing_garments_color_change_with_sup_toler_value = '4-5';
                                                        }
                                                        elseif($appear_after_washing_garments_color_change_with_sup_toler ==5.0)
                                                        {
                                                            $appear_after_washing_garments_color_change_with_sup_toler_value = '5';
                                                        }

                                                        $appear_after_wash_garments_color_change_with_sup = $row_for_qc['appear_after_wash_garments_color_change_with_sup_value'];
                                                        
                                                        if($appear_after_wash_garments_color_change_with_sup ==1.0)
                                                        {
                                                            $appear_after_wash_garments_color_change_with_sup_value = '1';
                                                        }
                                                        elseif($appear_after_wash_garments_color_change_with_sup ==1.5)
                                                        {
                                                            $appear_after_wash_garments_color_change_with_sup_value = '1-2';
                                                        }
                                                        elseif($appear_after_wash_garments_color_change_with_sup ==2.0)
                                                        {
                                                            $appear_after_wash_garments_color_change_with_sup_value = '2';
                                                        }
                                                        elseif($appear_after_wash_garments_color_change_with_sup ==2.5)
                                                        {
                                                            $appear_after_wash_garments_color_change_with_sup_value = '2-3';
                                                        }
                                                        elseif($appear_after_wash_garments_color_change_with_sup ==3.0)
                                                        {
                                                            $appear_after_wash_garments_color_change_with_sup_value = '3';
                                                        }
                                                        elseif($appear_after_wash_garments_color_change_with_sup ==3.5)
                                                        {
                                                            $appear_after_wash_garments_color_change_with_sup_value = '3-4';
                                                        }
                                                        elseif($appear_after_wash_garments_color_change_with_sup ==4.0)
                                                        {
                                                            $appear_after_wash_garments_color_change_with_sup_value = '4';
                                                        }
                                                        elseif($appear_after_wash_garments_color_change_with_sup ==4.5)
                                                        {
                                                            $appear_after_wash_garments_color_change_with_sup_value = '4-5';
                                                        }
                                                        elseif($appear_after_wash_garments_color_change_with_sup ==5.0)
                                                        {
                                                            $appear_after_wash_garments_color_change_with_sup_value = '5';
                                                        } 				// for test result
                                    
                                                    }

                                                    $form.="<tr>
                                                    <th >Garments (Color Change (With Suppressor))</th>
                                                    <td class='text-center'>".$appear_after_wash_garments_color_change_with_sup_value."</td>
                                                    <td class='text-center'>".$row_for_defining_process['appear_after_washing_garments_color_change_with_sup_math_op'].' '.$appear_after_washing_garments_color_change_with_sup_toler_value."</td>
                                                    </tr>";
                                                }
                                                
                                                if($row_for_defining_process['appearance_after_washing_garments_cross_staining_max_value']<>0)
                                                {
                                                    if($customer_type == 'american')
                                                    {
                                                        $appear_after_washing_garments_cross_staining_tolerance_value = $row_for_defining_process['appear_after_washing_garments_cross_staining_tolerance_value'];
                                                        $appearance_after_washing_garments_cross_staining_value = $row_for_qc['appearance_after_washing_garments_cross_staining_value'];
                            
                                                    }

                                                    if($customer_type == 'european')
                                                    {
                                                        $appear_after_washing_garments_cross_staining_tolerance = $row_for_defining_process['appear_after_washing_garments_cross_staining_tolerance_value'];
                        
                                                        if($appear_after_washing_garments_cross_staining_tolerance ==1.0)
                                                        {
                                                            $appear_after_washing_garments_cross_staining_tolerance_value = '1';
                                                        }
                                                        elseif($appear_after_washing_garments_cross_staining_tolerance ==1.5)
                                                        {
                                                            $appear_after_washing_garments_cross_staining_tolerance_value = '1-2';
                                                        }
                                                        elseif($appear_after_washing_garments_cross_staining_tolerance ==2.0)
                                                        {
                                                            $appear_after_washing_garments_cross_staining_tolerance_value = '2';
                                                        }
                                                        elseif($appear_after_washing_garments_cross_staining_tolerance ==2.5)
                                                        {
                                                            $appear_after_washing_garments_cross_staining_tolerance_value = '2-3';
                                                        }
                                                        elseif($appear_after_washing_garments_cross_staining_tolerance ==3.0)
                                                        {
                                                            $appear_after_washing_garments_cross_staining_tolerance_value = '3';
                                                        }
                                                        elseif($appear_after_washing_garments_cross_staining_tolerance ==3.5)
                                                        {
                                                            $appear_after_washing_garments_cross_staining_tolerance_value = '3-4';
                                                        }
                                                        elseif($appear_after_washing_garments_cross_staining_tolerance ==4.0)
                                                        {
                                                            $appear_after_washing_garments_cross_staining_tolerance_value = '4';
                                                        }
                                                        elseif($appear_after_washing_garments_cross_staining_tolerance ==4.5)
                                                        {
                                                            $appear_after_washing_garments_cross_staining_tolerance_value = '4-5';
                                                        }
                                                        elseif($appear_after_washing_garments_cross_staining_tolerance ==5.0)
                                                        {
                                                            $appear_after_washing_garments_cross_staining_tolerance_value = '5';
                                                        }

                                                        $appearance_after_washing_garments_cross_staining = $row_for_qc['appearance_after_washing_garments_cross_staining_value'];
                                                        
                                                        if($appearance_after_washing_garments_cross_staining ==1.0)
                                                        {
                                                            $appearance_after_washing_garments_cross_staining_value = '1';
                                                        }
                                                        elseif($appearance_after_washing_garments_cross_staining ==1.5)
                                                        {
                                                            $appearance_after_washing_garments_cross_staining_value = '1-2';
                                                        }
                                                        elseif($appearance_after_washing_garments_cross_staining ==2.0)
                                                        {
                                                            $appearance_after_washing_garments_cross_staining_value = '2';
                                                        }
                                                        elseif($appearance_after_washing_garments_cross_staining ==2.5)
                                                        {
                                                            $appearance_after_washing_garments_cross_staining_value = '2-3';
                                                        }
                                                        elseif($appearance_after_washing_garments_cross_staining ==3.0)
                                                        {
                                                            $appearance_after_washing_garments_cross_staining_value = '3';
                                                        }
                                                        elseif($appearance_after_washing_garments_cross_staining ==3.5)
                                                        {
                                                            $appearance_after_washing_garments_cross_staining_value = '3-4';
                                                        }
                                                        elseif($appearance_after_washing_garments_cross_staining ==4.0)
                                                        {
                                                            $appearance_after_washing_garments_cross_staining_value = '4';
                                                        }
                                                        elseif($appearance_after_washing_garments_cross_staining ==4.5)
                                                        {
                                                            $appearance_after_washing_garments_cross_staining_value = '4-5';
                                                        }
                                                        elseif($appearance_after_washing_garments_cross_staining ==5.0)
                                                        {
                                                            $appearance_after_washing_garments_cross_staining_value = '5';
                                                        } 				// for test result
                                    
                                                    }
                                
                                                            
                                                    $form.="<tr>
                                                    <th >Garments (Cross Staining)</th>
                                                    <td class='text-center'>".$appearance_after_washing_garments_cross_staining_value."</td>
                                                    <td class='text-center'>".$row_for_defining_process['appear_after_washing_garments_cross_staining_math_op'].' '.$appear_after_washing_garments_cross_staining_tolerance_value."</td>
                                                    </tr>";
                                                }

                                                if($row_for_defining_process['appearance_after_washing_garments__differential_shrink_max_value']<>0)
                                                {

                                                    if($customer_type == 'american')
                                                    {
                                                        $appear_after_washing_garments__differential_shrink_tolerance_val = $row_for_defining_process['appear_after_washing_garments__differential_shrink_tolerance_val'];
                                                        $appearance_after_washing_garments_differential_shrinkage_value = $row_for_qc['appearance_after_washing_garments_differential_shrinkage_value'];
                            
                                                    }
                                                    if($customer_type == 'european')
                                                    {
                                                        $appear_after_washing_garments__differential_shrink_tolerance = $row_for_defining_process['appear_after_washing_garments__differential_shrink_tolerance_val'];
                        
                                                        if($appear_after_washing_garments__differential_shrink_tolerance ==1.0)
                                                        {
                                                            $appear_after_washing_garments__differential_shrink_tolerance_val = '1';
                                                        }
                                                        elseif($appear_after_washing_garments__differential_shrink_tolerance ==1.5)
                                                        {
                                                            $appear_after_washing_garments__differential_shrink_tolerance_val = '1-2';
                                                        }
                                                        elseif($appear_after_washing_garments__differential_shrink_tolerance ==2.0)
                                                        {
                                                            $appear_after_washing_garments__differential_shrink_tolerance_val = '2';
                                                        }
                                                        elseif($appear_after_washing_garments__differential_shrink_tolerance ==2.5)
                                                        {
                                                            $appear_after_washing_garments__differential_shrink_tolerance_val = '2-3';
                                                        }
                                                        elseif($appear_after_washing_garments__differential_shrink_tolerance ==3.0)
                                                        {
                                                            $appear_after_washing_garments__differential_shrink_tolerance_val = '3';
                                                        }
                                                        elseif($appear_after_washing_garments__differential_shrink_tolerance ==3.5)
                                                        {
                                                            $appear_after_washing_garments__differential_shrink_tolerance_val = '3-4';
                                                        }
                                                        elseif($appear_after_washing_garments__differential_shrink_tolerance ==4.0)
                                                        {
                                                            $appear_after_washing_garments__differential_shrink_tolerance_val = '4';
                                                        }
                                                        elseif($appear_after_washing_garments__differential_shrink_tolerance ==4.5)
                                                        {
                                                            $appear_after_washing_garments__differential_shrink_tolerance_val = '4-5';
                                                        }
                                                        elseif($appear_after_washing_garments__differential_shrink_tolerance ==5.0)
                                                        {
                                                            $appear_after_washing_garments__differential_shrink_tolerance_val = '5';
                                                        }
                                
                                
                                                        $appearance_after_washing_garments_differential_shrinkage = $row_for_qc['appearance_after_washing_garments_differential_shrinkage_value'];
                                                        
                                                        if($appearance_after_washing_garments_differential_shrinkage ==1.0)
                                                        {
                                                            $appearance_after_washing_garments_differential_shrinkage_value = '1';
                                                        }
                                                        elseif($appearance_after_washing_garments_differential_shrinkage ==1.5)
                                                        {
                                                            $appearance_after_washing_garments_differential_shrinkage_value = '1-2';
                                                        }
                                                        elseif($appearance_after_washing_garments_differential_shrinkage ==2.0)
                                                        {
                                                            $appearance_after_washing_garments_differential_shrinkage_value = '2';
                                                        }
                                                        elseif($appearance_after_washing_garments_differential_shrinkage ==2.5)
                                                        {
                                                            $appearance_after_washing_garments_differential_shrinkage_value = '2-3';
                                                        }
                                                        elseif($appearance_after_washing_garments_differential_shrinkage ==3.0)
                                                        {
                                                            $appearance_after_washing_garments_differential_shrinkage_value = '3';
                                                        }
                                                        elseif($appearance_after_washing_garments_differential_shrinkage ==3.5)
                                                        {
                                                            $appearance_after_washing_garments_differential_shrinkage_value = '3-4';
                                                        }
                                                        elseif($appearance_after_washing_garments_differential_shrinkage ==4.0)
                                                        {
                                                            $appearance_after_washing_garments_differential_shrinkage_value = '4';
                                                        }
                                                        elseif($appearance_after_washing_garments_differential_shrinkage ==4.5)
                                                        {
                                                            $appearance_after_washing_garments_differential_shrinkage_value = '4-5';
                                                        }
                                                        elseif($appearance_after_washing_garments_differential_shrinkage ==5.0)
                                                        {
                                                            $appearance_after_washing_garments_differential_shrinkage_value = '5';
                                                        } 				// for test result
                                    
                                                    }


                                                    $form.="<tr>
                                                    <th >Garments (Differential Shrinking)</th>
                                                    <td class='text-center'>".$appearance_after_washing_garments_differential_shrinkage_value."</td>
                                                    <td class='text-center'>".$row_for_defining_process['appear_after_washing_garments_differential_shrink_math_op'].' '.$appear_after_washing_garments__differential_shrink_tolerance_val."</td>
                                                    </tr>";
                                                }
                                                if($row_for_defining_process['appearance_after_washing_garments_surface_fuzzing_max_value']<>0)
                                                {

                                                    if($customer_type == 'american')
                                                    {
                                                        $appearance_after_washing_garments_surface_fuzzing_tolerance_val = $row_for_defining_process['appearance_after_washing_garments_surface_fuzzing_tolerance_val'];
                                                        $appearance_after_washing_garments_surface_fuzzing_value = $row_for_qc['appearance_after_washing_garments_surface_fuzzing_value'];
                        
                                                    }
                                                    if($customer_type == 'european')
                                                    {
                                                        $appearance_after_washing_garments_surface_fuzzing_tolerance = $row_for_defining_process['appearance_after_washing_garments_surface_fuzzing_tolerance_val'];

                                                        if($appearance_after_washing_garments_surface_fuzzing_tolerance ==1.0)
                                                        {
                                                            $appearance_after_washing_garments_surface_fuzzing_tolerance_val = '1';
                                                        }
                                                        elseif($appearance_after_washing_garments_surface_fuzzing_tolerance ==1.5)
                                                        {
                                                            $appearance_after_washing_garments_surface_fuzzing_tolerance_val = '1-2';
                                                        }
                                                        elseif($appearance_after_washing_garments_surface_fuzzing_tolerance ==2.0)
                                                        {
                                                            $appearance_after_washing_garments_surface_fuzzing_tolerance_val = '2';
                                                        }
                                                        elseif($appearance_after_washing_garments_surface_fuzzing_tolerance ==2.5)
                                                        {
                                                            $appearance_after_washing_garments_surface_fuzzing_tolerance_val = '2-3';
                                                        }
                                                        elseif($appearance_after_washing_garments_surface_fuzzing_tolerance ==3.0)
                                                        {
                                                            $appearance_after_washing_garments_surface_fuzzing_tolerance_val = '3';
                                                        }
                                                        elseif($appearance_after_washing_garments_surface_fuzzing_tolerance ==3.5)
                                                        {
                                                            $appearance_after_washing_garments_surface_fuzzing_tolerance_val = '3-4';
                                                        }
                                                        elseif($appearance_after_washing_garments_surface_fuzzing_tolerance ==4.0)
                                                        {
                                                            $appearance_after_washing_garments_surface_fuzzing_tolerance_val = '4';
                                                        }
                                                        elseif($appearance_after_washing_garments_surface_fuzzing_tolerance ==4.5)
                                                        {
                                                            $appearance_after_washing_garments_surface_fuzzing_tolerance_val = '4-5';
                                                        }
                                                        elseif($appearance_after_washing_garments_surface_fuzzing_tolerance ==5.0)
                                                        {
                                                            $appearance_after_washing_garments_surface_fuzzing_tolerance_val = '5';
                                                        }
                                

                                                        $appearance_after_washing_garments_surface_fuzzing = $row_for_qc['appearance_after_washing_garments_surface_fuzzing_value'];
                                                        
                                                        if($appearance_after_washing_garments_surface_fuzzing ==1.0)
                                                        {
                                                            $appearance_after_washing_garments_surface_fuzzing_value = '1';
                                                        }
                                                        elseif($appearance_after_washing_garments_surface_fuzzing ==1.5)
                                                        {
                                                            $appearance_after_washing_garments_surface_fuzzing_value = '1-2';
                                                        }
                                                        elseif($appearance_after_washing_garments_surface_fuzzing ==2.0)
                                                        {
                                                            $appearance_after_washing_garments_surface_fuzzing_value = '2';
                                                        }
                                                        elseif($appearance_after_washing_garments_surface_fuzzing ==2.5)
                                                        {
                                                            $appearance_after_washing_garments_surface_fuzzing_value = '2-3';
                                                        }
                                                        elseif($appearance_after_washing_garments_surface_fuzzing ==3.0)
                                                        {
                                                            $appearance_after_washing_garments_surface_fuzzing_value = '3';
                                                        }
                                                        elseif($appearance_after_washing_garments_surface_fuzzing ==3.5)
                                                        {
                                                            $appearance_after_washing_garments_surface_fuzzing_value = '3-4';
                                                        }
                                                        elseif($appearance_after_washing_garments_surface_fuzzing ==4.0)
                                                        {
                                                            $appearance_after_washing_garments_surface_fuzzing_value = '4';
                                                        }
                                                        elseif($appearance_after_washing_garments_surface_fuzzing ==4.5)
                                                        {
                                                            $appearance_after_washing_garments_surface_fuzzing_value = '4-5';
                                                        }
                                                        elseif($appearance_after_washing_garments_surface_fuzzing ==5.0)
                                                        {
                                                            $appearance_after_washing_garments_surface_fuzzing_value = '5';
                                                        } 				// for test result
                                
                                                    }
                                                    $form.="<tr>
                                                    <th >Garments (Surface Fuzzing)</th>
                                                    <td class='text-center'>".$appearance_after_washing_garments_surface_fuzzing_value."</td>
                                                    <td class='text-center'>".$row_for_defining_process['appear_after_washing_garments_surface_fuzzing_math_op'].' '.$appearance_after_washing_garments_surface_fuzzing_tolerance_val."</td>
                                                    </tr>";
                                                }
                                                if($row_for_defining_process['appearance_after_washing_garments_surface_pilling_max_value']<>0)
                                                {
                                                    if($customer_type == 'american')
                                                    {
                                                        $appearance_after_washing_garments_surface_pilling_tolerance_val = $row_for_defining_process['appearance_after_washing_garments_surface_pilling_tolerance_val'];
                                                        $appearance_after_washing_garments_surface_pilling_value = $row_for_qc['appearance_after_washing_garments_surface_pilling_value'];
                            
                                                    }
                                                    if($customer_type == 'european')
                                                    {
                                                                
                                                        $appearance_after_washing_garments_surface_pilling_tolerance = $row_for_defining_process['appearance_after_washing_garments_surface_pilling_tolerance_val'];
                        
                                                        if($appearance_after_washing_garments_surface_pilling_tolerance ==1.0)
                                                        {
                                                            $appearance_after_washing_garments_surface_pilling_tolerance_val = '1';
                                                        }
                                                        elseif($appearance_after_washing_garments_surface_pilling_tolerance ==1.5)
                                                        {
                                                            $appearance_after_washing_garments_surface_pilling_tolerance_val = '1-2';
                                                        }
                                                        elseif($appearance_after_washing_garments_surface_pilling_tolerance ==2.0)
                                                        {
                                                            $appearance_after_washing_garments_surface_pilling_tolerance_val = '2';
                                                        }
                                                        elseif($appearance_after_washing_garments_surface_pilling_tolerance ==2.5)
                                                        {
                                                            $appearance_after_washing_garments_surface_pilling_tolerance_val = '2-3';
                                                        }
                                                        elseif($appearance_after_washing_garments_surface_pilling_tolerance ==3.0)
                                                        {
                                                            $appearance_after_washing_garments_surface_pilling_tolerance_val = '3';
                                                        }
                                                        elseif($appearance_after_washing_garments_surface_pilling_tolerance ==3.5)
                                                        {
                                                            $appearance_after_washing_garments_surface_pilling_tolerance_val = '3-4';
                                                        }
                                                        elseif($appearance_after_washing_garments_surface_pilling_tolerance ==4.0)
                                                        {
                                                            $appearance_after_washing_garments_surface_pilling_tolerance_val = '4';
                                                        }
                                                        elseif($appearance_after_washing_garments_surface_pilling_tolerance ==4.5)
                                                        {
                                                            $appearance_after_washing_garments_surface_pilling_tolerance_val = '4-5';
                                                        }
                                                        elseif($appearance_after_washing_garments_surface_pilling_tolerance ==5.0)
                                                        {
                                                            $appearance_after_washing_garments_surface_pilling_tolerance_val = '5';
                                                        }
                                
                                                        $appearance_after_washing_garments_surface_pilling = $row_for_qc['appearance_after_washing_garments_surface_pilling_value'];
                                                        
                                                        if($appearance_after_washing_garments_surface_pilling ==1.0)
                                                        {
                                                            $appearance_after_washing_garments_surface_pilling_value = '1';
                                                        }
                                                        elseif($appearance_after_washing_garments_surface_pilling ==1.5)
                                                        {
                                                            $appearance_after_washing_garments_surface_pilling_value = '1-2';
                                                        }
                                                        elseif($appearance_after_washing_garments_surface_pilling ==2.0)
                                                        {
                                                            $appearance_after_washing_garments_surface_pilling_value = '2';
                                                        }
                                                        elseif($appearance_after_washing_garments_surface_pilling ==2.5)
                                                        {
                                                            $appearance_after_washing_garments_surface_pilling_value = '2-3';
                                                        }
                                                        elseif($appearance_after_washing_garments_surface_pilling ==3.0)
                                                        {
                                                            $appearance_after_washing_garments_surface_pilling_value = '3';
                                                        }
                                                        elseif($appearance_after_washing_garments_surface_pilling ==3.5)
                                                        {
                                                            $appearance_after_washing_garments_surface_pilling_value = '3-4';
                                                        }
                                                        elseif($appearance_after_washing_garments_surface_pilling ==4.0)
                                                        {
                                                            $appearance_after_washing_garments_surface_pilling_value = '4';
                                                        }
                                                        elseif($appearance_after_washing_garments_surface_pilling ==4.5)
                                                        {
                                                            $appearance_after_washing_garments_surface_pilling_value = '4-5';
                                                        }
                                                        elseif($appearance_after_washing_garments_surface_pilling ==5.0)
                                                        {
                                                            $appearance_after_washing_garments_surface_pilling_value = '5';
                                                        } 				// for test result
                                    
                                                    }
                                                    $form.="<tr>
                                                    <th >Garments (Surface Pilling)</th>
                                                    <td class='text-center'>".$appearance_after_washing_garments_surface_pilling_value."</td>
                                                    <td class='text-center'>".$row_for_defining_process['appear_after_washing_garments_surface_pilling_math_op'].' '.$appearance_after_washing_garments_surface_pilling_tolerance_val."</td>
                                                    </tr>";
                                                }
                                                if($row_for_defining_process['appearance_after_washing_garments_crease_after_ironing_max_value']<>0)
                                                {

                                                    if($customer_type == 'american')
                                                    {
                                                        $appear_after_washing_garments_crease_after_ironing_tolerance_val = $row_for_defining_process['appear_after_washing_garments_crease_after_ironing_tolerance_val'];
                                                        $appearance_after_washing_garments_crease_after_ironing_value = $row_for_qc['appearance_after_washing_garments_crease_after_ironing_value'];
                        
                                                    }
                                                    if($customer_type == 'european')
                                                    {
                                                                    
                                                        $appear_after_washing_garments_crease_after_ironing_tolerance = $row_for_defining_process['appear_after_washing_garments_crease_after_ironing_tolerance_val'];

                                                        if($appear_after_washing_garments_crease_after_ironing_tolerance ==1.0)
                                                        {
                                                            $appear_after_washing_garments_crease_after_ironing_tolerance_val = '1';
                                                        }
                                                        elseif($appear_after_washing_garments_crease_after_ironing_tolerance ==1.5)
                                                        {
                                                            $appear_after_washing_garments_crease_after_ironing_tolerance_val = '1-2';
                                                        }
                                                        elseif($appear_after_washing_garments_crease_after_ironing_tolerance ==2.0)
                                                        {
                                                            $appear_after_washing_garments_crease_after_ironing_tolerance_val = '2';
                                                        }
                                                        elseif($appear_after_washing_garments_crease_after_ironing_tolerance ==2.5)
                                                        {
                                                            $appear_after_washing_garments_crease_after_ironing_tolerance_val = '2-3';
                                                        }
                                                        elseif($appear_after_washing_garments_crease_after_ironing_tolerance ==3.0)
                                                        {
                                                            $appear_after_washing_garments_crease_after_ironing_tolerance_val = '3';
                                                        }
                                                        elseif($appear_after_washing_garments_crease_after_ironing_tolerance ==3.5)
                                                        {
                                                            $appear_after_washing_garments_crease_after_ironing_tolerance_val = '3-4';
                                                        }
                                                        elseif($appear_after_washing_garments_crease_after_ironing_tolerance ==4.0)
                                                        {
                                                            $appear_after_washing_garments_crease_after_ironing_tolerance_val = '4';
                                                        }
                                                        elseif($appear_after_washing_garments_crease_after_ironing_tolerance ==4.5)
                                                        {
                                                            $appear_after_washing_garments_crease_after_ironing_tolerance_val = '4-5';
                                                        }
                                                        elseif($appear_after_washing_garments_crease_after_ironing_tolerance ==5.0)
                                                        {
                                                            $appear_after_washing_garments_crease_after_ironing_tolerance_val = '5';
                                                        }
                                    
                                    
                                                        $appearance_after_washing_garments_crease_after_ironing = $row_for_qc['appearance_after_washing_garments_crease_after_ironing_value'];
                                                            
                                                        if($appearance_after_washing_garments_crease_after_ironing ==1.0)
                                                        {
                                                            $appearance_after_washing_garments_crease_after_ironing_value = '1';
                                                        }
                                                        elseif($appearance_after_washing_garments_crease_after_ironing ==1.5)
                                                        {
                                                            $appearance_after_washing_garments_crease_after_ironing_value = '1-2';
                                                        }
                                                        elseif($appearance_after_washing_garments_crease_after_ironing ==2.0)
                                                        {
                                                            $appearance_after_washing_garments_crease_after_ironing_value = '2';
                                                        }
                                                        elseif($appearance_after_washing_garments_crease_after_ironing ==2.5)
                                                        {
                                                            $appearance_after_washing_garments_crease_after_ironing_value = '2-3';
                                                        }
                                                        elseif($appearance_after_washing_garments_crease_after_ironing ==3.0)
                                                        {
                                                            $appearance_after_washing_garments_crease_after_ironing_value = '3';
                                                        }
                                                        elseif($appearance_after_washing_garments_crease_after_ironing ==3.5)
                                                        {
                                                            $appearance_after_washing_garments_crease_after_ironing_value = '3-4';
                                                        }
                                                        elseif($appearance_after_washing_garments_crease_after_ironing ==4.0)
                                                        {
                                                            $appearance_after_washing_garments_crease_after_ironing_value = '4';
                                                        }
                                                        elseif($appearance_after_washing_garments_crease_after_ironing ==4.5)
                                                        {
                                                            $appearance_after_washing_garments_crease_after_ironing_value = '4-5';
                                                        }
                                                        elseif($appearance_after_washing_garments_crease_after_ironing ==5.0)
                                                        {
                                                            $appearance_after_washing_garments_crease_after_ironing_value = '5';
                                                        } 				// for test result
                                    
                                                    }
                                                    $form.="<tr>
                                                    <th >Garments (Crease After Ironing)</th>
                                                    <td class='text-center'>".$row_for_qc['appearance_after_washing_garments_crease_after_ironing_value']."</td>
                                                    <td class='text-center'>".$row_for_defining_process['appear_after_washing_garments_crease_after_ironing_math_op'].' '.$appear_after_washing_garments_crease_after_ironing_tolerance_val."</td>
                                                    </tr>";
                                                }
                                                if($row_for_defining_process['appearance_after_washing_garments_abrasive_mark']<>0)
                                                {
                                                    $form.="<tr>
                                                    <th >Garments (Abrasive Mark)</th>
                                                    <td class='text-center'>".$row_for_qc['appearance_after_washing_garments_abrasive_mark_value']."</td>
                                                    <td class='text-center'>".$row_for_defining_process['appearance_after_washing_garments_abrasive_mark']."</td>
                                                    </tr>";
                                                }
                                                if($row_for_defining_process['seam_breakdown_garments']<>0)
                                                {
                                                    $form.="<tr>
                                                    <th >Garments (Seam Breakdown)</th>
                                                    <td class='text-center'>".$row_for_qc['appearance_after_washing_garments_seam_breakdown_value']."</td>
                                                    <td class='text-center'>".$row_for_defining_process['seam_breakdown_garments']."</td>
                                                    </tr>";
                                                }
                                                if($row_for_defining_process['appear_after_washing_garments_seam_pucker_rop_iron_max_value']<>0)
                                                {

                                                    if($customer_type == 'american')
                                                    {
                                                        $appear_after_washing_garments_seam_pucker_rop_iron_toler_value = $row_for_defining_process['appear_after_washing_garments_seam_pucker_rop_iron_toler_value'];
                                                        $appearance_after_washing_garments_seam_puckering_roping_after_ir = $row_for_qc['appearance_after_washing_garments_seam_puckering_roping_after_ir'];
                        
                                                    }
                                                    if($customer_type == 'european')
                                                    {
                                                                    
                                                        $appear_after_washing_garments_seam_pucker_rop_iron_toler = $row_for_defining_process['appear_after_washing_garments_seam_pucker_rop_iron_toler_value'];

                                                        if($appear_after_washing_garments_seam_pucker_rop_iron_toler ==1.0)
                                                        {
                                                            $appear_after_washing_garments_seam_pucker_rop_iron_toler_value = '1';
                                                        }
                                                        elseif($appear_after_washing_garments_seam_pucker_rop_iron_toler ==1.5)
                                                        {
                                                            $appear_after_washing_garments_seam_pucker_rop_iron_toler_value = '1-2';
                                                        }
                                                        elseif($appear_after_washing_garments_seam_pucker_rop_iron_toler ==2.0)
                                                        {
                                                            $appear_after_washing_garments_seam_pucker_rop_iron_toler_value = '2';
                                                        }
                                                        elseif($appear_after_washing_garments_seam_pucker_rop_iron_toler ==2.5)
                                                        {
                                                            $appear_after_washing_garments_seam_pucker_rop_iron_toler_value = '2-3';
                                                        }
                                                        elseif($appear_after_washing_garments_seam_pucker_rop_iron_toler ==3.0)
                                                        {
                                                            $appear_after_washing_garments_seam_pucker_rop_iron_toler_value = '3';
                                                        }
                                                        elseif($appear_after_washing_garments_seam_pucker_rop_iron_toler ==3.5)
                                                        {
                                                            $appear_after_washing_garments_seam_pucker_rop_iron_toler_value = '3-4';
                                                        }
                                                        elseif($appear_after_washing_garments_seam_pucker_rop_iron_toler ==4.0)
                                                        {
                                                            $appear_after_washing_garments_seam_pucker_rop_iron_toler_value = '4';
                                                        }
                                                        elseif($appear_after_washing_garments_seam_pucker_rop_iron_toler ==4.5)
                                                        {
                                                            $appear_after_washing_garments_seam_pucker_rop_iron_toler_value = '4-5';
                                                        }
                                                        elseif($appear_after_washing_garments_seam_pucker_rop_iron_toler ==5.0)
                                                        {
                                                            $appear_after_washing_garments_seam_pucker_rop_iron_toler_value = '5';
                                                        }
                                    
                                    
                                                        $appearance_after_washing_garments_seam_puckering_roping_after = $row_for_qc['appearance_after_washing_garments_seam_puckering_roping_after_ir'];
                                                            
                                                        if($appearance_after_washing_garments_seam_puckering_roping_after ==1.0)
                                                        {
                                                            $appearance_after_washing_garments_seam_puckering_roping_after_ir = '1';
                                                        }
                                                        elseif($appearance_after_washing_garments_seam_puckering_roping_after ==1.5)
                                                        {
                                                            $appearance_after_washing_garments_seam_puckering_roping_after_ir = '1-2';
                                                        }
                                                        elseif($appearance_after_washing_garments_seam_puckering_roping_after ==2.0)
                                                        {
                                                            $appearance_after_washing_garments_seam_puckering_roping_after_ir = '2';
                                                        }
                                                        elseif($appearance_after_washing_garments_seam_puckering_roping_after ==2.5)
                                                        {
                                                            $appearance_after_washing_garments_seam_puckering_roping_after_ir = '2-3';
                                                        }
                                                        elseif($appearance_after_washing_garments_seam_puckering_roping_after ==3.0)
                                                        {
                                                            $appearance_after_washing_garments_seam_puckering_roping_after_ir = '3';
                                                        }
                                                        elseif($appearance_after_washing_garments_seam_puckering_roping_after ==3.5)
                                                        {
                                                            $appearance_after_washing_garments_seam_puckering_roping_after_ir = '3-4';
                                                        }
                                                        elseif($appearance_after_washing_garments_seam_puckering_roping_after ==4.0)
                                                        {
                                                            $appearance_after_washing_garments_seam_puckering_roping_after_ir = '4';
                                                        }
                                                        elseif($appearance_after_washing_garments_seam_puckering_roping_after ==4.5)
                                                        {
                                                            $appearance_after_washing_garments_seam_puckering_roping_after_ir = '4-5';
                                                        }
                                                        elseif($appearance_after_washing_garments_seam_puckering_roping_after ==5.0)
                                                        {
                                                            $appearance_after_washing_garments_seam_puckering_roping_after_ir = '5';
                                                        } 				// for test result
                                    
                                                    }
                                                            
                                                    $form.="<tr>
                                                    <th >Garments (Seam puckering or roping After Iron)</th>
                                                    <td class='text-center'>".$appearance_after_washing_garments_seam_puckering_roping_after_ir."</td>
                                                    <td class='text-center'>".$row_for_defining_process['appear_after_wash_garments_seam_pucker_rop_iron_math_op'].' '.$appear_after_washing_garments_seam_pucker_rop_iron_toler_value."</td>
                                                    </tr>";
                                                }
                                                if($row_for_defining_process['detachment_of_interlinings_fused_components_garments']<>'' && $row_for_qc['appearance_after_washing_garments_detachment_of_interlining_valu']<>'')
                                                {
                                                    $form.="<tr>
                                                    <th >Garments (Detachment of interlinings / fused components)</th>
                                                    <td class='text-center'>".$row_for_qc['appearance_after_washing_garments_detachment_of_interlining_valu']."</td>
                                                    <td class='text-center'>".$row_for_defining_process['detachment_of_interlinings_fused_components_garments']."</td>
                                                    </tr>";
                                                }
                                                if($row_for_defining_process['change_id_handle_or_appearance']<>'' && $row_for_qc['appearance_after_washing_garments_change_in_handle_value']<>'')
                                                {
                                                    $form.="<tr>
                                                    <th >Garments (Change in handle or appearance)</th>
                                                    <td class='text-center'>".$row_for_qc['appearance_after_washing_garments_change_in_handle_value']."</td>
                                                    <td class='text-center'>".$row_for_defining_process['change_id_handle_or_appearance']."</td>
                                                    </tr>";
                                                }
                                                if($row_for_defining_process['effect_on_accessories_such_as_buttons']<>'' && $row_for_qc['appearance_after_washing_garments_effect_accessories_value']<>'')
                                                {
                                                    $form.="<tr>
                                                    <th >Garments (Effect on accessories such as buttons, zips etc.)</th>
                                                    <td class='text-center'>".$row_for_qc['appearance_after_washing_garments_effect_accessories_value']."</td>
                                                    <td class='text-center'>".$row_for_defining_process['effect_on_accessories_such_as_buttons']."</td>
                                                    </tr>";
                                                }
                                                if($row_for_defining_process['appearance_after_washing_garments_spirality_max_value']<>0 && $row_for_qc['appearance_after_washing_garments_spirality_value']<>0)
                                                {
                                                    $form.="<tr>
                                                    <th >Garments (Spirality (%))</th>
                                                    <td class='text-center'>".$row_for_qc['appearance_after_washing_garments_spirality_value']."</td>
                                                    <td class='text-center'>".$row_for_defining_process['appearance_after_washing_garments_spirality_min_value'].' to '.$row_for_defining_process['appearance_after_washing_garments_spirality_max_value']."</td>
                                                    </tr>";
                                                }
                                                if($row_for_defining_process['detachment_or_fraying_of_ribbons']<>'' && $row_for_qc['appearance_after_washing_garments_detachment_or_fraying_of_ribbo']<>'')
                                                {
                                                    $form.="<tr>
                                                    <th >Garments (Detachment or Fraying of ribbons / trims)</th>
                                                    <td class='text-center'>".$row_for_qc['appearance_after_washing_garments_detachment_or_fraying_of_ribbo']."</td>
                                                    <td class='text-center'>".$row_for_defining_process['detachment_or_fraying_of_ribbons']."</td>
                                                    </tr>";
                                                }
                                                if($row_for_defining_process['loss_of_print_garments']<>'' && $row_for_qc['appearance_after_washing_garments_loss_of_print_value']<>'')
                                                {
                                                    $form.="<tr>
                                                    <th >Garments (Loss of Print)</th>
                                                    <td class='text-center'>".$row_for_qc['appearance_after_washing_garments_loss_of_print_value']."</td>
                                                    <td class='text-center'>".$row_for_defining_process['loss_of_print_garments']."</td>
                                                    </tr>";
                                                }
                                                if($row_for_defining_process['care_level_garments']<>'' && $row_for_qc['appearance_after_washing_garments_care_level_value']<>'')
                                                {
                                                    $form.="<tr>
                                                    <th >Garments (Care Level)</th>
                                                    <td class='text-center'>".$row_for_qc['appearance_after_washing_garments_care_level_value']."</td>
                                                    <td class='text-center'>".$row_for_defining_process['care_level_garments']."</td>
                                                    </tr>";
                                                }
                                                if($row_for_defining_process['odor_garments']<>'' && $row_for_qc['appearance_after_washing_garments_odor_value']<>'')
                                                {
                                                    $form.="<tr>
                                                    <th >Garments (Odor)</th>
                                                    <td class='text-center'>".$row_for_qc['appearance_after_washing_garments_odor_value']."</td>
                                                    <td class='text-center'>".$row_for_defining_process['odor_garments']."</td>
                                                    </tr>";
                                                }
                                                if($row_for_defining_process['appearance_after_washing_other_observation_garments']<>'' && $row_for_qc['appearance_after_washing_other_observation_garments']<>'')
                                                {
                                                    $form.="<tr>
                                                    <th >Fabric (Other observation)</th>
                                                    <td class='text-center'>".$row_for_qc['appearance_after_washing_other_observation_garments']."</td>
                                                    <td class='text-center'>".$row_for_defining_process['appearance_after_washing_other_observation_garments']."</td>
                                                    </tr>";
                                                }
                                                $form.="</tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>";
                                }   
                                echo $form;
                                $form = "";                         
                            }    /*End of if (in_array($row['id'], ['3']))*/  
                        }
                 
                          // echo $form;
                         
                     ?>

                     
                   
                </form>


            </div>  <!-- End of <div id="element_for_test"> -->



          </body>   
      


    </div>   <!-- End of <div class="panel panel-default"> -->



     <div id="elementH"></div>

            <a href="report/pdf_file_for_all_test_report_for_finish_process.php?value_pdf=<?php echo urlencode($get_value) ?>"target="_blank">
                        <button type="button" id="pdf_file_for_all_test_report_for_finishing" name="pdf_file_for_all_test_report_for_finishing"  class="btn btn-primary btn-xs">Generate pdf file</button>
            </a>
             
       

       



</div>   <!-- End of <div class="col-sm-12 col-md-12 col-lg-12"> -->

    
<!-- <button onclick="generate_pdf_for_all_test()">print</button> -->
          




