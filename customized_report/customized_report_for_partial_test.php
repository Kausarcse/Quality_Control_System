<?php
session_start();
require_once("../login/session.php");
include('../login/db_connection_class.php');
$obj = new DB_Connection_Class();
$obj->connection();
?>
<script>
	const d = new Date();
  const ye = new Intl.DateTimeFormat('en', { year: 'numeric' }).format(d);
  const mo = new Intl.DateTimeFormat('en', { month: '2-digit' }).format(d);
  const da = new Intl.DateTimeFormat('en', { day: '2-digit' }).format(d);
	
</script>

<script>



function script_for_table()
{

	 /*$(document).ready(function() {
					    $('#datatable-buttons').DataTable( {
					        initComplete: function () {
					            this.api().columns().every( function () {
					                var column = this;
					                var select = $('<select><option value=""></option></select>')
					                    .appendTo( $(column.footer()).empty() )
					                    .on( 'change', function () {
					                        var val = $.fn.dataTable.util.escapeRegex(
					                            $(this).val()
					                        );
					 
					                        column
					                            .search( val ? '^'+val+'$' : '', true, false )
					                            .draw();
					                    } );
					 
					                column.data().unique().sort().each( function ( d, j ) {
					                    select.append( '<option value="'+d+'">'+d+'</option>' )
					                } );
					            } );
					        }
					     } );
					  } );*/

					  $('#datatable-buttons').ddTableFilter();



}
function Fill_Value_Of_Version_Number_Field(pp_number)
{
    var value_for_data= 'pp_number_value='+pp_number;
/*    $('#version_number').html='<option>This is test </option>';
*/	/*document.getElementById('version_number').innerHTML='<option> option 1</option> <option> option 2</option> ';*/
            $.ajax({
			 		url: 'customized_report/returning_version_number_details.php',
			 		dataType: 'text',
			 		type: 'post',
			 		contentType: 'application/x-www-form-urlencoded',
			 		data: value_for_data,
			 		      
			 		success: function( data, textStatus, jQxhr )
			 		{       
			 			   /*alert(data);*/
			 				document.getElementById('version_number').innerHTML=data;
			 				var splitted_data_value = data.split("?fs?");
			 				/*alert(document.getElementById('design').innerHTML=splitted_data_value[6]);*/
			 				/*$('#design').html(splitted_data_value[6]);*/
			 				$('#design').val(splitted_data_value[6]);
			 				
			 				
							
							//document.getElementById('test').innerHTML=data;
							
			 		},
			 		error: function( jqXhr, textStatus, errorThrown )
			 		{       
			 				//console.log( errorThrown );
			 				alert(errorThrown);
			 		}
			}); // End of $.ajax({
}   /*End of function Fill_Value_Of_Version_Number_Field(pp_number)*/

function select_attached_proces_of_version()
{
	
			
			//alert('Here');
			//innerHTML=splitted_data[3];
			var pp_number = document.getElementById('pp_number').value;
			var version_value = document.getElementById('version_number').value;

			
			var splitted_version_value = version_value.split("?fs?");
			var version_name = splitted_version_value[0];
			var color = splitted_version_value[1];
			var version_id = splitted_version_value[4];
			//alert(pp_number+" "+version_number);
            $.ajax({
			 		url: '../znzQC/customized_report/returning_attached_proces_of_version.php',
			 		dataType: 'text',
			 		type: 'post',
			 		contentType: 'application/x-www-form-urlencoded',
			 		data: {pp_number_value:pp_number,version_number_value:version_name,color_value:color,version_id:version_id},
			 		      
			 		success: function( data, textStatus, jQxhr )
			 		{       
			 			    

			 				document.getElementById('process').innerHTML=data;

							
			 		},
			 		error: function( jqXhr, textStatus, errorThrown )
			 		{       
			 				//console.log( errorThrown );
			 				alert(errorThrown);
			 		}
			}); // End of $.ajax({
	
	
}


