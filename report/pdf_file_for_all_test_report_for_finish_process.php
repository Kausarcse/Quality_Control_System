
<?php
// error_reporting(0);
// ob_start();
include '../fpdf/code128.php';


session_start();

//include('../barcode/barcode.php');


require_once("../login/session.php");
include('../login/db_connection_class.php');
$obj = new DB_Connection_Class();
$obj->connection();

 $value=$_GET['value_pdf'];

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


    // $sql_for_customer = "SELECT customer_type from customer WHERE customer_id = '$customer_id' AND customer_name = '$customer_name'";
	// $result_for_customer = mysqli_query($con, $sql_for_customer) or die(mysqli_error($con));
	// $row_for_customer = mysqli_fetch_assoc($result_for_customer);
	
	//  $customer_type =  $row_for_customer['customer_type'];

 date_default_timezone_set('Asia/Dhaka'); 
 $currnet_date = date("d-m-Y h:i:s A");

 

/***************** Displaying Result from qc_standard table [Start] *****************/
$sql_for_finishing_process="select * from defining_qc_standard_for_finishing_process WHERE customer_name='$customer_name' and pp_number= '$pp_number' and version_number='$version_number' and `finish_width_in_inch`='$finish_width_in_inch' ";

// $sql_for_finishing_process="select * from defining_qc_standard_for_finishing_process WHERE customer_name='Ikea' and pp_number= '5893/2020' and version_number='Qc Back'";
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


   /***************** Displaying Result from process_program_info table [Start] *****************/
   $sql_for_process_program_info="SELECT distinct * FROM process_program_info ppi
   INNER JOIN pp_wise_version_creation_info pwvci on ppi.pp_number=pwvci.pp_number
   INNER JOIN partial_test_for_test_result_info ptftri  on ppi.pp_number=ptftri.pp_number and  pwvci.version_name=ptftri.version_number and pwvci.style_name=ptftri.style and pwvci.finish_width_in_inch=ptftri.finish_width_in_inch
    WHERE ppi.customer_name='$customer_name' and ppi.pp_number= '$pp_number' and pwvci.version_name='$version_number' and pwvci.`style_name`='$style' and pwvci.`finish_width_in_inch`='$finish_width_in_inch' and ptftri.process_id='proc_16'";
  
  
   $report_for_process_program_info=mysqli_query($con,$sql_for_process_program_info) or die(mysqli_error($con));
   $row_for_process_program_info=mysqli_fetch_array($report_for_process_program_info);

$trf_id=$row_for_process_program_info['trf_id'];

$washing= $row_for_process_program_info['washing'];
$bleaching= $row_for_process_program_info['bleaching'];
$ironing= $row_for_process_program_info['ironing'];
$dry_cleaning= $row_for_process_program_info['dry_cleaning'];
$drying= $row_for_process_program_info['drying'];

if($row_for_process_program_info['other_fiber_in_yarn']=='Null')
{
    $val='';
}
else 
{
    $val=$row_for_process_program_info['percentage_of_other_fiber_content'].'% '.$row_for_process_program_info['other_fiber_in_yarn'];
}
$fiber=$row_for_process_program_info['percentage_of_cotton_content'].'% Cotton '.$row_for_process_program_info['percentage_of_polyester_content'].'% Polyester '.$val;

class PDF extends PDF_Code128
{
   
// Page header
function Header()
{
   
    $this->setTopMargin(10);

    $this->SetFont('Arial','B',12);
   

    $this->setLeftMargin(0);
    $this->Cell(150,5,'Zaber & Zubir Quality Control Processing Laboratory',"0","0",'L');
      
    $this->Ln(2);

    $this->Image('../img/zz_logo.png',5,16,20);

    $this->setLeftMargin(27);
    $this->Ln(5);
    $this->setTextColor(0,0,0);
    $this->SetFont('Arial','',8);
    $this->Cell(105,3,"PAGAR, TONGI, GAZIPUR, BANGLADESH","0","0","L");
  
    $this->Ln(3);
    $this->Cell(105,3,"Contact Info : (+8802) 9801012, 9801146 Visit us at www.znzfab.com, ","0","0","L");
   
    $this->Ln(3);
    $this->Cell(50,3,"E-mail : ftslab@znzfab.com","0","0","L");
    
$this->Ln(10);
$this->setLeftMargin(17);

}

// Page footer
function Footer()
{
    $this->SetFont('Times','',6);
    $this->SetY(-8);
    $this->SetTextColor(0,0,0);

    /*$this->SetFont('Times','B',6);
    $this->Cell(65,6,"REPORT BY : _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ ","0","0","L");
    $this->Cell(65,6,"CHECKED BY : _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _","0","0","L");
    $this->Cell(65,6,"VERIFIED BY : _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _","0","1","L");
    $this->SetFont('Arial','I',8);
*/ 
    
    $this->Cell(0,5,'Page '.$this->PageNo().'/{nb}',0,1,'C');
    // $this->setLeftMargin(10);
    $this->SetFont('Arial','',6);
   

    $this->AcceptPageBreak();
    $this->SetAutoPageBreak(true, 10);
    
}


// protected $col = 0;

// function SetCol($col)
// {
//     // Set position on top of a column
//     $this->col = $col;
//     $this->SetLeftMargin(10+$col*40);
//     $this->SetY(25);
// }

// function AcceptPageBreak()
// {
//     // Go to the next column
//     $this->SetCol($this->col+1);
//     return false;
// }

// function DumpFont($FontName)
// {
//     for($i=163;$i<=163;$i++)
//     {
//         $this->SetFont($FontName);
//         $this->Cell(0,5,chr($i),0,0);
//     }
   
// }



}


// Instanciation of inherited class
/*$pdf = new PDF('P','mm','A4');*/
$pdf=new PDF('P','mm','A4');
// $pdf=new PDF_Code128('P','mm',array(101.6,101.6));
$pdf->AliasNbPages();
$pdf->AddPage();
$counter = 30;
$pdf->AcceptPageBreak();
$pdf->SetAutoPageBreak(true, 10);
$pdf->Ln(0);
$pdf->setTopMargin(0);
$pdf->setLeftMargin(135);
$pdf->setTopMargin(10);
$pdf->SetFont('Arial','',8);
$pdf->Cell(60,-25,"Date of publish :  ".$currnet_date,0,0,'L');
$pdf->Ln(0);

$pdf->setLeftMargin(6);
$counter = $counter + 10;

$pdf->Code128(136,23,$trf_id,50,8);
$pdf->Ln(0);
$pdf->Cell(300,4,"Report No: ".$trf_id,"0","0","C");
$pdf->Ln(10);
$pdf->setLeftMargin(6);
$pdf->SetFont('Times','B',18);
$pdf->Cell(190,6,"Test Report for ".$row_for_process_program_info['customer_name'],"0","0","C");

$pdf->Ln(10);
$pdf->Cell(200,0,"","1","0","C");
$pdf->Ln(2);
$pdf->setLeftMargin(20);
$counter = $counter + 22;

$pdf->SetFont('Arial','B',9);
$pdf->Cell(60,7,"SAMPLE DETAILS (PP DESCRIPTION)","0","0","L");
$pdf->Cell(15,7," : ","0","0","L");
$pdf->SetFont('Arial','',9);
$pdf->Cell(70,7,"".$row_for_process_program_info['pp_description'],"0","1","L");

$pdf->SetFont('Arial','B',9);
$pdf->Cell(60,7,"PP NO.","0","0","L");
$pdf->Cell(15,7," : ","0","0","L");
$pdf->SetFont('Arial','',9);
$pdf->Cell(70,7,"".$row_for_process_program_info['pp_number'],"0","1","L");

$pdf->SetFont('Arial','B',9);
$pdf->Cell(60,7,"DESIGN","0","0","L");
$pdf->Cell(15,7," : ","0","0","L");
$pdf->SetFont('Arial','',9);
$pdf->Cell(70,7,"".$row_for_process_program_info['design'],"0","1","L");

$pdf->SetFont('Arial','B',9);
$pdf->Cell(60,7,"COLOR","0","0","L");
$pdf->Cell(15,7," : ","0","0","L");
$pdf->SetFont('Arial','',9);
$pdf->Cell(70,7,"".$row_for_process_program_info['color'],"0","1","L");

$pdf->SetFont('Arial','B',9);
$pdf->Cell(60,7,"CONSTRUCTION","0","0","L");
$pdf->Cell(15,7," : ","0","0","L");
$pdf->SetFont('Arial','',9);
$pdf->Cell(70,7,"".$row_for_process_program_info['construction_name'],"0","1","L");

$pdf->SetFont('Arial','B',9);
$pdf->Cell(60,7,"VERSION","0","0","L");
$pdf->Cell(15,7," : ","0","0","L");
$pdf->SetFont('Arial','',9);
$pdf->Cell(70,7,"".$row_for_process_program_info['version_number'],"0","1","L");

$pdf->SetFont('Arial','B',9);
$pdf->Cell(60,7,"STYLE","0","0","L");
$pdf->Cell(15,7," : ","0","0","L");
$pdf->SetFont('Arial','',9);
$pdf->Cell(70,7,"".$row_for_process_program_info['style_name'],"0","1","L");


$pdf->SetFont('Arial','B',9);
$pdf->Cell(60,7,"WEEK","0","0","L");
$pdf->Cell(15,7," : ","0","0","L");
$pdf->SetFont('Arial','',9);
$pdf->Cell(70,7,"".$row_for_process_program_info['week_in_year'],"0","1","L");


$pdf->SetFont('Arial','B',9);
$pdf->Cell(60,7,"FIBER COMPOSITION","0","0","L");
$pdf->Cell(15,7," : ","0","0","L");
$pdf->SetFont('Arial','',9);
$pdf->Cell(70,7,"".$fiber,"0","1","L");

$pdf->SetFont('Arial','B',9);
$pdf->Cell(60,7,"PROCESS TECHNIQUE","0","0","L");
$pdf->Cell(15,7," : ","0","0","L");
$pdf->SetFont('Arial','',9);
$pdf->Cell(70,7,"".$row_for_process_program_info['process_technique_name'],"0","1","L");

$pdf->SetFont('Arial','B',9);
$pdf->Cell(60,7,"CARE INSTRUCTION","0","0","L");
$pdf->Cell(15,7," : ","0","0","L");
$pdf->SetFont('Arial','',9);
$pdf->Cell(70,7, $pdf->Image($washing,95, $pdf->GetY(), 8).$pdf->Image($bleaching,105, $pdf->GetY(), 6).$pdf->Image($ironing,115,125,7).$pdf->Image($dry_cleaning,125, $pdf->GetY(), 7).$pdf->Image($drying,135, $pdf->GetY(), 6),"0","1","L");

$counter = $counter + 77;

$pdf->SetFont('Arial','B',9);
$pdf->Ln(2);
$pdf->Cell(60,7,"SAMPLE PICTURE","0","0","L");
$pdf->Cell(15,7," : ","0","0","L");
$pdf->SetFont('Arial','',9);
$pdf->Cell(50,40,$pdf->Image('../img/'.$row_for_process_program_info['sample_picture'],100, $pdf->GetY(), 30),"0","1","L");
$pdf->AliasNbPages();

$counter = $counter + 42;

$pdf->Ln(80);
$pdf->SetFont('Times','B',6);
$pdf->Cell(80,6,"REPORTED BY :    ".$row_for_process_program_info['employee_name'],"0","0","L");
// $pdf->Cell(65,6,"CHECKED BY :     ".$row_for_qc['recording_person_name'],"0","0","C");
$pdf->Cell(95,6,"Verified By :    ".$pdf->Image('../img/'.$row_for_process_program_info['verified_signature'],155, $pdf->GetY(), 30),"0","1","C");
$pdf->SetFont('Arial','I',8);

$counter = $counter + 86;

$pdf->AddPage();

$pdf->Ln(0);
$pdf->setTopMargin(0);
$pdf->setLeftMargin(135);
$pdf->setTopMargin(10);
$pdf->SetFont('Arial','',8);

$pdf->Cell(60,-25,"Date of publish :  ".$currnet_date,0,0,'L');
$pdf->Ln(0);
$pdf->setLeftMargin(6);
$pdf->SetFont('Arial','',8);
$pdf->Code128(136,23,$trf_id,50,8);
$pdf->Ln(0);
$pdf->Cell(300,4,"Report No: ".$trf_id,"0","0","C");
$pdf->Ln(10);






$pdf->Cell(200,0,"","1","0","C");
$pdf->Ln(2);
$pdf->setLeftMargin(10);
$pdf->SetFont('Arial','B',12);
$pdf->Cell(100,5,"TEST CONCLUSION : ","0","1","L");
$pdf->SetFillColor(0,0,0); // input R, G, B
$pdf->Ln(1);
$pdf->SetFont('Times','B',10);
$pdf->Cell(65,5,"TEST NAME", "1", "0","C");
$pdf->Cell(65,5,"TEST METHOD", "1", "0","C");
$pdf->Cell(15,5,"PASS", "1", "0","C");
$pdf->Cell(15,5,"FAIL", "1", "0","C");
$pdf->Cell(30,5,"DATA", "1", "1","C");



// $pdf->Ln();
$pdf->SetFont('Times','',9);



//  $pdf->Ln(10);

// // $pdf->dataTable();

// $customer_name=$row_for_trf['customer_name'];
// $pp_number=$row_for_trf['pp_number'];
// $version_number=$row_for_trf['version_number'];
// $finish_width_in_inch=$row_for_trf['finish_width_in_inch'];
// $before_trolley_number_or_batcher_number=$row_for_trf['before_trolley_number_or_batcher_number'];
// $after_trolley_number_or_batcher_number=$row_for_trf['after_trolley_number_or_batcher_number'];



// $sql="SELECT distinct tnm.id,tmc.test_method_id,  IF(tmc.test_method_name <> 'Other',concat(tmc.test_name,'(',tmc.test_method_name,')'),tmc.test_name) test_name_method
// from test_name_and_method_for_all_process tnm 
// INNER JOIN transaction_test_name_and_method ttnm on tnm.id = ttnm.test_name_and_method_for_process_id
// INNER JOIN test_method_for_customer tmc on tmc.iso_or_aatcc = ttnm.iso_or_aatcc and tmc.test_id=ttnm.test_name_id and tmc.test_method_id=ttnm.test_method_id
// where tmc.customer_name = '$customer_name'";

$sql="SELECT DISTINCT tnmp.id, tmn.test_method_id, IF(tmn.test_method_name <> 'Other',concat(tmn.test_name,'(',tmn.test_method_name,')'),tmn.test_name) test_name_method
FROM test_name_and_method_for_all_process tnmp
INNER JOIN test_method_name tmn ON tnmp.id = tmn.test_name_and_method_for_process_id 
INNER JOIN transaction_test_name_and_method ttnm ON ttnm.test_name_and_method_for_process_id = tmn.test_name_and_method_for_process_id
INNER JOIN test_method_for_customer tmc ON tmc.test_id = ttnm.test_name_id AND tmc.test_method_id = tmn.test_method_id
WHERE tmc.customer_name = '$customer_name' ORDER BY ttnm.test_name_and_method_for_process_id ASC";
// // $pdf->Cell(100,4,$after_trolley_number_or_batcher_number."(Dry)" ,"1", "0","C");


$sql_for_customer = "SELECT customer_type from customer WHERE customer_id = '$customer_id' AND customer_name = '$customer_name'";
	$result_for_customer = mysqli_query($con, $sql_for_customer) or die(mysqli_error($con));
	$row_for_customer = mysqli_fetch_assoc($result_for_customer);
	
	 $customer_type =  $row_for_customer['customer_type'];

$total_test=0;
$p=0;
$f=0;

