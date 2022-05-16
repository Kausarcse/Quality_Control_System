<!DOCTYPE html>
<html lang="en">
<?php
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


$date = new DateTime('now', new DateTimeZone('Asia/Dhaka'));

?>

<script type='text/javascript' src='trf/partial_test_for_test_result/partial_test_for_test_result_info_form_validation.js'></script>

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
		
		
	

/*	$('#submit').click(function()
      {

		document.getElementById("bleachingURL").value=document.getElementById("bleaching").src;
		document.getElementById("washingURL").value=document.getElementById("washing").src;
		document.getElementById("ironingURL").value=document.getElementById("ironing").src;
		document.getElementById("DryCleaningURL").value=document.getElementById("DryCleaning").src;
		document.getElementById("DryingURL").value=document.getElementById("Drying").src;



		alert(document.getElementById("washingURL").value);
		var formData = new FormData(document.getElementsByName('partial_test_for_test_result_form')[0]);

      	  	$.ajax({
		  type: "POST",
		  url: "save_partial_test_for_test_result_form.php",
		  data: formData,
		  processData: false,
		  contentType: false,
		  error: function(jqXHR, textStatus, errorMessage) 
		  {
			  alert(errorMessage);
		  },
		  success: function(data) 
		  {
		 	alert(data);

		

			  
			
		  } 
		 });
		});
       	*/
	
		
		
</script>

<script>

function get_all_value_for_trf(trf_id)
{
  var value_for_data= 'trf_id_value='+trf_id;
/*    $('#version_number').html='<option>This is test </option>';
*/  /*document.getElementById('version_number').innerHTML='<option> option 1</option> <option> option 2</option> ';*/
            $.ajax({
          url: 'test_result/returning_value_from_trf.php',
          dataType: 'text',
          type: 'post',
          contentType: 'application/x-www-form-urlencoded',
          data: value_for_data,
                
          success: function( data, textStatus, jQxhr )
          {       
                

                            /*var splitted_data= data.split('?fs?');*/
                /*document.getElementById('customer_name_name').value=splitted_data[0]; 
                document.getElementById('color').value=splitted_data[1]; 
                document.getElementById('greige_width').value=splitted_data[2]; 
                document.getElementById('version_number').innerHTML=splitted_data[3]; */
              

              /*document.getElementById('pp_number').innerHTML=data;*/

             /*  alert(data);*/
             


              var splitted_version_details= data.split('?fs?');

              document.getElementById('process_name').value=splitted_version_details[18];
              document.getElementById('pp_number').value=splitted_version_details[1];
              document.getElementById('version_number').value=splitted_version_details[2];
              document.getElementById('design').value=splitted_version_details[3]; 
              document.getElementById('week_in_year').value=splitted_version_details[4]; 
              document.getElementById('customer_name').value=splitted_version_details[5]; 
              document.getElementById('fiber_composition').value=splitted_version_details[6]; 
              document.getElementById('finish_width_in_inch').value=splitted_version_details[7]; 
              document.getElementById('before_trolley_number_or_batcher_number').value=splitted_version_details[8]; 
              document.getElementById('after_trolley_number_or_batcher_number').value=splitted_version_details[9]; 
              document.getElementById('qty').value=splitted_version_details[10]; 
              document.getElementById('machine_name').value=splitted_version_details[11]; 
              document.getElementById('service_type').value=splitted_version_details[12]; 
              var washing = document.getElementById('washing').value=splitted_version_details[13];
              $("#washing").attr("src", washing);
              var bleaching = document.getElementById('bleaching').value=splitted_version_details[14]; 
               
              $("#bleaching").attr("src", bleaching);
              var ironing = document.getElementById('ironing').value=splitted_version_details[15]; 
              $("#ironing").attr("src", ironing);
              var DryCleaning = document.getElementById('DryCleaning').value=splitted_version_details[16]; 
              $("#DryCleaning").attr("src", DryCleaning);
               var drying = document.getElementById('drying').value=splitted_version_details[17]; 
              $("#drying").attr("src", drying);

              document.getElementById('shift').value=splitted_version_details[20];
              
                          
              
              //document.getElementById('test').innerHTML=data;
              
          },
          error: function( jqXhr, textStatus, errorThrown )
          {       
              //console.log( errorThrown );
              alert(errorThrown);
          }
      }); // End of $.ajax({
}  /* end of function get_all_value_for_trf()*/


