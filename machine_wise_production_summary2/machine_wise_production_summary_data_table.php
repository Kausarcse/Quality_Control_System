<script type='text/javascript' src='process_program/process_program_info_form_validation.js'></script>

<script>

function Remove_Value_Of_This_Element(element_name)
{

     document.getElementById(element_name).value='';
     var alternate_field_of_date = "alternate_"+element_name;

     if(typeof(alternate_field_of_date) != 'undefined' && alternate_field_of_date != null) // This is for deleting Alternative Field of Date if exists
     {
        document.getElementById(alternate_field_of_date).value='';
     }

}

function Reset_Radio_Button(radio_element)
{

        var radio_btn = document.getElementsByName(radio_element);
        for(var i=0;i<radio_btn.length;i++) 
        {
                radio_btn[i].checked = false;
        }


}

</script>

<?php
error_reporting(0);
session_start();
require_once("../login/session.php");
include('../login/db_connection_class.php');
$obj = new DB_Connection_Class();
$obj->connection();

$date = date("Y-m-d");



$sub_query='';


if(isset($_POST['from_date']) && $_POST['from_date']!='' && $_POST['to_date']=='')
{   
    $from_date=$_POST['from_date'];

    $sub_query.=" and  partial_test_for_test_result_creation_date= '".$from_date."'";

}
 if(isset($_POST['to_date']) && isset($_POST['from_date']) && $_POST['to_date']!='')
{   
    
  $from_date=$_POST['from_date'];
  $to_date=$_POST['to_date'];

 $sub_query.=" and  partial_test_for_test_result_creation_date between '".$from_date."' and '".$to_date."'";
}

if(isset($_POST['process_name']) && $_POST['process_name']!='select')
{   
    
    
    $process_name_value=$_POST['process_name'];
    $splitted_data=explode('?fs?',$process_name_value);
    $process_id=$splitted_data[0]; 
    $process_name = $splitted_data[1];

    $sub_query.=" and  process_name='".$process_name."'";

}
if(isset($_POST['machine_name']) && $_POST['machine_name']!='' && $_POST['machine_name']!='select')
{   
    $machine_name=$_POST['machine_name'];

    $sub_query.=" and  machine_name='".$machine_name."'";


}






$current_process_index=-1;
$previous_process="";
$after_process="";
$data_for_all_process = array();
// echo $process_name;


