<?php

session_start();
require_once("../login/session.php");
include('../login/db_connection_class.php');
$obj = new DB_Connection_Class();
$obj->connection();

$sql = '';

if ( !($_GET['customer_name'] == 'select') ) 
{
    $customer = $_GET['customer_name'];
    $splitted_customer = explode('?fs?', $customer);
    $customer_id = $splitted_customer[0];
    $customer_name = $splitted_customer[1];
    $sql .= " AND customer_name = '$customer_name'";
}

if ( !($_GET['version_name'] == 'select') ) 
{
    $version_number = $_GET['version_name'];
    $sql .= " AND version_number = '$version_number'";
}

if ( !($_GET['process_name'] == 'select') ) 
{
    $process_details = $_GET['process_name'];
    $splitted_process = explode('?fs?', $process_details);
    $process_id = $splitted_process[0];
    $process_name = $splitted_process[1];
    $sql .= " AND process_name = '$process_name'";
}

if ( !($_GET['process_technique_name'] == 'select') ) 
{
    $process_technique_name = $_GET['process_technique_name'];
    $sql .= " AND process_technique = '$process_technique_name'";
}


?>

    <div class="panel panel-default" id="version_wise_process_info_list">
            
             <div  id="pagination" class="form-group form-group-sm" id="form-group_for_test_method_name">

                 <table id="data_table_for_pp"  class="table table-striped table-bordered">
                     <thead>
                     <tr>
                         <th>SI</th>
                         <th>Customer</th>
                         <th>Version Name</th>
                         <th>Process Name</th>
                         <th>Process Serial</th>
                         <th>Process Technique</th>
                         <th>Action</th>
                     </tr>
                     </thead>
                     <tbody>
                <?php

                     $s1 = 0;

                     $sql_for_color = "SELECT * FROM adding_process_to_version_model Where 1=1".$sql;

                     $res_for_color = mysqli_query($con, $sql_for_color);

                     while ($row = mysqli_fetch_assoc($res_for_color))
                     {
                         $s1=$s1+1;
                     ?>
                     <tr>
                         <td><?php echo $s1; ?></td>
                         <td><?php echo $row['customer_name']; ?></td>
                         <td><?php echo $row['version_number']; ?></td>
                         <td><?php echo $row['process_name']; ?></td>
                         <td><?php echo $row['process_serial_no']; ?></td>
                         <td><?php echo $row['process_technique']; ?></td>
                         <td>
                            <?php

                             $customer_name = $row['customer_name'];
                             $customer_id = $row['customer_id'];
                             $version_number = $row['version_number'];
                             //$version_id = $row['version_id'];
                             $process_name = $row['process_name'];
                             $process_id = $row['process_id'];
                             $process_technique = $row['process_technique'];
                             $process_serial_no = $row['process_serial_no'];
                             $color = $row['color_name'];
                             $model_standard = 'model_standard';

                             $customer = "customer_name=".$customer_id."?fs?".$customer_name;
                             $version = "&version_name=".$version_number;
                             $color = "&color=".$color;
                             $process = "&process_name=".$process_id."?fs?".$process_name;
                             $process_serial = "&process_serial=".$process_serial_no;
                             $process_technique_name = "&process_technique_name=".$process_technique;

                             $model_standard_details = '&model_standard='.$model_standard;

                             $update_value = $customer.$version.$color.$process.$process_serial.$process_technique_name.$model_standard_details;
                             ?>

                             <button type="button" id="" name="update_pp_info"  class="btn btn-info btn-xs" onclick="sending_data_for_update('<?php echo $update_value; ?>, <?php echo $process_name; ?>')"> Edit </button>

                         </td>
                     </tr>
                     <?php
                     }

                     ?>

                     </tbody>
                 </table>
             </div>


             <div id="row_for_qc_standard_defining_form_loading">
                
             </div>

        </div>

<?php


?>