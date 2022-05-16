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

$date = new DateTime('now', new DateTimeZone('Asia/Dhaka'));

require_once('pop_up_washing.php');
require_once('pop_up_bleaching.php');
require_once('pop_up_dry_cleaning.php');
require_once('pop_up_iron.php');
require_once('pop_up_drying.php');

?>

<script>
  
   var d = new Date();
  var ye = new Intl.DateTimeFormat('en', { year: 'numeric' }).format(d);
  var mo = new Intl.DateTimeFormat('en', { month: '2-digit' }).format(d);
  var da = new Intl.DateTimeFormat('en', { day: '2-digit' }).format(d);
</script>

<script type='text/javascript' src='trf/all_test_for_trf_info_form_validation.js'></script>

</head>
<body class="nav-md">

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

    $('#ironingID1').click(function()
    {
	
        var selectedOption = $("input:radio[name=option]:checked").val()
        //<img  src="img/blenching3.png" width="55" class="img-fluid" alt="Responsive image" >
  
        if (selectedOption ==="ironing1") 
        {
            $("#ironing").attr("src", "img/ironing/ironing1.png");
        } 
        else if (selectedOption ==="ironing2") 
        {
            $("#ironing").attr("src", "img/ironing/ironing2.png");
        } 
        else if (selectedOption ==="ironing3") 
        {
            $("#ironing").attr("src", "img/ironing/ironing3.png");
        } 
        else if (selectedOption ==="ironing4") 
        {
            $("#ironing").attr("src", "img/ironing/ironing4.png");
        } 
        else if (selectedOption ==="ironing5") 
        {
            $("#ironing").attr("src", "img/ironing/ironing5.png");
        } 
    });


    $('#DryCleaningID1').click(function()
    {
        var selectedOption = $("input:radio[name=option]:checked").val()
        //<img  src="img/blenching3.png" width="55" class="img-fluid" alt="Responsive image" >
  
        if (selectedOption ==="DryCleaning1") 
        {
            $("#DryCleaning").attr("src", "img/DryCleaning/DryCleaning1.png");
        } 
        else if (selectedOption ==="DryCleaning2") 
        {
            $("#DryCleaning").attr("src", "img/DryCleaning/DryCleaning2.png");
        }       
    });



    $('#bleachingID1').click(function()
    {
        var selectedOption = $("input:radio[name=option]:checked").val()
        //<img  src="img/blenching3.png" width="55" class="img-fluid" alt="Responsive image" >
  
        if (selectedOption ==="bleaching1") 
        {
            $("#bleaching").attr("src", "img/bleaching/bleaching1.png");
        } 
        else if (selectedOption ==="bleaching2") 
        {
            $("#bleaching").attr("src", "img/bleaching/bleaching2.png");
        }   
        else if (selectedOption ==="bleaching3") 
        {
            $("#bleaching").attr("src", "img/bleaching/bleaching3.png");
        }   
        else if (selectedOption ==="bleaching4") 
        {
            $("#bleaching").attr("src", "img/bleaching/bleaching4.png");
        }  
        else if (selectedOption ==="bleaching5") 
        {
            $("#bleaching").attr("src", "img/bleaching/bleaching5.png");
        }    
    });
		
		
	$('#WashingID1').click(function()
    {
        var selectedOption = $("input:radio[name=option]:checked").val()
        //<img  src="img/blenching3.png" width="55" class="img-fluid" alt="Responsive image" >
  
        if (selectedOption ==="washing1") 
        {
            $("#washing").attr("src", "img/washing/washing1.png");
        } 
        else if (selectedOption ==="washing2") 
        {
            $("#washing").attr("src", "img/washing/washing2.png");
        } 
        else if (selectedOption ==="washing3") 
        {
            $("#washing").attr("src", "img/washing/washing3.png");
        } 
        else if (selectedOption ==="washing4") 
        {
            $("#washing").attr("src", "img/washing/washing4.png");
        } 
        else if (selectedOption ==="washing5") 
        {
            $("#washing").attr("src", "img/washing/washing5.png");
        } 
        else if (selectedOption ==="washing6") 
        {
            $("#washing").attr("src", "img/washing/washing6.png");
        } 
        else if (selectedOption ==="washing7") 
        {
            $("#washing").attr("src", "img/washing/washing7.png");
        } 
        else if (selectedOption ==="washing8") 
        {
            $("#washing").attr("src", "img/washing/washing8.png");
        } 
        else if (selectedOption ==="washing9") 
        {
            $("#washing").attr("src", "img/washing/washing9.png");
        } 
        else if (selectedOption ==="washing10") 
        {
            $("#washing").attr("src", "img/washing/washing10.png");
        } 
        else if (selectedOption ==="washing11") 
        {
            $("#washing").attr("src", "img/washing/washing11.png");
        } 
        else if (selectedOption ==="washing12") 
        {
            $("#washing").attr("src", "img/washing/washing12.png");
        } 
        else if (selectedOption ==="washing13") 
        {
            $("#washing").attr("src", "img/washing/washing13.png");
        } 
        else if (selectedOption ==="washing14") 
        {
            $("#washing").attr("src", "img/washing/washing14.png");
        } 
        else if (selectedOption ==="washing15") 
        {
            $("#washing").attr("src", "img/washing/washing15.png");
        } 

    });


	$('#DryingID1').click(function()
    {

        var selectedOption = $("input:radio[name=option]:checked").val()
        //<img  src="img/blenching3.png" width="55" class="img-fluid" alt="Responsive image" >
  
        if (selectedOption ==="drying1") 
        {
            $("#drying").attr("src", "img/Drying/Drying1.png");
        } 
        else if (selectedOption ==="drying2") 
        {
            $("#drying").attr("src", "img/Drying/Drying2.png");  
        } 
        else if (selectedOption ==="drying3") 
        {
            $("#drying").attr("src", "img/Drying/Drying3.png");
        } 
        else if (selectedOption ==="drying4") 
        {
            $("#drying").attr("src", "img/Drying/Drying4.png");
        } 
        else if (selectedOption ==="drying5") 
        {
            $("#drying").attr("src", "img/Drying/Drying5.png");
        } 
        else if (selectedOption ==="drying6") 
        {
            $("#drying").attr("src", "img/Drying/Drying6.png");
        } 
        else if (selectedOption ==="drying7") 
        {
            $("#drying").attr("src", "img/Drying/Drying7.png");
        } 
        else if (selectedOption ==="drying8") 
        {
            $("#drying").attr("src", "img/Drying/Drying8.png");
        } 
        else if (selectedOption ==="drying9") 
        {
            $("#drying").attr("src", "img/Drying/Drying9.png");
        } 
        else if (selectedOption ==="drying10") 
        {
            $("#drying").attr("src", "img/Drying/Drying10.png");
        } 
        else if (selectedOption ==="drying11") 
        {
            $("#drying").attr("src", "img/Drying/Drying11.png");
        } 
        else if (selectedOption ==="drying12") 
        {
            $("#drying").attr("src", "img/Drying/Drying12.png");
        } 
        
    });