$data="";
$data_for_test_method_id="";
$test_name_method="";
$result= mysqli_query($con,$sql) or die(mysqli_error($con));
				 while( $row = mysqli_fetch_array( $result))
				 {

                    if (in_array($row['id'], ['1']))
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
                                
                                $pdf->Cell(65,5,$test_name, "1", "0","L");
                                $pdf->Cell(65,5,'('.$test_method_name, "1", "0","L");
                                $pdf->Cell(15,5,"X", "1", "0","C");
                                $pdf->Cell(15,5,"", "1", "0","C");
                                $pdf->Cell(30,5,"", "1", "1","L");
                                
                            }
                            else 
                            {
                                $f++;
 
                                $pdf->Cell(65,5,$test_name, "1", "0","L");
                                $pdf->Cell(65,5,'('.$test_method_name, "1", "0","L");
                                $pdf->Cell(15,5,"", "1", "0","C");
                                $pdf->Cell(15,5,"X", "1", "0","C");
                                $pdf->Cell(30,5,"", "1", "1","L");
                            }
                        } 
						 
					}      /* End of if (in_array($row['id'], ['1','240','105','164','207','247','259','298']))*/


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
  
                                $pdf->Cell(65,5,$test_name, "1", "0","L");
                                $pdf->Cell(65,5,'('.$test_method_name, "1", "0","L");
                                $pdf->Cell(15,5,"X", "1", "0","C");
                                $pdf->Cell(15,5,"", "1", "0","C");
                                $pdf->Cell(30,5,"", "1", "1","L");
                            }
                            else 
                            {
                                $f++;
 
                                $pdf->Cell(65,5,$test_name, "1", "0","L");
                                $pdf->Cell(65,5,'('.$test_method_name, "1", "0","L");
                                $pdf->Cell(15,5,"X", "1", "0","C");
                                $pdf->Cell(15,5,"", "1", "0","C");
                                $pdf->Cell(30,5,"", "1", "1","L");
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
 
                                $pdf->Cell(65,5,$test_name, "1", "0","L");
                                $pdf->Cell(65,5,'('.$test_method_name, "1", "0","L");
                                $pdf->Cell(15,5,"X", "1", "0","C");
                                $pdf->Cell(15,5,"", "1", "0","C");
                                $pdf->Cell(30,5,"", "1", "1","L");
                            }
                            else 
                            {
                                $f++;
  
                                $pdf->Cell(65,5,$test_name, "1", "0","L");
                                $pdf->Cell(65,5,'('.$test_method_name, "1", "0","L");
                                $pdf->Cell(15,5,"", "1", "0","C");
                                $pdf->Cell(15,5,"X", "1", "0","C");
                                $pdf->Cell(30,5,"", "1", "1","L");
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
  
                                $pdf->Cell(65,5,$test_name, "1", "0","L");
                                $pdf->Cell(65,5,'('.$test_method_name, "1", "0","L");
                                $pdf->Cell(15,5,"X", "1", "0","C");
                                $pdf->Cell(15,5,"", "1", "0","C");
                                $pdf->Cell(30,5,"", "1", "1","L");
                            }
                            else 
                            {
                                $f++;
  
                                $pdf->Cell(65,5,$test_name, "1", "0","L");
                                $pdf->Cell(65,5,'('.$test_method_name, "1", "0","L");
                                $pdf->Cell(15,5,"", "1", "0","C");
                                $pdf->Cell(15,5,"X", "1", "0","C");
                                $pdf->Cell(30,5,"", "1", "1","L");
                            }
                        }
                    }

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
                                $pdf->Cell(65,5,$test_name, "1", "0","L");
                                $pdf->Cell(65,5,'('.$test_method_name, "1", "0","L");
                                $pdf->Cell(15,5,"X", "1", "0","C");
                                $pdf->Cell(15,5,"", "1", "0","C");
                                $pdf->Cell(30,5,"", "1", "1","L");
                            }
                            else 
                            {
                                $f++;
                                
                                $pdf->Cell(65,5,$test_name, "1", "0","L");
                                $pdf->Cell(65,5,'('.$test_method_name, "1", "0","L");
                                $pdf->Cell(15,5,"", "1", "0","C");
                                $pdf->Cell(15,5,"X", "1", "0","C");
                                $pdf->Cell(30,5,"", "1", "1","L");
                            }
                        }

                      
					}

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
                                $pdf->Cell(65,5,$test_name, "1", "0","L");
                                $pdf->Cell(65,5,'('.$test_method_name, "1", "0","L");
                                $pdf->Cell(15,5,"X", "1", "0","C");
                                $pdf->Cell(15,5,"", "1", "0","C");
                                $pdf->Cell(30,5,"", "1", "1","L");
                            }
                            else 
                            {
                                $f++;
                                
                                $pdf->Cell(65,5,$test_name, "1", "0","L");
                                $pdf->Cell(65,5,'('.$test_method_name, "1", "0","L");
                                $pdf->Cell(15,5,"", "1", "0","C");
                                $pdf->Cell(15,5,"X", "1", "0","C");
                                $pdf->Cell(30,5,"", "1", "1","L");
                            }
                        }
                   }

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
                            
                            $pdf->Cell(65,5,$test_name, "1", "0","L");
                                $pdf->Cell(65,5,'('.$test_method_name, "1", "0","L");
                                $pdf->Cell(15,5,"X", "1", "0","C");
                                $pdf->Cell(15,5,"", "1", "0","C");
                                $pdf->Cell(30,5,"", "1", "1","L");
                        }
                        else 
                        {
                            $f++;
                            
                            $pdf->Cell(65,5,$test_name, "1", "0","L");
                                $pdf->Cell(65,5,'('.$test_method_name, "1", "0","L");
                                $pdf->Cell(15,5,"", "1", "0","C");
                                $pdf->Cell(15,5,"X", "1", "0","C");
                                $pdf->Cell(30,5,"", "1", "1","L");
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
                            $pdf->Cell(65,5,$test_name, "1", "0","L");
                            $pdf->Cell(65,5,'('.$test_method_name, "1", "0","L");
                            $pdf->Cell(15,5,"X", "1", "0","C");
                            $pdf->Cell(15,5,"", "1", "0","C");
                            $pdf->Cell(30,5,"", "1", "1","L");
                        }
                        else 
                        {
                            $f++;
                            
                                $pdf->Cell(65,5,$test_name, "1", "0","L");
                                $pdf->Cell(65,5,'('.$test_method_name, "1", "0","L");
                                $pdf->Cell(15,5,"", "1", "0","C");
                                $pdf->Cell(15,5,"X", "1", "0","C");
                                $pdf->Cell(30,5,"", "1", "1","L");
                        }
                    }
                    }        /*End of if (in_array($row['id'], ['7', '115', '263', '274', '302']))*/
                   

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

                                $pdf->Cell(65,5,$test_name, "1", "0","L");
                                $pdf->Cell(65,5,'('.$test_method_name, "1", "0","L");
                                $pdf->Cell(15,5,"X", "1", "0","C");
                                $pdf->Cell(15,5,"", "1", "0","C");
                                $pdf->Cell(30,5,"", "1", "1","L");
                            }
                            else 
                            {
                                $f++;
                                
                                $pdf->Cell(65,5,$test_name, "1", "0","L");
                                $pdf->Cell(65,5,'('.$test_method_name, "1", "0","L");
                                $pdf->Cell(15,5,"", "1", "0","C");
                                $pdf->Cell(15,5,"X", "1", "0","C");
                                $pdf->Cell(30,5,"", "1", "1","L");
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
                                                        $pdf->Cell(65,5,$test_name, "1", "0","L");
                                                        $pdf->Cell(65,5,'('.$test_method_name, "1", "0","L");
                                                        $pdf->Cell(15,5,"X", "1", "0","C");
                                                        $pdf->Cell(15,5,"", "1", "0","C");
                                                        $pdf->Cell(30,5,"", "1", "1","L");
                                                    }
                                                    else 
                                                    {
                                                        $f++;
                                                        
                                                        $pdf->Cell(65,5,$test_name, "1", "0","L");
                                                        $pdf->Cell(65,5,'('.$test_method_name, "1", "0","L");
                                                        $pdf->Cell(15,5,"", "1", "0","C");
                                                        $pdf->Cell(15,5,"X", "1", "0","C");
                                                        $pdf->Cell(30,5,"", "1", "1","L");
                                                    }
                                                }
					 }   /*End of if (in_array($row['id'], ['9', '186', '230']))*/

					//  if (in_array($row['id'], ['9']))
					//  {
						
					// 	if ($row_for_defining_process['seam_slippage_resistance_iso_2_in_warp_max_value']<>0 && $row_for_qc['seam_slippage_resistance_iso_2_in_warp_value']<>0) 
					// 	{
                         
                    //      $total_test++;
					// 		if($row_for_defining_process['seam_slippage_resistance_iso_2_in_warp_min_value']<=$row_for_qc['seam_slippage_resistance_iso_2_in_warp_value'] && $row_for_defining_process['seam_slippage_resistance_iso_2_in_warp_max_value']>=$row_for_qc['seam_slippage_resistance_iso_2_in_warp_value'])
					// 		{
					// 			$p++;
					// 			$pdf->Cell(100,5,$row['test_name_method'].' (Warp)',"1", "0","L");
                    //             $pdf->Cell(35,5,$row_for_qc['seam_slippage_resistance_iso_2_in_warp_value'].' ' .$row_for_defining_process['uom_of_seam_slippage_resistance_iso_2_in_warp'], "1", "0","L");
                    //             $pdf->Cell(35,5,$row_for_defining_process['seam_slippage_resistance_iso_2_in_warp_tolerance_range_math_operator'].' '.$row_for_defining_process['seam_slippage_resistance_iiso_2_n_warp_tolerance_value'].' '.$row_for_defining_process['uom_of_seam_slippage_resistance_iso_2_in_warp'], "1", "0","L");
                    //             $pdf->Cell(20,5,"Pass", "1", "0","C");
                    //             $pdf->SetTextColor(0,0,0);
                    //             $pdf->Ln();
					// 		}
					// 		else 
					// 		{
					// 			$f++;
                    //             $pdf->SetTextColor(194,8,8);
                    //             $pdf->Cell(100,5,$row['test_name_method'].' (Warp)',"1", "0","L");
                    //             $pdf->Cell(35,5,$row_for_qc['seam_slippage_resistance_iso_2_in_warp_value'].' ' .$row_for_defining_process['uom_of_seam_slippage_resistance_iso_2_in_warp'], "1", "0","L");
                    //             $pdf->Cell(35,5,$row_for_defining_process['seam_slippage_resistance_iso_2_in_warp_tolerance_range_math_operator'].' '.$row_for_defining_process['seam_slippage_resistance_iiso_2_n_warp_tolerance_value'].' '.$row_for_defining_process['uom_of_seam_slippage_resistance_iso_2_in_warp'], "1", "0","L");
                    //             $pdf->Cell(20,5,"Fail", "1", "0","C");
                    //             $pdf->SetTextColor(0,0,0);
                    //             $pdf->Ln();
								
					// 		}
					// 	}

					// 	if ($row_for_defining_process['seam_slippage_resistance_iso_2_in_weft_max_value']<>0 && $row_for_qc['seam_slippage_resistance_iso_2_in_weft_value']<>0) 
					// 	{
                         
                    //     	$total_test++;
					// 		if($row_for_defining_process['seam_slippage_resistance_iso_2_in_weft_min_value']<=$row_for_qc['seam_slippage_resistance_iso_2_in_weft_value'] && $row_for_defining_process['seam_slippage_resistance_iso_2_in_weft_max_value']>=$row_for_qc['seam_slippage_resistance_iso_2_in_weft_value'])
					// 		{
					// 			$p++;
                    //             $pdf->Cell(100,5,$row['test_name_method'].' (Weft)',"1", "0","L");
                    //             $pdf->Cell(35,5,$row_for_qc['seam_slippage_resistance_iso_2_in_weft_value'].' ' .$row_for_defining_process['uom_of_seam_slippage_resistance_iso_2_in_weft'], "1", "0","L");
                    //             $pdf->Cell(35,5,$row_for_defining_process['seam_slippage_resistance_iso_2_in_weft_tolerance_range_math_operator'].' '.$row_for_defining_process['seam_slippage_resistance_iso_2_in_weft_tolerance_value'].' '.$row_for_defining_process['uom_of_seam_slippage_resistance_iso_2_in_weft'], "1", "0","L");
                    //             $pdf->Cell(20,5,"Pass", "1", "0","C");
                    //             $pdf->SetTextColor(0,0,0);
                    //             $pdf->Ln();
					// 		}
					// 		else 
					// 		{
					// 			$f++;
                    //             $pdf->SetTextColor(194,8,8);
                    //             $pdf->Cell(100,5,$row['test_name_method'].' (Weft)',"1", "0","L");
                    //             $pdf->Cell(35,5,$row_for_qc['seam_slippage_resistance_iso_2_in_weft_value'].' ' .$row_for_defining_process['uom_of_seam_slippage_resistance_iso_2_in_weft'], "1", "0","L");
                    //             $pdf->Cell(35,5,$row_for_defining_process['seam_slippage_resistance_iso_2_in_weft_tolerance_range_math_operator'].' '.$row_for_defining_process['seam_slippage_resistance_iso_2_in_weft_tolerance_value'].' '.$row_for_defining_process['uom_of_seam_slippage_resistance_iso_2_in_weft'], "1", "0","L");
                    //             $pdf->Cell(20,5,"Fail", "1", "0","C");
                    //             $pdf->SetTextColor(0,0,0);
                    //             $pdf->Ln();
								
					// 		}
					// 	}
					//  }   /*End of if (in_array($row['id'], ['9', '186', '230']))*/

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
                                                        $pdf->Cell(65,5,$test_name, "1", "0","L");
                                                        $pdf->Cell(65,5,'('.$test_method_name, "1", "0","L");
                                                        $pdf->Cell(15,5,"X", "1", "0","C");
                                                        $pdf->Cell(15,5,"", "1", "0","C");
                                                        $pdf->Cell(30,5,"", "1", "1","L");
                            }
                            else 
                            {
                                $f++;
                                
                                $pdf->Cell(65,5,$test_name, "1", "0","L");
                                $pdf->Cell(65,5,'('.$test_method_name, "1", "0","L");
                                $pdf->Cell(15,5,"", "1", "0","C");
                                $pdf->Cell(15,5,"X", "1", "0","C");
                                $pdf->Cell(30,5,"", "1", "1","L");
                            }
                        }
					 } /* End of  if (in_array($row['id'], ['11', '149', '187', '244', '304']))*/

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
                                                        $pdf->Cell(65,5,$test_name, "1", "0","L");
                                                        $pdf->Cell(65,5,'('.$test_method_name, "1", "0","L");
                                                        $pdf->Cell(15,5,"X", "1", "0","C");
                                                        $pdf->Cell(15,5,"", "1", "0","C");
                                                        $pdf->Cell(30,5,"", "1", "1","L");
                            }
                            else 
                            {
                                $f++;
                                
                                $pdf->Cell(65,5,$test_name, "1", "0","L");
                                $pdf->Cell(65,5,'('.$test_method_name, "1", "0","L");
                                $pdf->Cell(15,5,"", "1", "0","C");
                                $pdf->Cell(15,5,"X", "1", "0","C");
                                $pdf->Cell(30,5,"", "1", "1","L");
                            }
                        }
					}

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
                                $pdf->Cell(65,5,$test_name, "1", "0","L");
                                                        $pdf->Cell(65,5,'('.$test_method_name, "1", "0","L");
                                                        $pdf->Cell(15,5,"X", "1", "0","C");
                                                        $pdf->Cell(15,5,"", "1", "0","C");
                                                        $pdf->Cell(30,5,"", "1", "1","L");
                            }
                            else 
                            {
                                $f++;
                                
                                $pdf->Cell(65,5,$test_name, "1", "0","L");
                                $pdf->Cell(65,5,'('.$test_method_name, "1", "0","L");
                                $pdf->Cell(15,5,"", "1", "0","C");
                                $pdf->Cell(15,5,"X", "1", "0","C");
                                $pdf->Cell(30,5,"", "1", "1","L");
                            }
                        }
													
					}

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
                                                        $pdf->Cell(65,5,$test_name, "1", "0","L");
                                                        $pdf->Cell(65,5,'('.$test_method_name, "1", "0","L");
                                                        $pdf->Cell(15,5,"X", "1", "0","C");
                                                        $pdf->Cell(15,5,"", "1", "0","C");
                                                        $pdf->Cell(30,5,"", "1", "1","L");
                                                    }
                                                    else 
                                                    {
                                                        $f++;
                                                        
                                                        $pdf->Cell(65,5,$test_name, "1", "0","L");
                                                        $pdf->Cell(65,5,'('.$test_method_name, "1", "0","L");
                                                        $pdf->Cell(15,5,"", "1", "0","C");
                                                        $pdf->Cell(15,5,"X", "1", "0","C");
                                                        $pdf->Cell(30,5,"", "1", "1","L");
                                                    }
                                                }				
													
					} 

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
                                $pdf->Cell(65,5,$test_name, "1", "0","L");
                                $pdf->Cell(65,5,'('.$test_method_name, "1", "0","L");
                                $pdf->Cell(15,5,"X", "1", "0","C");
                                $pdf->Cell(15,5,"", "1", "0","C");
                                $pdf->Cell(30,5,"", "1", "1","L");
                            }
                            else 
                            {
                                $f++;
                                
                                $pdf->Cell(65,5,$test_name, "1", "0","L");
                                $pdf->Cell(65,5,'('.$test_method_name, "1", "0","L");
                                $pdf->Cell(15,5,"", "1", "0","C");
                                $pdf->Cell(15,5,"X", "1", "0","C");
                                $pdf->Cell(30,5,"", "1", "1","L");
                            }
                        }

													
					}

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
                                                                $pdf->Cell(65,5,$test_name, "1", "0","L");
                                                                $pdf->Cell(65,5,'('.$test_method_name, "1", "0","L");
                                                                $pdf->Cell(15,5,"X", "1", "0","C");
                                                                $pdf->Cell(15,5,"", "1", "0","C");
                                                                $pdf->Cell(30,5,"", "1", "1","L");

                                                    }
                                                    else 
                                                    {
                                                        $f++;
                                                        
                                                        $pdf->Cell(65,5,$test_name, "1", "0","L");
                                                        $pdf->Cell(65,5,'('.$test_method_name, "1", "0","L");
                                                        $pdf->Cell(15,5,"", "1", "0","C");
                                                        $pdf->Cell(15,5,"X", "1", "0","C");
                                                        $pdf->Cell(30,5,"", "1", "1","L");
                                                    }
                                                }

					}
                    /*  Iftekhar  After test*/
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
                                $pdf->Cell(65,5,$test_name, "1", "0","L");
                                                                $pdf->Cell(65,5,'('.$test_method_name, "1", "0","L");
                                                                $pdf->Cell(15,5,"X", "1", "0","C");
                                                                $pdf->Cell(15,5,"", "1", "0","C");
                                                                $pdf->Cell(30,5,"", "1", "1","L");
                            }
                            else 
                            {
                                $f++;
                                
                                $pdf->Cell(65,5,$test_name, "1", "0","L");
                                                        $pdf->Cell(65,5,'('.$test_method_name, "1", "0","L");
                                                        $pdf->Cell(15,5,"", "1", "0","C");
                                                        $pdf->Cell(15,5,"X", "1", "0","C");
                                                        $pdf->Cell(30,5,"", "1", "1","L");
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
                                $pdf->Cell(65,5,$test_name, "1", "0","L");
                                $pdf->Cell(65,5,'('.$test_method_name, "1", "0","L");
                                $pdf->Cell(15,5,"X", "1", "0","C");
                                $pdf->Cell(15,5,"", "1", "0","C");
                                $pdf->Cell(30,5,"", "1", "1","L");
                            }
                            else 
                            {
                                $f++;
                                
                                                        $pdf->Cell(65,5,$test_name, "1", "0","L");
                                                        $pdf->Cell(65,5,'('.$test_method_name, "1", "0","L");
                                                        $pdf->Cell(15,5,"", "1", "0","C");
                                                        $pdf->Cell(15,5,"X", "1", "0","C");
                                                        $pdf->Cell(30,5,"", "1", "1","L");
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
                                $pdf->Cell(65,5,$test_name, "1", "0","L");
                                $pdf->Cell(65,5,'('.$test_method_name, "1", "0","L");
                                $pdf->Cell(15,5,"X", "1", "0","C");
                                $pdf->Cell(15,5,"", "1", "0","C");
                                $pdf->Cell(30,5,"", "1", "1","L");
                            }
                            else 
                            {
                                $f++;
                                
                                $pdf->Cell(65,5,$test_name, "1", "0","L");
                                                        $pdf->Cell(65,5,'('.$test_method_name, "1", "0","L");
                                                        $pdf->Cell(15,5,"", "1", "0","C");
                                                        $pdf->Cell(15,5,"X", "1", "0","C");
                                                        $pdf->Cell(30,5,"", "1", "1","L");
                            }
                        }

                    } /*End of  if (in_array($row['id'], ['19', '121', '141', '167', '228']))*/


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
                                $pdf->Cell(65,5,$test_name, "1", "0","L");
                                $pdf->Cell(65,5,'('.$test_method_name, "1", "0","L");
                                $pdf->Cell(15,5,"X", "1", "0","C");
                                $pdf->Cell(15,5,"", "1", "0","C");
                                $pdf->Cell(30,5,"", "1", "1","L");
                            }
                            else 
                            {
                                $f++;
                                
                               
                                $pdf->Cell(65,5,$test_name, "1", "0","L");
                                                        $pdf->Cell(65,5,'('.$test_method_name, "1", "0","L");
                                                        $pdf->Cell(15,5,"", "1", "0","C");
                                                        $pdf->Cell(15,5,"X", "1", "0","C");
                                                        $pdf->Cell(30,5,"", "1", "1","L");
                            }
                        }

					 } /* End of if (in_array($row['id'], ['20', '65', '196']))*/
                     
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
                                $pdf->Cell(65,5,$test_name, "1", "0","L");
                                $pdf->Cell(65,5,'('.$test_method_name, "1", "0","L");
                                $pdf->Cell(15,5,"X", "1", "0","C");
                                $pdf->Cell(15,5,"", "1", "0","C");
                                $pdf->Cell(30,5,"", "1", "1","L");
                            }
                            else 
                            {
                                $f++;
                                
                                $pdf->Cell(65,5,$test_name, "1", "0","L");
                                                        $pdf->Cell(65,5,'('.$test_method_name, "1", "0","L");
                                                        $pdf->Cell(15,5,"", "1", "0","C");
                                                        $pdf->Cell(15,5,"X", "1", "0","C");
                                                        $pdf->Cell(30,5,"", "1", "1","L");
                            }
                        }
					 } /*End of if (in_array($row['id'], ['21', '206', '22', '66']))*/


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
                                $pdf->Cell(65,5,$test_name, "1", "0","L");
                                $pdf->Cell(65,5,'('.$test_method_name, "1", "0","L");
                                $pdf->Cell(15,5,"X", "1", "0","C");
                                $pdf->Cell(15,5,"", "1", "0","C");
                                $pdf->Cell(30,5,"", "1", "1","L");
                            }
                            else 
                            {
                                $f++;
                                
                                $pdf->Cell(65,5,$test_name, "1", "0","L");
                                                        $pdf->Cell(65,5,'('.$test_method_name, "1", "0","L");
                                                        $pdf->Cell(15,5,"", "1", "0","C");
                                                        $pdf->Cell(15,5,"X", "1", "0","C");
                                                        $pdf->Cell(30,5,"", "1", "1","L");
                            }
                        }



					 } /* End of if (in_array($row['id'], ['23', '67']))*/
					  
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
                                                        $pdf->Cell(65,5,$test_name, "1", "0","L");
                                                        $pdf->Cell(65,5,'('.$test_method_name, "1", "0","L");
                                                        $pdf->Cell(15,5,"X", "1", "0","C");
                                                        $pdf->Cell(15,5,"", "1", "0","C");
                                                        $pdf->Cell(30,5,"", "1", "1","L");
                                                    }
                                                    else 
                                                    {
                                                        $f++;
                                                        
                                                        $pdf->Cell(65,5,$test_name, "1", "0","L");
                                                        $pdf->Cell(65,5,'('.$test_method_name, "1", "0","L");
                                                        $pdf->Cell(15,5,"", "1", "0","C");
                                                        $pdf->Cell(15,5,"X", "1", "0","C");
                                                        $pdf->Cell(30,5,"", "1", "1","L");
                                                    }
                                                }


					 }   /*End of if (in_array($row['id'], ['24', '68']))*/



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
                                $pdf->Cell(65,5,$test_name, "1", "0","L");
                                                        $pdf->Cell(65,5,'('.$test_method_name, "1", "0","L");
                                                        $pdf->Cell(15,5,"X", "1", "0","C");
                                                        $pdf->Cell(15,5,"", "1", "0","C");
                                                        $pdf->Cell(30,5,"", "1", "1","L");
                            }
                            else 
                            {
                                $f++;
                                
                                $pdf->Cell(65,5,$test_name, "1", "0","L");
                                                        $pdf->Cell(65,5,'('.$test_method_name, "1", "0","L");
                                                        $pdf->Cell(15,5,"", "1", "0","C");
                                                        $pdf->Cell(15,5,"X", "1", "0","C");
                                                        $pdf->Cell(30,5,"", "1", "1","L");
                            }
                        }

					 }  /*End of if (in_array($row['id'], ['25', '158', '69']))*/

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
                                 $pdf->Cell(65,5,$test_name, "1", "0","L");
                                 $pdf->Cell(65,5,'('.$test_method_name, "1", "0","L");
                                 $pdf->Cell(15,5,"X", "1", "0","C");
                                 $pdf->Cell(15,5,"", "1", "0","C");
                                 $pdf->Cell(30,5,"", "1", "1","L");
                             }
                             else 
                             {
                                 $f++;
                                 
                                 $pdf->Cell(65,5,$test_name, "1", "0","L");
                                 $pdf->Cell(65,5,'('.$test_method_name, "1", "0","L");
                                 $pdf->Cell(15,5,"", "1", "0","C");
                                 $pdf->Cell(15,5,"X", "1", "0","C");
                                 $pdf->Cell(30,5,"", "1", "1","L");
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
                                        $pdf->Cell(65,5,$test_name, "1", "0","L");
                                        $pdf->Cell(65,5,'('.$test_method_name, "1", "0","L");
                                        $pdf->Cell(15,5,"X", "1", "0","C");
                                        $pdf->Cell(15,5,"", "1", "0","C");
                                        $pdf->Cell(30,5,"", "1", "1","L");
                                    }
                                    else 
                                    {
                                        $f++;
                                        
                                        $pdf->Cell(65,5,$test_name, "1", "0","L");
                                        $pdf->Cell(65,5,'('.$test_method_name, "1", "0","L");
                                        $pdf->Cell(15,5,"", "1", "0","C");
                                        $pdf->Cell(15,5,"X", "1", "0","C");
                                        $pdf->Cell(30,5,"", "1", "1","L");
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
                                 $pdf->Cell(65,5,$test_name, "1", "0","L");
                                $pdf->Cell(65,5,'('.$test_method_name, "1", "0","L");
                                $pdf->Cell(15,5,"X", "1", "0","C");
                                $pdf->Cell(15,5,"", "1", "0","C");
                                $pdf->Cell(30,5,"", "1", "1","L");
                             }
                             else 
                             {
                                 $f++;
                                 
                                 $pdf->Cell(65,5,$test_name, "1", "0","L");
                                 $pdf->Cell(65,5,'('.$test_method_name, "1", "0","L");
                                 $pdf->Cell(15,5,"", "1", "0","C");
                                 $pdf->Cell(15,5,"X", "1", "0","C");
                                 $pdf->Cell(30,5,"", "1", "1","L");
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
                                 $pdf->Cell(65,5,$test_name, "1", "0","L");
                                 $pdf->Cell(65,5,'('.$test_method_name, "1", "0","L");
                                 $pdf->Cell(15,5,"X", "1", "0","C");
                                 $pdf->Cell(15,5,"", "1", "0","C");
                                 $pdf->Cell(30,5,"", "1", "1","L");
                             }
                             else 
                             {
                                 $f++;
                                 
                                 $pdf->Cell(65,5,$test_name, "1", "0","L");
                                 $pdf->Cell(65,5,'('.$test_method_name, "1", "0","L");
                                 $pdf->Cell(15,5,"", "1", "0","C");
                                 $pdf->Cell(15,5,"X", "1", "0","C");
                                 $pdf->Cell(30,5,"", "1", "1","L");
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
                                 $pdf->Cell(65,5,$test_name, "1", "0","L");
                                $pdf->Cell(65,5,'('.$test_method_name, "1", "0","L");
                                $pdf->Cell(15,5,"X", "1", "0","C");
                                $pdf->Cell(15,5,"", "1", "0","C");
                                $pdf->Cell(30,5,"", "1", "1","L");
                             }
                             else 
                             {
                                 $f++;
                                 
                                 $pdf->Cell(65,5,$test_name, "1", "0","L");
                                 $pdf->Cell(65,5,'('.$test_method_name, "1", "0","L");
                                 $pdf->Cell(15,5,"", "1", "0","C");
                                 $pdf->Cell(15,5,"X", "1", "0","C");
                                 $pdf->Cell(30,5,"", "1", "1","L");
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
                                 $pdf->Cell(65,5,$test_name, "1", "0","L");
                                 $pdf->Cell(65,5,'('.$test_method_name, "1", "0","L");
                                 $pdf->Cell(15,5,"X", "1", "0","C");
                                 $pdf->Cell(15,5,"", "1", "0","C");
                                 $pdf->Cell(30,5,"", "1", "1","L");
                             }
                             else 
                             {
                                 $f++;
                                 
                                 $pdf->Cell(65,5,$test_name, "1", "0","L");
                                 $pdf->Cell(65,5,'('.$test_method_name, "1", "0","L");
                                 $pdf->Cell(15,5,"", "1", "0","C");
                                 $pdf->Cell(15,5,"X", "1", "0","C");
                                 $pdf->Cell(30,5,"", "1", "1","L");
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
                                 $pdf->Cell(65,5,$test_name, "1", "0","L");
                                $pdf->Cell(65,5,'('.$test_method_name, "1", "0","L");
                                $pdf->Cell(15,5,"X", "1", "0","C");
                                $pdf->Cell(15,5,"", "1", "0","C");
                                $pdf->Cell(30,5,"", "1", "1","L");
                             }
                             else 
                             {
                                 $f++;
                                 
                                 $pdf->Cell(65,5,$test_name, "1", "0","L");
                                 $pdf->Cell(65,5,'('.$test_method_name, "1", "0","L");
                                 $pdf->Cell(15,5,"", "1", "0","C");
                                 $pdf->Cell(15,5,"X", "1", "0","C");
                                 $pdf->Cell(30,5,"", "1", "1","L");
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
                                 $pdf->Cell(65,5,$test_name, "1", "0","L");
                                 $pdf->Cell(65,5,'('.$test_method_name, "1", "0","L");
                                 $pdf->Cell(15,5,"X", "1", "0","C");
                                 $pdf->Cell(15,5,"", "1", "0","C");
                                 $pdf->Cell(30,5,"", "1", "1","L");
                             }
                             else 
                             {
                                 $f++;
                                 $pdf->Cell(65,5,$test_name, "1", "0","L");
                                 $pdf->Cell(65,5,'('.$test_method_name, "1", "0","L");
                                 $pdf->Cell(15,5,"", "1", "0","C");
                                 $pdf->Cell(15,5,"X", "1", "0","C");
                                 $pdf->Cell(30,5,"", "1", "1","L");
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
                                 $pdf->Cell(65,5,$test_name, "1", "0","L");
                                $pdf->Cell(65,5,'('.$test_method_name, "1", "0","L");
                                $pdf->Cell(15,5,"X", "1", "0","C");
                                $pdf->Cell(15,5,"", "1", "0","C");
                                $pdf->Cell(30,5,"", "1", "1","L");
                             }
                             else 
                             {
                                 $f++;
                                 
                                 $pdf->Cell(65,5,$test_name, "1", "0","L");
                                 $pdf->Cell(65,5,'('.$test_method_name, "1", "0","L");
                                 $pdf->Cell(15,5,"", "1", "0","C");
                                 $pdf->Cell(15,5,"X", "1", "0","C");
                                 $pdf->Cell(30,5,"", "1", "1","L");
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
                                 $pdf->Cell(65,5,$test_name, "1", "0","L");
                                 $pdf->Cell(65,5,'('.$test_method_name, "1", "0","L");
                                 $pdf->Cell(15,5,"X", "1", "0","C");
                                 $pdf->Cell(15,5,"", "1", "0","C");
                                 $pdf->Cell(30,5,"", "1", "1","L");
                             }
                             else 
                             {
                                 $f++;
                                 
                                 $pdf->Cell(65,5,$test_name, "1", "0","L");
                                 $pdf->Cell(65,5,'('.$test_method_name, "1", "0","L");
                                 $pdf->Cell(15,5,"", "1", "0","C");
                                 $pdf->Cell(15,5,"X", "1", "0","C");
                                 $pdf->Cell(30,5,"", "1", "1","L");
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
                                 $pdf->Cell(65,5,$test_name, "1", "0","L");
                                 $pdf->Cell(65,5,'('.$test_method_name, "1", "0","L");
                                 $pdf->Cell(15,5,"X", "1", "0","C");
                                 $pdf->Cell(15,5,"", "1", "0","C");
                                 $pdf->Cell(30,5,"", "1", "1","L");
                             }
                             else 
                             {
                                 $f++;
                                 
                                 $pdf->Cell(65,5,$test_name, "1", "0","L");
                                 $pdf->Cell(65,5,'('.$test_method_name, "1", "0","L");
                                 $pdf->Cell(15,5,"", "1", "0","C");
                                 $pdf->Cell(15,5,"X", "1", "0","C");
                                 $pdf->Cell(30,5,"", "1", "1","L");
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
                                 $pdf->Cell(65,5,$test_name, "1", "0","L");
                                 $pdf->Cell(65,5,'('.$test_method_name, "1", "0","L");
                                 $pdf->Cell(15,5,"X", "1", "0","C");
                                 $pdf->Cell(15,5,"", "1", "0","C");
                                 $pdf->Cell(30,5,"", "1", "1","L");
                             }
                             else 
                             {
                                 $f++;
                                 
                                 $pdf->Cell(65,5,$test_name, "1", "0","L");
                                 $pdf->Cell(65,5,'('.$test_method_name, "1", "0","L");
                                 $pdf->Cell(15,5,"", "1", "0","C");
                                 $pdf->Cell(15,5,"X", "1", "0","C");
                                 $pdf->Cell(30,5,"", "1", "1","L");
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

                                     $pdf->Cell(65,5,$test_name, "1", "0","L");
                                     $pdf->Cell(65,5,'('.$test_method_name, "1", "0","L");
                                     $pdf->Cell(15,5,"", "1", "0","C");
                                     $pdf->Cell(15,5,"", "1", "0","C");
                                     $pdf->Cell(30,5,"", "1", "1","L");
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
                                 $pdf->Cell(65,5,$test_name, "1", "0","L");
                                 $pdf->Cell(65,5,'('.$test_method_name, "1", "0","L");
                                 $pdf->Cell(15,5,"X", "1", "0","C");
                                 $pdf->Cell(15,5,"", "1", "0","C");
                                 $pdf->Cell(30,5,"", "1", "1","L");
                             }
                             else 
                             {
                                 $f++;
                                 
                                 $pdf->Cell(65,5,$test_name, "1", "0","L");
                                 $pdf->Cell(65,5,'('.$test_method_name, "1", "0","L");
                                 $pdf->Cell(15,5,"", "1", "0","C");
                                 $pdf->Cell(15,5,"X", "1", "0","C");
                                 $pdf->Cell(30,5,"", "1", "1","L");
                             }
                         }
                     }  /* End of if (in_array($row['id'], ['39']))*/

                     if (in_array($row['id'], ['40']))
                     {
                         
                         if($row_for_defining_process['color_fastess_to_artificial_daylight_max_value']<>0 and $row_for_qc['cf_to_artificial_day_light_value']<>0)
                         {   
                             $total_test++;
 
                             $split=explode('(', $row['test_name_method']);
                                     $test_name=$split[0];
                                     $test_method_name=$split[1];
 
                                     if($row_for_defining_process['color_fastess_to_artificial_daylight_min_value']<=$row_for_qc['cf_to_artificial_day_light_value'] && $row_for_defining_process['color_fastess_to_artificial_daylight_max_value']>=$row_for_qc['cf_to_artificial_day_light_value'])
                                     {
                                 $p++;
                                 $pdf->Cell(65,5,$test_name, "1", "0","L");
                                $pdf->Cell(65,5,'('.$test_method_name, "1", "0","L");
                                $pdf->Cell(15,5,"X", "1", "0","C");
                                $pdf->Cell(15,5,"", "1", "0","C");
                                $pdf->Cell(30,5,"", "1", "1","L");
                             }
                             else 
                             {
                                 $f++;
                                 
                                 $pdf->Cell(65,5,$test_name, "1", "0","L");
                                 $pdf->Cell(65,5,'('.$test_method_name, "1", "0","L");
                                 $pdf->Cell(15,5,"", "1", "0","C");
                                 $pdf->Cell(15,5,"X", "1", "0","C");
                                 $pdf->Cell(30,5,"", "1", "1","L");
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
                                 $pdf->Cell(65,5,$test_name, "1", "0","L");
                                $pdf->Cell(65,5,'('.$test_method_name, "1", "0","L");
                                $pdf->Cell(15,5,"X", "1", "0","C");
                                $pdf->Cell(15,5,"", "1", "0","C");
                                $pdf->Cell(30,5,"", "1", "1","L");
                             }
                             else 
                             {
                                 $f++;
                                 $pdf->Cell(65,5,$test_name, "1", "0","L");
                                 $pdf->Cell(65,5,'('.$test_method_name, "1", "0","L");
                                 $pdf->Cell(15,5,"", "1", "0","C");
                                 $pdf->Cell(15,5,"X", "1", "0","C");
                                 $pdf->Cell(30,5,"", "1", "1","L");
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
                                 $pdf->Cell(65,5,$test_name, "1", "0","L");
                                 $pdf->Cell(65,5,'('.$test_method_name, "1", "0","L");
                                 $pdf->Cell(15,5,"X", "1", "0","C");
                                 $pdf->Cell(15,5,"", "1", "0","C");
                                 $pdf->Cell(30,5,"", "1", "1","L");
                             }
                             else 
                             {
                                 $f++;
                                 
                                 $pdf->Cell(65,5,$test_name, "1", "0","L");
                                 $pdf->Cell(65,5,'('.$test_method_name, "1", "0","L");
                                 $pdf->Cell(15,5,"", "1", "0","C");
                                 $pdf->Cell(15,5,"X", "1", "0","C");
                                 $pdf->Cell(30,5,"", "1", "1","L");
                             }
                         }
                     }  /* End of if (in_array($row['id'], ['42']))*/

                     if (in_array($row['id'], ['43']))
                     {
                         
                         if ($row_for_defining_process['percentage_of_total_cotton_content_max_value']<>0) 
                         {   
                             $total_test++;
 
                             $split=explode('(', $row['test_name_method']);
                                     $test_name=$split[0];
                                     $test_method_name=$split[1];
 
                                     if($row_for_defining_process['percentage_of_total_cotton_content_min_value']<=$row_for_qc['total_cotton_content_value'] && $row_for_defining_process['percentage_of_total_cotton_content_max_value']>=$row_for_qc['total_cotton_content_value'])
                                     {
                                 $p++;
                                 $pdf->Cell(65,5,$test_name."(Total Cotton)", "1", "0","L");
                                $pdf->Cell(65,5,'('.$test_method_name, "1", "0","L");
                                $pdf->Cell(15,5,"X", "1", "0","C");
                                $pdf->Cell(15,5,"", "1", "0","C");
                                $pdf->Cell(30,5,"", "1", "1","L");
                             }
                             else 
                             {
                                 $f++;
                                 
                                 $pdf->Cell(65,5,$test_name."(Total Cotton)", "1", "0","L");
                                 $pdf->Cell(65,5,'('.$test_method_name, "1", "0","L");
                                 $pdf->Cell(15,5,"", "1", "0","C");
                                 $pdf->Cell(15,5,"X", "1", "0","C");
                                 $pdf->Cell(30,5,"", "1", "1","L");
                             }
                         }

                         if ($row_for_defining_process['percentage_of_total_polyester_content_max_value']<>0) 
                         {   
                             $total_test++;
 
                             $split=explode('(', $row['test_name_method']);
                                     $test_name=$split[0];
                                     $test_method_name=$split[1];
 
                                     if($row_for_defining_process['percentage_of_total_polyester_content_min_value']<=$row_for_qc['total_total_Polyester_content_value'] && $row_for_defining_process['percentage_of_total_polyester_content_max_value']>=$row_for_qc['total_total_Polyester_content_value'])
                                     {
                                 $p++;
                                 $pdf->Cell(65,5,$test_name."(Total Polyester)", "1", "0","L");
                                 $pdf->Cell(65,5,'('.$test_method_name, "1", "0","L");
                                 $pdf->Cell(15,5,"X", "1", "0","C");
                                 $pdf->Cell(15,5,"", "1", "0","C");
                                 $pdf->Cell(30,5,"", "1", "1","L");
                             }
                             else 
                             {
                                 $f++;
                                 
                                 $pdf->Cell(65,5,$test_name."(Total Polyester)", "1", "0","L");
                                 $pdf->Cell(65,5,'('.$test_method_name, "1", "0","L");
                                 $pdf->Cell(15,5,"", "1", "0","C");
                                 $pdf->Cell(15,5,"X", "1", "0","C");
                                 $pdf->Cell(30,5,"", "1", "1","L");
                             }
                         }

                         if ($row_for_defining_process['percentage_of_total_other_fiber_content_max_value']<>0) 
                         {   
                             $total_test++;
 
                             $split=explode('(', $row['test_name_method']);
                                     $test_name=$split[0];
                                     $test_method_name=$split[1];
 
                                     if($row_for_defining_process['percentage_of_total_other_fiber_content_min_value']<=$row_for_qc['total_other_fiber_value'] && $row_for_defining_process['percentage_of_total_other_fiber_content_max_value']>=$row_for_qc['total_other_fiber_value'])
                                     {
                                 $p++;
                                 $pdf->Cell(65,5,$test_name."(Total Other Fiber)", "1", "0","L");
                                 $pdf->Cell(65,5,'('.$test_method_name, "1", "0","L");
                                 $pdf->Cell(15,5,"X", "1", "0","C");
                                 $pdf->Cell(15,5,"", "1", "0","C");
                                 $pdf->Cell(30,5,"", "1", "1","L");
                             }
                             else 
                             {
                                 $f++;
                                 
                                 $pdf->Cell(65,5,$test_name."(Total Other Fiber)", "1", "0","L");
                                 $pdf->Cell(65,5,'('.$test_method_name, "1", "0","L");
                                 $pdf->Cell(15,5,"", "1", "0","C");
                                 $pdf->Cell(15,5,"X", "1", "0","C");
                                 $pdf->Cell(30,5,"", "1", "1","L");
                             }
                         }

                         if ($row_for_defining_process['percentage_of_warp_cotton_content_max_value']<>0) 
                         {   
                             $total_test++;
 
                             $split=explode('(', $row['test_name_method']);
                                     $test_name=$split[0];
                                     $test_method_name=$split[1];
 
                                     if($row_for_defining_process['percentage_of_warp_cotton_content_min_value']<=$row_for_qc['warp_cotton_content_value'] && $row_for_defining_process['percentage_of_warp_cotton_content_max_value']>=$row_for_qc['warp_cotton_content_value'])
                                     {
                                 $p++;
                                 $pdf->Cell(65,5,$test_name."(Warp Cotton)", "1", "0","L");
                                 $pdf->Cell(65,5,'('.$test_method_name, "1", "0","L");
                                 $pdf->Cell(15,5,"X", "1", "0","C");
                                 $pdf->Cell(15,5,"", "1", "0","C");
                                 $pdf->Cell(30,5,"", "1", "1","L");
                             }
                             else 
                             {
                                 $f++;
                                 
                                 $pdf->Cell(65,5,$test_name."(Warp Cotton)", "1", "0","L");
                                 $pdf->Cell(65,5,'('.$test_method_name, "1", "0","L");
                                 $pdf->Cell(15,5,"", "1", "0","C");
                                 $pdf->Cell(15,5,"X", "1", "0","C");
                                 $pdf->Cell(30,5,"", "1", "1","L");
                             }
                         }

                         if ($row_for_defining_process['percentage_of_warp_polyester_content_max_value']<>0) 
                         {   
                             $total_test++;
 
                             $split=explode('(', $row['test_name_method']);
                                     $test_name=$split[0];
                                     $test_method_name=$split[1];
 
                                     if($row_for_defining_process['percentage_of_warp_polyester_content_min_value']<=$row_for_qc['warp_Polyester_content_value'] && $row_for_defining_process['percentage_of_warp_polyester_content_max_value']>=$row_for_qc['warp_Polyester_content_value'])
                                     {
                                 $p++;
                                 $pdf->Cell(65,5,$test_name."(Warp Polyester)", "1", "0","L");
                                 $pdf->Cell(65,5,'('.$test_method_name, "1", "0","L");
                                 $pdf->Cell(15,5,"X", "1", "0","C");
                                 $pdf->Cell(15,5,"", "1", "0","C");
                                 $pdf->Cell(30,5,"", "1", "1","L");
                             }
                             else 
                             {
                                 $f++;
                                 
                                 $pdf->Cell(65,5,$test_name."(Warp Polyester)", "1", "0","L");
                                 $pdf->Cell(65,5,'('.$test_method_name, "1", "0","L");
                                 $pdf->Cell(15,5,"", "1", "0","C");
                                 $pdf->Cell(15,5,"X", "1", "0","C");
                                 $pdf->Cell(30,5,"", "1", "1","L");
                             }
                         }

                         if ($row_for_defining_process['percentage_of_warp_other_fiber_content_max_value']<>0) 
                         {   
                             $total_test++;
 
                             $split=explode('(', $row['test_name_method']);
                                     $test_name=$split[0];
                                     $test_method_name=$split[1];
 
                                     if($row_for_defining_process['percentage_of_warp_other_fiber_content_min_value']<=$row_for_qc['warp_other_fiber_value'] && $row_for_defining_process['percentage_of_warp_other_fiber_content_max_value']>=$row_for_qc['warp_other_fiber_value'])
                                     {
                                 $p++;
                                 $pdf->Cell(65,5,$test_name."(Warp Other Fiber)", "1", "0","L");
                                 $pdf->Cell(65,5,'('.$test_method_name, "1", "0","L");
                                 $pdf->Cell(15,5,"X", "1", "0","C");
                                 $pdf->Cell(15,5,"", "1", "0","C");
                                 $pdf->Cell(30,5,"", "1", "1","L");
                             }
                             else 
                             {
                                 $f++;
                                 
                                 $pdf->Cell(65,5,$test_name."(Warp Other Fiber)", "1", "0","L");
                                 $pdf->Cell(65,5,'('.$test_method_name, "1", "0","L");
                                 $pdf->Cell(15,5,"", "1", "0","C");
                                 $pdf->Cell(15,5,"X", "1", "0","C");
                                 $pdf->Cell(30,5,"", "1", "1","L");
                             }
                         }

                         if ($row_for_defining_process['percentage_of_weft_cotton_content_max_value']<>0) 
                         {   
                             $total_test++;
 
                             $split=explode('(', $row['test_name_method']);
                                     $test_name=$split[0];
                                     $test_method_name=$split[1];
 
                                     if($row_for_defining_process['percentage_of_weft_cotton_content_min_value']<=$row_for_qc['weft_cotton_content_value'] && $row_for_defining_process['percentage_of_weft_cotton_content_max_value']>=$row_for_qc['weft_cotton_content_value'])
                                     {
                                 $p++;
                                 $pdf->Cell(65,5,$test_name."(Weft Cotton)", "1", "0","L");
                                 $pdf->Cell(65,5,'('.$test_method_name, "1", "0","L");
                                 $pdf->Cell(15,5,"X", "1", "0","C");
                                 $pdf->Cell(15,5,"", "1", "0","C");
                                 $pdf->Cell(30,5,"", "1", "1","L");
                             }
                             else 
                             {
                                 $f++;
                                 
                                 $pdf->Cell(65,5,$test_name."(Weft Cotton)", "1", "0","L");
                                 $pdf->Cell(65,5,'('.$test_method_name, "1", "0","L");
                                 $pdf->Cell(15,5,"", "1", "0","C");
                                 $pdf->Cell(15,5,"X", "1", "0","C");
                                 $pdf->Cell(30,5,"", "1", "1","L");
                             }
                         }

                         if ($row_for_defining_process['percentage_of_weft_polyester_content_max_value']<>0) 
                         {   
                             $total_test++;
 
                             $split=explode('(', $row['test_name_method']);
                                     $test_name=$split[0];
                                     $test_method_name=$split[1];
 
                                     if($row_for_defining_process['percentage_of_weft_polyester_content_min_value']<=$row_for_qc['weft_Polyester_content_value'] && $row_for_defining_process['percentage_of_weft_polyester_content_max_value']>=$row_for_qc['weft_Polyester_content_value'])
                                     {
                                 $p++;
                                 $pdf->Cell(65,5,$test_name."(Weft Polyester)", "1", "0","L");
                                 $pdf->Cell(65,5,'('.$test_method_name, "1", "0","L");
                                 $pdf->Cell(15,5,"X", "1", "0","C");
                                 $pdf->Cell(15,5,"", "1", "0","C");
                                 $pdf->Cell(30,5,"", "1", "1","L");
                             }
                             else 
                             {
                                 $f++;
                                 $pdf->Cell(65,5,$test_name."(Weft Polyester)", "1", "0","L");
                                 $pdf->Cell(65,5,'('.$test_method_name, "1", "0","L");
                                 $pdf->Cell(15,5,"", "1", "0","C");
                                 $pdf->Cell(15,5,"X", "1", "0","C");
                                 $pdf->Cell(30,5,"", "1", "1","L");
                             }
                         }

                         if ($row_for_defining_process['percentage_of_weft_other_fiber_content_max_value']<>0) 
                         {   
                             $total_test++;
 
                             $split=explode('(', $row['test_name_method']);
                                     $test_name=$split[0];
                                     $test_method_name=$split[1];
 
                                     if($row_for_defining_process['percentage_of_weft_other_fiber_content_min_value']<=$row_for_qc['weft_other_fiber_value'] && $row_for_defining_process['percentage_of_weft_other_fiber_content_max_value']>=$row_for_qc['weft_other_fiber_value'])
                                     {
                                 $p++;
                                 $pdf->Cell(65,5,$test_name."(Weft Other Fiber)", "1", "0","L");
                                 $pdf->Cell(65,5,'('.$test_method_name, "1", "0","L");
                                 $pdf->Cell(15,5,"X", "1", "0","C");
                                 $pdf->Cell(15,5,"", "1", "0","C");
                                 $pdf->Cell(30,5,"", "1", "1","L");
                             }
                             else 
                             {
                                 $f++;
                                 
                                 $pdf->Cell(65,5,$test_name."(Weft Other Fiber)", "1", "0","L");
                                 $pdf->Cell(65,5,'('.$test_method_name, "1", "0","L");
                                 $pdf->Cell(15,5,"", "1", "0","C");
                                 $pdf->Cell(15,5,"X", "1", "0","C");
                                 $pdf->Cell(30,5,"", "1", "1","L");
                             }
                         }
                     }  /* End of if (in_array($row['id'], ['43']))*/

                     if (in_array($row['id'], ['3']))
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
                                 $pdf->Cell(65,5,$test_name, "1", "0","L");
                                 $pdf->Cell(65,5,'('.$test_method_name, "1", "0","L");
                                 $pdf->Cell(15,5,"X", "1", "0","C");
                                 $pdf->Cell(15,5,"", "1", "0","C");
                                 $pdf->Cell(30,5,"", "1", "1","L");
                             }
                             else 
                             {
                                 $f++;
                                 $pdf->Cell(65,5,$test_name, "1", "0","L");
                                 $pdf->Cell(65,5,'('.$test_method_name, "1", "0","L");
                                 $pdf->Cell(15,5,"", "1", "0","C");
                                 $pdf->Cell(15,5,"X", "1", "0","C");
                                 $pdf->Cell(30,5,"", "1", "1","L");
                             }
                         }

                        


                         

                         if ($row_for_defining_process['appear_after_washing_garments_color_change_with_sup_max_value']<>0) 
                         {   
                             $total_test++;
 
                             $split=explode('(', $row['test_name_method']);
                                     $test_name=$split[0];
                                     $test_method_name=$split[1];
 
                                     if($row_for_defining_process['appear_after_washing_garments_color_change_without_sup_min_value']<=$row_for_qc['appear_after_wash_garments_color_change_without_sup_value'] && $row_for_defining_process['appear_after_washing_garments_color_change_without_sup_max_val']>=$row_for_qc['appear_after_wash_garments_color_change_without_sup_value'] && $row_for_defining_process['appear_after_washing_garments_color_change_with_sup_min_value']<=$row_for_qc['appear_after_wash_garments_color_change_with_sup_value'] && $row_for_defining_process['appear_after_washing_garments_color_change_with_sup_max_value']>=$row_for_qc['appear_after_wash_garments_color_change_with_sup_value'] && $row_for_defining_process['appearance_after_washing_garments_cross_staining_min_value']<=$row_for_qc['appearance_after_washing_garments_cross_staining_value'] && $row_for_defining_process['appearance_after_washing_garments_cross_staining_max_value']>=$row_for_qc['appearance_after_washing_garments_cross_staining_value'] && $row_for_defining_process['appearance_after_washing_garments__differential_shrink_min_value']<=$row_for_qc['appearance_after_washing_garments_differential_shrinkage_value'] && $row_for_defining_process['appearance_after_washing_garments__differential_shrink_max_value']>=$row_for_qc['appearance_after_washing_garments_differential_shrinkage_value'] && $row_for_defining_process['appearance_after_washing_garments_surface_fuzzing_min_value']<=$row_for_qc['appearance_after_washing_garments_surface_fuzzing_value'] && $row_for_defining_process['appearance_after_washing_garments_surface_fuzzing_max_value']>=$row_for_qc['appearance_after_washing_garments_surface_fuzzing_value'] && $row_for_defining_process['appearance_after_washing_garments_surface_pilling_min_value']<=$row_for_qc['appearance_after_washing_garments_surface_pilling_value'] && $row_for_defining_process['appearance_after_washing_garments_surface_pilling_max_value']>=$row_for_qc['appearance_after_washing_garments_surface_pilling_value'] && $row_for_defining_process['appearance_after_washing_garments_crease_after_ironing_min_value']<=$row_for_qc['appearance_after_washing_garments_crease_after_ironing_value'] && $row_for_defining_process['appearance_after_washing_garments_crease_after_ironing_max_value']>=$row_for_qc['appearance_after_washing_garments_crease_after_ironing_value'] && $row_for_defining_process['appear_after_washing_garments_seam_pucker_rop_iron_min_value']<=$row_for_qc['appearance_after_washing_garments_seam_puckering_roping_after_ir'] && $row_for_defining_process['appear_after_washing_garments_seam_pucker_rop_iron_max_value']>=$row_for_qc['appearance_after_washing_garments_seam_puckering_roping_after_ir'] && $row_for_defining_process['appearance_after_washing_garments_spirality_min_value']<=$row_for_qc['appearance_after_washing_garments_spirality_value'] && $row_for_defining_process['appearance_after_washing_garments_spirality_max_value']>=$row_for_qc['appearance_after_washing_garments_spirality_value'])
                                     {
                                 $p++;
                                 $pdf->Cell(65,5,$test_name, "1", "0","L");
                                 $pdf->Cell(65,5,'('.$test_method_name, "1", "0","L");
                                 $pdf->Cell(15,5,"X", "1", "0","C");
                                 $pdf->Cell(15,5,"", "1", "0","C");
                                 $pdf->Cell(30,5,"", "1", "1","L");
                             }
                             else 
                             {
                                 $f++;
                                 $pdf->Cell(65,5,$test_name, "1", "0","L");
                                 $pdf->Cell(65,5,'('.$test_method_name, "1", "0","L");
                                 $pdf->Cell(15,5,"", "1", "0","C");
                                 $pdf->Cell(15,5,"X", "1", "0","C");
                                 $pdf->Cell(30,5,"", "1", "1","L");
                             }
                         }

                        

                     }  /* End of if (in_array($row['id'], ['3']))*/
                }

