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


$date = new DateTime('now', new DateTimeZone('Asia/Dhaka'));

$partial_test_for_test_result_id=$_GET['partial_test_for_test_result_id'];

$sql="select * from partial_test_for_test_result_info where partial_test_for_test_result_id='$partial_test_for_test_result_id'";

$result=mysqli_query($con,$sql) or die(mysqli_error($con));
$row_for_test_result = mysqli_fetch_array($result);

?>

<script type='text/javascript' src='test_result/partial_test_for_test_result_info_form_validation.js'></script>

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
var get_trf_data="";




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
          url: 'test_result/returning_before_quantity_details_for_partial_test_for_reporcess.php',
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


  function sending_data_of_partial_test_for_test_result_form_for_saving_in_database()
 {

    // document.getElementById("bleachingURL").value=document.getElementById("bleaching").src;
    // document.getElementById("washingURL").value=document.getElementById("washing").src;
    // document.getElementById("ironingURL").value=document.getElementById("ironing").src;
    // document.getElementById("DryCleaningURL").value=document.getElementById("DryCleaning").src;
    // document.getElementById("DryingURL").value=document.getElementById("drying").src;

       var url_encoded_form_data = $("#partial_test_for_test_result_form").serialize(); //This will read all control elements value of the form 
      /* if(validate != false)
     {
*/

         $.ajax({
          url: 'test_result/edit_reprocess_partial_test_for_test_result_info_saving.php',
          dataType: 'text',
          type: 'post',
          contentType: 'application/x-www-form-urlencoded',
          data: url_encoded_form_data,
          success: function( data, textStatus, jQxhr )
          {
              alert(data);
              if(data== "Data is successfully saved.")
              {  
                var url_encoded_form_data = $("#partial_test_for_test_result_form").serialize();

                $.ajax({
                url: 'test_result/returning_value_for_test_result_for_partial_for_reprocess.php',
                dataType: 'text',
                type: 'post',
                contentType: 'application/x-www-form-urlencoded',
                data: url_encoded_form_data,
                success: function( data, textStatus, jQxhr )
                { 


                   
                    var data_split_for_result= data.split("?fs?");
                    var process_name= data_split_for_result[5];
                    
                    // alert(data);

                    var get_all_value=data_split_for_result[0]+"?fs?partial_test_for_test_result_info?fs?partial_test_for_test_result_id";



                    if(process_name== "Singeing & Desizing"){
                     
                        $('#div_full_form').load("process_qc_result/qc_result_for_singe_and_desize_process.php?trf_data=" + encodeURIComponent(get_all_value));
                    }

                    if(process_name== "Steaming"){
                        $('#div_full_form').load("process_qc_result/qc_result_for_steaming_process.php?trf_data=" + encodeURIComponent(get_all_value));
                    }

                    if(process_name== "Ready For Dyeing"){
                        $('#div_full_form').load("process_qc_result/qc_result_for_ready_for_dying_process.php?trf_data=" + encodeURIComponent(get_all_value));
                    }

                    if(process_name== "Washing"){
                        $('#div_full_form').load("process_qc_result/qc_result_for_washing_process.php?trf_data=" + encodeURIComponent(get_all_value));
                    }

                     if(process_name== "Ready For Raising"){
                        $('#div_full_form').load("process_qc_result/qc_result_for_ready_for_raising_process.php?trf_data=" + encodeURIComponent(get_all_value));
                    }

                    if(process_name== "Raising"){
                        $('#div_full_form').load("process_qc_result/qc_result_for_raising_process.php?trf_data=" + encodeURIComponent(get_all_value));
                    }

                    if(process_name== "Finishing"){
                        $('#div_full_form').load("process_qc_result/qc_result_for_finishing_process.php?trf_data=" + encodeURIComponent(get_all_value));
                    }

                   if(process_name== "Calander"){
                        $('#div_full_form').load("process_qc_result/qc_result_for_calendering_process.php?trf_data=" + encodeURIComponent(get_all_value));
                    } 

                   if(process_name== "Sanforizing"){
                        $('#div_full_form').load("process_qc_result/qc_result_for_sanforizing_process.php?trf_data=" + encodeURIComponent(get_all_value));
                    }  

                  if(process_name== "Scouring"){
                        $('#div_full_form').load("process_qc_result/qc_result_for_scouring_process.php?trf_data=" + encodeURIComponent(get_all_value));
                    }


                    if(process_name== "Bleaching"){
                        $('#div_full_form').load("process_qc_result/qc_result_for_bleaching_process.php?trf_data=" + encodeURIComponent(get_all_value));
                    }

                  if(process_name== "Scouring & Bleaching"){
                        $('#div_full_form').load("process_qc_result/qc_result_for_scouring_bleaching_process.php?trf_data=" + encodeURIComponent(get_all_value));
                    }

                   if(process_name== "Ready For Mercerize"){
                        $('#div_full_form').load("process_qc_result/qc_result_for_ready_for_mercerize_process.php?trf_data=" + encodeURIComponent(get_all_value));
                    } 

                    if(process_name== "Mercerize"){
                        $('#div_full_form').load("process_qc_result/qc_result_for_mercerize_process.php?trf_data=" + encodeURIComponent(get_all_value));
                    }
                  if(process_name== "Ready For Print"){
                        $('#div_full_form').load("process_qc_result/qc_result_for_ready_for_printing_process.php?trf_data=" + encodeURIComponent(get_all_value));
                    }

                  if(process_name== "Greige Receiving"){
                        $('#div_full_form').load("process_qc_result/qc_result_for_greige_receiveing_process.php?trf_data=" + encodeURIComponent(get_all_value));
                    }  
  
                   if(process_name== "Printing"){
                        $('#div_full_form').load("process_qc_result/qc_result_for_printing_process.php?trf_data=" + encodeURIComponent(get_all_value));
                    }

                    if(process_name== "Curing"){
                        $('#div_full_form').load("process_qc_result/qc_result_for_curing_process.php?trf_data=" + encodeURIComponent(get_all_value));
                    }



                    if(process_name== "Re-Singeing & Desizing"){
                      
                        $('#div_full_form').load("process_qc_result/qc_result_for_singe_and_desize_process.php?trf_data=" + encodeURIComponent(get_all_value));
                    }

                    if(process_name== "Re-Steaming"){
                        $('#div_full_form').load("process_qc_result/qc_result_for_steaming_process.php?trf_data=" + encodeURIComponent(get_all_value));
                    }

                    if(process_name== "Re-Ready For Dyeing"){
                        $('#div_full_form').load("process_qc_result/qc_result_for_ready_for_dying_process.php?trf_data=" + encodeURIComponent(get_all_value));
                    }

                    if(process_name== "Re-Washing"){
                        $('#div_full_form').load("process_qc_result/qc_result_for_washing_process.php?trf_data=" + encodeURIComponent(get_all_value));
                    }

                     if(process_name== "Re-Ready For Raising"){
                        $('#div_full_form').load("process_qc_result/qc_result_for_ready_for_raising_process.php?trf_data=" + encodeURIComponent(get_all_value));
                    }

                    if(process_name== "Re-Raising"){
                        $('#div_full_form').load("process_qc_result/qc_result_for_raising_process.php?trf_data=" + encodeURIComponent(get_all_value));
                    }

                    if(process_name== "Re-Finishing"){
                        $('#div_full_form').load("process_qc_result/qc_result_for_finishing_process.php?trf_data=" + encodeURIComponent(get_all_value));
                    }

                   if(process_name== "Re-Calander"){
                        $('#div_full_form').load("process_qc_result/qc_result_for_calendering_process.php?trf_data=" + encodeURIComponent(get_all_value));
                    } 

                   if(process_name== "Re-Sanforizing"){
                        $('#div_full_form').load("process_qc_result/qc_result_for_sanforizing_process.php?trf_data=" + encodeURIComponent(get_all_value));
                    }  

                  if(process_name== "Re-Scouring"){
                        $('#div_full_form').load("process_qc_result/qc_result_for_scouring_process.php?trf_data=" + encodeURIComponent(get_all_value));
                    }


                    if(process_name== "Re-Bleaching"){
                        $('#div_full_form').load("process_qc_result/qc_result_for_bleaching_process.php?trf_data=" + encodeURIComponent(get_all_value));
                    }

                  if(process_name== "Re-Scouring & Bleaching"){
                        $('#div_full_form').load("process_qc_result/qc_result_for_scouring_bleaching_process.php?trf_data=" + encodeURIComponent(get_all_value));
                    }

                   if(process_name== "Re-Ready For Mercerize"){
                        $('#div_full_form').load("process_qc_result/qc_result_for_ready_for_mercerize_process.php?trf_data=" + encodeURIComponent(get_all_value));
                    } 

                    if(process_name== "Re-Mercerize"){
                        $('#div_full_form').load("process_qc_result/qc_result_for_mercerize_process.php?trf_data=" + encodeURIComponent(get_all_value));
                    }
                  if(process_name== "Re-Ready For Print"){
                        $('#div_full_form').load("process_qc_result/qc_result_for_ready_for_printing_process.php?trf_data=" + encodeURIComponent(get_all_value));
                    }

                  if(process_name== "Re-Greige Receiving"){
                        $('#div_full_form').load("process_qc_result/qc_result_for_greige_receiveing_process.php?trf_data=" + encodeURIComponent(get_all_value));
                    }  
  
                   if(process_name== "Re-Printing"){
                        $('#div_full_form').load("process_qc_result/qc_result_for_printing_process.php?trf_data=" + encodeURIComponent(get_all_value));
                    }

                    if(process_name== "Re-Curing"){
                        $('#div_full_form').load("process_qc_result/qc_result_for_curing_process.php?trf_data=" + encodeURIComponent(get_all_value));
                    }


                    //2nd-Re_process


                     if(process_name== "2nd-Re-Singeing & Desizing"){
                      
                        $('#div_full_form').load("process_qc_result/qc_result_for_singe_and_desize_process.php?trf_data=" + encodeURIComponent(get_all_value));
                    }

                    if(process_name== "2nd-Re-Steaming"){
                        $('#div_full_form').load("process_qc_result/qc_result_for_steaming_process.php?trf_data=" + encodeURIComponent(get_all_value));
                    }

                    if(process_name== "2nd-Re-Ready For Dyeing"){
                        $('#div_full_form').load("process_qc_result/qc_result_for_ready_for_dying_process.php?trf_data=" + encodeURIComponent(get_all_value));
                    }

                    if(process_name== "2nd-Re-Washing"){
                        $('#div_full_form').load("process_qc_result/qc_result_for_washing_process.php?trf_data=" + encodeURIComponent(get_all_value));
                    }

                     if(process_name== "2nd-Re-Ready For Raising"){
                        $('#div_full_form').load("process_qc_result/qc_result_for_ready_for_raising_process.php?trf_data=" + encodeURIComponent(get_all_value));
                    }

                    if(process_name== "2nd-Re-Raising"){
                        $('#div_full_form').load("process_qc_result/qc_result_for_raising_process.php?trf_data=" + encodeURIComponent(get_all_value));
                    }

                    if(process_name== "2nd-Re-Finishing"){
                        $('#div_full_form').load("process_qc_result/qc_result_for_finishing_process.php?trf_data=" + encodeURIComponent(get_all_value));
                    }

                   if(process_name== "2nd-Re-Calander"){
                        $('#div_full_form').load("process_qc_result/qc_result_for_calendering_process.php?trf_data=" + encodeURIComponent(get_all_value));
                    } 

                   if(process_name== "2nd-Re-Sanforizing"){
                        $('#div_full_form').load("process_qc_result/qc_result_for_sanforizing_process.php?trf_data=" + encodeURIComponent(get_all_value));
                    }  

                  if(process_name== "2nd-Re-Scouring"){
                        $('#div_full_form').load("process_qc_result/qc_result_for_scouring_process.php?trf_data=" + encodeURIComponent(get_all_value));
                    }


                    if(process_name== "2nd-Re-Bleaching"){
                        $('#div_full_form').load("process_qc_result/qc_result_for_bleaching_process.php?trf_data=" + encodeURIComponent(get_all_value));
                    }

                  if(process_name== "2nd-Re-Scouring & Bleaching"){
                        $('#div_full_form').load("process_qc_result/qc_result_for_scouring_bleaching_process.php?trf_data=" + encodeURIComponent(get_all_value));
                    }

                   if(process_name== "2nd-Re-Ready For Mercerize"){
                        $('#div_full_form').load("process_qc_result/qc_result_for_ready_for_mercerize_process.php?trf_data=" + encodeURIComponent(get_all_value));
                    } 

                    if(process_name== "2nd-Re-Mercerize"){
                        $('#div_full_form').load("process_qc_result/qc_result_for_mercerize_process.php?trf_data=" + encodeURIComponent(get_all_value));
                    }
                  if(process_name== "2nd-Re-Ready For Print"){
                        $('#div_full_form').load("process_qc_result/qc_result_for_ready_for_printing_process.php?trf_data=" + encodeURIComponent(get_all_value));
                    }

                  if(process_name== "2nd-Re-Greige Receiving"){
                        $('#div_full_form').load("process_qc_result/qc_result_for_greige_receiveing_process.php?trf_data=" + encodeURIComponent(get_all_value));
                    }  
  
                   if(process_name== "2nd-Re-Printing"){
                        $('#div_full_form').load("process_qc_result/qc_result_for_printing_process.php?trf_data=" + encodeURIComponent(get_all_value));
                    }

                    if(process_name== "2nd-Re-Curing"){
                        $('#div_full_form').load("process_qc_result/qc_result_for_curing_process.php?trf_data=" + encodeURIComponent(get_all_value));
                    }

                  //3rd-Re-Process

                   if(process_name== "3rd-Re-Singeing & Desizing"){
                     
                        $('#div_full_form').load("process_qc_result/qc_result_for_singe_and_desize_process.php?trf_data=" + encodeURIComponent(get_all_value));
                    }

                    if(process_name== "3rd-Re-Steaming"){
                        $('#div_full_form').load("process_qc_result/qc_result_for_steaming_process.php?trf_data=" + encodeURIComponent(get_all_value));
                    }

                    if(process_name== "3rd-Re-Ready For Dyeing"){
                        $('#div_full_form').load("process_qc_result/qc_result_for_ready_for_dying_process.php?trf_data=" + encodeURIComponent(get_all_value));
                    }

                    if(process_name== "3rd-Re-Washing"){
                        $('#div_full_form').load("process_qc_result/qc_result_for_washing_process.php?trf_data=" + encodeURIComponent(get_all_value));
                    }

                     if(process_name== "3rd-Re-Ready For Raising"){
                        $('#div_full_form').load("process_qc_result/qc_result_for_ready_for_raising_process.php?trf_data=" + encodeURIComponent(get_all_value));
                    }

                    if(process_name== "3rd-Re-Raising"){
                        $('#div_full_form').load("process_qc_result/qc_result_for_raising_process.php?trf_data=" + encodeURIComponent(get_all_value));
                    }

                    if(process_name== "3rd-Re-Finishing"){
                        $('#div_full_form').load("process_qc_result/qc_result_for_finishing_process.php?trf_data=" + encodeURIComponent(get_all_value));
                    }

                   if(process_name== "3rd-Re-Calander"){
                        $('#div_full_form').load("process_qc_result/qc_result_for_calendering_process.php?trf_data=" + encodeURIComponent(get_all_value));
                    } 

                   if(process_name== "3rd-Re-Sanforizing"){
                        $('#div_full_form').load("process_qc_result/qc_result_for_sanforizing_process.php?trf_data=" + encodeURIComponent(get_all_value));
                    }  

                  if(process_name== "3rd-Re-Scouring"){
                        $('#div_full_form').load("process_qc_result/qc_result_for_scouring_process.php?trf_data=" + encodeURIComponent(get_all_value));
                    }


                    if(process_name== "3rd-Re-Bleaching"){
                        $('#div_full_form').load("process_qc_result/qc_result_for_bleaching_process.php?trf_data=" + encodeURIComponent(get_all_value));
                    }

                  if(process_name== "3rd-Re-Scouring & Bleaching"){
                        $('#div_full_form').load("process_qc_result/qc_result_for_scouring_bleaching_process.php?trf_data=" + encodeURIComponent(get_all_value));
                    }

                   if(process_name== "3rd-Re-Ready For Mercerize"){
                        $('#div_full_form').load("process_qc_result/qc_result_for_ready_for_mercerize_process.php?trf_data=" + encodeURIComponent(get_all_value));
                    } 

                    if(process_name== "3rd-Re-Mercerize"){
                        $('#div_full_form').load("process_qc_result/qc_result_for_mercerize_process.php?trf_data=" + encodeURIComponent(get_all_value));
                    }
                  if(process_name== "3rd-Re-Ready For Print"){
                        $('#div_full_form').load("process_qc_result/qc_result_for_ready_for_printing_process.php?trf_data=" + encodeURIComponent(get_all_value));
                    }

                  if(process_name== "3rd-Re-Greige Receiving"){
                        $('#div_full_form').load("process_qc_result/qc_result_for_greige_receiveing_process.php?trf_data=" + encodeURIComponent(get_all_value));
                    }  
  
                   if(process_name== "3rd-Re-Printing"){
                        $('#div_full_form').load("process_qc_result/qc_result_for_printing_process.php?trf_data=" + encodeURIComponent(get_all_value));
                    }

                    if(process_name== "3rd-Re-Curing"){
                        $('#div_full_form').load("process_qc_result/qc_result_for_curing_process.php?trf_data=" + encodeURIComponent(get_all_value));
                    }

                    //4th-Re-Process

                     if(process_name== "4th-Re-Singeing & Desizing"){
                     
                        $('#div_full_form').load("process_qc_result/qc_result_for_singe_and_desize_process.php?trf_data=" + encodeURIComponent(get_all_value));
                    }

                    if(process_name== "4th-Re-Steaming"){
                        $('#div_full_form').load("process_qc_result/qc_result_for_steaming_process.php?trf_data=" + encodeURIComponent(get_all_value));
                    }

                    if(process_name== "4th-Re-Ready For Dyeing"){
                        $('#div_full_form').load("process_qc_result/qc_result_for_ready_for_dying_process.php?trf_data=" + encodeURIComponent(get_all_value));
                    }

                    if(process_name== "4th-Re-Washing"){
                        $('#div_full_form').load("process_qc_result/qc_result_for_washing_process.php?trf_data=" + encodeURIComponent(get_all_value));
                    }

                     if(process_name== "4th-Re-Ready For Raising"){
                        $('#div_full_form').load("process_qc_result/qc_result_for_ready_for_raising_process.php?trf_data=" + encodeURIComponent(get_all_value));
                    }

                    if(process_name== "4th-Re-Raising"){
                        $('#div_full_form').load("process_qc_result/qc_result_for_raising_process.php?trf_data=" + encodeURIComponent(get_all_value));
                    }

                    if(process_name== "4th-Re-Finishing"){
                        $('#div_full_form').load("process_qc_result/qc_result_for_finishing_process.php?trf_data=" + encodeURIComponent(get_all_value));
                    }

                   if(process_name== "4th-Re-Calander"){
                        $('#div_full_form').load("process_qc_result/qc_result_for_calendering_process.php?trf_data=" + encodeURIComponent(get_all_value));
                    } 

                   if(process_name== "4th-Re-Sanforizing"){
                        $('#div_full_form').load("process_qc_result/qc_result_for_sanforizing_process.php?trf_data=" + encodeURIComponent(get_all_value));
                    }  

                  if(process_name== "4th-Re-Scouring"){
                        $('#div_full_form').load("process_qc_result/qc_result_for_scouring_process.php?trf_data=" + encodeURIComponent(get_all_value));
                    }


                    if(process_name== "4th-Re-Bleaching"){
                        $('#div_full_form').load("process_qc_result/qc_result_for_bleaching_process.php?trf_data=" + encodeURIComponent(get_all_value));
                    }

                  if(process_name== "4th-Re-Scouring & Bleaching"){
                        $('#div_full_form').load("process_qc_result/qc_result_for_scouring_bleaching_process.php?trf_data=" + encodeURIComponent(get_all_value));
                    }

                   if(process_name== "4th-Re-Ready For Mercerize"){
                        $('#div_full_form').load("process_qc_result/qc_result_for_ready_for_mercerize_process.php?trf_data=" + encodeURIComponent(get_all_value));
                    } 

                    if(process_name== "4th-Re-Mercerize"){
                        $('#div_full_form').load("process_qc_result/qc_result_for_mercerize_process.php?trf_data=" + encodeURIComponent(get_all_value));
                    }
                  if(process_name== "4th-Re-Ready For Print"){
                        $('#div_full_form').load("process_qc_result/qc_result_for_ready_for_printing_process.php?trf_data=" + encodeURIComponent(get_all_value));
                    }

                  if(process_name== "4th-Re-Greige Receiving"){
                        $('#div_full_form').load("process_qc_result/qc_result_for_greige_receiveing_process.php?trf_data=" + encodeURIComponent(get_all_value));
                    }  
  
                   if(process_name== "4th-Re-Printing"){
                        $('#div_full_form').load("process_qc_result/qc_result_for_printing_process.php?trf_data=" + encodeURIComponent(get_all_value));
                    }

                    if(process_name== "4th-Re-Curing"){
                        $('#div_full_form').load("process_qc_result/qc_result_for_curing_process.php?trf_data=" + encodeURIComponent(get_all_value));
                    }
                    
                      else{
                         
                      }
                    
                   
                },
                error: function( jqXhr, textStatus, errorThrown )
                {
       
                    alert(errorThrown);
                }
             }); // End of $.ajax({



              }
                   /*End of if(data== "Data is successfully saved.")*/


          },
          error: function( jqXhr, textStatus, errorThrown )
          {
              //console.log( errorThrown );
              alert(errorThrown);
          }
       }); // End of $.ajax({

       /*}*///End of if(validate != false)

 }//End of function sending_data_of_partial_test_for_test_result_form_for_saving_in_database()


                         /*         TEST RESULT ENTRY Form              */

 function sending_data_of_partial_test_for_test_result_form_for_getting_data_from_database(value)
 {

   
      
                var url_encoded_form_data = 'all_value='+value;
                
                $.ajax({
                url: 'test_result/returning_value_for_partial_test_from_direct_entry.php',
                dataType: 'text',
                type: 'post',
                contentType: 'application/x-www-form-urlencoded',
                data: url_encoded_form_data,
                success: function( data, textStatus, jQxhr )
                { 


                   
                    var data_split_for_result= data.split("?fs?");
                    var process_name= data_split_for_result[5];
                   

                    var get_all_value=data_split_for_result[0]+"?fs?partial_test_for_test_result_info?fs?partial_test_for_test_result_id";

                    


                    if(process_name== "Singeing & Desizing"){
                     
                        $('#div_full_form').load("process_qc_result/qc_result_for_singe_and_desize_process.php?trf_data=" + encodeURIComponent(get_all_value));
                    }

                    if(process_name== "Steaming"){
                        $('#div_full_form').load("process_qc_result/qc_result_for_steaming_process.php?trf_data=" + encodeURIComponent(get_all_value));
                    }

                    if(process_name== "Ready For Dyeing"){
                        $('#div_full_form').load("process_qc_result/qc_result_for_ready_for_dying_process.php?trf_data=" + encodeURIComponent(get_all_value));
                    }

                    if(process_name== "Washing"){
                        $('#div_full_form').load("process_qc_result/qc_result_for_washing_process.php?trf_data=" + encodeURIComponent(get_all_value));
                    }

                     if(process_name== "Ready For Raising"){
                        $('#div_full_form').load("process_qc_result/qc_result_for_ready_for_raising_process.php?trf_data=" + encodeURIComponent(get_all_value));
                    }

                    if(process_name== "Raising"){
                        $('#div_full_form').load("process_qc_result/qc_result_for_raising_process.php?trf_data=" + encodeURIComponent(get_all_value));
                    }

                    if(process_name== "Finishing"){
                        $('#div_full_form').load("process_qc_result/qc_result_for_finishing_process.php?trf_data=" + encodeURIComponent(get_all_value));
                    }

                   if(process_name== "Calander"){
                        $('#div_full_form').load("process_qc_result/qc_result_for_calendering_process.php?trf_data=" + encodeURIComponent(get_all_value));
                    } 

                   if(process_name== "Sanforizing"){
                        $('#div_full_form').load("process_qc_result/qc_result_for_sanforizing_process.php?trf_data=" + encodeURIComponent(get_all_value));
                    }  

                  if(process_name== "Scouring"){
                        $('#div_full_form').load("process_qc_result/qc_result_for_scouring_process.php?trf_data=" + encodeURIComponent(get_all_value));
                    }


                    if(process_name== "Bleaching"){
                        $('#div_full_form').load("process_qc_result/qc_result_for_bleaching_process.php?trf_data=" + encodeURIComponent(get_all_value));
                    }

                  if(process_name== "Scouring & Bleaching"){
                        $('#div_full_form').load("process_qc_result/qc_result_for_scouring_bleaching_process.php?trf_data=" + encodeURIComponent(get_all_value));
                    }

                   if(process_name== "Ready For Mercerize"){
                        $('#div_full_form').load("process_qc_result/qc_result_for_ready_for_mercerize_process.php?trf_data=" + encodeURIComponent(get_all_value));
                    } 

                    if(process_name== "Mercerize"){
                        $('#div_full_form').load("process_qc_result/qc_result_for_mercerize_process.php?trf_data=" + encodeURIComponent(get_all_value));
                    }
                  if(process_name== "Ready For Print"){
                        $('#div_full_form').load("process_qc_result/qc_result_for_ready_for_printing_process.php?trf_data=" + encodeURIComponent(get_all_value));
                    }

                  if(process_name== "Greige Receiving"){
                        $('#div_full_form').load("process_qc_result/qc_result_for_greige_receiveing_process.php?trf_data=" + encodeURIComponent(get_all_value));
                    }  
  
                   if(process_name== "Printing"){
                        $('#div_full_form').load("process_qc_result/qc_result_for_printing_process.php?trf_data=" + encodeURIComponent(get_all_value));
                    }

                    if(process_name== "Curing"){
                        $('#div_full_form').load("process_qc_result/qc_result_for_curing_process.php?trf_data=" + encodeURIComponent(get_all_value));
                    }

                    if(process_name== "Re-Singeing & Desizing"){
                      
                        $('#div_full_form').load("process_qc_result/qc_result_for_singe_and_desize_process.php?trf_data=" + encodeURIComponent(get_all_value));
                    }

                    if(process_name== "Re-Steaming"){
                        $('#div_full_form').load("process_qc_result/qc_result_for_steaming_process.php?trf_data=" + encodeURIComponent(get_all_value));
                    }

                    if(process_name== "Re-Ready For Dyeing"){
                        $('#div_full_form').load("process_qc_result/qc_result_for_ready_for_dying_process.php?trf_data=" + encodeURIComponent(get_all_value));
                    }

                    if(process_name== "Re-Washing"){
                        $('#div_full_form').load("process_qc_result/qc_result_for_washing_process.php?trf_data=" + encodeURIComponent(get_all_value));
                    }

                     if(process_name== "Re-Ready For Raising"){
                        $('#div_full_form').load("process_qc_result/qc_result_for_ready_for_raising_process.php?trf_data=" + encodeURIComponent(get_all_value));
                    }

                    if(process_name== "Re-Raising"){
                        $('#div_full_form').load("process_qc_result/qc_result_for_raising_process.php?trf_data=" + encodeURIComponent(get_all_value));
                    }

                    if(process_name== "Re-Finishing"){
                        $('#div_full_form').load("process_qc_result/qc_result_for_finishing_process.php?trf_data=" + encodeURIComponent(get_all_value));
                    }

                   if(process_name== "Re-Calander"){
                        $('#div_full_form').load("process_qc_result/qc_result_for_calendering_process.php?trf_data=" + encodeURIComponent(get_all_value));
                    } 

                   if(process_name== "Re-Sanforizing"){
                        $('#div_full_form').load("process_qc_result/qc_result_for_sanforizing_process.php?trf_data=" + encodeURIComponent(get_all_value));
                    }  

                  if(process_name== "Re-Scouring"){
                        $('#div_full_form').load("process_qc_result/qc_result_for_scouring_process.php?trf_data=" + encodeURIComponent(get_all_value));
                    }


                    if(process_name== "Re-Bleaching"){
                        $('#div_full_form').load("process_qc_result/qc_result_for_bleaching_process.php?trf_data=" + encodeURIComponent(get_all_value));
                    }

                  if(process_name== "Re-Scouring & Bleaching"){
                        $('#div_full_form').load("process_qc_result/qc_result_for_scouring_bleaching_process.php?trf_data=" + encodeURIComponent(get_all_value));
                    }

                   if(process_name== "Re-Ready For Mercerize"){
                        $('#div_full_form').load("process_qc_result/qc_result_for_ready_for_mercerize_process.php?trf_data=" + encodeURIComponent(get_all_value));
                    } 

                    if(process_name== "Re-Mercerize"){
                        $('#div_full_form').load("process_qc_result/qc_result_for_mercerize_process.php?trf_data=" + encodeURIComponent(get_all_value));
                    }
                  if(process_name== "Re-Ready For Print"){
                        $('#div_full_form').load("process_qc_result/qc_result_for_ready_for_printing_process.php?trf_data=" + encodeURIComponent(get_all_value));
                    }

                  if(process_name== "Re-Greige Receiving"){
                        $('#div_full_form').load("process_qc_result/qc_result_for_greige_receiveing_process.php?trf_data=" + encodeURIComponent(get_all_value));
                    }  
  
                   if(process_name== "Re-Printing"){
                        $('#div_full_form').load("process_qc_result/qc_result_for_printing_process.php?trf_data=" + encodeURIComponent(get_all_value));
                    }

                    if(process_name== "Re-Curing"){
                        $('#div_full_form').load("process_qc_result/qc_result_for_curing_process.php?trf_data=" + encodeURIComponent(get_all_value));
                    }


                    //2nd-Re-Process


                     if(process_name== "2nd-Re-Singeing & Desizing"){
                     
                        $('#div_full_form').load("process_qc_result/qc_result_for_singe_and_desize_process.php?trf_data=" + encodeURIComponent(get_all_value));
                    }

                    if(process_name== "2nd-Re-Steaming"){
                        $('#div_full_form').load("process_qc_result/qc_result_for_steaming_process.php?trf_data=" + encodeURIComponent(get_all_value));
                    }

                    if(process_name== "2nd-Re-Ready For Dyeing"){
                        $('#div_full_form').load("process_qc_result/qc_result_for_ready_for_dying_process.php?trf_data=" + encodeURIComponent(get_all_value));
                    }

                    if(process_name== "2nd-Re-Washing"){
                        $('#div_full_form').load("process_qc_result/qc_result_for_washing_process.php?trf_data=" + encodeURIComponent(get_all_value));
                    }

                     if(process_name== "2nd-Re-Ready For Raising"){
                        $('#div_full_form').load("process_qc_result/qc_result_for_ready_for_raising_process.php?trf_data=" + encodeURIComponent(get_all_value));
                    }

                    if(process_name== "2nd-Re-Raising"){
                        $('#div_full_form').load("process_qc_result/qc_result_for_raising_process.php?trf_data=" + encodeURIComponent(get_all_value));
                    }

                    if(process_name== "2nd-Re-Finishing"){
                        $('#div_full_form').load("process_qc_result/qc_result_for_finishing_process.php?trf_data=" + encodeURIComponent(get_all_value));
                    }

                   if(process_name== "2nd-Re-Calander"){
                        $('#div_full_form').load("process_qc_result/qc_result_for_calendering_process.php?trf_data=" + encodeURIComponent(get_all_value));
                    } 

                   if(process_name== "2nd-Re-Sanforizing"){
                        $('#div_full_form').load("process_qc_result/qc_result_for_sanforizing_process.php?trf_data=" + encodeURIComponent(get_all_value));
                    }  

                  if(process_name== "2nd-Re-Scouring"){
                        $('#div_full_form').load("process_qc_result/qc_result_for_scouring_process.php?trf_data=" + encodeURIComponent(get_all_value));
                    }


                    if(process_name== "2nd-Re-Bleaching"){
                        $('#div_full_form').load("process_qc_result/qc_result_for_bleaching_process.php?trf_data=" + encodeURIComponent(get_all_value));
                    }

                  if(process_name== "2nd-Re-Scouring & Bleaching"){
                        $('#div_full_form').load("process_qc_result/qc_result_for_scouring_bleaching_process.php?trf_data=" + encodeURIComponent(get_all_value));
                    }

                   if(process_name== "2nd-Re-Ready For Mercerize"){
                        $('#div_full_form').load("process_qc_result/qc_result_for_ready_for_mercerize_process.php?trf_data=" + encodeURIComponent(get_all_value));
                    } 

                    if(process_name== "2nd-Re-Mercerize"){
                        $('#div_full_form').load("process_qc_result/qc_result_for_mercerize_process.php?trf_data=" + encodeURIComponent(get_all_value));
                    }
                  if(process_name== "2nd-Re-Ready For Print"){
                        $('#div_full_form').load("process_qc_result/qc_result_for_ready_for_printing_process.php?trf_data=" + encodeURIComponent(get_all_value));
                    }

                  if(process_name== "2nd-Re-Greige Receiving"){
                        $('#div_full_form').load("process_qc_result/qc_result_for_greige_receiveing_process.php?trf_data=" + encodeURIComponent(get_all_value));
                    }  
  
                   if(process_name== "2nd-Re-Printing"){
                        $('#div_full_form').load("process_qc_result/qc_result_for_printing_process.php?trf_data=" + encodeURIComponent(get_all_value));
                    }

                    if(process_name== "2nd-Re-Curing"){
                        $('#div_full_form').load("process_qc_result/qc_result_for_curing_process.php?trf_data=" + encodeURIComponent(get_all_value));
                    }

                    //3rd-Reprocess


                     if(process_name== "3rd-Re-Singeing & Desizing"){
                     
                        $('#div_full_form').load("process_qc_result/qc_result_for_singe_and_desize_process.php?trf_data=" + encodeURIComponent(get_all_value));
                    }

                    if(process_name== "3rd-Re-Steaming"){
                        $('#div_full_form').load("process_qc_result/qc_result_for_steaming_process.php?trf_data=" + encodeURIComponent(get_all_value));
                    }

                    if(process_name== "3rd-Re-Ready For Dyeing"){
                        $('#div_full_form').load("process_qc_result/qc_result_for_ready_for_dying_process.php?trf_data=" + encodeURIComponent(get_all_value));
                    }

                    if(process_name== "3rd-Re-Washing"){
                        $('#div_full_form').load("process_qc_result/qc_result_for_washing_process.php?trf_data=" + encodeURIComponent(get_all_value));
                    }

                     if(process_name== "3rd-Re-Ready For Raising"){
                        $('#div_full_form').load("process_qc_result/qc_result_for_ready_for_raising_process.php?trf_data=" + encodeURIComponent(get_all_value));
                    }

                    if(process_name== "3rd-Re-Raising"){
                        $('#div_full_form').load("process_qc_result/qc_result_for_raising_process.php?trf_data=" + encodeURIComponent(get_all_value));
                    }

                    if(process_name== "3rd-Re-Finishing"){
                        $('#div_full_form').load("process_qc_result/qc_result_for_finishing_process.php?trf_data=" + encodeURIComponent(get_all_value));
                    }

                   if(process_name== "3rd-Re-Calander"){
                        $('#div_full_form').load("process_qc_result/qc_result_for_calendering_process.php?trf_data=" + encodeURIComponent(get_all_value));
                    } 

                   if(process_name== "3rd-Re-Sanforizing"){
                        $('#div_full_form').load("process_qc_result/qc_result_for_sanforizing_process.php?trf_data=" + encodeURIComponent(get_all_value));
                    }  

                  if(process_name== "3rd-Re-Scouring"){
                        $('#div_full_form').load("process_qc_result/qc_result_for_scouring_process.php?trf_data=" + encodeURIComponent(get_all_value));
                    }


                    if(process_name== "3rd-Re-Bleaching"){
                        $('#div_full_form').load("process_qc_result/qc_result_for_bleaching_process.php?trf_data=" + encodeURIComponent(get_all_value));
                    }

                  if(process_name== "3rd-Re-Scouring & Bleaching"){
                        $('#div_full_form').load("process_qc_result/qc_result_for_scouring_bleaching_process.php?trf_data=" + encodeURIComponent(get_all_value));
                    }

                   if(process_name== "3rd-Re-Ready For Mercerize"){
                        $('#div_full_form').load("process_qc_result/qc_result_for_ready_for_mercerize_process.php?trf_data=" + encodeURIComponent(get_all_value));
                    } 

                    if(process_name== "3rd-Re-Mercerize"){
                        $('#div_full_form').load("process_qc_result/qc_result_for_mercerize_process.php?trf_data=" + encodeURIComponent(get_all_value));
                    }
                  if(process_name== "3rd-Re-Ready For Print"){
                        $('#div_full_form').load("process_qc_result/qc_result_for_ready_for_printing_process.php?trf_data=" + encodeURIComponent(get_all_value));
                    }

                  if(process_name== "3rd-Re-Greige Receiving"){
                        $('#div_full_form').load("process_qc_result/qc_result_for_greige_receiveing_process.php?trf_data=" + encodeURIComponent(get_all_value));
                    }  
  
                   if(process_name== "3rd-Re-Printing"){
                        $('#div_full_form').load("process_qc_result/qc_result_for_printing_process.php?trf_data=" + encodeURIComponent(get_all_value));
                    }

                    if(process_name== "3rd-Re-Curing"){
                        $('#div_full_form').load("process_qc_result/qc_result_for_curing_process.php?trf_data=" + encodeURIComponent(get_all_value));
                    }

                    //4th-Reprocess

                     if(process_name== "4th-Re-Singeing & Desizing"){
                      
                        $('#div_full_form').load("process_qc_result/qc_result_for_singe_and_desize_process.php?trf_data=" + encodeURIComponent(get_all_value));
                    }

                    if(process_name== "4th-Re-Steaming"){
                        $('#div_full_form').load("process_qc_result/qc_result_for_steaming_process.php?trf_data=" + encodeURIComponent(get_all_value));
                    }

                    if(process_name== "4th-Re-Ready For Dyeing"){
                        $('#div_full_form').load("process_qc_result/qc_result_for_ready_for_dying_process.php?trf_data=" + encodeURIComponent(get_all_value));
                    }

                    if(process_name== "4th-Re-Washing"){
                        $('#div_full_form').load("process_qc_result/qc_result_for_washing_process.php?trf_data=" + encodeURIComponent(get_all_value));
                    }

                     if(process_name== "4th-Re-Ready For Raising"){
                        $('#div_full_form').load("process_qc_result/qc_result_for_ready_for_raising_process.php?trf_data=" + encodeURIComponent(get_all_value));
                    }

                    if(process_name== "4th-Re-Raising"){
                        $('#div_full_form').load("process_qc_result/qc_result_for_raising_process.php?trf_data=" + encodeURIComponent(get_all_value));
                    }

                    if(process_name== "4th-Re-Finishing"){
                        $('#div_full_form').load("process_qc_result/qc_result_for_finishing_process.php?trf_data=" + encodeURIComponent(get_all_value));
                    }

                   if(process_name== "4th-Re-Calander"){
                        $('#div_full_form').load("process_qc_result/qc_result_for_calendering_process.php?trf_data=" + encodeURIComponent(get_all_value));
                    } 

                   if(process_name== "4th-Re-Sanforizing"){
                        $('#div_full_form').load("process_qc_result/qc_result_for_sanforizing_process.php?trf_data=" + encodeURIComponent(get_all_value));
                    }  

                  if(process_name== "4th-Re-Scouring"){
                        $('#div_full_form').load("process_qc_result/qc_result_for_scouring_process.php?trf_data=" + encodeURIComponent(get_all_value));
                    }


                    if(process_name== "4th-Re-Bleaching"){
                        $('#div_full_form').load("process_qc_result/qc_result_for_bleaching_process.php?trf_data=" + encodeURIComponent(get_all_value));
                    }

                  if(process_name== "4th-Re-Scouring & Bleaching"){
                        $('#div_full_form').load("process_qc_result/qc_result_for_scouring_bleaching_process.php?trf_data=" + encodeURIComponent(get_all_value));
                    }

                   if(process_name== "4th-Re-Ready For Mercerize"){
                        $('#div_full_form').load("process_qc_result/qc_result_for_ready_for_mercerize_process.php?trf_data=" + encodeURIComponent(get_all_value));
                    } 

                    if(process_name== "4th-Re-Mercerize"){
                        $('#div_full_form').load("process_qc_result/qc_result_for_mercerize_process.php?trf_data=" + encodeURIComponent(get_all_value));
                    }
                  if(process_name== "4th-Re-Ready For Print"){
                        $('#div_full_form').load("process_qc_result/qc_result_for_ready_for_printing_process.php?trf_data=" + encodeURIComponent(get_all_value));
                    }

                  if(process_name== "4th-Re-Greige Receiving"){
                        $('#div_full_form').load("process_qc_result/qc_result_for_greige_receiveing_process.php?trf_data=" + encodeURIComponent(get_all_value));
                    }  
  
                   if(process_name== "4th-Re-Printing"){
                        $('#div_full_form').load("process_qc_result/qc_result_for_printing_process.php?trf_data=" + encodeURIComponent(get_all_value));
                    }

                    if(process_name== "4th-Re-Curing"){
                        $('#div_full_form').load("process_qc_result/qc_result_for_curing_process.php?trf_data=" + encodeURIComponent(get_all_value));
                    }
                    
                    
                      else{
                         
                      }
                    
                   
                },
                error: function( jqXhr, textStatus, errorThrown )
                {
       
                    alert(errorThrown);
                }
             }); // End of $.ajax({




 }//End of function sending_data_of_partial_test_for_test_result_form_for_saving_in_database()



                                /*              Edit TEST RESULT                    */ 



 function sending_data_for_edit_form_for_getting_data_from_database(value)
 {

   
      
                var url_encoded_form_data = 'all_value='+value;

                $.ajax({
                url: 'test_result/returning_value_for_partial_test_from_direct_entry.php',
                dataType: 'text',
                type: 'post',
                contentType: 'application/x-www-form-urlencoded',
                data: url_encoded_form_data,
                success: function( data, textStatus, jQxhr )
                { 


                   
                    var data_split_for_result= data.split("?fs?");
                    var process_name= data_split_for_result[5];
                   

                    var get_all_value=data_split_for_result[0]+"?fs?partial_test_for_test_result_info?fs?partial_test_for_test_result_id";

                    


                    if(process_name== "Singeing & Desizing"){
                     
                        $('#div_full_form').load("process_qc_result/edit_qc_result_for_singe_and_desize_process.php?trf_data=" + encodeURIComponent(get_all_value));
                    }

                    if(process_name== "Steaming"){
                        $('#div_full_form').load("process_qc_result/edit_qc_result_for_steaming_process.php?trf_data=" +encodeURIComponent(get_all_value));
                    }

                    if(process_name== "Ready For Dyeing"){
                        $('#div_full_form').load("process_qc_result/edit_qc_result_for_ready_for_dying_process.php?trf_data=" +encodeURIComponent(get_all_value));
                    }

                    if(process_name== "Washing"){
                        $('#div_full_form').load("process_qc_result/edit_qc_result_for_washing_process.php?trf_data=" + encodeURIComponent(get_all_value));
                    }

                     if(process_name== "Ready For Raising"){
                        $('#div_full_form').load("process_qc_result/edit_qc_result_for_ready_for_raising_process.php?trf_data=" + encodeURIComponent(get_all_value));
                    }

                    if(process_name== "Raising"){
                        $('#div_full_form').load("process_qc_result/edit_qc_result_for_raising_process.php?trf_data=" + encodeURIComponent(get_all_value));
                    }

                    if(process_name== "Finishing"){
                        $('#div_full_form').load("process_qc_result/edit_qc_result_for_finishing_process.php?trf_data=" + encodeURIComponent(get_all_value));
                    }

                   if(process_name== "Calander"){
                        $('#div_full_form').load("process_qc_result/edit_qc_result_for_calendering_process.php?trf_data=" + encodeURIComponent(get_all_value));
                    } 

                   if(process_name== "Sanforizing"){
                        $('#div_full_form').load("process_qc_result/edit_qc_result_for_sanforizing_process.php?trf_data=" + encodeURIComponent(get_all_value));
                    }  

                  if(process_name== "Scouring"){
                        $('#div_full_form').load("process_qc_result/edit_qc_result_for_scouring_process.php?trf_data=" + encodeURIComponent(get_all_value));
                    }


                    if(process_name== "Bleaching"){
                        $('#div_full_form').load("process_qc_result/edit_qc_result_for_bleaching_process.php?trf_data=" + encodeURIComponent(get_all_value));
                    }

                  if(process_name== "Scouring & Bleaching"){
                        $('#div_full_form').load("process_qc_result/edit_qc_result_for_scouring_bleaching_process.php?trf_data=" + encodeURIComponent(get_all_value));
                    }

                   if(process_name== "Ready For Mercerize"){
                        $('#div_full_form').load("process_qc_result/edit_qc_result_for_ready_for_mercerize_process.php?trf_data=" + encodeURIComponent(get_all_value));
                    } 

                    if(process_name== "Mercerize"){
                        $('#div_full_form').load("process_qc_result/edit_qc_result_for_mercerize_process.php?trf_data=" + encodeURIComponent(get_all_value));
                    }
                  if(process_name== "Ready For Print"){
                        $('#div_full_form').load("process_qc_result/edit_qc_result_for_ready_for_printing_process.php?trf_data=" + encodeURIComponent(get_all_value));
                    }

                  if(process_name== "Greige Receiving"){
                        $('#div_full_form').load("process_qc_result/edit_qc_result_for_greige_receiveing_process.php?trf_data=" + encodeURIComponent(get_all_value));
                    }  
  
                   if(process_name== "Printing"){
                        $('#div_full_form').load("process_qc_result/edit_qc_result_for_printing_process.php?trf_data=" + encodeURIComponent(get_all_value));
                    }

                    if(process_name== "Curing"){
                        $('#div_full_form').load("process_qc_result/edit_qc_result_for_curing_process.php?trf_data=" + encodeURIComponent(get_all_value));
                    }

                    //1st reprocess

                    if(process_name== "Re-Singeing & Desizing"){
                      
                        $('#div_full_form').load("process_qc_result/edit_qc_result_for_singe_and_desize_process.php?trf_data=" + encodeURIComponent(get_all_value));
                    }

                    if(process_name== "Re-Steaming"){
                        $('#div_full_form').load("process_qc_result/edit_qc_result_for_steaming_process.php?trf_data=" +encodeURIComponent(get_all_value));
                    }

                    if(process_name== "Re-Ready For Dyeing"){
                        $('#div_full_form').load("process_qc_result/edit_qc_result_for_ready_for_dying_process.php?trf_data=" +encodeURIComponent(get_all_value));
                    }

                    if(process_name== "Re-Washing"){
                        $('#div_full_form').load("process_qc_result/edit_qc_result_for_washing_process.php?trf_data=" + encodeURIComponent(get_all_value));
                    }

                     if(process_name== "Re-Ready For Raising"){
                        $('#div_full_form').load("process_qc_result/edit_qc_result_for_ready_for_raising_process.php?trf_data=" + encodeURIComponent(get_all_value));
                    }

                    if(process_name== "Re-Raising"){
                        $('#div_full_form').load("process_qc_result/edit_qc_result_for_raising_process.php?trf_data=" + encodeURIComponent(get_all_value));
                    }

                    if(process_name== "Re-Finishing"){
                        $('#div_full_form').load("process_qc_result/edit_qc_result_for_finishing_process.php?trf_data=" + encodeURIComponent(get_all_value));
                    }

                   if(process_name== "Re-Calander"){
                        $('#div_full_form').load("process_qc_result/edit_qc_result_for_calendering_process.php?trf_data=" + encodeURIComponent(get_all_value));
                    } 

                   if(process_name== "Re-Sanforizing"){
                        $('#div_full_form').load("process_qc_result/edit_qc_result_for_sanforizing_process.php?trf_data=" + encodeURIComponent(get_all_value));
                    }  

                  if(process_name== "Re-Scouring"){
                        $('#div_full_form').load("process_qc_result/edit_qc_result_for_scouring_process.php?trf_data=" + encodeURIComponent(get_all_value));
                    }


                    if(process_name== "Re-Bleaching"){
                        $('#div_full_form').load("process_qc_result/edit_qc_result_for_bleaching_process.php?trf_data=" + encodeURIComponent(get_all_value));
                    }

                  if(process_name== "Re-Scouring & Bleaching"){
                        $('#div_full_form').load("process_qc_result/edit_qc_result_for_scouring_bleaching_process.php?trf_data=" + encodeURIComponent(get_all_value));
                    }

                   if(process_name== "Re-Ready For Mercerize"){
                        $('#div_full_form').load("process_qc_result/edit_qc_result_for_ready_for_mercerize_process.php?trf_data=" + encodeURIComponent(get_all_value));
                    } 

                    if(process_name== "Re-Mercerize"){
                        $('#div_full_form').load("process_qc_result/edit_qc_result_for_mercerize_process.php?trf_data=" + encodeURIComponent(get_all_value));
                    }
                  if(process_name== "Re-Ready For Print"){
                        $('#div_full_form').load("process_qc_result/edit_qc_result_for_ready_for_printing_process.php?trf_data=" + encodeURIComponent(get_all_value));
                    }

                  if(process_name== "Re-Greige Receiving"){
                        $('#div_full_form').load("process_qc_result/edit_qc_result_for_greige_receiveing_process.php?trf_data=" + encodeURIComponent(get_all_value));
                    }  
  
                   if(process_name== "Re-Printing"){
                        $('#div_full_form').load("process_qc_result/edit_qc_result_for_printing_process.php?trf_data=" + encodeURIComponent(get_all_value));
                    }

                    if(process_name== "Re-Curing"){
                        $('#div_full_form').load("process_qc_result/edit_qc_result_for_curing_process.php?trf_data=" + encodeURIComponent(get_all_value));
                    }


                    //2nd-Reprocess



                    if(process_name== "2nd-Re-Singeing & Desizing"){
                      
                        $('#div_full_form').load("process_qc_result/edit_qc_result_for_singe_and_desize_process.php?trf_data=" + encodeURIComponent(get_all_value));
                    }

                    if(process_name== "2nd-Re-Steaming"){
                        $('#div_full_form').load("process_qc_result/edit_qc_result_for_steaming_process.php?trf_data=" +encodeURIComponent(get_all_value));
                    }

                    if(process_name== "2nd-Re-Ready For Dyeing"){
                        $('#div_full_form').load("process_qc_result/edit_qc_result_for_ready_for_dying_process.php?trf_data=" +encodeURIComponent(get_all_value));
                    }

                    if(process_name== "2nd-Re-Washing"){
                        $('#div_full_form').load("process_qc_result/edit_qc_result_for_washing_process.php?trf_data=" + encodeURIComponent(get_all_value));
                    }

                     if(process_name== "2nd-Re-Ready For Raising"){
                        $('#div_full_form').load("process_qc_result/edit_qc_result_for_ready_for_raising_process.php?trf_data=" + encodeURIComponent(get_all_value));
                    }

                    if(process_name== "2nd-Re-Raising"){
                        $('#div_full_form').load("process_qc_result/edit_qc_result_for_raising_process.php?trf_data=" + encodeURIComponent(get_all_value));
                    }

                    if(process_name== "2nd-Re-Finishing"){
                        $('#div_full_form').load("process_qc_result/edit_qc_result_for_finishing_process.php?trf_data=" + encodeURIComponent(get_all_value));
                    }

                   if(process_name== "2nd-Re-Calander"){
                        $('#div_full_form').load("process_qc_result/edit_qc_result_for_calendering_process.php?trf_data=" + encodeURIComponent(get_all_value));
                    } 

                   if(process_name== "2nd-Re-Sanforizing"){
                        $('#div_full_form').load("process_qc_result/edit_qc_result_for_sanforizing_process.php?trf_data=" + encodeURIComponent(get_all_value));
                    }  

                  if(process_name== "2nd-Re-Scouring"){
                        $('#div_full_form').load("process_qc_result/edit_qc_result_for_scouring_process.php?trf_data=" + encodeURIComponent(get_all_value));
                    }


                    if(process_name== "2nd-Re-Bleaching"){
                        $('#div_full_form').load("process_qc_result/edit_qc_result_for_bleaching_process.php?trf_data=" + encodeURIComponent(get_all_value));
                    }

                  if(process_name== "2nd-Re-Scouring & Bleaching"){
                        $('#div_full_form').load("process_qc_result/edit_qc_result_for_scouring_bleaching_process.php?trf_data=" + encodeURIComponent(get_all_value));
                    }

                   if(process_name== "2nd-Re-Ready For Mercerize"){
                        $('#div_full_form').load("process_qc_result/edit_qc_result_for_ready_for_mercerize_process.php?trf_data=" + encodeURIComponent(get_all_value));
                    } 

                    if(process_name== "2nd-Re-Mercerize"){
                        $('#div_full_form').load("process_qc_result/edit_qc_result_for_mercerize_process.php?trf_data=" + encodeURIComponent(get_all_value));
                    }
                  if(process_name== "2nd-Re-Ready For Print"){
                        $('#div_full_form').load("process_qc_result/edit_qc_result_for_ready_for_printing_process.php?trf_data=" + encodeURIComponent(get_all_value));
                    }

                  if(process_name== "2nd-Re-Greige Receiving"){
                        $('#div_full_form').load("process_qc_result/edit_qc_result_for_greige_receiveing_process.php?trf_data=" + encodeURIComponent(get_all_value));
                    }  
  
                   if(process_name== "2nd-Re-Printing"){
                        $('#div_full_form').load("process_qc_result/edit_qc_result_for_printing_process.php?trf_data=" + encodeURIComponent(get_all_value));
                    }

                    if(process_name== "2nd-Re-Curing"){
                        $('#div_full_form').load("process_qc_result/edit_qc_result_for_curing_process.php?trf_data=" + encodeURIComponent(get_all_value));
                    }

                    //3rd-Reporcess


                    if(process_name== "3rd-Re-Singeing & Desizing"){
                     
                        $('#div_full_form').load("process_qc_result/edit_qc_result_for_singe_and_desize_process.php?trf_data=" + encodeURIComponent(get_all_value));
                    }

                    if(process_name== "3rd-Re-Steaming"){
                        $('#div_full_form').load("process_qc_result/edit_qc_result_for_steaming_process.php?trf_data=" +encodeURIComponent(get_all_value));
                    }

                    if(process_name== "3rd-Re-Ready For Dyeing"){
                        $('#div_full_form').load("process_qc_result/edit_qc_result_for_ready_for_dying_process.php?trf_data=" +encodeURIComponent(get_all_value));
                    }

                    if(process_name== "3rd-Re-Washing"){
                        $('#div_full_form').load("process_qc_result/edit_qc_result_for_washing_process.php?trf_data=" + encodeURIComponent(get_all_value));
                    }

                     if(process_name== "3rd-Re-Ready For Raising"){
                        $('#div_full_form').load("process_qc_result/edit_qc_result_for_ready_for_raising_process.php?trf_data=" + encodeURIComponent(get_all_value));
                    }

                    if(process_name== "3rd-Re-Raising"){
                        $('#div_full_form').load("process_qc_result/edit_qc_result_for_raising_process.php?trf_data=" + encodeURIComponent(get_all_value));
                    }

                    if(process_name== "3rd-Re-Finishing"){
                        $('#div_full_form').load("process_qc_result/edit_qc_result_for_finishing_process.php?trf_data=" + encodeURIComponent(get_all_value));
                    }

                   if(process_name== "3rd-Re-Calander"){
                        $('#div_full_form').load("process_qc_result/edit_qc_result_for_calendering_process.php?trf_data=" + encodeURIComponent(get_all_value));
                    } 

                   if(process_name== "3rd-Re-Sanforizing"){
                        $('#div_full_form').load("process_qc_result/edit_qc_result_for_sanforizing_process.php?trf_data=" + encodeURIComponent(get_all_value));
                    }  

                  if(process_name== "3rd-Re-Scouring"){
                        $('#div_full_form').load("process_qc_result/edit_qc_result_for_scouring_process.php?trf_data=" + encodeURIComponent(get_all_value));
                    }


                    if(process_name== "3rd-Re-Bleaching"){
                        $('#div_full_form').load("process_qc_result/edit_qc_result_for_bleaching_process.php?trf_data=" + encodeURIComponent(get_all_value));
                    }

                  if(process_name== "3rd-Re-Scouring & Bleaching"){
                        $('#div_full_form').load("process_qc_result/edit_qc_result_for_scouring_bleaching_process.php?trf_data=" + encodeURIComponent(get_all_value));
                    }

                   if(process_name== "3rd-Re-Ready For Mercerize"){
                        $('#div_full_form').load("process_qc_result/edit_qc_result_for_ready_for_mercerize_process.php?trf_data=" + encodeURIComponent(get_all_value));
                    } 

                    if(process_name== "3rd-Re-Mercerize"){
                        $('#div_full_form').load("process_qc_result/edit_qc_result_for_mercerize_process.php?trf_data=" + encodeURIComponent(get_all_value));
                    }
                  if(process_name== "3rd-Re-Ready For Print"){
                        $('#div_full_form').load("process_qc_result/edit_qc_result_for_ready_for_printing_process.php?trf_data=" + encodeURIComponent(get_all_value));
                    }

                  if(process_name== "3rd-Re-Greige Receiving"){
                        $('#div_full_form').load("process_qc_result/edit_qc_result_for_greige_receiveing_process.php?trf_data=" + encodeURIComponent(get_all_value));
                    }  
  
                   if(process_name== "3rd-Re-Printing"){
                        $('#div_full_form').load("process_qc_result/edit_qc_result_for_printing_process.php?trf_data=" + encodeURIComponent(get_all_value));
                    }

                    if(process_name== "3rd-Re-Curing"){
                        $('#div_full_form').load("process_qc_result/edit_qc_result_for_curing_process.php?trf_data=" + encodeURIComponent(get_all_value));
                    }

                      


                //4th-Reporcess

                    if(process_name== "4th-Re-Singeing & Desizing"){
                      
                        $('#div_full_form').load("process_qc_result/edit_qc_result_for_singe_and_desize_process.php?trf_data=" + encodeURIComponent(get_all_value));
                    }

                    if(process_name== "4th-Re-Steaming"){
                        $('#div_full_form').load("process_qc_result/edit_qc_result_for_steaming_process.php?trf_data=" +encodeURIComponent(get_all_value));
                    }

                    if(process_name== "4th-Re-Ready For Dyeing"){
                        $('#div_full_form').load("process_qc_result/edit_qc_result_for_ready_for_dying_process.php?trf_data=" +encodeURIComponent(get_all_value));
                    }

                    if(process_name== "4th-Re-Washing"){
                        $('#div_full_form').load("process_qc_result/edit_qc_result_for_washing_process.php?trf_data=" + encodeURIComponent(get_all_value));
                    }

                     if(process_name== "4th-Re-Ready For Raising"){
                        $('#div_full_form').load("process_qc_result/edit_qc_result_for_ready_for_raising_process.php?trf_data=" + encodeURIComponent(get_all_value));
                    }

                    if(process_name== "4th-Re-Raising"){
                        $('#div_full_form').load("process_qc_result/edit_qc_result_for_raising_process.php?trf_data=" + encodeURIComponent(get_all_value));
                    }

                    if(process_name== "4th-Re-Finishing"){
                        $('#div_full_form').load("process_qc_result/edit_qc_result_for_finishing_process.php?trf_data=" + encodeURIComponent(get_all_value));
                    }

                   if(process_name== "4th-Re-Calander"){
                        $('#div_full_form').load("process_qc_result/edit_qc_result_for_calendering_process.php?trf_data=" + encodeURIComponent(get_all_value));
                    } 

                   if(process_name== "4th-Re-Sanforizing"){
                        $('#div_full_form').load("process_qc_result/edit_qc_result_for_sanforizing_process.php?trf_data=" + encodeURIComponent(get_all_value));
                    }  

                  if(process_name== "4th-Re-Scouring"){
                        $('#div_full_form').load("process_qc_result/edit_qc_result_for_scouring_process.php?trf_data=" + encodeURIComponent(get_all_value));
                    }


                    if(process_name== "4th-Re-Bleaching"){
                        $('#div_full_form').load("process_qc_result/edit_qc_result_for_bleaching_process.php?trf_data=" + encodeURIComponent(get_all_value));
                    }

                  if(process_name== "4th-Re-Scouring & Bleaching"){
                        $('#div_full_form').load("process_qc_result/edit_qc_result_for_scouring_bleaching_process.php?trf_data=" + encodeURIComponent(get_all_value));
                    }

                   if(process_name== "4th-Re-Ready For Mercerize"){
                        $('#div_full_form').load("process_qc_result/edit_qc_result_for_ready_for_mercerize_process.php?trf_data=" + encodeURIComponent(get_all_value));
                    } 

                    if(process_name== "4th-Re-Mercerize"){
                        $('#div_full_form').load("process_qc_result/edit_qc_result_for_mercerize_process.php?trf_data=" + encodeURIComponent(get_all_value));
                    }
                  if(process_name== "4th-Re-Ready For Print"){
                        $('#div_full_form').load("process_qc_result/edit_qc_result_for_ready_for_printing_process.php?trf_data=" + encodeURIComponent(get_all_value));
                    }

                  if(process_name== "4th-Re-Greige Receiving"){
                        $('#div_full_form').load("process_qc_result/edit_qc_result_for_greige_receiveing_process.php?trf_data=" + encodeURIComponent(get_all_value));
                    }  
  
                   if(process_name== "4th-Re-Printing"){
                        $('#div_full_form').load("process_qc_result/edit_qc_result_for_printing_process.php?trf_data=" + encodeURIComponent(get_all_value));
                    }

                    if(process_name== "4th-Re-Curing"){
                        $('#div_full_form').load("process_qc_result/edit_qc_result_for_curing_process.php?trf_data=" + encodeURIComponent(get_all_value));
                    }
                    
                      else{
                         
                      }
                    
                   
                },
                error: function( jqXhr, textStatus, errorThrown )
                {
       
                    alert(errorThrown);
                }
             }); // End of $.ajax({




 }//End of function sending_data_for_edit_form_for_getting_data_from_database()



  function sending_data_for_delete(partial_test_for_test_result_id)
 {
      
       var url_encoded_form_data = 'partial_test_for_test_result_id='+partial_test_for_test_result_id;
       
         $.ajax({
          url: 'test_result/deleting_test_result_info_for_parial_and_all.php',
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

 
 function sending_data_for_test_report(get_all_data)
 {
      
      var get_all_data=get_all_data;
       $('#div_full_form').load("report/pass_fail_report_for_partial_test.php?all_data="+encodeURIComponent(get_all_value));


 }//End of function sending_data_for_test_report()


</script>

    <div class="col-sm-12 col-md-12 col-lg-12">
        <div class="panel panel-default" id="div_full_form">

             <div class="panel-heading" style="color:#191970;"><b>Test Result Form (Partial Test)</b></div> <!-- This will create a upper block for FORM (Just Beautification) -->
                       
                         <br>
                          
                    
						 <form id='partial_test_for_test_result_form' name='partial_test_for_test_result_form'  action="" method="post" enctype="multipart/form-data" class="form-horizontal form-label-left" style="margin-bottom: 20px;">

						    <div class="form-group form-group-sm" id="form-group_for_partial_test_for_test_result_creation_date">
                <label class="control-label col-sm-3" for="partial_test_for_test_result_creation_date" style="color:#00008B;">Date: <span style="color:red">*</span> </label>
                <div class="col-sm-3">
                  <input type="text" class="form-control" id="partial_test_for_test_result_creation_date" name="partial_test_for_test_result_creation_date" value="<?php echo $row_for_test_result['partial_test_for_test_result_creation_date']?>" readonly> 
                </div>
                <div class="col-sm-2">
                  <input type="text" class="form-control" id="alternate_partial_test_for_test_result_creation_date_time" name="alternate_partial_test_for_test_result_creation_date_time" value="<?php echo $row_for_test_result['alternate_partial_test_for_test_result_creation_date_time']?>"  readonly>
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


                <div class="form-group form-group-sm" id="form-group_for_employee_name">
                        <label class="control-label col-sm-3" for="employee_name" style="margin-right:0px; color:#00008B;">Employee Name: <span style="trf_for_partial_test:red">*</span> </label>
                            <div class="col-sm-5">
                                <select  class="form-control" id="employee_name" name="employee_name" readonly>
                                            <option select="selected" value="<?php echo $row_for_test_result['employee_name']?>"><?php echo $row_for_test_result['employee_name']?></option>
                                            
                                </select>

                                <input type="hidden" class="form-control" id="employee_id" name="employee_id" value="<?php echo $row_for_test_result['employee_id']?>" readonly> 
                            </div>
                </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_employee_name"> -->



                    <div class="form-group form-group-sm" id="form-group_for_shift">
                        <label class="control-label col-sm-3" for="shift" style="margin-right:0px; color:#00008B;">Shift: <span style="color:red">*</span> </label>
                            <div class="col-sm-5">
                                <select  class="form-control" id="shift" name="shift" readonly>
                                            <option select="selected" value="<?php echo $row_for_test_result['shift']?>"><?php echo $row_for_test_result['shift']?></option>
                                            

                                                 
                                </select>
                            </div>
                    </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_shift"> -->
               <!--  onchange="get_all_value_for_trf()" -->



               



          <div class="form-group form-group-sm" id="form-group_for_trf_no">
                        <label class="control-label col-sm-3" for="trf_id" style="margin-right:0px; color:#00008B;">TRF No.:</label>
                            <div class="col-sm-5">
                                <select  class="form-control" id="trf_id" name="trf_id"  readonly>
                                            <option select="selected"  value="<?php echo $row_for_test_result['trf_id']?>"><?php echo $row_for_test_result['trf_id']?></option>
                                            
                                </select>
                            </div>
          </div>  <!-- End of <div class="form-group form-group-sm" id="form-group_for_process_name"> -->

          

          <div class="form-group form-group-sm" id="form-group_for_pp_number">
            <label class="control-label col-sm-3" for="pp_number" style="margin-right:0px; color:#00008B;" >PP Number: <span style="color:red">*</span> </label>
              <div class="col-sm-5">
                <select  class="form-control" id="pp_number" name="pp_number" readonly >
                      <option select="selected" value="<?php echo $row_for_test_result['pp_number']?>"><?php echo $row_for_test_result['pp_number']?></option>
                      
                </select>
              </div>
          </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_pp_number"> -->

            <div class="form-group form-group-sm" id="form-group_for_version_number">
            <label class="control-label col-sm-3" for="version_number" style="margin-right:0px; color:#00008B;">Version : <span style="color:red">*</span> </label>
              <div class="col-sm-5">
                <select  class="form-control" id="version_number" name="version_number"  readonly>
                      <option select="selected" value="<?php echo $row_for_test_result['version_number']?>"><?php echo $row_for_test_result['version_number']?></option>
                      
                </select>
              </div>

              <input type="hidden" id="version_id" name="version_id" value="<?php echo $row_for_test_result['version_id']?>">
            </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_version_number"> -->



            <div class="form-group form-group-sm" id="form-group_for_process_name">
                        <label class="control-label col-sm-3" for="process_name" style="margin-right:0px; color:#00008B;">Process Name: <span style="color:red">*</span> </label>
                            <div class="col-sm-5">
                                <select  class="form-control" id="process_name" name="process_name" readonly>
                                            <option select="selected" value="<?php echo $row_for_test_result['process_name']."?fs?".$row_for_test_result['process_id']?>"><?php echo $row_for_test_result['process_name']?></option>
                                           
                                </select>
                            </div>
          </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_process_name"> -->
    <!-- onchange="Fill_Value_Of_Version_Number_Field(this.value)"  -->


            <div class="form-group form-group-sm" id="form-group_for_week_in_year">
                                <label class="control-label col-sm-3" for="week_in_year" style="color:#00008B;">Week : <span style="color:red">*</span> </label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" id="week_in_year" name="week_in_year" value="<?php echo $row_for_test_result['week_in_year']?>" readonly>
                                </div>
                               
                                <i class="glyphicon glyphicon-remove" onclick="Remove_Value_Of_This_Element('week_in_year')"></i>
             </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_week_in_year"> -->

             <div class="form-group form-group-sm" id="form-group_for_design">
                <label class="control-label col-sm-3" for="design" style="color:#00008B;">Design:</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" id="design" name="design" value="<?php echo $row_for_test_result['design']?>" readonly>
            </div>
                <i class="glyphicon glyphicon-remove" onclick="Remove_Value_Of_This_Element('design')"></i>
            </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_design"> -->

             <div class="form-group form-group-sm" id="form-group_for_customer_name">
                                <label class="control-label col-sm-3" for="customer_name" style="color:#00008B;"> Customer Name: <span style="color:red">*</span> </label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" id="customer_name" name="customer_name" value="<?php echo $row_for_test_result['customer_name']?>" readonly>

                                    <input type="hidden" class="form-control" id="customer_id" name="customer_id" value="<?php echo $row_for_test_result['customer_id']?>">
                                </div>
                                <i class="glyphicon glyphicon-remove" onclick="Remove_Value_Of_This_Element('customer_name')"></i>
             </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_customer_name"> -->
 

              <!-- For style Entry -->

              <input type="hidden" class="form-control" id="style" name="style" value="<?php echo $row_for_test_result['style']?>">

              

             <div class="form-group form-group-sm" id="form-group_for_fiber_composition">
                                <label class="control-label col-sm-3" for="fiber_composition" style="color:#00008B;">Fiber Composition: <span style="color:red">*</span> </label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" id="fiber_composition" name="fiber_composition" value="<?php echo $row_for_test_result['fiber_composition']?>" readonly>
                                </div>
                                <i class="glyphicon glyphicon-remove" onclick="Remove_Value_Of_This_Element('fiber_composition')"></i>
              </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_fiber_composition"> -->

             

              <div class="form-group form-group-sm" id="form-group_for_finish_width_in_inch">
                        <label class="control-label col-sm-3" for="finish_width_in_inch" style="margin-right:0px; color:#00008B;">Finish Width in Inch: <span style="color:red">*</span> </label>
                            <div class="col-sm-5">
                                <select  class="form-control" id="finish_width_in_inch" name="finish_width_in_inch" readonly>
                                            <option select="selected" value="<?php echo $row_for_test_result['finish_width_in_inch']?>"><?php echo $row_for_test_result['finish_width_in_inch']?></option>
                                            
                                </select>
                            </div>
                </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_finish_width_in_inch"> -->




           <div class="form-group form-group-sm" id="form-group_for_before_trolley_number_or_batcher_number">
                        <label class="control-label col-sm-3" for="before_trolley_number_or_batcher_number" style="margin-right:0px; color:#00008B;">Before Trolley or Batcher Number: <span style="color:red">*</span> </label>
                            <div class="col-sm-5">
                                <select  class="form-control" id="before_trolley_number_or_batcher_number" name="before_trolley_number_or_batcher_number"  onchange="return_trolley_quantity(this.value)">
                                          
                                 <option select="selected" value="<?php echo $row_for_test_result['before_trolley_number_or_batcher_number']?>"><?php echo $row_for_test_result['before_trolley_number_or_batcher_number']?></option>
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
                                    <option select="selected" value="<?php echo $row_for_test_result['after_trolley_number_or_batcher_number']?>"><?php echo $row_for_test_result['after_trolley_number_or_batcher_number']?></option>
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
                                <input type="text" class="form-control" id="before_trolley_or_batcher_in_time" name="before_trolley_or_batcher_in_time" value="<?php echo $row_for_test_result['before_trolley_or_batcher_in_time']?>" required>
                            </div>
              </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_before_trolley_or_batcher_in_time"> -->

               <div class="form-group form-group-sm" id="form-group_for_after_trolley_or_batcher_out_time">
                        <label class="control-label col-sm-3" for="after_trolley_or_batcher_out_time" style="margin-right:0px; color:#00008B;">After Trolley Out Time or Batcher Out Time:  </label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" id="after_trolley_or_batcher_out_time" name="after_trolley_or_batcher_out_time" value="<?php echo $row_for_test_result['after_trolley_or_batcher_out_time']?>" required>
                            </div>
              </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_after_trolley_or_batcher_out_time"> -->



             <div class="form-group form-group-sm" id="form-group_for_qty">
                                <label class="control-label col-sm-3" for="qbefore_trolley_or_batcher_qtyty_label" style="color:#00008B;">Before Trolley  or Batcher Quantiy: <span style="color:red">*</span> </label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" id="before_trolley_or_batcher_qty" name="before_trolley_or_batcher_qty" value="<?php echo $row_for_test_result['before_trolley_or_batcher_qty']?>" required>
                                </div>
                                <i class="glyphicon glyphicon-remove" onclick="Remove_Value_Of_This_Element('before_trolley_or_batcher_qty')"></i>
              </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_qty"> -->

                <div class="form-group form-group-sm" id="form-group_for_qty">
                                <label class="control-label col-sm-3" for="before_trolley_or_batcher_qty_label" style="color:#00008B;">After Trolley  or Batcher Quantiy: <span style="color:red">*</span> </label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" id="after_trolley_or_batcher_qty" name="after_trolley_or_batcher_qty" value="<?php echo $row_for_test_result['after_trolley_or_batcher_qty']?>" required>
                                </div>
                                <i class="glyphicon glyphicon-remove" onclick="Remove_Value_Of_This_Element('after_trolley_or_batcher_qty')"></i>
              </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_qty"> -->

                         
            


                        <div class="form-group form-group-sm" id="form-group_for_machine_name">
                        <label class="control-label col-sm-3" for="machine_name" style="margin-right:0px; color:#00008B;">Machine:  </label>
                            <div class="col-sm-5">
                                <select  class="form-control" id="machine_name" name="machine_name" readonly>
                                            <option select="selected" value="<?php echo $row_for_test_result['machine_name']?>"><?php echo $row_for_test_result['machine_name']?></option>
                                            
                                </select>
                            </div>
                        </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_machine_name"> -->


                     <div class="form-group form-group-sm" id="form-group_for_service_type">
                        <label class="control-label col-sm-3" for="service_type_value" style="margin-right:0px; color:#00008B;">Service Type: <span style="color:red">*</span> </label>
                            <div class="col-sm-5">
                                <select  class="form-control" id="service_type" name="service_type" readonly>
                                            <option select="selected" value="<?php echo $row_for_test_result['service_type']?>"><?php echo $row_for_test_result['service_type']?></option>
                                            

                                                 
                                </select>
                            </div>
                    </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_service_type"> -->
 							
							

						           <div class="form-group">
								

                            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                             
                              <button type="button" name="submit" id="submit" class="btn btn-primary" data-toggle="modal" data-target="#Showpartial_test_for_test_result" onClick="sending_data_of_partial_test_for_test_result_form_for_saving_in_database()">Submit</button>
                              <button type="reset" name="reset" id="reset" class="btn btn-success">Reset</button>

                              <!-- <button type="button" name="submit" id="submit" class="btn btn-success" data-toggle="modal" data-target="#Showpartial_test_for_test_result">show </button> -->
                              
                            </div>
                      </div> <!--  End of <div class="form-group"> -->
               




    <div class="panel panel-default">

        
          <div class="form-group form-group-sm" >
           <label class="control-label col-sm-3" for="search" style="float: left">Partial Test Result List</label>
          </div> <!-- End of <div class="form-group form-group-sm" -->


        
          <table id="datatable-buttons" class="table table-hover table-bordered">
           <thead>
                 <tr>
               
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
                            $sql_for_trf_for_partial_test = "SELECT * FROM `partial_test_for_test_result_info` ORDER BY partial_test_for_test_result_id ASC";

                            $res_for_trf_for_partial_test = mysqli_query($con, $sql_for_trf_for_partial_test);

                            while ($row = mysqli_fetch_assoc($res_for_trf_for_partial_test)) 
                            {
                               

                              $pp_number=$row['pp_number'];
                              $version_number=$row['version_number'];
                              $style_name=$row['style'];
                              $finish_width_in_inch=$row['finish_width_in_inch'];

                              
                              $sql_for_pp_color = "select color from `pp_wise_version_creation_info` where pp_number='$pp_number' and version_name='$version_number' and style_name='$style_name' and finish_width_in_inch='$finish_width_in_inch'";
                            $result_for_pp_color= mysqli_query($con,$sql_for_pp_color) or die(mysqli_error($con));
                            $row_for_pp_color=mysqli_fetch_array($result_for_pp_color);


                               $trf_id=$row['trf_id'];
                               $split_trf_data=explode('_', $trf_id);
                               $data_for_at=$split_trf_data[1];

                              $process_name=$row['process_name'];
                               $split_process_name_data=explode('-', $process_name);
                               $data_for_process_name=$split_process_name_data[0];
                              
                               
                              
                              
                               if( $data_for_process_name=='Re')
                               {

             ?>

             <tr>
                
                <td><?php 
                  if($row['trf_id']=='select')
                  {


                  }
                  else
                  {
                    echo $row['trf_id'];
                  }
                  ?>
                </td>
                <td><?php echo $row['pp_number']; ?></td>
                <td><?php echo $row['version_number']; ?></td>
                <td><?php echo $row['style']; ?></td>
                <td><?php echo $row_for_pp_color['color']; ?></td>
                <td><?php echo $row['process_name']; ?></td>
                <td><?php echo $row['customer_name']; ?></td>
                <td><?php echo $row['before_trolley_or_batcher_qty']; ?></td>
                <td><?php echo $row['after_trolley_or_batcher_qty']; ?></td>
                <td>
                      

              <?php $value= $row['customer_id']."?fs?".$row['trf_id']."?fs?".$row['process_id']."?fs?".$row['pp_number']."?fs?".$row['version_id']."?fs?".$row['partial_test_for_test_result_id']?>           
             <?php $value_for_edit= $row['customer_id']."?fs?".$row['trf_id']."?fs?".$row['process_id']."?fs?".$row['pp_number']."?fs?".$row['version_id']."?fs?".$row['partial_test_for_test_result_id']?>            
                   

            <button type="submit" id="" name=""  class="btn btn-success btn-xs" onclick="sending_data_of_partial_test_for_test_result_form_for_getting_data_from_database('<?php echo $value; ?>')"> Test Result Entry</button>
            <button type="submit" id="" name=""  class="btn btn-primary btn-xs" onclick="sending_data_for_edit_form_for_getting_data_from_database('<?php echo $value_for_edit; ?>')">Edit Test Result Entry</button>

             <?php 
            if($row['trf_id']=='select'){
               $get_all_data= "?fs?".$row['version_id'].'?fs?'.$row['pp_number']."?fs?".$row['process_id']."?fs?".$row['style_name']."?fs?".$row['finish_width_in_inch']."?fs?".$row['before_trolley_number_or_batcher_number']."?fs?".$row['before_trolley_number_or_batcher_number'];
            }
            else
            {
              $get_all_data= $row['trf_id']."?fs?".$row['version_id'].'?fs?'.$row['pp_number']."?fs?".$row['process_id']."?fs?".$row['style_name']."?fs?".$row['finish_width_in_inch']."?fs?".$row['before_trolley_number_or_batcher_number']."?fs?".$row['before_trolley_number_or_batcher_number'];
            }
           

            ?>   

         

            <button type="submit" id="" name=""  class="btn btn-success btn-xs" onclick="sending_data_for_test_report('<?php echo $get_all_data; ?>')">Test Report</button>

            <button type="submit" id="" name=""  class="btn btn-danger btn-xs" onclick="sending_data_for_delete('<?php echo $row['partial_test_for_test_result_id']; ?>')"> Delete</button>
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
							  
						    	
					    
					</form>
                

        </div>
      </div>  <!--  end of <div class="panel panel-default"> -->
    </div>

	




	
</body>
</html>