function get_qc_standard_additional_info(pp_number)
{
    var value_for_data= 'pp_number_value='+pp_number;

            $.ajax({
			 		url: 'test_result/returning_version_number_details.php',
			 		dataType: 'text',
			 		type: 'post',
			 		contentType: 'application/x-www-form-urlencoded',
			 		data: value_for_data,
			 		      
			 		success: function( data, textStatus, jQxhr )
			 		{       


            document.getElementById('version_number').innerHTML=data;



	         /*  var splitted_version_details= version_details.split('?fs?');
               alert(document.getElementById('design').value=splitted_version_details[2]); 
              document.getElementById('week_in_year').value=splitted_version_details[3]; 
             document.getElementById('customer_name').value=splitted_version_details[4]; 
             document.getElementById('fiber_composition').value=splitted_version_details[5]; */

							
			 		},
			 		error: function( jqXhr, textStatus, errorThrown )
			 		{       
			 			
			 				alert(errorThrown);
			 		}
			}); // End of $.ajax({
}   

function fill_up_qc_standard_additional_info(version_details)
{  
   /*alert(version_details);*/
   var splitted_version_details= version_details.split('?fs?');
  
  
  document.getElementById('design').value=splitted_version_details[1]; 
  document.getElementById('week_in_year').value=splitted_version_details[2]; 
  document.getElementById('customer_name').value=splitted_version_details[3]; 
  document.getElementById('fiber_composition').value='Cotton:'+splitted_version_details[4].concat(' Polyester:',splitted_version_details[5],' Other',splitted_version_details[6]); 
 
  
}   //End of function fill_up_qc_standard_additional_info(version_details)