$pdf->AliasNbPages();
$pdf->AddPage();

$counter = 30;

$pdf->Ln(0);
$pdf->SetTopMargin(0);
$pdf->SetLeftMargin(135);
$pdf->setTopMargin(10);
$pdf->SetFont('Arial','',8);

$pdf->Cell(60,-25,"Date of publish :  ".$currnet_date,0,0,'L');
$pdf->Ln(0);
$pdf->SetLeftMargin(6);
$pdf->SetFont('Arial','',8);
$pdf->Code128(136,23,$trf_id,50,8);
$pdf->Ln(0);
$pdf->Cell(300,4,"Report No: ".$trf_id,"0","0","C");
$pdf->Ln(6);

$pdf->Cell(200,0,"","1","0","C");
$pdf->Ln(2);
$pdf->SetLeftMargin(10);
$pdf->SetFont('Arial','B',12);
$pdf->Cell(100,5,"TEST DETAILS : ","0","1","L");
$pdf->SetFillColor(0,0,0); // input R, G, B
$pdf->SetFont('Arial','B',12);

$counter = $counter + 27;
// $pdf->Cell(20,5,$counter,"1","1","C");

//  $pdf->Cell(100,5, $row_for_qc['cf_to_washing_staining_value_for_acetate'],"1","0","C");


// $sql="SELECT distinct tnm.id,tmc.test_method_id,  IF(tmc.test_method_name <> 'Other',concat(tmc.test_name,'(',tmc.test_method_name,')'),tmc.test_name) test_name_method
// from test_name_and_method_for_all_process tnm 
// INNER JOIN transaction_test_name_and_method ttnm on tnm.id = ttnm.test_name_and_method_for_process_id
// INNER JOIN test_method_for_customer tmc on tmc.iso_or_aatcc = ttnm.iso_or_aatcc and tmc.test_id=ttnm.test_name_id and tmc.test_method_id=ttnm.test_method_id
// where tmc.customer_name = '$customer_name'";

$sql="SELECT DISTINCT tnmp.id, tmn.test_method_id, IF(tmn.test_method_name <> 'Other',concat(tmn.test_name,'(',tmn.test_method_name,')'),tmn.test_name) test_name_method
FROM test_name_and_method_for_all_process tnmp
INNER JOIN test_method_name tmn ON tnmp.id = tmn.test_name_and_method_for_process_id 
INNER JOIN transaction_test_name_and_method ttnm ON ttnm.test_name_and_method_for_process_id = tmn.test_name_and_method_for_process_id
INNER JOIN test_method_for_customer tmc ON tmc.test_id = ttnm.test_name_id AND tmc.test_method_id = tmn.test_method_id
WHERE tmc.customer_name = '$customer_name' ORDER BY ttnm.test_name_and_method_for_process_id ASC";

$data="";
$data_for_test_method_id="";
$test_name_method="";
$serial=0;
$result= mysqli_query($con,$sql) or die(mysqli_error($con));
while( $row = mysqli_fetch_array( $result))
    {    
            // .................................id for cf_to_rubbing start.......................................
        if (in_array($row['id'], ['1']))
        {
                $counter = $counter + 28; 

                if($counter>300)
                    {
                        $pdf->AddPage();
                        $counter =30;
                        $counter = $counter + 28;
                        $pdf->SetLeftMargin(6);
                    }  

                $serial+=1;
                // $pdf->Ln(6);
                $pdf->SetLeftMargin(10);
                $pdf->Cell(10,10,$serial.". ", "0", "0","L");
                $pdf->Cell(190,10,$row['test_name_method']." : ", "0", "1","L");
                
                $pdf->setLeftMargin(17);
                $pdf->SetFont('Arial','B',10);
                $pdf->Cell(60,6," Direction ", "1","0","C",0);
                $pdf->Cell(60,6," Result ", "1","0","C",0);
                $pdf->Cell(60,6," Requirements ", "1","1","C",0);

                if (($row_for_defining_process['cf_to_rubbing_dry_max_value']<>0 && $row_for_qc['cf_to_rubbing_dry_value']<>0) || ($row_for_defining_process['cf_to_rubbing_wet_max_value']<>0 && $row_for_qc['cf_to_rubbing_wet_value']<>0) ) 

                { 
                
               
                if($row_for_defining_process['cf_to_rubbing_dry_tolerance_range_math_operator'] == '≥')
                {
                   $cf_to_rubbing_dry_tolerance_range_math_operator = $pdf->Image('../img/greater_equal.png',162, $pdf->GetY()+2, 2).'';
                }
                else if($row_for_defining_process['cf_to_rubbing_dry_tolerance_range_math_operator'] == '≤')
                {
                   $cf_to_rubbing_dry_tolerance_range_math_operator = $pdf->Image('../img/less_equal.png',162, $pdf->GetY()+2, 2).'';
                }
                else if($row_for_defining_process['cf_to_rubbing_dry_tolerance_range_math_operator'] == '>')
                {
                   $cf_to_rubbing_dry_tolerance_range_math_operator = '>';
                }
                else if($row_for_defining_process['cf_to_rubbing_dry_tolerance_range_math_operator'] == '<')
                {
                   $cf_to_rubbing_dry_tolerance_range_math_operator = '<';
                }

                

        
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
                        $cf_to_rubbing_dry_tolerance_value = '3-4';
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
                        $cf_to_rubbing_dry_value = '3-4';
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
               
                    $pdf->SetFont('Arial','',10);
                    $pdf->Cell(60,6," Dry ", "1","0","C",0);
                    $pdf->Cell(60,6,$cf_to_rubbing_dry_value, "1","0","C",0);
                    $pdf->Cell(60,6,$cf_to_rubbing_dry_tolerance_range_math_operator.' '.$cf_to_rubbing_dry_tolerance_value, "1","1","C",0);
                }

                if ($row_for_defining_process['cf_to_rubbing_wet_max_value']<>0 && $row_for_qc['cf_to_rubbing_wet_value']<>0) 

                {
                    if($row_for_defining_process['cf_to_rubbing_wet_tolerance_range_math_operator'] == '≥')
                    {
                        $cf_to_rubbing_wet_tolerance_range_math_operator = $pdf->Image('../img/greater_equal.png',162, $pdf->GetY()+2, 2).'';
                    }
                    else if($row_for_defining_process['cf_to_rubbing_wet_tolerance_range_math_operator'] == '≤')
                    {
                        $cf_to_rubbing_wet_tolerance_range_math_operator = $pdf->Image('../img/less_equal.png',162, $pdf->GetY()+2, 2).'';
                    }
                    else if($row_for_defining_process['cf_to_rubbing_wet_tolerance_range_math_operator'] == '>')
                    {
                        $cf_to_rubbing_wet_tolerance_range_math_operator = '>';
                    }
                    else if($row_for_defining_process['cf_to_rubbing_wet_tolerance_range_math_operator'] == '<')
                    {
                        $cf_to_rubbing_wet_tolerance_range_math_operator = '<';
                    }


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
                            $cf_to_rubbing_wet_tolerance_value = '3-4';
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
                            $cf_to_rubbing_wet_value = '3-4';
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

                    $pdf->SetFont('Arial','',10);
                    $pdf->Cell(60,6," Wet ", "1","0","C",0);
                    $pdf->Cell(60,6,$cf_to_rubbing_wet_value, "1","0","C",0);
                    $pdf->Cell(60,6,$cf_to_rubbing_wet_tolerance_range_math_operator.' '.'3-4', "1","1","C",0);
                }
                $pdf->setLeftMargin(10);
                $pdf->SetFont('Arial','B',12);

            }   /*End of if (($row_for_defining_process['cf_to_rubbing_dry_max_value']<>0 && $row_for_qc['cf_to_rubbing_dry_value']<>0) || ($row_for_defining_process['cf_to_rubbing_wet_max_value']<>0 && $row_for_qc['cf_to_rubbing_wet_value']<>0) ) */

        }  /*End of if (in_array($row['id'], ['1']))*/
        //$pdf->Ln(1);


        if (in_array($row['id'], ['2']))
        {
            $counter = $counter + 38; 

            if($counter>300)
            {
                $pdf->AddPage();
                $counter =30;
                $counter = $counter + 38;
                $pdf->SetLeftMargin(6);
            }

            
             if (($row_for_defining_process['dimensional_stability_to_warp_washing_before_iron_max_value']<>0 && $row_for_qc_supplimentery['dimensional_stability_to_warp_washing_before_iron_value']<>0) || ($row_for_defining_process['dimensional_stability_to_weft_washing_before_iron_max_value']<>0 && $row_for_qc_supplimentery['dimensional_stability_to_weft_washing_before_iron_value']<>0) )
            {  
                $serial+=1;
                $pdf->Ln(6);
                $pdf->SetLeftMargin(10);
                $pdf->Cell(10,5,$serial.".", "0", "0","L");
                $pdf->Cell(190,5,$row['test_name_method']." : ", "0", "1","L");
                $pdf->Ln(2);
                $pdf->Cell(190,5,"  ", "0", "1","L");
                $pdf->Ln(2);
                $pdf->setLeftMargin(17);
                $pdf->SetFont('Arial','B',10);
                $pdf->Cell(60,6," Direction", "1","0","C",0);
                $pdf->Cell(60,6," Result ", "1","0","C",0);
                $pdf->Cell(60,6," Requirements ", "1","1","C",0);
                $pdf->SetFont('Arial','',10);
                $pdf->Cell(60,6," Average Warp", "1","0","C",0);
                $pdf->Cell(60,6,$row_for_qc_supplimentery['dimensional_stability_to_warp_washing_before_iron_value'].' ' .$row_for_defining_process['uom_of_dimensional_stability_to_warp_washing_before_iron'], "1","0","C",0);
                $pdf->Cell(60,6,"(".$row_for_defining_process['dimensional_stability_to_warp_washing_after_iron_min_value']." to ".$row_for_defining_process['dimensional_stability_to_warp_washing_after_iron_max_value'].') ' .$row_for_defining_process['uom_of_dimensional_stability_to_warp_washing_before_iron'], "1","1","C",0);
                $pdf->Cell(60,6," Average Weft", "1","0","C",0);
                $pdf->Cell(60,6,$row_for_qc_supplimentery['dimensional_stability_to_weft_washing_before_iron_value'].' ' .$row_for_defining_process['uom_of_dimensional_stability_to_weft_washing_before_iron'], "1","0","C",0);
                $pdf->Cell(60,6,"(".$row_for_defining_process['dimensional_stability_to_weft_washing_after_iron_min_value']." to ".$row_for_defining_process['dimensional_stability_to_warp_washing_after_iron_max_value'].') ' .$row_for_defining_process['uom_of_dimensional_stability_to_weft_washing_before_iron'], "1","1","C",0);
              
            }
            $pdf->setLeftMargin(10);
            $pdf->SetFont('Arial','B',12);
              
         }  /*End of if (in_array($row['id'], ['2']))*/

         if (in_array($row['id'], ['3']))
         {
              
            $counter = $counter + 19; 

            if($row_for_defining_process['test_method_for_appearance_after_wash_fabric'] == 'Fabric (Mock up)' && $row_for_qc['test_method_for_appearance_after_wash'] == 'Fabric (Mock up)')
            {
                if(($row_for_defining_process['appearance_after_washing_fabric_color_change_max_value']<>0 ))
                {
                    $counter = $counter + 6;
                }
                if($row_for_defining_process['appearance_after_washing_fabric_cross_staining_max_value']<>0)
                {
                    $counter = $counter + 6;
                }
                if($row_for_defining_process['appearance_after_washing_fabric_surface_fuzzing_max_value']<>0)
                {
                    $counter = $counter + 6;
                }
                if($row_for_defining_process['appearance_after_washing_fabric_surface_pilling_max_value']<>0)
                {
                    $counter = $counter + 6;
                }
                if($row_for_defining_process['appearance_after_washing_fabric_crease_before_ironing_max_value']<>0)
                {
                    $counter = $counter + 6;
                }
                if($row_for_defining_process['appearance_after_washing_fabric_crease_after_ironing_max_value']<>0)
                {
                    $counter = $counter + 6;
                }
                if($row_for_defining_process['appearance_after_washing_loss_of_print_fabric']<>'' && $row_for_qc['appearance_after_washing_fabric_loss_of_print_value']<>'')
                {
                    $counter = $counter + 6;
                }
                if($row_for_defining_process['appearance_after_washing_fabric_abrasive_mark']<>'' && $row_for_qc['appearance_after_washing_fabric_abrasive_mark_value']<>'')
                {
                    $counter = $counter + 6;
                }
                if($row_for_defining_process['appearance_after_washing_odor_fabric']<>'' && $row_for_qc['appearance_after_washing_fabric_odor_value']<>'')
                {
                    $counter = $counter + 6;
                }
            }

            if($row_for_defining_process['test_method_for_appearance_after_wash_fabric'] == 'Garments' && $row_for_qc['test_method_for_appearance_after_wash'] == 'Garments')
            {
                if($row_for_defining_process['appear_after_washing_garments_color_change_without_sup_max_val']<>0)
                {
                    $counter = $counter + 6;
                }
                if($row_for_defining_process['appear_after_washing_garments_color_change_with_sup_max_value']<>0)
                {
                    $counter = $counter + 6;
                }
                if($row_for_defining_process['appearance_after_washing_garments_cross_staining_max_value']<>0)
                {
                    $counter = $counter + 6;
                }
                if($row_for_defining_process['appearance_after_washing_garments__differential_shrink_max_value']<>0)
                {
                    $counter = $counter + 6;
                }
                if($row_for_defining_process['appearance_after_washing_garments_surface_fuzzing_max_value']<>0)
                {
                    $counter = $counter + 6;
                }
                if($row_for_defining_process['appearance_after_washing_garments_surface_pilling_max_value']<>0)
                {
                    $counter = $counter + 6;
                }
                if($row_for_defining_process['appearance_after_washing_garments_crease_after_ironing_max_value']<>0)
                {
                    $counter = $counter + 6;
                }
                if($row_for_defining_process['appearance_after_washing_garments_abrasive_mark']<>'')
                {
                    $counter = $counter + 6;
                }
                if($row_for_defining_process['seam_breakdown_garments']<>0)
                {
                    $counter = $counter + 6;
                }
                if($row_for_defining_process['appear_after_washing_garments_seam_pucker_rop_iron_max_value']<>0)
                {
                    $counter = $counter + 6;
                }
                if($row_for_defining_process['detachment_of_interlinings_fused_components_garments']<>'' && $row_for_qc['appearance_after_washing_garments_detachment_of_interlining_valu']<>'')
                {
                    $counter = $counter + 6;
                }
                if($row_for_defining_process['change_id_handle_or_appearance']<>'' && $row_for_qc['appearance_after_washing_garments_change_in_handle_value']<>'')
                {
                    $counter = $counter + 6;
                }
                if($row_for_defining_process['effect_on_accessories_such_as_buttons']<>'' && $row_for_qc['appearance_after_washing_garments_effect_accessories_value']<>'')
                {
                    $counter = $counter + 6;
                }
                if($row_for_defining_process['appearance_after_washing_garments_spirality_max_value']<>0 && $row_for_qc['appearance_after_washing_garments_spirality_value']<>0)
                {
                    $counter = $counter + 6;
                }
                if($row_for_defining_process['detachment_or_fraying_of_ribbons']<>'' && $row_for_qc['appearance_after_washing_garments_detachment_or_fraying_of_ribbo']<>'')
                {
                    $counter = $counter + 6;
                }
                if($row_for_defining_process['loss_of_print_garments']<>'' && $row_for_qc['appearance_after_washing_garments_loss_of_print_value']<>'')
                {
                    $counter = $counter + 6;
                }
                if($row_for_defining_process['care_level_garments']<>'' && $row_for_qc['appearance_after_washing_garments_care_level_value']<>'')
                {
                    $counter = $counter + 6;
                }
                if($row_for_defining_process['odor_garments']<>'' && $row_for_qc['appearance_after_washing_garments_odor_value']<>'')
                {
                    $counter = $counter + 6;
                }
            }
            if($counter>300)
            {
                $pdf->AddPage();
                $counter =30;
                $counter = $counter + 19; 

                if($row_for_defining_process['test_method_for_appearance_after_wash_fabric'] == 'Fabric (Mock up)' && $row_for_qc['test_method_for_appearance_after_wash'] == 'Fabric (Mock up)')
                {
                    if(($row_for_defining_process['appearance_after_washing_fabric_color_change_max_value']<>0 ))
                    {
                        $counter = $counter + 6;
                    }
                    if($row_for_defining_process['appearance_after_washing_fabric_cross_staining_max_value']<>0)
                    {
                        $counter = $counter + 6;
                    }
                    if($row_for_defining_process['appearance_after_washing_fabric_surface_fuzzing_max_value']<>0)
                    {
                        $counter = $counter + 6;
                    }
                    if($row_for_defining_process['appearance_after_washing_fabric_surface_pilling_max_value']<>0)
                    {
                        $counter = $counter + 6;
                    }
                    if($row_for_defining_process['appearance_after_washing_fabric_crease_before_ironing_max_value']<>0)
                    {
                        $counter = $counter + 6;
                    }
                    if($row_for_defining_process['appearance_after_washing_fabric_crease_after_ironing_max_value']<>0)
                    {
                        $counter = $counter + 6;
                    }
                    if($row_for_defining_process['appearance_after_washing_loss_of_print_fabric']<>'' && $row_for_qc['appearance_after_washing_fabric_loss_of_print_value']<>'')
                    {
                        $counter = $counter + 6;
                    }
                    if($row_for_defining_process['appearance_after_washing_fabric_abrasive_mark']<>'' && $row_for_qc['appearance_after_washing_fabric_abrasive_mark_value']<>'')
                    {
                        $counter = $counter + 6;
                    }
                    if($row_for_defining_process['appearance_after_washing_odor_fabric']<>'' && $row_for_qc['appearance_after_washing_fabric_odor_value']<>'')
                    {
                        $counter = $counter + 6;
                    }
                    if($row_for_defining_process['appearance_after_washing_other_observation_fabric']<>'' && $row_for_qc['appearance_after_washing_other_observation_fabric']<>'')
                    {
                        $counter = $counter + 6;
                    }
                }

                if($row_for_defining_process['test_method_for_appearance_after_wash_fabric'] == 'Garments' && $row_for_qc['test_method_for_appearance_after_wash'] == 'Garments')
                {
                    if($row_for_defining_process['appear_after_washing_garments_color_change_without_sup_max_val']<>0)
                    {
                        $counter = $counter + 6;
                    }
                    if($row_for_defining_process['appear_after_washing_garments_color_change_with_sup_max_value']<>0)
                    {
                        $counter = $counter + 6;
                    }
                    if($row_for_defining_process['appearance_after_washing_garments_cross_staining_max_value']<>0)
                    {
                        $counter = $counter + 6;
                    }
                    if($row_for_defining_process['appearance_after_washing_garments__differential_shrink_max_value']<>0)
                    {
                        $counter = $counter + 6;
                    }
                    if($row_for_defining_process['appearance_after_washing_garments_surface_fuzzing_max_value']<>0)
                    {
                        $counter = $counter + 6;
                    }
                    if($row_for_defining_process['appearance_after_washing_garments_surface_pilling_max_value']<>0)
                    {
                        $counter = $counter + 6;
                    }
                    if($row_for_defining_process['appearance_after_washing_garments_crease_after_ironing_max_value']<>0)
                    {
                        $counter = $counter + 6;
                    }
                    if($row_for_defining_process['appearance_after_washing_garments_abrasive_mark']<>'')
                    {
                        $counter = $counter + 6;
                    }
                    if($row_for_defining_process['seam_breakdown_garments']<>0)
                    {
                        $counter = $counter + 6;
                    }
                    if($row_for_defining_process['appear_after_washing_garments_seam_pucker_rop_iron_max_value']<>0)
                    {
                        $counter = $counter + 6;
                    }
                    if($row_for_defining_process['detachment_of_interlinings_fused_components_garments']<>'' && $row_for_qc['appearance_after_washing_garments_detachment_of_interlining_valu']<>'')
                    {
                        $counter = $counter + 6;
                    }
                    if($row_for_defining_process['change_id_handle_or_appearance']<>'' && $row_for_qc['appearance_after_washing_garments_change_in_handle_value']<>'')
                    {
                        $counter = $counter + 6;
                    }
                    if($row_for_defining_process['effect_on_accessories_such_as_buttons']<>'' && $row_for_qc['appearance_after_washing_garments_effect_accessories_value']<>'')
                    {
                        $counter = $counter + 6;
                    }
                    if($row_for_defining_process['appearance_after_washing_garments_spirality_max_value']<>0 && $row_for_qc['appearance_after_washing_garments_spirality_value']<>0)
                    {
                        $counter = $counter + 6;
                    }
                    if($row_for_defining_process['detachment_or_fraying_of_ribbons']<>'' && $row_for_qc['appearance_after_washing_garments_detachment_or_fraying_of_ribbo']<>'')
                    {
                        $counter = $counter + 6;
                    }
                    if($row_for_defining_process['loss_of_print_garments']<>'' && $row_for_qc['appearance_after_washing_garments_loss_of_print_value']<>'')
                    {
                        $counter = $counter + 6;
                    }
                    if($row_for_defining_process['care_level_garments']<>'' && $row_for_qc['appearance_after_washing_garments_care_level_value']<>'')
                    {
                        $counter = $counter + 6;
                    }
                    if($row_for_defining_process['odor_garments']<>'' && $row_for_qc['appearance_after_washing_garments_odor_value']<>'')
                    {
                        $counter = $counter + 6;
                    }
                    if($row_for_defining_process['appearance_after_washing_other_observation_garments']<>'' && $row_for_qc['appearance_after_washing_other_observation_garments']<>'')
                    {
                        $counter = $counter + 6;
                    }
                   
                }
                $pdf->SetLeftMargin(6);
            }


              

                if($row_for_defining_process['test_method_for_appearance_after_wash_fabric'] == 'Fabric (Mock up)' && $row_for_qc['test_method_for_appearance_after_wash'] == 'Fabric (Mock up)')
                {
                    $serial+=1;
                    $pdf->Ln(6);
                    $pdf->SetLeftMargin(10);
                    $pdf->Cell(10,5,$serial.".", "0", "0","L");
                    $pdf->Cell(190,5,$row['test_name_method']." : ", "0", "1","L");
                    $pdf->Ln(2);
                    $pdf->setLeftMargin(17);
                    $pdf->SetFont('Arial','B',10);
                    $pdf->Cell(60,6," Assessment Criteria", "1","0","C",0);
                    $pdf->Cell(60,6," Result  / Comments", "1","0","C",0);
                    $pdf->Cell(60,6," Requirements", "1","1","C",0);
                    $pdf->SetFont('Arial','',10);

                if(($row_for_defining_process['appearance_after_washing_fabric_color_change_max_value']<>0 ))
                {

                    if($row_for_defining_process['appearance_after_washing_fabric_color_change_math_op'] == '≥')
                    {
                    $appearance_after_washing_fabric_color_change_math_op = $pdf->Image('../img/greater_equal.png',162, $pdf->GetY()+2, 2).'';
                    }
                    else if($row_for_defining_process['appearance_after_washing_fabric_color_change_math_op'] == '≤')
                    {
                    $appearance_after_washing_fabric_color_change_math_op = $pdf->Image('../img/less_equal.png',162, $pdf->GetY()+2, 2).'';
                    }
                    else if($row_for_defining_process['appearance_after_washing_fabric_color_change_math_op'] == '>')
                    {
                    $appearance_after_washing_fabric_color_change_math_op = '>';
                    }
                    else if($row_for_defining_process['appearance_after_washing_fabric_color_change_math_op'] == '<')
                    {
                    $appearance_after_washing_fabric_color_change_math_op = '<';
                    }

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
                                                      
            
           
                $pdf->Cell(60,6," Fabric (Color Change) ", "1","0","L",0);
                $pdf->Cell(60,6,$appear_after_wash_fabric_color_change_value, "1","0","C",0);
                $pdf->Cell(60,6,$appearance_after_washing_fabric_color_change_math_op.' '.$appearance_after_washing_fabric_color_change_tolerance_value, "1","1","C",0);
                
                }
                if($row_for_defining_process['appearance_after_washing_fabric_cross_staining_max_value']<>0)
                {
                    if($row_for_defining_process['appearance_after_washing_fabric_cross_staining_math_op'] == '≥')
                    {
                    $appearance_after_washing_fabric_cross_staining_math_op = $pdf->Image('../img/greater_equal.png',162, $pdf->GetY()+2, 2).'';
                    }
                    else if($row_for_defining_process['appearance_after_washing_fabric_cross_staining_math_op'] == '≤')
                    {
                    $appearance_after_washing_fabric_cross_staining_math_op = $pdf->Image('../img/less_equal.png',162, $pdf->GetY()+2, 2).'';
                    }
                    else if($row_for_defining_process['appearance_after_washing_fabric_cross_staining_math_op'] == '>')
                    {
                    $appearance_after_washing_fabric_cross_staining_math_op = '>';
                    }
                    else if($row_for_defining_process['appearance_after_washing_fabric_cross_staining_math_op'] == '<')
                    {
                    $appearance_after_washing_fabric_cross_staining_math_op = '<';
                    }

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

                $pdf->Cell(60,6," Fabric (Cross Staining) ", "1","0","l",0);
                $pdf->Cell(60,6,$appearance_after_washing_fabric_cross_staining_value, "1","0","C",0);
                $pdf->Cell(60,6,$appearance_after_washing_fabric_cross_staining_math_op.' '.$appearance_after_washing_fabric_cross_staining_tolerance_value, "1","1","C",0);
                
            }
           
            if($row_for_defining_process['appearance_after_washing_fabric_surface_fuzzing_max_value']<>0)
            {
                if($row_for_defining_process['appearance_after_washing_fabric_surface_fuzzing_math_op'] == '≥')
                       {
                          $appearance_after_washing_fabric_surface_fuzzing_math_op = $pdf->Image('../img/greater_equal.png',162, $pdf->GetY()+2, 2).'';
                       }
                       else if($row_for_defining_process['appearance_after_washing_fabric_surface_fuzzing_math_op'] == '≤')
                       {
                          $appearance_after_washing_fabric_surface_fuzzing_math_op = $pdf->Image('../img/less_equal.png',162, $pdf->GetY()+2, 2).'';
                       }
                       else if($row_for_defining_process['appearance_after_washing_fabric_surface_fuzzing_math_op'] == '>')
                       {
                          $appearance_after_washing_fabric_surface_fuzzing_math_op = '>';
                       }
                       else if($row_for_defining_process['appearance_after_washing_fabric_surface_fuzzing_math_op'] == '<')
                       {
                          $appearance_after_washing_fabric_surface_fuzzing_math_op = '<';
                       }

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

                       

                $pdf->Cell(60,6," Fabric (Surface Fuzzing )", "1","0","l",0);
                $pdf->Cell(60,6,$appearance_after_washing_fabric_surface_fuzzing_value, "1","0","C",0);
                $pdf->Cell(60,6,$appearance_after_washing_fabric_surface_fuzzing_math_op.' '.$appearance_after_washing_fabric_surface_fuzzing_tolerance_value, "1","1","C",0);
                
            }
            if($row_for_defining_process['appearance_after_washing_fabric_surface_pilling_max_value']<>0)
            {
                if($row_for_defining_process['appearance_after_washing_fabric_surface_pilling_math_op'] == '≥')
                       {
                          $appearance_after_washing_fabric_surface_pilling_math_op = $pdf->Image('../img/greater_equal.png',162, $pdf->GetY()+2, 2).'';
                       }
                       else if($row_for_defining_process['appearance_after_washing_fabric_surface_pilling_math_op'] == '≤')
                       {
                          $appearance_after_washing_fabric_surface_pilling_math_op = $pdf->Image('../img/less_equal.png',162, $pdf->GetY()+2, 2).'';
                       }
                       else if($row_for_defining_process['appearance_after_washing_fabric_surface_pilling_math_op'] == '>')
                       {
                          $appearance_after_washing_fabric_surface_pilling_math_op = '>';
                       }
                       else if($row_for_defining_process['appearance_after_washing_fabric_surface_pilling_math_op'] == '<')
                       {
                          $appearance_after_washing_fabric_surface_pilling_math_op = '<';
                       }

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

                $pdf->Cell(60,6," Fabric (Surface Pilling) ", "1","0","l",0);
                $pdf->Cell(60,6,$appearance_after_washing_fabric_surface_pilling_value, "1","0","C",0);
                $pdf->Cell(60,6,$appearance_after_washing_fabric_surface_pilling_math_op.' '.$appearance_after_washing_fabric_surface_pilling_tolerance_value, "1","1","C",0);
                
            }
            if($row_for_defining_process['appearance_after_washing_fabric_crease_before_ironing_max_value']<>0)
            {
                if($row_for_defining_process['appearance_after_washing_fabric_crease_before_iron_math_op'] == '≥')
                       {
                          $appearance_after_washing_fabric_crease_before_iron_math_op = $pdf->Image('../img/greater_equal.png',162, $pdf->GetY()+2, 2).'';
                       }
                       else if($row_for_defining_process['appearance_after_washing_fabric_crease_before_iron_math_op'] == '≤')
                       {
                          $appearance_after_washing_fabric_crease_before_iron_math_op = $pdf->Image('../img/less_equal.png',162, $pdf->GetY()+2, 2).'';
                       }
                       else if($row_for_defining_process['appearance_after_washing_fabric_crease_before_iron_math_op'] == '>')
                       {
                          $appearance_after_washing_fabric_crease_before_iron_math_op = '>';
                       }
                       else if($row_for_defining_process['appearance_after_washing_fabric_crease_before_iron_math_op'] == '<')
                       {
                          $appearance_after_washing_fabric_crease_before_iron_math_op = '<';
                       }

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

                $pdf->Cell(60,6,"Fabric (Crease before ironing) ", "1","0","L",0);
                $pdf->Cell(60,6,$appearance_after_washing_fabric_crease_before_ironing_value, "1","0","C",0);
                $pdf->Cell(60,6,$appearance_after_washing_fabric_crease_before_iron_math_op.' '.$appearance_after_washing_fabric_crease_before_iron_tolerance_val, "1","1","C",0);
            
            }
            if($row_for_defining_process['appearance_after_washing_fabric_crease_after_ironing_max_value']<>0)
            {
                if($row_for_defining_process['appearance_after_washing_fabric_crease_after_iron_math_op'] == '≥')
                       {
                          $appearance_after_washing_fabric_crease_after_iron_math_op = $pdf->Image('../img/greater_equal.png',162, $pdf->GetY()+2, 2).'';
                       }
                       else if($row_for_defining_process['appearance_after_washing_fabric_crease_after_iron_math_op'] == '≤')
                       {
                          $appearance_after_washing_fabric_crease_after_iron_math_op = $pdf->Image('../img/less_equal.png',162, $pdf->GetY()+2, 2).'';
                       }
                       else if($row_for_defining_process['appearance_after_washing_fabric_crease_after_iron_math_op'] == '>')
                       {
                          $appearance_after_washing_fabric_crease_after_iron_math_op = '>';
                       }
                       else if($row_for_defining_process['appearance_after_washing_fabric_crease_after_iron_math_op'] == '<')
                       {
                          $appearance_after_washing_fabric_crease_after_iron_math_op = '<';
                       }

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
                       
                $pdf->Cell(60,6,"Fabric (Crease after ironing) ", "1","0","l",0);
                $pdf->Cell(60,6,$appearance_after_washing_fabric_crease_after_ironing_value, "1","0","C",0);
                $pdf->Cell(60,6,$appearance_after_washing_fabric_crease_after_iron_math_op.' '.$appearance_after_washing_fabric_crease_after_iron_tolerance_val, "1","1","C",0);
            
            }
            if($row_for_defining_process['appearance_after_washing_loss_of_print_fabric']<>'' && $row_for_qc['appearance_after_washing_fabric_loss_of_print_value']<>'')
            {
                $pdf->Cell(60,6,"Fabric (Loss of Print) ", "1","0","L",0);
                $pdf->Cell(60,6,$row_for_qc['appearance_after_washing_fabric_loss_of_print_value'], "1","0","C",0);
                $pdf->Cell(60,6,$row_for_defining_process['appearance_after_washing_loss_of_print_fabric'], "1","1","C",0);
            
            }
            if($row_for_defining_process['appearance_after_washing_fabric_abrasive_mark']<>'' && $row_for_qc['appearance_after_washing_fabric_abrasive_mark_value']<>'')
            {
                $pdf->Cell(60,6,"Fabric (Abrasive Mark) ", "1","0","L",0);
                $pdf->Cell(60,6,$row_for_qc['appearance_after_washing_fabric_abrasive_mark_value'], "1","0","C",0);
                $pdf->Cell(60,6,$row_for_defining_process['appearance_after_washing_fabric_abrasive_mark'], "1","1","C",0);
            }
            if($row_for_defining_process['appearance_after_washing_odor_fabric']<>'' && $row_for_qc['appearance_after_washing_fabric_odor_value']<>'')
            {
                $pdf->Cell(60,6,"Fabric (Odor) ", "1","0","L",0);
                $pdf->Cell(60,6,$row_for_qc['appearance_after_washing_fabric_odor_value'], "1","0","C",0);
                $pdf->Cell(60,6,$row_for_defining_process['appearance_after_washing_odor_fabric'], "1","1","C",0);
            }
            if($row_for_defining_process['appearance_after_washing_other_observation_fabric']<>'' && $row_for_qc['appearance_after_washing_other_observation_fabric']<>'')
            {
                $pdf->Cell(60,6,"Fabric (Other observation) ", "1","0","L",0);
                $pdf->Cell(60,6,$row_for_qc['appearance_after_washing_other_observation_fabric'], "1","0","C",0);
                $pdf->Cell(60,6,$row_for_defining_process['appearance_after_washing_other_observation_fabric'], "1","1","C",0);
            }
        }

        if($row_for_defining_process['test_method_for_appearance_after_wash_fabric'] == 'Garments' && $row_for_qc['test_method_for_appearance_after_wash'] == 'Garments')
        {
            $serial+=1;
            $pdf->Ln(6);
            $pdf->SetLeftMargin(10);
            $pdf->Cell(10,5,$serial.".", "0", "0","L");
            $pdf->Cell(190,5,$row['test_name_method']." : ", "0", "1","L");
            $pdf->Ln(2);
            $pdf->setLeftMargin(17);
            $pdf->SetFont('Arial','B',10);
            $pdf->Cell(60,6," Assessment Criteria", "1","0","C",0);
            $pdf->Cell(60,6," Result  / Comments", "1","0","C",0);
            $pdf->Cell(60,6," Requirements", "1","1","C",0);
            $pdf->SetFont('Arial','',10);
            
            if($row_for_defining_process['appear_after_washing_garments_color_change_without_sup_max_val']<>0)
            {
                if($row_for_defining_process['appear_after_washing_garments_color_change_without_sup_math_op'] == '≥')
                {
                   $appear_after_washing_garments_color_change_without_sup_math_op = $pdf->Image('../img/greater_equal.png',162, $pdf->GetY()+2, 2).'';
                }
                else if($row_for_defining_process['appear_after_washing_garments_color_change_without_sup_math_op'] == '≤')
                {
                   $appear_after_washing_garments_color_change_without_sup_math_op = $pdf->Image('../img/less_equal.png',162, $pdf->GetY()+2, 2).'';
                }
                else if($row_for_defining_process['appear_after_washing_garments_color_change_without_sup_math_op'] == '>')
                {
                   $appear_after_washing_garments_color_change_without_sup_math_op = '>';
                }
                else if($row_for_defining_process['appear_after_washing_garments_color_change_without_sup_math_op'] == '<')
                {
                   $appear_after_washing_garments_color_change_without_sup_math_op = '<';
                }

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

                $pdf->Cell(60,6,"Garment(Color Change(Without Suppressor))", "1","0","l",0);
                $pdf->Cell(60,6,$appear_after_wash_garments_color_change_without_sup_value, "1","0","C",0);
                $pdf->Cell(60,6,$appear_after_washing_garments_color_change_without_sup_math_op.' '.$appear_after_washing_garments_color_change_without_sup_toler_val, "1","1","C",0);
            
            }
            if($row_for_defining_process['appear_after_washing_garments_color_change_with_sup_max_value']<>0)
            {
                if($row_for_defining_process['appear_after_washing_garments_color_change_with_sup_math_op'] == '≥')
                {
                   $appear_after_washing_garments_color_change_with_sup_math_op = $pdf->Image('../img/greater_equal.png',162, $pdf->GetY()+2, 2).'';
                }
                else if($row_for_defining_process['appear_after_washing_garments_color_change_with_sup_math_op'] == '≤')
                {
                   $appear_after_washing_garments_color_change_with_sup_math_op = $pdf->Image('../img/less_equal.png',162, $pdf->GetY()+2, 2).'';
                }
                else if($row_for_defining_process['appear_after_washing_garments_color_change_with_sup_math_op'] == '>')
                {
                   $appear_after_washing_garments_color_change_with_sup_math_op = '>';
                }
                else if($row_for_defining_process['appear_after_washing_garments_color_change_with_sup_math_op'] == '<')
                {
                   $appear_after_washing_garments_color_change_with_sup_math_op = '<';
                }
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

                $pdf->Cell(60,6,"Garment(Color Change(With Suppressor))", "1","0","l",0);
                $pdf->Cell(60,6,$appear_after_wash_garments_color_change_with_sup_value, "1","0","C",0);
                $pdf->Cell(60,6,$appear_after_washing_garments_color_change_with_sup_math_op.' '.$appear_after_washing_garments_color_change_with_sup_toler_value, "1","1","C",0);
            
            }
            if($row_for_defining_process['appearance_after_washing_garments_cross_staining_max_value']<>0)
            {
                if($row_for_defining_process['appear_after_washing_garments_cross_staining_math_op'] == '≥')
                {
                   $appear_after_washing_garments_cross_staining_math_op = $pdf->Image('../img/greater_equal.png',162, $pdf->GetY()+2, 2).'';
                }
                else if($row_for_defining_process['appear_after_washing_garments_cross_staining_math_op'] == '≤')
                {
                   $appear_after_washing_garments_cross_staining_math_op = $pdf->Image('../img/less_equal.png',162, $pdf->GetY()+2, 2).'';
                }
                else if($row_for_defining_process['appear_after_washing_garments_cross_staining_math_op'] == '>')
                {
                   $appear_after_washing_garments_cross_staining_math_op = '>';
                }
                else if($row_for_defining_process['appear_after_washing_garments_cross_staining_math_op'] == '<')
                {
                   $appear_after_washing_garments_cross_staining_math_op = '<';
                }

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

                $pdf->Cell(60,6,"Garments (Cross Staining)", "1","0","l",0);
                $pdf->Cell(60,6,$appearance_after_washing_garments_cross_staining_value, "1","0","C",0);
                $pdf->Cell(60,6,$appear_after_washing_garments_cross_staining_math_op.' '.$appear_after_washing_garments_cross_staining_tolerance_value, "1","1","C",0);
            
            }
            if($row_for_defining_process['appearance_after_washing_garments__differential_shrink_max_value']<>0)
            {
                $content_appear_after_wash_garments_differ_shrink = urlencode($row_for_defining_process['appear_after_washing_garments_differential_shrink_math_op']);

                $appear_after_washing_garments_differential_shrink_math_op = urldecode($pdf->sp_character($content_appear_after_wash_garments_differ_shrink));
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

                $pdf->Cell(60,6,"Garments (Differential Shrinking)", "1","0","l",0);
                $pdf->Cell(60,6,$appearance_after_washing_garments_differential_shrinkage_value, "1","0","C",0);
                $pdf->Cell(60,6,$appear_after_washing_garments_differential_shrink_math_op.' '.$appear_after_washing_garments__differential_shrink_tolerance_val, "1","1","C",0);
            
            }
            if($row_for_defining_process['appearance_after_washing_garments_surface_fuzzing_max_value']<>0)
            {
                if($row_for_defining_process['appear_after_washing_garments_surface_fuzzing_math_op'] == '≥')
                {
                   $appear_after_washing_garments_surface_fuzzing_math_op = $pdf->Image('../img/greater_equal.png',162, $pdf->GetY()+2, 2).'';
                }
                else if($row_for_defining_process['appear_after_washing_garments_surface_fuzzing_math_op'] == '≤')
                {
                   $appear_after_washing_garments_surface_fuzzing_math_op = $pdf->Image('../img/less_equal.png',162, $pdf->GetY()+2, 2).'';
                }
                else if($row_for_defining_process['appear_after_washing_garments_surface_fuzzing_math_op'] == '>')
                {
                   $appear_after_washing_garments_surface_fuzzing_math_op = '>';
                }
                else if($row_for_defining_process['appear_after_washing_garments_surface_fuzzing_math_op'] == '<')
                {
                   $appear_after_washing_garments_surface_fuzzing_math_op = '<';
                }

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

                $pdf->Cell(60,6,"Garments (Surface Fuzzing)", "1","0","l",0);
                $pdf->Cell(60,6,$appearance_after_washing_garments_surface_fuzzing_value, "1","0","C",0);
                $pdf->Cell(60,6,$appear_after_washing_garments_surface_fuzzing_math_op.' '.$appearance_after_washing_garments_surface_fuzzing_tolerance_val, "1","1","C",0);
            
            }
            if($row_for_defining_process['appearance_after_washing_garments_surface_pilling_max_value']<>0)
            {
                if($row_for_defining_process['appear_after_washing_garments_surface_pilling_math_op'] == '≥')
                {
                   $appear_after_washing_garments_surface_pilling_math_op = $pdf->Image('../img/greater_equal.png',162, $pdf->GetY()+2, 2).'';
                }
                else if($row_for_defining_process['appear_after_washing_garments_surface_pilling_math_op'] == '≤')
                {
                   $appear_after_washing_garments_surface_pilling_math_op = $pdf->Image('../img/less_equal.png',162, $pdf->GetY()+2, 2).'';
                }
                else if($row_for_defining_process['appear_after_washing_garments_surface_pilling_math_op'] == '>')
                {
                   $appear_after_washing_garments_surface_pilling_math_op = '>';
                }
                else if($row_for_defining_process['appear_after_washing_garments_surface_pilling_math_op'] == '<')
                {
                   $appear_after_washing_garments_surface_pilling_math_op = '<';
                }

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

                $pdf->Cell(60,6,"Garments (Surface Pilling)", "1","0","l",0);
                $pdf->Cell(60,6,$appearance_after_washing_garments_surface_pilling_value, "1","0","C",0);
                $pdf->Cell(60,6,$appear_after_washing_garments_surface_pilling_math_op.' '.$appearance_after_washing_garments_surface_pilling_tolerance_val, "1","1","C",0);

            }
            if($row_for_defining_process['appearance_after_washing_garments_crease_after_ironing_max_value']<>0)
            {
                if($row_for_defining_process['appear_after_washing_garments_crease_after_ironing_math_op'] == '≥')
                {
                   $appear_after_washing_garments_crease_after_ironing_math_op = $pdf->Image('../img/greater_equal.png',162, $pdf->GetY()+2, 2).'';
                }
                else if($row_for_defining_process['appear_after_washing_garments_crease_after_ironing_math_op'] == '≤')
                {
                   $appear_after_washing_garments_crease_after_ironing_math_op = $pdf->Image('../img/less_equal.png',162, $pdf->GetY()+2, 2).'';
                }
                else if($row_for_defining_process['appear_after_washing_garments_crease_after_ironing_math_op'] == '>')
                {
                   $appear_after_washing_garments_crease_after_ironing_math_op = '>';
                }
                else if($row_for_defining_process['appear_after_washing_garments_crease_after_ironing_math_op'] == '<')
                {
                   $appear_after_washing_garments_crease_after_ironing_math_op = '<';
                }

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

                $pdf->Cell(60,6,"Garments (Crease After Ironing)", "1","0","l",0);
                $pdf->Cell(60,6,$appearance_after_washing_garments_crease_after_ironing_value, "1","0","C",0);
                $pdf->Cell(60,6,$appear_after_washing_garments_crease_after_ironing_math_op.' '.$appear_after_washing_garments_crease_after_ironing_tolerance_val, "1","1","C",0);

            }
            if($row_for_defining_process['appearance_after_washing_garments_abrasive_mark']<>'')
            {
                $pdf->Cell(60,6,"Garments (Abrasive Mark)", "1","0","l",0);
                $pdf->Cell(60,6,$row_for_qc['appearance_after_washing_garments_abrasive_mark_value'], "1","0","C",0);
                $pdf->Cell(60,6,$row_for_defining_process['appearance_after_washing_garments_abrasive_mark'], "1","1","C",0);

            }
            if($row_for_defining_process['seam_breakdown_garments']<>0)
            {
                $pdf->Cell(60,6,"Garments (Seam Breakdown)", "1","0","l",0);
                $pdf->Cell(60,6,$row_for_qc['appearance_after_washing_garments_seam_breakdown_value'], "1","0","C",0);
                $pdf->Cell(60,6,$row_for_defining_process['seam_breakdown_garments'], "1","1","C",0);

            }
            if($row_for_defining_process['appear_after_washing_garments_seam_pucker_rop_iron_max_value']<>0)
            {
                if($row_for_defining_process['appear_after_wash_garments_seam_pucker_rop_iron_math_op'] == '≥')
                {
                   $appear_after_wash_garments_seam_pucker_rop_iron_math_op = $pdf->Image('../img/greater_equal.png',162, $pdf->GetY()+2, 2).'';
                }
                else if($row_for_defining_process['appear_after_wash_garments_seam_pucker_rop_iron_math_op'] == '≤')
                {
                   $appear_after_wash_garments_seam_pucker_rop_iron_math_op = $pdf->Image('../img/less_equal.png',162, $pdf->GetY()+2, 2).'';
                }
                else if($row_for_defining_process['appear_after_wash_garments_seam_pucker_rop_iron_math_op'] == '>')
                {
                   $appear_after_wash_garments_seam_pucker_rop_iron_math_op = '>';
                }
                else if($row_for_defining_process['appear_after_wash_garments_seam_pucker_rop_iron_math_op'] == '<')
                {
                   $appear_after_wash_garments_seam_pucker_rop_iron_math_op = '<';
                }

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

                $pdf->Cell(60,6,"Garments (Seam puckering or roping After Iron)", "1","0","l",0);
                $pdf->Cell(60,6,$appearance_after_washing_garments_seam_puckering_roping_after_ir, "1","0","C",0);
                $pdf->Cell(60,6,$appear_after_wash_garments_seam_pucker_rop_iron_math_op.' '.$appear_after_washing_garments_seam_pucker_rop_iron_toler_value, "1","1","C",0);

            }

            if($row_for_defining_process['detachment_of_interlinings_fused_components_garments']<>'' && $row_for_qc['appearance_after_washing_garments_detachment_of_interlining_valu']<>'')
            {
                $pdf->Cell(60,6,"Garments (Detachment of interlinings / fused components)", "1","0","l",0);
                $pdf->Cell(60,6,$row_for_qc['appearance_after_washing_garments_detachment_of_interlining_valu'], "1","0","C",0);
                $pdf->Cell(60,6,$row_for_defining_process['detachment_of_interlinings_fused_components_garments'], "1","1","C",0);

            }
            if($row_for_defining_process['change_id_handle_or_appearance']<>'' && $row_for_qc['appearance_after_washing_garments_change_in_handle_value']<>'')
            {
                $pdf->Cell(60,6,"Garments (Change in handle or appearance)", "1","0","l",0);
                $pdf->Cell(60,6,$row_for_qc['appearance_after_washing_garments_change_in_handle_value'], "1","0","C",0);
                $pdf->Cell(60,6,$row_for_defining_process['change_id_handle_or_appearance'], "1","1","C",0);

            }

            if($row_for_defining_process['effect_on_accessories_such_as_buttons']<>'' && $row_for_qc['appearance_after_washing_garments_effect_accessories_value']<>'')
            {
                $pdf->Cell(60,6,"Garments (Effect on accessories such as buttons, zips etc.)", "1","0","l",0);
                $pdf->Cell(60,6,$row_for_qc['appearance_after_washing_garments_effect_accessories_value'], "1","0","C",0);
                $pdf->Cell(60,6,$row_for_defining_process['effect_on_accessories_such_as_buttons'], "1","1","C",0);

            }

            if($row_for_defining_process['appearance_after_washing_garments_spirality_max_value']<>0 && $row_for_qc['appearance_after_washing_garments_spirality_value']<>0)
            {
                $pdf->Cell(60,6,"Garments (Spirality (%))", "1","0","l",0);
                $pdf->Cell(60,6,$row_for_qc['appearance_after_washing_garments_spirality_value'], "1","0","C",0);
                $pdf->Cell(60,6,$row_for_defining_process['appearance_after_washing_garments_spirality_min_value'], "1","1","C",0);

            }
            if($row_for_defining_process['detachment_or_fraying_of_ribbons']<>'' && $row_for_qc['appearance_after_washing_garments_detachment_or_fraying_of_ribbo']<>'')
            {
                $pdf->Cell(60,6,"Garments (Detachment or Fraying of ribbons / trims)", "1","0","l",0);
                $pdf->Cell(60,6,$row_for_qc['appearance_after_washing_garments_detachment_or_fraying_of_ribbo'], "1","0","C",0);
                $pdf->Cell(60,6,$row_for_defining_process['detachment_or_fraying_of_ribbons'], "1","1","C",0);

            }
            if($row_for_defining_process['loss_of_print_garments']<>'' && $row_for_qc['appearance_after_washing_garments_loss_of_print_value']<>'')
            {
                $pdf->Cell(60,6,"Garments (Loss of Print)", "1","0","l",0);
                $pdf->Cell(60,6,$row_for_qc['appearance_after_washing_garments_loss_of_print_value'], "1","0","C",0);
                $pdf->Cell(60,6,$row_for_defining_process['loss_of_print_garments'], "1","1","C",0);

            }
            if($row_for_defining_process['care_level_garments']<>'' && $row_for_qc['appearance_after_washing_garments_care_level_value']<>'')
            {
                $pdf->Cell(60,6,"Garments (Care Level)", "1","0","l",0);
                $pdf->Cell(60,6,$row_for_qc['appearance_after_washing_garments_care_level_value'], "1","0","C",0);
                $pdf->Cell(60,6,$row_for_defining_process['care_level_garments'], "1","1","C",0);

            }
            if($row_for_defining_process['odor_garments']<>'' && $row_for_qc['appearance_after_washing_garments_odor_value']<>'')
            {
                $pdf->Cell(60,6,"Garments (Odor)", "1","0","l",0);
                $pdf->Cell(60,6,$row_for_qc['appearance_after_washing_garments_odor_value'], "1","0","C",0);
                $pdf->Cell(60,6,$row_for_defining_process['odor_garments'], "1","1","C",0);
                
            }
            if($row_for_defining_process['appearance_after_washing_other_observation_garments']<>'' && $row_for_qc['appearance_after_washing_other_observation_garments']<>'')
            {
                $pdf->Cell(60,6,"Garments (Other observation)", "1","0","l",0);
                $pdf->Cell(60,6,$row_for_qc['appearance_after_washing_other_observation_garments'], "1","0","C",0);
                $pdf->Cell(60,6,$row_for_defining_process['appearance_after_washing_other_observation_garments'], "1","1","C",0);
                
            }
        }
            
        }
        $pdf->setLeftMargin(10);
        $pdf->SetFont('Arial','B',12);
