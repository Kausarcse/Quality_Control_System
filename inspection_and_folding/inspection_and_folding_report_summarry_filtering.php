
<?php
//error_reporting(0);
session_start();
require_once("../login/session.php");
include('../login/db_connection_class.php');
$obj = new DB_Connection_Class();
$obj->connection();

$date = date("Y-m-d");

$folding_date = $_POST['folding_date'];
$folding_pp_number = $_POST['folding_pp_number'];
$folding_customer = $_POST['folding_customer'];
$folding_week = $_POST['folding_week'];

$final_process_quantity = 0;
$reworkable_quantity = 0;
$rejected_quantity = 0;
$folding_quantity = 0;

$data = '';  
$quantity_data = '';                                                    
                             $sql_for_folding = "SELECT * FROM inspection_and_folding WHERE recording_time LIKE '%$folding_date%' AND
                             pp_number = '$folding_pp_number' AND customer_name = '$folding_customer' AND week_in_year = '$folding_week' order by folding_id desc";

                            $result_for_folding = mysqli_query($con, $sql_for_folding) or die(mysqli_error($con));
                            
                            while($row_for_folding = mysqli_fetch_array($result_for_folding))
                                {
                                   
                                 
                        $data .='
                            <tr>
                                <td style="border: 1px solid black">'.date("d-M-Y", strtotime($row_for_folding['recording_time'])).'</td>
                                <td style="border: 1px solid black">'.$row_for_folding['customer_name'].'</td>
                                <td style="border: 1px solid black">'.$row_for_folding['pp_number'].'</td>
                                <td style="border: 1px solid black">'.$row_for_folding['week_in_year'].'</td>
                                <td style="border: 1px solid black">'.$row_for_folding['design_name'].'</td>
                                <td style="border: 1px solid black">'.$row_for_folding['version_number'].'</td>
                                <td style="border: 1px solid black">'.$row_for_folding['style_name'].'</td>
                                <td style="border: 1px solid black">'.$row_for_folding['color'].'</td>
                                <td style="border: 1px solid black">'.$row_for_folding['construction_name'].'</td>
                                <td style="border: 1px solid black">'.$row_for_folding['process_name'].'</td>
                                <td style="border: 1px solid black">'.$row_for_folding['finish_width'].'</td>
                                <td style="border: 1px solid black">'.$row_for_folding['trolly_number'].'</td>
                                <td style="border: 1px solid black">'.$row_for_folding['quantity'].'</td>
                                <td style="border: 1px solid black">'.$row_for_folding['inspection_report_status'].'</td>
                                <td style="border: 1px solid black">'.$row_for_folding['reworkable_quantity'].'</td>
                                <td style="border: 1px solid black">'.$row_for_folding['rejected_quantity'].'</td>
                                <td style="border: 1px solid black">'.$row_for_folding['folding_quantity'].'</td>
                                <td style="border: 1px solid black">'.$row_for_folding['remarks'].'</td>
                               
                            </tr>';

                            $final_process_quantity += $row_for_folding['quantity'];
                            $reworkable_quantity += $row_for_folding['reworkable_quantity'];
                            $rejected_quantity += $row_for_folding['rejected_quantity'];
                            $folding_quantity += $row_for_folding['folding_quantity'];

                            }

                        $quantity_data .='<tr id="total_quantity_data">
                              
                            <td colspan="12" style="border: 1px solid black; text-align:right; font-weight: bold;">Total Quantity : </td>
                            <td style="border: 1px solid black">'.$final_process_quantity.'</td>
                            <td style="border: 1px solid black"></td>
                            <td style="border: 1px solid black">'.$reworkable_quantity.'</td>
                            <td style="border: 1px solid black">'.$rejected_quantity.'</td>
                            <td style="border: 1px solid black">'.$folding_quantity.'</td>
                            <td style="border: 1px solid black"></td>
                    
                        </tr>';

                    $final_data = $data.'?fs?'.$quantity_data;

          echo $final_data;
                        ?>
                            