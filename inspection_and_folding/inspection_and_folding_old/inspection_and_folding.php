
<?php

error_reporting(0);
include('../login/db_connection_class.php');
$obj = new DB_Connection_Class();
$obj->connection();
/*$sql_for_process="SELECT * FROM `process_name`";
$result_for_process=mysqli_query($con,$sql_for_process) or  die(mysqli_error());
$row_for_result=mysqli_fetch_assoc($result_for_process);*/


$date = new DateTime('now', new DateTimeZone('Asia/Dhaka'));

?>


</head>
<body>





<script>

var get_trf_data="";
var get_all_data="";

  var d = new Date();
  var ye = new Intl.DateTimeFormat('en', { year: 'numeric' }).format(d);
  var mo = new Intl.DateTimeFormat('en', { month: '2-digit' }).format(d);
  var da = new Intl.DateTimeFormat('en', { day: '2-digit' }).format(d);

function get_all_value_for_trf(trf_id)
{
   var value_for_data= 'trf_id_value='+trf_id;
   get_all_data=trf_id;

   get_trf_data += "?fs?partial_test_for_trf_info";


          $.ajax({
          url: 'test_result/returning_value_from_partial_test_trf.php',
          dataType: 'text',
          type: 'post',
          contentType: 'application/x-www-form-urlencoded',
          data: value_for_data,
                
          success: function( data, textStatus, jQxhr )
          {       
                

                         

             /*  alert(data);*/
             

              /* get_trf_data=data;*/

              var splitted_version_details= data.split('?fs?');
              
              // alert(data);

              document.getElementById('version_id').value=splitted_version_details[23];
             
              var value_for_process_name= 'process_id_value='+splitted_version_details[27];

                            $.ajax({
                          url: 'test_result/returning_process_id_name_details.php',
                          dataType: 'text',
                          type: 'post',
                          contentType: 'application/x-www-form-urlencoded',
                          data: value_for_process_name,
                                
                          success: function( data, textStatus, jQxhr )
                          {       


                            document.getElementById('process_name').innerHTML=data;



                          },
                          error: function( jqXhr, textStatus, errorThrown )
                          {       
                            
                              alert(errorThrown);
                          }
                      }); // End of $.ajax({   
        
              

              /*alert(document.getElementById('process_name').value=splitted_version_details[18]);*/
              document.getElementById('pp_number').value=splitted_version_details[1];
              document.getElementById('version_number').value=splitted_version_details[2];
              document.getElementById('design').value=splitted_version_details[3]; 
              document.getElementById('customer_name').value=splitted_version_details[5];

              document.getElementById('customer_id').value=splitted_version_details[22]; 
              document.getElementById('before_trolley_number_or_batcher_number').value=splitted_version_details[8]; 
              document.getElementById('after_trolley_number_or_batcher_number').value=splitted_version_details[9]; 
                        
              
          },
          error: function( jqXhr, textStatus, errorThrown )
          {       
              //console.log( errorThrown );
              alert(errorThrown);
          }
      }); // End of $.ajax({
}  /* end of function get_all_value_for_trf()*/




function returning_version_details(pp_number)
{
    var value_for_data= 'pp_number_value='+pp_number;
            $.ajax({
          url: 'report/returning_version_number_details.php',
          dataType: 'text',
          type: 'post',
          contentType: 'application/x-www-form-urlencoded',
          data: value_for_data,
                
          success: function( data, textStatus, jQxhr )
          {       
                
              document.getElementById('version_number').innerHTML=data;
              
             
          },
          error: function( jqXhr, textStatus, errorThrown )
          {       
              //console.log( errorThrown );
              alert(errorThrown);
          }
      }); // End of $.ajax({
}   /*End of function returning_version_details(pp_number)*/