$table ='    

               <label style="text-align: right;">Date: '.$from_date.' to '.$to_date.'</label>

                 <table class="table table-bordered" style="border: 2px solid black;">
                    <thead>
                     
                            <tr style="background-color: #C0C0C0; border: 2px solid black;">
                                
                                <th colspan="2" style="border: 1px solid">Process wise Machines</th>
                                <th style="border: 1px solid">Today (Yesterday)</th>
                                <th style="border: 1px solid">To Date (Day 1 to yesterday)</th>
                                <th style="border: 1px solid">Target (30 days)</th>
                                <th style="border: 1px solid">Remaining (-)</th>
                                <th style="border: 1px solid">Current Daily Average</th>
                                <th style="border: 1px solid">Required Daily Average</th>
                                <th style="border: 1px solid">Re-process Today (Yesterday)</th>
                                <th style="border: 1px solid">Re-process To date</th>
                            </tr>
                               
                            </thead>

                             <tbody>';
                            
     $sql = "SELECT DISTINCT process_name, process_id From partial_test_for_test_result_info
                        WHERE 1=1
                        ".$sub_query."";            
        // echo $sql;
         
        
         $result= mysqli_query($con,$sql) or die(mysqli_error($con));

         while( $row = mysqli_fetch_array( $result))
         {      


                            $counter_today =0;
                            $today_total_qty =0;
                            $total_till_yesterday_qty =0;
                            $total_qty_for_machine_wise_monthly_target=0;
                            $total_remaining_qty=0;
                            $total_current_daily_avg=0;
                            $total_required_avg =0;

                            $row_process_id=$row['process_id'];
                            $row_process_name=$row['process_name'];
                            // $row_machine_name=$row['machine_name'];

                              /*$sql_for_process = "SELECT process_name, SUM(after_trolley_or_batcher_qty) as total_qty, COUNT(partial_test_for_test_result_creation_date) AS count  from partial_test_for_test_result_info WHERE partial_test_for_test_result_creation_date <= CURRENT_DATE()-1 AND partial_test_for_test_result_creation_date >= (SELECT MIN(partial_test_for_test_result_creation_date) AS start_date from partial_test_for_test_result_info )
                            and 1=1 ".$sub_query." ";*/

                            if($from_date== "" && $to_date == "")
                            {
                                $sql_for_process = "SELECT  process_id, process_name, SUM(after_trolley_or_batcher_qty) as total_qty, COUNT(partial_test_for_test_result_creation_date) AS count  from partial_test_for_test_result_info WHERE partial_test_for_test_result_creation_date <= CURRENT_DATE()-1 AND partial_test_for_test_result_creation_date >= (SELECT MIN(partial_test_for_test_result_creation_date) AS start_date from partial_test_for_test_result_info WHERE process_id= '$row_process_id')
                                and process_id = '$row_process_id' ";
                            }
                            else
                            {

                                $sql_for_process = "SELECT  process_id, process_name, SUM(after_trolley_or_batcher_qty) as total_qty, COUNT(partial_test_for_test_result_creation_date) AS count  from partial_test_for_test_result_info WHERE partial_test_for_test_result_creation_date <= '$to_date' AND partial_test_for_test_result_creation_date >= '$from_date' and process_id = '$row_process_id' ";
                            }

                            /*echo $sql_for_process;*/
                            $res_for_process = mysqli_query($con, $sql_for_process);
                            
                        while ($row_for_process = mysqli_fetch_assoc($res_for_process)) 
                        {
                            
                            $process_name = $row_for_process['process_name'];
                            $process_id = $row_for_process['process_id'];
                            $sql_for_today_qty = "select DISTINCT SUM(after_trolley_or_batcher_qty) as today_qty from partial_test_for_test_result_info where  process_id = '$process_id' AND partial_test_for_test_result_creation_date = CURRENT_DATE()-1";
                            $res_for_today_qty = mysqli_query($con, $sql_for_today_qty);
                            $row_for_today_qty = mysqli_fetch_assoc($res_for_today_qty);
                            
                            if($row_for_today_qty['today_qty']!= null)
                            {
                                $today_qty = $row_for_today_qty['today_qty'];
                                $counter_today +=1;
                            }
                            else
                            {
                                $today_qty=0;
                                $counter_today =0;
                            }
                           
                            if($row_for_process['count']!=null)
                                    {
                                        $daily_avg_count = $row_for_process['count'];
                                    }
                                    else
                                    {
                                        $daily_avg_count =$counter_today;
                                    }

                            $today_total_qty += $today_qty;

                            if($row_for_process['total_qty'] != null)
                            {
                                $total_till_yesterday_qty =$row_for_process['total_qty'];
                            }
                            else
                            {
                                $total_till_yesterday_qty = 0;
                            }
                            
                            
                            $total_qty = $today_total_qty + $total_till_yesterday_qty;

                            $sql_for_machine_wise_monthly_target = "select DISTINCT process_name, SUM(machine_wise_monthly_target) as total_qty_for_machine_wise_monthly_target from machine_name WHERE process_id = '$process_id'";
                            $res_for_machine_wise_monthly_target = mysqli_query($con, $sql_for_machine_wise_monthly_target);
                            $row_for_machine_wise_monthly_target = mysqli_fetch_assoc($res_for_machine_wise_monthly_target);
                            $total_qty_for_machine_wise_monthly_target = $row_for_machine_wise_monthly_target['total_qty_for_machine_wise_monthly_target'];
                            
                            // $total_r_qty = $today_total_qty + $total_till_yesterday_qty;
                            $total_remaining_qty = $total_qty_for_machine_wise_monthly_target - $total_till_yesterday_qty;

                            $total_current_daily_avg = $total_till_yesterday_qty / $daily_avg_count;

                            $total_required_avg = $total_qty_for_machine_wise_monthly_target / $daily_avg_count;

                            $sql_for_reprocess_today = "SELECT SUM(after_trolley_or_batcher_qty) AS qty_for_reprocess from partial_test_for_test_result_info WHERE (process_id = 'proc_18' AND process_name LIKE '%Re-Sanforizing%') AND partial_test_for_test_result_creation_date = CURRENT_DATE()-1";
                            $res_for_reprocess_today = mysqli_query($con, $sql_for_reprocess_today) or die(mysqli_error($con));
                            $row_for_reprocess_today = mysqli_fetch_assoc($res_for_reprocess_today);

                            $sql_for_reprocess = "SELECT SUM(after_trolley_or_batcher_qty) AS qty_for_reprocess from partial_test_for_test_result_info WHERE (process_id = 'proc_18' AND process_name LIKE '%Re-Sanforizing%') AND partial_test_for_test_result_creation_date <= CURRENT_DATE()-1
                                   AND partial_test_for_test_result_creation_date >= (SELECT MIN(partial_test_for_test_result_creation_date) AS start_date from partial_test_for_test_result_info WHERE process_id= 'proc_20')";
                                   $res_for_reprocess = mysqli_query($con, $sql_for_reprocess) or die(mysqli_error($con));
                                   $row_for_reprocess = mysqli_fetch_assoc($res_for_reprocess);
                                   if($process_id == 'proc_18')
                                   {
                                       $qty_for_reprocess = $row_for_reprocess['qty_for_reprocess'];
                                       $qty_for_reprocess_today = $row_for_reprocess_today['qty_for_reprocess'];
                                    }
                          
                             $table .=' 
                                    <tr style="border: 2px solid black;  background-color: #E0DDDD">
                                    <td colspan="2" style="font-weight: bold; border: 1px solid" >'.$row_process_name.'</td>
                                    <td style="border: 1px solid">'.$today_total_qty.'</td>
                                    <td style="border: 1px solid">'.$total_till_yesterday_qty.'</td>
                                    <td style="border: 1px solid">'.$total_qty_for_machine_wise_monthly_target.'</td>
                                    <td style="border: 1px solid">'.$total_remaining_qty.'</td>
                                    <td style="border: 1px solid">'.number_format($total_current_daily_avg, 2).'</td>
                                    <td style="border: 1px solid">'.number_format($total_required_avg, 2).'</td>
                                    <td style="border: 1px solid">'.$qty_for_reprocess_today.'</td>
                                    <td style="border: 1px solid">'.$qty_for_reprocess.'</td>

                                   </tr>';
                                   
                                        $counter_today=0;
                                        $total_monthly_terget = 0;
                                        $remaining_qty =0;

                                       if($machine_name == "")
                                       {
                                        $sql_for_machine = "SELECT * FROM machine_name INNER JOIN process_name on machine_name.process_name = process_name.process_name and process_name.process_name = '$row_process_name'";
                                       }
                                       else
                                       {
                                        $sql_for_machine = "SELECT * FROM machine_name INNER JOIN process_name on machine_name.process_name = process_name.process_name and process_name.process_name = '$row_process_name' and machine_name.machine_name = '$machine_name'";
                                       }
                                        
                                        $res_for_machine = mysqli_query($con, $sql_for_machine);
                                       
                                        while($row_for_machine = mysqli_fetch_assoc($res_for_machine))
                                        {
                                            
                                            $machine_name = $row_for_machine['machine_name'];
                                            $sql_for_today_qty = "select SUM(after_trolley_or_batcher_qty) as today_qty from partial_test_for_test_result_info where process_id ='$process_id' AND machine_name = '$machine_name' AND partial_test_for_test_result_creation_date = CURRENT_DATE()-1";
                                            $res_for_today_qty = mysqli_query($con, $sql_for_today_qty);
                                            $row_for_today_qty = mysqli_fetch_assoc($res_for_today_qty);
                                            
                                            if($row_for_today_qty['today_qty']!= null)
                                            {
                                                $today_qty = $row_for_today_qty['today_qty'];
                                                $counter_today +=1;
                                            }
                                            else
                                            {
                                                $today_qty=0;
                                                $counter_today =0;
                                            }
                                            if($from_date== "" && $to_date == "")
                                            {
                                                $sql_for_total_qty = "select SUM(after_trolley_or_batcher_qty) as total_qty, COUNT(partial_test_for_test_result_creation_date) AS count from partial_test_for_test_result_info 
                                                where process_id ='$process_id' AND machine_name = '$machine_name' AND partial_test_for_test_result_creation_date <= CURRENT_DATE()-1 
                                                AND partial_test_for_test_result_creation_date >= (SELECT MIN(partial_test_for_test_result_creation_date) AS start_date from partial_test_for_test_result_info WHERE process_id= 'proc_20') ";
                                            }
                                            else
                                            {
                                                $sql_for_total_qty = "select SUM(after_trolley_or_batcher_qty) as total_qty, COUNT(partial_test_for_test_result_creation_date) AS count from partial_test_for_test_result_info 
                                                where process_id ='$process_id' AND machine_name = '$machine_name' AND partial_test_for_test_result_creation_date <= '$to_date' 
                                                AND partial_test_for_test_result_creation_date >= '$from_date' ";
                                            }
                                            
                                            $res_for_total_qty = mysqli_query($con, $sql_for_total_qty);
                                            $row_for_total_qty = mysqli_fetch_assoc($res_for_total_qty);

                                            if($row_for_total_qty['total_qty']!=null)
                                            {
                                                $till_yesterday_qty = $row_for_total_qty['total_qty'];
                                            }
                                            else
                                            {
                                                $till_yesterday_qty = 0;
                                            }
                                            $machine_wise_monthly_terget = $row_for_machine['machine_wise_monthly_target'];
                                            // $total_qty = $today_qty + $till_yesterday_qty;
                                            $remaining_qty = $machine_wise_monthly_terget - $till_yesterday_qty;
                                            // $total_remaining_qty += $remaining_qty;

                                            if($row_for_total_qty['count']!=null)
                                            {
                                                $daily_avg_count =$row_for_total_qty['count'];
                                            }
                                            else
                                            {
                                                $daily_avg_count =$counter_today;
                                            }
                                            
                                             $current_daily_avg = $till_yesterday_qty / $daily_avg_count;
                                            //  $total_daily_avg_count += $daily_avg_count;

                                             $required_daily_avg = $machine_wise_monthly_terget / $daily_avg_count;

                                             $sql_for_reprocess_today = "SELECT SUM(after_trolley_or_batcher_qty) AS qty_for_reprocess from partial_test_for_test_result_info WHERE machine_name = '$machine_name' AND process_name LIKE '%Re-Sanforizing%' AND partial_test_for_test_result_creation_date = CURRENT_DATE()-1";
                                             $res_for_reprocess_today = mysqli_query($con, $sql_for_reprocess_today) or die(mysqli_error($con));
                                             $row_for_reprocess_today = mysqli_fetch_assoc($res_for_reprocess_today);
                 
                                             $sql_for_reprocess = "SELECT SUM(after_trolley_or_batcher_qty) AS qty_for_reprocess from partial_test_for_test_result_info WHERE machine_name = '$machine_name' AND process_name LIKE '%Re-Sanforizing%' AND partial_test_for_test_result_creation_date <= CURRENT_DATE()-1
                                                    AND partial_test_for_test_result_creation_date >= (SELECT MIN(partial_test_for_test_result_creation_date) AS start_date from partial_test_for_test_result_info WHERE process_id= 'proc_20')";
                                                    $res_for_reprocess = mysqli_query($con, $sql_for_reprocess) or die(mysqli_error($con));
                                                    $row_for_reprocess = mysqli_fetch_assoc($res_for_reprocess);
                 
                                         
                                           $table.='<tr>
                                            <td colspan="2" style="border: 1px solid">'.$row_for_machine['machine_name'].'</td>
                                            <td style="border: 1px solid">'.$today_qty.'</td>
                                            <td style="border: 1px solid">'.$till_yesterday_qty.'</td>
                                            <td style="border: 1px solid">'.$row_for_machine['machine_wise_monthly_target'].'</td>
                                            <td style="border: 1px solid">'.$remaining_qty.'</td>
                                            <td style="border: 1px solid">'. number_format($current_daily_avg, 2).'</td>
                                            <td style="border: 1px solid">'.number_format($required_daily_avg, 2).'</td>
                                            <td style="border: 1px solid">'.$row_for_reprocess_today['qty_for_reprocess'].'</td>
                                            <td style="border: 1px solid">'.$row_for_reprocess['qty_for_reprocess'].'</td>
                                            </tr>'; 
                                            
                                            
                                        }
                                       
                                                    
                                    } 
                                            
                             
                               
}  /*End of while */                                    
         $table .='</tbody>
                     </table>
                     </div>';

         echo $table;
      



?>




<script>

function generate_pdf_for_machine_wise_production_summary(){
    



    /*document.getElementById("trf_pass_fail_form").style.marginLeft = "15%";*/

    let nbPages = 1;
    let sourceHtml = $('#element');

    
    html2pdf(sourceHtml[0], {
      margin: 1,
      filename: 'machine_wise_production_summary.pdf',
      image: { type: 'jpeg', quality: 0.98 },
     
      html2canvas: { dpi: 600, letterRendering: true, width: 2000, height: 3000  },
      jsPDF: { unit: 'pt', format: 'a4', orientation: 'portrait' }
    });  
}
</script>