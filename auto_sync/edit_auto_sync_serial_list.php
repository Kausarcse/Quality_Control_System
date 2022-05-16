<?php

session_start();
require_once("../login/session.php");
include('../login/db_connection_class.php');
$obj = new DB_Connection_Class();
$obj->connection();

$customer = $_GET['customer_name'];
$splitted_customer = explode('?fs?', $customer);
$customer_id = $splitted_customer[0];
$customer_name = $splitted_customer[1];

$version_number = $_GET['version_name'];

$color_name = $_GET['color'];

$process_details = $_GET['process_name'];
$splitted_process = explode('?fs?', $process_details);
$process_id = $splitted_process[0];
$process_name = $splitted_process[1];

$process_serial = $_GET['process_serial'];
$process_technique_name = $_GET['process_technique_name'];
$model_standard = $_GET['model_standard'];


?>

    <div class="panel panel-default" id="version_wise_process_info_list">
            
             <div  id="pagination" class="form-group form-group-sm" id="form-group_for_test_method_name">

               <form id="list_serial_update" name="list_serial_update">
                     <table id="data_table_for_pp"  class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th>SI</th>
                            <th>Customer</th>
                            <th>Version Name</th>
                            <th>Process Name</th>
                            <th>Process Serial</th>
                            <th>Process Technique</th>
                        </tr>
                        </thead>
                        <tbody>
                   <?php

                        $s1 = 0;

                        $sql_for_color = "SELECT * FROM adding_process_to_version_model Where customer_name = '$customer_name' AND version_number = '$version_number' AND process_technique = '$process_technique_name'";

                        $res_for_color = mysqli_query($con, $sql_for_color);

                        $total_number_of_serial = mysqli_num_rows($res_for_color);

                        while ($row = mysqli_fetch_assoc($res_for_color))
                        {
                            $s1=$s1+1;
                        ?>
                        <tr>
                            <td><?php echo $s1; ?></td>
                            <td><?php echo $row['customer_name']; ?></td>
                            <td><?php echo $row['version_number']; ?></td>
                            <td><?php echo $row['process_name']; ?></td>
                            <td>
                              <?php 
                                    $double_data = $row['process_serial_no']."?fs?".$total_number_of_serial;
                              ?>
                               <input type="number" onchange="checking_serial_number('<?php echo $double_data; ?>?fs?'+this.value)" name="process_serial_<?php echo $s1; ?>" id="process_serial_<?php echo $s1; ?>" value="<?php echo $row['process_serial_no']; ?>">
                            </td>
                            <td><?php echo $row['process_technique']; ?></td>
                        </tr>
                        <?php
                        }

                        ?>

                        </tbody>
                    </table>

                    <button type="button" id="" name="update_pp_info"  class="btn btn-success btn-lg" onclick="sending_edit_serial_auto_sync()"> Update Serial </button>

               </form>
                 
             </div>

        </div>

<?php


?>

