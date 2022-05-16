<!DOCTYPE html>
<html lang="en">
<?php

error_reporting(0);
/*require_once("../login/session.php");
include('db_connection_class.php');
$obj = new DB_Connection_Class();
$obj->connection();
*/

include('../login/db_connection_class.php');
$obj = new DB_Connection_Class();
$obj->connection();
/*$sql_for_process="SELECT * FROM `process_name`";
$result_for_process=mysqli_query($con,$sql_for_process) or  die(mysqli_error($con));
$row_for_result=mysqli_fetch_assoc($result_for_process);*/


$t=time();


$date = new DateTime('now', new DateTimeZone('Asia/Dhaka'));


$trf_id=$_GET['trf_id'];
$sql_for_partial_test_for_trf="select * from partial_test_for_trf_info where `trf_id`='$trf_id'";
$result_for_partial_test_for_trf= mysqli_query($con,$sql_for_partial_test_for_trf) or die(mysqli_error($con));
$row_for_partial_test_for_trf = mysqli_fetch_array( $result_for_partial_test_for_trf);

?>

<script type='text/javascript' src='trf/partial_test_for_trf_info_form_validation.js'></script>

</head>
<body class="nav-md">



<?php
require_once('pop_up_washing.php');
?>
<?php
require_once('pop_up_bleaching.php');
?>

<?php
require_once('pop_up_dry_cleaning.php');
?>



<?php
require_once('pop_up_iron.php');
?>


<?php
require_once('pop_up_drying.php');
?>


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

function Reset_Checkbox(checkbox_element)
{
    for(var i=0;i<checkbox_element.length;i++)
    {

        checkbox_element[i].checked = false;

    }
}
</script>

<script>

    

    $('#ironingID1').click(function()
      {
    
    
  

        var selectedOption = $("input:radio[name=option]:checked").val()
     //<img  src="img/blenching3.png" width="55" class="img-fluid" alt="Responsive image" >
  
        if (selectedOption ==="ironing1") {
            $("#ironing").attr("src", "img/ironing/ironing1.png");
            
        } 
        else if (selectedOption ==="ironing2") {
                $("#ironing").attr("src", "img/ironing/ironing2.png");
                
            } 

         else if (selectedOption ==="ironing3") {
            $("#ironing").attr("src", "img/ironing/ironing3.png");
            
        } 
          else if (selectedOption ==="ironing4") {
            $("#ironing").attr("src", "img/ironing/ironing4.png");
            
        } 

          else if (selectedOption ==="ironing5") {
            $("#ironing").attr("src", "img/ironing/ironing5.png");
            
        } 
          
    

       });


   $('#DryCleaningID1').click(function()
      {

    

        var selectedOption = $("input:radio[name=option]:checked").val()
     //<img  src="img/blenching3.png" width="55" class="img-fluid" alt="Responsive image" >
  
        if (selectedOption ==="DryCleaning1") {
            $("#DryCleaning").attr("src", "img/DryCleaning/DryCleaning1.png");
            
        } 
        else if (selectedOption ==="DryCleaning2") {
                $("#DryCleaning").attr("src", "img/DryCleaning/DryCleaning2.png");
                
            }       
          
    

       });



    $('#bleachingID1').click(function()
      {

    

        var selectedOption = $("input:radio[name=option]:checked").val()
     //<img  src="img/blenching3.png" width="55" class="img-fluid" alt="Responsive image" >
  
        if (selectedOption ==="bleaching1") {
            $("#bleaching").attr("src", "img/bleaching/bleaching1.png");
            
        } 
        else if (selectedOption ==="bleaching2") {
                $("#bleaching").attr("src", "img/bleaching/bleaching2.png");
                
            }   
        else if (selectedOption ==="bleaching3") {
                $("#bleaching").attr("src", "img/bleaching/bleaching3.png");
                
            }   
        else if (selectedOption ==="bleaching4") {
                $("#bleaching").attr("src", "img/bleaching/bleaching4.png");
                
            }  
        else if (selectedOption ==="bleaching5") {
                $("#bleaching").attr("src", "img/bleaching/bleaching5.png");
                
            }    
          
    

       });
    
    


  $('#WashingID1').click(function()
      {

        var selectedOption = $("input:radio[name=option]:checked").val()
     //<img  src="img/blenching3.png" width="55" class="img-fluid" alt="Responsive image" >
  
        if (selectedOption ==="washing1") {
            $("#washing").attr("src", "img/washing/washing1.png");
            
        } 
        else if (selectedOption ==="washing2") {
                $("#washing").attr("src", "img/washing/washing2.png");
                
            } 

         else if (selectedOption ==="washing3") {
            $("#washing").attr("src", "img/washing/washing3.png");
            
        } 
          else if (selectedOption ==="washing4") {
            $("#washing").attr("src", "img/washing/washing4.png");
            
        } 

          else if (selectedOption ==="washing5") {
            $("#washing").attr("src", "img/washing/washing5.png");
            
        } 
          else if (selectedOption ==="washing6") {
            $("#washing").attr("src", "img/washing/washing6.png");
            
        } 
          else if (selectedOption ==="washing7") {
            $("#washing").attr("src", "img/washing/washing7.png");
            
        } 
          else if (selectedOption ==="washing8") {
            $("#washing").attr("src", "img/washing/washing8.png");
            
        } 
          else if (selectedOption ==="washing9") {
            $("#washing").attr("src", "img/washing/washing9.png");
            
        } 
          else if (selectedOption ==="washing10") {
            $("#washing").attr("src", "img/washing/washing10.png");
            
        } 
          else if (selectedOption ==="washing11") {
            $("#washing").attr("src", "img/washing/washing11.png");
            
        } 
          else if (selectedOption ==="washing12") {
            $("#washing").attr("src", "img/washing/washing12.png");
            
        } 
          else if (selectedOption ==="washing13") {
            $("#washing").attr("src", "img/washing/washing13.png");
            
        } 
          else if (selectedOption ==="washing14") {
            $("#washing").attr("src", "img/washing/washing14.png");
            
        } 
          else if (selectedOption ==="washing15") {
            $("#washing").attr("src", "img/washing/washing15.png");
            
        } 


  
    

       });
    

    


  $('#DryingID1').click(function()
      {


        var selectedOption = $("input:radio[name=option]:checked").val()
     //<img  src="img/blenching3.png" width="55" class="img-fluid" alt="Responsive image" >
  
        if (selectedOption ==="drying1") {
            $("#drying").attr("src", "img/Drying/Drying1.png");
            
        } 
        else if (selectedOption ==="drying2") {
                $("#drying").attr("src", "img/Drying/Drying2.png");
                
            } 

         else if (selectedOption ==="drying3") {
            $("#drying").attr("src", "img/Drying/Drying3.png");
            
        } 
          else if (selectedOption ==="drying4") {
            $("#drying").attr("src", "img/Drying/Drying4.png");
            
        } 

          else if (selectedOption ==="drying5") {
            $("#drying").attr("src", "img/Drying/Drying5.png");
            
        } 
          else if (selectedOption ==="drying6") {
            $("#drying").attr("src", "img/Drying/Drying6.png");
            
        } 
          else if (selectedOption ==="drying7") {
            $("#drying").attr("src", "img/Drying/Drying7.png");
            
        } 
          else if (selectedOption ==="drying8") {
            $("#drying").attr("src", "img/Drying/Drying8.png");
            
        } 
          else if (selectedOption ==="drying9") {
            $("#drying").attr("src", "img/Drying/Drying9.png");
            
        } 

        else if (selectedOption ==="drying10") {
            $("#drying").attr("src", "img/Drying/Drying10.png");
            
        } 

         else if (selectedOption ==="drying11") {
            $("#drying").attr("src", "img/Drying/Drying11.png");
            
        } 
        else if (selectedOption ==="drying12") {
            $("#drying").attr("src", "img/Drying/Drying12.png");
            
        } 

       
    

       });
    
    
  

  
    
    