var get_trf_data="";

function get_qc_standard_additional_info(pp_number)
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
            },
            error: function( jqXhr, textStatus, errorThrown )
            {       
                alert(errorThrown);
            }
    }); // End of $.ajax({
}   

 function returning_value_for_shift(alternate_all_for_trf_creation_date_time)
{
    splitted_time = alternate_all_for_trf_creation_date_time.split(':');
    hours = splitted_time[0];
    // alert(hours);
    var shift = '';
    if(hours >=6 && hours <14)
    {
        shift = 'A';
        document.getElementById('shift_in_time').value = shift;
    }
    else if(hours>=14 && hours<22)
    {
        shift = 'B';
        document.getElementById('shift_in_time').value = shift;
    }
    else
    {
        shift = 'C';
        document.getElementById('shift_in_time').value = shift;
    }
}

function fill_up_qc_standard_additional_info(version_details)
{  
    var splitted_version_details= version_details.split('?fs?');

    var version_id='version_id='+splitted_version_details[8];

    $.ajax({
            url: 'trf/returning_finishing_process_name_for_all_test.php',
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
}   


function return_machine_name(process_name)
{ 
    var version_details = document.getElementById('version_number').value;
    var pp_number = document.getElementById('pp_number').value;
    var splitted_version_details= version_details.split('?fs?');
    var version_id = splitted_version_details[8];
    var style_name = splitted_version_details[9];
    var finish_width_in_inch = splitted_version_details[10];

    var process_details= process_name.split('?fs?');
    var process_id = process_details[0];
    // alert(process_id);
    var value_for_trolley_data= 'version_and_process='+version_id+'?fs?'+process_name+'?fs?';

    var value_for_trolley_quantity_data = 'trolley_details='+pp_number+'?fs?'+version_id+'?fs?'+style_name+'?fs?'+finish_width_in_inch+'?fs?';
    var value_for_data= 'process_name_value='+process_name+'?fs?'+version_id;


    //////////////////////////////////// Start ajax for trolley number, quantity, and time /////////////////////////////

   
        $.ajax({
                url: 'trf/returning_process_name_details_for_partial_test.php',
                dataType: 'text',
                type: 'post',
                contentType: 'application/x-www-form-urlencoded',
                data: value_for_trolley_data,
                    
                success: function( data, textStatus, jQxhr )
                {       
                    document.getElementById('before_trolley_number_or_batcher_number').innerHTML = data;
                    document.getElementById('before_trolley_or_batcher_qty').value = '';
                    document.getElementById('before_trolley_or_batcher_in_time').value = ''; 
                    document.getElementById('form-group_for_before_trolley_number_or_batcher_number').style.display = 'block';
                    document.getElementById('form-group_for_after_trolley_number_or_batcher_number').style.display = 'block';

                },
                error: function( jqXhr, textStatus, errorThrown )
                {       
                //console.log( errorThrown );
                alert(errorThrown);
                }
            }); // End of $.ajax({
  
    //////////////////////////////////// End ajax for trolley number, quantity, and time /////////////////////////////

        //////////////////////////////////// Start ajax for Machine Name /////////////////////////////

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
              
    //////////////////////////////////// End ajax for Machine Name /////////////////////////////

}

function return_trolley_quantity(before_trolley_number_or_batcher_number)
{

    var version_details = document.getElementById('version_number').value;

  
    var splitted_version_details= version_details.split('?fs?');
    var version_id = splitted_version_details[8];

    var process_name=document.getElementById('process_name').value;
    var value_for_trolley_data= 'version_and_process='+version_id+'?fs?'+before_trolley_number_or_batcher_number+'?fs?'+process_name;

    $.ajax({
            url: 'trf/returning_before_quantity_details_for_partial_test.php',
            dataType: 'text',
            type: 'post',
            contentType: 'application/x-www-form-urlencoded',
            data: value_for_trolley_data,
                    
            success: function( data, textStatus, jQxhr )
            {       
                // alert(data);
                var splitted_qty_data = data.split('?fs?');
                var after_trolley_or_batcher_qty = splitted_qty_data[0];
                var after_trolley_or_batcher_out_time = splitted_qty_data[1];
                
                document.getElementById('before_trolley_or_batcher_qty').value = after_trolley_or_batcher_qty; 
                document.getElementById('before_trolley_or_batcher_in_time').value = after_trolley_or_batcher_out_time; 

            },
            error: function( jqXhr, textStatus, errorThrown )
            {       
                //console.log( errorThrown );
                alert(errorThrown);
            }
        }); // End of $.ajax({
}


function sending_data_of_all_for_trf_form_for_saving_in_database()
{
    document.getElementById("bleachingURL").value=document.getElementById("bleaching").src;
    document.getElementById("washingURL").value=document.getElementById("washing").src;
    document.getElementById("ironingURL").value=document.getElementById("ironing").src;
    document.getElementById("DryCleaningURL").value=document.getElementById("DryCleaning").src;
    document.getElementById("DryingURL").value=document.getElementById("drying").src;
 
    var validate = all_test_for_trf_Form_Validation();
    var url_encoded_form_data = $("#all_for_trf_form").serialize(); //This will read all control elements value of the form

    if(validate != false)
    {

        $.ajax({
                  url: 'trf/all_test_for_trf_info_saving.php',
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
                      alert(errorThrown);
                  }
              }); // End of $.ajax({
    }
}//End of function sending_data_of_all_for_trf_form_for_saving_in_database()

 
function sending_data_for_delete(all_data)
{
    var url_encoded_form_data = 'all_data='+all_data;
    
    $.ajax({
            url: 'trf/deleting_trf_info_for_parial_and_all.php',
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

 /***************************************************** FOR AUTO COMPLETE********************************************************************/

// $('.for_auto_complete').chosen();    // Chosen Dropdown

$(".for_auto_complete").select2({
    placeholder: "Select Your Choice",
    selectOnClose: true,
    allowClear: true
});


/***************************************************** FOR AUTO COMPLETE********************************************************************/


</script>

    <div class="col-sm-12 col-md-12 col-lg-12">
        <div class="panel panel-default" id="div_full_form">

            <div class="panel-heading" style="color:#191970;"><b>Test Request Form (All Test For Trf)</b></div> <!-- This will create a upper block for FORM (Just Beautification) -->
                       
            <br>
						 
            <form id='all_for_trf_form' name='all_for_trf_form'  action="" method="post" enctype="multipart/form-data" class="form-horizontal form-label-left" style="margin-bottom: 20px;">

                <div class="form-group form-group-sm" id="form-group_for_all_for_trf_creation_date">
                    <label class="control-label col-sm-3" for="all_for_trf_creation_date" style="color:#00008B;">Date: <span style="color:red">*</span> </label>
                    <div class="col-sm-3">
                        <input type="text" class="form-control" id="all_test_for_trf_creation_date" name="all_test_for_trf_creation_date" placeholder="Please Provide Date" required>
                    </div>
                    <div class="col-sm-2">
                        <input type="time" class="form-control" id="alternate_all_test_for_trf_creation_date_time" name="alternate_all_test_for_trf_creation_date_time"   placeholder="Hour:Minute" onchange="returning_value_for_shift(this.value)" >
                    </div>
                    <div class="col-sm-1">
                        <i class="glyphicon glyphicon-remove" onclick="Remove_Value_Of_This_Element('all_test_for_trf_creation_date')"></i>
                    </div>
                </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_pp_creation_date"> -->

                <script>
                    $( function()
                    {
                        $( "#all_test_for_trf_creation_date" ).datepicker(
                        {
                            showWeek: true, // This is for Showing Week in Datepicker Calender.
                            //altField: "#alternate_all_for_trf_creation_date_time", // This is for Descriptive Date Showing in Alternative Field.
                            altFormat: "DD, d MM, yy" // This is for Descriptive Date Format in Alternative Field.
                        }
                        ); // End of $( "#pp_creation_date" ).datepicker(

                        $( "#all_test_for_trf_creation_date" ).datepicker( "option", "dateFormat", "dd/mm/yy" ); // This is for Date Format in Actual Date Field.
                        $( "#all_test_for_trf_creation_date" ).datepicker( "option", "showAnim", "drop" ); // This is for Datepicker Calender Animation in Actual Date Field.
                    }
                    ); // End of $( function()
                </script>

                <div class="form-group form-group-sm" id="form-group_for_employee_name">
                    <label class="control-label col-sm-3" for="employee_name" style="margin-right:0px; color:#00008B;">Employee Name: <span style="color:red">*</span> </label>
                    <div class="col-sm-5">
                        <select  class="form-control " id="employee_name" name="employee_name">
                            <option select="selected" value="select">Select Employee Name</option>
                            <?php 
                                $sql = "select * from `user_login`  where `user_type`='Sub_User'";
                                $result= mysqli_query($con,$sql) or die(mysqli_error($con));
                                while( $row = mysqli_fetch_array( $result))
                                {
                                    echo '<option value="'.$row['employee_name'].'?fs?'.$row['id'].'">'.$row['employee_name'].'</option>';
                                }
                            ?>
                        </select>
                        <script>
                            $("#employee_name").select2({
                                placeholder: "Select employee name",
                                selectOnClose: true,
                                theme: "classic",
                                closeOnSelect: true,
                                allowClear: true
                            });
                        </script>
                    </div>
                </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_employee_name"> -->

                <div class="form-group form-group-sm" id="form-group_for_shift">
                    <label class="control-label col-sm-3" for="shift" style="margin-right:0px; color:#00008B;">Shift: <span style="color:red">*</span> </label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" id="shift_in_time" name="shift_in_time" placeholder="Enter Shift in time" readonly>
                    </div>
                </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_shift"> -->
             
            <div id="div_all_data_without_trf">
            <div class="form-group form-group-sm" id="form-group_for_pp_number">
                <label class="control-label col-sm-3" for="pp_number" style="margin-right:0px; color:#00008B;" >PP Number: <span style="color:red">*</span> </label>
                <div class="col-sm-5">
                    <select  class="form-control " id="pp_number" name="pp_number" onchange="get_qc_standard_additional_info(this.value)" >
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
                        <script>
                            $("#pp_number").select2({
                                placeholder: "Select PP Number",
                                theme: "classic",
                                selectOnClose: true,
                                closeOnSelect: true,
                                allowClear: true
                            });
                        </script>
                </div>
            </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_pp_number"> -->

            <div class="form-group form-group-sm" id="form-group_for_version_number">
                <label class="control-label col-sm-3" for="version_number" style="margin-right:0px; color:#00008B;">Version : <span style="color:red">*</span> </label>
                <div class="col-sm-5">
                    <select  class="form-control " id="version_number" name="version_number"  onchange="fill_up_qc_standard_additional_info(this.value)" >
                        <option select="selected" value="select">Select Version Number</option>
                        <?php 
                            $sql = 'select DISTINCT version_name from `pp_wise_version_creation_info` order by `version_name`';
                            $result= mysqli_query($con,$sql) or die(mysqli_error($con));
                            while( $row = mysqli_fetch_array( $result))
                            {
                                echo '<option value="'.$row['version_name'].'">'.$row['version_name'].'</option>';
                            }
                        ?>
                    </select>
                    <script>
                            $("#version_number").select2({
                                placeholder: "Select Version Number",
                                theme: "classic",
                                selectOnClose: true,
                                closeOnSelect: true,
                                allowClear: true
                            });
                        </script>
                </div>
            </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_version_number"> -->

            <div class="form-group form-group-sm" id="form-group_for_process_name">
                <label class="control-label col-sm-3" for="process_name" style="margin-right:0px; color:#00008B;">Process Name: <span style="color:red">*</span> </label>
                <div class="col-sm-5">
                    <select  class="form-control " id="process_name" name="process_name" onchange="return_machine_name(this.value)">
                        <option select="selected" value="select">Select Process Name</option>
                        <?php 
                            $sql = 'select DISTINCT process_name from `process_name`';
                            $result= mysqli_query($con,$sql) or die(mysqli_error($con));
                            while( $row = mysqli_fetch_array( $result))
                            {
                                echo '<option value="'.$row['process_id']."?fs?".$row['process_name'].'">'.$row['process_name'].'</option>';
                            }
                        ?>
                    </select>
                    <script>
                        $("#process_name").select2({
                            placeholder: "Select process Name",
                            theme: "classic",
                            selectOnClose: true,
                            closeOnSelect: true,
                            allowClear: true
                        });
                    </script>
                </div>
            </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_process_name"> -->

            <div class="form-group form-group-sm" id="form-group_for_process_width">
                        <label class="control-label col-sm-3" for="for_process_width" style="margin-right:0px; color:#00008B;">Process Width:  </label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" id="process_width" name="process_width" placeholder="Enter Process Width" required>
                            </div>
                            <div class="col-sm-1">
                              <i class="glyphicon glyphicon-remove" onclick="Remove_Value_Of_This_Element('process_width')"></i>
                            </div> 
            </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_process_width"> -->
    
           <div class="form-group form-group-sm" id="form-group_for_before_trolley_number_or_batcher_number">
                <label class="control-label col-sm-3" for="before_trolley_number_or_batcher_number" style="margin-right:0px; color:#00008B;">Before Trolley or Batcher Number: <span style="color:red">*</span> </label>
                <div class="col-sm-5">
                    <select  class="form-control" id="before_trolley_number_or_batcher_number" name="before_trolley_number_or_batcher_number"  onchange="return_trolley_quantity(this.value)">
            
                    </select>
                    <script>
                        $("#before_trolley_number_or_batcher_number").select2({
                            placeholder: "Select Before Trolley or Batcher number",
                            theme: "classic",
                            selectOnClose: true,
                            closeOnSelect: true,
                            allowClear: true
                        });
                    </script>
                </div>
            </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_before_trolley_number_or_batcher_number"> -->


            <div class="form-group form-group-sm" id="form-group_for_after_trolley_number_or_batcher_number">
                <label class="control-label col-sm-3" for="after_trolley_number_or_batcher_number" style="color:#00008B;">After Trolley or Batcher Number: <span style="color:red">*</span> </label>
                <div class="col-sm-5">
                    <select  class="form-control for_auto_complete" id="after_trolley_number_or_batcher_number" name="after_trolley_number_or_batcher_number">
                        <option select="selected" value="select">Select After Trolley or Batcher Number</option>
                            <?php 
                                $sql = 'select * from `trolley` order by row_id ASC';
                                $result= mysqli_query($con,$sql) or die(mysqli_error($con));
                                while( $row = mysqli_fetch_array( $result))
                                {
                                    echo '<option value="'.$row['trolley_no'].'">'.$row['trolley_no'].'</option>';
                                }
                            ?>
                    </select>
                    <script>
                        $("#after_trolley_number_or_batcher_number").select2({
                            placeholder: "Select After Trolley or Batcher number",
                            theme: "classic",
                            selectOnClose: true,
                            closeOnSelect: true,
                            allowClear: true
                        });
                    </script>
                </div>
            </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_after_trolley_number_or_batcher_number"> -->


            <div class="form-group form-group-sm" id="form-group_for_before_trolley_or_batcher_in_time">
                <label class="control-label col-sm-3" for="before_trolley_or_batcher_in_time" style="margin-right:0px; color:#00008B;">Before Trolley  or Batcher In Time:  </label>
                <div class="col-sm-5">
                    <input type="time" class="form-control" id="before_trolley_or_batcher_in_time" name="before_trolley_or_batcher_in_time" placeholder="Enter Before trolley number or batcher In Time" required>
                </div>
             
            </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_before_trolley_or_batcher_in_time"> -->

            <div class="form-group form-group-sm" id="form-group_for_after_trolley_or_batcher_out_time">
                <label class="control-label col-sm-3" for="after_trolley_or_batcher_out_time" style="margin-right:0px; color:#00008B;">After Trolley Out Time or Batcher Out Time:  </label>
                <div class="col-sm-5">
                    <input type="time" class="form-control" id="after_trolley_or_batcher_out_time" name="after_trolley_or_batcher_out_time" placeholder="Enter Before trolley number or batcher out Time" required>
                </div>
                <div class="col-sm-1">
                    <i class="glyphicon glyphicon-remove" onclick="Remove_Value_Of_This_Element('after_trolley_or_batcher_out_time')"></i>
                </div>
            </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_after_trolley_or_batcher_out_time"> -->

            <div class="form-group form-group-sm" id="form-group_for_qty">
                <label class="control-label col-sm-3" for="qbefore_trolley_or_batcher_qtyty_label" style="color:#00008B;">Before Trolley  or Batcher Quantiy: <span style="color:red">*</span> </label>
                <div class="col-sm-5">
                    <input type="text" class="form-control" id="before_trolley_or_batcher_qty" name="before_trolley_or_batcher_qty" placeholder="Enter qty" readonly>
                </div>
                           
            </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_qty"> -->

            <div class="form-group form-group-sm" id="form-group_for_qty">
                <label class="control-label col-sm-3" for="before_trolley_or_batcher_qty_label" style="color:#00008B;">After Trolley  or Batcher Quantiy: <span style="color:red">*</span> </label>
                <div class="col-sm-5">
                    <input type="text" class="form-control" id="after_trolley_or_batcher_qty" name="after_trolley_or_batcher_qty" placeholder="Enter qty" required>
                </div>
                <div class="col-sm-1">
                    <i class="glyphicon glyphicon-remove" onclick="Remove_Value_Of_This_Element('after_trolley_or_batcher_qty')"></i>
                </div>              
            </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_qty"> -->

            <div class="form-group form-group-sm" id="form-group_for_machine_name">
                <label class="control-label col-sm-3" for="machine_name" style="margin-right:0px; color:#00008B;">Machine:  </label>
                <div class="col-sm-5">
                    <select  class="form-control" id="machine_name" name="machine_name" >
                        <option value="select" select="selected">Select Machine Name</option>
                        <?php 
                            $sql = 'select DISTINCT machine_name from `machine_name`';
                            $result= mysqli_query($con,$sql) or die(mysqli_error($con));
                            while( $row = mysqli_fetch_array( $result))
                            {
                                echo '<option value="'.$row['machine_name'].'">'.$row['machine_name'].'</option>';
                            }
                            ?>
                    </select>
                    <script>
                        $("#machine_name").select2({
                            placeholder: "Select Machine name",
                            theme: "classic",
                            selectOnClose: true,
                            closeOnSelect: true,
                            allowClear: true
                        });
                    </script>
                </div>
            </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_machine_name"> -->


                     <div class="form-group form-group-sm" id="form-group_for_service_type">
                        <label class="control-label col-sm-3" for="service_type_value" style="margin-right:0px; color:#00008B;">Service Type: <span style="color:red">*</span> </label>
                            <div class="col-sm-5">
                                <select  class="form-control" id="service_type" name="service_type" required>
                                            <option value="select" >Select Service Type</option>
                                            <option value="Regular">Regular</option>
                                            <option value="Express">Express</option>
                                            <option value="Shuttle">Shuttle</option>
         
                                </select>
                                <script>
                            $("#service_type").select2({
                                placeholder: "Select Service Type",
                                theme: "classic",
                                selectOnClose: true,
                                closeOnSelect: true,
                                allowClear: true
                            });
                    </script>
                            </div>
                    </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_service_type"> -->


                           
				<div class='col-md-8 col-sm-8 col-xs-12 col-md-offset-1' >

                   <label class="control-label col-sm-3" for="care_label" style="color:#00008B;">Care Label:  </label>

									<img  id="washing" data-toggle="modal" data-target="#exampleWashing"  src="img/washing/washing.png" width="55" class="img-fluid" alt="Responsive image" >
									<input type="hidden" name="washingURL" id="washingURL" value="">
									
									<img  id="bleaching" data-toggle="modal" data-target="#exampleModal"  src="img/bleaching/bleaching.png" width="55" class="img-fluid" alt="Responsive image" >
									<input type="hidden" name="bleachingURL" id="bleachingURL" value="">

									<img  id="ironing" data-toggle="modal" data-target="#exampleIron"  src="img/Ironing/ironing.png" width="55" class="img-fluid" alt="Responsive image" >
									<input type="hidden" name="ironingURL" id="ironingURL" value="">

									<img  id="DryCleaning" data-toggle="modal" data-target="#exampleDryCleaning"  src="img/DryCleaning/DryCleaning.png" width="55" class="img-fluid" alt="Responsive image" >
									<input type="hidden" name="DryCleaningURL" id="DryCleaningURL" value="">

									<img  id="drying" data-toggle="modal" data-target="#exampleDrying"  src="img/Drying/Drying.png" width="55" class="img-fluid" alt="Responsive image" >
									<input type="hidden" name="DryingURL" id="DryingURL" value="">



										
									
								</div> <!-- End of <div class='col-md-8 col-sm-8 col-xs-12 col-md-offset-3' > -->
                        </div>	
							
						<div class="form-group">
							
                            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                             
                              <button type="button" name="submit" id="submit" class="btn btn-primary" onClick="sending_data_of_all_for_trf_form_for_saving_in_database()">Submit</button>
                              <button type="reset" name="reset" id="reset" class="btn btn-success">Reset</button>

                              <!-- <button type="button" name="submit" id="submit" class="btn btn-success" data-toggle="modal" data-target="#Showall_for_trf">show </button> -->
                              
                            </div>
                      </div> <!--  End of <div class="form-group"> -->

					</form>

 
                    <div class="panel panel-default">

<div class="form-group form-group-sm">
    <label class="control-label col-sm-5" for="search">All Test(TRF) List</label>
</div> <!-- End of <div class="form-group form-group-sm" -->

   <table id="datatable-buttons" class="table table-hover table-bordered">
    <thead>
          <tr>
          <th>SI</th>
          <th>TRF Creation Date</th>
          <th>TRF ID</th>
          <th width="30">PP Number</th>
          <th>Version</th>
          <th>Style</th>
          <th>Process Name</th>
          <th>Customer Name</th>
          <th>Finish Width in Inch</th>
          <th>Before Trolley/Batcher Number</th>
          <th>After Trolley/Batcher Number</th>
          <th>Before Trolley/Batcher Quantity</th>
          <th>After Trolley/Batcher Quantity</th>
          <th>Action</th>
          </tr>
     </thead>
     <tbody>
     <?php 
                     $s1 = 1;
                     $sql_for_trf_for_all_test = "SELECT * FROM `partial_test_for_trf_info` ORDER BY partial_test_for_trf_id ASC";

                     $res_for_trf_for_all_test = mysqli_query($con, $sql_for_trf_for_all_test);

                     while ($row = mysqli_fetch_assoc($res_for_trf_for_all_test)) 
                     {  
                       $trf_id=$row['trf_id'];
                       $split_trf_data=explode('_', $trf_id);
                       $data_for_at=$split_trf_data[1];
                   
                   
                       if(($data_for_at=='AT' && $row['process_name']=='Finishing'))
                       {
                       $date=date_create($row['partial_test_for_trf_creation_date']);
                       $trf_creation_date = date_format($date,"d/m/Y");
                           ?>

                           <tr>
                               <td><?php echo $s1; ?></td>
                               <td><?php echo $trf_creation_date; ?></td>
                               <td><?php echo $row['trf_id']; ?></td>
                               <td><?php echo $row['pp_number']; ?></td>
                               <td><?php echo $row['version_number']; ?></td>
                               <td><?php echo $row['style']; ?></td>
                               <td><?php echo $row['process_name']; ?></td>
                               <td><?php echo $row['customer_name']; ?></td>
                               <td><?php echo $row['finish_width_in_inch']; ?></td>
                               <td><?php echo $row['before_trolley_number_or_batcher_number']; ?></td>
                               <td><?php echo $row['after_trolley_number_or_batcher_number']; ?></td>
                               <td><?php echo $row['before_trolley_or_batcher_qty']; ?></td>
                               <td><?php echo $row['after_trolley_or_batcher_qty']; ?></td>
                               <td>
                                   
                               <div class="form-group form-group-sm">
                               <div class="col-sm-offset-3 col-sm-5">

                                   <?php $value= $row['customer_id']."?fs?".$row['trf_id']."?fs?".$row['process_id']."?fs?".$row['pp_number']."?fs?".$row['version_id']?> 
                                   
                                   <a href="trf/pdf_file_for_all_test_trf_washing_lab.php?customer_id=<?php echo $value; ?>" target="_blank">
                                       <button type="button" id="pdf_file_for_all_test_trf_washing_lab" name="pdf_file_for_all_test_trf_washing_lab"  class="btn btn-success btn-xs">Generate pdf file(Washing)</button>
                                   </a>               
                               </div>


                               <div class="col-sm-offset-3 col-sm-5">
                                   <?php $value= $row['customer_id']."?fs?".$row['trf_id']."?fs?".$row['process_id']."?fs?".$row['pp_number']."?fs?".$row['version_id']?> 
                                   <a href="trf/pdf_file_for_all_test_trf_r_and_d_lab.php?customer_id=<?php echo $value; ?>" target="_blank">
                                       <button type="button" id="pdf_file_for_all_test_trf_r_and_d_lab" name="pdf_file_for_all_test_trf_r_and_d_lab"  class="btn btn-primary btn-xs">Generate pdf file(R&D)</button>
                                       </a>
                                       
                               </div>

                               <div class="col-sm-offset-3 col-sm-5">
                                   <?php $value= $row['customer_id']."?fs?".$row['trf_id']."?fs?".$row['process_id']."?fs?".$row['pp_number']."?fs?".$row['version_id']?> 
                                   <a href="trf/pdf_file_for_all_test_trf_physical_lab.php?customer_id=<?php echo $value; ?>" target="_blank">
                                   <button type="button" id="pdf_file_for_all_test_trf_physical_lab" name="pdf_file_for_all_test_trf_physical_lab"  class="btn btn-warning btn-xs">Generate pdf file(Physical)</button>
                                   </a>
                               
                               </div>
                           </div>
                           <button type="submit" id="" name=""  class="btn btn-info btn-xs" onclick="load_page('trf/edit_all_test_for_trf_info.php?trf_id=<?php echo $row['trf_id']; ?>')">Edit </button>
                           
                           <?php
                               $trf_id = $row['trf_id'];
                               $sql_for_pp_wise_version ="SELECT * FROM `partial_test_for_test_result_info` WHERE trf_id = '$trf_id'";
                               $result_for_pp_wise_version =  mysqli_query($con, $sql_for_pp_wise_version);

                               $row_number_for_pp_wise_version = mysqli_num_rows($result_for_pp_wise_version);

                               if($row_number_for_pp_wise_version >0)
                               {
                                   
                               }
                               else
                               {
                               ?>
                                   <button type="submit" id="" name=""  class="btn btn-danger btn-xs" onclick="sending_data_for_delete('<?php echo $row['trf_id']; ?>')">Delete </button>
                               <?php
                               }
                           ?>
         
                           </td>
                           </tr>
                           <?php
               
                           }       /*End of if($data_for_at=='AT')*/   
         $s1++;
                          }
          ?> 
   
   </tbody>
  </table>


     <script>
    $(document).ready(function() {
           // Setup - add a text input to each footer cell
          /* $('#datatable-buttons thead tr').clone(true).appendTo( '#datatable-buttons thead' );
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
           } );*/
        
           var table = $('#datatable-buttons').DataTable( {
              scrollY:        "500px",
               scrollX:        true,
               scrollCollapse: true,
               paging:         false,
               columnDefs: [
                   { width: '0%', targets: 0 }
               ],
               fixedColumns:   {
                                   leftColumns: 2,
                                   rightColumns: 1
                               }

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