function returning_all_details(version_details)
{  

  var splitted_version_details= version_details.split('?fs?');

  document.getElementById('version_id').value=splitted_version_details[8];
  document.getElementById('design').value=splitted_version_details[1];
  document.getElementById('customer_name').value=splitted_version_details[3]; 
  document.getElementById('customer_id').value=splitted_version_details[7];

  document.getElementById('style_name').value=splitted_version_details[9];
  document.getElementById('finish_width_in_inch').value=splitted_version_details[10];


  var version_id='version_id='+splitted_version_details[8];

  $.ajax({
          url: 'report/returning_all_for_process_name.php',
          dataType: 'text',
          type: 'post',
          contentType: 'application/x-www-form-urlencoded',
          data: version_id ,
                
          success: function( data, textStatus, jQxhr )
          {       
                
              
              document.getElementById('process_name').innerHTML=data;
              
         
              
          },
          error: function( jqXhr, textStatus, errorThrown )
          {       
              //console.log( errorThrown );
              alert(errorThrown);
          }
      }); // End of $.ajax({


}/* End of function fill_up_qc_standard_additional_info(version_details)*/



function returning_trolley_info(process_name)
{  var pp_number=document.getElementById('pp_number').value;
   var version_id=document.getElementById('version_id').value;
   var process_name=document.getElementById('process_name').value;
   var style_name=document.getElementById('style_name').value;
   var finish_width_in_inch=document.getElementById('finish_width_in_inch').value;
   
   var data_for_split_process=process_name.split("?fs?");
   
   var process_id=data_for_split_process[0];

   var value_for_data= 'process_name_value='+process_id+'?fs?'+version_id+'?fs?'+pp_number+'?fs?';
   
   get_all_data='?fs?'+version_id+'?fs?'+pp_number+'?fs?'+process_id+'?fs?'+style_name+'?fs?'+finish_width_in_inch;


            $.ajax({
          url: 'report/returning_trolley_name_for_partial_test.php',
          dataType: 'text',
          type: 'post',
          contentType: 'application/x-www-form-urlencoded',
          data: value_for_data,
                
          success: function( data, textStatus, jQxhr )
          {       
                
              /*alert(data);*/
              var data_for_split=data.split("?fs?");
              
             
              document.getElementById('after_trolley_number_or_batcher_number').value=data_for_split[2];

                 $.ajax({
                  url: 'report/returning_process_name_details_for_partial_test.php',
                  dataType: 'text',
                  type: 'post',
                  contentType: 'application/x-www-form-urlencoded',
                  data: value_for_data,
                        
                  success: function( data, textStatus, jQxhr )
                  {       
                      
                      document.getElementById('before_trolley_number_or_batcher_number').innerHTML=data;
                      
                  },
                  error: function( jqXhr, textStatus, errorThrown )
                  {       
                      //console.log( errorThrown );
                      alert(errorThrown);
                  }
              }); // End of $.ajax({


              
          },
          error: function( jqXhr, textStatus, errorThrown )
          {       
              //console.log( errorThrown );
              alert(errorThrown);
          }
      }); // End of $.ajax({

}