</script>


<script>

function b_t_b_span_show()
{
  document.getElementById("b_t_b").style.display="block";
  
}

function b_t_b_span_hide()
{
  document.getElementById("b_t_b").style.display="none";
  
}

  function Fill_Value_Of_Version_Number_Field(pp_number)
{
    var value_for_data= 'pp_number_value='+pp_number;
            $.ajax({
          url: 'trf/returning_version_number_details.php',
          dataType: 'text',
          type: 'post',
          contentType: 'application/x-www-form-urlencoded',
          data: value_for_data,
                
          success: function( data, textStatus, jQxhr )
          {       
                

              
              document.getElementById('version_number').innerHTML=data;
              
              
              //document.getElementById('test').innerHTML=data;
              
          },
          error: function( jqXhr, textStatus, errorThrown )
          {       
              //console.log( errorThrown );
              alert(errorThrown);
          }
      }); // End of $.ajax({
}   /*End of function Fill_Value_Of_Version_Number_Field(pp_number)*/

function fill_up_qc_standard_additional_info(version_details)
{  

  var splitted_version_details= version_details.split('?fs?');

 document.getElementById('version_id').value=splitted_version_details[8];
 document.getElementById('design').value=splitted_version_details[1];
  document.getElementById('week_in_year').value=splitted_version_details[2]; 
  document.getElementById('customer_name').value=splitted_version_details[3]; 
  document.getElementById('customer_id').value=splitted_version_details[7];
  document.getElementById('style').value=splitted_version_details[9];
  document.getElementById('finish_width_in_inch').value=splitted_version_details[10];
  document.getElementById('fiber_composition').value='Cotton:'+splitted_version_details[4].concat(' Polyester:',splitted_version_details[5],' Other:',splitted_version_details[6]); 


  var version_id='version_id='+splitted_version_details[8];

  $.ajax({
          url: 'trf/returning_all_for_process_name.php',
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


 /* document.getElementById('fiber_composition').value='Cotton:'+splitted_version_details[4].'Polyester:'+splitted_version_details[5]'Other:'+splitted_version_details[6]; */
  /*document.getElementById('customer_name_name').value=splitted_version_details[3]; 
  document.getElementById('customer_name_name').value=splitted_version_details[3]; 
  document.getElementById('customer_name_name').value=splitted_version_details[3]; */
  
}/* End of function fill_up_qc_standard_additional_info(version_details)*/



function return_machine_name(process_name)
{  var version_id=document.getElementById('version_id').value;/*
   var split_process_name=process_name.split('?fs?');
   var process_id=split_process_name[0];*/
  
   var value_for_trolley_data= 'version_and_process='+version_id+'?fs?'+process_name+'?fs?';
   var value_for_data= 'process_name_value='+process_name+'?fs?'+version_id;
   
  

            $.ajax({
          url: 'trf/returning_process_name_details_for_partial_test.php',
          dataType: 'text',
          type: 'post',
          contentType: 'application/x-www-form-urlencoded',
          data: value_for_trolley_data,
                
          success: function( data, textStatus, jQxhr )
          {       
            
              
              var data_for_split=data.split("?fs?");
              
              /*document.getElementById('before_trolley_or_batcher_qty').value=data_for_split[1];
              document.getElementById('before_trolley_number_or_batcher_number').value=data_for_split[2];*/
              document.getElementById('before_trolley_number_or_batcher_number').innerHTML=data;

              $.ajax({
                url: 'trf/returning_machine_name.php',
                dataType: 'text',
                type: 'post',
                contentType: 'application/x-www-form-urlencoded',
                data: value_for_data,
                      
                success: function( data, textStatus, jQxhr )
                {       
                      
                    

                    document.getElementById('machine_name').innerHTML=data;
                    
                    
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




function return_trolley_quantity(before_trolley_number_or_batcher_number)
{

  var version_id=document.getElementById('version_id').value;
  var process_name=document.getElementById('process_name').value;
 
  /*
   var split_process_name=process_name.split('?fs?');
   var process_id=split_process_name[0];*/
  
  var value_for_trolley_data= 'version_and_process='+version_id+'?fs?'+before_trolley_number_or_batcher_number+'?fs?'+process_name;
   //var value_for_data= 'process_name_value='+process_id+'?fs?'+version_id;
   
  

            $.ajax({
          url: 'trf/returning_before_quantity_details_for_partial_test.php',
          dataType: 'text',
          type: 'post',
          contentType: 'application/x-www-form-urlencoded',
          data: value_for_trolley_data,
                
          success: function( data, textStatus, jQxhr )
          {       
              
              document.getElementById('before_trolley_or_batcher_qty').value=data;
             

              
          },
          error: function( jqXhr, textStatus, errorThrown )
          {       
              //console.log( errorThrown );
              alert(errorThrown);
          }
      }); // End of $.ajax({
}


 function sending_data_of_partial_test_for_trf_form_for_saving_in_database()
 {

    document.getElementById("bleachingURL").value=document.getElementById("bleaching").src;
    document.getElementById("washingURL").value=document.getElementById("washing").src;
    document.getElementById("ironingURL").value=document.getElementById("ironing").src;
    document.getElementById("DryCleaningURL").value=document.getElementById("DryCleaning").src;
    document.getElementById("DryingURL").value=document.getElementById("drying").src;

       var validate = partial_test_for_trf_Form_Validation();
       var url_encoded_form_data = $("#partial_test_for_trf_form").serialize(); //This will read all control elements value of the form 
      /* if(validate != false)
     {
*/

         $.ajax({
          url: 'trf/edit_all_test_for_trf_info_saving.php',
          dataType: 'text',
          type: 'post',
          contentType: 'application/x-www-form-urlencoded',
          data: url_encoded_form_data,
          success: function( data, textStatus, jQxhr )
          {
              alert(data);
              

              
          },
          error: function( jqXhr, textStatus, errorThrown )
          {
              //console.log( errorThrown );
              alert(errorThrown);
          }
       }); // End of $.ajax({

       /*}*///End of if(validate != false)

 }//End of function sending_data_of_partial_test_for_trf_form_for_saving_in_database() trf_id


 function sending_data_for_delete(trf_id)
 {
      
       var url_encoded_form_data = 'trf_id='+trf_id;
       
         $.ajax({
          url: 'trf/deleting_partial_test_for_trf_info.php',
          dataType: 'text',
          type: 'post',
          contentType: 'application/x-www-form-urlencoded',
          data: url_encoded_form_data,
          success: function( data, textStatus, jQxhr )
          {
              alert(data);

          },
          error: function( jqXhr, textStatus, errorThrown )
          {
              //console.log( errorThrown );
              alert(errorThrown);
          }
       }); // End of $.ajax({



 }//End of function sending_data_for_delete()


</script>

    <div class="col-sm-12 col-md-12 col-lg-12">
       <div class="panel panel-default">

         <div class="panel-heading" style="color:#00008B;"><b>Edit Test Request Form (Partial Test For Trf)</b></div> <!-- This will create a upper block for FORM (Just Beautification) -->
                       
                         <br>
                          
                    
            <form id='partial_test_for_trf_form' name='partial_test_for_trf_form'  action="" method="post" enctype="multipart/form-data" class="form-horizontal form-label-left" style="margin-bottom: 20px;">

              <div class="form-group form-group-sm" id="form-group_for_partial_test_for_trf_creation_date">
                <label class="control-label col-sm-3" for="pp_creation_date" style="color:#00008B;">Date: <span style="color:red">*</span> </label>
                <div class="col-sm-2">
                  <input type="text" class="form-control" id="partial_test_for_trf_creation_date" name="partial_test_for_trf_creation_date" value="<?php echo $row_for_partial_test_for_trf['partial_test_for_trf_creation_date']?>" readonly />
                </div>
                <div class="col-sm-3">
                  <input type="text" class="form-control" id="alternate_partial_test_for_trf_creation_date_time" name="alternate_partial_test_for_trf_creation_date_time"  value="<?php echo $row_for_partial_test_for_trf['alternate_partial_test_for_trf_creation_date_time']?>" readonly >
                </div>
                <i class="glyphicon glyphicon-remove" onclick="Remove_Value_Of_This_Element('partial_test_for_trf_creation_date')"></i>
             </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_pp_creation_date"> -->
                      

                    <div class="form-group form-group-sm" id="form-group_for_employee_name">
                        <label class="control-label col-sm-3" for="employee_name" style="margin-right:0px; color:#00008B;">Employee Name: <span style="color:red">*</span> </label>
                            <div class="col-sm-5">
                               

                                  <select  class="form-control" id="employee_name" name="employee_name" readonly>

                                            <option select="selected" value="<?php echo $row_for_partial_test_for_trf['employee_name'].'?fs?'.$row_for_partial_test_for_trf['employee_id']; ?>" ><?php echo $row_for_partial_test_for_trf['employee_name'] ?></option>


                                          
                                   </select>

                                           
                            </div>
                    </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_employee_name"> -->



                    <div class="form-group form-group-sm" id="form-group_for_shift">
                        <label class="control-label col-sm-3" for="shift" style="margin-right:0px; color:#00008B;">Shift: <span style="color:red">*</span> </label>
                            <div class="col-sm-5">
                                <select  class="form-control" id="shift" name="shift" readonly>
                                            <option select="selected" value="<?php echo $row_for_partial_test_for_trf['shift'] ?>"><?php echo $row_for_partial_test_for_trf['shift'] ?></option>
                                           
                                </select>
                            </div>
                    </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_shift"> -->

          


          <div class="form-group form-group-sm" id="form-group_for_pp_number">
            <label class="control-label col-sm-3" for="pp_number" style="margin-right:0px; color:#00008B;">PP Number: <span style="color:red">*</span> </label>
              <div class="col-sm-5">
                <select  class="form-control" id="pp_number" name="pp_number" readonly>
                   <option value="<?php echo $row_for_partial_test_for_trf['pp_number'] ?>" selected ><?php echo $row_for_partial_test_for_trf['pp_number'] ?></option>
                                                    
                </select>
              </div>
          </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_pp_number"> -->

            <div class="form-group form-group-sm" id="form-group_for_version_number">
            <label class="control-label col-sm-3" for="version_number" style="margin-right:0px; color:#00008B;">Version : <span style="color:red">*</span></label>
              <div class="col-sm-5">
                <select  class="form-control" id="version_number" name="version_number" readonly>
                <option value="<?php echo $row_for_partial_test_for_trf['version_number'] ?>" selected><?php echo $row_for_partial_test_for_trf['version_number'] ?></option>
                    
                </select>
              </div>


              <input type="hidden" id="version_id" name="version_id" value="<?php echo $row_for_partial_test_for_trf['version_id'] ?>">


            </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_version_number"> -->



            <div class="form-group form-group-sm" id="form-group_for_process_name">
                        <label class="control-label col-sm-3" for="process_name" style="margin-right:0px; color:#00008B;">Process Name: <span style="color:red">*</span> </label>
                            <div class="col-sm-5">


                                
                                <input type="hidden" class="form-control" id="process_name" name="process_name" value="<?php echo $row_for_partial_test_for_trf['process_id'].'?fs?'.$row_for_partial_test_for_trf['process_name']?>" readonly>
                                <input type="text" class="form-control" id="process" name="process" value="<?php echo $row_for_partial_test_for_trf['process_name']?>" readonly>
                            </div>
            </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_process_name"> -->




            <div class="form-group form-group-sm" id="form-group_for_process_width">
                        <label class="control-label col-sm-3" for="for_process_width" style="margin-right:0px; color:#00008B;">Process Width:  </label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" id="process_width" name="process_width" value="<?php echo $row_for_partial_test_for_trf['process_width']?>" readonly>
                            </div>
              </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_process_width"> -->




            <div class="form-group form-group-sm" id="form-group_for_week_in_year">
                                <label class="control-label col-sm-3" for="week_in_year" style="color:#00008B;">Week : <span style="color:red">*</span></label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" id="week_in_year" name="week_in_year" value="<?php echo $row_for_partial_test_for_trf['week_in_year']?>" readonly>
                                </div>
                               
                                <i class="glyphicon glyphicon-remove" onclick="Remove_Value_Of_This_Element('week_in_year')"></i>
             </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_week_in_year"> -->


            <div class="form-group form-group-sm" id="form-group_for_design">
                <label class="control-label col-sm-3" for="design" style="color:#00008B;">Design: <span style="color:red">*</span></label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" id="design" name="design" value="<?php echo $row_for_partial_test_for_trf['design']?>" readonly>
                </div>
                <i class="glyphicon glyphicon-remove" onclick="Remove_Value_Of_This_Element('design')"></i>
            </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_design"> -->


             <div class="form-group form-group-sm" id="form-group_for_customer_name">
                                <label class="control-label col-sm-3" for="customer_name" style="color:#00008B;"> Customer Name: <span style="color:red">*</span> </label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" id="customer_name" name="customer_name" value="<?php echo $row_for_partial_test_for_trf['customer_name']?>" readonly>

                                    <input type="hidden" class="form-control" id="customer_id" name="customer_id" value="<?php echo $row_for_partial_test_for_trf['customer_id']?>">
                                </div>
                                <i class="glyphicon glyphicon-remove" onclick="Remove_Value_Of_This_Element('customer_name')"></i>
             </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_customer_name"> -->
              



              <input type="hidden" class="form-control" id="style" name="style" value="">




              <div class="form-group form-group-sm" id="form-group_for_fiber_composition">
                                <label class="control-label col-sm-3" for="fiber_composition" style="color:#00008B;">Fiber Composition: <span style="color:red">*</span> </label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" id="fiber_composition" name="fiber_composition" value="<?php echo $row_for_partial_test_for_trf['fiber_composition']?>" readonly>
                                </div>
                                <i class="glyphicon glyphicon-remove" onclick="Remove_Value_Of_This_Element('fiber_composition')"></i>
              </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_fiber_composition"> -->



              <!-- <div class="form-group form-group-sm" id="form-group_for_partial_test_for_trf_name">
                <label class="control-label col-sm-3" for="partial_test_for_trf_name" style="partial_test_for_trf:#00008B;">partial_test_for_trf Name:</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" id="partial_test_for_trf_name" name="partial_test_for_trf_name" placeholder="Enter partial_test_for_trf Name" required>

                </div>

                <i class="glyphicon glyphicon-remove" onclick="Remove_Value_Of_This_Element('partial_test_for_trf_name')"></i>
               </div> --> <!-- End of <div class="form-group form-group-sm" id="form-group_for_partial_test_for_trf_name"> -->

              <div class="form-group form-group-sm" id="form-group_for_finish_width_in_inch">
                        <label class="control-label col-sm-3" for="finish_width_in_inch" style="margin-right:0px; color:#00008B;">Finish Width in Inch: <span style="color:red">*</span> </label>
                            <div class="col-sm-5">
                                <select  class="form-control" id="finish_width_in_inch" name="finish_width_in_inch" readonly>
                                <option value="<?php echo $row_for_partial_test_for_trf['finish_width_in_inch'] ?>" selected><?php echo $row_for_partial_test_for_trf['finish_width_in_inch'] ?></option>
                                          
                                           
                                </select>
                            </div>
             </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_finish_width_in_inch"> -->



             <!-- <div class="form-group form-group-sm" id="form-group_for_before_trolley_number_or_batcher_number">
                        <label class="control-label col-sm-3" for="before_trolley_number_or_batcher_number" style="margin-right:0px; trf_for_partial_test:#00008B;">Before Trolley Number or Batcher Number: <span style="trf_for_partial_test:red">*</span> </label>
                            <div class="col-sm-5">
                                <select  class="form-control" id="before_trolley_number_or_batcher_number" name="before_trolley_number_or_batcher_number">
                                            <option select="selected" value="select">Select before trolley number or batcher number</option>
                                            <option value="1">1</option>
                                            <option value="'to be added">Need to be added</option>
                                            

                                                 
                                </select>
                            </div>
              </div> --> <!-- End of <div class="form-group form-group-sm" id="form-group_for_before_trolley_number_or_batcher_number"> -->


             <div class="form-group form-group-sm" id="form-group_for_before_trolley_number_or_batcher_number">
                        <label class="control-label col-sm-3" for="before_trolley_number_or_batcher_number" style="margin-right:0px; color:#00008B;">Before Trolley or Batcher Number: <span style="color:red">*</span> </label>
                            <div class="col-sm-5">
                                <select  class="form-control" id="before_trolley_number_or_batcher_number" name="before_trolley_number_or_batcher_number">
                                <option value="<?php echo $row_for_partial_test_for_trf['before_trolley_number_or_batcher_number'] ?>" selected><?php echo $row_for_partial_test_for_trf['before_trolley_number_or_batcher_number'] ?></option>    
                                 <option select="selected" value="select">Select Trolley Name</option>
                                            <?php 
                                                 $sql = 'select * from `trolley` order by row_id ASC';
                                                 $result= mysqli_query($con,$sql) or die(mysqli_error($con));
                                                 while( $row = mysqli_fetch_array( $result))
                                                 {

                                                     echo '<option value="'.$row['trolley_no'].'">'.$row['trolley_no'].'</option>';

                                                 }

                                             ?>
                                </select>
                            </div>
              </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_before_trolley_number_or_batcher_number"> -->


              <div class="form-group form-group-sm" id="form-group_for_after_trolley_number_or_batcher_number">
                                <label class="control-label col-sm-3" for="after_trolley_number_or_batcher_number" style="color:#00008B;">After Trolley or Batcher Number: <span style="color:red">*</span> </label>
                                <div class="col-sm-5">
                                     <select  class="form-control" id="after_trolley_number_or_batcher_number" name="after_trolley_number_or_batcher_number">
                                     <option value="<?php echo $row_for_partial_test_for_trf['after_trolley_number_or_batcher_number'] ?>" selected><?php echo $row_for_partial_test_for_trf['after_trolley_number_or_batcher_number'] ?></option>
                                       <option select="selected" value="select">Select Trolley Name</option>
                                                  <?php 
                                                       $sql = 'select * from `trolley` order by row_id ASC';
                                                       $result= mysqli_query($con,$sql) or die(mysqli_error($con));
                                                       while( $row = mysqli_fetch_array( $result))
                                                       {

                                                           echo '<option value="'.$row['trolley_no'].'">'.$row['trolley_no'].'</option>';

                                                       }

                                                   ?>
                                    </select>
                                </div>
                                <i class="glyphicon glyphicon-remove" onclick="Remove_Value_Of_This_Element('after_trolley_number_or_batcher_number')"></i>
              </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_after_trolley_number_or_batcher_number"> -->


            <div class="form-group form-group-sm" id="form-group_for_before_trolley_or_batcher_in_time">
                        <label class="control-label col-sm-3" for="before_trolley_or_batcher_in_time" style="margin-right:0px; color:#00008B;">Before Trolley  or Batcher In Time:  </label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" id="before_trolley_or_batcher_in_time" name="before_trolley_or_batcher_in_time" value="<?php echo $row_for_partial_test_for_trf['before_trolley_or_batcher_in_time']?>" required/>
                            </div>
              </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_before_trolley_or_batcher_in_time"> -->

               <div class="form-group form-group-sm" id="form-group_for_after_trolley_or_batcher_out_time">
                        <label class="control-label col-sm-3" for="after_trolley_or_batcher_out_time" style="margin-right:0px; color:#00008B;">After Trolley Out Time or Batcher Out Time:  </label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" id="after_trolley_or_batcher_out_time" name="after_trolley_or_batcher_out_time" value="<?php echo $row_for_partial_test_for_trf['after_trolley_or_batcher_out_time']?>" required>
                            </div>
              </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_after_trolley_or_batcher_out_time"> -->



             <div class="form-group form-group-sm" id="form-group_for_qty">
                                <label class="control-label col-sm-3" for="qbefore_trolley_or_batcher_qtyty_label" style="color:#00008B;">Before Trolley  or Batcher Quantiy: <span style="color:red">*</span> </label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" id="before_trolley_or_batcher_qty" name="before_trolley_or_batcher_qty"value="<?php echo $row_for_partial_test_for_trf['before_trolley_or_batcher_qty']?>" required>
                                </div>
                                <i class="glyphicon glyphicon-remove" onclick="Remove_Value_Of_This_Element('before_trolley_or_batcher_qty')"></i>
              </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_qty"> -->

                <div class="form-group form-group-sm" id="form-group_for_qty">
                                <label class="control-label col-sm-3" for="before_trolley_or_batcher_qty_label" style="color:#00008B;">After Trolley  or Batcher Quantiy: <span style="color:red">*</span> </label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" id="after_trolley_or_batcher_qty" name="after_trolley_or_batcher_qty" value="<?php echo $row_for_partial_test_for_trf['after_trolley_or_batcher_qty']?>" required>
                                </div>
                                <i class="glyphicon glyphicon-remove" onclick="Remove_Value_Of_This_Element('after_trolley_or_batcher_qty')"></i>
              </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_qty"> -->



              <div class="form-group form-group-sm" id="form-group_for_machine_name">
                        <label class="control-label col-sm-3" for="machine_name" style="margin-right:0px; color:#00008B;">Machine: <span style="color:red">*</span> </label>
                            <div class="col-sm-5">
                                <select  class="form-control" id="machine_name" name="machine_name" readonly>
                                <option value="<?php echo $row_for_partial_test_for_trf['machine_name'] ?>" selected><?php echo $row_for_partial_test_for_trf['machine_name'] ?></option>
                                          
                                </select>
                            </div>
               </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_machine_name"> -->



               <div class="form-group form-group-sm" id="form-group_for_service_type">
                        <label class="control-label col-sm-3" for="service_type" style="margin-right:0px; color:#00008B;">Service Type: <span style="color:red">*</span> </label>
                            <div class="col-sm-5">
                                <select  class="form-control" id="service_type" name="service_type" readonly>
                                <option value="<?php echo $row_for_partial_test_for_trf['service_type'] ?>" selected><?php echo $row_for_partial_test_for_trf['service_type'] ?></option>
                                          
                                </select>
                            </div>
                </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_service_type"> -->


                           
                <div class='col-md-8 col-sm-8 col-xs-12 col-md-offset-1' >

                     <label class="control-label col-sm-3" for="care_label" style="color:#00008B;">Care Label: </label>

                    <img  id="washing" data-toggle="modal" data-target="#exampleWashing"  src="img/washing/washing.png" width="55" class="img-fluid" alt="Responsive image" >
                    <input type="hidden" name="washingURL" id="washingURL" value="<?php echo $row_for_partial_test_for_trf['washingURL']?>">
                    
                    <img  id="bleaching" data-toggle="modal" data-target="#exampleModal"  src="img/bleaching/bleaching.png" width="55" class="img-fluid" alt="Responsive image" >
                    <input type="hidden" name="bleachingURL" id="bleachingURL" value="<?php echo $row_for_partial_test_for_trf['bleachingURL']?>">

                    <img  id="ironing" data-toggle="modal" data-target="#exampleIron"  src="img/Ironing/ironing.png" width="55" class="img-fluid" alt="Responsive image" >
                    <input type="hidden" name="ironingURL" id="ironingURL" value="<?php echo $row_for_partial_test_for_trf['ironingURL']?>">

                    <img  id="DryCleaning" data-toggle="modal" data-target="#exampleDryCleaning"  src="img/DryCleaning/DryCleaning.png" width="55" class="img-fluid" alt="Responsive image" >
                    <input type="hidden" name="DryCleaningURL" id="DryCleaningURL" value="<?php echo $row_for_partial_test_for_trf['DryCleaningURL']?>">

                    <img  id="drying" data-toggle="modal" data-target="#exampleDrying"  src="img/Drying/Drying.png" width="55" class="img-fluid" alt="Responsive image" >
                    <input type="hidden" name="DryingURL" id="DryingURL" value="<?php echo $row_for_partial_test_for_trf['DryingURL']?>">


                  
                </div> <!-- End of <div class='col-md-8 col-sm-8 col-xs-12 col-md-offset-3' > -->
              
              

                <div class="form-group">
                

                            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                             
                              <button type="button" name="submit" id="submit" class="btn btn-primary" data-toggle="modal" data-target="#Showpartial_test_for_trf" onClick="sending_data_of_partial_test_for_trf_form_for_saving_in_database()">Submit</button>
                              <button type="reset" name="reset" id="reset" class="btn btn-success">Reset</button>

                              <!-- <button type="button" name="submit" id="submit" class="btn btn-success" data-toggle="modal" data-target="#Showpartial_test_for_trf">show </button> -->
                              
                            </div>
                </div> <!--  End of <div class="form-group"> -->


   <div class="panel panel-default">

        

       <div class="form-group form-group-sm">
           <label class="control-label col-sm-5" for="search">Partial Test(TRF) List</label>
     </div> <!-- End of <div class="form-group form-group-sm" -->


        
          <table id="datatable-buttons" class="table table-hover table-bordered">
           <thead>
                 <tr>
                 <th>SI</th>
                 <th>TRF ID</th>
                 <th width="30">PP Number</th>
                 <th>Version</th>
                 <th>Style</th>
                 <th>Process Name</th>
                 <th>Customer Name</th>
                 <th>Before Trolley/Batcher Quantity</th>
                 <th>After Trolley/Batcher Quantity</th>
                 <th>Action</th>
                 </tr>
            </thead>
            <tbody>
            <?php 
                            $s1 = 1;
                            $sql_for_trf_for_partial_test = "SELECT * FROM `partial_test_for_trf_info` ORDER BY partial_test_for_trf_id ASC";

                            $res_for_trf_for_partial_test = mysqli_query($con, $sql_for_trf_for_partial_test);

                            while ($row = mysqli_fetch_assoc($res_for_trf_for_partial_test)) 
                            {

                               $trf_id=$row['trf_id'];
                               $split_trf_data=explode('_', $trf_id);
                               $data_for_at=$split_trf_data[1];
                              
                              
                               if($data_for_at=='AT')
                               {

             ?>

             <tr>
                <td><?php echo $s1; ?></td>
                <td><?php echo $row['trf_id']; ?></td>
                <td><?php echo $row['pp_number']; ?></td>
                <td><?php echo $row['version_number']; ?></td>
                <td><?php echo $row['style']; ?></td>
                <td><?php echo $row['process_name']; ?></td>
                <td><?php echo $row['customer_name']; ?></td>
                <td><?php echo $row['before_trolley_or_batcher_qty']; ?></td>
                <td><?php echo $row['after_trolley_or_batcher_qty']; ?></td>
                <td>
                      

            

           <div class="form-group form-group-sm">
                <div class="col-sm-offset-3 col-sm-5">

                    <?php $value= $row['customer_id']."?fs?".$row['trf_id']."?fs?".$row['process_id']."?fs?".$row['pp_number']."?fs?".$row['version_id']?> 
                  
                    <a href="trf/pdf_file_for_partial_test_trf_washing_lab.php?customer_id=<?php echo $value; ?>">
                      <button type="button" id="pdf_file_for_partial_test_trf_washing_lab" name="pdf_file_for_partial_test_trf_washing_lab"  class="btn btn-success btn-xs">Generate pdf file(Washing)</button>
                    </a>               
                </div>


                <div class="col-sm-offset-3 col-sm-5">
                    <?php $value= $row['customer_id']."?fs?".$row['trf_id']."?fs?".$row['process_id']."?fs?".$row['pp_number']."?fs?".$row['version_id']?> 
                    <a href="trf/pdf_file_for_partial_test_trf_r_and_d_lab.php?customer_id=<?php echo $value; ?>">
                        <button type="button" id="pdf_file_for_partial_test_trf_r_and_d_lab" name="pdf_file_for_partial_test_trf_r_and_d_lab"  class="btn btn-primary btn-xs">Generate pdf file(R&D)</button>
                      </a>
                     
                </div>

                <div class="col-sm-offset-3 col-sm-5">
                 <?php $value= $row['customer_id']."?fs?".$row['trf_id']."?fs?".$row['process_id']."?fs?".$row['pp_number']."?fs?".$row['version_id']?> 
                  <a href="trf/pdf_file_for_partial_test_trf_physical_lab.php?customer_id=<?php echo $value; ?>">
                    <button type="button" id="pdf_file_for_partial_test_trf_physical_lab" name="pdf_file_for_partial_test_trf_physical_lab"  class="btn btn-warning btn-xs">Generate pdf file(Physical)</button>
                  </a>
              
                </div>
            </div>
                

           

            <button type="submit" id="" name=""  class="btn btn-info btn-xs" onclick="load_page('trf/edit_partial_test_for_trf_info.php?trf_id=<?php echo $row['trf_id']; ?>')"> Edit</button>


            <button type="submit" id="" name=""  class="btn btn-danger btn-xs" onclick="sending_data_for_delete('<?php echo $row['trf_id']; ?>')"> Delete</button>
                 </td>
                <?php
                                 }       /*End of if($data_for_at=='AT')*/ 
                $s1++;
                                 }
                 ?> 
             </tr>
          </tbody>
         </table>


            <script>
                 $(document).ready(function() {
                        // Setup - add a text input to each footer cell
                        $('#datatable-buttons thead tr').clone(true).appendTo( '#datatable-buttons thead' );
                        $('#datatable-buttons thead tr:eq(1) th').each( function (i) {
                            var title = $(this).text();
                            $(this).html( '<input type="text" placeholder="Search '+title+'" />' );

                            $( 'input', this ).on( 'keyup change', function () {
                                if ( table.column(i).search() !== this.value ) {
                                    table
                                        .column(i)
                                        .search( this.value )
                                        .draw();
                                }
                            } );
                        } );
                     
                        var table = $('#datatable-buttons').DataTable( {
                           scrollY:        "500px",
                            scrollX:        true,
                            scrollCollapse: true,
                            paging:         false,
                            columnDefs: [
                                { width: '0%', targets: 0 }
                            ],
                            fixedColumns: false
                        } );
                    } );
            </script>

                
                  </div>  <!-- end of <div class="panel panel-default"> -->


             </div>
           </div>
         </div>
       </form>
                

        </div>
    </div>

  





  
</body>
</html>