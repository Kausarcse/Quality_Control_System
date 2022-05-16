
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
 $currnet_date = date("d-m-Y h:i:s A");

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

    $this->Image('../img/zz_logo.png',10,16,20);

    $this->setLeftMargin(30);
    $this->Ln(5);
    $this->setTextColor(0,0,0);
    $this->SetFont('Arial','',8);
    $this->Cell(105,3,"PAGAR, TONGI, GAZIPUR, BANGLADESH","0","0","L");
  
    $this->Ln(3);
    $this->Cell(105,3,"Contact Info : (+8802) 9801012, 9801146 Visit us at www.znzfab.com, ","0","0","L");
   
    $this->Ln(3);
    $this->Cell(50,3,"E-mail : ftslab@znzfab.com","0","0","L");
    
$this->Ln(7);
$this->setLeftMargin(17);

}

// Page footer
function Footer()
{
    $this->SetFont('Times','',6);
    $this->SetY(-8);
    $this->SetTextColor(0,0,0);

    $this->Cell(0,5,'Page '.$this->PageNo().'/{nb}',0,1,'C');
    $this->SetFont('Arial','',6);
    
    $this->AcceptPageBreak();
    $this->SetAutoPageBreak(true, 10);

}

}


$pp_number=$_GET['all_data'];
$process_loss_gain = 0.0;
$process_loss_gain_with_greige = 0.0;
$process_loss_gain_with_pp = 0.0;
$process_completion_date='';



                // $sql_for_pp = "select distinct ppi.pp_num_id, ppi.pp_number, date_format(ppi.pp_creation_date, '%d-%b-%Y') start_date , ppi.customer_id, ppi.customer_name, ppi.week_in_year, ppi.design,
                // group_concat( distinct pwvci.construction_name, ',') construction_name,pwvci.percentage_of_cotton_content, pwvci.percentage_of_polyester_content, pwvci.percentage_of_other_fiber_content, pwvci.other_fiber_in_yarn, 
                // sum(pwvci.pp_quantity) pp_quantity ,pwvci.greige_width_in_inch,
                // pwvci.finish_width_in_inch, group_concat(distinct pwvci.process_technique_name, ', ') process_technique_name,
                // (select date_format(min(ptftri.partial_test_for_test_result_creation_date), '%d-%b-%Y') start_date from partial_test_for_test_result_info  ptftri

                // where  ptftri.process_id = 'proc_20' and ptftri.pp_number = '$pp_number') greige_issue_date, 
                // (select date_format(max(ptftri.partial_test_for_test_result_creation_date), '%d-%b-%Y') start_date from partial_test_for_test_result_info  ptftri
                // where  ptftri.process_id = 'proc_20' and ptftri.pp_number = '$pp_number') greige_completion_date,
                // (select date_format(max(ptftri.partial_test_for_test_result_creation_date), '%d-%b-%Y') start_date from partial_test_for_test_result_info  ptftri
                // where ptftri.pp_number = '$pp_number') process_completion_date,
                //                             (select sum(ptftri.after_trolley_or_batcher_qty) total_process_qty from partial_test_for_test_result_info  ptftri, adding_process_to_version	aptv 
                //                             where ptftri.pp_number = aptv.pp_number and ptftri.pp_number = '$pp_number' and ptftri.process_id = aptv.process_id 
                //                             and ptftri.version_id = aptv.version_id  and aptv.process_or_reprocess = 'process') tot_process_qty,
                //                             (select sum(ptftri.after_trolley_or_batcher_qty) total_reprocess_qty from partial_test_for_test_result_info  ptftri, adding_process_to_version	aptv 
                //                             where ptftri.pp_number = aptv.pp_number and ptftri.pp_number = '$pp_number' and ptftri.process_name = aptv.process_name 
                //                             and ptftri.version_id = aptv.version_id  and (aptv.process_or_reprocess = 're-process' or aptv.process_or_reprocess = '2nd-Re-Process' or aptv.process_or_reprocess = '3rd-Re-Process' or aptv.process_or_reprocess = '4th-Re-Process')) tot_reprocess_qty
                // from process_program_info ppi, pp_wise_version_creation_info pwvci
                // where
                // ppi.pp_number = pwvci.pp_number and ppi.pp_number = '$pp_number'";

                $sql_for_pp = "select distinct ppi.pp_num_id, ppi.pp_number, date_format(ppi.pp_creation_date, '%d-%b-%Y') start_date, ppi.customer_id, ppi.customer_name, ppi.week_in_year, ppi.design,
                group_concat( distinct pwvci.construction_name, ',') construction_name,pwvci.percentage_of_cotton_content, pwvci.percentage_of_polyester_content, 
                                pwvci.percentage_of_other_fiber_content, pwvci.other_fiber_in_yarn, pwvci.greige_width_in_inch, pwvci.finish_width_in_inch, 
                                group_concat(distinct pwvci.process_technique_name, ', ') process_technique_name, sum(pwvci.pp_quantity) pp_quantity,
                        
                                (select SUM(after_trolley_or_batcher_qty) from partial_test_for_test_result_info  ptftri
                where  ptftri.process_id = 'proc_20' and ptftri.pp_number = '$pp_number') total_greige_qty,

                (select date_format(min(ptftri.partial_test_for_test_result_creation_date), '%d-%b-%Y') start_date from partial_test_for_test_result_info  ptftri
                where  ptftri.process_id = 'proc_20' and ptftri.pp_number = '$pp_number') greige_issue_date, 

                (select date_format(max(ptftri.partial_test_for_test_result_creation_date), '%d-%b-%Y') start_date from partial_test_for_test_result_info  ptftri
                where  ptftri.process_id = 'proc_20' and ptftri.pp_number = '$pp_number') greige_completion_date,

                                (select date_format(max(ptftri.partial_test_for_test_result_creation_date), '%d-%b-%Y') start_date from partial_test_for_test_result_info  ptftri
                where ptftri.pp_number = '$pp_number') process_completion_date,

                (SELECT SUM(ptftri_2.after_trolley_or_batcher_qty) FROM partial_test_for_test_result_info ptftri_2,(SELECT MAX(partial_test_for_test_result_id) lastid 
                                from partial_test_for_test_result_info where pp_number = '$pp_number' GROUP BY version_id) last_id where ptftri_2.partial_test_for_test_result_id = last_id.lastid) tot_process_qty,
                
                                (select sum(ptftri.after_trolley_or_batcher_qty) total_reprocess_qty from partial_test_for_test_result_info  ptftri, adding_process_to_version  aptv 
                 where ptftri.pp_number = aptv.pp_number and ptftri.pp_number = '$pp_number' and ptftri.process_name = aptv.process_name and ptftri.version_id = aptv.version_id  
                                 and (aptv.process_or_reprocess = 're-process' or aptv.process_or_reprocess = '2nd-Re-Process' or aptv.process_or_reprocess = '3rd-Re-Process' or 
                                 aptv.process_or_reprocess = '4th-Re-Process')) tot_reprocess_qty from process_program_info ppi, pp_wise_version_creation_info pwvci 
                                where ppi.pp_number = pwvci.pp_number and ppi.pp_number = '$pp_number'";


$result_for_pp= mysqli_query($con,$sql_for_pp) or die(mysqli_error($con));
$row_for_pp=mysqli_fetch_array($result_for_pp);

$process_loss_gain_with_pp = $row_for_pp['tot_process_qty'] - $row_for_pp['pp_quantity'];
$process_loss_gain_with_greige =   $row_for_pp['tot_process_qty'] - $row_for_pp['total_greige_qty'];

$serial='';

$process_start_date = $row_for_pp['greige_issue_date'];
$process_end_date = $row_for_pp['process_completion_date'];

$difference_In_Time = strtotime($process_end_date) - strtotime($process_start_date);

// To calculate the no. of days between two dates
$difference_In_Days = ($difference_In_Time + 86400) / (3600 * 24);
        


$pdf=new PDF('L','mm','A4');
$pdf->AliasNbPages();
$pdf->AddPage();
$counter=30;
$pdf->AcceptPageBreak();
$pdf->SetAutoPageBreak(true, 10);
$pdf->Ln(0);
$pdf->setTopMargin(0);
$pdf->setLeftMargin(230);
$pdf->setTopMargin(10);
$pdf->SetFont('Arial','',8);
$pdf->Cell(60,-25,"Date of publish :  ".$currnet_date,0,0,'L');
$pdf->Ln(0);
$counter = $counter + 10;
$pdf->setLeftMargin(6);
$pdf->Cell(300,4,"","0","0","C");
$pdf->Ln(2);
$pdf->setLeftMargin(8);
$pdf->SetFont('Times','B',18);
$pdf->Cell(280,10,"Processing Program Status","0","0","C");
$pdf->setLeftMargin(8);
$counter = $counter + 16;

$pdf->Ln(10);
$pdf->Cell(280,0,"","0","0","C");
$pdf->Ln(2);
$pdf->setLeftMargin(8);
$counter = $counter + 12;

$pdf->SetFont('Arial','B',9);
$pdf->Cell(70,6,"PP Issue Date:".$pdf->SetFillColor(220,220,220),"1","0","L",true);
$pdf->SetFont('Arial','',9);
$pdf->Cell(70,6,"".$row_for_pp['start_date'],"1","0","L");
$pdf->SetFont('Arial','B',9);
$pdf->Cell(70,6,"Week".$pdf->SetFillColor(220,220,220),"1","0","L",true);
$pdf->SetFont('Arial','',9);
$pdf->Cell(70,6,"".$row_for_pp['week_in_year'],"1","1","L");
$counter = $counter + 6;

$pdf->SetFont('Arial','B',9);
$pdf->Cell(70,6,"PP No.".$pdf->SetFillColor(220,220,220),"1","0","L",true);
$pdf->SetFont('Arial','',9);
$pdf->Cell(70,6,"".$row_for_pp['pp_number'],"1","0","L");
$pdf->SetFont('Arial','B',9);
$pdf->Cell(70,6,"Construction".$pdf->SetFillColor(220,220,220),"1","0","L",true);
$pdf->SetFont('Arial','',9);
$pdf->Cell(70,6,"".$row_for_pp['construction_name'],"1","1","L");
$counter = $counter + 6;

$pdf->SetFont('Arial','B',9);
$pdf->Cell(70,6,"Customer".$pdf->SetFillColor(220,220,220),"1","0","L",true);
$pdf->SetFont('Arial','',9);
$pdf->Cell(70,6,"".$row_for_pp['customer_name'],"1","0","L");
$pdf->SetFont('Arial','B',9);
$pdf->Cell(70,6,"Fiber Content".$pdf->SetFillColor(220,220,220),"LTR","0","L",true);
$pdf->SetFont('Arial','',9);
$pdf->Cell(70,6,"".$row_for_pp['percentage_of_cotton_content'].'% Cotton '.$row_for_pp['percentage_of_polyester_content'].'% Polyester',"LTR","1","L");
$counter = $counter + 6;

$pdf->SetFont('Arial','B',9);
$pdf->Cell(70,6,"Design".$pdf->SetFillColor(220,220,220),"1","0","L",true);
$pdf->SetFont('Arial','',9);
$pdf->Cell(70,6,"".$row_for_pp['design'],"1","0","L");
$pdf->SetFont('Arial','B',9);
$pdf->Cell(70,7,"".$pdf->SetFillColor(220,220,220),"LBR","0","L",true);
$pdf->SetFont('Arial','',9);
if($row_for_pp['other_fiber_in_yarn']=='Null')
{
    $pdf->Cell(70,6,"","LBR","1","L");
}
else
{
    $pdf->Cell(70,6,"".$row_for_pp['percentage_of_other_fiber_content'].'% '.' '.$row_for_pp['other_fiber_in_yarn'],"LBR","1","L");

}
$counter = $counter + 6;

$pdf->SetFont('Arial','B',9);
$pdf->Cell(70,6,"PP Qty.(mtr.)".$pdf->SetFillColor(220,220,220),"1","0","L",true);
$pdf->SetFont('Arial','',9);
$pdf->Cell(70,6,"".$row_for_pp['pp_quantity'],"1","0","L");
$pdf->SetFont('Arial','B',9);
$pdf->Cell(70,6,"Process Technique(s)".$pdf->SetFillColor(220,220,220),"1","0","L",true);
$pdf->SetFont('Arial','',9);
$pdf->Cell(70,6,"".$row_for_pp['process_technique_name'],"1","1","L");
$counter = $counter + 6;

$pdf->SetFont('Arial','B',9);
$pdf->Cell(70,6,"Greige Issue Date".$pdf->SetFillColor(220,220,220),"1","0","L",true);
$pdf->SetFont('Arial','',9);
$pdf->Cell(70,6,"".$row_for_pp['greige_issue_date'],"1","0","L");
$pdf->SetFont('Arial','B',9);
$pdf->Cell(70,6,"Process Loss/Gain Qty(mtr.) with PP".$pdf->SetFillColor(220,220,220),"1","0","L",true);
$pdf->SetFont('Arial','',9);
$pdf->Cell(70,6,"".$process_loss_gain_with_pp,"1","1","L");
$counter = $counter + 6;

$pdf->SetFont('Arial','B',9);
$pdf->Cell(70,6,"Greige Issuance Completion Date".$pdf->SetFillColor(220,220,220),"1","0","L",true);
$pdf->SetFont('Arial','',9);
$pdf->Cell(70,6,"".$row_for_pp['greige_completion_date'],"1","0","L");
$pdf->SetFont('Arial','B',9);
$pdf->Cell(70,6,"Process Loss/Gain Qty(mtr.) with Greige".$pdf->SetFillColor(220,220,220),"1","0","L",true);
$pdf->SetFont('Arial','',9);
$pdf->Cell(70,6,"".$process_loss_gain_with_greige,"1","1","L");
$counter = $counter + 6;


$pdf->SetFont('Arial','B',9);
$pdf->Cell(70,6,"Process Completion Date".$pdf->SetFillColor(220,220,220),"1","0","L",true);
$pdf->SetFont('Arial','',9);
$pdf->Cell(70,6,"".$row_for_pp['process_completion_date'],"1","0","L");
$pdf->SetFont('Arial','B',9);
$pdf->Cell(70,6,"Total Process Qty".$pdf->SetFillColor(220,220,220),"1","0","L",true);
$pdf->SetFont('Arial','',9);
$pdf->Cell(70,6,"".$row_for_pp['tot_process_qty'],"1","1","L");
$counter = $counter + 6;


$pdf->SetFont('Arial','B',9);
$pdf->Cell(70,6,"Process Lead Time(day)".$pdf->SetFillColor(220,220,220),"1","0","L",true);
$pdf->SetFont('Arial','',9);
$pdf->Cell(70,6,"".$difference_In_Days,"1","0","L");
$pdf->SetFont('Arial','B',9);
$pdf->Cell(70,6,"Total Reprocess Qty".$pdf->SetFillColor(220,220,220),"1","0","L",true);
$pdf->SetFont('Arial','',9);
$pdf->Cell(70,6,"".$row_for_pp['tot_reprocess_qty'],"1","1","L");
$counter = $counter + 6;

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

            $row_number_for_greige = mysqli_num_rows($result_for_greige);

            $counter = $counter + ($row_number_for_greige*8) + 10 + 10; 

                if($counter>200)
                    {
                        $pdf->AddPage();
                        $counter =30;
                        $counter = $counter + ($row_number_for_greige*8) + 10 + 10;
                    }    

            $pdf->SetFont('Arial','B',14);
             $pdf->Ln(3);
            $pdf->Cell(280,7,$Serial.'.'.'  '.'Greige Issuance'.'   ('.$row["start_date"].' To '.$row["end_date"].')'.$pdf->SetFillColor(255,255,255),"0","1","L",true);
            $pdf->SetFont('Arial','B',9);
            // $pdf->Cell(0,0,$pdf->SetFillColor(255,255,255),1,0,'c',true);
            // $pdf->Ln(2);
            $x = $pdf->GetX();
            $y = $pdf->GetY();
            $data = "Date";
            strlen($data)<15?$b=10:$b=5; 
            $pdf->MultiCell(25,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
            $pdf->SetXY($x + 25, $y);
            $data = "Version";
            strlen($data)<15?$b=10:$b=5; 
            $pdf->MultiCell(45,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
            $pdf->SetXY($x + 70, $y);
            $data = "Color";
            strlen($data)<15?$b=10:$b=5; 
            $pdf->MultiCell(45,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
            $pdf->SetXY($x + 115, $y);
            $data = "Style";
            strlen($data)<15?$b=10:$b=5;
            $pdf->MultiCell(45,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
            $pdf->SetXY($x + 160, $y);
            $data = "Greige Width (inch)";
            strlen($data)<15?$b=10:$b=5;
            $pdf->MultiCell(30,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
            $pdf->SetXY($x + 190, $y);
            $data = "Finish Width (inch)";
            strlen($data)<15?$b=10:$b=5;
            $pdf->MultiCell(30,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
            $pdf->SetXY($x + 220, $y);
            $data = "Received qty. (mtr.)";
            strlen($data)<15?$b=10:$b=5;
            $pdf->MultiCell(30,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
            $pdf->SetXY($x + 250, $y);
            $data = "Process / Reprocess";
            strlen($data)<15?$b=10:$b=5;
            $pdf->MultiCell(30,$b,"$data".$pdf->SetFillColor(220,220,220),'1','C',TRUE);
            $pdf->Cell(0,0,$pdf->SetFillColor(255,255,255),'0','1','c',true);

            $pdf->SetFont('Arial','',9);

								while($row = mysqli_fetch_array($result_for_greige))  
								{ 
                                   
                                    $x = $pdf->GetX();
                                    $y = $pdf->GetY();
                                    $data = $row['date'];
                                    strlen($data)<15?$b=8:$b=4;
                                    $pdf->MultiCell(25,$b,$data,'1','C');
                                    $pdf->SetXY($x + 25, $y);
                                    $data = $row['version_number'];
                                    strlen($data)<20?$b=8:$b=4;
                                    $pdf->MultiCell(45,$b,$data,'1','C');
                                    $pdf->SetXY($x + 70, $y);
                                    $data = $row['color'];
                                    strlen($data)<30?$b=8:$b=4;
                                    $pdf->MultiCell(45,$b,$data,'1','C');
                                    $pdf->SetXY($x + 115, $y);
                                    $data = $row['style_name'];
                                    strlen($data)<30?$b=8:$b=4;
                                    $pdf->MultiCell(45,$b,$data,'1','C');
                                    $pdf->SetXY($x + 160, $y);
                                    $data = $row['gw'];
                                    strlen($data)<15?$b=8:$b=4;
                                    $pdf->MultiCell(30,$b,$data,'1','C');
                                    $pdf->SetXY($x + 190, $y);
                                    $data = $row['fw'];
                                    strlen($data)<15?$b=8:$b=4;
                                    $pdf->MultiCell(30,$b,$data,'1','C');
                                    $pdf->SetXY($x + 220, $y);
                                    $data = $row['process_qty'];
                                    strlen($data)<15?$b=8:$b=4;
                                    $pdf->MultiCell(30,$b,$data,'1','C');
                                    $pdf->SetXY($x + 250, $y);
                                    $data = $row['process_or_reprocess'];
                                    strlen($data)<15?$b=8:$b=4;
                                    $pdf->SetFont('Arial','',7);
                                    $pdf->MultiCell(30,$b,$data,'1','C'); 
                                    $pdf->SetFont('Arial','',9);
                                } 
                                 
                           

                          // Width summary for greige receiving	

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
                    $row_number_for_greige_width = mysqli_num_rows($result_for_greige);

                    $counter = $counter + ($row_number_for_greige_width*8) + 10 + 10; 
        
                        if($counter>200)
                            {
                                $pdf->AddPage();
                                $pdf->SetLeftMargin(8);
                                $counter =30;
                                $counter = $counter + ($row_number_for_greige_width*8) + 10 + 10;
                            } 
                                    $pdf->SetFont('Arial','B',11);
                                    $pdf->Ln(3);
                                    $pdf->Cell(280,7,"Width Summary".$pdf->SetFillColor(220,220,220),"1","1","C",true);
                                    $pdf->SetFont('Arial','B',9);

                                    $x = $pdf->GetX();
                                    $y = $pdf->GetY();
                                    $data = "Greige Width (inch)";
                                    strlen($data)<30?$b=10:$b=5;
                                    $pdf->MultiCell(40,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                    $pdf->SetXY($x + 40, $y);
                                    $data = "Finish Width (inch)";
                                    strlen($data)<30?$b=10:$b=5;
                                    $pdf->MultiCell(40,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                    $pdf->SetXY($x + 80, $y);
                                    $data = "PP Quantity";
                                    strlen($data)<30?$b=10:$b=5;
                                    $pdf->MultiCell(40,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                    $pdf->SetXY($x + 120, $y);
                                    $data = "Received Quantity (mtr.)";
                                    strlen($data)<30?$b=10:$b=5;
                                    $pdf->MultiCell(40,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                    $pdf->SetXY($x + 160, $y);
                                    $data = "(+/-) From PP Qty (mtr.)";
                                    strlen($data)<50?$b=10:$b=5;
                                    $pdf->MultiCell(60,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                    $pdf->SetXY($x + 220, $y);
                                    $data = "(+/-) From PP Qty (%)";
                                    strlen($data)<50?$b=10:$b=5;
                                    $pdf->MultiCell(60,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                    $pdf->SetXY($x + 280, $y);
                                    $pdf->Cell(280,0,$pdf->SetFillColor(255,255,255),'0','1','c',true);
                                    $pdf->Ln(10);
                                    $pdf->SetFont('Arial','',9);

                    while($row = mysqli_fetch_array($result_for_greige))  
                    {
                                    $x = $pdf->GetX();
                                    $y = $pdf->GetY();
                                    $data = $row['gw'];
                                    strlen($data)<20?$b=8:$b=4;
                                    $pdf->MultiCell(40,$b,$data,'1','C');
                                    $pdf->SetXY($x + 40, $y);
                                    $data = $row['fw'];
                                    strlen($data)<20?$b=8:$b=4;
                                    $pdf->MultiCell(40,$b,$data,'1','C');
                                    $pdf->SetXY($x + 80, $y);
                                    $data = $row['pp_quantity'];
                                    strlen($data)<20?$b=8:$b=4;
                                    $pdf->MultiCell(40,$b,$data,'1','C');
                                    $pdf->SetXY($x + 120, $y);
                                    $data = $row['process_qty'];
                                    strlen($data)<20?$b=8:$b=4;
                                    $pdf->MultiCell(40,$b,$data,'1','C');
                                    $pdf->SetXY($x + 160, $y);
                                    $data = $row['short_excess_qty'];
                                    strlen($data)<20?$b=8:$b=4;
                                    $pdf->MultiCell(60,$b,$data,'1','C');
                                    $pdf->SetXY($x + 220, $y);
                                    $data = $row['short_qty_percent'];
                                    strlen($data)<20?$b=8:$b=4;
                                    $pdf->MultiCell(60,$b,$data,'1','C');

                    }

                     // Version summary for greige receiving

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
                     $row_number_for_greige_version = mysqli_num_rows($result_for_greige);

                    $counter = $counter + ($row_number_for_greige_version*8) + 10 + 10 + 8; 
        
                        if($counter>200)
                            {
                                $pdf->AddPage();
                                $pdf->SetLeftMargin(8);
                                $counter =30;
                                $counter = $counter + ($row_number_for_greige_version*8) + 10 + 10 + 8;
                            } 
                   
                    $pdf->SetFont('Arial','B',11);
                    $pdf->Ln(3);
                    $pdf->Cell(280,7,"Version Summary".$pdf->SetFillColor(220,220,220),"1","1","C",true);
                    $pdf->SetFont('Arial','B',9);

                    $x = $pdf->GetX();
                    $y = $pdf->GetY();
                    $data = "Version";
                    strlen($data)<30?$b=10:$b=5;
                    $pdf->MultiCell(45,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                    $pdf->SetXY($x + 45, $y);
                    $data = "Color";
                    strlen($data)<30?$b=10:$b=5;
                    $pdf->MultiCell(45,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                    $pdf->SetXY($x + 90, $y);
                    $data = "Style";
                    strlen($data)<30?$b=10:$b=5;
                    $pdf->MultiCell(45,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                    $pdf->SetXY($x + 135, $y);
                    $data = "PP Quantity (mtr.)";
                    strlen($data)<25?$b=10:$b=5;
                    $pdf->MultiCell(40,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                    $pdf->SetXY($x + 175, $y);
                    $data = "Received Quantity (mtr.)";
                    strlen($data)<30?$b=10:$b=5;
                    $pdf->MultiCell(40,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                    $pdf->SetXY($x + 215, $y);
                    $data = "(+/-) From PP";
                    strlen($data)<10?$b=10:$b=5;
                    $pdf->MultiCell(65,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                    $pdf->SetXY($x + 215, $y+5);
                    $data = "Qty (mtr.)";
                    // strlen($data)<15?$b=10:$b=5;
                    $pdf->MultiCell(35,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                    $pdf->SetXY($x + 250, $y+5);
                    $data = "%";
                    // strlen($data)<15?$b=10:$b=5;
                    $pdf->MultiCell(30,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                    $pdf->SetXY($x + 280, $y);
                    $pdf->Cell(0,0,$pdf->SetFillColor(255,255,255),'1','1','C',true);
                    $pdf->SetFont('Arial','',9); 
                    
                    $pdf->Ln(10);

                    while($row = mysqli_fetch_array($result_for_greige))  
                    {  
                        $x = $pdf->GetX();
                        $y = $pdf->GetY();
                        $data = $row['version_name'];
                        strlen($data)<20?$b=8:$b=4;
                        $pdf->MultiCell(45,$b,$data,'1','C');
                        $pdf->SetXY($x + 45, $y);
                        $data = $row['color'];
                        strlen($data)<30?$b=8:$b=4;
                        $pdf->MultiCell(45,$b,$data,'1','C');
                        $pdf->SetXY($x + 90, $y);
                        $data = $row['style_name'];
                        strlen($data)<30?$b=8:$b=4;
                        $pdf->MultiCell(45,$b,$data,'1','C');
                        $pdf->SetXY($x + 135, $y);
                        $data = $row['pp_quantity'];
                        strlen($data)<15?$b=8:$b=4;
                        $pdf->MultiCell(40,$b,$data,'1','C');
                        $pdf->SetXY($x + 175, $y);
                        $data = $row['process_qty'];
                        strlen($data)<15?$b=8:$b=4;
                        $pdf->MultiCell(40,$b,$data,'1','C');
                        $pdf->SetXY($x + 215, $y);
                        $data = $row['short_greige_qty'];
                        strlen($data)<20?$b=8:$b=4;
                        $pdf->MultiCell(35,$b,$data,'1','C');
                        $pdf->SetXY($x + 250, $y);
                        $data = $row['short_greige_per'];
                        strlen($data)<20?$b=8:$b=4;
                        $pdf->MultiCell(30,$b,$data,'1','C');
                        
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
                                            $pdf->MultiCell(135,$b,$data,'1','C');
                                            $pdf->SetXY($x + 135, $y);
                                            $data = $row['pp_quantity'];
                                            strlen($data)<20?$b=8:$b=4;
                                            $pdf->MultiCell(40,$b,$data,'1','C');
                                            $pdf->SetXY($x + 175, $y);
                                            $data = $row['process_qty'];
                                            strlen($data)<20?$b=8:$b=4;
                                            $pdf->MultiCell(40,$b,$data,'1','C');
                                            $pdf->SetXY($x + 215, $y);
                                            $data = $row['short_excess_qty'];
                                            strlen($data)<20?$b=8:$b=4;
                                            $pdf->MultiCell(35,$b,$data,'1','C');
                                            $pdf->SetXY($x + 250, $y);
                                            $data = $row['short_qty_percent'];
                                            strlen($data)<20?$b=8:$b=4;
                                            $pdf->MultiCell(30,$b,$data,'1','C');  
                                            

                                            if($row['short_excess_qty']!= '') 
                                                    {
                                                        $process_loss_gain+=$row['short_excess_qty'];
                                                    }
                                                    
                                                $Total_pp_quantity = $row['pp_quantity'];
                                                $Total_greige_quantity = $row['process_qty'];
										
                                        }
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

                  $row_number_for_singe = mysqli_num_rows($result_for_singe_desize);

                  $counter = $counter + ($row_number_for_singe*8) + 10 + 10; 
      
                      if($counter>200)
                          {
                              $pdf->AddPage();
                              $pdf->SetLeftMargin(8);
                              $counter =30;
                              $counter = $counter + ($row_number_for_singe*8) + 10 + 10; 

                          } 

                  $pdf->SetFont('Arial','B',14);
                  $pdf->Ln(3);
                  $pdf->Cell(280,7,$Serial.'.'.'  '.'Singeing & Desizing'.'   ('.$row["start_date"].' To '.$row["end_date"].')'.$pdf->SetFillColor(255,255,255),"0","1","L",true);
                  $pdf->SetFont('Arial','B',9);
                //   $pdf->Ln(2);
                 
      
                  $x = $pdf->GetX();
                  $y = $pdf->GetY();
                  $data = "Date";
                  strlen($data)<15?$b=10:$b=5;
                  $pdf->MultiCell(25,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                  $pdf->SetXY($x + 25, $y);
                  $data = "Version";
                  strlen($data)<15?$b=10:$b=5;
                  $pdf->MultiCell(40,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                  $pdf->SetXY($x + 65, $y);
                  $data = "Color";
                  strlen($data)<15?$b=10:$b=5;
                  $pdf->MultiCell(40,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                  $pdf->SetXY($x + 105, $y);
                  $data = "Style";
                  strlen($data)<15?$b=10:$b=5;
                  $pdf->MultiCell(40,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                  $pdf->SetXY($x + 145, $y);
                  $data = "Greige Width (inch)";
                  strlen($data)<15?$b=10:$b=5;
                  $pdf->MultiCell(25,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                  $pdf->SetXY($x + 170, $y);
                  $data = "Finish Width (inch)";
                  strlen($data)<15?$b=10:$b=5;
                  $pdf->MultiCell(25,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                  $pdf->SetXY($x + 195, $y);
                  $data = "After Batcher / Trolley No.";
                  strlen($data)<15?$b=10:$b=5;
                  $pdf->MultiCell(30,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                  $pdf->SetXY($x + 225, $y);
                  $data = "Process Quantity (mtr.)";
                  strlen($data)<20?$b=10:$b=5;
                  $pdf->MultiCell(35,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                  $pdf->SetXY($x + 260, $y);
                  $data = "Process / Reprocess";
                  strlen($data)<15?$b=10:$b=5;
                  $pdf->MultiCell(20,$b,"$data".$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                  // $pdf->SetXY($x + 194, $y);

                  $pdf->Cell(280,0,$pdf->SetFillColor(255,255,255),'1','1','c',true);
      
                  $pdf->SetFont('Arial','',9);


                                                  while($row = mysqli_fetch_array($result_for_singe_desize))  
                                                  {
                                                      $x = $pdf->GetX();
                                                      $y = $pdf->GetY();
                                                      $data = $row['date'];
                                                      strlen($data)<20?$b=8:$b=4;
                                                      $pdf->MultiCell(25,$b,$data,'1','C');
                                                      $pdf->SetXY($x + 25, $y);
                                                      $data = $row['version_number'];
                                                      strlen($data)<20?$b=8:$b=4;
                                                      $pdf->MultiCell(40,$b,$data,'1','C');
                                                      $pdf->SetXY($x + 65, $y);
                                                      $data = $row['color'];
                                                      strlen($data)<20?$b=8:$b=4;
                                                      $pdf->MultiCell(40,$b,$data,'1','C');
                                                      $pdf->SetXY($x + 105, $y);
                                                      $data = $row['style_name'];
                                                      strlen($data)<20?$b=8:$b=4;
                                                      $pdf->MultiCell(40,$b,$data,'1','C');
                                                      $pdf->SetXY($x + 145, $y);
                                                      $data = $row['gw'];
                                                      strlen($data)<20?$b=8:$b=4;
                                                      $pdf->MultiCell(25,$b,$data,'1','C');
                                                      $pdf->SetXY($x + 170, $y);
                                                      $data = $row['fw'];
                                                      strlen($data)<20?$b=8:$b=4;
                                                      $pdf->MultiCell(25,$b,$data,'1','C');
                                                      $pdf->SetXY($x + 195, $y);
                                                      $data = $row['after_trolley_number_or_batcher_number'];
                                                      strlen($data)<20?$b=8:$b=4;
                                                      $pdf->MultiCell(30,$b,$data,'1','C');
                                                      $pdf->SetXY($x + 225, $y);
                                                      $data = $row['after_trolley_or_batcher_qty'];
                                                      strlen($data)<20?$b=8:$b=4;
                                                      $pdf->MultiCell(35,$b,$data,'1','C');
                                                      $pdf->SetXY($x + 260, $y);
                                                      $data = $row['process_or_reprocess'];
                                                      strlen($data)<20?$b=8:$b=4;
                                                      $pdf->SetFont('Arial','',7);
                                                      $pdf->MultiCell(20,$b,$data,'1','C'); 
                                                      $pdf->SetFont('Arial','',9);
                                                  }



                                          // Width summary for signe and Desizing	

                                          $sql_for_singe_width = "select pp.pp_number, pp.gw, pp.fw, pp.pp_quantity, result.process_qty, result.before_process_qty, result.gray_process_qty,
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
                                          
                                          $result_for_singe_width= mysqli_query($con,$sql_for_singe_width) or die(mysqli_error($con));

                                          $row_number_for_singe_width = mysqli_num_rows($result_for_singe_width);

                                          $counter = $counter + ($row_number_for_singe_width*8) + 10 + 10; 
                            
                                            if($counter>200)
                                                {
                                                    $pdf->AddPage();
                                                    $pdf->SetLeftMargin(8);
                                                    $counter =30;
                                                    $counter = $counter + ($row_number_for_singe_width*8) + 10 + 10; 
                                                } 

                                          $pdf->SetFont('Arial','B',11);
                                          $pdf->Ln(3);
                                          $pdf->Cell(280,7,"Width Summary".$pdf->SetFillColor(220,220,220),"1","1","C",true);
                                          $pdf->SetFont('Arial','B',9);

                                          $x = $pdf->GetX();
                                          $y = $pdf->GetY();
                                          $data = "Greige Width (inch)";
                                          strlen($data)<20?$b=10:$b=5;
                                          $pdf->MultiCell(35,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                          $pdf->SetXY($x + 35, $y);
                                          $data = "Finish Width (inch)";
                                          strlen($data)<20?$b=10:$b=5;
                                          $pdf->MultiCell(35,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                          $pdf->SetXY($x + 70, $y);
                                          $data = "PP Quantity. (mtr.)";
                                          strlen($data)<20?$b=10:$b=5;
                                          $pdf->MultiCell(40,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                          $pdf->SetXY($x + 110, $y);
                                          $data = "Before Process Quantity (mtr.)";
                                          strlen($data)<15?$b=10:$b=5;
                                          $pdf->MultiCell(40,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                          $pdf->SetXY($x + 150, $y);
                                          $data = "Process Quantity. (mtr.)";
                                          strlen($data)<25?$b=10:$b=5;
                                          $pdf->MultiCell(40,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                          $pdf->SetXY($x + 190, $y);
                                          $data = "(+/-) From PP";
                                          // strlen($data)<15?$b=10:$b=5;
                                          $pdf->MultiCell(45,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                          $pdf->SetXY($x + 190, $y+5);
                                          $data = "Qty (mtr.)";
                                          // strlen($data)<15?$b=10:$b=5;
                                          $pdf->MultiCell(25,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                          $pdf->SetXY($x + 215, $y+5);
                                          $data = "%";
                                          // strlen($data)<15?$b=10:$b=5;
                                          $pdf->MultiCell(20,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                          $pdf->SetXY($x + 235, $y);
                                          $data = "(+/-) From Greige";
                                          // strlen($data)<15?$b=10:$b=5;
                                          $pdf->MultiCell(45,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                          $pdf->SetXY($x + 235, $y+5);
                                          $data = "Qty (mtr.)";
                                          // strlen($data)<15?$b=10:$b=5;
                                          $pdf->MultiCell(25,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                          $pdf->SetXY($x + 260, $y+5);
                                          $data = "%";
                                          // strlen($data)<15?$b=10:$b=5;
                                          $pdf->MultiCell(20,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                          $pdf->SetXY($x + 280, $y);
                                          
                                          // $pdf->Cell(0,0,$pdf->SetFillColor(255,255,255),'1','1','C',true);
                                          $pdf->SetFont('Arial','',9);       
                                           $pdf->Ln(10);
                                         
                                          
                                      while($row = mysqli_fetch_array($result_for_singe_width))  
                                      {
                                          $x = $pdf->GetX();
                                          $y = $pdf->GetY();
                                          $data = $row['gw'];
                                          strlen($data)<20?$b=8:$b=4;
                                          $pdf->MultiCell(35,$b,$data,'1','C');
                                          $pdf->SetXY($x + 35, $y);
                                          $data = $row['fw'];
                                          strlen($data)<20?$b=8:$b=4;
                                          $pdf->MultiCell(35,$b,$data,'1','C');
                                          $pdf->SetXY($x + 70, $y);
                                          $data = $row['pp_quantity'];
                                          strlen($data)<20?$b=8:$b=4;
                                          $pdf->MultiCell(40,$b,$data,'1','C');
                                          $pdf->SetXY($x + 110, $y);
                                          $data = $row['before_process_qty'];
                                          strlen($data)<20?$b=8:$b=4;
                                          $pdf->MultiCell(40,$b,$data,'1','C');
                                          $pdf->SetXY($x + 150, $y);
                                          $data = $row['process_qty'];
                                          strlen($data)<20?$b=8:$b=4;
                                          $pdf->MultiCell(40,$b,$data,'1','C');
                                          $pdf->SetXY($x + 190, $y);
                                          $data = $row['short_pp_qty'];
                                          strlen($data)<15?$b=8:$b=4;
                                          $pdf->MultiCell(25,$b,$data,'1','C');
                                          $pdf->SetXY($x + 215, $y);
                                          $data = $row['short_pp_percent'];
                                          strlen($data)<15?$b=8:$b=4;
                                          $pdf->MultiCell(20,$b,$data,'1','C');
                                          $pdf->SetXY($x + 235, $y);
                                          $data = $row['short_gre_rcv_qty'];
                                          strlen($data)<15?$b=8:$b=4;
                                          $pdf->MultiCell(25,$b,$data,'1','C');
                                          $pdf->SetXY($x + 260, $y);
                                          $data = $row['short_gre_rcv_percent'];
                                          strlen($data)<15?$b=8:$b=4;
                                          $pdf->MultiCell(20,$b,$data,'1','C');
                                          // $pdf->SetXY($x + 200, $y);

                                      }
                                          // Version summary for Signe and Desizing

                                           $sql_for_singe_version = "select pp.pp_number, pp.version_name version_number, pp.style_name, pp.color, pp.gw, pp.fw, pp.pp_quantity, result.process_qty, result.before_process_qty, result.gray_process_qty, 
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
                                            $result_for_singe_version= mysqli_query($con,$sql_for_singe_version) or die(mysqli_error($con));

                                            $row_number_for_singe_version = mysqli_num_rows($result_for_singe_version);

                                            $counter = $counter + ($row_number_for_singe_version*8) + 10 + 10 + 8; 
                            
                                            if($counter>200)
                                                {
                                                    $pdf->AddPage();
                                                    $pdf->SetLeftMargin(8);
                                                    $counter =30;
                                                    $counter = $counter + ($row_number_for_singe_version*8) + 10 + 10 + 8; 
                                                } 

                                            $pdf->SetFont('Arial','B',11);
                                            $pdf->Ln(3);
                                            $pdf->Cell(280,7,"Version Summary".$pdf->SetFillColor(220,220,220),"1","1","C",true);
                                            $pdf->SetFont('Arial','B',9);

                                          $x = $pdf->GetX();
                                          $y = $pdf->GetY();
                                          $data = "Version";
                                          strlen($data)<30?$b=10:$b=5;
                                          $pdf->MultiCell(40,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                          $pdf->SetXY($x + 40, $y);
                                          $data = "Color";
                                          strlen($data)<30?$b=10:$b=5;
                                          $pdf->MultiCell(40,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                          $pdf->SetXY($x + 80, $y);
                                          $data = "Style";
                                          strlen($data)<30?$b=10:$b=5;
                                          $pdf->MultiCell(35,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                          $pdf->SetXY($x + 115, $y);
                                          $data = "PP Quantity (mtr.)";
                                          strlen($data)<15?$b=10:$b=5;
                                          $pdf->MultiCell(24,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                          $pdf->SetXY($x + 139, $y);
                                          $data = "Before process Qty (mtr.)";
                                          strlen($data)<20?$b=10:$b=5;
                                          $pdf->MultiCell(26,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                          $pdf->SetXY($x + 165, $y);
                                          $data = "Process Quantity (mtr.)";
                                          strlen($data)<20?$b=10:$b=5;
                                          $pdf->MultiCell(25,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                          $pdf->SetXY($x + 190, $y);
                                          $data = "(+/-) From PP";
                                          strlen($data)<10?$b=10:$b=5;
                                          $pdf->MultiCell(45,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                          $pdf->SetXY($x + 190, $y+5);
                                          $data = "Qty (mtr.)";
                                          // strlen($data)<15?$b=10:$b=5;
                                          $pdf->MultiCell(25,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                          $pdf->SetXY($x + 215, $y+5);
                                          $data = "%";
                                          // strlen($data)<15?$b=10:$b=5;
                                          $pdf->MultiCell(20,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                          $pdf->SetXY($x + 235, $y);
                                          $data = "(+/-) From Greige";
                                          strlen($data)<10?$b=10:$b=5;
                                          $pdf->MultiCell(45,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                          $pdf->SetXY($x + 235, $y+5);
                                          $data = "Qty (mtr.)";
                                          // strlen($data)<15?$b=10:$b=5;
                                          $pdf->MultiCell(25,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                          $pdf->SetXY($x + 260, $y+5);
                                          $data = "%";
                                          // strlen($data)<15?$b=10:$b=5;
                                          $pdf->MultiCell(20,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                          $pdf->SetXY($x + 200, $y);
                                          
                                          $pdf->Cell(0,0,$pdf->SetFillColor(255,255,255),'1','1','C',true);
                                          $pdf->SetFont('Arial','',9);       
                                          $pdf->Ln(10);
              
                                    while($row = mysqli_fetch_array($result_for_singe_version))  
                                    {  
                                        $x = $pdf->GetX();
                                        $y = $pdf->GetY();
                                        $data = $row['version_number'];
                                        strlen($data)<20?$b=8:$b=4;
                                        $pdf->MultiCell(40,$b,$data,'1','C');
                                        $pdf->SetXY($x + 40, $y);
                                        $data = $row['color'];
                                        strlen($data)<20?$b=8:$b=4;
                                        $pdf->MultiCell(40,$b,$data,'1','C');
                                        $pdf->SetXY($x + 80, $y);
                                        $data = $row['style_name'];
                                        strlen($data)<20?$b=8:$b=4;
                                        $pdf->MultiCell(35,$b,$data,'1','C');
                                        $pdf->SetXY($x + 115, $y);
                                        $data = $row['pp_quantity'];
                                        strlen($data)<20?$b=8:$b=4;
                                        $pdf->MultiCell(24,$b,$data,'1','C');
                                        $pdf->SetXY($x + 139, $y);
                                        $data = $row['before_process_qty'];
                                        strlen($data)<20?$b=8:$b=4;
                                        $pdf->MultiCell(26,$b,$data,'1','C');
                                        $pdf->SetXY($x + 165, $y);
                                        $data = $row['process_qty'];
                                        strlen($data)<20?$b=8:$b=4;
                                        $pdf->MultiCell(25,$b,$data,'1','C');
                                        $pdf->SetXY($x + 190, $y);
                                        $data = $row['short_pp'];
                                        strlen($data)<15?$b=8:$b=4;
                                        $pdf->MultiCell(25,$b,$data,'1','C');
                                        $pdf->SetXY($x + 215, $y);
                                        $data = $row['short_pp_percent'];
                                        strlen($data)<15?$b=8:$b=4;
                                        $pdf->MultiCell(20,$b,$data,'1','C');
                                        $pdf->SetXY($x + 235, $y);
                                        $data = $row['short_gre_rcv_qty'];
                                        strlen($data)<15?$b=8:$b=4;
                                        $pdf->MultiCell(25,$b,$data,'1','C');
                                        $pdf->SetXY($x + 260, $y);
                                        $data = $row['short_gre_rcv_percent'];
                                        strlen($data)<15?$b=8:$b=4;
                                        $pdf->MultiCell(20,$b,$data,'1','C');
                                        // $pdf->SetXY($x + 280, $y);

                                    }

                                    $sql_for_singe_total = "select total.pp_number, sum(total.pp_quantity) pp_quantity, sum(total.process_qty) process_qty, 
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
                                  $result_for_singe_total= mysqli_query($con,$sql_for_singe_total) or die(mysqli_error($con));
                                  while($row = mysqli_fetch_array($result_for_singe_total))  
                                  {
                                      $pdf->SetFont('Arial','B',9); 
                                      $x = $pdf->GetX();
                                      $y = $pdf->GetY();
                                      $data = "Singeing & Desizing Total Qty. (mtr.)";
                                      strlen($data)<70?$b=8:$b=4;
                                      $pdf->MultiCell(115,$b,$data,'1','C');
                                      $pdf->SetXY($x + 115, $y);
                                      $data = $row['pp_quantity'];
                                      strlen($data)<20?$b=8:$b=4;
                                      $pdf->MultiCell(24,$b,$data,'1','C');
                                      $pdf->SetXY($x + 139, $y);
                                      $data = $row['before_process_qty'];
                                      strlen($data)<20?$b=8:$b=4;
                                      $pdf->MultiCell(26,$b,$data,'1','C');
                                      $pdf->SetXY($x + 165, $y);
                                      $data = $row['process_qty'];
                                      strlen($data)<20?$b=8:$b=4;
                                      $pdf->MultiCell(25,$b,$data,'1','C');
                                      $pdf->SetXY($x + 190, $y);
                                      $data = $row['short_pp_qty'];
                                      strlen($data)<20?$b=8:$b=4;
                                      $pdf->MultiCell(25,$b,$data,'1','C');
                                      $pdf->SetXY($x + 215, $y);
                                      $data = $row['short_pp_percent'];
                                      strlen($data)<20?$b=8:$b=4;
                                      $pdf->MultiCell(20,$b,$data,'1','C'); 
                                      $pdf->SetXY($x + 235, $y); 
                                      $data = $row['short_gre_rcv_qty'];
                                      strlen($data)<20?$b=8:$b=4;
                                      $pdf->MultiCell(25,$b,$data,'1','C');
                                      $pdf->SetXY($x + 260, $y);
                                      $data = $row['short_gre_rcv_percent'];
                                      strlen($data)<20?$b=8:$b=4;
                                      $pdf->MultiCell(20,$b,$data,'1','C');  

                                      if($row['short_excess_qty']!= '') 
                                          {
                                              $process_loss_gain+=$row['short_excess_qty'];
                                          }
                              
                                          $Total_pp_quantity = $row['pp_quantity'];
                                          $Total_greige_quantity = $row['process_qty'];
                                   
                                  }

              }
            }           // Singeing and desizing end


             /*********************************Create Singing (Process No- 21) Table**********************************/

          $greige_period = "select ptftri.pp_number, ptftri.process_id, date_format(min(ptftri.partial_test_for_test_result_creation_date), '%d-%b-%Y') start_date,
          date_format(max(ptftri.partial_test_for_test_result_creation_date), '%d-%b-%Y') end_date
          from partial_test_for_test_result_info  ptftri
          where  ptftri.process_id = 'proc_21' and ptftri.pp_number = '$pp_number'  
              ";

          $result_for_greige= mysqli_query($con,$greige_period) or die(mysqli_error($con));
          while($row = mysqli_fetch_array($result_for_greige))  
          {  
              if($row['end_date']!= '') $process_completion_date = $row['end_date'];

              if($row_for_select_process["process_id"] == "proc_21")
              {
                  $Serial+=1;

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
                  ptftri.pp_number = aptv.pp_number and ptftri.version_id = aptv.version_id and ptftri.style=aptv.style_name  and ptftri.process_name=aptv.process_name and ptftri.process_id = 'proc_21'
                   and ptftri.pp_number = '$pp_number')result 
                  
                  on pp.pp_number = result.pp_number and pp.version_id = result.version_id  order by result.date, pp.pp_number, pp.version_id, pp.color, pp.style_name, pp.gw, pp.fw;";
               
                  $result_for_singe_desize= mysqli_query($con,$sql_for_singe_desize) or die(mysqli_error($con));

                  $row_number_for_singe = mysqli_num_rows($result_for_singe_desize);

                  $counter = $counter + ($row_number_for_singe*8) + 10 + 10; 
      
                      if($counter>200)
                          {
                              $pdf->AddPage();
                              $pdf->SetLeftMargin(8);
                              $counter =30;
                              $counter = $counter + ($row_number_for_singe*8) + 10 + 10; 

                          } 

                  $pdf->SetFont('Arial','B',14);
                  $pdf->Ln(3);
                  $pdf->Cell(280,7,$Serial.'.'.'  '.'Singeing'.'   ('.$row["start_date"].' To '.$row["end_date"].')'.$pdf->SetFillColor(255,255,255),"0","1","L",true);
                  $pdf->SetFont('Arial','B',9);
                //   $pdf->Ln(2);
                 
      
                  $x = $pdf->GetX();
                  $y = $pdf->GetY();
                  $data = "Date";
                  strlen($data)<15?$b=10:$b=5;
                  $pdf->MultiCell(25,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                  $pdf->SetXY($x + 25, $y);
                  $data = "Version";
                  strlen($data)<15?$b=10:$b=5;
                  $pdf->MultiCell(40,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                  $pdf->SetXY($x + 65, $y);
                  $data = "Color";
                  strlen($data)<15?$b=10:$b=5;
                  $pdf->MultiCell(40,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                  $pdf->SetXY($x + 105, $y);
                  $data = "Style";
                  strlen($data)<15?$b=10:$b=5;
                  $pdf->MultiCell(40,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                  $pdf->SetXY($x + 145, $y);
                  $data = "Greige Width (inch)";
                  strlen($data)<15?$b=10:$b=5;
                  $pdf->MultiCell(25,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                  $pdf->SetXY($x + 170, $y);
                  $data = "Finish Width (inch)";
                  strlen($data)<15?$b=10:$b=5;
                  $pdf->MultiCell(25,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                  $pdf->SetXY($x + 195, $y);
                  $data = "After Batcher / Trolley No.";
                  strlen($data)<15?$b=10:$b=5;
                  $pdf->MultiCell(30,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                  $pdf->SetXY($x + 225, $y);
                  $data = "Process Quantity (mtr.)";
                  strlen($data)<20?$b=10:$b=5;
                  $pdf->MultiCell(35,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                  $pdf->SetXY($x + 260, $y);
                  $data = "Process / Reprocess";
                  strlen($data)<15?$b=10:$b=5;
                  $pdf->MultiCell(20,$b,"$data".$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                  // $pdf->SetXY($x + 194, $y);

                  $pdf->Cell(280,0,$pdf->SetFillColor(255,255,255),'1','1','c',true);
      
                  $pdf->SetFont('Arial','',9);


                                                  while($row = mysqli_fetch_array($result_for_singe_desize))  
                                                  {
                                                      $x = $pdf->GetX();
                                                      $y = $pdf->GetY();
                                                      $data = $row['date'];
                                                      strlen($data)<20?$b=8:$b=4;
                                                      $pdf->MultiCell(25,$b,$data,'1','C');
                                                      $pdf->SetXY($x + 25, $y);
                                                      $data = $row['version_number'];
                                                      strlen($data)<20?$b=8:$b=4;
                                                      $pdf->MultiCell(40,$b,$data,'1','C');
                                                      $pdf->SetXY($x + 65, $y);
                                                      $data = $row['color'];
                                                      strlen($data)<20?$b=8:$b=4;
                                                      $pdf->MultiCell(40,$b,$data,'1','C');
                                                      $pdf->SetXY($x + 105, $y);
                                                      $data = $row['style_name'];
                                                      strlen($data)<20?$b=8:$b=4;
                                                      $pdf->MultiCell(40,$b,$data,'1','C');
                                                      $pdf->SetXY($x + 145, $y);
                                                      $data = $row['gw'];
                                                      strlen($data)<20?$b=8:$b=4;
                                                      $pdf->MultiCell(25,$b,$data,'1','C');
                                                      $pdf->SetXY($x + 170, $y);
                                                      $data = $row['fw'];
                                                      strlen($data)<20?$b=8:$b=4;
                                                      $pdf->MultiCell(25,$b,$data,'1','C');
                                                      $pdf->SetXY($x + 195, $y);
                                                      $data = $row['after_trolley_number_or_batcher_number'];
                                                      strlen($data)<20?$b=8:$b=4;
                                                      $pdf->MultiCell(30,$b,$data,'1','C');
                                                      $pdf->SetXY($x + 225, $y);
                                                      $data = $row['after_trolley_or_batcher_qty'];
                                                      strlen($data)<20?$b=8:$b=4;
                                                      $pdf->MultiCell(35,$b,$data,'1','C');
                                                      $pdf->SetXY($x + 260, $y);
                                                      $data = $row['process_or_reprocess'];
                                                      strlen($data)<20?$b=8:$b=4;
                                                      $pdf->SetFont('Arial','',7);
                                                      $pdf->MultiCell(20,$b,$data,'1','C'); 
                                                      $pdf->SetFont('Arial','',9);
                                                  }



                                          // Width summary for signeing	

                                          $sql_for_singe_width = "select pp.pp_number, pp.gw, pp.fw, pp.pp_quantity, result.process_qty, result.before_process_qty, result.gray_process_qty,
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
                                          and ptftri.process_id = 'proc_21' and ptftri.pp_number = '$pp_number'
                                          group by ptftri.pp_number, pwvci.finish_width_in_inch, pwvci.greige_width_in_inch,ptftri.version_id )P
                                          where  1=1
                                          and ptftri_1.process_id = p.process_id
                                          and ptftri_1.pp_number = p.pp_number
                                          and ptftri_1.version_id = p.version_id
                                          and ptftri_1.partial_test_for_test_result_creation_date = p.max_date
                                          group by process_id,pp_number, fw,  gw)result 
                                          on pp.pp_number = result.pp_number and pp.fw = result.fw and pp.gw = result.gw 
                                          order by pp.pp_number, pp.gw, pp.fw";
                                          
                                          $result_for_singe_width= mysqli_query($con,$sql_for_singe_width) or die(mysqli_error($con));

                                          $row_number_for_singe_width = mysqli_num_rows($result_for_singe_width);

                                          $counter = $counter + ($row_number_for_singe_width*8) + 10 + 10; 
                            
                                            if($counter>200)
                                                {
                                                    $pdf->AddPage();
                                                    $pdf->SetLeftMargin(8);
                                                    $counter =30;
                                                    $counter = $counter + ($row_number_for_singe_width*8) + 10 + 10; 
                                                } 

                                          $pdf->SetFont('Arial','B',11);
                                          $pdf->Ln(3);
                                          $pdf->Cell(280,7,"Width Summary".$pdf->SetFillColor(220,220,220),"1","1","C",true);
                                          $pdf->SetFont('Arial','B',9);

                                          $x = $pdf->GetX();
                                          $y = $pdf->GetY();
                                          $data = "Greige Width (inch)";
                                          strlen($data)<20?$b=10:$b=5;
                                          $pdf->MultiCell(35,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                          $pdf->SetXY($x + 35, $y);
                                          $data = "Finish Width (inch)";
                                          strlen($data)<20?$b=10:$b=5;
                                          $pdf->MultiCell(35,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                          $pdf->SetXY($x + 70, $y);
                                          $data = "PP Quantity. (mtr.)";
                                          strlen($data)<20?$b=10:$b=5;
                                          $pdf->MultiCell(40,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                          $pdf->SetXY($x + 110, $y);
                                          $data = "Before Process Quantity (mtr.)";
                                          strlen($data)<15?$b=10:$b=5;
                                          $pdf->MultiCell(40,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                          $pdf->SetXY($x + 150, $y);
                                          $data = "Process Quantity. (mtr.)";
                                          strlen($data)<25?$b=10:$b=5;
                                          $pdf->MultiCell(40,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                          $pdf->SetXY($x + 190, $y);
                                          $data = "(+/-) From PP";
                                          // strlen($data)<15?$b=10:$b=5;
                                          $pdf->MultiCell(45,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                          $pdf->SetXY($x + 190, $y+5);
                                          $data = "Qty (mtr.)";
                                          // strlen($data)<15?$b=10:$b=5;
                                          $pdf->MultiCell(25,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                          $pdf->SetXY($x + 215, $y+5);
                                          $data = "%";
                                          // strlen($data)<15?$b=10:$b=5;
                                          $pdf->MultiCell(20,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                          $pdf->SetXY($x + 235, $y);
                                          $data = "(+/-) From Greige";
                                          // strlen($data)<15?$b=10:$b=5;
                                          $pdf->MultiCell(45,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                          $pdf->SetXY($x + 235, $y+5);
                                          $data = "Qty (mtr.)";
                                          // strlen($data)<15?$b=10:$b=5;
                                          $pdf->MultiCell(25,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                          $pdf->SetXY($x + 260, $y+5);
                                          $data = "%";
                                          // strlen($data)<15?$b=10:$b=5;
                                          $pdf->MultiCell(20,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                          $pdf->SetXY($x + 280, $y);
                                          
                                          // $pdf->Cell(0,0,$pdf->SetFillColor(255,255,255),'1','1','C',true);
                                          $pdf->SetFont('Arial','',9);       
                                           $pdf->Ln(10);
                                         
                                          
                                      while($row = mysqli_fetch_array($result_for_singe_width))  
                                      {
                                          $x = $pdf->GetX();
                                          $y = $pdf->GetY();
                                          $data = $row['gw'];
                                          strlen($data)<20?$b=8:$b=4;
                                          $pdf->MultiCell(35,$b,$data,'1','C');
                                          $pdf->SetXY($x + 35, $y);
                                          $data = $row['fw'];
                                          strlen($data)<20?$b=8:$b=4;
                                          $pdf->MultiCell(35,$b,$data,'1','C');
                                          $pdf->SetXY($x + 70, $y);
                                          $data = $row['pp_quantity'];
                                          strlen($data)<20?$b=8:$b=4;
                                          $pdf->MultiCell(40,$b,$data,'1','C');
                                          $pdf->SetXY($x + 110, $y);
                                          $data = $row['before_process_qty'];
                                          strlen($data)<20?$b=8:$b=4;
                                          $pdf->MultiCell(40,$b,$data,'1','C');
                                          $pdf->SetXY($x + 150, $y);
                                          $data = $row['process_qty'];
                                          strlen($data)<20?$b=8:$b=4;
                                          $pdf->MultiCell(40,$b,$data,'1','C');
                                          $pdf->SetXY($x + 190, $y);
                                          $data = $row['short_pp_qty'];
                                          strlen($data)<15?$b=8:$b=4;
                                          $pdf->MultiCell(25,$b,$data,'1','C');
                                          $pdf->SetXY($x + 215, $y);
                                          $data = $row['short_pp_percent'];
                                          strlen($data)<15?$b=8:$b=4;
                                          $pdf->MultiCell(20,$b,$data,'1','C');
                                          $pdf->SetXY($x + 235, $y);
                                          $data = $row['short_gre_rcv_qty'];
                                          strlen($data)<15?$b=8:$b=4;
                                          $pdf->MultiCell(25,$b,$data,'1','C');
                                          $pdf->SetXY($x + 260, $y);
                                          $data = $row['short_gre_rcv_percent'];
                                          strlen($data)<15?$b=8:$b=4;
                                          $pdf->MultiCell(20,$b,$data,'1','C');
                                          // $pdf->SetXY($x + 200, $y);

                                      }
                                          // Version summary for Signeing

                                           $sql_for_singe_version = "select pp.pp_number, pp.version_name version_number, pp.style_name, pp.color, pp.gw, pp.fw, pp.pp_quantity, result.process_qty, result.before_process_qty, result.gray_process_qty, 
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
                                            and ptftri.process_id = 'proc_21' and ptftri.pp_number = '$pp_number'
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
                                            $result_for_singe_version= mysqli_query($con,$sql_for_singe_version) or die(mysqli_error($con));

                                            $row_number_for_singe_version = mysqli_num_rows($result_for_singe_version);

                                            $counter = $counter + ($row_number_for_singe_version*8) + 10 + 10 + 8; 
                            
                                            if($counter>200)
                                                {
                                                    $pdf->AddPage();
                                                    $pdf->SetLeftMargin(8);
                                                    $counter =30;
                                                    $counter = $counter + ($row_number_for_singe_version*8) + 10 + 10 + 8; 
                                                } 

                                            $pdf->SetFont('Arial','B',11);
                                            $pdf->Ln(3);
                                            $pdf->Cell(280,7,"Version Summary".$pdf->SetFillColor(220,220,220),"1","1","C",true);
                                            $pdf->SetFont('Arial','B',9);

                                          $x = $pdf->GetX();
                                          $y = $pdf->GetY();
                                          $data = "Version";
                                          strlen($data)<30?$b=10:$b=5;
                                          $pdf->MultiCell(40,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                          $pdf->SetXY($x + 40, $y);
                                          $data = "Color";
                                          strlen($data)<30?$b=10:$b=5;
                                          $pdf->MultiCell(40,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                          $pdf->SetXY($x + 80, $y);
                                          $data = "Style";
                                          strlen($data)<30?$b=10:$b=5;
                                          $pdf->MultiCell(35,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                          $pdf->SetXY($x + 115, $y);
                                          $data = "PP Quantity (mtr.)";
                                          strlen($data)<15?$b=10:$b=5;
                                          $pdf->MultiCell(24,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                          $pdf->SetXY($x + 139, $y);
                                          $data = "Before process Qty (mtr.)";
                                          strlen($data)<20?$b=10:$b=5;
                                          $pdf->MultiCell(26,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                          $pdf->SetXY($x + 165, $y);
                                          $data = "Process Quantity (mtr.)";
                                          strlen($data)<20?$b=10:$b=5;
                                          $pdf->MultiCell(25,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                          $pdf->SetXY($x + 190, $y);
                                          $data = "(+/-) From PP";
                                          strlen($data)<10?$b=10:$b=5;
                                          $pdf->MultiCell(45,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                          $pdf->SetXY($x + 190, $y+5);
                                          $data = "Qty (mtr.)";
                                          // strlen($data)<15?$b=10:$b=5;
                                          $pdf->MultiCell(25,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                          $pdf->SetXY($x + 215, $y+5);
                                          $data = "%";
                                          // strlen($data)<15?$b=10:$b=5;
                                          $pdf->MultiCell(20,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                          $pdf->SetXY($x + 235, $y);
                                          $data = "(+/-) From Greige";
                                          strlen($data)<10?$b=10:$b=5;
                                          $pdf->MultiCell(45,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                          $pdf->SetXY($x + 235, $y+5);
                                          $data = "Qty (mtr.)";
                                          // strlen($data)<15?$b=10:$b=5;
                                          $pdf->MultiCell(25,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                          $pdf->SetXY($x + 260, $y+5);
                                          $data = "%";
                                          // strlen($data)<15?$b=10:$b=5;
                                          $pdf->MultiCell(20,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                          $pdf->SetXY($x + 200, $y);
                                          
                                          $pdf->Cell(0,0,$pdf->SetFillColor(255,255,255),'1','1','C',true);
                                          $pdf->SetFont('Arial','',9);       
                                          $pdf->Ln(10);
              
                                    while($row = mysqli_fetch_array($result_for_singe_version))  
                                    {  
                                        $x = $pdf->GetX();
                                        $y = $pdf->GetY();
                                        $data = $row['version_number'];
                                        strlen($data)<20?$b=8:$b=4;
                                        $pdf->MultiCell(40,$b,$data,'1','C');
                                        $pdf->SetXY($x + 40, $y);
                                        $data = $row['color'];
                                        strlen($data)<20?$b=8:$b=4;
                                        $pdf->MultiCell(40,$b,$data,'1','C');
                                        $pdf->SetXY($x + 80, $y);
                                        $data = $row['style_name'];
                                        strlen($data)<20?$b=8:$b=4;
                                        $pdf->MultiCell(35,$b,$data,'1','C');
                                        $pdf->SetXY($x + 115, $y);
                                        $data = $row['pp_quantity'];
                                        strlen($data)<20?$b=8:$b=4;
                                        $pdf->MultiCell(24,$b,$data,'1','C');
                                        $pdf->SetXY($x + 139, $y);
                                        $data = $row['before_process_qty'];
                                        strlen($data)<20?$b=8:$b=4;
                                        $pdf->MultiCell(26,$b,$data,'1','C');
                                        $pdf->SetXY($x + 165, $y);
                                        $data = $row['process_qty'];
                                        strlen($data)<20?$b=8:$b=4;
                                        $pdf->MultiCell(25,$b,$data,'1','C');
                                        $pdf->SetXY($x + 190, $y);
                                        $data = $row['short_pp'];
                                        strlen($data)<15?$b=8:$b=4;
                                        $pdf->MultiCell(25,$b,$data,'1','C');
                                        $pdf->SetXY($x + 215, $y);
                                        $data = $row['short_pp_percent'];
                                        strlen($data)<15?$b=8:$b=4;
                                        $pdf->MultiCell(20,$b,$data,'1','C');
                                        $pdf->SetXY($x + 235, $y);
                                        $data = $row['short_gre_rcv_qty'];
                                        strlen($data)<15?$b=8:$b=4;
                                        $pdf->MultiCell(25,$b,$data,'1','C');
                                        $pdf->SetXY($x + 260, $y);
                                        $data = $row['short_gre_rcv_percent'];
                                        strlen($data)<15?$b=8:$b=4;
                                        $pdf->MultiCell(20,$b,$data,'1','C');
                                        // $pdf->SetXY($x + 280, $y);

                                    }

                                    $sql_for_singe_total = "select total.pp_number, sum(total.pp_quantity) pp_quantity, sum(total.process_qty) process_qty, 
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
                                    and ptftri.process_id = 'proc_21' and ptftri.pp_number = '$pp_number'
                                    group by ptftri.pp_number, ptftri.version_number, ptftri.finish_width_in_inch )P
                                    where  1=1
                                    and ptftri_1.process_id = p.process_id
                                    and ptftri_1.pp_number = p.pp_number
                                    and ptftri_1.version_number = p.version_name
                                    and ptftri_1.partial_test_for_test_result_creation_date = p.max_date
                                    and ptftri_1.finish_width_in_inch = p.finish_width_in_inch
                                    group by process_id,pp_number, version_name)result where pp.pp_number = result.pp_number and pp.version_name = result.version_name ) total
                                    ";
                                  $result_for_singe_total= mysqli_query($con,$sql_for_singe_total) or die(mysqli_error($con));
                                  while($row = mysqli_fetch_array($result_for_singe_total))  
                                  {
                                      $pdf->SetFont('Arial','B',9); 
                                      $x = $pdf->GetX();
                                      $y = $pdf->GetY();
                                      $data = "Singeing Total Qty. (mtr.)";
                                      strlen($data)<70?$b=8:$b=4;
                                      $pdf->MultiCell(115,$b,$data,'1','C');
                                      $pdf->SetXY($x + 115, $y);
                                      $data = $row['pp_quantity'];
                                      strlen($data)<20?$b=8:$b=4;
                                      $pdf->MultiCell(24,$b,$data,'1','C');
                                      $pdf->SetXY($x + 139, $y);
                                      $data = $row['before_process_qty'];
                                      strlen($data)<20?$b=8:$b=4;
                                      $pdf->MultiCell(26,$b,$data,'1','C');
                                      $pdf->SetXY($x + 165, $y);
                                      $data = $row['process_qty'];
                                      strlen($data)<20?$b=8:$b=4;
                                      $pdf->MultiCell(25,$b,$data,'1','C');
                                      $pdf->SetXY($x + 190, $y);
                                      $data = $row['short_pp_qty'];
                                      strlen($data)<20?$b=8:$b=4;
                                      $pdf->MultiCell(25,$b,$data,'1','C');
                                      $pdf->SetXY($x + 215, $y);
                                      $data = $row['short_pp_percent'];
                                      strlen($data)<20?$b=8:$b=4;
                                      $pdf->MultiCell(20,$b,$data,'1','C'); 
                                      $pdf->SetXY($x + 235, $y); 
                                      $data = $row['short_gre_rcv_qty'];
                                      strlen($data)<20?$b=8:$b=4;
                                      $pdf->MultiCell(25,$b,$data,'1','C');
                                      $pdf->SetXY($x + 260, $y);
                                      $data = $row['short_gre_rcv_percent'];
                                      strlen($data)<20?$b=8:$b=4;
                                      $pdf->MultiCell(20,$b,$data,'1','C');  

                                      if($row['short_excess_qty']!= '') 
                                          {
                                              $process_loss_gain+=$row['short_excess_qty'];
                                          }
                              
                                          $Total_pp_quantity = $row['pp_quantity'];
                                          $Total_greige_quantity = $row['process_qty'];
                                   
                                  }

              }
            }


             /*********************************Create Desizing (Process No- 22) Table**********************************/

             $greige_period = "select ptftri.pp_number, ptftri.process_id, date_format(min(ptftri.partial_test_for_test_result_creation_date), '%d-%b-%Y') start_date,
             date_format(max(ptftri.partial_test_for_test_result_creation_date), '%d-%b-%Y') end_date
             from partial_test_for_test_result_info  ptftri
             where  ptftri.process_id = 'proc_22' and ptftri.pp_number = '$pp_number'  
                 ";
   
             $result_for_greige= mysqli_query($con,$greige_period) or die(mysqli_error($con));
             while($row = mysqli_fetch_array($result_for_greige))  
             {  
                 if($row['end_date']!= '') $process_completion_date = $row['end_date'];
   
                 if($row_for_select_process["process_id"] == "proc_22")
                 {
                     $Serial+=1;
   
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
                     ptftri.pp_number = aptv.pp_number and ptftri.version_id = aptv.version_id and ptftri.style=aptv.style_name  and ptftri.process_name=aptv.process_name and ptftri.process_id = 'proc_22'
                      and ptftri.pp_number = '$pp_number')result 
                     
                     on pp.pp_number = result.pp_number and pp.version_id = result.version_id  order by result.date, pp.pp_number, pp.version_id, pp.color, pp.style_name, pp.gw, pp.fw;";
                  
                     $result_for_singe_desize= mysqli_query($con,$sql_for_singe_desize) or die(mysqli_error($con));
   
                     $row_number_for_singe = mysqli_num_rows($result_for_singe_desize);
   
                     $counter = $counter + ($row_number_for_singe*8) + 10 + 10; 
         
                         if($counter>200)
                             {
                                 $pdf->AddPage();
                                 $pdf->SetLeftMargin(8);
                                 $counter =30;
                                 $counter = $counter + ($row_number_for_singe*8) + 10 + 10; 
   
                             } 
   
                     $pdf->SetFont('Arial','B',14);
                     $pdf->Ln(3);
                     $pdf->Cell(280,7,$Serial.'.'.'  '.'Desizing'.'   ('.$row["start_date"].' To '.$row["end_date"].')'.$pdf->SetFillColor(255,255,255),"0","1","L",true);
                     $pdf->SetFont('Arial','B',9);
                   //   $pdf->Ln(2);
                    
         
                     $x = $pdf->GetX();
                     $y = $pdf->GetY();
                     $data = "Date";
                     strlen($data)<15?$b=10:$b=5;
                     $pdf->MultiCell(25,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                     $pdf->SetXY($x + 25, $y);
                     $data = "Version";
                     strlen($data)<15?$b=10:$b=5;
                     $pdf->MultiCell(40,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                     $pdf->SetXY($x + 65, $y);
                     $data = "Color";
                     strlen($data)<15?$b=10:$b=5;
                     $pdf->MultiCell(40,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                     $pdf->SetXY($x + 105, $y);
                     $data = "Style";
                     strlen($data)<15?$b=10:$b=5;
                     $pdf->MultiCell(40,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                     $pdf->SetXY($x + 145, $y);
                     $data = "Greige Width (inch)";
                     strlen($data)<15?$b=10:$b=5;
                     $pdf->MultiCell(25,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                     $pdf->SetXY($x + 170, $y);
                     $data = "Finish Width (inch)";
                     strlen($data)<15?$b=10:$b=5;
                     $pdf->MultiCell(25,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                     $pdf->SetXY($x + 195, $y);
                     $data = "After Batcher / Trolley No.";
                     strlen($data)<15?$b=10:$b=5;
                     $pdf->MultiCell(30,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                     $pdf->SetXY($x + 225, $y);
                     $data = "Process Quantity (mtr.)";
                     strlen($data)<20?$b=10:$b=5;
                     $pdf->MultiCell(35,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                     $pdf->SetXY($x + 260, $y);
                     $data = "Process / Reprocess";
                     strlen($data)<15?$b=10:$b=5;
                     $pdf->MultiCell(20,$b,"$data".$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                     // $pdf->SetXY($x + 194, $y);
   
                     $pdf->Cell(280,0,$pdf->SetFillColor(255,255,255),'1','1','c',true);
         
                     $pdf->SetFont('Arial','',9);
   
   
                                                     while($row = mysqli_fetch_array($result_for_singe_desize))  
                                                     {
                                                         $x = $pdf->GetX();
                                                         $y = $pdf->GetY();
                                                         $data = $row['date'];
                                                         strlen($data)<20?$b=8:$b=4;
                                                         $pdf->MultiCell(25,$b,$data,'1','C');
                                                         $pdf->SetXY($x + 25, $y);
                                                         $data = $row['version_number'];
                                                         strlen($data)<20?$b=8:$b=4;
                                                         $pdf->MultiCell(40,$b,$data,'1','C');
                                                         $pdf->SetXY($x + 65, $y);
                                                         $data = $row['color'];
                                                         strlen($data)<20?$b=8:$b=4;
                                                         $pdf->MultiCell(40,$b,$data,'1','C');
                                                         $pdf->SetXY($x + 105, $y);
                                                         $data = $row['style_name'];
                                                         strlen($data)<20?$b=8:$b=4;
                                                         $pdf->MultiCell(40,$b,$data,'1','C');
                                                         $pdf->SetXY($x + 145, $y);
                                                         $data = $row['gw'];
                                                         strlen($data)<20?$b=8:$b=4;
                                                         $pdf->MultiCell(25,$b,$data,'1','C');
                                                         $pdf->SetXY($x + 170, $y);
                                                         $data = $row['fw'];
                                                         strlen($data)<20?$b=8:$b=4;
                                                         $pdf->MultiCell(25,$b,$data,'1','C');
                                                         $pdf->SetXY($x + 195, $y);
                                                         $data = $row['after_trolley_number_or_batcher_number'];
                                                         strlen($data)<20?$b=8:$b=4;
                                                         $pdf->MultiCell(30,$b,$data,'1','C');
                                                         $pdf->SetXY($x + 225, $y);
                                                         $data = $row['after_trolley_or_batcher_qty'];
                                                         strlen($data)<20?$b=8:$b=4;
                                                         $pdf->MultiCell(35,$b,$data,'1','C');
                                                         $pdf->SetXY($x + 260, $y);
                                                         $data = $row['process_or_reprocess'];
                                                         strlen($data)<20?$b=8:$b=4;
                                                         $pdf->SetFont('Arial','',7);
                                                         $pdf->MultiCell(20,$b,$data,'1','C'); 
                                                         $pdf->SetFont('Arial','',9);
                                                     }
   
   
   
                                             // Width summary for desizing	
   
                                             $sql_for_singe_width = "select pp.pp_number, pp.gw, pp.fw, pp.pp_quantity, result.process_qty, result.before_process_qty, result.gray_process_qty,
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
                                             and ptftri.process_id = 'proc_22' and ptftri.pp_number = '$pp_number'
                                             group by ptftri.pp_number, pwvci.finish_width_in_inch, pwvci.greige_width_in_inch,ptftri.version_id )P
                                             where  1=1
                                             and ptftri_1.process_id = p.process_id
                                             and ptftri_1.pp_number = p.pp_number
                                             and ptftri_1.version_id = p.version_id
                                             and ptftri_1.partial_test_for_test_result_creation_date = p.max_date
                                             group by process_id,pp_number, fw,  gw)result 
                                             on pp.pp_number = result.pp_number and pp.fw = result.fw and pp.gw = result.gw 
                                             order by pp.pp_number, pp.gw, pp.fw";
                                             
                                             $result_for_singe_width= mysqli_query($con,$sql_for_singe_width) or die(mysqli_error($con));
   
                                             $row_number_for_singe_width = mysqli_num_rows($result_for_singe_width);
   
                                             $counter = $counter + ($row_number_for_singe_width*8) + 10 + 10; 
                               
                                               if($counter>200)
                                                   {
                                                       $pdf->AddPage();
                                                       $pdf->SetLeftMargin(8);
                                                       $counter =30;
                                                       $counter = $counter + ($row_number_for_singe_width*8) + 10 + 10; 
                                                   } 
   
                                             $pdf->SetFont('Arial','B',11);
                                             $pdf->Ln(3);
                                             $pdf->Cell(280,7,"Width Summary".$pdf->SetFillColor(220,220,220),"1","1","C",true);
                                             $pdf->SetFont('Arial','B',9);
   
                                             $x = $pdf->GetX();
                                             $y = $pdf->GetY();
                                             $data = "Greige Width (inch)";
                                             strlen($data)<20?$b=10:$b=5;
                                             $pdf->MultiCell(35,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                             $pdf->SetXY($x + 35, $y);
                                             $data = "Finish Width (inch)";
                                             strlen($data)<20?$b=10:$b=5;
                                             $pdf->MultiCell(35,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                             $pdf->SetXY($x + 70, $y);
                                             $data = "PP Quantity. (mtr.)";
                                             strlen($data)<20?$b=10:$b=5;
                                             $pdf->MultiCell(40,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                             $pdf->SetXY($x + 110, $y);
                                             $data = "Before Process Quantity (mtr.)";
                                             strlen($data)<15?$b=10:$b=5;
                                             $pdf->MultiCell(40,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                             $pdf->SetXY($x + 150, $y);
                                             $data = "Process Quantity. (mtr.)";
                                             strlen($data)<25?$b=10:$b=5;
                                             $pdf->MultiCell(40,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                             $pdf->SetXY($x + 190, $y);
                                             $data = "(+/-) From PP";
                                             // strlen($data)<15?$b=10:$b=5;
                                             $pdf->MultiCell(45,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                             $pdf->SetXY($x + 190, $y+5);
                                             $data = "Qty (mtr.)";
                                             // strlen($data)<15?$b=10:$b=5;
                                             $pdf->MultiCell(25,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                             $pdf->SetXY($x + 215, $y+5);
                                             $data = "%";
                                             // strlen($data)<15?$b=10:$b=5;
                                             $pdf->MultiCell(20,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                             $pdf->SetXY($x + 235, $y);
                                             $data = "(+/-) From Greige";
                                             // strlen($data)<15?$b=10:$b=5;
                                             $pdf->MultiCell(45,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                             $pdf->SetXY($x + 235, $y+5);
                                             $data = "Qty (mtr.)";
                                             // strlen($data)<15?$b=10:$b=5;
                                             $pdf->MultiCell(25,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                             $pdf->SetXY($x + 260, $y+5);
                                             $data = "%";
                                             // strlen($data)<15?$b=10:$b=5;
                                             $pdf->MultiCell(20,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                             $pdf->SetXY($x + 280, $y);
                                             
                                             // $pdf->Cell(0,0,$pdf->SetFillColor(255,255,255),'1','1','C',true);
                                             $pdf->SetFont('Arial','',9);       
                                              $pdf->Ln(10);
                                            
                                             
                                         while($row = mysqli_fetch_array($result_for_singe_width))  
                                         {
                                             $x = $pdf->GetX();
                                             $y = $pdf->GetY();
                                             $data = $row['gw'];
                                             strlen($data)<20?$b=8:$b=4;
                                             $pdf->MultiCell(35,$b,$data,'1','C');
                                             $pdf->SetXY($x + 35, $y);
                                             $data = $row['fw'];
                                             strlen($data)<20?$b=8:$b=4;
                                             $pdf->MultiCell(35,$b,$data,'1','C');
                                             $pdf->SetXY($x + 70, $y);
                                             $data = $row['pp_quantity'];
                                             strlen($data)<20?$b=8:$b=4;
                                             $pdf->MultiCell(40,$b,$data,'1','C');
                                             $pdf->SetXY($x + 110, $y);
                                             $data = $row['before_process_qty'];
                                             strlen($data)<20?$b=8:$b=4;
                                             $pdf->MultiCell(40,$b,$data,'1','C');
                                             $pdf->SetXY($x + 150, $y);
                                             $data = $row['process_qty'];
                                             strlen($data)<20?$b=8:$b=4;
                                             $pdf->MultiCell(40,$b,$data,'1','C');
                                             $pdf->SetXY($x + 190, $y);
                                             $data = $row['short_pp_qty'];
                                             strlen($data)<15?$b=8:$b=4;
                                             $pdf->MultiCell(25,$b,$data,'1','C');
                                             $pdf->SetXY($x + 215, $y);
                                             $data = $row['short_pp_percent'];
                                             strlen($data)<15?$b=8:$b=4;
                                             $pdf->MultiCell(20,$b,$data,'1','C');
                                             $pdf->SetXY($x + 235, $y);
                                             $data = $row['short_gre_rcv_qty'];
                                             strlen($data)<15?$b=8:$b=4;
                                             $pdf->MultiCell(25,$b,$data,'1','C');
                                             $pdf->SetXY($x + 260, $y);
                                             $data = $row['short_gre_rcv_percent'];
                                             strlen($data)<15?$b=8:$b=4;
                                             $pdf->MultiCell(20,$b,$data,'1','C');
                                             // $pdf->SetXY($x + 200, $y);
   
                                         }
                                             // Version summary for desizing
   
                                              $sql_for_singe_version = "select pp.pp_number, pp.version_name version_number, pp.style_name, pp.color, pp.gw, pp.fw, pp.pp_quantity, result.process_qty, result.before_process_qty, result.gray_process_qty, 
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
                                               and ptftri.process_id = 'proc_22' and ptftri.pp_number = '$pp_number'
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
                                               $result_for_singe_version= mysqli_query($con,$sql_for_singe_version) or die(mysqli_error($con));
   
                                               $row_number_for_singe_version = mysqli_num_rows($result_for_singe_version);
   
                                               $counter = $counter + ($row_number_for_singe_version*8) + 10 + 10 + 8; 
                               
                                               if($counter>200)
                                                   {
                                                       $pdf->AddPage();
                                                       $pdf->SetLeftMargin(8);
                                                       $counter =30;
                                                       $counter = $counter + ($row_number_for_singe_version*8) + 10 + 10 + 8; 
                                                   } 
   
                                               $pdf->SetFont('Arial','B',11);
                                               $pdf->Ln(3);
                                               $pdf->Cell(280,7,"Version Summary".$pdf->SetFillColor(220,220,220),"1","1","C",true);
                                               $pdf->SetFont('Arial','B',9);
   
                                             $x = $pdf->GetX();
                                             $y = $pdf->GetY();
                                             $data = "Version";
                                             strlen($data)<30?$b=10:$b=5;
                                             $pdf->MultiCell(40,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                             $pdf->SetXY($x + 40, $y);
                                             $data = "Color";
                                             strlen($data)<30?$b=10:$b=5;
                                             $pdf->MultiCell(40,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                             $pdf->SetXY($x + 80, $y);
                                             $data = "Style";
                                             strlen($data)<30?$b=10:$b=5;
                                             $pdf->MultiCell(35,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                             $pdf->SetXY($x + 115, $y);
                                             $data = "PP Quantity (mtr.)";
                                             strlen($data)<15?$b=10:$b=5;
                                             $pdf->MultiCell(24,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                             $pdf->SetXY($x + 139, $y);
                                             $data = "Before process Qty (mtr.)";
                                             strlen($data)<20?$b=10:$b=5;
                                             $pdf->MultiCell(26,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                             $pdf->SetXY($x + 165, $y);
                                             $data = "Process Quantity (mtr.)";
                                             strlen($data)<20?$b=10:$b=5;
                                             $pdf->MultiCell(25,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                             $pdf->SetXY($x + 190, $y);
                                             $data = "(+/-) From PP";
                                             strlen($data)<10?$b=10:$b=5;
                                             $pdf->MultiCell(45,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                             $pdf->SetXY($x + 190, $y+5);
                                             $data = "Qty (mtr.)";
                                             // strlen($data)<15?$b=10:$b=5;
                                             $pdf->MultiCell(25,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                             $pdf->SetXY($x + 215, $y+5);
                                             $data = "%";
                                             // strlen($data)<15?$b=10:$b=5;
                                             $pdf->MultiCell(20,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                             $pdf->SetXY($x + 235, $y);
                                             $data = "(+/-) From Greige";
                                             strlen($data)<10?$b=10:$b=5;
                                             $pdf->MultiCell(45,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                             $pdf->SetXY($x + 235, $y+5);
                                             $data = "Qty (mtr.)";
                                             // strlen($data)<15?$b=10:$b=5;
                                             $pdf->MultiCell(25,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                             $pdf->SetXY($x + 260, $y+5);
                                             $data = "%";
                                             // strlen($data)<15?$b=10:$b=5;
                                             $pdf->MultiCell(20,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                             $pdf->SetXY($x + 200, $y);
                                             
                                             $pdf->Cell(0,0,$pdf->SetFillColor(255,255,255),'1','1','C',true);
                                             $pdf->SetFont('Arial','',9);       
                                             $pdf->Ln(10);
                 
                                       while($row = mysqli_fetch_array($result_for_singe_version))  
                                       {  
                                           $x = $pdf->GetX();
                                           $y = $pdf->GetY();
                                           $data = $row['version_number'];
                                           strlen($data)<20?$b=8:$b=4;
                                           $pdf->MultiCell(40,$b,$data,'1','C');
                                           $pdf->SetXY($x + 40, $y);
                                           $data = $row['color'];
                                           strlen($data)<20?$b=8:$b=4;
                                           $pdf->MultiCell(40,$b,$data,'1','C');
                                           $pdf->SetXY($x + 80, $y);
                                           $data = $row['style_name'];
                                           strlen($data)<20?$b=8:$b=4;
                                           $pdf->MultiCell(35,$b,$data,'1','C');
                                           $pdf->SetXY($x + 115, $y);
                                           $data = $row['pp_quantity'];
                                           strlen($data)<20?$b=8:$b=4;
                                           $pdf->MultiCell(24,$b,$data,'1','C');
                                           $pdf->SetXY($x + 139, $y);
                                           $data = $row['before_process_qty'];
                                           strlen($data)<20?$b=8:$b=4;
                                           $pdf->MultiCell(26,$b,$data,'1','C');
                                           $pdf->SetXY($x + 165, $y);
                                           $data = $row['process_qty'];
                                           strlen($data)<20?$b=8:$b=4;
                                           $pdf->MultiCell(25,$b,$data,'1','C');
                                           $pdf->SetXY($x + 190, $y);
                                           $data = $row['short_pp'];
                                           strlen($data)<15?$b=8:$b=4;
                                           $pdf->MultiCell(25,$b,$data,'1','C');
                                           $pdf->SetXY($x + 215, $y);
                                           $data = $row['short_pp_percent'];
                                           strlen($data)<15?$b=8:$b=4;
                                           $pdf->MultiCell(20,$b,$data,'1','C');
                                           $pdf->SetXY($x + 235, $y);
                                           $data = $row['short_gre_rcv_qty'];
                                           strlen($data)<15?$b=8:$b=4;
                                           $pdf->MultiCell(25,$b,$data,'1','C');
                                           $pdf->SetXY($x + 260, $y);
                                           $data = $row['short_gre_rcv_percent'];
                                           strlen($data)<15?$b=8:$b=4;
                                           $pdf->MultiCell(20,$b,$data,'1','C');
                                           // $pdf->SetXY($x + 280, $y);
   
                                       }
   
                                       $sql_for_singe_total = "select total.pp_number, sum(total.pp_quantity) pp_quantity, sum(total.process_qty) process_qty, 
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
                                       and ptftri.process_id = 'proc_22' and ptftri.pp_number = '$pp_number'
                                       group by ptftri.pp_number, ptftri.version_number, ptftri.finish_width_in_inch )P
                                       where  1=1
                                       and ptftri_1.process_id = p.process_id
                                       and ptftri_1.pp_number = p.pp_number
                                       and ptftri_1.version_number = p.version_name
                                       and ptftri_1.partial_test_for_test_result_creation_date = p.max_date
                                       and ptftri_1.finish_width_in_inch = p.finish_width_in_inch
                                       group by process_id,pp_number, version_name)result where pp.pp_number = result.pp_number and pp.version_name = result.version_name ) total
                                       ";
                                     $result_for_singe_total= mysqli_query($con,$sql_for_singe_total) or die(mysqli_error($con));
                                     while($row = mysqli_fetch_array($result_for_singe_total))  
                                     {
                                         $pdf->SetFont('Arial','B',9); 
                                         $x = $pdf->GetX();
                                         $y = $pdf->GetY();
                                         $data = "Desizing Total Qty. (mtr.)";
                                         strlen($data)<70?$b=8:$b=4;
                                         $pdf->MultiCell(115,$b,$data,'1','C');
                                         $pdf->SetXY($x + 115, $y);
                                         $data = $row['pp_quantity'];
                                         strlen($data)<20?$b=8:$b=4;
                                         $pdf->MultiCell(24,$b,$data,'1','C');
                                         $pdf->SetXY($x + 139, $y);
                                         $data = $row['before_process_qty'];
                                         strlen($data)<20?$b=8:$b=4;
                                         $pdf->MultiCell(26,$b,$data,'1','C');
                                         $pdf->SetXY($x + 165, $y);
                                         $data = $row['process_qty'];
                                         strlen($data)<20?$b=8:$b=4;
                                         $pdf->MultiCell(25,$b,$data,'1','C');
                                         $pdf->SetXY($x + 190, $y);
                                         $data = $row['short_pp_qty'];
                                         strlen($data)<20?$b=8:$b=4;
                                         $pdf->MultiCell(25,$b,$data,'1','C');
                                         $pdf->SetXY($x + 215, $y);
                                         $data = $row['short_pp_percent'];
                                         strlen($data)<20?$b=8:$b=4;
                                         $pdf->MultiCell(20,$b,$data,'1','C'); 
                                         $pdf->SetXY($x + 235, $y); 
                                         $data = $row['short_gre_rcv_qty'];
                                         strlen($data)<20?$b=8:$b=4;
                                         $pdf->MultiCell(25,$b,$data,'1','C');
                                         $pdf->SetXY($x + 260, $y);
                                         $data = $row['short_gre_rcv_percent'];
                                         strlen($data)<20?$b=8:$b=4;
                                         $pdf->MultiCell(20,$b,$data,'1','C');  
   
                                         if($row['short_excess_qty']!= '') 
                                             {
                                                 $process_loss_gain+=$row['short_excess_qty'];
                                             }
                                 
                                             $Total_pp_quantity = $row['pp_quantity'];
                                             $Total_greige_quantity = $row['process_qty'];
                                      
                                     }
   
                 }
               }

            /*********************************Create Scouring (Process No- 2) Table**********************************/

            $greige_period = "select ptftri.pp_number, ptftri.process_id, date_format(min(ptftri.partial_test_for_test_result_creation_date), '%d-%b-%Y') start_date,
            date_format(max(ptftri.partial_test_for_test_result_creation_date), '%d-%b-%Y') end_date
            from partial_test_for_test_result_info  ptftri
            where  ptftri.process_id = 'proc_2' and ptftri.pp_number = '$pp_number' ";

    $result_for_greige= mysqli_query($con,$greige_period) or die(mysqli_error($con));
    while($row = mysqli_fetch_array($result_for_greige))  
    {  
        if($row['end_date']!= '') 
        {
            $process_completion_date = $row['end_date'];
        }

        if($row_for_select_process["process_id"] == "proc_2")
        {
        $Serial+=1;

        $sql_for_scouring = "select pp.pp_number, pp.version_name as version_number, pp.color, pp.style_name, pp.gw, pp.fw, pp.pp_quantity, result.after_trolley_or_batcher_qty, result.date, 
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
        ptftri.pp_number = aptv.pp_number and ptftri.version_id = aptv.version_id and ptftri.style=aptv.style_name  and ptftri.process_name=aptv.process_name and ptftri.process_id = 'proc_2'
         and ptftri.pp_number = '$pp_number')result 
        
        on pp.pp_number = result.pp_number and pp.version_id = result.version_id  order by result.date, pp.pp_number, pp.version_id, pp.color, pp.style_name, pp.gw, pp.fw";
         
        $result_for_scouring = mysqli_query($con,$sql_for_scouring) or die(mysqli_error($con));

        $row_number_for_scouring = mysqli_num_rows($result_for_scouring);

        $counter = $counter + ($row_number_for_scouring*8) + 10 + 10; 

        if($counter>200)
            {
                $pdf->AddPage();
                $pdf->SetLeftMargin(8);
                $counter =30;
                $counter = $counter + ($row_number_for_scouring*8) + 10 + 10; 

            } 

        $pdf->SetFont('Arial','B',14);
        $pdf->Ln(3);
        $pdf->Cell(280,7,$Serial.'.'.'  '.'Scouring '.'   ('.$row["start_date"].' To '.$row["end_date"].')'.$pdf->SetFillColor(255,255,255),"0","1","L",true);
        $pdf->SetFont('Arial','B',9);
        $pdf->Ln(2);
       

        $x = $pdf->GetX();
        $y = $pdf->GetY();
        $data = "Date";
        strlen($data)<15?$b=10:$b=5;
        $pdf->MultiCell(21,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
        $pdf->SetXY($x + 21, $y);
        $data = "Version";
        strlen($data)<20?$b=10:$b=5;
        $pdf->MultiCell(28,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
        $pdf->SetXY($x + 49, $y);
        $data = "Color";
        strlen($data)<15?$b=10:$b=5;
        $pdf->MultiCell(24,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
        $pdf->SetXY($x + 73, $y);
        $data = "Style";
        strlen($data)<20?$b=10:$b=5;
        $pdf->MultiCell(24,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
        $pdf->SetXY($x + 97, $y);
        $data = "Greige Width (inch)";
        strlen($data)<10?$b=10:$b=5;
        $pdf->MultiCell(21,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
        $pdf->SetXY($x + 118, $y);
        $data = "Finish Width (inch)";
        strlen($data)<10?$b=10:$b=5;
        $pdf->MultiCell(21,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
        $pdf->SetXY($x + 139, $y);
        $data = "Before Trolley No.";
        strlen($data)<10?$b=10:$b=5;
        $pdf->MultiCell(20,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
        $pdf->SetXY($x + 159, $y);
        $data = "B. Process Qty (mtr.)";
        strlen($data)<15?$b=10:$b=5;
        $pdf->MultiCell(20,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
        $pdf->SetXY($x + 179, $y);
        $data = "After Trolley No.";
        strlen($data)<10?$b=10:$b=5;
        $pdf->MultiCell(20,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
        $pdf->SetXY($x + 199, $y);
        $data = "Process Qty (mtr.)";
        strlen($data)<10?$b=10:$b=5;
        $pdf->MultiCell(20,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
        $pdf->SetXY($x + 219, $y);
        $data = "(+/-) From Prev. Process";
        strlen($data)<10?$b=10:$b=5;
        $pdf->MultiCell(41,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
        $pdf->SetXY($x + 219, $y+5);
        $data = "Qty (mtr.)";
        // strlen($data)<15?$b=10:$b=5;
        $pdf->MultiCell(23,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
        $pdf->SetXY($x + 242, $y+5);
        $data = "%";
        // strlen($data)<15?$b=10:$b=5;
        $pdf->MultiCell(18,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
        $pdf->SetXY($x + 260, $y);
        $data = "Process / Reprocess";
        strlen($data)<10?$b=10:$b=5;
        $pdf->MultiCell(20,$b,"$data".$pdf->SetFillColor(220,220,220),'1','C',TRUE);
        // $pdf->SetXY($x + 194, $y);

        $pdf->Cell(200,0,$pdf->SetFillColor(255,255,255),'1','1','c',true);

        $pdf->SetFont('Arial','',9);


                                        while($row = mysqli_fetch_array($result_for_scouring))  
                                        {
                                            $x = $pdf->GetX();
                                            $y = $pdf->GetY();
                                            $data = $row['date'];
                                            strlen($data)<20?$b=8:$b=4;
                                            $pdf->MultiCell(21,$b,$data,'1','C');
                                            $pdf->SetXY($x + 21, $y);
                                            $data = $row['version_number'];
                                            strlen($data)<16?$b=8:$b=4;
                                            $pdf->MultiCell(28,$b,$data,'1','C');
                                            $pdf->SetXY($x + 49, $y);
                                            $data = $row['color'];
                                            strlen($data)<20?$b=8:$b=4;
                                            $pdf->MultiCell(24,$b,$data,'1','C');
                                            $pdf->SetXY($x + 73, $y);
                                            $data = $row['style_name'];
                                            strlen($data)<10?$b=8:$b=4;
                                            $pdf->MultiCell(24,$b,$data,'1','C');
                                            $pdf->SetXY($x + 97, $y);
                                            $data = $row['gw'];
                                            strlen($data)<20?$b=8:$b=4;
                                            $pdf->MultiCell(21,$b,$data,'1','C');
                                            $pdf->SetXY($x + 118, $y);
                                            $data = $row['fw'];
                                            strlen($data)<20?$b=8:$b=4;
                                            $pdf->MultiCell(21,$b,$data,'1','C');
                                            $pdf->SetXY($x + 139, $y);
                                            $data = $row['before_trolley_number_or_batcher_number'];
                                            strlen($data)<20?$b=8:$b=4;
                                            $pdf->MultiCell(20,$b,$data,'1','C');
                                            $pdf->SetXY($x + 159, $y);
                                            $data = $row['before_trolley_or_batcher_qty'];
                                            strlen($data)<20?$b=8:$b=4;
                                            $pdf->MultiCell(20,$b,$data,'1','C');
                                            $pdf->SetXY($x + 179, $y);
                                            $data = $row['after_trolley_number_or_batcher_number'];
                                            strlen($data)<20?$b=8:$b=4;
                                            $pdf->MultiCell(20,$b,$data,'1','C');
                                            $pdf->SetXY($x + 199, $y);
                                            $data = $row['after_trolley_or_batcher_qty'];
                                            strlen($data)<20?$b=8:$b=4;
                                            $pdf->MultiCell(20,$b,$data,'1','C');
                                            $pdf->SetXY($x + 219, $y);
                                            $data = $row['short_proc'];
                                            strlen($data)<20?$b=8:$b=4;
                                            $pdf->MultiCell(23,$b,$data,'1','C');
                                            $pdf->SetXY($x + 242, $y);
                                            $data = $row['short_percent'];
                                            strlen($data)<20?$b=8:$b=4;
                                            $pdf->MultiCell(18,$b,$data,'1','C');
                                            $pdf->SetXY($x + 260, $y);
                                            $data = $row['process_or_reprocess'];
                                            strlen($data)<20?$b=8:$b=4;
                                            $pdf->SetFont('Arial','',7);
                                            $pdf->MultiCell(20,$b,$data,'1','C'); 
                                            $pdf->SetFont('Arial','',9);
                                        }



                                // Width summary for Scouring

                                $sql_for_scouring_width = "select pp.pp_number, pp.gw, pp.fw, pp.pp_quantity, result.process_qty, result.before_process_qty, result.gray_process_qty,
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
                            and ptftri.process_id = 'proc_2' and ptftri.pp_number = '$pp_number'
                                group by ptftri.pp_number, pwvci.finish_width_in_inch, pwvci.greige_width_in_inch,ptftri.version_id )P
                            where  1=1
                            and ptftri_1.process_id = p.process_id
                            and ptftri_1.pp_number = p.pp_number
                            and ptftri_1.version_id = p.version_id
                            and ptftri_1.partial_test_for_test_result_creation_date = p.max_date
                            group by process_id,pp_number, fw,  gw)result 
                            on pp.pp_number = result.pp_number and pp.fw = result.fw and pp.gw = result.gw 
                            order by pp.pp_number, pp.gw, pp.fw";
                                
                                $result_for_scouring_width= mysqli_query($con,$sql_for_scouring_width) or die(mysqli_error($con));

                                $row_number_for_scouring_width = mysqli_num_rows($result_for_scouring_width);

                                $counter = $counter + ($row_number_for_scouring_width*8) + 10 + 10; 
                  
                                  if($counter>200)
                                      {
                                          $pdf->AddPage();
                                          $pdf->SetLeftMargin(8);
                                          $counter =30;
                                          $counter = $counter + ($row_number_for_scouring_width*8) + 10 + 10; 
                                      } 

                                $pdf->SetFont('Arial','B',11);
                                $pdf->Ln(3);
                                $pdf->Cell(280,7,"Width Summary".$pdf->SetFillColor(220,220,220),"1","1","C",true);
                                $pdf->SetFont('Arial','B',9);

                                $x = $pdf->GetX();
                                $y = $pdf->GetY();
                                $data = "Greige Width (inch)";
                                strlen($data)<15?$b=10:$b=5;
                                $pdf->MultiCell(30,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 30, $y);
                                $data = "Finish Width (inch)";
                                strlen($data)<15?$b=10:$b=5;
                                $pdf->MultiCell(30,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 60, $y);
                                $data = "PP Quantity. (mtr.)";
                                strlen($data)<25?$b=10:$b=5;
                                $pdf->MultiCell(32,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 92, $y);
                                $data = "Before Process Quantity (mtr.)";
                                strlen($data)<25?$b=10:$b=5;
                                $pdf->MultiCell(33,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 125, $y);
                                $data = "Process Quantity. (mtr.)";
                                strlen($data)<15?$b=10:$b=5;
                                $pdf->MultiCell(32,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 157, $y);
                                $data = "(+/-) From PP";
                                // strlen($data)<15?$b=10:$b=5;
                                $pdf->MultiCell(41,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 157, $y+5);
                                $data = "Qty (mtr.)";
                                // strlen($data)<15?$b=10:$b=5;
                                $pdf->MultiCell(23,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 180, $y+5);
                                $data = "%";
                                // strlen($data)<15?$b=10:$b=5;
                                $pdf->MultiCell(18,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 198, $y);
                                $data = "(+/-) From Greige";
                                // strlen($data)<15?$b=10:$b=5;
                                $pdf->MultiCell(41,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 198, $y+5);
                                $data = "Qty (mtr.)";
                                // strlen($data)<15?$b=10:$b=5;
                                $pdf->MultiCell(23,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 221, $y+5);
                                $data = "%";
                                // strlen($data)<15?$b=10:$b=5;
                                $pdf->MultiCell(18,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 239, $y);
                                $data = "(+/-) From Prev. Process";
                                // strlen($data)<15?$b=10:$b=5;
                                $pdf->MultiCell(41,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 239, $y+5);
                                $data = "Qty (mtr.)";
                                // strlen($data)<15?$b=10:$b=5;
                                $pdf->MultiCell(23,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 262, $y+5);
                                $data = "%";
                                // strlen($data)<15?$b=10:$b=5;
                                $pdf->MultiCell(18,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 280, $y);
                                
                                // $pdf->Cell(0,0,$pdf->SetFillColor(255,255,255),'1','1','C',true);
                                $pdf->SetFont('Arial','',9);       
                                 $pdf->Ln(10);
                               
                                
                            while($row = mysqli_fetch_array($result_for_scouring_width))  
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
                                $pdf->MultiCell(32,$b,$data,'1','C');
                                $pdf->SetXY($x + 92, $y);
                                $data = $row['before_process_qty'];
                                strlen($data)<20?$b=8:$b=4;
                                $pdf->MultiCell(33,$b,$data,'1','C');
                                $pdf->SetXY($x + 125, $y);
                                $data = $row['process_qty'];
                                strlen($data)<20?$b=8:$b=4;
                                $pdf->MultiCell(32,$b,$data,'1','C');
                                $pdf->SetXY($x + 157, $y);
                                $data = $row['short_pp_qty'];
                                strlen($data)<15?$b=8:$b=4;
                                $pdf->MultiCell(23,$b,$data,'1','C');
                                $pdf->SetXY($x + 180, $y);
                                $data = $row['short_pp_percent'];
                                strlen($data)<15?$b=8:$b=4;
                                $pdf->MultiCell(18,$b,$data,'1','C');
                                $pdf->SetXY($x + 198, $y);
                                $data = $row['short_gre_rcv_qty'];
                                strlen($data)<15?$b=8:$b=4;
                                $pdf->MultiCell(23,$b,$data,'1','C');
                                $pdf->SetXY($x + 221, $y);
                                $data = $row['short_gre_rcv_percent'];
                                strlen($data)<15?$b=8:$b=4;
                                $pdf->MultiCell(18,$b,$data,'1','C');
                                $pdf->SetXY($x + 239, $y);
                                $data = $row['short_pre_proc_qty'];
                                strlen($data)<15?$b=8:$b=4;
                                $pdf->MultiCell(23,$b,$data,'1','C');
                                $pdf->SetXY($x + 262, $y);
                                $data = $row['short_pre_proc_percent'];
                                strlen($data)<15?$b=8:$b=4;
                                $pdf->MultiCell(18,$b,$data,'1','C');
                                // $pdf->SetXY($x + 200, $y);

                            }
                                // Version summary for Scouring

                                 $sql_for_scouring_version = "select pp.pp_number, pp.version_name version_number, pp.style_name, pp.color, pp.gw, pp.fw, pp.pp_quantity, result.process_qty, result.before_process_qty, result.gray_process_qty, 
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
                                 and ptftri.process_id = 'proc_2' and ptftri.pp_number = '$pp_number'
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

                                  $result_for_scouring_version= mysqli_query($con,$sql_for_scouring_version) or die(mysqli_error($con));

                                  $row_number_for_scouring_version = mysqli_num_rows($result_for_scouring_version);

                                  $counter = $counter + ($row_number_for_scouring_version*8) + 10 + 10 + 8; 
                  
                                  if($counter>200)
                                      {
                                          $pdf->AddPage();
                                          $pdf->SetLeftMargin(8);
                                          $counter =30;
                                          $counter = $counter + ($row_number_for_scouring_version*8) + 10 + 10 + 8; 

                                      } 

                                  $pdf->SetFont('Arial','B',11);
                                  $pdf->Ln(3);
                                  $pdf->Cell(280,7,"Version Summary".$pdf->SetFillColor(220,220,220),"1","1","C",true);
                                  $pdf->SetFont('Arial','B',9);

                                $x = $pdf->GetX();
                                $y = $pdf->GetY();
                                $data = "Version";
                                strlen($data)<15?$b=10:$b=5;
                                $pdf->MultiCell(28,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 28, $y);
                                $data = "Color";
                                strlen($data)<15?$b=10:$b=5;
                                $pdf->MultiCell(24,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 52, $y);
                                $data = "Style";
                                strlen($data)<15?$b=10:$b=5;
                                $pdf->MultiCell(24,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 76, $y);
                                $data = "PP Quantity (mtr.)";
                                strlen($data)<15?$b=10:$b=5;
                                $pdf->MultiCell(27,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 103, $y);
                                $data = "Before process Qty (mtr.)";
                                strlen($data)<20?$b=10:$b=5;
                                $pdf->MultiCell(27,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 130, $y);
                                $data = "Process Quantity (mtr.)";
                                strlen($data)<20?$b=10:$b=5;
                                $pdf->MultiCell(27,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 157, $y);
                                $data = "(+/-) From PP";
                                // strlen($data)<15?$b=10:$b=5;
                                $pdf->MultiCell(41,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 157, $y+5);
                                $data = "Qty (mtr.)";
                                // strlen($data)<15?$b=10:$b=5;
                                $pdf->MultiCell(23,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 180, $y+5);
                                $data = "%";
                                // strlen($data)<15?$b=10:$b=5;
                                $pdf->MultiCell(18,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 198, $y);
                                $data = "(+/-) From Greige";
                                // strlen($data)<15?$b=10:$b=5;
                                $pdf->MultiCell(41,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 198, $y+5);
                                $data = "Qty (mtr.)";
                                // strlen($data)<15?$b=10:$b=5;
                                $pdf->MultiCell(23,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 221, $y+5);
                                $data = "%";
                                // strlen($data)<15?$b=10:$b=5;
                                $pdf->MultiCell(18,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 239, $y);
                                $data = "(+/-) From Prev. Process";
                                // strlen($data)<15?$b=10:$b=5;
                                $pdf->MultiCell(41,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 239, $y+5);
                                $data = "Qty (mtr.)";
                                // strlen($data)<15?$b=10:$b=5;
                                $pdf->MultiCell(23,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 262, $y+5);
                                $data = "%";
                                // strlen($data)<15?$b=10:$b=5;
                                $pdf->MultiCell(18,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 280, $y);
                                
                                // $pdf->Cell(0,0,$pdf->SetFillColor(255,255,255),'1','1','C',true);
                                $pdf->SetFont('Arial','',9);       
                                 $pdf->Ln(10);
    
                          while($row = mysqli_fetch_array($result_for_scouring_version))  
                          {  
                              $x = $pdf->GetX();
                              $y = $pdf->GetY();
                              $data = $row['version_number'];
                              strlen($data)<16?$b=8:$b=4;
                              $pdf->MultiCell(28,$b,$data,'1','C');
                              $pdf->SetXY($x + 28, $y);
                              $data = $row['color'];
                              strlen($data)<20?$b=8:$b=4;
                              $pdf->MultiCell(24,$b,$data,'1','C');
                              $pdf->SetXY($x + 52, $y);
                              $data = $row['style_name'];
                              strlen($data)<10?$b=8:$b=4;
                              $pdf->MultiCell(24,$b,$data,'1','C');
                              $pdf->SetXY($x + 76, $y);
                              $data = $row['pp_quantity'];
                              strlen($data)<20?$b=8:$b=4;
                              $pdf->MultiCell(27,$b,$data,'1','C');
                              $pdf->SetXY($x + 103, $y);
                              $data = $row['before_process_qty'];
                              strlen($data)<20?$b=8:$b=4;
                              $pdf->MultiCell(27,$b,$data,'1','C');
                              $pdf->SetXY($x + 130, $y);
                              $data = $row['process_qty'];
                              strlen($data)<20?$b=8:$b=4;
                              $pdf->MultiCell(27,$b,$data,'1','C');
                              $pdf->SetXY($x + 157, $y);
                              $data = $row['short_pp'];
                              strlen($data)<15?$b=8:$b=4;
                              $pdf->MultiCell(23,$b,$data,'1','C');
                              $pdf->SetXY($x + 180, $y);
                              $data = $row['short_pp_percent'];
                              strlen($data)<15?$b=8:$b=4;
                              $pdf->MultiCell(18,$b,$data,'1','C');
                              $pdf->SetXY($x + 198, $y);
                              $data = $row['short_gre_rcv_qty'];
                              strlen($data)<15?$b=8:$b=4;
                              $pdf->MultiCell(23,$b,$data,'1','C');
                              $pdf->SetXY($x + 221, $y);
                              $data = $row['short_gre_rcv_percent'];
                              strlen($data)<15?$b=8:$b=4;
                              $pdf->MultiCell(18,$b,$data,'1','C');
                              $pdf->SetXY($x + 239, $y);
                              $data = $row['short_pre_proc_qty'];
                              strlen($data)<15?$b=8:$b=4;
                              $pdf->MultiCell(23,$b,$data,'1','C');
                              $pdf->SetXY($x + 262, $y);
                              $data = $row['short_pre_proc_percent'];
                              strlen($data)<15?$b=8:$b=4;
                              $pdf->MultiCell(18,$b,$data,'1','C');
                              // $pdf->SetXY($x + 280, $y);

                          }

                          $sql_for_scouring_total = "select total.pp_number, sum(total.pp_quantity) pp_quantity, sum(total.process_qty) process_qty, 
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
                          and ptftri.process_id = 'proc_2' and ptftri.pp_number = '$pp_number'
                          group by ptftri.pp_number, ptftri.version_number, ptftri.finish_width_in_inch )P
                          where  1=1
                          and ptftri_1.process_id = p.process_id
                          and ptftri_1.pp_number = p.pp_number
                          and ptftri_1.version_number = p.version_name
                          and ptftri_1.partial_test_for_test_result_creation_date = p.max_date
                          and ptftri_1.finish_width_in_inch = p.finish_width_in_inch
                          group by process_id,pp_number, version_name)result where pp.pp_number = result.pp_number and pp.version_name = result.version_name ) total
                          ";

                        $result_for_scouring_total= mysqli_query($con,$sql_for_scouring_total) or die(mysqli_error($con));
                        while($row = mysqli_fetch_array($result_for_scouring_total))  
                        {
                            $pdf->SetFont('Arial','B',9); 
                            $x = $pdf->GetX();
                            $y = $pdf->GetY();
                            $data = "Scouring Total Qty. (mtr.)";
                            strlen($data)<70?$b=8:$b=4;
                            $pdf->MultiCell(76,$b,$data,'1','C');
                            $pdf->SetXY($x + 76, $y);
                            $data = $row['pp_quantity'];
                            strlen($data)<20?$b=8:$b=4;
                            $pdf->MultiCell(27,$b,$data,'1','C');
                            $pdf->SetXY($x + 103, $y);
                            $data = $row['before_process_qty'];
                            strlen($data)<20?$b=8:$b=4;
                            $pdf->MultiCell(27,$b,$data,'1','C');
                            $pdf->SetXY($x + 130, $y);
                            $data = $row['process_qty'];
                            strlen($data)<20?$b=8:$b=4;
                            $pdf->MultiCell(27,$b,$data,'1','C');
                            $pdf->SetXY($x + 157, $y);
                            $data = $row['short_pp_qty'];
                            strlen($data)<20?$b=8:$b=4;
                            $pdf->MultiCell(23,$b,$data,'1','C');
                            $pdf->SetXY($x + 180, $y);
                            $data = $row['short_pp_percent'];
                            strlen($data)<20?$b=8:$b=4;
                            $pdf->MultiCell(18,$b,$data,'1','C'); 
                            $pdf->SetXY($x + 198, $y); 
                            $data = $row['short_gre_rcv_qty'];
                            strlen($data)<20?$b=8:$b=4;
                            $pdf->MultiCell(23,$b,$data,'1','C');
                            $pdf->SetXY($x + 221, $y);
                            $data = $row['short_gre_rcv_percent'];
                            strlen($data)<20?$b=8:$b=4;
                            $pdf->MultiCell(18,$b,$data,'1','C');
                            $pdf->SetXY($x + 239, $y); 
                            $data = $row['short_pre_proc_qty'];
                            strlen($data)<20?$b=8:$b=4;
                            $pdf->MultiCell(23,$b,$data,'1','C');
                            $pdf->SetXY($x + 262, $y);
                            $data = $row['short_pre_proc_percent'];
                            strlen($data)<20?$b=8:$b=4;
                            $pdf->MultiCell(18,$b,$data,'1','C');  

                            if($row['short_excess_qty']!= '') 
                                {
                                    $process_loss_gain+=$row['short_excess_qty'];
                                }
                    
                                $Total_pp_quantity = $row['pp_quantity'];
                                $Total_greige_quantity = $row['process_qty'];
                         
                        }

    }
  }


  /*********************************Create Bleaching (Process No- 3) Table**********************************/

  $greige_period = "select ptftri.pp_number, ptftri.process_id, date_format(min(ptftri.partial_test_for_test_result_creation_date), '%d-%b-%Y') start_date,
  date_format(max(ptftri.partial_test_for_test_result_creation_date), '%d-%b-%Y') end_date
  from partial_test_for_test_result_info  ptftri
  where  ptftri.process_id = 'proc_3' and ptftri.pp_number = '$pp_number'  
    ";

$result_for_greige= mysqli_query($con,$greige_period) or die(mysqli_error($con));
while($row = mysqli_fetch_array($result_for_greige))  
{  
    if($row['end_date']!= '') 
    {
        $process_completion_date = $row['end_date'];
    }

    if($row_for_select_process["process_id"] == "proc_3")
    {
        $Serial+=1;

        $sql_for_bleaching = "select pp.pp_number, pp.version_name as version_number, pp.color, pp.style_name, pp.gw, pp.fw, pp.pp_quantity, result.after_trolley_or_batcher_qty, result.date, 
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
        ptftri.pp_number = aptv.pp_number and ptftri.version_id = aptv.version_id and ptftri.style=aptv.style_name  and ptftri.process_name=aptv.process_name and ptftri.process_id = 'proc_3'
         and ptftri.pp_number = '$pp_number')result 
        
        on pp.pp_number = result.pp_number and pp.version_id = result.version_id  order by result.date, pp.pp_number, pp.version_id, pp.color, pp.style_name, pp.gw, pp.fw";
         
        $result_for_bleaching= mysqli_query($con,$sql_for_bleaching) or die(mysqli_error($con));

        $row_number_for_bleaching = mysqli_num_rows($result_for_bleaching);

        $counter = $counter + ($row_number_for_bleaching*8) + 10 + 10; 

        if($counter>200)
            {
                $pdf->AddPage();
                $pdf->SetLeftMargin(8);
                $counter =30;
                $counter = $counter + ($row_number_for_bleaching*8) + 10 + 10; 

            } 

        $pdf->SetFont('Arial','B',14);
        $pdf->Ln(3);
        $pdf->Cell(280,7,$Serial.'.'.'  '.'Bleaching'.'   ('.$row["start_date"].' To '.$row["end_date"].')'.$pdf->SetFillColor(255,255,255),"0","1","L",true);
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
        $pdf->MultiCell(28,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
        $pdf->SetXY($x + 49, $y);
        $data = "Color";
        strlen($data)<15?$b=10:$b=5;
        $pdf->MultiCell(24,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
        $pdf->SetXY($x + 73, $y);
        $data = "Style";
        strlen($data)<15?$b=10:$b=5;
        $pdf->MultiCell(24,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
        $pdf->SetXY($x + 97, $y);
        $data = "Greige Width (inch)";
        strlen($data)<10?$b=10:$b=5;
        $pdf->MultiCell(21,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
        $pdf->SetXY($x + 118, $y);
        $data = "Finish Width (inch)";
        strlen($data)<10?$b=10:$b=5;
        $pdf->MultiCell(21,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
        $pdf->SetXY($x + 139, $y);
        $data = "Before Trolley No.";
        strlen($data)<10?$b=10:$b=5;
        $pdf->MultiCell(20,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
        $pdf->SetXY($x + 159, $y);
        $data = "B. Process Qty (mtr.)";
        strlen($data)<15?$b=10:$b=5;
        $pdf->MultiCell(20,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
        $pdf->SetXY($x + 179, $y);
        $data = "After Trolley No.";
        strlen($data)<10?$b=10:$b=5;
        $pdf->MultiCell(20,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
        $pdf->SetXY($x + 199, $y);
        $data = "Process Qty (mtr.)";
        strlen($data)<10?$b=10:$b=5;
        $pdf->MultiCell(20,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
        $pdf->SetXY($x + 219, $y);
        $data = "(+/-) From Prev. Process";
        strlen($data)<10?$b=10:$b=5;
        $pdf->MultiCell(41,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
        $pdf->SetXY($x + 219, $y+5);
        $data = "Qty (mtr.)";
        // strlen($data)<15?$b=10:$b=5;
        $pdf->MultiCell(23,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
        $pdf->SetXY($x + 242, $y+5);
        $data = "%";
        // strlen($data)<15?$b=10:$b=5;
        $pdf->MultiCell(18,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
        $pdf->SetXY($x + 260, $y);
        $data = "Process / Reprocess";
        strlen($data)<10?$b=10:$b=5;
        $pdf->MultiCell(20,$b,"$data".$pdf->SetFillColor(220,220,220),'1','C',TRUE);
        // $pdf->SetXY($x + 194, $y);

        $pdf->Cell(200,0,$pdf->SetFillColor(255,255,255),'1','1','c',true);

        $pdf->SetFont('Arial','',9);


                                        while($row = mysqli_fetch_array($result_for_bleaching))  
                                        {
                                            $x = $pdf->GetX();
                                            $y = $pdf->GetY();
                                            $data = $row['date'];
                                            strlen($data)<20?$b=8:$b=4;
                                            $pdf->MultiCell(21,$b,$data,'1','C');
                                            $pdf->SetXY($x + 21, $y);
                                            $data = $row['version_number'];
                                            strlen($data)<20?$b=8:$b=4;
                                            $pdf->MultiCell(28,$b,$data,'1','C');
                                            $pdf->SetXY($x + 49, $y);
                                            $data = $row['color'];
                                            strlen($data)<20?$b=8:$b=4;
                                            $pdf->MultiCell(24,$b,$data,'1','C');
                                            $pdf->SetXY($x + 73, $y);
                                            $data = $row['style_name'];
                                            strlen($data)<10?$b=8:$b=4;
                                            $pdf->MultiCell(24,$b,$data,'1','C');
                                            $pdf->SetXY($x + 97, $y);
                                            $data = $row['gw'];
                                            strlen($data)<20?$b=8:$b=4;
                                            $pdf->MultiCell(21,$b,$data,'1','C');
                                            $pdf->SetXY($x + 118, $y);
                                            $data = $row['fw'];
                                            strlen($data)<20?$b=8:$b=4;
                                            $pdf->MultiCell(21,$b,$data,'1','C');
                                            $pdf->SetXY($x + 139, $y);
                                            $data = $row['before_trolley_number_or_batcher_number'];
                                            strlen($data)<20?$b=8:$b=4;
                                            $pdf->MultiCell(20,$b,$data,'1','C');
                                            $pdf->SetXY($x + 159, $y);
                                            $data = $row['before_trolley_or_batcher_qty'];
                                            strlen($data)<20?$b=8:$b=4;
                                            $pdf->MultiCell(20,$b,$data,'1','C');
                                            $pdf->SetXY($x + 179, $y);
                                            $data = $row['after_trolley_number_or_batcher_number'];
                                            strlen($data)<20?$b=8:$b=4;
                                            $pdf->MultiCell(20,$b,$data,'1','C');
                                            $pdf->SetXY($x + 199, $y);
                                            $data = $row['after_trolley_or_batcher_qty'];
                                            strlen($data)<20?$b=8:$b=4;
                                            $pdf->MultiCell(20,$b,$data,'1','C');
                                            $pdf->SetXY($x + 219, $y);
                                            $data = $row['short_proc'];
                                            strlen($data)<20?$b=8:$b=4;
                                            $pdf->MultiCell(23,$b,$data,'1','C');
                                            $pdf->SetXY($x + 242, $y);
                                            $data = $row['short_percent'];
                                            strlen($data)<20?$b=8:$b=4;
                                            $pdf->MultiCell(18,$b,$data,'1','C');
                                            $pdf->SetXY($x + 260, $y);
                                            $data = $row['process_or_reprocess'];
                                            strlen($data)<20?$b=8:$b=4;
                                            $pdf->SetFont('Arial','',7);
                                                          $pdf->MultiCell(20,$b,$data,'1','C'); 
                                                          $pdf->SetFont('Arial','',9); 
                                        }



                                // Width summary for Bleaching	

                                $sql_for_bleaching_width = "select pp.pp_number, pp.gw, pp.fw, pp.pp_quantity, result.process_qty, result.before_process_qty, result.gray_process_qty,
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
                            and ptftri.process_id = 'proc_3' and ptftri.pp_number = '$pp_number'
                                group by ptftri.pp_number, pwvci.finish_width_in_inch, pwvci.greige_width_in_inch,ptftri.version_id )P
                            where  1=1
                            and ptftri_1.process_id = p.process_id
                            and ptftri_1.pp_number = p.pp_number
                            and ptftri_1.version_id = p.version_id
                            and ptftri_1.partial_test_for_test_result_creation_date = p.max_date
                            group by process_id,pp_number, fw,  gw)result 
                            on pp.pp_number = result.pp_number and pp.fw = result.fw and pp.gw = result.gw 
                            order by pp.pp_number, pp.gw, pp.fw";
                    
                                
                                $result_for_bleaching_width= mysqli_query($con,$sql_for_bleaching_width) or die(mysqli_error($con));

                                $row_number_for_bleaching_width = mysqli_num_rows($result_for_bleaching_width);

                                $counter = $counter + ($row_number_for_bleaching_width*8) + 10 + 10; 
                  
                                  if($counter>200)
                                      {
                                          $pdf->AddPage();
                                          $pdf->SetLeftMargin(8);
                                          $counter =30;
                                          $counter = $counter + ($row_number_for_bleaching_width*8) + 10 + 10; 
                                      } 

                                $pdf->SetFont('Arial','B',11);
                                $pdf->Ln(3);
                                $pdf->Cell(280,7,"Width Summary".$pdf->SetFillColor(220,220,220),"1","1","C",true);
                                $pdf->SetFont('Arial','B',9);

                                $x = $pdf->GetX();
                                $y = $pdf->GetY();
                                $data = "Greige Width (inch)";
                                strlen($data)<15?$b=10:$b=5;
                                $pdf->MultiCell(30,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 30, $y);
                                $data = "Finish Width (inch)";
                                strlen($data)<15?$b=10:$b=5;
                                $pdf->MultiCell(30,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 60, $y);
                                $data = "PP Quantity. (mtr.)";
                                strlen($data)<25?$b=10:$b=5;
                                $pdf->MultiCell(32,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 92, $y);
                                $data = "Before Process Quantity (mtr.)";
                                strlen($data)<25?$b=10:$b=5;
                                $pdf->MultiCell(33,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 125, $y);
                                $data = "Process Quantity. (mtr.)";
                                strlen($data)<15?$b=10:$b=5;
                                $pdf->MultiCell(32,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 157, $y);
                                $data = "(+/-) From PP";
                                // strlen($data)<15?$b=10:$b=5;
                                $pdf->MultiCell(41,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 157, $y+5);
                                $data = "Qty (mtr.)";
                                // strlen($data)<15?$b=10:$b=5;
                                $pdf->MultiCell(23,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 180, $y+5);
                                $data = "%";
                                // strlen($data)<15?$b=10:$b=5;
                                $pdf->MultiCell(18,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 198, $y);
                                $data = "(+/-) From Greige";
                                // strlen($data)<15?$b=10:$b=5;
                                $pdf->MultiCell(41,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 198, $y+5);
                                $data = "Qty (mtr.)";
                                // strlen($data)<15?$b=10:$b=5;
                                $pdf->MultiCell(23,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 221, $y+5);
                                $data = "%";
                                // strlen($data)<15?$b=10:$b=5;
                                $pdf->MultiCell(18,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 239, $y);
                                $data = "(+/-) From Prev. Process";
                                // strlen($data)<15?$b=10:$b=5;
                                $pdf->MultiCell(41,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 239, $y+5);
                                $data = "Qty (mtr.)";
                                // strlen($data)<15?$b=10:$b=5;
                                $pdf->MultiCell(23,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 262, $y+5);
                                $data = "%";
                                // strlen($data)<15?$b=10:$b=5;
                                $pdf->MultiCell(18,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 280, $y);
                                
                                // $pdf->Cell(0,0,$pdf->SetFillColor(255,255,255),'1','1','C',true);
                                $pdf->SetFont('Arial','',9);       
                                 $pdf->Ln(10);
                               
                                
                            while($row = mysqli_fetch_array($result_for_bleaching_width))  
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
                                $pdf->MultiCell(32,$b,$data,'1','C');
                                $pdf->SetXY($x + 92, $y);
                                $data = $row['before_process_qty'];
                                strlen($data)<20?$b=8:$b=4;
                                $pdf->MultiCell(33,$b,$data,'1','C');
                                $pdf->SetXY($x + 125, $y);
                                $data = $row['process_qty'];
                                strlen($data)<20?$b=8:$b=4;
                                $pdf->MultiCell(32,$b,$data,'1','C');
                                $pdf->SetXY($x + 157, $y);
                                $data = $row['short_pp_qty'];
                                strlen($data)<15?$b=8:$b=4;
                                $pdf->MultiCell(23,$b,$data,'1','C');
                                $pdf->SetXY($x + 180, $y);
                                $data = $row['short_pp_percent'];
                                strlen($data)<15?$b=8:$b=4;
                                $pdf->MultiCell(18,$b,$data,'1','C');
                                $pdf->SetXY($x + 198, $y);
                                $data = $row['short_gre_rcv_qty'];
                                strlen($data)<15?$b=8:$b=4;
                                $pdf->MultiCell(23,$b,$data,'1','C');
                                $pdf->SetXY($x + 221, $y);
                                $data = $row['short_gre_rcv_percent'];
                                strlen($data)<15?$b=8:$b=4;
                                $pdf->MultiCell(18,$b,$data,'1','C');
                                $pdf->SetXY($x + 239, $y);
                                $data = $row['short_pre_proc_qty'];
                                strlen($data)<15?$b=8:$b=4;
                                $pdf->MultiCell(23,$b,$data,'1','C');
                                $pdf->SetXY($x + 262, $y);
                                $data = $row['short_pre_proc_percent'];
                                strlen($data)<15?$b=8:$b=4;
                                $pdf->MultiCell(18,$b,$data,'1','C');
                                // $pdf->SetXY($x + 200, $y);

                            }
                                // Version summary for Bleaching

                                 $sql_for_bleaching_version = "select pp.pp_number, pp.version_name version_number, pp.style_name, pp.color, pp.gw, pp.fw, pp.pp_quantity, result.process_qty, result.before_process_qty, result.gray_process_qty, 
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
                                 and ptftri.process_id = 'proc_3' and ptftri.pp_number = '$pp_number'
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

                                  $result_for_bleaching_version= mysqli_query($con,$sql_for_bleaching_version) or die(mysqli_error($con));

                                  $row_number_for_bleaching_version = mysqli_num_rows($result_for_bleaching_version);

                                  $counter = $counter + ($row_number_for_bleaching_version*8) + 10 + 10 + 8; 
                  
                                  if($counter>200)
                                      {
                                          $pdf->AddPage();
                                          $pdf->SetLeftMargin(8);
                                          $counter =30;
                                          $counter = $counter + ($row_number_for_bleaching_version*8) + 10 + 10 + 8; 

                                      } 

                                  $pdf->SetFont('Arial','B',11);
                                  $pdf->Ln(3);
                                  $pdf->Cell(280,7,"Version Summary".$pdf->SetFillColor(220,220,220),"1","1","C",true);
                                  $pdf->SetFont('Arial','B',9);

                                $x = $pdf->GetX();
                                $y = $pdf->GetY();
                                $data = "Version";
                                strlen($data)<15?$b=10:$b=5;
                                $pdf->MultiCell(28,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 28, $y);
                                $data = "Color";
                                strlen($data)<15?$b=10:$b=5;
                                $pdf->MultiCell(24,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 52, $y);
                                $data = "Style";
                                strlen($data)<15?$b=10:$b=5;
                                $pdf->MultiCell(24,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 76, $y);
                                $data = "PP Quantity (mtr.)";
                                strlen($data)<15?$b=10:$b=5;
                                $pdf->MultiCell(27,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 103, $y);
                                $data = "Before process Qty (mtr.)";
                                strlen($data)<20?$b=10:$b=5;
                                $pdf->MultiCell(27,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 130, $y);
                                $data = "Process Quantity (mtr.)";
                                strlen($data)<20?$b=10:$b=5;
                                $pdf->MultiCell(27,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 157, $y);
                                $data = "(+/-) From PP";
                                // strlen($data)<15?$b=10:$b=5;
                                $pdf->MultiCell(41,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 157, $y+5);
                                $data = "Qty (mtr.)";
                                // strlen($data)<15?$b=10:$b=5;
                                $pdf->MultiCell(23,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 180, $y+5);
                                $data = "%";
                                // strlen($data)<15?$b=10:$b=5;
                                $pdf->MultiCell(18,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 198, $y);
                                $data = "(+/-) From Greige";
                                // strlen($data)<15?$b=10:$b=5;
                                $pdf->MultiCell(41,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 198, $y+5);
                                $data = "Qty (mtr.)";
                                // strlen($data)<15?$b=10:$b=5;
                                $pdf->MultiCell(23,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 221, $y+5);
                                $data = "%";
                                // strlen($data)<15?$b=10:$b=5;
                                $pdf->MultiCell(18,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 239, $y);
                                $data = "(+/-) From Prev. Process";
                                // strlen($data)<15?$b=10:$b=5;
                                $pdf->MultiCell(41,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 239, $y+5);
                                $data = "Qty (mtr.)";
                                // strlen($data)<15?$b=10:$b=5;
                                $pdf->MultiCell(23,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 262, $y+5);
                                $data = "%";
                                // strlen($data)<15?$b=10:$b=5;
                                $pdf->MultiCell(18,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 280, $y);
                                
                                // $pdf->Cell(0,0,$pdf->SetFillColor(255,255,255),'1','1','C',true);
                                $pdf->SetFont('Arial','',9);       
                                 $pdf->Ln(10);
    
                          while($row = mysqli_fetch_array($result_for_bleaching_version))  
                          {  
                              $x = $pdf->GetX();
                              $y = $pdf->GetY();
                              $data = $row['version_number'];
                              strlen($data)<20?$b=8:$b=4;
                              $pdf->MultiCell(28,$b,$data,'1','C');
                              $pdf->SetXY($x + 28, $y);
                              $data = $row['color'];
                              strlen($data)<20?$b=8:$b=4;
                              $pdf->MultiCell(24,$b,$data,'1','C');
                              $pdf->SetXY($x + 52, $y);
                              $data = $row['style_name'];
                              strlen($data)<10?$b=8:$b=4;
                              $pdf->MultiCell(24,$b,$data,'1','C');
                              $pdf->SetXY($x + 76, $y);
                              $data = $row['pp_quantity'];
                              strlen($data)<20?$b=8:$b=4;
                              $pdf->MultiCell(27,$b,$data,'1','C');
                              $pdf->SetXY($x + 103, $y);
                              $data = $row['before_process_qty'];
                              strlen($data)<20?$b=8:$b=4;
                              $pdf->MultiCell(27,$b,$data,'1','C');
                              $pdf->SetXY($x + 130, $y);
                              $data = $row['process_qty'];
                              strlen($data)<20?$b=8:$b=4;
                              $pdf->MultiCell(27,$b,$data,'1','C');
                              $pdf->SetXY($x + 157, $y);
                              $data = $row['short_pp'];
                              strlen($data)<15?$b=8:$b=4;
                              $pdf->MultiCell(23,$b,$data,'1','C');
                              $pdf->SetXY($x + 180, $y);
                              $data = $row['short_pp_percent'];
                              strlen($data)<15?$b=8:$b=4;
                              $pdf->MultiCell(18,$b,$data,'1','C');
                              $pdf->SetXY($x + 198, $y);
                              $data = $row['short_gre_rcv_qty'];
                              strlen($data)<15?$b=8:$b=4;
                              $pdf->MultiCell(23,$b,$data,'1','C');
                              $pdf->SetXY($x + 221, $y);
                              $data = $row['short_gre_rcv_percent'];
                              strlen($data)<15?$b=8:$b=4;
                              $pdf->MultiCell(18,$b,$data,'1','C');
                              $pdf->SetXY($x + 239, $y);
                              $data = $row['short_pre_proc_qty'];
                              strlen($data)<15?$b=8:$b=4;
                              $pdf->MultiCell(23,$b,$data,'1','C');
                              $pdf->SetXY($x + 262, $y);
                              $data = $row['short_pre_proc_percent'];
                              strlen($data)<15?$b=8:$b=4;
                              $pdf->MultiCell(18,$b,$data,'1','C');
                              // $pdf->SetXY($x + 280, $y);

                          }

                          $sql_for_bleaching_total = "select total.pp_number, sum(total.pp_quantity) pp_quantity, sum(total.process_qty) process_qty, 
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
                          and ptftri.process_id = 'proc_3' and ptftri.pp_number = '$pp_number'
                          group by ptftri.pp_number, ptftri.version_number, ptftri.finish_width_in_inch )P
                          where  1=1
                          and ptftri_1.process_id = p.process_id
                          and ptftri_1.pp_number = p.pp_number
                          and ptftri_1.version_number = p.version_name
                          and ptftri_1.partial_test_for_test_result_creation_date = p.max_date
                          and ptftri_1.finish_width_in_inch = p.finish_width_in_inch
                          group by process_id,pp_number, version_name)result where pp.pp_number = result.pp_number and pp.version_name = result.version_name ) total
                          ";
               
                        $result_for_bleaching_total= mysqli_query($con,$sql_for_bleaching_total) or die(mysqli_error($con));
                        while($row = mysqli_fetch_array($result_for_bleaching_total))  
                        {
                            $pdf->SetFont('Arial','B',9); 
                            $x = $pdf->GetX();
                            $y = $pdf->GetY();
                            $data = "Bleaching Total Qty. (mtr.)";
                            strlen($data)<70?$b=8:$b=4;
                            $pdf->MultiCell(76,$b,$data,'1','C');
                            $pdf->SetXY($x + 76, $y);
                            $data = $row['pp_quantity'];
                            strlen($data)<20?$b=8:$b=4;
                            $pdf->MultiCell(27,$b,$data,'1','C');
                            $pdf->SetXY($x + 103, $y);
                            $data = $row['before_process_qty'];
                            strlen($data)<20?$b=8:$b=4;
                            $pdf->MultiCell(27,$b,$data,'1','C');
                            $pdf->SetXY($x + 130, $y);
                            $data = $row['process_qty'];
                            strlen($data)<20?$b=8:$b=4;
                            $pdf->MultiCell(27,$b,$data,'1','C');
                            $pdf->SetXY($x + 157, $y);
                            $data = $row['short_pp_qty'];
                            strlen($data)<20?$b=8:$b=4;
                            $pdf->MultiCell(23,$b,$data,'1','C');
                            $pdf->SetXY($x + 180, $y);
                            $data = $row['short_pp_percent'];
                            strlen($data)<20?$b=8:$b=4;
                            $pdf->MultiCell(18,$b,$data,'1','C'); 
                            $pdf->SetXY($x + 198, $y); 
                            $data = $row['short_gre_rcv_qty'];
                            strlen($data)<20?$b=8:$b=4;
                            $pdf->MultiCell(23,$b,$data,'1','C');
                            $pdf->SetXY($x + 221, $y);
                            $data = $row['short_gre_rcv_percent'];
                            strlen($data)<20?$b=8:$b=4;
                            $pdf->MultiCell(18,$b,$data,'1','C');
                            $pdf->SetXY($x + 239, $y); 
                            $data = $row['short_pre_proc_qty'];
                            strlen($data)<20?$b=8:$b=4;
                            $pdf->MultiCell(23,$b,$data,'1','C');
                            $pdf->SetXY($x + 262, $y);
                            $data = $row['short_pre_proc_percent'];
                            strlen($data)<20?$b=8:$b=4;
                            $pdf->MultiCell(18,$b,$data,'1','C');  

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

                  $sql_for_scouring_bleaching = "select pp.pp_number, pp.version_name as version_number, pp.color, pp.style_name, pp.gw, pp.fw, pp.pp_quantity, result.after_trolley_or_batcher_qty, result.date, 
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
                  ptftri.pp_number = aptv.pp_number and ptftri.version_id = aptv.version_id and ptftri.style=aptv.style_name  and ptftri.process_name=aptv.process_name and ptftri.process_id = 'proc_4'
                   and ptftri.pp_number = '$pp_number')result 
                  
                  on pp.pp_number = result.pp_number and pp.version_id = result.version_id  order by result.date, pp.pp_number, pp.version_id, pp.color, pp.style_name, pp.gw, pp.fw;";
                   
                  $result_for_scouring_bleaching= mysqli_query($con,$sql_for_scouring_bleaching) or die(mysqli_error($con));

                  $row_number_for_scouring_bleaching = mysqli_num_rows($result_for_scouring_bleaching);

                  $counter = $counter + ($row_number_for_scouring_bleaching*8) + 10 + 10; 
  
                  if($counter>200)
                      {
                          $pdf->AddPage();
                          $pdf->SetLeftMargin(8);
                          $counter =30;
                          $counter = $counter + ($row_number_for_scouring_bleaching*8) + 10 + 10; 

                      } 

                  $pdf->SetFont('Arial','B',14);
                  $pdf->Ln(3);
                  $pdf->Cell(280,7,$Serial.'.'.'  '.'Scouring & Bleaching'.'   ('.$row["start_date"].' To '.$row["end_date"].')'.$pdf->SetFillColor(255,255,255),"0","1","L",true);
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
                  $pdf->MultiCell(28,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                  $pdf->SetXY($x + 49, $y);
                  $data = "Color";
                  strlen($data)<15?$b=10:$b=5;
                  $pdf->MultiCell(24,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                  $pdf->SetXY($x + 73, $y);
                  $data = "Style";
                  strlen($data)<15?$b=10:$b=5;
                  $pdf->MultiCell(24,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                  $pdf->SetXY($x + 97, $y);
                  $data = "Greige Width (inch)";
                  strlen($data)<10?$b=10:$b=5;
                  $pdf->MultiCell(21,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                  $pdf->SetXY($x + 118, $y);
                  $data = "Finish Width (inch)";
                  strlen($data)<10?$b=10:$b=5;
                  $pdf->MultiCell(21,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                  $pdf->SetXY($x + 139, $y);
                  $data = "Before Trolley No.";
                  strlen($data)<10?$b=10:$b=5;
                  $pdf->MultiCell(20,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                  $pdf->SetXY($x + 159, $y);
                  $data = "B. Process Qty (mtr.)";
                  strlen($data)<15?$b=10:$b=5;
                  $pdf->MultiCell(20,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                  $pdf->SetXY($x + 179, $y);
                  $data = "After Trolley No.";
                  strlen($data)<10?$b=10:$b=5;
                  $pdf->MultiCell(20,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                  $pdf->SetXY($x + 199, $y);
                  $data = "Process Qty (mtr.)";
                  strlen($data)<10?$b=10:$b=5;
                  $pdf->MultiCell(20,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                  $pdf->SetXY($x + 219, $y);
                  $data = "(+/-) From Prev. Process";
                  strlen($data)<10?$b=10:$b=5;
                  $pdf->MultiCell(41,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                  $pdf->SetXY($x + 219, $y+5);
                  $data = "Qty (mtr.)";
                  // strlen($data)<15?$b=10:$b=5;
                  $pdf->MultiCell(23,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                  $pdf->SetXY($x + 242, $y+5);
                  $data = "%";
                  // strlen($data)<15?$b=10:$b=5;
                  $pdf->MultiCell(18,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                  $pdf->SetXY($x + 260, $y);
                  $data = "Process / Reprocess";
                  strlen($data)<10?$b=10:$b=5;
                  $pdf->MultiCell(20,$b,"$data".$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                  // $pdf->SetXY($x + 194, $y);
  
                  $pdf->Cell(200,0,$pdf->SetFillColor(255,255,255),'1','1','c',true);
      
                  $pdf->SetFont('Arial','',9);
  

                                                  while($row = mysqli_fetch_array($result_for_scouring_bleaching))  
                                                  {
                                                      $x = $pdf->GetX();
                                                      $y = $pdf->GetY();
                                                      $data = $row['date'];
                                                      strlen($data)<20?$b=8:$b=4;
                                                      $pdf->MultiCell(21,$b,$data,'1','C');
                                                      $pdf->SetXY($x + 21, $y);
                                                      $data = $row['version_number'];
                                                      strlen($data)<17?$b=8:$b=4;
                                                      $pdf->MultiCell(28,$b,$data,'1','C');
                                                      $pdf->SetXY($x + 49, $y);
                                                      $data = $row['color'];
                                                      strlen($data)<20?$b=8:$b=4;
                                                      $pdf->MultiCell(24,$b,$data,'1','C');
                                                      $pdf->SetXY($x + 73, $y);
                                                      $data = $row['style_name'];
                                                      strlen($data)<10?$b=8:$b=4;
                                                      $pdf->MultiCell(24,$b,$data,'1','C');
                                                      $pdf->SetXY($x + 97, $y);
                                                      $data = $row['gw'];
                                                      strlen($data)<20?$b=8:$b=4;
                                                      $pdf->MultiCell(21,$b,$data,'1','C');
                                                      $pdf->SetXY($x + 118, $y);
                                                      $data = $row['fw'];
                                                      strlen($data)<20?$b=8:$b=4;
                                                      $pdf->MultiCell(21,$b,$data,'1','C');
                                                      $pdf->SetXY($x + 139, $y);
                                                      $data = $row['before_trolley_number_or_batcher_number'];
                                                      strlen($data)<20?$b=8:$b=4;
                                                      $pdf->MultiCell(20,$b,$data,'1','C');
                                                      $pdf->SetXY($x + 159, $y);
                                                      $data = $row['before_trolley_or_batcher_qty'];
                                                      strlen($data)<20?$b=8:$b=4;
                                                      $pdf->MultiCell(20,$b,$data,'1','C');
                                                      $pdf->SetXY($x + 179, $y);
                                                      $data = $row['after_trolley_number_or_batcher_number'];
                                                      strlen($data)<20?$b=8:$b=4;
                                                      $pdf->MultiCell(20,$b,$data,'1','C');
                                                      $pdf->SetXY($x + 199, $y);
                                                      $data = $row['after_trolley_or_batcher_qty'];
                                                      strlen($data)<20?$b=8:$b=4;
                                                      $pdf->MultiCell(20,$b,$data,'1','C');
                                                      $pdf->SetXY($x + 219, $y);
                                                      $data = $row['short_proc'];
                                                      strlen($data)<20?$b=8:$b=4;
                                                      $pdf->MultiCell(23,$b,$data,'1','C');
                                                      $pdf->SetXY($x + 242, $y);
                                                      $data = $row['short_percent'];
                                                      strlen($data)<20?$b=8:$b=4;
                                                      $pdf->MultiCell(18,$b,$data,'1','C');
                                                      $pdf->SetXY($x + 260, $y);
                                                      $data = $row['process_or_reprocess'];
                                                      strlen($data)<20?$b=8:$b=4;
                                                      $pdf->SetFont('Arial','',7);
                                                          $pdf->MultiCell(20,$b,$data,'1','C'); 
                                                          $pdf->SetFont('Arial','',9);
                                                  }



                                          // Width summary for Scouring and Bleaching	

                                          $sql_for_scouring_bleaching_width = "select pp.pp_number, pp.gw, pp.fw, pp.pp_quantity, result.process_qty, result.before_process_qty, result.gray_process_qty,
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
                                         and ptftri.process_id = 'proc_4' and ptftri.pp_number = '$pp_number'
                                          group by ptftri.pp_number, pwvci.finish_width_in_inch, pwvci.greige_width_in_inch,ptftri.version_id )P
                                         where  1=1
                                         and ptftri_1.process_id = p.process_id
                                         and ptftri_1.pp_number = p.pp_number
                                         and ptftri_1.version_id = p.version_id
                                         and ptftri_1.partial_test_for_test_result_creation_date = p.max_date
                                         group by process_id,pp_number, fw,  gw)result 
                                         on pp.pp_number = result.pp_number and pp.fw = result.fw and pp.gw = result.gw 
                                         order by pp.pp_number, pp.gw, pp.fw";
                                          
                                          $result_for_scouring_bleaching_width= mysqli_query($con,$sql_for_scouring_bleaching_width) or die(mysqli_error($con));

                                          $row_number_for_scouring_bleaching_width = mysqli_num_rows($result_for_scouring_bleaching_width);

                                          $counter = $counter + ($row_number_for_scouring_bleaching_width*8) + 10 + 10; 
                            
                                            if($counter>200)
                                                {
                                                    $pdf->AddPage();
                                                    $pdf->SetLeftMargin(8);
                                                    $counter =30;
                                                    $counter = $counter + ($row_number_for_scouring_bleaching_width*8) + 10 + 10; 
                                                } 

                                          $pdf->SetFont('Arial','B',11);
                                          $pdf->Ln(3);
                                          $pdf->Cell(280,7,"Width Summary".$pdf->SetFillColor(220,220,220),"1","1","C",true);
                                          $pdf->SetFont('Arial','B',9);

                                          $x = $pdf->GetX();
                                          $y = $pdf->GetY();
                                          $data = "Greige Width (inch)";
                                          strlen($data)<15?$b=10:$b=5;
                                          $pdf->MultiCell(30,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                          $pdf->SetXY($x + 30, $y);
                                          $data = "Finish Width (inch)";
                                          strlen($data)<15?$b=10:$b=5;
                                          $pdf->MultiCell(30,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                          $pdf->SetXY($x + 60, $y);
                                          $data = "PP Quantity. (mtr.)";
                                          strlen($data)<25?$b=10:$b=5;
                                          $pdf->MultiCell(32,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                          $pdf->SetXY($x + 92, $y);
                                          $data = "Before Process Quantity (mtr.)";
                                          strlen($data)<25?$b=10:$b=5;
                                          $pdf->MultiCell(33,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                          $pdf->SetXY($x + 125, $y);
                                          $data = "Process Quantity. (mtr.)";
                                          strlen($data)<15?$b=10:$b=5;
                                          $pdf->MultiCell(32,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                          $pdf->SetXY($x + 157, $y);
                                          $data = "(+/-) From PP";
                                          // strlen($data)<15?$b=10:$b=5;
                                          $pdf->MultiCell(41,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                          $pdf->SetXY($x + 157, $y+5);
                                          $data = "Qty (mtr.)";
                                          // strlen($data)<15?$b=10:$b=5;
                                          $pdf->MultiCell(23,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                          $pdf->SetXY($x + 180, $y+5);
                                          $data = "%";
                                          // strlen($data)<15?$b=10:$b=5;
                                          $pdf->MultiCell(18,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                          $pdf->SetXY($x + 198, $y);
                                          $data = "(+/-) From Greige";
                                          // strlen($data)<15?$b=10:$b=5;
                                          $pdf->MultiCell(41,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                          $pdf->SetXY($x + 198, $y+5);
                                          $data = "Qty (mtr.)";
                                          // strlen($data)<15?$b=10:$b=5;
                                          $pdf->MultiCell(23,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                          $pdf->SetXY($x + 221, $y+5);
                                          $data = "%";
                                          // strlen($data)<15?$b=10:$b=5;
                                          $pdf->MultiCell(18,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                          $pdf->SetXY($x + 239, $y);
                                          $data = "(+/-) From Prev. Process";
                                          // strlen($data)<15?$b=10:$b=5;
                                          $pdf->MultiCell(41,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                          $pdf->SetXY($x + 239, $y+5);
                                          $data = "Qty (mtr.)";
                                          // strlen($data)<15?$b=10:$b=5;
                                          $pdf->MultiCell(23,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                          $pdf->SetXY($x + 262, $y+5);
                                          $data = "%";
                                          // strlen($data)<15?$b=10:$b=5;
                                          $pdf->MultiCell(18,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                          $pdf->SetXY($x + 280, $y);
                                          
                                          // $pdf->Cell(0,0,$pdf->SetFillColor(255,255,255),'1','1','C',true);
                                          $pdf->SetFont('Arial','',9);       
                                           $pdf->Ln(10);
                                         
                                          
                                      while($row = mysqli_fetch_array($result_for_scouring_bleaching_width))  
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
                                          $pdf->MultiCell(32,$b,$data,'1','C');
                                          $pdf->SetXY($x + 92, $y);
                                          $data = $row['before_process_qty'];
                                          strlen($data)<20?$b=8:$b=4;
                                          $pdf->MultiCell(33,$b,$data,'1','C');
                                          $pdf->SetXY($x + 125, $y);
                                          $data = $row['process_qty'];
                                          strlen($data)<20?$b=8:$b=4;
                                          $pdf->MultiCell(32,$b,$data,'1','C');
                                          $pdf->SetXY($x + 157, $y);
                                          $data = $row['short_pp_qty'];
                                          strlen($data)<15?$b=8:$b=4;
                                          $pdf->MultiCell(23,$b,$data,'1','C');
                                          $pdf->SetXY($x + 180, $y);
                                          $data = $row['short_pp_percent'];
                                          strlen($data)<15?$b=8:$b=4;
                                          $pdf->MultiCell(18,$b,$data,'1','C');
                                          $pdf->SetXY($x + 198, $y);
                                          $data = $row['short_gre_rcv_qty'];
                                          strlen($data)<15?$b=8:$b=4;
                                          $pdf->MultiCell(23,$b,$data,'1','C');
                                          $pdf->SetXY($x + 221, $y);
                                          $data = $row['short_gre_rcv_percent'];
                                          strlen($data)<15?$b=8:$b=4;
                                          $pdf->MultiCell(18,$b,$data,'1','C');
                                          $pdf->SetXY($x + 239, $y);
                                          $data = $row['short_pre_proc_qty'];
                                          strlen($data)<15?$b=8:$b=4;
                                          $pdf->MultiCell(23,$b,$data,'1','C');
                                          $pdf->SetXY($x + 262, $y);
                                          $data = $row['short_pre_proc_percent'];
                                          strlen($data)<15?$b=8:$b=4;
                                          $pdf->MultiCell(18,$b,$data,'1','C');
                                          // $pdf->SetXY($x + 200, $y);

                                      }
                                          // Version summary for Scouring and Bleaching

                                           $sql_for_scouring_bleaching_version = "select pp.pp_number, pp.version_name version_number, pp.style_name, pp.color, pp.gw, pp.fw, pp.pp_quantity, result.process_qty, result.before_process_qty, result.gray_process_qty, 
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
                                           and ptftri.process_id = 'proc_4' and ptftri.pp_number = '$pp_number'
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
                                            $result_for_scouring_bleaching_version= mysqli_query($con,$sql_for_scouring_bleaching_version) or die(mysqli_error($con));

                                            $row_number_for_scouring_bleaching_version = mysqli_num_rows($result_for_scouring_bleaching_version);

                                            $counter = $counter + ($row_number_for_scouring_bleaching_version*8) + 10 + 10 + 8; 
                            
                                            if($counter>200)
                                                {
                                                    $pdf->AddPage();
                                                    $pdf->SetLeftMargin(8);
                                                    $counter =30;
                                                    $counter = $counter + ($row_number_for_scouring_bleaching_version*8) + 10 + 10 + 8; 

                                                } 

                                            $pdf->SetFont('Arial','B',11);
                                            $pdf->Ln(3);
                                            $pdf->Cell(280,7,"Version Summary".$pdf->SetFillColor(220,220,220),"1","1","C",true);
                                            $pdf->SetFont('Arial','B',9);

                                          $x = $pdf->GetX();
                                          $y = $pdf->GetY();
                                          $data = "Version";
                                          strlen($data)<15?$b=10:$b=5;
                                          $pdf->MultiCell(28,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                          $pdf->SetXY($x + 28, $y);
                                          $data = "Color";
                                          strlen($data)<15?$b=10:$b=5;
                                          $pdf->MultiCell(24,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                          $pdf->SetXY($x + 52, $y);
                                          $data = "Style";
                                          strlen($data)<15?$b=10:$b=5;
                                          $pdf->MultiCell(24,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                          $pdf->SetXY($x + 76, $y);
                                          $data = "PP Quantity (mtr.)";
                                          strlen($data)<15?$b=10:$b=5;
                                          $pdf->MultiCell(27,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                          $pdf->SetXY($x + 103, $y);
                                          $data = "Before process Qty (mtr.)";
                                          strlen($data)<20?$b=10:$b=5;
                                          $pdf->MultiCell(27,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                          $pdf->SetXY($x + 130, $y);
                                          $data = "Process Quantity (mtr.)";
                                          strlen($data)<20?$b=10:$b=5;
                                          $pdf->MultiCell(27,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                          $pdf->SetXY($x + 157, $y);
                                          $data = "(+/-) From PP";
                                          // strlen($data)<15?$b=10:$b=5;
                                          $pdf->MultiCell(41,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                          $pdf->SetXY($x + 157, $y+5);
                                          $data = "Qty (mtr.)";
                                          // strlen($data)<15?$b=10:$b=5;
                                          $pdf->MultiCell(23,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                          $pdf->SetXY($x + 180, $y+5);
                                          $data = "%";
                                          // strlen($data)<15?$b=10:$b=5;
                                          $pdf->MultiCell(18,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                          $pdf->SetXY($x + 198, $y);
                                          $data = "(+/-) From Greige";
                                          // strlen($data)<15?$b=10:$b=5;
                                          $pdf->MultiCell(41,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                          $pdf->SetXY($x + 198, $y+5);
                                          $data = "Qty (mtr.)";
                                          // strlen($data)<15?$b=10:$b=5;
                                          $pdf->MultiCell(23,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                          $pdf->SetXY($x + 221, $y+5);
                                          $data = "%";
                                          // strlen($data)<15?$b=10:$b=5;
                                          $pdf->MultiCell(18,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                          $pdf->SetXY($x + 239, $y);
                                          $data = "(+/-) From Prev. Process";
                                          // strlen($data)<15?$b=10:$b=5;
                                          $pdf->MultiCell(41,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                          $pdf->SetXY($x + 239, $y+5);
                                          $data = "Qty (mtr.)";
                                          // strlen($data)<15?$b=10:$b=5;
                                          $pdf->MultiCell(23,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                          $pdf->SetXY($x + 262, $y+5);
                                          $data = "%";
                                          // strlen($data)<15?$b=10:$b=5;
                                          $pdf->MultiCell(18,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                          $pdf->SetXY($x + 280, $y);
                                          
                                          // $pdf->Cell(0,0,$pdf->SetFillColor(255,255,255),'1','1','C',true);
                                          $pdf->SetFont('Arial','',9);       
                                           $pdf->Ln(10);
              
                                    while($row = mysqli_fetch_array($result_for_scouring_bleaching_version))  
                                    {  
                                        $x = $pdf->GetX();
                                        $y = $pdf->GetY();
                                        $data = $row['version_number'];
                                        strlen($data)<16?$b=8:$b=4;
                                        $pdf->MultiCell(28,$b,$data,'1','C');
                                        $pdf->SetXY($x + 28, $y);
                                        $data = $row['color'];
                                        strlen($data)<20?$b=8:$b=4;
                                        $pdf->MultiCell(24,$b,$data,'1','C');
                                        $pdf->SetXY($x + 52, $y);
                                        $data = $row['style_name'];
                                        strlen($data)<10?$b=8:$b=4;
                                        $pdf->MultiCell(24,$b,$data,'1','C');
                                        $pdf->SetXY($x + 76, $y);
                                        $data = $row['pp_quantity'];
                                        strlen($data)<20?$b=8:$b=4;
                                        $pdf->MultiCell(27,$b,$data,'1','C');
                                        $pdf->SetXY($x + 103, $y);
                                        $data = $row['before_process_qty'];
                                        strlen($data)<20?$b=8:$b=4;
                                        $pdf->MultiCell(27,$b,$data,'1','C');
                                        $pdf->SetXY($x + 130, $y);
                                        $data = $row['process_qty'];
                                        strlen($data)<20?$b=8:$b=4;
                                        $pdf->MultiCell(27,$b,$data,'1','C');
                                        $pdf->SetXY($x + 157, $y);
                                        $data = $row['short_pp'];
                                        strlen($data)<15?$b=8:$b=4;
                                        $pdf->MultiCell(23,$b,$data,'1','C');
                                        $pdf->SetXY($x + 180, $y);
                                        $data = $row['short_pp_percent'];
                                        strlen($data)<15?$b=8:$b=4;
                                        $pdf->MultiCell(18,$b,$data,'1','C');
                                        $pdf->SetXY($x + 198, $y);
                                        $data = $row['short_gre_rcv_qty'];
                                        strlen($data)<15?$b=8:$b=4;
                                        $pdf->MultiCell(23,$b,$data,'1','C');
                                        $pdf->SetXY($x + 221, $y);
                                        $data = $row['short_gre_rcv_percent'];
                                        strlen($data)<15?$b=8:$b=4;
                                        $pdf->MultiCell(18,$b,$data,'1','C');
                                        $pdf->SetXY($x + 239, $y);
                                        $data = $row['short_pre_proc_qty'];
                                        strlen($data)<15?$b=8:$b=4;
                                        $pdf->MultiCell(23,$b,$data,'1','C');
                                        $pdf->SetXY($x + 262, $y);
                                        $data = $row['short_pre_proc_percent'];
                                        strlen($data)<15?$b=8:$b=4;
                                        $pdf->MultiCell(18,$b,$data,'1','C');
                                        // $pdf->SetXY($x + 280, $y);

                                    }

                                    $sql_for_singe_total = "select total.pp_number, sum(total.pp_quantity) pp_quantity, sum(total.process_qty) process_qty, 
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
                                    and ptftri.process_id = 'proc_4' and ptftri.pp_number = '$pp_number'
                                    group by ptftri.pp_number, ptftri.version_number, ptftri.finish_width_in_inch )P
                                    where  1=1
                                    and ptftri_1.process_id = p.process_id
                                    and ptftri_1.pp_number = p.pp_number
                                    and ptftri_1.version_number = p.version_name
                                    and ptftri_1.partial_test_for_test_result_creation_date = p.max_date
                                    and ptftri_1.finish_width_in_inch = p.finish_width_in_inch
                                    group by process_id, pp_number, version_name)result where pp.pp_number = result.pp_number and pp.version_name = result.version_name ) total";

                                  $result_for_singe_total= mysqli_query($con,$sql_for_singe_total) or die(mysqli_error($con));
                                  while($row = mysqli_fetch_array($result_for_singe_total))  
                                  {
                                      $pdf->SetFont('Arial','B',9); 
                                      $x = $pdf->GetX();
                                      $y = $pdf->GetY();
                                      $data = "Scouring & Bleaching Total Qty. (mtr.)";
                                      strlen($data)<70?$b=8:$b=4;
                                      $pdf->MultiCell(76,$b,$data,'1','C');
                                      $pdf->SetXY($x + 76, $y);
                                      $data = $row['pp_quantity'];
                                      strlen($data)<20?$b=8:$b=4;
                                      $pdf->MultiCell(27,$b,$data,'1','C');
                                      $pdf->SetXY($x + 103, $y);
                                      $data = $row['before_process_qty'];
                                      strlen($data)<20?$b=8:$b=4;
                                      $pdf->MultiCell(27,$b,$data,'1','C');
                                      $pdf->SetXY($x + 130, $y);
                                      $data = $row['process_qty'];
                                      strlen($data)<20?$b=8:$b=4;
                                      $pdf->MultiCell(27,$b,$data,'1','C');
                                      $pdf->SetXY($x + 157, $y);
                                      $data = $row['short_pp_qty'];
                                      strlen($data)<20?$b=8:$b=4;
                                      $pdf->MultiCell(23,$b,$data,'1','C');
                                      $pdf->SetXY($x + 180, $y);
                                      $data = $row['short_pp_percent'];
                                      strlen($data)<20?$b=8:$b=4;
                                      $pdf->MultiCell(18,$b,$data,'1','C'); 
                                      $pdf->SetXY($x + 198, $y); 
                                      $data = $row['short_gre_rcv_qty'];
                                      strlen($data)<20?$b=8:$b=4;
                                      $pdf->MultiCell(23,$b,$data,'1','C');
                                      $pdf->SetXY($x + 221, $y);
                                      $data = $row['short_gre_rcv_percent'];
                                      strlen($data)<20?$b=8:$b=4;
                                      $pdf->MultiCell(18,$b,$data,'1','C');
                                      $pdf->SetXY($x + 239, $y); 
                                      $data = $row['short_pre_proc_qty'];
                                      strlen($data)<20?$b=8:$b=4;
                                      $pdf->MultiCell(23,$b,$data,'1','C');
                                      $pdf->SetXY($x + 262, $y);
                                      $data = $row['short_pre_proc_percent'];
                                      strlen($data)<20?$b=8:$b=4;
                                      $pdf->MultiCell(18,$b,$data,'1','C');  

                                      if($row['short_excess_qty']!= '') 
                                          {
                                              $process_loss_gain+=$row['short_excess_qty'];
                                          }
                              
                                          $Total_pp_quantity = $row['pp_quantity'];
                                          $Total_greige_quantity = $row['process_qty'];
                                   
                                  }

              }
            }

            /*********************************Create Ready For Mercerize (Process No- 5) Table**********************************/

            $greige_period = "select ptftri.pp_number, ptftri.process_id, date_format(min(ptftri.partial_test_for_test_result_creation_date), '%d-%b-%Y') start_date,
            date_format(max(ptftri.partial_test_for_test_result_creation_date), '%d-%b-%Y') end_date
            from partial_test_for_test_result_info  ptftri
            where  ptftri.process_id = 'proc_5' and ptftri.pp_number = '$pp_number' ";

    $result_for_greige= mysqli_query($con,$greige_period) or die(mysqli_error($con));
    while($row = mysqli_fetch_array($result_for_greige))  
    {  
        if($row['end_date']!= '') 
        {
            $process_completion_date = $row['end_date'];
        }

        if($row_for_select_process["process_id"] == "proc_5")
        {
        $Serial+=1;

        $sql_for_ready_for_mercerize = "select pp.pp_number, pp.version_name as version_number, pp.color, pp.style_name, pp.gw, pp.fw, pp.pp_quantity, result.after_trolley_or_batcher_qty, result.date, 
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
        ptftri.pp_number = aptv.pp_number and ptftri.version_id = aptv.version_id and ptftri.style=aptv.style_name  and ptftri.process_name=aptv.process_name and ptftri.process_id = 'proc_5'
         and ptftri.pp_number = '$pp_number')result 
        
        on pp.pp_number = result.pp_number and pp.version_id = result.version_id  order by result.date, pp.pp_number, pp.version_id, pp.color, pp.style_name, pp.gw, pp.fw";
         
        $result_for_ready_for_mercerize = mysqli_query($con,$sql_for_ready_for_mercerize) or die(mysqli_error($con));

        $row_number_for_ready_for_mercerize = mysqli_num_rows($result_for_ready_for_mercerize);

        $counter = $counter + ($row_number_for_ready_for_mercerize * 8) + 10 + 10; 

        if($counter>200)
            {
                $pdf->AddPage();
                $pdf->SetLeftMargin(8);
                $counter =30;
                $counter = $counter + ($row_number_for_ready_for_mercerize * 8) + 10 + 10; 

            } 

        $pdf->SetFont('Arial','B',14);
        $pdf->Ln(3);
        $pdf->Cell(280,7,$Serial.'.'.'  '.'Ready for Mercerize'.'   ('.$row["start_date"].' To '.$row["end_date"].')'.$pdf->SetFillColor(255,255,255),"0","1","L",true);
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
        $pdf->MultiCell(28,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
        $pdf->SetXY($x + 49, $y);
        $data = "Color";
        strlen($data)<15?$b=10:$b=5;
        $pdf->MultiCell(24,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
        $pdf->SetXY($x + 73, $y);
        $data = "Style";
        strlen($data)<15?$b=10:$b=5;
        $pdf->MultiCell(24,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
        $pdf->SetXY($x + 97, $y);
        $data = "Greige Width (inch)";
        strlen($data)<10?$b=10:$b=5;
        $pdf->MultiCell(21,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
        $pdf->SetXY($x + 118, $y);
        $data = "Finish Width (inch)";
        strlen($data)<10?$b=10:$b=5;
        $pdf->MultiCell(21,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
        $pdf->SetXY($x + 139, $y);
        $data = "Before Trolley No.";
        strlen($data)<10?$b=10:$b=5;
        $pdf->MultiCell(20,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
        $pdf->SetXY($x + 159, $y);
        $data = "B. Process Qty (mtr.)";
        strlen($data)<15?$b=10:$b=5;
        $pdf->MultiCell(20,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
        $pdf->SetXY($x + 179, $y);
        $data = "After Trolley No.";
        strlen($data)<10?$b=10:$b=5;
        $pdf->MultiCell(20,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
        $pdf->SetXY($x + 199, $y);
        $data = "Process Qty (mtr.)";
        strlen($data)<10?$b=10:$b=5;
        $pdf->MultiCell(20,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
        $pdf->SetXY($x + 219, $y);
        $data = "(+/-) From Prev. Process";
        strlen($data)<10?$b=10:$b=5;
        $pdf->MultiCell(41,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
        $pdf->SetXY($x + 219, $y+5);
        $data = "Qty (mtr.)";
        // strlen($data)<15?$b=10:$b=5;
        $pdf->MultiCell(23,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
        $pdf->SetXY($x + 242, $y+5);
        $data = "%";
        // strlen($data)<15?$b=10:$b=5;
        $pdf->MultiCell(18,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
        $pdf->SetXY($x + 260, $y);
        $data = "Process / Reprocess";
        strlen($data)<10?$b=10:$b=5;
        $pdf->MultiCell(20,$b,"$data".$pdf->SetFillColor(220,220,220),'1','C',TRUE);
        // $pdf->SetXY($x + 194, $y);

        $pdf->Cell(200,0,$pdf->SetFillColor(255,255,255),'1','1','c',true);

        $pdf->SetFont('Arial','',9);


                                        while($row = mysqli_fetch_array($result_for_ready_for_mercerize))  
                                        {
                                            $x = $pdf->GetX();
                                            $y = $pdf->GetY();
                                            $data = $row['date'];
                                            strlen($data)<20?$b=8:$b=4;
                                            $pdf->MultiCell(21,$b,$data,'1','C');
                                            $pdf->SetXY($x + 21, $y);
                                            $data = $row['version_number'];
                                            strlen($data)<20?$b=8:$b=4;
                                            $pdf->MultiCell(28,$b,$data,'1','C');
                                            $pdf->SetXY($x + 49, $y);
                                            $data = $row['color'];
                                            strlen($data)<20?$b=8:$b=4;
                                            $pdf->MultiCell(24,$b,$data,'1','C');
                                            $pdf->SetXY($x + 73, $y);
                                            $data = $row['style_name'];
                                            strlen($data)<10?$b=8:$b=4;
                                            $pdf->MultiCell(24,$b,$data,'1','C');
                                            $pdf->SetXY($x + 97, $y);
                                            $data = $row['gw'];
                                            strlen($data)<20?$b=8:$b=4;
                                            $pdf->MultiCell(21,$b,$data,'1','C');
                                            $pdf->SetXY($x + 118, $y);
                                            $data = $row['fw'];
                                            strlen($data)<20?$b=8:$b=4;
                                            $pdf->MultiCell(21,$b,$data,'1','C');
                                            $pdf->SetXY($x + 139, $y);
                                            $data = $row['before_trolley_number_or_batcher_number'];
                                            strlen($data)<20?$b=8:$b=4;
                                            $pdf->MultiCell(20,$b,$data,'1','C');
                                            $pdf->SetXY($x + 159, $y);
                                            $data = $row['before_trolley_or_batcher_qty'];
                                            strlen($data)<20?$b=8:$b=4;
                                            $pdf->MultiCell(20,$b,$data,'1','C');
                                            $pdf->SetXY($x + 179, $y);
                                            $data = $row['after_trolley_number_or_batcher_number'];
                                            strlen($data)<20?$b=8:$b=4;
                                            $pdf->MultiCell(20,$b,$data,'1','C');
                                            $pdf->SetXY($x + 199, $y);
                                            $data = $row['after_trolley_or_batcher_qty'];
                                            strlen($data)<20?$b=8:$b=4;
                                            $pdf->MultiCell(20,$b,$data,'1','C');
                                            $pdf->SetXY($x + 219, $y);
                                            $data = $row['short_proc'];
                                            strlen($data)<20?$b=8:$b=4;
                                            $pdf->MultiCell(23,$b,$data,'1','C');
                                            $pdf->SetXY($x + 242, $y);
                                            $data = $row['short_percent'];
                                            strlen($data)<20?$b=8:$b=4;
                                            $pdf->MultiCell(18,$b,$data,'1','C');
                                            $pdf->SetXY($x + 260, $y);
                                            $data = $row['process_or_reprocess'];
                                            strlen($data)<20?$b=8:$b=4;
                                            $pdf->SetFont('Arial','',7);
                                                          $pdf->MultiCell(20,$b,$data,'1','C'); 
                                                          $pdf->SetFont('Arial','',9); 
                                        }



                                // Width summary for ready_for_mercerize

                                $sql_for_ready_for_mercerize_width = "select pp.pp_number, pp.gw, pp.fw, pp.pp_quantity, result.process_qty, result.before_process_qty, result.gray_process_qty,
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
                               and ptftri.process_id = 'proc_5' and ptftri.pp_number = '$pp_number'
                                group by ptftri.pp_number, pwvci.finish_width_in_inch, pwvci.greige_width_in_inch,ptftri.version_id )P
                               where  1=1
                               and ptftri_1.process_id = p.process_id
                               and ptftri_1.pp_number = p.pp_number
                               and ptftri_1.version_id = p.version_id
                               and ptftri_1.partial_test_for_test_result_creation_date = p.max_date
                               group by process_id,pp_number, fw,  gw)result 
                               on pp.pp_number = result.pp_number and pp.fw = result.fw and pp.gw = result.gw 
                               order by pp.pp_number, pp.gw, pp.fw";
                                
                                $result_for_ready_for_mercerize_width= mysqli_query($con,$sql_for_ready_for_mercerize_width) or die(mysqli_error($con));

                                $row_number_for_ready_for_mercerize_width = mysqli_num_rows($result_for_ready_for_mercerize_width);

                                $counter = $counter + ($row_number_for_ready_for_mercerize_width*8) + 10 + 10; 
                  
                                  if($counter>200)
                                      {
                                          $pdf->AddPage();
                                          $pdf->SetLeftMargin(8);
                                          $counter =30;
                                          $counter = $counter + ($row_number_for_ready_for_mercerize_width*8) + 10 + 10; 
                                      } 

                                $pdf->SetFont('Arial','B',11);
                                $pdf->Ln(3);
                                $pdf->Cell(280,7,"Width Summary".$pdf->SetFillColor(220,220,220),"1","1","C",true);
                                $pdf->SetFont('Arial','B',9);

                                $x = $pdf->GetX();
                                $y = $pdf->GetY();
                                $data = "Greige Width (inch)";
                                strlen($data)<15?$b=10:$b=5;
                                $pdf->MultiCell(30,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 30, $y);
                                $data = "Finish Width (inch)";
                                strlen($data)<15?$b=10:$b=5;
                                $pdf->MultiCell(30,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 60, $y);
                                $data = "PP Quantity. (mtr.)";
                                strlen($data)<25?$b=10:$b=5;
                                $pdf->MultiCell(32,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 92, $y);
                                $data = "Before Process Quantity (mtr.)";
                                strlen($data)<25?$b=10:$b=5;
                                $pdf->MultiCell(33,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 125, $y);
                                $data = "Process Quantity. (mtr.)";
                                strlen($data)<15?$b=10:$b=5;
                                $pdf->MultiCell(32,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 157, $y);
                                $data = "(+/-) From PP";
                                // strlen($data)<15?$b=10:$b=5;
                                $pdf->MultiCell(41,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 157, $y+5);
                                $data = "Qty (mtr.)";
                                // strlen($data)<15?$b=10:$b=5;
                                $pdf->MultiCell(23,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 180, $y+5);
                                $data = "%";
                                // strlen($data)<15?$b=10:$b=5;
                                $pdf->MultiCell(18,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 198, $y);
                                $data = "(+/-) From Greige";
                                // strlen($data)<15?$b=10:$b=5;
                                $pdf->MultiCell(41,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 198, $y+5);
                                $data = "Qty (mtr.)";
                                // strlen($data)<15?$b=10:$b=5;
                                $pdf->MultiCell(23,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 221, $y+5);
                                $data = "%";
                                // strlen($data)<15?$b=10:$b=5;
                                $pdf->MultiCell(18,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 239, $y);
                                $data = "(+/-) From Prev. Process";
                                // strlen($data)<15?$b=10:$b=5;
                                $pdf->MultiCell(41,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 239, $y+5);
                                $data = "Qty (mtr.)";
                                // strlen($data)<15?$b=10:$b=5;
                                $pdf->MultiCell(23,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 262, $y+5);
                                $data = "%";
                                // strlen($data)<15?$b=10:$b=5;
                                $pdf->MultiCell(18,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 280, $y);
                                
                                // $pdf->Cell(0,0,$pdf->SetFillColor(255,255,255),'1','1','C',true);
                                $pdf->SetFont('Arial','',9);       
                                 $pdf->Ln(10);
                               
                                
                            while($row = mysqli_fetch_array($result_for_ready_for_mercerize_width))  
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
                                $pdf->MultiCell(32,$b,$data,'1','C');
                                $pdf->SetXY($x + 92, $y);
                                $data = $row['before_process_qty'];
                                strlen($data)<20?$b=8:$b=4;
                                $pdf->MultiCell(33,$b,$data,'1','C');
                                $pdf->SetXY($x + 125, $y);
                                $data = $row['process_qty'];
                                strlen($data)<20?$b=8:$b=4;
                                $pdf->MultiCell(32,$b,$data,'1','C');
                                $pdf->SetXY($x + 157, $y);
                                $data = $row['short_pp_qty'];
                                strlen($data)<15?$b=8:$b=4;
                                $pdf->MultiCell(23,$b,$data,'1','C');
                                $pdf->SetXY($x + 180, $y);
                                $data = $row['short_pp_percent'];
                                strlen($data)<15?$b=8:$b=4;
                                $pdf->MultiCell(18,$b,$data,'1','C');
                                $pdf->SetXY($x + 198, $y);
                                $data = $row['short_gre_rcv_qty'];
                                strlen($data)<15?$b=8:$b=4;
                                $pdf->MultiCell(23,$b,$data,'1','C');
                                $pdf->SetXY($x + 221, $y);
                                $data = $row['short_gre_rcv_percent'];
                                strlen($data)<15?$b=8:$b=4;
                                $pdf->MultiCell(18,$b,$data,'1','C');
                                $pdf->SetXY($x + 239, $y);
                                $data = $row['short_pre_proc_qty'];
                                strlen($data)<15?$b=8:$b=4;
                                $pdf->MultiCell(23,$b,$data,'1','C');
                                $pdf->SetXY($x + 262, $y);
                                $data = $row['short_pre_proc_percent'];
                                strlen($data)<15?$b=8:$b=4;
                                $pdf->MultiCell(18,$b,$data,'1','C');
                                // $pdf->SetXY($x + 200, $y);

                            }
                                // Version summary for ready_for_mercerize

                                 $sql_for_ready_for_mercerize_version = "select pp.pp_number, pp.version_name version_number, pp.style_name, pp.color, pp.gw, pp.fw, pp.pp_quantity, result.process_qty, result.before_process_qty, result.gray_process_qty, 
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
                                 and ptftri.process_id = 'proc_5' and ptftri.pp_number = '$pp_number'
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

                                  $result_for_ready_for_mercerize_version= mysqli_query($con,$sql_for_ready_for_mercerize_version) or die(mysqli_error($con));

                                  $row_number_for_ready_for_mercerize_version = mysqli_num_rows($result_for_ready_for_mercerize_version);

                                  $counter = $counter + ($row_number_for_ready_for_mercerize_version*8) + 10 + 10 + 8; 
                  
                                  if($counter>200)
                                      {
                                          $pdf->AddPage();
                                          $pdf->SetLeftMargin(8);
                                          $counter =30;
                                          $counter = $counter + ($row_number_for_ready_for_mercerize_version*8) + 10 + 10 + 8; 

                                      } 

                                  $pdf->SetFont('Arial','B',11);
                                  $pdf->Ln(3);
                                  $pdf->Cell(280,7,"Version Summary".$pdf->SetFillColor(220,220,220),"1","1","C",true);
                                  $pdf->SetFont('Arial','B',9);

                                $x = $pdf->GetX();
                                $y = $pdf->GetY();
                                $data = "Version";
                                strlen($data)<15?$b=10:$b=5;
                                $pdf->MultiCell(28,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 28, $y);
                                $data = "Color";
                                strlen($data)<15?$b=10:$b=5;
                                $pdf->MultiCell(24,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 52, $y);
                                $data = "Style";
                                strlen($data)<15?$b=10:$b=5;
                                $pdf->MultiCell(24,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 76, $y);
                                $data = "PP Quantity (mtr.)";
                                strlen($data)<15?$b=10:$b=5;
                                $pdf->MultiCell(27,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 103, $y);
                                $data = "Before process Qty (mtr.)";
                                strlen($data)<20?$b=10:$b=5;
                                $pdf->MultiCell(27,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 130, $y);
                                $data = "Process Quantity (mtr.)";
                                strlen($data)<20?$b=10:$b=5;
                                $pdf->MultiCell(27,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 157, $y);
                                $data = "(+/-) From PP";
                                // strlen($data)<15?$b=10:$b=5;
                                $pdf->MultiCell(41,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 157, $y+5);
                                $data = "Qty (mtr.)";
                                // strlen($data)<15?$b=10:$b=5;
                                $pdf->MultiCell(23,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 180, $y+5);
                                $data = "%";
                                // strlen($data)<15?$b=10:$b=5;
                                $pdf->MultiCell(18,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 198, $y);
                                $data = "(+/-) From Greige";
                                // strlen($data)<15?$b=10:$b=5;
                                $pdf->MultiCell(41,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 198, $y+5);
                                $data = "Qty (mtr.)";
                                // strlen($data)<15?$b=10:$b=5;
                                $pdf->MultiCell(23,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 221, $y+5);
                                $data = "%";
                                // strlen($data)<15?$b=10:$b=5;
                                $pdf->MultiCell(18,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 239, $y);
                                $data = "(+/-) From Prev. Process";
                                // strlen($data)<15?$b=10:$b=5;
                                $pdf->MultiCell(41,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 239, $y+5);
                                $data = "Qty (mtr.)";
                                // strlen($data)<15?$b=10:$b=5;
                                $pdf->MultiCell(23,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 262, $y+5);
                                $data = "%";
                                // strlen($data)<15?$b=10:$b=5;
                                $pdf->MultiCell(18,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 280, $y);
                                
                                // $pdf->Cell(0,0,$pdf->SetFillColor(255,255,255),'1','1','C',true);
                                $pdf->SetFont('Arial','',9);       
                                 $pdf->Ln(10);
    
                          while($row = mysqli_fetch_array($result_for_ready_for_mercerize_version))  
                          {  
                              $x = $pdf->GetX();
                              $y = $pdf->GetY();
                              $data = $row['version_number'];
                              strlen($data)<20?$b=8:$b=4;
                              $pdf->MultiCell(28,$b,$data,'1','C');
                              $pdf->SetXY($x + 28, $y);
                              $data = $row['color'];
                              strlen($data)<20?$b=8:$b=4;
                              $pdf->MultiCell(24,$b,$data,'1','C');
                              $pdf->SetXY($x + 52, $y);
                              $data = $row['style_name'];
                              strlen($data)<10?$b=8:$b=4;
                              $pdf->MultiCell(24,$b,$data,'1','C');
                              $pdf->SetXY($x + 76, $y);
                              $data = $row['pp_quantity'];
                              strlen($data)<20?$b=8:$b=4;
                              $pdf->MultiCell(27,$b,$data,'1','C');
                              $pdf->SetXY($x + 103, $y);
                              $data = $row['before_process_qty'];
                              strlen($data)<20?$b=8:$b=4;
                              $pdf->MultiCell(27,$b,$data,'1','C');
                              $pdf->SetXY($x + 130, $y);
                              $data = $row['process_qty'];
                              strlen($data)<20?$b=8:$b=4;
                              $pdf->MultiCell(27,$b,$data,'1','C');
                              $pdf->SetXY($x + 157, $y);
                              $data = $row['short_pp'];
                              strlen($data)<15?$b=8:$b=4;
                              $pdf->MultiCell(23,$b,$data,'1','C');
                              $pdf->SetXY($x + 180, $y);
                              $data = $row['short_pp_percent'];
                              strlen($data)<15?$b=8:$b=4;
                              $pdf->MultiCell(18,$b,$data,'1','C');
                              $pdf->SetXY($x + 198, $y);
                              $data = $row['short_gre_rcv_qty'];
                              strlen($data)<15?$b=8:$b=4;
                              $pdf->MultiCell(23,$b,$data,'1','C');
                              $pdf->SetXY($x + 221, $y);
                              $data = $row['short_gre_rcv_percent'];
                              strlen($data)<15?$b=8:$b=4;
                              $pdf->MultiCell(18,$b,$data,'1','C');
                              $pdf->SetXY($x + 239, $y);
                              $data = $row['short_pre_proc_qty'];
                              strlen($data)<15?$b=8:$b=4;
                              $pdf->MultiCell(23,$b,$data,'1','C');
                              $pdf->SetXY($x + 262, $y);
                              $data = $row['short_pre_proc_percent'];
                              strlen($data)<15?$b=8:$b=4;
                              $pdf->MultiCell(18,$b,$data,'1','C');
                              // $pdf->SetXY($x + 280, $y);

                          }

                          $sql_for_ready_for_mercerize_total = "select total.pp_number, sum(total.pp_quantity) pp_quantity, sum(total.process_qty) process_qty, 
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
                          and ptftri.process_id = 'proc_5' and ptftri.pp_number = '$pp_number'
                          group by ptftri.pp_number, ptftri.version_number, ptftri.finish_width_in_inch )P
                          where  1=1
                          and ptftri_1.process_id = p.process_id
                          and ptftri_1.pp_number = p.pp_number
                          and ptftri_1.version_number = p.version_name
                          and ptftri_1.partial_test_for_test_result_creation_date = p.max_date
                          and ptftri_1.finish_width_in_inch = p.finish_width_in_inch
                          group by process_id,pp_number, version_name)result where pp.pp_number = result.pp_number and pp.version_name = result.version_name ) total
                          ";
                        $result_for_ready_for_mercerize_total= mysqli_query($con,$sql_for_ready_for_mercerize_total) or die(mysqli_error($con));
                        while($row = mysqli_fetch_array($result_for_ready_for_mercerize_total))  
                        {
                            $pdf->SetFont('Arial','B',9); 
                            $x = $pdf->GetX();
                            $y = $pdf->GetY();
                            $data = "Ready for Mercerize Total Qty. (mtr.)";
                            strlen($data)<70?$b=8:$b=4;
                            $pdf->MultiCell(76,$b,$data,'1','C');
                            $pdf->SetXY($x + 76, $y);
                            $data = $row['pp_quantity'];
                            strlen($data)<20?$b=8:$b=4;
                            $pdf->MultiCell(27,$b,$data,'1','C');
                            $pdf->SetXY($x + 103, $y);
                            $data = $row['before_process_qty'];
                            strlen($data)<20?$b=8:$b=4;
                            $pdf->MultiCell(27,$b,$data,'1','C');
                            $pdf->SetXY($x + 130, $y);
                            $data = $row['process_qty'];
                            strlen($data)<20?$b=8:$b=4;
                            $pdf->MultiCell(27,$b,$data,'1','C');
                            $pdf->SetXY($x + 157, $y);
                            $data = $row['short_pp_qty'];
                            strlen($data)<20?$b=8:$b=4;
                            $pdf->MultiCell(23,$b,$data,'1','C');
                            $pdf->SetXY($x + 180, $y);
                            $data = $row['short_pp_percent'];
                            strlen($data)<20?$b=8:$b=4;
                            $pdf->MultiCell(18,$b,$data,'1','C'); 
                            $pdf->SetXY($x + 198, $y); 
                            $data = $row['short_gre_rcv_qty'];
                            strlen($data)<20?$b=8:$b=4;
                            $pdf->MultiCell(23,$b,$data,'1','C');
                            $pdf->SetXY($x + 221, $y);
                            $data = $row['short_gre_rcv_percent'];
                            strlen($data)<20?$b=8:$b=4;
                            $pdf->MultiCell(18,$b,$data,'1','C');
                            $pdf->SetXY($x + 239, $y); 
                            $data = $row['short_pre_proc_qty'];
                            strlen($data)<20?$b=8:$b=4;
                            $pdf->MultiCell(23,$b,$data,'1','C');
                            $pdf->SetXY($x + 262, $y);
                            $data = $row['short_pre_proc_percent'];
                            strlen($data)<20?$b=8:$b=4;
                            $pdf->MultiCell(18,$b,$data,'1','C');  

                            if($row['short_excess_qty']!= '') 
                                {
                                    $process_loss_gain+=$row['short_excess_qty'];
                                }
                    
                                $Total_pp_quantity = $row['pp_quantity'];
                                $Total_greige_quantity = $row['process_qty'];
                         
                        }

    }
  }

  /*********************************Create Mercerize (Process No- 6) Table**********************************/

  $greige_period = "select ptftri.pp_number, ptftri.process_id, date_format(min(ptftri.partial_test_for_test_result_creation_date), '%d-%b-%Y') start_date,
  date_format(max(ptftri.partial_test_for_test_result_creation_date), '%d-%b-%Y') end_date
  from partial_test_for_test_result_info  ptftri
  where  ptftri.process_id = 'proc_6' and ptftri.pp_number = '$pp_number'  
    ";

$result_for_greige= mysqli_query($con,$greige_period) or die(mysqli_error($con));
while($row = mysqli_fetch_array($result_for_greige))  
{  
    if($row['end_date']!= '') 
    {
        $process_completion_date = $row['end_date'];
    }

    if($row_for_select_process["process_id"] == "proc_6")
    {
        $Serial+=1;

        $sql_for_mercerize =  "select pp.pp_number, pp.version_name as version_number, pp.color, pp.style_name, pp.gw, pp.fw, pp.pp_quantity, result.after_trolley_or_batcher_qty, result.date, 
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
        ptftri.pp_number = aptv.pp_number and ptftri.version_id = aptv.version_id and ptftri.style=aptv.style_name  and ptftri.process_name=aptv.process_name and ptftri.process_id = 'proc_6'
         and ptftri.pp_number = '$pp_number')result 
        
        on pp.pp_number = result.pp_number and pp.version_id = result.version_id  order by result.date, pp.pp_number, pp.version_id, pp.color, pp.style_name, pp.gw, pp.fw";
         
        $result_for_mercerize= mysqli_query($con,$sql_for_mercerize) or die(mysqli_error($con));

        $row_number_for_mercerize = mysqli_num_rows($result_for_mercerize);

        $counter = $counter + ($row_number_for_mercerize*8) + 10 + 10; 

        if($counter>200)
            {
                $pdf->AddPage();
                $pdf->SetLeftMargin(8);
                $counter =30;
                $counter = $counter + ($row_number_for_mercerize*8) + 10 + 10; 

            } 

        $pdf->SetFont('Arial','B',14);
        $pdf->Ln(3);
        $pdf->Cell(280,7,$Serial.'.'.'  '.'Mercerize'.'   ('.$row["start_date"].' To '.$row["end_date"].')'.$pdf->SetFillColor(255,255,255),"0","1","L",true);
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
        $pdf->MultiCell(28,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
        $pdf->SetXY($x + 49, $y);
        $data = "Color";
        strlen($data)<15?$b=10:$b=5;
        $pdf->MultiCell(24,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
        $pdf->SetXY($x + 73, $y);
        $data = "Style";
        strlen($data)<15?$b=10:$b=5;
        $pdf->MultiCell(24,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
        $pdf->SetXY($x + 97, $y);
        $data = "Greige Width (inch)";
        strlen($data)<10?$b=10:$b=5;
        $pdf->MultiCell(21,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
        $pdf->SetXY($x + 118, $y);
        $data = "Finish Width (inch)";
        strlen($data)<10?$b=10:$b=5;
        $pdf->MultiCell(21,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
        $pdf->SetXY($x + 139, $y);
        $data = "Before Trolley No.";
        strlen($data)<10?$b=10:$b=5;
        $pdf->MultiCell(20,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
        $pdf->SetXY($x + 159, $y);
        $data = "B. Process Qty (mtr.)";
        strlen($data)<15?$b=10:$b=5;
        $pdf->MultiCell(20,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
        $pdf->SetXY($x + 179, $y);
        $data = "After Trolley No.";
        strlen($data)<10?$b=10:$b=5;
        $pdf->MultiCell(20,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
        $pdf->SetXY($x + 199, $y);
        $data = "Process Qty (mtr.)";
        strlen($data)<10?$b=10:$b=5;
        $pdf->MultiCell(20,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
        $pdf->SetXY($x + 219, $y);
        $data = "(+/-) From Prev. Process";
        strlen($data)<10?$b=10:$b=5;
        $pdf->MultiCell(41,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
        $pdf->SetXY($x + 219, $y+5);
        $data = "Qty (mtr.)";
        // strlen($data)<15?$b=10:$b=5;
        $pdf->MultiCell(23,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
        $pdf->SetXY($x + 242, $y+5);
        $data = "%";
        // strlen($data)<15?$b=10:$b=5;
        $pdf->MultiCell(18,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
        $pdf->SetXY($x + 260, $y);
        $data = "Process / Reprocess";
        strlen($data)<10?$b=10:$b=5;
        $pdf->MultiCell(20,$b,"$data".$pdf->SetFillColor(220,220,220),'1','C',TRUE);
        // $pdf->SetXY($x + 194, $y);

        $pdf->Cell(200,0,$pdf->SetFillColor(255,255,255),'1','1','c',true);

        $pdf->SetFont('Arial','',9);


                                        while($row = mysqli_fetch_array($result_for_mercerize))  
                                        {
                                            $x = $pdf->GetX();
                                            $y = $pdf->GetY();
                                            $data = $row['date'];
                                            strlen($data)<20?$b=8:$b=4;
                                            $pdf->MultiCell(21,$b,$data,'1','C');
                                            $pdf->SetXY($x + 21, $y);
                                            $data = $row['version_number'];
                                            strlen($data)<20?$b=8:$b=4;
                                            $pdf->MultiCell(28,$b,$data,'1','C');
                                            $pdf->SetXY($x + 49, $y);
                                            $data = $row['color'];
                                            strlen($data)<20?$b=8:$b=4;
                                            $pdf->MultiCell(24,$b,$data,'1','C');
                                            $pdf->SetXY($x + 73, $y);
                                            $data = $row['style_name'];
                                            strlen($data)<10?$b=8:$b=4;
                                            $pdf->MultiCell(24,$b,$data,'1','C');
                                            $pdf->SetXY($x + 97, $y);
                                            $data = $row['gw'];
                                            strlen($data)<20?$b=8:$b=4;
                                            $pdf->MultiCell(21,$b,$data,'1','C');
                                            $pdf->SetXY($x + 118, $y);
                                            $data = $row['fw'];
                                            strlen($data)<20?$b=8:$b=4;
                                            $pdf->MultiCell(21,$b,$data,'1','C');
                                            $pdf->SetXY($x + 139, $y);
                                            $data = $row['before_trolley_number_or_batcher_number'];
                                            strlen($data)<20?$b=8:$b=4;
                                            $pdf->MultiCell(20,$b,$data,'1','C');
                                            $pdf->SetXY($x + 159, $y);
                                            $data = $row['before_trolley_or_batcher_qty'];
                                            strlen($data)<20?$b=8:$b=4;
                                            $pdf->MultiCell(20,$b,$data,'1','C');
                                            $pdf->SetXY($x + 179, $y);
                                            $data = $row['after_trolley_number_or_batcher_number'];
                                            strlen($data)<20?$b=8:$b=4;
                                            $pdf->MultiCell(20,$b,$data,'1','C');
                                            $pdf->SetXY($x + 199, $y);
                                            $data = $row['after_trolley_or_batcher_qty'];
                                            strlen($data)<20?$b=8:$b=4;
                                            $pdf->MultiCell(20,$b,$data,'1','C');
                                            $pdf->SetXY($x + 219, $y);
                                            $data = $row['short_proc'];
                                            strlen($data)<20?$b=8:$b=4;
                                            $pdf->MultiCell(23,$b,$data,'1','C');
                                            $pdf->SetXY($x + 242, $y);
                                            $data = $row['short_percent'];
                                            strlen($data)<20?$b=8:$b=4;
                                            $pdf->MultiCell(18,$b,$data,'1','C');
                                            $pdf->SetXY($x + 260, $y);
                                            $data = $row['process_or_reprocess'];
                                            strlen($data)<20?$b=8:$b=4;
                                            $pdf->SetFont('Arial','',7);
                                                          $pdf->MultiCell(20,$b,$data,'1','C'); 
                                                          $pdf->SetFont('Arial','',9); 
                                        }



                                // Width summary for Mercerize	

                                $sql_for_mercerize_width = "select pp.pp_number, pp.gw, pp.fw, pp.pp_quantity, result.process_qty, result.before_process_qty, result.gray_process_qty,
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
                               and ptftri.process_id = 'proc_6' and ptftri.pp_number = '$pp_number'
                                group by ptftri.pp_number, pwvci.finish_width_in_inch, pwvci.greige_width_in_inch,ptftri.version_id )P
                               where  1=1
                               and ptftri_1.process_id = p.process_id
                               and ptftri_1.pp_number = p.pp_number
                               and ptftri_1.version_id = p.version_id
                               and ptftri_1.partial_test_for_test_result_creation_date = p.max_date
                               group by process_id,pp_number, fw,  gw)result 
                               on pp.pp_number = result.pp_number and pp.fw = result.fw and pp.gw = result.gw 
                               order by pp.pp_number, pp.gw, pp.fw";
                                
                                $result_for_mercerize_width= mysqli_query($con,$sql_for_mercerize_width) or die(mysqli_error($con));

                                $row_number_for_mercerize_width = mysqli_num_rows($result_for_mercerize_width);

                                $counter = $counter + ($row_number_for_mercerize_width*8) + 10 + 10; 
                  
                                  if($counter>200)
                                      {
                                          $pdf->AddPage();
                                          $pdf->SetLeftMargin(8);
                                          $counter =30;
                                          $counter = $counter + ($row_number_for_mercerize_width*8) + 10 + 10; 
                                      } 

                                $pdf->SetFont('Arial','B',11);
                                $pdf->Ln(3);
                                $pdf->Cell(280,7,"Width Summary".$pdf->SetFillColor(220,220,220),"1","1","C",true);
                                $pdf->SetFont('Arial','B',9);

                                $x = $pdf->GetX();
                                $y = $pdf->GetY();
                                $data = "Greige Width (inch)";
                                strlen($data)<15?$b=10:$b=5;
                                $pdf->MultiCell(30,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 30, $y);
                                $data = "Finish Width (inch)";
                                strlen($data)<15?$b=10:$b=5;
                                $pdf->MultiCell(30,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 60, $y);
                                $data = "PP Quantity. (mtr.)";
                                strlen($data)<25?$b=10:$b=5;
                                $pdf->MultiCell(32,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 92, $y);
                                $data = "Before Process Quantity (mtr.)";
                                strlen($data)<25?$b=10:$b=5;
                                $pdf->MultiCell(33,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 125, $y);
                                $data = "Process Quantity. (mtr.)";
                                strlen($data)<15?$b=10:$b=5;
                                $pdf->MultiCell(32,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 157, $y);
                                $data = "(+/-) From PP";
                                // strlen($data)<15?$b=10:$b=5;
                                $pdf->MultiCell(41,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 157, $y+5);
                                $data = "Qty (mtr.)";
                                // strlen($data)<15?$b=10:$b=5;
                                $pdf->MultiCell(23,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 180, $y+5);
                                $data = "%";
                                // strlen($data)<15?$b=10:$b=5;
                                $pdf->MultiCell(18,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 198, $y);
                                $data = "(+/-) From Greige";
                                // strlen($data)<15?$b=10:$b=5;
                                $pdf->MultiCell(41,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 198, $y+5);
                                $data = "Qty (mtr.)";
                                // strlen($data)<15?$b=10:$b=5;
                                $pdf->MultiCell(23,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 221, $y+5);
                                $data = "%";
                                // strlen($data)<15?$b=10:$b=5;
                                $pdf->MultiCell(18,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 239, $y);
                                $data = "(+/-) From Prev. Process";
                                // strlen($data)<15?$b=10:$b=5;
                                $pdf->MultiCell(41,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 239, $y+5);
                                $data = "Qty (mtr.)";
                                // strlen($data)<15?$b=10:$b=5;
                                $pdf->MultiCell(23,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 262, $y+5);
                                $data = "%";
                                // strlen($data)<15?$b=10:$b=5;
                                $pdf->MultiCell(18,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 280, $y);
                                
                                // $pdf->Cell(0,0,$pdf->SetFillColor(255,255,255),'1','1','C',true);
                                $pdf->SetFont('Arial','',9);       
                                 $pdf->Ln(10);
                               
                                
                            while($row = mysqli_fetch_array($result_for_mercerize_width))  
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
                                $pdf->MultiCell(32,$b,$data,'1','C');
                                $pdf->SetXY($x + 92, $y);
                                $data = $row['before_process_qty'];
                                strlen($data)<20?$b=8:$b=4;
                                $pdf->MultiCell(33,$b,$data,'1','C');
                                $pdf->SetXY($x + 125, $y);
                                $data = $row['process_qty'];
                                strlen($data)<20?$b=8:$b=4;
                                $pdf->MultiCell(32,$b,$data,'1','C');
                                $pdf->SetXY($x + 157, $y);
                                $data = $row['short_pp_qty'];
                                strlen($data)<15?$b=8:$b=4;
                                $pdf->MultiCell(23,$b,$data,'1','C');
                                $pdf->SetXY($x + 180, $y);
                                $data = $row['short_pp_percent'];
                                strlen($data)<15?$b=8:$b=4;
                                $pdf->MultiCell(18,$b,$data,'1','C');
                                $pdf->SetXY($x + 198, $y);
                                $data = $row['short_gre_rcv_qty'];
                                strlen($data)<15?$b=8:$b=4;
                                $pdf->MultiCell(23,$b,$data,'1','C');
                                $pdf->SetXY($x + 221, $y);
                                $data = $row['short_gre_rcv_percent'];
                                strlen($data)<15?$b=8:$b=4;
                                $pdf->MultiCell(18,$b,$data,'1','C');
                                $pdf->SetXY($x + 239, $y);
                                $data = $row['short_pre_proc_qty'];
                                strlen($data)<15?$b=8:$b=4;
                                $pdf->MultiCell(23,$b,$data,'1','C');
                                $pdf->SetXY($x + 262, $y);
                                $data = $row['short_pre_proc_percent'];
                                strlen($data)<15?$b=8:$b=4;
                                $pdf->MultiCell(18,$b,$data,'1','C');
                                // $pdf->SetXY($x + 200, $y);

                            }
                                // Version summary for Mercerize

                                 $sql_for_mercerize_version = "select pp.pp_number, pp.version_name version_number, pp.style_name, pp.color, pp.gw, pp.fw, pp.pp_quantity, result.process_qty, result.before_process_qty, result.gray_process_qty, 
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
                                 and ptftri.process_id = 'proc_6' and ptftri.pp_number = '$pp_number'
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

                                  $result_for_mercerize_version= mysqli_query($con,$sql_for_mercerize_version) or die(mysqli_error($con));

                                  $row_number_for_mercerize_version = mysqli_num_rows($result_for_mercerize_version);

                                  $counter = $counter + ($row_number_for_mercerize_version*8) + 10 + 10 + 8; 
                  
                                  if($counter>200)
                                      {
                                          $pdf->AddPage();
                                          $pdf->SetLeftMargin(8);
                                          $counter =30;
                                          $counter = $counter + ($row_number_for_mercerize_version*8) + 10 + 10 + 8; 

                                      } 

                                  $pdf->SetFont('Arial','B',11);
                                  $pdf->Ln(3);
                                  $pdf->Cell(280,7,"Version Summary".$pdf->SetFillColor(220,220,220),"1","1","C",true);
                                  $pdf->SetFont('Arial','B',9);

                                $x = $pdf->GetX();
                                $y = $pdf->GetY();
                                $data = "Version";
                                strlen($data)<15?$b=10:$b=5;
                                $pdf->MultiCell(28,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 28, $y);
                                $data = "Color";
                                strlen($data)<15?$b=10:$b=5;
                                $pdf->MultiCell(24,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 52, $y);
                                $data = "Style";
                                strlen($data)<15?$b=10:$b=5;
                                $pdf->MultiCell(24,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 76, $y);
                                $data = "PP Quantity (mtr.)";
                                strlen($data)<15?$b=10:$b=5;
                                $pdf->MultiCell(27,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 103, $y);
                                $data = "Before process Qty (mtr.)";
                                strlen($data)<20?$b=10:$b=5;
                                $pdf->MultiCell(27,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 130, $y);
                                $data = "Process Quantity (mtr.)";
                                strlen($data)<20?$b=10:$b=5;
                                $pdf->MultiCell(27,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 157, $y);
                                $data = "(+/-) From PP";
                                // strlen($data)<15?$b=10:$b=5;
                                $pdf->MultiCell(41,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 157, $y+5);
                                $data = "Qty (mtr.)";
                                // strlen($data)<15?$b=10:$b=5;
                                $pdf->MultiCell(23,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 180, $y+5);
                                $data = "%";
                                // strlen($data)<15?$b=10:$b=5;
                                $pdf->MultiCell(18,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 198, $y);
                                $data = "(+/-) From Greige";
                                // strlen($data)<15?$b=10:$b=5;
                                $pdf->MultiCell(41,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 198, $y+5);
                                $data = "Qty (mtr.)";
                                // strlen($data)<15?$b=10:$b=5;
                                $pdf->MultiCell(23,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 221, $y+5);
                                $data = "%";
                                // strlen($data)<15?$b=10:$b=5;
                                $pdf->MultiCell(18,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 239, $y);
                                $data = "(+/-) From Prev. Process";
                                // strlen($data)<15?$b=10:$b=5;
                                $pdf->MultiCell(41,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 239, $y+5);
                                $data = "Qty (mtr.)";
                                // strlen($data)<15?$b=10:$b=5;
                                $pdf->MultiCell(23,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 262, $y+5);
                                $data = "%";
                                // strlen($data)<15?$b=10:$b=5;
                                $pdf->MultiCell(18,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 280, $y);
                                
                                // $pdf->Cell(0,0,$pdf->SetFillColor(255,255,255),'1','1','C',true);
                                $pdf->SetFont('Arial','',9);       
                                 $pdf->Ln(10);
    
                          while($row = mysqli_fetch_array($result_for_mercerize_version))  
                          {  
                              $x = $pdf->GetX();
                              $y = $pdf->GetY();
                              $data = $row['version_number'];
                              strlen($data)<20?$b=8:$b=4;
                              $pdf->MultiCell(28,$b,$data,'1','C');
                              $pdf->SetXY($x + 28, $y);
                              $data = $row['color'];
                              strlen($data)<20?$b=8:$b=4;
                              $pdf->MultiCell(24,$b,$data,'1','C');
                              $pdf->SetXY($x + 52, $y);
                              $data = $row['style_name'];
                              strlen($data)<10?$b=8:$b=4;
                              $pdf->MultiCell(24,$b,$data,'1','C');
                              $pdf->SetXY($x + 76, $y);
                              $data = $row['pp_quantity'];
                              strlen($data)<20?$b=8:$b=4;
                              $pdf->MultiCell(27,$b,$data,'1','C');
                              $pdf->SetXY($x + 103, $y);
                              $data = $row['before_process_qty'];
                              strlen($data)<20?$b=8:$b=4;
                              $pdf->MultiCell(27,$b,$data,'1','C');
                              $pdf->SetXY($x + 130, $y);
                              $data = $row['process_qty'];
                              strlen($data)<20?$b=8:$b=4;
                              $pdf->MultiCell(27,$b,$data,'1','C');
                              $pdf->SetXY($x + 157, $y);
                              $data = $row['short_pp'];
                              strlen($data)<15?$b=8:$b=4;
                              $pdf->MultiCell(23,$b,$data,'1','C');
                              $pdf->SetXY($x + 180, $y);
                              $data = $row['short_pp_percent'];
                              strlen($data)<15?$b=8:$b=4;
                              $pdf->MultiCell(18,$b,$data,'1','C');
                              $pdf->SetXY($x + 198, $y);
                              $data = $row['short_gre_rcv_qty'];
                              strlen($data)<15?$b=8:$b=4;
                              $pdf->MultiCell(23,$b,$data,'1','C');
                              $pdf->SetXY($x + 221, $y);
                              $data = $row['short_gre_rcv_percent'];
                              strlen($data)<15?$b=8:$b=4;
                              $pdf->MultiCell(18,$b,$data,'1','C');
                              $pdf->SetXY($x + 239, $y);
                              $data = $row['short_pre_proc_qty'];
                              strlen($data)<15?$b=8:$b=4;
                              $pdf->MultiCell(23,$b,$data,'1','C');
                              $pdf->SetXY($x + 262, $y);
                              $data = $row['short_pre_proc_percent'];
                              strlen($data)<15?$b=8:$b=4;
                              $pdf->MultiCell(18,$b,$data,'1','C');
                              // $pdf->SetXY($x + 280, $y);

                          }

                          $sql_for_mercerize_total = "select total.pp_number, sum(total.pp_quantity) pp_quantity, sum(total.process_qty) process_qty, 
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
                          and ptftri.process_id = 'proc_6' and ptftri.pp_number = '$pp_number'
                          group by ptftri.pp_number, ptftri.version_number, ptftri.finish_width_in_inch )P
                          where  1=1
                          and ptftri_1.process_id = p.process_id
                          and ptftri_1.pp_number = p.pp_number
                          and ptftri_1.version_number = p.version_name
                          and ptftri_1.partial_test_for_test_result_creation_date = p.max_date
                          and ptftri_1.finish_width_in_inch = p.finish_width_in_inch
                          group by process_id,pp_number, version_name)result where pp.pp_number = result.pp_number and pp.version_name = result.version_name ) total
                          ";
                  
                        $result_for_mercerize_total= mysqli_query($con,$sql_for_mercerize_total) or die(mysqli_error($con));
                        while($row = mysqli_fetch_array($result_for_mercerize_total))  
                        {
                            $pdf->SetFont('Arial','B',9); 
                            $x = $pdf->GetX();
                            $y = $pdf->GetY();
                            $data = "Mercerize Total Qty. (mtr.)";
                            strlen($data)<70?$b=8:$b=4;
                            $pdf->MultiCell(76,$b,$data,'1','C');
                            $pdf->SetXY($x + 76, $y);
                            $data = $row['pp_quantity'];
                            strlen($data)<20?$b=8:$b=4;
                            $pdf->MultiCell(27,$b,$data,'1','C');
                            $pdf->SetXY($x + 103, $y);
                            $data = $row['before_process_qty'];
                            strlen($data)<20?$b=8:$b=4;
                            $pdf->MultiCell(27,$b,$data,'1','C');
                            $pdf->SetXY($x + 130, $y);
                            $data = $row['process_qty'];
                            strlen($data)<20?$b=8:$b=4;
                            $pdf->MultiCell(27,$b,$data,'1','C');
                            $pdf->SetXY($x + 157, $y);
                            $data = $row['short_pp_qty'];
                            strlen($data)<20?$b=8:$b=4;
                            $pdf->MultiCell(23,$b,$data,'1','C');
                            $pdf->SetXY($x + 180, $y);
                            $data = $row['short_pp_percent'];
                            strlen($data)<20?$b=8:$b=4;
                            $pdf->MultiCell(18,$b,$data,'1','C'); 
                            $pdf->SetXY($x + 198, $y); 
                            $data = $row['short_gre_rcv_qty'];
                            strlen($data)<20?$b=8:$b=4;
                            $pdf->MultiCell(23,$b,$data,'1','C');
                            $pdf->SetXY($x + 221, $y);
                            $data = $row['short_gre_rcv_percent'];
                            strlen($data)<20?$b=8:$b=4;
                            $pdf->MultiCell(18,$b,$data,'1','C');
                            $pdf->SetXY($x + 239, $y); 
                            $data = $row['short_pre_proc_qty'];
                            strlen($data)<20?$b=8:$b=4;
                            $pdf->MultiCell(23,$b,$data,'1','C');
                            $pdf->SetXY($x + 262, $y);
                            $data = $row['short_pre_proc_percent'];
                            strlen($data)<20?$b=8:$b=4;
                            $pdf->MultiCell(18,$b,$data,'1','C');  

                            if($row['short_excess_qty']!= '') 
                                {
                                    $process_loss_gain+=$row['short_excess_qty'];
                                }
                    
                                $Total_pp_quantity = $row['pp_quantity'];
                                $Total_greige_quantity = $row['process_qty'];
                         
                        }

    }
  }



                
          /*************************************************  Ready for Print (Process No- 7) ***************************************************/

          $greige_period = "select ptftri.pp_number, ptftri.process_id, date_format(min(ptftri.partial_test_for_test_result_creation_date), '%d-%b-%Y') start_date,
          date_format(max(ptftri.partial_test_for_test_result_creation_date), '%d-%b-%Y') end_date
          from partial_test_for_test_result_info  ptftri where  ptftri.process_id = 'proc_7' and ptftri.pp_number = '$pp_number'";
  
          $result_for_greige= mysqli_query($con,$greige_period) or die(mysqli_error($con));
          while($row = mysqli_fetch_array($result_for_greige))  
          {  
              if($row['end_date']!= '') 
              {
                  $process_completion_date = $row['end_date'];
              }
  
              if($row_for_select_process["process_id"] == "proc_7")
              {
                  $Serial+=1;

                  $sql_for_ready_for_print = "select pp.pp_number, pp.version_name as version_number, pp.color, pp.style_name, pp.gw, pp.fw, pp.pp_quantity, result.after_trolley_or_batcher_qty, result.date, 
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
                  ptftri.pp_number = aptv.pp_number and ptftri.version_id = aptv.version_id and ptftri.style=aptv.style_name  and ptftri.process_name=aptv.process_name and ptftri.process_id = 'proc_7'
                   and ptftri.pp_number = '$pp_number')result 
                  
                  on pp.pp_number = result.pp_number and pp.version_id = result.version_id  order by result.date, pp.pp_number, pp.version_id, pp.color, pp.style_name, pp.gw, pp.fw";
                   
                  $result_for_ready_for_print = mysqli_query($con,$sql_for_ready_for_print) or die(mysqli_error($con));

                  $row_number_for_ready_for_print = mysqli_num_rows($result_for_ready_for_print);

                  $counter = $counter + ($row_number_for_ready_for_print * 8) + 10 + 10; 
  
                  if($counter>200)
                      {
                          $pdf->AddPage();
                          $pdf->SetLeftMargin(8);
                          $counter =30;
                          $counter = $counter + ($row_number_for_ready_for_print*8) + 10 + 10; 

                      } 

                  $pdf->SetFont('Arial','B',14);
                  $pdf->Ln(3);
                  $pdf->Cell(280,7,$Serial.'.'.'  '.'Ready for Print'.'   ('.$row["start_date"].' To '.$row["end_date"].')'.$pdf->SetFillColor(255,255,255),"0","1","L",true);
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
                  $pdf->MultiCell(28,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                  $pdf->SetXY($x + 49, $y);
                  $data = "Color";
                  strlen($data)<15?$b=10:$b=5;
                  $pdf->MultiCell(24,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                  $pdf->SetXY($x + 73, $y);
                  $data = "Style";
                  strlen($data)<15?$b=10:$b=5;
                  $pdf->MultiCell(24,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                  $pdf->SetXY($x + 97, $y);
                  $data = "Greige Width (inch)";
                  strlen($data)<10?$b=10:$b=5;
                  $pdf->MultiCell(21,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                  $pdf->SetXY($x + 118, $y);
                  $data = "Finish Width (inch)";
                  strlen($data)<10?$b=10:$b=5;
                  $pdf->MultiCell(21,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                  $pdf->SetXY($x + 139, $y);
                  $data = "Before Trolley No.";
                  strlen($data)<10?$b=10:$b=5;
                  $pdf->MultiCell(20,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                  $pdf->SetXY($x + 159, $y);
                  $data = "B. Process Qty (mtr.)";
                  strlen($data)<15?$b=10:$b=5;
                  $pdf->MultiCell(20,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                  $pdf->SetXY($x + 179, $y);
                  $data = "After Trolley No.";
                  strlen($data)<10?$b=10:$b=5;
                  $pdf->MultiCell(20,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                  $pdf->SetXY($x + 199, $y);
                  $data = "Process Qty (mtr.)";
                  strlen($data)<10?$b=10:$b=5;
                  $pdf->MultiCell(20,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                  $pdf->SetXY($x + 219, $y);
                  $data = "(+/-) From Prev. Process";
                  strlen($data)<10?$b=10:$b=5;
                  $pdf->MultiCell(41,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                  $pdf->SetXY($x + 219, $y+5);
                  $data = "Qty (mtr.)";
                  // strlen($data)<15?$b=10:$b=5;
                  $pdf->MultiCell(23,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                  $pdf->SetXY($x + 242, $y+5);
                  $data = "%";
                  // strlen($data)<15?$b=10:$b=5;
                  $pdf->MultiCell(18,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                  $pdf->SetXY($x + 260, $y);
                  $data = "Process / Reprocess";
                  strlen($data)<10?$b=10:$b=5;
                  $pdf->MultiCell(20,$b,"$data".$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                  // $pdf->SetXY($x + 194, $y);
  
                  $pdf->Cell(200,0,$pdf->SetFillColor(255,255,255),'1','1','c',true);
      
                  $pdf->SetFont('Arial','',9);
  

                                                  while($row = mysqli_fetch_array($result_for_ready_for_print))  
                                                  {
                                                      $x = $pdf->GetX();
                                                      $y = $pdf->GetY();
                                                      $data = $row['date'];
                                                      strlen($data)<20?$b=8:$b=4;
                                                      $pdf->MultiCell(21,$b,$data,'1','C');
                                                      $pdf->SetXY($x + 21, $y);
                                                      $data = $row['version_number'];
                                                      strlen($data)<16?$b=8:$b=4;
                                                      $pdf->MultiCell(28,$b,$data,'1','C');
                                                      $pdf->SetXY($x + 49, $y);
                                                      $data = $row['color'];
                                                      strlen($data)<20?$b=8:$b=4;
                                                      $pdf->MultiCell(24,$b,$data,'1','C');
                                                      $pdf->SetXY($x + 73, $y);
                                                      $data = $row['style_name'];
                                                      strlen($data)<10?$b=8:$b=4;
                                                      $pdf->MultiCell(24,$b,$data,'1','C');
                                                      $pdf->SetXY($x + 97, $y);
                                                      $data = $row['gw'];
                                                      strlen($data)<20?$b=8:$b=4;
                                                      $pdf->MultiCell(21,$b,$data,'1','C');
                                                      $pdf->SetXY($x + 118, $y);
                                                      $data = $row['fw'];
                                                      strlen($data)<20?$b=8:$b=4;
                                                      $pdf->MultiCell(21,$b,$data,'1','C');
                                                      $pdf->SetXY($x + 139, $y);
                                                      $data = $row['before_trolley_number_or_batcher_number'];
                                                      strlen($data)<20?$b=8:$b=4;
                                                      $pdf->MultiCell(20,$b,$data,'1','C');
                                                      $pdf->SetXY($x + 159, $y);
                                                      $data = $row['before_trolley_or_batcher_qty'];
                                                      strlen($data)<20?$b=8:$b=4;
                                                      $pdf->MultiCell(20,$b,$data,'1','C');
                                                      $pdf->SetXY($x + 179, $y);
                                                      $data = $row['after_trolley_number_or_batcher_number'];
                                                      strlen($data)<20?$b=8:$b=4;
                                                      $pdf->MultiCell(20,$b,$data,'1','C');
                                                      $pdf->SetXY($x + 199, $y);
                                                      $data = $row['after_trolley_or_batcher_qty'];
                                                      strlen($data)<20?$b=8:$b=4;
                                                      $pdf->MultiCell(20,$b,$data,'1','C');
                                                      $pdf->SetXY($x + 219, $y);
                                                      $data = $row['short_proc'];
                                                      strlen($data)<20?$b=8:$b=4;
                                                      $pdf->MultiCell(23,$b,$data,'1','C');
                                                      $pdf->SetXY($x + 242, $y);
                                                      $data = $row['short_percent'];
                                                      strlen($data)<20?$b=8:$b=4;
                                                      $pdf->MultiCell(18,$b,$data,'1','C');
                                                      $pdf->SetXY($x + 260, $y);
                                                      $data = $row['process_or_reprocess'];
                                                      strlen($data)<20?$b=8:$b=4;
                                                      $pdf->SetFont('Arial','',7);
                                                          $pdf->MultiCell(20,$b,$data,'1','C'); 
                                                          $pdf->SetFont('Arial','',9); 
                                                  }



                                          // Width summary for Ready for Print	

                                          $sql_for_ready_for_print_width = "select pp.pp_number, pp.gw, pp.fw, pp.pp_quantity, result.process_qty, result.before_process_qty, result.gray_process_qty,
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
                                         and ptftri.process_id = 'proc_7' and ptftri.pp_number = '$pp_number'
                                          group by ptftri.pp_number, pwvci.finish_width_in_inch, pwvci.greige_width_in_inch,ptftri.version_id )P
                                         where  1=1
                                         and ptftri_1.process_id = p.process_id
                                         and ptftri_1.pp_number = p.pp_number
                                         and ptftri_1.version_id = p.version_id
                                         and ptftri_1.partial_test_for_test_result_creation_date = p.max_date
                                         group by process_id,pp_number, fw,  gw)result 
                                         on pp.pp_number = result.pp_number and pp.fw = result.fw and pp.gw = result.gw 
                                         order by pp.pp_number, pp.gw, pp.fw";
                                          
                                          $result_for_ready_for_print_width= mysqli_query($con,$sql_for_ready_for_print_width) or die(mysqli_error($con));

                                          $row_number_for_ready_for_print_width = mysqli_num_rows($result_for_ready_for_print_width);

                                          $counter = $counter + ($row_number_for_ready_for_print_width*8) + 10 + 10; 
                            
                                            if($counter>200)
                                                {
                                                    $pdf->AddPage();
                                                    $pdf->SetLeftMargin(8);
                                                    $counter =30;
                                                    $counter = $counter + ($row_number_for_ready_for_print_width*8) + 10 + 10; 
                                                } 

                                          $pdf->SetFont('Arial','B',11);
                                          $pdf->Ln(3);
                                          $pdf->Cell(280,7,"Width Summary".$pdf->SetFillColor(220,220,220),"1","1","C",true);
                                          $pdf->SetFont('Arial','B',9);

                                          $x = $pdf->GetX();
                                          $y = $pdf->GetY();
                                          $data = "Greige Width (inch)";
                                          strlen($data)<15?$b=10:$b=5;
                                          $pdf->MultiCell(30,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                          $pdf->SetXY($x + 30, $y);
                                          $data = "Finish Width (inch)";
                                          strlen($data)<15?$b=10:$b=5;
                                          $pdf->MultiCell(30,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                          $pdf->SetXY($x + 60, $y);
                                          $data = "PP Quantity. (mtr.)";
                                          strlen($data)<25?$b=10:$b=5;
                                          $pdf->MultiCell(32,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                          $pdf->SetXY($x + 92, $y);
                                          $data = "Before Process Quantity (mtr.)";
                                          strlen($data)<25?$b=10:$b=5;
                                          $pdf->MultiCell(33,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                          $pdf->SetXY($x + 125, $y);
                                          $data = "Process Quantity. (mtr.)";
                                          strlen($data)<15?$b=10:$b=5;
                                          $pdf->MultiCell(32,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                          $pdf->SetXY($x + 157, $y);
                                          $data = "(+/-) From PP";
                                          // strlen($data)<15?$b=10:$b=5;
                                          $pdf->MultiCell(41,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                          $pdf->SetXY($x + 157, $y+5);
                                          $data = "Qty (mtr.)";
                                          // strlen($data)<15?$b=10:$b=5;
                                          $pdf->MultiCell(23,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                          $pdf->SetXY($x + 180, $y+5);
                                          $data = "%";
                                          // strlen($data)<15?$b=10:$b=5;
                                          $pdf->MultiCell(18,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                          $pdf->SetXY($x + 198, $y);
                                          $data = "(+/-) From Greige";
                                          // strlen($data)<15?$b=10:$b=5;
                                          $pdf->MultiCell(41,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                          $pdf->SetXY($x + 198, $y+5);
                                          $data = "Qty (mtr.)";
                                          // strlen($data)<15?$b=10:$b=5;
                                          $pdf->MultiCell(23,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                          $pdf->SetXY($x + 221, $y+5);
                                          $data = "%";
                                          // strlen($data)<15?$b=10:$b=5;
                                          $pdf->MultiCell(18,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                          $pdf->SetXY($x + 239, $y);
                                          $data = "(+/-) From Prev. Process";
                                          // strlen($data)<15?$b=10:$b=5;
                                          $pdf->MultiCell(41,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                          $pdf->SetXY($x + 239, $y+5);
                                          $data = "Qty (mtr.)";
                                          // strlen($data)<15?$b=10:$b=5;
                                          $pdf->MultiCell(23,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                          $pdf->SetXY($x + 262, $y+5);
                                          $data = "%";
                                          // strlen($data)<15?$b=10:$b=5;
                                          $pdf->MultiCell(18,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                          $pdf->SetXY($x + 280, $y);
                                          
                                          // $pdf->Cell(0,0,$pdf->SetFillColor(255,255,255),'1','1','C',true);
                                          $pdf->SetFont('Arial','',9);       
                                           $pdf->Ln(10);
                                         
                                          
                                      while($row = mysqli_fetch_array($result_for_ready_for_print_width))  
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
                                          $pdf->MultiCell(32,$b,$data,'1','C');
                                          $pdf->SetXY($x + 92, $y);
                                          $data = $row['before_process_qty'];
                                          strlen($data)<20?$b=8:$b=4;
                                          $pdf->MultiCell(33,$b,$data,'1','C');
                                          $pdf->SetXY($x + 125, $y);
                                          $data = $row['process_qty'];
                                          strlen($data)<20?$b=8:$b=4;
                                          $pdf->MultiCell(32,$b,$data,'1','C');
                                          $pdf->SetXY($x + 157, $y);
                                          $data = $row['short_pp_qty'];
                                          strlen($data)<15?$b=8:$b=4;
                                          $pdf->MultiCell(23,$b,$data,'1','C');
                                          $pdf->SetXY($x + 180, $y);
                                          $data = $row['short_pp_percent'];
                                          strlen($data)<15?$b=8:$b=4;
                                          $pdf->MultiCell(18,$b,$data,'1','C');
                                          $pdf->SetXY($x + 198, $y);
                                          $data = $row['short_gre_rcv_qty'];
                                          strlen($data)<15?$b=8:$b=4;
                                          $pdf->MultiCell(23,$b,$data,'1','C');
                                          $pdf->SetXY($x + 221, $y);
                                          $data = $row['short_gre_rcv_percent'];
                                          strlen($data)<15?$b=8:$b=4;
                                          $pdf->MultiCell(18,$b,$data,'1','C');
                                          $pdf->SetXY($x + 239, $y);
                                          $data = $row['short_pre_proc_qty'];
                                          strlen($data)<15?$b=8:$b=4;
                                          $pdf->MultiCell(23,$b,$data,'1','C');
                                          $pdf->SetXY($x + 262, $y);
                                          $data = $row['short_pre_proc_percent'];
                                          strlen($data)<15?$b=8:$b=4;
                                          $pdf->MultiCell(18,$b,$data,'1','C');
                                          // $pdf->SetXY($x + 200, $y);

                                      }
                                          // Version summary for Ready for Print

                                           $sql_for_ready_for_print_version = "select pp.pp_number, pp.version_name version_number, pp.style_name, pp.color, pp.gw, pp.fw, pp.pp_quantity, result.process_qty, result.before_process_qty, result.gray_process_qty, 
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
                                           and ptftri.process_id = 'proc_7' and ptftri.pp_number = '$pp_number'
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

                                            $result_for_ready_for_print_version= mysqli_query($con,$sql_for_ready_for_print_version) or die(mysqli_error($con));

                                            $row_number_for_ready_for_print_version = mysqli_num_rows($result_for_ready_for_print_version);

                                            $counter = $counter + ($row_number_for_ready_for_print_version*8) + 10 + 10 + 8; 
                            
                                            if($counter>200)
                                                {
                                                    $pdf->AddPage();
                                                    $pdf->SetLeftMargin(8);
                                                    $counter =30;
                                                    $counter = $counter + ($row_number_for_ready_for_print_version*8) + 10 + 10 + 8; 
                                                } 

                                            $pdf->SetFont('Arial','B',11);
                                            $pdf->Ln(3);
                                            $pdf->Cell(280,7,"Version Summary".$pdf->SetFillColor(220,220,220),"1","1","C",true);
                                            $pdf->SetFont('Arial','B',9);

                                          $x = $pdf->GetX();
                                          $y = $pdf->GetY();
                                          $data = "Version";
                                          strlen($data)<15?$b=10:$b=5;
                                          $pdf->MultiCell(28,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                          $pdf->SetXY($x + 28, $y);
                                          $data = "Color";
                                          strlen($data)<15?$b=10:$b=5;
                                          $pdf->MultiCell(24,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                          $pdf->SetXY($x + 52, $y);
                                          $data = "Style";
                                          strlen($data)<15?$b=10:$b=5;
                                          $pdf->MultiCell(24,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                          $pdf->SetXY($x + 76, $y);
                                          $data = "PP Quantity (mtr.)";
                                          strlen($data)<15?$b=10:$b=5;
                                          $pdf->MultiCell(27,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                          $pdf->SetXY($x + 103, $y);
                                          $data = "Before process Qty (mtr.)";
                                          strlen($data)<20?$b=10:$b=5;
                                          $pdf->MultiCell(27,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                          $pdf->SetXY($x + 130, $y);
                                          $data = "Process Quantity (mtr.)";
                                          strlen($data)<20?$b=10:$b=5;
                                          $pdf->MultiCell(27,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                          $pdf->SetXY($x + 157, $y);
                                          $data = "(+/-) From PP";
                                          // strlen($data)<15?$b=10:$b=5;
                                          $pdf->MultiCell(41,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                          $pdf->SetXY($x + 157, $y+5);
                                          $data = "Qty (mtr.)";
                                          // strlen($data)<15?$b=10:$b=5;
                                          $pdf->MultiCell(23,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                          $pdf->SetXY($x + 180, $y+5);
                                          $data = "%";
                                          // strlen($data)<15?$b=10:$b=5;
                                          $pdf->MultiCell(18,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                          $pdf->SetXY($x + 198, $y);
                                          $data = "(+/-) From Greige";
                                          // strlen($data)<15?$b=10:$b=5;
                                          $pdf->MultiCell(41,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                          $pdf->SetXY($x + 198, $y+5);
                                          $data = "Qty (mtr.)";
                                          // strlen($data)<15?$b=10:$b=5;
                                          $pdf->MultiCell(23,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                          $pdf->SetXY($x + 221, $y+5);
                                          $data = "%";
                                          // strlen($data)<15?$b=10:$b=5;
                                          $pdf->MultiCell(18,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                          $pdf->SetXY($x + 239, $y);
                                          $data = "(+/-) From Prev. Process";
                                          // strlen($data)<15?$b=10:$b=5;
                                          $pdf->MultiCell(41,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                          $pdf->SetXY($x + 239, $y+5);
                                          $data = "Qty (mtr.)";
                                          // strlen($data)<15?$b=10:$b=5;
                                          $pdf->MultiCell(23,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                          $pdf->SetXY($x + 262, $y+5);
                                          $data = "%";
                                          // strlen($data)<15?$b=10:$b=5;
                                          $pdf->MultiCell(18,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                          $pdf->SetXY($x + 280, $y);
                                          
                                          // $pdf->Cell(0,0,$pdf->SetFillColor(255,255,255),'1','1','C',true);
                                          $pdf->SetFont('Arial','',9);       
                                           $pdf->Ln(10);
              
                                    while($row = mysqli_fetch_array($result_for_ready_for_print_version))  
                                    {  
                                        $x = $pdf->GetX();
                                        $y = $pdf->GetY();
                                        $data = $row['version_number'];
                                        strlen($data)<16?$b=8:$b=4;
                                        $pdf->MultiCell(28,$b,$data,'1','C');
                                        $pdf->SetXY($x + 28, $y);
                                        $data = $row['color'];
                                        strlen($data)<20?$b=8:$b=4;
                                        $pdf->MultiCell(24,$b,$data,'1','C');
                                        $pdf->SetXY($x + 52, $y);
                                        $data = $row['style_name'];
                                        strlen($data)<10?$b=8:$b=4;
                                        $pdf->MultiCell(24,$b,$data,'1','C');
                                        $pdf->SetXY($x + 76, $y);
                                        $data = $row['pp_quantity'];
                                        strlen($data)<20?$b=8:$b=4;
                                        $pdf->MultiCell(27,$b,$data,'1','C');
                                        $pdf->SetXY($x + 103, $y);
                                        $data = $row['before_process_qty'];
                                        strlen($data)<20?$b=8:$b=4;
                                        $pdf->MultiCell(27,$b,$data,'1','C');
                                        $pdf->SetXY($x + 130, $y);
                                        $data = $row['process_qty'];
                                        strlen($data)<20?$b=8:$b=4;
                                        $pdf->MultiCell(27,$b,$data,'1','C');
                                        $pdf->SetXY($x + 157, $y);
                                        $data = $row['short_pp'];
                                        strlen($data)<15?$b=8:$b=4;
                                        $pdf->MultiCell(23,$b,$data,'1','C');
                                        $pdf->SetXY($x + 180, $y);
                                        $data = $row['short_pp_percent'];
                                        strlen($data)<15?$b=8:$b=4;
                                        $pdf->MultiCell(18,$b,$data,'1','C');
                                        $pdf->SetXY($x + 198, $y);
                                        $data = $row['short_gre_rcv_qty'];
                                        strlen($data)<15?$b=8:$b=4;
                                        $pdf->MultiCell(23,$b,$data,'1','C');
                                        $pdf->SetXY($x + 221, $y);
                                        $data = $row['short_gre_rcv_percent'];
                                        strlen($data)<15?$b=8:$b=4;
                                        $pdf->MultiCell(18,$b,$data,'1','C');
                                        $pdf->SetXY($x + 239, $y);
                                        $data = $row['short_pre_proc_qty'];
                                        strlen($data)<15?$b=8:$b=4;
                                        $pdf->MultiCell(23,$b,$data,'1','C');
                                        $pdf->SetXY($x + 262, $y);
                                        $data = $row['short_pre_proc_percent'];
                                        strlen($data)<15?$b=8:$b=4;
                                        $pdf->MultiCell(18,$b,$data,'1','C');
                                        // $pdf->SetXY($x + 280, $y);

                                    }

                                    $sql_for_ready_for_print_total = "select total.pp_number, sum(total.pp_quantity) pp_quantity, sum(total.process_qty) process_qty, 
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
                                    and ptftri.process_id = 'proc_7' and ptftri.pp_number = '$pp_number'
                                    group by ptftri.pp_number, ptftri.version_number, ptftri.finish_width_in_inch )P
                                    where  1=1
                                    and ptftri_1.process_id = p.process_id
                                    and ptftri_1.pp_number = p.pp_number
                                    and ptftri_1.version_number = p.version_name
                                    and ptftri_1.partial_test_for_test_result_creation_date = p.max_date
                                    and ptftri_1.finish_width_in_inch = p.finish_width_in_inch
                                    group by process_id,pp_number, version_name)result where pp.pp_number = result.pp_number and pp.version_name = result.version_name ) total";

                                  $result_for_ready_for_print_total= mysqli_query($con,$sql_for_ready_for_print_total) or die(mysqli_error($con));
                                  while($row = mysqli_fetch_array($result_for_ready_for_print_total))  
                                  {
                                      $pdf->SetFont('Arial','B',9); 
                                      $x = $pdf->GetX();
                                      $y = $pdf->GetY();
                                      $data = "Ready for Print Total Qty. (mtr.)";
                                      strlen($data)<70?$b=8:$b=4;
                                      $pdf->MultiCell(76,$b,$data,'1','C');
                                      $pdf->SetXY($x + 76, $y);
                                      $data = $row['pp_quantity'];
                                      strlen($data)<20?$b=8:$b=4;
                                      $pdf->MultiCell(27,$b,$data,'1','C');
                                      $pdf->SetXY($x + 103, $y);
                                      $data = $row['before_process_qty'];
                                      strlen($data)<20?$b=8:$b=4;
                                      $pdf->MultiCell(27,$b,$data,'1','C');
                                      $pdf->SetXY($x + 130, $y);
                                      $data = $row['process_qty'];
                                      strlen($data)<20?$b=8:$b=4;
                                      $pdf->MultiCell(27,$b,$data,'1','C');
                                      $pdf->SetXY($x + 157, $y);
                                      $data = $row['short_pp_qty'];
                                      strlen($data)<20?$b=8:$b=4;
                                      $pdf->MultiCell(23,$b,$data,'1','C');
                                      $pdf->SetXY($x + 180, $y);
                                      $data = $row['short_pp_percent'];
                                      strlen($data)<20?$b=8:$b=4;
                                      $pdf->MultiCell(18,$b,$data,'1','C'); 
                                      $pdf->SetXY($x + 198, $y); 
                                      $data = $row['short_gre_rcv_qty'];
                                      strlen($data)<20?$b=8:$b=4;
                                      $pdf->MultiCell(23,$b,$data,'1','C');
                                      $pdf->SetXY($x + 221, $y);
                                      $data = $row['short_gre_rcv_percent'];
                                      strlen($data)<20?$b=8:$b=4;
                                      $pdf->MultiCell(18,$b,$data,'1','C');
                                      $pdf->SetXY($x + 239, $y); 
                                      $data = $row['short_pre_proc_qty'];
                                      strlen($data)<20?$b=8:$b=4;
                                      $pdf->MultiCell(23,$b,$data,'1','C');
                                      $pdf->SetXY($x + 262, $y);
                                      $data = $row['short_pre_proc_percent'];
                                      strlen($data)<20?$b=8:$b=4;
                                      $pdf->MultiCell(18,$b,$data,'1','C');  

                                      if($row['short_excess_qty']!= '') 
                                          {
                                              $process_loss_gain+=$row['short_excess_qty'];
                                          }
                              
                                          $Total_pp_quantity = $row['pp_quantity'];
                                          $Total_greige_quantity = $row['process_qty'];
                                   
                                  }

              }
            }


                    
          /*************************************************  Printing (Process No- 8) ***************************************************/

          $greige_period = "select ptftri.pp_number, ptftri.process_id, date_format(min(ptftri.partial_test_for_test_result_creation_date), '%d-%b-%Y') start_date,
        date_format(max(ptftri.partial_test_for_test_result_creation_date), '%d-%b-%Y') end_date
        from partial_test_for_test_result_info  ptftri where  ptftri.process_id = 'proc_8' and ptftri.pp_number = '$pp_number'";
  
          $result_for_greige= mysqli_query($con,$greige_period) or die(mysqli_error($con));
          while($row = mysqli_fetch_array($result_for_greige))  
          {  
              if($row['end_date']!= '') 
              {
                  $process_completion_date = $row['end_date'];
              }
  
              if($row_for_select_process["process_id"] == "proc_8")
              {
                  $Serial+=1;

                  $sql_for_printing = "select pp.pp_number, pp.version_name as version_number, pp.color, pp.style_name, pp.gw, pp.fw, pp.pp_quantity, result.after_trolley_or_batcher_qty, result.date, 
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
                  ptftri.pp_number = aptv.pp_number and ptftri.version_id = aptv.version_id and ptftri.style=aptv.style_name  and ptftri.process_name=aptv.process_name and ptftri.process_id = 'proc_8'
                   and ptftri.pp_number = '$pp_number')result 
                  
                  on pp.pp_number = result.pp_number and pp.version_id = result.version_id  order by result.date, pp.pp_number, pp.version_id, pp.color, pp.style_name, pp.gw, pp.fw";
                   
                  $result_for_printing = mysqli_query($con,$sql_for_printing) or die(mysqli_error($con));

                  $row_number_for_printing = mysqli_num_rows($result_for_printing);

                  $counter = $counter + ($row_number_for_printing * 8) + 10 + 10; 
  
                  if($counter>200)
                      {
                          $pdf->AddPage();
                          $pdf->SetLeftMargin(8);
                          $counter =30;
                          $counter = $counter + ($row_number_for_printing * 8) + 10 + 10; 

                      } 

                  $pdf->SetFont('Arial','B',14);
                  $pdf->Ln(3);
                  $pdf->Cell(280,7,$Serial.'.'.'  '.'Printing'.'   ('.$row["start_date"].' To '.$row["end_date"].')'.$pdf->SetFillColor(255,255,255),"0","1","L",true);
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
                  $pdf->MultiCell(28,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                  $pdf->SetXY($x + 49, $y);
                  $data = "Color";
                  strlen($data)<15?$b=10:$b=5;
                  $pdf->MultiCell(24,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                  $pdf->SetXY($x + 73, $y);
                  $data = "Style";
                  strlen($data)<15?$b=10:$b=5;
                  $pdf->MultiCell(24,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                  $pdf->SetXY($x + 97, $y);
                  $data = "Greige Width (inch)";
                  strlen($data)<10?$b=10:$b=5;
                  $pdf->MultiCell(21,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                  $pdf->SetXY($x + 118, $y);
                  $data = "Finish Width (inch)";
                  strlen($data)<10?$b=10:$b=5;
                  $pdf->MultiCell(21,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                  $pdf->SetXY($x + 139, $y);
                  $data = "Before Trolley No.";
                  strlen($data)<10?$b=10:$b=5;
                  $pdf->MultiCell(20,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                  $pdf->SetXY($x + 159, $y);
                  $data = "B. Process Qty (mtr.)";
                  strlen($data)<15?$b=10:$b=5;
                  $pdf->MultiCell(20,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                  $pdf->SetXY($x + 179, $y);
                  $data = "After Trolley No.";
                  strlen($data)<10?$b=10:$b=5;
                  $pdf->MultiCell(20,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                  $pdf->SetXY($x + 199, $y);
                  $data = "Process Qty (mtr.)";
                  strlen($data)<10?$b=10:$b=5;
                  $pdf->MultiCell(20,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                  $pdf->SetXY($x + 219, $y);
                  $data = "(+/-) From Prev. Process";
                  strlen($data)<10?$b=10:$b=5;
                  $pdf->MultiCell(41,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                  $pdf->SetXY($x + 219, $y+5);
                  $data = "Qty (mtr.)";
                  // strlen($data)<15?$b=10:$b=5;
                  $pdf->MultiCell(23,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                  $pdf->SetXY($x + 242, $y+5);
                  $data = "%";
                  // strlen($data)<15?$b=10:$b=5;
                  $pdf->MultiCell(18,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                  $pdf->SetXY($x + 260, $y);
                  $data = "Process / Reprocess";
                  strlen($data)<10?$b=10:$b=5;
                  $pdf->MultiCell(20,$b,"$data".$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                  // $pdf->SetXY($x + 194, $y);
  
                  $pdf->Cell(200,0,$pdf->SetFillColor(255,255,255),'1','1','c',true);
      
                  $pdf->SetFont('Arial','',9);
  

                                                  while($row = mysqli_fetch_array($result_for_printing))  
                                                  {
                                                      $x = $pdf->GetX();
                                                      $y = $pdf->GetY();
                                                      $data = $row['date'];
                                                      strlen($data)<20?$b=8:$b=4;
                                                      $pdf->MultiCell(21,$b,$data,'1','C');
                                                      $pdf->SetXY($x + 21, $y);
                                                      $data = $row['version_number'];
                                                      strlen($data)<16?$b=8:$b=4;
                                                      $pdf->MultiCell(28,$b,$data,'1','C');
                                                      $pdf->SetXY($x + 49, $y);
                                                      $data = $row['color'];
                                                      strlen($data)<20?$b=8:$b=4;
                                                      $pdf->MultiCell(24,$b,$data,'1','C');
                                                      $pdf->SetXY($x + 73, $y);
                                                      $data = $row['style_name'];
                                                      strlen($data)<10?$b=8:$b=4;
                                                      $pdf->MultiCell(24,$b,$data,'1','C');
                                                      $pdf->SetXY($x + 97, $y);
                                                      $data = $row['gw'];
                                                      strlen($data)<20?$b=8:$b=4;
                                                      $pdf->MultiCell(21,$b,$data,'1','C');
                                                      $pdf->SetXY($x + 118, $y);
                                                      $data = $row['fw'];
                                                      strlen($data)<20?$b=8:$b=4;
                                                      $pdf->MultiCell(21,$b,$data,'1','C');
                                                      $pdf->SetXY($x + 139, $y);
                                                      $data = $row['before_trolley_number_or_batcher_number'];
                                                      strlen($data)<20?$b=8:$b=4;
                                                      $pdf->MultiCell(20,$b,$data,'1','C');
                                                      $pdf->SetXY($x + 159, $y);
                                                      $data = $row['before_trolley_or_batcher_qty'];
                                                      strlen($data)<20?$b=8:$b=4;
                                                      $pdf->MultiCell(20,$b,$data,'1','C');
                                                      $pdf->SetXY($x + 179, $y);
                                                      $data = $row['after_trolley_number_or_batcher_number'];
                                                      strlen($data)<20?$b=8:$b=4;
                                                      $pdf->MultiCell(20,$b,$data,'1','C');
                                                      $pdf->SetXY($x + 199, $y);
                                                      $data = $row['after_trolley_or_batcher_qty'];
                                                      strlen($data)<20?$b=8:$b=4;
                                                      $pdf->MultiCell(20,$b,$data,'1','C');
                                                      $pdf->SetXY($x + 219, $y);
                                                      $data = $row['short_proc'];
                                                      strlen($data)<20?$b=8:$b=4;
                                                      $pdf->MultiCell(23,$b,$data,'1','C');
                                                      $pdf->SetXY($x + 242, $y);
                                                      $data = $row['short_percent'];
                                                      strlen($data)<20?$b=8:$b=4;
                                                      $pdf->MultiCell(18,$b,$data,'1','C');
                                                      $pdf->SetXY($x + 260, $y);
                                                      $data = $row['process_or_reprocess'];
                                                      strlen($data)<20?$b=8:$b=4;
                                                      $pdf->SetFont('Arial','',7);
                                                          $pdf->MultiCell(20,$b,$data,'1','C'); 
                                                          $pdf->SetFont('Arial','',9); 
                                                  }



                                          // Width summary for Printing

                                          $sql_for_printing_width = "select pp.pp_number, pp.gw, pp.fw, pp.pp_quantity, result.process_qty, result.before_process_qty, result.gray_process_qty,
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
                                         and ptftri.process_id = 'proc_8' and ptftri.pp_number = '$pp_number'
                                          group by ptftri.pp_number, pwvci.finish_width_in_inch, pwvci.greige_width_in_inch,ptftri.version_id )P
                                         where  1=1
                                         and ptftri_1.process_id = p.process_id
                                         and ptftri_1.pp_number = p.pp_number
                                         and ptftri_1.version_id = p.version_id
                                         and ptftri_1.partial_test_for_test_result_creation_date = p.max_date
                                         group by process_id,pp_number, fw,  gw)result 
                                         on pp.pp_number = result.pp_number and pp.fw = result.fw and pp.gw = result.gw 
                                         order by pp.pp_number, pp.gw, pp.fw";
                                          
                                          $result_for_printing_width= mysqli_query($con,$sql_for_printing_width) or die(mysqli_error($con));

                                          $row_number_for_printing_width = mysqli_num_rows($result_for_printing_width);

                                          $counter = $counter + ($row_number_for_printing_width*8) + 10 + 10; 
                            
                                            if($counter>200)
                                                {
                                                    $pdf->AddPage();
                                                    $pdf->SetLeftMargin(8);
                                                    $counter =30;
                                                    $counter = $counter + ($row_number_for_printing_width*8) + 10 + 10; 
                                                } 

                                          $pdf->SetFont('Arial','B',11);
                                          $pdf->Ln(3);
                                          $pdf->Cell(280,7,"Width Summary".$pdf->SetFillColor(220,220,220),"1","1","C",true);
                                          $pdf->SetFont('Arial','B',9);

                                          $x = $pdf->GetX();
                                          $y = $pdf->GetY();
                                          $data = "Greige Width (inch)";
                                          strlen($data)<15?$b=10:$b=5;
                                          $pdf->MultiCell(30,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                          $pdf->SetXY($x + 30, $y);
                                          $data = "Finish Width (inch)";
                                          strlen($data)<15?$b=10:$b=5;
                                          $pdf->MultiCell(30,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                          $pdf->SetXY($x + 60, $y);
                                          $data = "PP Quantity. (mtr.)";
                                          strlen($data)<25?$b=10:$b=5;
                                          $pdf->MultiCell(32,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                          $pdf->SetXY($x + 92, $y);
                                          $data = "Before Process Quantity (mtr.)";
                                          strlen($data)<25?$b=10:$b=5;
                                          $pdf->MultiCell(33,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                          $pdf->SetXY($x + 125, $y);
                                          $data = "Process Quantity. (mtr.)";
                                          strlen($data)<15?$b=10:$b=5;
                                          $pdf->MultiCell(32,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                          $pdf->SetXY($x + 157, $y);
                                          $data = "(+/-) From PP";
                                          // strlen($data)<15?$b=10:$b=5;
                                          $pdf->MultiCell(41,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                          $pdf->SetXY($x + 157, $y+5);
                                          $data = "Qty (mtr.)";
                                          // strlen($data)<15?$b=10:$b=5;
                                          $pdf->MultiCell(23,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                          $pdf->SetXY($x + 180, $y+5);
                                          $data = "%";
                                          // strlen($data)<15?$b=10:$b=5;
                                          $pdf->MultiCell(18,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                          $pdf->SetXY($x + 198, $y);
                                          $data = "(+/-) From Greige";
                                          // strlen($data)<15?$b=10:$b=5;
                                          $pdf->MultiCell(41,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                          $pdf->SetXY($x + 198, $y+5);
                                          $data = "Qty (mtr.)";
                                          // strlen($data)<15?$b=10:$b=5;
                                          $pdf->MultiCell(23,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                          $pdf->SetXY($x + 221, $y+5);
                                          $data = "%";
                                          // strlen($data)<15?$b=10:$b=5;
                                          $pdf->MultiCell(18,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                          $pdf->SetXY($x + 239, $y);
                                          $data = "(+/-) From Prev. Process";
                                          // strlen($data)<15?$b=10:$b=5;
                                          $pdf->MultiCell(41,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                          $pdf->SetXY($x + 239, $y+5);
                                          $data = "Qty (mtr.)";
                                          // strlen($data)<15?$b=10:$b=5;
                                          $pdf->MultiCell(23,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                          $pdf->SetXY($x + 262, $y+5);
                                          $data = "%";
                                          // strlen($data)<15?$b=10:$b=5;
                                          $pdf->MultiCell(18,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                          $pdf->SetXY($x + 280, $y);
                                          
                                          // $pdf->Cell(0,0,$pdf->SetFillColor(255,255,255),'1','1','C',true);
                                          $pdf->SetFont('Arial','',9);       
                                           $pdf->Ln(10);
                                         
                                          
                                      while($row = mysqli_fetch_array($result_for_printing_width))  
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
                                          $pdf->MultiCell(32,$b,$data,'1','C');
                                          $pdf->SetXY($x + 92, $y);
                                          $data = $row['before_process_qty'];
                                          strlen($data)<20?$b=8:$b=4;
                                          $pdf->MultiCell(33,$b,$data,'1','C');
                                          $pdf->SetXY($x + 125, $y);
                                          $data = $row['process_qty'];
                                          strlen($data)<20?$b=8:$b=4;
                                          $pdf->MultiCell(32,$b,$data,'1','C');
                                          $pdf->SetXY($x + 157, $y);
                                          $data = $row['short_pp_qty'];
                                          strlen($data)<15?$b=8:$b=4;
                                          $pdf->MultiCell(23,$b,$data,'1','C');
                                          $pdf->SetXY($x + 180, $y);
                                          $data = $row['short_pp_percent'];
                                          strlen($data)<15?$b=8:$b=4;
                                          $pdf->MultiCell(18,$b,$data,'1','C');
                                          $pdf->SetXY($x + 198, $y);
                                          $data = $row['short_gre_rcv_qty'];
                                          strlen($data)<15?$b=8:$b=4;
                                          $pdf->MultiCell(23,$b,$data,'1','C');
                                          $pdf->SetXY($x + 221, $y);
                                          $data = $row['short_gre_rcv_percent'];
                                          strlen($data)<15?$b=8:$b=4;
                                          $pdf->MultiCell(18,$b,$data,'1','C');
                                          $pdf->SetXY($x + 239, $y);
                                          $data = $row['short_pre_proc_qty'];
                                          strlen($data)<15?$b=8:$b=4;
                                          $pdf->MultiCell(23,$b,$data,'1','C');
                                          $pdf->SetXY($x + 262, $y);
                                          $data = $row['short_pre_proc_percent'];
                                          strlen($data)<15?$b=8:$b=4;
                                          $pdf->MultiCell(18,$b,$data,'1','C');
                                          // $pdf->SetXY($x + 200, $y);

                                      }
                                          // Version summary for Printing

                                           $sql_for_printing_version = "select pp.pp_number, pp.version_name version_number, pp.style_name, pp.color, pp.gw, pp.fw, pp.pp_quantity, result.process_qty, result.before_process_qty, result.gray_process_qty, 
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
                                           and ptftri.process_id = 'proc_8' and ptftri.pp_number = '$pp_number'
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

                                            $result_for_printing_version= mysqli_query($con,$sql_for_printing_version) or die(mysqli_error($con));

                                            $row_number_for_printing_version = mysqli_num_rows($result_for_printing_version);

                                            $counter = $counter + ($row_number_for_printing_version*8) + 10 + 10 + 8; 
                            
                                            if($counter>200)
                                                {
                                                    $pdf->AddPage();
                                                    $pdf->SetLeftMargin(8);
                                                    $counter =30;
                                                    $counter = $counter + ($row_number_for_printing_version*8) + 10 + 10 + 8; 
                                                } 

                                            $pdf->SetFont('Arial','B',11);
                                            $pdf->Ln(3);
                                            $pdf->Cell(280,7,"Version Summary".$pdf->SetFillColor(220,220,220),"1","1","C",true);
                                            $pdf->SetFont('Arial','B',9);

                                          $x = $pdf->GetX();
                                          $y = $pdf->GetY();
                                          $data = "Version";
                                          strlen($data)<15?$b=10:$b=5;
                                          $pdf->MultiCell(28,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                          $pdf->SetXY($x + 28, $y);
                                          $data = "Color";
                                          strlen($data)<15?$b=10:$b=5;
                                          $pdf->MultiCell(24,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                          $pdf->SetXY($x + 52, $y);
                                          $data = "Style";
                                          strlen($data)<15?$b=10:$b=5;
                                          $pdf->MultiCell(24,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                          $pdf->SetXY($x + 76, $y);
                                          $data = "PP Quantity (mtr.)";
                                          strlen($data)<15?$b=10:$b=5;
                                          $pdf->MultiCell(27,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                          $pdf->SetXY($x + 103, $y);
                                          $data = "Before process Qty (mtr.)";
                                          strlen($data)<20?$b=10:$b=5;
                                          $pdf->MultiCell(27,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                          $pdf->SetXY($x + 130, $y);
                                          $data = "Process Quantity (mtr.)";
                                          strlen($data)<20?$b=10:$b=5;
                                          $pdf->MultiCell(27,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                          $pdf->SetXY($x + 157, $y);
                                          $data = "(+/-) From PP";
                                          // strlen($data)<15?$b=10:$b=5;
                                          $pdf->MultiCell(41,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                          $pdf->SetXY($x + 157, $y+5);
                                          $data = "Qty (mtr.)";
                                          // strlen($data)<15?$b=10:$b=5;
                                          $pdf->MultiCell(23,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                          $pdf->SetXY($x + 180, $y+5);
                                          $data = "%";
                                          // strlen($data)<15?$b=10:$b=5;
                                          $pdf->MultiCell(18,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                          $pdf->SetXY($x + 198, $y);
                                          $data = "(+/-) From Greige";
                                          // strlen($data)<15?$b=10:$b=5;
                                          $pdf->MultiCell(41,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                          $pdf->SetXY($x + 198, $y+5);
                                          $data = "Qty (mtr.)";
                                          // strlen($data)<15?$b=10:$b=5;
                                          $pdf->MultiCell(23,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                          $pdf->SetXY($x + 221, $y+5);
                                          $data = "%";
                                          // strlen($data)<15?$b=10:$b=5;
                                          $pdf->MultiCell(18,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                          $pdf->SetXY($x + 239, $y);
                                          $data = "(+/-) From Prev. Process";
                                          // strlen($data)<15?$b=10:$b=5;
                                          $pdf->MultiCell(41,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                          $pdf->SetXY($x + 239, $y+5);
                                          $data = "Qty (mtr.)";
                                          // strlen($data)<15?$b=10:$b=5;
                                          $pdf->MultiCell(23,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                          $pdf->SetXY($x + 262, $y+5);
                                          $data = "%";
                                          // strlen($data)<15?$b=10:$b=5;
                                          $pdf->MultiCell(18,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                          $pdf->SetXY($x + 280, $y);
                                          
                                          // $pdf->Cell(0,0,$pdf->SetFillColor(255,255,255),'1','1','C',true);
                                          $pdf->SetFont('Arial','',9);       
                                           $pdf->Ln(10);
              
                                    while($row = mysqli_fetch_array($result_for_printing_version))  
                                    {  
                                        $x = $pdf->GetX();
                                        $y = $pdf->GetY();
                                        $data = $row['version_number'];
                                        strlen($data)<16?$b=8:$b=4;
                                        $pdf->MultiCell(28,$b,$data,'1','C');
                                        $pdf->SetXY($x + 28, $y);
                                        $data = $row['color'];
                                        strlen($data)<20?$b=8:$b=4;
                                        $pdf->MultiCell(24,$b,$data,'1','C');
                                        $pdf->SetXY($x + 52, $y);
                                        $data = $row['style_name'];
                                        strlen($data)<10?$b=8:$b=4;
                                        $pdf->MultiCell(24,$b,$data,'1','C');
                                        $pdf->SetXY($x + 76, $y);
                                        $data = $row['pp_quantity'];
                                        strlen($data)<20?$b=8:$b=4;
                                        $pdf->MultiCell(27,$b,$data,'1','C');
                                        $pdf->SetXY($x + 103, $y);
                                        $data = $row['before_process_qty'];
                                        strlen($data)<20?$b=8:$b=4;
                                        $pdf->MultiCell(27,$b,$data,'1','C');
                                        $pdf->SetXY($x + 130, $y);
                                        $data = $row['process_qty'];
                                        strlen($data)<20?$b=8:$b=4;
                                        $pdf->MultiCell(27,$b,$data,'1','C');
                                        $pdf->SetXY($x + 157, $y);
                                        $data = $row['short_pp'];
                                        strlen($data)<15?$b=8:$b=4;
                                        $pdf->MultiCell(23,$b,$data,'1','C');
                                        $pdf->SetXY($x + 180, $y);
                                        $data = $row['short_pp_percent'];
                                        strlen($data)<15?$b=8:$b=4;
                                        $pdf->MultiCell(18,$b,$data,'1','C');
                                        $pdf->SetXY($x + 198, $y);
                                        $data = $row['short_gre_rcv_qty'];
                                        strlen($data)<15?$b=8:$b=4;
                                        $pdf->MultiCell(23,$b,$data,'1','C');
                                        $pdf->SetXY($x + 221, $y);
                                        $data = $row['short_gre_rcv_percent'];
                                        strlen($data)<15?$b=8:$b=4;
                                        $pdf->MultiCell(18,$b,$data,'1','C');
                                        $pdf->SetXY($x + 239, $y);
                                        $data = $row['short_pre_proc_qty'];
                                        strlen($data)<15?$b=8:$b=4;
                                        $pdf->MultiCell(23,$b,$data,'1','C');
                                        $pdf->SetXY($x + 262, $y);
                                        $data = $row['short_pre_proc_percent'];
                                        strlen($data)<15?$b=8:$b=4;
                                        $pdf->MultiCell(18,$b,$data,'1','C');
                                        // $pdf->SetXY($x + 280, $y);

                                    }

                                    $sql_for_printing_total = "select total.pp_number, sum(total.pp_quantity) pp_quantity, sum(total.process_qty) process_qty, 
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
                                    and ptftri.process_id = 'proc_8' and ptftri.pp_number = '$pp_number'
                                    group by ptftri.pp_number, ptftri.version_number, ptftri.finish_width_in_inch )P
                                    where  1=1
                                    and ptftri_1.process_id = p.process_id
                                    and ptftri_1.pp_number = p.pp_number
                                    and ptftri_1.version_number = p.version_name
                                    and ptftri_1.partial_test_for_test_result_creation_date = p.max_date
                                    and ptftri_1.finish_width_in_inch = p.finish_width_in_inch
                                    group by process_id,pp_number, version_name)result where pp.pp_number = result.pp_number and pp.version_name = result.version_name ) total";
                        

                                  $result_for_printing_total= mysqli_query($con,$sql_for_printing_total) or die(mysqli_error($con));
                                  while($row = mysqli_fetch_array($result_for_printing_total))  
                                  {
                                      $pdf->SetFont('Arial','B',9); 
                                      $x = $pdf->GetX();
                                      $y = $pdf->GetY();
                                      $data = "Printing Total Qty. (mtr.)";
                                      strlen($data)<70?$b=8:$b=4;
                                      $pdf->MultiCell(76,$b,$data,'1','C');
                                      $pdf->SetXY($x + 76, $y);
                                      $data = $row['pp_quantity'];
                                      strlen($data)<20?$b=8:$b=4;
                                      $pdf->MultiCell(27,$b,$data,'1','C');
                                      $pdf->SetXY($x + 103, $y);
                                      $data = $row['before_process_qty'];
                                      strlen($data)<20?$b=8:$b=4;
                                      $pdf->MultiCell(27,$b,$data,'1','C');
                                      $pdf->SetXY($x + 130, $y);
                                      $data = $row['process_qty'];
                                      strlen($data)<20?$b=8:$b=4;
                                      $pdf->MultiCell(27,$b,$data,'1','C');
                                      $pdf->SetXY($x + 157, $y);
                                      $data = $row['short_pp_qty'];
                                      strlen($data)<20?$b=8:$b=4;
                                      $pdf->MultiCell(23,$b,$data,'1','C');
                                      $pdf->SetXY($x + 180, $y);
                                      $data = $row['short_pp_percent'];
                                      strlen($data)<20?$b=8:$b=4;
                                      $pdf->MultiCell(18,$b,$data,'1','C'); 
                                      $pdf->SetXY($x + 198, $y); 
                                      $data = $row['short_gre_rcv_qty'];
                                      strlen($data)<20?$b=8:$b=4;
                                      $pdf->MultiCell(23,$b,$data,'1','C');
                                      $pdf->SetXY($x + 221, $y);
                                      $data = $row['short_gre_rcv_percent'];
                                      strlen($data)<20?$b=8:$b=4;
                                      $pdf->MultiCell(18,$b,$data,'1','C');
                                      $pdf->SetXY($x + 239, $y); 
                                      $data = $row['short_pre_proc_qty'];
                                      strlen($data)<20?$b=8:$b=4;
                                      $pdf->MultiCell(23,$b,$data,'1','C');
                                      $pdf->SetXY($x + 262, $y);
                                      $data = $row['short_pre_proc_percent'];
                                      strlen($data)<20?$b=8:$b=4;
                                      $pdf->MultiCell(18,$b,$data,'1','C');  

                                      if($row['short_excess_qty']!= '') 
                                          {
                                              $process_loss_gain+=$row['short_excess_qty'];
                                          }
                              
                                          $Total_pp_quantity = $row['pp_quantity'];
                                          $Total_greige_quantity = $row['process_qty'];
                                   
                                  }

              }
            }

                         
          /*************************************************  Curing (Process No- 9) ***************************************************/

          $greige_period = "select ptftri.pp_number, ptftri.process_id, date_format(min(ptftri.partial_test_for_test_result_creation_date), '%d-%b-%Y') start_date,
        date_format(max(ptftri.partial_test_for_test_result_creation_date), '%d-%b-%Y') end_date
        from partial_test_for_test_result_info  ptftri where  ptftri.process_id = 'proc_9' and ptftri.pp_number = '$pp_number'";
    
            $result_for_greige= mysqli_query($con,$greige_period) or die(mysqli_error($con));
            while($row = mysqli_fetch_array($result_for_greige))  
            {  
                if($row['end_date']!= '') 
                {
                    $process_completion_date = $row['end_date'];
                }
    
                if($row_for_select_process["process_id"] == "proc_9")
                {
                    $Serial+=1;
  
                    $sql_for_curing = "select pp.pp_number, pp.version_name as version_number, pp.color, pp.style_name, pp.gw, pp.fw, pp.pp_quantity, result.after_trolley_or_batcher_qty, result.date, 
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
                    ptftri.pp_number = aptv.pp_number and ptftri.version_id = aptv.version_id and ptftri.style=aptv.style_name  and ptftri.process_name=aptv.process_name and ptftri.process_id = 'proc_9'
                     and ptftri.pp_number = '$pp_number')result 
                    
                    on pp.pp_number = result.pp_number and pp.version_id = result.version_id  order by result.date, pp.pp_number, pp.version_id, pp.color, pp.style_name, pp.gw, pp.fw";
                     
                    $result_for_curing = mysqli_query($con,$sql_for_curing) or die(mysqli_error($con));
  
                    $row_number_for_curing = mysqli_num_rows($result_for_curing);
  
                    $counter = $counter + ($row_number_for_curing * 8) + 10 + 10; 
    
                    if($counter>200)
                        {
                            $pdf->AddPage();
                            $pdf->SetLeftMargin(8);
                            $counter =30;
                            $counter = $counter + ($row_number_for_curing * 8) + 10 + 10; 
  
                        } 
  
                    $pdf->SetFont('Arial','B',14);
                    $pdf->Ln(3);
                    $pdf->Cell(280,7,$Serial.'.'.'  '.'Curing'.'   ('.$row["start_date"].' To '.$row["end_date"].')'.$pdf->SetFillColor(255,255,255),"0","1","L",true);
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
                    $pdf->MultiCell(28,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                    $pdf->SetXY($x + 49, $y);
                    $data = "Color";
                    strlen($data)<15?$b=10:$b=5;
                    $pdf->MultiCell(24,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                    $pdf->SetXY($x + 73, $y);
                    $data = "Style";
                    strlen($data)<15?$b=10:$b=5;
                    $pdf->MultiCell(24,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                    $pdf->SetXY($x + 97, $y);
                    $data = "Greige Width (inch)";
                    strlen($data)<10?$b=10:$b=5;
                    $pdf->MultiCell(21,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                    $pdf->SetXY($x + 118, $y);
                    $data = "Finish Width (inch)";
                    strlen($data)<10?$b=10:$b=5;
                    $pdf->MultiCell(21,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                    $pdf->SetXY($x + 139, $y);
                    $data = "Before Trolley No.";
                    strlen($data)<10?$b=10:$b=5;
                    $pdf->MultiCell(20,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                    $pdf->SetXY($x + 159, $y);
                    $data = "B. Process Qty (mtr.)";
                    strlen($data)<15?$b=10:$b=5;
                    $pdf->MultiCell(20,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                    $pdf->SetXY($x + 179, $y);
                    $data = "After Trolley No.";
                    strlen($data)<10?$b=10:$b=5;
                    $pdf->MultiCell(20,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                    $pdf->SetXY($x + 199, $y);
                    $data = "Process Qty (mtr.)";
                    strlen($data)<10?$b=10:$b=5;
                    $pdf->MultiCell(20,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                    $pdf->SetXY($x + 219, $y);
                    $data = "(+/-) From Prev. Process";
                    strlen($data)<10?$b=10:$b=5;
                    $pdf->MultiCell(41,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                    $pdf->SetXY($x + 219, $y+5);
                    $data = "Qty (mtr.)";
                    // strlen($data)<15?$b=10:$b=5;
                    $pdf->MultiCell(23,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                    $pdf->SetXY($x + 242, $y+5);
                    $data = "%";
                    // strlen($data)<15?$b=10:$b=5;
                    $pdf->MultiCell(18,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                    $pdf->SetXY($x + 260, $y);
                    $data = "Process / Reprocess";
                    strlen($data)<10?$b=10:$b=5;
                    $pdf->MultiCell(20,$b,"$data".$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                    // $pdf->SetXY($x + 194, $y);
    
                    $pdf->Cell(200,0,$pdf->SetFillColor(255,255,255),'1','1','c',true);
        
                    $pdf->SetFont('Arial','',9);
    
  
                                                    while($row = mysqli_fetch_array($result_for_curing))  
                                                    {
                                                        $x = $pdf->GetX();
                                                        $y = $pdf->GetY();
                                                        $data = $row['date'];
                                                        strlen($data)<20?$b=8:$b=4;
                                                        $pdf->MultiCell(21,$b,$data,'1','C');
                                                        $pdf->SetXY($x + 21, $y);
                                                        $data = $row['version_number'];
                                                        strlen($data)<16?$b=8:$b=4;
                                                        $pdf->MultiCell(28,$b,$data,'1','C');
                                                        $pdf->SetXY($x + 49, $y);
                                                        $data = $row['color'];
                                                        strlen($data)<20?$b=8:$b=4;
                                                        $pdf->MultiCell(24,$b,$data,'1','C');
                                                        $pdf->SetXY($x + 73, $y);
                                                        $data = $row['style_name'];
                                                        strlen($data)<10?$b=8:$b=4;
                                                        $pdf->MultiCell(24,$b,$data,'1','C');
                                                        $pdf->SetXY($x + 97, $y);
                                                        $data = $row['gw'];
                                                        strlen($data)<20?$b=8:$b=4;
                                                        $pdf->MultiCell(21,$b,$data,'1','C');
                                                        $pdf->SetXY($x + 118, $y);
                                                        $data = $row['fw'];
                                                        strlen($data)<20?$b=8:$b=4;
                                                        $pdf->MultiCell(21,$b,$data,'1','C');
                                                        $pdf->SetXY($x + 139, $y);
                                                        $data = $row['before_trolley_number_or_batcher_number'];
                                                        strlen($data)<20?$b=8:$b=4;
                                                        $pdf->MultiCell(20,$b,$data,'1','C');
                                                        $pdf->SetXY($x + 159, $y);
                                                        $data = $row['before_trolley_or_batcher_qty'];
                                                        strlen($data)<20?$b=8:$b=4;
                                                        $pdf->MultiCell(20,$b,$data,'1','C');
                                                        $pdf->SetXY($x + 179, $y);
                                                        $data = $row['after_trolley_number_or_batcher_number'];
                                                        strlen($data)<20?$b=8:$b=4;
                                                        $pdf->MultiCell(20,$b,$data,'1','C');
                                                        $pdf->SetXY($x + 199, $y);
                                                        $data = $row['after_trolley_or_batcher_qty'];
                                                        strlen($data)<20?$b=8:$b=4;
                                                        $pdf->MultiCell(20,$b,$data,'1','C');
                                                        $pdf->SetXY($x + 219, $y);
                                                        $data = $row['short_proc'];
                                                        strlen($data)<20?$b=8:$b=4;
                                                        $pdf->MultiCell(23,$b,$data,'1','C');
                                                        $pdf->SetXY($x + 242, $y);
                                                        $data = $row['short_percent'];
                                                        strlen($data)<20?$b=8:$b=4;
                                                        $pdf->MultiCell(18,$b,$data,'1','C');
                                                        $pdf->SetXY($x + 260, $y);
                                                        $data = $row['process_or_reprocess'];
                                                        strlen($data)<20?$b=8:$b=4;
                                                        $pdf->SetFont('Arial','',7);
                                                          $pdf->MultiCell(20,$b,$data,'1','C'); 
                                                          $pdf->SetFont('Arial','',9); 
                                                    }
  
  
  
                                            // Width summary for Curing
  
                                            $sql_for_curing_width = "select pp.pp_number, pp.gw, pp.fw, pp.pp_quantity, result.process_qty, result.before_process_qty, result.gray_process_qty,
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
                                           and ptftri.process_id = 'proc_9' and ptftri.pp_number = '$pp_number'
                                            group by ptftri.pp_number, pwvci.finish_width_in_inch, pwvci.greige_width_in_inch,ptftri.version_id )P
                                           where  1=1
                                           and ptftri_1.process_id = p.process_id
                                           and ptftri_1.pp_number = p.pp_number
                                           and ptftri_1.version_id = p.version_id
                                           and ptftri_1.partial_test_for_test_result_creation_date = p.max_date
                                           group by process_id,pp_number, fw,  gw)result 
                                           on pp.pp_number = result.pp_number and pp.fw = result.fw and pp.gw = result.gw 
                                           order by pp.pp_number, pp.gw, pp.fw";
                                            
                                            $result_for_curing_width= mysqli_query($con,$sql_for_curing_width) or die(mysqli_error($con));
  
                                            $row_number_for_curing_width = mysqli_num_rows($result_for_curing_width);
  
                                            $counter = $counter + ($row_number_for_curing_width*8) + 10 + 10; 
                              
                                              if($counter>200)
                                                  {
                                                      $pdf->AddPage();
                                                      $pdf->SetLeftMargin(8);
                                                      $counter =30;
                                                      $counter = $counter + ($row_number_for_curing_width*8) + 10 + 10; 
                                                  } 
  
                                            $pdf->SetFont('Arial','B',11);
                                            $pdf->Ln(3);
                                            $pdf->Cell(280,7,"Width Summary".$pdf->SetFillColor(220,220,220),"1","1","C",true);
                                            $pdf->SetFont('Arial','B',9);
  
                                            $x = $pdf->GetX();
                                            $y = $pdf->GetY();
                                            $data = "Greige Width (inch)";
                                            strlen($data)<15?$b=10:$b=5;
                                            $pdf->MultiCell(30,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                            $pdf->SetXY($x + 30, $y);
                                            $data = "Finish Width (inch)";
                                            strlen($data)<15?$b=10:$b=5;
                                            $pdf->MultiCell(30,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                            $pdf->SetXY($x + 60, $y);
                                            $data = "PP Quantity. (mtr.)";
                                            strlen($data)<25?$b=10:$b=5;
                                            $pdf->MultiCell(32,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                            $pdf->SetXY($x + 92, $y);
                                            $data = "Before Process Quantity (mtr.)";
                                            strlen($data)<25?$b=10:$b=5;
                                            $pdf->MultiCell(33,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                            $pdf->SetXY($x + 125, $y);
                                            $data = "Process Quantity. (mtr.)";
                                            strlen($data)<15?$b=10:$b=5;
                                            $pdf->MultiCell(32,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                            $pdf->SetXY($x + 157, $y);
                                            $data = "(+/-) From PP";
                                            // strlen($data)<15?$b=10:$b=5;
                                            $pdf->MultiCell(41,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                            $pdf->SetXY($x + 157, $y+5);
                                            $data = "Qty (mtr.)";
                                            // strlen($data)<15?$b=10:$b=5;
                                            $pdf->MultiCell(23,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                            $pdf->SetXY($x + 180, $y+5);
                                            $data = "%";
                                            // strlen($data)<15?$b=10:$b=5;
                                            $pdf->MultiCell(18,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                            $pdf->SetXY($x + 198, $y);
                                            $data = "(+/-) From Greige";
                                            // strlen($data)<15?$b=10:$b=5;
                                            $pdf->MultiCell(41,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                            $pdf->SetXY($x + 198, $y+5);
                                            $data = "Qty (mtr.)";
                                            // strlen($data)<15?$b=10:$b=5;
                                            $pdf->MultiCell(23,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                            $pdf->SetXY($x + 221, $y+5);
                                            $data = "%";
                                            // strlen($data)<15?$b=10:$b=5;
                                            $pdf->MultiCell(18,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                            $pdf->SetXY($x + 239, $y);
                                            $data = "(+/-) From Prev. Process";
                                            // strlen($data)<15?$b=10:$b=5;
                                            $pdf->MultiCell(41,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                            $pdf->SetXY($x + 239, $y+5);
                                            $data = "Qty (mtr.)";
                                            // strlen($data)<15?$b=10:$b=5;
                                            $pdf->MultiCell(23,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                            $pdf->SetXY($x + 262, $y+5);
                                            $data = "%";
                                            // strlen($data)<15?$b=10:$b=5;
                                            $pdf->MultiCell(18,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                            $pdf->SetXY($x + 280, $y);
                                            
                                            // $pdf->Cell(0,0,$pdf->SetFillColor(255,255,255),'1','1','C',true);
                                            $pdf->SetFont('Arial','',9);       
                                             $pdf->Ln(10);
                                           
                                            
                                        while($row = mysqli_fetch_array($result_for_curing_width))  
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
                                            $pdf->MultiCell(32,$b,$data,'1','C');
                                            $pdf->SetXY($x + 92, $y);
                                            $data = $row['before_process_qty'];
                                            strlen($data)<20?$b=8:$b=4;
                                            $pdf->MultiCell(33,$b,$data,'1','C');
                                            $pdf->SetXY($x + 125, $y);
                                            $data = $row['process_qty'];
                                            strlen($data)<20?$b=8:$b=4;
                                            $pdf->MultiCell(32,$b,$data,'1','C');
                                            $pdf->SetXY($x + 157, $y);
                                            $data = $row['short_pp_qty'];
                                            strlen($data)<15?$b=8:$b=4;
                                            $pdf->MultiCell(23,$b,$data,'1','C');
                                            $pdf->SetXY($x + 180, $y);
                                            $data = $row['short_pp_percent'];
                                            strlen($data)<15?$b=8:$b=4;
                                            $pdf->MultiCell(18,$b,$data,'1','C');
                                            $pdf->SetXY($x + 198, $y);
                                            $data = $row['short_gre_rcv_qty'];
                                            strlen($data)<15?$b=8:$b=4;
                                            $pdf->MultiCell(23,$b,$data,'1','C');
                                            $pdf->SetXY($x + 221, $y);
                                            $data = $row['short_gre_rcv_percent'];
                                            strlen($data)<15?$b=8:$b=4;
                                            $pdf->MultiCell(18,$b,$data,'1','C');
                                            $pdf->SetXY($x + 239, $y);
                                            $data = $row['short_pre_proc_qty'];
                                            strlen($data)<15?$b=8:$b=4;
                                            $pdf->MultiCell(23,$b,$data,'1','C');
                                            $pdf->SetXY($x + 262, $y);
                                            $data = $row['short_pre_proc_percent'];
                                            strlen($data)<15?$b=8:$b=4;
                                            $pdf->MultiCell(18,$b,$data,'1','C');
                                            // $pdf->SetXY($x + 200, $y);
  
                                        }
                                            // Version summary for Curing
  
                                             $sql_for_curing_version = "select pp.pp_number, pp.version_name version_number, pp.style_name, pp.color, pp.gw, pp.fw, pp.pp_quantity, result.process_qty, result.before_process_qty, result.gray_process_qty, 
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
                                             and ptftri.process_id = 'proc_9' and ptftri.pp_number = '$pp_number'
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
  
                                              $result_for_curing_version= mysqli_query($con,$sql_for_curing_version) or die(mysqli_error($con));
  
                                              $row_number_for_curing_version = mysqli_num_rows($result_for_curing_version);
  
                                              $counter = $counter + ($row_number_for_curing_version*8) + 10 + 10 + 8; 
                              
                                              if($counter>200)
                                                  {
                                                      $pdf->AddPage();
                                                      $pdf->SetLeftMargin(8);
                                                      $counter =30;
                                                      $counter = $counter + ($row_number_for_curing_version*8) + 10 + 10 + 8; 
                                                  } 
  
                                              $pdf->SetFont('Arial','B',11);
                                              $pdf->Ln(3);
                                              $pdf->Cell(280,7,"Version Summary".$pdf->SetFillColor(220,220,220),"1","1","C",true);
                                              $pdf->SetFont('Arial','B',9);
  
                                            $x = $pdf->GetX();
                                            $y = $pdf->GetY();
                                            $data = "Version";
                                            strlen($data)<15?$b=10:$b=5;
                                            $pdf->MultiCell(28,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                            $pdf->SetXY($x + 28, $y);
                                            $data = "Color";
                                            strlen($data)<15?$b=10:$b=5;
                                            $pdf->MultiCell(24,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                            $pdf->SetXY($x + 52, $y);
                                            $data = "Style";
                                            strlen($data)<15?$b=10:$b=5;
                                            $pdf->MultiCell(24,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                            $pdf->SetXY($x + 76, $y);
                                            $data = "PP Quantity (mtr.)";
                                            strlen($data)<15?$b=10:$b=5;
                                            $pdf->MultiCell(27,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                            $pdf->SetXY($x + 103, $y);
                                            $data = "Before process Qty (mtr.)";
                                            strlen($data)<20?$b=10:$b=5;
                                            $pdf->MultiCell(27,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                            $pdf->SetXY($x + 130, $y);
                                            $data = "Process Quantity (mtr.)";
                                            strlen($data)<20?$b=10:$b=5;
                                            $pdf->MultiCell(27,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                            $pdf->SetXY($x + 157, $y);
                                            $data = "(+/-) From PP";
                                            // strlen($data)<15?$b=10:$b=5;
                                            $pdf->MultiCell(41,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                            $pdf->SetXY($x + 157, $y+5);
                                            $data = "Qty (mtr.)";
                                            // strlen($data)<15?$b=10:$b=5;
                                            $pdf->MultiCell(23,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                            $pdf->SetXY($x + 180, $y+5);
                                            $data = "%";
                                            // strlen($data)<15?$b=10:$b=5;
                                            $pdf->MultiCell(18,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                            $pdf->SetXY($x + 198, $y);
                                            $data = "(+/-) From Greige";
                                            // strlen($data)<15?$b=10:$b=5;
                                            $pdf->MultiCell(41,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                            $pdf->SetXY($x + 198, $y+5);
                                            $data = "Qty (mtr.)";
                                            // strlen($data)<15?$b=10:$b=5;
                                            $pdf->MultiCell(23,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                            $pdf->SetXY($x + 221, $y+5);
                                            $data = "%";
                                            // strlen($data)<15?$b=10:$b=5;
                                            $pdf->MultiCell(18,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                            $pdf->SetXY($x + 239, $y);
                                            $data = "(+/-) From Prev. Process";
                                            // strlen($data)<15?$b=10:$b=5;
                                            $pdf->MultiCell(41,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                            $pdf->SetXY($x + 239, $y+5);
                                            $data = "Qty (mtr.)";
                                            // strlen($data)<15?$b=10:$b=5;
                                            $pdf->MultiCell(23,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                            $pdf->SetXY($x + 262, $y+5);
                                            $data = "%";
                                            // strlen($data)<15?$b=10:$b=5;
                                            $pdf->MultiCell(18,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                            $pdf->SetXY($x + 280, $y);
                                            
                                            // $pdf->Cell(0,0,$pdf->SetFillColor(255,255,255),'1','1','C',true);
                                            $pdf->SetFont('Arial','',9);       
                                             $pdf->Ln(10);
                
                                      while($row = mysqli_fetch_array($result_for_curing_version))  
                                      {  
                                          $x = $pdf->GetX();
                                          $y = $pdf->GetY();
                                          $data = $row['version_number'];
                                          strlen($data)<16?$b=8:$b=4;
                                          $pdf->MultiCell(28,$b,$data,'1','C');
                                          $pdf->SetXY($x + 28, $y);
                                          $data = $row['color'];
                                          strlen($data)<20?$b=8:$b=4;
                                          $pdf->MultiCell(24,$b,$data,'1','C');
                                          $pdf->SetXY($x + 52, $y);
                                          $data = $row['style_name'];
                                          strlen($data)<10?$b=8:$b=4;
                                          $pdf->MultiCell(24,$b,$data,'1','C');
                                          $pdf->SetXY($x + 76, $y);
                                          $data = $row['pp_quantity'];
                                          strlen($data)<20?$b=8:$b=4;
                                          $pdf->MultiCell(27,$b,$data,'1','C');
                                          $pdf->SetXY($x + 103, $y);
                                          $data = $row['before_process_qty'];
                                          strlen($data)<20?$b=8:$b=4;
                                          $pdf->MultiCell(27,$b,$data,'1','C');
                                          $pdf->SetXY($x + 130, $y);
                                          $data = $row['process_qty'];
                                          strlen($data)<20?$b=8:$b=4;
                                          $pdf->MultiCell(27,$b,$data,'1','C');
                                          $pdf->SetXY($x + 157, $y);
                                          $data = $row['short_pp'];
                                          strlen($data)<15?$b=8:$b=4;
                                          $pdf->MultiCell(23,$b,$data,'1','C');
                                          $pdf->SetXY($x + 180, $y);
                                          $data = $row['short_pp_percent'];
                                          strlen($data)<15?$b=8:$b=4;
                                          $pdf->MultiCell(18,$b,$data,'1','C');
                                          $pdf->SetXY($x + 198, $y);
                                          $data = $row['short_gre_rcv_qty'];
                                          strlen($data)<15?$b=8:$b=4;
                                          $pdf->MultiCell(23,$b,$data,'1','C');
                                          $pdf->SetXY($x + 221, $y);
                                          $data = $row['short_gre_rcv_percent'];
                                          strlen($data)<15?$b=8:$b=4;
                                          $pdf->MultiCell(18,$b,$data,'1','C');
                                          $pdf->SetXY($x + 239, $y);
                                          $data = $row['short_pre_proc_qty'];
                                          strlen($data)<15?$b=8:$b=4;
                                          $pdf->MultiCell(23,$b,$data,'1','C');
                                          $pdf->SetXY($x + 262, $y);
                                          $data = $row['short_pre_proc_percent'];
                                          strlen($data)<15?$b=8:$b=4;
                                          $pdf->MultiCell(18,$b,$data,'1','C');
                                          // $pdf->SetXY($x + 280, $y);
  
                                      }
  
                                      $sql_for_curing_total = "select total.pp_number, sum(total.pp_quantity) pp_quantity, sum(total.process_qty) process_qty, 
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
                                      and ptftri.process_id = 'proc_9' and ptftri.pp_number = '$pp_number'
                                      group by ptftri.pp_number, ptftri.version_number, ptftri.finish_width_in_inch )P
                                      where  1=1
                                      and ptftri_1.process_id = p.process_id
                                      and ptftri_1.pp_number = p.pp_number
                                      and ptftri_1.version_number = p.version_name
                                      and ptftri_1.partial_test_for_test_result_creation_date = p.max_date
                                      and ptftri_1.finish_width_in_inch = p.finish_width_in_inch
                                      group by process_id,pp_number, version_name)result where pp.pp_number = result.pp_number and pp.version_name = result.version_name ) total";
  
                                    $result_for_curing_total= mysqli_query($con,$sql_for_curing_total) or die(mysqli_error($con));
                                    while($row = mysqli_fetch_array($result_for_curing_total))  
                                    {
                                        $pdf->SetFont('Arial','B',9); 
                                        $x = $pdf->GetX();
                                        $y = $pdf->GetY();
                                        $data = "Curing Total Qty. (mtr.)";
                                        strlen($data)<70?$b=8:$b=4;
                                        $pdf->MultiCell(76,$b,$data,'1','C');
                                        $pdf->SetXY($x + 76, $y);
                                        $data = $row['pp_quantity'];
                                        strlen($data)<20?$b=8:$b=4;
                                        $pdf->MultiCell(27,$b,$data,'1','C');
                                        $pdf->SetXY($x + 103, $y);
                                        $data = $row['before_process_qty'];
                                        strlen($data)<20?$b=8:$b=4;
                                        $pdf->MultiCell(27,$b,$data,'1','C');
                                        $pdf->SetXY($x + 130, $y);
                                        $data = $row['process_qty'];
                                        strlen($data)<20?$b=8:$b=4;
                                        $pdf->MultiCell(27,$b,$data,'1','C');
                                        $pdf->SetXY($x + 157, $y);
                                        $data = $row['short_pp_qty'];
                                        strlen($data)<20?$b=8:$b=4;
                                        $pdf->MultiCell(23,$b,$data,'1','C');
                                        $pdf->SetXY($x + 180, $y);
                                        $data = $row['short_pp_percent'];
                                        strlen($data)<20?$b=8:$b=4;
                                        $pdf->MultiCell(18,$b,$data,'1','C'); 
                                        $pdf->SetXY($x + 198, $y); 
                                        $data = $row['short_gre_rcv_qty'];
                                        strlen($data)<20?$b=8:$b=4;
                                        $pdf->MultiCell(23,$b,$data,'1','C');
                                        $pdf->SetXY($x + 221, $y);
                                        $data = $row['short_gre_rcv_percent'];
                                        strlen($data)<20?$b=8:$b=4;
                                        $pdf->MultiCell(18,$b,$data,'1','C');
                                        $pdf->SetXY($x + 239, $y); 
                                        $data = $row['short_pre_proc_qty'];
                                        strlen($data)<20?$b=8:$b=4;
                                        $pdf->MultiCell(23,$b,$data,'1','C');
                                        $pdf->SetXY($x + 262, $y);
                                        $data = $row['short_pre_proc_percent'];
                                        strlen($data)<20?$b=8:$b=4;
                                        $pdf->MultiCell(18,$b,$data,'1','C');  
  
                                        if($row['short_excess_qty']!= '') 
                                            {
                                                $process_loss_gain+=$row['short_excess_qty'];
                                            }
                                
                                            $Total_pp_quantity = $row['pp_quantity'];
                                            $Total_greige_quantity = $row['process_qty'];
                                     
                                    }
  
                }
            }


            /*************************************************  Steaming (Process No- 10) ***************************************************/

          $greige_period = "select ptftri.pp_number, ptftri.process_id, date_format(min(ptftri.partial_test_for_test_result_creation_date), '%d-%b-%Y') start_date,
          date_format(max(ptftri.partial_test_for_test_result_creation_date), '%d-%b-%Y') end_date
          from partial_test_for_test_result_info  ptftri where  ptftri.process_id = 'proc_10' and ptftri.pp_number = '$pp_number'";
      
              $result_for_greige= mysqli_query($con,$greige_period) or die(mysqli_error($con));
              while($row = mysqli_fetch_array($result_for_greige))  
              {  
                  if($row['end_date']!= '') 
                  {
                      $process_completion_date = $row['end_date'];
                  }
      
                  if($row_for_select_process["process_id"] == "proc_10")
                  {
                      $Serial+=1;
    
                      $sql_for_curing = "select pp.pp_number, pp.version_name as version_number, pp.color, pp.style_name, pp.gw, pp.fw, pp.pp_quantity, result.after_trolley_or_batcher_qty, result.date, 
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
                      ptftri.pp_number = aptv.pp_number and ptftri.version_id = aptv.version_id and ptftri.style=aptv.style_name  and ptftri.process_name=aptv.process_name and ptftri.process_id = 'proc_10'
                       and ptftri.pp_number = '$pp_number')result 
                      
                      on pp.pp_number = result.pp_number and pp.version_id = result.version_id  order by result.date, pp.pp_number, pp.version_id, pp.color, pp.style_name, pp.gw, pp.fw";
                       
                      $result_for_curing = mysqli_query($con,$sql_for_curing) or die(mysqli_error($con));
    
                      $row_number_for_curing = mysqli_num_rows($result_for_curing);
    
                      $counter = $counter + ($row_number_for_curing * 8) + 10 + 10; 
      
                      if($counter>200)
                          {
                              $pdf->AddPage();
                              $pdf->SetLeftMargin(8);
                              $counter =30;
                              $counter = $counter + ($row_number_for_curing * 8) + 10 + 10; 
    
                          } 
    
                      $pdf->SetFont('Arial','B',14);
                      $pdf->Ln(3);
                      $pdf->Cell(280,7,$Serial.'.'.'  '.'Steaming'.'   ('.$row["start_date"].' To '.$row["end_date"].')'.$pdf->SetFillColor(255,255,255),"0","1","L",true);
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
                      $pdf->MultiCell(28,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                      $pdf->SetXY($x + 49, $y);
                      $data = "Color";
                      strlen($data)<15?$b=10:$b=5;
                      $pdf->MultiCell(24,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                      $pdf->SetXY($x + 73, $y);
                      $data = "Style";
                      strlen($data)<15?$b=10:$b=5;
                      $pdf->MultiCell(24,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                      $pdf->SetXY($x + 97, $y);
                      $data = "Greige Width (inch)";
                      strlen($data)<10?$b=10:$b=5;
                      $pdf->MultiCell(21,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                      $pdf->SetXY($x + 118, $y);
                      $data = "Finish Width (inch)";
                      strlen($data)<10?$b=10:$b=5;
                      $pdf->MultiCell(21,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                      $pdf->SetXY($x + 139, $y);
                      $data = "Before Trolley No.";
                      strlen($data)<10?$b=10:$b=5;
                      $pdf->MultiCell(20,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                      $pdf->SetXY($x + 159, $y);
                      $data = "B. Process Qty (mtr.)";
                      strlen($data)<15?$b=10:$b=5;
                      $pdf->MultiCell(20,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                      $pdf->SetXY($x + 179, $y);
                      $data = "After Trolley No.";
                      strlen($data)<10?$b=10:$b=5;
                      $pdf->MultiCell(20,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                      $pdf->SetXY($x + 199, $y);
                      $data = "Process Qty (mtr.)";
                      strlen($data)<10?$b=10:$b=5;
                      $pdf->MultiCell(20,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                      $pdf->SetXY($x + 219, $y);
                      $data = "(+/-) From Prev. Process";
                      strlen($data)<10?$b=10:$b=5;
                      $pdf->MultiCell(41,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                      $pdf->SetXY($x + 219, $y+5);
                      $data = "Qty (mtr.)";
                      // strlen($data)<15?$b=10:$b=5;
                      $pdf->MultiCell(23,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                      $pdf->SetXY($x + 242, $y+5);
                      $data = "%";
                      // strlen($data)<15?$b=10:$b=5;
                      $pdf->MultiCell(18,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                      $pdf->SetXY($x + 260, $y);
                      $data = "Process / Reprocess";
                      strlen($data)<10?$b=10:$b=5;
                      $pdf->MultiCell(20,$b,"$data".$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                      // $pdf->SetXY($x + 194, $y);
      
                      $pdf->Cell(200,0,$pdf->SetFillColor(255,255,255),'1','1','c',true);
          
                      $pdf->SetFont('Arial','',9);
      
    
                                                      while($row = mysqli_fetch_array($result_for_curing))  
                                                      {
                                                          $x = $pdf->GetX();
                                                          $y = $pdf->GetY();
                                                          $data = $row['date'];
                                                          strlen($data)<20?$b=8:$b=4;
                                                          $pdf->MultiCell(21,$b,$data,'1','C');
                                                          $pdf->SetXY($x + 21, $y);
                                                          $data = $row['version_number'];
                                                          strlen($data)<16?$b=8:$b=4;
                                                          $pdf->MultiCell(28,$b,$data,'1','C');
                                                          $pdf->SetXY($x + 49, $y);
                                                          $data = $row['color'];
                                                          strlen($data)<20?$b=8:$b=4;
                                                          $pdf->MultiCell(24,$b,$data,'1','C');
                                                          $pdf->SetXY($x + 73, $y);
                                                          $data = $row['style_name'];
                                                          strlen($data)<10?$b=8:$b=4;
                                                          $pdf->MultiCell(24,$b,$data,'1','C');
                                                          $pdf->SetXY($x + 97, $y);
                                                          $data = $row['gw'];
                                                          strlen($data)<20?$b=8:$b=4;
                                                          $pdf->MultiCell(21,$b,$data,'1','C');
                                                          $pdf->SetXY($x + 118, $y);
                                                          $data = $row['fw'];
                                                          strlen($data)<20?$b=8:$b=4;
                                                          $pdf->MultiCell(21,$b,$data,'1','C');
                                                          $pdf->SetXY($x + 139, $y);
                                                          $data = $row['before_trolley_number_or_batcher_number'];
                                                          strlen($data)<20?$b=8:$b=4;
                                                          $pdf->MultiCell(20,$b,$data,'1','C');
                                                          $pdf->SetXY($x + 159, $y);
                                                          $data = $row['before_trolley_or_batcher_qty'];
                                                          strlen($data)<20?$b=8:$b=4;
                                                          $pdf->MultiCell(20,$b,$data,'1','C');
                                                          $pdf->SetXY($x + 179, $y);
                                                          $data = $row['after_trolley_number_or_batcher_number'];
                                                          strlen($data)<20?$b=8:$b=4;
                                                          $pdf->MultiCell(20,$b,$data,'1','C');
                                                          $pdf->SetXY($x + 199, $y);
                                                          $data = $row['after_trolley_or_batcher_qty'];
                                                          strlen($data)<20?$b=8:$b=4;
                                                          $pdf->MultiCell(20,$b,$data,'1','C');
                                                          $pdf->SetXY($x + 219, $y);
                                                          $data = $row['short_proc'];
                                                          strlen($data)<20?$b=8:$b=4;
                                                          $pdf->MultiCell(23,$b,$data,'1','C');
                                                          $pdf->SetXY($x + 242, $y);
                                                          $data = $row['short_percent'];
                                                          strlen($data)<20?$b=8:$b=4;
                                                          $pdf->MultiCell(18,$b,$data,'1','C');
                                                          $pdf->SetXY($x + 260, $y);
                                                          $data = $row['process_or_reprocess'];
                                                          strlen($data)<20?$b=8:$b=4;
                                                          $pdf->SetFont('Arial','',7);
                                                            $pdf->MultiCell(20,$b,$data,'1','C'); 
                                                            $pdf->SetFont('Arial','',9); 
                                                      }
    
    
    
                                              // Width summary for steaming
    
                                              $sql_for_curing_width = "select pp.pp_number, pp.gw, pp.fw, pp.pp_quantity, result.process_qty, result.before_process_qty, result.gray_process_qty,
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
                                             and ptftri.process_id = 'proc_10' and ptftri.pp_number = '$pp_number'
                                              group by ptftri.pp_number, pwvci.finish_width_in_inch, pwvci.greige_width_in_inch,ptftri.version_id )P
                                             where  1=1
                                             and ptftri_1.process_id = p.process_id
                                             and ptftri_1.pp_number = p.pp_number
                                             and ptftri_1.version_id = p.version_id
                                             and ptftri_1.partial_test_for_test_result_creation_date = p.max_date
                                             group by process_id,pp_number, fw,  gw)result 
                                             on pp.pp_number = result.pp_number and pp.fw = result.fw and pp.gw = result.gw 
                                             order by pp.pp_number, pp.gw, pp.fw";
                                              
                                              $result_for_curing_width= mysqli_query($con,$sql_for_curing_width) or die(mysqli_error($con));
    
                                              $row_number_for_curing_width = mysqli_num_rows($result_for_curing_width);
    
                                              $counter = $counter + ($row_number_for_curing_width*8) + 10 + 10; 
                                
                                                if($counter>200)
                                                    {
                                                        $pdf->AddPage();
                                                        $pdf->SetLeftMargin(8);
                                                        $counter =30;
                                                        $counter = $counter + ($row_number_for_curing_width*8) + 10 + 10; 
                                                    } 
    
                                              $pdf->SetFont('Arial','B',11);
                                              $pdf->Ln(3);
                                              $pdf->Cell(280,7,"Width Summary".$pdf->SetFillColor(220,220,220),"1","1","C",true);
                                              $pdf->SetFont('Arial','B',9);
    
                                              $x = $pdf->GetX();
                                              $y = $pdf->GetY();
                                              $data = "Greige Width (inch)";
                                              strlen($data)<15?$b=10:$b=5;
                                              $pdf->MultiCell(30,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                              $pdf->SetXY($x + 30, $y);
                                              $data = "Finish Width (inch)";
                                              strlen($data)<15?$b=10:$b=5;
                                              $pdf->MultiCell(30,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                              $pdf->SetXY($x + 60, $y);
                                              $data = "PP Quantity. (mtr.)";
                                              strlen($data)<25?$b=10:$b=5;
                                              $pdf->MultiCell(32,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                              $pdf->SetXY($x + 92, $y);
                                              $data = "Before Process Quantity (mtr.)";
                                              strlen($data)<25?$b=10:$b=5;
                                              $pdf->MultiCell(33,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                              $pdf->SetXY($x + 125, $y);
                                              $data = "Process Quantity. (mtr.)";
                                              strlen($data)<15?$b=10:$b=5;
                                              $pdf->MultiCell(32,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                              $pdf->SetXY($x + 157, $y);
                                              $data = "(+/-) From PP";
                                              // strlen($data)<15?$b=10:$b=5;
                                              $pdf->MultiCell(41,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                              $pdf->SetXY($x + 157, $y+5);
                                              $data = "Qty (mtr.)";
                                              // strlen($data)<15?$b=10:$b=5;
                                              $pdf->MultiCell(23,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                              $pdf->SetXY($x + 180, $y+5);
                                              $data = "%";
                                              // strlen($data)<15?$b=10:$b=5;
                                              $pdf->MultiCell(18,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                              $pdf->SetXY($x + 198, $y);
                                              $data = "(+/-) From Greige";
                                              // strlen($data)<15?$b=10:$b=5;
                                              $pdf->MultiCell(41,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                              $pdf->SetXY($x + 198, $y+5);
                                              $data = "Qty (mtr.)";
                                              // strlen($data)<15?$b=10:$b=5;
                                              $pdf->MultiCell(23,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                              $pdf->SetXY($x + 221, $y+5);
                                              $data = "%";
                                              // strlen($data)<15?$b=10:$b=5;
                                              $pdf->MultiCell(18,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                              $pdf->SetXY($x + 239, $y);
                                              $data = "(+/-) From Prev. Process";
                                              // strlen($data)<15?$b=10:$b=5;
                                              $pdf->MultiCell(41,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                              $pdf->SetXY($x + 239, $y+5);
                                              $data = "Qty (mtr.)";
                                              // strlen($data)<15?$b=10:$b=5;
                                              $pdf->MultiCell(23,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                              $pdf->SetXY($x + 262, $y+5);
                                              $data = "%";
                                              // strlen($data)<15?$b=10:$b=5;
                                              $pdf->MultiCell(18,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                              $pdf->SetXY($x + 280, $y);
                                              
                                              // $pdf->Cell(0,0,$pdf->SetFillColor(255,255,255),'1','1','C',true);
                                              $pdf->SetFont('Arial','',9);       
                                               $pdf->Ln(10);
                                             
                                              
                                          while($row = mysqli_fetch_array($result_for_curing_width))  
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
                                              $pdf->MultiCell(32,$b,$data,'1','C');
                                              $pdf->SetXY($x + 92, $y);
                                              $data = $row['before_process_qty'];
                                              strlen($data)<20?$b=8:$b=4;
                                              $pdf->MultiCell(33,$b,$data,'1','C');
                                              $pdf->SetXY($x + 125, $y);
                                              $data = $row['process_qty'];
                                              strlen($data)<20?$b=8:$b=4;
                                              $pdf->MultiCell(32,$b,$data,'1','C');
                                              $pdf->SetXY($x + 157, $y);
                                              $data = $row['short_pp_qty'];
                                              strlen($data)<15?$b=8:$b=4;
                                              $pdf->MultiCell(23,$b,$data,'1','C');
                                              $pdf->SetXY($x + 180, $y);
                                              $data = $row['short_pp_percent'];
                                              strlen($data)<15?$b=8:$b=4;
                                              $pdf->MultiCell(18,$b,$data,'1','C');
                                              $pdf->SetXY($x + 198, $y);
                                              $data = $row['short_gre_rcv_qty'];
                                              strlen($data)<15?$b=8:$b=4;
                                              $pdf->MultiCell(23,$b,$data,'1','C');
                                              $pdf->SetXY($x + 221, $y);
                                              $data = $row['short_gre_rcv_percent'];
                                              strlen($data)<15?$b=8:$b=4;
                                              $pdf->MultiCell(18,$b,$data,'1','C');
                                              $pdf->SetXY($x + 239, $y);
                                              $data = $row['short_pre_proc_qty'];
                                              strlen($data)<15?$b=8:$b=4;
                                              $pdf->MultiCell(23,$b,$data,'1','C');
                                              $pdf->SetXY($x + 262, $y);
                                              $data = $row['short_pre_proc_percent'];
                                              strlen($data)<15?$b=8:$b=4;
                                              $pdf->MultiCell(18,$b,$data,'1','C');
                                              // $pdf->SetXY($x + 200, $y);
    
                                          }
                                              // Version summary for steaming
    
                                               $sql_for_curing_version = "select pp.pp_number, pp.version_name version_number, pp.style_name, pp.color, pp.gw, pp.fw, pp.pp_quantity, result.process_qty, result.before_process_qty, result.gray_process_qty, 
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
                                               and ptftri.process_id = 'proc_10' and ptftri.pp_number = '$pp_number'
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
    
                                                $result_for_curing_version= mysqli_query($con,$sql_for_curing_version) or die(mysqli_error($con));
    
                                                $row_number_for_curing_version = mysqli_num_rows($result_for_curing_version);
    
                                                $counter = $counter + ($row_number_for_curing_version*8) + 10 + 10 + 8; 
                                
                                                if($counter>200)
                                                    {
                                                        $pdf->AddPage();
                                                        $pdf->SetLeftMargin(8);
                                                        $counter =30;
                                                        $counter = $counter + ($row_number_for_curing_version*8) + 10 + 10 + 8; 
                                                    } 
    
                                                $pdf->SetFont('Arial','B',11);
                                                $pdf->Ln(3);
                                                $pdf->Cell(280,7,"Version Summary".$pdf->SetFillColor(220,220,220),"1","1","C",true);
                                                $pdf->SetFont('Arial','B',9);
    
                                              $x = $pdf->GetX();
                                              $y = $pdf->GetY();
                                              $data = "Version";
                                              strlen($data)<15?$b=10:$b=5;
                                              $pdf->MultiCell(28,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                              $pdf->SetXY($x + 28, $y);
                                              $data = "Color";
                                              strlen($data)<15?$b=10:$b=5;
                                              $pdf->MultiCell(24,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                              $pdf->SetXY($x + 52, $y);
                                              $data = "Style";
                                              strlen($data)<15?$b=10:$b=5;
                                              $pdf->MultiCell(24,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                              $pdf->SetXY($x + 76, $y);
                                              $data = "PP Quantity (mtr.)";
                                              strlen($data)<15?$b=10:$b=5;
                                              $pdf->MultiCell(27,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                              $pdf->SetXY($x + 103, $y);
                                              $data = "Before process Qty (mtr.)";
                                              strlen($data)<20?$b=10:$b=5;
                                              $pdf->MultiCell(27,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                              $pdf->SetXY($x + 130, $y);
                                              $data = "Process Quantity (mtr.)";
                                              strlen($data)<20?$b=10:$b=5;
                                              $pdf->MultiCell(27,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                              $pdf->SetXY($x + 157, $y);
                                              $data = "(+/-) From PP";
                                              // strlen($data)<15?$b=10:$b=5;
                                              $pdf->MultiCell(41,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                              $pdf->SetXY($x + 157, $y+5);
                                              $data = "Qty (mtr.)";
                                              // strlen($data)<15?$b=10:$b=5;
                                              $pdf->MultiCell(23,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                              $pdf->SetXY($x + 180, $y+5);
                                              $data = "%";
                                              // strlen($data)<15?$b=10:$b=5;
                                              $pdf->MultiCell(18,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                              $pdf->SetXY($x + 198, $y);
                                              $data = "(+/-) From Greige";
                                              // strlen($data)<15?$b=10:$b=5;
                                              $pdf->MultiCell(41,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                              $pdf->SetXY($x + 198, $y+5);
                                              $data = "Qty (mtr.)";
                                              // strlen($data)<15?$b=10:$b=5;
                                              $pdf->MultiCell(23,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                              $pdf->SetXY($x + 221, $y+5);
                                              $data = "%";
                                              // strlen($data)<15?$b=10:$b=5;
                                              $pdf->MultiCell(18,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                              $pdf->SetXY($x + 239, $y);
                                              $data = "(+/-) From Prev. Process";
                                              // strlen($data)<15?$b=10:$b=5;
                                              $pdf->MultiCell(41,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                              $pdf->SetXY($x + 239, $y+5);
                                              $data = "Qty (mtr.)";
                                              // strlen($data)<15?$b=10:$b=5;
                                              $pdf->MultiCell(23,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                              $pdf->SetXY($x + 262, $y+5);
                                              $data = "%";
                                              // strlen($data)<15?$b=10:$b=5;
                                              $pdf->MultiCell(18,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                              $pdf->SetXY($x + 280, $y);
                                              
                                              // $pdf->Cell(0,0,$pdf->SetFillColor(255,255,255),'1','1','C',true);
                                              $pdf->SetFont('Arial','',9);       
                                               $pdf->Ln(10);
                  
                                        while($row = mysqli_fetch_array($result_for_curing_version))  
                                        {  
                                            $x = $pdf->GetX();
                                            $y = $pdf->GetY();
                                            $data = $row['version_number'];
                                            strlen($data)<16?$b=8:$b=4;
                                            $pdf->MultiCell(28,$b,$data,'1','C');
                                            $pdf->SetXY($x + 28, $y);
                                            $data = $row['color'];
                                            strlen($data)<20?$b=8:$b=4;
                                            $pdf->MultiCell(24,$b,$data,'1','C');
                                            $pdf->SetXY($x + 52, $y);
                                            $data = $row['style_name'];
                                            strlen($data)<10?$b=8:$b=4;
                                            $pdf->MultiCell(24,$b,$data,'1','C');
                                            $pdf->SetXY($x + 76, $y);
                                            $data = $row['pp_quantity'];
                                            strlen($data)<20?$b=8:$b=4;
                                            $pdf->MultiCell(27,$b,$data,'1','C');
                                            $pdf->SetXY($x + 103, $y);
                                            $data = $row['before_process_qty'];
                                            strlen($data)<20?$b=8:$b=4;
                                            $pdf->MultiCell(27,$b,$data,'1','C');
                                            $pdf->SetXY($x + 130, $y);
                                            $data = $row['process_qty'];
                                            strlen($data)<20?$b=8:$b=4;
                                            $pdf->MultiCell(27,$b,$data,'1','C');
                                            $pdf->SetXY($x + 157, $y);
                                            $data = $row['short_pp'];
                                            strlen($data)<15?$b=8:$b=4;
                                            $pdf->MultiCell(23,$b,$data,'1','C');
                                            $pdf->SetXY($x + 180, $y);
                                            $data = $row['short_pp_percent'];
                                            strlen($data)<15?$b=8:$b=4;
                                            $pdf->MultiCell(18,$b,$data,'1','C');
                                            $pdf->SetXY($x + 198, $y);
                                            $data = $row['short_gre_rcv_qty'];
                                            strlen($data)<15?$b=8:$b=4;
                                            $pdf->MultiCell(23,$b,$data,'1','C');
                                            $pdf->SetXY($x + 221, $y);
                                            $data = $row['short_gre_rcv_percent'];
                                            strlen($data)<15?$b=8:$b=4;
                                            $pdf->MultiCell(18,$b,$data,'1','C');
                                            $pdf->SetXY($x + 239, $y);
                                            $data = $row['short_pre_proc_qty'];
                                            strlen($data)<15?$b=8:$b=4;
                                            $pdf->MultiCell(23,$b,$data,'1','C');
                                            $pdf->SetXY($x + 262, $y);
                                            $data = $row['short_pre_proc_percent'];
                                            strlen($data)<15?$b=8:$b=4;
                                            $pdf->MultiCell(18,$b,$data,'1','C');
                                            // $pdf->SetXY($x + 280, $y);
    
                                        }
    
                                        $sql_for_curing_total = "select total.pp_number, sum(total.pp_quantity) pp_quantity, sum(total.process_qty) process_qty, 
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
                                        and ptftri.process_id = 'proc_10' and ptftri.pp_number = '$pp_number'
                                        group by ptftri.pp_number, ptftri.version_number, ptftri.finish_width_in_inch )P
                                        where  1=1
                                        and ptftri_1.process_id = p.process_id
                                        and ptftri_1.pp_number = p.pp_number
                                        and ptftri_1.version_number = p.version_name
                                        and ptftri_1.partial_test_for_test_result_creation_date = p.max_date
                                        and ptftri_1.finish_width_in_inch = p.finish_width_in_inch
                                        group by process_id,pp_number, version_name)result where pp.pp_number = result.pp_number and pp.version_name = result.version_name ) total";
    
                                      $result_for_curing_total= mysqli_query($con,$sql_for_curing_total) or die(mysqli_error($con));
                                      while($row = mysqli_fetch_array($result_for_curing_total))  
                                      {
                                          $pdf->SetFont('Arial','B',9); 
                                          $x = $pdf->GetX();
                                          $y = $pdf->GetY();
                                          $data = "Steaming Total Qty. (mtr.)";
                                          strlen($data)<70?$b=8:$b=4;
                                          $pdf->MultiCell(76,$b,$data,'1','C');
                                          $pdf->SetXY($x + 76, $y);
                                          $data = $row['pp_quantity'];
                                          strlen($data)<20?$b=8:$b=4;
                                          $pdf->MultiCell(27,$b,$data,'1','C');
                                          $pdf->SetXY($x + 103, $y);
                                          $data = $row['before_process_qty'];
                                          strlen($data)<20?$b=8:$b=4;
                                          $pdf->MultiCell(27,$b,$data,'1','C');
                                          $pdf->SetXY($x + 130, $y);
                                          $data = $row['process_qty'];
                                          strlen($data)<20?$b=8:$b=4;
                                          $pdf->MultiCell(27,$b,$data,'1','C');
                                          $pdf->SetXY($x + 157, $y);
                                          $data = $row['short_pp_qty'];
                                          strlen($data)<20?$b=8:$b=4;
                                          $pdf->MultiCell(23,$b,$data,'1','C');
                                          $pdf->SetXY($x + 180, $y);
                                          $data = $row['short_pp_percent'];
                                          strlen($data)<20?$b=8:$b=4;
                                          $pdf->MultiCell(18,$b,$data,'1','C'); 
                                          $pdf->SetXY($x + 198, $y); 
                                          $data = $row['short_gre_rcv_qty'];
                                          strlen($data)<20?$b=8:$b=4;
                                          $pdf->MultiCell(23,$b,$data,'1','C');
                                          $pdf->SetXY($x + 221, $y);
                                          $data = $row['short_gre_rcv_percent'];
                                          strlen($data)<20?$b=8:$b=4;
                                          $pdf->MultiCell(18,$b,$data,'1','C');
                                          $pdf->SetXY($x + 239, $y); 
                                          $data = $row['short_pre_proc_qty'];
                                          strlen($data)<20?$b=8:$b=4;
                                          $pdf->MultiCell(23,$b,$data,'1','C');
                                          $pdf->SetXY($x + 262, $y);
                                          $data = $row['short_pre_proc_percent'];
                                          strlen($data)<20?$b=8:$b=4;
                                          $pdf->MultiCell(18,$b,$data,'1','C');  
    
                                          if($row['short_excess_qty']!= '') 
                                              {
                                                  $process_loss_gain+=$row['short_excess_qty'];
                                              }
                                  
                                              $Total_pp_quantity = $row['pp_quantity'];
                                              $Total_greige_quantity = $row['process_qty'];
                                       
                                      }
    
                  }
              }

            /*********************************Create Ready For Dyeing (Process No- 11) Table**********************************/

            $greige_period = "select ptftri.pp_number, ptftri.process_id, date_format(min(ptftri.partial_test_for_test_result_creation_date), '%d-%b-%Y') start_date,
            date_format(max(ptftri.partial_test_for_test_result_creation_date), '%d-%b-%Y') end_date
            from partial_test_for_test_result_info  ptftri
            where  ptftri.process_id = 'proc_11' and ptftri.pp_number = '$pp_number'  
              ";

$result_for_greige= mysqli_query($con,$greige_period) or die(mysqli_error($con));
while($row = mysqli_fetch_array($result_for_greige))  
{  
    if($row['end_date']!= '') 
    {
        $process_completion_date = $row['end_date'];
    }

    if($row_for_select_process["process_id"] == "proc_11")
    {
        $Serial+=1;

        $sql_for_ready_for_dyeing ="select pp.pp_number, pp.version_name as version_number, pp.color, pp.style_name, pp.gw, pp.fw, pp.pp_quantity, result.after_trolley_or_batcher_qty, result.date, 
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
        ptftri.pp_number = aptv.pp_number and ptftri.version_id = aptv.version_id and ptftri.style=aptv.style_name  and ptftri.process_name=aptv.process_name and ptftri.process_id = 'proc_11'
         and ptftri.pp_number = '$pp_number')result 
        
        on pp.pp_number = result.pp_number and pp.version_id = result.version_id  order by result.date, pp.pp_number, pp.version_id, pp.color, pp.style_name, pp.gw, pp.fw";
         

        $result_for_ready_for_dyeing= mysqli_query($con,$sql_for_ready_for_dyeing) or die(mysqli_error($con));

        $row_number_for_ready_for_dyeing = mysqli_num_rows($result_for_ready_for_dyeing);

        $counter = $counter + ($row_number_for_ready_for_dyeing*8) + 10 + 10; 

        if($counter>200)
            {
                $pdf->AddPage();
                $pdf->SetLeftMargin(8);
                $counter =30;
                $counter = $counter + ($row_number_for_ready_for_dyeing*8) + 10 + 10; 

            } 

        $pdf->SetFont('Arial','B',14);
        $pdf->Ln(3);
        $pdf->Cell(280,7,$Serial.'.'.'  '.'Ready for Dyeing'.'   ('.$row["start_date"].' To '.$row["end_date"].')'.$pdf->SetFillColor(255,255,255),"0","1","L",true);
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
        $pdf->MultiCell(28,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
        $pdf->SetXY($x + 49, $y);
        $data = "Color";
        strlen($data)<15?$b=10:$b=5;
        $pdf->MultiCell(24,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
        $pdf->SetXY($x + 73, $y);
        $data = "Style";
        strlen($data)<15?$b=10:$b=5;
        $pdf->MultiCell(24,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
        $pdf->SetXY($x + 97, $y);
        $data = "Greige Width (inch)";
        strlen($data)<10?$b=10:$b=5;
        $pdf->MultiCell(21,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
        $pdf->SetXY($x + 118, $y);
        $data = "Finish Width (inch)";
        strlen($data)<10?$b=10:$b=5;
        $pdf->MultiCell(21,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
        $pdf->SetXY($x + 139, $y);
        $data = "Before Trolley No.";
        strlen($data)<10?$b=10:$b=5;
        $pdf->MultiCell(20,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
        $pdf->SetXY($x + 159, $y);
        $data = "B. Process Qty (mtr.)";
        strlen($data)<15?$b=10:$b=5;
        $pdf->MultiCell(20,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
        $pdf->SetXY($x + 179, $y);
        $data = "After Trolley No.";
        strlen($data)<10?$b=10:$b=5;
        $pdf->MultiCell(20,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
        $pdf->SetXY($x + 199, $y);
        $data = "Process Qty (mtr.)";
        strlen($data)<10?$b=10:$b=5;
        $pdf->MultiCell(20,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
        $pdf->SetXY($x + 219, $y);
        $data = "(+/-) From Prev. Process";
        strlen($data)<10?$b=10:$b=5;
        $pdf->MultiCell(41,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
        $pdf->SetXY($x + 219, $y+5);
        $data = "Qty (mtr.)";
        // strlen($data)<15?$b=10:$b=5;
        $pdf->MultiCell(23,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
        $pdf->SetXY($x + 242, $y+5);
        $data = "%";
        // strlen($data)<15?$b=10:$b=5;
        $pdf->MultiCell(18,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
        $pdf->SetXY($x + 260, $y);
        $data = "Process / Reprocess";
        strlen($data)<10?$b=10:$b=5;
        $pdf->MultiCell(20,$b,"$data".$pdf->SetFillColor(220,220,220),'1','C',TRUE);
        // $pdf->SetXY($x + 194, $y);

        $pdf->Cell(200,0,$pdf->SetFillColor(255,255,255),'1','1','c',true);

        $pdf->SetFont('Arial','',9);


                                        while($row = mysqli_fetch_array($result_for_ready_for_dyeing))  
                                        {
                                            $x = $pdf->GetX();
                                            $y = $pdf->GetY();
                                            $data = $row['date'];
                                            strlen($data)<20?$b=8:$b=4;
                                            $pdf->MultiCell(21,$b,$data,'1','C');
                                            $pdf->SetXY($x + 21, $y);
                                            $data = $row['version_number'];
                                            strlen($data)<20?$b=8:$b=4;
                                            $pdf->MultiCell(28,$b,$data,'1','C');
                                            $pdf->SetXY($x + 49, $y);
                                            $data = $row['color'];
                                            strlen($data)<20?$b=8:$b=4;
                                            $pdf->MultiCell(24,$b,$data,'1','C');
                                            $pdf->SetXY($x + 73, $y);
                                            $data = $row['style_name'];
                                            strlen($data)<10?$b=8:$b=4;
                                            $pdf->MultiCell(24,$b,$data,'1','C');
                                            $pdf->SetXY($x + 97, $y);
                                            $data = $row['gw'];
                                            strlen($data)<20?$b=8:$b=4;
                                            $pdf->MultiCell(21,$b,$data,'1','C');
                                            $pdf->SetXY($x + 118, $y);
                                            $data = $row['fw'];
                                            strlen($data)<20?$b=8:$b=4;
                                            $pdf->MultiCell(21,$b,$data,'1','C');
                                            $pdf->SetXY($x + 139, $y);
                                            $data = $row['before_trolley_number_or_batcher_number'];
                                            strlen($data)<20?$b=8:$b=4;
                                            $pdf->MultiCell(20,$b,$data,'1','C');
                                            $pdf->SetXY($x + 159, $y);
                                            $data = $row['before_trolley_or_batcher_qty'];
                                            strlen($data)<20?$b=8:$b=4;
                                            $pdf->MultiCell(20,$b,$data,'1','C');
                                            $pdf->SetXY($x + 179, $y);
                                            $data = $row['after_trolley_number_or_batcher_number'];
                                            strlen($data)<20?$b=8:$b=4;
                                            $pdf->MultiCell(20,$b,$data,'1','C');
                                            $pdf->SetXY($x + 199, $y);
                                            $data = $row['after_trolley_or_batcher_qty'];
                                            strlen($data)<20?$b=8:$b=4;
                                            $pdf->MultiCell(20,$b,$data,'1','C');
                                            $pdf->SetXY($x + 219, $y);
                                            $data = $row['short_proc'];
                                            strlen($data)<20?$b=8:$b=4;
                                            $pdf->MultiCell(23,$b,$data,'1','C');
                                            $pdf->SetXY($x + 242, $y);
                                            $data = $row['short_percent'];
                                            strlen($data)<20?$b=8:$b=4;
                                            $pdf->MultiCell(18,$b,$data,'1','C');
                                            $pdf->SetXY($x + 260, $y);
                                            $data = $row['process_or_reprocess'];
                                            strlen($data)<20?$b=8:$b=4;
                                            $pdf->SetFont('Arial','',7);
                                                          $pdf->MultiCell(20,$b,$data,'1','C'); 
                                                          $pdf->SetFont('Arial','',9); 
                                        }



                                // Width summary for Ready for Dyeing	

                                $sql_for_ready_for_dyeing_width = "select pp.pp_number, pp.gw, pp.fw, pp.pp_quantity, result.process_qty, result.before_process_qty, result.gray_process_qty,
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
                               and ptftri.process_id = 'proc_11' and ptftri.pp_number = '$pp_number'
                                group by ptftri.pp_number, pwvci.finish_width_in_inch, pwvci.greige_width_in_inch,ptftri.version_id )P
                               where  1=1
                               and ptftri_1.process_id = p.process_id
                               and ptftri_1.pp_number = p.pp_number
                               and ptftri_1.version_id = p.version_id
                               and ptftri_1.partial_test_for_test_result_creation_date = p.max_date
                               group by process_id,pp_number, fw,  gw)result 
                               on pp.pp_number = result.pp_number and pp.fw = result.fw and pp.gw = result.gw 
                               order by pp.pp_number, pp.gw, pp.fw";
                                
                                $result_for_ready_for_dyeing_width= mysqli_query($con,$sql_for_ready_for_dyeing_width) or die(mysqli_error($con));

                                $row_number_for_ready_for_dyeing_width = mysqli_num_rows($result_for_ready_for_dyeing_width);

                                $counter = $counter + ($row_number_for_ready_for_dyeing_width*8) + 10 + 10; 
                  
                                  if($counter>200)
                                      {
                                          $pdf->AddPage();
                                          $pdf->SetLeftMargin(8);
                                          $counter =30;
                                          $counter = $counter + ($row_number_for_ready_for_dyeing_width*8) + 10 + 10; 
                                      } 

                                $pdf->SetFont('Arial','B',11);
                                $pdf->Ln(3);
                                $pdf->Cell(280,7,"Width Summary".$pdf->SetFillColor(220,220,220),"1","1","C",true);
                                $pdf->SetFont('Arial','B',9);

                                $x = $pdf->GetX();
                                $y = $pdf->GetY();
                                $data = "Greige Width (inch)";
                                strlen($data)<15?$b=10:$b=5;
                                $pdf->MultiCell(30,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 30, $y);
                                $data = "Finish Width (inch)";
                                strlen($data)<15?$b=10:$b=5;
                                $pdf->MultiCell(30,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 60, $y);
                                $data = "PP Quantity. (mtr.)";
                                strlen($data)<25?$b=10:$b=5;
                                $pdf->MultiCell(32,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 92, $y);
                                $data = "Before Process Quantity (mtr.)";
                                strlen($data)<25?$b=10:$b=5;
                                $pdf->MultiCell(33,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 125, $y);
                                $data = "Process Quantity. (mtr.)";
                                strlen($data)<15?$b=10:$b=5;
                                $pdf->MultiCell(32,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 157, $y);
                                $data = "(+/-) From PP";
                                // strlen($data)<15?$b=10:$b=5;
                                $pdf->MultiCell(41,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 157, $y+5);
                                $data = "Qty (mtr.)";
                                // strlen($data)<15?$b=10:$b=5;
                                $pdf->MultiCell(23,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 180, $y+5);
                                $data = "%";
                                // strlen($data)<15?$b=10:$b=5;
                                $pdf->MultiCell(18,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 198, $y);
                                $data = "(+/-) From Greige";
                                // strlen($data)<15?$b=10:$b=5;
                                $pdf->MultiCell(41,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 198, $y+5);
                                $data = "Qty (mtr.)";
                                // strlen($data)<15?$b=10:$b=5;
                                $pdf->MultiCell(23,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 221, $y+5);
                                $data = "%";
                                // strlen($data)<15?$b=10:$b=5;
                                $pdf->MultiCell(18,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 239, $y);
                                $data = "(+/-) From Prev. Process";
                                // strlen($data)<15?$b=10:$b=5;
                                $pdf->MultiCell(41,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 239, $y+5);
                                $data = "Qty (mtr.)";
                                // strlen($data)<15?$b=10:$b=5;
                                $pdf->MultiCell(23,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 262, $y+5);
                                $data = "%";
                                // strlen($data)<15?$b=10:$b=5;
                                $pdf->MultiCell(18,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 280, $y);
                                
                                // $pdf->Cell(0,0,$pdf->SetFillColor(255,255,255),'1','1','C',true);
                                $pdf->SetFont('Arial','',9);       
                                 $pdf->Ln(10);
                               
                                
                            while($row = mysqli_fetch_array($result_for_ready_for_dyeing_width))  
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
                                $pdf->MultiCell(32,$b,$data,'1','C');
                                $pdf->SetXY($x + 92, $y);
                                $data = $row['before_process_qty'];
                                strlen($data)<20?$b=8:$b=4;
                                $pdf->MultiCell(33,$b,$data,'1','C');
                                $pdf->SetXY($x + 125, $y);
                                $data = $row['process_qty'];
                                strlen($data)<20?$b=8:$b=4;
                                $pdf->MultiCell(32,$b,$data,'1','C');
                                $pdf->SetXY($x + 157, $y);
                                $data = $row['short_pp_qty'];
                                strlen($data)<15?$b=8:$b=4;
                                $pdf->MultiCell(23,$b,$data,'1','C');
                                $pdf->SetXY($x + 180, $y);
                                $data = $row['short_pp_percent'];
                                strlen($data)<15?$b=8:$b=4;
                                $pdf->MultiCell(18,$b,$data,'1','C');
                                $pdf->SetXY($x + 198, $y);
                                $data = $row['short_gre_rcv_qty'];
                                strlen($data)<15?$b=8:$b=4;
                                $pdf->MultiCell(23,$b,$data,'1','C');
                                $pdf->SetXY($x + 221, $y);
                                $data = $row['short_gre_rcv_percent'];
                                strlen($data)<15?$b=8:$b=4;
                                $pdf->MultiCell(18,$b,$data,'1','C');
                                $pdf->SetXY($x + 239, $y);
                                $data = $row['short_pre_proc_qty'];
                                strlen($data)<15?$b=8:$b=4;
                                $pdf->MultiCell(23,$b,$data,'1','C');
                                $pdf->SetXY($x + 262, $y);
                                $data = $row['short_pre_proc_percent'];
                                strlen($data)<15?$b=8:$b=4;
                                $pdf->MultiCell(18,$b,$data,'1','C');
                                // $pdf->SetXY($x + 200, $y);

                            }
                                // Version summary for Ready for Dyeing

                                 $sql_for_ready_for_dyeing_version = "select pp.pp_number, pp.version_name version_number, pp.style_name, pp.color, pp.gw, pp.fw, pp.pp_quantity, result.process_qty, result.before_process_qty, result.gray_process_qty, 
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
                                 and ptftri.process_id = 'proc_11' and ptftri.pp_number = '$pp_number'
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

                                  $result_for_ready_for_dyeing_version= mysqli_query($con,$sql_for_ready_for_dyeing_version) or die(mysqli_error($con));

                                  $row_number_for_ready_for_dyeing_version = mysqli_num_rows($result_for_ready_for_dyeing_version);

                                  $counter = $counter + ($row_number_for_ready_for_dyeing_version*8) + 10 + 10 + 8; 
                  
                                  if($counter>200)
                                      {
                                          $pdf->AddPage();
                                          $pdf->SetLeftMargin(8);
                                          $counter =30;
                                          $counter = $counter + ($row_number_for_ready_for_dyeing_version*8) + 10 + 10 + 8; 

                                      } 

                                  $pdf->SetFont('Arial','B',11);
                                  $pdf->Ln(3);
                                  $pdf->Cell(280,7,"Version Summary".$pdf->SetFillColor(220,220,220),"1","1","C",true);
                                  $pdf->SetFont('Arial','B',9);

                                $x = $pdf->GetX();
                                $y = $pdf->GetY();
                                $data = "Version";
                                strlen($data)<15?$b=10:$b=5;
                                $pdf->MultiCell(28,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 28, $y);
                                $data = "Color";
                                strlen($data)<15?$b=10:$b=5;
                                $pdf->MultiCell(24,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 52, $y);
                                $data = "Style";
                                strlen($data)<15?$b=10:$b=5;
                                $pdf->MultiCell(24,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 76, $y);
                                $data = "PP Quantity (mtr.)";
                                strlen($data)<15?$b=10:$b=5;
                                $pdf->MultiCell(27,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 103, $y);
                                $data = "Before process Qty (mtr.)";
                                strlen($data)<20?$b=10:$b=5;
                                $pdf->MultiCell(27,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 130, $y);
                                $data = "Process Quantity (mtr.)";
                                strlen($data)<20?$b=10:$b=5;
                                $pdf->MultiCell(27,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 157, $y);
                                $data = "(+/-) From PP";
                                // strlen($data)<15?$b=10:$b=5;
                                $pdf->MultiCell(41,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 157, $y+5);
                                $data = "Qty (mtr.)";
                                // strlen($data)<15?$b=10:$b=5;
                                $pdf->MultiCell(23,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 180, $y+5);
                                $data = "%";
                                // strlen($data)<15?$b=10:$b=5;
                                $pdf->MultiCell(18,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 198, $y);
                                $data = "(+/-) From Greige";
                                // strlen($data)<15?$b=10:$b=5;
                                $pdf->MultiCell(41,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 198, $y+5);
                                $data = "Qty (mtr.)";
                                // strlen($data)<15?$b=10:$b=5;
                                $pdf->MultiCell(23,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 221, $y+5);
                                $data = "%";
                                // strlen($data)<15?$b=10:$b=5;
                                $pdf->MultiCell(18,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 239, $y);
                                $data = "(+/-) From Prev. Process";
                                // strlen($data)<15?$b=10:$b=5;
                                $pdf->MultiCell(41,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 239, $y+5);
                                $data = "Qty (mtr.)";
                                // strlen($data)<15?$b=10:$b=5;
                                $pdf->MultiCell(23,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 262, $y+5);
                                $data = "%";
                                // strlen($data)<15?$b=10:$b=5;
                                $pdf->MultiCell(18,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 280, $y);
                                
                                // $pdf->Cell(0,0,$pdf->SetFillColor(255,255,255),'1','1','C',true);
                                $pdf->SetFont('Arial','',9);       
                                 $pdf->Ln(10);
    
                          while($row = mysqli_fetch_array($result_for_ready_for_dyeing_version))  
                          {  
                              $x = $pdf->GetX();
                              $y = $pdf->GetY();
                              $data = $row['version_number'];
                              strlen($data)<16?$b=8:$b=4;
                              $pdf->MultiCell(28,$b,$data,'1','C');
                              $pdf->SetXY($x + 28, $y);
                              $data = $row['color'];
                              strlen($data)<20?$b=8:$b=4;
                              $pdf->MultiCell(24,$b,$data,'1','C');
                              $pdf->SetXY($x + 52, $y);
                              $data = $row['style_name'];
                              strlen($data)<10?$b=8:$b=4;
                              $pdf->MultiCell(24,$b,$data,'1','C');
                              $pdf->SetXY($x + 76, $y);
                              $data = $row['pp_quantity'];
                              strlen($data)<20?$b=8:$b=4;
                              $pdf->MultiCell(27,$b,$data,'1','C');
                              $pdf->SetXY($x + 103, $y);
                              $data = $row['before_process_qty'];
                              strlen($data)<20?$b=8:$b=4;
                              $pdf->MultiCell(27,$b,$data,'1','C');
                              $pdf->SetXY($x + 130, $y);
                              $data = $row['process_qty'];
                              strlen($data)<20?$b=8:$b=4;
                              $pdf->MultiCell(27,$b,$data,'1','C');
                              $pdf->SetXY($x + 157, $y);
                              $data = $row['short_pp'];
                              strlen($data)<15?$b=8:$b=4;
                              $pdf->MultiCell(23,$b,$data,'1','C');
                              $pdf->SetXY($x + 180, $y);
                              $data = $row['short_pp_percent'];
                              strlen($data)<15?$b=8:$b=4;
                              $pdf->MultiCell(18,$b,$data,'1','C');
                              $pdf->SetXY($x + 198, $y);
                              $data = $row['short_gre_rcv_qty'];
                              strlen($data)<15?$b=8:$b=4;
                              $pdf->MultiCell(23,$b,$data,'1','C');
                              $pdf->SetXY($x + 221, $y);
                              $data = $row['short_gre_rcv_percent'];
                              strlen($data)<15?$b=8:$b=4;
                              $pdf->MultiCell(18,$b,$data,'1','C');
                              $pdf->SetXY($x + 239, $y);
                              $data = $row['short_pre_proc_qty'];
                              strlen($data)<15?$b=8:$b=4;
                              $pdf->MultiCell(23,$b,$data,'1','C');
                              $pdf->SetXY($x + 262, $y);
                              $data = $row['short_pre_proc_percent'];
                              strlen($data)<15?$b=8:$b=4;
                              $pdf->MultiCell(18,$b,$data,'1','C');
                              // $pdf->SetXY($x + 280, $y);

                          }

                          $sql_for_ready_for_dyeing_total = "select total.pp_number, sum(total.pp_quantity) pp_quantity, sum(total.process_qty) process_qty, 
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
                                                    and ptftri.process_id = 'proc_11' and ptftri.pp_number = '$pp_number'
                                                    group by ptftri.pp_number, ptftri.version_number, ptftri.finish_width_in_inch )P
                                                    where  1=1
                                                    and ptftri_1.process_id = p.process_id
                                                    and ptftri_1.pp_number = p.pp_number
                                                    and ptftri_1.version_number = p.version_name
                                                    and ptftri_1.partial_test_for_test_result_creation_date = p.max_date
                                                    and ptftri_1.finish_width_in_inch = p.finish_width_in_inch
                                                    group by process_id,pp_number, version_name)result where pp.pp_number = result.pp_number and pp.version_name = result.version_name ) total
                                                    ";
                        $result_for_ready_for_dyeing_total= mysqli_query($con,$sql_for_ready_for_dyeing_total) or die(mysqli_error($con));
                        while($row = mysqli_fetch_array($result_for_ready_for_dyeing_total))  
                        {
                            $pdf->SetFont('Arial','B',9); 
                            $x = $pdf->GetX();
                            $y = $pdf->GetY();
                            $data = "Ready for Dyeing Total Qty. (mtr.)";
                            strlen($data)<70?$b=8:$b=4;
                            $pdf->MultiCell(76,$b,$data,'1','C');
                            $pdf->SetXY($x + 76, $y);
                            $data = $row['pp_quantity'];
                            strlen($data)<20?$b=8:$b=4;
                            $pdf->MultiCell(27,$b,$data,'1','C');
                            $pdf->SetXY($x + 103, $y);
                            $data = $row['before_process_qty'];
                            strlen($data)<20?$b=8:$b=4;
                            $pdf->MultiCell(27,$b,$data,'1','C');
                            $pdf->SetXY($x + 130, $y);
                            $data = $row['process_qty'];
                            strlen($data)<20?$b=8:$b=4;
                            $pdf->MultiCell(27,$b,$data,'1','C');
                            $pdf->SetXY($x + 157, $y);
                            $data = $row['short_pp_qty'];
                            strlen($data)<20?$b=8:$b=4;
                            $pdf->MultiCell(23,$b,$data,'1','C');
                            $pdf->SetXY($x + 180, $y);
                            $data = $row['short_pp_percent'];
                            strlen($data)<20?$b=8:$b=4;
                            $pdf->MultiCell(18,$b,$data,'1','C'); 
                            $pdf->SetXY($x + 198, $y); 
                            $data = $row['short_gre_rcv_qty'];
                            strlen($data)<20?$b=8:$b=4;
                            $pdf->MultiCell(23,$b,$data,'1','C');
                            $pdf->SetXY($x + 221, $y);
                            $data = $row['short_gre_rcv_percent'];
                            strlen($data)<20?$b=8:$b=4;
                            $pdf->MultiCell(18,$b,$data,'1','C');
                            $pdf->SetXY($x + 239, $y); 
                            $data = $row['short_pre_proc_qty'];
                            strlen($data)<20?$b=8:$b=4;
                            $pdf->MultiCell(23,$b,$data,'1','C');
                            $pdf->SetXY($x + 262, $y);
                            $data = $row['short_pre_proc_percent'];
                            strlen($data)<20?$b=8:$b=4;
                            $pdf->MultiCell(18,$b,$data,'1','C');  

                            if($row['short_excess_qty']!= '') 
                                {
                                    $process_loss_gain+=$row['short_excess_qty'];
                                }
                    
                                $Total_pp_quantity = $row['pp_quantity'];
                                $Total_greige_quantity = $row['process_qty'];
                         
                        }

    }
  }

  /*********************************Create Dyeing (Process No- 12) Table**********************************/

  $greige_period = "select ptftri.pp_number, ptftri.process_id, date_format(min(ptftri.partial_test_for_test_result_creation_date), '%d-%b-%Y') start_date,
        date_format(max(ptftri.partial_test_for_test_result_creation_date), '%d-%b-%Y') end_date
        from partial_test_for_test_result_info  ptftri
        where  ptftri.process_id = 'proc_12' and ptftri.pp_number = '$pp_number'  
          ";

$result_for_greige= mysqli_query($con,$greige_period) or die(mysqli_error($con));
while($row = mysqli_fetch_array($result_for_greige))  
{  
    if($row['end_date']!= '') 
    {
        $process_completion_date = $row['end_date'];
    }

    if($row_for_select_process["process_id"] == "proc_12")
    {
        $Serial+=1;

        $sql_for_dyeing = "select pp.pp_number, pp.version_name as version_number, pp.color, pp.style_name, pp.gw, pp.fw, pp.pp_quantity, result.after_trolley_or_batcher_qty, result.date, 
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
        ptftri.pp_number = aptv.pp_number and ptftri.version_id = aptv.version_id and ptftri.style=aptv.style_name  and ptftri.process_name=aptv.process_name and ptftri.process_id = 'proc_12'
         and ptftri.pp_number = '$pp_number')result 
        
        on pp.pp_number = result.pp_number and pp.version_id = result.version_id  order by result.date, pp.pp_number, pp.version_id, pp.color, pp.style_name, pp.gw, pp.fw";
         
        $result_for_dyeing= mysqli_query($con,$sql_for_dyeing) or die(mysqli_error($con));

        $row_number_for_dyeing = mysqli_num_rows($result_for_dyeing);

        $counter = $counter + ($row_number_for_dyeing*8) + 10 + 10; 

        if($counter>200)
            {
                $pdf->AddPage();
                $pdf->SetLeftMargin(8);
                $counter =30;
                $counter = $counter + ($row_number_for_dyeing*8) + 10 + 10; 

            } 

        $pdf->SetFont('Arial','B',14);
        $pdf->Ln(3);
        $pdf->Cell(280,7,$Serial.'.'.'  '.'Dyeing'.'   ('.$row["start_date"].' To '.$row["end_date"].')'.$pdf->SetFillColor(255,255,255),"0","1","L",true);
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
        $pdf->MultiCell(28,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
        $pdf->SetXY($x + 49, $y);
        $data = "Color";
        strlen($data)<15?$b=10:$b=5;
        $pdf->MultiCell(24,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
        $pdf->SetXY($x + 73, $y);
        $data = "Style";
        strlen($data)<15?$b=10:$b=5;
        $pdf->MultiCell(24,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
        $pdf->SetXY($x + 97, $y);
        $data = "Greige Width (inch)";
        strlen($data)<10?$b=10:$b=5;
        $pdf->MultiCell(21,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
        $pdf->SetXY($x + 118, $y);
        $data = "Finish Width (inch)";
        strlen($data)<10?$b=10:$b=5;
        $pdf->MultiCell(21,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
        $pdf->SetXY($x + 139, $y);
        $data = "Before Trolley No.";
        strlen($data)<10?$b=10:$b=5;
        $pdf->MultiCell(20,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
        $pdf->SetXY($x + 159, $y);
        $data = "B. Process Qty (mtr.)";
        strlen($data)<15?$b=10:$b=5;
        $pdf->MultiCell(20,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
        $pdf->SetXY($x + 179, $y);
        $data = "After Trolley No.";
        strlen($data)<10?$b=10:$b=5;
        $pdf->MultiCell(20,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
        $pdf->SetXY($x + 199, $y);
        $data = "Process Qty (mtr.)";
        strlen($data)<10?$b=10:$b=5;
        $pdf->MultiCell(20,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
        $pdf->SetXY($x + 219, $y);
        $data = "(+/-) From Prev. Process";
        strlen($data)<10?$b=10:$b=5;
        $pdf->MultiCell(41,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
        $pdf->SetXY($x + 219, $y+5);
        $data = "Qty (mtr.)";
        // strlen($data)<15?$b=10:$b=5;
        $pdf->MultiCell(23,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
        $pdf->SetXY($x + 242, $y+5);
        $data = "%";
        // strlen($data)<15?$b=10:$b=5;
        $pdf->MultiCell(18,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
        $pdf->SetXY($x + 260, $y);
        $data = "Process / Reprocess";
        strlen($data)<10?$b=10:$b=5;
        $pdf->MultiCell(20,$b,"$data".$pdf->SetFillColor(220,220,220),'1','C',TRUE);
        // $pdf->SetXY($x + 194, $y);

        $pdf->Cell(200,0,$pdf->SetFillColor(255,255,255),'1','1','c',true);

        $pdf->SetFont('Arial','',9);


                                        while($row = mysqli_fetch_array($result_for_dyeing))  
                                        {
                                            $x = $pdf->GetX();
                                            $y = $pdf->GetY();
                                            $data = $row['date'];
                                            strlen($data)<20?$b=8:$b=4;
                                            $pdf->MultiCell(21,$b,$data,'1','C');
                                            $pdf->SetXY($x + 21, $y);
                                            $data = $row['version_number'];
                                            strlen($data)<16?$b=8:$b=4;
                                            $pdf->MultiCell(28,$b,$data,'1','C');
                                            $pdf->SetXY($x + 49, $y);
                                            $data = $row['color'];
                                            strlen($data)<20?$b=8:$b=4;
                                            $pdf->MultiCell(24,$b,$data,'1','C');
                                            $pdf->SetXY($x + 73, $y);
                                            $data = $row['style_name'];
                                            strlen($data)<10?$b=8:$b=4;
                                            $pdf->MultiCell(24,$b,$data,'1','C');
                                            $pdf->SetXY($x + 97, $y);
                                            $data = $row['gw'];
                                            strlen($data)<20?$b=8:$b=4;
                                            $pdf->MultiCell(21,$b,$data,'1','C');
                                            $pdf->SetXY($x + 118, $y);
                                            $data = $row['fw'];
                                            strlen($data)<20?$b=8:$b=4;
                                            $pdf->MultiCell(21,$b,$data,'1','C');
                                            $pdf->SetXY($x + 139, $y);
                                            $data = $row['before_trolley_number_or_batcher_number'];
                                            strlen($data)<20?$b=8:$b=4;
                                            $pdf->MultiCell(20,$b,$data,'1','C');
                                            $pdf->SetXY($x + 159, $y);
                                            $data = $row['before_trolley_or_batcher_qty'];
                                            strlen($data)<20?$b=8:$b=4;
                                            $pdf->MultiCell(20,$b,$data,'1','C');
                                            $pdf->SetXY($x + 179, $y);
                                            $data = $row['after_trolley_number_or_batcher_number'];
                                            strlen($data)<20?$b=8:$b=4;
                                            $pdf->MultiCell(20,$b,$data,'1','C');
                                            $pdf->SetXY($x + 199, $y);
                                            $data = $row['after_trolley_or_batcher_qty'];
                                            strlen($data)<20?$b=8:$b=4;
                                            $pdf->MultiCell(20,$b,$data,'1','C');
                                            $pdf->SetXY($x + 219, $y);
                                            $data = $row['short_proc'];
                                            strlen($data)<20?$b=8:$b=4;
                                            $pdf->MultiCell(23,$b,$data,'1','C');
                                            $pdf->SetXY($x + 242, $y);
                                            $data = $row['short_percent'];
                                            strlen($data)<20?$b=8:$b=4;
                                            $pdf->MultiCell(18,$b,$data,'1','C');
                                            $pdf->SetXY($x + 260, $y);
                                            $data = $row['process_or_reprocess'];
                                            strlen($data)<20?$b=8:$b=4;
                                            $pdf->SetFont('Arial','',7);
                                                          $pdf->MultiCell(20,$b,$data,'1','C'); 
                                                          $pdf->SetFont('Arial','',9);
                                        }



                                // Width summary for Dyeing

                                $sql_for_dyeing_width = "select pp.pp_number, pp.gw, pp.fw, pp.pp_quantity, result.process_qty, result.before_process_qty, result.gray_process_qty,
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
                               and ptftri.process_id = 'proc_12' and ptftri.pp_number = '$pp_number'
                                group by ptftri.pp_number, pwvci.finish_width_in_inch, pwvci.greige_width_in_inch,ptftri.version_id )P
                               where  1=1
                               and ptftri_1.process_id = p.process_id
                               and ptftri_1.pp_number = p.pp_number
                               and ptftri_1.version_id = p.version_id
                               and ptftri_1.partial_test_for_test_result_creation_date = p.max_date
                               group by process_id,pp_number, fw,  gw)result 
                               on pp.pp_number = result.pp_number and pp.fw = result.fw and pp.gw = result.gw 
                               order by pp.pp_number, pp.gw, pp.fw";
                                
                                $result_for_dyeing_width= mysqli_query($con,$sql_for_dyeing_width) or die(mysqli_error($con));

                                $row_number_for_dyeing_width = mysqli_num_rows($result_for_dyeing_width);

                                $counter = $counter + ($row_number_for_dyeing_width*8) + 10 + 10; 
                  
                                  if($counter>200)
                                      {
                                          $pdf->AddPage();
                                          $pdf->SetLeftMargin(8);
                                          $counter =30;
                                          $counter = $counter + ($row_number_for_dyeing_width*8) + 10 + 10; 
                                      } 

                                $pdf->SetFont('Arial','B',11);
                                $pdf->Ln(3);
                                $pdf->Cell(280,7,"Width Summary".$pdf->SetFillColor(220,220,220),"1","1","C",true);
                                $pdf->SetFont('Arial','B',9);

                                $x = $pdf->GetX();
                                $y = $pdf->GetY();
                                $data = "Greige Width (inch)";
                                strlen($data)<15?$b=10:$b=5;
                                $pdf->MultiCell(30,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 30, $y);
                                $data = "Finish Width (inch)";
                                strlen($data)<15?$b=10:$b=5;
                                $pdf->MultiCell(30,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 60, $y);
                                $data = "PP Quantity. (mtr.)";
                                strlen($data)<25?$b=10:$b=5;
                                $pdf->MultiCell(32,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 92, $y);
                                $data = "Before Process Quantity (mtr.)";
                                strlen($data)<25?$b=10:$b=5;
                                $pdf->MultiCell(33,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 125, $y);
                                $data = "Process Quantity. (mtr.)";
                                strlen($data)<15?$b=10:$b=5;
                                $pdf->MultiCell(32,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 157, $y);
                                $data = "(+/-) From PP";
                                // strlen($data)<15?$b=10:$b=5;
                                $pdf->MultiCell(41,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 157, $y+5);
                                $data = "Qty (mtr.)";
                                // strlen($data)<15?$b=10:$b=5;
                                $pdf->MultiCell(23,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 180, $y+5);
                                $data = "%";
                                // strlen($data)<15?$b=10:$b=5;
                                $pdf->MultiCell(18,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 198, $y);
                                $data = "(+/-) From Greige";
                                // strlen($data)<15?$b=10:$b=5;
                                $pdf->MultiCell(41,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 198, $y+5);
                                $data = "Qty (mtr.)";
                                // strlen($data)<15?$b=10:$b=5;
                                $pdf->MultiCell(23,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 221, $y+5);
                                $data = "%";
                                // strlen($data)<15?$b=10:$b=5;
                                $pdf->MultiCell(18,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 239, $y);
                                $data = "(+/-) From Prev. Process";
                                // strlen($data)<15?$b=10:$b=5;
                                $pdf->MultiCell(41,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 239, $y+5);
                                $data = "Qty (mtr.)";
                                // strlen($data)<15?$b=10:$b=5;
                                $pdf->MultiCell(23,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 262, $y+5);
                                $data = "%";
                                // strlen($data)<15?$b=10:$b=5;
                                $pdf->MultiCell(18,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 280, $y);
                                
                                // $pdf->Cell(0,0,$pdf->SetFillColor(255,255,255),'1','1','C',true);
                                $pdf->SetFont('Arial','',9);       
                                 $pdf->Ln(10);
                               
                                
                            while($row = mysqli_fetch_array($result_for_dyeing_width))  
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
                                $pdf->MultiCell(32,$b,$data,'1','C');
                                $pdf->SetXY($x + 92, $y);
                                $data = $row['before_process_qty'];
                                strlen($data)<20?$b=8:$b=4;
                                $pdf->MultiCell(33,$b,$data,'1','C');
                                $pdf->SetXY($x + 125, $y);
                                $data = $row['process_qty'];
                                strlen($data)<20?$b=8:$b=4;
                                $pdf->MultiCell(32,$b,$data,'1','C');
                                $pdf->SetXY($x + 157, $y);
                                $data = $row['short_pp_qty'];
                                strlen($data)<15?$b=8:$b=4;
                                $pdf->MultiCell(23,$b,$data,'1','C');
                                $pdf->SetXY($x + 180, $y);
                                $data = $row['short_pp_percent'];
                                strlen($data)<15?$b=8:$b=4;
                                $pdf->MultiCell(18,$b,$data,'1','C');
                                $pdf->SetXY($x + 198, $y);
                                $data = $row['short_gre_rcv_qty'];
                                strlen($data)<15?$b=8:$b=4;
                                $pdf->MultiCell(23,$b,$data,'1','C');
                                $pdf->SetXY($x + 221, $y);
                                $data = $row['short_gre_rcv_percent'];
                                strlen($data)<15?$b=8:$b=4;
                                $pdf->MultiCell(18,$b,$data,'1','C');
                                $pdf->SetXY($x + 239, $y);
                                $data = $row['short_pre_proc_qty'];
                                strlen($data)<15?$b=8:$b=4;
                                $pdf->MultiCell(23,$b,$data,'1','C');
                                $pdf->SetXY($x + 262, $y);
                                $data = $row['short_pre_proc_percent'];
                                strlen($data)<15?$b=8:$b=4;
                                $pdf->MultiCell(18,$b,$data,'1','C');
                                // $pdf->SetXY($x + 200, $y);

                            }
                                // Version summary for Dyeing

                                 $sql_for_dyeing_version = "select pp.pp_number, pp.version_name version_number, pp.style_name, pp.color, pp.gw, pp.fw, pp.pp_quantity, result.process_qty, result.before_process_qty, result.gray_process_qty, 
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
                                 and ptftri.process_id = 'proc_12' and ptftri.pp_number = '$pp_number'
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


                                  $result_for_dyeing_version= mysqli_query($con,$sql_for_dyeing_version) or die(mysqli_error($con));

                                  $row_number_for_dyeing_version = mysqli_num_rows($result_for_dyeing_version);

                                  $counter = $counter + ($row_number_for_dyeing_version*8) + 10 + 10 + 8; 
                  
                                  if($counter>200)
                                      {
                                          $pdf->AddPage();
                                          $pdf->SetLeftMargin(8);
                                          $counter =30;
                                          $counter = $counter + ($row_number_for_dyeing_version*8) + 10 + 10 + 8; 

                                      } 

                                  $pdf->SetFont('Arial','B',11);
                                  $pdf->Ln(3);
                                  $pdf->Cell(280,7,"Version Summary".$pdf->SetFillColor(220,220,220),"1","1","C",true);
                                  $pdf->SetFont('Arial','B',9);

                                $x = $pdf->GetX();
                                $y = $pdf->GetY();
                                $data = "Version";
                                strlen($data)<15?$b=10:$b=5;
                                $pdf->MultiCell(28,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 28, $y);
                                $data = "Color";
                                strlen($data)<15?$b=10:$b=5;
                                $pdf->MultiCell(24,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 52, $y);
                                $data = "Style";
                                strlen($data)<15?$b=10:$b=5;
                                $pdf->MultiCell(24,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 76, $y);
                                $data = "PP Quantity (mtr.)";
                                strlen($data)<15?$b=10:$b=5;
                                $pdf->MultiCell(27,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 103, $y);
                                $data = "Before process Qty (mtr.)";
                                strlen($data)<20?$b=10:$b=5;
                                $pdf->MultiCell(27,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 130, $y);
                                $data = "Process Quantity (mtr.)";
                                strlen($data)<20?$b=10:$b=5;
                                $pdf->MultiCell(27,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 157, $y);
                                $data = "(+/-) From PP";
                                // strlen($data)<15?$b=10:$b=5;
                                $pdf->MultiCell(41,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 157, $y+5);
                                $data = "Qty (mtr.)";
                                // strlen($data)<15?$b=10:$b=5;
                                $pdf->MultiCell(23,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 180, $y+5);
                                $data = "%";
                                // strlen($data)<15?$b=10:$b=5;
                                $pdf->MultiCell(18,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 198, $y);
                                $data = "(+/-) From Greige";
                                // strlen($data)<15?$b=10:$b=5;
                                $pdf->MultiCell(41,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 198, $y+5);
                                $data = "Qty (mtr.)";
                                // strlen($data)<15?$b=10:$b=5;
                                $pdf->MultiCell(23,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 221, $y+5);
                                $data = "%";
                                // strlen($data)<15?$b=10:$b=5;
                                $pdf->MultiCell(18,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 239, $y);
                                $data = "(+/-) From Prev. Process";
                                // strlen($data)<15?$b=10:$b=5;
                                $pdf->MultiCell(41,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 239, $y+5);
                                $data = "Qty (mtr.)";
                                // strlen($data)<15?$b=10:$b=5;
                                $pdf->MultiCell(23,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 262, $y+5);
                                $data = "%";
                                // strlen($data)<15?$b=10:$b=5;
                                $pdf->MultiCell(18,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 280, $y);
                                
                                // $pdf->Cell(0,0,$pdf->SetFillColor(255,255,255),'1','1','C',true);
                                $pdf->SetFont('Arial','',9);       
                                 $pdf->Ln(10);
    
                          while($row = mysqli_fetch_array($result_for_dyeing_version))  
                          {  
                              $x = $pdf->GetX();
                              $y = $pdf->GetY();
                              $data = $row['version_number'];
                              strlen($data)<20?$b=8:$b=4;
                              $pdf->MultiCell(28,$b,$data,'1','C');
                              $pdf->SetXY($x + 28, $y);
                              $data = $row['color'];
                              strlen($data)<20?$b=8:$b=4;
                              $pdf->MultiCell(24,$b,$data,'1','C');
                              $pdf->SetXY($x + 52, $y);
                              $data = $row['style_name'];
                              strlen($data)<10?$b=8:$b=4;
                              $pdf->MultiCell(24,$b,$data,'1','C');
                              $pdf->SetXY($x + 76, $y);
                              $data = $row['pp_quantity'];
                              strlen($data)<20?$b=8:$b=4;
                              $pdf->MultiCell(27,$b,$data,'1','C');
                              $pdf->SetXY($x + 103, $y);
                              $data = $row['before_process_qty'];
                              strlen($data)<20?$b=8:$b=4;
                              $pdf->MultiCell(27,$b,$data,'1','C');
                              $pdf->SetXY($x + 130, $y);
                              $data = $row['process_qty'];
                              strlen($data)<20?$b=8:$b=4;
                              $pdf->MultiCell(27,$b,$data,'1','C');
                              $pdf->SetXY($x + 157, $y);
                              $data = $row['short_pp'];
                              strlen($data)<15?$b=8:$b=4;
                              $pdf->MultiCell(23,$b,$data,'1','C');
                              $pdf->SetXY($x + 180, $y);
                              $data = $row['short_pp_percent'];
                              strlen($data)<15?$b=8:$b=4;
                              $pdf->MultiCell(18,$b,$data,'1','C');
                              $pdf->SetXY($x + 198, $y);
                              $data = $row['short_gre_rcv_qty'];
                              strlen($data)<15?$b=8:$b=4;
                              $pdf->MultiCell(23,$b,$data,'1','C');
                              $pdf->SetXY($x + 221, $y);
                              $data = $row['short_gre_rcv_percent'];
                              strlen($data)<15?$b=8:$b=4;
                              $pdf->MultiCell(18,$b,$data,'1','C');
                              $pdf->SetXY($x + 239, $y);
                              $data = $row['short_pre_proc_qty'];
                              strlen($data)<15?$b=8:$b=4;
                              $pdf->MultiCell(23,$b,$data,'1','C');
                              $pdf->SetXY($x + 262, $y);
                              $data = $row['short_pre_proc_percent'];
                              strlen($data)<15?$b=8:$b=4;
                              $pdf->MultiCell(18,$b,$data,'1','C');
                              // $pdf->SetXY($x + 280, $y);

                          }

                          $sql_for_dyeing_total = "select total.pp_number, sum(total.pp_quantity) pp_quantity, sum(total.process_qty) process_qty, 
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
            and ptftri.process_id = 'proc_12' and ptftri.pp_number = '$pp_number'
            group by ptftri.pp_number, ptftri.version_number, ptftri.finish_width_in_inch )P
            where  1=1
            and ptftri_1.process_id = p.process_id
            and ptftri_1.pp_number = p.pp_number
            and ptftri_1.version_number = p.version_name
            and ptftri_1.partial_test_for_test_result_creation_date = p.max_date
            and ptftri_1.finish_width_in_inch = p.finish_width_in_inch
            group by process_id,pp_number, version_name)result where pp.pp_number = result.pp_number and pp.version_name = result.version_name ) total
            ";
                        $result_for_dyeing_total= mysqli_query($con,$sql_for_dyeing_total) or die(mysqli_error($con));
                        while($row = mysqli_fetch_array($result_for_dyeing_total))  
                        {
                            $pdf->SetFont('Arial','B',9); 
                            $x = $pdf->GetX();
                            $y = $pdf->GetY();
                            $data = "Dyeing Total Qty. (mtr.)";
                            strlen($data)<70?$b=8:$b=4;
                            $pdf->MultiCell(76,$b,$data,'1','C');
                            $pdf->SetXY($x + 76, $y);
                            $data = $row['pp_quantity'];
                            strlen($data)<20?$b=8:$b=4;
                            $pdf->MultiCell(27,$b,$data,'1','C');
                            $pdf->SetXY($x + 103, $y);
                            $data = $row['before_process_qty'];
                            strlen($data)<20?$b=8:$b=4;
                            $pdf->MultiCell(27,$b,$data,'1','C');
                            $pdf->SetXY($x + 130, $y);
                            $data = $row['process_qty'];
                            strlen($data)<20?$b=8:$b=4;
                            $pdf->MultiCell(27,$b,$data,'1','C');
                            $pdf->SetXY($x + 157, $y);
                            $data = $row['short_pp_qty'];
                            strlen($data)<20?$b=8:$b=4;
                            $pdf->MultiCell(23,$b,$data,'1','C');
                            $pdf->SetXY($x + 180, $y);
                            $data = $row['short_pp_percent'];
                            strlen($data)<20?$b=8:$b=4;
                            $pdf->MultiCell(18,$b,$data,'1','C'); 
                            $pdf->SetXY($x + 198, $y); 
                            $data = $row['short_gre_rcv_qty'];
                            strlen($data)<20?$b=8:$b=4;
                            $pdf->MultiCell(23,$b,$data,'1','C');
                            $pdf->SetXY($x + 221, $y);
                            $data = $row['short_gre_rcv_percent'];
                            strlen($data)<20?$b=8:$b=4;
                            $pdf->MultiCell(18,$b,$data,'1','C');
                            $pdf->SetXY($x + 239, $y); 
                            $data = $row['short_pre_proc_qty'];
                            strlen($data)<20?$b=8:$b=4;
                            $pdf->MultiCell(23,$b,$data,'1','C');
                            $pdf->SetXY($x + 262, $y);
                            $data = $row['short_pre_proc_percent'];
                            strlen($data)<20?$b=8:$b=4;
                            $pdf->MultiCell(18,$b,$data,'1','C');  

                            if($row['short_excess_qty']!= '') 
                                {
                                    $process_loss_gain+=$row['short_excess_qty'];
                                }
                    
                                $Total_pp_quantity = $row['pp_quantity'];
                                $Total_greige_quantity = $row['process_qty'];
                         
                        }

    }
  }

/*********************************Create Washing (Process No- 13) Table**********************************/

$greige_period = "select ptftri.pp_number, ptftri.process_id, date_format(min(ptftri.partial_test_for_test_result_creation_date), '%d-%b-%Y') start_date,
date_format(max(ptftri.partial_test_for_test_result_creation_date), '%d-%b-%Y') end_date
from partial_test_for_test_result_info  ptftri
where  ptftri.process_id = 'proc_13' and ptftri.pp_number = '$pp_number' ";

$result_for_greige= mysqli_query($con,$greige_period) or die(mysqli_error($con));
while($row = mysqli_fetch_array($result_for_greige))  
{  
    if($row['end_date']!= '') 
    {
        $process_completion_date = $row['end_date'];
    }

    if($row_for_select_process["process_id"] == "proc_13")
    {
        $Serial+=1;

        $sql_for_washing = "select pp.pp_number, pp.version_name as version_number, pp.color, pp.style_name, pp.gw, pp.fw, pp.pp_quantity, result.after_trolley_or_batcher_qty, result.date, 
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
        ptftri.pp_number = aptv.pp_number and ptftri.version_id = aptv.version_id and ptftri.style=aptv.style_name  and ptftri.process_name=aptv.process_name and ptftri.process_id = 'proc_13'
         and ptftri.pp_number = '$pp_number')result 
        
        on pp.pp_number = result.pp_number and pp.version_id = result.version_id  order by result.date, pp.pp_number, pp.version_id, pp.color, pp.style_name, pp.gw, pp.fw";
         
        $result_for_washing= mysqli_query($con,$sql_for_washing) or die(mysqli_error($con));

        $row_number_for_washing = mysqli_num_rows($result_for_washing);

        $counter = $counter + ($row_number_for_washing*8) + 10 + 10; 

        if($counter>200)
            {
                $pdf->AddPage();
                $pdf->SetLeftMargin(8);
                $counter =30;
                $counter = $counter + ($row_number_for_washing*8) + 10 + 10; 

            } 

        $pdf->SetFont('Arial','B',14);
        $pdf->Ln(3);
        $pdf->Cell(280,7,$Serial.'.'.'  '.'Washing'.'   ('.$row["start_date"].' To '.$row["end_date"].')'.$pdf->SetFillColor(255,255,255),"0","1","L",true);
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
        $pdf->MultiCell(28,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
        $pdf->SetXY($x + 49, $y);
        $data = "Color";
        strlen($data)<15?$b=10:$b=5;
        $pdf->MultiCell(24,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
        $pdf->SetXY($x + 73, $y);
        $data = "Style";
        strlen($data)<15?$b=10:$b=5;
        $pdf->MultiCell(24,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
        $pdf->SetXY($x + 97, $y);
        $data = "Greige Width (inch)";
        strlen($data)<10?$b=10:$b=5;
        $pdf->MultiCell(21,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
        $pdf->SetXY($x + 118, $y);
        $data = "Finish Width (inch)";
        strlen($data)<10?$b=10:$b=5;
        $pdf->MultiCell(21,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
        $pdf->SetXY($x + 139, $y);
        $data = "Before Trolley No.";
        strlen($data)<10?$b=10:$b=5;
        $pdf->MultiCell(20,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
        $pdf->SetXY($x + 159, $y);
        $data = "B. Process Qty (mtr.)";
        strlen($data)<15?$b=10:$b=5;
        $pdf->MultiCell(20,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
        $pdf->SetXY($x + 179, $y);
        $data = "After Trolley No.";
        strlen($data)<10?$b=10:$b=5;
        $pdf->MultiCell(20,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
        $pdf->SetXY($x + 199, $y);
        $data = "Process Qty (mtr.)";
        strlen($data)<10?$b=10:$b=5;
        $pdf->MultiCell(20,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
        $pdf->SetXY($x + 219, $y);
        $data = "(+/-) From Prev. Process";
        strlen($data)<10?$b=10:$b=5;
        $pdf->MultiCell(41,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
        $pdf->SetXY($x + 219, $y+5);
        $data = "Qty (mtr.)";
        // strlen($data)<15?$b=10:$b=5;
        $pdf->MultiCell(23,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
        $pdf->SetXY($x + 242, $y+5);
        $data = "%";
        // strlen($data)<15?$b=10:$b=5;
        $pdf->MultiCell(18,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
        $pdf->SetXY($x + 260, $y);
        $data = "Process / Reprocess";
        strlen($data)<10?$b=10:$b=5;
        $pdf->MultiCell(20,$b,"$data".$pdf->SetFillColor(220,220,220),'1','C',TRUE);
        // $pdf->SetXY($x + 194, $y);

        $pdf->Cell(200,0,$pdf->SetFillColor(255,255,255),'1','1','c',true);

        $pdf->SetFont('Arial','',9);


                                        while($row = mysqli_fetch_array($result_for_washing))  
                                        {
                                            $x = $pdf->GetX();
                                            $y = $pdf->GetY();
                                            $data = $row['date'];
                                            strlen($data)<20?$b=8:$b=4;
                                            $pdf->MultiCell(21,$b,$data,'1','C');
                                            $pdf->SetXY($x + 21, $y);
                                            $data = $row['version_number'];
                                            strlen($data)<16?$b=8:$b=4;
                                            $pdf->MultiCell(28,$b,$data,'1','C');
                                            $pdf->SetXY($x + 49, $y);
                                            $data = $row['color'];
                                            strlen($data)<20?$b=8:$b=4;
                                            $pdf->MultiCell(24,$b,$data,'1','C');
                                            $pdf->SetXY($x + 73, $y);
                                            $data = $row['style_name'];
                                            strlen($data)<10?$b=8:$b=4;
                                            $pdf->MultiCell(24,$b,$data,'1','C');
                                            $pdf->SetXY($x + 97, $y);
                                            $data = $row['gw'];
                                            strlen($data)<20?$b=8:$b=4;
                                            $pdf->MultiCell(21,$b,$data,'1','C');
                                            $pdf->SetXY($x + 118, $y);
                                            $data = $row['fw'];
                                            strlen($data)<20?$b=8:$b=4;
                                            $pdf->MultiCell(21,$b,$data,'1','C');
                                            $pdf->SetXY($x + 139, $y);
                                            $data = $row['before_trolley_number_or_batcher_number'];
                                            strlen($data)<20?$b=8:$b=4;
                                            $pdf->MultiCell(20,$b,$data,'1','C');
                                            $pdf->SetXY($x + 159, $y);
                                            $data = $row['before_trolley_or_batcher_qty'];
                                            strlen($data)<20?$b=8:$b=4;
                                            $pdf->MultiCell(20,$b,$data,'1','C');
                                            $pdf->SetXY($x + 179, $y);
                                            $data = $row['after_trolley_number_or_batcher_number'];
                                            strlen($data)<20?$b=8:$b=4;
                                            $pdf->MultiCell(20,$b,$data,'1','C');
                                            $pdf->SetXY($x + 199, $y);
                                            $data = $row['after_trolley_or_batcher_qty'];
                                            strlen($data)<20?$b=8:$b=4;
                                            $pdf->MultiCell(20,$b,$data,'1','C');
                                            $pdf->SetXY($x + 219, $y);
                                            $data = $row['short_proc'];
                                            strlen($data)<20?$b=8:$b=4;
                                            $pdf->MultiCell(23,$b,$data,'1','C');
                                            $pdf->SetXY($x + 242, $y);
                                            $data = $row['short_percent'];
                                            strlen($data)<20?$b=8:$b=4;
                                            $pdf->MultiCell(18,$b,$data,'1','C');
                                            $pdf->SetXY($x + 260, $y);
                                            $data = $row['process_or_reprocess'];
                                            strlen($data)<20?$b=8:$b=4;
                                            $pdf->SetFont('Arial','',7);
                                                          $pdf->MultiCell(20,$b,$data,'1','C'); 
                                                          $pdf->SetFont('Arial','',9);
                                        }



                                // Width summary for Washing	

                                $sql_for_washing_width = "select pp.pp_number, pp.gw, pp.fw, pp.pp_quantity, result.process_qty, result.before_process_qty, result.gray_process_qty,
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
                               and ptftri.process_id = 'proc_13' and ptftri.pp_number = '$pp_number'
                                group by ptftri.pp_number, pwvci.finish_width_in_inch, pwvci.greige_width_in_inch,ptftri.version_id )P
                               where  1=1
                               and ptftri_1.process_id = p.process_id
                               and ptftri_1.pp_number = p.pp_number
                               and ptftri_1.version_id = p.version_id
                               and ptftri_1.partial_test_for_test_result_creation_date = p.max_date
                               group by process_id,pp_number, fw,  gw)result 
                               on pp.pp_number = result.pp_number and pp.fw = result.fw and pp.gw = result.gw 
                               order by pp.pp_number, pp.gw, pp.fw";
                                
                                $result_for_washing_width= mysqli_query($con,$sql_for_washing_width) or die(mysqli_error($con));

                                $row_number_for_washing_width = mysqli_num_rows($result_for_washing_width);

                                $counter = $counter + ($row_number_for_washing_width*8) + 10 + 10; 
                  
                                  if($counter>200)
                                      {
                                          $pdf->AddPage();
                                          $pdf->SetLeftMargin(8);
                                          $counter =30;
                                          $counter = $counter + ($row_number_for_washing_width*8) + 10 + 10; 
                                      } 

                                $pdf->SetFont('Arial','B',11);
                                $pdf->Ln(3);
                                $pdf->Cell(280,7,"Width Summary".$pdf->SetFillColor(220,220,220),"1","1","C",true);
                                $pdf->SetFont('Arial','B',9);

                                $x = $pdf->GetX();
                                $y = $pdf->GetY();
                                $data = "Greige Width (inch)";
                                strlen($data)<15?$b=10:$b=5;
                                $pdf->MultiCell(30,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 30, $y);
                                $data = "Finish Width (inch)";
                                strlen($data)<15?$b=10:$b=5;
                                $pdf->MultiCell(30,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 60, $y);
                                $data = "PP Quantity. (mtr.)";
                                strlen($data)<25?$b=10:$b=5;
                                $pdf->MultiCell(32,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 92, $y);
                                $data = "Before Process Quantity (mtr.)";
                                strlen($data)<25?$b=10:$b=5;
                                $pdf->MultiCell(33,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 125, $y);
                                $data = "Process Quantity. (mtr.)";
                                strlen($data)<15?$b=10:$b=5;
                                $pdf->MultiCell(32,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 157, $y);
                                $data = "(+/-) From PP";
                                // strlen($data)<15?$b=10:$b=5;
                                $pdf->MultiCell(41,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 157, $y+5);
                                $data = "Qty (mtr.)";
                                // strlen($data)<15?$b=10:$b=5;
                                $pdf->MultiCell(23,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 180, $y+5);
                                $data = "%";
                                // strlen($data)<15?$b=10:$b=5;
                                $pdf->MultiCell(18,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 198, $y);
                                $data = "(+/-) From Greige";
                                // strlen($data)<15?$b=10:$b=5;
                                $pdf->MultiCell(41,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 198, $y+5);
                                $data = "Qty (mtr.)";
                                // strlen($data)<15?$b=10:$b=5;
                                $pdf->MultiCell(23,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 221, $y+5);
                                $data = "%";
                                // strlen($data)<15?$b=10:$b=5;
                                $pdf->MultiCell(18,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 239, $y);
                                $data = "(+/-) From Prev. Process";
                                // strlen($data)<15?$b=10:$b=5;
                                $pdf->MultiCell(41,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 239, $y+5);
                                $data = "Qty (mtr.)";
                                // strlen($data)<15?$b=10:$b=5;
                                $pdf->MultiCell(23,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 262, $y+5);
                                $data = "%";
                                // strlen($data)<15?$b=10:$b=5;
                                $pdf->MultiCell(18,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 280, $y);
                                
                                // $pdf->Cell(0,0,$pdf->SetFillColor(255,255,255),'1','1','C',true);
                                $pdf->SetFont('Arial','',9);       
                                 $pdf->Ln(10);
                               
                                
                            while($row = mysqli_fetch_array($result_for_washing_width))  
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
                                $pdf->MultiCell(32,$b,$data,'1','C');
                                $pdf->SetXY($x + 92, $y);
                                $data = $row['before_process_qty'];
                                strlen($data)<20?$b=8:$b=4;
                                $pdf->MultiCell(33,$b,$data,'1','C');
                                $pdf->SetXY($x + 125, $y);
                                $data = $row['process_qty'];
                                strlen($data)<20?$b=8:$b=4;
                                $pdf->MultiCell(32,$b,$data,'1','C');
                                $pdf->SetXY($x + 157, $y);
                                $data = $row['short_pp_qty'];
                                strlen($data)<15?$b=8:$b=4;
                                $pdf->MultiCell(23,$b,$data,'1','C');
                                $pdf->SetXY($x + 180, $y);
                                $data = $row['short_pp_percent'];
                                strlen($data)<15?$b=8:$b=4;
                                $pdf->MultiCell(18,$b,$data,'1','C');
                                $pdf->SetXY($x + 198, $y);
                                $data = $row['short_gre_rcv_qty'];
                                strlen($data)<15?$b=8:$b=4;
                                $pdf->MultiCell(23,$b,$data,'1','C');
                                $pdf->SetXY($x + 221, $y);
                                $data = $row['short_gre_rcv_percent'];
                                strlen($data)<15?$b=8:$b=4;
                                $pdf->MultiCell(18,$b,$data,'1','C');
                                $pdf->SetXY($x + 239, $y);
                                $data = $row['short_pre_proc_qty'];
                                strlen($data)<15?$b=8:$b=4;
                                $pdf->MultiCell(23,$b,$data,'1','C');
                                $pdf->SetXY($x + 262, $y);
                                $data = $row['short_pre_proc_percent'];
                                strlen($data)<15?$b=8:$b=4;
                                $pdf->MultiCell(18,$b,$data,'1','C');
                                // $pdf->SetXY($x + 200, $y);

                            }
                                // Version summary for Washing

                                 $sql_for_washing_version = "select pp.pp_number, pp.version_name version_number, pp.style_name, pp.color, pp.gw, pp.fw, pp.pp_quantity, result.process_qty, result.before_process_qty, result.gray_process_qty, 
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
                                 and ptftri.process_id = 'proc_13' and ptftri.pp_number = '$pp_number'
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

                                  $result_for_washing_version= mysqli_query($con,$sql_for_washing_version) or die(mysqli_error($con));

                                  $row_number_for_washing_version = mysqli_num_rows($result_for_washing_version);

                                  $counter = $counter + ($row_number_for_washing_version*8) + 10 + 10 + 8; 
                  
                                  if($counter>200)
                                      {
                                          $pdf->AddPage();
                                          $pdf->SetLeftMargin(8);
                                          $counter =30;
                                          $counter = $counter + ($row_number_for_washing_version*8) + 10 + 10 + 8; 

                                      } 

                                  $pdf->SetFont('Arial','B',11);
                                  $pdf->Ln(3);
                                  $pdf->Cell(280,7,"Version Summary".$pdf->SetFillColor(220,220,220),"1","1","C",true);
                                  $pdf->SetFont('Arial','B',9);

                                $x = $pdf->GetX();
                                $y = $pdf->GetY();
                                $data = "Version";
                                strlen($data)<15?$b=10:$b=5;
                                $pdf->MultiCell(28,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 28, $y);
                                $data = "Color";
                                strlen($data)<15?$b=10:$b=5;
                                $pdf->MultiCell(24,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 52, $y);
                                $data = "Style";
                                strlen($data)<15?$b=10:$b=5;
                                $pdf->MultiCell(24,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 76, $y);
                                $data = "PP Quantity (mtr.)";
                                strlen($data)<15?$b=10:$b=5;
                                $pdf->MultiCell(27,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 103, $y);
                                $data = "Before process Qty (mtr.)";
                                strlen($data)<20?$b=10:$b=5;
                                $pdf->MultiCell(27,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 130, $y);
                                $data = "Process Quantity (mtr.)";
                                strlen($data)<20?$b=10:$b=5;
                                $pdf->MultiCell(27,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 157, $y);
                                $data = "(+/-) From PP";
                                // strlen($data)<15?$b=10:$b=5;
                                $pdf->MultiCell(41,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 157, $y+5);
                                $data = "Qty (mtr.)";
                                // strlen($data)<15?$b=10:$b=5;
                                $pdf->MultiCell(23,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 180, $y+5);
                                $data = "%";
                                // strlen($data)<15?$b=10:$b=5;
                                $pdf->MultiCell(18,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 198, $y);
                                $data = "(+/-) From Greige";
                                // strlen($data)<15?$b=10:$b=5;
                                $pdf->MultiCell(41,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 198, $y+5);
                                $data = "Qty (mtr.)";
                                // strlen($data)<15?$b=10:$b=5;
                                $pdf->MultiCell(23,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 221, $y+5);
                                $data = "%";
                                // strlen($data)<15?$b=10:$b=5;
                                $pdf->MultiCell(18,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 239, $y);
                                $data = "(+/-) From Prev. Process";
                                // strlen($data)<15?$b=10:$b=5;
                                $pdf->MultiCell(41,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 239, $y+5);
                                $data = "Qty (mtr.)";
                                // strlen($data)<15?$b=10:$b=5;
                                $pdf->MultiCell(23,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 262, $y+5);
                                $data = "%";
                                // strlen($data)<15?$b=10:$b=5;
                                $pdf->MultiCell(18,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 280, $y);
                                
                                // $pdf->Cell(0,0,$pdf->SetFillColor(255,255,255),'1','1','C',true);
                                $pdf->SetFont('Arial','',9);       
                                 $pdf->Ln(10);
    
                          while($row = mysqli_fetch_array($result_for_washing_version))  
                          {  
                              $x = $pdf->GetX();
                              $y = $pdf->GetY();
                              $data = $row['version_number'];
                              strlen($data)<16?$b=8:$b=4;
                              $pdf->MultiCell(28,$b,$data,'1','C');
                              $pdf->SetXY($x + 28, $y);
                              $data = $row['color'];
                              strlen($data)<20?$b=8:$b=4;
                              $pdf->MultiCell(24,$b,$data,'1','C');
                              $pdf->SetXY($x + 52, $y);
                              $data = $row['style_name'];
                              strlen($data)<10?$b=8:$b=4;
                              $pdf->MultiCell(24,$b,$data,'1','C');
                              $pdf->SetXY($x + 76, $y);
                              $data = $row['pp_quantity'];
                              strlen($data)<20?$b=8:$b=4;
                              $pdf->MultiCell(27,$b,$data,'1','C');
                              $pdf->SetXY($x + 103, $y);
                              $data = $row['before_process_qty'];
                              strlen($data)<20?$b=8:$b=4;
                              $pdf->MultiCell(27,$b,$data,'1','C');
                              $pdf->SetXY($x + 130, $y);
                              $data = $row['process_qty'];
                              strlen($data)<20?$b=8:$b=4;
                              $pdf->MultiCell(27,$b,$data,'1','C');
                              $pdf->SetXY($x + 157, $y);
                              $data = $row['short_pp'];
                              strlen($data)<15?$b=8:$b=4;
                              $pdf->MultiCell(23,$b,$data,'1','C');
                              $pdf->SetXY($x + 180, $y);
                              $data = $row['short_pp_percent'];
                              strlen($data)<15?$b=8:$b=4;
                              $pdf->MultiCell(18,$b,$data,'1','C');
                              $pdf->SetXY($x + 198, $y);
                              $data = $row['short_gre_rcv_qty'];
                              strlen($data)<15?$b=8:$b=4;
                              $pdf->MultiCell(23,$b,$data,'1','C');
                              $pdf->SetXY($x + 221, $y);
                              $data = $row['short_gre_rcv_percent'];
                              strlen($data)<15?$b=8:$b=4;
                              $pdf->MultiCell(18,$b,$data,'1','C');
                              $pdf->SetXY($x + 239, $y);
                              $data = $row['short_pre_proc_qty'];
                              strlen($data)<15?$b=8:$b=4;
                              $pdf->MultiCell(23,$b,$data,'1','C');
                              $pdf->SetXY($x + 262, $y);
                              $data = $row['short_pre_proc_percent'];
                              strlen($data)<15?$b=8:$b=4;
                              $pdf->MultiCell(18,$b,$data,'1','C');
                              // $pdf->SetXY($x + 280, $y);

                          }

                          $sql_for_washing_total = "select total.pp_number, sum(total.pp_quantity) pp_quantity, sum(total.process_qty) process_qty, 
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
                          and ptftri.process_id = 'proc_13' and ptftri.pp_number = '$pp_number'
                          group by ptftri.pp_number, ptftri.version_number, ptftri.finish_width_in_inch )P
                          where  1=1
                          and ptftri_1.process_id = p.process_id
                          and ptftri_1.pp_number = p.pp_number
                          and ptftri_1.version_number = p.version_name
                          and ptftri_1.partial_test_for_test_result_creation_date = p.max_date
                          and ptftri_1.finish_width_in_inch = p.finish_width_in_inch
                          group by process_id,pp_number, version_name)result where pp.pp_number = result.pp_number and pp.version_name = result.version_name ) total
                          ";

                        $result_for_washing_total= mysqli_query($con,$sql_for_washing_total) or die(mysqli_error($con));
                        while($row = mysqli_fetch_array($result_for_washing_total))  
                        {
                            $pdf->SetFont('Arial','B',9); 
                            $x = $pdf->GetX();
                            $y = $pdf->GetY();
                            $data = "Washing Total Qty. (mtr.)";
                            strlen($data)<70?$b=8:$b=4;
                            $pdf->MultiCell(76,$b,$data,'1','C');
                            $pdf->SetXY($x + 76, $y);
                            $data = $row['pp_quantity'];
                            strlen($data)<20?$b=8:$b=4;
                            $pdf->MultiCell(27,$b,$data,'1','C');
                            $pdf->SetXY($x + 103, $y);
                            $data = $row['before_process_qty'];
                            strlen($data)<20?$b=8:$b=4;
                            $pdf->MultiCell(27,$b,$data,'1','C');
                            $pdf->SetXY($x + 130, $y);
                            $data = $row['process_qty'];
                            strlen($data)<20?$b=8:$b=4;
                            $pdf->MultiCell(27,$b,$data,'1','C');
                            $pdf->SetXY($x + 157, $y);
                            $data = $row['short_pp_qty'];
                            strlen($data)<20?$b=8:$b=4;
                            $pdf->MultiCell(23,$b,$data,'1','C');
                            $pdf->SetXY($x + 180, $y);
                            $data = $row['short_pp_percent'];
                            strlen($data)<20?$b=8:$b=4;
                            $pdf->MultiCell(18,$b,$data,'1','C'); 
                            $pdf->SetXY($x + 198, $y); 
                            $data = $row['short_gre_rcv_qty'];
                            strlen($data)<20?$b=8:$b=4;
                            $pdf->MultiCell(23,$b,$data,'1','C');
                            $pdf->SetXY($x + 221, $y);
                            $data = $row['short_gre_rcv_percent'];
                            strlen($data)<20?$b=8:$b=4;
                            $pdf->MultiCell(18,$b,$data,'1','C');
                            $pdf->SetXY($x + 239, $y); 
                            $data = $row['short_pre_proc_qty'];
                            strlen($data)<20?$b=8:$b=4;
                            $pdf->MultiCell(23,$b,$data,'1','C');
                            $pdf->SetXY($x + 262, $y);
                            $data = $row['short_pre_proc_percent'];
                            strlen($data)<20?$b=8:$b=4;
                            $pdf->MultiCell(18,$b,$data,'1','C');  

                            if($row['short_excess_qty']!= '') 
                                {
                                    $process_loss_gain+=$row['short_excess_qty'];
                                }
                    
                                $Total_pp_quantity = $row['pp_quantity'];
                                $Total_greige_quantity = $row['process_qty'];
                         
                        }

    }
  }

  /*********************************Create Ready For Raising (Process No- 14) Table**********************************/
 
  $greige_period = "select ptftri.pp_number, ptftri.process_id, date_format(min(ptftri.partial_test_for_test_result_creation_date), '%d-%b-%Y') start_date,
        date_format(max(ptftri.partial_test_for_test_result_creation_date), '%d-%b-%Y') end_date
        from partial_test_for_test_result_info  ptftri
        where  ptftri.process_id = 'proc_14' and ptftri.pp_number = '$pp_number'  
          ";


$result_for_greige= mysqli_query($con,$greige_period) or die(mysqli_error($con));
while($row = mysqli_fetch_array($result_for_greige))  
{  
    if($row['end_date']!= '') 
    {
        $process_completion_date = $row['end_date'];
    }

    if($row_for_select_process["process_id"] == "proc_14")
    {
        $Serial+=1;

        $sql_for_ready_for_raising = "select pp.pp_number, pp.version_name as version_number, pp.color, pp.style_name, pp.gw, pp.fw, pp.pp_quantity, result.after_trolley_or_batcher_qty, result.date, 
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
        ptftri.pp_number = aptv.pp_number and ptftri.version_id = aptv.version_id and ptftri.style=aptv.style_name  and ptftri.process_name=aptv.process_name and ptftri.process_id = 'proc_14'
         and ptftri.pp_number = '$pp_number')result 
        
        on pp.pp_number = result.pp_number and pp.version_id = result.version_id  order by result.date, pp.pp_number, pp.version_id, pp.color, pp.style_name, pp.gw, pp.fw";
         
        $result_for_ready_for_raising= mysqli_query($con,$sql_for_ready_for_raising) or die(mysqli_error($con));

        $row_number_for_ready_for_raising = mysqli_num_rows($result_for_ready_for_raising);

        $counter = $counter + ($row_number_for_ready_for_raising*8) + 10 + 10; 

        if($counter>200)
            {
                $pdf->AddPage();
                $pdf->SetLeftMargin(8);
                $counter =30;
                $counter = $counter + ($row_number_for_ready_for_raising*8) + 10 + 10; 

            } 

        $pdf->SetFont('Arial','B',14);
        $pdf->Ln(3);
        $pdf->Cell(280,7,$Serial.'.'.'  '.'Ready for Raising'.'   ('.$row["start_date"].' To '.$row["end_date"].')'.$pdf->SetFillColor(255,255,255),"0","1","L",true);
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
        $pdf->MultiCell(28,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
        $pdf->SetXY($x + 49, $y);
        $data = "Color";
        strlen($data)<15?$b=10:$b=5;
        $pdf->MultiCell(24,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
        $pdf->SetXY($x + 73, $y);
        $data = "Style";
        strlen($data)<15?$b=10:$b=5;
        $pdf->MultiCell(24,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
        $pdf->SetXY($x + 97, $y);
        $data = "Greige Width (inch)";
        strlen($data)<10?$b=10:$b=5;
        $pdf->MultiCell(21,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
        $pdf->SetXY($x + 118, $y);
        $data = "Finish Width (inch)";
        strlen($data)<10?$b=10:$b=5;
        $pdf->MultiCell(21,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
        $pdf->SetXY($x + 139, $y);
        $data = "Before Trolley No.";
        strlen($data)<10?$b=10:$b=5;
        $pdf->MultiCell(20,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
        $pdf->SetXY($x + 159, $y);
        $data = "B. Process Qty (mtr.)";
        strlen($data)<15?$b=10:$b=5;
        $pdf->MultiCell(20,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
        $pdf->SetXY($x + 179, $y);
        $data = "After Trolley No.";
        strlen($data)<10?$b=10:$b=5;
        $pdf->MultiCell(20,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
        $pdf->SetXY($x + 199, $y);
        $data = "Process Qty (mtr.)";
        strlen($data)<10?$b=10:$b=5;
        $pdf->MultiCell(20,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
        $pdf->SetXY($x + 219, $y);
        $data = "(+/-) From Prev. Process";
        strlen($data)<10?$b=10:$b=5;
        $pdf->MultiCell(41,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
        $pdf->SetXY($x + 219, $y+5);
        $data = "Qty (mtr.)";
        // strlen($data)<15?$b=10:$b=5;
        $pdf->MultiCell(23,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
        $pdf->SetXY($x + 242, $y+5);
        $data = "%";
        // strlen($data)<15?$b=10:$b=5;
        $pdf->MultiCell(18,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
        $pdf->SetXY($x + 260, $y);
        $data = "Process / Reprocess";
        strlen($data)<10?$b=10:$b=5;
        $pdf->MultiCell(20,$b,"$data".$pdf->SetFillColor(220,220,220),'1','C',TRUE);
        // $pdf->SetXY($x + 194, $y);

        $pdf->Cell(200,0,$pdf->SetFillColor(255,255,255),'1','1','c',true);

        $pdf->SetFont('Arial','',9);


                                        while($row = mysqli_fetch_array($result_for_ready_for_raising))  
                                        {
                                            $x = $pdf->GetX();
                                            $y = $pdf->GetY();
                                            $data = $row['date'];
                                            strlen($data)<20?$b=8:$b=4;
                                            $pdf->MultiCell(21,$b,$data,'1','C');
                                            $pdf->SetXY($x + 21, $y);
                                            $data = $row['version_number'];
                                            strlen($data)<16?$b=8:$b=4;
                                            $pdf->MultiCell(28,$b,$data,'1','C');
                                            $pdf->SetXY($x + 49, $y);
                                            $data = $row['color'];
                                            strlen($data)<20?$b=8:$b=4;
                                            $pdf->MultiCell(24,$b,$data,'1','C');
                                            $pdf->SetXY($x + 73, $y);
                                            $data = $row['style_name'];
                                            strlen($data)<10?$b=8:$b=4;
                                            $pdf->MultiCell(24,$b,$data,'1','C');
                                            $pdf->SetXY($x + 97, $y);
                                            $data = $row['gw'];
                                            strlen($data)<20?$b=8:$b=4;
                                            $pdf->MultiCell(21,$b,$data,'1','C');
                                            $pdf->SetXY($x + 118, $y);
                                            $data = $row['fw'];
                                            strlen($data)<20?$b=8:$b=4;
                                            $pdf->MultiCell(21,$b,$data,'1','C');
                                            $pdf->SetXY($x + 139, $y);
                                            $data = $row['before_trolley_number_or_batcher_number'];
                                            strlen($data)<20?$b=8:$b=4;
                                            $pdf->MultiCell(20,$b,$data,'1','C');
                                            $pdf->SetXY($x + 159, $y);
                                            $data = $row['before_trolley_or_batcher_qty'];
                                            strlen($data)<20?$b=8:$b=4;
                                            $pdf->MultiCell(20,$b,$data,'1','C');
                                            $pdf->SetXY($x + 179, $y);
                                            $data = $row['after_trolley_number_or_batcher_number'];
                                            strlen($data)<20?$b=8:$b=4;
                                            $pdf->MultiCell(20,$b,$data,'1','C');
                                            $pdf->SetXY($x + 199, $y);
                                            $data = $row['after_trolley_or_batcher_qty'];
                                            strlen($data)<20?$b=8:$b=4;
                                            $pdf->MultiCell(20,$b,$data,'1','C');
                                            $pdf->SetXY($x + 219, $y);
                                            $data = $row['short_proc'];
                                            strlen($data)<20?$b=8:$b=4;
                                            $pdf->MultiCell(23,$b,$data,'1','C');
                                            $pdf->SetXY($x + 242, $y);
                                            $data = $row['short_percent'];
                                            strlen($data)<20?$b=8:$b=4;
                                            $pdf->MultiCell(18,$b,$data,'1','C');
                                            $pdf->SetXY($x + 260, $y);
                                            $data = $row['process_or_reprocess'];
                                            strlen($data)<20?$b=8:$b=4;
                                            $pdf->SetFont('Arial','',7);
                                                          $pdf->MultiCell(20,$b,$data,'1','C'); 
                                                          $pdf->SetFont('Arial','',9); 
                                        }



                                // Width summary for Ready for Raising

                                $sql_for_ready_for_raising_width = "select pp.pp_number, pp.gw, pp.fw, pp.pp_quantity, result.process_qty, result.before_process_qty, result.gray_process_qty,
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
                               where ptv.pp_number = ptftri_1.pp_number and ptv.process_id = 'proc_20' and fw = ptv.finish_width_in_inch) gray_process_qty 
                               FROM
                               partial_test_for_test_result_info ptftri_1
                                inner join (
                               SELECT ptftri.process_id,ptftri.pp_number, pwvci.finish_width_in_inch fw, pwvci.greige_width_in_inch gw,ptftri.version_id
                                ,max(ptftri.partial_test_for_test_result_creation_date) max_date
                               from partial_test_for_test_result_info ptftri, pp_wise_version_creation_info pwvci
                                where ptftri.pp_number = pwvci.pp_number and ptftri.version_id = pwvci.version_id and ptftri.style=pwvci.style_name
                                and ptftri.finish_width_in_inch=pwvci.finish_width_in_inch 
                               and ptftri.process_id = 'proc_14' and ptftri.pp_number = '$pp_number'
                                group by ptftri.pp_number, pwvci.finish_width_in_inch, pwvci.greige_width_in_inch,ptftri.version_id )P
                               where  1=1
                               and ptftri_1.process_id = p.process_id
                               and ptftri_1.pp_number = p.pp_number
                               and ptftri_1.version_id = p.version_id
                               and ptftri_1.partial_test_for_test_result_creation_date = p.max_date
                               group by process_id,pp_number, fw,  gw)result 
                               on pp.pp_number = result.pp_number and pp.fw = result.fw and pp.gw = result.gw 
                               order by pp.pp_number, pp.gw, pp.fw";
                                
                                $result_for_ready_for_raising_width= mysqli_query($con,$sql_for_ready_for_raising_width) or die(mysqli_error($con));

                                $row_number_for_ready_for_raising_width = mysqli_num_rows($result_for_ready_for_raising_width);

                                $counter = $counter + ($row_number_for_ready_for_raising_width*8) + 10 + 10; 
                  
                                  if($counter>200)
                                      {
                                          $pdf->AddPage();
                                          $pdf->SetLeftMargin(8);
                                          $counter =30;
                                          $counter = $counter + ($row_number_for_ready_for_raising_width*8) + 10 + 10; 
                                      } 

                                $pdf->SetFont('Arial','B',11);
                                $pdf->Ln(3);
                                $pdf->Cell(280,7,"Width Summary".$pdf->SetFillColor(220,220,220),"1","1","C",true);
                                $pdf->SetFont('Arial','B',9);

                                $x = $pdf->GetX();
                                $y = $pdf->GetY();
                                $data = "Greige Width (inch)";
                                strlen($data)<15?$b=10:$b=5;
                                $pdf->MultiCell(30,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 30, $y);
                                $data = "Finish Width (inch)";
                                strlen($data)<15?$b=10:$b=5;
                                $pdf->MultiCell(30,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 60, $y);
                                $data = "PP Quantity. (mtr.)";
                                strlen($data)<25?$b=10:$b=5;
                                $pdf->MultiCell(32,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 92, $y);
                                $data = "Before Process Quantity (mtr.)";
                                strlen($data)<25?$b=10:$b=5;
                                $pdf->MultiCell(33,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 125, $y);
                                $data = "Process Quantity. (mtr.)";
                                strlen($data)<15?$b=10:$b=5;
                                $pdf->MultiCell(32,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 157, $y);
                                $data = "(+/-) From PP";
                                // strlen($data)<15?$b=10:$b=5;
                                $pdf->MultiCell(41,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 157, $y+5);
                                $data = "Qty (mtr.)";
                                // strlen($data)<15?$b=10:$b=5;
                                $pdf->MultiCell(23,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 180, $y+5);
                                $data = "%";
                                // strlen($data)<15?$b=10:$b=5;
                                $pdf->MultiCell(18,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 198, $y);
                                $data = "(+/-) From Greige";
                                // strlen($data)<15?$b=10:$b=5;
                                $pdf->MultiCell(41,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 198, $y+5);
                                $data = "Qty (mtr.)";
                                // strlen($data)<15?$b=10:$b=5;
                                $pdf->MultiCell(23,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 221, $y+5);
                                $data = "%";
                                // strlen($data)<15?$b=10:$b=5;
                                $pdf->MultiCell(18,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 239, $y);
                                $data = "(+/-) From Prev. Process";
                                // strlen($data)<15?$b=10:$b=5;
                                $pdf->MultiCell(41,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 239, $y+5);
                                $data = "Qty (mtr.)";
                                // strlen($data)<15?$b=10:$b=5;
                                $pdf->MultiCell(23,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 262, $y+5);
                                $data = "%";
                                // strlen($data)<15?$b=10:$b=5;
                                $pdf->MultiCell(18,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 280, $y);
                                
                                // $pdf->Cell(0,0,$pdf->SetFillColor(255,255,255),'1','1','C',true);
                                $pdf->SetFont('Arial','',9);       
                                 $pdf->Ln(10);
                               
                                
                            while($row = mysqli_fetch_array($result_for_ready_for_raising_width))  
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
                                $pdf->MultiCell(32,$b,$data,'1','C');
                                $pdf->SetXY($x + 92, $y);
                                $data = $row['before_process_qty'];
                                strlen($data)<20?$b=8:$b=4;
                                $pdf->MultiCell(33,$b,$data,'1','C');
                                $pdf->SetXY($x + 125, $y);
                                $data = $row['process_qty'];
                                strlen($data)<20?$b=8:$b=4;
                                $pdf->MultiCell(32,$b,$data,'1','C');
                                $pdf->SetXY($x + 157, $y);
                                $data = $row['short_pp_qty'];
                                strlen($data)<15?$b=8:$b=4;
                                $pdf->MultiCell(23,$b,$data,'1','C');
                                $pdf->SetXY($x + 180, $y);
                                $data = $row['short_pp_percent'];
                                strlen($data)<15?$b=8:$b=4;
                                $pdf->MultiCell(18,$b,$data,'1','C');
                                $pdf->SetXY($x + 198, $y);
                                $data = $row['short_gre_rcv_qty'];
                                strlen($data)<15?$b=8:$b=4;
                                $pdf->MultiCell(23,$b,$data,'1','C');
                                $pdf->SetXY($x + 221, $y);
                                $data = $row['short_gre_rcv_percent'];
                                strlen($data)<15?$b=8:$b=4;
                                $pdf->MultiCell(18,$b,$data,'1','C');
                                $pdf->SetXY($x + 239, $y);
                                $data = $row['short_pre_proc_qty'];
                                strlen($data)<15?$b=8:$b=4;
                                $pdf->MultiCell(23,$b,$data,'1','C');
                                $pdf->SetXY($x + 262, $y);
                                $data = $row['short_pre_proc_percent'];
                                strlen($data)<15?$b=8:$b=4;
                                $pdf->MultiCell(18,$b,$data,'1','C');
                                // $pdf->SetXY($x + 200, $y);

                            }
                                // Version summary for ready for raising

                                 $sql_for_ready_for_raising_version = "select pp.pp_number, pp.version_name version_number, pp.style_name, pp.color, pp.gw, pp.fw, pp.pp_quantity, result.process_qty, result.before_process_qty, result.gray_process_qty, 
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
             and ptftri.process_id = 'proc_14' and ptftri.pp_number = '$pp_number'
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

                                  $result_for_ready_for_raising_version= mysqli_query($con,$sql_for_ready_for_raising_version) or die(mysqli_error($con));

                                  $row_number_for_ready_for_raising_version = mysqli_num_rows($result_for_ready_for_raising_version);

                                  $counter = $counter + ($row_number_for_ready_for_raising_version*8) + 10 + 10 + 8; 
                  
                                  if($counter>200)
                                      {
                                          $pdf->AddPage();
                                          $pdf->SetLeftMargin(8);
                                          $counter =30;
                                          $counter = $counter + ($row_number_for_ready_for_raising_version*8) + 10 + 10 + 8; 

                                      } 

                                  $pdf->SetFont('Arial','B',11);
                                  $pdf->Ln(3);
                                  $pdf->Cell(280,7,"Version Summary".$pdf->SetFillColor(220,220,220),"1","1","C",true);
                                  $pdf->SetFont('Arial','B',9);

                                $x = $pdf->GetX();
                                $y = $pdf->GetY();
                                $data = "Version";
                                strlen($data)<15?$b=10:$b=5;
                                $pdf->MultiCell(28,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 28, $y);
                                $data = "Color";
                                strlen($data)<15?$b=10:$b=5;
                                $pdf->MultiCell(24,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 52, $y);
                                $data = "Style";
                                strlen($data)<15?$b=10:$b=5;
                                $pdf->MultiCell(24,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 76, $y);
                                $data = "PP Quantity (mtr.)";
                                strlen($data)<15?$b=10:$b=5;
                                $pdf->MultiCell(27,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 103, $y);
                                $data = "Before process Qty (mtr.)";
                                strlen($data)<20?$b=10:$b=5;
                                $pdf->MultiCell(27,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 130, $y);
                                $data = "Process Quantity (mtr.)";
                                strlen($data)<20?$b=10:$b=5;
                                $pdf->MultiCell(27,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 157, $y);
                                $data = "(+/-) From PP";
                                // strlen($data)<15?$b=10:$b=5;
                                $pdf->MultiCell(41,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 157, $y+5);
                                $data = "Qty (mtr.)";
                                // strlen($data)<15?$b=10:$b=5;
                                $pdf->MultiCell(23,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 180, $y+5);
                                $data = "%";
                                // strlen($data)<15?$b=10:$b=5;
                                $pdf->MultiCell(18,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 198, $y);
                                $data = "(+/-) From Greige";
                                // strlen($data)<15?$b=10:$b=5;
                                $pdf->MultiCell(41,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 198, $y+5);
                                $data = "Qty (mtr.)";
                                // strlen($data)<15?$b=10:$b=5;
                                $pdf->MultiCell(23,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 221, $y+5);
                                $data = "%";
                                // strlen($data)<15?$b=10:$b=5;
                                $pdf->MultiCell(18,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 239, $y);
                                $data = "(+/-) From Prev. Process";
                                // strlen($data)<15?$b=10:$b=5;
                                $pdf->MultiCell(41,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 239, $y+5);
                                $data = "Qty (mtr.)";
                                // strlen($data)<15?$b=10:$b=5;
                                $pdf->MultiCell(23,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 262, $y+5);
                                $data = "%";
                                // strlen($data)<15?$b=10:$b=5;
                                $pdf->MultiCell(18,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 280, $y);
                                
                                // $pdf->Cell(0,0,$pdf->SetFillColor(255,255,255),'1','1','C',true);
                                $pdf->SetFont('Arial','',9);       
                                 $pdf->Ln(10);
    
                          while($row = mysqli_fetch_array($result_for_ready_for_raising_version))  
                          {  
                              $x = $pdf->GetX();
                              $y = $pdf->GetY();
                              $data = $row['version_number'];
                              strlen($data)<16?$b=8:$b=4;
                              $pdf->MultiCell(28,$b,$data,'1','C');
                              $pdf->SetXY($x + 28, $y);
                              $data = $row['color'];
                              strlen($data)<20?$b=8:$b=4;
                              $pdf->MultiCell(24,$b,$data,'1','C');
                              $pdf->SetXY($x + 52, $y);
                              $data = $row['style_name'];
                              strlen($data)<10?$b=8:$b=4;
                              $pdf->MultiCell(24,$b,$data,'1','C');
                              $pdf->SetXY($x + 76, $y);
                              $data = $row['pp_quantity'];
                              strlen($data)<20?$b=8:$b=4;
                              $pdf->MultiCell(27,$b,$data,'1','C');
                              $pdf->SetXY($x + 103, $y);
                              $data = $row['before_process_qty'];
                              strlen($data)<20?$b=8:$b=4;
                              $pdf->MultiCell(27,$b,$data,'1','C');
                              $pdf->SetXY($x + 130, $y);
                              $data = $row['process_qty'];
                              strlen($data)<20?$b=8:$b=4;
                              $pdf->MultiCell(27,$b,$data,'1','C');
                              $pdf->SetXY($x + 157, $y);
                              $data = $row['short_pp'];
                              strlen($data)<15?$b=8:$b=4;
                              $pdf->MultiCell(23,$b,$data,'1','C');
                              $pdf->SetXY($x + 180, $y);
                              $data = $row['short_pp_percent'];
                              strlen($data)<15?$b=8:$b=4;
                              $pdf->MultiCell(18,$b,$data,'1','C');
                              $pdf->SetXY($x + 198, $y);
                              $data = $row['short_gre_rcv_qty'];
                              strlen($data)<15?$b=8:$b=4;
                              $pdf->MultiCell(23,$b,$data,'1','C');
                              $pdf->SetXY($x + 221, $y);
                              $data = $row['short_gre_rcv_percent'];
                              strlen($data)<15?$b=8:$b=4;
                              $pdf->MultiCell(18,$b,$data,'1','C');
                              $pdf->SetXY($x + 239, $y);
                              $data = $row['short_pre_proc_qty'];
                              strlen($data)<15?$b=8:$b=4;
                              $pdf->MultiCell(23,$b,$data,'1','C');
                              $pdf->SetXY($x + 262, $y);
                              $data = $row['short_pre_proc_percent'];
                              strlen($data)<15?$b=8:$b=4;
                              $pdf->MultiCell(18,$b,$data,'1','C');
                              // $pdf->SetXY($x + 280, $y);

                          }

                          $sql_for_ready_for_raising_total = "select total.pp_number, sum(total.pp_quantity) pp_quantity, sum(total.process_qty) process_qty, 
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
                          and ptftri.process_id = 'proc_14' and ptftri.pp_number = '$pp_number'
                          group by ptftri.pp_number, ptftri.version_number, ptftri.finish_width_in_inch )P
                          where  1=1
                          and ptftri_1.process_id = p.process_id
                          and ptftri_1.pp_number = p.pp_number
                          and ptftri_1.version_number = p.version_name
                          and ptftri_1.partial_test_for_test_result_creation_date = p.max_date
                          and ptftri_1.finish_width_in_inch = p.finish_width_in_inch
                          group by process_id,pp_number, version_name)result where pp.pp_number = result.pp_number and pp.version_name = result.version_name ) total
                          ";

                        $result_for_ready_for_raising_total= mysqli_query($con,$sql_for_ready_for_raising_total) or die(mysqli_error($con));
                        while($row = mysqli_fetch_array($result_for_ready_for_raising_total))  
                        {
                            $pdf->SetFont('Arial','B',9); 
                            $x = $pdf->GetX();
                            $y = $pdf->GetY();
                            $data = "Ready for Raising Total Qty. (mtr.)";
                            strlen($data)<70?$b=8:$b=4;
                            $pdf->MultiCell(76,$b,$data,'1','C');
                            $pdf->SetXY($x + 76, $y);
                            $data = $row['pp_quantity'];
                            strlen($data)<20?$b=8:$b=4;
                            $pdf->MultiCell(27,$b,$data,'1','C');
                            $pdf->SetXY($x + 103, $y);
                            $data = $row['before_process_qty'];
                            strlen($data)<20?$b=8:$b=4;
                            $pdf->MultiCell(27,$b,$data,'1','C');
                            $pdf->SetXY($x + 130, $y);
                            $data = $row['process_qty'];
                            strlen($data)<20?$b=8:$b=4;
                            $pdf->MultiCell(27,$b,$data,'1','C');
                            $pdf->SetXY($x + 157, $y);
                            $data = $row['short_pp_qty'];
                            strlen($data)<20?$b=8:$b=4;
                            $pdf->MultiCell(23,$b,$data,'1','C');
                            $pdf->SetXY($x + 180, $y);
                            $data = $row['short_pp_percent'];
                            strlen($data)<20?$b=8:$b=4;
                            $pdf->MultiCell(18,$b,$data,'1','C'); 
                            $pdf->SetXY($x + 198, $y); 
                            $data = $row['short_gre_rcv_qty'];
                            strlen($data)<20?$b=8:$b=4;
                            $pdf->MultiCell(23,$b,$data,'1','C');
                            $pdf->SetXY($x + 221, $y);
                            $data = $row['short_gre_rcv_percent'];
                            strlen($data)<20?$b=8:$b=4;
                            $pdf->MultiCell(18,$b,$data,'1','C');
                            $pdf->SetXY($x + 239, $y); 
                            $data = $row['short_pre_proc_qty'];
                            strlen($data)<20?$b=8:$b=4;
                            $pdf->MultiCell(23,$b,$data,'1','C');
                            $pdf->SetXY($x + 262, $y);
                            $data = $row['short_pre_proc_percent'];
                            strlen($data)<20?$b=8:$b=4;
                            $pdf->MultiCell(18,$b,$data,'1','C');  

                            if($row['short_excess_qty']!= '') 
                                {
                                    $process_loss_gain+=$row['short_excess_qty'];
                                }
                    
                                $Total_pp_quantity = $row['pp_quantity'];
                                $Total_greige_quantity = $row['process_qty'];
                         
                        }

    }
  }


  /*********************************Create Raising (Process No- 15) Table**********************************/

  $greige_period = "select ptftri.pp_number, ptftri.process_id, date_format(min(ptftri.partial_test_for_test_result_creation_date), '%d-%b-%Y') start_date,
        date_format(max(ptftri.partial_test_for_test_result_creation_date), '%d-%b-%Y') end_date
        from partial_test_for_test_result_info  ptftri
        where  ptftri.process_id = 'proc_15' and ptftri.pp_number = '$pp_number' ";

$result_for_greige= mysqli_query($con,$greige_period) or die(mysqli_error($con));
while($row = mysqli_fetch_array($result_for_greige))  
{  
    if($row['end_date']!= '') 
    {
        $process_completion_date = $row['end_date'];
    }

    if($row_for_select_process["process_id"] == "proc_15")
    {
        $Serial+=1;

        $sql_for_raising = "select pp.pp_number, pp.version_name as version_number, pp.color, pp.style_name, pp.gw, pp.fw, pp.pp_quantity, result.after_trolley_or_batcher_qty, result.date, 
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
        ptftri.pp_number = aptv.pp_number and ptftri.version_id = aptv.version_id and ptftri.style=aptv.style_name  and ptftri.process_name=aptv.process_name and ptftri.process_id = 'proc_15'
         and ptftri.pp_number = '$pp_number')result 
        
        on pp.pp_number = result.pp_number and pp.version_id = result.version_id  order by result.date, pp.pp_number, pp.version_id, pp.color, pp.style_name, pp.gw, pp.fw";
         
        $result_for_raising= mysqli_query($con,$sql_for_raising) or die(mysqli_error($con));

        $row_number_for_raising = mysqli_num_rows($result_for_raising);

        $counter = $counter + ($row_number_for_raising*8) + 10 + 10; 

        if($counter>200)
            {
                $pdf->AddPage();
                $pdf->SetLeftMargin(8);
                $counter =30;
                $counter = $counter + ($row_number_for_raising*8) + 10 + 10; 

            } 

        $pdf->SetFont('Arial','B',14);
        $pdf->Ln(3);
        $pdf->Cell(280,7,$Serial.'.'.'  '.'Raising'.'   ('.$row["start_date"].' To '.$row["end_date"].')'.$pdf->SetFillColor(255,255,255),"0","1","L",true);
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
        $pdf->MultiCell(28,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
        $pdf->SetXY($x + 49, $y);
        $data = "Color";
        strlen($data)<15?$b=10:$b=5;
        $pdf->MultiCell(24,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
        $pdf->SetXY($x + 73, $y);
        $data = "Style";
        strlen($data)<15?$b=10:$b=5;
        $pdf->MultiCell(24,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
        $pdf->SetXY($x + 97, $y);
        $data = "Greige Width (inch)";
        strlen($data)<10?$b=10:$b=5;
        $pdf->MultiCell(21,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
        $pdf->SetXY($x + 118, $y);
        $data = "Finish Width (inch)";
        strlen($data)<10?$b=10:$b=5;
        $pdf->MultiCell(21,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
        $pdf->SetXY($x + 139, $y);
        $data = "Before Trolley No.";
        strlen($data)<10?$b=10:$b=5;
        $pdf->MultiCell(20,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
        $pdf->SetXY($x + 159, $y);
        $data = "B. Process Qty (mtr.)";
        strlen($data)<15?$b=10:$b=5;
        $pdf->MultiCell(20,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
        $pdf->SetXY($x + 179, $y);
        $data = "After Trolley No.";
        strlen($data)<10?$b=10:$b=5;
        $pdf->MultiCell(20,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
        $pdf->SetXY($x + 199, $y);
        $data = "Process Qty (mtr.)";
        strlen($data)<10?$b=10:$b=5;
        $pdf->MultiCell(20,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
        $pdf->SetXY($x + 219, $y);
        $data = "(+/-) From Prev. Process";
        strlen($data)<10?$b=10:$b=5;
        $pdf->MultiCell(41,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
        $pdf->SetXY($x + 219, $y+5);
        $data = "Qty (mtr.)";
        // strlen($data)<15?$b=10:$b=5;
        $pdf->MultiCell(23,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
        $pdf->SetXY($x + 242, $y+5);
        $data = "%";
        // strlen($data)<15?$b=10:$b=5;
        $pdf->MultiCell(18,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
        $pdf->SetXY($x + 260, $y);
        $data = "Process / Reprocess";
        strlen($data)<10?$b=10:$b=5;
        $pdf->MultiCell(20,$b,"$data".$pdf->SetFillColor(220,220,220),'1','C',TRUE);
        // $pdf->SetXY($x + 194, $y);

        $pdf->Cell(200,0,$pdf->SetFillColor(255,255,255),'1','1','c',true);

        $pdf->SetFont('Arial','',9);


                                        while($row = mysqli_fetch_array($result_for_raising))  
                                        {
                                            $x = $pdf->GetX();
                                            $y = $pdf->GetY();
                                            $data = $row['date'];
                                            strlen($data)<20?$b=8:$b=4;
                                            $pdf->MultiCell(21,$b,$data,'1','C');
                                            $pdf->SetXY($x + 21, $y);
                                            $data = $row['version_number'];
                                            strlen($data)<16?$b=8:$b=4;
                                            $pdf->MultiCell(28,$b,$data,'1','C');
                                            $pdf->SetXY($x + 49, $y);
                                            $data = $row['color'];
                                            strlen($data)<20?$b=8:$b=4;
                                            $pdf->MultiCell(24,$b,$data,'1','C');
                                            $pdf->SetXY($x + 73, $y);
                                            $data = $row['style_name'];
                                            strlen($data)<10?$b=8:$b=4;
                                            $pdf->MultiCell(24,$b,$data,'1','C');
                                            $pdf->SetXY($x + 97, $y);
                                            $data = $row['gw'];
                                            strlen($data)<20?$b=8:$b=4;
                                            $pdf->MultiCell(21,$b,$data,'1','C');
                                            $pdf->SetXY($x + 118, $y);
                                            $data = $row['fw'];
                                            strlen($data)<20?$b=8:$b=4;
                                            $pdf->MultiCell(21,$b,$data,'1','C');
                                            $pdf->SetXY($x + 139, $y);
                                            $data = $row['before_trolley_number_or_batcher_number'];
                                            strlen($data)<20?$b=8:$b=4;
                                            $pdf->MultiCell(20,$b,$data,'1','C');
                                            $pdf->SetXY($x + 159, $y);
                                            $data = $row['before_trolley_or_batcher_qty'];
                                            strlen($data)<20?$b=8:$b=4;
                                            $pdf->MultiCell(20,$b,$data,'1','C');
                                            $pdf->SetXY($x + 179, $y);
                                            $data = $row['after_trolley_number_or_batcher_number'];
                                            strlen($data)<20?$b=8:$b=4;
                                            $pdf->MultiCell(20,$b,$data,'1','C');
                                            $pdf->SetXY($x + 199, $y);
                                            $data = $row['after_trolley_or_batcher_qty'];
                                            strlen($data)<20?$b=8:$b=4;
                                            $pdf->MultiCell(20,$b,$data,'1','C');
                                            $pdf->SetXY($x + 219, $y);
                                            $data = $row['short_proc'];
                                            strlen($data)<20?$b=8:$b=4;
                                            $pdf->MultiCell(23,$b,$data,'1','C');
                                            $pdf->SetXY($x + 242, $y);
                                            $data = $row['short_percent'];
                                            strlen($data)<20?$b=8:$b=4;
                                            $pdf->MultiCell(18,$b,$data,'1','C');
                                            $pdf->SetXY($x + 260, $y);
                                            $data = $row['process_or_reprocess'];
                                            strlen($data)<20?$b=8:$b=4;
                                            $pdf->SetFont('Arial','',7);
                                            $pdf->MultiCell(20,$b,$data,'1','C'); 
                                            $pdf->SetFont('Arial','',9); 
                                        }



                                // Width summary for raising	

                                $sql_for_raising_width = "select pp.pp_number, pp.gw, pp.fw, pp.pp_quantity, result.process_qty, result.before_process_qty, result.gray_process_qty,
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
                               where ptv.pp_number = ptftri_1.pp_number and ptv.process_id = 'proc_20' and fw = ptv.finish_width_in_inch) gray_process_qty 
                               FROM
                               partial_test_for_test_result_info ptftri_1
                                inner join (
                               SELECT ptftri.process_id,ptftri.pp_number, pwvci.finish_width_in_inch fw, pwvci.greige_width_in_inch gw,ptftri.version_id
                                ,max(ptftri.partial_test_for_test_result_creation_date) max_date
                               from partial_test_for_test_result_info ptftri, pp_wise_version_creation_info pwvci
                                where ptftri.pp_number = pwvci.pp_number and ptftri.version_id = pwvci.version_id and ptftri.style=pwvci.style_name
                                and ptftri.finish_width_in_inch=pwvci.finish_width_in_inch 
                               and ptftri.process_id = 'proc_15' and ptftri.pp_number = '$pp_number'
                                group by ptftri.pp_number, pwvci.finish_width_in_inch, pwvci.greige_width_in_inch,ptftri.version_id )P
                               where  1=1
                               and ptftri_1.process_id = p.process_id
                               and ptftri_1.pp_number = p.pp_number
                               and ptftri_1.version_id = p.version_id
                               and ptftri_1.partial_test_for_test_result_creation_date = p.max_date
                               group by process_id,pp_number, fw,  gw)result 
                               on pp.pp_number = result.pp_number and pp.fw = result.fw and pp.gw = result.gw 
                               order by pp.pp_number, pp.gw, pp.fw";
                                
                                $result_for_raising_width= mysqli_query($con,$sql_for_raising_width) or die(mysqli_error($con));

                                $row_number_for_raising_width = mysqli_num_rows($result_for_raising_width);

                                $counter = $counter + ($row_number_for_raising_width*8) + 10 + 10; 
                  
                                  if($counter>200)
                                      {
                                          $pdf->AddPage();
                                          $pdf->SetLeftMargin(8);
                                          $counter =30;
                                          $counter = $counter + ($row_number_for_raising_width*8) + 10 + 10; 
                                      } 

                                $pdf->SetFont('Arial','B',11);
                                $pdf->Ln(3);
                                $pdf->Cell(280,7,"Width Summary".$pdf->SetFillColor(220,220,220),"1","1","C",true);
                                $pdf->SetFont('Arial','B',9);

                                $x = $pdf->GetX();
                                $y = $pdf->GetY();
                                $data = "Greige Width (inch)";
                                strlen($data)<15?$b=10:$b=5;
                                $pdf->MultiCell(30,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 30, $y);
                                $data = "Finish Width (inch)";
                                strlen($data)<15?$b=10:$b=5;
                                $pdf->MultiCell(30,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 60, $y);
                                $data = "PP Quantity. (mtr.)";
                                strlen($data)<25?$b=10:$b=5;
                                $pdf->MultiCell(32,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 92, $y);
                                $data = "Before Process Quantity (mtr.)";
                                strlen($data)<25?$b=10:$b=5;
                                $pdf->MultiCell(33,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 125, $y);
                                $data = "Process Quantity. (mtr.)";
                                strlen($data)<15?$b=10:$b=5;
                                $pdf->MultiCell(32,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 157, $y);
                                $data = "(+/-) From PP";
                                // strlen($data)<15?$b=10:$b=5;
                                $pdf->MultiCell(41,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 157, $y+5);
                                $data = "Qty (mtr.)";
                                // strlen($data)<15?$b=10:$b=5;
                                $pdf->MultiCell(23,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 180, $y+5);
                                $data = "%";
                                // strlen($data)<15?$b=10:$b=5;
                                $pdf->MultiCell(18,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 198, $y);
                                $data = "(+/-) From Greige";
                                // strlen($data)<15?$b=10:$b=5;
                                $pdf->MultiCell(41,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 198, $y+5);
                                $data = "Qty (mtr.)";
                                // strlen($data)<15?$b=10:$b=5;
                                $pdf->MultiCell(23,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 221, $y+5);
                                $data = "%";
                                // strlen($data)<15?$b=10:$b=5;
                                $pdf->MultiCell(18,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 239, $y);
                                $data = "(+/-) From Prev. Process";
                                // strlen($data)<15?$b=10:$b=5;
                                $pdf->MultiCell(41,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 239, $y+5);
                                $data = "Qty (mtr.)";
                                // strlen($data)<15?$b=10:$b=5;
                                $pdf->MultiCell(23,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 262, $y+5);
                                $data = "%";
                                // strlen($data)<15?$b=10:$b=5;
                                $pdf->MultiCell(18,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 280, $y);
                                
                                // $pdf->Cell(0,0,$pdf->SetFillColor(255,255,255),'1','1','C',true);
                                $pdf->SetFont('Arial','',9);       
                                 $pdf->Ln(10);
                               
                                
                            while($row = mysqli_fetch_array($result_for_raising_width))  
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
                                $pdf->MultiCell(32,$b,$data,'1','C');
                                $pdf->SetXY($x + 92, $y);
                                $data = $row['before_process_qty'];
                                strlen($data)<20?$b=8:$b=4;
                                $pdf->MultiCell(33,$b,$data,'1','C');
                                $pdf->SetXY($x + 125, $y);
                                $data = $row['process_qty'];
                                strlen($data)<20?$b=8:$b=4;
                                $pdf->MultiCell(32,$b,$data,'1','C');
                                $pdf->SetXY($x + 157, $y);
                                $data = $row['short_pp_qty'];
                                strlen($data)<15?$b=8:$b=4;
                                $pdf->MultiCell(23,$b,$data,'1','C');
                                $pdf->SetXY($x + 180, $y);
                                $data = $row['short_pp_percent'];
                                strlen($data)<15?$b=8:$b=4;
                                $pdf->MultiCell(18,$b,$data,'1','C');
                                $pdf->SetXY($x + 198, $y);
                                $data = $row['short_gre_rcv_qty'];
                                strlen($data)<15?$b=8:$b=4;
                                $pdf->MultiCell(23,$b,$data,'1','C');
                                $pdf->SetXY($x + 221, $y);
                                $data = $row['short_gre_rcv_percent'];
                                strlen($data)<15?$b=8:$b=4;
                                $pdf->MultiCell(18,$b,$data,'1','C');
                                $pdf->SetXY($x + 239, $y);
                                $data = $row['short_pre_proc_qty'];
                                strlen($data)<15?$b=8:$b=4;
                                $pdf->MultiCell(23,$b,$data,'1','C');
                                $pdf->SetXY($x + 262, $y);
                                $data = $row['short_pre_proc_percent'];
                                strlen($data)<15?$b=8:$b=4;
                                $pdf->MultiCell(18,$b,$data,'1','C');
                                // $pdf->SetXY($x + 200, $y);

                            }
                                // Version summary for raising

                                 $sql_for_raising_version = "select pp.pp_number, pp.version_name version_number, pp.style_name, pp.color, pp.gw, pp.fw, pp.pp_quantity, result.process_qty, result.before_process_qty, result.gray_process_qty, 
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
                                 and ptftri.process_id = 'proc_15' and ptftri.pp_number = '$pp_number'
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

                                  $result_for_raising_version= mysqli_query($con,$sql_for_raising_version) or die(mysqli_error($con));

                                  $row_number_for_raising_version = mysqli_num_rows($result_for_raising_version);

                                  $counter = $counter + ($row_number_for_raising_version*8) + 10 + 10 + 8; 
                  
                                  if($counter>200)
                                      {
                                          $pdf->AddPage();
                                          $pdf->SetLeftMargin(8);
                                          $counter =30;
                                          $counter = $counter + ($row_number_for_raising_version*8) + 10 + 10 + 8; 

                                      } 

                                  $pdf->SetFont('Arial','B',11);
                                  $pdf->Ln(3);
                                  $pdf->Cell(280,7,"Version Summary".$pdf->SetFillColor(220,220,220),"1","1","C",true);
                                  $pdf->SetFont('Arial','B',9);

                                $x = $pdf->GetX();
                                $y = $pdf->GetY();
                                $data = "Version";
                                strlen($data)<15?$b=10:$b=5;
                                $pdf->MultiCell(28,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 28, $y);
                                $data = "Color";
                                strlen($data)<15?$b=10:$b=5;
                                $pdf->MultiCell(24,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 52, $y);
                                $data = "Style";
                                strlen($data)<15?$b=10:$b=5;
                                $pdf->MultiCell(24,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 76, $y);
                                $data = "PP Quantity (mtr.)";
                                strlen($data)<15?$b=10:$b=5;
                                $pdf->MultiCell(27,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 103, $y);
                                $data = "Before process Qty (mtr.)";
                                strlen($data)<20?$b=10:$b=5;
                                $pdf->MultiCell(27,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 130, $y);
                                $data = "Process Quantity (mtr.)";
                                strlen($data)<20?$b=10:$b=5;
                                $pdf->MultiCell(27,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 157, $y);
                                $data = "(+/-) From PP";
                                // strlen($data)<15?$b=10:$b=5;
                                $pdf->MultiCell(41,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 157, $y+5);
                                $data = "Qty (mtr.)";
                                // strlen($data)<15?$b=10:$b=5;
                                $pdf->MultiCell(23,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 180, $y+5);
                                $data = "%";
                                // strlen($data)<15?$b=10:$b=5;
                                $pdf->MultiCell(18,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 198, $y);
                                $data = "(+/-) From Greige";
                                // strlen($data)<15?$b=10:$b=5;
                                $pdf->MultiCell(41,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 198, $y+5);
                                $data = "Qty (mtr.)";
                                // strlen($data)<15?$b=10:$b=5;
                                $pdf->MultiCell(23,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 221, $y+5);
                                $data = "%";
                                // strlen($data)<15?$b=10:$b=5;
                                $pdf->MultiCell(18,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 239, $y);
                                $data = "(+/-) From Prev. Process";
                                // strlen($data)<15?$b=10:$b=5;
                                $pdf->MultiCell(41,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 239, $y+5);
                                $data = "Qty (mtr.)";
                                // strlen($data)<15?$b=10:$b=5;
                                $pdf->MultiCell(23,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 262, $y+5);
                                $data = "%";
                                // strlen($data)<15?$b=10:$b=5;
                                $pdf->MultiCell(18,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 280, $y);
                                
                                // $pdf->Cell(0,0,$pdf->SetFillColor(255,255,255),'1','1','C',true);
                                $pdf->SetFont('Arial','',9);       
                                 $pdf->Ln(10);
    
                          while($row = mysqli_fetch_array($result_for_raising_version))  
                          {  
                              $x = $pdf->GetX();
                              $y = $pdf->GetY();
                              $data = $row['version_number'];
                              strlen($data)<16?$b=8:$b=4;
                              $pdf->MultiCell(28,$b,$data,'1','C');
                              $pdf->SetXY($x + 28, $y);
                              $data = $row['color'];
                              strlen($data)<20?$b=8:$b=4;
                              $pdf->MultiCell(24,$b,$data,'1','C');
                              $pdf->SetXY($x + 52, $y);
                              $data = $row['style_name'];
                              strlen($data)<10?$b=8:$b=4;
                              $pdf->MultiCell(24,$b,$data,'1','C');
                              $pdf->SetXY($x + 76, $y);
                              $data = $row['pp_quantity'];
                              strlen($data)<20?$b=8:$b=4;
                              $pdf->MultiCell(27,$b,$data,'1','C');
                              $pdf->SetXY($x + 103, $y);
                              $data = $row['before_process_qty'];
                              strlen($data)<20?$b=8:$b=4;
                              $pdf->MultiCell(27,$b,$data,'1','C');
                              $pdf->SetXY($x + 130, $y);
                              $data = $row['process_qty'];
                              strlen($data)<20?$b=8:$b=4;
                              $pdf->MultiCell(27,$b,$data,'1','C');
                              $pdf->SetXY($x + 157, $y);
                              $data = $row['short_pp'];
                              strlen($data)<15?$b=8:$b=4;
                              $pdf->MultiCell(23,$b,$data,'1','C');
                              $pdf->SetXY($x + 180, $y);
                              $data = $row['short_pp_percent'];
                              strlen($data)<15?$b=8:$b=4;
                              $pdf->MultiCell(18,$b,$data,'1','C');
                              $pdf->SetXY($x + 198, $y);
                              $data = $row['short_gre_rcv_qty'];
                              strlen($data)<15?$b=8:$b=4;
                              $pdf->MultiCell(23,$b,$data,'1','C');
                              $pdf->SetXY($x + 221, $y);
                              $data = $row['short_gre_rcv_percent'];
                              strlen($data)<15?$b=8:$b=4;
                              $pdf->MultiCell(18,$b,$data,'1','C');
                              $pdf->SetXY($x + 239, $y);
                              $data = $row['short_pre_proc_qty'];
                              strlen($data)<15?$b=8:$b=4;
                              $pdf->MultiCell(23,$b,$data,'1','C');
                              $pdf->SetXY($x + 262, $y);
                              $data = $row['short_pre_proc_percent'];
                              strlen($data)<15?$b=8:$b=4;
                              $pdf->MultiCell(18,$b,$data,'1','C');
                              // $pdf->SetXY($x + 280, $y);

                          }

                          $sql_for_raising_total = "select total.pp_number, sum(total.pp_quantity) pp_quantity, sum(total.process_qty) process_qty, 
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
                        and ptftri.process_id = 'proc_15' and ptftri.pp_number = '$pp_number'
                        group by ptftri.pp_number, ptftri.version_number, ptftri.finish_width_in_inch )P
                        where  1=1
                        and ptftri_1.process_id = p.process_id
                        and ptftri_1.pp_number = p.pp_number
                        and ptftri_1.version_number = p.version_name
                        and ptftri_1.partial_test_for_test_result_creation_date = p.max_date
                        and ptftri_1.finish_width_in_inch = p.finish_width_in_inch
                        group by process_id,pp_number, version_name)result where pp.pp_number = result.pp_number and pp.version_name = result.version_name ) total
                        ";

                        $result_for_raising_total= mysqli_query($con,$sql_for_raising_total) or die(mysqli_error($con));
                        while($row = mysqli_fetch_array($result_for_raising_total))  
                        {
                            $pdf->SetFont('Arial','B',9); 
                            $x = $pdf->GetX();
                            $y = $pdf->GetY();
                            $data = "Raising Total Qty. (mtr.)";
                            strlen($data)<70?$b=8:$b=4;
                            $pdf->MultiCell(76,$b,$data,'1','C');
                            $pdf->SetXY($x + 76, $y);
                            $data = $row['pp_quantity'];
                            strlen($data)<20?$b=8:$b=4;
                            $pdf->MultiCell(27,$b,$data,'1','C');
                            $pdf->SetXY($x + 103, $y);
                            $data = $row['before_process_qty'];
                            strlen($data)<20?$b=8:$b=4;
                            $pdf->MultiCell(27,$b,$data,'1','C');
                            $pdf->SetXY($x + 130, $y);
                            $data = $row['process_qty'];
                            strlen($data)<20?$b=8:$b=4;
                            $pdf->MultiCell(27,$b,$data,'1','C');
                            $pdf->SetXY($x + 157, $y);
                            $data = $row['short_pp_qty'];
                            strlen($data)<20?$b=8:$b=4;
                            $pdf->MultiCell(23,$b,$data,'1','C');
                            $pdf->SetXY($x + 180, $y);
                            $data = $row['short_pp_percent'];
                            strlen($data)<20?$b=8:$b=4;
                            $pdf->MultiCell(18,$b,$data,'1','C'); 
                            $pdf->SetXY($x + 198, $y); 
                            $data = $row['short_gre_rcv_qty'];
                            strlen($data)<20?$b=8:$b=4;
                            $pdf->MultiCell(23,$b,$data,'1','C');
                            $pdf->SetXY($x + 221, $y);
                            $data = $row['short_gre_rcv_percent'];
                            strlen($data)<20?$b=8:$b=4;
                            $pdf->MultiCell(18,$b,$data,'1','C');
                            $pdf->SetXY($x + 239, $y); 
                            $data = $row['short_pre_proc_qty'];
                            strlen($data)<20?$b=8:$b=4;
                            $pdf->MultiCell(23,$b,$data,'1','C');
                            $pdf->SetXY($x + 262, $y);
                            $data = $row['short_pre_proc_percent'];
                            strlen($data)<20?$b=8:$b=4;
                            $pdf->MultiCell(18,$b,$data,'1','C');  

                            if($row['short_excess_qty']!= '') 
                                {
                                    $process_loss_gain+=$row['short_excess_qty'];
                                }
                    
                                $Total_pp_quantity = $row['pp_quantity'];
                                $Total_greige_quantity = $row['process_qty'];
                         
                        }

    }
  }



             /*************************************************  Finishing (Process No- 16) ***************************************************/

             $greige_period = "select ptftri.pp_number, ptftri.process_id, date_format(min(ptftri.partial_test_for_test_result_creation_date), '%d-%b-%Y') start_date,
             date_format(max(ptftri.partial_test_for_test_result_creation_date), '%d-%b-%Y') end_date
             from partial_test_for_test_result_info  ptftri where  ptftri.process_id = 'proc_16' and ptftri.pp_number = '$pp_number'";
      
              $result_for_greige= mysqli_query($con,$greige_period) or die(mysqli_error($con));
              while($row = mysqli_fetch_array($result_for_greige))  
              {  
                  if($row['end_date']!= '') 
                  {
                      $process_completion_date = $row['end_date'];
                  }
      
                  if($row_for_select_process["process_id"] == "proc_16")
                  {
                      $Serial+=1;
    
                      $sql_for_finishing = "select pp.pp_number, pp.version_name as version_number, pp.color, pp.style_name, pp.gw, pp.fw, pp.pp_quantity, result.after_trolley_or_batcher_qty, result.date, 
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
                      ptftri.pp_number = aptv.pp_number and ptftri.version_id = aptv.version_id and ptftri.style=aptv.style_name  and ptftri.process_name=aptv.process_name and ptftri.process_id = 'proc_16'
                       and ptftri.pp_number = '$pp_number')result 
                      
                      on pp.pp_number = result.pp_number and pp.version_id = result.version_id  order by result.date, pp.pp_number, pp.version_id, pp.color, pp.style_name, pp.gw, pp.fw";
                       
                      $result_for_finishing = mysqli_query($con,$sql_for_finishing) or die(mysqli_error($con));
    
                      $row_number_for_finishing = mysqli_num_rows($result_for_finishing);
    
                      $counter = $counter + ($row_number_for_finishing * 8) + 10 + 10; 
      
                      if($counter>200)
                          {
                              $pdf->AddPage();
                              $pdf->SetLeftMargin(8);
                              $counter =30;
                              $counter = $counter + ($row_number_for_finishing * 8) + 10 + 10; 
    
                          } 
    
                      $pdf->SetFont('Arial','B',14);
                      $pdf->Ln(3);
                      $pdf->Cell(280,7,$Serial.'.'.'  '.'Finishing'.'   ('.$row["start_date"].' To '.$row["end_date"].')'.$pdf->SetFillColor(255,255,255),"0","1","L",true);
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
                      $pdf->MultiCell(28,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                      $pdf->SetXY($x + 49, $y);
                      $data = "Color";
                      strlen($data)<15?$b=10:$b=5;
                      $pdf->MultiCell(24,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                      $pdf->SetXY($x + 73, $y);
                      $data = "Style";
                      strlen($data)<15?$b=10:$b=5;
                      $pdf->MultiCell(24,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                      $pdf->SetXY($x + 97, $y);
                      $data = "Greige Width (inch)";
                      strlen($data)<10?$b=10:$b=5;
                      $pdf->MultiCell(21,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                      $pdf->SetXY($x + 118, $y);
                      $data = "Finish Width (inch)";
                      strlen($data)<10?$b=10:$b=5;
                      $pdf->MultiCell(21,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                      $pdf->SetXY($x + 139, $y);
                      $data = "Before Trolley No.";
                      strlen($data)<10?$b=10:$b=5;
                      $pdf->MultiCell(20,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                      $pdf->SetXY($x + 159, $y);
                      $data = "B. Process Qty (mtr.)";
                      strlen($data)<15?$b=10:$b=5;
                      $pdf->MultiCell(20,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                      $pdf->SetXY($x + 179, $y);
                      $data = "After Trolley No.";
                      strlen($data)<10?$b=10:$b=5;
                      $pdf->MultiCell(20,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                      $pdf->SetXY($x + 199, $y);
                      $data = "Process Qty (mtr.)";
                      strlen($data)<10?$b=10:$b=5;
                      $pdf->MultiCell(20,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                      $pdf->SetXY($x + 219, $y);
                      $data = "(+/-) From Prev. Process";
                      strlen($data)<10?$b=10:$b=5;
                      $pdf->MultiCell(41,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                      $pdf->SetXY($x + 219, $y+5);
                      $data = "Qty (mtr.)";
                      // strlen($data)<15?$b=10:$b=5;
                      $pdf->MultiCell(23,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                      $pdf->SetXY($x + 242, $y+5);
                      $data = "%";
                      // strlen($data)<15?$b=10:$b=5;
                      $pdf->MultiCell(18,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                      $pdf->SetXY($x + 260, $y);
                      $data = "Process / Reprocess";
                      strlen($data)<10?$b=10:$b=5;
                      $pdf->MultiCell(20,$b,"$data".$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                      // $pdf->SetXY($x + 194, $y);
      
                      $pdf->Cell(200,0,$pdf->SetFillColor(255,255,255),'1','1','c',true);
          
                      $pdf->SetFont('Arial','',9);
      
    
                                                      while($row = mysqli_fetch_array($result_for_finishing))  
                                                      {
                                                          $x = $pdf->GetX();
                                                          $y = $pdf->GetY();
                                                          $data = $row['date'];
                                                          strlen($data)<20?$b=8:$b=4;
                                                          $pdf->MultiCell(21,$b,$data,'1','C');
                                                          $pdf->SetXY($x + 21, $y);
                                                          $data = $row['version_number'];
                                                          strlen($data)<16?$b=8:$b=4;
                                                          $pdf->MultiCell(28,$b,$data,'1','C');
                                                          $pdf->SetXY($x + 49, $y);
                                                          $data = $row['color'];
                                                          strlen($data)<20?$b=8:$b=4;
                                                          $pdf->MultiCell(24,$b,$data,'1','C');
                                                          $pdf->SetXY($x + 73, $y);
                                                          $data = $row['style_name'];
                                                          strlen($data)<10?$b=8:$b=4;
                                                          $pdf->MultiCell(24,$b,$data,'1','C');
                                                          $pdf->SetXY($x + 97, $y);
                                                          $data = $row['gw'];
                                                          strlen($data)<20?$b=8:$b=4;
                                                          $pdf->MultiCell(21,$b,$data,'1','C');
                                                          $pdf->SetXY($x + 118, $y);
                                                          $data = $row['fw'];
                                                          strlen($data)<20?$b=8:$b=4;
                                                          $pdf->MultiCell(21,$b,$data,'1','C');
                                                          $pdf->SetXY($x + 139, $y);
                                                          $data = $row['before_trolley_number_or_batcher_number'];
                                                          strlen($data)<20?$b=8:$b=4;
                                                          $pdf->MultiCell(20,$b,$data,'1','C');
                                                          $pdf->SetXY($x + 159, $y);
                                                          $data = $row['before_trolley_or_batcher_qty'];
                                                          strlen($data)<20?$b=8:$b=4;
                                                          $pdf->MultiCell(20,$b,$data,'1','C');
                                                          $pdf->SetXY($x + 179, $y);
                                                          $data = $row['after_trolley_number_or_batcher_number'];
                                                          strlen($data)<20?$b=8:$b=4;
                                                          $pdf->MultiCell(20,$b,$data,'1','C');
                                                          $pdf->SetXY($x + 199, $y);
                                                          $data = $row['after_trolley_or_batcher_qty'];
                                                          strlen($data)<20?$b=8:$b=4;
                                                          $pdf->MultiCell(20,$b,$data,'1','C');
                                                          $pdf->SetXY($x + 219, $y);
                                                          $data = $row['short_proc'];
                                                          strlen($data)<20?$b=8:$b=4;
                                                          $pdf->MultiCell(23,$b,$data,'1','C');
                                                          $pdf->SetXY($x + 242, $y);
                                                          $data = $row['short_percent'];
                                                          strlen($data)<20?$b=8:$b=4;
                                                          $pdf->MultiCell(18,$b,$data,'1','C');
                                                          $pdf->SetXY($x + 260, $y);
                                                          $data = $row['process_or_reprocess'];
                                                          strlen($data)<20?$b=8:$b=4;
                                                          $pdf->SetFont('Arial','',7);
                                                          $pdf->MultiCell(20,$b,$data,'1','C'); 
                                                          $pdf->SetFont('Arial','',9); 
                                                      }
    
    
    
                                              // Width summary for Finishing
    
                                              $sql_for_finishing_width = "select pp.pp_number, pp.gw, pp.fw, pp.pp_quantity, result.process_qty, result.before_process_qty, result.gray_process_qty,
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
                                             where ptv.pp_number = ptftri_1.pp_number and ptv.process_id = 'proc_20' and fw = ptv.finish_width_in_inch) gray_process_qty 
                                             FROM
                                             partial_test_for_test_result_info ptftri_1
                                              inner join (
                                             SELECT ptftri.process_id,ptftri.pp_number, pwvci.finish_width_in_inch fw, pwvci.greige_width_in_inch gw,ptftri.version_id
                                              ,max(ptftri.partial_test_for_test_result_creation_date) max_date
                                             from partial_test_for_test_result_info ptftri, pp_wise_version_creation_info pwvci
                                              where ptftri.pp_number = pwvci.pp_number and ptftri.version_id = pwvci.version_id and ptftri.style=pwvci.style_name
                                              and ptftri.finish_width_in_inch=pwvci.finish_width_in_inch 
                                             and ptftri.process_id = 'proc_16' and ptftri.pp_number = '$pp_number'
                                              group by ptftri.pp_number, pwvci.finish_width_in_inch, pwvci.greige_width_in_inch,ptftri.version_id )P
                                             where  1=1
                                             and ptftri_1.process_id = p.process_id
                                             and ptftri_1.pp_number = p.pp_number
                                             and ptftri_1.version_id = p.version_id
                                             and ptftri_1.partial_test_for_test_result_creation_date = p.max_date
                                             group by process_id,pp_number, fw,  gw)result 
                                             on pp.pp_number = result.pp_number and pp.fw = result.fw and pp.gw = result.gw 
                                             order by pp.pp_number, pp.gw, pp.fw";
                                              
                                              $result_for_finishing_width= mysqli_query($con,$sql_for_finishing_width) or die(mysqli_error($con));
    
                                              $row_number_for_finishing_width = mysqli_num_rows($result_for_finishing_width);
    
                                              $counter = $counter + ($row_number_for_finishing_width*8) + 10 + 10; 
                                
                                                if($counter>200)
                                                    {
                                                        $pdf->AddPage();
                                                        $pdf->SetLeftMargin(8);
                                                        $counter =30;
                                                        $counter = $counter + ($row_number_for_finishing_width*8) + 10 + 10; 
                                                    } 
    
                                              $pdf->SetFont('Arial','B',11);
                                              $pdf->Ln(3);
                                              $pdf->Cell(280,7,"Width Summary".$pdf->SetFillColor(220,220,220),"1","1","C",true);
                                              $pdf->SetFont('Arial','B',9);
    
                                              $x = $pdf->GetX();
                                              $y = $pdf->GetY();
                                              $data = "Greige Width (inch)";
                                              strlen($data)<15?$b=10:$b=5;
                                              $pdf->MultiCell(30,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                              $pdf->SetXY($x + 30, $y);
                                              $data = "Finish Width (inch)";
                                              strlen($data)<15?$b=10:$b=5;
                                              $pdf->MultiCell(30,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                              $pdf->SetXY($x + 60, $y);
                                              $data = "PP Quantity. (mtr.)";
                                              strlen($data)<25?$b=10:$b=5;
                                              $pdf->MultiCell(32,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                              $pdf->SetXY($x + 92, $y);
                                              $data = "Before Process Quantity (mtr.)";
                                              strlen($data)<25?$b=10:$b=5;
                                              $pdf->MultiCell(33,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                              $pdf->SetXY($x + 125, $y);
                                              $data = "Process Quantity. (mtr.)";
                                              strlen($data)<15?$b=10:$b=5;
                                              $pdf->MultiCell(32,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                              $pdf->SetXY($x + 157, $y);
                                              $data = "(+/-) From PP";
                                              // strlen($data)<15?$b=10:$b=5;
                                              $pdf->MultiCell(41,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                              $pdf->SetXY($x + 157, $y+5);
                                              $data = "Qty (mtr.)";
                                              // strlen($data)<15?$b=10:$b=5;
                                              $pdf->MultiCell(23,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                              $pdf->SetXY($x + 180, $y+5);
                                              $data = "%";
                                              // strlen($data)<15?$b=10:$b=5;
                                              $pdf->MultiCell(18,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                              $pdf->SetXY($x + 198, $y);
                                              $data = "(+/-) From Greige";
                                              // strlen($data)<15?$b=10:$b=5;
                                              $pdf->MultiCell(41,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                              $pdf->SetXY($x + 198, $y+5);
                                              $data = "Qty (mtr.)";
                                              // strlen($data)<15?$b=10:$b=5;
                                              $pdf->MultiCell(23,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                              $pdf->SetXY($x + 221, $y+5);
                                              $data = "%";
                                              // strlen($data)<15?$b=10:$b=5;
                                              $pdf->MultiCell(18,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                              $pdf->SetXY($x + 239, $y);
                                              $data = "(+/-) From Prev. Process";
                                              // strlen($data)<15?$b=10:$b=5;
                                              $pdf->MultiCell(41,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                              $pdf->SetXY($x + 239, $y+5);
                                              $data = "Qty (mtr.)";
                                              // strlen($data)<15?$b=10:$b=5;
                                              $pdf->MultiCell(23,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                              $pdf->SetXY($x + 262, $y+5);
                                              $data = "%";
                                              // strlen($data)<15?$b=10:$b=5;
                                              $pdf->MultiCell(18,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                              $pdf->SetXY($x + 280, $y);
                                              
                                              // $pdf->Cell(0,0,$pdf->SetFillColor(255,255,255),'1','1','C',true);
                                              $pdf->SetFont('Arial','',9);       
                                               $pdf->Ln(10);
                                             
                                              
                                          while($row = mysqli_fetch_array($result_for_finishing_width))  
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
                                              $pdf->MultiCell(32,$b,$data,'1','C');
                                              $pdf->SetXY($x + 92, $y);
                                              $data = $row['before_process_qty'];
                                              strlen($data)<20?$b=8:$b=4;
                                              $pdf->MultiCell(33,$b,$data,'1','C');
                                              $pdf->SetXY($x + 125, $y);
                                              $data = $row['process_qty'];
                                              strlen($data)<20?$b=8:$b=4;
                                              $pdf->MultiCell(32,$b,$data,'1','C');
                                              $pdf->SetXY($x + 157, $y);
                                              $data = $row['short_pp_qty'];
                                              strlen($data)<15?$b=8:$b=4;
                                              $pdf->MultiCell(23,$b,$data,'1','C');
                                              $pdf->SetXY($x + 180, $y);
                                              $data = $row['short_pp_percent'];
                                              strlen($data)<15?$b=8:$b=4;
                                              $pdf->MultiCell(18,$b,$data,'1','C');
                                              $pdf->SetXY($x + 198, $y);
                                              $data = $row['short_gre_rcv_qty'];
                                              strlen($data)<15?$b=8:$b=4;
                                              $pdf->MultiCell(23,$b,$data,'1','C');
                                              $pdf->SetXY($x + 221, $y);
                                              $data = $row['short_gre_rcv_percent'];
                                              strlen($data)<15?$b=8:$b=4;
                                              $pdf->MultiCell(18,$b,$data,'1','C');
                                              $pdf->SetXY($x + 239, $y);
                                              $data = $row['short_pre_proc_qty'];
                                              strlen($data)<15?$b=8:$b=4;
                                              $pdf->MultiCell(23,$b,$data,'1','C');
                                              $pdf->SetXY($x + 262, $y);
                                              $data = $row['short_pre_proc_percent'];
                                              strlen($data)<15?$b=8:$b=4;
                                              $pdf->MultiCell(18,$b,$data,'1','C');
                                              // $pdf->SetXY($x + 200, $y);
    
                                          }
                                              // Version summary for Finishing
    
                                               $sql_for_finishing_version = "select pp.pp_number, pp.version_name version_number, pp.style_name, pp.color, pp.gw, pp.fw, pp.pp_quantity, result.process_qty, result.before_process_qty, result.gray_process_qty, 
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
                                               and ptftri.process_id = 'proc_16' and ptftri.pp_number = '$pp_number'
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
    
                                                $result_for_finishing_version= mysqli_query($con,$sql_for_finishing_version) or die(mysqli_error($con));
    
                                                $row_number_for_finishing_version = mysqli_num_rows($result_for_finishing_version);
    
                                                $counter = $counter + ($row_number_for_finishing_version*8) + 10 + 10 + 8; 
                                
                                                if($counter>200)
                                                    {
                                                        $pdf->AddPage();
                                                        $pdf->SetLeftMargin(8);
                                                        $counter =30;
                                                        $counter = $counter + ($row_number_for_finishing_version*8) + 10 + 10 + 8; 
                                                    } 
    
                                                $pdf->SetFont('Arial','B',11);
                                                $pdf->Ln(3);
                                                $pdf->Cell(280,7,"Version Summary".$pdf->SetFillColor(220,220,220),"1","1","C",true);
                                                $pdf->SetFont('Arial','B',9);
    
                                              $x = $pdf->GetX();
                                              $y = $pdf->GetY();
                                              $data = "Version";
                                              strlen($data)<15?$b=10:$b=5;
                                              $pdf->MultiCell(28,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                              $pdf->SetXY($x + 28, $y);
                                              $data = "Color";
                                              strlen($data)<15?$b=10:$b=5;
                                              $pdf->MultiCell(24,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                              $pdf->SetXY($x + 52, $y);
                                              $data = "Style";
                                              strlen($data)<15?$b=10:$b=5;
                                              $pdf->MultiCell(24,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                              $pdf->SetXY($x + 76, $y);
                                              $data = "PP Quantity (mtr.)";
                                              strlen($data)<15?$b=10:$b=5;
                                              $pdf->MultiCell(27,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                              $pdf->SetXY($x + 103, $y);
                                              $data = "Before process Qty (mtr.)";
                                              strlen($data)<20?$b=10:$b=5;
                                              $pdf->MultiCell(27,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                              $pdf->SetXY($x + 130, $y);
                                              $data = "Process Quantity (mtr.)";
                                              strlen($data)<20?$b=10:$b=5;
                                              $pdf->MultiCell(27,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                              $pdf->SetXY($x + 157, $y);
                                              $data = "(+/-) From PP";
                                              // strlen($data)<15?$b=10:$b=5;
                                              $pdf->MultiCell(41,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                              $pdf->SetXY($x + 157, $y+5);
                                              $data = "Qty (mtr.)";
                                              // strlen($data)<15?$b=10:$b=5;
                                              $pdf->MultiCell(23,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                              $pdf->SetXY($x + 180, $y+5);
                                              $data = "%";
                                              // strlen($data)<15?$b=10:$b=5;
                                              $pdf->MultiCell(18,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                              $pdf->SetXY($x + 198, $y);
                                              $data = "(+/-) From Greige";
                                              // strlen($data)<15?$b=10:$b=5;
                                              $pdf->MultiCell(41,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                              $pdf->SetXY($x + 198, $y+5);
                                              $data = "Qty (mtr.)";
                                              // strlen($data)<15?$b=10:$b=5;
                                              $pdf->MultiCell(23,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                              $pdf->SetXY($x + 221, $y+5);
                                              $data = "%";
                                              // strlen($data)<15?$b=10:$b=5;
                                              $pdf->MultiCell(18,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                              $pdf->SetXY($x + 239, $y);
                                              $data = "(+/-) From Prev. Process";
                                              // strlen($data)<15?$b=10:$b=5;
                                              $pdf->MultiCell(41,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                              $pdf->SetXY($x + 239, $y+5);
                                              $data = "Qty (mtr.)";
                                              // strlen($data)<15?$b=10:$b=5;
                                              $pdf->MultiCell(23,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                              $pdf->SetXY($x + 262, $y+5);
                                              $data = "%";
                                              // strlen($data)<15?$b=10:$b=5;
                                              $pdf->MultiCell(18,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                              $pdf->SetXY($x + 280, $y);
                                              
                                              // $pdf->Cell(0,0,$pdf->SetFillColor(255,255,255),'1','1','C',true);
                                              $pdf->SetFont('Arial','',9);       
                                               $pdf->Ln(10);
                  
                                        while($row = mysqli_fetch_array($result_for_finishing_version))  
                                        {  
                                            $x = $pdf->GetX();
                                            $y = $pdf->GetY();
                                            $data = $row['version_number'];
                                            strlen($data)<16?$b=8:$b=4;
                                            $pdf->MultiCell(28,$b,$data,'1','C');
                                            $pdf->SetXY($x + 28, $y);
                                            $data = $row['color'];
                                            strlen($data)<20?$b=8:$b=4;
                                            $pdf->MultiCell(24,$b,$data,'1','C');
                                            $pdf->SetXY($x + 52, $y);
                                            $data = $row['style_name'];
                                            strlen($data)<10?$b=8:$b=4;
                                            $pdf->MultiCell(24,$b,$data,'1','C');
                                            $pdf->SetXY($x + 76, $y);
                                            $data = $row['pp_quantity'];
                                            strlen($data)<20?$b=8:$b=4;
                                            $pdf->MultiCell(27,$b,$data,'1','C');
                                            $pdf->SetXY($x + 103, $y);
                                            $data = $row['before_process_qty'];
                                            strlen($data)<20?$b=8:$b=4;
                                            $pdf->MultiCell(27,$b,$data,'1','C');
                                            $pdf->SetXY($x + 130, $y);
                                            $data = $row['process_qty'];
                                            strlen($data)<20?$b=8:$b=4;
                                            $pdf->MultiCell(27,$b,$data,'1','C');
                                            $pdf->SetXY($x + 157, $y);
                                            $data = $row['short_pp'];
                                            strlen($data)<15?$b=8:$b=4;
                                            $pdf->MultiCell(23,$b,$data,'1','C');
                                            $pdf->SetXY($x + 180, $y);
                                            $data = $row['short_pp_percent'];
                                            strlen($data)<15?$b=8:$b=4;
                                            $pdf->MultiCell(18,$b,$data,'1','C');
                                            $pdf->SetXY($x + 198, $y);
                                            $data = $row['short_gre_rcv_qty'];
                                            strlen($data)<15?$b=8:$b=4;
                                            $pdf->MultiCell(23,$b,$data,'1','C');
                                            $pdf->SetXY($x + 221, $y);
                                            $data = $row['short_gre_rcv_percent'];
                                            strlen($data)<15?$b=8:$b=4;
                                            $pdf->MultiCell(18,$b,$data,'1','C');
                                            $pdf->SetXY($x + 239, $y);
                                            $data = $row['short_pre_proc_qty'];
                                            strlen($data)<15?$b=8:$b=4;
                                            $pdf->MultiCell(23,$b,$data,'1','C');
                                            $pdf->SetXY($x + 262, $y);
                                            $data = $row['short_pre_proc_percent'];
                                            strlen($data)<15?$b=8:$b=4;
                                            $pdf->MultiCell(18,$b,$data,'1','C');
                                            // $pdf->SetXY($x + 280, $y);
    
                                        }
    
                                        $sql_for_finishing_total = "select total.pp_number, sum(total.pp_quantity) pp_quantity, sum(total.process_qty) process_qty, 
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
                                        and ptftri.process_id = 'proc_16' and ptftri.pp_number = '$pp_number'
                                        group by ptftri.pp_number, ptftri.version_number, ptftri.finish_width_in_inch )P
                                        where  1=1
                                        and ptftri_1.process_id = p.process_id
                                        and ptftri_1.pp_number = p.pp_number
                                        and ptftri_1.version_number = p.version_name
                                        and ptftri_1.partial_test_for_test_result_creation_date = p.max_date
                                        and ptftri_1.finish_width_in_inch = p.finish_width_in_inch
                                        group by process_id,pp_number, version_name)result where pp.pp_number = result.pp_number and pp.version_name = result.version_name ) total
                                        ";

                                      $result_for_finishing_total= mysqli_query($con,$sql_for_finishing_total) or die(mysqli_error($con));
                                      while($row = mysqli_fetch_array($result_for_finishing_total))  
                                      {
                                          $pdf->SetFont('Arial','B',9); 
                                          $x = $pdf->GetX();
                                          $y = $pdf->GetY();
                                          $data = "Finishing Total Qty. (mtr.)";
                                          strlen($data)<70?$b=8:$b=4;
                                          $pdf->MultiCell(76,$b,$data,'1','C');
                                          $pdf->SetXY($x + 76, $y);
                                          $data = $row['pp_quantity'];
                                          strlen($data)<20?$b=8:$b=4;
                                          $pdf->MultiCell(27,$b,$data,'1','C');
                                          $pdf->SetXY($x + 103, $y);
                                          $data = $row['before_process_qty'];
                                          strlen($data)<20?$b=8:$b=4;
                                          $pdf->MultiCell(27,$b,$data,'1','C');
                                          $pdf->SetXY($x + 130, $y);
                                          $data = $row['process_qty'];
                                          strlen($data)<20?$b=8:$b=4;
                                          $pdf->MultiCell(27,$b,$data,'1','C');
                                          $pdf->SetXY($x + 157, $y);
                                          $data = $row['short_pp_qty'];
                                          strlen($data)<20?$b=8:$b=4;
                                          $pdf->MultiCell(23,$b,$data,'1','C');
                                          $pdf->SetXY($x + 180, $y);
                                          $data = $row['short_pp_percent'];
                                          strlen($data)<20?$b=8:$b=4;
                                          $pdf->MultiCell(18,$b,$data,'1','C'); 
                                          $pdf->SetXY($x + 198, $y); 
                                          $data = $row['short_gre_rcv_qty'];
                                          strlen($data)<20?$b=8:$b=4;
                                          $pdf->MultiCell(23,$b,$data,'1','C');
                                          $pdf->SetXY($x + 221, $y);
                                          $data = $row['short_gre_rcv_percent'];
                                          strlen($data)<20?$b=8:$b=4;
                                          $pdf->MultiCell(18,$b,$data,'1','C');
                                          $pdf->SetXY($x + 239, $y); 
                                          $data = $row['short_pre_proc_qty'];
                                          strlen($data)<20?$b=8:$b=4;
                                          $pdf->MultiCell(23,$b,$data,'1','C');
                                          $pdf->SetXY($x + 262, $y);
                                          $data = $row['short_pre_proc_percent'];
                                          strlen($data)<20?$b=8:$b=4;
                                          $pdf->MultiCell(18,$b,$data,'1','C');  
    
                                          if($row['short_gre_rcv_qty']!= '') $process_loss_gain +=
                                          $row['short_gre_rcv_qty'];
                        
                                      $process_loss_gain_with_greige=
                                          $row['short_gre_rcv_qty'];
                        
                                          $process_loss_gain_with_pp=
                                          $row['short_pp_qty'];
                                         
                                          $final_process_qty = $row['process_qty'];
                                  
                                        
                                        }
                                          $process_loss_gain_with_pp = $Total_pp_quantity - $final_process_qty;
                                          $process_loss_gain_with_greige = $Total_greige_quantity - $final_process_qty;

                                          
    
                  }
              }

               /*************************************************  Dyeing-Finish (Process No- 23) ***************************************************/

             $greige_period = "select ptftri.pp_number, ptftri.process_id, date_format(min(ptftri.partial_test_for_test_result_creation_date), '%d-%b-%Y') start_date,
             date_format(max(ptftri.partial_test_for_test_result_creation_date), '%d-%b-%Y') end_date
             from partial_test_for_test_result_info  ptftri where  ptftri.process_id = 'proc_23' and ptftri.pp_number = '$pp_number'";
      
              $result_for_greige= mysqli_query($con,$greige_period) or die(mysqli_error($con));
              while($row = mysqli_fetch_array($result_for_greige))  
              {  
                  if($row['end_date']!= '') 
                  {
                      $process_completion_date = $row['end_date'];
                  }
      
                  if($row_for_select_process["process_id"] == "proc_23")
                  {
                      $Serial+=1;
    
                      $sql_for_finishing = "select pp.pp_number, pp.version_name as version_number, pp.color, pp.style_name, pp.gw, pp.fw, pp.pp_quantity, result.after_trolley_or_batcher_qty, result.date, 
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
                      ptftri.pp_number = aptv.pp_number and ptftri.version_id = aptv.version_id and ptftri.style=aptv.style_name  and ptftri.process_name=aptv.process_name and ptftri.process_id = 'proc_23'
                       and ptftri.pp_number = '$pp_number')result 
                      
                      on pp.pp_number = result.pp_number and pp.version_id = result.version_id  order by result.date, pp.pp_number, pp.version_id, pp.color, pp.style_name, pp.gw, pp.fw";
                       
                      $result_for_finishing = mysqli_query($con,$sql_for_finishing) or die(mysqli_error($con));
    
                      $row_number_for_finishing = mysqli_num_rows($result_for_finishing);
    
                      $counter = $counter + ($row_number_for_finishing * 8) + 10 + 10; 
      
                      if($counter>200)
                          {
                              $pdf->AddPage();
                              $pdf->SetLeftMargin(8);
                              $counter =30;
                              $counter = $counter + ($row_number_for_finishing * 8) + 10 + 10; 
    
                          } 
    
                      $pdf->SetFont('Arial','B',14);
                      $pdf->Ln(3);
                      $pdf->Cell(280,7,$Serial.'.'.'  '.'Dyeing-Finish'.'   ('.$row["start_date"].' To '.$row["end_date"].')'.$pdf->SetFillColor(255,255,255),"0","1","L",true);
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
                      $pdf->MultiCell(28,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                      $pdf->SetXY($x + 49, $y);
                      $data = "Color";
                      strlen($data)<15?$b=10:$b=5;
                      $pdf->MultiCell(24,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                      $pdf->SetXY($x + 73, $y);
                      $data = "Style";
                      strlen($data)<15?$b=10:$b=5;
                      $pdf->MultiCell(24,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                      $pdf->SetXY($x + 97, $y);
                      $data = "Greige Width (inch)";
                      strlen($data)<10?$b=10:$b=5;
                      $pdf->MultiCell(21,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                      $pdf->SetXY($x + 118, $y);
                      $data = "Finish Width (inch)";
                      strlen($data)<10?$b=10:$b=5;
                      $pdf->MultiCell(21,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                      $pdf->SetXY($x + 139, $y);
                      $data = "Before Trolley No.";
                      strlen($data)<10?$b=10:$b=5;
                      $pdf->MultiCell(20,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                      $pdf->SetXY($x + 159, $y);
                      $data = "B. Process Qty (mtr.)";
                      strlen($data)<15?$b=10:$b=5;
                      $pdf->MultiCell(20,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                      $pdf->SetXY($x + 179, $y);
                      $data = "After Trolley No.";
                      strlen($data)<10?$b=10:$b=5;
                      $pdf->MultiCell(20,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                      $pdf->SetXY($x + 199, $y);
                      $data = "Process Qty (mtr.)";
                      strlen($data)<10?$b=10:$b=5;
                      $pdf->MultiCell(20,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                      $pdf->SetXY($x + 219, $y);
                      $data = "(+/-) From Prev. Process";
                      strlen($data)<10?$b=10:$b=5;
                      $pdf->MultiCell(41,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                      $pdf->SetXY($x + 219, $y+5);
                      $data = "Qty (mtr.)";
                      // strlen($data)<15?$b=10:$b=5;
                      $pdf->MultiCell(23,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                      $pdf->SetXY($x + 242, $y+5);
                      $data = "%";
                      // strlen($data)<15?$b=10:$b=5;
                      $pdf->MultiCell(18,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                      $pdf->SetXY($x + 260, $y);
                      $data = "Process / Reprocess";
                      strlen($data)<10?$b=10:$b=5;
                      $pdf->MultiCell(20,$b,"$data".$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                      // $pdf->SetXY($x + 194, $y);
      
                      $pdf->Cell(200,0,$pdf->SetFillColor(255,255,255),'1','1','c',true);
          
                      $pdf->SetFont('Arial','',9);
      
    
                                                      while($row = mysqli_fetch_array($result_for_finishing))  
                                                      {
                                                          $x = $pdf->GetX();
                                                          $y = $pdf->GetY();
                                                          $data = $row['date'];
                                                          strlen($data)<20?$b=8:$b=4;
                                                          $pdf->MultiCell(21,$b,$data,'1','C');
                                                          $pdf->SetXY($x + 21, $y);
                                                          $data = $row['version_number'];
                                                          strlen($data)<16?$b=8:$b=4;
                                                          $pdf->MultiCell(28,$b,$data,'1','C');
                                                          $pdf->SetXY($x + 49, $y);
                                                          $data = $row['color'];
                                                          strlen($data)<20?$b=8:$b=4;
                                                          $pdf->MultiCell(24,$b,$data,'1','C');
                                                          $pdf->SetXY($x + 73, $y);
                                                          $data = $row['style_name'];
                                                          strlen($data)<10?$b=8:$b=4;
                                                          $pdf->MultiCell(24,$b,$data,'1','C');
                                                          $pdf->SetXY($x + 97, $y);
                                                          $data = $row['gw'];
                                                          strlen($data)<20?$b=8:$b=4;
                                                          $pdf->MultiCell(21,$b,$data,'1','C');
                                                          $pdf->SetXY($x + 118, $y);
                                                          $data = $row['fw'];
                                                          strlen($data)<20?$b=8:$b=4;
                                                          $pdf->MultiCell(21,$b,$data,'1','C');
                                                          $pdf->SetXY($x + 139, $y);
                                                          $data = $row['before_trolley_number_or_batcher_number'];
                                                          strlen($data)<20?$b=8:$b=4;
                                                          $pdf->MultiCell(20,$b,$data,'1','C');
                                                          $pdf->SetXY($x + 159, $y);
                                                          $data = $row['before_trolley_or_batcher_qty'];
                                                          strlen($data)<20?$b=8:$b=4;
                                                          $pdf->MultiCell(20,$b,$data,'1','C');
                                                          $pdf->SetXY($x + 179, $y);
                                                          $data = $row['after_trolley_number_or_batcher_number'];
                                                          strlen($data)<20?$b=8:$b=4;
                                                          $pdf->MultiCell(20,$b,$data,'1','C');
                                                          $pdf->SetXY($x + 199, $y);
                                                          $data = $row['after_trolley_or_batcher_qty'];
                                                          strlen($data)<20?$b=8:$b=4;
                                                          $pdf->MultiCell(20,$b,$data,'1','C');
                                                          $pdf->SetXY($x + 219, $y);
                                                          $data = $row['short_proc'];
                                                          strlen($data)<20?$b=8:$b=4;
                                                          $pdf->MultiCell(23,$b,$data,'1','C');
                                                          $pdf->SetXY($x + 242, $y);
                                                          $data = $row['short_percent'];
                                                          strlen($data)<20?$b=8:$b=4;
                                                          $pdf->MultiCell(18,$b,$data,'1','C');
                                                          $pdf->SetXY($x + 260, $y);
                                                          $data = $row['process_or_reprocess'];
                                                          strlen($data)<20?$b=8:$b=4;
                                                          $pdf->SetFont('Arial','',7);
                                                          $pdf->MultiCell(20,$b,$data,'1','C'); 
                                                          $pdf->SetFont('Arial','',9); 
                                                      }
    
    
    
                                              // Width summary for Dyeing-Finish
    
                                              $sql_for_finishing_width = "select pp.pp_number, pp.gw, pp.fw, pp.pp_quantity, result.process_qty, result.before_process_qty, result.gray_process_qty,
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
                                             where ptv.pp_number = ptftri_1.pp_number and ptv.process_id = 'proc_20' and fw = ptv.finish_width_in_inch) gray_process_qty 
                                             FROM
                                             partial_test_for_test_result_info ptftri_1
                                              inner join (
                                             SELECT ptftri.process_id,ptftri.pp_number, pwvci.finish_width_in_inch fw, pwvci.greige_width_in_inch gw,ptftri.version_id
                                              ,max(ptftri.partial_test_for_test_result_creation_date) max_date
                                             from partial_test_for_test_result_info ptftri, pp_wise_version_creation_info pwvci
                                              where ptftri.pp_number = pwvci.pp_number and ptftri.version_id = pwvci.version_id and ptftri.style=pwvci.style_name
                                              and ptftri.finish_width_in_inch=pwvci.finish_width_in_inch 
                                             and ptftri.process_id = 'proc_23' and ptftri.pp_number = '$pp_number'
                                              group by ptftri.pp_number, pwvci.finish_width_in_inch, pwvci.greige_width_in_inch,ptftri.version_id )P
                                             where  1=1
                                             and ptftri_1.process_id = p.process_id
                                             and ptftri_1.pp_number = p.pp_number
                                             and ptftri_1.version_id = p.version_id
                                             and ptftri_1.partial_test_for_test_result_creation_date = p.max_date
                                             group by process_id,pp_number, fw,  gw)result 
                                             on pp.pp_number = result.pp_number and pp.fw = result.fw and pp.gw = result.gw 
                                             order by pp.pp_number, pp.gw, pp.fw";
                                              
                                              $result_for_finishing_width= mysqli_query($con,$sql_for_finishing_width) or die(mysqli_error($con));
    
                                              $row_number_for_finishing_width = mysqli_num_rows($result_for_finishing_width);
    
                                              $counter = $counter + ($row_number_for_finishing_width*8) + 10 + 10; 
                                
                                                if($counter>200)
                                                    {
                                                        $pdf->AddPage();
                                                        $pdf->SetLeftMargin(8);
                                                        $counter =30;
                                                        $counter = $counter + ($row_number_for_finishing_width*8) + 10 + 10; 
                                                    } 
    
                                              $pdf->SetFont('Arial','B',11);
                                              $pdf->Ln(3);
                                              $pdf->Cell(280,7,"Width Summary".$pdf->SetFillColor(220,220,220),"1","1","C",true);
                                              $pdf->SetFont('Arial','B',9);
    
                                              $x = $pdf->GetX();
                                              $y = $pdf->GetY();
                                              $data = "Greige Width (inch)";
                                              strlen($data)<15?$b=10:$b=5;
                                              $pdf->MultiCell(30,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                              $pdf->SetXY($x + 30, $y);
                                              $data = "Finish Width (inch)";
                                              strlen($data)<15?$b=10:$b=5;
                                              $pdf->MultiCell(30,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                              $pdf->SetXY($x + 60, $y);
                                              $data = "PP Quantity. (mtr.)";
                                              strlen($data)<25?$b=10:$b=5;
                                              $pdf->MultiCell(32,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                              $pdf->SetXY($x + 92, $y);
                                              $data = "Before Process Quantity (mtr.)";
                                              strlen($data)<25?$b=10:$b=5;
                                              $pdf->MultiCell(33,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                              $pdf->SetXY($x + 125, $y);
                                              $data = "Process Quantity. (mtr.)";
                                              strlen($data)<15?$b=10:$b=5;
                                              $pdf->MultiCell(32,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                              $pdf->SetXY($x + 157, $y);
                                              $data = "(+/-) From PP";
                                              // strlen($data)<15?$b=10:$b=5;
                                              $pdf->MultiCell(41,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                              $pdf->SetXY($x + 157, $y+5);
                                              $data = "Qty (mtr.)";
                                              // strlen($data)<15?$b=10:$b=5;
                                              $pdf->MultiCell(23,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                              $pdf->SetXY($x + 180, $y+5);
                                              $data = "%";
                                              // strlen($data)<15?$b=10:$b=5;
                                              $pdf->MultiCell(18,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                              $pdf->SetXY($x + 198, $y);
                                              $data = "(+/-) From Greige";
                                              // strlen($data)<15?$b=10:$b=5;
                                              $pdf->MultiCell(41,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                              $pdf->SetXY($x + 198, $y+5);
                                              $data = "Qty (mtr.)";
                                              // strlen($data)<15?$b=10:$b=5;
                                              $pdf->MultiCell(23,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                              $pdf->SetXY($x + 221, $y+5);
                                              $data = "%";
                                              // strlen($data)<15?$b=10:$b=5;
                                              $pdf->MultiCell(18,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                              $pdf->SetXY($x + 239, $y);
                                              $data = "(+/-) From Prev. Process";
                                              // strlen($data)<15?$b=10:$b=5;
                                              $pdf->MultiCell(41,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                              $pdf->SetXY($x + 239, $y+5);
                                              $data = "Qty (mtr.)";
                                              // strlen($data)<15?$b=10:$b=5;
                                              $pdf->MultiCell(23,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                              $pdf->SetXY($x + 262, $y+5);
                                              $data = "%";
                                              // strlen($data)<15?$b=10:$b=5;
                                              $pdf->MultiCell(18,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                              $pdf->SetXY($x + 280, $y);
                                              
                                              // $pdf->Cell(0,0,$pdf->SetFillColor(255,255,255),'1','1','C',true);
                                              $pdf->SetFont('Arial','',9);       
                                               $pdf->Ln(10);
                                             
                                              
                                          while($row = mysqli_fetch_array($result_for_finishing_width))  
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
                                              $pdf->MultiCell(32,$b,$data,'1','C');
                                              $pdf->SetXY($x + 92, $y);
                                              $data = $row['before_process_qty'];
                                              strlen($data)<20?$b=8:$b=4;
                                              $pdf->MultiCell(33,$b,$data,'1','C');
                                              $pdf->SetXY($x + 125, $y);
                                              $data = $row['process_qty'];
                                              strlen($data)<20?$b=8:$b=4;
                                              $pdf->MultiCell(32,$b,$data,'1','C');
                                              $pdf->SetXY($x + 157, $y);
                                              $data = $row['short_pp_qty'];
                                              strlen($data)<15?$b=8:$b=4;
                                              $pdf->MultiCell(23,$b,$data,'1','C');
                                              $pdf->SetXY($x + 180, $y);
                                              $data = $row['short_pp_percent'];
                                              strlen($data)<15?$b=8:$b=4;
                                              $pdf->MultiCell(18,$b,$data,'1','C');
                                              $pdf->SetXY($x + 198, $y);
                                              $data = $row['short_gre_rcv_qty'];
                                              strlen($data)<15?$b=8:$b=4;
                                              $pdf->MultiCell(23,$b,$data,'1','C');
                                              $pdf->SetXY($x + 221, $y);
                                              $data = $row['short_gre_rcv_percent'];
                                              strlen($data)<15?$b=8:$b=4;
                                              $pdf->MultiCell(18,$b,$data,'1','C');
                                              $pdf->SetXY($x + 239, $y);
                                              $data = $row['short_pre_proc_qty'];
                                              strlen($data)<15?$b=8:$b=4;
                                              $pdf->MultiCell(23,$b,$data,'1','C');
                                              $pdf->SetXY($x + 262, $y);
                                              $data = $row['short_pre_proc_percent'];
                                              strlen($data)<15?$b=8:$b=4;
                                              $pdf->MultiCell(18,$b,$data,'1','C');
                                              // $pdf->SetXY($x + 200, $y);
    
                                          }
                                              // Version summary for Dyeing-Finish
    
                                               $sql_for_finishing_version = "select pp.pp_number, pp.version_name version_number, pp.style_name, pp.color, pp.gw, pp.fw, pp.pp_quantity, result.process_qty, result.before_process_qty, result.gray_process_qty, 
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
                                               and ptftri.process_id = 'proc_23' and ptftri.pp_number = '$pp_number'
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
    
                                                $result_for_finishing_version= mysqli_query($con,$sql_for_finishing_version) or die(mysqli_error($con));
    
                                                $row_number_for_finishing_version = mysqli_num_rows($result_for_finishing_version);
    
                                                $counter = $counter + ($row_number_for_finishing_version*8) + 10 + 10 + 8; 
                                
                                                if($counter>200)
                                                    {
                                                        $pdf->AddPage();
                                                        $pdf->SetLeftMargin(8);
                                                        $counter =30;
                                                        $counter = $counter + ($row_number_for_finishing_version*8) + 10 + 10 + 8; 
                                                    } 
    
                                                $pdf->SetFont('Arial','B',11);
                                                $pdf->Ln(3);
                                                $pdf->Cell(280,7,"Version Summary".$pdf->SetFillColor(220,220,220),"1","1","C",true);
                                                $pdf->SetFont('Arial','B',9);
    
                                              $x = $pdf->GetX();
                                              $y = $pdf->GetY();
                                              $data = "Version";
                                              strlen($data)<15?$b=10:$b=5;
                                              $pdf->MultiCell(28,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                              $pdf->SetXY($x + 28, $y);
                                              $data = "Color";
                                              strlen($data)<15?$b=10:$b=5;
                                              $pdf->MultiCell(24,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                              $pdf->SetXY($x + 52, $y);
                                              $data = "Style";
                                              strlen($data)<15?$b=10:$b=5;
                                              $pdf->MultiCell(24,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                              $pdf->SetXY($x + 76, $y);
                                              $data = "PP Quantity (mtr.)";
                                              strlen($data)<15?$b=10:$b=5;
                                              $pdf->MultiCell(27,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                              $pdf->SetXY($x + 103, $y);
                                              $data = "Before process Qty (mtr.)";
                                              strlen($data)<20?$b=10:$b=5;
                                              $pdf->MultiCell(27,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                              $pdf->SetXY($x + 130, $y);
                                              $data = "Process Quantity (mtr.)";
                                              strlen($data)<20?$b=10:$b=5;
                                              $pdf->MultiCell(27,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                              $pdf->SetXY($x + 157, $y);
                                              $data = "(+/-) From PP";
                                              // strlen($data)<15?$b=10:$b=5;
                                              $pdf->MultiCell(41,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                              $pdf->SetXY($x + 157, $y+5);
                                              $data = "Qty (mtr.)";
                                              // strlen($data)<15?$b=10:$b=5;
                                              $pdf->MultiCell(23,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                              $pdf->SetXY($x + 180, $y+5);
                                              $data = "%";
                                              // strlen($data)<15?$b=10:$b=5;
                                              $pdf->MultiCell(18,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                              $pdf->SetXY($x + 198, $y);
                                              $data = "(+/-) From Greige";
                                              // strlen($data)<15?$b=10:$b=5;
                                              $pdf->MultiCell(41,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                              $pdf->SetXY($x + 198, $y+5);
                                              $data = "Qty (mtr.)";
                                              // strlen($data)<15?$b=10:$b=5;
                                              $pdf->MultiCell(23,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                              $pdf->SetXY($x + 221, $y+5);
                                              $data = "%";
                                              // strlen($data)<15?$b=10:$b=5;
                                              $pdf->MultiCell(18,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                              $pdf->SetXY($x + 239, $y);
                                              $data = "(+/-) From Prev. Process";
                                              // strlen($data)<15?$b=10:$b=5;
                                              $pdf->MultiCell(41,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                              $pdf->SetXY($x + 239, $y+5);
                                              $data = "Qty (mtr.)";
                                              // strlen($data)<15?$b=10:$b=5;
                                              $pdf->MultiCell(23,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                              $pdf->SetXY($x + 262, $y+5);
                                              $data = "%";
                                              // strlen($data)<15?$b=10:$b=5;
                                              $pdf->MultiCell(18,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                              $pdf->SetXY($x + 280, $y);
                                              
                                              // $pdf->Cell(0,0,$pdf->SetFillColor(255,255,255),'1','1','C',true);
                                              $pdf->SetFont('Arial','',9);       
                                               $pdf->Ln(10);
                  
                                        while($row = mysqli_fetch_array($result_for_finishing_version))  
                                        {  
                                            $x = $pdf->GetX();
                                            $y = $pdf->GetY();
                                            $data = $row['version_number'];
                                            strlen($data)<16?$b=8:$b=4;
                                            $pdf->MultiCell(28,$b,$data,'1','C');
                                            $pdf->SetXY($x + 28, $y);
                                            $data = $row['color'];
                                            strlen($data)<20?$b=8:$b=4;
                                            $pdf->MultiCell(24,$b,$data,'1','C');
                                            $pdf->SetXY($x + 52, $y);
                                            $data = $row['style_name'];
                                            strlen($data)<10?$b=8:$b=4;
                                            $pdf->MultiCell(24,$b,$data,'1','C');
                                            $pdf->SetXY($x + 76, $y);
                                            $data = $row['pp_quantity'];
                                            strlen($data)<20?$b=8:$b=4;
                                            $pdf->MultiCell(27,$b,$data,'1','C');
                                            $pdf->SetXY($x + 103, $y);
                                            $data = $row['before_process_qty'];
                                            strlen($data)<20?$b=8:$b=4;
                                            $pdf->MultiCell(27,$b,$data,'1','C');
                                            $pdf->SetXY($x + 130, $y);
                                            $data = $row['process_qty'];
                                            strlen($data)<20?$b=8:$b=4;
                                            $pdf->MultiCell(27,$b,$data,'1','C');
                                            $pdf->SetXY($x + 157, $y);
                                            $data = $row['short_pp'];
                                            strlen($data)<15?$b=8:$b=4;
                                            $pdf->MultiCell(23,$b,$data,'1','C');
                                            $pdf->SetXY($x + 180, $y);
                                            $data = $row['short_pp_percent'];
                                            strlen($data)<15?$b=8:$b=4;
                                            $pdf->MultiCell(18,$b,$data,'1','C');
                                            $pdf->SetXY($x + 198, $y);
                                            $data = $row['short_gre_rcv_qty'];
                                            strlen($data)<15?$b=8:$b=4;
                                            $pdf->MultiCell(23,$b,$data,'1','C');
                                            $pdf->SetXY($x + 221, $y);
                                            $data = $row['short_gre_rcv_percent'];
                                            strlen($data)<15?$b=8:$b=4;
                                            $pdf->MultiCell(18,$b,$data,'1','C');
                                            $pdf->SetXY($x + 239, $y);
                                            $data = $row['short_pre_proc_qty'];
                                            strlen($data)<15?$b=8:$b=4;
                                            $pdf->MultiCell(23,$b,$data,'1','C');
                                            $pdf->SetXY($x + 262, $y);
                                            $data = $row['short_pre_proc_percent'];
                                            strlen($data)<15?$b=8:$b=4;
                                            $pdf->MultiCell(18,$b,$data,'1','C');
                                            // $pdf->SetXY($x + 280, $y);
    
                                        }
    
                                        $sql_for_finishing_total = "select total.pp_number, sum(total.pp_quantity) pp_quantity, sum(total.process_qty) process_qty, 
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
                                        and ptftri.process_id = 'proc_23' and ptftri.pp_number = '$pp_number'
                                        group by ptftri.pp_number, ptftri.version_number, ptftri.finish_width_in_inch )P
                                        where  1=1
                                        and ptftri_1.process_id = p.process_id
                                        and ptftri_1.pp_number = p.pp_number
                                        and ptftri_1.version_number = p.version_name
                                        and ptftri_1.partial_test_for_test_result_creation_date = p.max_date
                                        and ptftri_1.finish_width_in_inch = p.finish_width_in_inch
                                        group by process_id,pp_number, version_name)result where pp.pp_number = result.pp_number and pp.version_name = result.version_name ) total
                                        ";

                                      $result_for_finishing_total= mysqli_query($con,$sql_for_finishing_total) or die(mysqli_error($con));
                                      while($row = mysqli_fetch_array($result_for_finishing_total))  
                                      {
                                          $pdf->SetFont('Arial','B',9); 
                                          $x = $pdf->GetX();
                                          $y = $pdf->GetY();
                                          $data = "Dyeing-Finish Total Qty. (mtr.)";
                                          strlen($data)<70?$b=8:$b=4;
                                          $pdf->MultiCell(76,$b,$data,'1','C');
                                          $pdf->SetXY($x + 76, $y);
                                          $data = $row['pp_quantity'];
                                          strlen($data)<20?$b=8:$b=4;
                                          $pdf->MultiCell(27,$b,$data,'1','C');
                                          $pdf->SetXY($x + 103, $y);
                                          $data = $row['before_process_qty'];
                                          strlen($data)<20?$b=8:$b=4;
                                          $pdf->MultiCell(27,$b,$data,'1','C');
                                          $pdf->SetXY($x + 130, $y);
                                          $data = $row['process_qty'];
                                          strlen($data)<20?$b=8:$b=4;
                                          $pdf->MultiCell(27,$b,$data,'1','C');
                                          $pdf->SetXY($x + 157, $y);
                                          $data = $row['short_pp_qty'];
                                          strlen($data)<20?$b=8:$b=4;
                                          $pdf->MultiCell(23,$b,$data,'1','C');
                                          $pdf->SetXY($x + 180, $y);
                                          $data = $row['short_pp_percent'];
                                          strlen($data)<20?$b=8:$b=4;
                                          $pdf->MultiCell(18,$b,$data,'1','C'); 
                                          $pdf->SetXY($x + 198, $y); 
                                          $data = $row['short_gre_rcv_qty'];
                                          strlen($data)<20?$b=8:$b=4;
                                          $pdf->MultiCell(23,$b,$data,'1','C');
                                          $pdf->SetXY($x + 221, $y);
                                          $data = $row['short_gre_rcv_percent'];
                                          strlen($data)<20?$b=8:$b=4;
                                          $pdf->MultiCell(18,$b,$data,'1','C');
                                          $pdf->SetXY($x + 239, $y); 
                                          $data = $row['short_pre_proc_qty'];
                                          strlen($data)<20?$b=8:$b=4;
                                          $pdf->MultiCell(23,$b,$data,'1','C');
                                          $pdf->SetXY($x + 262, $y);
                                          $data = $row['short_pre_proc_percent'];
                                          strlen($data)<20?$b=8:$b=4;
                                          $pdf->MultiCell(18,$b,$data,'1','C');  
    
                                          if($row['short_gre_rcv_qty']!= '') $process_loss_gain +=
                                          $row['short_gre_rcv_qty'];
                        
                                      $process_loss_gain_with_greige=
                                          $row['short_gre_rcv_qty'];
                        
                                          $process_loss_gain_with_pp=
                                          $row['short_pp_qty'];
                                         
                                          $final_process_qty = $row['process_qty'];
                                  
                                        
                                        }
                                          $process_loss_gain_with_pp = $Total_pp_quantity - $final_process_qty;
                                          $process_loss_gain_with_greige = $Total_greige_quantity - $final_process_qty;

                                          
    
                  }
              }

              
              /*********************************Create  Calender (Process No- 17) Table**********************************/

              $greige_period = "select ptftri.pp_number, ptftri.process_id, date_format(min(ptftri.partial_test_for_test_result_creation_date), '%d-%b-%Y') start_date,
              date_format(max(ptftri.partial_test_for_test_result_creation_date), '%d-%b-%Y') end_date
              from partial_test_for_test_result_info  ptftri
              where  ptftri.process_id = 'proc_17' and ptftri.pp_number = '$pp_number'  
                ";

$result_for_greige= mysqli_query($con,$greige_period) or die(mysqli_error($con));
while($row = mysqli_fetch_array($result_for_greige))  
{  
    if($row['end_date']!= '') 
    {
        $process_completion_date = $row['end_date'];
    }

    if($row_for_select_process["process_id"] == "proc_17")
    {
        $Serial+=1;

        $sql_for_calender = "select pp.pp_number, pp.version_name as version_number, pp.color, pp.style_name, pp.gw, pp.fw, pp.pp_quantity, result.after_trolley_or_batcher_qty, result.date, 
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
        ptftri.pp_number = aptv.pp_number and ptftri.version_id = aptv.version_id and ptftri.style=aptv.style_name  and ptftri.process_name=aptv.process_name and ptftri.process_id = 'proc_17'
         and ptftri.pp_number = '$pp_number')result 
        
        on pp.pp_number = result.pp_number and pp.version_id = result.version_id  order by result.date, pp.pp_number, pp.version_id, pp.color, pp.style_name, pp.gw, pp.fw";
         
        $result_for_calender= mysqli_query($con,$sql_for_calender) or die(mysqli_error($con));

        $row_number_for_calender = mysqli_num_rows($result_for_calender);

        $counter = $counter + ($row_number_for_calender*8) + 10 + 10; 

        if($counter>200)
            {
                $pdf->AddPage();
                $pdf->SetLeftMargin(8);
                $counter =30;
                $counter = $counter + ($row_number_for_calender*8) + 10 + 10; 

            } 

        $pdf->SetFont('Arial','B',14);
        $pdf->Ln(3);
        $pdf->Cell(280,7,$Serial.'.'.'  '.'Calender'.'   ('.$row["start_date"].' To '.$row["end_date"].')'.$pdf->SetFillColor(255,255,255),"0","1","L",true);
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
        $pdf->MultiCell(28,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
        $pdf->SetXY($x + 49, $y);
        $data = "Color";
        strlen($data)<15?$b=10:$b=5;
        $pdf->MultiCell(24,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
        $pdf->SetXY($x + 73, $y);
        $data = "Style";
        strlen($data)<15?$b=10:$b=5;
        $pdf->MultiCell(24,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
        $pdf->SetXY($x + 97, $y);
        $data = "Greige Width (inch)";
        strlen($data)<10?$b=10:$b=5;
        $pdf->MultiCell(21,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
        $pdf->SetXY($x + 118, $y);
        $data = "Finish Width (inch)";
        strlen($data)<10?$b=10:$b=5;
        $pdf->MultiCell(21,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
        $pdf->SetXY($x + 139, $y);
        $data = "Before Trolley No.";
        strlen($data)<10?$b=10:$b=5;
        $pdf->MultiCell(20,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
        $pdf->SetXY($x + 159, $y);
        $data = "B. Process Qty (mtr.)";
        strlen($data)<15?$b=10:$b=5;
        $pdf->MultiCell(20,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
        $pdf->SetXY($x + 179, $y);
        $data = "After Trolley No.";
        strlen($data)<10?$b=10:$b=5;
        $pdf->MultiCell(20,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
        $pdf->SetXY($x + 199, $y);
        $data = "Process Qty (mtr.)";
        strlen($data)<10?$b=10:$b=5;
        $pdf->MultiCell(20,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
        $pdf->SetXY($x + 219, $y);
        $data = "(+/-) From Prev. Process";
        strlen($data)<10?$b=10:$b=5;
        $pdf->MultiCell(41,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
        $pdf->SetXY($x + 219, $y+5);
        $data = "Qty (mtr.)";
        // strlen($data)<15?$b=10:$b=5;
        $pdf->MultiCell(23,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
        $pdf->SetXY($x + 242, $y+5);
        $data = "%";
        // strlen($data)<15?$b=10:$b=5;
        $pdf->MultiCell(18,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
        $pdf->SetXY($x + 260, $y);
        $data = "Process / Reprocess";
        strlen($data)<10?$b=10:$b=5;
        $pdf->MultiCell(20,$b,"$data".$pdf->SetFillColor(220,220,220),'1','C',TRUE);
        // $pdf->SetXY($x + 194, $y);

        $pdf->Cell(200,0,$pdf->SetFillColor(255,255,255),'1','1','c',true);

        $pdf->SetFont('Arial','',9);


                                        while($row = mysqli_fetch_array($result_for_calender))  
                                        {
                                            $x = $pdf->GetX();
                                            $y = $pdf->GetY();
                                            $data = $row['date'];
                                            strlen($data)<20?$b=8:$b=4;
                                            $pdf->MultiCell(21,$b,$data,'1','C');
                                            $pdf->SetXY($x + 21, $y);
                                            $data = $row['version_number'];
                                            strlen($data)<16?$b=8:$b=4;
                                            $pdf->MultiCell(28,$b,$data,'1','C');
                                            $pdf->SetXY($x + 49, $y);
                                            $data = $row['color'];
                                            strlen($data)<20?$b=8:$b=4;
                                            $pdf->MultiCell(24,$b,$data,'1','C');
                                            $pdf->SetXY($x + 73, $y);
                                            $data = $row['style_name'];
                                            strlen($data)<10?$b=8:$b=4;
                                            $pdf->MultiCell(24,$b,$data,'1','C');
                                            $pdf->SetXY($x + 97, $y);
                                            $data = $row['gw'];
                                            strlen($data)<20?$b=8:$b=4;
                                            $pdf->MultiCell(21,$b,$data,'1','C');
                                            $pdf->SetXY($x + 118, $y);
                                            $data = $row['fw'];
                                            strlen($data)<20?$b=8:$b=4;
                                            $pdf->MultiCell(21,$b,$data,'1','C');
                                            $pdf->SetXY($x + 139, $y);
                                            $data = $row['before_trolley_number_or_batcher_number'];
                                            strlen($data)<20?$b=8:$b=4;
                                            $pdf->MultiCell(20,$b,$data,'1','C');
                                            $pdf->SetXY($x + 159, $y);
                                            $data = $row['before_trolley_or_batcher_qty'];
                                            strlen($data)<20?$b=8:$b=4;
                                            $pdf->MultiCell(20,$b,$data,'1','C');
                                            $pdf->SetXY($x + 179, $y);
                                            $data = $row['after_trolley_number_or_batcher_number'];
                                            strlen($data)<20?$b=8:$b=4;
                                            $pdf->MultiCell(20,$b,$data,'1','C');
                                            $pdf->SetXY($x + 199, $y);
                                            $data = $row['after_trolley_or_batcher_qty'];
                                            strlen($data)<20?$b=8:$b=4;
                                            $pdf->MultiCell(20,$b,$data,'1','C');
                                            $pdf->SetXY($x + 219, $y);
                                            $data = $row['short_proc'];
                                            strlen($data)<20?$b=8:$b=4;
                                            $pdf->MultiCell(23,$b,$data,'1','C');
                                            $pdf->SetXY($x + 242, $y);
                                            $data = $row['short_percent'];
                                            strlen($data)<20?$b=8:$b=4;
                                            $pdf->MultiCell(18,$b,$data,'1','C');
                                            $pdf->SetXY($x + 260, $y);
                                            $data = $row['process_or_reprocess'];
                                            strlen($data)<20?$b=8:$b=4;
                                            $pdf->SetFont('Arial','',7);
                                            $pdf->MultiCell(20,$b,$data,'1','C'); 
                                            $pdf->SetFont('Arial','',9); 
                                        }



                                // Width summary for calender

                                $sql_for_calender_width = "select pp.pp_number, pp.gw, pp.fw, pp.pp_quantity, result.process_qty, result.before_process_qty, result.gray_process_qty,
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
                               where ptv.pp_number = ptftri_1.pp_number and ptv.process_id = 'proc_20' and fw = ptv.finish_width_in_inch) gray_process_qty 
                               FROM
                               partial_test_for_test_result_info ptftri_1
                                inner join (
                               SELECT ptftri.process_id,ptftri.pp_number, pwvci.finish_width_in_inch fw, pwvci.greige_width_in_inch gw,ptftri.version_id
                                ,max(ptftri.partial_test_for_test_result_creation_date) max_date
                               from partial_test_for_test_result_info ptftri, pp_wise_version_creation_info pwvci
                                where ptftri.pp_number = pwvci.pp_number and ptftri.version_id = pwvci.version_id and ptftri.style=pwvci.style_name
                                and ptftri.finish_width_in_inch=pwvci.finish_width_in_inch 
                               and ptftri.process_id = 'proc_17' and ptftri.pp_number = '$pp_number'
                                group by ptftri.pp_number, pwvci.finish_width_in_inch, pwvci.greige_width_in_inch,ptftri.version_id )P
                               where  1=1
                               and ptftri_1.process_id = p.process_id
                               and ptftri_1.pp_number = p.pp_number
                               and ptftri_1.version_id = p.version_id
                               and ptftri_1.partial_test_for_test_result_creation_date = p.max_date
                               group by process_id,pp_number, fw,  gw)result 
                               on pp.pp_number = result.pp_number and pp.fw = result.fw and pp.gw = result.gw 
                               order by pp.pp_number, pp.gw, pp.fw";
                                
                                $result_for_calender_width= mysqli_query($con,$sql_for_calender_width) or die(mysqli_error($con));

                                $row_number_for_calender_width = mysqli_num_rows($result_for_calender_width);

                                $counter = $counter + ($row_number_for_calender_width*8) + 10 + 10; 
                  
                                  if($counter>200)
                                      {
                                          $pdf->AddPage();
                                          $pdf->SetLeftMargin(8);
                                          $counter =30;
                                          $counter = $counter + ($row_number_for_calender_width*8) + 10 + 10; 
                                      } 

                                $pdf->SetFont('Arial','B',11);
                                $pdf->Ln(3);
                                $pdf->Cell(280,7,"Width Summary".$pdf->SetFillColor(220,220,220),"1","1","C",true);
                                $pdf->SetFont('Arial','B',9);

                                $x = $pdf->GetX();
                                $y = $pdf->GetY();
                                $data = "Greige Width (inch)";
                                strlen($data)<15?$b=10:$b=5;
                                $pdf->MultiCell(30,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 30, $y);
                                $data = "Finish Width (inch)";
                                strlen($data)<15?$b=10:$b=5;
                                $pdf->MultiCell(30,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 60, $y);
                                $data = "PP Quantity. (mtr.)";
                                strlen($data)<25?$b=10:$b=5;
                                $pdf->MultiCell(32,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 92, $y);
                                $data = "Before Process Quantity (mtr.)";
                                strlen($data)<25?$b=10:$b=5;
                                $pdf->MultiCell(33,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 125, $y);
                                $data = "Process Quantity. (mtr.)";
                                strlen($data)<15?$b=10:$b=5;
                                $pdf->MultiCell(32,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 157, $y);
                                $data = "(+/-) From PP";
                                // strlen($data)<15?$b=10:$b=5;
                                $pdf->MultiCell(41,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 157, $y+5);
                                $data = "Qty (mtr.)";
                                // strlen($data)<15?$b=10:$b=5;
                                $pdf->MultiCell(23,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 180, $y+5);
                                $data = "%";
                                // strlen($data)<15?$b=10:$b=5;
                                $pdf->MultiCell(18,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 198, $y);
                                $data = "(+/-) From Greige";
                                // strlen($data)<15?$b=10:$b=5;
                                $pdf->MultiCell(41,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 198, $y+5);
                                $data = "Qty (mtr.)";
                                // strlen($data)<15?$b=10:$b=5;
                                $pdf->MultiCell(23,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 221, $y+5);
                                $data = "%";
                                // strlen($data)<15?$b=10:$b=5;
                                $pdf->MultiCell(18,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 239, $y);
                                $data = "(+/-) From Prev. Process";
                                // strlen($data)<15?$b=10:$b=5;
                                $pdf->MultiCell(41,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 239, $y+5);
                                $data = "Qty (mtr.)";
                                // strlen($data)<15?$b=10:$b=5;
                                $pdf->MultiCell(23,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 262, $y+5);
                                $data = "%";
                                // strlen($data)<15?$b=10:$b=5;
                                $pdf->MultiCell(18,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 280, $y);
                                
                                // $pdf->Cell(0,0,$pdf->SetFillColor(255,255,255),'1','1','C',true);
                                $pdf->SetFont('Arial','',9);       
                                 $pdf->Ln(10);
                               
                                
                            while($row = mysqli_fetch_array($result_for_calender_width))  
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
                                $pdf->MultiCell(32,$b,$data,'1','C');
                                $pdf->SetXY($x + 92, $y);
                                $data = $row['before_process_qty'];
                                strlen($data)<20?$b=8:$b=4;
                                $pdf->MultiCell(33,$b,$data,'1','C');
                                $pdf->SetXY($x + 125, $y);
                                $data = $row['process_qty'];
                                strlen($data)<20?$b=8:$b=4;
                                $pdf->MultiCell(32,$b,$data,'1','C');
                                $pdf->SetXY($x + 157, $y);
                                $data = $row['short_pp_qty'];
                                strlen($data)<15?$b=8:$b=4;
                                $pdf->MultiCell(23,$b,$data,'1','C');
                                $pdf->SetXY($x + 180, $y);
                                $data = $row['short_pp_percent'];
                                strlen($data)<15?$b=8:$b=4;
                                $pdf->MultiCell(18,$b,$data,'1','C');
                                $pdf->SetXY($x + 198, $y);
                                $data = $row['short_gre_rcv_qty'];
                                strlen($data)<15?$b=8:$b=4;
                                $pdf->MultiCell(23,$b,$data,'1','C');
                                $pdf->SetXY($x + 221, $y);
                                $data = $row['short_gre_rcv_percent'];
                                strlen($data)<15?$b=8:$b=4;
                                $pdf->MultiCell(18,$b,$data,'1','C');
                                $pdf->SetXY($x + 239, $y);
                                $data = $row['short_pre_proc_qty'];
                                strlen($data)<15?$b=8:$b=4;
                                $pdf->MultiCell(23,$b,$data,'1','C');
                                $pdf->SetXY($x + 262, $y);
                                $data = $row['short_pre_proc_percent'];
                                strlen($data)<15?$b=8:$b=4;
                                $pdf->MultiCell(18,$b,$data,'1','C');
                                // $pdf->SetXY($x + 200, $y);

                            }
                                // Version summary for Calender

                                 $sql_for_calender_version = "select pp.pp_number, pp.version_name version_number, pp.style_name, pp.color, pp.gw, pp.fw, pp.pp_quantity, result.process_qty, result.before_process_qty, result.gray_process_qty, 
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
                                 and ptftri.process_id = 'proc_17' and ptftri.pp_number = '$pp_number'
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

                                  $result_for_calender_version= mysqli_query($con,$sql_for_calender_version) or die(mysqli_error($con));

                                  $row_number_for_calender_version = mysqli_num_rows($result_for_calender_version);

                                  $counter = $counter + ($row_number_for_calender_version*8) + 10 + 10 + 8; 
                  
                                  if($counter>200)
                                      {
                                          $pdf->AddPage();
                                          $pdf->SetLeftMargin(8);
                                          $counter =30;
                                          $counter = $counter + ($row_number_for_calender_version*8) + 10 + 10 + 8; 

                                      } 

                                  $pdf->SetFont('Arial','B',11);
                                  $pdf->Ln(3);
                                  $pdf->Cell(280,7,"Version Summary".$pdf->SetFillColor(220,220,220),"1","1","C",true);
                                  $pdf->SetFont('Arial','B',9);

                                $x = $pdf->GetX();
                                $y = $pdf->GetY();
                                $data = "Version";
                                strlen($data)<15?$b=10:$b=5;
                                $pdf->MultiCell(28,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 28, $y);
                                $data = "Color";
                                strlen($data)<15?$b=10:$b=5;
                                $pdf->MultiCell(24,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 52, $y);
                                $data = "Style";
                                strlen($data)<15?$b=10:$b=5;
                                $pdf->MultiCell(24,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 76, $y);
                                $data = "PP Quantity (mtr.)";
                                strlen($data)<15?$b=10:$b=5;
                                $pdf->MultiCell(27,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 103, $y);
                                $data = "Before process Qty (mtr.)";
                                strlen($data)<20?$b=10:$b=5;
                                $pdf->MultiCell(27,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 130, $y);
                                $data = "Process Quantity (mtr.)";
                                strlen($data)<20?$b=10:$b=5;
                                $pdf->MultiCell(27,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 157, $y);
                                $data = "(+/-) From PP";
                                // strlen($data)<15?$b=10:$b=5;
                                $pdf->MultiCell(41,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 157, $y+5);
                                $data = "Qty (mtr.)";
                                // strlen($data)<15?$b=10:$b=5;
                                $pdf->MultiCell(23,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 180, $y+5);
                                $data = "%";
                                // strlen($data)<15?$b=10:$b=5;
                                $pdf->MultiCell(18,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 198, $y);
                                $data = "(+/-) From Greige";
                                // strlen($data)<15?$b=10:$b=5;
                                $pdf->MultiCell(41,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 198, $y+5);
                                $data = "Qty (mtr.)";
                                // strlen($data)<15?$b=10:$b=5;
                                $pdf->MultiCell(23,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 221, $y+5);
                                $data = "%";
                                // strlen($data)<15?$b=10:$b=5;
                                $pdf->MultiCell(18,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 239, $y);
                                $data = "(+/-) From Prev. Process";
                                // strlen($data)<15?$b=10:$b=5;
                                $pdf->MultiCell(41,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 239, $y+5);
                                $data = "Qty (mtr.)";
                                // strlen($data)<15?$b=10:$b=5;
                                $pdf->MultiCell(23,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 262, $y+5);
                                $data = "%";
                                // strlen($data)<15?$b=10:$b=5;
                                $pdf->MultiCell(18,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                $pdf->SetXY($x + 280, $y);
                                
                                // $pdf->Cell(0,0,$pdf->SetFillColor(255,255,255),'1','1','C',true);
                                $pdf->SetFont('Arial','',9);       
                                 $pdf->Ln(10);
    
                          while($row = mysqli_fetch_array($result_for_calender_version))  
                          {  
                              $x = $pdf->GetX();
                              $y = $pdf->GetY();
                              $data = $row['version_number'];
                              strlen($data)<16?$b=8:$b=4;
                              $pdf->MultiCell(28,$b,$data,'1','C');
                              $pdf->SetXY($x + 28, $y);
                              $data = $row['color'];
                              strlen($data)<20?$b=8:$b=4;
                              $pdf->MultiCell(24,$b,$data,'1','C');
                              $pdf->SetXY($x + 52, $y);
                              $data = $row['style_name'];
                              strlen($data)<10?$b=8:$b=4;
                              $pdf->MultiCell(24,$b,$data,'1','C');
                              $pdf->SetXY($x + 76, $y);
                              $data = $row['pp_quantity'];
                              strlen($data)<20?$b=8:$b=4;
                              $pdf->MultiCell(27,$b,$data,'1','C');
                              $pdf->SetXY($x + 103, $y);
                              $data = $row['before_process_qty'];
                              strlen($data)<20?$b=8:$b=4;
                              $pdf->MultiCell(27,$b,$data,'1','C');
                              $pdf->SetXY($x + 130, $y);
                              $data = $row['process_qty'];
                              strlen($data)<20?$b=8:$b=4;
                              $pdf->MultiCell(27,$b,$data,'1','C');
                              $pdf->SetXY($x + 157, $y);
                              $data = $row['short_pp'];
                              strlen($data)<15?$b=8:$b=4;
                              $pdf->MultiCell(23,$b,$data,'1','C');
                              $pdf->SetXY($x + 180, $y);
                              $data = $row['short_pp_percent'];
                              strlen($data)<15?$b=8:$b=4;
                              $pdf->MultiCell(18,$b,$data,'1','C');
                              $pdf->SetXY($x + 198, $y);
                              $data = $row['short_gre_rcv_qty'];
                              strlen($data)<15?$b=8:$b=4;
                              $pdf->MultiCell(23,$b,$data,'1','C');
                              $pdf->SetXY($x + 221, $y);
                              $data = $row['short_gre_rcv_percent'];
                              strlen($data)<15?$b=8:$b=4;
                              $pdf->MultiCell(18,$b,$data,'1','C');
                              $pdf->SetXY($x + 239, $y);
                              $data = $row['short_pre_proc_qty'];
                              strlen($data)<15?$b=8:$b=4;
                              $pdf->MultiCell(23,$b,$data,'1','C');
                              $pdf->SetXY($x + 262, $y);
                              $data = $row['short_pre_proc_percent'];
                              strlen($data)<15?$b=8:$b=4;
                              $pdf->MultiCell(18,$b,$data,'1','C');
                              // $pdf->SetXY($x + 280, $y);

                          }

                          $sql_for_calender_total = "select total.pp_number, sum(total.pp_quantity) pp_quantity, sum(total.process_qty) process_qty, 
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
                        and ptftri.process_id = 'proc_17' and ptftri.pp_number = '$pp_number'
                        group by ptftri.pp_number, ptftri.version_number, ptftri.finish_width_in_inch )P
                        where  1=1
                        and ptftri_1.process_id = p.process_id
                        and ptftri_1.pp_number = p.pp_number
                        and ptftri_1.version_number = p.version_name
                        and ptftri_1.partial_test_for_test_result_creation_date = p.max_date
                        and ptftri_1.finish_width_in_inch = p.finish_width_in_inch
                        group by process_id,pp_number, version_name)result where pp.pp_number = result.pp_number and pp.version_name = result.version_name ) total
                        ";

                        $result_for_calender_total= mysqli_query($con,$sql_for_calender_total) or die(mysqli_error($con));
                        while($row = mysqli_fetch_array($result_for_calender_total))  
                        {
                            $pdf->SetFont('Arial','B',9); 
                            $x = $pdf->GetX();
                            $y = $pdf->GetY();
                            $data = "Calender Total Qty. (mtr.)";
                            strlen($data)<70?$b=8:$b=4;
                            $pdf->MultiCell(76,$b,$data,'1','C');
                            $pdf->SetXY($x + 76, $y);
                            $data = $row['pp_quantity'];
                            strlen($data)<20?$b=8:$b=4;
                            $pdf->MultiCell(27,$b,$data,'1','C');
                            $pdf->SetXY($x + 103, $y);
                            $data = $row['before_process_qty'];
                            strlen($data)<20?$b=8:$b=4;
                            $pdf->MultiCell(27,$b,$data,'1','C');
                            $pdf->SetXY($x + 130, $y);
                            $data = $row['process_qty'];
                            strlen($data)<20?$b=8:$b=4;
                            $pdf->MultiCell(27,$b,$data,'1','C');
                            $pdf->SetXY($x + 157, $y);
                            $data = $row['short_pp_qty'];
                            strlen($data)<20?$b=8:$b=4;
                            $pdf->MultiCell(23,$b,$data,'1','C');
                            $pdf->SetXY($x + 180, $y);
                            $data = $row['short_pp_percent'];
                            strlen($data)<20?$b=8:$b=4;
                            $pdf->MultiCell(18,$b,$data,'1','C'); 
                            $pdf->SetXY($x + 198, $y); 
                            $data = $row['short_gre_rcv_qty'];
                            strlen($data)<20?$b=8:$b=4;
                            $pdf->MultiCell(23,$b,$data,'1','C');
                            $pdf->SetXY($x + 221, $y);
                            $data = $row['short_gre_rcv_percent'];
                            strlen($data)<20?$b=8:$b=4;
                            $pdf->MultiCell(18,$b,$data,'1','C');
                            $pdf->SetXY($x + 239, $y); 
                            $data = $row['short_pre_proc_qty'];
                            strlen($data)<20?$b=8:$b=4;
                            $pdf->MultiCell(23,$b,$data,'1','C');
                            $pdf->SetXY($x + 262, $y);
                            $data = $row['short_pre_proc_percent'];
                            strlen($data)<20?$b=8:$b=4;
                            $pdf->MultiCell(18,$b,$data,'1','C');  

                            if($row['short_excess_qty']!= '') 
                                {
                                    $process_loss_gain+=$row['short_excess_qty'];
                                }
                    
                                $Total_pp_quantity = $row['pp_quantity'];
                                $Total_greige_quantity = $row['process_qty'];
                         
                        }

    }
  }


               /*************************************************  Sanforizing (Process No- 18) ***************************************************/

               $greige_period = "select ptftri.pp_number, ptftri.process_id, date_format(min(ptftri.partial_test_for_test_result_creation_date), '%d-%b-%Y') start_date,
               date_format(max(ptftri.partial_test_for_test_result_creation_date), '%d-%b-%Y') end_date
               from partial_test_for_test_result_info  ptftri
               where  ptftri.process_id = 'proc_18' and ptftri.pp_number = '$pp_number'";
      
              $result_for_greige= mysqli_query($con,$greige_period) or die(mysqli_error($con));
              while($row = mysqli_fetch_array($result_for_greige))  
              {  
                  if($row['end_date']!= '') 
                  {
                      $process_completion_date = $row['end_date'];
                  }
      
                  if($row_for_select_process["process_id"] == "proc_18")
                  {
                      $Serial+=1;
    
                      $sql_for_sanforizing = "select pp.pp_number, pp.version_name as version_number, pp.color, pp.style_name, pp.gw, pp.fw, pp.pp_quantity, result.after_trolley_or_batcher_qty, result.date, 
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
                      ptftri.pp_number = aptv.pp_number and ptftri.version_id = aptv.version_id and ptftri.style=aptv.style_name  and ptftri.process_name=aptv.process_name and ptftri.process_id = 'proc_18'
                       and ptftri.pp_number = '$pp_number')result 
                      
                      on pp.pp_number = result.pp_number and pp.version_id = result.version_id  order by result.date, pp.pp_number, pp.version_id, pp.color, pp.style_name, pp.gw, pp.fw";
                       
                      $result_for_sanforizing = mysqli_query($con,$sql_for_sanforizing) or die(mysqli_error($con));
    
                      $row_number_for_sanforizing = mysqli_num_rows($result_for_sanforizing);
    
                      $counter = $counter + ($row_number_for_sanforizing * 8) + 10 + 10; 
      
                      if($counter>200)
                          {
                              $pdf->AddPage();
                              $pdf->SetLeftMargin(8);
                              $counter =30;
                              $counter = $counter + ($row_number_for_sanforizing * 8) + 10 + 10; 
    
                          } 
    
                      $pdf->SetFont('Arial','B',14);
                      $pdf->Ln(3);
                      $pdf->Cell(280,7,$Serial.'.'.'  '.'Sanforizing'.'   ('.$row["start_date"].' To '.$row["end_date"].')'.$pdf->SetFillColor(255,255,255),"0","1","L",true);
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
                      $pdf->MultiCell(28,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                      $pdf->SetXY($x + 49, $y);
                      $data = "Color";
                      strlen($data)<15?$b=10:$b=5;
                      $pdf->MultiCell(24,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                      $pdf->SetXY($x + 73, $y);
                      $data = "Style";
                      strlen($data)<15?$b=10:$b=5;
                      $pdf->MultiCell(24,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                      $pdf->SetXY($x + 97, $y);
                      $data = "Greige Width (inch)";
                      strlen($data)<10?$b=10:$b=5;
                      $pdf->MultiCell(21,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                      $pdf->SetXY($x + 118, $y);
                      $data = "Finish Width (inch)";
                      strlen($data)<10?$b=10:$b=5;
                      $pdf->MultiCell(21,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                      $pdf->SetXY($x + 139, $y);
                      $data = "Before Trolley No.";
                      strlen($data)<10?$b=10:$b=5;
                      $pdf->MultiCell(20,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                      $pdf->SetXY($x + 159, $y);
                      $data = "B. Process Qty (mtr.)";
                      strlen($data)<15?$b=10:$b=5;
                      $pdf->MultiCell(20,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                      $pdf->SetXY($x + 179, $y);
                      $data = "After Trolley No.";
                      strlen($data)<10?$b=10:$b=5;
                      $pdf->MultiCell(20,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                      $pdf->SetXY($x + 199, $y);
                      $data = "Process Qty (mtr.)";
                      strlen($data)<10?$b=10:$b=5;
                      $pdf->MultiCell(20,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                      $pdf->SetXY($x + 219, $y);
                      $data = "(+/-) From Prev. Process";
                      strlen($data)<10?$b=10:$b=5;
                      $pdf->MultiCell(41,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                      $pdf->SetXY($x + 219, $y+5);
                      $data = "Qty (mtr.)";
                      // strlen($data)<15?$b=10:$b=5;
                      $pdf->MultiCell(23,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                      $pdf->SetXY($x + 242, $y+5);
                      $data = "%";
                      // strlen($data)<15?$b=10:$b=5;
                      $pdf->MultiCell(18,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                      $pdf->SetXY($x + 260, $y);
                      $data = "Process / Reprocess";
                      strlen($data)<10?$b=10:$b=5;
                      $pdf->MultiCell(20,$b,"$data".$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                      // $pdf->SetXY($x + 194, $y);
      
                      $pdf->Cell(200,0,$pdf->SetFillColor(255,255,255),'1','1','c',true);
          
                      $pdf->SetFont('Arial','',9);
      
    
                                                      while($row = mysqli_fetch_array($result_for_sanforizing))  
                                                      {
                                                          $x = $pdf->GetX();
                                                          $y = $pdf->GetY();
                                                          $data = $row['date'];
                                                          strlen($data)<20?$b=8:$b=4;
                                                          $pdf->MultiCell(21,$b,$data,'1','C');
                                                          $pdf->SetXY($x + 21, $y);
                                                          $data = $row['version_number'];
                                                          strlen($data)<16?$b=8:$b=4;
                                                          $pdf->MultiCell(28,$b,$data,'1','C');
                                                          $pdf->SetXY($x + 49, $y);
                                                          $data = $row['color'];
                                                          strlen($data)<20?$b=8:$b=4;
                                                          $pdf->MultiCell(24,$b,$data,'1','C');
                                                          $pdf->SetXY($x + 73, $y);
                                                          $data = $row['style_name'];
                                                          strlen($data)<10?$b=8:$b=4;
                                                          $pdf->MultiCell(24,$b,$data,'1','C');
                                                          $pdf->SetXY($x + 97, $y);
                                                          $data = $row['gw'];
                                                          strlen($data)<20?$b=8:$b=4;
                                                          $pdf->MultiCell(21,$b,$data,'1','C');
                                                          $pdf->SetXY($x + 118, $y);
                                                          $data = $row['fw'];
                                                          strlen($data)<20?$b=8:$b=4;
                                                          $pdf->MultiCell(21,$b,$data,'1','C');
                                                          $pdf->SetXY($x + 139, $y);
                                                          $data = $row['before_trolley_number_or_batcher_number'];
                                                          strlen($data)<20?$b=8:$b=4;
                                                          $pdf->MultiCell(20,$b,$data,'1','C');
                                                          $pdf->SetXY($x + 159, $y);
                                                          $data = $row['before_trolley_or_batcher_qty'];
                                                          strlen($data)<20?$b=8:$b=4;
                                                          $pdf->MultiCell(20,$b,$data,'1','C');
                                                          $pdf->SetXY($x + 179, $y);
                                                          $data = $row['after_trolley_number_or_batcher_number'];
                                                          strlen($data)<20?$b=8:$b=4;
                                                          $pdf->MultiCell(20,$b,$data,'1','C');
                                                          $pdf->SetXY($x + 199, $y);
                                                          $data = $row['after_trolley_or_batcher_qty'];
                                                          strlen($data)<20?$b=8:$b=4;
                                                          $pdf->MultiCell(20,$b,$data,'1','C');
                                                          $pdf->SetXY($x + 219, $y);
                                                          $data = $row['short_proc'];
                                                          strlen($data)<20?$b=8:$b=4;
                                                          $pdf->MultiCell(23,$b,$data,'1','C');
                                                          $pdf->SetXY($x + 242, $y);
                                                          $data = $row['short_percent'];
                                                          strlen($data)<20?$b=8:$b=4;
                                                          $pdf->MultiCell(18,$b,$data,'1','C');
                                                          $pdf->SetXY($x + 260, $y);
                                                          $data = $row['process_or_reprocess'];
                                                          strlen($data)<15?$b=8:$b=4;
                                                          $pdf->SetFont('Arial','',7);
                                                          $pdf->MultiCell(20,$b,$data,'1','C'); 
                                                          $pdf->SetFont('Arial','',9);
                                                      }
    
    
    
                                              // Width summary for Sanforizing
    
                                              $sql_for_sanforizing_width = "select pp.pp_number, pp.gw, pp.fw, pp.pp_quantity, result.process_qty, result.before_process_qty, result.gray_process_qty,
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
                                             where  ptv.pp_number = ptftri_1.pp_number and ptv.process_id = 'proc_20' and fw = ptv.finish_width_in_inch) gray_process_qty 
                                             FROM
                                             partial_test_for_test_result_info ptftri_1
                                              inner join (
                                             SELECT ptftri.process_id,ptftri.pp_number, pwvci.finish_width_in_inch fw, pwvci.greige_width_in_inch gw,ptftri.version_id
                                              ,max(ptftri.partial_test_for_test_result_creation_date) max_date
                                             from partial_test_for_test_result_info ptftri, pp_wise_version_creation_info pwvci
                                              where ptftri.pp_number = pwvci.pp_number and ptftri.version_id = pwvci.version_id and ptftri.style=pwvci.style_name
                                              and ptftri.finish_width_in_inch=pwvci.finish_width_in_inch 
                                             and ptftri.process_id = 'proc_18' and ptftri.pp_number = '$pp_number'
                                              group by ptftri.pp_number, pwvci.finish_width_in_inch, pwvci.greige_width_in_inch,ptftri.version_id )P
                                             where  1=1
                                             and ptftri_1.process_id = p.process_id
                                             and ptftri_1.pp_number = p.pp_number
                                             and ptftri_1.version_id = p.version_id
                                             and ptftri_1.partial_test_for_test_result_creation_date = p.max_date
                                             group by process_id,pp_number, fw,  gw)result 
                                             on pp.pp_number = result.pp_number and pp.fw = result.fw and pp.gw = result.gw 
                                             order by pp.pp_number, pp.gw, pp.fw";
                                              
                                              $result_for_sanforizing_width= mysqli_query($con,$sql_for_sanforizing_width) or die(mysqli_error($con));
    
                                              $row_number_for_sanforizing_width = mysqli_num_rows($result_for_sanforizing_width);
    
                                              $counter = $counter + ($row_number_for_sanforizing_width*8) + 10 + 10; 
                                
                                                if($counter>200)
                                                    {
                                                        $pdf->AddPage();
                                                        $pdf->SetLeftMargin(8);
                                                        $counter =30;
                                                        $counter = $counter + ($row_number_for_sanforizing_width*8) + 10 + 10; 
                                                    } 
    
                                              $pdf->SetFont('Arial','B',11);
                                              $pdf->Ln(3);
                                              $pdf->Cell(280,7,"Width Summary".$pdf->SetFillColor(220,220,220),"1","1","C",true);
                                              $pdf->SetFont('Arial','B',9);
    
                                              $x = $pdf->GetX();
                                              $y = $pdf->GetY();
                                              $data = "Greige Width (inch)";
                                              strlen($data)<15?$b=10:$b=5;
                                              $pdf->MultiCell(30,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                              $pdf->SetXY($x + 30, $y);
                                              $data = "Finish Width (inch)";
                                              strlen($data)<15?$b=10:$b=5;
                                              $pdf->MultiCell(30,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                              $pdf->SetXY($x + 60, $y);
                                              $data = "PP Quantity. (mtr.)";
                                              strlen($data)<25?$b=10:$b=5;
                                              $pdf->MultiCell(32,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                              $pdf->SetXY($x + 92, $y);
                                              $data = "Before Process Quantity (mtr.)";
                                              strlen($data)<25?$b=10:$b=5;
                                              $pdf->MultiCell(33,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                              $pdf->SetXY($x + 125, $y);
                                              $data = "Process Quantity. (mtr.)";
                                              strlen($data)<15?$b=10:$b=5;
                                              $pdf->MultiCell(32,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                              $pdf->SetXY($x + 157, $y);
                                              $data = "(+/-) From PP";
                                              // strlen($data)<15?$b=10:$b=5;
                                              $pdf->MultiCell(41,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                              $pdf->SetXY($x + 157, $y+5);
                                              $data = "Qty (mtr.)";
                                              // strlen($data)<15?$b=10:$b=5;
                                              $pdf->MultiCell(23,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                              $pdf->SetXY($x + 180, $y+5);
                                              $data = "%";
                                              // strlen($data)<15?$b=10:$b=5;
                                              $pdf->MultiCell(18,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                              $pdf->SetXY($x + 198, $y);
                                              $data = "(+/-) From Greige";
                                              // strlen($data)<15?$b=10:$b=5;
                                              $pdf->MultiCell(41,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                              $pdf->SetXY($x + 198, $y+5);
                                              $data = "Qty (mtr.)";
                                              // strlen($data)<15?$b=10:$b=5;
                                              $pdf->MultiCell(23,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                              $pdf->SetXY($x + 221, $y+5);
                                              $data = "%";
                                              // strlen($data)<15?$b=10:$b=5;
                                              $pdf->MultiCell(18,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                              $pdf->SetXY($x + 239, $y);
                                              $data = "(+/-) From Prev. Process";
                                              // strlen($data)<15?$b=10:$b=5;
                                              $pdf->MultiCell(41,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                              $pdf->SetXY($x + 239, $y+5);
                                              $data = "Qty (mtr.)";
                                              // strlen($data)<15?$b=10:$b=5;
                                              $pdf->MultiCell(23,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                              $pdf->SetXY($x + 262, $y+5);
                                              $data = "%";
                                              // strlen($data)<15?$b=10:$b=5;
                                              $pdf->MultiCell(18,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                              $pdf->SetXY($x + 280, $y);
                                              
                                              // $pdf->Cell(0,0,$pdf->SetFillColor(255,255,255),'1','1','C',true);
                                              $pdf->SetFont('Arial','',9);       
                                               $pdf->Ln(10);
                                             
                                              
                                          while($row = mysqli_fetch_array($result_for_sanforizing_width))  
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
                                              $pdf->MultiCell(32,$b,$data,'1','C');
                                              $pdf->SetXY($x + 92, $y);
                                              $data = $row['before_process_qty'];
                                              strlen($data)<20?$b=8:$b=4;
                                              $pdf->MultiCell(33,$b,$data,'1','C');
                                              $pdf->SetXY($x + 125, $y);
                                              $data = $row['process_qty'];
                                              strlen($data)<20?$b=8:$b=4;
                                              $pdf->MultiCell(32,$b,$data,'1','C');
                                              $pdf->SetXY($x + 157, $y);
                                              $data = $row['short_pp_qty'];
                                              strlen($data)<15?$b=8:$b=4;
                                              $pdf->MultiCell(23,$b,$data,'1','C');
                                              $pdf->SetXY($x + 180, $y);
                                              $data = $row['short_pp_percent'];
                                              strlen($data)<15?$b=8:$b=4;
                                              $pdf->MultiCell(18,$b,$data,'1','C');
                                              $pdf->SetXY($x + 198, $y);
                                              $data = $row['short_gre_rcv_qty'];
                                              strlen($data)<15?$b=8:$b=4;
                                              $pdf->MultiCell(23,$b,$data,'1','C');
                                              $pdf->SetXY($x + 221, $y);
                                              $data = $row['short_gre_rcv_percent'];
                                              strlen($data)<15?$b=8:$b=4;
                                              $pdf->MultiCell(18,$b,$data,'1','C');
                                              $pdf->SetXY($x + 239, $y);
                                              $data = $row['short_pre_proc_qty'];
                                              strlen($data)<15?$b=8:$b=4;
                                              $pdf->MultiCell(23,$b,$data,'1','C');
                                              $pdf->SetXY($x + 262, $y);
                                              $data = $row['short_pre_proc_percent'];
                                              strlen($data)<15?$b=8:$b=4;
                                              $pdf->MultiCell(18,$b,$data,'1','C');
                                              // $pdf->SetXY($x + 200, $y);
    
                                          }
                                              // Version summary for Sanforizing
    
                                               $sql_for_sanforizing_version = " select pp.pp_number, pp.version_name version_number, pp.style_name, pp.color, pp.gw, pp.fw, pp.pp_quantity, result.process_qty, result.before_process_qty, result.gray_process_qty, 
                                               (result.process_qty-pp.pp_quantity) short_pp, 
                                               round((((result.process_qty-pp.pp_quantity)/pp.pp_quantity)*100),2)short_pp_percent, 
                                               (result.process_qty-result.gray_process_qty) short_gre_rcv_qty, 
                                               round((((result.process_qty-result.gray_process_qty)/result.gray_process_qty)*100),2)short_gre_rcv_percent, 
                                               (result.process_qty-result.before_process_qty) short_pre_proc_qty, 
                                               round((((result.process_qty-result.before_process_qty)/result.before_process_qty)*100),2)short_pre_proc_percent 
                   
                                               from (select distinct pwvci.pp_number, pwvci.version_name, pwvci.finish_width_in_inch fw, pwvci.greige_width_in_inch gw, pwvci.style_name, pwvci.color, 
                                               sum(pwvci.pp_quantity) pp_quantity from pp_wise_version_creation_info pwvci where pwvci.pp_number = '$pp_number' 
                                                                           group by pwvci.pp_number, pwvci.version_name )pp 
                   
                                               INNER JOIN 
                                               (SELECT distinct ptftri_1.process_id, ptftri_1.pp_number , version_name, ptftri_1.finish_width_in_inch
                                               ,sum(ptftri_1.after_trolley_or_batcher_qty) process_qty
                                               , sum(ptftri_1.before_trolley_or_batcher_qty) before_process_qty
                                               ,(SELECT sum(ptv.after_trolley_or_batcher_qty) process_qty from partial_test_for_test_result_info ptv 
                                               where ptv.pp_number = ptftri_1.pp_number and ptv.process_id = 'proc_20' and version_name = ptv.version_number) gray_process_qty 
                                               FROM
                                               partial_test_for_test_result_info ptftri_1
                                               inner join (
                                               SELECT ptftri.process_id, ptftri.pp_number pp_number, ptftri.version_number version_name, ptftri.finish_width_in_inch finish_width_in_inch
                                               ,max(ptftri.partial_test_for_test_result_creation_date) max_date
                                               from partial_test_for_test_result_info ptftri, pp_wise_version_creation_info pwvci
                                               where ptftri.pp_number = pwvci.pp_number and ptftri.version_number = pwvci.version_name and ptftri.style=pwvci.style_name
                                               and ptftri.finish_width_in_inch=pwvci.finish_width_in_inch 
                                               and ptftri.process_id = 'proc_18' and ptftri.pp_number = '$pp_number'
                                               group by ptftri.pp_number, ptftri.version_number, ptftri.finish_width_in_inch )P
                                               where  1 = 1
                                               and ptftri_1.process_id = p.process_id
                                               and ptftri_1.pp_number = p.pp_number
                                               and ptftri_1.version_number = p.version_name
                                               and ptftri_1.partial_test_for_test_result_creation_date = p.max_date
                                               and ptftri_1.finish_width_in_inch = p.finish_width_in_inch
                                               group by process_id , pp_number, version_name)result 
                                               on pp.pp_number = result.pp_number and pp.version_name = result.version_name
                                               order by pp.pp_number, pp.version_name";
    
                                                $result_for_sanforizing_version= mysqli_query($con,$sql_for_sanforizing_version) or die(mysqli_error($con));
    
                                                $row_number_for_sanforizing_version = mysqli_num_rows($result_for_sanforizing_version);
    
                                                $counter = $counter + ($row_number_for_sanforizing_version*8) + 10 + 10 + 8; 
                                
                                                if($counter>200)
                                                    {
                                                        $pdf->AddPage();
                                                        $pdf->SetLeftMargin(8);
                                                        $counter =30;
                                                        $counter = $counter + ($row_number_for_sanforizing_version*8) + 10 + 10 + 8; 
                                                    } 
    
                                                $pdf->SetFont('Arial','B',11);
                                                $pdf->Ln(3);
                                                $pdf->Cell(280,7,"Version Summary".$pdf->SetFillColor(220,220,220),"1","1","C",true);
                                                $pdf->SetFont('Arial','B',9);
    
                                              $x = $pdf->GetX();
                                              $y = $pdf->GetY();
                                              $data = "Version";
                                              strlen($data)<15?$b=10:$b=5;
                                              $pdf->MultiCell(28,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                              $pdf->SetXY($x + 28, $y);
                                              $data = "Color";
                                              strlen($data)<15?$b=10:$b=5;
                                              $pdf->MultiCell(24,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                              $pdf->SetXY($x + 52, $y);
                                              $data = "Style";
                                              strlen($data)<15?$b=10:$b=5;
                                              $pdf->MultiCell(24,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                              $pdf->SetXY($x + 76, $y);
                                              $data = "PP Quantity (mtr.)";
                                              strlen($data)<15?$b=10:$b=5;
                                              $pdf->MultiCell(27,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                              $pdf->SetXY($x + 103, $y);
                                              $data = "Before process Qty (mtr.)";
                                              strlen($data)<20?$b=10:$b=5;
                                              $pdf->MultiCell(27,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                              $pdf->SetXY($x + 130, $y);
                                              $data = "Process Quantity (mtr.)";
                                              strlen($data)<20?$b=10:$b=5;
                                              $pdf->MultiCell(27,$b,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                              $pdf->SetXY($x + 157, $y);
                                              $data = "(+/-) From PP";
                                              // strlen($data)<15?$b=10:$b=5;
                                              $pdf->MultiCell(41,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                              $pdf->SetXY($x + 157, $y+5);
                                              $data = "Qty (mtr.)";
                                              // strlen($data)<15?$b=10:$b=5;
                                              $pdf->MultiCell(23,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                              $pdf->SetXY($x + 180, $y+5);
                                              $data = "%";
                                              // strlen($data)<15?$b=10:$b=5;
                                              $pdf->MultiCell(18,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                              $pdf->SetXY($x + 198, $y);
                                              $data = "(+/-) From Greige";
                                              // strlen($data)<15?$b=10:$b=5;
                                              $pdf->MultiCell(41,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                              $pdf->SetXY($x + 198, $y+5);
                                              $data = "Qty (mtr.)";
                                              // strlen($data)<15?$b=10:$b=5;
                                              $pdf->MultiCell(23,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                              $pdf->SetXY($x + 221, $y+5);
                                              $data = "%";
                                              // strlen($data)<15?$b=10:$b=5;
                                              $pdf->MultiCell(18,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                              $pdf->SetXY($x + 239, $y);
                                              $data = "(+/-) From Prev. Process";
                                              // strlen($data)<15?$b=10:$b=5;
                                              $pdf->MultiCell(41,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                              $pdf->SetXY($x + 239, $y+5);
                                              $data = "Qty (mtr.)";
                                              // strlen($data)<15?$b=10:$b=5;
                                              $pdf->MultiCell(23,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                              $pdf->SetXY($x + 262, $y+5);
                                              $data = "%";
                                              // strlen($data)<15?$b=10:$b=5;
                                              $pdf->MultiCell(18,5,$data.$pdf->SetFillColor(220,220,220),'1','C',TRUE);
                                              $pdf->SetXY($x + 280, $y);
                                              
                                              // $pdf->Cell(0,0,$pdf->SetFillColor(255,255,255),'1','1','C',true);
                                              $pdf->SetFont('Arial','',9);       
                                               $pdf->Ln(10);
                  
                                        while($row = mysqli_fetch_array($result_for_sanforizing_version))  
                                        {  
                                            $x = $pdf->GetX();
                                            $y = $pdf->GetY();
                                            $data = $row['version_number'];
                                            strlen($data)<16?$b=8:$b=4;
                                            $pdf->MultiCell(28,$b,$data,'1','C');
                                            $pdf->SetXY($x + 28, $y);
                                            $data = $row['color'];
                                            strlen($data)<20?$b=8:$b=4;
                                            $pdf->MultiCell(24,$b,$data,'1','C');
                                            $pdf->SetXY($x + 52, $y);
                                            $data = $row['style_name'];
                                            strlen($data)<10?$b=8:$b=4;
                                            $pdf->MultiCell(24,$b,$data,'1','C');
                                            $pdf->SetXY($x + 76, $y);
                                            $data = $row['pp_quantity'];
                                            strlen($data)<20?$b=8:$b=4;
                                            $pdf->MultiCell(27,$b,$data,'1','C');
                                            $pdf->SetXY($x + 103, $y);
                                            $data = $row['before_process_qty'];
                                            strlen($data)<20?$b=8:$b=4;
                                            $pdf->MultiCell(27,$b,$data,'1','C');
                                            $pdf->SetXY($x + 130, $y);
                                            $data = $row['process_qty'];
                                            strlen($data)<20?$b=8:$b=4;
                                            $pdf->MultiCell(27,$b,$data,'1','C');
                                            $pdf->SetXY($x + 157, $y);
                                            $data = $row['short_pp'];
                                            strlen($data)<15?$b=8:$b=4;
                                            $pdf->MultiCell(23,$b,$data,'1','C');
                                            $pdf->SetXY($x + 180, $y);
                                            $data = $row['short_pp_percent'];
                                            strlen($data)<15?$b=8:$b=4;
                                            $pdf->MultiCell(18,$b,$data,'1','C');
                                            $pdf->SetXY($x + 198, $y);
                                            $data = $row['short_gre_rcv_qty'];
                                            strlen($data)<15?$b=8:$b=4;
                                            $pdf->MultiCell(23,$b,$data,'1','C');
                                            $pdf->SetXY($x + 221, $y);
                                            $data = $row['short_gre_rcv_percent'];
                                            strlen($data)<15?$b=8:$b=4;
                                            $pdf->MultiCell(18,$b,$data,'1','C');
                                            $pdf->SetXY($x + 239, $y);
                                            $data = $row['short_pre_proc_qty'];
                                            strlen($data)<15?$b=8:$b=4;
                                            $pdf->MultiCell(23,$b,$data,'1','C');
                                            $pdf->SetXY($x + 262, $y);
                                            $data = $row['short_pre_proc_percent'];
                                            strlen($data)<15?$b=8:$b=4;
                                            $pdf->MultiCell(18,$b,$data,'1','C');
                                            // $pdf->SetXY($x + 280, $y);
    
                                        }
    
                                        $sql_for_sanforizing_total = "select total.pp_number, sum(total.pp_quantity) pp_quantity, sum(total.process_qty) process_qty, 
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
                            
                                        (SELECT distinct ptftri_1.process_id, ptftri_1.pp_number , version_name, ptftri_1.finish_width_in_inch
                                            ,sum(ptftri_1.after_trolley_or_batcher_qty) process_qty
                                            , sum(ptftri_1.before_trolley_or_batcher_qty) before_process_qty
                                            ,(SELECT sum(ptv.after_trolley_or_batcher_qty) process_qty from partial_test_for_test_result_info ptv 
                                            where ptv.pp_number = ptftri_1.pp_number and ptv.process_id = 'proc_20' and version_name = ptv.version_number) gray_process_qty 
                                            FROM
                                            partial_test_for_test_result_info ptftri_1
                                            inner join (
                                            SELECT ptftri.process_id, ptftri.pp_number pp_number, ptftri.version_number version_name, ptftri.finish_width_in_inch finish_width_in_inch
                                            ,max(ptftri.partial_test_for_test_result_creation_date) max_date
                                            from partial_test_for_test_result_info ptftri, pp_wise_version_creation_info pwvci
                                            where ptftri.pp_number = pwvci.pp_number and ptftri.version_number = pwvci.version_name and ptftri.style=pwvci.style_name
                                            and ptftri.finish_width_in_inch=pwvci.finish_width_in_inch 
                                            and ptftri.process_id = 'proc_18' and ptftri.pp_number = '$pp_number'
                                            group by ptftri.pp_number, ptftri.version_number, ptftri.finish_width_in_inch )P
                                            where  1 = 1
                                            and ptftri_1.process_id = p.process_id
                                            and ptftri_1.pp_number = p.pp_number
                                            and ptftri_1.version_number = p.version_name
                                            and ptftri_1.partial_test_for_test_result_creation_date = p.max_date
                                            and ptftri_1.finish_width_in_inch = p.finish_width_in_inch
                                            group by process_id , pp_number, version_name)result where pp.pp_number = result.pp_number and pp.version_name = result.version_name ) total";

                                      $result_for_sanforizing_total= mysqli_query($con,$sql_for_sanforizing_total) or die(mysqli_error($con));
                                      while($row = mysqli_fetch_array($result_for_sanforizing_total))  
                                      {
                                          $pdf->SetFont('Arial','B',9); 
                                          $x = $pdf->GetX();
                                          $y = $pdf->GetY();
                                          $data = "Sanforizing Total Qty. (mtr.)";
                                          strlen($data)<70?$b=8:$b=4;
                                          $pdf->MultiCell(76,$b,$data,'1','C');
                                          $pdf->SetXY($x + 76, $y);
                                          $data = $row['pp_quantity'];
                                          strlen($data)<20?$b=8:$b=4;
                                          $pdf->MultiCell(27,$b,$data,'1','C');
                                          $pdf->SetXY($x + 103, $y);
                                          $data = $row['before_process_qty'];
                                          strlen($data)<20?$b=8:$b=4;
                                          $pdf->MultiCell(27,$b,$data,'1','C');
                                          $pdf->SetXY($x + 130, $y);
                                          $data = $row['process_qty'];
                                          strlen($data)<20?$b=8:$b=4;
                                          $pdf->MultiCell(27,$b,$data,'1','C');
                                          $pdf->SetXY($x + 157, $y);
                                          $data = $row['short_pp_qty'];
                                          strlen($data)<20?$b=8:$b=4;
                                          $pdf->MultiCell(23,$b,$data,'1','C');
                                          $pdf->SetXY($x + 180, $y);
                                          $data = $row['short_pp_percent'];
                                          strlen($data)<20?$b=8:$b=4;
                                          $pdf->MultiCell(18,$b,$data,'1','C'); 
                                          $pdf->SetXY($x + 198, $y); 
                                          $data = $row['short_gre_rcv_qty'];
                                          strlen($data)<20?$b=8:$b=4;
                                          $pdf->MultiCell(23,$b,$data,'1','C');
                                          $pdf->SetXY($x + 221, $y);
                                          $data = $row['short_gre_rcv_percent'];
                                          strlen($data)<20?$b=8:$b=4;
                                          $pdf->MultiCell(18,$b,$data,'1','C');
                                          $pdf->SetXY($x + 239, $y); 
                                          $data = $row['short_pre_proc_qty'];
                                          strlen($data)<20?$b=8:$b=4;
                                          $pdf->MultiCell(23,$b,$data,'1','C');
                                          $pdf->SetXY($x + 262, $y);
                                          $data = $row['short_pre_proc_percent'];
                                          strlen($data)<20?$b=8:$b=4;
                                          $pdf->MultiCell(18,$b,$data,'1','C');  
    
                                          if($row['short_excess_qty']!= '') 
                                              {
                                                  $process_loss_gain+=$row['short_excess_qty'];
                                              }
                                  
                                              $Total_pp_quantity = $row['pp_quantity'];
                                              $Total_greige_quantity = $row['process_qty'];
                                        $final_process_qty = $row['process_qty'];
                                       
                                      }
                                        $process_loss_gain_with_pp = $final_process_qty - $Total_pp_quantity;
                                        $process_loss_gain_with_greige =   $final_process_qty - $Total_greige_quantity;
    
                }
            }

    }
}



ob_end_clean();

$pdf->Output('I', "pp_status_reprot_for_pp_number_".$pp_number.".pdf", true);
// ob_end_flush();


?>





