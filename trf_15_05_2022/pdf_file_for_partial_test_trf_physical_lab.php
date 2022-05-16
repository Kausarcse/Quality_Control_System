
<?php
// ob_start();
/*require("../fpdf/fpdf.php");*/
include '../fpdf/code128.php';
session_start();

//include('../barcode/barcode.php');


require_once("../login/session.php");
include('../login/db_connection_class.php');
$obj = new DB_Connection_Class();
$obj->connection();


$customer_id=$_GET['customer_id'];
// echo $customer_id;

$splitted_data=explode('?fs?', $customer_id);


$customer_id=$splitted_data[0];
$trf_id=$splitted_data[1];
$process_id=$splitted_data[2];
$pp_number=$splitted_data[3];
$version_id=$splitted_data[4];
// echo "/// ".$customer_id;
// echo "/// ".$trf_id;

$sql_for_trf="select * from `partial_test_for_trf_info` where `partial_test_for_trf_info`.`trf_id`='$trf_id'";

$res_for_trf = mysqli_query($con, $sql_for_trf);

$row = mysqli_fetch_assoc($res_for_trf);


$customer_name = $row['customer_name'];
$version_number = $row['version_number'];
$pp_number = $row['pp_number'];
$finish_width_in_inch = $row['finish_width_in_inch'];
$new_process_id = $row['process_id'];

$washing= $row['washing'];
$bleaching= $row['bleaching'];
$ironing= $row['ironing'];
$dry_cleaning= $row['dry_cleaning'];
$drying= $row['drying'];



// Instanciation of inherited class
/*$pdf = new PDF('P','mm','A4');*/
// $pdf=new PDF_Code128('P','mm','A4');
$pdf=new PDF_Code128('P','mm',array(101.6,101.6));

$pdf->setTopMargin(3);

$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetAutoPageBreak(true,2);
// $pdf->SetFont('Arial','B',25);
$pdf->SetFont('Arial','B',7);
$pdf->Cell(90,0,'Zaber & Zubir Quality Control Processing Laboratory',0,0,'C');
$pdf->SetFont('Arial','B',6);
$pdf->Ln();

$pdf->Image('../img/zz_logo.png',5,3,10);
// Arial bold 15
// $pdf->SetFont('Arial','B',12);

// Move to the right
// $pdf->Cell(30);
// Title
// Line break
$pdf->Ln(4);

$pdf->SetFont('Arial','B',8);
$pdf->Cell(85,0,"Test Request Form","0","0","C");
// $pdf->Ln(2);
//$pdf->SetTextColor(252,3,3);

$pdf->setLeftMargin(4);
$pdf->Ln(4);
$pdf->setTextColor(0,0,0);
$pdf->SetFont('Arial','',6);
$pdf->Cell(3,3,"Fiber Composision : " .$row['fiber_composition'],"0","0","L");
$pdf->Ln(2);
$pdf->Cell(3,3,"Submitted Date : " .$row['recording_time'],"0","0","L");
//$pdf->Image(PHOTO_UPLOADPATH. $row['washing'],15,8,75);

//$pdf->UPC_A(100,30,$trf_id,10,0,35,9);
// $pdf->Cell(90,10,"","0","1","R");
/*$pdf->Cell(170,10,$pdf->Code128(50,20,$trf_id,40,10),"0","1","R");*/
// $pdf->Code128(130,50,$trf_id,60,10);
$pdf->Code128(68,9,$trf_id,30,5);
$pdf->Ln(0);
$pdf->setLeftMargin(4);

$pdf->Cell(90,6,"TRF ID : ".$trf_id,"0","0","R");
//$pdf->Cell(120,15, "Care Instruction :".$pdf->Image($washing,$pdf->GetX(), $pdf->GetY(), 10.78).$pdf->Image($bleaching,$pdf->GetX(), $pdf->GetY(), 10.78), "1","0","");
// $pdf->Cell(120,15, "Care Instruction :".$pdf->Image($washing,50, $pdf->GetY(), 9.50).$pdf->Image($bleaching,60, $pdf->GetY(), 9.50),"1","0","L");
 $pdf->Ln(5);
 $y = $pdf->GetY() + 0.5;
 $pdf->Cell(60,6, "Care Instruction :".$pdf->Image($washing,25, $y, 7).$pdf->Image($bleaching,33,$y, 6).$pdf->Image($ironing,41,$y, 6).$pdf->Image($drying,50,$y, 5).$pdf->Image($dry_cleaning,57, $y, 6),"1","0","L") ;
 //  $pdf->Cell(60,4, "Care Instruction :".$pdf->Image($washing,27, $pdf->GetY(), 5).$pdf->Image($bleaching,33, $pdf->GetY(), 3),"1","0","L");

