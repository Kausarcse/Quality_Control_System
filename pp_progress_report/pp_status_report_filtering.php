
<?php

error_reporting(0);
include('../login/db_connection_class.php');
$obj = new DB_Connection_Class();
$obj->connection();
/*$sql_for_process="SELECT * FROM `process_name`";
$result_for_process=mysqli_query($con,$sql_for_process) or  die(mysqli_error($con));
$row_for_result=mysqli_fetch_assoc($result_for_process);*/


$date = new DateTime('now', new DateTimeZone('Asia/Dhaka'));

?>


</head>
<body class="nav-md">





<script>

var get_trf_data="";
var get_all_data="";




function get_pp(pp_number)
{
  get_all_data=pp_number;
}

 function sending_data_from_database()
 {

   
    //  alert(get_all_data);
   
     $('#panel_load_for_full_form').load('pp_progress_report/pp_status_report.php?all_data='+encodeURIComponent(get_all_data));
   
    //$('#partial_test_for_test_result_form').load("report/pass_fail_report.php?trf="+get_all_data);
    
     




 }//End of function sending_data_of_partial_test_for_test_result_form_for_saving_in_database()


 /***************************************************** FOR AUTO COMPLETE********************************************************************/

$('.for_auto_complete').chosen();


/***************************************************** FOR AUTO COMPLETE********************************************************************/

</script>

    <div class="col-sm-12 col-md-12 col-lg-12">

      <div class="panel panel-default" id="panel_load_for_full_form">
              <div class="panel-heading" style="color:#191970;">
                <b>PP Status Report</b>
              </div> <!-- This will create a upper block for FORM (Just Beautification) -->
                       
                         <br>
                          
           <div id="full_form">         
             <form name='pp_status_filtering' id="pp_status_filtering"  action="" method="post" enctype="multipart/form-data" class="form-horizontal form-label-left">
                
             <div class="form-group form-group-sm" id="form-group_for_partial_test_for_test_result_creation_date">
                <label class="control-label col-sm-3" for="pp_creation_date" style="display: none;">Date: <span style="color:red">*</span> </label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" id="partial_test_for_test_result_creation_date" name="partial_test_for_test_result_creation_date" placeholder="Please Provide Date" required style="display: none;">
                </div>               
                
              </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_pp_creation_date"> -->

            <div class="form-group form-group-sm" id="form-group_for_pp_number">
            <label class="control-label col-sm-3" for="pp_number" style="margin-right:0px; color:#00008B;" >PP Number: <span style="color:red">*</span> </label>
              <div class="col-sm-5">
                <select  class="form-control for_auto_complete" id="pp_number" name="pp_number" onchange="get_pp(this.value)">
                      <option select="selected" value="select">Select PP Number</option>
                      <?php 
                         $sql = 'select DISTINCT pp_number from `process_program_info` order by `pp_number`';
                         $result= mysqli_query($con,$sql) or die(mysqli_error($con));
                         while( $row = mysqli_fetch_array( $result))
                         {

                           echo '<option value="'.$row['pp_number'].'">'.$row['pp_number'].'</option>';

                         }

                       ?>
                </select>
              </div>
          </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_pp_number"> -->

          


                   <div class="form-group">
                

                            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                             

                              <button type="submit" name="trf_pass_fail_form" id="trf_pass_fail_form" class="btn btn-primary"  onclick="sending_data_from_database()">Search</button>
                              <button type="reset" name="reset" id="reset" class="btn btn-success">Reset</button>

                              <!-- <button type="button" name="submit" id="submit" class="btn btn-success" data-toggle="modal" data-target="#Showpartial_test_for_test_result">show </button> -->
                              
                            </div>
                     </div> <!--  End of <div class="form-group"> -->


                 </form>
            </div> <!-- end of <div id="full_form"> -->
                
          </div>  <!--  end of <div class="panel panel-default"> -->


    </div>