// }     //End of while loop 

if (in_array($row['id'], ['4']))
    {
          
        $counter = $counter + 31; 

        if($counter>300)
        {
            $pdf->AddPage();
            $counter =30;
            $counter = $counter + 31;
            $pdf->SetLeftMargin(6);
        }

       if (($row_for_defining_process['no_of_threads_in_warp_max_value']<>0 && $row_for_qc_supplimentery['no_of_threads_in_warp_value']<>0) || ($row_for_defining_process['no_of_threads_in_weft_max_value']<>0 && $row_for_qc_supplimentery['no_of_threads_in_weft_value']<>0) ) 
        {

            $content_no_of_thread_warp = urlencode($row_for_defining_process['no_of_threads_in_warp_tolerance_range_math_operator']);

            $no_of_threads_in_warp_tolerance_range_math_operator = urldecode($pdf->sp_character($content_no_of_thread_warp));
            
            $content_no_of_thread_weft = urlencode($row_for_defining_process['no_of_threads_in_weft_tolerance_range_math_operator']);

            $no_of_threads_in_weft_tolerance_range_math_operator = urldecode($pdf->sp_character($content_no_of_thread_weft));

            
            $serial+=1;
            $pdf->Ln(6);
            $pdf->SetLeftMargin(10);
            $pdf->Cell(10,5,$serial.".", "0", "0","L");
            $pdf->Cell(190,5,$row['test_name_method']." : ", "0", "1","L");
            $pdf->Ln(2);
            $pdf->setLeftMargin(17);
            $pdf->SetFont('Arial','B',10);
            $pdf->Cell(120,6," Result", "1","0","C",0);
            $pdf->Cell(60,6," Requirements ", "1","1","C",0);
            $pdf->SetFont('Arial','',10);
            $pdf->Cell(60,6," EPI ", "1","0","C",0);
            $pdf->Cell(60,6,$row_for_qc_supplimentery['no_of_threads_in_warp_value'].' ' .$row_for_defining_process['uom_of_no_of_threads_in_warp_value'], "1","0","C",0);
            $pdf->Cell(60,6,$row_for_defining_process['no_of_threads_in_warp_value'].' ' .$row_for_defining_process['uom_of_no_of_threads_in_warp_value']." (".$no_of_threads_in_warp_tolerance_range_math_operator.' '.$row_for_defining_process['no_of_threads_in_warp_tolerance_value']."%)", "1","1","C",0);
            
            $pdf->Cell(60,6," PPI", "1","0","C",0);
            $pdf->Cell(60,6,$row_for_qc_supplimentery['no_of_threads_in_weft_value'].' ' .$row_for_defining_process['uom_of_no_of_threads_in_weft_value'], "1","0","C",0);
            $pdf->Cell(60,6,$row_for_defining_process['no_of_threads_in_weft_value'].' ' .$row_for_defining_process['uom_of_no_of_threads_in_weft_value']." (".$no_of_threads_in_weft_tolerance_range_math_operator.' '.$row_for_defining_process['no_of_threads_in_weft_tolerance_value']."%)", "1","1","C",0);
            
           
        }
        $pdf->setLeftMargin(10);
        $pdf->SetFont('Arial','B',12);
               

        }  /*End of if (in_array($row['id'], ['4']))*/

        if (in_array($row['id'], ['5']))
        {
            $counter = $counter + 25; 

            if($counter>300)
            {
                $pdf->AddPage();
                $counter =30;
                $counter = $counter + 25;
                $pdf->SetLeftMargin(6);
            }

           if ($row_for_defining_process['mass_per_unit_per_area_max_value']<>0 && $row_for_qc_supplimentery['mass_per_unit_per_area_value']<>0)
           {
            $content = urlencode('±');

            $mass_per_unit_plus_minus = urldecode($pdf->sp_character($content));

            $serial+=1;
            if($row_for_defining_process['mass_per_unit_per_area_tolerance_range_math_operator'] == $row_for_defining_process['mass_per_unit_per_area_tolerance_value'])
                {
                    $pdf->Ln(6);
                    $pdf->SetLeftMargin(10);
                    $pdf->Cell(10,5,$serial.".", "0", "0","L");
                    $pdf->Cell(190,5,$row['test_name_method']." : ", "0", "1","L");
                    $pdf->Ln(2);
                    $pdf->setLeftMargin(17);
                    $pdf->SetFont('Arial','B',10);
                    $pdf->Cell(120,6," Result (g/m2)", "1","0","C",0);
                    $pdf->Cell(60,6," Requirements ", "1","1","C",0);
                    $pdf->SetFont('Arial','',10);
                    $pdf->Cell(120,6,$row_for_qc_supplimentery['mass_per_unit_per_area_value'], "1","0","C",0);
                    $pdf->Cell(60,6,$row_for_defining_process['mass_per_unit_per_area_value'].' '.$row_for_defining_process['uom_of_mass_per_unit_per_area_value'].'  ('.$mass_per_unit_plus_minus.' '.$row_for_defining_process['mass_per_unit_per_area_tolerance_value']."%)", "1","1","C",0);
                    
                }
                else
                {
                    $pdf->Ln(6);
                    $pdf->SetLeftMargin(10);
                    $pdf->Cell(10,5,$serial.".", "0", "0","L");
                    $pdf->Cell(190,5,$row['test_name_method']." : ", "0", "1","L");
                    $pdf->Ln(2);
                    $pdf->setLeftMargin(17);
                    $pdf->SetFont('Arial','B',10);
                    $pdf->Cell(120,6," Result (g/m2)", "1","0","C",0);
                    $pdf->Cell(60,6," Requirements ", "1","1","C",0);
                    $pdf->SetFont('Arial','',10);
                    $pdf->Cell(120,6,$row_for_qc_supplimentery['mass_per_unit_per_area_value'], "1","0","C",0);
                    $pdf->Cell(60,6,$row_for_defining_process['mass_per_unit_per_area_value'].' '.$row_for_defining_process['uom_of_mass_per_unit_per_area_value'].'  (+'.$row_for_defining_process['mass_per_unit_per_area_tolerance_range_math_operator'].'% / -'.$row_for_defining_process['mass_per_unit_per_area_tolerance_value']."%)", "1","1","C",0);
                    
                }
           
          
        }
        $pdf->setLeftMargin(10);
        $pdf->SetFont('Arial','B',12);
              
        }  /*End of if (in_array($row['id'], ['5']))*/

        if (in_array($row['id'], ['6']))
        {
            
           
           if ($row_for_defining_process['surface_fuzzing_and_pilling_max_value']<>0 && $row_for_qc['surface_fuzzing_and_pilling_value']<>0)
           {

           


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
        $counter = $counter + 25; 

        if($counter>300)
        {
            $pdf->AddPage();
            $counter =30;
            $counter = $counter + 25;
            $pdf->SetLeftMargin(6);
        }

         

            $serial+=1;
            $pdf->Ln(6);
            $pdf->SetLeftMargin(10);
            $pdf->Cell(10,5,$serial.".", "0", "0","L");
            $pdf->Cell(190,5,$row['test_name_method']." : ", "0", "1","L");
            $pdf->Ln(2);
            $pdf->setLeftMargin(17);
            $pdf->SetFont('Arial','B',10);
            $pdf->Cell(120,6," Result", "1","0","C",0);
            $pdf->Cell(60,6," Requirements ", "1","1","C",0);
            $pdf->SetFont('Arial','',10);
            $pdf->Cell(120,6,$surface_fuzzing_and_pilling_value, "1","0","C",0);

            if($row_for_defining_process['surface_fuzzing_and_pilling_tolerance_range_math_operator'] == '≥')
            {
               $pdf->Cell(60,6,$pdf->Image('../img/greater_equal.png',162, $pdf->GetY()+2, 2).' '.($surface_fuzzing_and_pilling_tolerance_value)."", "1","1","C",0);

            }
            else if($row_for_defining_process['surface_fuzzing_and_pilling_tolerance_range_math_operator'] == '≤')
            {
               $pdf->Cell(60,6,$pdf->Image('../img/less_equal.png',162, $pdf->GetY()+2, 2).' '.($surface_fuzzing_and_pilling_tolerance_value)."", "1","1","C",0);

            }
            else if($row_for_defining_process['surface_fuzzing_and_pilling_tolerance_range_math_operator'] == '>')
            {
               $pdf->Cell(60,6,'>'.' '.($surface_fuzzing_and_pilling_tolerance_value)."", "1","1","C",0);

            }
            else if($row_for_defining_process['surface_fuzzing_and_pilling_tolerance_range_math_operator'] == '<')
            {
               $pdf->Cell(60,6,'<'.' '.($surface_fuzzing_and_pilling_tolerance_value)."", "1","1","C",0);
            }
        }
        $pdf->setLeftMargin(10);
        $pdf->SetFont('Arial','B',12);
          
        }  /*End of if (in_array($row['id'], ['6']))*/

        if (in_array($row['id'], ['7']))
        {
                                
            if ($row_for_defining_process['tensile_properties_in_warp_value_max_value']<>0 && $row_for_qc['tensile_properties_in_weft_value']<>0) 
            {
                
               

                $counter = $counter + 31; 

                if($counter>300)
                {
                    $pdf->AddPage();
                    $counter =30;
                    $counter = $counter + 31;
                    $pdf->SetLeftMargin(6);
                }

                $serial+=1;
                $pdf->Ln(6);
                $pdf->SetLeftMargin(10);
                $pdf->Cell(10,5,$serial.".", "0", "0","L");
                $pdf->Cell(190,5,$row['test_name_method']." : ", "0", "1","L");
                $pdf->Ln(2);
                $pdf->setLeftMargin(17);
                $pdf->SetFont('Arial','B',10);
                $pdf->Cell(120,6," Result", "1","0","C",0);
                $pdf->Cell(60,6," Requirements ", "1","1","C",0);
                $pdf->SetFont('Arial','',10);
                $pdf->Cell(60,6," Warp ", "1","0","C",0);
                $pdf->Cell(60,6,$row_for_qc['tensile_properties_in_warp_value'].' ' .$row_for_defining_process['uom_of_tensile_properties_in_warp_value'], "1","0","C",0);

                if($row_for_defining_process['tensile_properties_in_warp_value_tolerance_range_math_operator'] == '≥')
                {
                   $pdf->Cell(60,6,$pdf->Image('../img/greater_equal.png',158, $pdf->GetY()+2, 2).' '.$row_for_defining_process['tensile_properties_in_warp_value_tolerance_value'].' ' .$row_for_defining_process['uom_of_tensile_properties_in_warp_value'], "1","1","C",0);
    
                }
                else if($row_for_defining_process['tensile_properties_in_warp_value_tolerance_range_math_operator'] == '≤')
                {
                   $pdf->Cell(60,6,$pdf->Image('../img/less_equal.png',158, $pdf->GetY()+2, 2).' '.$row_for_defining_process['tensile_properties_in_warp_value_tolerance_value'].' ' .$row_for_defining_process['uom_of_tensile_properties_in_warp_value'], "1","1","C",0);
    
                }
                else if($row_for_defining_process['tensile_properties_in_warp_value_tolerance_range_math_operator'] == '>')
                {
                   $pdf->Cell(60,6,'>'.' '.$row_for_defining_process['tensile_properties_in_warp_value_tolerance_value'].' ' .$row_for_defining_process['uom_of_tensile_properties_in_warp_value'], "1","1","C",0);
    
                }
                else if($row_for_defining_process['tensile_properties_in_warp_value_tolerance_range_math_operator'] == '<')
                {
                   $pdf->Cell(60,6,'<'.' '.$row_for_defining_process['tensile_properties_in_warp_value_tolerance_value'].' ' .$row_for_defining_process['uom_of_tensile_properties_in_warp_value'], "1","1","C",0);
                }

                $pdf->Cell(60,6," Weft", "1","0","C",0);
                $pdf->Cell(60,6,$row_for_qc['tensile_properties_in_weft_value'].' ' .$row_for_defining_process['uom_of_tensile_properties_in_weft_value'], "1","0","C",0);
                
                if($row_for_defining_process['tensile_properties_in_warp_value_tolerance_range_math_operator'] == '≥')
                {
                   $pdf->Cell(60,6,$pdf->Image('../img/greater_equal.png',158, $pdf->GetY()+2, 2).' '.$row_for_defining_process['tensile_properties_in_weft_value_tolerance_value'].' ' .$row_for_defining_process['uom_of_tensile_properties_in_weft_value'], "1","1","C",0);
    
                }
                else if($row_for_defining_process['tensile_properties_in_warp_value_tolerance_range_math_operator'] == '≤')
                {
                   $pdf->Cell(60,6,$pdf->Image('../img/less_equal.png',158, $pdf->GetY()+2, 2).' '.$row_for_defining_process['tensile_properties_in_weft_value_tolerance_value'].' ' .$row_for_defining_process['uom_of_tensile_properties_in_weft_value'], "1","1","C",0);
    
                }
                else if($row_for_defining_process['tensile_properties_in_warp_value_tolerance_range_math_operator'] == '>')
                {
                   $pdf->Cell(60,6,'>'.' '.$row_for_defining_process['tensile_properties_in_weft_value_tolerance_value'].' ' .$row_for_defining_process['uom_of_tensile_properties_in_weft_value'], "1","1","C",0);
    
                }
                else if($row_for_defining_process['tensile_properties_in_warp_value_tolerance_range_math_operator'] == '<')
                {
                   $pdf->Cell(60,6,'<'.' '.$row_for_defining_process['tensile_properties_in_weft_value_tolerance_value'].' ' .$row_for_defining_process['uom_of_tensile_properties_in_weft_value'], "1","1","C",0);
                }
               
            }
            $pdf->setLeftMargin(10);
            $pdf->SetFont('Arial','B',12);
                
              

            } /*End of if (in_array($row['id'], ['7']))*/

            if (in_array($row['id'], ['8']))
            {
                                
                if ($row_for_defining_process['tear_force_in_warp_value_max_value']<>0 && $row_for_qc['tear_force_in_warp_value']<>0) 
                {


                                 $counter = $counter + 31; 

                                 if($counter>300)
                                 {
                                     $pdf->AddPage();
                                     $counter =30;
                                     $counter = $counter + 31;
                                     $pdf->SetLeftMargin(6);
                                 }

                                    
                    $serial+=1;
                    $pdf->Ln(6);
                    $pdf->SetLeftMargin(10);
                    $pdf->Cell(10,5,$serial.".", "0", "0","L");
                    $pdf->Cell(190,5,$row['test_name_method']." : ", "0", "1","L");
                    $pdf->Ln(2);
                    $pdf->setLeftMargin(17);
                    $pdf->SetFont('Arial','B',10);
                    $pdf->Cell(120,6," Result", "1","0","C",0);
                    $pdf->Cell(60,6," Requirements ", "1","1","C",0);
                    $pdf->SetFont('Arial','',10);
                    $pdf->Cell(60,6," Warp ", "1","0","C",0);
                    $pdf->Cell(60,6,$row_for_qc['tear_force_in_warp_value'].' ' .$row_for_defining_process['uom_of_tear_force_in_warp_value'], "1","0","C",0);
                    if($row_for_defining_process['tear_force_in_warp_value_tolerance_range_math_operator'] == '≥')
                    {
                       $tear_force_in_warp_value_tolerance_range_math_operator = $pdf->Image('../img/greater_equal.png',158, $pdf->GetY()+2, 2).'';
                       $pdf->Cell(60,6,$tear_force_in_warp_value_tolerance_range_math_operator.' '.$row_for_defining_process['tear_force_in_warp_value_tolerance_value'].' ' .$row_for_defining_process['uom_of_tear_force_in_warp_value'], "1","1","C",0);

                    }
                    else if($row_for_defining_process['tear_force_in_warp_value_tolerance_range_math_operator'] == '≤')
                    {
                       $tear_force_in_warp_value_tolerance_range_math_operator = $pdf->Image('../img/less_equal.png',158, $pdf->GetY()+2, 2).'';
                       $pdf->Cell(60,6,$tear_force_in_warp_value_tolerance_range_math_operator.' '.$row_for_defining_process['tear_force_in_warp_value_tolerance_value'].' ' .$row_for_defining_process['uom_of_tear_force_in_warp_value'], "1","1","C",0);

                    }
                    else if($row_for_defining_process['tear_force_in_warp_value_tolerance_range_math_operator'] == '>')
                    {
                       $tear_force_in_warp_value_tolerance_range_math_operator = '>';
                       $pdf->Cell(60,6,$tear_force_in_warp_value_tolerance_range_math_operator.' '.$row_for_defining_process['tear_force_in_warp_value_tolerance_value'].' ' .$row_for_defining_process['uom_of_tear_force_in_warp_value'], "1","1","C",0);

                    }
                    else if($row_for_defining_process['tear_force_in_warp_value_tolerance_range_math_operator'] == '<')
                    {
                       $tear_force_in_warp_value_tolerance_range_math_operator = '<';
                       $pdf->Cell(60,6,$tear_force_in_warp_value_tolerance_range_math_operator.' '.$row_for_defining_process['tear_force_in_warp_value_tolerance_value'].' ' .$row_for_defining_process['uom_of_tear_force_in_warp_value'], "1","1","C",0);

                    }

                    $pdf->Cell(60,6," Weft", "1","0","C",0);
                    $pdf->Cell(60,6,$row_for_qc['tear_force_in_weft_value'].' ' .$row_for_defining_process['uom_of_tear_force_in_weft_value'], "1","0","C",0);
                    if($row_for_defining_process['tear_force_in_weft_value_tolerance_range_math_operator'] == '≥')
                    {
                        $tear_force_in_weft_value_tolerance_range_math_operator = $pdf->Image('../img/greater_equal.png',158, $pdf->GetY()+2, 2).'';
                        $pdf->Cell(60,6,$tear_force_in_weft_value_tolerance_range_math_operator.' '.$row_for_defining_process['tear_force_in_weft_value_tolerance_value'].' ' .$row_for_defining_process['uom_of_tear_force_in_weft_value'], "1","1","C",0);

                    }
                    else if($row_for_defining_process['tear_force_in_weft_value_tolerance_range_math_operator'] == '≤')
                    {
                        $tear_force_in_weft_value_tolerance_range_math_operator = $pdf->Image('../img/less_equal.png',158, $pdf->GetY()+2, 2).'';
                        $pdf->Cell(60,6,$tear_force_in_weft_value_tolerance_range_math_operator.' '.$row_for_defining_process['tear_force_in_weft_value_tolerance_value'].' ' .$row_for_defining_process['uom_of_tear_force_in_weft_value'], "1","1","C",0);

                    }
                    else if($row_for_defining_process['tear_force_in_weft_value_tolerance_range_math_operator'] == '>')
                    {
                        $tear_force_in_weft_value_tolerance_range_math_operator = '>';
                        $pdf->Cell(60,6,$tear_force_in_weft_value_tolerance_range_math_operator.' '.$row_for_defining_process['tear_force_in_weft_value_tolerance_value'].' ' .$row_for_defining_process['uom_of_tear_force_in_weft_value'], "1","1","C",0);

                    }
                    else if($row_for_defining_process['tear_force_in_weft_value_tolerance_range_math_operator'] == '<')
                    {
                        $tear_force_in_weft_value_tolerance_range_math_operator = '<';
                        $pdf->Cell(60,6,$tear_force_in_weft_value_tolerance_range_math_operator.' '.$row_for_defining_process['tear_force_in_weft_value_tolerance_value'].' ' .$row_for_defining_process['uom_of_tear_force_in_weft_value'], "1","1","C",0);

                    }
                   
                }
                $pdf->setLeftMargin(10);
                $pdf->SetFont('Arial','B',12);

                                   
            } /*End of if (in_array($row['id'], ['8']))*/

            if (in_array($row['id'], ['9']))
            {
               
               if (($row_for_defining_process['seam_slippage_resistance_in_warp_max_value']<>0 && $row_for_qc['seam_slippage_resistance_in_warp_value']<>0) || ($row_for_defining_process['seam_slippage_resistance_in_weft_max_value']<>0 && $row_for_qc['seam_slippage_resistance_in_weft_value'])<>0 )
               {

                $counter = $counter + 31; 

                if($counter>300)
                {
                    $pdf->AddPage();
                    $counter =30;
                    $counter = $counter + 31;
                    $pdf->SetLeftMargin(6);
                }

                $serial+=1;
                $pdf->Ln(6);
                $pdf->SetLeftMargin(10);
                $pdf->Cell(10,5,$serial.".", "0", "0","L");
                $pdf->Cell(190,5,$row['test_name_method']." : ", "0", "1","L");
                $pdf->Ln(2);
                $pdf->setLeftMargin(17);
                $pdf->SetFont('Arial','B',10);
                $pdf->Cell(120,6," Result", "1","0","C",0);
                $pdf->Cell(60,6," Requirements ", "1","1","C",0);
                $pdf->SetFont('Arial','',10);
                $pdf->Cell(60,6," Warp ", "1","0","C",0);
                $pdf->Cell(60,6,$row_for_qc['seam_slippage_resistance_in_warp_value'].' '.$row_for_defining_process['uom_of_seam_slippage_resistance_in_warp'], "1","0","C",0);
                $pdf->Cell(60,6,$row_for_defining_process['seam_slippage_resistance_in_warp_tolerance_range_math_operator'].' '.$row_for_defining_process['seam_slippage_resistance_in_warp_tolerance_value'].' '.$row_for_defining_process['uom_of_seam_slippage_resistance_in_warp'], "1","1","C",0);
                
                $pdf->Cell(60,6," Weft", "1","0","C",0);
                $pdf->Cell(60,6,$row_for_qc['seam_slippage_resistance_in_weft_value'].' '.$row_for_defining_process['uom_of_seam_slippage_resistance_in_weft'], "1","0","C",0);
                $pdf->Cell(60,6,$row_for_defining_process['seam_slippage_resistance_in_weft_tolerance_range_math_operator'].' '.$row_for_defining_process['seam_slippage_resistance_in_weft_tolerance_value'].' '.$row_for_defining_process['uom_of_seam_slippage_resistance_in_weft'], "1","1","C",0);
                
               
            }
            $pdf->setLeftMargin(10);
            $pdf->SetFont('Arial','B',12);
                  

            } /*End of if (in_array($row['id'], ['9']))*/

            if (in_array($row['id'], ['9']))
            {
                

                 
           if (($row_for_defining_process['seam_slippage_resistance_iso_2_in_warp_max_value']<>0 && $row_for_qc['seam_slippage_resistance_iso_2_in_warp_value']<>0) || ($row_for_defining_process['seam_slippage_resistance_iso_2_in_weft_max_value']<>0 && $row_for_qc['seam_slippage_resistance_iso_2_in_weft_value'])<>0)
               {
                $counter = $counter + 31; 

                if($counter>300)
                {
                    $pdf->AddPage();
                    $counter =30;
                    $counter = $counter + 31;
                    $pdf->SetLeftMargin(6);
                }
                $serial+=1;
                $pdf->Ln(6);
                $pdf->SetLeftMargin(10);
                $pdf->Cell(10,5,$serial.".", "0", "0","L");
                $pdf->Cell(190,5,$row['test_name_method']." : ", "0", "1","L");
                $pdf->Ln(2);
                $pdf->setLeftMargin(17);
                $pdf->SetFont('Arial','B',10);
                $pdf->Cell(120,6," Result", "1","0","C",0);
                $pdf->Cell(60,6," Requirements ", "1","1","C",0);
                $pdf->SetFont('Arial','',10);
                $pdf->Cell(60,6," Warp ", "1","0","C",0);
                $pdf->Cell(60,6,$row_for_qc['seam_slippage_resistance_iso_2_in_warp_value'].' '.$row_for_defining_process['uom_of_seam_slippage_resistance_iso_2_in_warp'], "1","0","C",0);
                $pdf->Cell(60,6,$row_for_defining_process['seam_slippage_resistance_iso_2_in_warp_tolerance_range_math_operator'].' '.$row_for_defining_process['seam_slippage_resistance_iso_2_in_warp_tolerance_value'].' '.$row_for_defining_process['uom_of_seam_slippage_resistance_iso_2_in_warp'], "1","1","C",0);
                
                $pdf->Cell(60,6," Weft", "1","0","C",0);
                $pdf->Cell(60,6,$row_for_qc['seam_slippage_resistance_iso_2_in_weft_value'].' '.$row_for_defining_process['uom_of_seam_slippage_resistance_iso_2_in_weft'], "1","0","C",0);
                $pdf->Cell(60,6,$row_for_defining_process['seam_slippage_resistance_iso_2_in_weft_tolerance_range_math_operator'].' '.$row_for_defining_process['seam_slippage_resistance_iso_2_in_weft_tolerance_value'].' '.$row_for_defining_process['uom_of_seam_slippage_resistance_iso_2_in_weft'], "1","1","C",0);
                
            }
            $pdf->setLeftMargin(10);
            $pdf->SetFont('Arial','B',12);
                  
            } /*End of if (in_array($row['id'], ['9']))*/

            if (in_array($row['id'], ['11']))
            {
                

               if (($row_for_defining_process['seam_strength_in_warp_value_max_value']<>0 && $row_for_qc['seam_strength_in_warp_value']<>0) || ($row_for_defining_process['seam_strength_in_weft_value_max_value']<>0 && $row_for_qc['seam_strength_in_weft_value']<>0) ) 
               {

                $counter = $counter + 31; 

                if($counter>300)
                {
                    $pdf->AddPage();
                    $counter =30;
                    $counter = $counter + 31;
                    $pdf->SetLeftMargin(6);
                }

                $serial+=1;
                $pdf->Ln(6);
                $pdf->SetLeftMargin(10);
                $pdf->Cell(10,5,$serial.".", "0", "0","L");
                $pdf->Cell(190,5,$row['test_name_method']." : ", "0", "1","L");
                $pdf->Ln(2);
                $pdf->setLeftMargin(17);
                $pdf->SetFont('Arial','B',10);
                $pdf->Cell(120,6," Result", "1","0","C",0);
                $pdf->Cell(60,6," Requirements ", "1","1","C",0);
                $pdf->SetFont('Arial','',10);
                $pdf->Cell(60,6," Warp ", "1","0","C",0);
                $pdf->Cell(60,6,$row_for_qc['seam_strength_in_warp_value'].' '.$row_for_defining_process['uom_of_seam_strength_in_warp_value'], "1","0","C",0);
                $pdf->Cell(60,6,$row_for_defining_process['seam_strength_in_warp_value_tolerance_range_math_operator'].' '.$row_for_defining_process['seam_strength_in_warp_value_tolerance_value'].' '.$row_for_defining_process['uom_of_seam_strength_in_warp_value'], "1","1","C",0);
                
                $pdf->Cell(60,6," Weft", "1","0","C",0);
                $pdf->Cell(60,6,$row_for_qc['seam_strength_in_weft_value'].' '.$row_for_defining_process['uom_of_seam_strength_in_weft_value'], "1","0","C",0);
                $pdf->Cell(60,6,$row_for_defining_process['seam_strength_in_weft_value_tolerance_range_math_operator'].' '.$row_for_defining_process['seam_strength_in_weft_value_tolerance_value'].' '.$row_for_defining_process['uom_of_seam_strength_in_weft_value'], "1","1","C",0);
                
            }
            $pdf->setLeftMargin(10);
            $pdf->SetFont('Arial','B',12);
                  
            } /*End of if (in_array($row['id'], ['11']))*/

            if (in_array($row['id'], ['12']))
            {
                


               if (($row_for_defining_process['seam_properties_seam_slippage_iso_astm_d_in_warp_max_value']<>0 && $row_for_qc['seam_properties_seam_slippage_iso_astm_d_in_warp_value']<>0) ||($row_for_defining_process['seam_properties_seam_slippage_iso_astm_d_in_weft_max_value']<>0 && $row_for_qc['seam_properties_seam_slippage_iso_astm_d_in_weft_value']) )
               {
                $counter = $counter + 43; 

                if($counter>300)
                {
                    $pdf->AddPage();
                    $counter =30;
                    $counter = $counter + 43;
                    $pdf->SetLeftMargin(6);
                }

                $serial+=1;
                $pdf->Ln(6);
                $pdf->SetLeftMargin(10);
                $pdf->Cell(10,5,$serial.".", "0", "0","L");
                $pdf->Cell(190,5,$row['test_name_method']." : ", "0", "1","L");
                $pdf->Ln(2);
                $pdf->setLeftMargin(17);
                $pdf->SetFont('Arial','B',10);
                $pdf->Cell(120,6," Result", "1","0","C",0);
                $pdf->Cell(60,6," Requirements ", "1","1","C",0);
                $pdf->SetFont('Arial','',10);
                $pdf->Cell(60,6," Warp ", "1","0","C",0);
                $pdf->Cell(60,6,$row_for_qc['seam_properties_seam_slippage_iso_astm_d_in_warp_value'].' '.$row_for_defining_process['uom_of_seam_properties_seam_slippage_iso_astm_d_in_warp'], "1","0","C",0);
                $pdf->Cell(60,6,$row_for_defining_process['seam_properties_seam_slippage_iso_astm_d_in_warp_tol_range_mt_op'].' '.$row_for_defining_process['seam_properties_seam_slippage_iso_astm_d_in_warp_tolerance_value'].' '.$row_for_defining_process['uom_of_seam_properties_seam_slippage_iso_astm_d_in_warp'], "1","1","C",0);
                
                $pdf->Cell(60,6," Weft", "1","0","C",0);
                $pdf->Cell(60,6,$row_for_qc['seam_properties_seam_slippage_iso_astm_d_in_weft_value'].' '.$row_for_defining_process['uom_of_seam_properties_seam_slippage_iso_astm_d_in_weft'], "1","0","C",0);
                $pdf->Cell(60,6,$row_for_defining_process['seam_properties_seam_slippage_iso_astm_d_in_weft_tol_range_mt_op'].' '.$row_for_defining_process['seam_properties_seam_slippage_iso_astm_d_in_weft_tolerance_value'].' '.$row_for_defining_process['uom_of_seam_properties_seam_slippage_iso_astm_d_in_weft'], "1","1","C",0);
                
                $pdf->Cell(60,6," Warp ", "1","0","C",0);
                $pdf->Cell(60,6,$row_for_qc['seam_properties_seam_strength_iso_astm_d_in_warp_value'].' '.$row_for_defining_process['uom_of_seam_properties_seam_strength_iso_astm_d_in_warp'], "1","0","C",0);
                $pdf->Cell(60,6,$row_for_defining_process['seam_properties_seam_strength_iso_astm_d_in_warp_tol_range_op'].' '.$row_for_defining_process['seam_properties_seam_strength_iso_astm_d_in_warp_tolerance_value'].' '.$row_for_defining_process['uom_of_seam_properties_seam_strength_iso_astm_d_in_warp'], "1","1","C",0);
                
                $pdf->Cell(60,6," Weft", "1","0","C",0);
                $pdf->Cell(60,6,$row_for_qc['seam_properties_seam_strength_iso_astm_d_in_weft_value'].' '.$row_for_defining_process['uom_of_seam_properties_seam_strength_iso_astm_d_in_weft'], "1","0","C",0);
                $pdf->Cell(60,6,$row_for_defining_process['seam_properties_seam_strength_iso_astm_d_in_weft_tol_range_op'].' '.$row_for_defining_process['seam_properties_seam_strength_iso_astm_d_in_weft_tolerance_value'].' '.$row_for_defining_process['uom_of_seam_properties_seam_strength_iso_astm_d_in_weft'], "1","1","C",0);
                
            }
            $pdf->setLeftMargin(10);
            $pdf->SetFont('Arial','B',12);
      

            } /*End of if (in_array($row['id'], ['12']))*/

            if (in_array($row['id'], ['13']))
            {
               
               if (($row_for_defining_process['abrasion_resistance_no_of_thread_break_max_value']<>0 && $row_for_qc['abrasion_resistance_no_of_thread_break_value']<>0) || ($row_for_defining_process['abrasion_resistance_c_change_max_value']<>0 && $row_for_qc['abrasion_resistance_c_change_value']<>0) )  
               {


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

                $counter = $counter + 31; 

                if($counter>300)
                {
                    $pdf->AddPage();
                    $counter =30;
                    $counter = $counter + 31;
                    $pdf->SetLeftMargin(6);
                }


                $serial+=1;
                $pdf->Ln(6);
                $pdf->SetLeftMargin(10);
                $pdf->Cell(10,5,$serial.".", "0", "0","L");
                $pdf->Cell(190,5,$row['test_name_method']." : ", "0", "1","L");
                $pdf->Ln(2);
                $pdf->setLeftMargin(17);
                $pdf->SetFont('Arial','B',10);
                $pdf->Cell(120,6," Result", "1","0","C",0);
                $pdf->Cell(60,6," Requirements ", "1","1","C",0);
                $pdf->SetFont('Arial','',10);
                $pdf->Cell(60,6," No. of thread ", "1","0","C",0);
                $pdf->Cell(60,6,$row_for_qc['abrasion_resistance_no_of_thread_break_value'].' '.$row_for_defining_process['uom_of_abrasion_resistance_no_of_thread_break'], "1","0","C",0);
                $pdf->Cell(60,6,$row_for_defining_process['abrasion_resistance_no_of_thread_break_min_value'].' '.$row_for_defining_process['abrasion_resistance_no_of_thread_break_max_value'].' '.$row_for_defining_process['uom_of_seam_properties_seam_strength_iso_astm_d_in_weft'], "1","1","C",0);
                
                $pdf->Cell(60,6," Color Change", "1","0","C",0);
                $pdf->Cell(60,6,$abrasion_resistance_c_change_value.' '.$row_for_defining_process['uom_of_abrasion_resistance_c_change_value'], "1","0","C",0);
                $pdf->Cell(60,6,$row_for_defining_process['abrasion_resistance_c_change_value_math_op'].' '.$abrasion_resistance_c_change_value_tolerance_value.' '.$row_for_defining_process['uom_of_abrasion_resistance_c_change_value'], "1","1","C",0);
                
            }
            $pdf->setLeftMargin(10);
            $pdf->SetFont('Arial','B',12);
                 

            } /*End of if (in_array($row['id'], ['13']))*/

            if (in_array($row['id'], ['14']))
            {
                                
                 if ($row_for_defining_process['mass_loss_in_abrasion_test_value_max_value']<>0 && $row_for_qc['mass_loss_in_abrasion_value']<>0)
                {



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
                $counter = $counter + 25; 

                if($counter>300)
                {
                    $pdf->AddPage();
                    $counter =30;
                    $counter = $counter + 25;
                    $pdf->SetLeftMargin(6);
                }


                $serial+=1;
                $pdf->Ln(6);
                $pdf->SetLeftMargin(10);
                $pdf->Cell(10,5,$serial.".", "0", "0","L");
                $pdf->Cell(190,5,$row['test_name_method']." : ", "0", "1","L");
                $pdf->Ln(2);
                $pdf->setLeftMargin(17);
                $pdf->SetFont('Arial','B',10);
                $pdf->Cell(90,6," Result", "1","0","C",0);
                $pdf->Cell(90,6," Requirements ", "1","1","C",0);
                $pdf->SetFont('Arial','',10);
                $pdf->Cell(90,6,$mass_loss_in_abrasion_value.' '.$row_for_defining_process['uom_of_mass_loss_in_abrasion_test_value'], "1","0","C",0);
                $pdf->Cell(90,6,$row_for_defining_process['mass_loss_in_abrasion_test_value_tolerance_range_math_operator'].' '.$mass_loss_in_abrasion_test_value_tolerance_value.' '.$row_for_defining_process['uom_of_mass_loss_in_abrasion_test_value'], "1","1","C",0);
                
              
            }
            $pdf->setLeftMargin(10);
            $pdf->SetFont('Arial','B',12);
        
        }




                    // ----------------------------------id for cf_to_washing---------------------------
        if (in_array($row['id'], ['15','59']))
        {


            if ($row_for_defining_process['cf_to_washing_color_change_max_value']<>0 && $row_for_qc['cf_to_washing_color_change_value']<>0)
            {
                                

                                

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

                
                $counter = $counter + 37; 

                if($counter>300)
                    {
                        $pdf->AddPage();
                        $counter =30;
                        $counter = $counter + 37;
                        $pdf->SetLeftMargin(6);
                    }  

                $serial+=1;
                $pdf->Ln(6);
                $pdf->SetLeftMargin(10);
                $pdf->Cell(10,5,$serial.".", "0", "0","L");
                $pdf->Cell(190,5,$row['test_name_method']." : ", "0", "1","L");
                $pdf->Ln(2);
                $pdf->setLeftMargin(17);
                $pdf->SetFont('Arial','B',10);
                 $pdf->Cell(128,6," Result ", "1","0","C",0);
                $pdf->Cell(52,6," Requirements ", "1","1","C",0);
                $pdf->Cell(26,12," Color Change", "1","0","C",0);
                $pdf->Cell(102,6," Staining on to mulifiber ", "1","0","C",0);
                $pdf->Cell(26,12," Color Change ", "1","0","C",0);
                $pdf->Cell(26,12," Staining ", "1","0","C",0);
                $pdf->Cell(0,6," ", "0","1","C",0); //dummy cell for new line
                $pdf->Cell(26,6," ", "0","0","C",0);  // dummy cell for blank space
                $pdf->Cell(17,6," Acetate ", "1","0","C",0);
                $pdf->Cell(17,6," Cotton ", "1","0","C",0);
                $pdf->Cell(17,6," Mylon ", "1","0","C",0);
                $pdf->Cell(17,6," Polyester ", "1","0","C",0);
                $pdf->Cell(17,6," Acrylic ", "1","0","C",0);
                $pdf->Cell(17,6," Wool ", "1","0","C",0);
                $pdf->Cell(26,6," ", "0","0","C",0); // dummy cell for blank space
                $pdf->Cell(26,6," ", "0","0","C",0); // dummy cell for blank space
                $pdf->Cell(0,6," ", "0","1","C",0); //dummy cell for new line

                $pdf->SetFont('Arial','',10);
                $pdf->Cell(26,6,$cf_to_washing_color_change_value, "LBR","0","C",0);
                $pdf->Cell(17,6,$cf_to_washing_staining_value_for_acetate, "1","0","C",0);
                $pdf->Cell(17,6,$cf_to_washing_staining_value_for_cotton, "1","0","C",0);
                $pdf->Cell(17,6,$cf_to_washing_staining_value_for_mylon, "1","0","C",0);
                $pdf->Cell(17,6,$cf_to_washing_staining_value_for_polyester, "1","0","C",0);
                $pdf->Cell(17,6,$cf_to_washing_staining_value_for_acrylic, "1","0","C",0);
                $pdf->Cell(17,6,$cf_to_washing_staining_value_for_wool, "1","0","C",0);
                if($row_for_defining_process['cf_to_washing_color_change_tolerance_range_math_operator'] == '≥')
                {
                    $cf_to_washing_color_change_tolerance_range_math_operator = $pdf->Image('../img/greater_equal.png',153, $pdf->GetY()+2, 2).'';
                    $pdf->Cell(26,6,$cf_to_washing_color_change_tolerance_range_math_operator.' '.($cf_to_washing_color_change_tolerance_value), "LBR","0","C",0);

                }
                else if($row_for_defining_process['cf_to_washing_color_change_tolerance_range_math_operator'] == '≤')
                {
                    $cf_to_washing_color_change_tolerance_range_math_operator = $pdf->Image('../img/less_equal.png',153, $pdf->GetY()+2, 2).'';
                    $pdf->Cell(26,6,$cf_to_washing_color_change_tolerance_range_math_operator.' '.($cf_to_washing_color_change_tolerance_value), "LBR","0","C",0);

                }
                else if($row_for_defining_process['cf_to_washing_color_change_tolerance_range_math_operator'] == '>')
                {
                    $cf_to_washing_color_change_tolerance_range_math_operator = '>';
                    $pdf->Cell(26,6,$cf_to_washing_color_change_tolerance_range_math_operator.' '.($cf_to_washing_color_change_tolerance_value), "LBR","0","C",0);

                }
                else if($row_for_defining_process['cf_to_washing_color_change_tolerance_range_math_operator'] == '<')
                {
                    $cf_to_washing_color_change_tolerance_range_math_operator = '<';
                    $pdf->Cell(26,6,$cf_to_washing_color_change_tolerance_range_math_operator.' '.($cf_to_washing_color_change_tolerance_value), "LBR","0","C",0);

                }

                if($row_for_defining_process['cf_to_washing_staining_tolerance_range_math_operator'] == '≥')
                {
                    $cf_to_washing_staining_tolerance_range_math_operator = $pdf->Image('../img/greater_equal.png',153, $pdf->GetY()+2, 2).'';
                    $pdf->Cell(26,6,$cf_to_washing_staining_tolerance_range_math_operator.' '.($cf_to_washing_staining_tolerance_value), "LBR","1","C",0);

                }
                else if($row_for_defining_process['cf_to_washing_staining_tolerance_range_math_operator'] == '≤')
                {
                    $cf_to_washing_staining_tolerance_range_math_operator = $pdf->Image('../img/less_equal.png',153, $pdf->GetY()+2, 2).'';
                    $pdf->Cell(26,6,$cf_to_washing_staining_tolerance_range_math_operator.' '.($cf_to_washing_staining_tolerance_value), "LBR","1","C",0);

                }
                else if($row_for_defining_process['cf_to_washing_staining_tolerance_range_math_operator'] == '>')
                {
                    $cf_to_washing_staining_tolerance_range_math_operator = '>';
                    $pdf->Cell(26,6,$cf_to_washing_staining_tolerance_range_math_operator.' '.($cf_to_washing_staining_tolerance_value), "LBR","1","C",0);

                }
                else if($row_for_defining_process['cf_to_washing_staining_tolerance_range_math_operator'] == '<')
                {
                    $cf_to_washing_staining_tolerance_range_math_operator = '<';
                    $pdf->Cell(26,6,$cf_to_washing_staining_tolerance_range_math_operator.' '.($cf_to_washing_staining_tolerance_value), "LBR","1","C",0);

                }
            }

             $pdf->setLeftMargin(10);
             $pdf->SetFont('Arial','B',12);

        }  /*End of if (in_array($row['id'], ['15','59']))*/
        

                // --------------------------id for cf to dry cleaning-------------------------------------
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
            $counter = $counter + 37; 

            if($counter>300)
                {
                    $pdf->AddPage();
                    $counter =30;
                    $counter = $counter + 37;
                    $pdf->SetLeftMargin(6);
                }  
                 


                $pdf->Ln(6);
                $pdf->SetLeftMargin(10);
                $pdf->Cell(10,5,$serial.".", "0", "0","L");
                $pdf->Cell(190,5,$row['test_name_method']." : ", "0", "1","L");
                $pdf->Ln(2);
                $pdf->setLeftMargin(17);
                $pdf->SetFont('Arial','B',10);
                $pdf->Cell(128,6," Result ", "1","0","C",0);
                $pdf->Cell(52,6," Requirements ", "1","1","C",0);
                $pdf->Cell(26,12," Color Change", "1","0","C",0);
                $pdf->Cell(102,6," Staining on to mulifiber ", "1","0","C",0);
                $pdf->Cell(26,12," Color Change ", "1","0","C",0);
                $pdf->Cell(26,12," Staining ", "1","0","C",0);
                $pdf->Cell(0,6," ", "0","1","C",0); //dummy cell for new line
                $pdf->Cell(26,6," ", "0","0","C",0);  // dummy cell for blank space
                $pdf->Cell(17,6," Acetate ", "1","0","C",0);
                $pdf->Cell(17,6," Cotton ", "1","0","C",0);
                $pdf->Cell(17,6," Mylon ", "1","0","C",0);
                $pdf->Cell(17,6," Polyester ", "1","0","C",0);
                $pdf->Cell(17,6," Acrylic ", "1","0","C",0);
                $pdf->Cell(17,6," Wool ", "1","0","C",0);
                $pdf->Cell(26,6," ", "0","0","C",0); // dummy cell for blank space
                $pdf->Cell(26,6," ", "0","0","C",0); // dummy cell for blank space
                $pdf->Cell(0,6," ", "0","1","C",0); //dummy cell for new line

                $pdf->SetFont('Arial','',10);
                $pdf->Cell(26,6,$cf_to_dry_cleaning_color_change_value, "LBR","0","C",0);
                $pdf->Cell(17,6,$cf_to_dry_cleaning_staining_value_for_acetate, "1","0","C",0);
                $pdf->Cell(17,6,$cf_to_dry_cleaning_staining_value_for_cotton, "1","0","C",0);
                $pdf->Cell(17,6,$cf_to_dry_cleaning_staining_value_for_mylon, "1","0","C",0);
                $pdf->Cell(17,6,$cf_to_dry_cleaning_staining_value_for_polyester, "1","0","C",0);
                $pdf->Cell(17,6,$cf_to_dry_cleaning_staining_value_for_acrylic, "1","0","C",0);
                $pdf->Cell(17,6,$cf_to_dry_cleaning_staining_value_for_wool, "1","0","C",0);
                $pdf->Cell(26,6,$row_for_defining_process['cf_to_dry_cleaning_color_change_tolerance_range_math_operator'].' '.$row_for_defining_process['cf_to_dry_cleaning_color_change_tolerance_value'].' '.$row_for_defining_process['uom_of_cf_to_dry_cleaning_color_change'], "LBR","0","C",0);
                $pdf->Cell(26,6,$row_for_defining_process['cf_to_dry_cleaning_staining_tolerance_range_math_operator'].' '.$row_for_defining_process['cf_to_dry_cleaning_staining_tolerance_value'].' '.$row_for_defining_process['uom_of_cf_to_dry_cleaning_staining'], "LBR","1","C",0);

            }
            $pdf->setLeftMargin(10);
            $pdf->SetFont('Arial','B',12);
        }

        if (in_array($row['id'], ['17']))
        {
       
            if($row_for_defining_process['cf_to_perspiration_acid_color_change_max_value']<>0 && $row_for_qc['cf_to_perspiration_acid_color_change_value']<>0)
            { 

                               


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

                $counter = $counter + 37; 

                if($counter>300)
                {
                    $pdf->AddPage();
                    $counter =30;
                    $counter = $counter + 37;
                    $pdf->SetLeftMargin(6);
                } 

                $serial+=1;
                // $pdf->AddPage();
                $pdf->Ln(6);
                $pdf->SetLeftMargin(10);
                $pdf->Cell(10,5,$serial.".", "0", "0","L");
                $pdf->Cell(190,5,$row['test_name_method']." : ", "0", "1","L");
                $pdf->Ln(2);
                $pdf->setLeftMargin(17);
                $pdf->SetFont('Arial','B',10);
                 $pdf->Cell(128,6," Result ", "1","0","C",0);
            $pdf->Cell(52,6," Requirements ", "1","1","C",0);
            $pdf->Cell(26,12," Color Change", "1","0","C",0);
            $pdf->Cell(102,6," Staining on to mulifiber ", "1","0","C",0);
            $pdf->Cell(26,12," Color Change ", "1","0","C",0);
            $pdf->Cell(26,12," Staining ", "1","0","C",0);
            $pdf->Cell(0,6," ", "0","1","C",0); //dummy cell for new line
            $pdf->Cell(26,6," ", "0","0","C",0);  // dummy cell for blank space
            $pdf->Cell(17,6," Acetate ", "1","0","C",0);
            $pdf->Cell(17,6," Cotton ", "1","0","C",0);
            $pdf->Cell(17,6," Mylon ", "1","0","C",0);
            $pdf->Cell(17,6," Polyester ", "1","0","C",0);
            $pdf->Cell(17,6," Acrylic ", "1","0","C",0);
            $pdf->Cell(17,6," Wool ", "1","0","C",0);
            $pdf->Cell(26,6," ", "0","0","C",0); // dummy cell for blank space
            $pdf->Cell(26,6," ", "0","0","C",0); // dummy cell for blank space
            $pdf->Cell(0,6," ", "0","1","C",0); //dummy cell for new line

                $pdf->SetFont('Arial','',10);
                $pdf->Cell(26,6,$cf_to_perspiration_acid_color_change_value, "LBR","0","C",0);
                $pdf->Cell(17,6,$cf_to_perspiration_acid_staining_value_for_acetate, "1","0","C",0);
                $pdf->Cell(17,6,$cf_to_perspiration_acid_staining_value_for_cotton, "1","0","C",0);
                $pdf->Cell(17,6,$cf_to_perspiration_acid_staining_value_for_mylon, "1","0","C",0);
                $pdf->Cell(17,6,$cf_to_perspiration_acid_staining_value_for_polyester, "1","0","C",0);
                $pdf->Cell(17,6,$cf_to_perspiration_acid_staining_value_for_acrylic, "1","0","C",0);
                $pdf->Cell(17,6,$cf_to_perspiration_acid_staining_value_for_wool, "1","0","C",0);

                if($row_for_defining_process['cf_to_perspiration_acid_color_change_tolerance_range_math_op'] == '≥')
                {
                   $cf_to_perspiration_acid_color_change_tolerance_range_math_op = $pdf->Image('../img/greater_equal.png',153, $pdf->GetY()+2, 2).'';
                   $pdf->Cell(26,6,$cf_to_perspiration_acid_color_change_tolerance_range_math_op.' '.($cf_to_perspiration_acid_color_change_tolerance_value), "LBR","0","C",0);

                }
                else if($row_for_defining_process['cf_to_perspiration_acid_color_change_tolerance_range_math_op'] == '≤')
                {
                   $cf_to_perspiration_acid_color_change_tolerance_range_math_op = $pdf->Image('../img/less_equal.png',153, $pdf->GetY()+2, 2).'';
                   $pdf->Cell(26,6,$cf_to_perspiration_acid_color_change_tolerance_range_math_op.' '.($cf_to_perspiration_acid_color_change_tolerance_value), "LBR","0","C",0);

                }
                else if($row_for_defining_process['cf_to_perspiration_acid_color_change_tolerance_range_math_op'] == '>')
                {
                   $cf_to_perspiration_acid_color_change_tolerance_range_math_op = '>';
                   $pdf->Cell(26,6,$cf_to_perspiration_acid_color_change_tolerance_range_math_op.' '.($cf_to_perspiration_acid_color_change_tolerance_value), "LBR","0","C",0);

                }
                else if($row_for_defining_process['cf_to_perspiration_acid_color_change_tolerance_range_math_op'] == '<')
                {
                   $cf_to_perspiration_acid_color_change_tolerance_range_math_op = '<';
                   $pdf->Cell(26,6,$cf_to_perspiration_acid_color_change_tolerance_range_math_op.' '.($cf_to_perspiration_acid_color_change_tolerance_value), "LBR","0","C",0);

                }

                if($row_for_defining_process['cf_to_perspiration_acid_staining_tolerance_range_math_operator'] == '≥')
                {
                   $cf_to_perspiration_acid_staining_tolerance_range_math_operator = $pdf->Image('../img/greater_equal.png',153, $pdf->GetY()+2, 2).'';
                   $pdf->Cell(26,6,$cf_to_perspiration_acid_staining_tolerance_range_math_operator.' ' .($cf_to_perspiration_acid_staining_value), "LBR","1","C",0);

                }
                else if($row_for_defining_process['cf_to_perspiration_acid_staining_tolerance_range_math_operator'] == '≤')
                {
                   $cf_to_perspiration_acid_staining_tolerance_range_math_operator = $pdf->Image('../img/less_equal.png',153, $pdf->GetY()+2, 2).'';
                   $pdf->Cell(26,6,$cf_to_perspiration_acid_staining_tolerance_range_math_operator.' ' .($cf_to_perspiration_acid_staining_value), "LBR","1","C",0);

                }
                else if($row_for_defining_process['cf_to_perspiration_acid_staining_tolerance_range_math_operator'] == '>')
                {
                   $cf_to_perspiration_acid_staining_tolerance_range_math_operator = '>';
                   $pdf->Cell(26,6,$cf_to_perspiration_acid_staining_tolerance_range_math_operator.' ' .($cf_to_perspiration_acid_staining_value), "LBR","1","C",0);

                }
                else if($row_for_defining_process['cf_to_perspiration_acid_staining_tolerance_range_math_operator'] == '<')
                {
                   $cf_to_perspiration_acid_staining_tolerance_range_math_operator = '<';
                   $pdf->Cell(26,6,$cf_to_perspiration_acid_staining_tolerance_range_math_operator.' ' .($cf_to_perspiration_acid_staining_value), "LBR","1","C",0);

                }

            }
            $pdf->setLeftMargin(10);
            $pdf->SetFont('Arial','B',12);

        }

    if (in_array($row['id'], ['18'])) 
    {
                                  
        if($row_for_defining_process['cf_to_perspiration_alkali_color_change_max_value']<>0 && $row_for_qc['cf_to_perspiration_alkali_color_change_value']<>0)
        {

                           


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
            $counter = $counter + 37; 

            if($counter>300)
                {
                    $pdf->AddPage();
                    $counter =30;
                    $counter = $counter + 37;
                    $pdf->SetLeftMargin(6);
                } 


            $serial+=1;
            $pdf->Ln(6);
            $pdf->SetLeftMargin(10);
            $pdf->Cell(10,5,$serial.".", "0", "0","L");
            $pdf->Cell(190,5,$row['test_name_method']." : ", "0", "1","L");
            $pdf->Ln(2);
            $pdf->setLeftMargin(17);
            $pdf->SetFont('Arial','B',10);
            $pdf->Cell(128,6," Result ", "1","0","C",0);
            $pdf->Cell(52,6," Requirements ", "1","1","C",0);
            $pdf->Cell(26,12," Color Change", "1","0","C",0);
            $pdf->Cell(102,6," Staining on to mulifiber ", "1","0","C",0);
            $pdf->Cell(26,12," Color Change ", "1","0","C",0);
            $pdf->Cell(26,12," Staining ", "1","0","C",0);
            $pdf->Cell(0,6," ", "0","1","C",0); //dummy cell for new line
            $pdf->Cell(26,6," ", "0","0","C",0);  // dummy cell for blank space
            $pdf->Cell(17,6," Acetate ", "1","0","C",0);
            $pdf->Cell(17,6," Cotton ", "1","0","C",0);
            $pdf->Cell(17,6," Mylon ", "1","0","C",0);
            $pdf->Cell(17,6," Polyester ", "1","0","C",0);
            $pdf->Cell(17,6," Acrylic ", "1","0","C",0);
            $pdf->Cell(17,6," Wool ", "1","0","C",0);
            $pdf->Cell(26,6," ", "0","0","C",0); // dummy cell for blank space
            $pdf->Cell(26,6," ", "0","0","C",0); // dummy cell for blank space
            $pdf->Cell(0,6," ", "0","1","C",0); //dummy cell for new line
    
            $pdf->SetFont('Arial','',10);
            $pdf->Cell(26,6,$cf_to_perspiration_alkali_color_change_value, "LBR","0","C",0);
            $pdf->Cell(17,6,$cf_to_perspiration_alkali_staining_value_for_acetate, "1","0","C",0);
            $pdf->Cell(17,6,$cf_to_perspiration_alkali_staining_value_for_cotton, "1","0","C",0);
            $pdf->Cell(17,6,$cf_to_perspiration_alkali_staining_value_for_mylon, "1","0","C",0);
            $pdf->Cell(17,6,$cf_to_perspiration_alkali_staining_value_for_polyester, "1","0","C",0);
            $pdf->Cell(17,6,$cf_to_perspiration_alkali_staining_value_for_acrylic, "1","0","C",0);
            $pdf->Cell(17,6,$cf_to_perspiration_alkali_staining_value_for_wool, "1","0","C",0);
            if($row_for_defining_process['cf_to_perspiration_alkali_color_change_tolerance_range_math_op'] == '≥')
            {
               $cf_to_perspiration_alkali_color_change_tolerance_range_math_op = $pdf->Image('../img/greater_equal.png',153, $pdf->GetY()+2, 2).'';
               $pdf->Cell(26,6,$cf_to_perspiration_alkali_color_change_tolerance_range_math_op.' '.($cf_to_perspiration_alkali_color_change_tolerance_value), "LBR","0","C",0);

            }
            else if($row_for_defining_process['cf_to_perspiration_alkali_color_change_tolerance_range_math_op'] == '≤')
            {
               $cf_to_perspiration_alkali_color_change_tolerance_range_math_op = $pdf->Image('../img/less_equal.png',153, $pdf->GetY()+2, 2).'';
               $pdf->Cell(26,6,$cf_to_perspiration_alkali_color_change_tolerance_range_math_op.' '.($cf_to_perspiration_alkali_color_change_tolerance_value), "LBR","0","C",0);

            }
            else if($row_for_defining_process['cf_to_perspiration_alkali_color_change_tolerance_range_math_op'] == '>')
            {
               $cf_to_perspiration_alkali_color_change_tolerance_range_math_op = '>';
               $pdf->Cell(26,6,$cf_to_perspiration_alkali_color_change_tolerance_range_math_op.' '.($cf_to_perspiration_alkali_color_change_tolerance_value), "LBR","0","C",0);

            }
            else if($row_for_defining_process['cf_to_perspiration_alkali_color_change_tolerance_range_math_op'] == '<')
            {
               $cf_to_perspiration_alkali_color_change_tolerance_range_math_op = '<';
               $pdf->Cell(26,6,$cf_to_perspiration_alkali_color_change_tolerance_range_math_op.' '.($cf_to_perspiration_alkali_color_change_tolerance_value), "LBR","0","C",0);

            }

            if($row_for_defining_process['cf_to_perspiration_alkali_staining_tolerance_range_math_op'] == '≥')
            {
               $cf_to_perspiration_alkali_staining_tolerance_range_math_op = $pdf->Image('../img/greater_equal.png',153, $pdf->GetY()+2, 2).'';
               $pdf->Cell(26,6,$cf_to_perspiration_alkali_staining_tolerance_range_math_op.' '.($cf_to_perspiration_alkali_staining_tolerance_value), "LBR","1","C",0);

            }
            else if($row_for_defining_process['cf_to_perspiration_alkali_staining_tolerance_range_math_op'] == '≤')
            {
               $cf_to_perspiration_alkali_staining_tolerance_range_math_op = $pdf->Image('../img/less_equal.png',153, $pdf->GetY()+2, 2).'';
               $pdf->Cell(26,6,$cf_to_perspiration_alkali_staining_tolerance_range_math_op.' '.($cf_to_perspiration_alkali_staining_tolerance_value), "LBR","1","C",0);

            }
            else if($row_for_defining_process['cf_to_perspiration_alkali_staining_tolerance_range_math_op'] == '>')
            {
               $cf_to_perspiration_alkali_staining_tolerance_range_math_op = '>';
               $pdf->Cell(26,6,$cf_to_perspiration_alkali_staining_tolerance_range_math_op.' '.($cf_to_perspiration_alkali_staining_tolerance_value), "LBR","1","C",0);

            }
            else if($row_for_defining_process['cf_to_perspiration_alkali_staining_tolerance_range_math_op'] == '<')
            {
               $cf_to_perspiration_alkali_staining_tolerance_range_math_op = '<';
               $pdf->Cell(26,6,$cf_to_perspiration_alkali_staining_tolerance_range_math_op.' '.($cf_to_perspiration_alkali_staining_tolerance_value), "LBR","1","C",0);

            }

            }
           $pdf->setLeftMargin(10);
           $pdf->SetFont('Arial','B',12);                             
        }

        if (in_array($row['id'], ['19']))
        { 
                                 
            if($row_for_defining_process['cf_to_water_color_change_max_value']<>0 && $row_for_qc['cf_to_water_color_change_value']<>0)
                                
            {
                            


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

                $counter = $counter + 37; 

                if($counter>300)
                {
                    $pdf->AddPage();
                    $counter =30;
                    $counter = $counter + 37;
                    $pdf->SetLeftMargin(6);
                }
                 
                $serial+=1;
                $pdf->Ln(6);
                $pdf->SetLeftMargin(10);
                $pdf->Cell(10,5,$serial.".", "0", "0","L");
                $pdf->Cell(190,5,$row['test_name_method']." : ", "0", "1","L");
                $pdf->Ln(2);
                $pdf->setLeftMargin(17);
                $pdf->SetFont('Arial','B',10);
                 $pdf->Cell(128,6," Result ", "1","0","C",0);
            $pdf->Cell(52,6," Requirements ", "1","1","C",0);
            $pdf->Cell(26,12," Color Change", "1","0","C",0);
            $pdf->Cell(102,6," Staining on to mulifiber ", "1","0","C",0);
            $pdf->Cell(26,12," Color Change ", "1","0","C",0);
            $pdf->Cell(26,12," Staining ", "1","0","C",0);
            $pdf->Cell(0,6," ", "0","1","C",0); //dummy cell for new line
            $pdf->Cell(26,6," ", "0","0","C",0);  // dummy cell for blank space
            $pdf->Cell(17,6," Acetate ", "1","0","C",0);
            $pdf->Cell(17,6," Cotton ", "1","0","C",0);
            $pdf->Cell(17,6," Mylon ", "1","0","C",0);
            $pdf->Cell(17,6," Polyester ", "1","0","C",0);
            $pdf->Cell(17,6," Acrylic ", "1","0","C",0);
            $pdf->Cell(17,6," Wool ", "1","0","C",0);
            $pdf->Cell(26,6," ", "0","0","C",0); // dummy cell for blank space
            $pdf->Cell(26,6," ", "0","0","C",0); // dummy cell for blank space
            $pdf->Cell(0,6," ", "0","1","C",0); //dummy cell for new line
        
                $pdf->SetFont('Arial','',10);
                $pdf->Cell(26,6,$cf_to_water_color_change_value, "LBR","0","C",0);
                $pdf->Cell(17,6,$cf_to_water_staining_value_for_acetate, "1","0","C",0);
                $pdf->Cell(17,6,$cf_to_water_staining_value_for_cotton, "1","0","C",0);
                $pdf->Cell(17,6,$cf_to_water_staining_value_for_mylon, "1","0","C",0);
                $pdf->Cell(17,6,$cf_to_water_staining_value_for_polyester, "1","0","C",0);
                $pdf->Cell(17,6,$cf_to_water_staining_value_for_acrylic, "1","0","C",0);
                $pdf->Cell(17,6,$cf_to_water_staining_value_for_wool, "1","0","C",0);
                
                if($row_for_defining_process['cf_to_water_color_change_tolerance_range_math_operator'] == '≥')
                {
                    $cf_to_water_color_change_tolerance_range_math_operator = $pdf->Image('../img/greater_equal.png',153, $pdf->GetY()+2, 2).'';
                    $pdf->Cell(26,6,$cf_to_water_color_change_tolerance_range_math_operator.' '.($cf_to_water_color_change_tolerance_value), "LBR","0","C",0);

                }
                else if($row_for_defining_process['cf_to_water_color_change_tolerance_range_math_operator'] == '≤')
                {
                    $cf_to_water_color_change_tolerance_range_math_operator = $pdf->Image('../img/less_equal.png',153, $pdf->GetY()+2, 2).'';
                    $pdf->Cell(26,6,$cf_to_water_color_change_tolerance_range_math_operator.' '.($cf_to_water_color_change_tolerance_value), "LBR","0","C",0);

                }
                else if($row_for_defining_process['cf_to_water_color_change_tolerance_range_math_operator'] == '>')
                {
                    $cf_to_water_color_change_tolerance_range_math_operator = '>';
                    $pdf->Cell(26,6,$cf_to_water_color_change_tolerance_range_math_operator.' '.($cf_to_water_color_change_tolerance_value), "LBR","0","C",0);

                }
                else if($row_for_defining_process['cf_to_water_color_change_tolerance_range_math_operator'] == '<')
                {
                    $cf_to_water_color_change_tolerance_range_math_operator = '<';
                    $pdf->Cell(26,6,$cf_to_water_color_change_tolerance_range_math_operator.' '.($cf_to_water_color_change_tolerance_value), "LBR","0","C",0);

                }

               if($row_for_defining_process['cf_to_water_staining_tolerance_range_math_operator'] == '≥')
               {
                  $cf_to_water_staining_tolerance_range_math_operator = $pdf->Image('../img/greater_equal.png',153, $pdf->GetY()+2, 2).'';
                  $pdf->Cell(26,6,$cf_to_water_staining_tolerance_range_math_operator.' '.($cf_to_water_staining_tolerance_value), "LBR","1","C",0);

               }
               else if($row_for_defining_process['cf_to_water_staining_tolerance_range_math_operator'] == '≤')
               {
                  $cf_to_water_staining_tolerance_range_math_operator = $pdf->Image('../img/less_equal.png',153, $pdf->GetY()+2, 2).'';
                  $pdf->Cell(26,6,$cf_to_water_staining_tolerance_range_math_operator.' '.($cf_to_water_staining_tolerance_value), "LBR","1","C",0);

               }
               else if($row_for_defining_process['cf_to_water_staining_tolerance_range_math_operator'] == '>')
               {
                  $cf_to_water_staining_tolerance_range_math_operator = '>';
                  $pdf->Cell(26,6,$cf_to_water_staining_tolerance_range_math_operator.' '.($cf_to_water_staining_tolerance_value), "LBR","1","C",0);

               }
               else if($row_for_defining_process['cf_to_water_staining_tolerance_range_math_operator'] == '<')
               {
                  $cf_to_water_staining_tolerance_range_math_operator = '<';
                  $pdf->Cell(26,6,$cf_to_water_staining_tolerance_range_math_operator.' '.($cf_to_water_staining_tolerance_value), "LBR","1","C",0);

               }

            }
               $pdf->setLeftMargin(10);
               $pdf->SetFont('Arial','B',12);                             
               
        } /* ENd of if (in_array($row['id'], ['19']))*/

        if (in_array($row['id'], ['23', '67']))
        {
           
           if ($row_for_defining_process['cf_to_hydrolysis_of_reactive_dyes_color_change_max_value']<>0 && $row_for_qc['cf_to_hydrolysis_of_reactive_dyes_color_change_value']<>0)
           {

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
               $cf_to_hydrolysis_of_reactive_dyes_color_change_value = '3-4';
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

       $counter = $counter + 25; 

       if($counter>300)
       {
           $pdf->AddPage();
           $counter =30;
           $counter = $counter + 25;
           $pdf->SetLeftMargin(6);
       }
                $serial+=1;
                $pdf->Ln(6);
                $pdf->SetLeftMargin(10);
                $pdf->Cell(10,5,$serial.".", "0", "0","L");
                $pdf->Cell(190,5,$row['test_name_method']." : ", "0", "1","L");
                $pdf->Ln(2);
                $pdf->setLeftMargin(17);
                $pdf->SetFont('Arial','B',10);
                $pdf->Cell(120,6," Result (Color Change)", "1","0","C",0);
                $pdf->Cell(60,6," Requirements ", "1","1","C",0);
                $pdf->SetFont('Arial','',10);
                $pdf->Cell(120,6,$cf_to_hydrolysis_of_reactive_dyes_color_change_value.' '.$row_for_defining_process['uom_of_cf_to_hydrolysis_of_reactive_dyes_color_change'], "1","0","C",0);
                $pdf->Cell(60,6,$row_for_defining_process['cf_to_hydrolysis_of_reactive_dyes_color_change_tol_rang_mat_op'].' '.($cf_to_hydrolysis_of_reactive_dyes_color_change_tolerance_value).' '.$row_for_defining_process['uom_of_cf_to_hydrolysis_of_reactive_dyes_color_change'], "1","1","C",0);
            
            } 
            $pdf->setLeftMargin(10);
            $pdf->SetFont('Arial','B',12);
            
        }  /*End of if (in_array($row['id'], ['23', '67']))*/

        if (in_array($row['id'], ['24', '68']))
        {
           
           if ($row_for_defining_process['cf_to_oxidative_bleach_damage_color_change_max_value']<>0 && $row_for_qc['cf_to_oxidative_bleach_damage_color_change_value']<>0)
           {

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
           $cf_to_oxidative_bleach_damage_color_change_value = '3-4';
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

   $counter = $counter + 25; 

   if($counter>300)
   {
       $pdf->AddPage();
       $counter =30;
       $counter = $counter + 25;
       $pdf->SetLeftMargin(6);
   }
                $serial+=1;
                $pdf->Ln(6);
                $pdf->SetLeftMargin(10);
                $pdf->Cell(10,5,$serial.".", "0", "0","L");
                $pdf->Cell(190,5,$row['test_name_method']." : ", "0", "1","L");
                $pdf->Ln(2);
                $pdf->setLeftMargin(17);
                $pdf->SetFont('Arial','B',10);
                $pdf->Cell(120,6," Result (Color Change)", "1","0","C",0);
                $pdf->Cell(60,6," Requirements ", "1","1","C",0);
                $pdf->SetFont('Arial','',10);
                $pdf->Cell(120,6,$cf_to_oxidative_bleach_damage_color_change_value.' '.$row_for_defining_process['uom_of_cf_to_oxidative_bleach_damage_color_change'], "1","0","C",0);
                $pdf->Cell(60,6,$row_for_defining_process['cf_to_oxidative_bleach_damage_color_change_tol_range_math_op'].' '.($cf_to_oxidative_bleach_damage_color_change_tolerance_value).' '.$row_for_defining_process['uom_of_cf_to_oxidative_bleach_damage_color_change'], "1","1","C",0);

            }
            $pdf->setLeftMargin(10);
            $pdf->SetFont('Arial','B',12);
        }  /*End of if (in_array($row['id'], ['24', '68']))*/

        if (in_array($row['id'], ['25','69']))
        {
           
           if ($row_for_defining_process['cf_to_phenolic_yellowing_staining_max_value']<>0 && $row_for_qc['cf_to_phenolic_yellowing_staining_value']<>0)
           {


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
                          $cf_to_phenolic_yellowing_staining_value = '3-4';
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

                  $counter = $counter + 25; 

                  if($counter>300)
                  {
                      $pdf->AddPage();
                      $counter =30;
                      $counter = $counter + 25;
                      $pdf->SetLeftMargin(6);
                  }

            $serial+=1;
            $pdf->Ln(6);
            $pdf->SetLeftMargin(10);
            $pdf->Cell(10,5,$serial.".", "0", "0","L");
            $pdf->Cell(190,5,$row['test_name_method']." : ", "0", "1","L");
            $pdf->Ln(2);
            $pdf->setLeftMargin(17);
            $pdf->SetFont('Arial','B',10);
            $pdf->Cell(120,6," Result (Staining)", "1","0","C",0);
            $pdf->Cell(60,6," Requirements ", "1","1","C",0);
            $pdf->SetFont('Arial','',10);
            $pdf->Cell(120,6,$cf_to_phenolic_yellowing_staining_value.' '.$row_for_defining_process['uom_of_cf_to_phenolic_yellowing_staining'], "1","0","C",0);
            $pdf->Cell(60,6,$row_for_defining_process['cf_to_phenolic_yellowing_staining_tolerance_range_math_operator'].' '.($cf_to_phenolic_yellowing_staining_tolerance_value).' '.$row_for_defining_process['uom_of_cf_to_phenolic_yellowing_staining'], "1","1","C",0);

            }
            $pdf->setLeftMargin(10);
            $pdf->SetFont('Arial','B',12);

        }  /*End of if (in_array($row['id'], ['25','69'))*/

        if (in_array($row['id'], ['27', '71']))
        {
          if($row_for_defining_process['cf_to_saliva_color_change_max_value']<>0 && $row_for_qc['cf_to_saliva_color_change_value']<>0)
           {           
                         


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

                       $counter = $counter + 37; 

                       if($counter>300)
                       {
                           $pdf->AddPage();
                           $counter =30;
                           $counter = $counter + 37;
                           $pdf->SetLeftMargin(6);
                       }

            $serial+=1;
            $pdf->Ln(5);
            $pdf->SetLeftMargin(10);
            $pdf->Cell(10,5,$serial.".", "0", "0","L");
            $pdf->Cell(190,5,$row['test_name_method']." : ", "0", "1","L");
            $pdf->Ln(2);
            $pdf->setLeftMargin(17);
            $pdf->SetFont('Arial','B',10);
            $pdf->Cell(128,6," Result ", "1","0","C",0);
            $pdf->Cell(52,6," Requirements ", "1","1","C",0);
            $pdf->Cell(26,6," ", "LTR","0","C",0);
            $pdf->Cell(102,6," Staining on to mulifiber ", "1","0","C",0);
            $pdf->Cell(26,6,"  ", "LTR","0","C",0);
            $pdf->Cell(26,6,"  ", "LTR","1","C",0);
            $pdf->Cell(26,6," Color Change", "LBR","0","C",0);
            $pdf->Cell(17,6," Acetate ", "1","0","C",0);
            $pdf->Cell(17,6," Cotton ", "1","0","C",0);
            $pdf->Cell(17,6," Mylon ", "1","0","C",0);
            $pdf->Cell(17,6," Polyester ", "1","0","C",0);
            $pdf->Cell(17,6," Acrylic ", "1","0","C",0);
            $pdf->Cell(17,6," Wool ", "1","0","C",0);
            $pdf->Cell(26,6," Color Change ", "LBR","0","C",0);
            $pdf->Cell(26,6," Staining ", "LBR","1","C",0);
    
            $pdf->SetFont('Arial','',10);
            $pdf->Cell(26,6,$cf_to_saliva_color_change_value, "LBR","0","C",0);
            $pdf->Cell(17,6,$cf_to_saliva_staining_value_for_acetate, "1","0","C",0);
                $pdf->Cell(17,6,$cf_to_saliva_staining_value_for_cotton, "1","0","C",0);
                $pdf->Cell(17,6,$cf_to_saliva_staining_value_for_mylon, "1","0","C",0);
                $pdf->Cell(17,6,$cf_to_saliva_staining_value_for_polyester, "1","0","C",0);
                $pdf->Cell(17,6,$cf_to_saliva_staining_value_for_acrylic, "1","0","C",0);
                $pdf->Cell(17,6,$cf_to_saliva_staining_value_for_wool, "1","0","C",0);
            if($row_for_defining_process['cf_to_saliva_color_change_tolerance_range_math_operator'] == '≥')
            {
               $cf_to_saliva_color_change_tolerance_range_math_operator = $pdf->Image('../img/greater_equal.png',153, $pdf->GetY()+2, 2).'';
               $pdf->Cell(26,6,$cf_to_saliva_color_change_tolerance_range_math_operator.' '.($cf_to_saliva_color_change_tolerance_value), "LBR","0","C",0);

            }
            else if($row_for_defining_process['cf_to_saliva_color_change_tolerance_range_math_operator'] == '≤')
            {
               $cf_to_saliva_color_change_tolerance_range_math_operator = $pdf->Image('../img/less_equal.png',153, $pdf->GetY()+2, 2).'';
               $pdf->Cell(26,6,$cf_to_saliva_color_change_tolerance_range_math_operator.' '.($cf_to_saliva_color_change_tolerance_value), "LBR","0","C",0);

            }
            else if($row_for_defining_process['cf_to_saliva_color_change_tolerance_range_math_operator'] == '>')
            {
               $cf_to_saliva_color_change_tolerance_range_math_operator = '>';
               $pdf->Cell(26,6,$cf_to_saliva_color_change_tolerance_range_math_operator.' '.($cf_to_saliva_color_change_tolerance_value), "LBR","0","C",0);

            }
            else if($row_for_defining_process['cf_to_saliva_color_change_tolerance_range_math_operator'] == '<')
            {
               $cf_to_saliva_color_change_tolerance_range_math_operator = '<';
               $pdf->Cell(26,6,$cf_to_saliva_color_change_tolerance_range_math_operator.' '.($cf_to_saliva_color_change_tolerance_value), "LBR","0","C",0);

            }

            if($row_for_defining_process['cf_to_saliva_staining_tolerance_range_math_operator'] == '≥')
            {
               $cf_to_saliva_staining_tolerance_range_math_operator = $pdf->Image('../img/greater_equal.png',153, $pdf->GetY()+2, 2).'';
               $pdf->Cell(26,6,$cf_to_saliva_staining_tolerance_range_math_operator.' '.($cf_to_saliva_staining_tolerance_value), "LBR","1","C",0);

            }
            else if($row_for_defining_process['cf_to_saliva_staining_tolerance_range_math_operator'] == '≤')
            {
               $cf_to_saliva_staining_tolerance_range_math_operator = $pdf->Image('../img/less_equal.png',153, $pdf->GetY()+2, 2).'';
               $pdf->Cell(26,6,$cf_to_saliva_staining_tolerance_range_math_operator.' '.($cf_to_saliva_staining_tolerance_value), "LBR","1","C",0);

            }
            else if($row_for_defining_process['cf_to_saliva_staining_tolerance_range_math_operator'] == '>')
            {
               $cf_to_saliva_staining_tolerance_range_math_operator = '>';
               $pdf->Cell(26,6,$cf_to_saliva_staining_tolerance_range_math_operator.' '.($cf_to_saliva_staining_tolerance_value), "LBR","1","C",0);

            }
            else if($row_for_defining_process['cf_to_saliva_staining_tolerance_range_math_operator'] == '<')
            {
               $cf_to_saliva_staining_tolerance_range_math_operator = '<';
               $pdf->Cell(26,6,$cf_to_saliva_staining_tolerance_range_math_operator.' '.($cf_to_saliva_staining_tolerance_value), "LBR","1","C",0);

            }
        }
        $pdf->setLeftMargin(10);
        $pdf->SetFont('Arial','B',12);  

    } /* ENd of if (in_array($row['id'], ['19']))*/
    if (in_array($row['id'], ['28', '72']))
    {
       
       if ($row_for_defining_process['cf_to_chlorinated_water_color_change_max_value']<>0 && $row_for_qc['cf_to_chlorinated_water_color_change_change_value']<>0)
       {


            
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
                    $cf_to_chlorinated_water_color_change_change_value = '3-4';
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

        $counter = $counter + 25; 

        if($counter>300)
        {
            $pdf->AddPage();
            $counter =30;
            $counter = $counter + 25;
            $pdf->SetLeftMargin(6);
        }

            $serial+=1;
            $pdf->Ln(6);
            $pdf->SetLeftMargin(10);
            $pdf->Cell(10,5,$serial.".", "0", "0","L");
            $pdf->Cell(190,5,$row['test_name_method']." : ", "0", "1","L");
            $pdf->Ln(2);
            $pdf->setLeftMargin(17);
            $pdf->SetFont('Arial','B',10);
            $pdf->Cell(120,6," Result (Color Change)", "1","0","C",0);
            $pdf->Cell(60,6," Requirements ", "1","1","C",0);
            $pdf->SetFont('Arial','',10);
            $pdf->Cell(120,6,$cf_to_chlorinated_water_color_change_change_value, "1","0","C",0);
            $pdf->Cell(60,6,$row_for_defining_process['cf_to_chlorinated_water_color_change_tolerance_range_math_op'].' '.($cf_to_chlorinated_water_color_change_tolerance_value).' '.$row_for_defining_process['uom_of_cf_to_chlorinated_water_color_change'], "1","1","C",0);

        }
        $pdf->setLeftMargin(10);
        $pdf->SetFont('Arial','B',12);

    }  /*End of if (in_array($row['id'], ['28', '72']))*/

    if (in_array($row['id'], ['29', '73']))
    {
       
       if ($row_for_defining_process['cf_to_cholorine_bleach_color_change_max_value']<>0 && $row_for_qc['cf_to_cholorine_bleach_color_change_value']<>0)
       {


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
            $cf_to_cholorine_bleach_color_change_value = '3-4';
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

        $counter = $counter + 25; 

        if($counter>300)
        {
            $pdf->AddPage();
            $counter =30;
            $counter = $counter + 25;
            $pdf->SetLeftMargin(6);
        }

            $serial+=1;
            $pdf->Ln(6);
            $pdf->SetLeftMargin(10);
            $pdf->Cell(10,5,$serial.".", "0", "0","L");
            $pdf->Cell(190,5,$row['test_name_method']." : ", "0", "1","L");
            $pdf->Ln(2);
            $pdf->setLeftMargin(17);
            $pdf->SetFont('Arial','B',10);
            $pdf->Cell(120,6," Result (Color Change)", "1","0","C",0);
            $pdf->Cell(60,6," Requirements ", "1","1","C",0);
            $pdf->SetFont('Arial','',10);
            $pdf->Cell(120,6,$cf_to_cholorine_bleach_color_change_value.' '.$row_for_defining_process['uom_of_cf_to_cholorine_bleach_color_change'], "1","0","C",0);
            $pdf->Cell(60,6,$row_for_defining_process['cf_to_cholorine_bleach_color_change_tolerance_range_math_op'].' '.($cf_to_cholorine_bleach_color_change_tolerance_value).' '.$row_for_defining_process['uom_of_cf_to_cholorine_bleach_color_change'], "1","1","C",0);

        }
        $pdf->setLeftMargin(10);
        $pdf->SetFont('Arial','B',12);

    }  /*End of if (in_array($row['id'], ['29', '73']))*/
    if (in_array($row['id'], ['30']))
    {
       
       if ($row_for_defining_process['cf_to_peroxide_bleach_color_change_max_value']<>0 && $row_for_qc['cf_to_peroxide_bleach_color_change_value']<>0)
       {

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
            $cf_to_peroxide_bleach_color_change_value = '3-4';
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

        $counter = $counter + 25; 

        if($counter>300)
        {
            $pdf->AddPage();
            $counter =30;
            $counter = $counter + 25;
            $pdf->SetLeftMargin(6);
        }

            $serial+=1;
            $pdf->Ln(6);
            $pdf->SetLeftMargin(10);
            $pdf->Cell(10,5,$serial.".", "0", "0","L");
            $pdf->Cell(190,5,$row['test_name_method']." : ", "0", "1","L");
            $pdf->Ln(2);
            $pdf->setLeftMargin(17);
            $pdf->SetFont('Arial','B',10);
            $pdf->Cell(120,6," Result (Color Change)", "1","0","C",0);
            $pdf->Cell(60,6," Requirements ", "1","1","C",0);
            $pdf->SetFont('Arial','',10);
            $pdf->Cell(120,6,$cf_to_peroxide_bleach_color_change_value.' '.$row_for_defining_process['uom_of_cf_to_peroxide_bleach_color_change'], "1","0","C",0);
            $pdf->Cell(60,6,$row_for_defining_process['cf_to_peroxide_bleach_color_change_tolerance_range_math_operator'].' '.($cf_to_peroxide_bleach_color_change_tolerance_value).' '.$row_for_defining_process['uom_of_cf_to_peroxide_bleach_color_change'], "1","1","C",0);

        }
        $pdf->setLeftMargin(10);
        $pdf->SetFont('Arial','B',12);

    }  /*End of if (in_array($row['id'], ['30']))*/

    if (in_array($row['id'], ['31']))
    {
       
      if ($row_for_defining_process['cross_staining_max_value']<>0 && $row_for_qc['cross_staining_value']<>0)
       {

       


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
                          $cross_staining_value = '3-4';
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

                  $counter = $counter + 25; 

                  if($counter>300)
                  {
                      $pdf->AddPage();
                      $counter =30;
                      $counter = $counter + 25;
                      $pdf->SetLeftMargin(6);
                  }

        $serial+=1;
        $pdf->Ln(6);
        $pdf->SetLeftMargin(10);
        $pdf->Cell(10,5,$serial.".", "0", "0","L");
        $pdf->Cell(190,5,$row['test_name_method']." : ", "0", "1","L");
        $pdf->Ln(2);
        $pdf->setLeftMargin(17);
        $pdf->SetFont('Arial','B',10);
        $pdf->Cell(120,6," Result ", "1","0","C",0);
        $pdf->Cell(60,6," Requirements ", "1","1","C",0);
        $pdf->SetFont('Arial','',10);
        $pdf->Cell(120,6,$cross_staining_value.' '.$row_for_defining_process['uom_of_cross_staining'], "1","0","C",0);
        if($row_for_defining_process['cross_staining_tolerance_range_math_operator'] == '≥')
        {
           $cross_staining_tolerance_range_math_operator = $pdf->Image('../img/greater_equal.png',162, $pdf->GetY()+2, 2).'';
           $pdf->Cell(60,6,$cross_staining_tolerance_range_math_operator.' '.($cross_staining_tolerance_value).' '.$row_for_defining_process['uom_of_cross_staining'], "1","1","C",0);

        }
        else if($row_for_defining_process['cross_staining_tolerance_range_math_operator'] == '≤')
        {
           $cross_staining_tolerance_range_math_operator = $pdf->Image('../img/less_equal.png',162, $pdf->GetY()+2, 2).'';
           $pdf->Cell(60,6,$cross_staining_tolerance_range_math_operator.' '.($cross_staining_tolerance_value).' '.$row_for_defining_process['uom_of_cross_staining'], "1","1","C",0);

        }
        else if($row_for_defining_process['cross_staining_tolerance_range_math_operator'] == '>')
        {
           $cross_staining_tolerance_range_math_operator = '>';
           $pdf->Cell(60,6,$cross_staining_tolerance_range_math_operator.' '.($cross_staining_tolerance_value).' '.$row_for_defining_process['uom_of_cross_staining'], "1","1","C",0);

        }
        else if($row_for_defining_process['cross_staining_tolerance_range_math_operator'] == '<')
        {
           $cross_staining_tolerance_range_math_operator = '<';
           $pdf->Cell(60,6,$cross_staining_tolerance_range_math_operator.' '.($cross_staining_tolerance_value).' '.$row_for_defining_process['uom_of_cross_staining'], "1","1","C",0);

        }

    }
    $pdf->setLeftMargin(10);
    $pdf->SetFont('Arial','B',12);

    }  /*End of if (in_array($row['id'], ['31']))*/

    if (in_array($row['id'], ['32']))
    {
       
       if ($row_for_defining_process['formaldehyde_content_max_value']<>0 && $row_for_qc['formaldehyde_content_value']<>0)
       {

                            

                           $counter = $counter + 25; 

                           if($counter>300)
                           {
                               $pdf->AddPage();
                               $counter =30;
                               $counter = $counter + 25;
                               $pdf->SetLeftMargin(6);
                           }

        $serial+=1;
        $pdf->Ln(6);
        $pdf->SetLeftMargin(10);
        $pdf->Cell(10,5,$serial.".", "0", "0","L");
        $pdf->Cell(190,5,$row['test_name_method']." : ", "0", "1","L");
        $pdf->Ln(2);
        $pdf->setLeftMargin(17);
        $pdf->SetFont('Arial','B',10);
        $pdf->Cell(120,6," Result ", "1","0","C",0);
        $pdf->Cell(60,6," Requirements ", "1","1","C",0);
        $pdf->SetFont('Arial','',10);
        $pdf->Cell(120,6,$row_for_qc['formaldehyde_content_value'].' '.$row_for_defining_process['uom_of_formaldehyde_content'], "1","0","C",0);

        if($row_for_defining_process['formaldehyde_content_tolerance_range_math_operator'] == '≥')
        {
            $formaldehyde_content_tolerance_range_math_operator = $pdf->Image('../img/greater_equal.png',162, $pdf->GetY()+2, 2).'';
            $pdf->Cell(60,6,$formaldehyde_content_tolerance_range_math_operator.' '.' '.intval($row_for_defining_process['formaldehyde_content_tolerance_value']).' '.$row_for_defining_process['uom_of_formaldehyde_content'], "1","1","C",0);

        }
        else if($row_for_defining_process['formaldehyde_content_tolerance_range_math_operator'] == '≤')
        {
            $formaldehyde_content_tolerance_range_math_operator = $pdf->Image('../img/less_equal.png',162, $pdf->GetY()+2, 2).'';
            $pdf->Cell(60,6,$formaldehyde_content_tolerance_range_math_operator.' '.' '.intval($row_for_defining_process['formaldehyde_content_tolerance_value']).' '.$row_for_defining_process['uom_of_formaldehyde_content'], "1","1","C",0);

        }
        else if($row_for_defining_process['formaldehyde_content_tolerance_range_math_operator'] == '>')
        {
            $formaldehyde_content_tolerance_range_math_operator = '>';
            $pdf->Cell(60,6,$formaldehyde_content_tolerance_range_math_operator.' '.' '.intval($row_for_defining_process['formaldehyde_content_tolerance_value']).' '.$row_for_defining_process['uom_of_formaldehyde_content'], "1","1","C",0);

        }
        else if($row_for_defining_process['formaldehyde_content_tolerance_range_math_operator'] == '<')
        {
            $formaldehyde_content_tolerance_range_math_operator = '<';
            $pdf->Cell(60,6,$formaldehyde_content_tolerance_range_math_operator.' '.' '.intval($row_for_defining_process['formaldehyde_content_tolerance_value']).' '.$row_for_defining_process['uom_of_formaldehyde_content'], "1","1","C",0);

        }
    }
    $pdf->setLeftMargin(10);
    $pdf->SetFont('Arial','B',12);

    }  /*End of if (in_array($row['id'], ['32']))*/

    if (in_array($row['id'], ['33']))
    {
       
      if ($row_for_defining_process['ph_value_max_value']<>0 && $row_for_qc['ph_value']<>0)
       {

        $counter = $counter + 25; 

        if($counter>300)
        {
            $pdf->AddPage();
            $counter =30;
            $counter = $counter + 25;
            $pdf->SetLeftMargin(6);
        }
            $serial+=1;
            $pdf->Ln(6);
            $pdf->SetLeftMargin(10);
            $pdf->Cell(10,5,$serial.".", "0", "0","L");
            $pdf->Cell(190,5,$row['test_name_method']." : ", "0", "1","L");
            $pdf->Ln(2);
            $pdf->setLeftMargin(17);
            $pdf->SetFont('Arial','B',10);
            $pdf->Cell(120,6," Result ", "1","0","C",0);
            $pdf->Cell(60,6," Requirements ", "1","1","C",0);
            $pdf->SetFont('Arial','',10);
            $pdf->Cell(120,6,$row_for_qc['ph_value'], "1","0","C",0);
            $pdf->Cell(60,6,$row_for_defining_process['ph_value_min_value'].' to '.$row_for_defining_process['ph_value_max_value'], "1","1","C",0);
        
        }
        $pdf->setLeftMargin(10);
        $pdf->SetFont('Arial','B',12);

    }  /*End of if (in_array($row['id'], ['33']))*/

    if (in_array($row['id'], ['34']))
    {
       
       if ($row_for_defining_process['water_absorption_value_max_value']<>0 && $row_for_qc['water_absorption_value']<>0)
       {

        $counter = $counter + 43; 

        if($counter>300)
        {
            $pdf->AddPage();
            $counter =30;
            $counter = $counter + 43;
            $pdf->SetLeftMargin(6);
        }

            $serial+=1;
            $pdf->Ln(6);
            $pdf->SetLeftMargin(10);
            $pdf->Cell(10,5,$serial.".", "0", "0","L");
            $pdf->Cell(190,5,$row['test_name_method']." : ", "0", "1","L");
            $pdf->Ln(2);
            $pdf->setLeftMargin(17);
            $pdf->SetFont('Arial','B',10);
            $pdf->Cell(120,6," Result", "1","0","C",0);
            $pdf->Cell(60,6," Requirements ", "1","1","C",0);
            $pdf->SetFont('Arial','',10);
            $pdf->Cell(60,6," ", "1","0","C",0);
            $pdf->Cell(60,6,$row_for_qc['water_absorption_value'].' '.$row_for_defining_process['uom_of_water_absorption_value'], "1","0","C",0);
            $pdf->Cell(60,6,$row_for_defining_process['water_absorption_value_tolerance_range_math_operator'].' '.$row_for_defining_process['water_absorption_value_tolerance_value'].' '.$row_for_defining_process['uom_of_water_absorption_value'], "1","1","C",0);
            
            $pdf->Cell(60,6," Before Wash 30 Sec.", "1","0","C",0);
            $pdf->Cell(60,6,$row_for_qc['water_absorption_b_wash_thirty_sec_value'].' '.$row_for_defining_process['uom_of_water_absorption_b_wash_thirty_sec'], "1","0","C",0);
            $pdf->Cell(60,6,$row_for_defining_process['water_absorption_b_wash_thirty_sec_tolerance_range_math_op'].' '.$row_for_defining_process['water_absorption_b_wash_thirty_sec_tolerance_value'].' '.$row_for_defining_process['uom_of_water_absorption_b_wash_thirty_sec'], "1","1","C",0);
            
            $pdf->Cell(60,6," Before Wash ", "1","0","C",0);
            $pdf->Cell(60,6,$row_for_qc['water_absorption_b_wash_max_value'].' '.$row_for_defining_process['uom_of_water_absorption_b_wash_max'], "1","0","C",0);
            $pdf->Cell(60,6,$row_for_defining_process['water_absorption_b_wash_max_tolerance_range_math_op'].' '.$row_for_defining_process['water_absorption_b_wash_max_tolerance_value'].' '.$row_for_defining_process['uom_of_water_absorption_b_wash_max'], "1","1","C",0);
            
            $pdf->Cell(60,6," After Wash 30 Sec. ", "1","0","C",0);
            $pdf->Cell(60,6,$row_for_qc['water_absorption_a_wash_thirty_sec_value'].' '.$row_for_defining_process['uom_of_water_absorption_a_wash_thirty_sec'], "1","0","C",0);
            $pdf->Cell(60,6,$row_for_defining_process['water_absorption_a_wash_thirty_sec_tolerance_range_math_op'].' '.$row_for_defining_process['water_absorption_a_wash_thirty_sec_tolerance_value'].' '.$row_for_defining_process['uom_of_water_absorption_a_wash_thirty_sec'], "1","1","C",0);
        
        }
        $pdf->setLeftMargin(10);
        $pdf->SetFont('Arial','B',12);


    }  /*End of if (in_array($row['id'], ['34']))*/

    if (in_array($row['id'], ['35']))
    {
       
       if ($row_for_defining_process['wicking_test_max_value']<>0 && $row_for_qc['wicking_test_value']<>0)
       {
        $counter = $counter + 25; 

        if($counter>300)
        {
            $pdf->AddPage();
            $counter =30;
            $counter = $counter + 25;
            $pdf->SetLeftMargin(6);
        }

        $serial+=1;
        $pdf->Ln(6);
        $pdf->SetLeftMargin(10);
        $pdf->Cell(10,5,$serial.".", "0", "0","L");
        $pdf->Cell(190,5,$row['test_name_method']." : ", "0", "1","L");
        $pdf->Ln(2);
        $pdf->setLeftMargin(17);
        $pdf->SetFont('Arial','B',10);
        $pdf->Cell(120,6," Result ", "1","0","C",0);
        $pdf->Cell(60,6," Requirements ", "1","1","C",0);
        $pdf->SetFont('Arial','',10);
        $pdf->Cell(120,6,$row_for_qc['wicking_test_value'].' '.$row_for_defining_process['uom_of_wicking_test'], "1","0","C",0);
        $pdf->Cell(60,6,$row_for_defining_process['wicking_test_tol_range_math_op'].' '.$row_for_defining_process['wicking_test_tolerance_value'].' '.$row_for_defining_process['uom_of_wicking_test'], "1","1","C",0);
    
    }
    $pdf->setLeftMargin(10);
    $pdf->SetFont('Arial','B',12);

    }  /*End of if (in_array($row['id'], ['35']))*/

    if (in_array($row['id'], ['36']))
    {
        $counter = $counter + 25; 

        if($counter>300)
        {
            $pdf->AddPage();
            $counter =30;
            $counter = $counter + 25;
            $pdf->SetLeftMargin(6);
        }

        if ($row_for_defining_process['spirality_value_max_value']<>0 && $row_for_qc['spirality_value']<>0)
       {
            

        $serial+=1;
        $pdf->Ln(6);
        $pdf->SetLeftMargin(10);
        $pdf->Cell(10,5,$serial.".", "0", "0","L");
        $pdf->Cell(190,5,$row['test_name_method']." : ", "0", "1","L");
        $pdf->Ln(2);
        $pdf->setLeftMargin(17);
        $pdf->SetFont('Arial','B',10);
        $pdf->Cell(120,6," Result ", "1","0","C",0);
        $pdf->Cell(60,6," Requirements ", "1","1","C",0);
        $pdf->SetFont('Arial','',10);
        $pdf->Cell(120,6,$row_for_qc['spirality_value'].' '.$row_for_defining_process['uom_of_spirality_value'], "1","0","C",0);
        if($row_for_defining_process['spirality_value_tolerance_range_math_operator'] == '≥')
        {
            $spirality_value_tolerance_range_math_operator = $pdf->Image('../img/greater_equal.png',162, $pdf->GetY()+2, 2).'';
            $pdf->Cell(60,6,$spirality_value_tolerance_range_math_operator.' '.$row_for_defining_process['spirality_value_tolerance_value'].' '.$row_for_defining_process['uom_of_spirality_value'], "1","1","C",0);

        }
        else if($row_for_defining_process['spirality_value_tolerance_range_math_operator'] == '≤')
        {
            $spirality_value_tolerance_range_math_operator = $pdf->Image('../img/less_equal.png',162, $pdf->GetY()+2, 2).'';
            $pdf->Cell(60,6,$spirality_value_tolerance_range_math_operator.' '.$row_for_defining_process['spirality_value_tolerance_value'].' '.$row_for_defining_process['uom_of_spirality_value'], "1","1","C",0);

        }
        else if($row_for_defining_process['spirality_value_tolerance_range_math_operator'] == '>')
        {
            $spirality_value_tolerance_range_math_operator = '>';
            $pdf->Cell(60,6,$spirality_value_tolerance_range_math_operator.' '.$row_for_defining_process['spirality_value_tolerance_value'].' '.$row_for_defining_process['uom_of_spirality_value'], "1","1","C",0);

        }
        else if($row_for_defining_process['spirality_value_tolerance_range_math_operator'] == '<')
        {
            $spirality_value_tolerance_range_math_operator = '<';
            $pdf->Cell(60,6,$spirality_value_tolerance_range_math_operator.' '.$row_for_defining_process['spirality_value_tolerance_value'].' '.$row_for_defining_process['uom_of_spirality_value'], "1","1","C",0);

        }
    }
    $pdf->setLeftMargin(10);
    $pdf->SetFont('Arial','B',12);

         
    }  /*End of if (in_array($row['id'], ['36']))*/

    if (in_array($row['id'], ['37']))
    {
        $counter = $counter + 25; 

        if($counter>300)
        {
            $pdf->AddPage();
            $counter =30;
            $counter = $counter + 25;
            $pdf->SetLeftMargin(6);
        }
       
    if ($row_for_defining_process['smoothness_appearance_max_value']<>0 && $row_for_qc['smoothness_appearance_value']<>0)
       {

           

        $serial+=1;
        $pdf->Ln(6);
        $pdf->SetLeftMargin(10);
        $pdf->Cell(10,5,$serial.".", "0", "0","L");
        $pdf->Cell(190,5,$row['test_name_method']." : ", "0", "1","L");
        $pdf->Ln(2);
        $pdf->setLeftMargin(17);
        $pdf->SetFont('Arial','B',10);
        $pdf->Cell(120,6," Result ", "1","0","C",0);
        $pdf->Cell(60,6," Requirements ", "1","1","C",0);
        $pdf->SetFont('Arial','',10);
        $pdf->Cell(120,6,$row_for_qc['smoothness_appearance_value'].' '.$row_for_defining_process['uom_of_smoothness_appearance'], "1","0","C",0);
    
        if($row_for_defining_process['smoothness_appearance_tolerance_range_math_op'] == '≥')
        {
            $smoothness_appearance_tolerance_range_math_op = $pdf->Image('../img/greater_equal.png',162, $pdf->GetY()+2, 2).'';
            $pdf->Cell(60,6,$smoothness_appearance_tolerance_range_math_op.' '.$row_for_defining_process['smoothness_appearance_tolerance_value'].' '.$row_for_defining_process['uom_of_smoothness_appearance'], "1","1","C",0);

        }
        else if($row_for_defining_process['smoothness_appearance_tolerance_range_math_op'] == '≤')
        {
            $smoothness_appearance_tolerance_range_math_op = $pdf->Image('../img/less_equal.png',162, $pdf->GetY()+2, 2).'';
            $pdf->Cell(60,6,$smoothness_appearance_tolerance_range_math_op.' '.$row_for_defining_process['smoothness_appearance_tolerance_value'].' '.$row_for_defining_process['uom_of_smoothness_appearance'], "1","1","C",0);

        }
        else if($row_for_defining_process['smoothness_appearance_tolerance_range_math_op'] == '>')
        {
            $smoothness_appearance_tolerance_range_math_op = '>';
            $pdf->Cell(60,6,$smoothness_appearance_tolerance_range_math_op.' '.$row_for_defining_process['smoothness_appearance_tolerance_value'].' '.$row_for_defining_process['uom_of_smoothness_appearance'], "1","1","C",0);

        }
        else if($row_for_defining_process['smoothness_appearance_tolerance_range_math_op'] == '<')
        {
            $smoothness_appearance_tolerance_range_math_op = '<';
            $pdf->Cell(60,6,$smoothness_appearance_tolerance_range_math_op.' '.$row_for_defining_process['smoothness_appearance_tolerance_value'].' '.$row_for_defining_process['uom_of_smoothness_appearance'], "1","1","C",0);

        }

    }
    $pdf->setLeftMargin(10);
    $pdf->SetFont('Arial','B',12);

         
    }  /*End of if (in_array($row['id'], ['37']))*/

    if (in_array($row['id'], ['38']))
    {
        $counter = $counter + 25; 

        if($counter>300)
        {
            $pdf->AddPage();
            $counter =30;
            $counter = $counter + 25;
            $pdf->SetLeftMargin(6);
        }
       
        if ($row_for_defining_process['print_duribility_m_s_c_15_value']<>0 && $row_for_qc['print_duribility_value']<>0)
       {

        $serial+=1;
        $pdf->Ln(6);
        $pdf->SetLeftMargin(10);
        $pdf->Cell(10,5,$serial.".", "0", "0","L");
        $pdf->Cell(190,5,$row['test_name_method']." : ", "0", "1","L");
        $pdf->Ln(2);
        $pdf->setLeftMargin(17);
        $pdf->SetFont('Arial','B',10);
        $pdf->Cell(120,6," Result ", "1","0","C",0);
        $pdf->Cell(60,6," Requirements ", "1","1","C",0);
        $pdf->SetFont('Arial','',10);
        $pdf->Cell(120,6,$row_for_qc['print_duribility_value'], "1","0","C",0);
        $pdf->Cell(60,6,$row_for_defining_process['print_duribility_m_s_c_15_value'], "1","1","C",0);
    
    }
    $pdf->setLeftMargin(10);
    $pdf->SetFont('Arial','B',12);

         
    }  /*End of if (in_array($row['id'], ['38']))*/

    if (in_array($row['id'], ['39']))
    {
         
        $counter = $counter + 25; 

        if($counter>300)
        {
            $pdf->AddPage();
            $counter =30;
            $counter = $counter + 25;
            $pdf->SetLeftMargin(6);
        }

        if ($row_for_defining_process['iron_ability_of_woven_fabric_max_value']<>0 && $row_for_qc['iron_ability_of_woven_fabric_value']<>0)
        {

           
        $serial+=1;
        $pdf->Ln(6);
        $pdf->SetLeftMargin(10);
        $pdf->Cell(10,5,$serial.".", "0", "0","L");
        $pdf->Cell(190,5,$row['test_name_method']." : ", "0", "1","L");
        $pdf->Ln(2);
        $pdf->setLeftMargin(17);
        $pdf->SetFont('Arial','B',10);
        $pdf->Cell(120,6," Result ", "1","0","C",0);
        $pdf->Cell(60,6," Requirements ", "1","1","C",0);
        $pdf->SetFont('Arial','',10);
        $pdf->Cell(120,6,$row_for_qc['iron_ability_of_woven_fabric_value'].' '.$row_for_qc['iron_ability_of_woven_fabric_value'].' '.$row_for_defining_process['uom_of_iron_ability_of_woven_fabric'], "1","0","C",0);
        $pdf->Cell(60,6,$row_for_defining_process['iron_ability_of_woven_fabric_tolerance_range_math_op'].' '.$row_for_defining_process['iron_ability_of_woven_fabric_tolerance_value'].' '.$row_for_defining_process['uom_of_iron_ability_of_woven_fabric'], "1","1","C",0);
    
    }
    $pdf->setLeftMargin(10);
    $pdf->SetFont('Arial','B',12);

                                 
    }  /*End of if (in_array($row['id'], ['39']))*/

    if (in_array($row['id'], ['41']))
    {
       
        $counter = $counter + 25; 

        if($counter>300)
        {
            $pdf->AddPage();
            $counter =30;
            $counter = $counter + 25;
            $pdf->SetLeftMargin(6);
        }

       if ($row_for_defining_process['moisture_content_max_value']<>0 && $row_for_qc['moisture_content_value']<>0)
       {


        $serial+=1;
        $pdf->Ln(6);
        $pdf->SetLeftMargin(10);
        $pdf->Cell(10,5,$serial.".", "0", "0","L");
        $pdf->Cell(190,5,$row['test_name_method']." : ", "0", "1","L");
        $pdf->Ln(2);
        $pdf->setLeftMargin(17);
        $pdf->SetFont('Arial','B',10);
        $pdf->Cell(120,6," Result ", "1","0","C",0);
        $pdf->Cell(60,6," Requirements ", "1","1","C",0);
        $pdf->SetFont('Arial','',10);
        $pdf->Cell(120,6,$row_for_qc['moisture_content_value'].' '.$row_for_defining_process['uom_of_moisture_content'], "1","0","C",0);
        $pdf->Cell(60,6,$row_for_defining_process['moisture_content_tolerance_range_math_op'].' '.$row_for_defining_process['moisture_content_tolerance_value'].' '.$row_for_defining_process['uom_of_moisture_content'], "1","1","C",0);
    
    }
    $pdf->setLeftMargin(10);
    $pdf->SetFont('Arial','B',12);

          
    }  /*End of if (in_array($row['id'], ['41']))*/

    if (in_array($row['id'], ['42']))
    {
        $counter = $counter + 25; 

        if($counter>300)
        {
            $pdf->AddPage();
            $counter =30;
            $counter = $counter + 25;
            $pdf->SetLeftMargin(6);
        }

       if ($row_for_defining_process['evaporation_rate_quick_drying_max_value']<>0 && $row_for_qc['evaporation_rate_quick_drying_value']<>0)
       {

        
        $serial+=1;
        $pdf->Ln(6);
        $pdf->SetLeftMargin(10);
        $pdf->Cell(10,5,$serial.".", "0", "0","L");
        $pdf->Cell(190,5,$row['test_name_method']." : ", "0", "1","L");
        $pdf->Ln(2);
        $pdf->setLeftMargin(17);
        $pdf->SetFont('Arial','B',10);
        $pdf->Cell(120,6," Result ", "1","0","C",0);
        $pdf->Cell(60,6," Requirements ", "1","1","C",0);
        $pdf->SetFont('Arial','',10);
        $pdf->Cell(120,6,$row_for_qc['evaporation_rate_quick_drying_value'].' '.$row_for_defining_process['uom_of_evaporation_rate_quick_drying'], "1","0","C",0);
        $pdf->Cell(60,6,$row_for_defining_process['evaporation_rate_quick_drying_tolerance_range_math_op'].' '.$row_for_defining_process['evaporation_rate_quick_drying_tolerance_value'].' '.$row_for_defining_process['uom_of_evaporation_rate_quick_drying'], "1","1","C",0);
    
    }
    $pdf->setLeftMargin(10);
    $pdf->SetFont('Arial','B',12);

        
    }  /*End of if (in_array($row['id'], ['42']))*/

    if (in_array($row['id'], ['43']))
    {
       
        

      if (($row_for_defining_process['percentage_of_total_cotton_content_max_value']<>0 && $row_for_qc['total_cotton_content_value']<>0) || ($row_for_defining_process['percentage_of_warp_cotton_content_max_value']<>0 && $row_for_qc['warp_cotton_content_value']<>0) || ($row_for_defining_process['percentage_of_weft_cotton_content_max_value']<>0 && $row_for_qc['weft_cotton_content_value']<>0) )
       {

        if ($row_for_defining_process['percentage_of_total_cotton_content_max_value']<>0 && $row_for_qc['total_cotton_content_value']<>0)
        {
            $counter = $counter + 18;
        }

        if ($row_for_defining_process['percentage_of_warp_cotton_content_max_value']<>0 && $row_for_qc['warp_cotton_content_value']<>0)
        {
            $counter = $counter + 18;
        }

        if ($row_for_defining_process['percentage_of_weft_cotton_content_max_value']<>0 && $row_for_qc['weft_cotton_content_value']<>0)
        {
            $counter = $counter + 18;
        }

        $counter = $counter + 19;

        if($counter>300)
        {
            $pdf->AddPage();
            $counter =30;
            if ($row_for_defining_process['percentage_of_total_cotton_content_max_value']<>0 && $row_for_qc['total_cotton_content_value']<>0)
                {
                    $counter = $counter + 18;
                }

            if ($row_for_defining_process['percentage_of_warp_cotton_content_max_value']<>0 && $row_for_qc['warp_cotton_content_value']<>0)
                {
                    $counter = $counter + 18;
                }

            if ($row_for_defining_process['percentage_of_weft_cotton_content_max_value']<>0 && $row_for_qc['weft_cotton_content_value']<>0)
                {
                    $counter = $counter + 18;
                }
            $counter = $counter + 19;
            $pdf->SetLeftMargin(6);
        }

        $serial+=1;
        $pdf->Ln(6);
        $pdf->SetLeftMargin(10);
        $pdf->Cell(10,5,$serial.".", "0", "0","L");
        $pdf->Cell(190,5,$row['test_name_method']." : ", "0", "1","L");
        $pdf->Ln(2);
        $pdf->setLeftMargin(17);
        $pdf->SetFont('Arial','B',10);
        $pdf->Cell(60,6," Assessment Criteria", "1","0","C",0);
        $pdf->Cell(60,6," Result", "1","0","C",0);
        $pdf->Cell(60,6," Requirements ", "1","1","C",0);
        $pdf->SetFont('Arial','',10);
        $pdf->SetLeftMargin(17);

     if ($row_for_defining_process['percentage_of_total_cotton_content_max_value']<>0 && $row_for_qc['total_cotton_content_value']<>0)
     {
         
        $content_of_total_cotton_content = urlencode($row_for_defining_process['percentage_of_total_cotton_content_tolerance_range_math_operator']);
        $percentage_of_total_cotton_content_tolerance_range_math_operator = urldecode($pdf->sp_character($content_of_total_cotton_content));

        $content_total_polyster = urlencode($row_for_defining_process['percentage_of_total_polyester_content_tolerance_range_math_op']);
        $percentage_of_total_polyester_content_tolerance_range_math_op = urldecode($pdf->sp_character($content_total_polyster));

        $content_total_other_fiber = urlencode($row_for_defining_process['percentage_of_total_other_fiber_content_tolerance_range_math_op']);
        $percentage_of_total_other_fiber_content_tolerance_range_math_op = urldecode($pdf->sp_character($content_total_other_fiber));

        $pdf->Cell(60,6," Total Cotton ", "1","0","L",0);
        $pdf->Cell(60,6,$row_for_qc['total_cotton_content_value'].' '.$row_for_defining_process['uom_of_percentage_of_total_cotton_content'], "1","0","C",0);
        $pdf->Cell(60,6,$row_for_defining_process['percentage_of_total_cotton_content_value'].' ('.$percentage_of_total_cotton_content_tolerance_range_math_operator.' '.$row_for_defining_process['percentage_of_total_cotton_content_tolerance_value']."%)", "1","1","C",0);
        
        $pdf->Cell(60,6," Total Polyester", "1","0","l",0);
        $pdf->Cell(60,6,$row_for_qc['total_total_Polyester_content_value'].' '.$row_for_defining_process['uom_of_percentage_of_total_polyester_content'], "1","0","C",0);
        $pdf->Cell(60,6,$row_for_defining_process['percentage_of_total_polyester_content_value'].' ('.$percentage_of_total_polyester_content_tolerance_range_math_op.' '.$row_for_defining_process['percentage_of_total_polyester_content_tolerance_value']."%)", "1","1","C",0);
        
        $pdf->Cell(60,6," Total Other Fiber ", "1","0","l",0);
        $pdf->Cell(60,6,$row_for_qc['total_other_fiber_value'].' '.$row_for_defining_process['uom_of_percentage_of_total_other_fiber_content'], "1","0","C",0);
        $pdf->Cell(60,6,$row_for_defining_process['percentage_of_total_other_fiber_content_value'].' ('.$percentage_of_total_other_fiber_content_tolerance_range_math_op.' '.$row_for_defining_process['percentage_of_total_other_fiber_content_tolerance_value']."%)", "1","1","C",0);
      }

    if ($row_for_defining_process['percentage_of_warp_cotton_content_max_value']<>0 && $row_for_qc['warp_cotton_content_value']<>0)
      {
        $content_warp_cotton = urlencode($row_for_defining_process['percentage_of_warp_cotton_content_tolerance_range_math_operator']);
        $percentage_of_warp_cotton_content_tolerance_range_math_operator = urldecode($pdf->sp_character($content_warp_cotton));

        $content_warp_polyster = urlencode($row_for_defining_process['percentage_of_warp_polyester_content_tolerance_range_math_op']);
        $percentage_of_warp_polyester_content_tolerance_range_math_op = urldecode($pdf->sp_character($content_warp_polyster));

        $content_warp_other_fiber = urlencode($row_for_defining_process['percentage_of_warp_other_fiber_content_tolerance_range_math_op']);
        $percentage_of_warp_other_fiber_content_tolerance_range_math_op = urldecode($pdf->sp_character($content_warp_other_fiber));


        $pdf->Cell(60,6," Warp Cotton ", "1","0","l",0);
        $pdf->Cell(60,6,$row_for_qc['warp_cotton_content_value'].' '.$row_for_defining_process['uom_of_percentage_of_warp_cotton_content'], "1","0","C",0);
        $pdf->Cell(60,6,$row_for_defining_process['percentage_of_warp_cotton_content_value'].' ('.$percentage_of_warp_cotton_content_tolerance_range_math_operator.' '.$row_for_defining_process['percentage_of_warp_cotton_content_tolerance_value']."%)", "1","1","C",0);
        
        $pdf->Cell(60,6," Warp Polyester ", "1","0","L",0);
        $pdf->Cell(60,6,$row_for_qc['warp_Polyester_content_value'].' '.$row_for_defining_process['uom_of_percentage_of_warp_polyester_content'], "1","0","C",0);
        $pdf->Cell(60,6,$row_for_defining_process['percentage_of_warp_polyester_content_value'].' ('.$percentage_of_warp_polyester_content_tolerance_range_math_op.' '.$row_for_defining_process['percentage_of_warp_polyester_content_tolerance_value']."%)", "1","1","C",0);
    
        $pdf->Cell(60,6," Warp Other Fiber ", "1","0","l",0);
        $pdf->Cell(60,6,$row_for_qc['warp_other_fiber_value'].' '.$row_for_defining_process['uom_of_percentage_of_warp_other_fiber_content'], "1","0","C",0);
        $pdf->Cell(60,6,$row_for_defining_process['percentage_of_warp_other_fiber_content_value'].' ('.$percentage_of_warp_other_fiber_content_tolerance_range_math_op.' '.$row_for_defining_process['percentage_of_warp_other_fiber_content_tolerance_value']."%)", "1","1","C",0);
      }


    if ($row_for_defining_process['percentage_of_weft_cotton_content_max_value']<>0 && $row_for_qc['weft_cotton_content_value']<>0)
      {
        $content_weft_cotton = urlencode($row_for_defining_process['percentage_of_weft_cotton_content_tolerance_range_math_op']);
        $percentage_of_weft_cotton_content_tolerance_range_math_op = urldecode($pdf->sp_character($content_weft_cotton));

        $content_weft_polyester = urlencode($row_for_defining_process['percentage_of_weft_polyester_content_tolerance_range_math_op']);
        $percentage_of_weft_polyester_content_tolerance_range_math_op = urldecode($pdf->sp_character($content_weft_polyester));

        $content_weft_other_fiber = urlencode($row_for_defining_process['percentage_of_weft_other_fiber_content_tolerance_range_math_op']);
        $percentage_of_weft_other_fiber_content_tolerance_range_math_op = urldecode($pdf->sp_character($content_weft_other_fiber));

        $pdf->Cell(60,6," Weft Cotton ", "1","0","L",0);
        $pdf->Cell(60,6,$row_for_qc['weft_cotton_content_value'].' '.$row_for_defining_process['uom_of_percentage_of_weft_cotton_content'], "1","0","C",0);
        $pdf->Cell(60,6,$row_for_defining_process['percentage_of_weft_cotton_content_value'].' ('.$percentage_of_weft_cotton_content_tolerance_range_math_op.' '.$row_for_defining_process['percentage_of_weft_cotton_content_tolerance_value']."%)", "1","1","C",0);
    
        $pdf->Cell(60,6," Weft Polyester ", "1","0","l",0);
        $pdf->Cell(60,6,$row_for_qc['weft_Polyester_content_value'].' '.$row_for_defining_process['uom_of_percentage_of_weft_polyester_content'], "1","0","C",0);
        $pdf->Cell(60,6,$row_for_defining_process['percentage_of_weft_polyester_content_value'].' ('.$percentage_of_weft_polyester_content_tolerance_range_math_op.' '.$row_for_defining_process['percentage_of_weft_polyester_content_tolerance_value']."%)", "1","1","C",0);
    
        $pdf->Cell(60,6," Weft Other Fiber ", "1","0","l",0);
        $pdf->Cell(60,6,$row_for_qc['weft_other_fiber_value'].' '.$row_for_defining_process['uom_of_percentage_of_weft_other_fiber_content'], "1","0","C",0);
        $pdf->Cell(60,6,$row_for_defining_process['percentage_of_weft_other_fiber_content_value'].' ('.$percentage_of_weft_other_fiber_content_tolerance_range_math_op.' '.$row_for_defining_process['percentage_of_weft_other_fiber_content_tolerance_value']."%)", "1","1","C",0);

      }
    
    }
    $pdf->setLeftMargin(10);
    $pdf->SetFont('Arial','B',12);

          
    }  /*End of if (in_array($row['id'], ['43']))*/

    if (in_array($row['id'], ['20', '65']))
    {
        $counter = $counter + 37; 

        if($counter>300)
        {
            $pdf->AddPage();
            $counter =30;
            $counter = $counter + 37;
            $pdf->SetLeftMargin(6);
        }

       if (($row_for_defining_process['cf_to_water_spotting_surface_max_value']<>0 && $row_for_qc['cf_to_water_spotting_surface_value']<>0) || ($row_for_defining_process['cf_to_water_spotting_edge_max_value']<>0 && $row_for_qc['cf_to_water_spotting_edge_value']<>0) || ($row_for_defining_process['cf_to_water_spotting_cross_staining_max_value']<>0 && $row_for_qc['cf_to_water_spotting_cross_staining_value']<>0))
       {
            

        $serial+=1;
        $pdf->Ln(6);
        $pdf->SetLeftMargin(10);
        $pdf->Cell(10,5,$serial.".", "0", "0","L");
        $pdf->Cell(190,5,$row['test_name_method']." : ", "0", "1","L");
        $pdf->Ln(2);
        $pdf->setLeftMargin(17);
        $pdf->SetFont('Arial','B',10);
        $pdf->Cell(120,6," Result", "1","0","C",0);
        $pdf->Cell(60,6," Requirements ", "1","1","C",0);
        $pdf->SetFont('Arial','',10);
        $pdf->Cell(60,6," Surface ", "1","0","L",0);
        $pdf->Cell(60,6,$row_for_qc['cf_to_water_spotting_surface_value'].' '.$row_for_defining_process['uom_of_cf_to_water_spotting_surface'], "1","0","C",0);

        if($row_for_defining_process['cf_to_water_spotting_surface_tolerance_range_math_op'] == '≥')
        {
            $cf_to_water_spotting_surface_tolerance_range_math_op = $pdf->Image('../img/greater_equal.png',162, $pdf->GetY()+2, 2).'';
            $pdf->Cell(60,6,$cf_to_water_spotting_surface_tolerance_range_math_op.' '.$row_for_defining_process['cf_to_water_spotting_surface_tolerance_value'].' '.$row_for_defining_process['uom_of_cf_to_water_spotting_surface'], "1","1","C",0);

        }
        else if($row_for_defining_process['cf_to_water_spotting_surface_tolerance_range_math_op'] == '≤')
        {
            $cf_to_water_spotting_surface_tolerance_range_math_op = $pdf->Image('../img/less_equal.png',162, $pdf->GetY()+2, 2).'';
            $pdf->Cell(60,6,$cf_to_water_spotting_surface_tolerance_range_math_op.' '.$row_for_defining_process['cf_to_water_spotting_surface_tolerance_value'].' '.$row_for_defining_process['uom_of_cf_to_water_spotting_surface'], "1","1","C",0);

        }
        else if($row_for_defining_process['cf_to_water_spotting_surface_tolerance_range_math_op'] == '>')
        {
            $cf_to_water_spotting_surface_tolerance_range_math_op = '>';
            $pdf->Cell(60,6,$cf_to_water_spotting_surface_tolerance_range_math_op.' '.$row_for_defining_process['cf_to_water_spotting_surface_tolerance_value'].' '.$row_for_defining_process['uom_of_cf_to_water_spotting_surface'], "1","1","C",0);

        }
        else if($row_for_defining_process['cf_to_water_spotting_surface_tolerance_range_math_op'] == '<')
        {
            $cf_to_water_spotting_surface_tolerance_range_math_op = '<';
            $pdf->Cell(60,6,$cf_to_water_spotting_surface_tolerance_range_math_op.' '.$row_for_defining_process['cf_to_water_spotting_surface_tolerance_value'].' '.$row_for_defining_process['uom_of_cf_to_water_spotting_surface'], "1","1","C",0);

        }

            
        $pdf->Cell(60,6," Edge", "1","0","l",0);
        $pdf->Cell(60,6,$row_for_qc['cf_to_water_spotting_edge_value'].' '.$row_for_defining_process['uom_of_cf_to_water_spotting_edge'], "1","0","C",0);

        if($row_for_defining_process['cf_to_water_spotting_edge_tolerance_range_math_op'] == '≥')
        {
            $cf_to_water_spotting_edge_tolerance_range_math_op = $pdf->Image('../img/greater_equal.png',162, $pdf->GetY()+2, 2).'';
            $pdf->Cell(60,6,$cf_to_water_spotting_edge_tolerance_range_math_op.' '.$row_for_defining_process['cf_to_water_spotting_edge_tolerance_value'].' '.$row_for_defining_process['uom_of_cf_to_water_spotting_edge'], "1","1","C",0);

        }
        else if($row_for_defining_process['cf_to_water_spotting_edge_tolerance_range_math_op'] == '≤')
        {
            $cf_to_water_spotting_edge_tolerance_range_math_op = $pdf->Image('../img/less_equal.png',162, $pdf->GetY()+2, 2).'';
            $pdf->Cell(60,6,$cf_to_water_spotting_edge_tolerance_range_math_op.' '.$row_for_defining_process['cf_to_water_spotting_edge_tolerance_value'].' '.$row_for_defining_process['uom_of_cf_to_water_spotting_edge'], "1","1","C",0);

        }
        else if($row_for_defining_process['cf_to_water_spotting_edge_tolerance_range_math_op'] == '>')
        {
            $cf_to_water_spotting_edge_tolerance_range_math_op = '>';
            $pdf->Cell(60,6,$cf_to_water_spotting_edge_tolerance_range_math_op.' '.$row_for_defining_process['cf_to_water_spotting_edge_tolerance_value'].' '.$row_for_defining_process['uom_of_cf_to_water_spotting_edge'], "1","1","C",0);

        }
        else if($row_for_defining_process['cf_to_water_spotting_edge_tolerance_range_math_op'] == '<')
        {
            $cf_to_water_spotting_edge_tolerance_range_math_op = '<';
            $pdf->Cell(60,6,$cf_to_water_spotting_edge_tolerance_range_math_op.' '.$row_for_defining_process['cf_to_water_spotting_edge_tolerance_value'].' '.$row_for_defining_process['uom_of_cf_to_water_spotting_edge'], "1","1","C",0);

        }

           

        $pdf->Cell(60,6," Cross Staining", "1","0","l",0);
        $pdf->Cell(60,6,$row_for_qc['cf_to_water_spotting_cross_staining_value'].' '.$row_for_defining_process['uom_of_cf_to_water_spotting_cross_staining'], "1","0","C",0);

        if($row_for_defining_process['cf_to_water_spotting_cross_staining_tolerance_range_math_op'] == '≥')
        {
        $cf_to_water_spotting_cross_staining_tolerance_range_math_op = $pdf->Image('../img/greater_equal.png',162, $pdf->GetY()+2, 2).'';
        $pdf->Cell(60,6,$cf_to_water_spotting_cross_staining_tolerance_range_math_op.' '.$row_for_defining_process['cf_to_water_spotting_cross_staining_tolerance_value'].' '.$row_for_defining_process['uom_of_cf_to_water_spotting_cross_staining'], "1","1","C",0);

        }
        else if($row_for_defining_process['cf_to_water_spotting_cross_staining_tolerance_range_math_op'] == '≤')
        {
        $cf_to_water_spotting_cross_staining_tolerance_range_math_op = $pdf->Image('../img/less_equal.png',162, $pdf->GetY()+2, 2).'';
        $pdf->Cell(60,6,$cf_to_water_spotting_cross_staining_tolerance_range_math_op.' '.$row_for_defining_process['cf_to_water_spotting_cross_staining_tolerance_value'].' '.$row_for_defining_process['uom_of_cf_to_water_spotting_cross_staining'], "1","1","C",0);

        }
        else if($row_for_defining_process['cf_to_water_spotting_cross_staining_tolerance_range_math_op'] == '>')
        {
        $cf_to_water_spotting_cross_staining_tolerance_range_math_op = '>';
        $pdf->Cell(60,6,$cf_to_water_spotting_cross_staining_tolerance_range_math_op.' '.$row_for_defining_process['cf_to_water_spotting_cross_staining_tolerance_value'].' '.$row_for_defining_process['uom_of_cf_to_water_spotting_cross_staining'], "1","1","C",0);

        }
        else if($row_for_defining_process['cf_to_water_spotting_cross_staining_tolerance_range_math_op'] == '<')
        {
        $cf_to_water_spotting_cross_staining_tolerance_range_math_op = '<';
        $pdf->Cell(60,6,$cf_to_water_spotting_cross_staining_tolerance_range_math_op.' '.$row_for_defining_process['cf_to_water_spotting_cross_staining_tolerance_value'].' '.$row_for_defining_process['uom_of_cf_to_water_spotting_cross_staining'], "1","1","C",0);

        }
     
    }
    $pdf->setLeftMargin(10);
    $pdf->SetFont('Arial','B',12);

         
    }  /*End of if (in_array($row['id'], ['20', '65']))*/

    if (in_array($row['id'], ['21','22', '66']))
    {
            
        $counter = $counter + 37; 

        if($counter>300)
        {
            $pdf->AddPage();
            $counter =30;
            $counter = $counter + 37;
            $pdf->SetLeftMargin(6);
        }

       if (($row_for_defining_process['resistance_to_surface_wetting_before_wash_max_value']<>0 && $row_for_qc['resistance_to_surface_wetting_before_wash_value']<>0) || ($row_for_defining_process['resistance_to_surface_wetting_after_one_wash_value']<>0 && $row_for_qc['resistance_to_surface_wetting_after_one_wash_value']<>0) || ($row_for_defining_process['resistance_to_surface_wetting_after_five_wash_max_value']<>0 && $row_for_qc['resistance_to_surface_wetting_after_five_wash_value']<>0) )
        {

            $serial+=1;
            $pdf->Ln(6);
            $pdf->SetLeftMargin(10);
            $pdf->Cell(10,5,$serial.".", "0", "0","L");
            $pdf->Cell(190,5,$row['test_name_method']." : ", "0", "1","L");
            $pdf->Ln(2);
            $pdf->setLeftMargin(17);
            $pdf->SetFont('Arial','B',10);
            $pdf->Cell(120,6," Result", "1","0","C",0);
            $pdf->Cell(60,6," Requirements ", "1","1","C",0);
            $pdf->SetFont('Arial','',10);
            $pdf->Cell(60,6,"Before Wash ", "1","0","C",0);
            $pdf->Cell(60,6,$row_for_qc['resistance_to_surface_wetting_before_wash_value'].' '.$row_for_defining_process['uom_of_resistance_to_surface_wetting_before_wash'], "1","0","C",0);
            $pdf->Cell(60,6,$row_for_defining_process['resistance_to_surface_wetting_before_wash_tol_range_math_op'].' '.$row_for_defining_process['resistance_to_surface_wetting_before_wash_tolerance_value'].' '.$row_for_defining_process['uom_of_resistance_to_surface_wetting_before_wash'], "1","1","C",0);
            
            $pdf->Cell(60,6," After One Wash", "1","0","C",0);
            $pdf->Cell(60,6,$row_for_qc['resistance_to_surface_wetting_after_one_wash_value'].' '.$row_for_defining_process['uom_of_resistance_to_surface_wetting_after_one_wash'], "1","0","C",0);
            $pdf->Cell(60,6,$row_for_defining_process['resistance_to_surface_wetting_after_one_wash_tol_range_math_op'].' '.$row_for_defining_process['resistance_to_surface_wetting_after_one_wash_tolerance_value'].' '.$row_for_defining_process['uom_of_resistance_to_surface_wetting_after_one_wash'], "1","1","C",0);
            
            $pdf->Cell(60,6," After Five Wash ", "1","0","C",0);
            $pdf->Cell(60,6,$row_for_qc['resistance_to_surface_wetting_after_five_wash_value'].' '.$row_for_defining_process['uom_of_resistance_to_surface_wetting_after_five_wash'], "1","0","C",0);
            $pdf->Cell(60,6,$row_for_defining_process['resistance_to_surface_wetting_after_five_wash_tol_range_math_op'].' '.$row_for_defining_process['resistance_to_surface_wetting_after_five_wash_tolerance_value'].' '.$row_for_defining_process['uom_of_resistance_to_surface_wetting_after_five_wash'], "1","1","C",0);
           
        }
        $pdf->setLeftMargin(10);
        $pdf->SetFont('Arial','B',12);

                                   
    }  /*End of if (in_array($row['id'], [['21','22', '66']))*/

    if (in_array($row['id'], ['26', '70']))
    {
       if($row_for_defining_process['cf_to_pvc_migration_staining_max_value']<>0 && $row_for_qc['cf_to_pvc_migration_staining_value']<>0)
       {

        



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

        $counter = $counter + 31; 

        if($counter>300)
        {
            $pdf->AddPage();
            $counter =30;
            $counter = $counter + 31;
            $pdf->SetLeftMargin(6);
        }
          
        $serial+=1;
        $pdf->Ln(6);
        $pdf->SetLeftMargin(10);
        $pdf->Cell(10,5,$serial.".", "0", "0","L");
        $pdf->Cell(190,5,$row['test_name_method']." : ", "0", "1","L");
        $pdf->Ln(2);
        $pdf->setLeftMargin(17);
        $pdf->SetFont('Arial','B',10);
        $pdf->Cell(120,6," Color Change ", "1","0","C",0);
        $pdf->Cell(60,6," Requirements ", "1","1","C",0);
        $pdf->Cell(60,12," Staining ", "1","0","C",0);
        $pdf->Cell(60,6," Colors ", "1","0","C",0);
        $pdf->SetFont('Arial','',10);

        if($row_for_defining_process['cf_to_pvc_migration_staining_tolerance_range_math_operator'] == '≥')
        {
           $cf_to_pvc_migration_staining_tolerance_range_math_operator = $pdf->Image('../img/greater_equal.png',160, $pdf->GetY()+5, 2).'';
           $pdf->Cell(60,12,$cf_to_pvc_migration_staining_tolerance_range_math_operator. ' '.($cf_to_pvc_migration_staining_tolerance_value), "1","0","C",0);

        }
        else if($row_for_defining_process['cf_to_pvc_migration_staining_tolerance_range_math_operator'] == '≤')
        {
           $cf_to_pvc_migration_staining_tolerance_range_math_operator = $pdf->Image('../img/less_equal.png',160, $pdf->GetY()+5, 2).'';
           $pdf->Cell(60,12,$cf_to_pvc_migration_staining_tolerance_range_math_operator. ' '.($cf_to_pvc_migration_staining_tolerance_value), "1","0","C",0);

        }
        else if($row_for_defining_process['cf_to_pvc_migration_staining_tolerance_range_math_operator'] == '>')
        {
           $cf_to_pvc_migration_staining_tolerance_range_math_operator = '>';
            $pdf->Cell(60,12,$cf_to_pvc_migration_staining_tolerance_range_math_operator. ' '.($cf_to_pvc_migration_staining_tolerance_value), "1","0","C",0);

        }
        else if($row_for_defining_process['cf_to_pvc_migration_staining_tolerance_range_math_operator'] == '<')
        {
           $cf_to_pvc_migration_staining_tolerance_range_math_operator = '<';
           $pdf->Cell(60,12,$cf_to_pvc_migration_staining_tolerance_range_math_operator. ' '.($cf_to_pvc_migration_staining_tolerance_value), "1","0","C",0);

        }

        $pdf->Cell(0,6,"  ", "0","1","C",0); //dummy cell for new line

        $pdf->Cell(60,6,"  ", "0","0","C",0); //dummy cell for space
        $pdf->Cell(60,6,$cf_to_pvc_migration_staining_value, "1","0","C",0);
        $pdf->Cell(60,6,"  ", "0","0","C",0); //dummy cell for space

        $pdf->Ln(8);

        }
        $pdf->setLeftMargin(10);
        $pdf->SetFont('Arial','B',12);
    } /*End of if (in_array($row['id'], ['26', '26', '70']))*/

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

        $counter = $counter + 37; 

        if($counter>300)
        {
            $pdf->AddPage();
            $counter =30;
            $counter = $counter + 37;
            $pdf->SetLeftMargin(6);
        }

            $pdf->Ln(6);
            $pdf->SetLeftMargin(10);
            $pdf->Cell(10,5,$serial.".", "0", "0","L");
            $pdf->Cell(190,5,$row['test_name_method']." : ", "0", "1","L");
            $pdf->Ln(2);
            $pdf->setLeftMargin(17);
            $pdf->SetFont('Arial','B',10);
            $pdf->Cell(145,6," Result ", "1","0","C",0);
            $pdf->Cell(35,6," Requirements ", "1","1","C",0);
            $pdf->Cell(26,6," ", "LTR","0","C",0);
            $pdf->Cell(119,6," Shade Change ", "1","0","C",0);
            $pdf->Cell(35,6,"  ", "LTR","1","C",0);
            $pdf->Cell(26,6,"Color Change", "LBR","0","C",0);
            $pdf->Cell(17,6,$row_for_qc['cf_to_light_shade_color_1'], "1","0","C",0);
            $pdf->Cell(17,6,$row_for_qc['cf_to_light_shade_color_2'], "1","0","C",0);
            $pdf->Cell(17,6,$row_for_qc['cf_to_light_shade_color_3'], "1","0","C",0);
            $pdf->Cell(17,6,$row_for_qc['cf_to_light_shade_color_4'], "1","0","C",0);
            $pdf->Cell(17,6,$row_for_qc['cf_to_light_shade_color_5'], "1","0","C",0);
            $pdf->Cell(17,6,$row_for_qc['cf_to_light_shade_color_6'], "1","0","C",0);
            $pdf->Cell(17,6,$row_for_qc['cf_to_light_shade_color_7'], "1","0","C",0);
            $pdf->Cell(35,6," Staining ", "LBR","1","C",0);

            $pdf->SetFont('Arial','',10);
            $pdf->Cell(26,6,$cf_to_artificial_day_light_value, "LBR","0","C",0);
            $pdf->Cell(17,6,$cf_to_light_shade_color_1_value, "1","0","C",0);
                $pdf->Cell(17,6,$cf_to_light_shade_color_2_value, "1","0","C",0);
                $pdf->Cell(17,6,$cf_to_light_shade_color_3_value, "1","0","C",0);
                $pdf->Cell(17,6,$cf_to_light_shade_color_4_value, "1","0","C",0);
                $pdf->Cell(17,6,$cf_to_light_shade_color_5_value, "1","0","C",0);
                $pdf->Cell(17,6,$cf_to_light_shade_color_6_value, "1","0","C",0);
                $pdf->Cell(17,6,$cf_to_light_shade_color_7_value, "1","0","C",0);

            if($row_for_defining_process['color_fastess_to_artificial_daylight_tolerance_range_math_op'] == '≥')
            {
               $color_fastess_to_artificial_daylight_tolerance_range_math_op = $pdf->Image('../img/greater_equal.png',162, $pdf->GetY()+2, 2).'';
               $pdf->Cell(35,6,$color_fastess_to_artificial_daylight_tolerance_range_math_op.' '.$color_fastess_to_artificial_daylight_tolerance_value, "1","0","C",0);

            }
            else if($row_for_defining_process['color_fastess_to_artificial_daylight_tolerance_range_math_op'] == '≤')
            {
               $color_fastess_to_artificial_daylight_tolerance_range_math_op = $pdf->Image('../img/less_equal.png',162, $pdf->GetY()+2, 2).'';
               $pdf->Cell(35,6,$color_fastess_to_artificial_daylight_tolerance_range_math_op.' '.$color_fastess_to_artificial_daylight_tolerance_value, "1","0","C",0);

            }
            else if($row_for_defining_process['color_fastess_to_artificial_daylight_tolerance_range_math_op'] == '>')
            {
               $color_fastess_to_artificial_daylight_tolerance_range_math_op = '>';
               $pdf->Cell(35,6,$color_fastess_to_artificial_daylight_tolerance_range_math_op.' '.$color_fastess_to_artificial_daylight_tolerance_value, "1","0","C",0);

            }
            else if($row_for_defining_process['color_fastess_to_artificial_daylight_tolerance_range_math_op'] == '<')
            {
               $color_fastess_to_artificial_daylight_tolerance_range_math_op = '<';
               $pdf->Cell(35,6,$color_fastess_to_artificial_daylight_tolerance_range_math_op.' '.$color_fastess_to_artificial_daylight_tolerance_value, "1","0","C",0);

            }
        }
        $pdf->setLeftMargin(10);
        $pdf->SetFont('Arial','B',12);
        $pdf->Ln(4);

    } /* ENd of if (in_array($row['id'], ['40']))*/


    if (in_array($row['id'], ['74']))
    {
       
       if (($row_for_defining_process['warp_yarn_count_max_value']<>0 && $row_for_qc['warp_yarn_count_value']<>0) || ($row_for_defining_process['weft_yarn_count_max_value']<>0 && $row_for_qc['weft_yarn_count_value']<>0) )
       {
        $content_warp_yarn_count = urlencode($row_for_defining_process['warp_yarn_count_tolerance_range_math_operator']);

        $warp_yarn_count_tolerance_range_math_operator = urldecode($pdf->sp_character($content_warp_yarn_count));
             

        $content_weft_yarn_count = urlencode($row_for_defining_process['weft_yarn_count_tolerance_range_math_operator']);

        $weft_yarn_count_tolerance_range_math_operator = urldecode($pdf->sp_character($content_weft_yarn_count));

        $counter = $counter + 31; 

        if($counter>300)
        {
            $pdf->AddPage();
            $counter =30;
            $counter = $counter + 31;
            $pdf->SetLeftMargin(6);
        }

        $serial+=1;
        $pdf->Ln(6);
        $pdf->SetLeftMargin(10);
        $pdf->Cell(10,5,$serial.".", "0", "0","L");
        $pdf->Cell(190,5,$row['test_name_method']." : ", "0", "1","L");
        $pdf->Ln(2);
        $pdf->setLeftMargin(17);
        $pdf->SetFont('Arial','B',10);
        $pdf->Cell(120,6," Result", "1","0","C",0);
        $pdf->Cell(60,6," Requirements ", "1","1","C",0);
        $pdf->SetFont('Arial','',10);
        $pdf->Cell(60,6," Warp ", "1","0","C",0);
        $pdf->Cell(60,6,$row_for_qc['warp_yarn_count_value'].' ' .$row_for_defining_process['uom_of_warp_yarn_count_value'], "1","0","C",0);
        $pdf->Cell(60,6,$row_for_defining_process['warp_yarn_count_value'].' ' .$row_for_defining_process['uom_of_warp_yarn_count_value']." (".$warp_yarn_count_tolerance_range_math_operator.' '.$row_for_defining_process['warp_yarn_count_tolerance_value'].")%", "1","1","C",0);
        
        $pdf->Cell(60,6," Weft", "1","0","C",0);
        $pdf->Cell(60,6,$row_for_qc['weft_yarn_count_value'].' ' .$row_for_defining_process['uom_of_weft_yarn_count_value'], "1","0","C",0);
        $pdf->Cell(60,6,$row_for_defining_process['weft_yarn_count_value'].' ' .$row_for_defining_process['uom_of_weft_yarn_count_value']." (".$weft_yarn_count_tolerance_range_math_operator.' '.$row_for_defining_process['weft_yarn_count_tolerance_value'].")%", "1","1","C",0);
        
       
    }
    $pdf->setLeftMargin(10);
    $pdf->SetFont('Arial','B',12);
           
         

    } /*End of if (in_array($row['id'], ['74']))*/


    

        

       

        

    }

// $pdf->Ln(10);
// $pdf->AddPage();
// for($i=1;$i<=200;$i++)
// {
    
//     $count=10;
//     if( ($i+$count) <= 35 )
//     {
//         $pdf->Cell(60,6,$i, "1","1","C");
//     }
//     else
//     {
//        // $pdf->AddPage();
//         $pdf->AcceptPageBreak();
//         $pdf->SetAutoPageBreak(true, 50);
//         $pdf->Cell(60,6,$i.'kkk', "1","1","C");
//     }
        
// }


// $pdf->Ln();
$pdf->SetFont('Times','',9);
//  $pdf->Ln(10);
// $pdf->AddPage();
// for($i=1;$i<=100;$i++)
// {
//     $pdf->Cell(25,6,$i,1,1,'C');
// }

ob_end_clean();

$pdf->Output('I', "all_test_merge_report_for_finishing_process_'$trf_id'.pdf", true);
// ob_end_flush();
?>