//$pdf->Cell(40,10, "dddd", "1","0","");
//$img = base64_encode($row['washing']);
//$pdf->Image(70,10,$row['washing'],"1", "1","C");
$pdf->Cell(35,6,"Service Type :  ".$row['service_type'], "1", "1","C");
$pdf->SetFillColor(255, 204, 0); // input R, G, B
$pdf->Cell(95,4,"Test Report Type :  Partial Test", "1", "1","C",true);
$pdf->SetFillColor(255,255,0); // input R, G, B
$pdf->Cell(95,4, $row['process_name']. "  Process", "1", "1","C",true);
$pdf->SetFillColor(51,153,255); // input R, G, B
$pdf->Cell(95,4,"Required Test (Physical Lab)", "1", "0","C",true);
$pdf->Ln(5);
$pdf->SetFillColor(0,0,0); // input R, G, B
$pdf->SetFont('Times','B',7);
$pdf->Cell(30,3,"Test Name", "1", "0","C");
$pdf->Cell(45,3,"Test Methods", "1", "0","C");
$pdf->Cell(11,3,"Unit", "1", "0","C");
$pdf->Cell(9,3,"Remark", "1", "0","C");
$pdf->Ln(3);
$pdf->SetFont('Times','',6.5);
// $pdf->dataTable();



//--------------------------------------Singe_and_desize----------------------------------

if($new_process_id == 'proc_1')
{
        /***************** Displaying Result from qc_standard table [Start] *****************/
        $sql_for_singe_and_desize_process="select * from defining_qc_standard_for_singe_and_desize_process WHERE customer_name='$customer_name' and pp_number= '$pp_number' and version_number='$version_number' and `finish_width_in_inch`='$finish_width_in_inch' ";

        $report_for_singe_and_desize_process=mysqli_query($con,$sql_for_singe_and_desize_process) or die(mysqli_error($con));
        $row_for_defining_process=mysqli_fetch_array($report_for_singe_and_desize_process);
}

//---------------------------Scouring-----------------------------------

if($new_process_id == 'proc_2')
{
        /***************** Displaying Result from qc_standard table [Start] *****************/
        $sql_for_scouring_process="select * from defining_qc_standard_for_scouring_process WHERE customer_name='$customer_name' and pp_number= '$pp_number' and version_number='$version_number' and `finish_width_in_inch`='$finish_width_in_inch' ";

        $report_for_scouring_process=mysqli_query($con,$sql_for_scouring_process) or die(mysqli_error($con));
        $row_for_defining_process=mysqli_fetch_array($report_for_scouring_process);
}

//------------------------------Bleacing-------------------------------------------

if($new_process_id == 'proc_3')
{
        /***************** Displaying Result from qc_standard table [Start] *****************/
        $sql_for_bleaching_process="select * from defining_qc_standard_for_bleaching_process WHERE customer_name='$customer_name' and pp_number= '$pp_number' and version_number='$version_number' and `finish_width_in_inch`='$finish_width_in_inch' ";

        $report_for_bleaching_process=mysqli_query($con,$sql_for_bleaching_process) or die(mysqli_error($con));
        $row_for_defining_process=mysqli_fetch_array($report_for_bleaching_process);
}

//-------------------------------------------Scouring & Bleaching---------------------------

if($new_process_id == 'proc_4')
{
        /***************** Displaying Result from qc_standard table [Start] *****************/
        $sql_for_scouring_bleaching_process="select * from defining_qc_standard_for_scouring_bleaching_process WHERE customer_name='$customer_name' and pp_number= '$pp_number' and version_number='$version_number' and `finish_width_in_inch`='$finish_width_in_inch' ";

        $report_for_scouring_bleaching_process=mysqli_query($con,$sql_for_scouring_bleaching_process) or die(mysqli_error($con));
        $row_for_defining_process=mysqli_fetch_array($report_for_scouring_bleaching_process);
}

//---------------------------Ready For Mercerize--------------------------

if($new_process_id == 'proc_5')
{
        /***************** Displaying Result from qc_standard table [Start] *****************/
        $sql_for_ready_for_mercerize_process="select * from defining_qc_standard_for_ready_for_mercerize_process WHERE customer_name='$customer_name' and pp_number= '$pp_number' and version_number='$version_number' and `finish_width_in_inch`='$finish_width_in_inch' ";

        $report_for_ready_for_mercerize_process=mysqli_query($con,$sql_for_ready_for_mercerize_process) or die(mysqli_error($con));
        $row_for_defining_process=mysqli_fetch_array($report_for_ready_for_mercerize_process);
}

//--------------------------Mercerize----------------------------------------