function get_before_trolley_value(before_trolley_number_or_batcher_number)
{
   var pp_number=document.getElementById('pp_number').value;
   var version_id=document.getElementById('version_id').value;
   var process_name=document.getElementById('process_name').value;
   var style_name=document.getElementById('style_name').value;
   var finish_width_in_inch=document.getElementById('finish_width_in_inch').value;
   var before_trolley_number_or_batcher_number= before_trolley_number_or_batcher_number;
   
   var data_for_split_process=process_name.split("?fs?");
   
   var process_id=data_for_split_process[0];
   
   get_all_data='?fs?'+version_id+'?fs?'+pp_number+'?fs?'+process_id+'?fs?'+style_name+'?fs?'+finish_width_in_inch+"?fs?"+before_trolley_number_or_batcher_number;

   var value_for_data= 'process_name_value='+process_id+'?fs?'+version_id+'?fs?'+pp_number+'?fs?'+before_trolley_number_or_batcher_number+"?fs?";

    $.ajax({
                  url: 'report/returning_after_trolley_details_for_partial_and_all_test.php',
                  dataType: 'text',
                  type: 'post',
                  contentType: 'application/x-www-form-urlencoded',
                  data: value_for_data,
                        
                  success: function( data, textStatus, jQxhr )
                  {       
                      /*alert(data);*/
                      document.getElementById('after_trolley_number_or_batcher_number').value=data;


                      var pp_number=document.getElementById('pp_number').value;
                     var version_id=document.getElementById('version_id').value;
                     var process_name=document.getElementById('process_name').value;
                     var style_name=document.getElementById('style_name').value;
                     var finish_width_in_inch=document.getElementById('finish_width_in_inch').value;
                     var before_trolley_number_or_batcher_number=document.getElementById('before_trolley_number_or_batcher_number').value;
                     var after_trolley_number_or_batcher_number=data;
                     
                     var data_for_split_process=process_name.split("?fs?");
                     
                     var process_id=data_for_split_process[0];
                  
                     
                     get_all_data='?fs?'+version_id+'?fs?'+pp_number+'?fs?'+process_id+'?fs?'+style_name+'?fs?'+finish_width_in_inch+"?fs?"+before_trolley_number_or_batcher_number+"?fs?"+after_trolley_number_or_batcher_number;
                      
                  },
                  error: function( jqXhr, textStatus, errorThrown )
                  {       
                      //console.log( errorThrown );
                      alert(errorThrown);
                  }
              }); // End of $.ajax({

}  
function change_trolley_info(after_trolley_number_or_batcher_number)
{
               var pp_number=document.getElementById('pp_number').value;
               var version_id=document.getElementById('version_id').value;
               var process_name=document.getElementById('process_name').value;
               var style_name=document.getElementById('style_name').value;
               var finish_width_in_inch=document.getElementById('finish_width_in_inch').value;
               var before_trolley_number_or_batcher_number=document.getElementById('before_trolley_number_or_batcher_number').value;
               var after_trolley_number_or_batcher_number=after_trolley_number_or_batcher_number;
               
               var data_for_split_process=process_name.split("?fs?");
               
               var process_id=data_for_split_process[0];
               
               get_all_data='?fs?'+version_id+'?fs?'+pp_number+'?fs?'+process_id+'?fs?'+style_name+'?fs?'+finish_width_in_inch+"?fs?"+before_trolley_number_or_batcher_number+"?fs?"+after_trolley_number_or_batcher_number;
}


  function sending_data_from_database()
 {

    // alert(get_all_data);

   
    $('#inspection_and_folding').load('inspection_and_folding/inspection_and_folding_info.php?all_data='+encodeURIComponent(get_all_data));

    

 }//End of function sending_data_of_partial_test_for_test_result_form_for_saving_in_database()


  /***************************************************** FOR AUTO COMPLETE********************************************************************/

$(document).ready(function() {
$('.for_auto_complete').chosen();

 } );


/***************************************************** FOR AUTO COMPLETE********************************************************************/

</script>


