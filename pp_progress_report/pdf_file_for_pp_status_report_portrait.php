
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


 date_default_timezone_set('Asia/Dhaka'); 
 $currnet_date = date("d-m-Y h:i:s a");

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
$this->setLeftMargin(6);

}

// Page footer
function Footer()
{
    $this->setLeftMargin(6);

    $this->SetFont('Times','',6);
    $this->SetY(-8);
    $this->SetTextColor(0,0,0);

    $this->Cell(0,5,'Page '.$this->PageNo().'/{nb}',0,1,'C');
    $this->SetFont('Arial','',6);
    // $this->SetAutoPageBreak(true, 10);

    $this->AcceptPageBreak();
}

}


$pp_number=$_GET['all_data'];
$process_loss_gain = 0.0;
$process_loss_gain_with_greige = 0.0;
$process_loss_gain_with_pp = 0.0;
$process_completion_date='';



                $sql_for_pp = "select distinct ppi.pp_num_id, ppi.pp_number, ppi.pp_creation_date, ppi.customer_id, ppi.customer_name, ppi.week_in_year, ppi.design,
                group_concat( distinct pwvci.construction_name, ',') construction_name,pwvci.percentage_of_cotton_content, pwvci.percentage_of_polyester_content, pwvci.percentage_of_other_fiber_content, pwvci.other_fiber_in_yarn, 
                sum(pwvci.pp_quantity) pp_quantity ,pwvci.greige_width_in_inch,
                pwvci.finish_width_in_inch, group_concat(distinct pwvci.process_technique_name, ', ') process_technique_name,
                (select date_format(min(ptftri.partial_test_for_test_result_creation_date), '%d-%b-%Y') start_date from partial_test_for_test_result_info  ptftri

                where  ptftri.process_id = 'proc_20' and ptftri.pp_number = '$pp_number') greige_issue_date, 
                (select date_format(max(ptftri.partial_test_for_test_result_creation_date), '%d-%b-%Y') start_date from partial_test_for_test_result_info  ptftri
                where  ptftri.process_id = 'proc_20' and ptftri.pp_number = '$pp_number') greige_completion_date,
                                            (select sum(ptftri.after_trolley_or_batcher_qty) total_process_qty from partial_test_for_test_result_info  ptftri, adding_process_to_version	aptv 
                                            where ptftri.pp_number = aptv.pp_number and ptftri.pp_number = '$pp_number' and ptftri.process_id = aptv.process_id 
                                            and ptftri.version_id = aptv.version_id  and aptv.process_or_reprocess = 'process') tot_process_qty,
                                            (select sum(ptftri.after_trolley_or_batcher_qty) total_reprocess_qty from partial_test_for_test_result_info  ptftri, adding_process_to_version	aptv 
                                            where ptftri.pp_number = aptv.pp_number and ptftri.pp_number = '$pp_number' and ptftri.process_name = aptv.process_name 
                                            and ptftri.version_id = aptv.version_id  and (aptv.process_or_reprocess = 're-process' or aptv.process_or_reprocess = '2nd-Re-Process' or aptv.process_or_reprocess = '3rd-Re-Process' or aptv.process_or_reprocess = '4th-Re-Process')) tot_reprocess_qty
                from process_program_info ppi, pp_wise_version_creation_info pwvci
                where
                ppi.pp_number = pwvci.pp_number
                and ppi.pp_number = '$pp_number'";


$result_for_pp= mysqli_query($con,$sql_for_pp) or die(mysqli_error($con));
$row_for_pp=mysqli_fetch_array($result_for_pp);

$serial='';




$pdf=new PDF('P','mm','A4');

$pdf->AliasNbPages();
$pdf->AddPage();
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
$pdf->Cell(300,4,"","0","0","C");
$pdf->Ln(2);
$pdf->setLeftMargin(6);
$pdf->SetFont('Times','B',18);
$pdf->Cell(200,10,"Processing Program Status","1","0","C");
$pdf->setLeftMargin(6);

$pdf->Ln(10);
$pdf->Cell(200,0,"","1","0","C");
$pdf->Ln(2);
$pdf->setLeftMargin(6);

$pdf->SetFont('Arial','B',9);
$pdf->Cell(52,6,"PP Issue Date:".$pdf->SetFillColor(220,220,220),"1","0","L",true);
$pdf->SetFont('Arial','',9);
$pdf->Cell(42,6,"".$row_for_pp['pp_creation_date'],"1","0","L");
$pdf->SetFont('Arial','B',9);
$pdf->Cell(63,6,"Week".$pdf->SetFillColor(220,220,220),"1","0","L",true);
$pdf->SetFont('Arial','',9);
$pdf->Cell(43,6,"".$row_for_pp['week_in_year'],"1","1","L");

$pdf->SetFont('Arial','B',9);
$pdf->Cell(52,6,"PP No.".$pdf->SetFillColor(220,220,220),"1","0","L",true);
$pdf->SetFont('Arial','',9);
$pdf->Cell(42,6,"".$row_for_pp['pp_number'],"1","0","L");
$pdf->SetFont('Arial','B',9);
$pdf->Cell(63,6,"Construction".$pdf->SetFillColor(220,220,220),"1","0","L",true);
$pdf->SetFont('Arial','',9);
$pdf->Cell(43,6,"".$row_for_pp['construction_name'],"1","1","L");

$pdf->SetFont('Arial','B',9);
$pdf->Cell(52,6,"Customer".$pdf->SetFillColor(220,220,220),"1","0","L",true);
$pdf->SetFont('Arial','',9);
$pdf->Cell(42,6,"".$row_for_pp['customer_name'],"1","0","L");
$pdf->SetFont('Arial','B',9);
$pdf->Cell(63,6,"Fiber Content".$pdf->SetFillColor(220,220,220),"LTR","0","L",true);
$pdf->SetFont('Arial','',9);
$pdf->Cell(43,6,"".$row_for_pp['percentage_of_cotton_content'].'% Cotton '.$row_for_pp['percentage_of_polyester_content'].'% Polyester',"LTR","1","L");

$pdf->SetFont('Arial','B',9);
$pdf->Cell(52,6,"Design".$pdf->SetFillColor(220,220,220),"1","0","L",true);
$pdf->SetFont('Arial','',9);
$pdf->Cell(42,6,"".$row_for_pp['design'],"1","0","L");
$pdf->SetFont('Arial','B',9);
$pdf->Cell(63,7,"".$pdf->SetFillColor(220,220,220),"LBR","0","L",true);
$pdf->SetFont('Arial','',9);
if($row_for_pp['other_fiber_in_yarn']=='Null')
{
    $pdf->Cell(43,6,"","LBR","1","L");
}
else
{
    $pdf->Cell(43,6,"".$row_for_pp['percentage_of_other_fiber_content'].'% '.' '.$row_for_pp['other_fiber_in_yarn'],"LBR","1","L");

}

$pdf->SetFont('Arial','B',9);
$pdf->Cell(52,6,"PP Qty.(mtr.)".$pdf->SetFillColor(220,220,220),"1","0","L",true);
$pdf->SetFont('Arial','',9);
$pdf->Cell(42,6,"".$row_for_pp['pp_quantity'],"1","0","L");
$pdf->SetFont('Arial','B',9);
$pdf->Cell(63,6,"Process Technique(s)".$pdf->SetFillColor(220,220,220),"1","0","L",true);
$pdf->SetFont('Arial','',9);
$pdf->Cell(43,6,"".$row_for_pp['process_technique_name'],"1","1","L");

$pdf->SetFont('Arial','B',9);
$pdf->Cell(52,6,"Greige Issue Date".$pdf->SetFillColor(220,220,220),"1","0","L",true);
$pdf->SetFont('Arial','',9);
$pdf->Cell(42,6,"".$row_for_pp['week_in_year'],"1","0","L");
$pdf->SetFont('Arial','B',9);
$pdf->Cell(63,6,"Process Loss/Gain Qty(mtr.) with PP".$pdf->SetFillColor(220,220,220),"1","0","L",true);
$pdf->SetFont('Arial','',9);
$pdf->Cell(43,6,"".$process_loss_gain_with_pp,"1","1","L");

$pdf->SetFont('Arial','B',9);
$pdf->Cell(52,6,"Greige Issuance Completion Date".$pdf->SetFillColor(220,220,220),"1","0","L",true);
$pdf->SetFont('Arial','',9);
$pdf->Cell(42,6,"".$row_for_pp['tot_process_qty'],"1","0","L");
$pdf->SetFont('Arial','B',9);
$pdf->Cell(63,6,"Process Loss/Gain Qty(mtr.) with Greige".$pdf->SetFillColor(220,220,220),"1","0","L",true);
$pdf->SetFont('Arial','',9);
$pdf->Cell(43,6,"".$process_loss_gain_with_greige,"1","1","L");


$pdf->SetFont('Arial','B',9);
$pdf->Cell(52,6,"Process Completion Date".$pdf->SetFillColor(220,220,220),"1","0","L",true);
$pdf->SetFont('Arial','',9);
$pdf->Cell(42,6,"".$process_completion_date,"1","0","L");
$pdf->SetFont('Arial','B',9);
$pdf->Cell(63,6,"Total Process Qty".$pdf->SetFillColor(220,220,220),"1","0","L",true);
$pdf->SetFont('Arial','',9);
$pdf->Cell(43,6,"".$row_for_pp['tot_process_qty'],"1","1","L");


$pdf->SetFont('Arial','B',9);
$pdf->Cell(52,6,"Process Lead Time(day)".$pdf->SetFillColor(220,220,220),"1","0","L",true);
$pdf->SetFont('Arial','',9);
$pdf->Cell(42,6,"".$row_for_pp['week_in_year'],"1","0","L");
$pdf->SetFont('Arial','B',9);
$pdf->Cell(63,6,"Total Reprocess Qty".$pdf->SetFillColor(220,220,220),"1","0","L",true);
$pdf->SetFont('Arial','',9);
$pdf->Cell(43,6,"".$row_for_pp['tot_reprocess_qty'],"1","1","L");

  /******************************************For Selecting Process ************************************************/
  $Serial=0;
  $sql_for_select_process="select DISTINCT ptftri.process_id
  from partial_test_for_test_result_info  ptftri
  where  ptftri.pp_number = '$pp_number'";