if($new_process_id == 'proc_6')
{
        /***************** Displaying Result from qc_standard table [Start] *****************/
        $sql_for_mercerize_process="select * from defining_qc_standard_for_mercerize_process WHERE customer_name='$customer_name' and pp_number= '$pp_number' and version_number='$version_number' and `finish_width_in_inch`='$finish_width_in_inch' ";

        $report_for_mercerize_process=mysqli_query($con,$sql_for_mercerize_process) or die(mysqli_error($con));
        $row_for_defining_process=mysqli_fetch_array($report_for_mercerize_process);
}
//---------------------------Ready For Print---------------------

if($new_process_id == 'proc_7')
{
        /***************** Displaying Result from qc_standard table [Start] *****************/
        $sql_for_ready_for_printing_process="select * from defining_qc_standard_for_ready_for_printing_process WHERE customer_name='$customer_name' and pp_number= '$pp_number' and version_number='$version_number' and `finish_width_in_inch`='$finish_width_in_inch' ";

        $report_for_ready_for_printing_process=mysqli_query($con,$sql_for_ready_for_printing_process) or die(mysqli_error($con));
        $row_for_defining_process=mysqli_fetch_array($report_for_ready_for_printing_process);
}

//----------------------------Printing-----------------------------------------

if($new_process_id == 'proc_8')
{
        /***************** Displaying Result from qc_standard table [Start] *****************/
        $sql_for_printing_process="select * from defining_qc_standard_for_printing_process WHERE customer_name='$customer_name' and pp_number= '$pp_number' and version_number='$version_number' and `finish_width_in_inch`='$finish_width_in_inch' ";

        $report_for_printing_process=mysqli_query($con,$sql_for_printing_process) or die(mysqli_error($con));
        $row_for_defining_process=mysqli_fetch_array($report_for_printing_process);
}

//----------------------------Curing---------------------------------

if($new_process_id == 'proc_9')
{
        /***************** Displaying Result from qc_standard table [Start] *****************/
        $sql_for_curing_process="select * from defining_qc_standard_for_curing_process WHERE customer_name='$customer_name' and pp_number= '$pp_number' and version_number='$version_number' and `finish_width_in_inch`='$finish_width_in_inch' ";

        $report_for_curing_process=mysqli_query($con,$sql_for_curing_process) or die(mysqli_error($con));
        $row_for_defining_process=mysqli_fetch_array($report_for_curing_process);
}

//--------------------------------------Steaming------------------------

if($new_process_id == 'proc_10')
{
        /***************** Displaying Result from qc_standard table [Start] *****************/
        $sql_for_steaming_process="select * from defining_qc_standard_for_steaming_process WHERE customer_name='$customer_name' and pp_number= '$pp_number' and version_number='$version_number' and `finish_width_in_inch`='$finish_width_in_inch' ";

        $report_for_steaming_process=mysqli_query($con,$sql_for_steaming_process) or die(mysqli_error($con));
        $row_for_defining_process=mysqli_fetch_array($report_for_steaming_process);
}

//----------------------------Ready for Dyeing---------------------------------

if($new_process_id == 'proc_11')
{
        /***************** Displaying Result from qc_standard table [Start] *****************/
        $sql_for_ready_for_dying_process="select * from defining_qc_standard_for_ready_for_dying_process WHERE customer_name='$customer_name' and pp_number= '$pp_number' and version_number='$version_number' and `finish_width_in_inch`='$finish_width_in_inch' ";

        $report_for_ready_for_dying_process=mysqli_query($con,$sql_for_ready_for_dying_process) or die(mysqli_error($con));
        $row_for_defining_process=mysqli_fetch_array($report_for_ready_for_dying_process);
}

//-----------------------------------Washing---------------------------

if($new_process_id == 'proc_13')
{
        /***************** Displaying Result from qc_standard table [Start] *****************/
        $sql_for_washing_process="select * from defining_qc_standard_for_washing_process WHERE customer_name='$customer_name' and pp_number= '$pp_number' and version_number='$version_number' and `finish_width_in_inch`='$finish_width_in_inch' ";

        $report_for_washing_process=mysqli_query($con,$sql_for_washing_process) or die(mysqli_error($con));
        $row_for_defining_process=mysqli_fetch_array($report_for_washing_process);
}

//-------------------------------Ready For Raising------------------------------
if($new_process_id == 'proc_14')
{
        /***************** Displaying Result from qc_standard table [Start] *****************/
        $sql_for_ready_for_raising_process="select * from defining_qc_standard_for_ready_for_raising_process WHERE customer_name='$customer_name' and pp_number= '$pp_number' and version_number='$version_number' and `finish_width_in_inch`='$finish_width_in_inch' ";

        $report_for_ready_for_raising_process=mysqli_query($con,$sql_for_ready_for_raising_process) or die(mysqli_error($con));
        $row_for_defining_process=mysqli_fetch_array($report_for_ready_for_raising_process);
}

