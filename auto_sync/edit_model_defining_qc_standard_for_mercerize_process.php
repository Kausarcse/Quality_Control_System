<?php
error_reporting(0);
session_start();
require_once("../login/session.php");
include('../login/db_connection_class.php');
$obj = new DB_Connection_Class();
$obj->connection();

$model_mercerize_id = '';

if(isset($_GET['model_mercerize_id']))
{
   $model_mercerize_id=$_GET['model_mercerize_id'];
   $sql_for_model_mercerize="select * from model_defining_qc_standard_for_mercerize_process where `id`='$model_mercerize_id'";
   $result_for_model_mercerize= mysqli_query($con,$sql_for_model_mercerize) or die(mysqli_error($con));
   $row_for_model_mercerize = mysqli_fetch_array( $result_for_model_mercerize);
}

?>
<script type='text/javascript' src='process_program/defining_qc_standard_for_mercerize_process_form_validation.js'></script>
<script type='text/javascript' src='process_program/calculate_data_for_standards.js'></script>

<style>

.form-group		/* This is for reducing Gap among Form's Fields */
{

	margin-bottom: 5px;

}

</style>

<script>

function Remove_Value_Of_This_Element(element_name)
{


	 document.getElementById('color').value='red';
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

function change_up_down_arrow_icon_1(icon_lcation)
{


  //alert(icon_lcation);
  var class_name = $('#'+icon_lcation).attr('class');
    //alert(class_name);
  if(class_name=="glyphicon glyphicon-chevron-up text-right")
  {
    $('#'+icon_lcation).removeClass();
    $('#'+icon_lcation).addClass("glyphicon glyphicon-chevron-down text-right");
  }
  else
  {
    $('#'+icon_lcation).removeClass();
    $('#'+icon_lcation).addClass("glyphicon glyphicon-chevron-up text-right");

  }


} // End of function change_up_down_arrow_icon_1(icon_lcation)


</script>

<script>
    
function load_full_form(customer_id)
{  


  $('#buttn_for_load_form').hide();
  $('#full_page_load').show();
 
    var value_for_data= 'customer_id='+customer_id;
   

    $.ajax({
                url: 'process_program/return_test_name_method.php',
                dataType: 'text',
                type: 'post',
                contentType: 'application/x-www-form-urlencoded',
                data: value_for_data,
                        
                success: function( data, textStatus, jQxhr )
                {       
                    // alert(data);
                    var split_all_data= data.split('method');
                    var data= split_all_data[0];
                    var test_method_id=split_all_data[1];
                    var test_method_id= test_method_id.split(',');

                    var test_method_for_all='';

                    $("#checking_data").val(data);

                    var splitted_data= data.split('?fs?');

                    if(splitted_data.includes('49'))
                     {
                     	
                     	test_method_for_all+=test_method_id[splitted_data.indexOf('49')]+',';
                     	$(".full_page_load").show();
                     	$("#div_whiteness").show();
                     	
                     	
                     }

                     if(splitted_data.includes('50'))
                     {
                     	test_method_for_all+=test_method_id[splitted_data.indexOf('50')]+',';
                     	$(".full_page_load").show();
                     	$("#div_residual_sizing_material").show();
                     	
                     	
                     }

                     if(splitted_data.includes('51'))
                     {
                     	test_method_for_all+=test_method_id[splitted_data.indexOf('51')]+',';
                     	$(".full_page_load").show();
                     	$("#div_absorbency_test_method").show();
                     	
                     	
                     }

                      if(splitted_data.includes('33'))
                     {
                     	
                     	test_method_for_all+=test_method_id[splitted_data.indexOf('33')]+',';
                     	$(".full_page_load").show();
                     	$("#div_ph").show();
                     	
                     	
                     }


                     $("#test_method_id").val(test_method_for_all);
							
			 		},
			 		error: function( jqXhr, textStatus, errorThrown )
			 		{       
			 				
			 				alert(errorThrown);
			 		}
            }); // End of $.ajax({


} // End of function load_full_form()



 function sending_data_of_edit_defining_qc_standard_for_model_mercerize_process_form_for_saving_in_database()
{
       var url_encoded_form_data = $("#defining_qc_standard_for_model_mercerize_process_form").serialize();

       $.ajax({
        url: 'auto_sync/edit_model_defining_qc_standard_for_mercerize_process_saving.php',
        dataType: 'text',
        type: 'post',
        contentType: 'application/x-www-form-urlencoded',
        data: url_encoded_form_data,
        success: function( data, textStatus, jQxhr )
        {
            alert(data);

            //document.getElementById('test').innerHTML=data;

        },
        error: function( jqXhr, textStatus, errorThrown )
        {
            //console.log( errorThrown );
            alert(errorThrown);
        }
     }); // End of $.ajax({

    //  }//End of if(validate != false)

   


}//End of function sending_data_of_defining_qc_standard_for_model_mercerize_process_form_for_saving_in_database()



 $(document).ready(function() {
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
	            } );
               

</script>
<div id='test'>

</div>

<div class="col-sm-12 col-md-12 col-lg-12">

		<div class="panel panel-default"> <!-- This div will create a block/panel for FORM -->

				<div class="panel-heading" style="color:#191970;"><b>Edit Model Defining Standard For Mercerize Process</b></div> 

				<div class="row" data-toggle="collapse" data-target="#search_form_collpapsible_div_1" onClick="change_up_down_arrow_icon_1(this.childNodes[5].childNodes[1].id)">

                    <div style="padding-right:13px;" id='test'> <i class="glyphicon glyphicon-chevron-up text-right"  id='panel_heading_icon_1'></i></div>

                </div>   

                <div id='search_form_collpapsible_div_1' class="collapse in"> 



                     <form class="form-horizontal" action="" style="margin-top:10px;" name="defining_qc_standard_for_model_mercerize_process_form_view" id="defining_qc_standard_for_model_mercerize_process_form_view" data-toggle="collapse" data-target="#search_form_collpapsible_div">
					
	                    <div class="panel panel-default">
	                       <table id="datatable-buttons" class="table table-striped table-bordered">
	                        <thead>
	                               <tr>
	                               <th>SI</th>
	                               <th>Customer Name</th>
	                               <th>Version Name</th>
	                               <th>Color</th>
                                   <th>Process</th>
	                               <th>Process Serial</th>
	                               <th>Process Technique</th>
	                               <th>Action</th>
	                               </tr>
	                          </thead>
	                          <tbody>
	                          <?php

                                  $s1 = 1;
                                  $standard_for_which_process='Mercerize';

                                  if(isset($model_mercerize_id))
                                  {
                                     $sql_for_model_mercerize = "SELECT * FROM `model_defining_qc_standard_for_mercerize_process` WHERE `id`='$model_mercerize_id'";
                                  }


                                  $res_for_model_mercerize = mysqli_query($con, $sql_for_model_mercerize);

                                  while ($row = mysqli_fetch_assoc($res_for_model_mercerize))
                                  {
                                     	$customer_id=$row['customer_id'];
										$customer_name=$row['customer_name'];
										$version_number=$row['version_number'];
										$color=$row['color'];
										$process_id=$row['process_id'];
										$process_name=$row['process_name'];
										$process_serial=$row['process_serial'];
										$process_technique=$row['process_technique'];
	                           ?>

	                           		<tr>
	                              		 <td><?php echo $s1; ?></td>
										 <td width="300"><?php echo $customer_name; ?></td>
										 <td><?php echo $version_number; ?></td>
										 <td><?php echo $color; ?></td>
										 <td><?php echo $process_name; ?></td>
										 <td><?php echo $process_serial; ?></td>
										 <td><?php echo $process_technique; ?></td>
										 <td>

                                         <button type="submit" id="edit_model_mercerize" name="edit_model_mercerize"  class="btn btn-info btn-xs" onclick="load_page('auto_sync/edit_model_defining_qc_standard_for_mercerize_process.php?model_mercerize_id=<?php echo $row['id'] ?>')"> Edit </button>

			                             </td>
	                              <?php

	                              $s1++;
	                                }
	                             ?>
                           </tr>
                        </tbody>
                       </table>

                    </div>

               </form>    <!-- End of <form class="form-horizontal" action="" style="margin-top:10px;" name="defining_qc_standard_for_model_mercerize_process_form" id="defining_qc_standard_for_model_mercerize_process_form"> -->

	</div> <!-- End of <div class="panel-heading" style="color:#191970;"><b> model_mercerize Standard Process List</b></div>  -->

   <button type="button" class="btn btn-info" id="buttn_for_load_form" onclick="load_full_form('<?php echo $row_for_model_mercerize['customer_id']?>')">Load Form</button>




           <div class="full_page_load" id="full_page_load" style="display: none;">	



    <form class="form-horizontal" action="" style="margin-top:10px;" name="defining_qc_standard_for_model_mercerize_process_form" id="defining_qc_standard_for_model_mercerize_process_form">
						
						<input type="hidden" id="process_id" name="process_id"  value="proc_6">
			            <input type="hidden" id="test_method_id" name="test_method_id"  value="">
						<input type="hidden" id="checking_data" name="checking_data"  value="">
						
						<!-------------- for model standard (start) -------------->
						<input type="hidden" class="form-control" id="version_number" name="version_number" value="<?php echo $row_for_model_mercerize['version_number']; ?>">
						<input type="hidden" class="form-control" id="customer_id" name="customer_id" value="<?php echo $row_for_model_mercerize['customer_id']; ?>">
						<input type="hidden" class="form-control" id="customer_name" name="customer_name" value="<?php echo $row_for_model_mercerize['customer_name']; ?>">
						<input type="hidden" class="form-control" id="color_name" name="color_name" value="<?php echo $row_for_model_mercerize['color']; ?>">
						<input type="hidden" class="form-control" id="process_name" name="process_name" value="<?php echo $row_for_model_mercerize['process_name']; ?>">
						<input type="hidden" class="form-control" id="process_serial" name="process_serial" value="<?php echo $row_for_model_mercerize['process_serial']; ?>">
						<input type="hidden" class="form-control" id="process_technique_name" name="process_technique_name" value="<?php echo $row_for_model_mercerize['process_technique']; ?>">

						<!-------------- for model standard (end) -------------->
				<!-- *********************************** Designing Tabular FoYarn Countrmar (Multi-Column Form Elements Here (Start))*********************************** -->


 		    <div class="form-group form-group-sm">


				<div class="col-sm-3 text-center">
					<label for="test_name_and_method" style="font-size:12px; color:#008000;">Test Name & Method</label>


				</div>

				 <div class="col-sm-1 text-center">
		              <label for="description_or_type" style="font-size:12px; color:#008000;">Direction/Type</label>

		         </div>

	           <div class="col-sm-1 text-center">
		             <!-- Gap Creation -->
		       </div>

		        <div class="col-sm-1 text-center">
		              <label for="value" style="font-size:12px; color:#008000;">Value</label>

		        </div>

	               <!--Add Input/Select Field Here No Dive Only Input/Select/Radio Button/Checkbox/Textarea -->

			   <div class="col-sm-1 text-center">
			         <label for="math_op_value" style="font-size:12px; color:#008000;">Math OP.</label>

			   </div>



	          <div class="col-sm-1 text-center" for="line_creation_between_min_and_max">

	          	<label for="tolerance_value" style="font-size:12px; color:#008000;">Tolerance</label>


	          </div>

	          <div class="col-sm-1 text-center">
	              <label for="min_value" style="font-size:12px; color:#008000;">Unit</label>

	          </div>

		               <!--Add Input/Select Field Here No Dive Only Input/Select/Radio Button/Checkbox/Textarea -->


	          <div class="col-sm-1" for="remaining_two_spans_of_bootstrap">

	             <label for="max_value" style="font-size:12px; color:#008000;">Minimum</label>

	          </div>

	          <div class="col-sm-1">

	             <label for="max_value" style="font-size:12px; color:#008000;">Maximum</label>

	          </div>


       </div><!-- End of <div class="form-group form-group-sm"  -->


 <!-- Start of whiteness -->

 <div id="div_whiteness" style="display: none">


<div class="form-group form-group-sm" >


  <div class="col-sm-3 text-center">
     <label class="control-label"  style="color:#00008B;">Whiteness- <span id="whiteness_test_method">Berger</span> </label>
  </div>
   
   <div class="col-sm-2 text-center">
            <!-- <label for="description_or_type" style="font-size:12px; color:#000066;">Direction/Type</label> -->
            <label class="control-label" for="description_or_type" style="color:#00008B;"> </label>
            <input type="hidden" class="form-control" id="test_method_for_whiteness" name="test_method_for_whiteness" value="Berger">
            
       </div>

   

       <div class="col-sm-1 text-center">
             <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
         
     </div>
        
         
      <div class="col-sm-1 text-center">
           <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
          
       </div>
        
             <!--Add Input/Select Field Here No Dive Only Input/Select/Radio Button/Checkbox/Textarea -->
          
      <div class="col-sm-1" for="tolerance">

         <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
      </div>

      <div class="col-sm-1" for="unit">

         (??)
        <input type="hidden" id="uom_of_whiteness" name="uom_of_whiteness"  value="??">
      </div>

        
      <div class="col-sm-1 text-center" for="min_value">

        <input type="text" class="form-control" id="whiteness_min_value" name="whiteness_min_value"  value="<?php echo $row_for_model_mercerize['whiteness_min_value']?>" required>

      </div>
          
      <div class="col-sm-1 text-center">
          
       <input type="text" class="form-control" id="whiteness_max_value" name="whiteness_max_value" value="<?php echo $row_for_model_mercerize['whiteness_max_value']?>" required>

     </div>
        

</div><!-- End of <div class="form-group form-group-sm" whiteness_max_value-->
</div>  <!-- End of <div id="div_whiteness" style="display: none"> -->


<!-- Start of residual_sizing_material -->
<div id="div_residual_sizing_material" style="display: none"> 						

<div class="form-group form-group-sm" >


      <div class="col-sm-3 text-center">
         <label class="control-label"  style="color:#00008B;">Residual Sizing Material <span id="residual_sizing_material_test_method">(Drop test method)</span></label>
      </div>

   
       <div class="col-sm-2 text-center">
                <!-- <label for="description_or_type" style="font-size:12px; color:#000066;">Direction/Type</label> -->
                <label class="control-label" for="description_or_type" style="color:#00008B;"> </label>
                <input type="hidden" class="form-control" id="test_method_for_residual_sizing_material" name="test_method_for_residual_sizing_material" value="Drop test method">
                
       </div>



     <div class="col-sm-1 text-center">
         <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
     
     </div>
        
         
      <div class="col-sm-1 text-center">
           <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
          
       </div>
        
             <!--Add Input/Select Field Here No Dive Only Input/Select/Radio Button/Checkbox/Textarea -->
          
      <div class="col-sm-1" for="tolerance">

         <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
      </div>

      <div class="col-sm-1" for="unit">

         <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
        <input type="hidden" name="uom_of_residual_sizing_material" id="uom_of_residual_sizing_material" value="%">
      </div>

        
      <div class="col-sm-1 text-center" for="min_value">

       <input type="text" class="form-control" id="residual_sizing_material_min_value" name="residual_sizing_material_min_value" value="<?php echo $row_for_model_mercerize['residual_sizing_material_min_value']?>" required>

      </div>
          
      <div class="col-sm-1 text-center">
          
       <input type="text" class="form-control" id="residual_sizing_material_max_value" name="residual_sizing_material_max_value" value="<?php echo $row_for_model_mercerize['residual_sizing_material_max_value']?>" required>

     </div>
        

</div><!-- End of <div class="form-group form-group-sm" bath_residual_sizing_material_max_value-->
               
</div>  <!-- End of <div id="div_residual_sizing_material" style="display: none"> 	 -->



<!-- Start of absorbency_test_method -->

<div id="div_absorbency_test_method" style="display: none"> 	



<div class="form-group form-group-sm" >


  <div class="col-sm-3 text-center">
     <label class="control-label"  style="color:#00008B;">Absorbency  <span id="absorbency_test_method">(Capillary Method)</span></label>
  </div>
   
   <div class="col-sm-2 text-center">
            <!-- <label for="description_or_type" style="font-size:12px; color:#000066;">Direction/Type</label> -->
            <label class="control-label" for="description_or_type" style="color:#00008B;"> At 60 Sec</label>
            <input type="hidden" class="form-control" id="test_method_for_absorbency" name="test_method_for_absorbency" value="Capillary Method">
            
       </div>



       <div class="col-sm-1 text-center">
             <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
         
     </div>
        
         
      <div class="col-sm-1 text-center">
           <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
          
       </div>
        
             <!--Add Input/Select Field Here No Dive Only Input/Select/Radio Button/Checkbox/Textarea -->
          
      <div class="col-sm-1" for="tolerance">

         <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
      </div>

      <div class="col-sm-1" for="unit">

        mm
        <input type="hidden" name="uom_of_absorbency" id="uom_of_absorbency" value="mm">
      </div>

        
      <div class="col-sm-1 text-center" for="min_value">

       <input type="text" class="form-control" id="absorbency_min_value" name="absorbency_min_value"  value="<?php echo $row_for_model_mercerize['absorbency_min_value']?>" required>

      </div>
          
      <div class="col-sm-1 text-center">
          
       <input type="text" class="form-control" id="absorbency_max_value" name="absorbency_max_value"  value="<?php echo $row_for_model_mercerize['absorbency_max_value']?>" required>

     </div>
            

</div><!-- End of <div class="form-group form-group-sm" bath_absorbency_max_value-->


</div> <!--  End of <div id="div_absorbency_test_method" style="display: none"> --> 


<!-- For PH Start -->
<div id="div_ph" style="display: none"> 
<div class="form-group form-group-sm" >


  <div class="col-sm-3 text-center">
     <label class="control-label"  style="color:#00008B;">pH (Drop test method) <span id="ph_test_method"></span> </label>
  </div>

   
   <div class="col-sm-2 text-center">
            <!-- <label for="description_or_type" style="font-size:12px; color:#000066;">Direction/Type</label> -->
            <label class="control-label" for="description_or_type" style="color:#00008B;"> </label>
            <input type="hidden" class="form-control" id="test_method_for_ph" name="test_method_for_ph" value="Berger">
            
   </div>

   

    <div class="col-sm-1 text-center">
             <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
         
    </div>
        
         
    <div class="col-sm-1 text-center">
           <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
          
    </div>
        
             <!--Add Input/Select Field Here No Dive Only Input/Select/Radio Button/Checkbox/Textarea -->
          
  <div class="col-sm-1" for="tolerance">

     <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
  </div>

  <div class="col-sm-1" for="unit">

    <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
    <input type="hidden" name="uom_of_ph" id="uom_of_ph" value="%">
  </div>

        
  <div class="col-sm-1 text-center" for="min_value">

   <input type="text" class="form-control" id="ph_min_value" name="ph_min_value" value="<?php echo $row_for_model_mercerize['ph_min_value']?>" required>

  </div>
          
  <div class="col-sm-1 text-center">
      
   <input type="text" class="form-control" id="ph_max_value" name="ph_max_value" value="<?php echo $row_for_model_mercerize['ph_max_value']?>" required>

 </div>
        

</div><!-- End of <div class="form-group form-group-sm" bath_ph_max_value-->

</div>   <!-- End of <div id="div_ph" style="display: none"> --> 




<!-- *********************************** Designing Tabular Formar (Multi-Column Form Elements Here (End))*********************************** -->

						<div class="form-group form-group-sm">
								<div class="col-sm-offset-3 col-sm-5">
									<button type="button" class="btn btn-primary" onClick="sending_data_of_edit_defining_qc_standard_for_model_mercerize_process_form_for_saving_in_database()">Edit</button>
									<button type="reset" class="btn btn-success">Reset</button>
								</div>
						</div>

				</form>

		</div> <!-- End of <div class="panel panel-default"> -->

</div> <!-- End of <div class="col-sm-12 col-md-12 col-lg-12"> -->
