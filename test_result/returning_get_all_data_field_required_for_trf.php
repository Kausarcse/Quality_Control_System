<?php
session_start();
require_once("../login/session.php");
include('../login/db_connection_class.php');
$obj = new DB_Connection_Class();
$obj->connection();

$data = '';

$trf_id = $_POST['trf_id'];

$sql_for_trf = "SELECT * FROM partial_test_for_trf_info WHERE trf_id = '$trf_id'";

$res_for_trf = mysqli_query($con,$sql_for_trf) or die(mysqli_error($con));

$row_for_trf = mysqli_fetch_assoc($res_for_trf);

$data .= '
            <div class="form-group form-group-sm" id="form_group_for_pp_number">
                <label class="control-label col-sm-3" for="pp_number" style="margin-right:0px; color:#00008B;" >PP Number: <span style="color:red">*</span> </label>
                <div class="col-sm-5">
                    <input type="text" class="form-control" id="pp_number_value" name="pp_number_value" value="'.$row_for_trf['pp_number'].'" readonly>
                </div>
            </div>
    
            <div class="form-group form-group-sm" id="form-group_for_version_number">
                <label class="control-label col-sm-3" for="version_number" style="margin-right:0px; color:#00008B;">Version : <span style="color:red">*</span> </label>
                <div class="col-sm-5">
                    <input type="text" class="form-control" id="version_number_value" name="version_number_value" value="'.$row_for_trf['version_number'].'" readonly>

                </div>
                <input type="hidden" id="version_id_value" name="version_id_value" value="'.$row_for_trf['version_id'].'">
            </div> 

            <div class="form-group form-group-sm" id="form-group_for_process_name">
                <label class="control-label col-sm-3" for="process_name" style="margin-right:0px; color:#00008B;">Process Name: <span style="color:red">*</span> </label>
                <div class="col-sm-5">
                    <input type="text" class="form-control" id="process_name_value" name="process_name_value" value="'.$row_for_trf['process_name'].'" readonly>
                </div>
                <input type="hidden" class="form-control" id="process_id_value" name="process_id_value" value="'.$row_for_trf['process_id'].'" readonly>
            </div> 


            <div class="form-group form-group-sm" id="form-group_for_before_trolley_number_or_batcher_number">
                <label class="control-label col-sm-3" for="before_trolley_number_or_batcher_number" style="margin-right:0px; color:#00008B;">Before Trolley or Batcher Number: <span style="color:red">*</span> </label>
                <div class="col-sm-5">
                    <input type="text" class="form-control" id="before_trolley_number_or_batcher_number_value" name="before_trolley_number_or_batcher_number_value" value="'.$row_for_trf['before_trolley_number_or_batcher_number'].'" readonly>
                </div>
            </div> 

            <div class="form-group form-group-sm" id="form-group_for_after_trolley_number_or_batcher_number">
                <label class="control-label col-sm-3" for="after_trolley_number_or_batcher_number" style="color:#00008B;">After Trolley or Batcher Number: <span style="color:red">*</span> </label>
                <div class="col-sm-5">
                    <input type="text" class="form-control" id="after_trolley_number_or_batcher_number_value_value" name="after_trolley_number_or_batcher_number_value_value" value="'.$row_for_trf['after_trolley_number_or_batcher_number'].'" readonly>
                </div>
            </div>

            <div class="form-group form-group-sm" id="form-group_for_before_trolley_or_batcher_in_time">
                <label class="control-label col-sm-3" for="before_trolley_or_batcher_in_time" style="margin-right:0px; color:#00008B;">Before Trolley  or Batcher In Time:  </label>
                <div class="col-sm-5">
                    <input type="text" class="form-control" id="before_trolley_or_batcher_in_time_value" name="before_trolley_or_batcher_in_time_value" value="'.$row_for_trf['before_trolley_or_batcher_in_time'].'" readonly>
                </div>
            </div> 

            <div class="form-group form-group-sm" id="form-group_for_after_trolley_or_batcher_out_time">
                <label class="control-label col-sm-3" for="after_trolley_or_batcher_out_time" style="margin-right:0px; color:#00008B;">After Trolley Out Time or Batcher Out Time:  </label>
                <div class="col-sm-5">
                    <input type="text" class="form-control" id="after_trolley_or_batcher_out_time_value" name="after_trolley_or_batcher_out_time_value" value="'.$row_for_trf['after_trolley_or_batcher_out_time'].'" readonly>
                </div>
            </div> 

            <div class="form-group form-group-sm" id="form-group_for_qty">
                <label class="control-label col-sm-3" for="before_trolley_or_batcher_qty" style="color:#00008B;">Before Trolley  or Batcher Quantiy: <span style="color:red">*</span> </label>
                <div class="col-sm-5">
                    <input type="text" class="form-control" id="before_trolley_or_batcher_qty_value" name="before_trolley_or_batcher_qty_value" value="'.$row_for_trf['before_trolley_or_batcher_qty'].'" readonly>
                </div>
            </div> 

            <div class="form-group form-group-sm" id="form-group_for_qty">
                <label class="control-label col-sm-3" for="before_trolley_or_batcher_qty_label" style="color:#00008B;">After Trolley  or Batcher Quantiy: <span style="color:red">*</span> </label>
                <div class="col-sm-5">
                    <input type="text" class="form-control" id="after_trolley_or_batcher_qty_value" name="after_trolley_or_batcher_qty_value" value="'.$row_for_trf['after_trolley_or_batcher_qty'].'" readonly>
                </div>
            </div> 

            <div class="form-group form-group-sm" id="form-group_for_machine_name">
                <label class="control-label col-sm-3" for="machine_name" style="margin-right:0px; color:#00008B;">Machine:  </label>
                <div class="col-sm-5">
                    <input type="text" class="form-control" id="machine_name_value" name="machine_name_value" value="'.$row_for_trf['machine_name'].'" readonly>
                </div>
            </div> 

            <div class="form-group form-group-sm" id="form-group_for_service_type">
                <label class="control-label col-sm-3" for="service_type_value" style="margin-right:0px; color:#00008B;">Service Type: <span style="color:red">*</span> </label>
                <div class="col-sm-5">
                <input type="text" class="form-control" id="service_type_value" name="service_type_value" value="'.$row_for_trf['service_type'].'" readonly>
                </div>
            </div> 

            <div class="col-md-8 col-sm-8 col-xs-12 col-md-offset-1" >
                <label class="control-label col-sm-3" for="care_label" style="color:#00008B;">Care Label:  </label>
                <img id="washing_value" src="'.$row_for_trf['washing'].'" width="55" class="img-fluid" alt="Responsive image" >
                <input type="hidden" name="washingURL_value" id="washingURL_value" value="'.$row_for_trf['washing'].'">

                <img id="bleaching_value" src="'.$row_for_trf['bleaching'].'" width="55" class="img-fluid" alt="Responsive image" >
                <input type="hidden" name="bleachingURL_value" id="bleachingURL_value" value="'.$row_for_trf['bleaching'].'">

                <img id="ironing_value" src="'.$row_for_trf['ironing'].'" width="55" class="img-fluid" alt="Responsive image" >
                <input type="hidden" name="ironingURL_value" id="ironingURL_value" value="'.$row_for_trf['ironing'].'">

                <img id="DryCleaning_value" src="'.$row_for_trf['dry_cleaning'].'" width="55" class="img-fluid" alt="Responsive image" >
                <input type="hidden" name="DryCleaningURL_value" id="DryCleaningURL_value" value="'.$row_for_trf['dry_cleaning'].'">

                <img id="drying_value" src="'.$row_for_trf['drying'].'" width="55" class="img-fluid" alt="Responsive image" >
                <input type="hidden" name="DryingURL_value" id="DryingURL_value" value="'.$row_for_trf['drying'].'">					
            </div> ';

    echo $data;

?>