//------------------------------------------Raising------------------------------

if($new_process_id == 'proc_15')
{
        /***************** Displaying Result from qc_standard table [Start] *****************/
        $sql_for_raising_process="select * from defining_qc_standard_for_raising_process WHERE customer_name='$customer_name' and pp_number= '$pp_number' and version_number='$version_number' and `finish_width_in_inch`='$finish_width_in_inch' ";

        $report_for_raising_process=mysqli_query($con,$sql_for_raising_process) or die(mysqli_error($con));
        $row_for_defining_process=mysqli_fetch_array($report_for_raising_process);
}


//----------------------------------------- Finishing process------------------------------
if($new_process_id == 'proc_16')
{
         /***************** Displaying Result from qc_standard table [Start] *****************/
         $sql_for_finishing_process="select * from defining_qc_standard_for_finishing_process WHERE customer_name='$customer_name' and pp_number= '$pp_number' and version_number='$version_number' and `finish_width_in_inch`='$finish_width_in_inch' ";

         // $sql_for_finishing_process="select * from defining_qc_standard_for_finishing_process WHERE customer_name='Ikea' and pp_number= '5893/2020' and version_number='Qc Back'";
         $report_for_finishing_process=mysqli_query($con,$sql_for_finishing_process) or die(mysqli_error($con));
         $row_for_defining_process=mysqli_fetch_array($report_for_finishing_process);
}


//------------------------------Calender--------------------------------

if($new_process_id == 'proc_17')
{
        /***************** Displaying Result from qc_standard table [Start] *****************/
        $sql_for_calendering_process="select * from defining_qc_standard_for_calendering_process WHERE customer_name='$customer_name' and pp_number= '$pp_number' and version_number='$version_number' and `finish_width_in_inch`='$finish_width_in_inch' ";

        $report_for_calendering_process=mysqli_query($con,$sql_for_calendering_process) or die(mysqli_error($con));
        $row_for_defining_process=mysqli_fetch_array($report_for_calendering_process);
}

//------------------------------Sanforizing--------------------------------

if($new_process_id == 'proc_18')
{
        /***************** Displaying Result from qc_standard table [Start] *****************/
        $sql_for_sanforizing_process="select * from defining_qc_standard_for_sanforizing_process WHERE customer_name='$customer_name' and pp_number= '$pp_number' and version_number='$version_number' and `finish_width_in_inch`='$finish_width_in_inch' ";

        $report_for_sanforizing_process=mysqli_query($con,$sql_for_sanforizing_process) or die(mysqli_error($con));
        $row_for_defining_process=mysqli_fetch_array($report_for_sanforizing_process);
}

//-------------------------------Greige Receiving----------------------------

if($new_process_id == 'proc_20')
{
      /***************** Displaying Result from qc_standard table [Start] *****************/
	$sql_for_greige_receiving_process="select * from defining_qc_standard_for_greige_receiving_process WHERE customer_name='$customer_name' and pp_number= '$pp_number' and version_number='$version_number'  and `finish_width_in_inch`='$finish_width_in_inch'";

	$report_for_greige_receiving_process=mysqli_query($con,$sql_for_greige_receiving_process) or die(mysqli_error($con));
	$row_for_defining_process=mysqli_fetch_array($report_for_greige_receiving_process);
}




// $sql_for_trfs="SELECT DISTINCT tmfc.test_name,tmfc.test_method_name,tmn.criteria_or_testing_lab from
//                             data_for_all_standard das 
//                             INNER JOIN test_method_for_customer tmfc on das.test_method_id=tmfc.test_method_id  and das.customer_id=tmfc.customer_id
//                             INNER JOIN test_method_name tmn on tmn.test_method_id = tmfc.test_method_id
//                             WHERE das.pp_number='$pp_number'  and das.customer_id='$customer_id'  and das.process_id='$process_id' and das.version_id='$version_id'";

$sql_for_trfs = "SELECT DISTINCT tnmp.id, tmn.test_method_id, tmc.test_name, tmc.test_method_name, tmn.criteria_or_testing_lab
FROM test_name_and_method_for_all_process tnmp
INNER JOIN test_method_name tmn ON tnmp.id = tmn.test_name_and_method_for_process_id 
INNER JOIN transaction_test_name_and_method ttnm ON ttnm.test_name_and_method_for_process_id = tmn.test_name_and_method_for_process_id
INNER JOIN test_method_for_customer tmc ON tmc.test_id = ttnm.test_name_id AND tmc.test_method_id = tmn.test_method_id
INNER JOIN data_for_all_standard das ON das.test_method_id=tmc.test_method_id  and das.customer_id=tmc.customer_id
WHERE das.pp_number='$pp_number' and tmc.customer_id='$customer_id' and das.process_id='$process_id' and das.version_id='$version_id' ORDER BY ttnm.test_name_and_method_for_process_id ASC";
$res_for_trfs = mysqli_query($con, $sql_for_trfs);


