<?php
error_reporting(0);
session_start();
require_once("../login/session.php");
include('../login/db_connection_class.php');
$obj = new DB_Connection_Class();
$obj->connection();

$model_ready_for_raising_id = '';

if(isset($_GET['model_ready_for_raising_id']))
{
   $model_ready_for_raising_id=$_GET['model_ready_for_raising_id'];
   $sql_for_model_ready_for_raising="select * from model_defining_qc_standard_for_ready_for_raising_process where `id`='$model_ready_for_raising_id'";
   $result_for_model_ready_for_raising= mysqli_query($con,$sql_for_model_ready_for_raising) or die(mysqli_error($con));
   $row_for_model_ready_for_raising = mysqli_fetch_array( $result_for_model_ready_for_raising);
}

?>
<script type='text/javascript' src='process_program/defining_qc_standard_for_ready_for_raising_process_form_validation.js'></script>
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
 

} // End of function load_full_form()



 function sending_data_of_edit_defining_qc_standard_for_model_ready_for_raising_process_form_for_saving_in_database()
{
       var url_encoded_form_data = $("#defining_qc_standard_for_model_ready_for_raising_process_form").serialize();

       $.ajax({
        url: 'auto_sync/edit_model_defining_qc_standard_for_ready_for_raising_process_saving.php',
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

   


}//End of function sending_data_of_defining_qc_standard_for_model_ready_for_raising_process_form_for_saving_in_database()



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

				<div class="panel-heading" style="color:#191970;"><b>Edit Model Defining Standard For Ready For Raising Process</b></div> 

				<div class="row" data-toggle="collapse" data-target="#search_form_collpapsible_div_1" onClick="change_up_down_arrow_icon_1(this.childNodes[5].childNodes[1].id)">

                    <div style="padding-right:13px;" id='test'> <i class="glyphicon glyphicon-chevron-up text-right"  id='panel_heading_icon_1'></i></div>

                </div>   

                <div id='search_form_collpapsible_div_1' class="collapse in"> 



                     <form class="form-horizontal" action="" style="margin-top:10px;" name="defining_qc_standard_for_model_ready_for_raising_process_form_view" id="defining_qc_standard_for_model_ready_for_raising_process_form_view" data-toggle="collapse" data-target="#search_form_collpapsible_div">
					
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
                                  $standard_for_which_process='Ready For Raising';

                                  if(isset($model_ready_for_raising_id))
                                  {
                                    $sql_for_model_ready_for_raising = "SELECT * FROM `model_defining_qc_standard_for_ready_for_raising_process` WHERE `id`='$model_ready_for_raising_id'";
                                  }


                                  $res_for_model_ready_for_raising = mysqli_query($con, $sql_for_model_ready_for_raising);

                                  while ($row = mysqli_fetch_assoc($res_for_model_ready_for_raising))
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
                                            <button type="submit" id="edit_model_ready_for_raising" name="edit_model_ready_for_raising"  class="btn btn-info btn-xs" onclick="load_page('auto_sync/edit_model_defining_qc_standard_for_ready_for_raising_process.php?model_ready_for_raising_id=<?php echo $row['id'] ?>')"> Edit </button>
			                             </td>
	                              <?php

	                              $s1++;
	                                }
	                             ?>
                           </tr>
                        </tbody>
                       </table>

                    </div>

               </form>    <!-- End of <form class="form-horizontal" action="" style="margin-top:10px;" name="defining_qc_standard_for_model_ready_for_raising_process_form" id="defining_qc_standard_for_model_ready_for_raising_process_form"> -->

	</div> <!-- End of <div class="panel-heading" style="color:#191970;"><b> model_ready_for_raising Standard Process List</b></div>  -->

   <button type="button" class="btn btn-info" id="buttn_for_load_form" onclick="load_full_form('<?php echo $row_for_model_ready_for_raising['customer_id']?>')">Load Form</button>




           <div class="full_page_load" id="full_page_load" style="display: none;">	



    <form class="form-horizontal" action="" style="margin-top:10px;" name="defining_qc_standard_for_model_ready_for_raising_process_form" id="defining_qc_standard_for_model_ready_for_raising_process_form">
						
						<input type="hidden" id="process_id" name="process_id"  value="proc_14">
			            <input type="hidden" id="test_method_id" name="test_method_id"  value="">
						<input type="hidden" id="checking_data" name="checking_data"  value="">
						
						<!-------------- for model standard (start) -------------->
						<input type="hidden" class="form-control" id="version_number" name="version_number" value="<?php echo $row_for_model_ready_for_raising['version_number']; ?>">
						<input type="hidden" class="form-control" id="customer_id" name="customer_id" value="<?php echo $row_for_model_ready_for_raising['customer_id']; ?>">
						<input type="hidden" class="form-control" id="customer_name" name="customer_name" value="<?php echo $row_for_model_ready_for_raising['customer_name']; ?>">
						<input type="hidden" class="form-control" id="color_name" name="color_name" value="<?php echo $row_for_model_ready_for_raising['color']; ?>">
						<input type="hidden" class="form-control" id="process_name" name="process_name" value="<?php echo $row_for_model_ready_for_raising['process_name']; ?>">
						<input type="hidden" class="form-control" id="process_serial" name="process_serial" value="<?php echo $row_for_model_ready_for_raising['process_serial']; ?>">
						<input type="hidden" class="form-control" id="process_technique_name" name="process_technique_name" value="<?php echo $row_for_model_ready_for_raising['process_technique']; ?>">

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


<!-- Start div_tensile_properties -->		
<div id="div_tensile_properties" >

<div class="form-group form-group-sm" for="tensile_properties_in_warp">
  

    <div class="col-sm-3 text-center">
         <label class="control-label" for="tensile_properties_in_warp" style="color:#00008B;"><span id="for_tensile_properties_in_warp_test_name_label">Tensile Properties</span> <span id="tensile_properties_in_warp_test_method"></span>(ISO 13934-1)</label>
    </div>
     
     <div class="col-sm-2 text-center">
          <!-- <label for="description_or_type" style="font-size:12px; color:#000066;">Description/Type</label> -->
          <label class="control-label" for="description_or_type" style="color:#00008B;"> Warp </label>

          <input type="hidden" class="form-control" id="test_method_for_tensile_properties_in_warp" name="test_method_for_tensile_properties_in_warp" value="ISO 13934-1">
          
     </div>

     

     <div class="col-sm-1 text-center">
             <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
         
     </div>
        
         
  <div class="col-sm-1 text-center">
      <select  class="form-control" id="tensile_properties_in_warp_value_tolerance_range_math_operator" name="tensile_properties_in_warp_value_tolerance_range_math_operator" onchange="tensile_properties_in_warp()">
              <option value=""> Select Tensile Properties In Warp Value Tolerance Range Math Operator</option>
              <?php
                              $tensile_properties_in_warp_value_tolerance_range_math_operator = $row_for_model_ready_for_raising['tensile_properties_in_warp_value_tolerance_range_math_operator'];
                         
                                  if($tensile_properties_in_warp_value_tolerance_range_math_operator=='≥')
                                  {
                               ?>
                                     <option value="≥" selected>≥</option>
                                     <option value="≤"> ≤ </option>
                                     <option value=">"> > </option>
                                     <option value="<"> < </option>
                              <?php
                                  }
                                  else if($tensile_properties_in_warp_value_tolerance_range_math_operator=='≤')
                                  {
                                 ?>
                                  <option value="≥">≥</option>
                                  <option value="≤" selected> ≤ </option>
                                  <option value=">"> > </option>
                                  <option value="<"> < </option>
                               <?php
                                  }
                                  else if($tensile_properties_in_warp_value_tolerance_range_math_operator=='>')
                                  {
                                 ?>
                                     <option value="≥">≥</option>
                                     <option value="≤"> ≤ </option>
                                     <option value=">" selected> > </option>
                                     <option value="<"> < </option>
                               <?php
                                  }
                                  else if($tensile_properties_in_warp_value_tolerance_range_math_operator=='<')
                                  {
                                 ?>
                                     <option value="≥">≥</option>
                                     <option value="≤"> ≤ </option>
                                     <option value=">"> > </option>
                                     <option value="<" selected> < </option>
                               <?php
                                  }
                                  else 
                                  {
                                     ?>

                                     <option value="≥">≥</option>
                                     <option value="≤"> ≤ </option>
                                     <option value=">" > > </option>
                                     <option value="<" > < </option>

                                     <?php
                                  }
                               ?>
        </select>
      
   </div>
      
           <!--Add Input/Select Field Here No Dive Only Input/Select/Radio Button/Checkbox/Textarea -->
          
  <div class="col-sm-1" for="tolerance">

     <input type="text" class="form-control" id="tensile_properties_in_warp_value_tolerance_value" name="tensile_properties_in_warp_value_tolerance_value" value="<?php echo $row_for_model_ready_for_raising['tensile_properties_in_warp_value_tolerance_value']?>" onchange="tensile_properties_in_warp()" required>
  </div>

  <div class="col-sm-1" for="unit">
     <select  class="form-control" id="uom_of_tensile_properties_in_warp_value" name="uom_of_tensile_properties_in_warp_value">
              <option value="">Select Uom Of Warp Yarn Tensile Properties</option>
              <?php
                              $uom_of_tensile_properties_in_warp_value = $row_for_model_ready_for_raising['uom_of_tensile_properties_in_warp_value'];
                         
                                  if($uom_of_tensile_properties_in_warp_value=='N')
                                  {
                               ?>
                                      <option value="N" selected>N</option>
                                     <option value="kg">kg</option>
                                     <option value="lbf">lbf</option>
                                     <option value="daN">daN</option>
                              <?php
                                  }
                                  else if($uom_of_tensile_properties_in_warp_value=='kg')
                                  {
                                 ?>
                                  <option value="N">N</option>
                                     <option value="kg" selected>kg</option>
                                     <option value="lbf">lbf</option>
                                     <option value="daN">daN</option>
                               <?php
                                  }
                                  else if($uom_of_tensile_properties_in_warp_value=='lbf')
                                  {
                                 ?>
                                     <option value="N">N</option>
                                     <option value="kg">kg</option>
                                     <option value="lbf" selected>lbf</option>
                                     <option value="daN">daN</option>
                               <?php
                                  }
                                  else if($uom_of_tensile_properties_in_warp_value=='daN')
                                  {
                                 ?>
                                     <option value="N">N</option>
                                     <option value="kg">kg</option>
                                     <option value="lbf">lbf</option>
                                     <option value="daN" selected>daN</option>
                               <?php
                                  }
                                  else 
                                  {
                                     ?>

                                     <option value="N">N</option>
                                     <option value="kg">kg</option>
                                     <option value="lbf">lbf</option>
                                     <option value="daN">daN</option>

                                     <?php
                                  }
                               ?>
              
      </select>
  </div>

        
  <div class="col-sm-1 text-center" for="min_value">

      <input type="text" class="form-control" id="tensile_properties_in_warp_value_min_value" name="tensile_properties_in_warp_value_min_value" value="<?php echo $row_for_model_ready_for_raising['tensile_properties_in_warp_value_min_value']?>" required>
  </div>
          
  <div class="col-sm-1 text-center">
      
    <input type="text" class="form-control" id="tensile_properties_in_warp_value_max_value" name="tensile_properties_in_warp_value_max_value" value="<?php echo $row_for_model_ready_for_raising['tensile_properties_in_warp_value_max_value']?>" required>

   </div>
            
   
</div><!-- End of <div class="form-group form-group-sm" tensile_properties_in_warp_value_max_value-->




<div class="form-group form-group-sm" for="tensile_properties_in_weft">
  

    <div class="col-sm-3 text-center">
         <label class="control-label" for="tensile_properties_in_weft" style="display: none"><span id="for_tensile_properties_in_weft_test_name_label">Tensile Properties</span>   <span id="tensile_properties_in_weft_test_method">(ISO 13934-1)</span></label>
    </div>
     
     <div class="col-sm-2 text-center">
          <!-- <label for="description_or_type" style="font-size:12px; color:#000066;">Description/Type</label> -->
          <label class="control-label" for="description_or_type" style="color:#00008B;"> Weft </label>

           <input type="hidden" class="form-control" id="test_method_for_tensile_properties_in_weft" name="test_method_for_tensile_properties_in_weft" value="ISO 13934-1">
          
     </div>

   
     <div class="col-sm-1 text-center">
             <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
         
     </div>
        
         
  <div class="col-sm-1 text-center">
      <select  class="form-control" id="tensile_properties_in_weft_value_tolerance_range_math_operator" name="tensile_properties_in_weft_value_tolerance_range_math_operator" onchange="tensile_properties_in_weft()">
              <option value="">Select Tensile Properties In weft Value Tolerance Range Math Operator</option>
              <?php
                              $tensile_properties_in_weft_value_tolerance_range_math_operator = $row_for_model_ready_for_raising['tensile_properties_in_weft_value_tolerance_range_math_operator'];
                         
                                  if($tensile_properties_in_weft_value_tolerance_range_math_operator=='≥')
                                  {
                               ?>
                                     <option value="≥" selected>≥</option>
                                     <option value="≤"> ≤ </option>
                                     <option value=">"> > </option>
                                     <option value="<"> < </option>
                              <?php
                                  }
                                  else if($tensile_properties_in_weft_value_tolerance_range_math_operator=='≤')
                                  {
                                 ?>
                                  <option value="≥">≥</option>
                                  <option value="≤" selected> ≤ </option>
                                  <option value=">"> > </option>
                                  <option value="<"> < </option>
                               <?php
                                  }
                                  else if($tensile_properties_in_weft_value_tolerance_range_math_operator=='>')
                                  {
                                 ?>
                                     <option value="≥">≥</option>
                                     <option value="≤"> ≤ </option>
                                     <option value=">" selected> > </option>
                                     <option value="<"> < </option>
                               <?php
                                  }
                                  else if($tensile_properties_in_weft_value_tolerance_range_math_operator=='<')
                                  {
                                 ?>
                                     <option value="≥">≥</option>
                                     <option value="≤"> ≤ </option>
                                     <option value=">"> > </option>
                                     <option value="<" selected> < </option>
                               <?php
                                  }
                                  else 
                                  {
                                     ?>

                                     <option value="≥">≥</option>
                                     <option value="≤"> ≤ </option>
                                     <option value=">" > > </option>
                                     <option value="<" > < </option>

                                     <?php
                                  }
                               ?>
        </select>
      
   </div>
      
           <!--Add Input/Select Field Here No Dive Only Input/Select/Radio Button/Checkbox/Textarea -->
          
  <div class="col-sm-1" for="tolerance">

     <input type="text" class="form-control" id="tensile_properties_in_weft_value_tolerance_value" name="tensile_properties_in_weft_value_tolerance_value" value="<?php echo $row_for_model_ready_for_raising['tensile_properties_in_weft_value_tolerance_value']?>" onchange="tensile_properties_in_weft()" required>
  </div>

  <div class="col-sm-1" for="unit">
     <select  class="form-control" id="uom_of_tensile_properties_in_weft_value" name="uom_of_tensile_properties_in_weft_value">
              <option value="">Select Uom Of weft Yarn Tensile Properties</option>
              <?php
                              $uom_of_tensile_properties_in_weft_value = $row_for_model_ready_for_raising['uom_of_tensile_properties_in_weft_value'];
                         
                                  if($uom_of_tensile_properties_in_weft_value=='N')
                                  {
                               ?>
                                      <option value="N" selected>N</option>
                                     <option value="kg">kg</option>
                                     <option value="lbf">lbf</option>
                                     <option value="daN">daN</option>
                              <?php
                                  }
                                  else if($uom_of_tensile_properties_in_weft_value=='kg')
                                  {
                                 ?>
                                  <option value="N">N</option>
                                     <option value="kg" selected>kg</option>
                                     <option value="lbf">lbf</option>
                                     <option value="daN">daN</option>
                               <?php
                                  }
                                  else if($uom_of_tensile_properties_in_weft_value=='lbf')
                                  {
                                 ?>
                                     <option value="N">N</option>
                                     <option value="kg">kg</option>
                                     <option value="lbf" selected>lbf</option>
                                     <option value="daN">daN</option>
                               <?php
                                  }
                                  else if($uom_of_tensile_properties_in_weft_value=='daN')
                                  {
                                 ?>
                                     <option value="N">N</option>
                                     <option value="kg">kg</option>
                                     <option value="lbf" >lbf</option>
                                     <option value="daN" selected>daN</option>
                               <?php
                                  }
                                  else 
                                  {
                                     ?>

                                     <option value="N">N</option>
                                     <option value="kg">kg</option>
                                     <option value="lbf">lbf</option>
                                     <option value="daN">daN</option>

                                     <?php
                                  }
                               ?>
              
      </select>
  </div>

        
  <div class="col-sm-1 text-center" for="min_value">

      <input type="text" class="form-control" id="tensile_properties_in_weft_value_min_value" name="tensile_properties_in_weft_value_min_value" value="<?php echo $row_for_model_ready_for_raising['tensile_properties_in_weft_value_min_value']?>" required>
  </div>
          
  <div class="col-sm-1 text-center">
      
    <input type="text" class="form-control" id="tensile_properties_in_weft_value_max_value" name="tensile_properties_in_weft_value_max_value" value="<?php echo $row_for_model_ready_for_raising['tensile_properties_in_weft_value_max_value']?>" required>

   </div>
            
   
</div><!-- End of <div class="form-group form-group-sm" tensile_properties_in_weft_value_max_value-->



</div>  <!-- End of div_tensile_properties-->    




<!-- Start div_tear_force_in_warp_value -->		
<div id="div_tear_force_value" >

<div class="form-group form-group-sm" for="tear_force_in_warp_value">
  

    <div class="col-sm-3 text-center">
         <label class="control-label" for="tear_force_in_warp_value" style="color:#00008B;"><span id="for_tear_force_in_warp_test_name_label">Tear Force</span> <span id="tear_force_in_warp_test_method">(ISO 13937-2)</span></label>
    </div>
     
     <div class="col-sm-2 text-center">
          <!-- <label for="description_or_type" style="font-size:12px; color:#000066;">Description/Type</label> -->
          <label class="control-label" for="description_or_type" style="color:#00008B;"> Warp </label>

          <input type="hidden" class="form-control" id="test_method_for_tear_force_in_warp" name="test_method_for_tear_force_in_warp" value="ISO 13937-2">
          
     </div>

 

     <div class="col-sm-1 text-center">
             <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
         
     </div>
        
         
  <div class="col-sm-1 text-center">
      <select  class="form-control" id="tear_force_in_warp_value_tolerance_range_math_operator" name="tear_force_in_warp_value_tolerance_range_math_operator" onchange="tear_force_in_warp_cal()">
              <option value="">Select Warp Yarn Tear Force Tolerance Range Math Operator</option>
              <?php
                              $tear_force_in_warp_value_tolerance_range_math_operator = $row_for_model_ready_for_raising['tear_force_in_warp_value_tolerance_range_math_operator'];
                         
                                  if($tear_force_in_warp_value_tolerance_range_math_operator=='≥')
                                  {
                               ?>
                                     <option value="≥" selected>≥</option>
                                     <option value="≤"> ≤ </option>
                                     <option value=">"> > </option>
                                     <option value="<"> < </option>
                              <?php
                                  }
                                  else if($tear_force_in_warp_value_tolerance_range_math_operator=='≤')
                                  {
                                 ?>
                                  <option value="≥">≥</option>
                                  <option value="≤" selected> ≤ </option>
                                  <option value=">"> > </option>
                                  <option value="<"> < </option>
                               <?php
                                  }
                                  else if($tear_force_in_warp_value_tolerance_range_math_operator=='>')
                                  {
                                 ?>
                                     <option value="≥">≥</option>
                                     <option value="≤"> ≤ </option>
                                     <option value=">" selected> > </option>
                                     <option value="<"> < </option>
                               <?php
                                  }
                                  else if($tear_force_in_warp_value_tolerance_range_math_operator=='<')
                                  {
                                 ?>
                                     <option value="≥">≥</option>
                                     <option value="≤"> ≤ </option>
                                     <option value=">"> > </option>
                                     <option value="<" selected> < </option>
                               <?php
                                  }
                                  else 
                                  {
                                     ?>

                                     <option value="≥">≥</option>
                                     <option value="≤"> ≤ </option>
                                     <option value=">" > > </option>
                                     <option value="<"> < </option>

                                     <?php
                                  }
                               ?>
       </select>
      
   </div>
      
           <!--Add Input/Select Field Here No Dive Only Input/Select/Radio Button/Checkbox/Textarea -->
          
  <div class="col-sm-1" for="tolerance">

     <input type="text" class="form-control" id="tear_force_in_warp_value_tolerance_value" name="tear_force_in_warp_value_tolerance_value" value="<?php echo $row_for_model_ready_for_raising['tear_force_in_warp_value_tolerance_value']?>" onchange="tear_force_in_warp_cal()" required>
  </div>

  <div class="col-sm-1" for="unit">
     <select  class="form-control" id="uom_of_tear_force_in_warp_value" name="uom_of_tear_force_in_warp_value">
              <option value="">Select Uom Of Warp Yarn Tear Force Properties</option>
              <?php
                              $uom_of_tear_force_in_warp_value = $row_for_model_ready_for_raising['uom_of_tear_force_in_warp_value'];
                         
                                  if($uom_of_tear_force_in_warp_value=='N')
                                  {
                               ?>
                                     <option value="N" selected>N</option>
                                     <option value="kg">kg</option>
                                     <option value="lbf">lbf</option>
                                     <option value="gm">gm</option>
                                     <option value="daN">daN</option>
                                     <option value="oz">oz</option>
                              <?php
                                  }
                                  else if($uom_of_tear_force_in_warp_value=='kg')
                                  {
                                 ?>
                                     <option value="N">N</option>
                                     <option value="kg" selected>kg</option>
                                     <option value="lbf">lbf</option>
                                     <option value="gm">gm</option>
                                     <option value="daN">daN</option>
                                     <option value="oz">oz</option>
                               <?php
                                  }
                                  else if($uom_of_tear_force_in_warp_value=='lbf')
                                  {
                                 ?>
                                     <option value="N">N</option>
                                     <option value="kg">kg</option>
                                     <option value="lbf" selected>lbf</option>
                                     <option value="gm">gm</option>
                                     <option value="daN">daN</option>
                                     <option value="oz">oz</option>
                               <?php
                                  }
                                  else if($uom_of_tear_force_in_warp_value=='gm')
                                  {
                                     ?>

                                     <option value="N">N</option>
                                     <option value="kg">kg</option>
                                     <option value="lbf">lbf</option>
                                     <option value="gm" selected>gm</option>
                                     <option value="daN">daN</option>
                                     <option value="oz">oz</option>

                               <?php
                                  }
                                  else if($uom_of_tear_force_in_warp_value=='daN')
                                  {
                                     ?>

                                     <option value="N">N</option>
                                     <option value="kg">kg</option>
                                     <option value="lbf">lbf</option>
                                     <option value="gm" >gm</option>
                                     <option value="daN" selected>daN</option>
                                     <option value="oz">oz</option>

                               <?php
                                  }
                                  else if($uom_of_tear_force_in_warp_value=='oz')
                                  {
                                     ?>

                                     <option value="N">N</option>
                                     <option value="kg">kg</option>
                                     <option value="lbf">lbf</option>
                                     <option value="gm" >gm</option>
                                     <option value="daN">daN</option>
                                     <option value="oz" selected>oz</option>

                               <?php
                                  }
                                  else 
                                  {
                                     ?>

                                     <option value="N">N</option>
                                     <option value="kg">kg</option>
                                     <option value="lbf">lbf</option>
                                     <option value="gm" >gm</option>
                                     <option value="daN" >daN</option>
                                     <option value="oz">oz</option>

                               <?php
                                  }
                               ?>
      </select>
  </div>

        
  <div class="col-sm-1 text-center" for="min_value">

      <input type="text" class="form-control" id="tear_force_in_warp_value_min_value" name="tear_force_in_warp_value_min_value" value="<?php echo $row_for_model_ready_for_raising['tear_force_in_warp_value_min_value']?>" required>
  </div>
          
  <div class="col-sm-1 text-center">
      
    <input type="text" class="form-control" id="tear_force_in_warp_value_max_value" name="tear_force_in_warp_value_max_value" value="<?php echo $row_for_model_ready_for_raising['tear_force_in_warp_value_max_value']?>" required>

   </div>
            
   
</div><!-- End of <div class="form-group form-group-sm" tear_force_in_warp_value-->     	



<div class="form-group form-group-sm" for="tear_force_in_weft_value">


    <div class="col-sm-3 text-center">
     <label class="control-label" for="tear_force_in_weft_value" style="display: none"><span id="for_tear_force_in_warp_test_name_label">Tear Force</span> <span id="tear_force_in_weft_test_method">(ISO 13937-2)</span></label>
    </div>
   
    <div class="col-sm-2 text-center">
            <!-- <label for="description_or_type" style="font-size:12px; color:#000066;">Description/Type</label> -->
            <label class="control-label" for="description_or_type" style="color:#00008B;"> Weft </label>

             <input type="hidden" class="form-control" id="test_method_for_tear_force_in_weft" name="test_method_for_tear_force_in_weft" value="ISO 13937-2">
            
    </div>



   <div class="col-sm-1 text-center">
         <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
     
 </div>
    
     
  <div class="col-sm-1 text-center">
      <select  class="form-control" id="tear_force_in_weft_value_tolerance_range_math_operator" name="tear_force_in_weft_value_tolerance_range_math_operator" onchange="tear_force_in_weft_cal()">
              <option value="">Select weft Yarn Tear Force Tolerance Range Math Operator</option>
              <?php
                              $tear_force_in_weft_value_tolerance_range_math_operator = $row_for_model_ready_for_raising['tear_force_in_weft_value_tolerance_range_math_operator'];
                         
                                  if($tear_force_in_weft_value_tolerance_range_math_operator=='≥')
                                  {
                               ?>
                                     <option value="≥" selected>≥</option>
                                     <option value="≤"> ≤ </option>
                                     <option value=">"> > </option>
                                     <option value="<"> < </option>
                              <?php
                                  }
                                  else if($tear_force_in_weft_value_tolerance_range_math_operator=='≤')
                                  {
                                 ?>
                                  <option value="≥">≥</option>
                                  <option value="≤" selected> ≤ </option>
                                  <option value=">"> > </option>
                                  <option value="<"> < </option>
                               <?php
                                  }
                                  else if($tear_force_in_weft_value_tolerance_range_math_operator=='>')
                                  {
                                 ?>
                                     <option value="≥">≥</option>
                                     <option value="≤"> ≤ </option>
                                     <option value=">" selected> > </option>
                                     <option value="<"> < </option>
                               <?php
                                  }
                                  else if($tear_force_in_weft_value_tolerance_range_math_operator=='<')
                                  {
                                 ?>
                                     <option value="≥">≥</option>
                                     <option value="≤"> ≤ </option>
                                     <option value=">"> > </option>
                                     <option value="<" selected> < </option>
                               <?php
                                  }
                                  else 
                                  {
                                     ?>

                                     <option value="≥">≥</option>
                                     <option value="≤"> ≤ </option>
                                     <option value=">" > > </option>
                                     <option value="<" > < </option>

                                     <?php
                                  }
                               ?>
       </select>
      
   </div>
    
         <!--Add Input/Select Field Here No Dive Only Input/Select/Radio Button/Checkbox/Textarea -->
      
  <div class="col-sm-1" for="tolerance">

     <input type="text" class="form-control" id="tear_force_in_weft_value_tolerance_value" name="tear_force_in_weft_value_tolerance_value" value="<?php echo $row_for_model_ready_for_raising['tear_force_in_weft_value_tolerance_value']?>" onchange="tear_force_in_weft_cal()" required>
  </div>

  <div class="col-sm-1" for="unit">
     <select  class="form-control" id="uom_of_tear_force_in_weft_value" name="uom_of_tear_force_in_weft_value">
              <option value="">Select Uom Of weft Yarn Tear Force Properties</option>
              <?php
                              $uom_of_tear_force_in_weft_value = $row_for_model_ready_for_raising['uom_of_tear_force_in_weft_value'];
                         
                                  if($uom_of_tear_force_in_weft_value=='N')
                                  {
                               ?>
                                     <option value="N" selected>N</option>
                                     <option value="kg">kg</option>
                                     <option value="lbf">lbf</option>
                                     <option value="gm">gm</option>
                                     <option value="daN">daN</option>
                                     <option value="oz">oz</option>
                              <?php
                                  }
                                  else if($uom_of_tear_force_in_weft_value=='kg')
                                  {
                                 ?>
                                     <option value="N">N</option>
                                     <option value="kg" selected>kg</option>
                                     <option value="lbf">lbf</option>
                                     <option value="gm">gm</option>
                                     <option value="daN">daN</option>
                                     <option value="oz">oz</option>
                               <?php
                                  }
                                  else if($uom_of_tear_force_in_weft_value=='lbf')
                                  {
                                 ?>
                                     <option value="N">N</option>
                                     <option value="kg">kg</option>
                                     <option value="lbf" selected>lbf</option>
                                     <option value="gm">gm</option>
                                     <option value="daN">daN</option>
                                     <option value="oz">oz</option>
                               <?php
                                  }
                                  else if($uom_of_tear_force_in_weft_value=='gm')
                                  {
                                     ?>

                                     <option value="N">N</option>
                                     <option value="kg">kg</option>
                                     <option value="lbf">lbf</option>
                                     <option value="gm" selected>gm</option>
                                     <option value="daN">daN</option>
                                     <option value="oz">oz</option>

                               <?php
                                  }
                                  else if($uom_of_tear_force_in_weft_value=='daN')
                                  {
                                     ?>

                                     <option value="N">N</option>
                                     <option value="kg">kg</option>
                                     <option value="lbf">lbf</option>
                                     <option value="gm" >gm</option>
                                     <option value="daN" selected>daN</option>
                                     <option value="oz">oz</option>

                               <?php
                                  }
                                  else if($uom_of_tear_force_in_weft_value=='oz')
                                  {
                                     ?>

                                     <option value="N">N</option>
                                     <option value="kg">kg</option>
                                     <option value="lbf">lbf</option>
                                     <option value="gm" >gm</option>
                                     <option value="daN" >daN</option>
                                     <option value="oz" selected>oz</option>

                               <?php
                                  }
                                  else 
                                  {
                                     ?>

                                     <option value="N">N</option>
                                     <option value="kg">kg</option>
                                     <option value="lbf">lbf</option>
                                     <option value="gm" >gm</option>
                                     <option value="daN" >daN</option>
                                     <option value="oz">oz</option>

                               <?php
                                  }
                               ?>
      </select>
  </div>

    
  <div class="col-sm-1 text-center" for="min_value">

    <input type="text" class="form-control" id="tear_force_in_weft_value_min_value" name="tear_force_in_weft_value_min_value" value="<?php echo $row_for_model_ready_for_raising['tear_force_in_weft_value_min_value']?>" required>
  </div>
      
  <div class="col-sm-1 text-center">
      
    <input type="text" class="form-control" id="tear_force_in_weft_value_max_value" name="tear_force_in_weft_value_max_value" value="<?php echo $row_for_model_ready_for_raising['tear_force_in_weft_value_max_value']?>" required>

   </div>
        

</div><!-- End of <div class="form-group form-group-sm" tensile_properties_in_weft_value_max_value-->  

</div>     <!-- div_tear_force_value-->   

<!-- *********************************** Designing Tabular Formar (Multi-Column Form Elements Here (End))*********************************** -->

						<div class="form-group form-group-sm">
								<div class="col-sm-offset-3 col-sm-5">
									<button type="button" class="btn btn-primary" onClick="sending_data_of_edit_defining_qc_standard_for_model_ready_for_raising_process_form_for_saving_in_database()">Edit</button>
									<button type="reset" class="btn btn-success">Reset</button>
								</div>
						</div>

				</form>

		</div> <!-- End of <div class="panel panel-default"> -->

</div> <!-- End of <div class="col-sm-12 col-md-12 col-lg-12"> -->