<div id="inspection_and_folding">
  


    <div class="col-sm-12 col-md-12 col-lg-12" id="panel_load_for_full_form_for_inspection_and_folding">
        <div class="panel panel-default" >
             <div class="panel-heading" style="color:#191970;"><b>Inspection and folding overview</b></div> <!-- This will create a upper block for FORM (Just Beautification) -->
                       
                         <br>
                          
                    
             <form id='inspection_and_folding_overview_form' name='inspection_and_folding_overview_form'  action="" method="post" enctype="multipart/form-data" class="form-horizontal form-label-left">
                

              <div class="form-group form-group-sm" id="form-group_for_inspection_and_folding_overview_form">
                <label class="control-label col-sm-3" for="inspection_and_folding_overview_form" style="display: none;">Date: <span style="color:red">*</span> </label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" id="inspection_and_folding_overview_date" name="inspection_and_folding_overview_date" placeholder="Please Provide Date" required style="display: none;">
                </div>               
                
              </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_pp_creation_date"> -->


                

                 <div class="form-group form-group-sm" id="form-group_for_trf_no">
                        <label class="control-label col-sm-3" for="trf_id" style="margin-right:0px; color:#00008B;">TRF No.:</label>
                            <div class="col-sm-5">
                                <select  class="form-control for_auto_complete" id="trf_id" name="trf_id"  onchange="get_all_value_for_trf(this.value)">
                                            <option select="selected" value="">Select TRF No</option>
                                            <?php 
                                                 $sql = 'select * from `partial_test_for_trf_info`';
                                                 $result= mysqli_query($con,$sql) or die(mysqli_error());
                                                 while( $row = mysqli_fetch_array( $result))
                                                 {

                                                     $trf_id=$row['trf_id'];
                                                     $split_trf_data=explode('_', $trf_id);
                                                     $data_for_at=$split_trf_data[1];
                                                    
                                                    
                                                    //  if($data_for_at=='PT')
                                                    //  {
                                                     echo '<option value="'.$row['trf_id'].'">'.$row['trf_id'].'</option>';
                                                    //  }

                                                 }

                                             ?>
                                </select>
                            </div>
              </div>  

            <div class="form-group form-group-sm" id="form-group_for_pp_number">
            <label class="control-label col-sm-3" for="pp_number" style="margin-right:0px; color:#00008B;" >PP Number: <span style="color:red">*</span> </label>
              <div class="col-sm-5">
                <select  class="form-control " id="pp_number" name="pp_number" onchange="returning_version_details(this.value)">
                      <option select="selected" value="select">Select PP Number</option>
                      <?php 
                         $sql = 'select DISTINCT pp_number from `process_program_info` order by `pp_number`';
                         $result= mysqli_query($con,$sql) or die(mysqli_error());
                         while( $row = mysqli_fetch_array( $result))
                         {

                           echo '<option value="'.$row['pp_number'].'">'.$row['pp_number'].'</option>';

                         }

                       ?>
                </select>
              </div>
          </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_pp_number"> -->

            <div class="form-group form-group-sm" id="form-group_for_version_number">
            <label class="control-label col-sm-3" for="version_number" style="margin-right:0px; color:#00008B;">Version : <span style="color:red">*</span> </label>
              <div class="col-sm-5">
                <select  class="form-control" id="version_number" name="version_number" onchange="returning_all_details(this.value)">
                      <option select="selected" value="select">Select Version Number</option>
                      <?php 
                         $sql = 'select DISTINCT version_name from `pp_wise_version_creation_info` order by `version_name`';
                         $result= mysqli_query($con,$sql) or die(mysqli_error());
                         while( $row = mysqli_fetch_array( $result))
                         {

                           echo '<option value="'.$row['version_name'].'">'.$row['version_name'].'</option>';

                         }

                       ?>
                </select>
              </div>
            </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_version_number"> -->


             <input type="hidden" class="form-control" id="version_id" name="version_id" value="">


               <div class="form-group form-group-sm" id="form-group_for_customer_name">
                                <label class="control-label col-sm-3" for="customer_name" style="color:#00008B;"> Customer Name: <span style="color:red">*</span> </label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" id="customer_name" name="customer_name" placeholder="Enter customer name" required>

                                    <input type="hidden" class="form-control" id="customer_id" name="customer_id" value="">
                                </div>
                                <i class="glyphicon glyphicon-remove" onclick="Remove_Value_Of_This_Element('customer_name')"></i>
             </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_customer_name"> -->

              <input type="hidden" class="form-control" id="finish_width_in_inch" name="finish_width_in_inch" value="">
              <input type="hidden" class="form-control" id="color" name="color" value="">
              <input type="hidden" class="form-control" id="style_name" name="style_name" value="">


            <div class="form-group form-group-sm" id="form-group_for_design">
                <label class="control-label col-sm-3" for="design" style="color:#00008B;">Design:</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" id="design" name="design" placeholder="Enter Design" required>
            </div>
                <i class="glyphicon glyphicon-remove" onclick="Remove_Value_Of_This_Element('design')"></i>
            </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_design"> -->


          <div class="form-group form-group-sm" id="form-group_for_process_name">
                        <label class="control-label col-sm-3" for="process_name" style="margin-right:0px; color:#00008B;">Process Name: <span style="color:red">*</span> </label>
                            <div class="col-sm-5">
                                <select  class="form-control" id="process_name" name="process_name" onchange="returning_trolley_info(this.value)">
                                            <option select="selected" value="select">Select Process Name</option>
                                            <?php 
                                                 $sql = 'select process_name from `process_name`';
                                                 $result= mysqli_query($con,$sql) or die(mysqli_error());
                                                 while( $row = mysqli_fetch_array( $result))
                                                 {

                                                     echo '<option value="'.$row['process_name'].'">'.$row['process_name'].'</option>';

                                                 }

                                             ?>
                                </select>
                            </div>
          </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_process_name"> -->
    <!-- onchange="Fill_Value_Of_Version_Number_Field(this.value)"  -->




               <div class="form-group form-group-sm" id="form-group_for_before_trolley_number_or_batcher_number">
                        <label class="control-label col-sm-3" for="before_trolley_number_or_batcher_number" style="margin-right:0px; color:#00008B;">Before Trolley Number or Batcher Number: <span style="color:red">*</span> </label>
                            <div class="col-sm-5">
                                <select  class="form-control" id="before_trolley_number_or_batcher_number" name="before_trolley_number_or_batcher_number" onchange="get_before_trolley_value(this.value)" >
                                          
                                 <option select="selected" value="select">Select before trolley number or batcher number</option>
                                            <?php 
                                                 $sql = 'select distinct * from `trolley`';
                                                 $result= mysqli_query($con,$sql) or die(mysqli_error());
                                                 while( $row = mysqli_fetch_array( $result))
                                                 {

                                                     echo '<option value="'.$row['trolley_no'].'">'.$row['trolley_no'].'</option>';

                                                 }

                                             ?>
                                </select>
                            </div>
              </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_before_trolley_number_or_batcher_number"> -->

                

                <div class="form-group form-group-sm" id="form-group_for_after_trolley_number_or_batcher_number">
                                <label class="control-label col-sm-3" for="after_trolley_number_or_batcher_number" style="color:#00008B;">After Trolley Number or Batcher Number: <span style="color:red">*</span> </label>
                                <div class="col-sm-5">
                                    <!-- <input type="text" class="form-control" id="after_trolley_number_or_batcher_number" name="after_trolley_number_or_batcher_number" placeholder="Enter after trolley number or batcher number" required> -->
                              <select  class="form-control" id="after_trolley_number_or_batcher_number" name="after_trolley_number_or_batcher_number" onchange="change_trolley_info(this.value)">
                                          
                                 <option select="selected" value="">Select After trolley number or batcher number</option>
                                            <?php 
                                                 $sql = 'select distinct * from `trolley`';
                                                 $result= mysqli_query($con,$sql) or die(mysqli_error());
                                                 while( $row = mysqli_fetch_array( $result))
                                                 {

                                                     echo '<option value="'.$row['trolley_no'].'">'.$row['trolley_no'].'</option>';

                                                 }

                                             ?>
                                </select>
                                </div>
                                <i class="glyphicon glyphicon-remove" onclick="Remove_Value_Of_This_Element('after_trolley_number_or_batcher_number')"></i>
                  </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_after_trolley_number_or_batcher_number"> -->

                   <div class="form-group">
                

                            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                             

                              <button type="button" name="trf_pass_fail_form" id="trf_pass_fail_form" class="btn btn-primary"  onclick="sending_data_from_database()">Search</button>
                              <button type="reset" name="reset" id="reset" class="btn btn-success">Reset</button>

                              <!-- <button type="button" name="submit" id="submit" class="btn btn-success" data-toggle="modal" data-target="#Showpartial_test_for_test_result">show </button> -->
                              
                            </div>
                     </div> <!--  End of <div class="form-group"> -->
                 </form>
                
          </div>  <!--  end of <div class="panel panel-default"> -->


    </div>

</div>