while($row_for_test = mysqli_fetch_assoc($res_for_trfs))
{
    if($row_for_test['criteria_or_testing_lab']=='Physical Lab')
    {

        // $pdf->Cell(35,3, $rd['test_name'], "1", "0","L");
        // $pdf->Cell(35,3, $rd['test_method_name'], "1", "0","L");
        // $pdf->Cell(15,3, "","1", "0","R");
        // $pdf->Cell(10,3, "","1", "0","R");
        // $pdf->Ln();

        ///////////////    CF_to_rubbing    ////////////////////////
        if (in_array($row_for_test['id'], ['1']))
        {
            if($row_for_defining_process['uom_of_cf_to_rubbing_dry']<>'')
            {
                $uom_of_cf_to_rubbing = $row_for_defining_process['uom_of_cf_to_rubbing_dry'];
                $arr_uom_of_cf_to_rubbing = explode(' ',trim($uom_of_cf_to_rubbing));
                if( ($arr_uom_of_cf_to_rubbing[0] == 'Select') || ($arr_uom_of_cf_to_rubbing[0] == 'select') || ($arr_uom_of_cf_to_rubbing[0] == '') )
                {
                    $uom_of_cf_to_rubbing = '';
                }
            }
            else if($row_for_defining_process['uom_of_cf_to_rubbing_wet']<>'')
            {
                $uom_of_cf_to_rubbing = $row_for_defining_process['uom_of_cf_to_rubbing_wet'];
                $arr_uom_of_cf_to_rubbing = explode(' ',trim($uom_of_cf_to_rubbing));
                if( ($arr_uom_of_cf_to_rubbing[0] == 'Select') || ($arr_uom_of_cf_to_rubbing[0] == 'select') || ($arr_uom_of_cf_to_rubbing[0] == '') )
                {
                    $uom_of_cf_to_rubbing = '';
                }
            }
            $x = $pdf->GetX();
            $y = $pdf->GetY();
            $data = $row_for_test['test_name'];
            strlen($data)<30?$b=4.8:$b=2.4;
            $pdf->MultiCell(30,$b,$data.$pdf->SetFillColor(255,255,255),'1','L',TRUE);
            $pdf->SetXY($x + 30, $y);
            $pdf->SetFont('Times','',6);
            $data = $row_for_test['test_method_name'];

            strlen($data)<45?$b=4.8:$b=2.4;
            $pdf->MultiCell(45,$b,$data.$pdf->SetFillColor(255,255,255),'1','L',TRUE);
            $pdf->SetXY($x + 75, $y);
            $pdf->SetFont('Times','',6.5);
            $b = 4.8;
            $pdf->MultiCell(11,$b,$uom_of_cf_to_rubbing,'1','L',TRUE);
            $pdf->SetXY($x + 86, $y);
            $pdf->MultiCell(9,$b,'','1','L',TRUE);
        }

         ///////////////   Number of threads per unit length   ////////////////////////
         if (in_array($row_for_test['id'], ['4']))
         {
             if($row_for_defining_process['uom_of_no_of_threads_in_warp_value']<>'')
             {
                 $uom_of_no_of_threads = $row_for_defining_process['uom_of_no_of_threads_in_warp_value'];
                 $arr_uom_of_no_of_threads = explode(' ',trim($uom_of_no_of_threads));
                 if( ($arr_uom_of_no_of_threads[0] == 'Select') || ($arr_uom_of_no_of_threads[0] == 'select') || ($arr_uom_of_no_of_threads[0] == '') )
                 {
                     $uom_of_no_of_threads = '';
                 }
             }
             else if($row_for_defining_process['uom_of_no_of_threads_in_weft_value']<>'')
             {
                 $uom_of_no_of_threads = $row_for_defining_process['uom_of_no_of_threads_in_weft_value'];
                 $arr_uom_of_no_of_threads = explode(' ',trim($uom_of_no_of_threads));
                 if( ($arr_uom_of_no_of_threads[0] == 'Select') || ($arr_uom_of_no_of_threads[0] == 'select') || ($arr_uom_of_no_of_threads[0] == '') )
                 {
                     $uom_of_no_of_threads = '';
                 }
             }
            
             $x = $pdf->GetX();
             $y = $pdf->GetY();
             $data = $row_for_test['test_name'];
             strlen($data)<30?$b=4.8:$b=2.4;
             $pdf->MultiCell(30,$b,$data.$pdf->SetFillColor(255,255,255),'1','L',TRUE);
             $pdf->SetXY($x + 30, $y);
             $pdf->SetFont('Times','',6);
             $data = $row_for_test['test_method_name'];

             strlen($data)<45?$b=4.8:$b=2.4;
             $pdf->MultiCell(45,$b,$data.$pdf->SetFillColor(255,255,255),'1','L',TRUE);
             $pdf->SetXY($x + 75, $y);
             $pdf->SetFont('Times','',6.5);
             $b = 4.8;
             $pdf->MultiCell(11,$b,$uom_of_no_of_threads,'1','L',TRUE);
             $pdf->SetXY($x + 86, $y);
             $pdf->MultiCell(9,$b,'','1','L',TRUE);
         }

         
         ///////////////   Mas per unit area   ////////////////////////
         if (in_array($row_for_test['id'], ['5']))
         {
             if($row_for_defining_process['uom_of_mass_per_unit_per_area_value']<>'')
             {
                 $uom_of_mass_per_unit_per_area_value = $row_for_defining_process['uom_of_mass_per_unit_per_area_value'];
                 $arr_uom_of_mass_per_unit_per_area_value = explode(' ',trim($uom_of_mass_per_unit_per_area_value));
                 if( ($arr_uom_of_mass_per_unit_per_area_value[0] == 'Select') || ($arr_uom_of_mass_per_unit_per_area_value[0] == 'select') || ($arr_uom_of_mass_per_unit_per_area_value[0] == '') )
                 {
                     $uom_of_mass_per_unit_per_area_value = '';
                 }
             }
             
            
             $x = $pdf->GetX();
             $y = $pdf->GetY();
             $data = $row_for_test['test_name'];
             strlen($data)<30?$b=4.8:$b=2.4;
             $pdf->MultiCell(30,$b,$data.$pdf->SetFillColor(255,255,255),'1','L',TRUE);
             $pdf->SetXY($x + 30, $y);
             $pdf->SetFont('Times','',6);
             $data = $row_for_test['test_method_name'];

             strlen($data)<45?$b=4.8:$b=2.4;
             $pdf->MultiCell(45,$b,$data.$pdf->SetFillColor(255,255,255),'1','L',TRUE);
             $pdf->SetXY($x + 75, $y);
             $pdf->SetFont('Times','',6.5);
             $b = 4.8;
             $pdf->MultiCell(11,$b,$uom_of_mass_per_unit_per_area_value,'1','L',TRUE);
             $pdf->SetXY($x + 86, $y);
             $pdf->MultiCell(9,$b,'','1','L',TRUE);
         }

          
         ///////////////   Resistance to pilling  ////////////////////////
         if (in_array($row_for_test['id'], ['6']))
         {
             if($row_for_defining_process['uom_of_surface_fuzzing_and_pilling_value']<>'')
             {
                 $uom_of_surface_fuzzing_and_pilling_value = $row_for_defining_process['uom_of_surface_fuzzing_and_pilling_value'];
                 $arr_uom_of_surface_fuzzing_and_pilling_value = explode(' ',trim($uom_of_surface_fuzzing_and_pilling_value));
                 if( ($arr_uom_of_surface_fuzzing_and_pilling_value[0] == 'Select') || ($arr_uom_of_surface_fuzzing_and_pilling_value[0] == 'select') || ($arr_uom_of_surface_fuzzing_and_pilling_value[0] == '') )
                 {
                     $uom_of_surface_fuzzing_and_pilling_value = '';
                 }
             }
             if($row_for_defining_process['description_or_type_for_surface_fuzzing_and_pilling']<>'')
             {
                 $description_or_type_for_surface_fuzzing_and_pilling = $row_for_defining_process['description_or_type_for_surface_fuzzing_and_pilling'];
                 $arr_description_of_surface_fuzzing_and_pilling = explode(' ',trim($description_or_type_for_surface_fuzzing_and_pilling));
                 if( ($arr_description_of_surface_fuzzing_and_pilling[0] == 'Select') || ($arr_description_of_surface_fuzzing_and_pilling[0] == 'select') || ($arr_description_of_surface_fuzzing_and_pilling[0] == '') )
                 {
                     $description_or_type_for_surface_fuzzing_and_pilling = '';
                 }
                 else
                 {
                    $description_or_type_for_surface_fuzzing_and_pilling = '('.$row_for_defining_process['description_or_type_for_surface_fuzzing_and_pilling'].')';
                 }
             }
             
            
             $x = $pdf->GetX();
             $y = $pdf->GetY();
             $data = $row_for_test['test_name'];
             strlen($data)<30?$b=4.8:$b=2.4;
             $pdf->MultiCell(30,$b,$data.$pdf->SetFillColor(255,255,255),'1','L',TRUE);
             $pdf->SetXY($x + 30, $y);
             $pdf->SetFont('Times','',6);
             $data = $row_for_test['test_method_name'].' '.$description_or_type_for_surface_fuzzing_and_pilling;

             strlen($data)<45?$b=4.8:$b=2.4;
             $pdf->MultiCell(45,$b,$data.$pdf->SetFillColor(255,255,255),'1','L',TRUE);
             $pdf->SetXY($x + 75, $y);
             $pdf->SetFont('Times','',6.5);
             $b = 4.8;
             $pdf->MultiCell(11,$b,$uom_of_surface_fuzzing_and_pilling_value,'1','L',TRUE);
             $pdf->SetXY($x + 86, $y);
             $pdf->MultiCell(9,$b,'','1','L',TRUE);
         }

          ///////////////   Tensile properties  ////////////////////////
          if (in_array($row_for_test['id'], ['7']))
          {
              if($row_for_defining_process['uom_of_tensile_properties_in_warp_value']<>'')
              {
                  $uom_of_tensile_properties = $row_for_defining_process['uom_of_tensile_properties_in_warp_value'];
                  $arr_uom_of_tensile_properties = explode(' ',trim($uom_of_tensile_properties));
                    if( ($arr_uom_of_tensile_properties[0] == 'Select') || ($arr_uom_of_tensile_properties[0] == 'select') || ($arr_uom_of_tensile_properties[0] == '') )
                    {
                        $uom_of_tensile_properties = '';
                    }
              }
              if($row_for_defining_process['uom_of_tensile_properties_in_weft_value']<>'')
              {
                  $uom_of_tensile_properties = $row_for_defining_process['uom_of_tensile_properties_in_weft_value'];
                  $arr_uom_of_tensile_properties = explode(' ',trim($uom_of_tensile_properties));
                  if( ($arr_uom_of_tensile_properties[0] == 'Select') || ($arr_uom_of_tensile_properties[0] == 'select') || ($arr_uom_of_tensile_properties[0] == '') )
                  {
                      $uom_of_tensile_properties = '';
                  }
              }
              
             
              $x = $pdf->GetX();
              $y = $pdf->GetY();
              $data = $row_for_test['test_name'];
              strlen($data)<30?$b=4.8:$b=2.4;
              $pdf->MultiCell(30,$b,$data.$pdf->SetFillColor(255,255,255),'1','L',TRUE);
              $pdf->SetXY($x + 30, $y);
              $pdf->SetFont('Times','',6);
              $data = $row_for_test['test_method_name'];

              strlen($data)<45?$b=4.8:$b=2.4;
              $pdf->MultiCell(45,$b,$data.$pdf->SetFillColor(255,255,255),'1','L',TRUE);
              $pdf->SetXY($x + 75, $y);
              $pdf->SetFont('Times','',6.5);
              $b = 4.8;
              $pdf->MultiCell(11,$b,$uom_of_tensile_properties,'1','L',TRUE);
              $pdf->SetXY($x + 86, $y);
              $pdf->MultiCell(9,$b,'','1','L',TRUE);
          }

           ///////////////   Tear properties  ////////////////////////
           if (in_array($row_for_test['id'], ['8']))
           {
               if($row_for_defining_process['uom_of_tear_force_in_warp_value']<>'')
               {
                   $uom_of_tear_properties = $row_for_defining_process['uom_of_tear_force_in_warp_value'];
                   $arr_uom_of_tear_properties = explode(' ',trim($uom_of_tear_properties));
                   if( ($arr_uom_of_tear_properties[0] == 'Select') || ($arr_uom_of_tear_properties[0] == 'select') || ($arr_uom_of_tear_properties[0] == '') )
                   {
                       $uom_of_tear_properties = '';
                   }
               }
               if($row_for_defining_process['uom_of_tear_force_in_weft_value']<>'')
               {
                   $uom_of_tear_properties = $row_for_defining_process['uom_of_tear_force_in_weft_value'];
                   $arr_uom_of_tear_properties = explode(' ',trim($uom_of_tear_properties));
                   if( ($arr_uom_of_tear_properties[0] == 'Select') || ($arr_uom_of_tear_properties[0] == 'select') || ($arr_uom_of_tear_properties[0] == '') )
                   {
                       $uom_of_tear_properties = '';
                   }
               }
               
              
               $x = $pdf->GetX();
               $y = $pdf->GetY();
               $data = $row_for_test['test_name'];
               strlen($data)<30?$b=4.8:$b=2.4;
               $pdf->MultiCell(30,$b,$data.$pdf->SetFillColor(255,255,255),'1','L',TRUE);
               $pdf->SetXY($x + 30, $y);
               $pdf->SetFont('Times','',6);
               $data = $row_for_test['test_method_name'];

               strlen($data)<45?$b=4.8:$b=2.4;
               $pdf->MultiCell(45,$b,$data.$pdf->SetFillColor(255,255,255),'1','L',TRUE);
               $pdf->SetXY($x + 75, $y);
               $pdf->SetFont('Times','',6.5);
               $b = 4.8;
               $pdf->MultiCell(11,$b,$uom_of_tear_properties,'1','L',TRUE);
               $pdf->SetXY($x + 86, $y);
               $pdf->MultiCell(9,$b,'','1','L',TRUE);
           }

             ///////////////   Ph value  ////////////////////////
           if (in_array($row_for_test['id'], ['33','48']))
           {
            //    if($row_for_defining_process['uom_of_ph_value']<>'')
            //    {
            //        $uom_of_ph_value = $row_for_defining_process['uom_of_ph_value'];
            //    }
              
               $x = $pdf->GetX();
               $y = $pdf->GetY();
               $data = $row_for_test['test_name'];
               strlen($data)<30?$b=4.8:$b=2.4;
               $pdf->MultiCell(30,$b,$data.$pdf->SetFillColor(255,255,255),'1','L',TRUE);
               $pdf->SetXY($x + 30, $y);
               $pdf->SetFont('Times','',6);
               $data = $row_for_test['test_method_name'];

               strlen($data)<45?$b=4.8:$b=2.4;
               $pdf->MultiCell(45,$b,$data.$pdf->SetFillColor(255,255,255),'1','L',TRUE);
               $pdf->SetXY($x + 75, $y);
               $pdf->SetFont('Times','',6.5);
               $b = 4.8;
               $pdf->MultiCell(11,$b,'','1','L',TRUE);
               $pdf->SetXY($x + 86, $y);
               $pdf->MultiCell(9,$b,'','1','L',TRUE);
           }


            
           ///////////////   Yarn count  ////////////////////////
           if (in_array($row_for_test['id'], ['74']))
           {
               if($row_for_defining_process['uom_of_warp_yarn_count_value']<>'')
               {
                   $uom_of_yarn_count_value = $row_for_defining_process['uom_of_warp_yarn_count_value'];
                   $arr_uom_of_yarn_count_value = explode(' ',trim($uom_of_yarn_count_value));
                   if( ($arr_uom_of_yarn_count_value[0] == 'Select') || ($arr_uom_of_yarn_count_value[0] == 'select') || ($arr_uom_of_yarn_count_value[0] == '') )
                   {
                       $uom_of_yarn_count_value = '';
                   }
               }
               if($row_for_defining_process['uom_of_weft_yarn_count_value']<>'')
               {
                   $uom_of_yarn_count_value = $row_for_defining_process['uom_of_weft_yarn_count_value'];
                   $arr_uom_of_yarn_count_value = explode(' ',trim($uom_of_yarn_count_value));
                   if( ($arr_uom_of_yarn_count_value[0] == 'Select') || ($arr_uom_of_yarn_count_value[0] == 'select') || ($arr_uom_of_yarn_count_value[0] == '') )
                   {
                       $uom_of_yarn_count_value = '';
                   }
               }
               
              
               $x = $pdf->GetX();
               $y = $pdf->GetY();
               $data = $row_for_test['test_name'];
               strlen($data)<30?$b=4.8:$b=2.4;
               $pdf->MultiCell(30,$b,$data.$pdf->SetFillColor(255,255,255),'1','L',TRUE);
               $pdf->SetXY($x + 30, $y);
               $pdf->SetFont('Times','',6);
               $data = $row_for_test['test_method_name'];

               strlen($data)<45?$b=4.8:$b=2.4;
               $pdf->MultiCell(45,$b,$data.$pdf->SetFillColor(255,255,255),'1','L',TRUE);
               $pdf->SetXY($x + 75, $y);
               $pdf->SetFont('Times','',6.5);
               $b = 4.8;
               $pdf->MultiCell(11,$b,$uom_of_yarn_count_value,'1','L',TRUE);
               $pdf->SetXY($x + 86, $y);
               $pdf->MultiCell(9,$b,'','1','L',TRUE);
           }

       
        
       
    }
}
// $pdf->Cell(10,4.8, "","1", "1","R");
// $pdf->Cell(10,4.8, "","1", "1","R");
// $pdf->Cell(10,4.8, "","1", "1","R");
// $pdf->Cell(10,4.8, "","1", "1","R");






$pdf->Ln(1.5);
$pdf->SetFont('Times','B',6);
$pdf->Cell(50,3.5,"Submitted By : ".$row['employee_name'],"0","0","L");

ob_end_clean();

$pdf->Output('I', "physical_lab_for_trf_id_".$trf_id.".pdf", true);
// ob_end_flush();
?>