function find_summary()
{
	
			
			//alert('Here');
			//innerHTML=splitted_data[3];
			var pp_number = document.getElementById('pp_number').value;
			var version_value = document.getElementById('version_number').value;
			var splitted_version_value = version_value.split("?fs?");
			var version_name = splitted_version_value[0];
			var color = splitted_version_value[1];
			var version_id = splitted_version_value[4];
			var design = document.getElementById("design").value
			var process_name = document.getElementById("process").value
			//alert(pp_number+" "+version_number);
            $.ajax({
			 		url: 'customized_report/returning_summary_of_version_for_partial_test.php',
			 		dataType: 'text',
			 		type: 'post',
			 		contentType: 'application/x-www-form-urlencoded',
			 		data: {pp_number_value:pp_number,version_number_value:version_name,color_value:color,design:design,process_name:process_name,version_id:version_id},
			 		      
			 		success: function( data, textStatus, jQxhr )
			 		{       
			 			    
                           
			 				document.getElementById('display_summary_result').innerHTML=data;

			 				

							
			 		},
			 		error: function( jqXhr, textStatus, errorThrown )
			 		{       
			 				//console.log( errorThrown );
			 				alert(errorThrown);
			 		}
			}); // End of $.ajax({
	
	
}


function find_details(i)
{
	//alert('Here');
	//innerHTML=splitted_data[3];
	var pp_number = document.getElementById('pp_number').value;
	var version_value = document.getElementById('table_version_id'+i).innerHTML;
	var process_name = document.getElementById('process').value;
	var splitted_version_value = version_value.split("?fs?");
	var version_name = splitted_version_value[0];
	var color = splitted_version_value[1];
	var version_id = splitted_version_value[4];

	var row_id=document.getElementById('table_row_id'+i).innerHTML;
	//alert(pp_number+" "+version_number);
	$.ajax({
			url: 'customized_report/returning_details_of_version_for_partial_test.php',
			dataType: 'text',
			type: 'post',
			contentType: 'application/x-www-form-urlencoded',
			data: {pp_number_value:pp_number,version_number_value:version_value,color_value:color,process_name:process_name,row_id:row_id},
			
					
			success: function( data, textStatus, jQxhr )
			{       
					
				document.getElementById('details_based_on_pp_div').innerHTML=data;

				/*$('#pp_number_color_change').css({ 'color': 'red', 'font-size': '150%' });*/		
			},
			error: function( jqXhr, textStatus, errorThrown )
			{       
					//console.log( errorThrown );
					alert(errorThrown);
			}
	}); // End of $.ajax({
	
	
}

 function report_view(get_all_data)
 {
      
      

       $('#print').hide();
       $('#element_for_first_div').hide();

       

       var split_data=get_all_data.split('?fs?');

       var process_id=split_data[3];
       
      
       if(process_id=='proc_16')
       {
          $('#element').load("report/pass_fail_report_for_all_test.php?all_data="+encodeURIComponent(get_all_data));
       }

       else
       {
       	  $('#element').load("report/pass_fail_report_for_partial_test.php?all_data="+encodeURIComponent(get_all_data));
       }
       
      
       


 }//End of function sending_data_for_test_report()



 /***************************************************** FOR AUTO COMPLETE********************************************************************/

$('.for_auto_complete').chosen();


/***************************************************** FOR AUTO COMPLETE********************************************************************/


</script>