$result_for_select_process= mysqli_query($con,$sql_for_select_process) or die(mysqli_error($con));
while($row_for_select_process=mysqli_fetch_array($result_for_select_process)) 
{ 
    $greige_period = "select ptftri.pp_number, ptftri.process_id, date_format(min(ptftri.partial_test_for_test_result_creation_date), '%d-%b-%Y') start_date,
    date_format(max(ptftri.partial_test_for_test_result_creation_date), '%d-%b-%Y') end_date
    from partial_test_for_test_result_info  ptftri where  ptftri.process_id = 'proc_20' and ptftri.pp_number = '$pp_number'";
    $result_for_greige= mysqli_query($con,$greige_period) or die(mysqli_error($con));
    while($row = mysqli_fetch_array($result_for_greige))  
    { 
        if($row['end_date']!= '') $process_completion_date = $row['end_date'];


        /*********************************Create Greige Receiving Table**********************************/
        if($row_for_select_process["process_id"] == "proc_20")
        {
            $Serial+=1;
            $pdf->SetFont('Arial','B',14);
            $pdf->Ln(4);
            $pdf->Cell(200,7,$Serial.'.'.'  '.'Greige Issuance'.'   ('.$row["start_date"].' To '.$row["end_date"].')'.$pdf->SetFillColor(255,255,255),"0","1","L",true);
            $pdf->SetFont('Arial','B',9);
            // $pdf->Cell(0,0,$pdf->SetFillColor(255,255,255),0,0,'c',true);
            $pdf->Ln(2);
           

            $x = $pdf->GetX();
            $y = $pdf->GetY();
            $data = "Date";
            strlen($data)<15?$b=10:$b=5;
            $pdf->MultiCell(21,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
            $pdf->SetXY($x + 21, $y);
            $data = "Version";
            strlen($data)<15?$b=10:$b=5;
            $pdf->MultiCell(35,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
            $pdf->SetXY($x + 56, $y);
            $data = "Color";
            strlen($data)<15?$b=10:$b=5;
            $pdf->MultiCell(35,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
            $pdf->SetXY($x + 91, $y);
            $data = "Style";
            strlen($data)<15?$b=10:$b=5;
            $pdf->MultiCell(35,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
            $pdf->SetXY($x + 126, $y);
            $data = "G.W (inch)";
            strlen($data)<15?$b=10:$b=5;
            $pdf->MultiCell(18,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
            $pdf->SetXY($x + 144, $y);
            $data = "F.W (inch)";
            strlen($data)<15?$b=10:$b=5;
            $pdf->MultiCell(20,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
            $pdf->SetXY($x + 162, $y);
            $data = "Recv. qty. (mtr.)";
            strlen($data)<15?$b=10:$b=5;
            $pdf->MultiCell(18,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
            $pdf->SetXY($x + 180, $y);
            $data = "Process / Reprocess";
            strlen($data)<15?$b=10:$b=5;
            $pdf->MultiCell(20,$b,"$data".$pdf->SetFillColor(220,220,220),'1','C',TRUE);
            
            $pdf->Cell(0,0,$pdf->SetFillColor(255,255,255),'1','1','c',true);

            $pdf->SetFont('Arial','',9);


            $sql_for_greige = "select pp.pp_number, pp.version_name as version_number, pp.color, pp.style_name,  pp.gw, pp.fw, pp.pp_quantity, result.process_qty, result.date,
                            result.process_or_reprocess
                            from 
                            (
                            select distinct pwvci.pp_number, pwvci.version_id, pwvci.version_name, pwvci.style_name, pwvci.color, 
                                                        pwvci.finish_width_in_inch fw, pwvci.greige_width_in_inch gw, pwvci.pp_quantity  
                            from pp_wise_version_creation_info	pwvci
                            where  pwvci.pp_number = '$pp_number'
                            )pp
                            INNER JOIN 
                            (
                            select distinct  date_format(ptftri.partial_test_for_test_result_creation_date, '%d-%b-%Y') date, ptftri.pp_number, 
                                                        ptftri.version_id, ptftri.version_number, pwvci.style_name, pwvci.color, pwvci.finish_width_in_inch fw, 
                            pwvci.greige_width_in_inch gw, ptftri.after_trolley_or_batcher_qty process_qty,	
                            ptftri.after_trolley_number_or_batcher_number, ptftri.after_trolley_or_batcher_qty, 
                                                        ptftri.before_trolley_number_or_batcher_number, ptftri.before_trolley_or_batcher_qty, aptv.process_or_reprocess
                            from partial_test_for_test_result_info  ptftri, pp_wise_version_creation_info pwvci, adding_process_to_version aptv
                            where  ptftri.pp_number = pwvci.pp_number and ptftri.version_id = pwvci.version_id 
                            and  ptftri.style=pwvci.style_name and ptftri.finish_width_in_inch=pwvci.finish_width_in_inch
                            and ptftri.pp_number = aptv.pp_number and ptftri.version_id = aptv.version_id 
                            and ptftri.style=aptv.style_name and ptftri.finish_width_in_inch=aptv.finish_width_in_inch 
                            and ptftri.process_id=aptv.process_id and ptftri.process_id = 'proc_20' and ptftri.pp_number = '$pp_number'
                            )result
                            on pp.pp_number = result.pp_number	and pp.version_id = result.version_id
                            order by pp.pp_number, pp.version_id, pp.color, pp.style_name, pp.gw, pp.fw";

								$result_for_greige= mysqli_query($con,$sql_for_greige) or die(mysqli_error($con));
								while($row = mysqli_fetch_array($result_for_greige))  
								{ 
                                   
                                    $x = $pdf->GetX();
                                    $y = $pdf->GetY();
                                    $data = $row['date'];
                                    strlen($data)<20?$b=8:$b=4;
                                    $pdf->MultiCell(21,$b,$data,'1','C');
                                    $pdf->SetXY($x + 21, $y);
                                    $data = $row['version_number'];
                                    strlen($data)<20?$b=8:$b=4;
                                    $pdf->MultiCell(35,$b,$data,'1','C');
                                    $pdf->SetXY($x + 56, $y);
                                    $data = $row['color'];
                                    strlen($data)<20?$b=8:$b=4;
                                    $pdf->MultiCell(35,$b,$data,'1','C');
                                    $pdf->SetXY($x + 91, $y);
                                    $data = $row['style_name'];
                                    strlen($data)<20?$b=8:$b=4;
                                    $pdf->MultiCell(35,$b,$data,'1','C');
                                    $pdf->SetXY($x + 126, $y);
                                    $data = $row['gw'];
                                    strlen($data)<20?$b=8:$b=4;
                                    $pdf->MultiCell(18,$b,$data,'1','C');
                                    $pdf->SetXY($x + 144, $y);
                                    $data = $row['fw'];
                                    strlen($data)<20?$b=8:$b=4;
                                    $pdf->MultiCell(18,$b,$data,'1','C');
                                    $pdf->SetXY($x + 162, $y);
                                    $data = $row['process_qty'];
                                    strlen($data)<20?$b=8:$b=4;
                                    $pdf->MultiCell(18,$b,$data,'1','C');
                                    $pdf->SetXY($x + 180, $y);
                                    $data = $row['process_or_reprocess'];
                                    strlen($data)<20?$b=8:$b=4;
                                    $pdf->MultiCell(20,$b,$data,'1','C');
                                } 
                          // Width summary for greige receiving	
                                    $pdf->SetFont('Arial','B',11);
                                    $pdf->Ln(2);
                                    $pdf->Cell(200,7,"Width Summary".$pdf->SetFillColor(220,220,220),"1","1","C",true);
                                    $pdf->SetFont('Arial','B',9);

                                    $x = $pdf->GetX();
                                    $y = $pdf->GetY();
                                    $data = "G.W (inch)";
                                    strlen($data)<20?$b=10:$b=5;
                                    $pdf->MultiCell(30,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                    $pdf->SetXY($x + 30, $y);
                                    $data = "F.W (inch)";
                                    strlen($data)<20?$b=10:$b=5;
                                    $pdf->MultiCell(30,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                    $pdf->SetXY($x + 60, $y);
                                    $data = "PP Qty. (mtr.)";
                                    strlen($data)<20?$b=10:$b=5;
                                    $pdf->MultiCell(30,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                    $pdf->SetXY($x + 90, $y);
                                    $data = "Recv. Qty. (mtr.)";
                                    strlen($data)<20?$b=10:$b=5;
                                    $pdf->MultiCell(30,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                    $pdf->SetXY($x + 120, $y);
                                    $data = "(+/-) From PP Qty. (mtr)";
                                    strlen($data)<25?$b=10:$b=5;
                                    $pdf->MultiCell(40,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                    $pdf->SetXY($x + 160, $y);
                                    $data = "(+/-) From PP Qty (%)";
                                    strlen($data)<25?$b=10:$b=5;
                                    $pdf->MultiCell(40,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                    $pdf->SetXY($x + 200, $y);
                                    
                                    $pdf->Cell(0,0,$pdf->SetFillColor(255,255,255),'1','1','C',true);
                                    $pdf->SetFont('Arial','',9);       
                                    $pdf->Ln(10);
                                    $sql_for_greige = "select pp.pp_number,  pp.gw, pp.fw, pp.pp_quantity, result.process_qty,
                                    (result.process_qty-pp.pp_quantity) short_excess_qty,
                                    round((((result.process_qty-pp.pp_quantity)/result.process_qty)*100),2) short_qty_percent 
                                    from 
                                    (
                                    select distinct pwvci.pp_number,  pwvci.finish_width_in_inch fw, 
                                    pwvci.greige_width_in_inch gw, sum(pwvci.pp_quantity) pp_quantity 
                                    from pp_wise_version_creation_info	pwvci
                                    where  pwvci.pp_number = '$pp_number' 
                                    group by pwvci.pp_number, pwvci.finish_width_in_inch, pwvci.greige_width_in_inch
                                    )pp
                                    INNER JOIN
                                    (
                                    select distinct  ptftri.pp_number, pwvci.finish_width_in_inch fw, 
                                    pwvci.greige_width_in_inch gw,  sum(ptftri.after_trolley_or_batcher_qty) process_qty	
                                    from partial_test_for_test_result_info  ptftri, pp_wise_version_creation_info pwvci
                                    where  ptftri.pp_number = pwvci.pp_number and ptftri.version_id = pwvci.version_id 
                                    and  ptftri.style=pwvci.style_name and ptftri.finish_width_in_inch=pwvci.finish_width_in_inch
                                    and ptftri.process_id = 'proc_20' and ptftri.pp_number = '$pp_number'
                                    group by ptftri.pp_number, pwvci.finish_width_in_inch, pwvci.greige_width_in_inch
                                    )result                         
                                    on pp.pp_number = result.pp_number and pp.fw = result.fw and pp.gw = result.gw order by pp.pp_number, pp.gw, pp.fw";
                    $result_for_greige= mysqli_query($con,$sql_for_greige) or die(mysqli_error($con));
                    while($row = mysqli_fetch_array($result_for_greige))  
                    {
                                    $x = $pdf->GetX();
                                    $y = $pdf->GetY();
                                    $data = $row['gw'];
                                    strlen($data)<20?$b=8:$b=4;
                                    $pdf->MultiCell(30,$b,$data,'1','C');
                                    $pdf->SetXY($x + 30, $y);
                                    $data = $row['fw'];
                                    strlen($data)<20?$b=8:$b=4;
                                    $pdf->MultiCell(30,$b,$data,'1','C');
                                    $pdf->SetXY($x + 60, $y);
                                    $data = $row['pp_quantity'];
                                    strlen($data)<20?$b=8:$b=4;
                                    $pdf->MultiCell(30,$b,$data,'1','C');
                                    $pdf->SetXY($x + 90, $y);
                                    $data = $row['process_qty'];
                                    strlen($data)<20?$b=8:$b=4;
                                    $pdf->MultiCell(30,$b,$data,'1','C');
                                    $pdf->SetXY($x + 120, $y);
                                    $data = $row['short_excess_qty'];
                                    strlen($data)<20?$b=8:$b=4;
                                    $pdf->MultiCell(40,$b,$data,'1','C');
                                    $pdf->SetXY($x + 160, $y);
                                    $data = $row['short_qty_percent'];
                                    strlen($data)<20?$b=8:$b=4;
                                    $pdf->MultiCell(40,$b,$data,'1','C');
                    }
                                    
                    // Version summary for greige receiving
                                    $pdf->SetFont('Arial','B',11);
                                    $pdf->Ln(2);
                                    $pdf->Cell(200,7,"Version Summary".$pdf->SetFillColor(220,220,220),"1","1","C",true);
                                    $pdf->SetFont('Arial','B',9);
                   
                                    $x = $pdf->GetX();
                                    $y = $pdf->GetY();
                                    $data = "Version";
                                    strlen($data)<30?$b=10:$b=5;
                                    $pdf->MultiCell(35,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                    $pdf->SetXY($x + 35, $y);
                                    $data = "Color";
                                    strlen($data)<30?$b=10:$b=5;
                                    $pdf->MultiCell(35,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                    $pdf->SetXY($x + 70, $y);
                                    $data = "Style";
                                    strlen($data)<30?$b=10:$b=5;
                                    $pdf->MultiCell(35,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                    $pdf->SetXY($x + 105, $y);
                                    $data = "PP Qty. (mtr.)";
                                    strlen($data)<15?$b=10:$b=5;
                                    $pdf->MultiCell(23,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                    $pdf->SetXY($x + 128, $y);
                                    $data = "Recv. Qty. (mtr.)";
                                    strlen($data)<25?$b=10:$b=5;
                                    $pdf->MultiCell(27,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                    $pdf->SetXY($x + 155, $y);
                                    $data = "(+/-) From PP";
                                    strlen($data)<10?$b=10:$b=5;
                                    $pdf->MultiCell(45,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                    $pdf->SetXY($x + 155, $y+5);
                                    $data = "Qty (mtr.)";
                                    // strlen($data)<15?$b=10:$b=5;
                                    $pdf->MultiCell(25,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                    $pdf->SetXY($x + 180, $y+5);
                                    $data = "%";
                                    // strlen($data)<15?$b=10:$b=5;
                                    $pdf->MultiCell(20,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                    $pdf->SetXY($x + 180, $y);
                                   
                                    $pdf->Cell(0,0,$pdf->SetFillColor(255,255,255),'1','1','C',true);
                                    $pdf->SetFont('Arial','',9); 
                                    $sql_for_greige = "select pp.pp_number, pp.version_name, pp.style_name, pp.color, pp.gw, pp.fw, pp.pp_quantity, result.process_qty,
                                    (result.process_qty-pp.pp_quantity) short_greige_qty,
                                    round((((result.process_qty-pp.pp_quantity)/pp.pp_quantity)*100),2)short_greige_per 
                                    from 
                                    (
                                    select distinct pwvci.pp_number,  pwvci.version_name, pwvci.finish_width_in_inch fw, 
                                    pwvci.greige_width_in_inch gw, pwvci.style_name, pwvci.color, sum(pwvci.pp_quantity) pp_quantity 
                                    from pp_wise_version_creation_info	pwvci
                                    where  pwvci.pp_number = '$pp_number' 
                                    group by pwvci.pp_number, pwvci.version_name
                                    )pp
                                    INNER JOIN
                                    (
                                    select distinct  ptftri.pp_number, ptftri.version_number, pwvci.finish_width_in_inch fw, 
                                    pwvci.greige_width_in_inch gw, pwvci.style_name, pwvci.color, sum(ptftri.after_trolley_or_batcher_qty) process_qty	
                                    from partial_test_for_test_result_info  ptftri, pp_wise_version_creation_info pwvci
                                    where  ptftri.pp_number = pwvci.pp_number and ptftri.version_id = pwvci.version_id 
                                    and  ptftri.style=pwvci.style_name and ptftri.finish_width_in_inch=pwvci.finish_width_in_inch
                                    and ptftri.process_id = 'proc_20' and ptftri.pp_number = '$pp_number'
                                    group by ptftri.pp_number, ptftri.version_number
                                    )result
                                    on pp.pp_number = result.pp_number and pp.version_name = result.version_number";
                                    $result_for_greige= mysqli_query($con,$sql_for_greige) or die(mysqli_error($con));
                                    while($row = mysqli_fetch_array($result_for_greige))  
                                    {  
                                        $pdf->Ln(10);
                                        $x = $pdf->GetX();
                                        $y = $pdf->GetY();
                                        $data = $row['version_name'];
                                        strlen($data)<20?$b=8:$b=4;
                                        $pdf->MultiCell(35,$b,$data,'1','C');
                                        $pdf->SetXY($x + 35, $y);
                                        $data = $row['color'];
                                        strlen($data)<20?$b=8:$b=4;
                                        $pdf->MultiCell(35,$b,$data,'1','C');
                                        $pdf->SetXY($x + 70, $y);
                                        $data = $row['style_name'];
                                        strlen($data)<20?$b=8:$b=4;
                                        $pdf->MultiCell(35,$b,$data,'1','C');
                                        $pdf->SetXY($x + 105, $y);
                                        $data = $row['pp_quantity'];
                                        strlen($data)<15?$b=8:$b=4;
                                        $pdf->MultiCell(23,$b,$data,'1','C');
                                        $pdf->SetXY($x + 128, $y);
                                        $data = $row['process_qty'];
                                        strlen($data)<15?$b=8:$b=4;
                                        $pdf->MultiCell(27,$b,$data,'1','C');
                                        $pdf->SetXY($x + 155, $y);
                                        $data = $row['short_greige_qty'];
                                        strlen($data)<20?$b=8:$b=4;
                                        $pdf->MultiCell(25,$b,$data,'1','C');
                                        $pdf->SetXY($x + 180, $y);
                                        $data = $row['short_greige_per'];
                                        strlen($data)<20?$b=8:$b=4;
                                        $pdf->MultiCell(20,$b,$data,'1','C');
                                    }

                                    $sql_for_greige = "select total.pp_number, sum(total.pp_quantity) pp_quantity, sum(total.process_qty) process_qty, 
                                    -- sum(total.short_greige_qty) short_greige_qty ,  sum(total.short_greige_per) short_excess_qty,
                                    (sum(total.process_qty)- sum(total.pp_quantity)) short_excess_qty,
                                    round((((sum(total.process_qty)-sum(total.pp_quantity))/sum(total.pp_quantity))*100),2) short_qty_percent
                                    from
                                    (
                                    select pp.pp_number, pp.version_name, pp.style_name, pp.color, pp.gw, pp.fw, pp.pp_quantity, result.process_qty,
                                    (result.process_qty-pp.pp_quantity) short_greige_qty,
                                    round((((result.process_qty-pp.pp_quantity)/pp.pp_quantity)*100),2)short_greige_per 
                                    from 
                                    (
                                    select distinct pwvci.pp_number,  pwvci.version_name, pwvci.finish_width_in_inch fw, 
                                    pwvci.greige_width_in_inch gw, pwvci.style_name, pwvci.color, sum(pwvci.pp_quantity) pp_quantity 
                                    from pp_wise_version_creation_info	pwvci
                                    where  pwvci.pp_number = '$pp_number' 
                                    group by pwvci.pp_number, pwvci.version_name
                                    )pp, 
                                    (
                                    select distinct  ptftri.pp_number, ptftri.version_number, pwvci.finish_width_in_inch fw, 
                                    pwvci.greige_width_in_inch gw, pwvci.style_name, pwvci.color, sum(ptftri.after_trolley_or_batcher_qty) process_qty	
                                    from partial_test_for_test_result_info  ptftri, pp_wise_version_creation_info pwvci
                                    where  ptftri.pp_number = pwvci.pp_number and ptftri.version_id = pwvci.version_id 
                                    and  ptftri.style=pwvci.style_name and ptftri.finish_width_in_inch=pwvci.finish_width_in_inch
                                    and ptftri.process_id = 'proc_20' and ptftri.pp_number = '$pp_number'
                                    group by ptftri.pp_number, ptftri.version_number
                                    )result
                                    where pp.pp_number = result.pp_number and pp.version_name = result.version_number) total";
                                                        $result_for_greige= mysqli_query($con,$sql_for_greige) or die(mysqli_error($con));
                                                        while($row = mysqli_fetch_array($result_for_greige))  
                                                        {
                                                            $pdf->SetFont('Arial','B',9); 
                                                            $x = $pdf->GetX();
                                                            $y = $pdf->GetY();
                                                            $data = "Greige Total Qty.(mtr.)";
                                                            strlen($data)<70?$b=8:$b=4;
                                                            $pdf->MultiCell(105,$b,$data,'1','C');
                                                            $pdf->SetXY($x + 105, $y);
                                                            $data = $row['pp_quantity'];
                                                            strlen($data)<20?$b=8:$b=4;
                                                            $pdf->MultiCell(23,$b,$data,'1','C');
                                                            $pdf->SetXY($x + 128, $y);
                                                            $data = $row['process_qty'];
                                                            strlen($data)<20?$b=8:$b=4;
                                                            $pdf->MultiCell(27,$b,$data,'1','C');
                                                            $pdf->SetXY($x + 155, $y);
                                                            $data = $row['short_excess_qty'];
                                                            strlen($data)<20?$b=8:$b=4;
                                                            $pdf->MultiCell(25,$b,$data,'1','C');
                                                            $pdf->SetXY($x + 180, $y);
                                                            $data = $row['short_qty_percent'];
                                                            strlen($data)<20?$b=8:$b=4;
                                                            $pdf->MultiCell(20,$b,$data,'1','C');  

                                                            if($row['short_excess_qty']!= '') 
                                                                {
                                                                    $process_loss_gain+=$row['short_excess_qty'];
                                                                }
                                                    
                                                                $Total_pp_quantity = $row['pp_quantity'];
                                                                $Total_greige_quantity = $row['process_qty'];
												         
                                                        }
        // $pdf->AliasNbPages();
        // $pdf->AddPage();
        // $pdf->AcceptPageBreak();
        // $pdf->SetAutoPageBreak(true, 10);
        // $pdf->setTopMargin(0);
        // $pdf->setLeftMargin(6);


        }
        
       
        
        /*********************************Create Singing & Desizing (Process No- 1) Table**********************************/

        $greige_period = "select ptftri.pp_number, ptftri.process_id, date_format(min(ptftri.partial_test_for_test_result_creation_date), '%d-%b-%Y') start_date,
					date_format(max(ptftri.partial_test_for_test_result_creation_date), '%d-%b-%Y') end_date
					from partial_test_for_test_result_info  ptftri
					where  ptftri.process_id = 'proc_1' and ptftri.pp_number = '$pp_number'  
						";

					$result_for_greige= mysqli_query($con,$greige_period) or die(mysqli_error($con));
					while($row = mysqli_fetch_array($result_for_greige))  
					{  
                        if($row['end_date']!= '') $process_completion_date = $row['end_date'];

                        if($row_for_select_process["process_id"] == "proc_1")
                        {
                            $Serial+=1;
                            $pdf->SetFont('Arial','B',14);
                            $pdf->Ln(6);
                            $pdf->Cell(200,7,$Serial.'.'.'  '.'Singeing & Desizing'.'   ('.$row["start_date"].' To '.$row["end_date"].')'.$pdf->SetFillColor(255,255,255),"0","1","L",true);
                            $pdf->SetFont('Arial','B',9);
                            $pdf->Ln(2);
                           
                
                            $x = $pdf->GetX();
                            $y = $pdf->GetY();
                            $data = "Date";
                            strlen($data)<15?$b=10:$b=5;
                            $pdf->MultiCell(21,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                            $pdf->SetXY($x + 21, $y);
                            $data = "Version";
                            strlen($data)<15?$b=10:$b=5;
                            $pdf->MultiCell(30,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                            $pdf->SetXY($x + 51, $y);
                            $data = "Color";
                            strlen($data)<15?$b=10:$b=5;
                            $pdf->MultiCell(30,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                            $pdf->SetXY($x + 81, $y);
                            $data = "Style";
                            strlen($data)<15?$b=10:$b=5;
                            $pdf->MultiCell(29,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                            $pdf->SetXY($x + 110, $y);
                            $data = "G.W (inch)";
                            strlen($data)<15?$b=10:$b=5;
                            $pdf->MultiCell(18,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                            $pdf->SetXY($x + 128, $y);
                            $data = "F.W (inch)";
                            strlen($data)<15?$b=10:$b=5;
                            $pdf->MultiCell(18,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                            $pdf->SetXY($x + 146, $y);
                            $data = "A. B/T No.";
                            strlen($data)<15?$b=10:$b=5;
                            $pdf->MultiCell(18,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                            $pdf->SetXY($x + 164, $y);
                            $data = "Process Qty.(mtr.)";
                            strlen($data)<15?$b=10:$b=5;
                            $pdf->MultiCell(17,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                            $pdf->SetXY($x + 181, $y);
                            $data = "Process / Reprocess";
                            strlen($data)<15?$b=10:$b=5;
                            $pdf->MultiCell(19,$b,"$data".$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                            // $pdf->SetXY($x + 194, $y);

                            $pdf->Cell(200,0,$pdf->SetFillColor(255,255,255),'1','1','c',true);
                
                            $pdf->SetFont('Arial','',9);


                            $sql_for_singe_desize = "select pp.pp_number, pp.version_name as version_number, pp.color, pp.style_name, pp.gw, pp.fw, pp.pp_quantity, result.after_trolley_or_batcher_qty, result.date, 
                            result.process_or_reprocess, result.after_trolley_number_or_batcher_number, result.before_trolley_number_or_batcher_number, result.before_trolley_or_batcher_qty, 
                            (result.after_trolley_or_batcher_qty-result.before_trolley_or_batcher_qty) short_proc, 
                            round((((result.after_trolley_or_batcher_qty-result.before_trolley_or_batcher_qty)/result.before_trolley_or_batcher_qty)*100),2)short_percent 
                            from (select distinct pwvci.pp_number, pwvci.version_id, pwvci.version_name, pwvci.style_name, pwvci.color, pwvci.finish_width_in_inch fw,
                             pwvci.greige_width_in_inch gw, pwvci.pp_quantity from pp_wise_version_creation_info pwvci where pwvci.pp_number = '$pp_number' )pp 
                            
                            INNER JOIN 
                            (select distinct date_format(ptftri.partial_test_for_test_result_creation_date, '%d-%b-%Y') date, ptftri.pp_number, ptftri.version_id, ptftri.version_number, 
                            pwvci.style_name, pwvci.color, pwvci.finish_width_in_inch fw, pwvci.greige_width_in_inch gw, ptftri.after_trolley_or_batcher_qty, ptftri.after_trolley_number_or_batcher_number, 
                            ptftri.before_trolley_number_or_batcher_number, ptftri.before_trolley_or_batcher_qty, aptv.process_or_reprocess 
                            
                            from partial_test_for_test_result_info ptftri, pp_wise_version_creation_info pwvci, adding_process_to_version aptv 
                            
                            where ptftri.pp_number = pwvci.pp_number and ptftri.version_id = pwvci.version_id and ptftri.style=pwvci.style_name and ptftri.finish_width_in_inch=pwvci.finish_width_in_inch and 
                            ptftri.pp_number = aptv.pp_number and ptftri.version_id = aptv.version_id and ptftri.style=aptv.style_name  and ptftri.process_name=aptv.process_name and ptftri.process_id = 'proc_1'
                             and ptftri.pp_number = '$pp_number')result 
                            
                            on pp.pp_number = result.pp_number and pp.version_id = result.version_id  order by result.date, pp.pp_number, pp.version_id, pp.color, pp.style_name, pp.gw, pp.fw;";
                             
            
                            
                                                            $result_for_singe_desize= mysqli_query($con,$sql_for_singe_desize) or die(mysqli_error($con));
                                                            while($row = mysqli_fetch_array($result_for_singe_desize))  
                                                            {
                                                                $x = $pdf->GetX();
                                                                $y = $pdf->GetY();
                                                                $data = $row['date'];
                                                                strlen($data)<20?$b=8:$b=4;
                                                                $pdf->MultiCell(21,$b,$data,'1','C');
                                                                $pdf->SetXY($x + 21, $y);
                                                                $data = $row['version_number'];
                                                                strlen($data)<20?$b=8:$b=4;
                                                                $pdf->MultiCell(30,$b,$data,'1','C');
                                                                $pdf->SetXY($x + 51, $y);
                                                                $data = $row['color'];
                                                                strlen($data)<20?$b=8:$b=4;
                                                                $pdf->MultiCell(30,$b,$data,'1','C');
                                                                $pdf->SetXY($x + 81, $y);
                                                                $data = $row['style_name'];
                                                                strlen($data)<20?$b=8:$b=4;
                                                                $pdf->MultiCell(29,$b,$data,'1','C');
                                                                $pdf->SetXY($x + 110, $y);
                                                                $data = $row['gw'];
                                                                strlen($data)<20?$b=8:$b=4;
                                                                $pdf->MultiCell(18,$b,$data,'1','C');
                                                                $pdf->SetXY($x + 128, $y);
                                                                $data = $row['fw'];
                                                                strlen($data)<20?$b=8:$b=4;
                                                                $pdf->MultiCell(18,$b,$data,'1','C');
                                                                $pdf->SetXY($x + 146, $y);
                                                                $data = $row['after_trolley_number_or_batcher_number'];
                                                                strlen($data)<20?$b=8:$b=4;
                                                                $pdf->MultiCell(18,$b,$data,'1','C');
                                                                $pdf->SetXY($x + 164, $y);
                                                                $data = $row['after_trolley_or_batcher_qty'];
                                                                strlen($data)<20?$b=8:$b=4;
                                                                $pdf->MultiCell(17,$b,$data,'1','C');
                                                                $pdf->SetXY($x + 181, $y);
                                                                $data = $row['process_or_reprocess'];
                                                                strlen($data)<20?$b=8:$b=4;
                                                                $pdf->MultiCell(19,$b,$data,'1','C'); 
                                                            }
                                                    // Width summary for signe and Desizing	
                                                    $pdf->SetFont('Arial','B',11);
                                                    $pdf->Ln(2);
                                                    $pdf->Cell(200,7,"Width Summary".$pdf->SetFillColor(220,220,220),"1","1","C",true);
                                                    $pdf->SetFont('Arial','B',9);

                                                    $x = $pdf->GetX();
                                                    $y = $pdf->GetY();
                                                    $data = "G.W (inch)";
                                                    strlen($data)<20?$b=10:$b=5;
                                                    $pdf->MultiCell(20,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                                    $pdf->SetXY($x + 20, $y);
                                                    $data = "F.W (inch)";
                                                    strlen($data)<20?$b=10:$b=5;
                                                    $pdf->MultiCell(20,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                                    $pdf->SetXY($x + 40, $y);
                                                    $data = "PP Qty. (mtr.)";
                                                    strlen($data)<20?$b=10:$b=5;
                                                    $pdf->MultiCell(24,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                                    $pdf->SetXY($x + 64, $y);
                                                    $data = "B. Process Qty (mtr.)";
                                                    strlen($data)<15?$b=10:$b=5;
                                                    $pdf->MultiCell(26,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                                    $pdf->SetXY($x + 90, $y);
                                                    $data = "Process Qty. (mtr.)";
                                                    strlen($data)<18?$b=10:$b=5;
                                                    $pdf->MultiCell(25,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                                    $pdf->SetXY($x + 115, $y);
                                                    $data = "(+/-) From PP";
                                                    // strlen($data)<15?$b=10:$b=5;
                                                    $pdf->MultiCell(40,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                                    $pdf->SetXY($x + 115, $y+5);
                                                    $data = "Qty (mtr.)";
                                                    // strlen($data)<15?$b=10:$b=5;
                                                    $pdf->MultiCell(22,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                                    $pdf->SetXY($x + 137, $y+5);
                                                    $data = "%";
                                                    // strlen($data)<15?$b=10:$b=5;
                                                    $pdf->MultiCell(18,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                                    $pdf->SetXY($x + 155, $y);
                                                    $data = "(+/-) From Greige";
                                                    // strlen($data)<15?$b=10:$b=5;
                                                    $pdf->MultiCell(45,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                                    $pdf->SetXY($x + 155, $y+5);
                                                    $data = "Qty (mtr.)";
                                                    // strlen($data)<15?$b=10:$b=5;
                                                    $pdf->MultiCell(25,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                                    $pdf->SetXY($x + 180, $y+5);
                                                    $data = "%";
                                                    // strlen($data)<15?$b=10:$b=5;
                                                    $pdf->MultiCell(20,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                                    $pdf->SetXY($x + 200, $y);
                                                    
                                                    // $pdf->Cell(0,0,$pdf->SetFillColor(255,255,255),'1','1','C',true);
                                                    $pdf->SetFont('Arial','',9);       
                                                     $pdf->Ln(10);
                                                   
                                                    $sql_for_greige = "select pp.pp_number, pp.gw, pp.fw, pp.pp_quantity, result.process_qty, result.before_process_qty, result.gray_process_qty,
                                                    (result.process_qty - pp.pp_quantity) short_pp_qty, round((((result.process_qty - pp.pp_quantity)/pp.pp_quantity)*100),2) short_pp_percent, 
                                                    (result.process_qty-result.gray_process_qty) short_gre_rcv_qty, 
                                                    round((((result.process_qty-result.gray_process_qty)/result.gray_process_qty)*100),2) short_gre_rcv_percent,
                                                    (result.process_qty-result.before_process_qty) short_pre_proc_qty, 
                                                    round((((result.process_qty-result.before_process_qty)/result.before_process_qty)*100),2) short_pre_proc_percent
                                                    from (select distinct pwvci.pp_number, pwvci.finish_width_in_inch fw, pwvci.greige_width_in_inch gw, sum(pwvci.pp_quantity) pp_quantity 
                                                    from pp_wise_version_creation_info pwvci where pwvci.pp_number = '$pp_number' group by pwvci.pp_number,
                                                    pwvci.finish_width_in_inch, pwvci.greige_width_in_inch )pp 
                                                    INNER JOIN (SELECT distinct ptftri_1.process_id,ptftri_1.pp_number, fw,  gw
                                                    ,sum(ptftri_1.after_trolley_or_batcher_qty) process_qty
                                                    , sum(ptftri_1.before_trolley_or_batcher_qty) before_process_qty
                                                    ,(SELECT sum(ptv.after_trolley_or_batcher_qty) process_qty from partial_test_for_test_result_info ptv 
                                                    where  ptv.pp_number = ptftri_1.pp_number  and ptv.process_id = 'proc_20' and fw = ptv.finish_width_in_inch) gray_process_qty 
                                                    FROM
                                                    partial_test_for_test_result_info ptftri_1
                                                    inner join (
                                                    SELECT ptftri.process_id,ptftri.pp_number, pwvci.finish_width_in_inch fw, pwvci.greige_width_in_inch gw,ptftri.version_id
                                                    ,max(ptftri.partial_test_for_test_result_creation_date) max_date
                                                    from partial_test_for_test_result_info ptftri, pp_wise_version_creation_info pwvci
                                                    where ptftri.pp_number = pwvci.pp_number and ptftri.version_id = pwvci.version_id and ptftri.style=pwvci.style_name
                                                    and ptftri.finish_width_in_inch=pwvci.finish_width_in_inch 
                                                    and ptftri.process_id = 'proc_1' and ptftri.pp_number = '$pp_number'
                                                    group by ptftri.pp_number, pwvci.finish_width_in_inch, pwvci.greige_width_in_inch,ptftri.version_id )P
                                                    where  1=1
                                                    and ptftri_1.process_id = p.process_id
                                                    and ptftri_1.pp_number = p.pp_number
                                                    and ptftri_1.version_id = p.version_id
                                                    and ptftri_1.partial_test_for_test_result_creation_date = p.max_date
                                                    group by process_id,pp_number, fw,  gw)result 
                                                    on pp.pp_number = result.pp_number and pp.fw = result.fw and pp.gw = result.gw 
                                                    order by pp.pp_number, pp.gw, pp.fw";
                                                    
                                                $result_for_greige= mysqli_query($con,$sql_for_greige) or die(mysqli_error($con));
                                                while($row = mysqli_fetch_array($result_for_greige))  
                                                {
                                                    $x = $pdf->GetX();
                                                    $y = $pdf->GetY();
                                                    $data = $row['gw'];
                                                    strlen($data)<20?$b=8:$b=4;
                                                    $pdf->MultiCell(20,$b,$data,'1','C');
                                                    $pdf->SetXY($x + 20, $y);
                                                    $data = $row['fw'];
                                                    strlen($data)<20?$b=8:$b=4;
                                                    $pdf->MultiCell(20,$b,$data,'1','C');
                                                    $pdf->SetXY($x + 40, $y);
                                                    $data = $row['pp_quantity'];
                                                    strlen($data)<20?$b=8:$b=4;
                                                    $pdf->MultiCell(24,$b,$data,'1','C');
                                                    $pdf->SetXY($x + 64, $y);
                                                    $data = $row['before_process_qty'];
                                                    strlen($data)<20?$b=8:$b=4;
                                                    $pdf->MultiCell(26,$b,$data,'1','C');
                                                    $pdf->SetXY($x + 90, $y);
                                                    $data = $row['process_qty'];
                                                    strlen($data)<20?$b=8:$b=4;
                                                    $pdf->MultiCell(25,$b,$data,'1','C');
                                                    $pdf->SetXY($x + 115, $y);
                                                    $data = $row['short_pp_qty'];
                                                    strlen($data)<15?$b=8:$b=4;
                                                    $pdf->MultiCell(22,$b,$data,'1','C');
                                                    $pdf->SetXY($x + 137, $y);
                                                    $data = $row['short_pp_percent'];
                                                    strlen($data)<15?$b=8:$b=4;
                                                    $pdf->MultiCell(18,$b,$data,'1','C');
                                                    $pdf->SetXY($x + 155, $y);
                                                    $data = $row['short_gre_rcv_qty'];
                                                    strlen($data)<15?$b=8:$b=4;
                                                    $pdf->MultiCell(25,$b,$data,'1','C');
                                                    $pdf->SetXY($x + 180, $y);
                                                    $data = $row['short_gre_rcv_percent'];
                                                    strlen($data)<15?$b=8:$b=4;
                                                    $pdf->MultiCell(20,$b,$data,'1','C');
                                                    // $pdf->SetXY($x + 200, $y);

                                                }
                                                    // Version summary for Signe and Desizing

                                                    $pdf->SetFont('Arial','B',11);
                                                    $pdf->Ln(2);
                                                    $pdf->setLeftMargin(6);
                                                    $pdf->Cell(200,7,"Version Summary".$pdf->SetFillColor(220,220,220),"1","1","C",true);
                                                    $pdf->SetFont('Arial','B',9);
                                                    $pdf->setLeftMargin(6);
                                                    $x = $pdf->GetX();
                                                    $y = $pdf->GetY();
                                                    $data = "Version";
                                                    strlen($data)<15?$b=10:$b=5;
                                                    $pdf->MultiCell(28,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                                    $pdf->SetXY($x + 28, $y);
                                                    $data = "Color";
                                                    strlen($data)<15?$b=10:$b=5;
                                                    $pdf->MultiCell(25,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                                    $pdf->SetXY($x + 53, $y);
                                                    $data = "Style";
                                                    strlen($data)<15?$b=10:$b=5;
                                                    $pdf->MultiCell(25,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                                    $pdf->SetXY($x + 78, $y);
                                                    $data = "PP Qty (mtr.)";
                                                    strlen($data)<10?$b=10:$b=5;
                                                    $pdf->MultiCell(18,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                                    $pdf->SetXY($x + 96, $y);
                                                    $data = "B. process Qty (mtr.)";
                                                    strlen($data)<10?$b=10:$b=5;
                                                    $pdf->MultiCell(19,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                                    $pdf->SetXY($x + 115, $y);
                                                    $data = "Process Qty (mtr.)";
                                                    strlen($data)<15?$b=10:$b=5;
                                                    $pdf->MultiCell(17,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                                    $pdf->SetXY($x + 132, $y);
                                                    $data = "(+/-) From PP";
                                                    strlen($data)<10?$b=10:$b=5;
                                                    $pdf->MultiCell(34,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                                    $pdf->SetXY($x + 132, $y+5);
                                                    $data = "Qty (mtr.)";
                                                    // strlen($data)<15?$b=10:$b=5;
                                                    $pdf->MultiCell(20,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                                    $pdf->SetXY($x + 152, $y+5);
                                                    $data = "%";
                                                    // strlen($data)<15?$b=10:$b=5;
                                                    $pdf->MultiCell(14,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                                    $pdf->SetXY($x + 166, $y);
                                                    $data = "(+/-) From Greige";
                                                    strlen($data)<10?$b=10:$b=5;
                                                    $pdf->MultiCell(34,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                                    $pdf->SetXY($x + 166, $y+5);
                                                    $data = "Qty (mtr.)";
                                                    // strlen($data)<15?$b=10:$b=5;
                                                    $pdf->MultiCell(20,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                                    $pdf->SetXY($x + 186, $y+5);
                                                    $data = "%";
                                                    // strlen($data)<15?$b=10:$b=5;
                                                    $pdf->MultiCell(14,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                                    $pdf->SetXY($x + 200, $y);
                                                    
                                                    $pdf->Cell(0,0,$pdf->SetFillColor(255,255,255),'1','1','C',true);
                                                    $pdf->SetFont('Arial','',9);       
                                                    $pdf->Ln(10);
                        $sql_for_greige = "select pp.pp_number, pp.version_name version_number, pp.style_name, pp.color, pp.gw, pp.fw, pp.pp_quantity, result.process_qty, result.before_process_qty, result.gray_process_qty, 
                        (result.process_qty-pp.pp_quantity) short_pp, 
                        round((((result.process_qty-pp.pp_quantity)/pp.pp_quantity)*100),2)short_pp_percent, 
                        (result.process_qty-result.gray_process_qty) short_gre_rcv_qty, 
                        round((((result.process_qty-result.gray_process_qty)/result.gray_process_qty)*100),2)short_gre_rcv_percent, 
                        (result.process_qty-result.before_process_qty) short_pre_proc_qty, 
                        round((((result.process_qty-result.before_process_qty)/result.before_process_qty)*100),2)short_pre_proc_percent 
            
                        from (select distinct pwvci.pp_number, pwvci.version_name, pwvci.finish_width_in_inch fw, pwvci.greige_width_in_inch gw, pwvci.style_name, pwvci.color, 
                        sum(pwvci.pp_quantity) pp_quantity from pp_wise_version_creation_info pwvci where pwvci.pp_number = '$pp_number' group by pwvci.pp_number, pwvci.version_name )pp 
            
                        INNER JOIN 
                        (SELECT distinct ptftri_1.process_id,ptftri_1.pp_number , version_name, ptftri_1.finish_width_in_inch,
                        sum(ptftri_1.after_trolley_or_batcher_qty) process_qty,
                        sum(ptftri_1.before_trolley_or_batcher_qty) before_process_qty,
                        (SELECT sum(ptv.after_trolley_or_batcher_qty) process_qty from partial_test_for_test_result_info ptv 
                        where ptv.pp_number = ptftri_1.pp_number and ptv.process_id = 'proc_20' and version_name = ptv.version_number) gray_process_qty 
                        FROM
                        partial_test_for_test_result_info ptftri_1
                        inner join (
                        SELECT ptftri.process_id, ptftri.pp_number pp_number, ptftri.version_number version_name, ptftri.finish_width_in_inch finish_width_in_inch,
                        max(ptftri.partial_test_for_test_result_creation_date) max_date
                        from partial_test_for_test_result_info ptftri, pp_wise_version_creation_info pwvci
                        where ptftri.pp_number = pwvci.pp_number and ptftri.version_number = pwvci.version_name and ptftri.style=pwvci.style_name
                        and ptftri.finish_width_in_inch=pwvci.finish_width_in_inch 
                        and ptftri.process_id = 'proc_1' and ptftri.pp_number = '$pp_number'
                        group by ptftri.pp_number, ptftri.version_number, ptftri.finish_width_in_inch )P
                        where  1=1
                        and ptftri_1.process_id = p.process_id
                        and ptftri_1.pp_number = p.pp_number
                        and ptftri_1.version_number = p.version_name
                        and ptftri_1.partial_test_for_test_result_creation_date = p.max_date
                        and ptftri_1.finish_width_in_inch = p.finish_width_in_inch
                        group by process_id,pp_number, version_name)result 
            
                        on pp.pp_number = result.pp_number and pp.version_name = result.version_name
                        order by pp.pp_number, pp.version_name";
                        $result_for_greige= mysqli_query($con,$sql_for_greige) or die(mysqli_error($con));
                        while($row = mysqli_fetch_array($result_for_greige))  
                        {  
                            $x = $pdf->GetX();
                            $y = $pdf->GetY();
                            $data = $row['version_number'];
                            strlen($data)<20?$b=8:$b=4;
                            $pdf->MultiCell(28,$b,$data,'1','C');
                            $pdf->SetXY($x + 28, $y);
                            $data = $row['color'];
                            strlen($data)<20?$b=8:$b=4;
                            $pdf->MultiCell(25,$b,$data,'1','C');
                            $pdf->SetXY($x + 53, $y);
                            $data = $row['style_name'];
                            strlen($data)<20?$b=8:$b=4;
                            $pdf->MultiCell(25,$b,$data,'1','C');
                            $pdf->SetXY($x + 78, $y);
                            $data = $row['pp_quantity'];
                            strlen($data)<20?$b=8:$b=4;
                            $pdf->MultiCell(18,$b,$data,'1','C');
                            $pdf->SetXY($x + 96, $y);
                            $data = $row['before_process_qty'];
                            strlen($data)<20?$b=8:$b=4;
                            $pdf->MultiCell(19,$b,$data,'1','C');
                            $pdf->SetXY($x + 115, $y);
                            $data = $row['process_qty'];
                            strlen($data)<20?$b=8:$b=4;
                            $pdf->MultiCell(17,$b,$data,'1','C');
                            $pdf->SetXY($x + 132, $y);
                            $data = $row['short_pp'];
                            strlen($data)<15?$b=8:$b=4;
                            $pdf->MultiCell(20,$b,$data,'1','C');
                            $pdf->SetXY($x + 152, $y);
                            $data = $row['short_pp_percent'];
                            strlen($data)<15?$b=8:$b=4;
                            $pdf->MultiCell(14,$b,$data,'1','C');
                            $pdf->SetXY($x + 166, $y);
                            $data = $row['short_gre_rcv_qty'];
                            strlen($data)<15?$b=8:$b=4;
                            $pdf->MultiCell(20,$b,$data,'1','C');
                            $pdf->SetXY($x + 186, $y);
                            $data = $row['short_gre_rcv_percent'];
                            strlen($data)<15?$b=8:$b=4;
                            $pdf->MultiCell(14,$b,$data,'1','C');
                            // $pdf->SetXY($x + 200, $y);

                        }

                        $sql_for_greige = "select total.pp_number, sum(total.pp_quantity) pp_quantity, sum(total.process_qty) process_qty, 
                        sum(total.before_process_qty) before_process_qty, sum(total.gray_process_qty) gray_process_qty, 
                        (sum(total.process_qty)-sum(total.pp_quantity)) short_pp_qty, 
                        round((((sum(total.process_qty)-sum(total.pp_quantity))/sum(total.pp_quantity))*100),2) short_pp_percent, 
                        (sum(total.process_qty)-sum(total.gray_process_qty)) short_gre_rcv_qty, 
                        round((((sum(total.process_qty)-sum(total.gray_process_qty))/sum(total.pp_quantity))*100),2) short_gre_rcv_percent, 
                        (sum(total.process_qty)-sum(total.before_process_qty)) short_pre_proc_qty, 
                        round((((sum(total.process_qty)-sum(total.before_process_qty))/sum(total.before_process_qty))*100),2) short_pre_proc_percent 
                
                        from ( select pp.pp_number, pp.version_name, pp.style_name, pp.color, pp.gw, pp.fw, pp.pp_quantity, result.process_qty, result.before_process_qty, 
                        result.gray_process_qty from 
                        ( select distinct pwvci.pp_number, pwvci.version_name, pwvci.finish_width_in_inch fw, pwvci.greige_width_in_inch gw, pwvci.style_name, pwvci.color, 
                        sum(pwvci.pp_quantity) pp_quantity from pp_wise_version_creation_info pwvci where pwvci.pp_number = '$pp_number' group by pwvci.pp_number, pwvci.version_name )pp,
                
                        (SELECT distinct ptftri_1.process_id,ptftri_1.pp_number , version_name, ptftri_1.finish_width_in_inch,
                        sum(ptftri_1.after_trolley_or_batcher_qty) process_qty,
                        sum(ptftri_1.before_trolley_or_batcher_qty) before_process_qty,
                        (SELECT sum(ptv.after_trolley_or_batcher_qty) process_qty from partial_test_for_test_result_info ptv 
                        where ptv.pp_number = ptftri_1.pp_number and ptv.process_id = 'proc_20' and version_name = ptv.version_number) gray_process_qty 
                        FROM
                        partial_test_for_test_result_info ptftri_1
                        inner join (
                        SELECT ptftri.process_id, ptftri.pp_number pp_number, ptftri.version_number version_name, ptftri.finish_width_in_inch finish_width_in_inch,
                        max(ptftri.partial_test_for_test_result_creation_date) max_date
                        from partial_test_for_test_result_info ptftri, pp_wise_version_creation_info pwvci
                        where ptftri.pp_number = pwvci.pp_number and ptftri.version_number = pwvci.version_name and ptftri.style=pwvci.style_name
                        and ptftri.finish_width_in_inch=pwvci.finish_width_in_inch 
                        and ptftri.process_id = 'proc_1' and ptftri.pp_number = '$pp_number'
                        group by ptftri.pp_number, ptftri.version_number, ptftri.finish_width_in_inch )P
                        where  1=1
                        and ptftri_1.process_id = p.process_id
                        and ptftri_1.pp_number = p.pp_number
                        and ptftri_1.version_number = p.version_name
                        and ptftri_1.partial_test_for_test_result_creation_date = p.max_date
                        and ptftri_1.finish_width_in_inch = p.finish_width_in_inch
                        group by process_id,pp_number, version_name)result where pp.pp_number = result.pp_number and pp.version_name = result.version_name ) total
                        ";
                                            $result_for_greige= mysqli_query($con,$sql_for_greige) or die(mysqli_error($con));
                                            while($row = mysqli_fetch_array($result_for_greige))  
                                            {
                                                $pdf->SetFont('Arial','B',9); 
                                                $x = $pdf->GetX();
                                                $y = $pdf->GetY();
                                                $data = "Singeing & Desizing Total Qty.(mtr.)";
                                                strlen($data)<70?$b=8:$b=4;
                                                $pdf->MultiCell(78,$b,$data,'1','C');
                                                $pdf->SetXY($x + 78, $y);
                                                $data = $row['pp_quantity'];
                                                strlen($data)<20?$b=8:$b=4;
                                                $pdf->MultiCell(18,$b,$data,'1','C');
                                                $pdf->SetXY($x + 96, $y);
                                                $data = $row['before_process_qty'];
                                                strlen($data)<20?$b=8:$b=4;
                                                $pdf->MultiCell(19,$b,$data,'1','C');
                                                $pdf->SetXY($x + 115, $y);
                                                $data = $row['process_qty'];
                                                strlen($data)<20?$b=8:$b=4;
                                                $pdf->MultiCell(17,$b,$data,'1','C');
                                                $pdf->SetXY($x + 132, $y);
                                                $data = $row['short_pp_qty'];
                                                strlen($data)<20?$b=8:$b=4;
                                                $pdf->MultiCell(20,$b,$data,'1','C');
                                                $pdf->SetXY($x + 152, $y);
                                                $data = $row['short_pp_percent'];
                                                strlen($data)<20?$b=8:$b=4;
                                                $pdf->MultiCell(14,$b,$data,'1','C'); 
                                                $pdf->SetXY($x + 166, $y); 
                                                $data = $row['short_gre_rcv_qty'];
                                                strlen($data)<20?$b=8:$b=4;
                                                $pdf->MultiCell(20,$b,$data,'1','C');
                                                $pdf->SetXY($x + 186, $y);
                                                $data = $row['short_gre_rcv_percent'];
                                                strlen($data)<20?$b=8:$b=4;
                                                $pdf->MultiCell(14,$b,$data,'1','C');  

                                                if($row['short_excess_qty']!= '') 
                                                    {
                                                        $process_loss_gain+=$row['short_excess_qty'];
                                                    }
                                        
                                                    $Total_pp_quantity = $row['pp_quantity'];
                                                    $Total_greige_quantity = $row['process_qty'];
                                             
                                            }

                        }
                    }

                     /*********************************Create Scouring and Bleaching (Process No- 4) Table**********************************/

        $greige_period = "select ptftri.pp_number, ptftri.process_id, date_format(min(ptftri.partial_test_for_test_result_creation_date), '%d-%b-%Y') start_date,
        date_format(max(ptftri.partial_test_for_test_result_creation_date), '%d-%b-%Y') end_date
        from partial_test_for_test_result_info  ptftri
        where  ptftri.process_id = 'proc_4' and ptftri.pp_number = '$pp_number' ";

        $result_for_greige= mysqli_query($con,$greige_period) or die(mysqli_error($con));
        while($row = mysqli_fetch_array($result_for_greige))  
        {  
            if($row['end_date']!= '') 
            {
                $process_completion_date = $row['end_date'];
            }

            if($row_for_select_process["process_id"] == "proc_4")
            {
                $Serial+=1;
                $pdf->SetFont('Arial','B',14);
                $pdf->Ln(6);
                $pdf->Cell(200,7,$Serial.'.'.'  '.'Scouring & Bleaching'.'   ('.$row["start_date"].' To '.$row["end_date"].')'.$pdf->SetFillColor(255,255,255),"0","1","L",true);
                $pdf->SetFont('Arial','B',9);
                $pdf->Ln(2);
               
    
                $x = $pdf->GetX();
                $y = $pdf->GetY();
                $data = "Date";
                strlen($data)<15?$b=10:$b=5;
                $pdf->MultiCell(21,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                $pdf->SetXY($x + 21, $y);
                $data = "Version";
                strlen($data)<15?$b=10:$b=5;
                $pdf->MultiCell(20,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                $pdf->SetXY($x + 49, $y);
                $data = "Color";
                strlen($data)<15?$b=10:$b=5;
                $pdf->MultiCell(23,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                $pdf->SetXY($x + 72, $y);
                $data = "Style";
                strlen($data)<15?$b=10:$b=5;
                $pdf->MultiCell(23,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                $pdf->SetXY($x + 95, $y);
                $data = "G.W (inch)";
                strlen($data)<10?$b=10:$b=5;
                $pdf->MultiCell(12,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                $pdf->SetXY($x + 107, $y);
                $data = "F.W (inch)";
                strlen($data)<10?$b=10:$b=5;
                $pdf->MultiCell(12,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                $pdf->SetXY($x + 119, $y);
                $data = "B. B/T No.";
                strlen($data)<10?$b=10:$b=5;
                $pdf->MultiCell(15,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                $pdf->SetXY($x + 134, $y);
                $data = "B.Proc Qty";
                strlen($data)<10?$b=10:$b=5;
                $pdf->MultiCell(18,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                $pdf->SetXY($x + 152, $y);
                $data = "A. B/T No.";
                strlen($data)<10?$b=10:$b=5;
                $pdf->MultiCell(15,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                $pdf->SetXY($x + 167, $y);
                $data = "A.Proc Qty";
                strlen($data)<10?$b=10:$b=5;
                $pdf->MultiCell(15,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                $pdf->SetXY($x + 182, $y);
                $data = "Proc Qty";
                strlen($data)<10?$b=10:$b=5;
                $pdf->MultiCell(17,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                $pdf->SetXY($x + 197, $y);
                $data = "Proc / Reproc";
                strlen($data)<10?$b=10:$b=5;
                $pdf->MultiCell(15,$b,"$data".$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                // $pdf->SetXY($x + 194, $y);

                $pdf->Cell(200,0,$pdf->SetFillColor(255,255,255),'1','1','c',true);
    
                $pdf->SetFont('Arial','',9);

          
            //     $sql_for_singe_desize = "select pp.pp_number, pp.version_name as version_number, pp.color, pp.style_name, pp.gw, pp.fw, pp.pp_quantity, result.after_trolley_or_batcher_qty, result.date, 
            //     result.process_or_reprocess, result.after_trolley_number_or_batcher_number, result.before_trolley_number_or_batcher_number, result.before_trolley_or_batcher_qty, 
            //     (result.after_trolley_or_batcher_qty-result.before_trolley_or_batcher_qty) short_proc, 
            //     round((((result.after_trolley_or_batcher_qty-result.before_trolley_or_batcher_qty)/result.before_trolley_or_batcher_qty)*100),2)short_percent 
            //     from (select distinct pwvci.pp_number, pwvci.version_id, pwvci.version_name, pwvci.style_name, pwvci.color, pwvci.finish_width_in_inch fw,
            //      pwvci.greige_width_in_inch gw, pwvci.pp_quantity from pp_wise_version_creation_info pwvci where pwvci.pp_number = '$pp_number' )pp 
                
            //     INNER JOIN 
            //     (select distinct date_format(ptftri.partial_test_for_test_result_creation_date, '%d-%b-%Y') date, ptftri.pp_number, ptftri.version_id, ptftri.version_number, 
            //     pwvci.style_name, pwvci.color, pwvci.finish_width_in_inch fw, pwvci.greige_width_in_inch gw, ptftri.after_trolley_or_batcher_qty, ptftri.after_trolley_number_or_batcher_number, 
            //     ptftri.before_trolley_number_or_batcher_number, ptftri.before_trolley_or_batcher_qty, aptv.process_or_reprocess 
                
            //     from partial_test_for_test_result_info ptftri, pp_wise_version_creation_info pwvci, adding_process_to_version aptv 
                
            //     where ptftri.pp_number = pwvci.pp_number and ptftri.version_id = pwvci.version_id and ptftri.style=pwvci.style_name and ptftri.finish_width_in_inch=pwvci.finish_width_in_inch and 
            //     ptftri.pp_number = aptv.pp_number and ptftri.version_id = aptv.version_id and ptftri.style=aptv.style_name  and ptftri.process_name=aptv.process_name and ptftri.process_id = 'proc_1'
            //      and ptftri.pp_number = '$pp_number')result 
                
            //     on pp.pp_number = result.pp_number and pp.version_id = result.version_id  order by result.date, pp.pp_number, pp.version_id, pp.color, pp.style_name, pp.gw, pp.fw;";
                 

                
            //                                     $result_for_singe_desize= mysqli_query($con,$sql_for_singe_desize) or die(mysqli_error($con));
            //                                     while($row = mysqli_fetch_array($result_for_singe_desize))  
            //                                     {
            //                                         $x = $pdf->GetX();
            //                                         $y = $pdf->GetY();
            //                                         $data = $row['date'];
            //                                         strlen($data)<20?$b=8:$b=4;
            //                                         $pdf->MultiCell(21,$b,$data,'1','C');
            //                                         $pdf->SetXY($x + 21, $y);
            //                                         $data = $row['version_number'];
            //                                         strlen($data)<20?$b=8:$b=4;
            //                                         $pdf->MultiCell(30,$b,$data,'1','C');
            //                                         $pdf->SetXY($x + 51, $y);
            //                                         $data = $row['color'];
            //                                         strlen($data)<20?$b=8:$b=4;
            //                                         $pdf->MultiCell(30,$b,$data,'1','C');
            //                                         $pdf->SetXY($x + 81, $y);
            //                                         $data = $row['style_name'];
            //                                         strlen($data)<20?$b=8:$b=4;
            //                                         $pdf->MultiCell(29,$b,$data,'1','C');
            //                                         $pdf->SetXY($x + 110, $y);
            //                                         $data = $row['gw'];
            //                                         strlen($data)<20?$b=8:$b=4;
            //                                         $pdf->MultiCell(18,$b,$data,'1','C');
            //                                         $pdf->SetXY($x + 128, $y);
            //                                         $data = $row['fw'];
            //                                         strlen($data)<20?$b=8:$b=4;
            //                                         $pdf->MultiCell(18,$b,$data,'1','C');
            //                                         $pdf->SetXY($x + 146, $y);
            //                                         $data = $row['after_trolley_number_or_batcher_number'];
            //                                         strlen($data)<20?$b=8:$b=4;
            //                                         $pdf->MultiCell(18,$b,$data,'1','C');
            //                                         $pdf->SetXY($x + 164, $y);
            //                                         $data = $row['after_trolley_or_batcher_qty'];
            //                                         strlen($data)<20?$b=8:$b=4;
            //                                         $pdf->MultiCell(17,$b,$data,'1','C');
            //                                         $pdf->SetXY($x + 181, $y);
            //                                         $data = $row['process_or_reprocess'];
            //                                         strlen($data)<20?$b=8:$b=4;
            //                                         $pdf->MultiCell(19,$b,$data,'1','C'); 
            //                                     }
            //                             // Width summary for signe and Desizing	
            //                             $pdf->SetFont('Arial','B',11);
            //                             $pdf->Ln(2);
            //                             $pdf->Cell(200,7,"Width Summary".$pdf->SetFillColor(220,220,220),"1","1","C",true);
            //                             $pdf->SetFont('Arial','B',9);

            //                             $x = $pdf->GetX();
            //                             $y = $pdf->GetY();
            //                             $data = "G.W (inch)";
            //                             strlen($data)<20?$b=10:$b=5;
            //                             $pdf->MultiCell(20,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
            //                             $pdf->SetXY($x + 20, $y);
            //                             $data = "F.W (inch)";
            //                             strlen($data)<20?$b=10:$b=5;
            //                             $pdf->MultiCell(20,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
            //                             $pdf->SetXY($x + 40, $y);
            //                             $data = "PP Qty. (mtr.)";
            //                             strlen($data)<20?$b=10:$b=5;
            //                             $pdf->MultiCell(24,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
            //                             $pdf->SetXY($x + 64, $y);
            //                             $data = "B. Process Qty (mtr.)";
            //                             strlen($data)<15?$b=10:$b=5;
            //                             $pdf->MultiCell(26,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
            //                             $pdf->SetXY($x + 90, $y);
            //                             $data = "Process Qty. (mtr.)";
            //                             strlen($data)<18?$b=10:$b=5;
            //                             $pdf->MultiCell(25,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
            //                             $pdf->SetXY($x + 115, $y);
            //                             $data = "(+/-) From PP";
            //                             // strlen($data)<15?$b=10:$b=5;
            //                             $pdf->MultiCell(40,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
            //                             $pdf->SetXY($x + 115, $y+5);
            //                             $data = "Qty (mtr.)";
            //                             // strlen($data)<15?$b=10:$b=5;
            //                             $pdf->MultiCell(22,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
            //                             $pdf->SetXY($x + 137, $y+5);
            //                             $data = "%";
            //                             // strlen($data)<15?$b=10:$b=5;
            //                             $pdf->MultiCell(18,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
            //                             $pdf->SetXY($x + 155, $y);
            //                             $data = "(+/-) From Greige";
            //                             // strlen($data)<15?$b=10:$b=5;
            //                             $pdf->MultiCell(45,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
            //                             $pdf->SetXY($x + 155, $y+5);
            //                             $data = "Qty (mtr.)";
            //                             // strlen($data)<15?$b=10:$b=5;
            //                             $pdf->MultiCell(25,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
            //                             $pdf->SetXY($x + 180, $y+5);
            //                             $data = "%";
            //                             // strlen($data)<15?$b=10:$b=5;
            //                             $pdf->MultiCell(20,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
            //                             $pdf->SetXY($x + 200, $y);
                                        
            //                             // $pdf->Cell(0,0,$pdf->SetFillColor(255,255,255),'1','1','C',true);
            //                             $pdf->SetFont('Arial','',9);       
            //                              $pdf->Ln(10);
                                       
            //                             $sql_for_greige = "select pp.pp_number, pp.gw, pp.fw, pp.pp_quantity, result.process_qty, result.before_process_qty, result.gray_process_qty,
            //                             (result.process_qty - pp.pp_quantity) short_pp_qty, round((((result.process_qty - pp.pp_quantity)/pp.pp_quantity)*100),2) short_pp_percent, 
            //                             (result.process_qty-result.gray_process_qty) short_gre_rcv_qty, 
            //                             round((((result.process_qty-result.gray_process_qty)/result.gray_process_qty)*100),2) short_gre_rcv_percent,
            //                             (result.process_qty-result.before_process_qty) short_pre_proc_qty, 
            //                             round((((result.process_qty-result.before_process_qty)/result.before_process_qty)*100),2) short_pre_proc_percent
            //                             from (select distinct pwvci.pp_number, pwvci.finish_width_in_inch fw, pwvci.greige_width_in_inch gw, sum(pwvci.pp_quantity) pp_quantity 
            //                             from pp_wise_version_creation_info pwvci where pwvci.pp_number = '$pp_number' group by pwvci.pp_number,
            //                             pwvci.finish_width_in_inch, pwvci.greige_width_in_inch )pp 
            //                             INNER JOIN (SELECT distinct ptftri_1.process_id,ptftri_1.pp_number, fw,  gw
            //                             ,sum(ptftri_1.after_trolley_or_batcher_qty) process_qty
            //                             , sum(ptftri_1.before_trolley_or_batcher_qty) before_process_qty
            //                             ,(SELECT sum(ptv.after_trolley_or_batcher_qty) process_qty from partial_test_for_test_result_info ptv 
            //                             where  ptv.pp_number = ptftri_1.pp_number  and ptv.process_id = 'proc_20' and fw = ptv.finish_width_in_inch) gray_process_qty 
            //                             FROM
            //                             partial_test_for_test_result_info ptftri_1
            //                             inner join (
            //                             SELECT ptftri.process_id,ptftri.pp_number, pwvci.finish_width_in_inch fw, pwvci.greige_width_in_inch gw,ptftri.version_id
            //                             ,max(ptftri.partial_test_for_test_result_creation_date) max_date
            //                             from partial_test_for_test_result_info ptftri, pp_wise_version_creation_info pwvci
            //                             where ptftri.pp_number = pwvci.pp_number and ptftri.version_id = pwvci.version_id and ptftri.style=pwvci.style_name
            //                             and ptftri.finish_width_in_inch=pwvci.finish_width_in_inch 
            //                             and ptftri.process_id = 'proc_1' and ptftri.pp_number = '$pp_number'
            //                             group by ptftri.pp_number, pwvci.finish_width_in_inch, pwvci.greige_width_in_inch,ptftri.version_id )P
            //                             where  1=1
            //                             and ptftri_1.process_id = p.process_id
            //                             and ptftri_1.pp_number = p.pp_number
            //                             and ptftri_1.version_id = p.version_id
            //                             and ptftri_1.partial_test_for_test_result_creation_date = p.max_date
            //                             group by process_id,pp_number, fw,  gw)result 
            //                             on pp.pp_number = result.pp_number and pp.fw = result.fw and pp.gw = result.gw 
            //                             order by pp.pp_number, pp.gw, pp.fw";
                                        
            //                         $result_for_greige= mysqli_query($con,$sql_for_greige) or die(mysqli_error($con));
            //                         while($row = mysqli_fetch_array($result_for_greige))  
            //                         {
            //                             $x = $pdf->GetX();
            //                             $y = $pdf->GetY();
            //                             $data = $row['gw'];
            //                             strlen($data)<20?$b=8:$b=4;
            //                             $pdf->MultiCell(20,$b,$data,'1','C');
            //                             $pdf->SetXY($x + 20, $y);
            //                             $data = $row['fw'];
            //                             strlen($data)<20?$b=8:$b=4;
            //                             $pdf->MultiCell(20,$b,$data,'1','C');
            //                             $pdf->SetXY($x + 40, $y);
            //                             $data = $row['pp_quantity'];
            //                             strlen($data)<20?$b=8:$b=4;
            //                             $pdf->MultiCell(24,$b,$data,'1','C');
            //                             $pdf->SetXY($x + 64, $y);
            //                             $data = $row['before_process_qty'];
            //                             strlen($data)<20?$b=8:$b=4;
            //                             $pdf->MultiCell(26,$b,$data,'1','C');
            //                             $pdf->SetXY($x + 90, $y);
            //                             $data = $row['process_qty'];
            //                             strlen($data)<20?$b=8:$b=4;
            //                             $pdf->MultiCell(25,$b,$data,'1','C');
            //                             $pdf->SetXY($x + 115, $y);
            //                             $data = $row['short_pp_qty'];
            //                             strlen($data)<15?$b=8:$b=4;
            //                             $pdf->MultiCell(22,$b,$data,'1','C');
            //                             $pdf->SetXY($x + 137, $y);
            //                             $data = $row['short_pp_percent'];
            //                             strlen($data)<15?$b=8:$b=4;
            //                             $pdf->MultiCell(18,$b,$data,'1','C');
            //                             $pdf->SetXY($x + 155, $y);
            //                             $data = $row['short_gre_rcv_qty'];
            //                             strlen($data)<15?$b=8:$b=4;
            //                             $pdf->MultiCell(25,$b,$data,'1','C');
            //                             $pdf->SetXY($x + 180, $y);
            //                             $data = $row['short_gre_rcv_percent'];
            //                             strlen($data)<15?$b=8:$b=4;
            //                             $pdf->MultiCell(20,$b,$data,'1','C');
            //                             // $pdf->SetXY($x + 200, $y);

            //                         }
            //                             // Version summary for Signe and Desizing
            //                             $pdf->SetFont('Arial','B',11);
            //                             $pdf->Ln(2);
            //                             $pdf->setLeftMargin(6);
            //                             $pdf->Cell(200,7,"Version Summary".$pdf->SetFillColor(220,220,220),"1","1","C",true);
            //                             $pdf->SetFont('Arial','B',9);
            //                             $pdf->setLeftMargin(6);
            //                             $x = $pdf->GetX();
            //                             $y = $pdf->GetY();
            //                             $data = "Version";
            //                             strlen($data)<15?$b=10:$b=5;
            //                             $pdf->MultiCell(28,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
            //                             $pdf->SetXY($x + 28, $y);
            //                             $data = "Color";
            //                             strlen($data)<15?$b=10:$b=5;
            //                             $pdf->MultiCell(25,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
            //                             $pdf->SetXY($x + 53, $y);
            //                             $data = "Style";
            //                             strlen($data)<15?$b=10:$b=5;
            //                             $pdf->MultiCell(25,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
            //                             $pdf->SetXY($x + 78, $y);
            //                             $data = "PP Qty (mtr.)";
            //                             strlen($data)<10?$b=10:$b=5;
            //                             $pdf->MultiCell(18,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
            //                             $pdf->SetXY($x + 96, $y);
            //                             $data = "B. process Qty (mtr.)";
            //                             strlen($data)<10?$b=10:$b=5;
            //                             $pdf->MultiCell(19,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
            //                             $pdf->SetXY($x + 115, $y);
            //                             $data = "Process Qty (mtr.)";
            //                             strlen($data)<15?$b=10:$b=5;
            //                             $pdf->MultiCell(17,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
            //                             $pdf->SetXY($x + 132, $y);
            //                             $data = "(+/-) From PP";
            //                             strlen($data)<10?$b=10:$b=5;
            //                             $pdf->MultiCell(34,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
            //                             $pdf->SetXY($x + 132, $y+5);
            //                             $data = "Qty (mtr.)";
            //                             // strlen($data)<15?$b=10:$b=5;
            //                             $pdf->MultiCell(20,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
            //                             $pdf->SetXY($x + 152, $y+5);
            //                             $data = "%";
            //                             // strlen($data)<15?$b=10:$b=5;
            //                             $pdf->MultiCell(14,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
            //                             $pdf->SetXY($x + 166, $y);
            //                             $data = "(+/-) From Greige";
            //                             strlen($data)<10?$b=10:$b=5;
            //                             $pdf->MultiCell(34,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
            //                             $pdf->SetXY($x + 166, $y+5);
            //                             $data = "Qty (mtr.)";
            //                             // strlen($data)<15?$b=10:$b=5;
            //                             $pdf->MultiCell(20,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
            //                             $pdf->SetXY($x + 186, $y+5);
            //                             $data = "%";
            //                             // strlen($data)<15?$b=10:$b=5;
            //                             $pdf->MultiCell(14,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
            //                             $pdf->SetXY($x + 200, $y);
                                        
            //                             $pdf->Cell(0,0,$pdf->SetFillColor(255,255,255),'1','1','C',true);
            //                             $pdf->SetFont('Arial','',9);       
            //                             $pdf->Ln(10);
            // $sql_for_greige = "select pp.pp_number, pp.version_name version_number, pp.style_name, pp.color, pp.gw, pp.fw, pp.pp_quantity, result.process_qty, result.before_process_qty, result.gray_process_qty, 
            // (result.process_qty-pp.pp_quantity) short_pp, 
            // round((((result.process_qty-pp.pp_quantity)/pp.pp_quantity)*100),2)short_pp_percent, 
            // (result.process_qty-result.gray_process_qty) short_gre_rcv_qty, 
            // round((((result.process_qty-result.gray_process_qty)/result.gray_process_qty)*100),2)short_gre_rcv_percent, 
            // (result.process_qty-result.before_process_qty) short_pre_proc_qty, 
            // round((((result.process_qty-result.before_process_qty)/result.before_process_qty)*100),2)short_pre_proc_percent 

            // from (select distinct pwvci.pp_number, pwvci.version_name, pwvci.finish_width_in_inch fw, pwvci.greige_width_in_inch gw, pwvci.style_name, pwvci.color, 
            // sum(pwvci.pp_quantity) pp_quantity from pp_wise_version_creation_info pwvci where pwvci.pp_number = '$pp_number' group by pwvci.pp_number, pwvci.version_name )pp 

            // INNER JOIN 
            // (SELECT distinct ptftri_1.process_id,ptftri_1.pp_number , version_name, ptftri_1.finish_width_in_inch,
            // sum(ptftri_1.after_trolley_or_batcher_qty) process_qty,
            // sum(ptftri_1.before_trolley_or_batcher_qty) before_process_qty,
            // (SELECT sum(ptv.after_trolley_or_batcher_qty) process_qty from partial_test_for_test_result_info ptv 
            // where ptv.pp_number = ptftri_1.pp_number and ptv.process_id = 'proc_20' and version_name = ptv.version_number) gray_process_qty 
            // FROM
            // partial_test_for_test_result_info ptftri_1
            // inner join (
            // SELECT ptftri.process_id, ptftri.pp_number pp_number, ptftri.version_number version_name, ptftri.finish_width_in_inch finish_width_in_inch,
            // max(ptftri.partial_test_for_test_result_creation_date) max_date
            // from partial_test_for_test_result_info ptftri, pp_wise_version_creation_info pwvci
            // where ptftri.pp_number = pwvci.pp_number and ptftri.version_number = pwvci.version_name and ptftri.style=pwvci.style_name
            // and ptftri.finish_width_in_inch=pwvci.finish_width_in_inch 
            // and ptftri.process_id = 'proc_1' and ptftri.pp_number = '$pp_number'
            // group by ptftri.pp_number, ptftri.version_number, ptftri.finish_width_in_inch )P
            // where  1=1
            // and ptftri_1.process_id = p.process_id
            // and ptftri_1.pp_number = p.pp_number
            // and ptftri_1.version_number = p.version_name
            // and ptftri_1.partial_test_for_test_result_creation_date = p.max_date
            // and ptftri_1.finish_width_in_inch = p.finish_width_in_inch
            // group by process_id,pp_number, version_name)result 

            // on pp.pp_number = result.pp_number and pp.version_name = result.version_name
            // order by pp.pp_number, pp.version_name";
            // $result_for_greige= mysqli_query($con,$sql_for_greige) or die(mysqli_error($con));
            // while($row = mysqli_fetch_array($result_for_greige))  
            // {  
            //     $x = $pdf->GetX();
            //     $y = $pdf->GetY();
            //     $data = $row['version_number'];
            //     strlen($data)<20?$b=8:$b=4;
            //     $pdf->MultiCell(28,$b,$data,'1','C');
            //     $pdf->SetXY($x + 28, $y);
            //     $data = $row['color'];
            //     strlen($data)<20?$b=8:$b=4;
            //     $pdf->MultiCell(25,$b,$data,'1','C');
            //     $pdf->SetXY($x + 53, $y);
            //     $data = $row['style_name'];
            //     strlen($data)<20?$b=8:$b=4;
            //     $pdf->MultiCell(25,$b,$data,'1','C');
            //     $pdf->SetXY($x + 78, $y);
            //     $data = $row['pp_quantity'];
            //     strlen($data)<20?$b=8:$b=4;
            //     $pdf->MultiCell(18,$b,$data,'1','C');
            //     $pdf->SetXY($x + 96, $y);
            //     $data = $row['before_process_qty'];
            //     strlen($data)<20?$b=8:$b=4;
            //     $pdf->MultiCell(19,$b,$data,'1','C');
            //     $pdf->SetXY($x + 115, $y);
            //     $data = $row['process_qty'];
            //     strlen($data)<20?$b=8:$b=4;
            //     $pdf->MultiCell(17,$b,$data,'1','C');
            //     $pdf->SetXY($x + 132, $y);
            //     $data = $row['short_pp'];
            //     strlen($data)<15?$b=8:$b=4;
            //     $pdf->MultiCell(20,$b,$data,'1','C');
            //     $pdf->SetXY($x + 152, $y);
            //     $data = $row['short_pp_percent'];
            //     strlen($data)<15?$b=8:$b=4;
            //     $pdf->MultiCell(14,$b,$data,'1','C');
            //     $pdf->SetXY($x + 166, $y);
            //     $data = $row['short_gre_rcv_qty'];
            //     strlen($data)<15?$b=8:$b=4;
            //     $pdf->MultiCell(20,$b,$data,'1','C');
            //     $pdf->SetXY($x + 186, $y);
            //     $data = $row['short_gre_rcv_percent'];
            //     strlen($data)<15?$b=8:$b=4;
            //     $pdf->MultiCell(14,$b,$data,'1','C');
            //     // $pdf->SetXY($x + 200, $y);

            // }

            // $sql_for_greige = "select total.pp_number, sum(total.pp_quantity) pp_quantity, sum(total.process_qty) process_qty, 
            // sum(total.before_process_qty) before_process_qty, sum(total.gray_process_qty) gray_process_qty, 
            // (sum(total.process_qty)-sum(total.pp_quantity)) short_pp_qty, 
            // round((((sum(total.process_qty)-sum(total.pp_quantity))/sum(total.pp_quantity))*100),2) short_pp_percent, 
            // (sum(total.process_qty)-sum(total.gray_process_qty)) short_gre_rcv_qty, 
            // round((((sum(total.process_qty)-sum(total.gray_process_qty))/sum(total.pp_quantity))*100),2) short_gre_rcv_percent, 
            // (sum(total.process_qty)-sum(total.before_process_qty)) short_pre_proc_qty, 
            // round((((sum(total.process_qty)-sum(total.before_process_qty))/sum(total.before_process_qty))*100),2) short_pre_proc_percent 
    
            // from ( select pp.pp_number, pp.version_name, pp.style_name, pp.color, pp.gw, pp.fw, pp.pp_quantity, result.process_qty, result.before_process_qty, 
            // result.gray_process_qty from 
            // ( select distinct pwvci.pp_number, pwvci.version_name, pwvci.finish_width_in_inch fw, pwvci.greige_width_in_inch gw, pwvci.style_name, pwvci.color, 
            // sum(pwvci.pp_quantity) pp_quantity from pp_wise_version_creation_info pwvci where pwvci.pp_number = '$pp_number' group by pwvci.pp_number, pwvci.version_name )pp,
    
            // (SELECT distinct ptftri_1.process_id,ptftri_1.pp_number , version_name, ptftri_1.finish_width_in_inch,
            // sum(ptftri_1.after_trolley_or_batcher_qty) process_qty,
            // sum(ptftri_1.before_trolley_or_batcher_qty) before_process_qty,
            // (SELECT sum(ptv.after_trolley_or_batcher_qty) process_qty from partial_test_for_test_result_info ptv 
            // where ptv.pp_number = ptftri_1.pp_number and ptv.process_id = 'proc_20' and version_name = ptv.version_number) gray_process_qty 
            // FROM
            // partial_test_for_test_result_info ptftri_1
            // inner join (
            // SELECT ptftri.process_id, ptftri.pp_number pp_number, ptftri.version_number version_name, ptftri.finish_width_in_inch finish_width_in_inch,
            // max(ptftri.partial_test_for_test_result_creation_date) max_date
            // from partial_test_for_test_result_info ptftri, pp_wise_version_creation_info pwvci
            // where ptftri.pp_number = pwvci.pp_number and ptftri.version_number = pwvci.version_name and ptftri.style=pwvci.style_name
            // and ptftri.finish_width_in_inch=pwvci.finish_width_in_inch 
            // and ptftri.process_id = 'proc_1' and ptftri.pp_number = '$pp_number'
            // group by ptftri.pp_number, ptftri.version_number, ptftri.finish_width_in_inch )P
            // where  1=1
            // and ptftri_1.process_id = p.process_id
            // and ptftri_1.pp_number = p.pp_number
            // and ptftri_1.version_number = p.version_name
            // and ptftri_1.partial_test_for_test_result_creation_date = p.max_date
            // and ptftri_1.finish_width_in_inch = p.finish_width_in_inch
            // group by process_id,pp_number, version_name)result where pp.pp_number = result.pp_number and pp.version_name = result.version_name ) total
            // ";
            //                     $result_for_greige= mysqli_query($con,$sql_for_greige) or die(mysqli_error($con));
            //                     while($row = mysqli_fetch_array($result_for_greige))  
            //                     {
            //                         $pdf->SetFont('Arial','B',9); 
            //                         $x = $pdf->GetX();
            //                         $y = $pdf->GetY();
            //                         $data = "Singeing & Desizing Total Qty.(mtr.)";
            //                         strlen($data)<70?$b=8:$b=4;
            //                         $pdf->MultiCell(78,$b,$data,'1','C');
            //                         $pdf->SetXY($x + 78, $y);
            //                         $data = $row['pp_quantity'];
            //                         strlen($data)<20?$b=8:$b=4;
            //                         $pdf->MultiCell(18,$b,$data,'1','C');
            //                         $pdf->SetXY($x + 96, $y);
            //                         $data = $row['before_process_qty'];
            //                         strlen($data)<20?$b=8:$b=4;
            //                         $pdf->MultiCell(19,$b,$data,'1','C');
            //                         $pdf->SetXY($x + 115, $y);
            //                         $data = $row['process_qty'];
            //                         strlen($data)<20?$b=8:$b=4;
            //                         $pdf->MultiCell(17,$b,$data,'1','C');
            //                         $pdf->SetXY($x + 132, $y);
            //                         $data = $row['short_pp_qty'];
            //                         strlen($data)<20?$b=8:$b=4;
            //                         $pdf->MultiCell(20,$b,$data,'1','C');
            //                         $pdf->SetXY($x + 152, $y);
            //                         $data = $row['short_pp_percent'];
            //                         strlen($data)<20?$b=8:$b=4;
            //                         $pdf->MultiCell(14,$b,$data,'1','C'); 
            //                         $pdf->SetXY($x + 166, $y); 
            //                         $data = $row['short_gre_rcv_qty'];
            //                         strlen($data)<20?$b=8:$b=4;
            //                         $pdf->MultiCell(20,$b,$data,'1','C');
            //                         $pdf->SetXY($x + 186, $y);
            //                         $data = $row['short_gre_rcv_percent'];
            //                         strlen($data)<20?$b=8:$b=4;
            //                         $pdf->MultiCell(14,$b,$data,'1','C');  

            //                         if($row['short_excess_qty']!= '') 
            //                             {
            //                                 $process_loss_gain+=$row['short_excess_qty'];
            //                             }
                            
            //                             $Total_pp_quantity = $row['pp_quantity'];
            //                             $Total_greige_quantity = $row['process_qty'];
                                 
            //                     }

             }
        }

        
    }
   
}


// $pdf->Ln(10);

// $item = array("1", "Name","dsfdsf dsfdsf dssfr vvfdf gggggg fhtg fdhtere wef fdsf dfdsf kjkhkh","address");

// // foreach($data as $item)
// // {
// 	$cellWidth = 40;
// 	$cellHeight = 5;
// 	if($pdf->GetStringWidth($item[2]) < $cellWidth)
// 	{
// 		$line = 1;	
// 	}
// 	else
// 	{
// 		$textLength = strlen($item[2]);
// 		$errMargin = 10;
// 		$startChar = 0;
// 		$maxChar = 0;
// 		$textArray = array();
// 		$tmpString = '';
// 		while($startChar < $textLength)
// 		{
// 			while($pdf->GetStringWidth($tmpString) < ($cellWidth - $errMargin) && ($startChar + $maxChar) < $textLength)
// 				{
// 					$maxChar ++;
// 					$tmpString = substr($item[2],$startChar,$maxChar);
// 				}
// 			$startChar = $startChar + $maxChar;
// 			array_push($textArray,$tmpString);
// 			$maxChar = 0;
// 			$tmpString = '';
// 		}
// 		$line = count($textArray);
// 	}
// 	$pdf->Cell(10,($line * $cellHeight), $item[0],1,0,'L');
// 	$pdf->Cell(20,($line * $cellHeight), $item[1],1,0,'L');
	
// 	$xPos = $pdf->GetX();
// 	$yPos = $pdf->GetY();
// 	$pdf->MultiCell($cellWidth, $cellHeight, $item[2],1,'L');
// 	$pdf->SetXY($xPos + $cellWidth, $yPos);

// 	$pdf->Cell(20,($line * $cellHeight), $item[3],1,1,'L');
// 	// $pdf->Cell(10,5, $item[0],1,0);
//     // $pdf->Cell(20,5, $item[1],1,0);
//     // $pdf->Cell(40,5, $item[2],1,0);
//     // $pdf->Cell(20,5, $item[3],1,1);
// // }

 
ob_end_clean();

$pdf->Output('I', "pp_status_reprot_for_pp_number_".$pp_number.".pdf", true);
// ob_end_flush();


?>