// To return Machine Name in dropDown
function return_machine_name(process_name)
{
   var value_for_data= 'process_name_value='+process_name;

            $.ajax({
          url: 'test_result/returning_process_name.php',
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

}


 function sending_data_of_partial_test_for_test_result_form_for_saving_in_database()
 {

    document.getElementById("bleachingURL").value=document.getElementById("bleaching").src;
		document.getElementById("washingURL").value=document.getElementById("washing").src;
		document.getElementById("ironingURL").value=document.getElementById("ironing").src;
		document.getElementById("DryCleaningURL").value=document.getElementById("DryCleaning").src;
		document.getElementById("DryingURL").value=document.getElementById("drying").src;

       var validate = partial_test_for_test_result_Form_Validation();
       var url_encoded_form_data = $("#partial_test_for_test_result_form").serialize(); //This will read all control elements value of the form	
      /* if(validate != false)
	   {
*/

		  	 $.ajax({
			 		url: 'trf/partial_test_for_test_result/partial_test_for_test_result_info_saving.php',
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

 }//End of function sending_data_of_partial_test_for_test_result_form_for_saving_in_database()

</script>

    <div class="col-sm-12 col-md-12 col-lg-12">
        <div class="panel panel-default">

             <div class="panel-heading" style="color:#191970;"><b>Test Result Form (partial test)</b></div> <!-- This will create a upper block for FORM (Just Beautification) -->
                       
                         <br>
                          
                    
						 <form id='partial_test_for_test_result_form' name='partial_test_for_test_result_form'  action="" method="post" enctype="multipart/form-data" class="form-horizontal form-label-left" style="margin-bottom: 20px;">

						    <div class="form-group form-group-sm" id="form-group_for_partial_test_for_test_result_creation_date">
								<label class="control-label col-sm-3" for="pp_creation_date" style="color:#00008B;">Date: <span style="color:red">*</span> </label>
								<div class="col-sm-3">
									<input type="text" class="form-control" id="partial_test_for_test_result_creation_date" name="partial_test_for_test_result_creation_date" placeholder="Please Provide Date" required>
								</div>
								<div class="col-sm-3">
									<input type="text" class="form-control" id="alternate_partial_test_for_test_result_creation_date_time" name="alternate_partial_test_for_test_result_creation_date_time"   placeholder="Hour:Minute" >
								</div>
								<i class="glyphicon glyphicon-remove" onclick="Remove_Value_Of_This_Element('partial_test_for_test_result_creation_date')"></i>
						    </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_pp_creation_date"> -->


								<script>
									$( function()
									{
										$( "#partial_test_for_test_result_creation_date" ).datepicker(
										{
											showWeek: true, // This is for Showing Week in Datepicker Calender.
											//altField: "#alternate_partial_test_for_test_result_creation_date_time", // This is for Descriptive Date Showing in Alternative Field.
											altFormat: "DD, d MM, yy" // This is for Descriptive Date Format in Alternative Field.
										}
										); // End of $( "#pp_creation_date" ).datepicker(

										$( "#partial_test_for_test_result_creation_date" ).datepicker( "option", "dateFormat", "dd/mm/yy" ); // This is for Date Format in Actual Date Field.
										$( "#partial_test_for_test_result_creation_date" ).datepicker( "option", "showAnim", "drop" ); // This is for Datepicker Calender Animation in Actual Date Field.
									}
									); // End of $( function()
								</script>

                    <div class="form-group form-group-sm" id="form-group_for_shift">
                        <label class="control-label col-sm-3" for="shift" style="margin-right:0px; color:#00008B;">Shift: <span style="color:red">*</span> </label>
                            <div class="col-sm-5">
                                <select  class="form-control" id="shift" name="shift">
                                            <option select="selected" value="select">Select Shift</option>
                                            <option value="A">A</option>
                                            <option value="B">B</option>
                                            <option value="C">C</option>

                                                 
                                </select>
                            </div>
                    </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_shift"> -->
               <!--  onchange="get_all_value_for_trf()" -->

<!-- 
                       <div class="form-group form-group-sm" id="form-group_for_qty">
                                <label class="control-label col-sm-3" for="trf_id" style="color:#00008B;">TRF ID: <span style="color:red">*</span> </label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" id="trf_id" name="trf_id" placeholder="Enter Trd ID" onchange="get_all_value_for_trf(this.value)" required>
                                </div>
                                <i class="glyphicon glyphicon-remove" onclick="Remove_Value_Of_This_Element('trf_id')"></i>
                        </div>  --><!-- End of <div class="form-group form-group-sm" id="form-group_for_qty"> -->

          <div class="form-group form-group-sm" id="form-group_for_trf_no">
                        <label class="control-label col-sm-3" for="trf_id" style="margin-right:0px; color:#00008B;">TRF No.:</label>
                            <div class="col-sm-5">
                                <select  class="form-control" id="trf_id" name="trf_id"  onchange="get_all_value_for_trf(this.value)">
                                            <option select="selected" value="select">Select TRF No</option>
                                            <?php 
                                                 $sql = 'select partial_test_for_test_result_for_trf_id from `partial_test_for_test_result_for_trf_info`';
                                                 $result= mysqli_query($con,$sql) or die(mysqli_error($con));
                                                 while( $row = mysqli_fetch_array( $result))
                                                 {

                                                     echo '<option value="'.$row['trf_id'].'">'.$row['trf_id'].'</option>';

                                                 }

                                             ?>
                                </select>
                            </div>
          </div>  <!-- End of <div class="form-group form-group-sm" id="form-group_for_process_name"> -->

          <div class="form-group form-group-sm" id="form-group_for_process_name">
                        <label class="control-label col-sm-3" for="process_name" style="margin-right:0px; color:#00008B;">Process Name: <span style="color:red">*</span> </label>
                            <div class="col-sm-5">
                                <select  class="form-control" id="process_name" name="process_name" onchange="return_machine_name(this.value)">
                                            <option select="selected" value="select">Select Process Name</option>
                                            <?php 
                                                 $sql = 'select process_name from `process_name`';
                                                 $result= mysqli_query($con,$sql) or die(mysqli_error($con));
                                                 while( $row = mysqli_fetch_array( $result))
                                                 {

                                                     echo '<option value="'.$row['process_name'].'">'.$row['process_name'].'</option>';

                                                 }

                                             ?>
                                </select>
                            </div>
          </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_process_name"> -->
    <!-- onchange="Fill_Value_Of_Version_Number_Field(this.value)"  -->

					<div class="form-group form-group-sm" id="form-group_for_pp_number">
						<label class="control-label col-sm-3" for="pp_number" style="margin-right:0px; color:#00008B;" >PP Number: <span style="color:red">*</span> </label>
							<div class="col-sm-5">
								<select  class="form-control" id="pp_number" name="pp_number" onchange="get_qc_standard_additional_info(this.value)" >
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

						<div class="form-group form-group-sm" id="form-group_for_version_number">
						<label class="control-label col-sm-3" for="version_number" style="margin-right:0px; color:#00008B;">Version : <span style="color:red">*</span> </label>
							<div class="col-sm-5">
								<select  class="form-control" id="version_number" name="version_number"  onchange="fill_up_qc_standard_additional_info(this.value)" >
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
							</div>
						</div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_version_number"> -->


						<div class="form-group form-group-sm" id="form-group_for_week_in_year">
                                <label class="control-label col-sm-3" for="week_in_year" style="color:#00008B;">Week : <span style="color:red">*</span> </label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" id="week_in_year" name="week_in_year" placeholder="Enter week in year" required>
                                </div>
                               
                                <i class="glyphicon glyphicon-remove" onclick="Remove_Value_Of_This_Element('week_in_year')"></i>
             </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_week_in_year"> -->

             <div class="form-group form-group-sm" id="form-group_for_design">
								<label class="control-label col-sm-3" for="design" style="color:#00008B;">Design:</label>
								<div class="col-sm-5">
									<input type="text" class="form-control" id="design" name="design" placeholder="Enter Design" required>
						</div>
								<i class="glyphicon glyphicon-remove" onclick="Remove_Value_Of_This_Element('design')"></i>
						</div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_design"> -->

					   <div class="form-group form-group-sm" id="form-group_for_customer_name">
                                <label class="control-label col-sm-3" for="customer_name" style="color:#00008B;"> Customer Name: <span style="color:red">*</span> </label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" id="customer_name" name="customer_name" placeholder="Enter customer name" required>
                                </div>
                                <i class="glyphicon glyphicon-remove" onclick="Remove_Value_Of_This_Element('customer_name')"></i>
             </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_customer_name"> -->

             <div class="form-group form-group-sm" id="form-group_for_fiber_composition">
                                <label class="control-label col-sm-3" for="fiber_composition" style="color:#00008B;">Fiber Composition: <span style="color:red">*</span> </label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" id="fiber_composition" name="fiber_composition" placeholder="Enter fiber composition" required>
                                </div>
                                <i class="glyphicon glyphicon-remove" onclick="Remove_Value_Of_This_Element('fiber_composition')"></i>
              </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_fiber_composition"> -->

						 	<!-- <div class="form-group form-group-sm" id="form-group_for_partial_test_for_test_result_name">
								<label class="control-label col-sm-3" for="partial_test_for_test_result_name" style="partial_test_for_test_result:#00008B;">partial_test_for_test_result Name:</label>
								<div class="col-sm-5">
									<input type="text" class="form-control" id="partial_test_for_test_result_name" name="partial_test_for_test_result_name" placeholder="Enter partial_test_for_test_result Name" required>

								</div>

								<i class="glyphicon glyphicon-remove" onclick="Remove_Value_Of_This_Element('partial_test_for_test_result_name')"></i>
						   </div> --> <!-- End of <div class="form-group form-group-sm" id="form-group_for_partial_test_for_test_result_name"> -->

					  	<div class="form-group form-group-sm" id="form-group_for_finish_width_in_inch">
                        <label class="control-label col-sm-3" for="finish_width_in_inch" style="margin-right:0px; color:#00008B;">Finish Width in Inch: <span style="color:red">*</span> </label>
                            <div class="col-sm-5">
                                <select  class="form-control" id="finish_width_in_inch" name="finish_width_in_inch">
                                            <option select="selected" value="select">Select Finish Width</option>
                                            <?php 
                                                 $sql = 'select distinct finish_width_in_inch from `pp_wise_version_creation_info`';
                                                 $result= mysqli_query($con,$sql) or die(mysqli_error($con));
                                                 while( $row = mysqli_fetch_array( $result))
                                                 {

                                                     echo '<option value="'.$row['finish_width_in_inch'].'">'.$row['finish_width_in_inch'].'</option>';

                                                 }

                                             ?>
                                </select>
                            </div>
                </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_finish_width_in_inch"> -->


<!-- 
               <div class="form-group form-group-sm" id="form-group_for_before_trolley_number_or_batcher_number">
                        <label class="control-label col-sm-3" for="before_trolley_number_or_batcher_number" style="margin-right:0px; color:#00008B;">Before Trolley Number or Batcher Number: <span style="color:red">*</span> </label>
                            <div class="col-sm-5">
                                <select  class="form-control" id="before_trolley_number_or_batcher_number" name="before_trolley_number_or_batcher_number">
                                            <option select="selected" value="select">Select before trolley number or batcher number</option>
                                            <option value="1">1</option>
                                            <option value="'to be added">Need to be added</option>
                                            

                                                 
                                </select>
                            </div>
               </div> --> <!-- End of <div class="form-group form-group-sm" id="form-group_for_before_trolley_number_or_batcher_number"> -->



               <div class="form-group form-group-sm" id="form-group_for_before_trolley_number_or_batcher_number">
                        <label class="control-label col-sm-3" for="before_trolley_number_or_batcher_number" style="margin-right:0px; color:#00008B;">Before Trolley Number or Batcher Number: <span style="color:red">*</span> </label>
                            <div class="col-sm-5">
                                <select  class="form-control" id="before_trolley_number_or_batcher_number" name="before_trolley_number_or_batcher_number">
                                          
                                 <option select="selected" value="select">Select before trolley number or batcher number</option>
                                            <?php 
                                                 $sql = 'select distinct after_trolley_number_or_batcher_number from `trf_info`';
                                                 $result= mysqli_query($con,$sql) or die(mysqli_error($con));
                                                 while( $row = mysqli_fetch_array( $result))
                                                 {

                                                     echo '<option value="'.$row['after_trolley_number_or_batcher_number'].'">'.$row['after_trolley_number_or_batcher_number'].'</option>';

                                                 }

                                             ?>
                                </select>
                            </div>
              </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_before_trolley_number_or_batcher_number"> -->

                

               <div class="form-group form-group-sm" id="form-group_for_after_trolley_number_or_batcher_number">
                                <label class="control-label col-sm-3" for="after_trolley_number_or_batcher_number" style="color:#00008B;">After Trolley Number or Batcher Number: <span style="color:red">*</span> </label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" id="after_trolley_number_or_batcher_number" name="after_trolley_number_or_batcher_number" placeholder="Enter after trolley number or batcher number" required>
                                </div>
                                <i class="glyphicon glyphicon-remove" onclick="Remove_Value_Of_This_Element('after_trolley_number_or_batcher_number')"></i>
              </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_after_trolley_number_or_batcher_number"> -->

              <div class="form-group form-group-sm" id="form-group_for_qty">
                                 <label class="control-label col-sm-3" for="qty" style="color:#00008B;">Qty:</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" id="qty" name="qty" placeholder="Enter qty" required>
                                </div>
                                <i class="glyphicon glyphicon-remove" onclick="Remove_Value_Of_This_Element('qty')"></i>
                        </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_qty"> -->


                        <div class="form-group form-group-sm" id="form-group_for_machine_name">
                        <label class="control-label col-sm-3" for="machine_name" style="margin-right:0px; color:#00008B;">Machine: <span style="color:red">*</span> </label>
                            <div class="col-sm-5">
                                <select  class="form-control" id="machine_name" name="machine_name">
                                            <option select="selected" value="select">Select PP Number</option>
                                            <?php 
                                                 $sql = 'select DISTINCT machine_name from `machine_name`';
                                                 $result= mysqli_query($con,$sql) or die(mysqli_error($con));
                                                 while( $row = mysqli_fetch_array( $result))
                                                 {

                                                     echo '<option value="'.$row['machine_name'].'">'.$row['machine_name'].'</option>';

                                                 }

                                             ?>
                                </select>
                            </div>
                        </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_machine_name"> -->


                     <div class="form-group form-group-sm" id="form-group_for_service_type">
                        <label class="control-label col-sm-3" for="service_type_value" style="margin-right:0px; color:#00008B;">Service Type: <span style="color:red">*</span> </label>
                            <div class="col-sm-5">
                                <select  class="form-control" id="service_type" name="service_type">
                                            <option select="selected" value="select">Select Service Type</option>
                                            <option value="Regular">Regular</option>
                                            <option value="Express">Express</option>
                                            <option value="Shuttle">Shuttle</option>

                                                 
                                </select>
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
 							
							

						<div class="form-group">
								

                            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                             
                              <button type="button" name="submit" id="submit" class="btn btn-primary" data-toggle="modal" data-target="#Showpartial_test_for_test_result" onClick="sending_data_of_partial_test_for_test_result_form_for_saving_in_database()">Submit</button>
                              <button type="reset" name="reset" id="reset" class="btn btn-success">Reset</button>

                              <!-- <button type="button" name="submit" id="submit" class="btn btn-success" data-toggle="modal" data-target="#Showpartial_test_for_test_result">show </button> -->
                              
                            </div>
                         </div> <!--  End of <div class="form-group"> -->

							  
						    	</div>  <!--  end of <div class="panel panel-default"> -->
							  </div>
						  </div>
						</div>
					</form>
                

        </div>
    </div>

	<script  src="popUp.js">

		/*$(function()
		{

			$("#process_program_info").autocomplete(
			{

				minLength: 0,
				source: 'get_process_program_info_info.php',
				delay: 0,
				select: function( event, ui )
				{
					console.log()

					$("#process_program_info").val(ui.item.pp_number);
					//$("#design_no_id").val(ui.item.label);
					$("#").val(ui.item.week);
					$("#design").val(ui.item.design);
					$("#customer_name").val(ui.item.process_program);
					//$("#fiber_coposition").val(ui.item.fiber_coposition);
					
					

					return false;
				}

			});
		});
		*/
	</script>
	





	
</body>
</html>