<script>
  $(document).ready(function() {
    // Setup - add a text input to each footer cell
    $('#datatable-buttons_for_version_details thead tr').clone(true).appendTo( '#datatable-buttons_for_version_details thead' );
    $('#datatable-buttons_for_version_details thead tr:eq(1) th').each( function (i) {
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
 
    var table = $('#datatable-buttons_for_version_details').DataTable( {
       scrollY:        "300px",
        scrollX:        true,
        scrollCollapse: true,
        paging:         false,
        columnDefs: [
            { width: '20%', targets: 0 }
        ],
        fixedColumns: true
    } );
} );
</script>    



<script>

function generate_pdf(){
 

   var printContents = document.getElementById('element').innerHTML;
     var originalContents = document.body.innerHTML;

     document.body.innerHTML = printContents;

     window.print();

     document.body.innerHTML = originalContents;
}
</script>



 <div class="col-sm-12 col-md-12 col-lg-12">
       <div class="panel panel-default">

       	   <body id="target">

       	   <div id="element_for_first_div">
           	

                <div class="panel-heading" style="color:#191970;"><b>Customized Report</b></div> <!-- This will create a upper block for FORM (Just Beautification) -->

                   <form class="form-horizontal" action="" style="margin-top:10px;" name="customized_report_form" id="customized_report_form">


						<div class="form-group form-group-sm" id="form-group_for_pp_number" id="form_customized_report">
						<label class="control-label col-sm-4" for="pp_number" style="margin-right:0px; color:#00008B;">PP Number:</label>
							<div class="col-sm-5">
								<select  class="form-control for_auto_complete" id="pp_number" name="pp_number" onchange="Fill_Value_Of_Version_Number_Field(this.value)">
											<option select="selected" value="select">Select PP Number</option>
											<?php 
												 $sql = 'select pp_number from `process_program_info` order by `pp_number`';
												 $result= mysqli_query($con,$sql) or die(mysqli_error($con));
												 while( $row = mysqli_fetch_array( $result))
												 {

													 echo '<option value="'.$row['pp_number'].'">'.$row['pp_number'].'</option>';

												 }

											 ?>
								</select>
								
							</div>
						</div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_pp_number"> -->

						<div class="form-group form-group-sm" id="form-group_for_design">
                           <label class="control-label col-sm-4" for="design" style="margin-right:0px; color:#00008B;">Design : <span id=""></span></label>
                           <div class="col-sm-5"> 
                            
                             <input type="text" class="form-control" name="design" id="design" value="" readonly="">
                           </div>
						</div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_design"> -->


						<div class="form-group form-group-sm" id="form-group_for_version_number">
						<label class="control-label col-sm-4" for="version_number" style="margin-right:0px; color:#00008B;">Version Number (Optional):</label>
							<div class="col-sm-5">
								<select  class="form-control" id="version_number" name="version_number" onchange="select_attached_proces_of_version()">
											<option select="selected" value="select">Select Version Number</option>
											<?php 
												 // $sql = 'select version_name from `pp_wise_version_creation_info` order by `version_name`';
												 // $result= mysqli_query($con,$sql) or die(mysqli_error($con));
												 // while( $row = mysqli_fetch_array( $result))
												 // {

													 // echo '<option value="'.$row['version_name'].'">'.$row['version_name'].'</option>';

												 // }

											 ?>
								</select>
							</div>
						</div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_version_number"> -->
						
						
						
						<div class="form-group form-group-sm" id="form-group_for_process">
						<label class="control-label col-sm-4" for="process" style="margin-right:0px; color:#00008B;">Process:</label>
							<div class="col-sm-5">
								<select  class="form-control" id="process" name="process" onchange="find_summary()">
											<option select="selected" value="select">Select Process</option>
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
						</div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_process"> -->

							

			  </div>   <!-- <div id="element_for_first_div"> -->


			 <div id="element">
						
						<div class="form-group form-group-sm" id="summary_result" >
						   
							<!-- This is Display Section. --> 


							<div id="display_summary_result" class="col-sm-12" align="center" style=" margin-top:0px;"> </div>
							
							   
										 
						</div> <!-- End of <div id="summary_result"> -->
						
						<div class="form-group form-group-sm"  id="details_result_based_on_pp" >
						   
							<!-- This is Display Section. --> 

							<div id="details_based_on_pp_div" class="col-sm-12" align="center" style=" margin-top:0px;"> </div>
							
							   
										 
						</div> <!-- End of <div id="summary_result"> -->

            </div> <!-- end of div element -->
						<input type="hidden" id="customer_name" name="customer_name" value="">
						<input type="hidden" id="customer_id" name="customer_id" value="">
						<input type="hidden" id="color" name="color" value="" >
						<input type="hidden" id="finish_width_in_inch" name="finish_width_in_inch"  value="">
						<input type="hidden" id="process_id" name="process_id"  value="">
						<input type="hidden" id="test_method_id" name="test_method_id"  value="">
						<input type="hidden" id="version_id" name="version_id"  value="">
						

						<input type="hidden" id="checking_data" name="checking_data"  value="">

                 </form>

                
               
                

              </div>

             </div>   <!-- End of <div class="panel panel-default"> -->


            <!--  <button class="btn btn-success"><a id="downloadLink" onclick="exportF(this)">Export to excel</a></button> -->
         	 <button id="print" class="btn btn-primary align-center" name="print" onclick="generate_pdf()">Print</button>

     </div>   <!-- End of <div class="col-sm-12 col-md-12 col-lg-12"> -->



    <!--  	For export to excel -->

          
