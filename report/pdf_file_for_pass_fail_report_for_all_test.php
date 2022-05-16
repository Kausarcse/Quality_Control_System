
<?php
// ob_start();
/*require("../fpdf/fpdf.php");*/
error_reporting(0);
include '../fpdf/code128.php';
session_start();
/*$user_name=$_SESSION['user_name'];*/
//include('../barcode/barcode.php');


require_once("../login/session.php");
include('../login/db_connection_class.php');
$obj = new DB_Connection_Class();
$obj->connection();


$all_data=$_GET['all_data'];

$split_all_data=explode("?fs?", $all_data);

$trf_id=$split_all_data[0];
if($trf_id == 'select')
{
	$trf_id = '';
}
$version_id=$split_all_data[1]; 
$pp_number=$split_all_data[2];
$process_id=$split_all_data[3];
$process_name_v=$split_all_data[4];
$style_name=$split_all_data[5];
$finish_width_in_inch=$split_all_data[6];
$before_trolley_number_or_batcher_number=$split_all_data[7];
$after_trolley_number_or_batcher_number=$split_all_data[8];
$after_trolley_or_batcher_qty_direct=$split_all_data[9];

$currnet_date = date("Y-m-d");




$sql_for_trf = "select * from partial_test_for_test_result_info ptftri
				left join pp_wise_version_creation_info  pwvci on ptftri.pp_number=pwvci.pp_number and ptftri.version_id=pwvci.version_id and ptftri.style=pwvci.style_name and ptftri.finish_width_in_inch=pwvci.finish_width_in_inch
				left join process_program_info ppi on ptftri.pp_number=ppi.pp_number
				where ptftri.trf_id = '$trf_id' or (ptftri.version_id='$version_id' and ptftri.pp_number='$pp_number' and ptftri.process_id='$process_id' and ptftri.process_name = '$process_name_v' and 
				ptftri.finish_width_in_inch='$finish_width_in_inch' and ptftri.before_trolley_number_or_batcher_number='$before_trolley_number_or_batcher_number' and 
				ptftri.after_trolley_number_or_batcher_number='$after_trolley_number_or_batcher_number')";

$result_for_trf= mysqli_query($con,$sql_for_trf) or die(mysqli_error($con));
$row_for_trf=mysqli_fetch_array($result_for_trf);



$sql_for_pp_version="SELECT * FROM  pp_wise_version_creation_info WHERE pp_number='$pp_number' and version_id='$version_id' and style_name='$style_name' and finish_width_in_inch='$finish_width_in_inch'";

$result_for_pp_version= mysqli_query($con,$sql_for_pp_version) or die(mysqli_error($con));
$row_for_pp_version=mysqli_fetch_array($result_for_pp_version);


$sql_for_pp_info="SELECT * FROM  process_program_info WHERE pp_number='$pp_number'";

$result_for_pp_info= mysqli_query($con,$sql_for_pp_info) or die(mysqli_error($con));
$row_for_pp_info=mysqli_fetch_array($result_for_pp_info);


$get_date=$row_for_trf['partial_test_for_test_result_creation_date'];
$date=explode('-',$get_date);
$merge_date=$date[1].'/'.$date[2].'/'.$date[0];


$process_name= $row_for_trf['process_name']; 

$washing= $row_for_trf['washing'];
$bleaching= $row_for_trf['bleaching'];
$ironing= $row_for_trf['ironing'];
$dry_cleaning= $row_for_trf['dry_cleaning'];
$drying= $row_for_trf['drying'];

?>
<script>

var dt = new Date();
document.getElementById("datetime").innerHTML = dt.toLocaleString();


</script>


<?php



class PDF extends PDF_Code128
{
// Page header
function Header()
{
    // Logo
    //$this->Image('logo.png',10,6,30);
    // Arial bold 15
    // Move to the right
    $this->setTopMargin(0);

    $this->SetFont('Arial','B',12);
    // $this->Cell(80);
    $this->setLeftMargin(0);
    $this->SetTextColor(0,0,0);

    $this->Cell(150,5,'Zaber & Zubir Quality Control Processing Laboratory',"0","0",'L');
    // $pdf->SetFont('Arial','B',10);
    $this->Ln(2);

    $this->Image('../img/zz_logo.png',5,15,20);

    $this->setLeftMargin(27);
    $this->Ln(5);
    $this->setTextColor(0,0,0);
    $this->SetFont('Arial','',8);
    $this->Cell(105,3,"PAGAR, TONGI, GAZIPUR, BANGLADESH","0","0","L");
    // $this->Ln(1);
    // $this->SetFont('Arial','',8);
    $this->Ln(3);
    $this->Cell(105,3,"Contact Info : (+8802) 9801012, 9801146 Visit us at www.znzfab.com, ","0","0","L");
    // $this->Ln(1);
    // $this->SetFont('Arial','',8);
    $this->Ln(3);
    $this->Cell(50,3,"E-mail : ftslab@znzfab.com","0","0","L");
    // $this->setLeftMargin(5);
    // $this->Ln(4);
    // $this->Cell(170,0,"",1,0,"L");
    // $this->setTopMargin(3);

   
         // $this->SetFont('Arial','',16);
         // $this->Cell(0,6,'Symbol',0,1,'C');
        
    
   //  $this->SetCol(0);


$this->Ln(8);
$this->setLeftMargin(10);

}

// Page footer
function Footer()
{
    // Position at 1.5 cm from bottom
    $this->SetFont('Times','',6);
    $this->SetY(-8);    // Arial italic 8
    $this->SetTextColor(0,0,0);

    $this->SetFont('Arial','I',8);
    // Page number
    $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');

}
}






// Instanciation of inherited class
/*$pdf = new PDF('P','mm','A4');*/
$pdf=new PDF('P','mm','A4');
// $pdf=new PDF_Code128('P','mm',array(101.6,101.6));
$pdf->AliasNbPages();
$pdf->AddPage();

$pdf->Ln(0);
$pdf->setTopMargin(0);
$pdf->setLeftMargin(135);
$pdf->SetAutoPageBreak(true, 10);
$pdf->setTopMargin(10);

$pdf->Cell(60,-25,"Date of Publish:  ".$currnet_date,0,0,'L');
$pdf->Ln(3);
$pdf->Cell(60,-20,'Date of Testing:  '.$merge_date,"0","0",'L');
// $pdf->SetFont('Arial','B',25);


$pdf->setLeftMargin(6);

$pdf->SetFont('Arial','',8);
$pdf->Ln(0);
$pdf->Code128(136,28,$trf_id,50,8);

$pdf->Ln(0);
$pdf->SetFont('Arial','B',14);
$pdf->Cell(120,5,"All Test Report - ".$process_name,"0","0","L");
$pdf->Ln(2);
$pdf->SetFont('Arial','',8);
$pdf->Cell(300,5,"TRF ID : ".$trf_id,"0","0","C");
//  $pdf->Ln(4);
// $pdf->setLeftMargin(6);
// $pdf->Cell(95,6,$pdf->result($data_r),1,0,'L');

$pdf->setLeftMargin(10);
$pdf->Ln(6);
$pdf->SetFont('Arial','B',12);
$pdf->Cell(100,5,"Sample Information : ","0","1","L");
$pdf->Ln(2);
// $pdf->setLeftMargin(12);
$pdf->SetFont('Arial','',8);
$pdf->Cell(42,5,"Sample Details(PP Description)","1","0","L");
$pdf->Cell(5,5," : ","1","0","L");
$pdf->Cell(54,5,$row_for_trf['pp_description'],"1","0","L");
$pdf->Cell(30,5,"Fiber Composition","1","0","L");
$pdf->Cell(5,5," : ","1","0","L");
$pdf->Cell(54,5,$row_for_trf['fiber_composition'],"1","1","L");

$pdf->Cell(42,5,"PP No.","1","0","L");
$pdf->Cell(5,5," : ","1","0","L");
$pdf->Cell(54,5,$row_for_trf['pp_number'],"1","0","L");
$pdf->Cell(30,5,"Process Technique","1","0","L");
$pdf->Cell(5,5," : ","1","0","L");
$pdf->Cell(54,5,$row_for_trf['process_technique_name'],"1","1","L");

$pdf->Cell(42,5,"Week","1","0","L");
$pdf->Cell(5,5," : ","1","0","L");
$pdf->Cell(54,5,$row_for_trf['week_in_year'],"1","0","L");
$pdf->Cell(30,5,"After Trolley/Batcher","1","0","L");
$pdf->Cell(5,5," : ","1","0","L");
$pdf->Cell(54,5,$row_for_trf['after_trolley_number_or_batcher_number'],"1","1","L");

$pdf->Cell(42,5,"Design","1","0","L");
$pdf->Cell(5,5," : ","1","0","L");
$pdf->Cell(54,5,$row_for_trf['design'],"1","0","L");
$pdf->Cell(30,5,"Machine","1","0","L");
$pdf->Cell(5,5," : ","1","0","L");
$pdf->Cell(54,5,$row_for_trf['machine_name'],"1","1","L");

$pdf->Cell(42,5,"Version","1","0","L");
$pdf->Cell(5,5," : ","1","0","L");
$pdf->Cell(54,5,$row_for_trf['version_number'],"1","0","L");
$pdf->Cell(30,5,"Shift","1","0","L");
$pdf->Cell(5,5," : ","1","0","L");
$pdf->Cell(54,5,$row_for_trf['shift'],"1","1","L");

$pdf->Cell(42,5,"Style","1","0","L");
$pdf->Cell(5,5," : ","1","0","L");
$pdf->Cell(54,5,$row_for_trf['style_name'],"1","0","L");
$pdf->Cell(30,5,"Finish Width(Inch)","1","0","L");
$pdf->Cell(5,5," : ","1","0","L");
$pdf->Cell(54,5,$row_for_trf['finish_width_in_inch'],"1","1","L");

$pdf->Cell(42,5,"Color","1","0","L");
$pdf->Cell(5,5," : ","1","0","L");
$pdf->Cell(54,5,$row_for_trf['color'],"1","0","L");
$pdf->Cell(30,5,"Quantity(mtr.)","1","0","L");
$pdf->Cell(5,5," : ","1","0","L");
$pdf->Cell(54,5,$row_for_trf['after_trolley_or_batcher_qty'],"1","1","L");

$pdf->Cell(42,7,"Construction","1","0","L");
$pdf->Cell(5,7," : ","1","0","L");
$pdf->Cell(54,7,$row_for_trf['construction_name'],"1","0","L");
$pdf->Cell(30,7,"Care Instruction","1","0","L");
$pdf->Cell(5,7," : ","1","0","L");


$y = $pdf->GetY() +0.5;
$pdf->Cell(54,7, $pdf->Image($washing,150, $y, 8).$pdf->Image($bleaching,160, $y, 7).$pdf->Image($ironing,170, $y, 7).$pdf->Image($drying,180, $y, 6).$pdf->Image($dry_cleaning,190, $y, 7),"1","1","L");
//$pdf->Cell(60,4, "Care Instruction :".$pdf->Image($washing,27, $pdf->GetY(), 5).$pdf->Image($bleaching,32, $pdf->GetY(), 3),"1","0","L");

$pdf->Ln(3);


// $pdf->setLeftMargin(5);
$pdf->SetFont('Arial','B',12);
$pdf->Cell(100,5,"Test Result : ","0","1","L");
// $pdf->setLeftMargin(12);
$pdf->SetFillColor(0,0,0); // input R, G, B
$pdf->SetFont('Times','B',10);
$pdf->Cell(124,5,"Test Name", "1", "0","C");
$pdf->Cell(21,5,"Test Result", "1", "0","C");
$pdf->Cell(30,5,"Requirements", "1", "0","C");
$pdf->Cell(15,5,"Remarks", "1", "0","C");
$pdf->Ln();
$pdf->SetFont('Times','',8);
// $pdf->dataTable();

// $str = '4';
// $pdf->SetFont('Symbol','',8); 
// $pdf->Cell(100,5, chr(179),'1',0,'L');

// $pdf->SetFont('Times','',8); # restore original font
// $x = $pdf->GetX(); 
// $y = $pdf->GetY(); 
// $pdf->SetXY($x-98,$y);

// $pdf->Cell(0,5,$str);
//  $str_len = strlen($str)+2;
// $pdf->SetXY($x-(98-$str_len),$y);

// $pdf->Cell(0,5,"ok"); 
// $pdf->SetXY($x-1,$y+0.5);

// $pdf->Ln(10);

$customer_id=$row_for_trf['customer_id'];
$customer_name=$row_for_trf['customer_name'];
$pp_number=$row_for_trf['pp_number'];
$version_number=$row_for_trf['version_number'];
$style=$row_for_trf['style'];
$finish_width_in_inch=$row_for_trf['finish_width_in_inch'];
$before_trolley_number_or_batcher_number=$row_for_trf['before_trolley_number_or_batcher_number'];
$after_trolley_number_or_batcher_number=$row_for_trf['after_trolley_number_or_batcher_number'];

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


/************ Displaying Result from qc_result table [End] ************/


$sql="SELECT DISTINCT tnmp.id, tmn.test_method_id, IF(tmn.test_method_name <> 'Other',concat(tmn.test_name,'(',tmn.test_method_name,')'),tmn.test_name) test_name_method
FROM test_name_and_method_for_all_process tnmp
INNER JOIN test_method_name tmn ON tnmp.id = tmn.test_name_and_method_for_process_id 
INNER JOIN transaction_test_name_and_method ttnm ON ttnm.test_name_and_method_for_process_id = tmn.test_name_and_method_for_process_id
INNER JOIN test_method_for_customer tmc ON tmc.test_id = ttnm.test_name_id AND tmc.test_method_id = tmn.test_method_id
WHERE tmc.customer_name = '$customer_name' ORDER BY ttnm.test_name_and_method_for_process_id ASC";


$sql_for_customer = "SELECT customer_type from customer WHERE customer_id = '$customer_id' AND customer_name = '$customer_name'";
	$result_for_customer = mysqli_query($con, $sql_for_customer) or die(mysqli_error($con));
	$row_for_customer = mysqli_fetch_assoc($result_for_customer);
	
	 $customer_type =  $row_for_customer['customer_type'];


// $pdf->Cell(100,4,$after_trolley_number_or_batcher_number."(Dry)" ,"1", "0","C");

$total_test= 0;
	$p= 0;
	$f= 0;

$data="";
$data_for_test_method_id="";
$test_name_method="";
$result= mysqli_query($con,$sql) or die(mysqli_error($con));
				 while( $row = mysqli_fetch_array( $result))
				 {

               if (in_array($row['id'], ['1']))
					{
						if ($row_for_defining_process['cf_to_rubbing_dry_max_value']<>0 && $row_for_qc['cf_to_rubbing_dry_value']<>0) 

							{
								$total_test++;


                                 // tolarence value
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
                                       // math operator
                        if($row_for_defining_process['cf_to_rubbing_dry_tolerance_range_math_operator'] == '≥')
                        {
                           $cf_to_rubbing_dry_tolerance_range_math_operator = $pdf->Image('../img/greater_equal.png',156, $pdf->GetY()+1.5, 1.7).'   ';
                        }
                        else if($row_for_defining_process['cf_to_rubbing_dry_tolerance_range_math_operator'] == '≤')
                        {
                           $cf_to_rubbing_dry_tolerance_range_math_operator = $pdf->Image('../img/less_equal.png',156, $pdf->GetY()+1.5, 1.7).'   ';
                        }
                        else if($row_for_defining_process['cf_to_rubbing_dry_tolerance_range_math_operator'] == '>')
                        {
                           $cf_to_rubbing_dry_tolerance_range_math_operator = '>';
                        }
                        else if($row_for_defining_process['cf_to_rubbing_dry_tolerance_range_math_operator'] == '<')
                        {
                           $cf_to_rubbing_dry_tolerance_range_math_operator = '<';
                        }

								if($row_for_defining_process['cf_to_rubbing_dry_min_value']<=$row_for_qc['cf_to_rubbing_dry_value'] && $row_for_defining_process['cf_to_rubbing_dry_max_value']>=$row_for_qc['cf_to_rubbing_dry_value'])
								{
									$p++;
                                    $pdf->Cell(124,5,$row['test_name_method']." (Dry)" ,"1", "0","L");
                                    $pdf->Cell(21,5,$cf_to_rubbing_dry_value.' ' .$row_for_defining_process['uom_of_cf_to_rubbing_dry'], "1", "0","L");
                                   
                                    $pdf->Cell(30,5,$cf_to_rubbing_dry_tolerance_range_math_operator.' '.$cf_to_rubbing_dry_tolerance_value.' '.$row_for_defining_process['uom_of_cf_to_rubbing_dry'], "1", "0","L");

                                    $pdf->Cell(15,5,"Pass", "1", "0","C");
                                    $pdf->Ln();
								}
								else 
								{
									$f++;
                                    $pdf->Cell(124,5,$row['test_name_method']." (Dry)" ,"1", "0","L");
                                    $pdf->Cell(21,5,$cf_to_rubbing_dry_value.' ' .$row_for_defining_process['uom_of_cf_to_rubbing_dry'], "1", "0","L");
                                    $pdf->Cell(30,5,$cf_to_rubbing_dry_tolerance_range_math_operator.' '.$cf_to_rubbing_dry_tolerance_value.' '.$row_for_defining_process['uom_of_cf_to_rubbing_dry'], "1", "0","L");
                                    $pdf->SetTextColor(194,8,8);

                                    $pdf->Cell(15,5,"Fail", "1", "0","C");
                                    $pdf->SetTextColor(0,0,0);
                                    $pdf->Ln();
									
								}
														
							}

						if ($row_for_defining_process['cf_to_rubbing_wet_max_value']<>0 && $row_for_qc['cf_to_rubbing_wet_value']<>0) 
							{
								$total_test++;

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

                        if($row_for_defining_process['cf_to_rubbing_wet_tolerance_range_math_operator'] == '≥')
                        {
                           $cf_to_rubbing_wet_tolerance_range_math_operator = $pdf->Image('../img/greater_equal.png',156, $pdf->GetY()+1.5, 1.7).'   ';
                        }
                        else if($row_for_defining_process['cf_to_rubbing_wet_tolerance_range_math_operator'] == '≤')
                        {
                           $cf_to_rubbing_wet_tolerance_range_math_operator = $pdf->Image('../img/less_equal.png',156, $pdf->GetY()+1.5, 1.7).'   ';
                        }
                        else if($row_for_defining_process['cf_to_rubbing_wet_tolerance_range_math_operator'] == '>')
                        {
                           $cf_to_rubbing_wet_tolerance_range_math_operator = '>';
                        }
                        else if($row_for_defining_process['cf_to_rubbing_wet_tolerance_range_math_operator'] == '<')
                        {
                           $cf_to_rubbing_wet_tolerance_range_math_operator = '<';
                        }

								if($row_for_defining_process['cf_to_rubbing_wet_min_value']<=$row_for_qc['cf_to_rubbing_wet_value'] && $row_for_defining_process['cf_to_rubbing_wet_max_value']>=$row_for_qc['cf_to_rubbing_wet_value'])
								{
									$p++;
									 $pdf->Cell(124,5,$row['test_name_method']." (Wet)" ,"1", "0","L");
                                    $pdf->Cell(21,5,$cf_to_rubbing_wet_value.' ' .$row_for_defining_process['uom_of_cf_to_rubbing_wet'], "1", "0","L");
                                    $pdf->Cell(30,5,$cf_to_rubbing_wet_tolerance_range_math_operator.' '.$cf_to_rubbing_wet_tolerance_value.' '.$row_for_defining_process['uom_of_cf_to_rubbing_wet'], "1", "0","L");
                                    $pdf->Cell(15,5,"Pass", "1", "0","C");
                                    $pdf->Ln();
								}
								else {
									$f++;
                                    $pdf->Cell(124,5,$row['test_name_method']." (Wet)" ,"1", "0","L");
                                    $pdf->Cell(21,5,$cf_to_rubbing_wet_value.' ' .$row_for_defining_process['uom_of_cf_to_rubbing_wet'], "1", "0","L");
                                    $pdf->Cell(30,5,$cf_to_rubbing_wet_tolerance_range_math_operator.' '.$cf_to_rubbing_wet_tolerance_value.' '.$row_for_defining_process['uom_of_cf_to_rubbing_wet'], "1", "0","L");
                                    $pdf->SetTextColor(194,8,8);

                                    $pdf->Cell(15,5,"Fail", "1", "0","C");
                                    $pdf->SetTextColor(0,0,0);
                                    $pdf->Ln();
									
								}
							}
						 
					}      /* End of if (in_array($row['id'], ['1','240','105','164','207','247','259','298']))*/


					if (in_array($row['id'], ['2']))
					{
						if ($row_for_defining_process['dimensional_stability_to_warp_washing_before_iron_max_value']<>0 && $row_for_qc['dimensional_stability_to_warp_washing_before_iron_value']<>0) 
						{
                            
                            $total_test++;

							if($row_for_defining_process['dimensional_stability_to_warp_washing_before_iron_min_value']<=$row_for_qc['dimensional_stability_to_warp_washing_before_iron_value'] && $row_for_defining_process['dimensional_stability_to_warp_washing_before_iron_max_value']>=$row_for_qc['dimensional_stability_to_warp_washing_before_iron_value'])
							{
								$p++;
                                $pdf->SetFont('Times','',7);
                                $pdf->Cell(124,5,$row['test_name_method']."(Before Iron-Warp)(".$row_for_defining_process['washing_cycle_for_warp_for_washing_before_iron'].' Wash)' ,"1", "0","L");
                                $pdf->SetFont('Times','',8);
                                $pdf->Cell(21,5,$row_for_qc['dimensional_stability_to_warp_washing_before_iron_value'].' ' .$row_for_defining_process['uom_of_dimensional_stability_to_warp_washing_before_iron'], "1", "0","L");
                                $pdf->Cell(30,5,$row_for_defining_process['dimensional_stability_to_warp_washing_before_iron_min_value'].' to '.$row_for_defining_process['dimensional_stability_to_warp_washing_before_iron_max_value'].' ('.$row_for_defining_process['uom_of_dimensional_stability_to_warp_washing_before_iron'].")", "1", "0","L");
                                $pdf->Cell(15,5,"Pass", "1", "0","C");
                                $pdf->Ln();
							}
							else {
								$f++;
                                $pdf->SetFont('Times','',7);
								        $pdf->Cell(124,5,$row['test_name_method']."(Before Iron-Warp)(".$row_for_defining_process['washing_cycle_for_warp_for_washing_before_iron'].' Wash)' ,"1", "0","L");
                                $pdf->SetFont('Times','',8);
                                $pdf->Cell(21,5,$row_for_qc['dimensional_stability_to_warp_washing_before_iron_value'].' ' .$row_for_defining_process['uom_of_dimensional_stability_to_warp_washing_before_iron'], "1", "0","L");
                                $pdf->Cell(30,5,$row_for_defining_process['dimensional_stability_to_warp_washing_before_iron_min_value'].' to '.$row_for_defining_process['dimensional_stability_to_warp_washing_before_iron_max_value'].' ('.$row_for_defining_process['uom_of_dimensional_stability_to_warp_washing_before_iron'].")", "1", "0","L");
                                $pdf->SetTextColor(194,8,8);

                                $pdf->Cell(15,5,"Fail", "1", "0","C");
                                $pdf->SetTextColor(0,0,0);
                                $pdf->Ln();
							}

							

						}

						if ($row_for_defining_process['dimensional_stability_to_weft_washing_before_iron_max_value']<>0 && $row_for_qc['dimensional_stability_to_weft_washing_before_iron_value']<>0) 
						{
							$total_test++;

							if($row_for_defining_process['dimensional_stability_to_weft_washing_before_iron_min_value']<=$row_for_qc['dimensional_stability_to_weft_washing_before_iron_value'] && $row_for_defining_process['dimensional_stability_to_weft_washing_before_iron_max_value']>=$row_for_qc['dimensional_stability_to_weft_washing_before_iron_value'])
							{
								$p++;
                                $pdf->SetFont('Times','',7);
                                $pdf->Cell(124,5,$row['test_name_method']."(Before Iron-Weft)(".$row_for_defining_process['washing_cycle_for_weft_for_washing_before_iron'].' Wash)' ,"1", "0","L");
                                $pdf->SetFont('Times','',8);
                                $pdf->Cell(21,5,$row_for_qc['dimensional_stability_to_weft_washing_before_iron_value'].' ' .$row_for_defining_process['uom_of_dimensional_stability_to_weft_washing_before_iron'], "1", "0","L");
                                $pdf->Cell(30,5,$row_for_defining_process['dimensional_stability_to_weft_washing_before_iron_min_value'].' to '.$row_for_defining_process['dimensional_stability_to_weft_washing_before_iron_max_value'].' ('.$row_for_defining_process['uom_of_dimensional_stability_to_weft_washing_before_iron'].")", "1", "0","L");
                                $pdf->Cell(15,5,"Pass", "1", "0","C");
                                $pdf->Ln();
							}
							else {
								$f++;
                                $pdf->SetFont('Times','',7);
								         $pdf->Cell(124,5,$row['test_name_method']."(Before Iron-Weft)(".$row_for_defining_process['washing_cycle_for_weft_for_washing_before_iron'].' Wash)' ,"1", "0","L");
                                $pdf->SetFont('Times','',8);
                                $pdf->Cell(21,5,$row_for_qc['dimensional_stability_to_weft_washing_before_iron_value'].' ' .$row_for_defining_process['uom_of_dimensional_stability_to_weft_washing_before_iron'], "1", "0","L");
                                $pdf->Cell(30,5,$row_for_defining_process['dimensional_stability_to_weft_washing_before_iron_min_value'].' to '.$row_for_defining_process['dimensional_stability_to_weft_washing_before_iron_max_value'].' ('.$row_for_defining_process['uom_of_dimensional_stability_to_weft_washing_before_iron'].")", "1", "0","L");
                                $pdf->SetTextColor(194,8,8);

                                $pdf->Cell(15,5,"Fail", "1", "0","C");
                                $pdf->SetTextColor(0,0,0);
                                $pdf->Ln();
								
							}			

						}


						if ($row_for_defining_process['dimensional_stability_to_warp_washing_after_iron_max_value']<>0 && $row_for_qc['dimensional_stability_to_warp_washing_after_iron_value']<>0) 
						{

							$total_test++;

							if($row_for_defining_process['dimensional_stability_to_warp_washing_after_iron_min_value']<=$row_for_qc['dimensional_stability_to_warp_washing_after_iron_value'] && $row_for_defining_process['dimensional_stability_to_warp_washing_after_iron_max_value']>=$row_for_qc['dimensional_stability_to_warp_washing_after_iron_value'])
							{
								$p++;
                                $pdf->SetFont('Times','',7);
                                $pdf->Cell(124,5,$row['test_name_method']."(After Iron-Warp)(".$row_for_defining_process['washing_cycle_for_warp_for_washing_after_iron'].' Wash)' ,"1", "0","L");
                                $pdf->SetFont('Times','',8);
                                $pdf->Cell(21,5,$row_for_qc['dimensional_stability_to_warp_washing_after_iron_value'].' ' .$row_for_defining_process['uom_of_dimensional_stability_to_warp_washing_after_iron'], "1", "0","L");
                                $pdf->Cell(30,5,$row_for_defining_process['dimensional_stability_to_warp_washing_after_iron_min_value'].' to '.$row_for_defining_process['dimensional_stability_to_warp_washing_after_iron_max_value'].' ('.$row_for_defining_process['uom_of_dimensional_stability_to_warp_washing_after_iron'].")", "1", "0","L");
                                $pdf->Cell(15,5,"Pass", "1", "0","C");
                                $pdf->Ln();
							}
							else 
							{
								$f++;

                                $pdf->SetFont('Times','',7);
								        $pdf->Cell(124,5,$row['test_name_method']."(After Iron-Warp)(".$row_for_defining_process['washing_cycle_for_warp_for_washing_after_iron'].' Wash)' ,"1", "0","L");
                                $pdf->SetFont('Times','',8);
                                $pdf->Cell(21,5,$row_for_qc['dimensional_stability_to_warp_washing_after_iron_value'].' ' .$row_for_defining_process['uom_of_dimensional_stability_to_warp_washing_after_iron'], "1", "0","L");
                                $pdf->Cell(30,5,$row_for_defining_process['dimensional_stability_to_warp_washing_after_iron_min_value'].' to '.$row_for_defining_process['dimensional_stability_to_warp_washing_after_iron_max_value'].' ('.$row_for_defining_process['uom_of_dimensional_stability_to_warp_washing_after_iron'].")", "1", "0","L");
                                $pdf->SetTextColor(194,8,8);

                                $pdf->Cell(15,5,"Fail", "1", "0","C");
                                $pdf->SetTextColor(0,0,0);
                                $pdf->Ln();
							}

						}

						if ($row_for_defining_process['dimensional_stability_to_weft_washing_after_iron_max_value']<>0 && $row_for_qc['dimensional_stability_to_weft_washing_after_iron_value']<>0) 
						{

							$total_test++;

							if($row_for_defining_process['dimensional_stability_to_weft_washing_after_iron_min_value']<=$row_for_qc['dimensional_stability_to_weft_washing_after_iron_value'] && $row_for_defining_process['dimensional_stability_to_weft_washing_after_iron_max_value']>=$row_for_qc['dimensional_stability_to_weft_washing_after_iron_value'])
							{
								$p++;
                                $pdf->SetFont('Times','',7);
                                $pdf->Cell(124,5,$row['test_name_method']."(After Iron-Weft)(".$row_for_defining_process['washing_cycle_for_weft_for_washing_after_iron'].' Wash)' ,"1", "0","L");
                                $pdf->SetFont('Times','',8);
                                $pdf->Cell(21,5,$row_for_qc['dimensional_stability_to_weft_washing_after_iron_value'].' ' .$row_for_defining_process['uom_of_dimensional_stability_to_weft_washing_after_iron'], "1", "0","L");
                                $pdf->Cell(30,5,$row_for_defining_process['dimensional_stability_to_weft_washing_after_iron_min_value'].' to '.$row_for_defining_process['dimensional_stability_to_weft_washing_after_iron_max_value'].' ('.$row_for_defining_process['uom_of_dimensional_stability_to_weft_washing_after_iron'].")", "1", "0","L");
                                $pdf->Cell(15,5,"Pass", "1", "0","C");
                                $pdf->Ln();
							}
							else {
								$f++;
                                $pdf->SetFont('Times','',7);
								 $pdf->Cell(124,5,$row['test_name_method']."(After Iron-Weft)(".$row_for_defining_process['washing_cycle_for_weft_for_washing_after_iron'].' Wash)' ,"1", "0","L");
                                $pdf->SetFont('Times','',8);
                                $pdf->Cell(21,5,$row_for_qc['dimensional_stability_to_weft_washing_after_iron_value'].' ' .$row_for_defining_process['uom_of_dimensional_stability_to_weft_washing_after_iron'], "1", "0","L");
                                $pdf->Cell(30,5,$row_for_defining_process['dimensional_stability_to_weft_washing_after_iron_min_value'].' to '.$row_for_defining_process['dimensional_stability_to_weft_washing_after_iron_max_value'].' ('.$row_for_defining_process['uom_of_dimensional_stability_to_weft_washing_after_iron'].")", "1", "0","L");
                                $pdf->SetTextColor(194,8,8);

                                $pdf->Cell(15,5,"Fail", "1", "0","C");
                                $pdf->SetTextColor(0,0,0);
                                $pdf->Ln();
							}

							

						}

					}

               if (in_array($row['id'], ['74']))
					{
                        

                  if ($row_for_defining_process['warp_yarn_count_max_value']!=null && $row_for_qc['warp_yarn_count_value']!=null) 
						{
                     $content = urlencode($row_for_defining_process['warp_yarn_count_tolerance_range_math_operator']);

                     $warp_yarn_count_tolerance_range_math_operator = urldecode($pdf->sp_character($content));
                          
							$total_test++;

							if($row_for_defining_process['warp_yarn_count_min_value']<=$row_for_qc['warp_yarn_count_value'] && $row_for_defining_process['warp_yarn_count_max_value']>=$row_for_qc['warp_yarn_count_value'])
							{
								$p++;
                                $pdf->Cell(124,5,$row['test_name_method']." (Dry)" ,"1", "0","L");
                                $pdf->Cell(21,5,$row_for_qc['warp_yarn_count_value'].' ' .$row_for_defining_process['uom_of_warp_yarn_count_value'], "1", "0","L");
                                $pdf->Cell(30,5,$row_for_defining_process['warp_yarn_count_value'].' '.$row_for_defining_process['uom_of_warp_yarn_count_value'].' ('.$warp_yarn_count_tolerance_range_math_operator.'  '.$row_for_defining_process['warp_yarn_count_tolerance_value']."%)", "1", "0","L");
                                $pdf->Cell(15,5,"Pass", "1", "0","C");
                                $pdf->Ln();
								
							}
							else 
							{
								$f++;
								        $pdf->Cell(124,5,$row['test_name_method']." (Dry)" ,"1", "0","L");
                                $pdf->Cell(21,5,$row_for_qc['warp_yarn_count_value'].' ' .$row_for_defining_process['uom_of_warp_yarn_count_value'], "1", "0","L");
                                $pdf->Cell(30,5,$row_for_defining_process['warp_yarn_count_value'].' '.$row_for_defining_process['uom_of_warp_yarn_count_value'].' ('.$warp_yarn_count_tolerance_range_math_operator.'  '.$row_for_defining_process['warp_yarn_count_tolerance_value']."%)", "1", "0","L");
                                $pdf->SetTextColor(194,8,8);

                                $pdf->Cell(15,5,"Fail", "1", "0","C");
                                $pdf->SetTextColor(0,0,0);
                                $pdf->Ln();
							}

						}
                  if ($row_for_defining_process['weft_yarn_count_max_value']<>0 && $row_for_qc['weft_yarn_count_value']<>0) 
						{
							$total_test++;

                     $content = urlencode($row_for_defining_process['weft_yarn_count_tolerance_range_math_operator']);

                     $weft_yarn_count_tolerance_range_math_operator = urldecode($pdf->sp_character($content));
                     
							if($row_for_defining_process['weft_yarn_count_min_value']<=$row_for_qc['weft_yarn_count_value'] && $row_for_defining_process['weft_yarn_count_max_value']>=$row_for_qc['weft_yarn_count_value'])
							{
								$p++;
                                $pdf->Cell(124,5,$row['test_name_method']." (Weft)" ,"1", "0","L");
                                $pdf->Cell(21,5,$row_for_qc['weft_yarn_count_value'].' ' .$row_for_defining_process['uom_of_weft_yarn_count_value'], "1", "0","L");
                                $pdf->Cell(30,5,$row_for_defining_process['weft_yarn_count_value'].' '.$row_for_defining_process['uom_of_weft_yarn_count_value'].' ('.$weft_yarn_count_tolerance_range_math_operator.'  '.$row_for_defining_process['weft_yarn_count_tolerance_value']."%)", "1", "0","L");
                                $pdf->Cell(15,5,"Pass", "1", "0","C");
                                $pdf->Ln();
								
							}
							else 
							{
								$f++;
								        $pdf->Cell(124,5,$row['test_name_method']." (Weft)" ,"1", "0","L");
                                $pdf->Cell(21,5,$row_for_qc['weft_yarn_count_value'].' ' .$row_for_defining_process['uom_of_weft_yarn_count_value'], "1", "0","L");
                                $pdf->Cell(30,5,$row_for_defining_process['weft_yarn_count_value'].' '.$row_for_defining_process['uom_of_weft_yarn_count_value'].' ('.$weft_yarn_count_tolerance_range_math_operator.'  '.$row_for_defining_process['weft_yarn_count_tolerance_value']."%)", "1", "0","L");
                                $pdf->SetTextColor(194,8,8);

                                $pdf->Cell(15,5,"Fail", "1", "0","C");
                                $pdf->SetTextColor(0,0,0);
                                $pdf->Ln();
							}
						}
                    }

                    if (in_array($row['id'], ['4']))
					{
						
						if ($row_for_defining_process['no_of_threads_in_warp_max_value']<>0 && $row_for_qc['no_of_threads_in_warp_value']<>0) 
						{
                     $content_no_of_thread_warp = urlencode($row_for_defining_process['no_of_threads_in_warp_tolerance_range_math_operator']);

                     $no_of_threads_in_warp_tolerance_range_math_operator = urldecode($pdf->sp_character($content_no_of_thread_warp));

                            
                            $total_test++;

							if($row_for_defining_process['no_of_threads_in_warp_min_value']<=$row_for_qc['no_of_threads_in_warp_value'] && $row_for_defining_process['no_of_threads_in_warp_max_value']>=$row_for_qc['no_of_threads_in_warp_value'])
							{
								$p++;
                                $pdf->Cell(124,5,$row['test_name_method']." (Warp)" ,"1", "0","L");
                                $pdf->Cell(21,5,$row_for_qc['no_of_threads_in_warp_value'].' ' .$row_for_defining_process['uom_of_no_of_threads_in_warp_value'], "1", "0","L");
                                $pdf->Cell(30,5,$row_for_defining_process['no_of_threads_in_warp_value'].' '.$row_for_defining_process['uom_of_no_of_threads_in_warp_value'].' ('.$no_of_threads_in_warp_tolerance_range_math_operator.'  '.$row_for_defining_process['no_of_threads_in_warp_tolerance_value']."%)", "1", "0","L");
                                $pdf->Cell(15,5,"Pass", "1", "0","C");
                                $pdf->Ln();
							}
							else {
								$f++;
								        $pdf->Cell(124,5,$row['test_name_method']." (Warp)" ,"1", "0","L");
                                $pdf->Cell(21,5,$row_for_qc['no_of_threads_in_warp_value'].' ' .$row_for_defining_process['uom_of_no_of_threads_in_warp_value'], "1", "0","L");
                                $pdf->Cell(30,5,$row_for_defining_process['no_of_threads_in_warp_value'].' '.$row_for_defining_process['uom_of_no_of_threads_in_warp_value'].' ('.$no_of_threads_in_warp_tolerance_range_math_operator.'  '.$row_for_defining_process['no_of_threads_in_warp_tolerance_value']."%)", "1", "0","L");
                                $pdf->SetTextColor(194,8,8);

                                $pdf->Cell(15,5,"Fail", "1", "0","C");
                                $pdf->SetTextColor(0,0,0);
                                $pdf->Ln();
							}

							

						}

						if ($row_for_defining_process['no_of_threads_in_weft_max_value']<>0 && $row_for_qc['no_of_threads_in_weft_value']<>0) 
						{

                     $content_no_of_thread_weft = urlencode($row_for_defining_process['no_of_threads_in_weft_tolerance_range_math_operator']);

                     $no_of_threads_in_weft_tolerance_range_math_operator = urldecode($pdf->sp_character($content_no_of_thread_weft));


							$total_test++;

							if($row_for_defining_process['no_of_threads_in_weft_min_value']<=$row_for_qc['no_of_threads_in_weft_value'] && $row_for_defining_process['no_of_threads_in_weft_max_value']>=$row_for_qc['no_of_threads_in_weft_value'])
							{
								$p++;
                                $pdf->Cell(124,5,$row['test_name_method']." (Weft)" ,"1", "0","L");
                                $pdf->Cell(21,5,$row_for_qc['no_of_threads_in_weft_value'].' ' .$row_for_defining_process['uom_of_no_of_threads_in_weft_value'], "1", "0","L");
                                $pdf->Cell(30,5,$row_for_defining_process['no_of_threads_in_weft_value'].' '.$row_for_defining_process['uom_of_no_of_threads_in_weft_value'].' ('.$no_of_threads_in_weft_tolerance_range_math_operator.'  '.$row_for_defining_process['no_of_threads_in_weft_tolerance_value']."%)", "1", "0","L");
                                $pdf->Cell(15,5,"Pass", "1", "0","C");
                                $pdf->Ln();
							}
							else {
								$f++;
								        $pdf->Cell(124,5,$row['test_name_method']." (Weft)" ,"1", "0","L");
                                $pdf->Cell(21,5,$row_for_qc['no_of_threads_in_weft_value'].' ' .$row_for_defining_process['uom_of_no_of_threads_in_weft_value'], "1", "0","L");
                                $pdf->Cell(30,5,$row_for_defining_process['no_of_threads_in_weft_value'].' '.$row_for_defining_process['uom_of_no_of_threads_in_weft_value'].' ('.$no_of_threads_in_weft_tolerance_range_math_operator.'  '.$row_for_defining_process['no_of_threads_in_weft_tolerance_value']."%)", "1", "0","L");
                                $pdf->SetTextColor(194,8,8);

                                $pdf->Cell(15,5,"Fail", "1", "0","C");
                                $pdf->SetTextColor(0,0,0);
                                $pdf->Ln();
								
							}
						}
					}

                    if (in_array($row['id'], ['5']))
                    {
                       
                       if ($row_for_defining_process['mass_per_unit_per_area_max_value']<>0 && $row_for_qc['mass_per_unit_per_area_value']<>0) 
                       {
                        
                            $total_test++;
                            $content = urlencode('±');

                            $mass_per_unit_plus_minus = urldecode($pdf->sp_character($content));

                           if($row_for_defining_process['mass_per_unit_per_area_min_value']<=$row_for_qc['mass_per_unit_per_area_value'] && $row_for_defining_process['mass_per_unit_per_area_max_value']>=$row_for_qc['mass_per_unit_per_area_value'])
                           {
                               $p++;
                               if($row_for_defining_process['mass_per_unit_per_area_tolerance_range_math_operator'] == $row_for_defining_process['mass_per_unit_per_area_tolerance_value'])
                                 {
                                    $pdf->Cell(124,5,$row['test_name_method'],"1", "0","L");
                                    $pdf->Cell(21,5,$row_for_qc['mass_per_unit_per_area_value'].' ' .$row_for_defining_process['uom_of_mass_per_unit_per_area_value'], "1", "0","L");
                                    $pdf->Cell(30,5,$row_for_defining_process['mass_per_unit_per_area_value'].' '.$row_for_defining_process['uom_of_mass_per_unit_per_area_value'].'  ('.$mass_per_unit_plus_minus.' '.$row_for_defining_process['mass_per_unit_per_area_tolerance_value']."%)", "1", "0","L");
                                    $pdf->Cell(15,5,"Pass", "1", "0","C");
                                    $pdf->Ln();
                                 }
                                 else
                                 {
                                    $pdf->Cell(124,5,$row['test_name_method'],"1", "0","L");
                                    $pdf->Cell(21,5,$row_for_qc['mass_per_unit_per_area_value'].' ' .$row_for_defining_process['uom_of_mass_per_unit_per_area_value'], "1", "0","L");
                                    $pdf->Cell(30,5,$row_for_defining_process['mass_per_unit_per_area_value'].' '.$row_for_defining_process['uom_of_mass_per_unit_per_area_value'].'  (+'.$row_for_defining_process['mass_per_unit_per_area_tolerance_range_math_operator'].'% / -'.$row_for_defining_process['mass_per_unit_per_area_tolerance_value']."%)", "1", "0","L");
                                    $pdf->Cell(15,5,"Pass", "1", "0","C");
                                    $pdf->Ln();
                                 }
                               
                           }
                           else 
                           {
                               $f++;
                               if($row_for_defining_process['mass_per_unit_per_area_tolerance_range_math_operator'] == $row_for_defining_process['mass_per_unit_per_area_tolerance_value'])
                                 {
                                    $pdf->Cell(124,5,$row['test_name_method'],"1", "0","L");
                                    $pdf->Cell(21,5,$row_for_qc['mass_per_unit_per_area_value'].' ' .$row_for_defining_process['uom_of_mass_per_unit_per_area_value'], "1", "0","L");
                                    $pdf->Cell(30,5,$row_for_defining_process['mass_per_unit_per_area_value'].' '.$row_for_defining_process['uom_of_mass_per_unit_per_area_value'].'  ('.$mass_per_unit_plus_minus.' '.$row_for_defining_process['mass_per_unit_per_area_tolerance_value']."%)", "1", "0","L");
                                    $pdf->SetTextColor(194,8,8);

                                    $pdf->Cell(15,5,"Fail", "1", "0","C");
                                    $pdf->SetTextColor(0,0,0);
                                    $pdf->Ln();
                                 }
                                 else
                                 {
                                    $pdf->Cell(124,5,$row['test_name_method'],"1", "0","L");
                                    $pdf->Cell(21,5,$row_for_qc['mass_per_unit_per_area_value'].' ' .$row_for_defining_process['uom_of_mass_per_unit_per_area_value'], "1", "0","L");
                                    $pdf->Cell(30,5,$row_for_defining_process['mass_per_unit_per_area_value'].' '.$row_for_defining_process['uom_of_mass_per_unit_per_area_value'].'  (+'.$row_for_defining_process['mass_per_unit_per_area_tolerance_range_math_operator'].'% / -'.$row_for_defining_process['mass_per_unit_per_area_tolerance_value']."%)", "1", "0","L");
                                    $pdf->SetTextColor(194,8,8);

                                    $pdf->Cell(15,5,"Fail", "1", "0","C");
                                    $pdf->SetTextColor(0,0,0);
                                    $pdf->Ln();
                                 }
                               
                              
                           }
                       }
                   }

                   if (in_array($row['id'], ['6']))
                   {
                       
                       if ($row_for_defining_process['surface_fuzzing_and_pilling_max_value']<>0 && $row_for_qc['surface_fuzzing_and_pilling_value']<>0) 
                       {
                           $total_test++;

                    
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


                           if($row_for_defining_process['surface_fuzzing_and_pilling_tolerance_range_math_operator'] == '≥')
                           {
                              $surface_fuzzing_and_pilling_tolerance_range_math_operator = $pdf->Image('../img/greater_equal.png',156, $pdf->GetY()+1.5, 1.7).'   ';
                           }
                           else if($row_for_defining_process['surface_fuzzing_and_pilling_tolerance_range_math_operator'] == '≤')
                           {
                              $surface_fuzzing_and_pilling_tolerance_range_math_operator = $pdf->Image('../img/less_equal.png',156, $pdf->GetY()+1.5, 1.7).'   ';
                           }
                           else if($row_for_defining_process['surface_fuzzing_and_pilling_tolerance_range_math_operator'] == '>')
                           {
                              $surface_fuzzing_and_pilling_tolerance_range_math_operator = '>';
                           }
                           else if($row_for_defining_process['surface_fuzzing_and_pilling_tolerance_range_math_operator'] == '<')
                           {
                              $surface_fuzzing_and_pilling_tolerance_range_math_operator = '<';
                           }


                           if($row_for_defining_process['surface_fuzzing_and_pilling_min_value']<=$row_for_qc['surface_fuzzing_and_pilling_value'] && $row_for_defining_process['surface_fuzzing_and_pilling_max_value']>=$row_for_qc['surface_fuzzing_and_pilling_value'])
                           {
                               $p++;
                               $pdf->Cell(124,5,$row['test_name_method'],"1", "0","L");
                               $pdf->Cell(21,5,$surface_fuzzing_and_pilling_value.' ' .$row_for_defining_process['uom_of_surface_fuzzing_and_pilling_value'], "1", "0","L");
                               $pdf->Cell(30,5,$surface_fuzzing_and_pilling_tolerance_range_math_operator.' '.$surface_fuzzing_and_pilling_tolerance_value.' '.$row_for_defining_process['uom_of_surface_fuzzing_and_pilling_value'], "1", "0","L");
                               $pdf->Cell(15,5,"Pass", "1", "0","C");
                               $pdf->Ln();
                           }
                           else 
                           {
                               $f++;
                               $pdf->Cell(124,5,$row['test_name_method'],"1", "0","L");
                               $pdf->Cell(21,5,$surface_fuzzing_and_pilling_value.' ' .$row_for_defining_process['uom_of_surface_fuzzing_and_pilling_value'], "1", "0","L");
                               $pdf->Cell(30,5,$surface_fuzzing_and_pilling_tolerance_range_math_operator.' '.$surface_fuzzing_and_pilling_tolerance_value.' '.$row_for_defining_process['uom_of_surface_fuzzing_and_pilling_value'], "1", "0","L");
                               $pdf->SetTextColor(194,8,8);

                               $pdf->Cell(15,5,"Fail", "1", "0","C");
                               $pdf->SetTextColor(0,0,0);
                               $pdf->Ln();
                              
                           }


                       }
                   } /* End of if (in_array($row['id'], ['6', '101']))*/

                   if (in_array($row['id'], ['7']))
                   {
                       
                       if ($row_for_defining_process['tensile_properties_in_warp_value_max_value']<>0 && $row_for_qc['tensile_properties_in_warp_value']<>0) 
                       {
                       
                           $total_test++;

                           if($row_for_defining_process['tensile_properties_in_warp_value_tolerance_range_math_operator'] == '≥')
                           {
                              $tensile_properties_in_warp_value_tolerance_range_math_operator = $pdf->Image('../img/greater_equal.png',156, $pdf->GetY()+1.5, 1.7).'   ';
                           }
                           else if($row_for_defining_process['tensile_properties_in_warp_value_tolerance_range_math_operator'] == '≤')
                           {
                              $tensile_properties_in_warp_value_tolerance_range_math_operator = $pdf->Image('../img/less_equal.png',156, $pdf->GetY()+1.5, 1.7).'   ';
                           }
                           else if($row_for_defining_process['tensile_properties_in_warp_value_tolerance_range_math_operator'] == '>')
                           {
                              $tensile_properties_in_warp_value_tolerance_range_math_operator = '>';
                           }
                           else if($row_for_defining_process['tensile_properties_in_warp_value_tolerance_range_math_operator'] == '<')
                           {
                              $tensile_properties_in_warp_value_tolerance_range_math_operator = '<';
                           }

                            if($row_for_defining_process['tensile_properties_in_warp_value_min_value']<=$row_for_qc['tensile_properties_in_warp_value'] && $row_for_defining_process['tensile_properties_in_warp_value_max_value']>=$row_for_qc['tensile_properties_in_warp_value'])
                           {
                               $p++;
                               $pdf->Cell(124,5,$row['test_name_method'].' (Warp)',"1", "0","L");
                               $pdf->Cell(21,5,$row_for_qc['tensile_properties_in_warp_value'].' ' .$row_for_defining_process['uom_of_tensile_properties_in_warp_value'], "1", "0","L");
                               $pdf->Cell(30,5,$tensile_properties_in_warp_value_tolerance_range_math_operator.' '.$row_for_defining_process['tensile_properties_in_warp_value_tolerance_value'].' '.$row_for_defining_process['uom_of_tensile_properties_in_warp_value'], "1", "0","L");
                               $pdf->Cell(15,5,"Pass", "1", "0","C");
                               $pdf->Ln();
                           }
                           else {
                               $f++;
                               $pdf->Cell(124,5,$row['test_name_method'].' (Warp)',"1", "0","L");
                               $pdf->Cell(21,5,$row_for_qc['tensile_properties_in_warp_value'].' ' .$row_for_defining_process['uom_of_tensile_properties_in_warp_value'], "1", "0","L");
                               $pdf->Cell(30,5,$tensile_properties_in_warp_value_tolerance_range_math_operator.' '.$row_for_defining_process['tensile_properties_in_warp_value_tolerance_value'].' '.$row_for_defining_process['uom_of_tensile_properties_in_warp_value'], "1", "0","L");
                               $pdf->SetTextColor(194,8,8);

                               $pdf->Cell(15,5,"Fail", "1", "0","C");
                               $pdf->SetTextColor(0,0,0);
                               $pdf->Ln();
                              
                           }
                       }

                       if ($row_for_defining_process['tensile_properties_in_weft_value_max_value']<>0 && $row_for_qc['tensile_properties_in_weft_value']<>0) 
                       {

                           $total_test++;

                           if($row_for_defining_process['tensile_properties_in_weft_value_tolerance_range_math_operator'] == '≥')
                           {
                              $tensile_properties_in_weft_value_tolerance_range_math_operator = $pdf->Image('../img/greater_equal.png',156, $pdf->GetY()+1.5, 1.7).'   ';
                              // $content = urlencode($row_for_defining_process['tensile_properties_in_weft_value_tolerance_range_math_operator']);

                              // $tensile_properties_in_weft_value_tolerance_range_math_operator = urldecode($pdf->sp_character($content));
                           }
                           else if($row_for_defining_process['tensile_properties_in_weft_value_tolerance_range_math_operator'] == '≤')
                           {
                              $tensile_properties_in_weft_value_tolerance_range_math_operator = $pdf->Image('../img/less_equal.png',156, $pdf->GetY()+1.5, 1.7).'   ';
                              // $content = urlencode($row_for_defining_process['tensile_properties_in_weft_value_tolerance_range_math_operator']);

                              // $tensile_properties_in_weft_value_tolerance_range_math_operator = urldecode($pdf->sp_character($content));
                           }
                           else if($row_for_defining_process['tensile_properties_in_weft_value_tolerance_range_math_operator'] == '>')
                           {
                              $tensile_properties_in_weft_value_tolerance_range_math_operator = '>';
                           }
                           else if($row_for_defining_process['tensile_properties_in_weft_value_tolerance_range_math_operator'] == '<')
                           {
                              $tensile_properties_in_weft_value_tolerance_range_math_operator = '<';
                           }

                           if($row_for_defining_process['tensile_properties_in_weft_value_min_value']<=$row_for_qc['tensile_properties_in_weft_value'] && $row_for_defining_process['tensile_properties_in_weft_value_max_value']>=$row_for_qc['tensile_properties_in_weft_value'])
                           {
                               $p++;
                               $pdf->Cell(124,5,$row['test_name_method'].' (Weft)',"1", "0","L");
                               $pdf->Cell(21,5,$row_for_qc['tensile_properties_in_weft_value'].' ' .$row_for_defining_process['uom_of_tensile_properties_in_weft_value'], "1", "0","L");
                               $pdf->Cell(30,5,$tensile_properties_in_weft_value_tolerance_range_math_operator.' '.$row_for_defining_process['tensile_properties_in_weft_value_tolerance_value'].' '.$row_for_defining_process['uom_of_tensile_properties_in_weft_value'], "1", "0","L");
                               $pdf->Cell(15,5,"Pass", "1", "0","C");
                               $pdf->SetTextColor(0,0,0);
                               $pdf->Ln();
                           }
                           else 
                           {
                               $f++;
                               $pdf->Cell(124,5,$row['test_name_method'].' (Weft)',"1", "0","L");
                               $pdf->Cell(21,5,$row_for_qc['tensile_properties_in_weft_value'].' ' .$row_for_defining_process['uom_of_tensile_properties_in_weft_value'], "1", "0","L");
                               $pdf->Cell(30,5,$tensile_properties_in_weft_value_tolerance_range_math_operator.' '.$row_for_defining_process['tensile_properties_in_weft_value_tolerance_value'].' '.$row_for_defining_process['uom_of_tensile_properties_in_weft_value'], "1", "0","L");
                               $pdf->SetTextColor(194,8,8);

                               $pdf->Cell(15,5,"Fail", "1", "0","C");
                               $pdf->SetTextColor(0,0,0);
                               $pdf->Ln();
                           }

                           

                           }
                    }        /*End of if (in_array($row['id'], ['7', '115', '263', '274', '302']))*/
                   

                   if (in_array($row['id'], ['8']))
                    {
                       
                       if ($row_for_defining_process['tear_force_in_warp_value_max_value']<>0 && $row_for_qc['tear_force_in_warp_value']<>0) {
                       
                           $total_test++;

                           if($row_for_defining_process['tear_force_in_warp_value_tolerance_range_math_operator'] == '≥')
                           {
                              $tear_force_in_warp_value_tolerance_range_math_operator = $pdf->Image('../img/greater_equal.png',156, $pdf->GetY()+1.5, 1.7).'   ';
                           }
                           else if($row_for_defining_process['tear_force_in_warp_value_tolerance_range_math_operator'] == '≤')
                           {
                              $tear_force_in_warp_value_tolerance_range_math_operator = $pdf->Image('../img/less_equal.png',156, $pdf->GetY()+1.5, 1.7).'   ';
                           }
                           else if($row_for_defining_process['tear_force_in_warp_value_tolerance_range_math_operator'] == '>')
                           {
                              $tear_force_in_warp_value_tolerance_range_math_operator = '>';
                           }
                           else if($row_for_defining_process['tear_force_in_warp_value_tolerance_range_math_operator'] == '<')
                           {
                              $tear_force_in_warp_value_tolerance_range_math_operator = '<';
                           }

                           if($row_for_defining_process['tear_force_in_warp_value_min_value']<=$row_for_qc['tear_force_in_warp_value'] && $row_for_defining_process['tear_force_in_warp_value_max_value']>=$row_for_qc['tear_force_in_warp_value'])
                           {
                               $p++;
                               $pdf->Cell(124,5,$row['test_name_method'].' (Warp)',"1", "0","L");
                               $pdf->Cell(21,5,$row_for_qc['tear_force_in_warp_value'].' ' .$row_for_defining_process['uom_of_tear_force_in_warp_value'], "1", "0","L");
                               $pdf->Cell(30,5,$tear_force_in_warp_value_tolerance_range_math_operator.' '.$row_for_defining_process['tear_force_in_warp_value_tolerance_value'].' '.$row_for_defining_process['uom_of_tear_force_in_warp_value'], "1", "0","L");
                               $pdf->Cell(15,5,"Pass", "1", "0","C");
                               $pdf->SetTextColor(0,0,0);
                               $pdf->Ln();
                           }
                           else {
                               $f++;
                               $pdf->Cell(124,5,$row['test_name_method'].' (Warp)',"1", "0","L");
                               $pdf->Cell(21,5,$row_for_qc['tear_force_in_warp_value'].' ' .$row_for_defining_process['uom_of_tear_force_in_warp_value'], "1", "0","L");
                               $pdf->Cell(30,5,$tear_force_in_warp_value_tolerance_range_math_operator.' '.$row_for_defining_process['tear_force_in_warp_value_tolerance_value'].' '.$row_for_defining_process['uom_of_tear_force_in_warp_value'], "1", "0","L");
                               $pdf->SetTextColor(194,8,8);

                               $pdf->Cell(15,5,"Fail", "1", "0","C");
                               $pdf->SetTextColor(0,0,0);
                               $pdf->Ln();
                              
                           }

                            

                           }  /*End warp tear force*/

                           if ($row_for_defining_process['tear_force_in_weft_value_max_value']<>0 && $row_for_qc['tear_force_in_weft_value']<>0) 
                           {
                               $total_test++;

                                 if($row_for_defining_process['tear_force_in_weft_value_tolerance_range_math_operator'] == '≥')
                                 {
                                    $tear_force_in_weft_value_tolerance_range_math_operator = $pdf->Image('../img/greater_equal.png',156, $pdf->GetY()+1.5, 1.7).'   ';
                                 }
                                 else if($row_for_defining_process['tear_force_in_weft_value_tolerance_range_math_operator'] == '≤')
                                 {
                                    $tear_force_in_weft_value_tolerance_range_math_operator = $pdf->Image('../img/less_equal.png',156, $pdf->GetY()+1.5, 1.7).'   ';
                                 }
                                 else if($row_for_defining_process['tear_force_in_weft_value_tolerance_range_math_operator'] == '>')
                                 {
                                    $tear_force_in_weft_value_tolerance_range_math_operator = '>';
                                 }
                                 else if($row_for_defining_process['tear_force_in_weft_value_tolerance_range_math_operator'] == '<')
                                 {
                                    $tear_force_in_weft_value_tolerance_range_math_operator = '<';
                                 }

                           if($row_for_defining_process['tear_force_in_weft_value_min_value']<=$row_for_qc['tear_force_in_weft_value'] && $row_for_defining_process['tear_force_in_weft_value_max_value']>=$row_for_qc['tear_force_in_weft_value'])
                           {
                               $p++;
                               $pdf->Cell(124,5,$row['test_name_method'].' (Weft)',"1", "0","L");
                               $pdf->Cell(21,5,$row_for_qc['tear_force_in_weft_value'].' ' .$row_for_defining_process['uom_of_tear_force_in_weft_value'], "1", "0","L");
                               $pdf->Cell(30,5,$tear_force_in_weft_value_tolerance_range_math_operator.' '.$row_for_defining_process['tear_force_in_weft_value_tolerance_value'].' '.$row_for_defining_process['uom_of_tear_force_in_weft_value'], "1", "0","L");
                               $pdf->Cell(15,5,"Pass", "1", "0","C");
                               $pdf->SetTextColor(0,0,0);
                               $pdf->Ln();
                           }
                           else {
                               $f++;
                               $pdf->Cell(124,5,$row['test_name_method'].' (Weft)',"1", "0","L");
                               $pdf->Cell(21,5,$row_for_qc['tear_force_in_weft_value'].' ' .$row_for_defining_process['uom_of_tear_force_in_weft_value'], "1", "0","L");
                               $pdf->Cell(30,5,$tear_force_in_weft_value_tolerance_range_math_operator.' '.$row_for_defining_process['tear_force_in_weft_value_tolerance_value'].' '.$row_for_defining_process['uom_of_tear_force_in_weft_value'], "1", "0","L");
                               $pdf->SetTextColor(194,8,8);

                               $pdf->Cell(15,5,"Fail", "1", "0","C");
                               $pdf->SetTextColor(0,0,0);
                               $pdf->Ln();
                            
                           }


                           }
                    }  /* End of  if (in_array($row['id'], ['8', '135', '148', '201', '275', '303']))*/

                    if (in_array($row['id'], ['9']))
					 {
						
						if ($row_for_defining_process['seam_slippage_resistance_in_warp_max_value']<>0 && $row_for_qc['seam_slippage_resistance_in_warp_value']<>0) 
						{
                         
                         $total_test++;
							if($row_for_defining_process['seam_slippage_resistance_in_warp_min_value']<=$row_for_qc['seam_slippage_resistance_in_warp_value'] && $row_for_defining_process['seam_slippage_resistance_in_warp_max_value']>=$row_for_qc['seam_slippage_resistance_in_warp_value'])
							{
								$p++;
                                $pdf->Cell(124,5,$row['test_name_method'].' (Warp)',"1", "0","L");
                                $pdf->Cell(21,5,$row_for_qc['seam_slippage_resistance_in_warp_value'].' ' .$row_for_defining_process['uom_of_seam_slippage_resistance_in_warp'], "1", "0","L");
                                $pdf->Cell(30,5,$row_for_defining_process['seam_slippage_resistance_in_warp_tolerance_range_math_operator'].' '.$row_for_defining_process['seam_slippage_resistance_in_warp_tolerance_value'].' '.$row_for_defining_process['uom_of_seam_slippage_resistance_in_warp'], "1", "0","L");
                                $pdf->Cell(15,5,"Pass", "1", "0","C");
                                $pdf->SetTextColor(0,0,0);
                                $pdf->Ln();
							}
							else 
							{
								$f++;
                               $pdf->Cell(124,5,$row['test_name_method'].' (Warp)',"1", "0","L");
                               $pdf->Cell(21,5,$row_for_qc['seam_slippage_resistance_in_warp_value'].' ' .$row_for_defining_process['uom_of_seam_slippage_resistance_in_warp'], "1", "0","L");
                               $pdf->Cell(30,5,$row_for_defining_process['seam_slippage_resistance_in_warp_tolerance_range_math_operator'].' '.$row_for_defining_process['seam_slippage_resistance_in_warp_tolerance_value'].' '.$row_for_defining_process['uom_of_seam_slippage_resistance_in_warp'], "1", "0","L");
                               $pdf->SetTextColor(194,8,8);

                               $pdf->Cell(15,5,"Fail", "1", "0","C");
                               $pdf->SetTextColor(0,0,0);
                               $pdf->Ln();
								
							}
						}

						if ($row_for_defining_process['seam_slippage_resistance_in_weft_max_value']<>0 && $row_for_qc['seam_slippage_resistance_in_weft_value']<>0) 
						{
                         
                        	$total_test++;
							if($row_for_defining_process['seam_slippage_resistance_in_weft_min_value']<=$row_for_qc['seam_slippage_resistance_in_weft_value'] && $row_for_defining_process['seam_slippage_resistance_in_weft_max_value']>=$row_for_qc['seam_slippage_resistance_in_weft_value'])
							{
								$p++;
								 $pdf->Cell(124,5,$row['test_name_method'].' (Weft)',"1", "0","L");
                                $pdf->Cell(21,5,$row_for_qc['seam_slippage_resistance_in_weft_value'].' ' .$row_for_defining_process['uom_of_seam_slippage_resistance_in_weft'], "1", "0","L");
                                $pdf->Cell(30,5,$row_for_defining_process['seam_slippage_resistance_in_weft_tolerance_range_math_operator'].' '.$row_for_defining_process['seam_slippage_resistance_in_weft_tolerance_value'].' '.$row_for_defining_process['uom_of_seam_slippage_resistance_in_weft'], "1", "0","L");
                                $pdf->Cell(15,5,"Pass", "1", "0","C");
                                $pdf->SetTextColor(0,0,0);
                                $pdf->Ln();
							}
							else 
							{
								$f++;
                                $pdf->Cell(124,5,$row['test_name_method'].' (Weft)',"1", "0","L");
                                $pdf->Cell(21,5,$row_for_qc['seam_slippage_resistance_in_weft_value'].' ' .$row_for_defining_process['uom_of_seam_slippage_resistance_in_weft'], "1", "0","L");
                                $pdf->Cell(30,5,$row_for_defining_process['seam_slippage_resistance_in_weft_tolerance_range_math_operator'].' '.$row_for_defining_process['seam_slippage_resistance_in_weft_tolerance_value'].' '.$row_for_defining_process['uom_of_seam_slippage_resistance_in_weft'], "1", "0","L");
                                $pdf->SetTextColor(194,8,8);

                                $pdf->Cell(15,5,"Fail", "1", "0","C");
                                $pdf->SetTextColor(0,0,0);
                                $pdf->Ln();
								
							}
						}
					 }   /*End of if (in_array($row['id'], ['9', '186', '230']))*/

					 if (in_array($row['id'], ['9']))
					 {
						
						if ($row_for_defining_process['seam_slippage_resistance_iso_2_in_warp_max_value']<>0 && $row_for_qc['seam_slippage_resistance_iso_2_in_warp_value']<>0) 
						{
                         
                         $total_test++;
							if($row_for_defining_process['seam_slippage_resistance_iso_2_in_warp_min_value']<=$row_for_qc['seam_slippage_resistance_iso_2_in_warp_value'] && $row_for_defining_process['seam_slippage_resistance_iso_2_in_warp_max_value']>=$row_for_qc['seam_slippage_resistance_iso_2_in_warp_value'])
							{
								$p++;
								 $pdf->Cell(124,5,$row['test_name_method'].' (Warp)',"1", "0","L");
                                $pdf->Cell(21,5,$row_for_qc['seam_slippage_resistance_iso_2_in_warp_value'].' ' .$row_for_defining_process['uom_of_seam_slippage_resistance_iso_2_in_warp'], "1", "0","L");
                                $pdf->Cell(30,5,$row_for_defining_process['seam_slippage_resistance_iso_2_in_warp_tolerance_range_math_operator'].' '.$row_for_defining_process['seam_slippage_resistance_iiso_2_n_warp_tolerance_value'].' '.$row_for_defining_process['uom_of_seam_slippage_resistance_iso_2_in_warp'], "1", "0","L");
                                $pdf->Cell(15,5,"Pass", "1", "0","C");
                                $pdf->SetTextColor(0,0,0);
                                $pdf->Ln();
							}
							else 
							{
								$f++;
                                $pdf->Cell(124,5,$row['test_name_method'].' (Warp)',"1", "0","L");
                                $pdf->Cell(21,5,$row_for_qc['seam_slippage_resistance_iso_2_in_warp_value'].' ' .$row_for_defining_process['uom_of_seam_slippage_resistance_iso_2_in_warp'], "1", "0","L");
                                $pdf->Cell(30,5,$row_for_defining_process['seam_slippage_resistance_iso_2_in_warp_tolerance_range_math_operator'].' '.$row_for_defining_process['seam_slippage_resistance_iiso_2_n_warp_tolerance_value'].' '.$row_for_defining_process['uom_of_seam_slippage_resistance_iso_2_in_warp'], "1", "0","L");
                                $pdf->SetTextColor(194,8,8);

                                $pdf->Cell(15,5,"Fail", "1", "0","C");
                                $pdf->SetTextColor(0,0,0);
                                $pdf->Ln();
								
							}
						}

						if ($row_for_defining_process['seam_slippage_resistance_iso_2_in_weft_max_value']<>0 && $row_for_qc['seam_slippage_resistance_iso_2_in_weft_value']<>0) 
						{
                         
                        	$total_test++;
							if($row_for_defining_process['seam_slippage_resistance_iso_2_in_weft_min_value']<=$row_for_qc['seam_slippage_resistance_iso_2_in_weft_value'] && $row_for_defining_process['seam_slippage_resistance_iso_2_in_weft_max_value']>=$row_for_qc['seam_slippage_resistance_iso_2_in_weft_value'])
							{
								$p++;
                                $pdf->Cell(124,5,$row['test_name_method'].' (Weft)',"1", "0","L");
                                $pdf->Cell(21,5,$row_for_qc['seam_slippage_resistance_iso_2_in_weft_value'].' ' .$row_for_defining_process['uom_of_seam_slippage_resistance_iso_2_in_weft'], "1", "0","L");
                                $pdf->Cell(30,5,$row_for_defining_process['seam_slippage_resistance_iso_2_in_weft_tolerance_range_math_operator'].' '.$row_for_defining_process['seam_slippage_resistance_iso_2_in_weft_tolerance_value'].' '.$row_for_defining_process['uom_of_seam_slippage_resistance_iso_2_in_weft'], "1", "0","L");
                                $pdf->Cell(15,5,"Pass", "1", "0","C");
                                $pdf->SetTextColor(0,0,0);
                                $pdf->Ln();
							}
							else 
							{
								$f++;
                                $pdf->Cell(124,5,$row['test_name_method'].' (Weft)',"1", "0","L");
                                $pdf->Cell(21,5,$row_for_qc['seam_slippage_resistance_iso_2_in_weft_value'].' ' .$row_for_defining_process['uom_of_seam_slippage_resistance_iso_2_in_weft'], "1", "0","L");
                                $pdf->Cell(30,5,$row_for_defining_process['seam_slippage_resistance_iso_2_in_weft_tolerance_range_math_operator'].' '.$row_for_defining_process['seam_slippage_resistance_iso_2_in_weft_tolerance_value'].' '.$row_for_defining_process['uom_of_seam_slippage_resistance_iso_2_in_weft'], "1", "0","L");
                                $pdf->SetTextColor(194,8,8);

                                $pdf->Cell(15,5,"Fail", "1", "0","C");
                                $pdf->SetTextColor(0,0,0);
                                $pdf->Ln();
								
							}
						}
					 }   /*End of if (in_array($row['id'], ['9', '186', '230']))*/

					 if (in_array($row['id'], ['11']))
					 {
						
						if ($row_for_defining_process['seam_strength_in_warp_value_max_value']<>0 && $row_for_qc['seam_strength_in_warp_value']<>0) {

							$total_test++;

							if($row_for_defining_process['seam_strength_in_warp_value_min_value']<=$row_for_qc['seam_strength_in_warp_value'] && $row_for_defining_process['seam_strength_in_warp_value_max_value']>=$row_for_qc['seam_strength_in_warp_value'])
							{
								$p++;
								 $pdf->Cell(124,5,$row['test_name_method'].' (Warp)',"1", "0","L");
                                $pdf->Cell(21,5,$row_for_qc['seam_strength_in_warp_value'].' ' .$row_for_defining_process['uom_of_seam_strength_in_warp_value'], "1", "0","L");
                                $pdf->Cell(30,5,$row_for_defining_process['seam_strength_in_warp_value_tolerance_range_math_operator'].' '.$row_for_defining_process['seam_strength_in_warp_value_tolerance_value'].' '.$row_for_defining_process['uom_of_seam_strength_in_warp_value'], "1", "0","L");
                                $pdf->Cell(15,5,"Pass", "1", "0","C");
                                $pdf->SetTextColor(0,0,0);
                                $pdf->Ln();
							}
							else {
								$f++;
                                $pdf->Cell(124,5,$row['test_name_method'].' (Warp)',"1", "0","L");
                                $pdf->Cell(21,5,$row_for_qc['seam_strength_in_warp_value'].' ' .$row_for_defining_process['uom_of_seam_strength_in_warp_value'], "1", "0","L");
                                $pdf->Cell(30,5,$row_for_defining_process['seam_strength_in_warp_value_tolerance_range_math_operator'].' '.$row_for_defining_process['seam_strength_in_warp_value_tolerance_value'].' '.$row_for_defining_process['uom_of_seam_strength_in_warp_value'], "1", "0","L");
                                $pdf->SetTextColor(194,8,8);

                                $pdf->Cell(15,5,"Fail", "1", "0","C");
                                $pdf->SetTextColor(0,0,0);
                                $pdf->Ln();
								
							}

							}

						if ($row_for_defining_process['seam_strength_in_weft_value_max_value']<>0 && $row_for_qc['seam_strength_in_weft_value']<>0) 
						{

								$total_test++;
							if($row_for_defining_process['seam_strength_in_weft_value_min_value']<=$row_for_qc['seam_strength_in_weft_value'] && $row_for_defining_process['seam_strength_in_weft_value_max_value']>=$row_for_qc['seam_strength_in_weft_value'])
							{
								$p++;
                                $pdf->Cell(124,5,$row['test_name_method'].' (Weft)',"1", "0","L");
                                $pdf->Cell(21,5,$row_for_qc['seam_strength_in_weft_value'].' ' .$row_for_defining_process['uom_of_seam_strength_in_weft_value'], "1", "0","L");
                                $pdf->Cell(30,5,$row_for_defining_process['seam_strength_in_weft_value_tolerance_range_math_operator'].' '.$row_for_defining_process['seam_strength_in_weft_value_tolerance_value'].' '.$row_for_defining_process['uom_of_seam_strength_in_weft_value'], "1", "0","L");
                                $pdf->Cell(15,5,"Pass", "1", "0","C");
                                $pdf->SetTextColor(0,0,0);
                                $pdf->Ln();
							}
							else 
							{
								$f++;
                                $pdf->Cell(124,5,$row['test_name_method'].' (Weft)',"1", "0","L");
                                $pdf->Cell(21,5,$row_for_qc['seam_strength_in_weft_value'].' ' .$row_for_defining_process['uom_of_seam_strength_in_weft_value'], "1", "0","L");
                                $pdf->Cell(30,5,$row_for_defining_process['seam_strength_in_weft_value_tolerance_range_math_operator'].' '.$row_for_defining_process['seam_strength_in_weft_value_tolerance_value'].' '.$row_for_defining_process['uom_of_seam_strength_in_weft_value'], "1", "0","L");
                                $pdf->SetTextColor(194,8,8);

                                $pdf->Cell(15,5,"Fail", "1", "0","C");
                                $pdf->SetTextColor(0,0,0);
                                $pdf->Ln();
								
							}
						}
					 } /* End of  if (in_array($row['id'], ['11', '149', '187', '244', '304']))*/

					 if (in_array($row['id'], ['12']))
					 {
						
						if ($row_for_defining_process['seam_properties_seam_slippage_iso_astm_d_in_warp_max_value']<>0 && $row_for_qc['seam_properties_seam_slippage_iso_astm_d_in_warp_value']<>0) {

							$total_test++;

							if($row_for_defining_process['seam_properties_seam_slippage_iso_astm_d_in_warp_min_value']<=$row_for_qc['seam_properties_seam_slippage_iso_astm_d_in_warp_value'] && $row_for_defining_process['seam_properties_seam_slippage_iso_astm_d_in_warp_max_value']>=$row_for_qc['seam_properties_seam_slippage_iso_astm_d_in_warp_value'])
							{
								$p++;
								 $pdf->Cell(124,5,$row['test_name_method'].' (Warp)',"1", "0","L");
                                $pdf->Cell(21,5,$row_for_qc['seam_properties_seam_slippage_iso_astm_d_in_warp_value'].' ' .$row_for_defining_process['uom_of_seam_properties_seam_slippage_iso_astm_d_in_warp'], "1", "0","L");
                                $pdf->Cell(30,5,$row_for_defining_process['seam_properties_seam_slippage_iso_astm_d_in_warp_tol_range_mt_op'].' '.$row_for_defining_process['seam_properties_seam_slippage_iso_astm_d_in_warp_tolerance_value'].' '.$row_for_defining_process['uom_of_seam_properties_seam_slippage_iso_astm_d_in_warp'], "1", "0","L");
                                $pdf->Cell(15,5,"Pass", "1", "0","C");
                                $pdf->SetTextColor(0,0,0);
                                $pdf->Ln();
							}
							else {
								$f++;
                                $pdf->Cell(124,5,$row['test_name_method'].' (Warp)',"1", "0","L");
                                $pdf->Cell(21,5,$row_for_qc['seam_properties_seam_slippage_iso_astm_d_in_warp_value'].' ' .$row_for_defining_process['uom_of_seam_properties_seam_slippage_iso_astm_d_in_warp'], "1", "0","L");
                                $pdf->Cell(30,5,$row_for_defining_process['seam_properties_seam_slippage_iso_astm_d_in_warp_tol_range_mt_op'].' '.$row_for_defining_process['seam_properties_seam_slippage_iso_astm_d_in_warp_tolerance_value'].' '.$row_for_defining_process['uom_of_seam_properties_seam_slippage_iso_astm_d_in_warp'], "1", "0","L");
                                $pdf->SetTextColor(194,8,8);

                                $pdf->Cell(15,5,"Fail", "1", "0","C");
                                $pdf->SetTextColor(0,0,0);
                                $pdf->Ln();
								
							}

							}	

							if ($row_for_defining_process['seam_properties_seam_slippage_iso_astm_d_in_weft_max_value']<>0 && $row_for_qc['seam_properties_seam_slippage_iso_astm_d_in_weft_value']<>0) {

							$total_test++;

							if($row_for_defining_process['seam_properties_seam_slippage_iso_astm_d_in_weft_min_value']<=$row_for_qc['seam_properties_seam_slippage_iso_astm_d_in_weft_value'] && $row_for_defining_process['seam_properties_seam_slippage_iso_astm_d_in_weft_max_value']>=$row_for_qc['seam_properties_seam_slippage_iso_astm_d_in_weft_value'])
							{
								$p++;
                                $pdf->Cell(124,5,$row['test_name_method'].' (Weft)',"1", "0","L");
                                $pdf->Cell(21,5,$row_for_qc['seam_properties_seam_slippage_iso_astm_d_in_weft_value'].' ' .$row_for_defining_process['uom_of_seam_properties_seam_slippage_iso_astm_d_in_weft'], "1", "0","L");
                                $pdf->Cell(30,5,$row_for_defining_process['seam_properties_seam_slippage_iso_astm_d_in_weft_tol_range_mt_op'].' '.$row_for_defining_process['seam_properties_seam_slippage_iso_astm_d_in_weft_tolerance_value'].' '.$row_for_defining_process['uom_of_seam_properties_seam_slippage_iso_astm_d_in_weft'], "1", "0","L");
                                $pdf->Cell(15,5,"Pass", "1", "0","C");
                                $pdf->SetTextColor(0,0,0);
                                $pdf->Ln();
								
							}
							else {
								$f++;
                                $pdf->Cell(124,5,$row['test_name_method'].' (Weft)',"1", "0","L");
                                $pdf->Cell(21,5,$row_for_qc['seam_properties_seam_slippage_iso_astm_d_in_weft_value'].' ' .$row_for_defining_process['uom_of_seam_properties_seam_slippage_iso_astm_d_in_weft'], "1", "0","L");
                                $pdf->Cell(30,5,$row_for_defining_process['seam_properties_seam_slippage_iso_astm_d_in_weft_tol_range_mt_op'].' '.$row_for_defining_process['seam_properties_seam_slippage_iso_astm_d_in_weft_tolerance_value'].' '.$row_for_defining_process['uom_of_seam_properties_seam_slippage_iso_astm_d_in_weft'], "1", "0","L");
                                $pdf->SetTextColor(194,8,8);

                                $pdf->Cell(15,5,"Fail", "1", "0","C");
                                $pdf->SetTextColor(0,0,0);
                                $pdf->Ln();
								
							}

						}

						if ($row_for_defining_process['seam_properties_seam_strength_iso_astm_d_in_warp_max_value']<>0 && $row_for_qc['seam_properties_seam_strength_iso_astm_d_in_warp_value']<>0) 
						{

							$total_test++;

							if($row_for_defining_process['seam_properties_seam_strength_iso_astm_d_in_warp_min_value']<=$row_for_qc['seam_properties_seam_strength_iso_astm_d_in_warp_value'] && $row_for_defining_process['seam_properties_seam_strength_iso_astm_d_in_warp_max_value']>=$row_for_qc['seam_properties_seam_strength_iso_astm_d_in_warp_value'])
							{
								$p++;
								 $pdf->Cell(124,5,$row['test_name_method'].' (Warp)',"1", "0","L");
                                $pdf->Cell(21,5,$row_for_qc['seam_properties_seam_strength_iso_astm_d_in_warp_value'].' ' .$row_for_defining_process['uom_of_seam_properties_seam_strength_iso_astm_d_in_warp'], "1", "0","L");
                                $pdf->Cell(30,5,$row_for_defining_process['seam_properties_seam_strength_iso_astm_d_in_warp_tol_range_op'].' '.$row_for_defining_process['seam_properties_seam_strength_iso_astm_d_in_warp_tolerance_value'].' '.$row_for_defining_process['uom_of_seam_properties_seam_strength_iso_astm_d_in_warp'], "1", "0","L");
                                $pdf->Cell(15,5,"Pass", "1", "0","C");
                                $pdf->SetTextColor(0,0,0);
                                $pdf->Ln();
							}
							else {
								$f++;
                                $pdf->Cell(124,5,$row['test_name_method'].' (Warp)',"1", "0","L");
                                $pdf->Cell(21,5,$row_for_qc['seam_properties_seam_strength_iso_astm_d_in_warp_value'].' ' .$row_for_defining_process['uom_of_seam_properties_seam_strength_iso_astm_d_in_warp'], "1", "0","L");
                                $pdf->Cell(30,5,$row_for_defining_process['seam_properties_seam_strength_iso_astm_d_in_warp_tol_range_op'].' '.$row_for_defining_process['seam_properties_seam_strength_iso_astm_d_in_warp_tolerance_value'].' '.$row_for_defining_process['uom_of_seam_properties_seam_strength_iso_astm_d_in_warp'], "1", "0","L");
                                $pdf->SetTextColor(194,8,8);

                                $pdf->Cell(15,5,"Fail", "1", "0","C");
                                $pdf->SetTextColor(0,0,0);
                                $pdf->Ln();
								
							}

						}

						if ($row_for_defining_process['seam_properties_seam_strength_iso_astm_d_in_weft_max_value']<>0 && $row_for_qc['seam_properties_seam_strength_iso_astm_d_in_weft_value']<>0)
						{

							$total_test++;

							if($row_for_defining_process['seam_properties_seam_strength_iso_astm_d_in_weft_min_value']<=$row_for_qc['seam_properties_seam_strength_iso_astm_d_in_weft_value'] && $row_for_defining_process['seam_properties_seam_strength_iso_astm_d_in_weft_max_value']>=$row_for_qc['seam_properties_seam_strength_iso_astm_d_in_weft_value'])
							{
								$p++;
                                $pdf->Cell(124,5,$row['test_name_method'].' (Weft)',"1", "0","L");
                                $pdf->Cell(21,5,$row_for_qc['seam_properties_seam_strength_iso_astm_d_in_weft_value'].' ' .$row_for_defining_process['uom_of_seam_properties_seam_strength_iso_astm_d_in_weft'], "1", "0","L");
                                $pdf->Cell(30,5,$row_for_defining_process['seam_properties_seam_strength_iso_astm_d_in_weft_tol_range_op'].' '.$row_for_defining_process['seam_properties_seam_strength_iso_astm_d_in_weft_tolerance_value'].' '.$row_for_defining_process['uom_of_seam_properties_seam_strength_iso_astm_d_in_weft'], "1", "0","L");
                                $pdf->Cell(15,5,"Pass", "1", "0","C");
                                $pdf->SetTextColor(0,0,0);
                                $pdf->Ln();
							}
							else {
								$f++;
                                $pdf->Cell(124,5,$row['test_name_method'].' (Weft)',"1", "0","L");
                                $pdf->Cell(21,5,$row_for_qc['seam_properties_seam_strength_iso_astm_d_in_weft_value'].' ' .$row_for_defining_process['uom_of_seam_properties_seam_strength_iso_astm_d_in_weft'], "1", "0","L");
                                $pdf->Cell(30,5,$row_for_defining_process['seam_properties_seam_strength_iso_astm_d_in_weft_tol_range_op'].' '.$row_for_defining_process['seam_properties_seam_strength_iso_astm_d_in_weft_tolerance_value'].' '.$row_for_defining_process['uom_of_seam_properties_seam_strength_iso_astm_d_in_weft'], "1", "0","L");
                                $pdf->SetTextColor(194,8,8);

                                $pdf->Cell(15,5,"Fail", "1", "0","C");
                                $pdf->SetTextColor(0,0,0);
                                $pdf->Ln();
							
							}

						}
					}

					if (in_array($row['id'], ['13']))
					 {
						
						if ($row_for_defining_process['abrasion_resistance_no_of_thread_break_max_value']<>0 && $row_for_qc['abrasion_resistance_no_of_thread_break_value']<>0) 
						{

							$total_test++;

							if($row_for_defining_process['abrasion_resistance_no_of_thread_break_min_value']<=$row_for_qc['abrasion_resistance_no_of_thread_break_value'] && $row_for_defining_process['abrasion_resistance_no_of_thread_break_max_value']>=$row_for_qc['abrasion_resistance_no_of_thread_break_value'])
							{
								$p++;
								 $pdf->Cell(124,5,$row['test_name_method'],"1", "0","L");
                                $pdf->Cell(21,5,$row_for_qc['abrasion_resistance_no_of_thread_break_value'].' ' .$row_for_defining_process['uom_of_abrasion_resistance_no_of_thread_break'], "1", "0","L");
                                $pdf->Cell(30,5,$row_for_defining_process['abrasion_resistance_no_of_thread_break_min_value'].' '.$row_for_defining_process['abrasion_resistance_no_of_thread_break_max_value'].' '.$row_for_defining_process['uom_of_seam_properties_seam_strength_iso_astm_d_in_weft'], "1", "0","L");
                                $pdf->Cell(15,5,"Pass", "1", "0","C");
                                $pdf->SetTextColor(0,0,0);
                                $pdf->Ln();
							}
							else {
								$f++;
                                $pdf->Cell(124,5,$row['test_name_method'],"1", "0","L");
                                $pdf->Cell(21,5,$row_for_qc['abrasion_resistance_no_of_thread_break_value'].' ' .$row_for_defining_process['uom_of_abrasion_resistance_no_of_thread_break'], "1", "0","L");
                                $pdf->Cell(30,5,$row_for_defining_process['abrasion_resistance_no_of_thread_break_min_value'].' '.$row_for_defining_process['abrasion_resistance_no_of_thread_break_max_value'].' '.$row_for_defining_process['uom_of_seam_properties_seam_strength_iso_astm_d_in_weft'], "1", "0","L");
                                $pdf->SetTextColor(194,8,8);

                                $pdf->Cell(15,5,"Fail", "1", "0","C");
                                $pdf->SetTextColor(0,0,0);
                                $pdf->Ln();
								
							}
						}	

						if ($row_for_defining_process['abrasion_resistance_c_change_value_max_value']<>0 && $row_for_qc['abrasion_resistance_c_change_value']<>0) {

								$total_test++;
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


							if($row_for_defining_process['abrasion_resistance_c_change_value_min_value']<=$row_for_qc['abrasion_resistance_c_change_value'] && $row_for_defining_process['abrasion_resistance_c_change_value_max_value']>=$row_for_qc['abrasion_resistance_c_change_value'])
							{
								$p++;
								 $pdf->Cell(124,5,$row['test_name_method'].' (Color Change)',"1", "0","L");
                                $pdf->Cell(21,5,$abrasion_resistance_c_change_value.' ' .$row_for_defining_process['uom_of_abrasion_resistance_c_change_value'], "1", "0","L");
                                $pdf->Cell(30,5,$row_for_defining_process['abrasion_resistance_c_change_value_math_op'].' '.$abrasion_resistance_c_change_value_tolerance_value.' '.$row_for_defining_process['uom_of_abrasion_resistance_c_change_value'], "1", "0","L");
                                $pdf->Cell(15,5,"Pass", "1", "0","C");
                                $pdf->SetTextColor(0,0,0);
                                $pdf->Ln();
							}
							else {
								$f++;
                                $pdf->Cell(124,5,$row['test_name_method'].' (Color Change)',"1", "0","L");
                                $pdf->Cell(21,5,$abrasion_resistance_c_change_value.' ' .$row_for_defining_process['uom_of_abrasion_resistance_c_change_value'], "1", "0","L");
                                $pdf->Cell(30,5,$row_for_defining_process['abrasion_resistance_c_change_value_math_op'].' '.$abrasion_resistance_c_change_value_tolerance_value.' '.$row_for_defining_process['uom_of_abrasion_resistance_c_change_value'], "1", "0","L");
                                $pdf->SetTextColor(194,8,8);

                                $pdf->Cell(15,5,"Fail", "1", "0","C");
                                $pdf->SetTextColor(0,0,0);
                                $pdf->Ln();
								
							}
						}
													
					}

					 if (in_array($row['id'], ['14']))
					{
						
						if ($row_for_defining_process['mass_loss_in_abrasion_test_value_max_value']<>0 && $row_for_qc['mass_loss_in_abrasion_value']<>0) {

							$total_test++;

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

							if($row_for_defining_process['mass_loss_in_abrasion_test_value_min_value']<=$row_for_qc['mass_loss_in_abrasion_value'] && $row_for_defining_process['mass_loss_in_abrasion_test_value_max_value']>=$row_for_qc['mass_loss_in_abrasion_value'])
							{
								$p++;
								 $pdf->Cell(124,5,$row['test_name_method'],"1", "0","L");
                                $pdf->Cell(21,5,$mass_loss_in_abrasion_value.' ' .$row_for_defining_process['uom_of_mass_loss_in_abrasion_test_value'], "1", "0","L");
                                $pdf->Cell(30,5,$row_for_defining_process['mass_loss_in_abrasion_test_value_tolerance_range_math_operator'].' '.$mass_loss_in_abrasion_test_value_tolerance_value.' '.$row_for_defining_process['uom_of_mass_loss_in_abrasion_test_value'], "1", "0","L");
                                $pdf->Cell(15,5,"Pass", "1", "0","C");
                                $pdf->SetTextColor(0,0,0);
                                $pdf->Ln();
							}
							else {
								$f++;
                                $pdf->Cell(124,5,$row['test_name_method'],"1", "0","L");
                                $pdf->Cell(21,5,$mass_loss_in_abrasion_value.' ' .$row_for_defining_process['uom_of_mass_loss_in_abrasion_test_value'], "1", "0","L");
                                $pdf->Cell(30,5,$row_for_defining_process['mass_loss_in_abrasion_test_value_tolerance_range_math_operator'].' '.$mass_loss_in_abrasion_test_value_tolerance_value.' '.$row_for_defining_process['uom_of_mass_loss_in_abrasion_test_value'], "1", "0","L");
                                $pdf->SetTextColor(194,8,8);

                                $pdf->Cell(15,5,"Fail", "1", "0","C");
                                $pdf->SetTextColor(0,0,0);
                                $pdf->Ln();
								
								
							}

						}								
													
					} 

					 if (in_array($row['id'], ['15','59']))
					{
						
						if ($row_for_defining_process['cf_to_washing_color_change_max_value']<>0 && $row_for_qc['cf_to_washing_color_change_value']<>0) {

							$total_test++;

                                 if($row_for_defining_process['cf_to_washing_color_change_tolerance_range_math_operator'] == '≥')
                                 {
                                    $cf_to_washing_color_change_tolerance_range_math_operator = $pdf->Image('../img/greater_equal.png',156, $pdf->GetY()+1.5, 1.7).'   ';
                                 }
                                 else if($row_for_defining_process['cf_to_washing_color_change_tolerance_range_math_operator'] == '≤')
                                 {
                                    $cf_to_washing_color_change_tolerance_range_math_operator = $pdf->Image('../img/less_equal.png',156, $pdf->GetY()+1.5, 1.7).'   ';
                                 }
                                 else if($row_for_defining_process['cf_to_washing_color_change_tolerance_range_math_operator'] == '>')
                                 {
                                    $cf_to_washing_color_change_tolerance_range_math_operator = '>';
                                 }
                                 else if($row_for_defining_process['cf_to_washing_color_change_tolerance_range_math_operator'] == '<')
                                 {
                                    $cf_to_washing_color_change_tolerance_range_math_operator = '<';
                                 }


                                 if($customer_type == 'american')
                                 {
                                    $cf_to_washing_color_change_tolerance_value = $row_for_defining_process['cf_to_washing_color_change_tolerance_value'];
                                    $cf_to_washing_color_change_value = $row_for_qc['cf_to_washing_color_change_value'];
            
                                 }
                                 if($customer_type == 'european')
                                 {
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
                                       }  				// for defining
            
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
                                       } 				// for test result
            
                                 }

							if($row_for_defining_process['cf_to_washing_color_change_min_value']<=$row_for_qc['cf_to_washing_color_change_value'] && $row_for_defining_process['cf_to_washing_color_change_max_value']>=$row_for_qc['cf_to_washing_color_change_value'])
							{
								$p++;
								 $pdf->Cell(124,5,$row['test_name_method'].' (Color Change)',"1", "0","L");
                                $pdf->Cell(21,5,$cf_to_washing_color_change_value.' ' .$row_for_defining_process['uom_of_cf_to_washing_color_change'], "1", "0","L");
                                $pdf->Cell(30,5,$cf_to_washing_color_change_tolerance_range_math_operator.' '.$cf_to_washing_color_change_tolerance_value.' '.$row_for_defining_process['uom_of_cf_to_washing_color_change'], "1", "0","L");
                                $pdf->Cell(15,5,"Pass", "1", "0","C");
                                $pdf->SetTextColor(0,0,0);
                                $pdf->Ln();
							}
							else {
								$f++;
                                $pdf->Cell(124,5,$row['test_name_method'].' (Color Change)',"1", "0","L");
                                $pdf->Cell(21,5,$cf_to_washing_color_change_value.' ' .$row_for_defining_process['uom_of_cf_to_washing_color_change'], "1", "0","L");
                                $pdf->Cell(30,5,$cf_to_washing_color_change_tolerance_range_math_operator.' '.$cf_to_washing_color_change_tolerance_value.' '.$row_for_defining_process['uom_of_cf_to_washing_color_change'], "1", "0","L");
                                $pdf->SetTextColor(194,8,8);

                                $pdf->Cell(15,5,"Fail", "1", "0","C");
                                $pdf->SetTextColor(0,0,0);
                                $pdf->Ln();
								
							}

							
						} /*end of cf_to_washing_color_change*/

							if ($row_for_defining_process['cf_to_washing_staining_max_value']<>0 && $row_for_qc['cf_to_washing_staining_value']<>0) {

								$total_test++;

                        if($row_for_defining_process['cf_to_washing_staining_tolerance_range_math_operator'] == '≥')
                        {
                           $cf_to_washing_staining_tolerance_range_math_operator = $pdf->Image('../img/greater_equal.png',156, $pdf->GetY()+1.5, 1.7).'   ';
                        }
                        else if($row_for_defining_process['cf_to_washing_staining_tolerance_range_math_operator'] == '≤')
                        {
                           $cf_to_washing_staining_tolerance_range_math_operator = $pdf->Image('../img/less_equal.png',156, $pdf->GetY()+1.5, 1.7).'   ';
                        }
                        else if($row_for_defining_process['cf_to_washing_staining_tolerance_range_math_operator'] == '>')
                        {
                           $cf_to_washing_staining_tolerance_range_math_operator = '>';
                        }
                        else if($row_for_defining_process['cf_to_washing_staining_tolerance_range_math_operator'] == '<')
                        {
                           $cf_to_washing_staining_tolerance_range_math_operator = '<';
                        }

                        if($customer_type == 'american')
                        {
                           $cf_to_washing_staining_tolerance_value =  $row_for_defining_process['cf_to_washing_staining_tolerance_value'];
                           $cf_to_washing_staining_value = $row_for_qc['cf_to_washing_staining_value'];

                        }
                        if($customer_type == 'european')
                        {
                        
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
                           }			// for defining

                     $cf_to_washing_staining = $row_for_qc['cf_to_washing_staining_value'];
                  
                        if($cf_to_washing_staining ==1.0)
                        {
                           $cf_to_washing_staining_value = '1';
                        }
                        elseif($cf_to_washing_staining ==1.5)
                        {
                           $cf_to_washing_staining_value = '1-2';
                        }
                        elseif($cf_to_washing_staining ==2.0)
                        {
                           $cf_to_washing_staining_value = '2';
                        }
                        elseif($cf_to_washing_staining ==2.5)
                        {
                           $cf_to_washing_staining_value = '2-3';
                        }
                        elseif($cf_to_washing_staining ==3.0)
                        {
                           $cf_to_washing_staining_value = '3';
                        }
                        elseif($cf_to_washing_staining ==3.5)
                        {
                           $cf_to_washing_staining_value = '3-4';
                        }
                        elseif($cf_to_washing_staining ==4.0)
                        {
                           $cf_to_washing_staining_value = '4';
                        }
                        elseif($cf_to_washing_staining ==4.5)
                        {
                           $cf_to_washing_staining_value = '4-5';
                        }
                        elseif($cf_to_washing_staining ==5.0)
                        {
                           $cf_to_washing_staining_value = '5';
                        } 				// for test result

                  }



							if($row_for_defining_process['cf_to_washing_staining_min_value']<=$row_for_qc['cf_to_washing_staining_value'] && $row_for_defining_process['cf_to_washing_staining_max_value']>=$row_for_qc['cf_to_washing_staining_value'])
							{
								$p++;
								 $pdf->Cell(124,5,$row['test_name_method'].' (Staining)',"1", "0","L");
                                $pdf->Cell(21,5,$cf_to_washing_staining_value.' ' .$row_for_defining_process['uom_of_cf_to_washing_staining'], "1", "0","L");
                                $pdf->Cell(30,5,$cf_to_washing_staining_tolerance_range_math_operator.' '.$cf_to_washing_staining_tolerance_value.' '.$row_for_defining_process['uom_of_cf_to_washing_staining'], "1", "0","L");
                                $pdf->Cell(15,5,"Pass", "1", "0","C");
                                $pdf->SetTextColor(0,0,0);
                                $pdf->Ln();
							}
							else {
								$f++;
                                $pdf->Cell(124,5,$row['test_name_method'].' (Staining)',"1", "0","L");
                                $pdf->Cell(21,5,$cf_to_washing_staining_value.' ' .$row_for_defining_process['uom_of_cf_to_washing_staining'], "1", "0","L");
                                $pdf->Cell(30,5,$cf_to_washing_staining_tolerance_range_math_operator.' '.$cf_to_washing_staining_tolerance_value.' '.$row_for_defining_process['uom_of_cf_to_washing_staining'], "1", "0","L");
                                $pdf->SetTextColor(194,8,8);

                                $pdf->Cell(15,5,"Fail", "1", "0","C");
                                $pdf->SetTextColor(0,0,0);
                                $pdf->Ln();
								
							}


							}	

							if ($row_for_defining_process['cf_to_washing_cross_staining_max_value']<>0 && $row_for_qc['cf_to_washing_cross_staining_value']<>0) {

								$total_test++;

                        if($row_for_defining_process['cf_to_washing_cross_staining_tolerance_range_math_operator'] == '≥')
                        {
                           $cf_to_washing_cross_staining_tolerance_range_math_operator = $pdf->Image('../img/greater_equal.png',156, $pdf->GetY()+1.5, 1.7).'   ';
                        }
                        else if($row_for_defining_process['cf_to_washing_cross_staining_tolerance_range_math_operator'] == '≤')
                        {
                           $cf_to_washing_cross_staining_tolerance_range_math_operator = $pdf->Image('../img/less_equal.png',156, $pdf->GetY()+1.5, 1.7).'   ';
                        }
                        else if($row_for_defining_process['cf_to_washing_cross_staining_tolerance_range_math_operator'] == '>')
                        {
                           $cf_to_washing_cross_staining_tolerance_range_math_operator = '>';
                        }
                        else if($row_for_defining_process['cf_to_washing_cross_staining_tolerance_range_math_operator'] == '<')
                        {
                           $cf_to_washing_cross_staining_tolerance_range_math_operator = '<';
                        }

                        if($customer_type == 'american')
									{
										$cf_to_washing_cross_staining_tolerance_value =  $row_for_defining_process['cf_to_washing_cross_staining_tolerance_value'];
										$cf_to_washing_cross_staining_value = $row_for_qc['cf_to_washing_cross_staining_value'];

									}
									if($customer_type == 'european')
									{
									
											$cf_to_washing_cross_staining_tolerance = $row_for_defining_process['cf_to_washing_cross_staining_tolerance_value'];
										
											if($cf_to_washing_cross_staining_tolerance ==1.0)
											{
												$cf_to_washing_cross_staining_tolerance_value = '1';
											}
											elseif($cf_to_washing_cross_staining_tolerance ==1.5)
											{
												$cf_to_washing_cross_staining_tolerance_value = '1-2';
											}
											elseif($cf_to_washing_cross_staining_tolerance ==2.0)
											{
												$cf_to_washing_cross_staining_tolerance_value = '2';
											}
											elseif($cf_to_washing_cross_staining_tolerance ==2.5)
											{
												$cf_to_washing_cross_staining_tolerance_value = '2-3';
											}
											elseif($cf_to_washing_cross_staining_tolerance ==3.0)
											{
												$cf_to_washing_cross_staining_tolerance_value = '3';
											}
											elseif($cf_to_washing_cross_staining_tolerance ==3.5)
											{
												$cf_to_washing_cross_staining_tolerance_value = '3-4';
											}
											elseif($cf_to_washing_cross_staining_tolerance ==4.0)
											{
												$cf_to_washing_cross_staining_tolerance_value = '4';
											}
											elseif($cf_to_washing_cross_staining_tolerance ==4.5)
											{
												$cf_to_washing_cross_staining_tolerance_value = '4-5';
											}
											elseif($cf_to_washing_cross_staining_tolerance ==5.0)
											{
												$cf_to_washing_cross_staining_tolerance_value = '5';
											}			// for defining

											$cf_to_washing_cross_staining = $row_for_qc['cf_to_washing_cross_staining_value'];
									
											if($cf_to_washing_cross_staining ==1.0)
											{
												$cf_to_washing_cross_staining_value = '1';
											}
											elseif($cf_to_washing_cross_staining ==1.5)
											{
												$cf_to_washing_cross_staining_value = '1-2';
											}
											elseif($cf_to_washing_cross_staining ==2.0)
											{
												$cf_to_washing_cross_staining_value = '2';
											}
											elseif($cf_to_washing_cross_staining ==2.5)
											{
												$cf_to_washing_cross_staining_value = '2-3';
											}
											elseif($cf_to_washing_cross_staining ==3.0)
											{
												$cf_to_washing_cross_staining_value = '3';
											}
											elseif($cf_to_washing_cross_staining ==3.5)
											{
												$cf_to_washing_cross_staining_value = '3-4';
											}
											elseif($cf_to_washing_cross_staining ==4.0)
											{
												$cf_to_washing_cross_staining_value = '4';
											}
											elseif($cf_to_washing_cross_staining ==4.5)
											{
												$cf_to_washing_cross_staining_value = '4-5';
											}
											elseif($cf_to_washing_cross_staining ==5.0)
											{
												$cf_to_washing_cross_staining_value = '5';
											} 				// for test result

							}

							if($row_for_defining_process['cf_to_washing_cross_staining_min_value']<=$row_for_qc['cf_to_washing_cross_staining_value'] && $row_for_defining_process['cf_to_washing_cross_staining_max_value']>=$row_for_qc['cf_to_washing_cross_staining_value'])
							{
								$p++;
                                $pdf->Cell(124,5,$row['test_name_method'].' (Cross Staining)',"1", "0","L");
                                $pdf->Cell(21,5,$cf_to_washing_cross_staining_value.' ' .$row_for_defining_process['uom_of_cf_to_washing_cross_staining'], "1", "0","L");
                                $pdf->Cell(30,5,$cf_to_washing_cross_staining_tolerance_range_math_operator.' '.$cf_to_washing_cross_staining_tolerance_value.' '.$row_for_defining_process['uom_of_cf_to_washing_cross_staining'], "1", "0","L");
                                $pdf->Cell(15,5,"Pass", "1", "0","C");
                                $pdf->SetTextColor(0,0,0);
                                $pdf->Ln();
							}
							else {
								$f++;
                                $pdf->Cell(124,5,$row['test_name_method'].' (Cross Staining)',"1", "0","L");
                                $pdf->Cell(21,5,$cf_to_washing_cross_staining_value.' ' .$row_for_defining_process['uom_of_cf_to_washing_cross_staining'], "1", "0","L");
                                $pdf->Cell(30,5,$cf_to_washing_cross_staining_tolerance_range_math_operator.' '.$cf_to_washing_cross_staining_tolerance_value.' '.$row_for_defining_process['uom_of_cf_to_washing_cross_staining'], "1", "0","L");
                                $pdf->SetTextColor(194,8,8);

                                $pdf->Cell(15,5,"Fail", "1", "0","C");
                                $pdf->SetTextColor(0,0,0);
                                $pdf->Ln();
								
							}

						}		/*	cf_to_washing_cross_staining_tolerance_value*/					
													
					}

                    if (in_array($row['id'], ['16']))
					{
						
						if ($row_for_defining_process['cf_to_dry_cleaning_color_change_max_value']<>0 && $row_for_qc['cf_to_dry_cleaning_color_change_value']<>0) {

							$total_test++;

                     if($customer_type == 'american')
							{
								$cf_to_dry_cleaning_color_change_tolerance_value = $row_for_defining_process['cf_to_dry_cleaning_color_change_tolerance_value'];
								$cf_to_dry_cleaning_color_change_value = $row_for_qc['cf_to_dry_cleaning_color_change_value'];

							}
							if($customer_type == 'european')
							{
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
										$cf_to_dry_cleaning_color_change_tolerance_value = '2-3';
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
									}			// for defining

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
									} 				// for test result

							}
							if($row_for_defining_process['cf_to_dry_cleaning_color_change_min_value']<=$row_for_qc['cf_to_dry_cleaning_color_change_value'] && $row_for_defining_process['cf_to_dry_cleaning_color_change_max_value']>=$row_for_qc['cf_to_dry_cleaning_color_change_value'])
							{
								$p++;
                                $pdf->Cell(124,5,$row['test_name_method'].' (Color Change)',"1", "0","L");
                                $pdf->Cell(21,5,$cf_to_dry_cleaning_color_change_value.' ' .$row_for_defining_process['uom_of_cf_to_dry_cleaning_color_change'], "1", "0","L");
                                $pdf->Cell(30,5,$row_for_defining_process['cf_to_dry_cleaning_color_change_tolerance_range_math_operator'].' '.$cf_to_dry_cleaning_color_change_tolerance_value.' '.$row_for_defining_process['uom_of_cf_to_dry_cleaning_color_change'], "1", "0","L");
                                $pdf->Cell(15,5,"Pass", "1", "0","C");
                                $pdf->SetTextColor(0,0,0);
                                $pdf->Ln();
								
							}
							else {
								$f++;
                                $pdf->Cell(124,5,$row['test_name_method'].' (Color Change)',"1", "0","L");
                                $pdf->Cell(21,5,$cf_to_dry_cleaning_color_change_value.' ' .$row_for_defining_process['uom_of_cf_to_dry_cleaning_color_change'], "1", "0","L");
                                $pdf->Cell(30,5,$row_for_defining_process['cf_to_dry_cleaning_color_change_tolerance_range_math_operator'].' '.$cf_to_dry_cleaning_color_change_tolerance_value.' '.$row_for_defining_process['uom_of_cf_to_dry_cleaning_color_change'], "1", "0","L");
                                $pdf->SetTextColor(194,8,8);

                                $pdf->Cell(15,5,"Fail", "1", "0","C");
                                $pdf->SetTextColor(0,0,0);
                                $pdf->Ln();
								
							}

							

							}

							if ($row_for_defining_process['cf_to_dry_cleaning_staining_max_value']<>0 && $row_for_qc['cf_to_dry_cleaning_staining_value']<>0) {

								$total_test++;

                        if($customer_type == 'american')
								{
									$cf_to_dry_cleaning_staining_tolerance_value = $row_for_defining_process['cf_to_dry_cleaning_staining_tolerance_value'];
									$cf_to_dry_cleaning_staining_value = $row_for_qc['cf_to_dry_cleaning_staining_value'];

								}
								if($customer_type == 'european')
								{
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
								}			// for defining

								$cf_to_dry_cleaning_staining = $row_for_qc['cf_to_dry_cleaning_staining_value'];
							
									if($cf_to_dry_cleaning_staining ==1.0)
									{
										$cf_to_dry_cleaning_staining_value = '1';
									}
									elseif($cf_to_dry_cleaning_staining ==1.5)
									{
										$cf_to_dry_cleaning_staining_value = '1-2';
									}
									elseif($cf_to_dry_cleaning_staining ==2.0)
									{
										$cf_to_dry_cleaning_staining_value = '2';
									}
									elseif($cf_to_dry_cleaning_staining ==2.5)
									{
										$cf_to_dry_cleaning_staining_value = '2-3';
									}
									elseif($cf_to_dry_cleaning_staining ==3.0)
									{
										$cf_to_dry_cleaning_staining_value = '3';
									}
									elseif($cf_to_dry_cleaning_staining ==3.5)
									{
										$cf_to_dry_cleaning_staining_value = '3-4';
									}
									elseif($cf_to_dry_cleaning_staining ==4.0)
									{
										$cf_to_dry_cleaning_staining_value = '4';
									}
									elseif($cf_to_dry_cleaning_staining ==4.5)
									{
										$cf_to_dry_cleaning_staining_value = '4-5';
									}
									elseif($cf_to_dry_cleaning_staining ==5.0)
									{
										$cf_to_dry_cleaning_staining_value = '5';
									} 				// for test result

							}


							if($row_for_defining_process['cf_to_dry_cleaning_staining_min_value']<=$row_for_qc['cf_to_dry_cleaning_staining_value'] && $row_for_defining_process['cf_to_dry_cleaning_staining_max_value']>=$row_for_qc['cf_to_dry_cleaning_staining_value'])
							{
								$p++;
								 $pdf->Cell(124,5,$row['test_name_method'].' (Staining)',"1", "0","L");
                                $pdf->Cell(21,5,$cf_to_dry_cleaning_staining_value.' ' .$row_for_defining_process['uom_of_cf_to_dry_cleaning_staining'], "1", "0","L");
                                $pdf->Cell(30,5,$row_for_defining_process['cf_to_dry_cleaning_staining_tolerance_range_math_operator'].' '.$cf_to_dry_cleaning_staining_tolerance_value.' '.$row_for_defining_process['uom_of_cf_to_dry_cleaning_staining'], "1", "0","L");
                                $pdf->Cell(15,5,"Pass", "1", "0","C");
                                $pdf->SetTextColor(0,0,0);
                                $pdf->Ln();
							}
							else {
								$f++;
                                $pdf->Cell(124,5,$row['test_name_method'].' (Staining)',"1", "0","L");
                                $pdf->Cell(21,5,$cf_to_dry_cleaning_staining_value.' ' .$row_for_defining_process['uom_of_cf_to_dry_cleaning_staining'], "1", "0","L");
                                $pdf->Cell(30,5,$row_for_defining_process['cf_to_dry_cleaning_staining_tolerance_range_math_operator'].' '.$cf_to_dry_cleaning_staining_tolerance_value.' '.$row_for_defining_process['uom_of_cf_to_dry_cleaning_staining'], "1", "0","L");
                                $pdf->SetTextColor(194,8,8);

                                $pdf->Cell(15,5,"Fail", "1", "0","C");
                                $pdf->SetTextColor(0,0,0);
                                $pdf->Ln();
								
							}
                                 
							

					          }	

					}
                    /*  Iftekhar  After test*/
					 if (in_array($row['id'], ['17','61']))
					 {
						
						
                        
                        if($row_for_defining_process['cf_to_perspiration_acid_color_change_max_value']<>0 && $row_for_qc['cf_to_perspiration_acid_color_change_value']<>0)
                        {   
                           $total_test++;

                           if($row_for_defining_process['cf_to_perspiration_acid_color_change_tolerance_range_math_op'] == '≥')
                                 {
                                    $cf_to_perspiration_acid_color_change_tolerance_range_math_op = $pdf->Image('../img/greater_equal.png',156, $pdf->GetY()+1.5, 1.7).'   ';
                                 }
                                 else if($row_for_defining_process['cf_to_perspiration_acid_color_change_tolerance_range_math_op'] == '≤')
                                 {
                                    $cf_to_perspiration_acid_color_change_tolerance_range_math_op = $pdf->Image('../img/less_equal.png',156, $pdf->GetY()+1.5, 1.7).'   ';
                                 }
                                 else if($row_for_defining_process['cf_to_perspiration_acid_color_change_tolerance_range_math_op'] == '>')
                                 {
                                    $cf_to_perspiration_acid_color_change_tolerance_range_math_op = '>';
                                 }
                                 else if($row_for_defining_process['cf_to_perspiration_acid_color_change_tolerance_range_math_op'] == '<')
                                 {
                                    $cf_to_perspiration_acid_color_change_tolerance_range_math_op = '<';
                                 }


                                 if($customer_type == 'american')
                                 {
                                    $cf_to_perspiration_acid_color_change_tolerance_value = $row_for_defining_process['cf_to_perspiration_acid_color_change_tolerance_value'];
                                    $cf_to_perspiration_acid_color_change_value = $row_for_qc['cf_to_perspiration_acid_color_change_value'];
         
                                 }
                              if($customer_type == 'european')
                                 {
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
                                    }					// for defining
         
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
                                    } 				// for test result
         
                              }


                        	if($row_for_defining_process['cf_to_perspiration_acid_color_change_min_value']<=$row_for_qc['cf_to_perspiration_acid_color_change_value'] && $row_for_defining_process['cf_to_perspiration_acid_color_change_max_value']>=$row_for_qc['cf_to_perspiration_acid_color_change_value'])
							{
								$p++;
                                $pdf->Cell(124,5,$row['test_name_method'].' (Color Change)',"1", "0","L");
                                $pdf->Cell(21,5,$cf_to_perspiration_acid_color_change_value.' ' .$row_for_defining_process['uom_of_cf_to_perspiration_acid_color_change'], "1", "0","L");
                                $pdf->Cell(30,5,$cf_to_perspiration_acid_color_change_tolerance_range_math_op.' '.$cf_to_perspiration_acid_color_change_tolerance_value.' '.$row_for_defining_process['uom_of_cf_to_perspiration_acid_color_change'], "1", "0","L");
                                $pdf->Cell(15,5,"Pass", "1", "0","C");
                                $pdf->SetTextColor(0,0,0);
                                $pdf->Ln();
							}
							else {
								$f++;
                                $pdf->Cell(124,5,$row['test_name_method'].' (Color Change)',"1", "0","L");
                                $pdf->Cell(21,5,$cf_to_perspiration_acid_color_change_value.' ' .$row_for_defining_process['uom_of_cf_to_perspiration_acid_color_change'], "1", "0","L");
                                $pdf->Cell(30,5,$cf_to_perspiration_acid_color_change_tolerance_range_math_op.' '.$cf_to_perspiration_acid_color_change_tolerance_value.' '.$row_for_defining_process['uom_of_cf_to_perspiration_acid_color_change'], "1", "0","L");
                                $pdf->SetTextColor(194,8,8);

                                $pdf->Cell(15,5,"Fail", "1", "0","C");
                                $pdf->SetTextColor(0,0,0);
                                $pdf->Ln();
								
							}

						
						}

						if($row_for_defining_process['cf_to_perspiration_acid_staining_max_value']<>0 && $row_for_qc['cf_to_perspiration_acid_staining_value']<>0)
						{

							$total_test++;

                                 if($row_for_defining_process['cf_to_perspiration_acid_staining_tolerance_range_math_operator'] == '≥')
                                 {
                                    $cf_to_perspiration_acid_staining_tolerance_range_math_operator = $pdf->Image('../img/greater_equal.png',156, $pdf->GetY()+1.5, 1.7).'   ';
                                 }
                                 else if($row_for_defining_process['cf_to_perspiration_acid_staining_tolerance_range_math_operator'] == '≤')
                                 {
                                    $cf_to_perspiration_acid_staining_tolerance_range_math_operator = $pdf->Image('../img/less_equal.png',156, $pdf->GetY()+1.5, 1.7).'   ';
                                 }
                                 else if($row_for_defining_process['cf_to_perspiration_acid_staining_tolerance_range_math_operator'] == '>')
                                 {
                                    $cf_to_perspiration_acid_staining_tolerance_range_math_operator = '>';
                                 }
                                 else if($row_for_defining_process['cf_to_perspiration_acid_staining_tolerance_range_math_operator'] == '<')
                                 {
                                    $cf_to_perspiration_acid_staining_tolerance_range_math_operator = '<';
                                 }


                                 if($customer_type == 'american')
                                 {
                                    $cf_to_perspiration_acid_staining_value = $row_for_defining_process['cf_to_perspiration_acid_staining_value'];
                                    $cf_to_perspiration_acid_staining_val = $row_for_qc['cf_to_perspiration_acid_staining_value'];
         
                                 }
                              if($customer_type == 'european')
                                 {
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
                              }                                                 // for defining
         
                                 $cf_to_perspiration_acid_staining = $row_for_qc['cf_to_perspiration_acid_staining_value'];
                              
                                    if($cf_to_perspiration_acid_staining ==1.0)
                                    {
                                       $cf_to_perspiration_acid_staining_val = '1';
                                    }
                                    elseif($cf_to_perspiration_acid_staining ==1.5)
                                    {
                                       $cf_to_perspiration_acid_staining_val = '1-2';
                                    }
                                    elseif($cf_to_perspiration_acid_staining ==2.0)
                                    {
                                       $cf_to_perspiration_acid_staining_val = '2';
                                    }
                                    elseif($cf_to_perspiration_acid_staining ==2.5)
                                    {
                                       $cf_to_perspiration_acid_staining_val = '2-3';
                                    }
                                    elseif($cf_to_perspiration_acid_staining ==3.0)
                                    {
                                       $cf_to_perspiration_acid_staining_val = '3';
                                    }
                                    elseif($cf_to_perspiration_acid_staining ==3.5)
                                    {
                                       $cf_to_perspiration_acid_staining_val = '3-4';
                                    }
                                    elseif($cf_to_perspiration_acid_staining ==4.0)
                                    {
                                       $cf_to_perspiration_acid_staining_val = '4';
                                    }
                                    elseif($cf_to_perspiration_acid_staining ==4.5)
                                    {
                                       $cf_to_perspiration_acid_staining_val = '4-5';
                                    }
                                    elseif($cf_to_perspiration_acid_staining ==5.0)
                                    {
                                       $cf_to_perspiration_acid_staining_val = '5';
                                    } 				// for test result
         
                              }

							if($row_for_defining_process['cf_to_perspiration_acid_staining_min_value']<=$row_for_qc['cf_to_perspiration_acid_staining_value'] && $row_for_defining_process['cf_to_perspiration_acid_staining_max_value']>=$row_for_qc['cf_to_perspiration_acid_staining_value'])
							{
								$p++;
								 $pdf->Cell(124,5,$row['test_name_method'].' (Staining)',"1", "0","L");
                                $pdf->Cell(21,5,$cf_to_perspiration_acid_staining_val, "1", "0","L");
                                $pdf->Cell(30,5,$cf_to_perspiration_acid_staining_tolerance_range_math_operator.' '.$cf_to_perspiration_acid_staining_value, "1", "0","L");
                                $pdf->Cell(15,5,"Pass", "1", "0","C");
                                $pdf->SetTextColor(0,0,0);
                                $pdf->Ln();
							}
							else {
								$f++;
                                $pdf->Cell(124,5,$row['test_name_method'].' (Staining)',"1", "0","L");
                                $pdf->Cell(21,5,$cf_to_perspiration_acid_staining_val, "1", "0","L");
                                $pdf->Cell(30,5,$cf_to_perspiration_acid_staining_tolerance_range_math_operator.' '.$cf_to_perspiration_acid_staining_value, "1", "0","L");
                                $pdf->SetTextColor(194,8,8);

                                $pdf->Cell(15,5,"Fail", "1", "0","C");
                                $pdf->SetTextColor(0,0,0);
                                $pdf->Ln();
								
							}

                           
						}
		

		               if($row_for_defining_process['cf_to_perspiration_acid_cross_staining_max_value']<>0 && $row_for_qc['cf_to_perspiration_acid_cross_staining_value']<>0)
		                  {

		                    $total_test++;

                          if($row_for_defining_process['cf_to_perspiration_acid_cross_staining_tolerance_range_math_op'] == '≥')
                          {
                             $cf_to_perspiration_acid_cross_staining_tolerance_range_math_op = $pdf->Image('../img/greater_equal.png',156, $pdf->GetY()+1.5, 1.7).'   ';
                          }
                          else if($row_for_defining_process['cf_to_perspiration_acid_cross_staining_tolerance_range_math_op'] == '≤')
                          {
                             $cf_to_perspiration_acid_cross_staining_tolerance_range_math_op = $pdf->Image('../img/less_equal.png',156, $pdf->GetY()+1.5, 1.7).'   ';
                          }
                          else if($row_for_defining_process['cf_to_perspiration_acid_cross_staining_tolerance_range_math_op'] == '>')
                          {
                             $cf_to_perspiration_acid_cross_staining_tolerance_range_math_op = '>';
                          }
                          else if($row_for_defining_process['cf_to_perspiration_acid_cross_staining_tolerance_range_math_op'] == '<')
                          {
                             $cf_to_perspiration_acid_cross_staining_tolerance_range_math_op = '<';
                          }

                          if($customer_type == 'american')
                          {
                             $cf_to_perspiration_acid_cross_staining_tolerance_value = $row_for_defining_process['cf_to_perspiration_acid_cross_staining_tolerance_value'];
                             $cf_to_perspiration_acid_cross_staining_value = $row_for_qc['cf_to_perspiration_acid_cross_staining_value'];
  
                          }
                       if($customer_type == 'european')
                          {
                             $cf_to_perspiration_acid_cross_staining_tolerance = $row_for_defining_process['cf_to_perspiration_acid_cross_staining_tolerance_value'];
                       
                             if($cf_to_perspiration_acid_cross_staining_tolerance ==1.0)
                             {
                                $cf_to_perspiration_acid_cross_staining_tolerance_value = '1';
                             }
                             elseif($cf_to_perspiration_acid_cross_staining_tolerance ==1.5)
                             {
                                $cf_to_perspiration_acid_cross_staining_tolerance_value = '1-2';
                             }
                             elseif($cf_to_perspiration_acid_cross_staining_tolerance ==2.0)
                             {
                                $cf_to_perspiration_acid_cross_staining_tolerance_value = '2';
                             }
                             elseif($cf_to_perspiration_acid_cross_staining_tolerance ==2.5)
                             {
                                $cf_to_perspiration_acid_cross_staining_tolerance_value = '2-3';
                             }
                             elseif($cf_to_perspiration_acid_cross_staining_tolerance ==3.0)
                             {
                                $cf_to_perspiration_acid_cross_staining_tolerance_value = '3';
                             }
                             elseif($cf_to_perspiration_acid_cross_staining_tolerance ==3.5)
                             {
                                $cf_to_perspiration_acid_cross_staining_tolerance_value = '3-4';
                             }
                             elseif($cf_to_perspiration_acid_cross_staining_tolerance ==4.0)
                             {
                                $cf_to_perspiration_acid_cross_staining_tolerance_value = '4';
                             }
                             elseif($cf_to_perspiration_acid_cross_staining_tolerance ==4.5)
                             {
                                $cf_to_perspiration_acid_cross_staining_tolerance_value = '4-5';
                             }
                             elseif($cf_to_perspiration_acid_cross_staining_tolerance ==5.0)
                             {
                                $cf_to_perspiration_acid_cross_staining_tolerance_value = '5';
                             }							   // for defining
  
                          $cf_to_perspiration_acid_cross_staining = $row_for_qc['cf_to_perspiration_acid_cross_staining_value'];
                       
                             if($cf_to_perspiration_acid_cross_staining ==1.0)
                             {
                                $cf_to_perspiration_acid_cross_staining_value = '1';
                             }
                             elseif($cf_to_perspiration_acid_cross_staining ==1.5)
                             {
                                $cf_to_perspiration_acid_cross_staining_value = '1-2';
                             }
                             elseif($cf_to_perspiration_acid_cross_staining ==2.0)
                             {
                                $cf_to_perspiration_acid_cross_staining_value = '2';
                             }
                             elseif($cf_to_perspiration_acid_cross_staining ==2.5)
                             {
                                $cf_to_perspiration_acid_cross_staining_value = '2-3';
                             }
                             elseif($cf_to_perspiration_acid_cross_staining ==3.0)
                             {
                                $cf_to_perspiration_acid_cross_staining_value = '3';
                             }
                             elseif($cf_to_perspiration_acid_cross_staining ==3.5)
                             {
                                $cf_to_perspiration_acid_cross_staining_value = '3-4';
                             }
                             elseif($cf_to_perspiration_acid_cross_staining ==4.0)
                             {
                                $cf_to_perspiration_acid_cross_staining_value = '4';
                             }
                             elseif($cf_to_perspiration_acid_cross_staining ==4.5)
                             {
                                $cf_to_perspiration_acid_cross_staining_value = '4-5';
                             }
                             elseif($cf_to_perspiration_acid_cross_staining ==5.0)
                             {
                                $cf_to_perspiration_acid_cross_staining_value = '5';
                             } 				// for test result
  
                       }
  

		                     if($row_for_defining_process['cf_to_perspiration_acid_cross_staining_min_value']<=$row_for_qc['cf_to_perspiration_acid_cross_staining_value'] && $row_for_defining_process['cf_to_perspiration_acid_cross_staining_max_value']>=$row_for_qc['cf_to_perspiration_acid_cross_staining_value'])
		                     {
		                        $p++;
                                $pdf->Cell(124,5,$row['test_name_method'].' (Cross Staining)',"1", "0","L");
                                $pdf->Cell(21,5,$cf_to_perspiration_acid_cross_staining_value.' ' .$row_for_defining_process['uom_of_cf_to_perspiration_acid_cross_staining'], "1", "0","L");
                                $pdf->Cell(30,5,$cf_to_perspiration_acid_cross_staining_tolerance_range_math_op.' '.$cf_to_perspiration_acid_cross_staining_tolerance_value.' '.$row_for_defining_process['uom_of_cf_to_perspiration_acid_cross_staining'], "1", "0","L");
                                $pdf->Cell(15,5,"Pass", "1", "0","C");
                                $pdf->SetTextColor(0,0,0);
                                $pdf->Ln();
		                     }
		                     else {
		                        $f++;
                                $pdf->Cell(124,5,$row['test_name_method'].' (Cross Staining)',"1", "0","L");
                                $pdf->Cell(21,5,$cf_to_perspiration_acid_cross_staining_value.' ' .$row_for_defining_process['uom_of_cf_to_perspiration_acid_cross_staining'], "1", "0","L");
                                $pdf->Cell(30,5,$cf_to_perspiration_acid_cross_staining_tolerance_range_math_op.' '.$cf_to_perspiration_acid_cross_staining_tolerance_value.' '.$row_for_defining_process['uom_of_cf_to_perspiration_acid_cross_staining'], "1", "0","L");
                                $pdf->SetTextColor(194,8,8);

                                $pdf->Cell(15,5,"Fail", "1", "0","C");
                                $pdf->SetTextColor(0,0,0);
                                $pdf->Ln();
		                        
		                     }

		                          
		                  }    /*End of if($row_for_defining_process['cf_to_perspiration_acid_cross_staining_max_value']<>0)*/                   


                     }  /*End of f (in_array($row['id'], ['17','61']))*/


					 
					if (in_array($row['id'], ['18']))
					 {
					 	  
						if($row_for_defining_process['cf_to_perspiration_alkali_color_change_max_value']<>0 && $row_for_qc['cf_to_perspiration_alkali_color_change_value']<>0)
                        {

                           $total_test++;

                           if($row_for_defining_process['cf_to_perspiration_alkali_color_change_tolerance_range_math_op'] == '≥')
                           {
                              $cf_to_perspiration_alkali_color_change_tolerance_range_math_op = $pdf->Image('../img/greater_equal.png',156, $pdf->GetY()+1.5, 1.7).'   ';
                           }
                           else if($row_for_defining_process['cf_to_perspiration_alkali_color_change_tolerance_range_math_op'] == '≤')
                           {
                              $cf_to_perspiration_alkali_color_change_tolerance_range_math_op = $pdf->Image('../img/less_equal.png',156, $pdf->GetY()+1.5, 1.7).'   ';
                           }
                           else if($row_for_defining_process['cf_to_perspiration_alkali_color_change_tolerance_range_math_op'] == '>')
                           {
                              $cf_to_perspiration_alkali_color_change_tolerance_range_math_op = '>';
                           }
                           else if($row_for_defining_process['cf_to_perspiration_alkali_color_change_tolerance_range_math_op'] == '<')
                           {
                              $cf_to_perspiration_alkali_color_change_tolerance_range_math_op = '<';
                           }

                           
                           if($customer_type == 'american')
                           {
                              $cf_to_perspiration_alkali_color_change_tolerance_value = $row_for_defining_process['cf_to_perspiration_alkali_color_change_tolerance_value'];
                              $cf_to_perspiration_alkali_color_change_value = $row_for_qc['cf_to_perspiration_alkali_color_change_value'];
      
                           }
                        if($customer_type == 'european')
                           {
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
                           }		   // for defining
      
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
                              } 				// for test result
      
                        }


                           if($row_for_defining_process['cf_to_perspiration_alkali_color_change_min_value']<=$row_for_qc['cf_to_perspiration_alkali_color_change_value'] && $row_for_defining_process['cf_to_perspiration_alkali_color_change_max_value']>=$row_for_qc['cf_to_perspiration_alkali_color_change_value'])
                           {
                              $p++;
                              $pdf->Cell(124,5,$row['test_name_method'].' (Color Change)',"1", "0","L");
                              $pdf->Cell(21,5,$cf_to_perspiration_alkali_color_change_value.' ' .$row_for_defining_process['uom_of_cf_to_perspiration_alkali_color_change'], "1", "0","L");
                              $pdf->Cell(30,5,$cf_to_perspiration_alkali_color_change_tolerance_range_math_op.' '.$cf_to_perspiration_alkali_color_change_tolerance_value.' '.$row_for_defining_process['uom_of_cf_to_perspiration_alkali_color_change'], "1", "0","L");
                              $pdf->Cell(15,5,"Pass", "1", "0","C");
                              $pdf->SetTextColor(0,0,0);
                              $pdf->Ln();
                           }
                           else {
                              $f++;
                              $pdf->Cell(124,5,$row['test_name_method'].' (Color Change)',"1", "0","L");
                              $pdf->Cell(21,5,$cf_to_perspiration_alkali_color_change_value.' ' .$row_for_defining_process['uom_of_cf_to_perspiration_alkali_color_change'], "1", "0","L");
                              $pdf->Cell(30,5,$cf_to_perspiration_alkali_color_change_tolerance_range_math_op.' '.$cf_to_perspiration_alkali_color_change_tolerance_value.' '.$row_for_defining_process['uom_of_cf_to_perspiration_alkali_color_change'], "1", "0","L");
                              $pdf->SetTextColor(194,8,8);

                              $pdf->Cell(15,5,"Fail", "1", "0","C");
                              $pdf->SetTextColor(0,0,0);
                              $pdf->Ln();
                               
                           }

                                
                        }    /*End of if($row_for_defining_process['cf_to_perspiration_alkali_color_change_max_value']<>0)*/

                           if($row_for_defining_process['cf_to_perspiration_alkali_staining_max_value']<>0 && $row_for_qc['cf_to_perspiration_alkali_staining_value']<>0)
                        {

                           $total_test++;

                           if($row_for_defining_process['cf_to_perspiration_alkali_staining_tolerance_range_math_op'] == '≥')
                           {
                              $cf_to_perspiration_alkali_staining_tolerance_range_math_op = $pdf->Image('../img/greater_equal.png',156, $pdf->GetY()+1.5, 1.7).'   ';
                           }
                           else if($row_for_defining_process['cf_to_perspiration_alkali_staining_tolerance_range_math_op'] == '≤')
                           {
                              $cf_to_perspiration_alkali_staining_tolerance_range_math_op = $pdf->Image('../img/less_equal.png',156, $pdf->GetY()+1.5, 1.7).'   ';
                           }
                           else if($row_for_defining_process['cf_to_perspiration_alkali_staining_tolerance_range_math_op'] == '>')
                           {
                              $cf_to_perspiration_alkali_staining_tolerance_range_math_op = '>';
                           }
                           else if($row_for_defining_process['cf_to_perspiration_alkali_staining_tolerance_range_math_op'] == '<')
                           {
                              $cf_to_perspiration_alkali_staining_tolerance_range_math_op = '<';
                           }


                           if($customer_type == 'american')
                           {
                              $cf_to_perspiration_alkali_staining_tolerance_value = $row_for_defining_process['cf_to_perspiration_alkali_staining_tolerance_value'];
                              $cf_to_perspiration_alkali_staining_value = $row_for_qc['cf_to_perspiration_alkali_staining_value'];
      
                           }
                        if($customer_type == 'european')
                           {
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
                           }		   // for defining
      
                           $cf_to_perspiration_alkali_staining = $row_for_qc['cf_to_perspiration_alkali_staining_value'];
                        
                              if($cf_to_perspiration_alkali_staining ==1.0)
                              {
                                 $cf_to_perspiration_alkali_staining_value = '1';
                              }
                              elseif($cf_to_perspiration_alkali_staining ==1.5)
                              {
                                 $cf_to_perspiration_alkali_staining_value = '1-2';
                              }
                              elseif($cf_to_perspiration_alkali_staining ==2.0)
                              {
                                 $cf_to_perspiration_alkali_staining_value = '2';
                              }
                              elseif($cf_to_perspiration_alkali_staining ==2.5)
                              {
                                 $cf_to_perspiration_alkali_staining_value = '2-3';
                              }
                              elseif($cf_to_perspiration_alkali_staining ==3.0)
                              {
                                 $cf_to_perspiration_alkali_staining_value = '3';
                              }
                              elseif($cf_to_perspiration_alkali_staining ==3.5)
                              {
                                 $cf_to_perspiration_alkali_staining_value = '3-4';
                              }
                              elseif($cf_to_perspiration_alkali_staining ==4.0)
                              {
                                 $cf_to_perspiration_alkali_staining_value = '4';
                              }
                              elseif($cf_to_perspiration_alkali_staining ==4.5)
                              {
                                 $cf_to_perspiration_alkali_staining_value = '4-5';
                              }
                              elseif($cf_to_perspiration_alkali_staining ==5.0)
                              {
                                 $cf_to_perspiration_alkali_staining_value = '5';
                              } 				// for test result
      
                        }


                           if($row_for_defining_process['cf_to_perspiration_alkali_staining_min_value']<=$row_for_qc['cf_to_perspiration_alkali_staining_value'] && $row_for_defining_process['cf_to_perspiration_alkali_staining_max_value']>=$row_for_qc['cf_to_perspiration_alkali_staining_value'])
                           {
                              $p++;
                              $pdf->Cell(124,5,$row['test_name_method'].' (Staining)',"1", "0","L");
                              $pdf->Cell(21,5,$cf_to_perspiration_alkali_staining_value.' ' .$row_for_defining_process['uom_of_cf_to_perspiration_alkali_staining'], "1", "0","L");
                              $pdf->Cell(30,5,$cf_to_perspiration_alkali_staining_tolerance_range_math_op.' '.$cf_to_perspiration_alkali_staining_tolerance_value.' '.$row_for_defining_process['uom_of_cf_to_perspiration_alkali_staining'], "1", "0","L");
                              $pdf->Cell(15,5,"Pass", "1", "0","C");
                              $pdf->SetTextColor(0,0,0);
                              $pdf->Ln();
                           }
                           else {
                              $f++;
                              $pdf->Cell(124,5,$row['test_name_method'].' (Staining)',"1", "0","L");
                              $pdf->Cell(21,5,$cf_to_perspiration_alkali_staining_value.' ' .$row_for_defining_process['uom_of_cf_to_perspiration_alkali_staining'], "1", "0","L");
                              $pdf->Cell(30,5,$cf_to_perspiration_alkali_staining_tolerance_range_math_op.' '.$cf_to_perspiration_alkali_staining_tolerance_value.' '.$row_for_defining_process['uom_of_cf_to_perspiration_alkali_staining'], "1", "0","L");
                              $pdf->SetTextColor(194,8,8);

                              $pdf->Cell(15,5,"Fail", "1", "0","C");
                              $pdf->SetTextColor(0,0,0);
                              $pdf->Ln();
                             
                           }

                                 
                        } 

                        if($row_for_defining_process['cf_to_perspiration_alkali_cross_staining_max_value']<>0 && $row_for_qc['cf_to_perspiration_alkali_cross_staining_value']<>0)
                        {

                           $total_test++;

                           if($row_for_defining_process['cf_to_perspiration_alkali_cross_staining_tolerance_range_math_op'] == '≥')
                           {
                              $cf_to_perspiration_alkali_cross_staining_tolerance_range_math_op = $pdf->Image('../img/greater_equal.png',156, $pdf->GetY()+1.5, 1.7).'   ';
                           }
                           else if($row_for_defining_process['cf_to_perspiration_alkali_cross_staining_tolerance_range_math_op'] == '≤')
                           {
                              $cf_to_perspiration_alkali_cross_staining_tolerance_range_math_op = $pdf->Image('../img/less_equal.png',156, $pdf->GetY()+1.5, 1.7).'   ';
                           }
                           else if($row_for_defining_process['cf_to_perspiration_alkali_cross_staining_tolerance_range_math_op'] == '>')
                           {
                              $cf_to_perspiration_alkali_cross_staining_tolerance_range_math_op = '>';
                           }
                           else if($row_for_defining_process['cf_to_perspiration_alkali_cross_staining_tolerance_range_math_op'] == '<')
                           {
                              $cf_to_perspiration_alkali_cross_staining_tolerance_range_math_op = '<';
                           }

                           if($customer_type == 'american')
						   {
							   $cf_to_perspiration_alkali_cross_staining_tolerance_value = $row_for_defining_process['cf_to_perspiration_alkali_cross_staining_tolerance_value'];
							   $cf_to_perspiration_alkali_cross_staining_value = $row_for_qc['cf_to_perspiration_alkali_cross_staining_value'];

						   }
					   if($customer_type == 'european')
						   {
							$cf_to_perspiration_alkali_cross_staining_tolerance = $row_for_defining_process['cf_to_perspiration_alkali_cross_staining_tolerance_value'];
							
							if($cf_to_perspiration_alkali_cross_staining_tolerance ==1.0)
							{
								$cf_to_perspiration_alkali_cross_staining_tolerance_value = '1';
							}
							elseif($cf_to_perspiration_alkali_cross_staining_tolerance ==1.5)
							{
								$cf_to_perspiration_alkali_cross_staining_tolerance_value = '1-2';
							}
							elseif($cf_to_perspiration_alkali_cross_staining_tolerance ==2.0)
							{
								$cf_to_perspiration_alkali_cross_staining_tolerance_value = '2';
							}
							elseif($cf_to_perspiration_alkali_cross_staining_tolerance ==2.5)
							{
								$cf_to_perspiration_alkali_cross_staining_tolerance_value = '2-3';
							}
							elseif($cf_to_perspiration_alkali_cross_staining_tolerance ==3.0)
							{
								$cf_to_perspiration_alkali_cross_staining_tolerance_value = '3';
							}
							elseif($cf_to_perspiration_alkali_cross_staining_tolerance ==3.5)
							{
								$cf_to_perspiration_alkali_cross_staining_tolerance_value = '3-4';
							}
							elseif($cf_to_perspiration_alkali_cross_staining_tolerance ==4.0)
							{
								$cf_to_perspiration_alkali_cross_staining_tolerance_value = '4';
							}
							elseif($cf_to_perspiration_alkali_cross_staining_tolerance ==4.5)
							{
								$cf_to_perspiration_alkali_cross_staining_tolerance_value = '4-5';
							}
							elseif($cf_to_perspiration_alkali_cross_staining_tolerance ==5.0)
							{
								$cf_to_perspiration_alkali_cross_staining_tolerance_value = '5';
							}												// for defining

						   $cf_to_perspiration_alkali_cross_staining = $row_for_qc['cf_to_perspiration_alkali_cross_staining_value'];
					   
							   if($cf_to_perspiration_alkali_cross_staining ==1.0)
							   {
								   $cf_to_perspiration_alkali_cross_staining_value = '1';
							   }
							   elseif($cf_to_perspiration_alkali_cross_staining ==1.5)
							   {
								   $cf_to_perspiration_alkali_cross_staining_value = '1-2';
							   }
							   elseif($cf_to_perspiration_alkali_cross_staining ==2.0)
							   {
								   $cf_to_perspiration_alkali_cross_staining_value = '2';
							   }
							   elseif($cf_to_perspiration_alkali_cross_staining ==2.5)
							   {
								   $cf_to_perspiration_alkali_cross_staining_value = '2-3';
							   }
							   elseif($cf_to_perspiration_alkali_cross_staining ==3.0)
							   {
								   $cf_to_perspiration_alkali_cross_staining_value = '3';
							   }
							   elseif($cf_to_perspiration_alkali_cross_staining ==3.5)
							   {
								   $cf_to_perspiration_alkali_cross_staining_value = '3-4';
							   }
							   elseif($cf_to_perspiration_alkali_cross_staining ==4.0)
							   {
								   $cf_to_perspiration_alkali_cross_staining_value = '4';
							   }
							   elseif($cf_to_perspiration_alkali_cross_staining ==4.5)
							   {
								   $cf_to_perspiration_alkali_cross_staining_value = '4-5';
							   }
							   elseif($cf_to_perspiration_alkali_cross_staining ==5.0)
							   {
								   $cf_to_perspiration_alkali_cross_staining_value = '5';
							   } 				// for test result

					   }

                           
                           if($row_for_defining_process['cf_to_perspiration_alkali_cross_staining_min_value']<=$row_for_qc['cf_to_perspiration_alkali_cross_staining_value'] && $row_for_defining_process['cf_to_perspiration_alkali_cross_staining_max_value']>=$row_for_qc['cf_to_perspiration_alkali_cross_staining_value'])
                           {
                              $p++;
                              $pdf->Cell(124,5,$row['test_name_method'].' (Cross Staining)',"1", "0","L");
                              $pdf->Cell(21,5,$cf_to_perspiration_alkali_cross_staining_value.' ' .$row_for_defining_process['uom_of_cf_to_perspiration_alkali_cross_staining'], "1", "0","L");
                              $pdf->Cell(30,5,$cf_to_perspiration_alkali_cross_staining_tolerance_range_math_op.' '.$cf_to_perspiration_alkali_cross_staining_tolerance_value.' '.$row_for_defining_process['uom_of_cf_to_perspiration_alkali_cross_staining'], "1", "0","L");
                              $pdf->Cell(15,5,"Pass", "1", "0","C");
                              $pdf->SetTextColor(0,0,0);
                              $pdf->Ln();
                           }
                           else {
                              $f++;
                              $pdf->Cell(124,5,$row['test_name_method'].' (Cross Staining)',"1", "0","L");
                              $pdf->Cell(21,5,$cf_to_perspiration_alkali_cross_staining_value.' ' .$row_for_defining_process['uom_of_cf_to_perspiration_alkali_cross_staining'], "1", "0","L");
                              $pdf->Cell(30,5,$cf_to_perspiration_alkali_cross_staining_tolerance_range_math_op.' '.$cf_to_perspiration_alkali_cross_staining_tolerance_value.' '.$row_for_defining_process['uom_of_cf_to_perspiration_alkali_cross_staining'], "1", "0","L");
                              
                              $pdf->SetTextColor(194,8,8);
                              $pdf->Cell(15,5,"Fail", "1", "0","C");
                              $pdf->SetTextColor(0,0,0);
                              $pdf->Ln();
                              
                           }

                                
                        }   


					 }  /*End of if (in_array($row['id'], ['18', '120', '62', '18', '129', '194', '269']))*/




					 if (in_array($row['id'], ['19']))
					 { 
					 	 
						 if($row_for_defining_process['cf_to_water_color_change_max_value']<>0 && $row_for_qc['cf_to_water_color_change_value']<>0)
                        {

                           $total_test++;

                           if($row_for_defining_process['cf_to_water_color_change_tolerance_range_math_operator'] == '≥')
                           {
                              $cf_to_water_color_change_tolerance_range_math_operator = $pdf->Image('../img/greater_equal.png',156, $pdf->GetY()+1.5, 1.7).'   ';
                           }
                           else if($row_for_defining_process['cf_to_water_color_change_tolerance_range_math_operator'] == '≤')
                           {
                              $cf_to_water_color_change_tolerance_range_math_operator = $pdf->Image('../img/less_equal.png',156, $pdf->GetY()+1.5, 1.7).'   ';
                           }
                           else if($row_for_defining_process['cf_to_water_color_change_tolerance_range_math_operator'] == '>')
                           {
                              $cf_to_water_color_change_tolerance_range_math_operator = '>';
                           }
                           else if($row_for_defining_process['cf_to_water_color_change_tolerance_range_math_operator'] == '<')
                           {
                              $cf_to_water_color_change_tolerance_range_math_operator = '<';
                           }

                           if($customer_type == 'american')
						   {
							   $cf_to_water_color_change_tolerance_value = $row_for_defining_process['cf_to_water_color_change_tolerance_value'];
							   $cf_to_water_color_change_value = $row_for_qc['cf_to_water_color_change_value'];

						   }
					   		if($customer_type == 'european')
						   {
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
							}						// for defining

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
							   } 				// for test result

					   }

                           if($row_for_defining_process['cf_to_water_color_change_min_value']<=$row_for_qc['cf_to_water_color_change_value'] && $row_for_defining_process['cf_to_water_color_change_max_value']>=$row_for_qc['cf_to_water_color_change_value'])
                           {
                              $p++;
                              $pdf->Cell(124,5,$row['test_name_method'].' (Color Change)',"1", "0","L");
                              $pdf->Cell(21,5,$cf_to_water_color_change_value.' ' .$row_for_defining_process['uom_of_cf_to_water_color_change'], "1", "0","L");
                              $pdf->Cell(30,5,$cf_to_water_color_change_tolerance_range_math_operator.' '.$cf_to_water_color_change_tolerance_value.' '.$row_for_defining_process['uom_of_cf_to_water_color_change'], "1", "0","L");
                              $pdf->Cell(15,5,"Pass", "1", "0","C");
                              $pdf->SetTextColor(0,0,0);
                              $pdf->Ln();
                           }
                           else {
                              $f++;
                              $pdf->Cell(124,5,$row['test_name_method'].' (Color Change)',"1", "0","L");
                              $pdf->Cell(21,5,$cf_to_water_color_change_value.' ' .$row_for_defining_process['uom_of_cf_to_water_color_change'], "1", "0","L");
                              $pdf->Cell(30,5,$cf_to_water_color_change_tolerance_range_math_operator.' '.$cf_to_water_color_change_tolerance_value.' '.$row_for_defining_process['uom_of_cf_to_water_color_change'], "1", "0","L");
                              $pdf->SetTextColor(194,8,8);

                              $pdf->Cell(15,5,"Fail", "1", "0","C");
                              $pdf->SetTextColor(0,0,0);
                              $pdf->Ln();
							  
                           }

                        }    /*End of if($row_for_defining_process['cf_to_water_color_change_max_value']<>0)*/


                         if($row_for_defining_process['cf_to_water_staining_max_value']<>0 && $row_for_qc['cf_to_water_staining_value']<>0)
                        {

                           $total_test++;

                           if($row_for_defining_process['cf_to_water_staining_tolerance_range_math_operator'] == '≥')
                           {
                              $cf_to_water_staining_tolerance_range_math_operator = $pdf->Image('../img/greater_equal.png',156, $pdf->GetY()+1.5, 1.7).'   ';
                           }
                           else if($row_for_defining_process['cf_to_water_staining_tolerance_range_math_operator'] == '≤')
                           {
                              $cf_to_water_staining_tolerance_range_math_operator = $pdf->Image('../img/less_equal.png',156, $pdf->GetY()+1.5, 1.7).'   ';
                           }
                           else if($row_for_defining_process['cf_to_water_staining_tolerance_range_math_operator'] == '>')
                           {
                              $cf_to_water_staining_tolerance_range_math_operator = '>';
                           }
                           else if($row_for_defining_process['cf_to_water_staining_tolerance_range_math_operator'] == '<')
                           {
                              $cf_to_water_staining_tolerance_range_math_operator = '<';
                           }


                           if($customer_type == 'american')
                           {
                              $cf_to_water_staining_tolerance_value = $row_for_defining_process['cf_to_water_staining_tolerance_value'];
                              $cf_to_water_staining_value = $row_for_qc['cf_to_water_staining_value'];
      
                           }
                              if($customer_type == 'european')
                           {
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
                           }		// for defining
      
                           $cf_to_water_staining = $row_for_qc['cf_to_water_staining_value'];
                        
                              if($cf_to_water_staining ==1.0)
                              {
                                 $cf_to_water_staining_value = '1';
                              }
                              elseif($cf_to_water_staining ==1.5)
                              {
                                 $cf_to_water_staining_value = '1-2';
                              }
                              elseif($cf_to_water_staining ==2.0)
                              {
                                 $cf_to_water_staining_value = '2';
                              }
                              elseif($cf_to_water_staining ==2.5)
                              {
                                 $cf_to_water_staining_value = '2-3';
                              }
                              elseif($cf_to_water_staining ==3.0)
                              {
                                 $cf_to_water_staining_value = '3';
                              }
                              elseif($cf_to_water_staining ==3.5)
                              {
                                 $cf_to_water_staining_value = '3-4';
                              }
                              elseif($cf_to_water_staining ==4.0)
                              {
                                 $cf_to_water_staining_value = '4';
                              }
                              elseif($cf_to_water_staining ==4.5)
                              {
                                 $cf_to_water_staining_value = '4-5';
                              }
                              elseif($cf_to_water_staining ==5.0)
                              {
                                 $cf_to_water_staining_value = '5';
                              } 				// for test result
      
                        }

                           

                           if($row_for_defining_process['cf_to_water_staining_min_value']<=$row_for_qc['cf_to_water_staining_value'] && $row_for_defining_process['cf_to_water_staining_max_value']>=$row_for_qc['cf_to_water_staining_value'])
                           {
                              $p++;
							  $pdf->Cell(124,5,$row['test_name_method'].' (Staining)',"1", "0","L");
                              $pdf->Cell(21,5,$cf_to_water_staining_value.' ' .$row_for_defining_process['uom_of_cf_to_water_staining'], "1", "0","L");
                              $pdf->Cell(30,5,$cf_to_water_staining_tolerance_range_math_operator.' '.$cf_to_water_staining_tolerance_value.' '.$row_for_defining_process['uom_of_cf_to_water_staining'], "1", "0","L");
                              $pdf->Cell(15,5,"Pass", "1", "0","C");
                              $pdf->SetTextColor(0,0,0);
                              $pdf->Ln();
                           }
                           else {
                              $f++;
                              $pdf->Cell(124,5,$row['test_name_method'].' (Staining)',"1", "0","L");
                              $pdf->Cell(21,5,$cf_to_water_staining_value.' ' .$row_for_defining_process['uom_of_cf_to_water_staining'], "1", "0","L");
                              $pdf->Cell(30,5,$cf_to_water_staining_tolerance_range_math_operator.' '.$cf_to_water_staining_tolerance_value.' '.$row_for_defining_process['uom_of_cf_to_water_staining'], "1", "0","L");
                              $pdf->SetTextColor(194,8,8);

                              $pdf->Cell(15,5,"Fail", "1", "0","C");
                              $pdf->SetTextColor(0,0,0);
                              $pdf->Ln();
							  
                           }

                               
                        }    /*End of if($row_for_defining_process['cf_to_water_staining_max_value']<>0)*/


                        if($row_for_defining_process['cf_to_water_cross_staining_max_value']<>0 && $row_for_qc['cf_to_water_cross_staining_value']<>0)
                        {

                           $total_test++;

                           if($row_for_defining_process['cf_to_water_cross_staining_tolerance_range_math_operator'] == '≥')
                           {
                              $cf_to_water_cross_staining_tolerance_range_math_operator = $pdf->Image('../img/greater_equal.png',156, $pdf->GetY()+1.5, 1.7).'   ';
                           }
                           else if($row_for_defining_process['cf_to_water_cross_staining_tolerance_range_math_operator'] == '≤')
                           {
                              $cf_to_water_cross_staining_tolerance_range_math_operator = $pdf->Image('../img/less_equal.png',156, $pdf->GetY()+1.5, 1.7).'   ';
                           }
                           else if($row_for_defining_process['cf_to_water_cross_staining_tolerance_range_math_operator'] == '>')
                           {
                              $cf_to_water_cross_staining_tolerance_range_math_operator = '>';
                           }
                           else if($row_for_defining_process['cf_to_water_cross_staining_tolerance_range_math_operator'] == '<')
                           {
                              $cf_to_water_cross_staining_tolerance_range_math_operator = '<';
                           }


                           if($customer_type == 'american')
                           {
                              $cf_to_water_cross_staining_tolerance_value = $row_for_defining_process['cf_to_water_cross_staining_tolerance_value'];
                              $cf_to_water_cross_staining_value = $row_for_qc['cf_to_water_cross_staining_value'];
      
                           }
                              if($customer_type == 'european')
                           {
                           $cf_to_water_cross_staining_tolerance = $row_for_defining_process['cf_to_water_cross_staining_tolerance_value'];
                           
                           if($cf_to_water_cross_staining_tolerance ==1.0)
                           {
                              $cf_to_water_cross_staining_tolerance_value = '1';
                           }
                           elseif($cf_to_water_cross_staining_tolerance ==1.5)
                           {
                              $cf_to_water_cross_staining_tolerance_value = '1-2';
                           }
                           elseif($cf_to_water_cross_staining_tolerance ==2.0)
                           {
                              $cf_to_water_cross_staining_tolerance_value = '2';
                           }
                           elseif($cf_to_water_cross_staining_tolerance ==2.5)
                           {
                              $cf_to_water_cross_staining_tolerance_value = '2-3';
                           }
                           elseif($cf_to_water_cross_staining_tolerance ==3.0)
                           {
                              $cf_to_water_cross_staining_tolerance_value = '3';
                           }
                           elseif($cf_to_water_cross_staining_tolerance ==3.5)
                           {
                              $cf_to_water_cross_staining_tolerance_value = '3-4';
                           }
                           elseif($cf_to_water_cross_staining_tolerance ==4.0)
                           {
                              $cf_to_water_cross_staining_tolerance_value = '4';
                           }
                           elseif($cf_to_water_cross_staining_tolerance ==4.5)
                           {
                              $cf_to_water_cross_staining_tolerance_value = '4-5';
                           }
                           elseif($cf_to_water_cross_staining_tolerance ==5.0)
                           {
                              $cf_to_water_cross_staining_tolerance_value = '5';
                           }									// for defining
      
                           $cf_to_water_cross_staining = $row_for_qc['cf_to_water_cross_staining_value'];
                        
                              if($cf_to_water_cross_staining ==1.0)
                              {
                                 $cf_to_water_cross_staining_value = '1';
                              }
                              elseif($cf_to_water_cross_staining ==1.5)
                              {
                                 $cf_to_water_cross_staining_value = '1-2';
                              }
                              elseif($cf_to_water_cross_staining ==2.0)
                              {
                                 $cf_to_water_cross_staining_value = '2';
                              }
                              elseif($cf_to_water_cross_staining ==2.5)
                              {
                                 $cf_to_water_cross_staining_value = '2-3';
                              }
                              elseif($cf_to_water_cross_staining ==3.0)
                              {
                                 $cf_to_water_cross_staining_value = '3';
                              }
                              elseif($cf_to_water_cross_staining ==3.5)
                              {
                                 $cf_to_water_cross_staining_value = '3-4';
                              }
                              elseif($cf_to_water_cross_staining ==4.0)
                              {
                                 $cf_to_water_cross_staining_value = '4';
                              }
                              elseif($cf_to_water_cross_staining ==4.5)
                              {
                                 $cf_to_water_cross_staining_value = '4-5';
                              }
                              elseif($cf_to_water_cross_staining ==5.0)
                              {
                                 $cf_to_water_cross_staining_value = '5';
                              } 				// for test result
      
                        }


                           if($row_for_defining_process['cf_to_water_cross_staining_min_value']<=$row_for_qc['cf_to_water_cross_staining_value'] && $row_for_defining_process['cf_to_water_cross_staining_max_value']>=$row_for_qc['cf_to_water_cross_staining_value'])
                           {
                              $p++;
                              $pdf->Cell(124,5,$row['test_name_method'].' (Cross Staining)',"1", "0","L");
                              $pdf->Cell(21,5,$cf_to_water_cross_staining_value.' ' .$row_for_defining_process['uom_of_cf_to_water_cross_staining'], "1", "0","L");
                              $pdf->Cell(30,5,$cf_to_water_cross_staining_tolerance_range_math_operator.' '.$cf_to_water_cross_staining_tolerance_value.' '.$row_for_defining_process['uom_of_cf_to_water_cross_staining'], "1", "0","L");
                              $pdf->Cell(15,5,"Pass", "1", "0","C");
                              $pdf->SetTextColor(0,0,0);
                              $pdf->Ln();
							  
                           }
                           else {
                              $f++;
                              $pdf->Cell(124,5,$row['test_name_method'].' (Cross Staining)',"1", "0","L");
                              $pdf->Cell(21,5,$cf_to_water_cross_staining_value.' ' .$row_for_defining_process['uom_of_cf_to_water_cross_staining'], "1", "0","L");
                              $pdf->Cell(30,5,$cf_to_water_cross_staining_tolerance_range_math_operator.' '.$cf_to_water_cross_staining_tolerance_value.' '.$row_for_defining_process['uom_of_cf_to_water_cross_staining'], "1", "0","L");
                              $pdf->SetTextColor(194,8,8);

                              $pdf->Cell(15,5,"Fail", "1", "0","C");
                              $pdf->SetTextColor(0,0,0);
                              $pdf->Ln();
							  
                           }

                             
                        }    /*End of if($row_for_defining_process['cf_to_water_cross_staining_max_value']<>0)*/

                    } /*End of  if (in_array($row['id'], ['19', '121', '141', '167', '228']))*/


                    if (in_array($row['id'], ['20', '65']))
					 {

                        if($row_for_defining_process['cf_to_water_spotting_surface_max_value']<>0 && $row_for_qc['cf_to_water_spotting_surface_value']<>0)
                        {

                           $total_test++;


                           if($customer_type == 'american')
						   {
							   $cf_to_water_spotting_surface_tolerance_value = $row_for_defining_process['cf_to_water_spotting_surface_tolerance_value'];
							   $cf_to_water_spotting_surface_value = $row_for_qc['cf_to_water_spotting_surface_value'];

						   }
					   		if($customer_type == 'european')
						   {
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

					   }
      

                           

                           if($row_for_defining_process['cf_to_water_spotting_surface_min_value']<=$row_for_qc['cf_to_water_spotting_surface_value'] && $row_for_defining_process['cf_to_water_spotting_surface_max_value']>=$row_for_qc['cf_to_water_spotting_surface_value'])
                           {
                              $p++;
                              $pdf->Cell(124,5,$row['test_name_method'].' (Surface)',"1", "0","L");
                              $pdf->Cell(21,5,$cf_to_water_spotting_surface_value.' ' .$row_for_defining_process['uom_of_cf_to_water_spotting_surface'], "1", "0","L");
                              $pdf->Cell(30,5,$cf_to_water_spotting_surface_tolerance_range_math_op.' '.$cf_to_water_spotting_surface_tolerance_value.' '.$row_for_defining_process['uom_of_cf_to_water_spotting_surface'], "1", "0","L");
                              $pdf->Cell(15,5,"Pass", "1", "0","C");
                              $pdf->SetTextColor(0,0,0);
                              $pdf->Ln();
                           }
                           else {
                              $f++;
                              $pdf->Cell(124,5,$row['test_name_method'].' (Surface)',"1", "0","L");
                              $pdf->Cell(21,5,$cf_to_water_spotting_surface_value.' ' .$row_for_defining_process['uom_of_cf_to_water_spotting_surface'], "1", "0","L");
                              $pdf->Cell(30,5,$cf_to_water_spotting_surface_tolerance_range_math_op.' '.$cf_to_water_spotting_surface_tolerance_value.' '.$row_for_defining_process['uom_of_cf_to_water_spotting_surface'], "1", "0","L");
                              $pdf->SetTextColor(194,8,8);

                              $pdf->Cell(15,5,"Fail", "1", "0","C");
                              $pdf->SetTextColor(0,0,0);
                              $pdf->Ln();
							  
                           }

                         
                        }    /*End of if($row_for_defining_process['cf_to_water_spotting_surface_max_value']<>0)*/

                        if($row_for_defining_process['cf_to_water_spotting_edge_max_value']<>0 && $row_for_qc['cf_to_water_spotting_edge_value']<>0)
                        {

                           $total_test++;
                           if($customer_type == 'american')
                           {
                              $cf_to_water_spotting_edge_tolerance_value = $row_for_defining_process['cf_to_water_spotting_edge_tolerance_value'];
                              $cf_to_water_spotting_edge_value = $row_for_qc['cf_to_water_spotting_edge_value'];
      
                           }
                              if($customer_type == 'european')
                           {
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
      
                        }
      

                           if($row_for_defining_process['cf_to_water_spotting_edge_min_value']<=$row_for_qc['cf_to_water_spotting_edge_value'] && $row_for_defining_process['cf_to_water_spotting_edge_max_value']>=$row_for_qc['cf_to_water_spotting_edge_value'])
                           {
                              $p++;
                              $pdf->Cell(124,5,$row['test_name_method'].' (Edge)',"1", "0","L");
                              $pdf->Cell(21,5,$cf_to_water_spotting_edge_value.' ' .$row_for_defining_process['uom_of_cf_to_water_spotting_edge'], "1", "0","L");
                              $pdf->Cell(30,5,$cf_to_water_spotting_edge_tolerance_range_math_op.' '.$cf_to_water_spotting_edge_tolerance_value.' '.$row_for_defining_process['uom_of_cf_to_water_spotting_edge'], "1", "0","L");
                              $pdf->Cell(15,5,"Pass", "1", "0","C");
                              $pdf->SetTextColor(0,0,0);
                              $pdf->Ln();
							 
                           }
                           else {
                              $f++;
                              $pdf->Cell(124,5,$row['test_name_method'].' (Edge)',"1", "0","L");
                              $pdf->Cell(21,5,$cf_to_water_spotting_edge_value.' ' .$row_for_defining_process['uom_of_cf_to_water_spotting_edge'], "1", "0","L");
                              $pdf->Cell(30,5,$cf_to_water_spotting_edge_tolerance_range_math_op.' '.$cf_to_water_spotting_edge_tolerance_value.' '.$row_for_defining_process['uom_of_cf_to_water_spotting_edge'], "1", "0","L");
                              $pdf->SetTextColor(194,8,8);

                              $pdf->Cell(15,5,"Fail", "1", "0","C");
                              $pdf->SetTextColor(0,0,0);
                              $pdf->Ln();
							 
                           }

        
                        }    /*End of if($row_for_defining_process['cf_to_water_spotting_edge_max_value']<>0)*/


                        if($row_for_defining_process['cf_to_water_spotting_cross_staining_max_value']<>0 && $row_for_qc['cf_to_water_spotting_cross_staining_value']<>0)
                        {

                           $total_test++;

                           if($customer_type == 'american')
						   {
							   $cf_to_water_spotting_cross_staining_tolerance_value = $row_for_defining_process['cf_to_water_spotting_cross_staining_tolerance_value'];
							   $cf_to_water_spotting_cross_staining_value = $row_for_qc['cf_to_water_spotting_cross_staining_value'];

						   }
					   		if($customer_type == 'european')
						   {
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

                           if($row_for_defining_process['cf_to_water_spotting_cross_staining_min_value']<=$row_for_qc['cf_to_water_spotting_cross_staining_value'] && $row_for_defining_process['cf_to_water_spotting_cross_staining_max_value']>=$row_for_qc['cf_to_water_spotting_cross_staining_value'])
                           {
                              $p++;
							         $pdf->Cell(124,5,$row['test_name_method'].' (Cross Staining)',"1", "0","L");
                              $pdf->Cell(21,5,$cf_to_water_spotting_cross_staining_value.' ' .$row_for_defining_process['uom_of_cf_to_water_spotting_cross_staining'], "1", "0","L");
                              $pdf->Cell(30,5,$cf_to_water_spotting_cross_staining_tolerance_range_math_op.' '.$cf_to_water_spotting_cross_staining_tolerance_value.' '.$row_for_defining_process['uom_of_cf_to_water_spotting_cross_staining'], "1", "0","L");
                              $pdf->Cell(15,5,"Pass", "1", "0","C");
                              $pdf->SetTextColor(0,0,0);
                              $pdf->Ln();
                           }
                           else {
                              $f++;
                              $pdf->Cell(124,5,$row['test_name_method'].' (Cross Staining)',"1", "0","L");
                              $pdf->Cell(21,5,$cf_to_water_spotting_cross_staining_value.' ' .$row_for_defining_process['uom_of_cf_to_water_spotting_cross_staining'], "1", "0","L");
                              $pdf->Cell(30,5,$cf_to_water_spotting_cross_staining_tolerance_range_math_op.' '.$cf_to_water_spotting_cross_staining_tolerance_value.' '.$row_for_defining_process['uom_of_cf_to_water_spotting_cross_staining'], "1", "0","L");
                              $pdf->SetTextColor(194,8,8);

                              $pdf->Cell(15,5,"Fail", "1", "0","C");
                              $pdf->SetTextColor(0,0,0);
                              $pdf->Ln();
							  
                           }

                              
                        }    /*End of if($row_for_defining_process['cf_to_water_spotting_cross_staining_max_value']<>0)*/

					 } /* End of if (in_array($row['id'], ['20', '65', '196']))*/
                     
                     if (in_array($row['id'], ['21','22', '66']))
					 {
						
                       if($row_for_defining_process['resistance_to_surface_wetting_before_wash_max_value']<>0 && $row_for_qc['resistance_to_surface_wetting_before_wash_value']<>0)
                        {

                           $total_test++;

                           if($customer_type == 'american')
                           {
                              $resistance_to_surface_wetting_before_wash_tolerance_value = $row_for_defining_process['resistance_to_surface_wetting_before_wash_tolerance_value'];
                              $resistance_to_surface_wetting_before_wash_value = $row_for_qc['resistance_to_surface_wetting_before_wash_value'];
      
                           }
                              if($customer_type == 'european')
                           {
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
      
                        }

                           if($row_for_defining_process['resistance_to_surface_wetting_before_wash_min_value']<=$row_for_qc['resistance_to_surface_wetting_before_wash_value'] && $row_for_defining_process['resistance_to_surface_wetting_before_wash_max_value']>=$row_for_qc['resistance_to_surface_wetting_before_wash_value'])
                           {
                              $p++;
							  $pdf->Cell(124,5,$row['test_name_method'].' (Before Wash)',"1", "0","L");
                              $pdf->Cell(21,5,$resistance_to_surface_wetting_before_wash_value.' ' .$row_for_defining_process['uom_of_resistance_to_surface_wetting_before_wash'], "1", "0","L");
                              $pdf->Cell(30,5,$row_for_defining_process['resistance_to_surface_wetting_before_wash_tol_range_math_op'].' '.$resistance_to_surface_wetting_before_wash_tolerance_value.' '.$row_for_defining_process['uom_of_resistance_to_surface_wetting_before_wash'], "1", "0","L");
                              $pdf->Cell(15,5,"Pass", "1", "0","C");
                              $pdf->SetTextColor(0,0,0);
                              $pdf->Ln();
                           }
                           else {
                              $f++;
                              $pdf->Cell(124,5,$row['test_name_method'].' (Before Wash)',"1", "0","L");
                              $pdf->Cell(21,5,$resistance_to_surface_wetting_before_wash_value.' ' .$row_for_defining_process['uom_of_resistance_to_surface_wetting_before_wash'], "1", "0","L");
                              $pdf->Cell(30,5,$row_for_defining_process['resistance_to_surface_wetting_before_wash_tol_range_math_op'].' '.$resistance_to_surface_wetting_before_wash_tolerance_value.' '.$row_for_defining_process['uom_of_resistance_to_surface_wetting_before_wash'], "1", "0","L");
                              $pdf->SetTextColor(194,8,8);

                              $pdf->Cell(15,5,"Fail", "1", "0","C");
                              $pdf->SetTextColor(0,0,0);
                              $pdf->Ln();
							 
                           }

                     
                        }    /*End of if($row_for_defining_process['resistance_to_surface_wetting_before_wash_max_value']<>0)*/

                         if($row_for_defining_process['resistance_to_surface_wetting_after_one_wash_max_value']<>0 && $row_for_qc['resistance_to_surface_wetting_after_one_wash_value']<>0)
                        {

                           $total_test++;

                           if($customer_type == 'american')
						   {
							   $resistance_to_surface_wetting_after_one_wash_tolerance_value = $row_for_defining_process['resistance_to_surface_wetting_after_one_wash_tolerance_value'];
							   $resistance_to_surface_wetting_after_one_wash_value = $row_for_qc['resistance_to_surface_wetting_after_one_wash_value'];

						   }
					   		if($customer_type == 'european')
						   {
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

					   }


                           if($row_for_defining_process['resistance_to_surface_wetting_after_one_wash_min_value']<=$row_for_qc['resistance_to_surface_wetting_after_one_wash_value'] && $row_for_defining_process['resistance_to_surface_wetting_after_one_wash_max_value']>=$row_for_qc['resistance_to_surface_wetting_after_one_wash_value'])
                           {
                              $p++;
							         $pdf->Cell(124,5,$row['test_name_method'].' (After One Wash)',"1", "0","L");
                              $pdf->Cell(21,5,$resistance_to_surface_wetting_after_one_wash_value.' ' .$row_for_defining_process['uom_of_resistance_to_surface_wetting_after_one_wash'], "1", "0","L");
                              $pdf->Cell(30,5,$row_for_defining_process['resistance_to_surface_wetting_after_one_wash_tol_range_math_op'].' '.$resistance_to_surface_wetting_after_one_wash_tolerance_value.' '.$row_for_defining_process['uom_of_resistance_to_surface_wetting_after_one_wash'], "1", "0","L");
                              $pdf->Cell(15,5,"Pass", "1", "0","C");
                              $pdf->SetTextColor(0,0,0);
                              $pdf->Ln();
                           }
                           else {
                              $f++;
                              $pdf->Cell(124,5,$row['test_name_method'].' (After One Wash)',"1", "0","L");
                              $pdf->Cell(21,5,$resistance_to_surface_wetting_after_one_wash_value.' ' .$row_for_defining_process['uom_of_resistance_to_surface_wetting_after_one_wash'], "1", "0","L");
                              $pdf->Cell(30,5,$row_for_defining_process['resistance_to_surface_wetting_after_one_wash_tol_range_math_op'].' '.$resistance_to_surface_wetting_after_one_wash_tolerance_value.' '.$row_for_defining_process['uom_of_resistance_to_surface_wetting_after_one_wash'], "1", "0","L");
                              $pdf->SetTextColor(194,8,8);

                              $pdf->Cell(15,5,"Fail", "1", "0","C");
                              $pdf->SetTextColor(0,0,0);
                              $pdf->Ln();
							
                           }

                        }    /*End of if($row_for_defining_process['resistance_to_surface_wetting_after_one_wash_max_value']<>0)*/



                        if($row_for_defining_process['resistance_to_surface_wetting_after_five_wash_max_value']<>0 && $row_for_qc['resistance_to_surface_wetting_after_five_wash_value']<>0)
                        {

                           $total_test++;

                           if($customer_type == 'american')
						   {
							   $resistance_to_surface_wetting_after_five_wash_tolerance_value = $row_for_defining_process['resistance_to_surface_wetting_after_five_wash_tolerance_value'];
							   $resistance_to_surface_wetting_after_five_wash_value = $row_for_qc['resistance_to_surface_wetting_after_five_wash_value'];

						   }
					   		if($customer_type == 'european')
						   {
							 
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

                           if($row_for_defining_process['resistance_to_surface_wetting_after_five_wash_min_value']<=$row_for_qc['resistance_to_surface_wetting_after_five_wash_value'] && $row_for_defining_process['resistance_to_surface_wetting_after_five_wash_max_value']>=$row_for_qc['resistance_to_surface_wetting_after_five_wash_value'])
                           {
                              $p++;
							         $pdf->Cell(124,5,$row['test_name_method'].' (After Five Wash)',"1", "0","L");
                              $pdf->Cell(21,5,$resistance_to_surface_wetting_after_five_wash_value.' ' .$row_for_defining_process['uom_of_resistance_to_surface_wetting_after_five_wash'], "1", "0","L");
                              $pdf->Cell(30,5,$row_for_defining_process['resistance_to_surface_wetting_after_five_wash_tol_range_math_op'].' '.$resistance_to_surface_wetting_after_five_wash_tolerance_value.' '.$row_for_defining_process['uom_of_resistance_to_surface_wetting_after_five_wash'], "1", "0","L");
                              $pdf->Cell(15,5,"Pass", "1", "0","C");
                              $pdf->SetTextColor(0,0,0);
                              $pdf->Ln();
                           }
                           else {
                              $f++;
                              $pdf->Cell(124,5,$row['test_name_method'].' (After Five Wash)',"1", "0","L");
                              $pdf->Cell(21,5,$resistance_to_surface_wetting_after_five_wash_value.' ' .$row_for_defining_process['uom_of_resistance_to_surface_wetting_after_five_wash'], "1", "0","L");
                              $pdf->Cell(30,5,$row_for_defining_process['resistance_to_surface_wetting_after_five_wash_tol_range_math_op'].' '.$resistance_to_surface_wetting_after_five_wash_tolerance_value.' '.$row_for_defining_process['uom_of_resistance_to_surface_wetting_after_five_wash'], "1", "0","L");
                              $pdf->SetTextColor(194,8,8);

                              $pdf->Cell(15,5,"Fail", "1", "0","C");
                              $pdf->SetTextColor(0,0,0);
                              $pdf->Ln();
							  
                           }

        
                        }    /*End of if($row_for_defining_process['resistance_to_surface_wetting_after_five_wash_max_value']<>0)*/


					 } /*End of if (in_array($row['id'], ['21', '206', '22', '66']))*/


					 if (in_array($row['id'], ['23', '67']))
					 {
						if($row_for_defining_process['cf_to_hydrolysis_of_reactive_dyes_color_change_max_value']<>0 && $row_for_qc['cf_to_hydrolysis_of_reactive_dyes_color_change_value']<>0)
                        {

                           $total_test++;

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
                           }																	// for defining
      
                           $cf_to_hydrolysis_of_reactive_dyes_color_change = $row_for_qc['cf_to_hydrolysis_of_reactive_dyes_color_change_value'];
                        
                              if($cf_to_hydrolysis_of_reactive_dyes_color_change ==1.0)
                              {
                                 $cf_to_hydrolysis_of_reactive_dyes_color_change_value = '1';
                              }
                              elseif($cf_to_hydrolysis_of_reactive_dyes_color_change ==1.5)
                              {
                                 $cf_to_hydrolysis_of_reactive_dyes_color_change_value = '1-2';
                              }
                              elseif($cf_to_hydrolysis_of_reactive_dyes_color_change ==2.0)
                              {
                                 $cf_to_hydrolysis_of_reactive_dyes_color_change_value = '2';
                              }
                              elseif($cf_to_hydrolysis_of_reactive_dyes_color_change ==2.5)
                              {
                                 $cf_to_hydrolysis_of_reactive_dyes_color_change_value = '2-3';
                              }
                              elseif($cf_to_hydrolysis_of_reactive_dyes_color_change ==3.0)
                              {
                                 $cf_to_hydrolysis_of_reactive_dyes_color_change_value = '3';
                              }
                              elseif($cf_to_hydrolysis_of_reactive_dyes_color_change ==3.5)
                              {
                                 $cf_to_hydrolysis_of_reactive_dyes_color_change_value = '3-4';
                              }
                              elseif($cf_to_hydrolysis_of_reactive_dyes_color_change ==4.0)
                              {
                                 $cf_to_hydrolysis_of_reactive_dyes_color_change_value = '4';
                              }
                              elseif($cf_to_hydrolysis_of_reactive_dyes_color_change ==4.5)
                              {
                                 $cf_to_hydrolysis_of_reactive_dyes_color_change_value = '4-5';
                              }
                              elseif($cf_to_hydrolysis_of_reactive_dyes_color_change ==5.0)
                              {
                                 $cf_to_hydrolysis_of_reactive_dyes_color_change_value = '5';
                              } 				// for test result
      
                        }
      

                           if($row_for_defining_process['cf_to_hydrolysis_of_reactive_dyes_color_change_min_value']<=$row_for_qc['cf_to_hydrolysis_of_reactive_dyes_color_change_value'] && $row_for_defining_process['cf_to_hydrolysis_of_reactive_dyes_color_change_max_value']>=$row_for_qc['cf_to_hydrolysis_of_reactive_dyes_color_change_value'])
                           {
                              $p++;
                              $pdf->Cell(124,5,$row['test_name_method'].' (Color Change)',"1", "0","L");
                              $pdf->Cell(21,5,$cf_to_hydrolysis_of_reactive_dyes_color_change_value.' ' .$row_for_defining_process['uom_of_cf_to_hydrolysis_of_reactive_dyes_color_change'], "1", "0","L");
                              $pdf->Cell(30,5,$row_for_defining_process['cf_to_hydrolysis_of_reactive_dyes_color_change_tol_rang_mat_op'].' '.$cf_to_hydrolysis_of_reactive_dyes_color_change_tolerance_value.' '.$row_for_defining_process['uom_of_cf_to_hydrolysis_of_reactive_dyes_color_change'], "1", "0","L");
                              $pdf->Cell(15,5,"Pass", "1", "0","C");
                              $pdf->SetTextColor(0,0,0);
                              $pdf->Ln();
                           }
                           else {
                              $f++;
                              $pdf->Cell(124,5,$row['test_name_method'].' (Color Change)',"1", "0","L");
                              $pdf->Cell(21,5,$cf_to_hydrolysis_of_reactive_dyes_color_change_value.' ' .$row_for_defining_process['uom_of_cf_to_hydrolysis_of_reactive_dyes_color_change'], "1", "0","L");
                              $pdf->Cell(30,5,$row_for_defining_process['cf_to_hydrolysis_of_reactive_dyes_color_change_tol_rang_mat_op'].' '.$cf_to_hydrolysis_of_reactive_dyes_color_change_tolerance_value.' '.$row_for_defining_process['uom_of_cf_to_hydrolysis_of_reactive_dyes_color_change'], "1", "0","L");
                              $pdf->SetTextColor(194,8,8);

                              $pdf->Cell(15,5,"Fail", "1", "0","C");
                              $pdf->SetTextColor(0,0,0);
                              $pdf->Ln();
							 
                           }

                        }    /*End of if($row_for_defining_process['cf_to_hydrolysis_of_reactive_dyes_color_change_max_value']<>0)*/



					 } /* End of if (in_array($row['id'], ['23', '67']))*/
					  
                     if (in_array($row['id'], ['24', '68']))
					 {
                        if($row_for_defining_process['cf_to_oxidative_bleach_damage_color_change_max_value']<>0 && $row_for_qc['cf_to_oxidative_bleach_damage_color_change_value']<>0)
                        {

                           $total_test++;

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
							}												// for defining

						   $cf_to_oxidative_bleach_damage_color_change = $row_for_qc['cf_to_oxidative_bleach_damage_color_change_value'];
					   
							   if($cf_to_oxidative_bleach_damage_color_change ==1.0)
							   {
								   $cf_to_oxidative_bleach_damage_color_change_value = '1';
							   }
							   elseif($cf_to_oxidative_bleach_damage_color_change ==1.5)
							   {
								   $cf_to_oxidative_bleach_damage_color_change_value = '1-2';
							   }
							   elseif($cf_to_oxidative_bleach_damage_color_change ==2.0)
							   {
								   $cf_to_oxidative_bleach_damage_color_change_value = '2';
							   }
							   elseif($cf_to_oxidative_bleach_damage_color_change ==2.5)
							   {
								   $cf_to_oxidative_bleach_damage_color_change_value = '2-3';
							   }
							   elseif($cf_to_oxidative_bleach_damage_color_change ==3.0)
							   {
								   $cf_to_oxidative_bleach_damage_color_change_value = '3';
							   }
							   elseif($cf_to_oxidative_bleach_damage_color_change ==3.5)
							   {
								   $cf_to_oxidative_bleach_damage_color_change_value = '3-4';
							   }
							   elseif($cf_to_oxidative_bleach_damage_color_change ==4.0)
							   {
								   $cf_to_oxidative_bleach_damage_color_change_value = '4';
							   }
							   elseif($cf_to_oxidative_bleach_damage_color_change ==4.5)
							   {
								   $cf_to_oxidative_bleach_damage_color_change_value = '4-5';
							   }
							   elseif($cf_to_oxidative_bleach_damage_color_change ==5.0)
							   {
								   $cf_to_oxidative_bleach_damage_color_change_value = '5';
							   } 				// for test result

					   }

                           if($row_for_defining_process['cf_to_oxidative_bleach_damage_color_change_min_value']<=$row_for_qc['cf_to_oxidative_bleach_damage_color_change_value'] && $row_for_defining_process['cf_to_oxidative_bleach_damage_color_change_max_value']>=$row_for_qc['cf_to_oxidative_bleach_damage_color_change_value'])
                           {
                              $p++;
                              $pdf->Cell(124,5,$row['test_name_method'].' (Color Change)',"1", "0","L");
                              $pdf->Cell(21,5,$cf_to_oxidative_bleach_damage_color_change_value.' ' .$row_for_defining_process['uom_of_cf_to_oxidative_bleach_damage_color_change'], "1", "0","L");
                              $pdf->Cell(30,5,$row_for_defining_process['cf_to_oxidative_bleach_damage_color_change_tol_range_math_op'].' '.$cf_to_oxidative_bleach_damage_color_change_tolerance_value.' '.$row_for_defining_process['uom_of_cf_to_oxidative_bleach_damage_color_change'], "1", "0","L");
                              $pdf->Cell(15,5,"Pass", "1", "0","C");
                              $pdf->SetTextColor(0,0,0);
                              $pdf->Ln();
                           }
                           else {
                              $f++;
                              $pdf->Cell(124,5,$row['test_name_method'].' (Color Change)',"1", "0","L");
                              $pdf->Cell(21,5,$cf_to_oxidative_bleach_damage_color_change_value.' ' .$row_for_defining_process['uom_of_cf_to_oxidative_bleach_damage_color_change'], "1", "0","L");
                              $pdf->Cell(30,5,$row_for_defining_process['cf_to_oxidative_bleach_damage_color_change_tol_range_math_op'].' '.$cf_to_oxidative_bleach_damage_color_change_tolerance_value.' '.$row_for_defining_process['uom_of_cf_to_oxidative_bleach_damage_color_change'], "1", "0","L");
                              $pdf->SetTextColor(194,8,8);

                              $pdf->Cell(15,5,"Fail", "1", "0","C");
                              $pdf->SetTextColor(0,0,0);
                              $pdf->Ln();
							 
                           }

                              
                        }    /*End of if($row_for_defining_process['cf_to_oxidative_bleach_damage_color_change_max_value']<>0)*/


                        if($row_for_defining_process['cf_to_oxidative_bleach_damage_max_value']<>0 && $row_for_qc['cf_to_oxidative_bleach_damage_value']<>0)
                        {

                           $total_test++;
                           if($row_for_defining_process['cf_to_oxidative_bleach_damage_min_value']<=$row_for_qc['cf_to_oxidative_bleach_damage_value'] && $row_for_defining_process['cf_to_oxidative_bleach_damage_max_value']>=$row_for_qc['cf_to_oxidative_bleach_damage_value'])
                           {
                              $p++;
                              $pdf->Cell(124,5,$row['test_name_method'].' (Color Change)',"1", "0","L");
                              $pdf->Cell(21,5,$row_for_qc['cf_to_oxidative_bleach_damage_color_change_value'].' ' .$row_for_defining_process['uom_of_cf_to_oxidative_bleach_damage_color_change'], "1", "0","L");
                              $pdf->Cell(30,5,$row_for_defining_process['cf_to_oxidative_bleach_damage_min_value'].' to '.$row_for_defining_process['cf_to_oxidative_bleach_damage_max_value'], "1", "0","L");
                              $pdf->Cell(15,5,"Pass", "1", "0","C");
                              $pdf->SetTextColor(0,0,0);
                              $pdf->Ln();
                           }
                           else {
                              $f++;
                              $pdf->Cell(124,5,$row['test_name_method'].' (Color Change)',"1", "0","L");
                              $pdf->Cell(21,5,$row_for_qc['cf_to_oxidative_bleach_damage_color_change_value'].' ' .$row_for_defining_process['uom_of_cf_to_oxidative_bleach_damage_color_change'], "1", "0","L");
                              $pdf->Cell(30,5,$row_for_defining_process['cf_to_oxidative_bleach_damage_min_value'].' to '.$row_for_defining_process['cf_to_oxidative_bleach_damage_max_value'], "1", "0","L");
                              $pdf->SetTextColor(194,8,8);

                              $pdf->Cell(15,5,"Fail", "1", "0","C");
                              $pdf->SetTextColor(0,0,0);
                              $pdf->Ln();
							 
                           }

                               
                        }    /*End of if($row_for_defining_process['cf_to_oxidative_bleach_damage_max_value']<>0)*/

					 }   /*End of if (in_array($row['id'], ['24', '68']))*/



					 if (in_array($row['id'], ['25','69']))
					 {

                        if($row_for_defining_process['cf_to_phenolic_yellowing_staining_max_value']<>0 && $row_for_qc['cf_to_phenolic_yellowing_staining_value']<>0)
                        {

                           $total_test++;

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
							}											 // for defining

						   $cf_to_phenolic_yellowing_staining = $row_for_qc['cf_to_phenolic_yellowing_staining_value'];
					   
							   if($cf_to_phenolic_yellowing_staining ==1.0)
							   {
								   $cf_to_phenolic_yellowing_staining_value = '1';
							   }
							   elseif($cf_to_phenolic_yellowing_staining ==1.5)
							   {
								   $cf_to_phenolic_yellowing_staining_value = '1-2';
							   }
							   elseif($cf_to_phenolic_yellowing_staining ==2.0)
							   {
								   $cf_to_phenolic_yellowing_staining_value = '2';
							   }
							   elseif($cf_to_phenolic_yellowing_staining ==2.5)
							   {
								   $cf_to_phenolic_yellowing_staining_value = '2-3';
							   }
							   elseif($cf_to_phenolic_yellowing_staining ==3.0)
							   {
								   $cf_to_phenolic_yellowing_staining_value = '3';
							   }
							   elseif($cf_to_phenolic_yellowing_staining ==3.5)
							   {
								   $cf_to_phenolic_yellowing_staining_value = '3-4';
							   }
							   elseif($cf_to_phenolic_yellowing_staining ==4.0)
							   {
								   $cf_to_phenolic_yellowing_staining_value = '4';
							   }
							   elseif($cf_to_phenolic_yellowing_staining ==4.5)
							   {
								   $cf_to_phenolic_yellowing_staining_value = '4-5';
							   }
							   elseif($cf_to_phenolic_yellowing_staining ==5.0)
							   {
								   $cf_to_phenolic_yellowing_staining_value = '5';
							   } 				// for test result

					   }

                           if($row_for_defining_process['cf_to_phenolic_yellowing_staining_min_value']<=$row_for_qc['cf_to_phenolic_yellowing_staining_value'] && $row_for_defining_process['cf_to_phenolic_yellowing_staining_max_value']>=$row_for_qc['cf_to_phenolic_yellowing_staining_value'])
                           {
                              $p++;
                              $pdf->Cell(124,5,$row['test_name_method'].' (Staining)',"1", "0","L");
                              $pdf->Cell(21,5,$cf_to_phenolic_yellowing_staining_value.' ' .$row_for_defining_process['uom_of_cf_to_phenolic_yellowing_staining'], "1", "0","L");
                              $pdf->Cell(30,5,$row_for_defining_process['cf_to_phenolic_yellowing_staining_tolerance_range_math_operator'].' '.$cf_to_phenolic_yellowing_staining_tolerance_value.' '.$row_for_defining_process['uom_of_cf_to_phenolic_yellowing_staining'], "1", "0","L");
                              $pdf->Cell(15,5,"Pass", "1", "0","C");
                              $pdf->SetTextColor(0,0,0);
                              $pdf->Ln();
                           }
                           else {
                              $f++;
                              $pdf->Cell(124,5,$row['test_name_method'].' (Staining)',"1", "0","L");
                              $pdf->Cell(21,5,$cf_to_phenolic_yellowing_staining_value.' ' .$row_for_defining_process['uom_of_cf_to_phenolic_yellowing_staining'], "1", "0","L");
                              $pdf->Cell(30,5,$row_for_defining_process['cf_to_phenolic_yellowing_staining_tolerance_range_math_operator'].' '.$cf_to_phenolic_yellowing_staining_tolerance_value.' '.$row_for_defining_process['uom_of_cf_to_phenolic_yellowing_staining'], "1", "0","L");
                              $pdf->SetTextColor(194,8,8);

                              $pdf->Cell(15,5,"Fail", "1", "0","C");
                              $pdf->SetTextColor(0,0,0);
                              $pdf->Ln();
							
                           }

                            
                        }    /*End of if($row_for_defining_process['cf_to_phenolic_yellowing_staining_max_value']<>0)*/

					 }  /*End of if (in_array($row['id'], ['25', '158', '69']))*/

                     if (in_array($row['id'], ['26', '26', '70']))
					 {
					 	if($row_for_defining_process['cf_to_pvc_migration_staining_max_value']<>0 && $row_for_qc['cf_to_pvc_migration_staining_value']!= null)
                        {

                           $total_test++;

                           if($row_for_defining_process['cf_to_pvc_migration_staining_tolerance_range_math_operator'] == '≥')
                           {
                              $cf_to_pvc_migration_staining_tolerance_range_math_operator = $pdf->Image('../img/greater_equal.png',156, $pdf->GetY()+1.5, 1.7).'   ';
                           }
                           else if($row_for_defining_process['cf_to_pvc_migration_staining_tolerance_range_math_operator'] == '≤')
                           {
                              $cf_to_pvc_migration_staining_tolerance_range_math_operator = $pdf->Image('../img/less_equal.png',156, $pdf->GetY()+1.5, 1.7).'   ';
                           }
                           else if($row_for_defining_process['cf_to_pvc_migration_staining_tolerance_range_math_operator'] == '>')
                           {
                              $cf_to_pvc_migration_staining_tolerance_range_math_operator = '>';
                           }
                           else if($row_for_defining_process['cf_to_pvc_migration_staining_tolerance_range_math_operator'] == '<')
                           {
                              $cf_to_pvc_migration_staining_tolerance_range_math_operator = '<';
                           }

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

                           

                           if($row_for_defining_process['cf_to_pvc_migration_staining_min_value']<=$row_for_qc['cf_to_pvc_migration_staining_value'] && $row_for_defining_process['cf_to_pvc_migration_staining_max_value']>=$row_for_qc['cf_to_pvc_migration_staining_value'])
                           {
                              $p++;
							  $pdf->Cell(124,5,$row['test_name_method'].' (Staining)',"1", "0","L");
                              $pdf->Cell(21,5,$cf_to_pvc_migration_staining_value.' ' .$row_for_defining_process['uom_of_cf_to_pvc_migration_staining'], "1", "0","L");
                              $pdf->Cell(30,5,$cf_to_pvc_migration_staining_tolerance_range_math_operator.' '.$cf_to_pvc_migration_staining_tolerance_value.' '.$row_for_defining_process['uom_of_cf_to_pvc_migration_staining'], "1", "0","L");
                              $pdf->Cell(15,5,"Pass", "1", "0","C");
                              $pdf->SetTextColor(0,0,0);
                              $pdf->Ln();
                           }
                           else {
                              $f++;
                              $pdf->Cell(124,5,$row['test_name_method'].' (Staining)',"1", "0","L");
                              $pdf->Cell(21,5,$cf_to_pvc_migration_staining_value.' ' .$row_for_defining_process['uom_of_cf_to_pvc_migration_staining'], "1", "0","L");
                              $pdf->Cell(30,5,$cf_to_pvc_migration_staining_tolerance_range_math_operator.' '.$cf_to_pvc_migration_staining_tolerance_value.' '.$row_for_defining_process['uom_of_cf_to_pvc_migration_staining'], "1", "0","L");
                              $pdf->SetTextColor(194,8,8);

                              $pdf->Cell(15,5,"Fail", "1", "0","C");
                              $pdf->SetTextColor(0,0,0);
                              $pdf->Ln();
							 
                           }


                        }    /*End of if($row_for_defining_process['cf_to_pvc_migration_staining_max_value']<>0)*/
					 }


					 if (in_array($row['id'], ['27', '71']))
					 {
                       if($row_for_defining_process['cf_to_saliva_color_change_max_value']<>0 && $row_for_qc['cf_to_saliva_color_change_value']<>0)
                        {

                           $total_test++;

                           if($customer_type == 'american')
						   {
							   $cf_to_saliva_color_change_tolerance_value = $row_for_defining_process['cf_to_saliva_color_change_tolerance_value'];
							   $cf_to_saliva_color_change_value = $row_for_qc['cf_to_saliva_color_change_value'];

						   }
					   		if($customer_type == 'european')
						   {
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
							   } 				// for test result

					   }


                           if($row_for_defining_process['cf_to_saliva_color_change_min_value']<=$row_for_qc['cf_to_saliva_color_change_value'] && $row_for_defining_process['cf_to_saliva_color_change_max_value']>=$row_for_qc['cf_to_saliva_color_change_value'])
                           {
                              $p++;
							  $pdf->Cell(124,5,$row['test_name_method'].' (Color Change)',"1", "0","L");
                              $pdf->Cell(21,5,$cf_to_saliva_color_change_value.' ' .$row_for_defining_process['uom_of_cf_to_saliva_color_change'], "1", "0","L");
                              $pdf->Cell(30,5,$cf_to_saliva_color_change_tolerance_range_math_operator.' '.$cf_to_saliva_color_change_tolerance_value.' '.$row_for_defining_process['uom_of_cf_to_saliva_color_change'], "1", "0","L");
                              $pdf->Cell(15,5,"Pass", "1", "0","C");
                              $pdf->SetTextColor(0,0,0);
                              $pdf->Ln();
                           }
                           else {
                              $f++;
                              $pdf->Cell(124,5,$row['test_name_method'].' (Color Change)',"1", "0","L");
                              $pdf->Cell(21,5,$cf_to_saliva_color_change_value.' ' .$row_for_defining_process['uom_of_cf_to_saliva_color_change'], "1", "0","L");
                              $pdf->Cell(30,5,$cf_to_saliva_color_change_tolerance_range_math_operator.' '.$cf_to_saliva_color_change_tolerance_value.' '.$row_for_defining_process['uom_of_cf_to_saliva_color_change'], "1", "0","L");
                              $pdf->SetTextColor(194,8,8);

                              $pdf->Cell(15,5,"Fail", "1", "0","C");
                              $pdf->SetTextColor(0,0,0);
                              $pdf->Ln();
							 
                           }

                                
                        }    /*End of if($row_for_defining_process['cf_to_saliva_color_change_max_value']<>0)*/

                        if($row_for_defining_process['cf_to_saliva_staining_max_value']<>0 && $row_for_qc['cf_to_saliva_staining_value']<>0)
                        {

                           $total_test++;

                           if($row_for_defining_process['cf_to_saliva_staining_tolerance_range_math_operator'] == '≥')
                           {
                              $cf_to_saliva_staining_tolerance_range_math_operator = $pdf->Image('../img/greater_equal.png',156, $pdf->GetY()+1.5, 1.7).'   ';
                           }
                           else if($row_for_defining_process['cf_to_saliva_staining_tolerance_range_math_operator'] == '≤')
                           {
                              $cf_to_saliva_staining_tolerance_range_math_operator = $pdf->Image('../img/less_equal.png',156, $pdf->GetY()+1.5, 1.7).'   ';
                           }
                           else if($row_for_defining_process['cf_to_saliva_staining_tolerance_range_math_operator'] == '>')
                           {
                              $cf_to_saliva_staining_tolerance_range_math_operator = '>';
                           }
                           else if($row_for_defining_process['cf_to_saliva_staining_tolerance_range_math_operator'] == '<')
                           {
                              $cf_to_saliva_staining_tolerance_range_math_operator = '<';
                           }

                           if($customer_type == 'american')
                           {
                              $cf_to_saliva_staining_tolerance_value = $row_for_defining_process['cf_to_saliva_staining_tolerance_value'];
                              $cf_to_saliva_staining_value = $row_for_qc['cf_to_saliva_staining_value'];
      
                           }
                              if($customer_type == 'european')
                           {
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
       
       
                           $cf_to_saliva_staining = $row_for_qc['cf_to_saliva_staining_value'];
                        
                              if($cf_to_saliva_staining ==1.0)
                              {
                                 $cf_to_saliva_staining_value = '1';
                              }
                              elseif($cf_to_saliva_staining ==1.5)
                              {
                                 $cf_to_saliva_staining_value = '1-2';
                              }
                              elseif($cf_to_saliva_staining ==2.0)
                              {
                                 $cf_to_saliva_staining_value = '2';
                              }
                              elseif($cf_to_saliva_staining ==2.5)
                              {
                                 $cf_to_saliva_staining_value = '2-3';
                              }
                              elseif($cf_to_saliva_staining ==3.0)
                              {
                                 $cf_to_saliva_staining_value = '3';
                              }
                              elseif($cf_to_saliva_staining ==3.5)
                              {
                                 $cf_to_saliva_staining_value = '3-4';
                              }
                              elseif($cf_to_saliva_staining ==4.0)
                              {
                                 $cf_to_saliva_staining_value = '4';
                              }
                              elseif($cf_to_saliva_staining ==4.5)
                              {
                                 $cf_to_saliva_staining_value = '4-5';
                              }
                              elseif($cf_to_saliva_staining ==5.0)
                              {
                                 $cf_to_saliva_staining_value = '5';
                              } 				// for test result
      
                        }
      


                           if($row_for_defining_process['cf_to_saliva_staining_min_value']<=$row_for_qc['cf_to_saliva_staining_value'] && $row_for_defining_process['cf_to_saliva_staining_max_value']>=$row_for_qc['cf_to_saliva_staining_value'])
                           {
                              $p++;
                              $pdf->Cell(124,5,$row['test_name_method'].' (Staining)',"1", "0","L");
                              $pdf->Cell(21,5,$cf_to_saliva_staining_value.' ' .$row_for_defining_process['uom_of_cf_to_saliva_staining'], "1", "0","L");
                              $pdf->Cell(30,5,$cf_to_saliva_staining_tolerance_range_math_operator.' '.$cf_to_saliva_staining_tolerance_value.' '.$row_for_defining_process['uom_of_cf_to_saliva_staining'], "1", "0","L");
                              $pdf->Cell(15,5,"Pass", "1", "0","C");
                              $pdf->SetTextColor(0,0,0);
                              $pdf->Ln();
                           }
                           else {
                              $f++;
                              $pdf->Cell(124,5,$row['test_name_method'].' (Staining)',"1", "0","L");
                              $pdf->Cell(21,5,$cf_to_saliva_staining_value.' ' .$row_for_defining_process['uom_of_cf_to_saliva_staining'], "1", "0","L");
                              $pdf->Cell(30,5,$cf_to_saliva_staining_tolerance_range_math_operator.' '.$cf_to_saliva_staining_tolerance_value.' '.$row_for_defining_process['uom_of_cf_to_saliva_staining'], "1", "0","L");
                              $pdf->SetTextColor(194,8,8);

                              $pdf->Cell(15,5,"Fail", "1", "0","C");
                              $pdf->SetTextColor(0,0,0);
                              $pdf->Ln();
							  
                           }

                                
                        }    /*End of if($row_for_defining_process['cf_to_saliva_staining_max_value']<>0)*/


					 }  /*End of if (in_array($row['id'], ['27', '71', '168', '156']))*/
                     if (in_array($row['id'], ['28', '72']))
					 {
                        if($row_for_defining_process['cf_to_chlorinated_water_color_change_max_value']<>0 && $row_for_qc['cf_to_chlorinated_water_color_change_change_value']<>0)
                        {

                           $total_test++;
                           
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
                           }
       
       
                           $cf_to_chlorinated_water_color_change_change = $row_for_qc['cf_to_chlorinated_water_color_change_change_value'];
                        
                              if($cf_to_chlorinated_water_color_change_change ==1.0)
                              {
                                 $cf_to_chlorinated_water_color_change_change_value = '1';
                              }
                              elseif($cf_to_chlorinated_water_color_change_change ==1.5)
                              {
                                 $cf_to_chlorinated_water_color_change_change_value = '1-2';
                              }
                              elseif($cf_to_chlorinated_water_color_change_change ==2.0)
                              {
                                 $cf_to_chlorinated_water_color_change_change_value = '2';
                              }
                              elseif($cf_to_chlorinated_water_color_change_change ==2.5)
                              {
                                 $cf_to_chlorinated_water_color_change_change_value = '2-3';
                              }
                              elseif($cf_to_chlorinated_water_color_change_change ==3.0)
                              {
                                 $cf_to_chlorinated_water_color_change_change_value = '3';
                              }
                              elseif($cf_to_chlorinated_water_color_change_change ==3.5)
                              {
                                 $cf_to_chlorinated_water_color_change_change_value = '3-4';
                              }
                              elseif($cf_to_chlorinated_water_color_change_change ==4.0)
                              {
                                 $cf_to_chlorinated_water_color_change_change_value = '4';
                              }
                              elseif($cf_to_chlorinated_water_color_change_change ==4.5)
                              {
                                 $cf_to_chlorinated_water_color_change_change_value = '4-5';
                              }
                              elseif($cf_to_chlorinated_water_color_change_change ==5.0)
                              {
                                 $cf_to_chlorinated_water_color_change_change_value = '5';
                              } 				// for test result
      
                        }

                           if($row_for_defining_process['cf_to_chlorinated_water_color_change_min_value']<=$row_for_qc['cf_to_chlorinated_water_color_change_change_value'] && $row_for_defining_process['cf_to_chlorinated_water_color_change_max_value']>=$row_for_qc['cf_to_chlorinated_water_color_change_value'])
                           {
                              $p++;
							         $pdf->Cell(124,5,$row['test_name_method'].' (Color Change)',"1", "0","L");
                              $pdf->Cell(21,5,$cf_to_chlorinated_water_color_change_change_value.' ' .$row_for_defining_process['uom_of_cf_to_chlorinated_water_color_change'], "1", "0","L");
                              $pdf->Cell(30,5,$row_for_defining_process['cf_to_chlorinated_water_color_change_tolerance_range_math_op'].' '.$cf_to_chlorinated_water_color_change_tolerance_value.' '.$row_for_defining_process['uom_of_cf_to_chlorinated_water_color_change'], "1", "0","L");
                              $pdf->Cell(15,5,"Pass", "1", "0","C");
                              $pdf->SetTextColor(0,0,0);
                              $pdf->Ln();
                           }
                           else {
                              $f++;
                              $pdf->Cell(124,5,$row['test_name_method'].' (Color Change)',"1", "0","L");
                              $pdf->Cell(21,5,$cf_to_chlorinated_water_color_change_change_value.' ' .$row_for_defining_process['uom_of_cf_to_chlorinated_water_color_change'], "1", "0","L");
                              $pdf->Cell(30,5,$row_for_defining_process['cf_to_chlorinated_water_color_change_tolerance_range_math_op'].' '.$cf_to_chlorinated_water_color_change_tolerance_value.' '.$row_for_defining_process['uom_of_cf_to_chlorinated_water_color_change'], "1", "0","L");
                              $pdf->SetTextColor(194,8,8);

                              $pdf->Cell(15,5,"Fail", "1", "0","C");
                              $pdf->SetTextColor(0,0,0);
                              $pdf->Ln();
							 
                           }

                                
                        }    /*End of if($row_for_defining_process['cf_to_chlorinated_water_color_change_max_value']<>0)*/
					 }  /*End of if (in_array($row['id'], ['28', '210', '224', '72', '142']))*/


					 if (in_array($row['id'], ['29', '73']))
					 {
                       if($row_for_defining_process['cf_to_cholorine_bleach_color_change_max_value']<>0 && $row_for_qc['cf_to_cholorine_bleach_color_change_value']<>0)
                        {

                           $total_test++;

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
                           }
       
       
                           $cf_to_cholorine_bleach_color_change = $row_for_qc['cf_to_cholorine_bleach_color_change_value'];
                        
                              if($cf_to_cholorine_bleach_color_change ==1.0)
                              {
                                 $cf_to_cholorine_bleach_color_change_value = '1';
                              }
                              elseif($cf_to_cholorine_bleach_color_change ==1.5)
                              {
                                 $cf_to_cholorine_bleach_color_change_value = '1-2';
                              }
                              elseif($cf_to_cholorine_bleach_color_change ==2.0)
                              {
                                 $cf_to_cholorine_bleach_color_change_value = '2';
                              }
                              elseif($cf_to_cholorine_bleach_color_change ==2.5)
                              {
                                 $cf_to_cholorine_bleach_color_change_value = '2-3';
                              }
                              elseif($cf_to_cholorine_bleach_color_change ==3.0)
                              {
                                 $cf_to_cholorine_bleach_color_change_value = '3';
                              }
                              elseif($cf_to_cholorine_bleach_color_change ==3.5)
                              {
                                 $cf_to_cholorine_bleach_color_change_value = '3-4';
                              }
                              elseif($cf_to_cholorine_bleach_color_change ==4.0)
                              {
                                 $cf_to_cholorine_bleach_color_change_value = '4';
                              }
                              elseif($cf_to_cholorine_bleach_color_change ==4.5)
                              {
                                 $cf_to_cholorine_bleach_color_change_value = '4-5';
                              }
                              elseif($cf_to_cholorine_bleach_color_change ==5.0)
                              {
                                 $cf_to_cholorine_bleach_color_change_value = '5';
                              } 				// for test result
      
                        }



                           if($row_for_defining_process['cf_to_cholorine_bleach_color_change_min_value']<=$row_for_qc['cf_to_cholorine_bleach_color_change_value'] && $row_for_defining_process['cf_to_cholorine_bleach_color_change_max_value']>=$row_for_qc['cf_to_cholorine_bleach_color_change_value'])
                           {
                              $p++;
                              $pdf->Cell(124,5,$row['test_name_method'].' (Color Change)',"1", "0","L");
                              $pdf->Cell(21,5,$cf_to_cholorine_bleach_color_change_value.' ' .$row_for_defining_process['uom_of_cf_to_cholorine_bleach_color_change'], "1", "0","L");
                              $pdf->Cell(30,5,$row_for_defining_process['cf_to_cholorine_bleach_color_change_tolerance_range_math_op'].' '.$cf_to_cholorine_bleach_color_change_tolerance_value.' '.$row_for_defining_process['uom_of_cf_to_cholorine_bleach_color_change'], "1", "0","L");
                              $pdf->Cell(15,5,"Pass", "1", "0","C");
                              $pdf->SetTextColor(0,0,0);
                              $pdf->Ln();
							 
                           }
                           else {
                              $f++;
                              $pdf->Cell(124,5,$row['test_name_method'].' (Color Change)',"1", "0","L");
                              $pdf->Cell(21,5,$cf_to_cholorine_bleach_color_change_value.' ' .$row_for_defining_process['uom_of_cf_to_cholorine_bleach_color_change'], "1", "0","L");
                              $pdf->Cell(30,5,$row_for_defining_process['cf_to_cholorine_bleach_color_change_tolerance_range_math_op'].' '.$cf_to_cholorine_bleach_color_change_tolerance_value.' '.$row_for_defining_process['uom_of_cf_to_cholorine_bleach_color_change'], "1", "0","L");
                              $pdf->SetTextColor(194,8,8);

                              $pdf->Cell(15,5,"Fail", "1", "0","C");
                              $pdf->SetTextColor(0,0,0);
                              $pdf->Ln();
							 
                           }

                                
                        }    /*End of if($row_for_defining_process['cf_to_cholorine_bleach_color_change_max_value']<>0)*/
					 }   /*End of if (in_array($row['id'], ['29', '241', '73', '285']))*/



					 if (in_array($row['id'], ['30']))
					 {
                       if($row_for_defining_process['cf_to_peroxide_bleach_color_change_max_value']<>0 && $row_for_qc['cf_to_peroxide_bleach_color_change_value']<>0)
                        {

                           $total_test++;




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
							}
 
 
 
						   $cf_to_peroxide_bleach_color_change = $row_for_qc['cf_to_peroxide_bleach_color_change_value'];
					   
							   if($cf_to_peroxide_bleach_color_change ==1.0)
							   {
								   $cf_to_peroxide_bleach_color_change_value = '1';
							   }
							   elseif($cf_to_peroxide_bleach_color_change ==1.5)
							   {
								   $cf_to_peroxide_bleach_color_change_value = '1-2';
							   }
							   elseif($cf_to_peroxide_bleach_color_change ==2.0)
							   {
								   $cf_to_peroxide_bleach_color_change_value = '2';
							   }
							   elseif($cf_to_peroxide_bleach_color_change ==2.5)
							   {
								   $cf_to_peroxide_bleach_color_change_value = '2-3';
							   }
							   elseif($cf_to_peroxide_bleach_color_change ==3.0)
							   {
								   $cf_to_peroxide_bleach_color_change_value = '3';
							   }
							   elseif($cf_to_peroxide_bleach_color_change ==3.5)
							   {
								   $cf_to_peroxide_bleach_color_change_value = '3-4';
							   }
							   elseif($cf_to_peroxide_bleach_color_change ==4.0)
							   {
								   $cf_to_peroxide_bleach_color_change_value = '4';
							   }
							   elseif($cf_to_peroxide_bleach_color_change ==4.5)
							   {
								   $cf_to_peroxide_bleach_color_change_value = '4-5';
							   }
							   elseif($cf_to_peroxide_bleach_color_change ==5.0)
							   {
								   $cf_to_peroxide_bleach_color_change_value = '5';
							   } 				// for test result

					   }


                           



                           if($row_for_defining_process['cf_to_peroxide_bleach_color_change_min_value']<=$row_for_qc['cf_to_peroxide_bleach_color_change_value'] && $row_for_defining_process['cf_to_peroxide_bleach_color_change_max_value']>=$row_for_qc['cf_to_peroxide_bleach_color_change_value'])
                           {
                              $p++;
							  $pdf->Cell(124,5,$row['test_name_method'].' (Color Change)',"1", "0","L");
                              $pdf->Cell(21,5,$cf_to_peroxide_bleach_color_change_value.' ' .$row_for_defining_process['uom_of_cf_to_peroxide_bleach_color_change'], "1", "0","L");
                              $pdf->Cell(30,5,$row_for_defining_process['cf_to_peroxide_bleach_color_change_tolerance_range_math_operator'].' '.$cf_to_peroxide_bleach_color_change_tolerance_value.' '.$row_for_defining_process['uom_of_cf_to_peroxide_bleach_color_change'], "1", "0","L");
                              $pdf->Cell(15,5,"Pass", "1", "0","C");
                              $pdf->SetTextColor(0,0,0);
                              $pdf->Ln();
                           }
                           else {
                              $f++;
                              $pdf->Cell(124,5,$row['test_name_method'].' (Color Change)',"1", "0","L");
                              $pdf->Cell(21,5,$cf_to_peroxide_bleach_color_change_value.' ' .$row_for_defining_process['uom_of_cf_to_peroxide_bleach_color_change'], "1", "0","L");
                              $pdf->Cell(30,5,$row_for_defining_process['cf_to_peroxide_bleach_color_change_tolerance_range_math_operator'].' '.$cf_to_peroxide_bleach_color_change_tolerance_value.' '.$row_for_defining_process['uom_of_cf_to_peroxide_bleach_color_change'], "1", "0","L");
                              $pdf->SetTextColor(194,8,8);

                              $pdf->Cell(15,5,"Fail", "1", "0","C");
                              $pdf->SetTextColor(0,0,0);
                              $pdf->Ln();
							 
                           }

                        
                        }    /*End of if($row_for_defining_process['cf_to_peroxide_bleach_color_change_max_value']<>0)*/

					 }   /*End of if (in_array($row['id'], ['30', '75']))*/


					 if (in_array($row['id'], ['31']))
					 {
                        if($row_for_defining_process['cross_staining_max_value']<>0 && $row_for_qc['cross_staining_value']!= null)
                        {

                           $total_test++;

                           if($row_for_defining_process['cross_staining_tolerance_range_math_operator'] == '≥')
                           {
                              $cross_staining_tolerance_range_math_operator = $pdf->Image('../img/greater_equal.png',156, $pdf->GetY()+1.5, 1.7).'   ';
                           }
                           else if($row_for_defining_process['cross_staining_tolerance_range_math_operator'] == '≤')
                           {
                              $cross_staining_tolerance_range_math_operator = $pdf->Image('../img/less_equal.png',156, $pdf->GetY()+1.5, 1.7).'   ';
                           }
                           else if($row_for_defining_process['cross_staining_tolerance_range_math_operator'] == '>')
                           {
                              $cross_staining_tolerance_range_math_operator = '>';
                           }
                           else if($row_for_defining_process['cross_staining_tolerance_range_math_operator'] == '<')
                           {
                              $cross_staining_tolerance_range_math_operator = '<';
                           }


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
                           }
       
       
       
                           $cross_staining = $row_for_qc['cross_staining_value'];
                        
                              if($cross_staining ==1.0)
                              {
                                 $cross_staining_value = '1';
                              }
                              elseif($cross_staining ==1.5)
                              {
                                 $cross_staining_value = '1-2';
                              }
                              elseif($cross_staining ==2.0)
                              {
                                 $cross_staining_value = '2';
                              }
                              elseif($cross_staining ==2.5)
                              {
                                 $cross_staining_value = '2-3';
                              }
                              elseif($cross_staining ==3.0)
                              {
                                 $cross_staining_value = '3';
                              }
                              elseif($cross_staining ==3.5)
                              {
                                 $cross_staining_value = '3-4';
                              }
                              elseif($cross_staining ==4.0)
                              {
                                 $cross_staining_value = '4';
                              }
                              elseif($cross_staining ==4.5)
                              {
                                 $cross_staining_value = '4-5';
                              }
                              elseif($cross_staining ==5.0)
                              {
                                 $cross_staining_value = '5';
                              } 				// for test result
      
                        }


                           if($row_for_defining_process['cross_staining_min_value']<=$row_for_qc['cross_staining_value'] && $row_for_defining_process['cross_staining_max_value']>=$row_for_qc['cross_staining_value'])
                           {
                              $p++;

                              $pdf->Cell(124,5,$row['test_name_method'].' (Cross Staining)',"1", "0","L");
                              $pdf->Cell(21,5,$cross_staining_value.' ' .$row_for_defining_process['uom_of_cross_staining'], "1", "0","L");
                              $pdf->Cell(30,5,$cross_staining_tolerance_range_math_operator.' '.$cross_staining_tolerance_value.' '.$row_for_defining_process['uom_of_cross_staining'], "1", "0","L");
                              $pdf->Cell(15,5,"Pass", "1", "0","C");
                              $pdf->SetTextColor(0,0,0);
                              $pdf->Ln();
                           }
                           else {
                              $f++;
                              $pdf->Cell(124,5,$row['test_name_method'].' (Cross Staining)',"1", "0","L");
                              $pdf->Cell(21,5,$cross_staining_value.' ' .$row_for_defining_process['uom_of_cross_staining'], "1", "0","L");
                              $pdf->Cell(30,5,$cross_staining_tolerance_range_math_operator.' '.$cross_staining_tolerance_value.' '.$row_for_defining_process['uom_of_cross_staining'], "1", "0","L");
                              $pdf->SetTextColor(194,8,8);

                              $pdf->Cell(15,5,"Fail", "1", "0","C");
                              $pdf->SetTextColor(0,0,0);
                              $pdf->Ln();
							 
                           }

                                 
                        }    /*End of if($row_for_defining_process['cross_staining_max_value']<>0)*/
					 }  /*End of  if (in_array($row['id'], ['31', '76']))*/


					  if (in_array($row['id'], ['32']))
					 {
                        if($row_for_defining_process['formaldehyde_content_max_value']<>0 && $row_for_qc['formaldehyde_content_value']<>0)
                        {

                           $total_test++;

                           if($row_for_defining_process['formaldehyde_content_tolerance_range_math_operator'] == '≥')
                           {
                              $formaldehyde_content_tolerance_range_math_operator = $pdf->Image('../img/greater_equal.png',156, $pdf->GetY()+1.5, 1.7).'   ';
                           }
                           else if($row_for_defining_process['formaldehyde_content_tolerance_range_math_operator'] == '≤')
                           {
                              $formaldehyde_content_tolerance_range_math_operator = $pdf->Image('../img/less_equal.png',156, $pdf->GetY()+1.5, 1.7).'   ';
                           }
                           else if($row_for_defining_process['formaldehyde_content_tolerance_range_math_operator'] == '>')
                           {
                              $formaldehyde_content_tolerance_range_math_operator = '>';
                           }
                           else if($row_for_defining_process['formaldehyde_content_tolerance_range_math_operator'] == '<')
                           {
                              $formaldehyde_content_tolerance_range_math_operator = '<';
                           }

                           if(($row_for_defining_process['formaldehyde_content_min_value']<=$row_for_qc['formaldehyde_content_value'] && $row_for_defining_process['formaldehyde_content_max_value']>=$row_for_qc['formaldehyde_content_value']) ||  $row_for_qc['formaldehyde_content_value']=='N.D.' )
                           {
                              $p++;
                              $pdf->Cell(124,5,$row['test_name_method'],"1", "0","L");
                              $pdf->Cell(21,5,$row_for_qc['formaldehyde_content_value'].' ' .$row_for_defining_process['uom_of_formaldehyde_content'], "1", "0","L");
                              $pdf->Cell(30,5,$formaldehyde_content_tolerance_range_math_operator.' '.$row_for_defining_process['formaldehyde_content_tolerance_value'].' '.$row_for_defining_process['uom_of_formaldehyde_content'], "1", "0","L");
                              $pdf->Cell(15,5,"Pass", "1", "0","C");
                              $pdf->SetTextColor(0,0,0);
                              $pdf->Ln();
                           }
                           else {
                              $f++;
                              $pdf->Cell(124,5,$row['test_name_method'],"1", "0","L");
                              $pdf->Cell(21,5,$row_for_qc['formaldehyde_content_value'].' ' .$row_for_defining_process['uom_of_formaldehyde_content'], "1", "0","L");
                              $pdf->Cell(30,5,$formaldehyde_content_tolerance_range_math_operator.' '.$row_for_defining_process['formaldehyde_content_tolerance_value'].' '.$row_for_defining_process['uom_of_formaldehyde_content'], "1", "0","L");
                              $pdf->SetTextColor(194,8,8);

                              $pdf->Cell(15,5,"Fail", "1", "0","C");
                              $pdf->SetTextColor(0,0,0);
                              $pdf->Ln();
							 
                           }

                                 
                        }    /*End of if($row_for_defining_process['formaldehyde_content_max_value']<>0)*/

					 } /* end of if (in_array($row['id'], ['32', '118', '77', '235', '258']))*/
                       

                    if (in_array($row['id'], ['33']))
					 {
                       if($row_for_defining_process['ph_value_max_value']<>0 && $row_for_qc['ph_value']<>0)
                        {

                           $total_test++;
                           if($row_for_defining_process['ph_value_min_value']<=$row_for_qc['ph_value'] && $row_for_defining_process['ph_value_max_value']>=$row_for_qc['ph_value'])
                           {
                              $p++;
                              $pdf->Cell(124,5,$row['test_name_method'],"1", "0","L");
                              $pdf->Cell(21,5,$row_for_qc['ph_value'], "1", "0","L");
                              $pdf->Cell(30,5,$row_for_defining_process['ph_value_min_value'].' to '.$row_for_defining_process['ph_value_max_value'], "1", "0","L");
                              $pdf->Cell(15,5,"Pass", "1", "0","C");
                              $pdf->SetTextColor(0,0,0);
                              $pdf->Ln();
                           }
                           else {
                              $f++;
                              $pdf->Cell(124,5,$row['test_name_method'],"1", "0","L");
                              $pdf->Cell(21,5,$row_for_qc['ph_value'], "1", "0","L");
                              $pdf->Cell(30,5,$row_for_defining_process['ph_value_min_value'].' to '.$row_for_defining_process['ph_value_max_value'], "1", "0","L");
                              $pdf->SetTextColor(194,8,8);

                              $pdf->Cell(15,5,"Fail", "1", "0","C");
                              $pdf->SetTextColor(0,0,0);
                              $pdf->Ln();
							  
                           }
                        }    /*End of if($row_for_defining_process['ph_value_max_value']<>0)*/

					 }    
                      

                     if (in_array($row['id'], ['34']))
					 {
                         if($row_for_defining_process['water_absorption_value_max_value']<>0 && $row_for_qc['water_absorption_value']<>0)
                        {

                           $total_test++;
                           if($row_for_defining_process['water_absorption_value_min_value']<=$row_for_qc['water_absorption_value'] && $row_for_defining_process['water_absorption_value_max_value']>=$row_for_qc['water_absorption_value'])
                           {
                              $p++;
                              $pdf->Cell(124,5,$row['test_name_method'],"1", "0","L");
                              $pdf->Cell(21,5,$row_for_qc['water_absorption_value'].' ' .$row_for_defining_process['uom_of_water_absorption_value'], "1", "0","L");
                              $pdf->Cell(30,5,$row_for_defining_process['water_absorption_value_tolerance_range_math_operator'].' '.$row_for_defining_process['water_absorption_value_tolerance_value'].' '.$row_for_defining_process['uom_of_water_absorption_value'], "1", "0","L");
                              $pdf->Cell(15,5,"Pass", "1", "0","C");
                              $pdf->SetTextColor(0,0,0);
                              $pdf->Ln();
                           }
                           else {
                              $f++;
                              $pdf->Cell(124,5,$row['test_name_method'],"1", "0","L");
                              $pdf->Cell(21,5,$row_for_qc['water_absorption_value'].' ' .$row_for_defining_process['uom_of_water_absorption_value'], "1", "0","L");
                              $pdf->Cell(30,5,$row_for_defining_process['water_absorption_value_tolerance_range_math_operator'].' '.$row_for_defining_process['water_absorption_value_tolerance_value'].' '.$row_for_defining_process['uom_of_water_absorption_value'], "1", "0","L");
                              $pdf->SetTextColor(194,8,8);

                              $pdf->Cell(15,5,"Fail", "1", "0","C");
                              $pdf->SetTextColor(0,0,0);
                              $pdf->Ln();
							  
                           }

                              
                        }    /*End of if($row_for_defining_process['water_absorption_value_max_value']<>0)*/

                        if($row_for_defining_process['water_absorption_b_wash_thirty_sec_max_value']<>0 && $row_for_qc['water_absorption_b_wash_thirty_sec_value']<>0)
                        {

                           $total_test++;
                           if($row_for_defining_process['water_absorption_b_wash_thirty_sec_min_value']<=$row_for_qc['water_absorption_b_wash_thirty_sec_value'] && $row_for_defining_process['water_absorption_b_wash_thirty_sec_max_value']>=$row_for_qc['water_absorption_b_wash_thirty_sec_value'])
                           {
                              $p++;
                              $pdf->Cell(124,5,$row['test_name_method'].' (Before Wash 30 Sec.)',"1", "0","L");
                              $pdf->Cell(21,5,$row_for_qc['water_absorption_b_wash_thirty_sec_value'].' ' .$row_for_defining_process['uom_of_water_absorption_b_wash_thirty_sec'], "1", "0","L");
                              $pdf->Cell(30,5,$row_for_defining_process['water_absorption_b_wash_thirty_sec_tolerance_range_math_op'].' '.$row_for_defining_process['water_absorption_b_wash_thirty_sec_tolerance_value'].' '.$row_for_defining_process['uom_of_water_absorption_b_wash_thirty_sec'], "1", "0","L");
                              $pdf->Cell(15,5,"Pass", "1", "0","C");
                              $pdf->SetTextColor(0,0,0);
                              $pdf->Ln();
                           }
                           else {
                              $f++;
                              $pdf->Cell(124,5,$row['test_name_method'].' (Before Wash 30 Sec.)',"1", "0","L");
                              $pdf->Cell(21,5,$row_for_qc['water_absorption_b_wash_thirty_sec_value'].' ' .$row_for_defining_process['uom_of_water_absorption_b_wash_thirty_sec'], "1", "0","L");
                              $pdf->Cell(30,5,$row_for_defining_process['water_absorption_b_wash_thirty_sec_tolerance_range_math_op'].' '.$row_for_defining_process['water_absorption_b_wash_thirty_sec_tolerance_value'].' '.$row_for_defining_process['uom_of_water_absorption_b_wash_thirty_sec'], "1", "0","L");
                              $pdf->SetTextColor(194,8,8);

                              $pdf->Cell(15,5,"Fail", "1", "0","C");
                              $pdf->SetTextColor(0,0,0);
                              $pdf->Ln();
							 
                           }

                                
                        }    /*End of if($row_for_defining_process['water_absorption_b_wash_thirty_sec_max_value']<>0)*/

                        if($row_for_defining_process['water_absorption_b_wash_max_max_value']<>0 && $row_for_qc['water_absorption_b_wash_max_value']<>0)
                        {

                           $total_test++;
                           if($row_for_defining_process['water_absorption_b_wash_max_min_value']<=$row_for_qc['water_absorption_b_wash_max_value'] && $row_for_defining_process['water_absorption_b_wash_max_max_value']>=$row_for_qc['water_absorption_b_wash_max_value'])
                           {
                              $p++;
							  $pdf->Cell(124,5,$row['test_name_method'].' (Before Wash )',"1", "0","L");
                              $pdf->Cell(21,5,$row_for_qc['water_absorption_b_wash_max_value'].' ' .$row_for_defining_process['uom_of_water_absorption_b_wash_max'], "1", "0","L");
                              $pdf->Cell(30,5,$row_for_defining_process['water_absorption_b_wash_max_tolerance_range_math_op'].' '.$row_for_defining_process['water_absorption_b_wash_max_tolerance_value'].' '.$row_for_defining_process['uom_of_water_absorption_b_wash_max'], "1", "0","L");
                              $pdf->Cell(15,5,"Pass", "1", "0","C");
                              $pdf->SetTextColor(0,0,0);
                              $pdf->Ln();
                           }
                           else {
                              $f++;
                              $pdf->Cell(124,5,$row['test_name_method'].' (Before Wash )',"1", "0","L");
                              $pdf->Cell(21,5,$row_for_qc['water_absorption_b_wash_max_value'].' ' .$row_for_defining_process['uom_of_water_absorption_b_wash_max'], "1", "0","L");
                              $pdf->Cell(30,5,$row_for_defining_process['water_absorption_b_wash_max_tolerance_range_math_op'].' '.$row_for_defining_process['water_absorption_b_wash_max_tolerance_value'].' '.$row_for_defining_process['uom_of_water_absorption_b_wash_max'], "1", "0","L");
                              $pdf->SetTextColor(194,8,8);

                              $pdf->Cell(15,5,"Fail", "1", "0","C");
                              $pdf->SetTextColor(0,0,0);
                              $pdf->Ln();
							 
                           }

                             
                        }    /*End of if($row_for_defining_process['water_absorption_b_wash_max_max_value']<>0)*/

                        if($row_for_defining_process['water_absorption_a_wash_thirty_sec_max_value']<>0 && $row_for_qc['water_absorption_a_wash_thirty_sec_value']<>0)
                        {

                           $total_test++;
                           if($row_for_defining_process['water_absorption_a_wash_thirty_sec_min_value']<=$row_for_qc['water_absorption_a_wash_thirty_sec_value'] && $row_for_defining_process['water_absorption_a_wash_thirty_sec_max_value']>=$row_for_qc['cf_to_perspiration_acid_color_change_value'])
                           {
                              $p++;
                              $pdf->Cell(124,5,$row['test_name_method'].' (After Wash 30 Sec. )',"1", "0","L");
                              $pdf->Cell(21,5,$row_for_qc['water_absorption_a_wash_thirty_sec_value'].' ' .$row_for_defining_process['uom_of_water_absorption_a_wash_thirty_sec'], "1", "0","L");
                              $pdf->Cell(30,5,$row_for_defining_process['water_absorption_a_wash_thirty_sec_tolerance_range_math_op'].' '.$row_for_defining_process['water_absorption_a_wash_thirty_sec_tolerance_value'].' '.$row_for_defining_process['uom_of_water_absorption_a_wash_thirty_sec'], "1", "0","L");
                              $pdf->Cell(15,5,"Pass", "1", "0","C");
                              $pdf->SetTextColor(0,0,0);
                              $pdf->Ln();
                           }
                           else {
                              $f++;
                              $pdf->Cell(124,5,$row['test_name_method'].' (After Wash 30 Sec. )',"1", "0","L");
                              $pdf->Cell(21,5,$row_for_qc['water_absorption_a_wash_thirty_sec_value'].' ' .$row_for_defining_process['uom_of_water_absorption_a_wash_thirty_sec'], "1", "0","L");
                              $pdf->Cell(30,5,$row_for_defining_process['water_absorption_a_wash_thirty_sec_tolerance_range_math_op'].' '.$row_for_defining_process['water_absorption_a_wash_thirty_sec_tolerance_value'].' '.$row_for_defining_process['uom_of_water_absorption_a_wash_thirty_sec'], "1", "0","L");
                              $pdf->SetTextColor(194,8,8);

                              $pdf->Cell(15,5,"Fail", "1", "0","C");
                              $pdf->SetTextColor(0,0,0);
                              $pdf->Ln();
							  
                           }

                              
                        }    /*End of if($row_for_defining_process['water_absorption_a_wash_thirty_sec_max_value']<>0)*/


					 }   /*End of  if (in_array($row['id'], ['33', '109', '78', '237', '170']))*/
                     if (in_array($row['id'], ['35']))
					 {
                        
                        if($row_for_defining_process['wicking_test_max_value']<>0 && $row_for_qc['wicking_test_value']<>0)
                        {

                           $total_test++;
                           if($row_for_defining_process['wicking_test_min_value']<=$row_for_qc['wicking_test_value'] && $row_for_defining_process['wicking_test_max_value']>=$row_for_qc['wicking_test_value'])
                           {
                              $p++;
                              $pdf->Cell(124,5,$row['test_name_method'],"1", "0","L");
                              $pdf->Cell(21,5,$row_for_qc['wicking_test_value'].' ' .$row_for_defining_process['uom_of_wicking_test'], "1", "0","L");
                              $pdf->Cell(30,5,$row_for_defining_process['wicking_test_tol_range_math_op'].' '.$row_for_defining_process['wicking_test_tolerance_value'].' '.$row_for_defining_process['uom_of_wicking_test'], "1", "0","L");
                              $pdf->Cell(15,5,"Pass", "1", "0","C");
                              $pdf->SetTextColor(0,0,0);
                              $pdf->Ln();
                           }
                           else {
                              $f++;
                              $pdf->Cell(124,5,$row['test_name_method'],"1", "0","L");
                              $pdf->Cell(21,5,$row_for_qc['wicking_test_value'].' ' .$row_for_defining_process['uom_of_wicking_test'], "1", "0","L");
                              $pdf->Cell(30,5,$row_for_defining_process['wicking_test_tol_range_math_op'].' '.$row_for_defining_process['wicking_test_tolerance_value'].' '.$row_for_defining_process['uom_of_wicking_test'], "1", "0","L");
                              $pdf->SetTextColor(194,8,8);

                              $pdf->Cell(15,5,"Fail", "1", "0","C");
                              $pdf->SetTextColor(0,0,0);
                              $pdf->Ln();
							 
                           }

                            
                        }    /*End of if($row_for_defining_process['wicking_test_max_value']<>0)*/

					 }   /*End of if (in_array($row['id'], ['35', '80']))*/




					 if (in_array($row['id'], ['36']))
					 {
                       if($row_for_defining_process['spirality_value_max_value']<>0 && $row_for_qc['spirality_value']<>0)
                        {
		                     $total_test++;
                           
                           if($row_for_defining_process['spirality_value_tolerance_range_math_operator'] == '≥')
                           {
                              $spirality_value_tolerance_range_math_operator = $pdf->Image('../img/greater_equal.png',156, $pdf->GetY()+1.5, 1.7).'   ';
                           }
                           else if($row_for_defining_process['spirality_value_tolerance_range_math_operator'] == '≤')
                           {
                              $spirality_value_tolerance_range_math_operator = $pdf->Image('../img/less_equal.png',156, $pdf->GetY()+1.5, 1.7).'   ';
                           }
                           else if($row_for_defining_process['spirality_value_tolerance_range_math_operator'] == '>')
                           {
                              $spirality_value_tolerance_range_math_operator = '>';
                           }
                           else if($row_for_defining_process['spirality_value_tolerance_range_math_operator'] == '<')
                           {
                              $spirality_value_tolerance_range_math_operator = '<';
                           }

		                     if($row_for_defining_process['spirality_value_min_value']<=$row_for_qc['spirality_value'] && $row_for_defining_process['spirality_value_max_value']>=$row_for_qc['spirality_value_value'])
		                     {
		                        $p++;
                                $pdf->Cell(124,5,$row['test_name_method'],"1", "0","L");
                                $pdf->Cell(21,5,$row_for_qc['spirality_value'].' ' .$row_for_defining_process['uom_of_spirality_value'], "1", "0","L");
                                $pdf->Cell(30,5,$spirality_value_tolerance_range_math_operator.' '.$row_for_defining_process['spirality_value_tolerance_value'].' '.$row_for_defining_process['uom_of_spirality_value'], "1", "0","L");
                                $pdf->Cell(15,5,"Pass", "1", "0","C");
                                $pdf->SetTextColor(0,0,0);
                                $pdf->Ln();
		                     }
		                     else {
		                        $f++;
                                $pdf->Cell(124,5,$row['test_name_method'],"1", "0","L");
                                $pdf->Cell(21,5,$row_for_qc['spirality_value'].' ' .$row_for_defining_process['uom_of_spirality_value'], "1", "0","L");
                                $pdf->Cell(30,5,$spirality_value_tolerance_range_math_operator.' '.$row_for_defining_process['spirality_value_tolerance_value'].' '.$row_for_defining_process['uom_of_spirality_value'], "1", "0","L");
                                $pdf->SetTextColor(194,8,8);

                                $pdf->Cell(15,5,"Fail", "1", "0","C");
                                $pdf->SetTextColor(0,0,0);
                                $pdf->Ln();
								
		                     }

		                   
		                  }   /*End of ($row_for_defining_process['spirality_value_max_value']<>0) */
					 }  /* End of if (in_array($row['id'], ['36', '190', '81', '163', '214']))*/
                   

                   if (in_array($row['id'], ['37']))
					 { 

	                     if($row_for_defining_process['smoothness_appearance_max_value']<>0 && $row_for_qc['smoothness_appearance_value']<>0)
	                        {
	                           $total_test++;
                              
		                           if($row_for_defining_process['smoothness_appearance_min_value']<=$row_for_qc['smoothness_appearance_value'] && $row_for_defining_process['smoothness_appearance_max_value']>=$row_for_qc['smoothness_appearance_value'])
				                     {
				                        $p++;
										 $pdf->Cell(124,5,$row['test_name_method'],"1", "0","L");
                                        $pdf->Cell(21,5,$row_for_qc['smoothness_appearance_value'].' ' .$row_for_defining_process['uom_of_smoothness_appearance'], "1", "0","L");
                                        $pdf->Cell(30,5,$row_for_defining_process['smoothness_appearance_tolerance_range_math_op'].' '.$row_for_defining_process['smoothness_appearance_tolerance_value'].' '.$row_for_defining_process['uom_of_smoothness_appearance'], "1", "0","L");
                                        $pdf->Cell(15,5,"Pass", "1", "0","C");
                                        $pdf->SetTextColor(0,0,0);
                                        $pdf->Ln();
				                     }
				                     else {
				                        $f++;
                                        $pdf->Cell(124,5,$row['test_name_method'],"1", "0","L");
                                        $pdf->Cell(21,5,$row_for_qc['smoothness_appearance_value'].' ' .$row_for_defining_process['uom_of_smoothness_appearance'], "1", "0","L");
                                        $pdf->Cell(30,5,$row_for_defining_process['smoothness_appearance_tolerance_range_math_op'].' '.$row_for_defining_process['smoothness_appearance_tolerance_value'].' '.$row_for_defining_process['uom_of_smoothness_appearance'], "1", "0","L");
                                        $pdf->SetTextColor(194,8,8);

                                        $pdf->Cell(15,5,"Fail", "1", "0","C");
                                        $pdf->SetTextColor(0,0,0);
                                        $pdf->Ln();
										
				                     }

				                  
				           }  /*ENd of ($row_for_defining_process['smoothness_appearance_max_value']<>0) */

	                 }   /*End of if (in_array($row['id'], ['37', '282', '82', '37', '267']))*/


                     if (in_array($row['id'], ['38']))
					{ 

                       if($row_for_defining_process['print_duribility_m_s_c_15_value']<>0 && $row_for_qc['print_duribility_value']<>0)    
                        {
                            $pdf->Cell(124,5,$row['test_name_method'],"1", "0","L");
                            $pdf->Cell(21,5,$row_for_qc['print_duribility_value'], "1", "0","L");
                            $pdf->Cell(30,5,$row_for_defining_process['print_duribility_m_s_c_15_value'], "1", "0","L");
                            $pdf->Cell(15,5,"Pass", "1", "0","C");
                            $pdf->SetTextColor(0,0,0);
                            $pdf->Ln();
		                  
		                }    /*End of if($row_for_defining_process['print_duribility_m_s_c_15_value']<>0)*/


					 }  /*End of if (in_array($row['id'], ['37', '282', '82', '37', '267']))*/  
                     

                      if (in_array($row['id'], ['39']))
					 { 
                        if($row_for_defining_process['iron_ability_of_woven_fabric_max_value']<>0 && $row_for_qc['iron_ability_of_woven_fabric_value']<>0)
                        {
                           $total_test++;
                           if($row_for_defining_process['iron_ability_of_woven_fabric_min_value']<=$row_for_qc['iron_ability_of_woven_fabric_value'] && $row_for_defining_process['iron_ability_of_woven_fabric_max_value']>=$row_for_qc['iron_ability_of_woven_fabric_value'])
                           {
								$p++;
								 $pdf->Cell(124,5,$row['test_name_method'],"1", "0","L");
                              $pdf->Cell(21,5,$row_for_qc['iron_ability_of_woven_fabric_value'].' ' .$row_for_defining_process['uom_of_iron_ability_of_woven_fabric'], "1", "0","L");
                              $pdf->Cell(30,5,$row_for_defining_process['iron_ability_of_woven_fabric_tolerance_range_math_op'].' '.$row_for_defining_process['iron_ability_of_woven_fabric_tolerance_value'].' '.$row_for_defining_process['uom_of_iron_ability_of_woven_fabric'], "1", "0","L");
                              $pdf->Cell(15,5,"Pass", "1", "0","C");
                              $pdf->SetTextColor(0,0,0);
                              $pdf->Ln();
                           }
                           else {
                              $f++;
                              $pdf->Cell(124,5,$row['test_name_method'],"1", "0","L");
                              $pdf->Cell(21,5,$row_for_qc['iron_ability_of_woven_fabric_value'].' ' .$row_for_defining_process['uom_of_iron_ability_of_woven_fabric'], "1", "0","L");
                              $pdf->Cell(30,5,$row_for_defining_process['iron_ability_of_woven_fabric_tolerance_range_math_op'].' '.$row_for_defining_process['iron_ability_of_woven_fabric_tolerance_value'].' '.$row_for_defining_process['uom_of_iron_ability_of_woven_fabric'], "1", "0","L");
                              $pdf->SetTextColor(194,8,8);

                              $pdf->Cell(15,5,"Fail", "1", "0","C");
                              $pdf->SetTextColor(0,0,0);
                              $pdf->Ln();
							 
                           }

                         
                       }  


                     }   /*End of if (in_array($row['id'], ['38', '234', '83']))*/



                    if (in_array($row['id'], ['40']))
					 { 

					 	 if($row_for_defining_process['color_fastess_to_artificial_daylight_max_value']<>0 && $row_for_qc['cf_to_artificial_day_light_value']<>0)
		                   {
		                           $total_test++;
                                
                                 if($row_for_defining_process['color_fastess_to_artificial_daylight_tolerance_range_math_op'] == '≥')
                                 {
                                    $color_fastess_to_artificial_daylight_tolerance_range_math_op = $pdf->Image('../img/greater_equal.png',156, $pdf->GetY()+1.5, 1.7).'   ';
                                    
                                    // $pdf->SetFont('Symbol','',8);
                                    // $color_fastess_to_artificial_daylight_tolerance_range_math_op = chr(179);
                                    // $pdf->Cell(30,5,$color_fastess_to_artificial_daylight_tolerance_range_math_op.' '.$row_for_defining_process['color_fastess_to_artificial_daylight_tolerance_value'].' '.$row_for_defining_process['uom_of_color_fastess_to_artificial_daylight'], "1", "0","L");
                                    // $pdf->SetFont('Arial','',8);
                                 }
                                 else if($row_for_defining_process['color_fastess_to_artificial_daylight_tolerance_range_math_op'] == '≤')
                                 {
                                    $color_fastess_to_artificial_daylight_tolerance_range_math_op = $pdf->Image('../img/less_equal.png',156, $pdf->GetY()+1.5, 1.7).'   ';
                                 }
                                 else if($row_for_defining_process['color_fastess_to_artificial_daylight_tolerance_range_math_op'] == '>')
                                 {
                                    $color_fastess_to_artificial_daylight_tolerance_range_math_op = '>';
                                 }
                                 else if($row_for_defining_process['color_fastess_to_artificial_daylight_tolerance_range_math_op'] == '<')
                                 {
                                    $color_fastess_to_artificial_daylight_tolerance_range_math_op = '<';
                                 }



                                 if($customer_type == 'american')
                                 {
                                    $color_fastess_to_artificial_daylight_tolerance_value = $row_for_defining_process['color_fastess_to_artificial_daylight_tolerance_value'];
                                    $cf_to_artificial_day_light_value = $row_for_qc['cf_to_artificial_day_light_value'];
            
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
                                 }
             
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
                                    }							 // for test result
            
                              }
            




		                           if($row_for_defining_process['color_fastess_to_artificial_daylight_min_value']<=$row_for_qc['cf_to_artificial_day_light_value'] && $row_for_defining_process['color_fastess_to_artificial_daylight_max_value']>=$row_for_qc['cf_to_artificial_day_light_value'])
		                           {
		                                $p++;
									           $pdf->Cell(124,5,$row['test_name_method'],"1", "0","L");
                                      $pdf->Cell(21,5,$cf_to_artificial_day_light_value.' ' .$row_for_defining_process['uom_of_color_fastess_to_artificial_daylight'], "1", "0","L");
                                      $pdf->Cell(30,5,$color_fastess_to_artificial_daylight_tolerance_range_math_op.' '.$color_fastess_to_artificial_daylight_tolerance_value.' '.$row_for_defining_process['uom_of_color_fastess_to_artificial_daylight'], "1", "0","L");
                                      $pdf->Cell(15,5,"Pass", "1", "0","C");
                                      $pdf->SetTextColor(0,0,0);
                                      $pdf->Ln();
		                           }
		                           else {
		                              $f++;
                                      $pdf->Cell(124,5,$row['test_name_method'],"1", "0","L");
                                      $pdf->Cell(21,5,$cf_to_artificial_day_light_value.' ' .$row_for_defining_process['uom_of_color_fastess_to_artificial_daylight'], "1", "0","L");
                                      $pdf->Cell(30,5,$color_fastess_to_artificial_daylight_tolerance_range_math_op.' '.$color_fastess_to_artificial_daylight_tolerance_value.' '.$row_for_defining_process['uom_of_color_fastess_to_artificial_daylight'], "1", "0","L");
                                      $pdf->SetTextColor(194,8,8);

                                      $pdf->Cell(15,5,"Fail", "1", "0","C");
                                      $pdf->SetTextColor(0,0,0);
                                      $pdf->Ln();
		                             
		                           }

		                         
		                  }  /* End of  if($row_for_defining_process['color_fastess_to_artificial_daylight_max_value']<>0)*/
                     
                     }   /*End of if (in_array($row['id'], ['40', '159', '133', '86', '182', '238','297', '220', '172', '198', '174', '270', '243', '111']))*/


                    if (in_array($row['id'], ['41']))
					 { 
                       if($row_for_defining_process['moisture_content_max_value']<>0 && $row_for_qc['moisture_content_value']<>0)
		                   {
		                           $total_test++;
		                           if($row_for_defining_process['moisture_content_min_value']<=$row_for_qc['moisture_content_value'] && $row_for_defining_process['moisture_content_max_value']>=$row_for_qc['moisture_content_value'])
		                           {
		                              $p++;
                                      $pdf->Cell(124,5,$row['test_name_method'],"1", "0","L");
                                      $pdf->Cell(21,5,$row_for_qc['moisture_content_value'].' ' .$row_for_defining_process['uom_of_moisture_content'], "1", "0","L");
                                      $pdf->Cell(30,5,$row_for_defining_process['moisture_content_tolerance_range_math_op'].' '.$row_for_defining_process['moisture_content_tolerance_value'].' '.$row_for_defining_process['uom_of_moisture_content'], "1", "0","L");
                                      $pdf->Cell(15,5,"Pass", "1", "0","C");
                                      $pdf->SetTextColor(0,0,0);
                                      $pdf->Ln();
		                           }
		                           else {
		                              $f++;
                                      $pdf->Cell(124,5,$row['test_name_method'],"1", "0","L");
                                      $pdf->Cell(21,5,$row_for_qc['moisture_content_value'].' ' .$row_for_defining_process['uom_of_moisture_content'], "1", "0","L");
                                      $pdf->Cell(30,5,$row_for_defining_process['moisture_content_tolerance_range_math_op'].' '.$row_for_defining_process['moisture_content_tolerance_value'].' '.$row_for_defining_process['uom_of_moisture_content'], "1", "0","L");
                                      $pdf->SetTextColor(194,8,8);

                                      $pdf->Cell(15,5,"Fail", "1", "0","C");
                                      $pdf->SetTextColor(0,0,0);
                                      $pdf->Ln();
									  
		                           }
		                  }  

                     }  /*End of  if (in_array($row['id'], ['41', '87']))*/


                    if (in_array($row['id'], ['42']))
					  { 
                        if($row_for_defining_process['evaporation_rate_quick_drying_max_value']<>0 && $row_for_qc['evaporation_rate_quick_drying_value']<>0)
                          {
                           $total_test++;
                           if($row_for_defining_process['evaporation_rate_quick_drying_min_value']<=$row_for_qc['evaporation_rate_quick_drying_value'] && $row_for_defining_process['evaporation_rate_quick_drying_max_value']>=$row_for_qc['evaporation_rate_quick_drying_value'])
                           {
                              $p++;
							  $pdf->Cell(124,5,$row['test_name_method'],"1", "0","L");
                              $pdf->Cell(21,5,$row_for_qc['evaporation_rate_quick_drying_value'].' ' .$row_for_defining_process['uom_of_evaporation_rate_quick_drying'], "1", "0","L");
                              $pdf->Cell(30,5,$row_for_defining_process['evaporation_rate_quick_drying_tolerance_range_math_op'].' '.$row_for_defining_process['evaporation_rate_quick_drying_tolerance_value'].' '.$row_for_defining_process['uom_of_evaporation_rate_quick_drying'], "1", "0","L");
                              $pdf->Cell(15,5,"Pass", "1", "0","C");
                              $pdf->SetTextColor(0,0,0);
                              $pdf->Ln();
                           }
                           else {
                              $f++;
                              $pdf->Cell(124,5,$row['test_name_method'],"1", "0","L");
                              $pdf->Cell(21,5,$row_for_qc['evaporation_rate_quick_drying_value'].' ' .$row_for_defining_process['uom_of_evaporation_rate_quick_drying'], "1", "0","L");
                              $pdf->Cell(30,5,$row_for_defining_process['evaporation_rate_quick_drying_tolerance_range_math_op'].' '.$row_for_defining_process['evaporation_rate_quick_drying_tolerance_value'].' '.$row_for_defining_process['uom_of_evaporation_rate_quick_drying'], "1", "0","L");
                              $pdf->SetTextColor(194,8,8);

                              $pdf->Cell(15,5,"Fail", "1", "0","C");
                              $pdf->SetTextColor(0,0,0);
                              $pdf->Ln();
							 
                           }

                       
                          }  
                      }  /*End of  if (in_array($row['id'], ['42', '257', '88']))*/


                    if (in_array($row['id'], ['43']))
					  {
                           if($row_for_defining_process['percentage_of_total_cotton_content_max_value']<>0 && $row_for_qc['total_cotton_content_value']<>0)
                          {
                           $total_test++;
                           
                           $content_of_total_cotton_content = urlencode($row_for_defining_process['percentage_of_total_cotton_content_tolerance_range_math_operator']);
                           $percentage_of_total_cotton_content_tolerance_range_math_operator = urldecode($pdf->sp_character($content_of_total_cotton_content));

                           if($row_for_defining_process['percentage_of_total_cotton_content_min_value']<=$row_for_qc['total_cotton_content_value'] && $row_for_defining_process['percentage_of_total_cotton_content_max_value']>=$row_for_qc['total_cotton_content_value'])
                           {
                              $p++;
							         $pdf->Cell(124,5,$row['test_name_method'].'(Total Cotton)',"1", "0","L");
                              $pdf->Cell(21,5,$row_for_qc['total_cotton_content_value'].' ' .$row_for_defining_process['uom_of_percentage_of_total_cotton_content'], "1", "0","L");
                              $pdf->Cell(30,5,$row_for_defining_process['percentage_of_total_cotton_content_value'].' '.$row_for_defining_process['uom_of_percentage_of_total_cotton_content'].' ('.$percentage_of_total_cotton_content_tolerance_range_math_operator.'  '.$row_for_defining_process['percentage_of_total_cotton_content_tolerance_value']." %)", "1", "0","L");
                              $pdf->Cell(15,5,"Pass", "1", "0","C");
                              $pdf->SetTextColor(0,0,0);
                              $pdf->Ln();
							 
                           }
                           else {
                              $f++;
                              $pdf->Cell(124,5,$row['test_name_method'].'(Total Cotton)',"1", "0","L");
                              $pdf->Cell(21,5,$row_for_qc['total_cotton_content_value'].' ' .$row_for_defining_process['uom_of_percentage_of_total_cotton_content'], "1", "0","L");
                              $pdf->Cell(30,5,$row_for_defining_process['percentage_of_total_cotton_content_value'].' '.$row_for_defining_process['uom_of_percentage_of_total_cotton_content'].' ('.$percentage_of_total_cotton_content_tolerance_range_math_operator.'  '.$row_for_defining_process['percentage_of_total_cotton_content_tolerance_value']." %)", "1", "0","L");
                              $pdf->SetTextColor(194,8,8);

                              $pdf->Cell(15,5,"Fail", "1", "0","C");
                              $pdf->SetTextColor(0,0,0);
                              $pdf->Ln();
							 
                           }

                        
                        }

                        if($row_for_defining_process['percentage_of_total_polyester_content_max_value']<>0 && $row_for_qc['total_total_Polyester_content_value']<>0)
                       {
                           $total_test++;

                           $content_total_polyster = urlencode($row_for_defining_process['percentage_of_total_polyester_content_tolerance_range_math_op']);
                           $percentage_of_total_polyester_content_tolerance_range_math_op = urldecode($pdf->sp_character($content_total_polyster));


                           if($row_for_defining_process['percentage_of_total_polyester_content_min_value']<=$row_for_qc['total_total_Polyester_content_value'] && $row_for_defining_process['percentage_of_total_polyester_content_max_value']>=$row_for_qc['total_total_Polyester_content_value'])
                           {
                              $p++;
                              $pdf->Cell(124,5,$row['test_name_method'].'(Total Polyester)',"1", "0","L");
                              $pdf->Cell(21,5,$row_for_qc['total_total_Polyester_content_value'].' ' .$row_for_defining_process['uom_of_percentage_of_total_polyester_content'], "1", "0","L");
                              $pdf->Cell(30,5,$row_for_defining_process['percentage_of_total_polyester_content_value'].' '.$row_for_defining_process['uom_of_percentage_of_total_polyester_content'].' ('.$percentage_of_total_polyester_content_tolerance_range_math_op." %)", "1", "0","L");
                              $pdf->Cell(15,5,"Pass", "1", "0","C");
                              $pdf->SetTextColor(0,0,0);
                              $pdf->Ln();
                           }
                           else {
                              $f++;
                              $pdf->Cell(124,5,$row['test_name_method'].'(Total Polyester)',"1", "0","L");
                              $pdf->Cell(21,5,$row_for_qc['total_total_Polyester_content_value'].' ' .$row_for_defining_process['uom_of_percentage_of_total_polyester_content'], "1", "0","L");
                              $pdf->Cell(30,5,$row_for_defining_process['percentage_of_total_polyester_content_value'].' '.$row_for_defining_process['uom_of_percentage_of_total_polyester_content'].' ('.$percentage_of_total_polyester_content_tolerance_range_math_op." %)", "1", "0","L");
                              $pdf->SetTextColor(194,8,8);

                              $pdf->Cell(15,5,"Fail", "1", "0","C");
                              $pdf->SetTextColor(0,0,0);
                              $pdf->Ln();
							 
                           }

                        
                       }  



                        if($row_for_defining_process['percentage_of_total_other_fiber_content_max_value']<>0 && $row_for_qc['total_other_fiber_value']<>0)
                       {
                           $total_test++;

                           $content_total_other_fiber = urlencode($row_for_defining_process['percentage_of_total_other_fiber_content_tolerance_range_math_op']);
                           $percentage_of_total_other_fiber_content_tolerance_range_math_op = urldecode($pdf->sp_character($content_total_other_fiber));


                           if($row_for_defining_process['percentage_of_total_other_fiber_content_min_value']<=$row_for_qc['total_other_fiber_value'] && $row_for_defining_process['percentage_of_total_other_fiber_content_max_value']>=$row_for_qc['total_other_fiber_value'])
                           {
                              $p++;
                              $pdf->Cell(124,5,$row['test_name_method'].'(Total Other Fiber)',"1", "0","L");
                              $pdf->Cell(21,5,$row_for_qc['total_other_fiber_value'].' ' .$row_for_defining_process['uom_of_percentage_of_total_other_fiber_content'], "1", "0","L");
                              $pdf->Cell(30,5,$row_for_defining_process['percentage_of_total_other_fiber_content_value'].' '.$row_for_defining_process['uom_of_percentage_of_total_other_fiber_content'].' ('.$percentage_of_total_other_fiber_content_tolerance_range_math_op.'  '.$row_for_defining_process['percentage_of_total_other_fiber_content_tolerance_value']." %)", "1", "0","L");
                              $pdf->Cell(15,5,"Pass", "1", "0","C");
                              $pdf->SetTextColor(0,0,0);
                              $pdf->Ln();
						 }
						 else {
							$f++;
                              $pdf->Cell(124,5,$row['test_name_method'].'(Total Other Fiber)',"1", "0","L");
                              $pdf->Cell(21,5,$row_for_qc['total_other_fiber_value'].' ' .$row_for_defining_process['uom_of_percentage_of_total_other_fiber_content'], "1", "0","L");
                              $pdf->Cell(30,5,$row_for_defining_process['percentage_of_total_other_fiber_content_value'].' '.$row_for_defining_process['uom_of_percentage_of_total_other_fiber_content'].' ('.$percentage_of_total_other_fiber_content_tolerance_range_math_op.'  '.$row_for_defining_process['percentage_of_total_other_fiber_content_tolerance_value']." %)", "1", "0","L");
                              $pdf->SetTextColor(194,8,8);

                              $pdf->Cell(15,5,"Fail", "1", "0","C");
                              $pdf->SetTextColor(0,0,0);
                              $pdf->Ln();
							
                           }

                    
                       }


                       if($row_for_defining_process['percentage_of_warp_cotton_content_max_value']<>0 && $row_for_qc['warp_cotton_content_value']<>0)
                       {
                           $total_test++;

                           $content_warp_cotton = urlencode($row_for_defining_process['percentage_of_warp_cotton_content_tolerance_range_math_operator']);
                           $percentage_of_warp_cotton_content_tolerance_range_math_operator = urldecode($pdf->sp_character($content_warp_cotton));


                           if($row_for_defining_process['percentage_of_warp_cotton_content_min_value']<=$row_for_qc['warp_cotton_content_value'] && $row_for_defining_process['percentage_of_warp_cotton_content_max_value']>=$row_for_qc['warp_cotton_content_value'])
                           {
                              $p++;
                              $pdf->Cell(124,5,$row['test_name_method'].'(Warp Cotton)',"1", "0","L");
                              $pdf->Cell(21,5,$row_for_qc['warp_cotton_content_value'].' ' .$row_for_defining_process['uom_of_percentage_of_warp_cotton_content'], "1", "0","L");
                              $pdf->Cell(30,5,$row_for_defining_process['percentage_of_warp_cotton_content_value'].' '.$row_for_defining_process['uom_of_percentage_of_warp_cotton_content'].' ('.$percentage_of_warp_cotton_content_tolerance_range_math_operator.'  '.$row_for_defining_process['percentage_of_warp_cotton_content_tolerance_value']." %)", "1", "0","L");
                              $pdf->Cell(15,5,"Pass", "1", "0","C");
                              $pdf->SetTextColor(0,0,0);
                              $pdf->Ln();
                           }
                           else {
                              $f++;
                              $pdf->Cell(124,5,$row['test_name_method'].'(Warp Cotton)',"1", "0","L");
                              $pdf->Cell(21,5,$row_for_qc['warp_cotton_content_value'].' ' .$row_for_defining_process['uom_of_percentage_of_warp_cotton_content'], "1", "0","L");
                              $pdf->Cell(30,5,$row_for_defining_process['percentage_of_warp_cotton_content_value'].' '.$row_for_defining_process['uom_of_percentage_of_warp_cotton_content'].' ('.$percentage_of_warp_cotton_content_tolerance_range_math_operator.'  '.$row_for_defining_process['percentage_of_warp_cotton_content_tolerance_value']." %)", "1", "0","L");
                              $pdf->SetTextColor(194,8,8);

                              $pdf->Cell(15,5,"Fail", "1", "0","C");
                              $pdf->SetTextColor(0,0,0);
                              $pdf->Ln();
							 
                           }

                        
                       }  


                      if($row_for_defining_process['percentage_of_warp_polyester_content_max_value']<>0 && $row_for_qc['warp_Polyester_content_value']<>0)
                       {
                           $total_test++;

                           
                           $content_warp_polyster = urlencode($row_for_defining_process['percentage_of_warp_polyester_content_tolerance_range_math_op']);
                           $percentage_of_warp_polyester_content_tolerance_range_math_op = urldecode($pdf->sp_character($content_warp_polyster));


                           if($row_for_defining_process['percentage_of_warp_polyester_content_min_value']<=$row_for_qc['warp_Polyester_content_value'] && $row_for_defining_process['percentage_of_warp_polyester_content_max_value']>=$row_for_qc['warp_Polyester_content_value'])
                           {
                              $p++;
							         $pdf->Cell(124,5,$row['test_name_method'].'(Warp Polyester)',"1", "0","L");
                              $pdf->Cell(21,5,$row_for_qc['warp_Polyester_content_value'].' ' .$row_for_defining_process['uom_of_percentage_of_warp_polyester_content'], "1", "0","L");
                              $pdf->Cell(30,5,$row_for_defining_process['percentage_of_warp_polyester_content_value'].' '.$row_for_defining_process['uom_of_percentage_of_warp_polyester_content'].' ('.$percentage_of_warp_polyester_content_tolerance_range_math_op.'  '.$row_for_defining_process['percentage_of_warp_polyester_content_tolerance_value']." %)", "1", "0","L");
                              $pdf->Cell(15,5,"Pass", "1", "0","C");
                              $pdf->SetTextColor(0,0,0);
                              $pdf->Ln();
                           }
                           else {
                              $f++;
                              $pdf->Cell(124,5,$row['test_name_method'].'(Warp Polyester)',"1", "0","L");
                              $pdf->Cell(21,5,$row_for_qc['warp_Polyester_content_value'].' ' .$row_for_defining_process['uom_of_percentage_of_warp_polyester_content'], "1", "0","L");
                              $pdf->Cell(30,5,$row_for_defining_process['percentage_of_warp_polyester_content_value'].' '.$row_for_defining_process['uom_of_percentage_of_warp_polyester_content'].' ('.$percentage_of_warp_polyester_content_tolerance_range_math_op.'  '.$row_for_defining_process['percentage_of_warp_polyester_content_tolerance_value']." %)", "1", "0","L");
                              $pdf->SetTextColor(194,8,8);

                              $pdf->Cell(15,5,"Fail", "1", "0","C");
                              $pdf->SetTextColor(0,0,0);
                              $pdf->Ln();
							
                           }

                        
                       }  


                       if($row_for_defining_process['percentage_of_warp_other_fiber_content_max_value']<>0 && $row_for_qc['warp_other_fiber_value']<>0)
                       {
                           $total_test++;

                           $content_warp_other_fiber = urlencode($row_for_defining_process['percentage_of_warp_other_fiber_content_tolerance_range_math_op']);
                           $percentage_of_warp_other_fiber_content_tolerance_range_math_op = urldecode($pdf->sp_character($content_warp_other_fiber));


                           if($row_for_defining_process['percentage_of_warp_other_fiber_content_min_value']<=$row_for_qc['warp_other_fiber_value'] && $row_for_defining_process['percentage_of_warp_other_fiber_content_max_value']>=$row_for_qc['warp_other_fiber_value'])
                           {
                              $p++;
                              $pdf->Cell(124,5,$row['test_name_method'].'(Warp Other Fiber)',"1", "0","L");
                              $pdf->Cell(21,5,$row_for_qc['warp_other_fiber_value'].' ' .$row_for_defining_process['uom_of_percentage_of_warp_other_fiber_content'], "1", "0","L");
                              $pdf->Cell(30,5,$row_for_defining_process['percentage_of_warp_other_fiber_content_value'].' '.$row_for_defining_process['uom_of_percentage_of_warp_other_fiber_content'].' ('.$percentage_of_warp_other_fiber_content_tolerance_range_math_op.'  '.$row_for_defining_process['percentage_of_warp_other_fiber_content_tolerance_value']." %)", "1", "0","L");
                              $pdf->Cell(15,5,"Pass", "1", "0","C");
                              $pdf->SetTextColor(0,0,0);
                              $pdf->Ln();
							
                           }
                           else {
                              $f++;
                              $pdf->Cell(124,5,$row['test_name_method'].'(Warp Other Fiber)',"1", "0","L");
                              $pdf->Cell(21,5,$row_for_qc['warp_other_fiber_value'].' ' .$row_for_defining_process['uom_of_percentage_of_warp_other_fiber_content'], "1", "0","L");
                              $pdf->Cell(30,5,$row_for_defining_process['percentage_of_warp_other_fiber_content_value'].' '.$row_for_defining_process['uom_of_percentage_of_warp_other_fiber_content'].' ('.$percentage_of_warp_other_fiber_content_tolerance_range_math_op.'  '.$row_for_defining_process['percentage_of_warp_other_fiber_content_tolerance_value']." %)", "1", "0","L");
                              $pdf->SetTextColor(194,8,8);

                              $pdf->Cell(15,5,"Fail", "1", "0","C");
                              $pdf->SetTextColor(0,0,0);
                              $pdf->Ln();
							
                           }

                        
                       }  


                       if($row_for_defining_process['percentage_of_weft_cotton_content_max_value']<>0 && $row_for_qc['weft_cotton_content_value']<>0)
                       {
                           $total_test++;

                           $content_weft_cotton = urlencode($row_for_defining_process['percentage_of_weft_cotton_content_tolerance_range_math_op']);
                           $percentage_of_weft_cotton_content_tolerance_range_math_op = urldecode($pdf->sp_character($content_weft_cotton));


                           if($row_for_defining_process['percentage_of_weft_cotton_content_min_value']<=$row_for_qc['weft_cotton_content_value'] && $row_for_defining_process['percentage_of_weft_cotton_content_max_value']>=$row_for_qc['weft_cotton_content_value'])
                           {
                              $p++;
							         $pdf->Cell(124,5,$row['test_name_method'].'(Weft Cotton)',"1", "0","L");
                              $pdf->Cell(21,5,$row_for_qc['weft_cotton_content_value'].' ' .$row_for_defining_process['uom_of_percentage_of_weft_cotton_content'], "1", "0","L");
                              $pdf->Cell(30,5,$row_for_defining_process['percentage_of_weft_cotton_content_value'].' '.$row_for_defining_process['uom_of_percentage_of_weft_cotton_content'].' ('.$percentage_of_weft_cotton_content_tolerance_range_math_op.'  '.$row_for_defining_process['percentage_of_weft_cotton_content_tolerance_value']." %)", "1", "0","L");
                              $pdf->Cell(15,5,"Pass", "1", "0","C");
                              $pdf->SetTextColor(0,0,0);
                              $pdf->Ln();
                           }
                           else {
                              $f++;
                              $pdf->Cell(124,5,$row['test_name_method'].'(Weft Cotton)',"1", "0","L");
                              $pdf->Cell(21,5,$row_for_qc['weft_cotton_content_value'].' ' .$row_for_defining_process['uom_of_percentage_of_weft_cotton_content'], "1", "0","L");
                              $pdf->Cell(30,5,$row_for_defining_process['percentage_of_weft_cotton_content_value'].' '.$row_for_defining_process['uom_of_percentage_of_weft_cotton_content'].' ('.$percentage_of_weft_cotton_content_tolerance_range_math_op.'  '.$row_for_defining_process['percentage_of_weft_cotton_content_tolerance_value']." %)", "1", "0","L");
                              $pdf->SetTextColor(194,8,8);

                              $pdf->Cell(15,5,"Fail", "1", "0","C");
                              $pdf->SetTextColor(0,0,0);
                              $pdf->Ln();
							 
                           }

                        
                       } 


                        if($row_for_defining_process['percentage_of_weft_polyester_content_max_value']<>0 && $row_for_qc['weft_Polyester_content_value']<>0)
                       {
                           $total_test++;

                           $content_weft_polyester = urlencode($row_for_defining_process['percentage_of_weft_polyester_content_tolerance_range_math_op']);
                           $percentage_of_weft_polyester_content_tolerance_range_math_op = urldecode($pdf->sp_character($content_weft_polyester));


                           if($row_for_defining_process['percentage_of_weft_polyester_content_min_value']<=$row_for_qc['weft_Polyester_content_value'] && $row_for_defining_process['percentage_of_weft_polyester_content_max_value']>=$row_for_qc['weft_Polyester_content_value'])
                           {
                              $p++;
							  $pdf->Cell(124,5,$row['test_name_method'].'(Weft Polyester)',"1", "0","L");
                              $pdf->Cell(21,5,$row_for_qc['weft_Polyester_content_value'].' ' .$row_for_defining_process['uom_of_percentage_of_weft_polyester_content'], "1", "0","L");
                              $pdf->Cell(30,5,$row_for_defining_process['percentage_of_weft_polyester_content_value'].' '.$row_for_defining_process['uom_of_percentage_of_weft_polyester_content'].' ('.$percentage_of_weft_polyester_content_tolerance_range_math_op.'  '.$row_for_defining_process['percentage_of_weft_polyester_content_tolerance_value']." %)", "1", "0","L");
                              $pdf->Cell(15,5,"Pass", "1", "0","C");
                              $pdf->SetTextColor(0,0,0);
                              $pdf->Ln();
                           }
                           else {
                              $f++;
                              $pdf->Cell(124,5,$row['test_name_method'].'(Weft Polyester)',"1", "0","L");
                              $pdf->Cell(21,5,$row_for_qc['weft_Polyester_content_value'].' ' .$row_for_defining_process['uom_of_percentage_of_weft_polyester_content'], "1", "0","L");
                              $pdf->Cell(30,5,$row_for_defining_process['percentage_of_weft_polyester_content_value'].' '.$row_for_defining_process['uom_of_percentage_of_weft_polyester_content'].' ('.$percentage_of_weft_polyester_content_tolerance_range_math_op.'  '.$row_for_defining_process['percentage_of_weft_polyester_content_tolerance_value']." %)", "1", "0","L");
                              $pdf->SetTextColor(194,8,8);

                              $pdf->Cell(15,5,"Fail", "1", "0","C");
                              $pdf->SetTextColor(0,0,0);
                              $pdf->Ln();
							 
                           }

                        
                       }  

                       if($row_for_defining_process['percentage_of_weft_other_fiber_content_max_value']<>0 && $row_for_qc['weft_other_fiber_value']<>0)
                       {
                           $total_test++;

                           $content_weft_other_fiber = urlencode($row_for_defining_process['percentage_of_weft_other_fiber_content_tolerance_range_math_op']);
                           $percentage_of_weft_other_fiber_content_tolerance_range_math_op = urldecode($pdf->sp_character($content_weft_other_fiber));


                           if($row_for_defining_process['percentage_of_weft_other_fiber_content_min_value']<=$row_for_qc['weft_other_fiber_value'] && $row_for_defining_process['percentage_of_weft_other_fiber_content_max_value']>=$row_for_qc['weft_other_fiber_value'])
                           {
                              $p++;
                              $pdf->Cell(124,5,$row['test_name_method'].'(Weft Other Fiber)',"1", "0","L");
                              $pdf->Cell(21,5,$row_for_qc['weft_other_fiber_value'].' ' .$row_for_defining_process['uom_of_percentage_of_weft_other_fiber_content'], "1", "0","L");
                              $pdf->Cell(30,5,$row_for_defining_process['percentage_of_weft_other_fiber_content_value'].' '.$row_for_defining_process['uom_of_percentage_of_weft_other_fiber_content'].' ('.$percentage_of_weft_other_fiber_content_tolerance_range_math_op.'  '.$row_for_defining_process['percentage_of_weft_other_fiber_content_tolerance_value']." %)", "1", "0","L");
                              $pdf->Cell(15,5,"Pass", "1", "0","C");
                              $pdf->SetTextColor(0,0,0);
                              $pdf->Ln();
                           }
                           else {
                              $f++;
                              $pdf->Cell(124,5,$row['test_name_method'].'(Weft Other Fiber)',"1", "0","L");
                              $pdf->Cell(21,5,$row_for_qc['weft_other_fiber_value'].' ' .$row_for_defining_process['uom_of_percentage_of_weft_other_fiber_content'], "1", "0","L");
                              $pdf->Cell(30,5,$row_for_defining_process['percentage_of_weft_other_fiber_content_value'].' '.$row_for_defining_process['uom_of_percentage_of_weft_other_fiber_content'].' ('.$percentage_of_weft_other_fiber_content_tolerance_range_math_op.'  '.$row_for_defining_process['percentage_of_weft_other_fiber_content_tolerance_value']." %)", "1", "0","L");
                              $pdf->SetTextColor(194,8,8);

                              $pdf->Cell(15,5,"Fail", "1", "0","C");
                              $pdf->SetTextColor(0,0,0);
                              $pdf->Ln();
							 
                           }

                         
                        }  
					}  /*  End of if (in_array($row['id'], ['43', '225', '296', '110', '180', '89']))*/

                    if (in_array($row['id'], ['3']))
					{ 

                  if($row_for_defining_process['test_method_for_appearance_after_wash_fabric'] == 'Fabric (Mock up)')
                  {
						if($row_for_defining_process['appearance_after_washing_fabric_color_change_max_value']<>0 && $row_for_qc['appear_after_wash_fabric_color_change_value']<>0)
						   {
							  $total_test++;

                       if($row_for_defining_process['appearance_after_washing_fabric_color_change_math_op'] == '≥')
                       {
                          $appearance_after_washing_fabric_color_change_math_op = $pdf->Image('../img/greater_equal.png',156, $pdf->GetY()+1.5, 1.7).'   ';
                       }
                       else if($row_for_defining_process['appearance_after_washing_fabric_color_change_math_op'] == '≤')
                       {
                          $appearance_after_washing_fabric_color_change_math_op = $pdf->Image('../img/less_equal.png',156, $pdf->GetY()+1.5, 1.7).'   ';
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



								  if($row_for_defining_process['appearance_after_washing_fabric_color_change_min_value']<=$row_for_qc['appear_after_wash_fabric_color_change_value'] && $row_for_defining_process['appearance_after_washing_fabric_color_change_max_value']>=$row_for_qc['appear_after_wash_fabric_color_change_value'])
									{
									   $p++;
                                       $pdf->Cell(124,5,$row['test_name_method']. ' (Fabric (Color Change))('.$row_for_defining_process['appearance_after_washing_cycle_fabric_wash1'].')',"1", "0","L");
                                       $pdf->Cell(21,5,$appear_after_wash_fabric_color_change_value, "1", "0","L");
                                       $pdf->Cell(30,5,$appearance_after_washing_fabric_color_change_math_op.' '.$appearance_after_washing_fabric_color_change_tolerance_value, "1", "0","L");
                                       $pdf->Cell(15,5,"Pass", "1", "0","C");
                                       $pdf->SetTextColor(0,0,0);
                                       $pdf->Ln();
									}
									else {
									   $f++;
                                       $pdf->Cell(124,5,$row['test_name_method']. ' (Fabric (Color Change))('.$row_for_defining_process['appearance_after_washing_cycle_fabric_wash1'].')',"1", "0","L");
                                       $pdf->Cell(21,5,$appear_after_wash_fabric_color_change_value, "1", "0","L");
                                       $pdf->Cell(30,5,$appearance_after_washing_fabric_color_change_math_op.' '.$appearance_after_washing_fabric_color_change_tolerance_value, "1", "0","L");
                                       $pdf->SetTextColor(194,8,8);

                                       $pdf->Cell(15,5,"Fail", "1", "0","C");
                                       $pdf->SetTextColor(0,0,0);
                                       $pdf->Ln();
									   
									}
	 
						}  /*ENd of ($row_for_defining_process['appearance_after_washing_fabric_color_change_max_value']<>0) */
						
						if($row_for_defining_process['appearance_after_washing_fabric_cross_staining_max_value']<>0 && $row_for_qc['appearance_after_washing_fabric_cross_staining_value']<>0)
						   {
							  $total_test++;

                       if($row_for_defining_process['appearance_after_washing_fabric_cross_staining_math_op'] == '≥')
                       {
                          $appearance_after_washing_fabric_cross_staining_math_op = $pdf->Image('../img/greater_equal.png',156, $pdf->GetY()+1.5, 1.7).'   ';
                       }
                       else if($row_for_defining_process['appearance_after_washing_fabric_cross_staining_math_op'] == '≤')
                       {
                          $appearance_after_washing_fabric_cross_staining_math_op = $pdf->Image('../img/less_equal.png',156, $pdf->GetY()+1.5, 1.7).'   ';
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




								  if($row_for_defining_process['appearance_after_washing_fabric_cross_staining_min_value']<=$row_for_qc['appearance_after_washing_fabric_cross_staining_value'] && $row_for_defining_process['appearance_after_washing_fabric_cross_staining_max_value']>=$row_for_qc['appearance_after_washing_fabric_cross_staining_value'])
									{
									   $p++;
									   $pdf->Cell(124,5,$row['test_name_method']. ' (Fabric (Cross Staining))('.$row_for_defining_process['appearance_after_washing_cycle_fabric_wash1'].')',"1", "0","L");
                                       $pdf->Cell(21,5,$appearance_after_washing_fabric_cross_staining_value, "1", "0","L");
                                       $pdf->Cell(30,5,$appearance_after_washing_fabric_cross_staining_math_op.' '.$appearance_after_washing_fabric_cross_staining_tolerance_value, "1", "0","L");
                                       $pdf->Cell(15,5,"Pass", "1", "0","C");
                                       $pdf->SetTextColor(0,0,0);
                                       $pdf->Ln();
									}
									else {
									   $f++;
                                       $pdf->Cell(124,5,$row['test_name_method']. ' (Fabric (Cross Staining))('.$row_for_defining_process['appearance_after_washing_cycle_fabric_wash1'].')',"1", "0","L");
                                       $pdf->Cell(21,5,$appearance_after_washing_fabric_cross_staining_value, "1", "0","L");
                                       $pdf->Cell(30,5,$appearance_after_washing_fabric_cross_staining_math_op.' '.$appearance_after_washing_fabric_cross_staining_tolerance_value, "1", "0","L");
                                       $pdf->SetTextColor(194,8,8);

                                       $pdf->Cell(15,5,"Fail", "1", "0","C");
                                       $pdf->SetTextColor(0,0,0);
                                       $pdf->Ln();
									  
									}
	 
						}  /*ENd of ($row_for_defining_process['appearance_after_washing_fabric_cross_staining_max_value']<>0) */
						if($row_for_defining_process['appearance_after_washing_fabric_surface_fuzzing_max_value']<>0 && $row_for_qc['appearance_after_washing_fabric_surface_fuzzing_value']<>0)
						   {
							  $total_test++;

                       if($row_for_defining_process['appearance_after_washing_fabric_surface_fuzzing_math_op'] == '≥')
                       {
                          $appearance_after_washing_fabric_surface_fuzzing_math_op = $pdf->Image('../img/greater_equal.png',156, $pdf->GetY()+1.5, 1.7).'   ';
                       }
                       else if($row_for_defining_process['appearance_after_washing_fabric_surface_fuzzing_math_op'] == '≤')
                       {
                          $appearance_after_washing_fabric_surface_fuzzing_math_op = $pdf->Image('../img/less_equal.png',156, $pdf->GetY()+1.5, 1.7).'   ';
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




								  if($row_for_defining_process['appearance_after_washing_fabric_surface_fuzzing_min_value']<=$row_for_qc['appearance_after_washing_fabric_surface_fuzzing_value'] && $row_for_defining_process['appearance_after_washing_fabric_surface_fuzzing_max_value']>=$row_for_qc['appearance_after_washing_fabric_surface_fuzzing_value'])
									{
									   $p++;
									   $pdf->Cell(124,5,$row['test_name_method']. ' (Fabric (Surface Fuzzing))('.$row_for_defining_process['appearance_after_washing_cycle_fabric_wash1'].')',"1", "0","L");
                                       $pdf->Cell(21,5,$appearance_after_washing_fabric_surface_fuzzing_value, "1", "0","L");
                                       $pdf->Cell(30,5,$appearance_after_washing_fabric_surface_fuzzing_math_op.' '.$appearance_after_washing_fabric_surface_fuzzing_tolerance_value, "1", "0","L");
                                       $pdf->Cell(15,5,"Pass", "1", "0","C");
                                       $pdf->SetTextColor(0,0,0);
                                       $pdf->Ln();
									}
									else {
									   $f++;
                                       $pdf->Cell(124,5,$row['test_name_method']. ' (Fabric (Surface Fuzzing))('.$row_for_defining_process['appearance_after_washing_cycle_fabric_wash1'].')',"1", "0","L");
                                       $pdf->Cell(21,5,$appearance_after_washing_fabric_surface_fuzzing_value, "1", "0","L");
                                       $pdf->Cell(30,5,$appearance_after_washing_fabric_surface_fuzzing_math_op.' '.$appearance_after_washing_fabric_surface_fuzzing_tolerance_value, "1", "0","L");
                                       
                                       $pdf->SetTextColor(194,8,8);
                                       $pdf->Cell(15,5,"Fail", "1", "0","C");
                                       $pdf->SetTextColor(0,0,0);
                                       $pdf->Ln();
									   
									}
	 
						}  /*ENd of ($row_for_defining_process['appearance_after_washing_fabric_surface_fuzzing_max_value']<>0) */

						if($row_for_defining_process['appearance_after_washing_fabric_surface_pilling_max_value']<>0 && $row_for_qc['appearance_after_washing_fabric_surface_pilling_value']<>0)
						   {
							  $total_test++;

                       if($row_for_defining_process['appearance_after_washing_fabric_surface_pilling_math_op'] == '≥')
                       {
                          $appearance_after_washing_fabric_surface_pilling_math_op = $pdf->Image('../img/greater_equal.png',156, $pdf->GetY()+1.5, 1.7).'   ';
                       }
                       else if($row_for_defining_process['appearance_after_washing_fabric_surface_pilling_math_op'] == '≤')
                       {
                          $appearance_after_washing_fabric_surface_pilling_math_op = $pdf->Image('../img/less_equal.png',156, $pdf->GetY()+1.5, 1.7).'   ';
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


								  if($row_for_defining_process['appearance_after_washing_fabric_surface_pilling_min_value']<=$row_for_qc['appearance_after_washing_fabric_surface_pilling_value'] && $row_for_defining_process['appearance_after_washing_fabric_surface_pilling_max_value']>=$row_for_qc['appearance_after_washing_fabric_surface_pilling_value'])
									{
									   $p++;
                                       $pdf->Cell(124,5,$row['test_name_method']. ' (Fabric (Surface Pilling))('.$row_for_defining_process['appearance_after_washing_cycle_fabric_wash1'].')',"1", "0","L");
                                       $pdf->Cell(21,5,$appearance_after_washing_fabric_surface_pilling_value, "1", "0","L");
                                       $pdf->Cell(30,5,$appearance_after_washing_fabric_surface_pilling_math_op.' '.$appearance_after_washing_fabric_surface_pilling_tolerance_value, "1", "0","L");
                                       $pdf->Cell(15,5,"Pass", "1", "0","C");
                                       $pdf->SetTextColor(0,0,0);
                                       $pdf->Ln();
									}
									else {
									   $f++;
                                       $pdf->Cell(124,5,$row['test_name_method']. ' (Fabric (Surface Pilling))('.$row_for_defining_process['appearance_after_washing_cycle_fabric_wash1'].')',"1", "0","L");
                                       $pdf->Cell(21,5,$appearance_after_washing_fabric_surface_pilling_value, "1", "0","L");
                                       $pdf->Cell(30,5,$appearance_after_washing_fabric_surface_pilling_math_op.' '.$appearance_after_washing_fabric_surface_pilling_tolerance_value, "1", "0","L");
                                       $pdf->SetTextColor(194,8,8);

                                       $pdf->Cell(15,5,"Fail", "1", "0","C");
                                       $pdf->SetTextColor(0,0,0);
                                       $pdf->Ln();
									   
									}
	 
						}  /*ENd of ($row_for_defining_process['appearance_after_washing_fabric_surface_pilling_max_value']<>0) */

						if($row_for_defining_process['appearance_after_washing_fabric_crease_before_ironing_max_value']<>0 && $row_for_qc['appearance_after_washing_fabric_crease_before_ironing_value']<>0)
						   {
							  $total_test++;

                       if($row_for_defining_process['appearance_after_washing_fabric_crease_before_iron_math_op'] == '≥')
                       {
                          $appearance_after_washing_fabric_crease_before_iron_math_op = $pdf->Image('../img/greater_equal.png',156, $pdf->GetY()+1.5, 1.7).'   ';
                       }
                       else if($row_for_defining_process['appearance_after_washing_fabric_crease_before_iron_math_op'] == '≤')
                       {
                          $appearance_after_washing_fabric_crease_before_iron_math_op = $pdf->Image('../img/less_equal.png',156, $pdf->GetY()+1.5, 1.7).'   ';
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



								  if($row_for_defining_process['appearance_after_washing_fabric_crease_before_ironing_min_value']<=$row_for_qc['appearance_after_washing_fabric_crease_before_ironing_value'] && $row_for_defining_process['appearance_after_washing_fabric_crease_before_ironing_max_value']>=$row_for_qc['appearance_after_washing_fabric_crease_before_ironing_value'])
									{
									   $p++;
									   $pdf->Cell(124,5,$row['test_name_method']. ' (Fabric (Crease before ironing))('.$row_for_defining_process['appearance_after_washing_cycle_fabric_wash1'].')',"1", "0","L");
                                       $pdf->Cell(21,5,$appearance_after_washing_fabric_crease_before_ironing_value, "1", "0","L");
                                       $pdf->Cell(30,5,$appearance_after_washing_fabric_crease_before_iron_math_op.' '.$appearance_after_washing_fabric_crease_before_iron_tolerance_val, "1", "0","L");
                                       $pdf->Cell(15,5,"Pass", "1", "0","C");
                                       $pdf->SetTextColor(0,0,0);
                                       $pdf->Ln();
									}
									else {
									   $f++;
                                       $pdf->Cell(124,5,$row['test_name_method']. ' (Fabric (Crease before ironing))('.$row_for_defining_process['appearance_after_washing_cycle_fabric_wash1'].')',"1", "0","L");
                                       $pdf->Cell(21,5,$appearance_after_washing_fabric_crease_before_ironing_value, "1", "0","L");
                                       $pdf->Cell(30,5,$appearance_after_washing_fabric_crease_before_iron_math_op.' '.$appearance_after_washing_fabric_crease_before_iron_tolerance_val, "1", "0","L");
                                       $pdf->SetTextColor(194,8,8);

                                       $pdf->Cell(15,5,"Fail", "1", "0","C");
                                       $pdf->SetTextColor(0,0,0);
                                       $pdf->Ln();
									   
									}
	 
						}  /*ENd of ($row_for_defining_process['appearance_after_washing_fabric_crease_before_ironing_max_value']<>0) */

						if($row_for_defining_process['appearance_after_washing_fabric_crease_after_ironing_max_value']<>0 && $row_for_qc['appearance_after_washing_fabric_crease_after_ironing_value']<>0)
						   {
							  $total_test++;

                       if($row_for_defining_process['appearance_after_washing_fabric_crease_after_iron_math_op'] == '≥')
                       {
                          $appearance_after_washing_fabric_crease_after_iron_math_op = $pdf->Image('../img/greater_equal.png',156, $pdf->GetY()+1.5, 1.7).'   ';
                       }
                       else if($row_for_defining_process['appearance_after_washing_fabric_crease_after_iron_math_op'] == '≤')
                       {
                          $appearance_after_washing_fabric_crease_after_iron_math_op = $pdf->Image('../img/less_equal.png',156, $pdf->GetY()+1.5, 1.7).'   ';
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



								  if($row_for_defining_process['appearance_after_washing_fabric_crease_after_ironing_min_value']<=$row_for_qc['appearance_after_washing_fabric_crease_after_ironing_value'] && $row_for_defining_process['appearance_after_washing_fabric_crease_after_ironing_max_value']>=$row_for_qc['appearance_after_washing_fabric_crease_after_ironing_value'])
									{
									   $p++;
                                       $pdf->Cell(124,5,$row['test_name_method']. ' (Fabric (Crease after ironing))('.$row_for_defining_process['appearance_after_washing_cycle_fabric_wash1'].')',"1", "0","L");
                                       $pdf->Cell(21,5,$appearance_after_washing_fabric_crease_after_ironing_value, "1", "0","L");
                                       $pdf->Cell(30,5,$appearance_after_washing_fabric_crease_after_iron_math_op.' '.$appearance_after_washing_fabric_crease_after_iron_tolerance_val, "1", "0","L");
                                       $pdf->Cell(15,5,"Pass", "1", "0","C");
                                       $pdf->SetTextColor(0,0,0);
                                       $pdf->Ln();
									}
									else {
									   $f++;
                                       $pdf->Cell(124,5,$row['test_name_method']. ' (Fabric (Crease after ironing))('.$row_for_defining_process['appearance_after_washing_cycle_fabric_wash1'].')',"1", "0","L");
                                       $pdf->Cell(21,5,$appearance_after_washing_fabric_crease_after_ironing_value, "1", "0","L");
                                       $pdf->Cell(30,5,$appearance_after_washing_fabric_crease_after_iron_math_op.' '.$appearance_after_washing_fabric_crease_after_iron_tolerance_val, "1", "0","L");
                                       $pdf->SetTextColor(194,8,8);

                                       $pdf->Cell(15,5,"Fail", "1", "0","C");
                                       $pdf->SetTextColor(0,0,0);
                                       $pdf->Ln();
									   
									}
	 
						}  /*ENd of ($row_for_defining_process['appearance_after_washing_fabric_crease_after_ironing_max_value']<>0) */

                  if($row_for_defining_process['appearance_after_washing_loss_of_print_fabric']<>'' && $row_for_qc['appearance_after_washing_fabric_loss_of_print_value']<>'')
                  {
                            $pdf->Cell(124,5,$row['test_name_method']. ' (Fabric (Loss of Print))('.$row_for_defining_process['appearance_after_washing_cycle_fabric_wash1'].')',"1", "0","L");
                            $pdf->Cell(21,5,$row_for_qc['appearance_after_washing_fabric_loss_of_print_value'], "1", "0","L");
                            $pdf->Cell(30,5,$row_for_defining_process['appearance_after_washing_loss_of_print_fabric'], "1", "0","L");
                            $pdf->Cell(15,5,"Pass", "1", "0","C");
                            $pdf->SetTextColor(0,0,0);
                            $pdf->Ln();
							
						}  /*ENd of ($row_for_defining_process['appearance_after_washing_loss_of_print_fabric']<>0) */

                  if($row_for_defining_process['appearance_after_washing_fabric_abrasive_mark']<>'' && $row_for_qc['appearance_after_washing_fabric_abrasive_mark_value']<>'')
                  {
                            $pdf->Cell(124,5,$row['test_name_method']. ' (Fabric (Abrasive Mark))('.$row_for_defining_process['appearance_after_washing_cycle_fabric_wash1'].')',"1", "0","L");
                            $pdf->Cell(21,5,$row_for_qc['appearance_after_washing_fabric_abrasive_mark_value'], "1", "0","L");
                            $pdf->Cell(30,5,$row_for_defining_process['appearance_after_washing_fabric_abrasive_mark'], "1", "0","L");
                            $pdf->Cell(15,5,"Pass", "1", "0","C");
                            $pdf->SetTextColor(0,0,0);
                            $pdf->Ln();
									  
						}  /*ENd of ($row_for_defining_process['appearance_after_washing_fabric_abrasive_mark']<>0) */

                  if($row_for_defining_process['appearance_after_washing_odor_fabric']<>'' && $row_for_qc['appearance_after_washing_fabric_odor_value']<>'')
                  {
                            $pdf->Cell(124,5,$row['test_name_method']. ' (Fabric (Odor))('.$row_for_defining_process['appearance_after_washing_cycle_fabric_wash1'].')',"1", "0","L");
                            $pdf->Cell(21,5,$row_for_qc['appearance_after_washing_fabric_odor_value'], "1", "0","L");
                            $pdf->Cell(30,5,$row_for_defining_process['appearance_after_washing_odor_fabric'], "1", "0","L");
                            $pdf->Cell(15,5,"Pass", "1", "0","C");
                            $pdf->SetTextColor(0,0,0);
                            $pdf->Ln();
									   
						}  /*ENd of ($row_for_defining_process['appearance_after_washing_odor_fabric']<>0) */

                  if($row_for_defining_process['appearance_after_washing_other_observation_fabric']<>'' && $row_for_qc['appearance_after_washing_other_observation_fabric']<>'')
						{
								  $pdf->Cell(124,5,$row['test_name_method']. ' (Fabric (Other observation))('.$row_for_defining_process['appearance_after_washing_cycle_fabric_wash'].')',"1", "0","L");
								  $pdf->Cell(21,5,$row_for_qc['appearance_after_washing_other_observation_fabric'], "1", "0","L");
								  $pdf->Cell(30,5,$row_for_defining_process['appearance_after_washing_other_observation_fabric'], "1", "0","L");
								  $pdf->Cell(15,5,"Pass", "1", "0","C");
								  $pdf->SetTextColor(0,0,0);
								  $pdf->Ln();
											 
							  }  /*ENd of ($row_for_defining_process['appearance_after_washing_odor_fabric']<>0) */

               }
               if($row_for_defining_process['test_method_for_appearance_after_wash_fabric'] == 'Garments')
               {

						if($row_for_defining_process['appear_after_washing_garments_color_change_without_sup_max_val']<>0 && $row_for_qc['appear_after_wash_garments_color_change_without_sup_value']<>0)
						   {
							  $total_test++;

                       if($row_for_defining_process['appear_after_washing_garments_color_change_without_sup_math_op'] == '≥')
                        {
                           $appear_after_washing_garments_color_change_without_sup_math_op = $pdf->Image('../img/greater_equal.png',156, $pdf->GetY()+1.5, 1.7).'   ';
                        }
                        else if($row_for_defining_process['appear_after_washing_garments_color_change_without_sup_math_op'] == '≤')
                        {
                           $appear_after_washing_garments_color_change_without_sup_math_op = $pdf->Image('../img/less_equal.png',156, $pdf->GetY()+1.5, 1.7).'   ';
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
 




								  if($row_for_defining_process['appear_after_washing_garments_color_change_without_sup_min_value']<=$row_for_qc['appear_after_wash_garments_color_change_without_sup_value'] && $row_for_defining_process['appear_after_washing_garments_color_change_without_sup_max_val']>=$row_for_qc['appear_after_wash_garments_color_change_without_sup_value'])
									{
									   $p++;
                                       $pdf->Cell(124,5,$row['test_name_method']. '((GMT(Color Change (Without Suppressor)))('.$row_for_defining_process['appearance_after_washing_cycle_garments_wash'].')',"1", "0","L");
                                       $pdf->Cell(21,5,$appear_after_wash_garments_color_change_without_sup_value, "1", "0","L");
                                       $pdf->Cell(30,5,$appear_after_washing_garments_color_change_without_sup_math_op.' '.$appear_after_washing_garments_color_change_without_sup_toler_val, "1", "0","L");
                                       $pdf->Cell(15,5,"Pass", "1", "0","C");
                                       $pdf->SetTextColor(0,0,0);
                                       $pdf->Ln();
									}
									else {
									   $f++;
                                       $pdf->Cell(124,5,$row['test_name_method']. '((GMT(Color Change (Without Suppressor)))('.$row_for_defining_process['appearance_after_washing_cycle_garments_wash'].')',"1", "0","L");
                                       $pdf->Cell(21,5,$appear_after_wash_garments_color_change_without_sup_value, "1", "0","L");
                                       $pdf->Cell(30,5,$appear_after_washing_garments_color_change_without_sup_math_op.' '.$appear_after_washing_garments_color_change_without_sup_toler_val, "1", "0","L");
                                       $pdf->SetTextColor(194,8,8);

                                       $pdf->Cell(15,5,"Fail", "1", "0","C");
                                       $pdf->SetTextColor(0,0,0);
                                       $pdf->Ln();
									  
									}
	 
						}  /*ENd of ($row_for_defining_process['appear_after_washing_garments_color_change_without_sup_max_val']<>0) */

						if($row_for_defining_process['appear_after_washing_garments_color_change_with_sup_max_value']<>0 && $row_for_qc['appear_after_wash_garments_color_change_with_sup_value']<>0)
						   {
							  $total_test++;

                       if($row_for_defining_process['appear_after_washing_garments_color_change_with_sup_math_op'] == '≥')
                       {
                          $appear_after_washing_garments_color_change_with_sup_math_op = $pdf->Image('../img/greater_equal.png',156, $pdf->GetY()+1.5, 1.7).'   ';
                       }
                       else if($row_for_defining_process['appear_after_washing_garments_color_change_with_sup_math_op'] == '≤')
                       {
                          $appear_after_washing_garments_color_change_with_sup_math_op = $pdf->Image('../img/less_equal.png',156, $pdf->GetY()+1.5, 1.7).'   ';
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


								  if($row_for_defining_process['appear_after_washing_garments_color_change_with_sup_min_value']<=$row_for_qc['appear_after_wash_garments_color_change_with_sup_value'] && $row_for_defining_process['appear_after_washing_garments_color_change_with_sup_max_value']>=$row_for_qc['appear_after_wash_garments_color_change_with_sup_value'])
									{
									   $p++;
									   $pdf->Cell(124,5,$row['test_name_method']. '((GMT(Color Change (With Suppressor)))('.$row_for_defining_process['appearance_after_washing_cycle_garments_wash'].')',"1", "0","L");
                                       $pdf->Cell(21,5,$appear_after_wash_garments_color_change_with_sup_value, "1", "0","L");
                                       $pdf->Cell(30,5,$appear_after_washing_garments_color_change_with_sup_math_op.' '.$appear_after_washing_garments_color_change_with_sup_toler_value, "1", "0","L");
                                       $pdf->Cell(15,5,"Pass", "1", "0","C");
                                       $pdf->SetTextColor(0,0,0);
                                       $pdf->Ln();
									}
									else {
									   $f++;
                                       $pdf->Cell(124,5,$row['test_name_method']. '((GMT(Color Change (With Suppressor)))('.$row_for_defining_process['appearance_after_washing_cycle_garments_wash'].')',"1", "0","L");
                                       $pdf->Cell(21,5,$appear_after_wash_garments_color_change_with_sup_value, "1", "0","L");
                                       $pdf->Cell(30,5,$appear_after_washing_garments_color_change_with_sup_math_op.' '.$appear_after_washing_garments_color_change_with_sup_toler_value, "1", "0","L");
                                       $pdf->SetTextColor(194,8,8);

                                       $pdf->Cell(15,5,"Fail", "1", "0","C");
                                       $pdf->SetTextColor(0,0,0);
                                       $pdf->Ln();
									   
									}
	 
						}  /*ENd of ($row_for_defining_process['appear_after_washing_garments_color_change_with_sup_max_value']<>0) */

						if($row_for_defining_process['appearance_after_washing_garments_cross_staining_max_value']<>0  && $row_for_qc['appearance_after_washing_garments_cross_staining_value']<>0)
						   {
							  $total_test++;

                       if($row_for_defining_process['appear_after_washing_garments_cross_staining_math_op'] == '≥')
                       {
                          $appear_after_washing_garments_cross_staining_math_op = $pdf->Image('../img/greater_equal.png',156, $pdf->GetY()+1.5, 1.7).'   ';
                       }
                       else if($row_for_defining_process['appear_after_washing_garments_cross_staining_math_op'] == '≤')
                       {
                          $appear_after_washing_garments_cross_staining_math_op = $pdf->Image('../img/less_equal.png',156, $pdf->GetY()+1.5, 1.7).'   ';
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



								  if($row_for_defining_process['appearance_after_washing_garments_cross_staining_min_value']<=$row_for_qc['appearance_after_washing_garments_cross_staining_value'] && $row_for_defining_process['appearance_after_washing_garments_cross_staining_max_value']>=$row_for_qc['appearance_after_washing_garments_cross_staining_value'])
									{
									   $p++;
									   $pdf->Cell(124,5,$row['test_name_method']. ' ((GMT (Cross Staining))('.$row_for_defining_process['appearance_after_washing_cycle_garments_wash'].')',"1", "0","L");
                                       $pdf->Cell(21,5,$appearance_after_washing_garments_cross_staining_value, "1", "0","L");
                                       $pdf->Cell(30,5,$appear_after_washing_garments_cross_staining_math_op.' '.$appear_after_washing_garments_cross_staining_tolerance_value, "1", "0","L");
                                       $pdf->Cell(15,5,"Pass", "1", "0","C");
                                       $pdf->SetTextColor(0,0,0);
                                       $pdf->Ln();
									}
									else {
									   $f++;
                                       $pdf->Cell(124,5,$row['test_name_method']. ' ((GMT (Cross Staining))('.$row_for_defining_process['appearance_after_washing_cycle_garments_wash'].')',"1", "0","L");
                                       $pdf->Cell(21,5,$appearance_after_washing_garments_cross_staining_value, "1", "0","L");
                                       $pdf->Cell(30,5,$appear_after_washing_garments_cross_staining_math_op.' '.$appear_after_washing_garments_cross_staining_tolerance_value, "1", "0","L");
                                       $pdf->SetTextColor(194,8,8);

                                       $pdf->Cell(15,5,"Fail", "1", "0","C");
                                       $pdf->SetTextColor(0,0,0);
                                       $pdf->Ln();
									   
									}
	 
						}  /*ENd of ($row_for_defining_process['appearance_after_washing_garments_cross_staining_max_value']<>0) */

						if($row_for_defining_process['appearance_after_washing_garments__differential_shrink_max_value']<>0 && $row_for_qc['appearance_after_washing_garments_differential_shrinkage_value']<>0)
						   {
							  $total_test++;

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

                          
                       
								  if($row_for_defining_process['appearance_after_washing_garments__differential_shrink_min_value']<=$row_for_qc['appearance_after_washing_garments_differential_shrinkage_value'] && $row_for_defining_process['appearance_after_washing_garments__differential_shrink_max_value']>=$row_for_qc['appearance_after_washing_garments_differential_shrinkage_value'])
									{
									   $p++;
                                       $pdf->Cell(124,5,$row['test_name_method']. ' ((GMT (Differential Shrinking))('.$row_for_defining_process['appearance_after_washing_cycle_garments_wash'].')',"1", "0","L");
                                       $pdf->Cell(21,5,$appearance_after_washing_garments_differential_shrinkage_value, "1", "0","L");
                                       $pdf->Cell(30,5,$appear_after_washing_garments_differential_shrink_math_op.' '.$appear_after_washing_garments__differential_shrink_tolerance_val, "1", "0","L");
                                       $pdf->Cell(15,5,"Pass", "1", "0","C");
                                       $pdf->SetTextColor(0,0,0);
                                       $pdf->Ln();
									}
									else {
									   $f++;
                                       $pdf->Cell(124,5,$row['test_name_method']. ' ((GMT (Differential Shrinking))('.$row_for_defining_process['appearance_after_washing_cycle_garments_wash'].')',"1", "0","L");
                                       $pdf->Cell(21,5,$appearance_after_washing_garments_differential_shrinkage_value, "1", "0","L");
                                       $pdf->Cell(30,5,$appear_after_washing_garments_differential_shrink_math_op.' '.$appear_after_washing_garments__differential_shrink_tolerance_val, "1", "0","L");
                                       $pdf->SetTextColor(194,8,8);

                                       $pdf->Cell(15,5,"Fail", "1", "0","C");
                                       $pdf->SetTextColor(0,0,0);
                                       $pdf->Ln();
									   
									}
	 
						}  /*ENd of ($row_for_defining_process['appearance_after_washing_garments__differential_shrink_max_value']<>0) */

						if($row_for_defining_process['appearance_after_washing_garments_surface_fuzzing_max_value']<>0 && $row_for_qc['appearance_after_washing_garments_surface_fuzzing_value']<>0)
						   {
							  $total_test++;

                       if($row_for_defining_process['appear_after_washing_garments_surface_fuzzing_math_op'] == '≥')
                       {
                          $appear_after_washing_garments_surface_fuzzing_math_op = $pdf->Image('../img/greater_equal.png',156, $pdf->GetY()+1.5, 1.7).'   ';
                       }
                       else if($row_for_defining_process['appear_after_washing_garments_surface_fuzzing_math_op'] == '≤')
                       {
                          $appear_after_washing_garments_surface_fuzzing_math_op = $pdf->Image('../img/less_equal.png',156, $pdf->GetY()+1.5, 1.7).'   ';
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



								  if($row_for_defining_process['appearance_after_washing_garments_surface_fuzzing_min_value']<=$row_for_qc['appearance_after_washing_garments_surface_fuzzing_value'] && $row_for_defining_process['appearance_after_washing_garments_surface_fuzzing_max_value']>=$row_for_qc['appearance_after_washing_garments_surface_fuzzing_value'])
									{
									   $p++;
                                       $pdf->Cell(124,5,$row['test_name_method']. ' ((GMT (Surface Fuzzing))('.$row_for_defining_process['appearance_after_washing_cycle_garments_wash'].')',"1", "0","L");
                                       $pdf->Cell(21,5,$appearance_after_washing_garments_surface_fuzzing_value, "1", "0","L");
                                       $pdf->Cell(30,5,$appear_after_washing_garments_surface_fuzzing_math_op.' '.$appearance_after_washing_garments_surface_fuzzing_tolerance_val, "1", "0","L");
                                       $pdf->Cell(15,5,"Pass", "1", "0","C");
                                       $pdf->SetTextColor(0,0,0);
                                       $pdf->Ln();
									}
									else {
									   $f++;
                                       $pdf->Cell(124,5,$row['test_name_method']. ' ((GMT (Surface Fuzzing))('.$row_for_defining_process['appearance_after_washing_cycle_garments_wash'].')',"1", "0","L");
                                       $pdf->Cell(21,5,$appearance_after_washing_garments_surface_fuzzing_value, "1", "0","L");
                                       $pdf->Cell(30,5,$appear_after_washing_garments_surface_fuzzing_math_op.' '.$appearance_after_washing_garments_surface_fuzzing_tolerance_val, "1", "0","L");
                                       $pdf->SetTextColor(194,8,8);

                                       $pdf->Cell(15,5,"Fail", "1", "0","C");
                                       $pdf->SetTextColor(0,0,0);
                                       $pdf->Ln();
									   
									}
	 
						}  /*ENd of ($row_for_defining_process['appearance_after_washing_garments_surface_fuzzing_max_value']<>0) */

						if($row_for_defining_process['appearance_after_washing_garments_surface_pilling_max_value']<>0 && $row_for_qc['appearance_after_washing_garments_surface_pilling_value']<>0)
						   {
							  $total_test++;

                       if($row_for_defining_process['appear_after_washing_garments_surface_pilling_math_op'] == '≥')
                       {
                          $appear_after_washing_garments_surface_pilling_math_op = $pdf->Image('../img/greater_equal.png',156, $pdf->GetY()+1.5, 1.7).'   ';
                       }
                       else if($row_for_defining_process['appear_after_washing_garments_surface_pilling_math_op'] == '≤')
                       {
                          $appear_after_washing_garments_surface_pilling_math_op = $pdf->Image('../img/less_equal.png',156, $pdf->GetY()+1.5, 1.7).'   ';
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



								  if($row_for_defining_process['appearance_after_washing_garments_surface_pilling_min_value']<=$row_for_qc['appearance_after_washing_garments_surface_pilling_value'] && $row_for_defining_process['appearance_after_washing_garments_surface_pilling_max_value']>=$row_for_qc['appearance_after_washing_garments_surface_pilling_value'])
									{
									   $p++;
                                       $pdf->Cell(124,5,$row['test_name_method']. ' ((GMT (Surface Pilling))('.$row_for_defining_process['appearance_after_washing_cycle_garments_wash'].')',"1", "0","L");
                                       $pdf->Cell(21,5,$appearance_after_washing_garments_surface_pilling_value, "1", "0","L");
                                       $pdf->Cell(30,5,$appear_after_washing_garments_surface_pilling_math_op.' '.$appearance_after_washing_garments_surface_pilling_tolerance_val, "1", "0","L");
                                       $pdf->Cell(15,5,"Pass", "1", "0","C");
                                       $pdf->SetTextColor(0,0,0);
                                       $pdf->Ln();
									}
									else {
									   $f++;
                                       $pdf->Cell(124,5,$row['test_name_method']. ' ((GMT (Surface Pilling))('.$row_for_defining_process['appearance_after_washing_cycle_garments_wash'].')',"1", "0","L");
                                       $pdf->Cell(21,5,$appearance_after_washing_garments_surface_pilling_value, "1", "0","L");
                                       $pdf->Cell(30,5,$appear_after_washing_garments_surface_pilling_math_op.' '.$appearance_after_washing_garments_surface_pilling_tolerance_val, "1", "0","L");
                                       $pdf->SetTextColor(194,8,8);

                                       $pdf->Cell(15,5,"Fail", "1", "0","C");
                                       $pdf->SetTextColor(0,0,0);
                                       $pdf->Ln();
									 
									}
	 
						}  /*ENd of ($row_for_defining_process['appearance_after_washing_garments_surface_pilling_max_value']<>0) */

						if($row_for_defining_process['appearance_after_washing_garments_crease_after_ironing_max_value']<>0 && $row_for_qc['appearance_after_washing_garments_crease_after_ironing_value']<>0)
						   {
							  $total_test++;

                       if($row_for_defining_process['appear_after_washing_garments_crease_after_ironing_math_op'] == '≥')
                       {
                          $appear_after_washing_garments_crease_after_ironing_math_op = $pdf->Image('../img/greater_equal.png',156, $pdf->GetY()+1.5, 1.7).'   ';
                       }
                       else if($row_for_defining_process['appear_after_washing_garments_crease_after_ironing_math_op'] == '≤')
                       {
                          $appear_after_washing_garments_crease_after_ironing_math_op = $pdf->Image('../img/less_equal.png',156, $pdf->GetY()+1.5, 1.7).'   ';
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

								  if($row_for_defining_process['appearance_after_washing_garments_crease_after_ironing_min_value']<=$row_for_qc['appearance_after_washing_garments_crease_after_ironing_value'] && $row_for_defining_process['appearance_after_washing_garments_crease_after_ironing_max_value']>=$row_for_qc['appearance_after_washing_garments_crease_after_ironing_value'])
									{
									   $p++;
									   $pdf->Cell(124,5,$row['test_name_method']. ' ((GMT (Crease After Ironing))('.$row_for_defining_process['appearance_after_washing_cycle_garments_wash'].')',"1", "0","L");
                                       $pdf->Cell(21,5,$appearance_after_washing_garments_crease_after_ironing_value, "1", "0","L");
                                       $pdf->Cell(30,5,$appear_after_washing_garments_crease_after_ironing_math_op.' '.$appear_after_washing_garments_crease_after_ironing_tolerance_val, "1", "0","L");
                                       $pdf->Cell(15,5,"Pass", "1", "0","C");
                                       $pdf->SetTextColor(0,0,0);
                                       $pdf->Ln();
									}
									else {
									   $f++;
                                       $pdf->Cell(124,5,$row['test_name_method']. ' ((GMT (Crease After Ironing))('.$row_for_defining_process['appearance_after_washing_cycle_garments_wash'].')',"1", "0","L");
                                       $pdf->Cell(21,5,$appearance_after_washing_garments_crease_after_ironing_value, "1", "0","L");
                                       $pdf->Cell(30,5,$appear_after_washing_garments_crease_after_ironing_math_op.' '.$appear_after_washing_garments_crease_after_ironing_tolerance_val, "1", "0","L");
                                       $pdf->SetTextColor(194,8,8);

                                       $pdf->Cell(15,5,"Fail", "1", "0","C");
                                       $pdf->SetTextColor(0,0,0);
                                       $pdf->Ln();
									  
									}
	 
						}  /*ENd of ($row_for_defining_process['appearance_after_washing_garments_crease_after_ironing_max_value']<>0) */

						if($row_for_defining_process['appearance_after_washing_garments_abrasive_mark']<>'' && $row_for_qc['appearance_after_washing_garments_abrasive_mark_value']<>'')
						   {
                            $pdf->Cell(124,5,$row['test_name_method']. ' ((GMT (Abrasive Mark))('.$row_for_defining_process['appearance_after_washing_cycle_garments_wash'].')',"1", "0","L");
                            $pdf->Cell(21,5,$row_for_qc['appearance_after_washing_garments_abrasive_mark_value'], "1", "0","L");
                            $pdf->Cell(30,5,$row_for_defining_process['appearance_after_washing_garments_abrasive_mark'], "1", "0","L");
                            $pdf->Cell(15,5,"Pass", "1", "0","C");
                            $pdf->SetTextColor(0,0,0);
                            $pdf->Ln();
									  
						}  /*ENd of ($row_for_defining_process['appearance_after_washing_garments_abrasive_mark']<>0) */

						if($row_for_defining_process['seam_breakdown_garments']<>0 && $row_for_qc['appearance_after_washing_garments_seam_breakdown_value']<>0)
						   {
                            $pdf->Cell(124,5,$row['test_name_method']. ' ((GMT (Seam Breakdown))('.$row_for_defining_process['appearance_after_washing_cycle_garments_wash'].')',"1", "0","L");
                            $pdf->Cell(21,5,$row_for_qc['appearance_after_washing_garments_seam_breakdown_value'], "1", "0","L");
                            $pdf->Cell(30,5,$row_for_defining_process['seam_breakdown_garments'], "1", "0","L");
                            $pdf->Cell(15,5,"Pass", "1", "0","C");
                            $pdf->SetTextColor(0,0,0);
                            $pdf->Ln();
						
						}  /*ENd of ($row_for_defining_process['seam_breakdown_garments']<>0) */

						


						if($row_for_defining_process['appear_after_washing_garments_seam_pucker_rop_iron_max_value']<>0 && $row_for_qc['appearance_after_washing_garments_seam_puckering_roping_after_ir']<>0)
						   {
							  $total_test++;

                       if($row_for_defining_process['appear_after_wash_garments_seam_pucker_rop_iron_math_op'] == '≥')
                       {
                          $appear_after_wash_garments_seam_pucker_rop_iron_math_op = $pdf->Image('../img/greater_equal.png',156, $pdf->GetY()+1.5, 1.7).'   ';
                       }
                       else if($row_for_defining_process['appear_after_wash_garments_seam_pucker_rop_iron_math_op'] == '≤')
                       {
                          $appear_after_wash_garments_seam_pucker_rop_iron_math_op = $pdf->Image('../img/less_equal.png',156, $pdf->GetY()+1.5, 1.7).'   ';
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


								  if($row_for_defining_process['appear_after_washing_garments_seam_pucker_rop_iron_min_value']<=$row_for_qc['appearance_after_washing_garments_seam_puckering_roping_after_ir'] && $row_for_defining_process['appear_after_washing_garments_seam_pucker_rop_iron_max_value']>=$row_for_qc['appearance_after_washing_garments_seam_puckering_roping_after_ir'])
									{
									   $p++;
                                       $pdf->Cell(124,5,$row['test_name_method']. '((GMT(Seam puckering/roping After Iron))('.$row_for_defining_process['appearance_after_washing_cycle_garments_wash'].')',"1", "0","L");
                                       $pdf->Cell(21,5,$appearance_after_washing_garments_seam_puckering_roping_after_ir, "1", "0","L");
                                       $pdf->Cell(30,5,$appear_after_wash_garments_seam_pucker_rop_iron_math_op.' '.$appear_after_washing_garments_seam_pucker_rop_iron_toler_value, "1", "0","L");
                                       $pdf->Cell(15,5,"Pass", "1", "0","C");
                                       $pdf->SetTextColor(0,0,0);
                                       $pdf->Ln();
									}
									else {
									   $f++;
                                       $pdf->Cell(124,5,$row['test_name_method']. '((GMT(Seam puckering/roping After Iron))('.$row_for_defining_process['appearance_after_washing_cycle_garments_wash'].')',"1", "0","L");
                                       $pdf->Cell(21,5,$appearance_after_washing_garments_seam_puckering_roping_after_ir, "1", "0","L");
                                       $pdf->Cell(30,5,$appear_after_wash_garments_seam_pucker_rop_iron_math_op.' '.$appear_after_washing_garments_seam_pucker_rop_iron_toler_value, "1", "0","L");
                                       
                                       $pdf->SetTextColor(194,8,8);
                                       $pdf->Cell(15,5,"Fail", "1", "0","C");
                                       $pdf->SetTextColor(0,0,0);
                                       $pdf->Ln();
									   
									}
	 
						}  /*ENd of ($row_for_defining_process['appear_after_washing_garments_seam_pucker_rop_iron_max_value']<>0) */

                  if($row_for_defining_process['detachment_of_interlinings_fused_components_garments']<>'' && $row_for_qc['appearance_after_washing_garments_detachment_of_interlining_valu']<>'')
                  {
                            $pdf->Cell(124,5,$row['test_name_method']. '((GMT(Detachment of interlinings))('.$row_for_defining_process['appearance_after_washing_cycle_garments_wash'].')',"1", "0","L");
                            $pdf->Cell(21,5,$row_for_qc['appearance_after_washing_garments_detachment_of_interlining_valu'], "1", "0","L");
                            $pdf->Cell(30,5,$row_for_defining_process['detachment_of_interlinings_fused_components_garments'], "1", "0","L");
                            $pdf->Cell(15,5,"Pass", "1", "0","C");
                            $pdf->SetTextColor(0,0,0);
                            $pdf->Ln();
	 
						}  /*ENd of ($row_for_defining_process['detachment_of_interlinings_fused_components_garments']<>0) */

                  if($row_for_defining_process['change_id_handle_or_appearance']<>'' && $row_for_qc['appearance_after_washing_garments_change_in_handle_value']<>'')
                  {
                            $pdf->Cell(124,5,$row['test_name_method']. '((GMT (Change in handle/appearance))('.$row_for_defining_process['appearance_after_washing_cycle_garments_wash'].')',"1", "0","L");
                            $pdf->Cell(21,5,$row_for_qc['appearance_after_washing_garments_change_in_handle_value'], "1", "0","L");
                            $pdf->Cell(30,5,$row_for_defining_process['change_id_handle_or_appearance'], "1", "0","L");
                            $pdf->Cell(15,5,"Pass", "1", "0","C");
                            $pdf->SetTextColor(0,0,0);
                            $pdf->Ln();
									
						}  /*ENd of ($row_for_defining_process['change_id_handle_or_appearance']<>0) */

                  if($row_for_defining_process['effect_on_accessories_such_as_buttons']<>'' && $row_for_qc['appearance_after_washing_garments_effect_accessories_value']<>'')
                  {
                            $pdf->Cell(124,5,$row['test_name_method']. '((GMT(Effect on accessories))('.$row_for_defining_process['appearance_after_washing_cycle_garments_wash'].')',"1", "0","L");
                            $pdf->Cell(21,5,$row_for_qc['appearance_after_washing_garments_effect_accessories_value'], "1", "0","L");
                            $pdf->Cell(30,5,$row_for_defining_process['effect_on_accessories_such_as_buttons'], "1", "0","L");
                            $pdf->Cell(15,5,"Pass", "1", "0","C");
                            $pdf->SetTextColor(0,0,0);
                            $pdf->Ln();
								
						}  /*ENd of ($row_for_defining_process['effect_on_accessories_such_as_buttons']<>0) */

                  if($row_for_defining_process['appearance_after_washing_garments_spirality_max_value']<>0 && $row_for_qc['appearance_after_washing_garments_spirality_value']<>0)
                  {
							  $total_test++;
								  if($row_for_defining_process['appearance_after_washing_garments_spirality_min_value']<=$row_for_qc['appearance_after_washing_garments_spirality_value'] && $row_for_defining_process['appearance_after_washing_garments_spirality_max_value']>=$row_for_qc['appearance_after_washing_garments_spirality_value'])
									{
									   $p++;
                                       $pdf->Cell(124,5,$row['test_name_method']. '(GMT(Spirality(%)))('.$row_for_defining_process['appearance_after_washing_cycle_garments_wash'].')',"1", "0","L");
                                       $pdf->Cell(21,5,$row_for_qc['appearance_after_washing_garments_spirality_value'], "1", "0","L");
                                       $pdf->Cell(30,5,$row_for_defining_process['appearance_after_washing_garments_spirality_min_value'], "1", "0","L");
                                       $pdf->Cell(15,5,"Pass", "1", "0","C");
                                       $pdf->SetTextColor(0,0,0);
                                       $pdf->Ln();
									}
									else {
									   $f++;
                                       $pdf->Cell(124,5,$row['test_name_method']. '(Germents(Spirality(%)))('.$row_for_defining_process['appearance_after_washing_cycle_garments_wash'].')',"1", "0","L");
                                       $pdf->Cell(21,5,$row_for_qc['appearance_after_washing_garments_spirality_value'], "1", "0","L");
                                       $pdf->Cell(30,5,$row_for_defining_process['appearance_after_washing_garments_spirality_min_value'], "1", "0","L");
                                       $pdf->SetTextColor(194,8,8);

                                       $pdf->Cell(15,5,"Fail", "1", "0","C");
                                       $pdf->SetTextColor(0,0,0);
                                       $pdf->Ln();
									  
									}
	 
						}  /*ENd of ($row_for_defining_process['appearance_after_washing_garments_spirality_max_value']<>0) */

                  if($row_for_defining_process['detachment_or_fraying_of_ribbons']<>'' && $row_for_qc['appearance_after_washing_garments_detachment_or_fraying_of_ribbo']<>'')
                  {
                            $pdf->Cell(124,5,$row['test_name_method']. '(GMT(Detachment/Fraying of ribbons/trims))('.$row_for_defining_process['appearance_after_washing_cycle_garments_wash'].')',"1", "0","L");
                            $pdf->Cell(21,5,$row_for_qc['appearance_after_washing_garments_detachment_or_fraying_of_ribbo'], "1", "0","L");
                            $pdf->Cell(30,5,$row_for_defining_process['detachment_or_fraying_of_ribbons'], "1", "0","L");
                            $pdf->Cell(15,5,"Pass", "1", "0","C");
                            $pdf->SetTextColor(0,0,0);
                            $pdf->Ln();
									  
						}  /*ENd of ($row_for_defining_process['detachment_or_fraying_of_ribbons']<>0) */

                  if($row_for_defining_process['loss_of_print_garments']<>'' && $row_for_qc['appearance_after_washing_garments_loss_of_print_value']<>'')
                  {
                            $pdf->Cell(124,5,$row['test_name_method']. '(GMT(Loss of Print))('.$row_for_defining_process['appearance_after_washing_cycle_garments_wash'].')',"1", "0","L");
                            $pdf->Cell(21,5,$row_for_qc['appearance_after_washing_garments_loss_of_print_value'], "1", "0","L");
                            $pdf->Cell(30,5,$row_for_defining_process['loss_of_print_garments'], "1", "0","L");
                            $pdf->Cell(15,5,"Pass", "1", "0","C");
                            $pdf->SetTextColor(0,0,0);
                            $pdf->Ln();
									 
						}  /*ENd of ($row_for_defining_process['loss_of_print_garments']<>0) */

                  if($row_for_defining_process['care_level_garments']<>'' && $row_for_qc['appearance_after_washing_garments_care_level_value']<>'')
                  {
                            $pdf->Cell(124,5,$row['test_name_method']. '(GMT(Care Level))('.$row_for_defining_process['appearance_after_washing_cycle_garments_wash'].')',"1", "0","L");
                            $pdf->Cell(21,5,$row_for_qc['appearance_after_washing_garments_care_level_value'], "1", "0","L");
                            $pdf->Cell(30,5,$row_for_defining_process['care_level_garments'], "1", "0","L");
                            $pdf->Cell(15,5,"Pass", "1", "0","C");
                            $pdf->SetTextColor(0,0,0);
                            $pdf->Ln();
									
						}  /*ENd of ($row_for_defining_process['care_level_garments']<>0) */

                  if($row_for_defining_process['odor_garments']<>'' && $row_for_qc['appearance_after_washing_garments_odor_value']<>'')
                  {
                            $pdf->Cell(124,5,$row['test_name_method']. '(GMT(Odor))('.$row_for_defining_process['appearance_after_washing_cycle_garments_wash'].')',"1", "0","L");
                            $pdf->Cell(21,5,$row_for_qc['appearance_after_washing_garments_odor_value'], "1", "0","L");
                            $pdf->Cell(30,5,$row_for_defining_process['odor_garments'], "1", "0","L");
                            $pdf->Cell(15,5,"Pass", "1", "0","C");
                            $pdf->SetTextColor(0,0,0);
                            $pdf->Ln();
									
						}  /*ENd of ($row_for_defining_process['odor_garments']<>0) */

                  if($row_for_defining_process['appearance_after_washing_other_observation_garments']<>'' && $row_for_qc['appearance_after_washing_garments_odor_value']<>'')
						{
								  $pdf->Cell(124,5,$row['test_name_method']. ' (GMT (Other observation)) ('.$row_for_defining_process['appearance_after_washing_cycle_garments_wash'].')',"1", "0","L");
								 $pdf->Cell(21,5,$row_for_qc['appearance_after_washing_other_observation_garments'], "1", "0","L");
								  $pdf->Cell(30,5,$row_for_defining_process['appearance_after_washing_other_observation_garments'], "1", "0","L");
								  $pdf->Cell(15,5,"Pass", "1", "0","C");
								  $pdf->SetTextColor(0,0,0);
								  $pdf->Ln();
										  
						}  /*ENd of ($row_for_defining_process['appearance_after_washing_other_observation_garments']<>0) */
               }

					}   /*End of if (in_array($row['id'], ['3']))*/

                   
                }
$pdf->Ln(5);
$pdf->SetFont('Arial','B',12);
                if($total_test == $p)
                    {
                        $pdf->SetTextColor(0,0,0);
                        $pdf->Cell(95,6,"Result Summary :   Pass","0","1","L");
                    }
                    else{
                     $pdf->Cell(40,6,"Result Summary : ","0","0","L");
                       $pdf->SetTextColor(194,8,8);
                        $pdf->Cell(21,6," Fail","0","1","L");
                       $pdf->SetTextColor(0,0,0);
                    }

$pdf->Ln(5);
$pdf->SetFont('Times','B',6);
$pdf->Cell(95,6,"Remarks :   ".$row_for_qc['remarks'],"0","1","L");
$pdf->Ln(2);
$pdf->Cell(95,6,"Reported By :   ".$row_for_trf['employee_name'],"0","0","L");
if($row_for_trf['verified_signature'] <> '')
{
	$pdf->Cell(95,6,"Verified By :    ".$pdf->Image('../img/'.$row_for_trf['verified_signature'],160, $pdf->GetY(), 30),"0","0","C");

}
else
{
	$pdf->Cell(95,6,"Verified By :    ".$pdf->Image('../img/default.png',160, $pdf->GetY(), 10),"0","0","C");
}

ob_end_clean();

$pdf->Output('I', "all_test_for_'$process_name'_process.pdf", true);
?>
