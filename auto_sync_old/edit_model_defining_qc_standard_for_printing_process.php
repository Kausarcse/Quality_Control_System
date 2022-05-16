<?php
error_reporting(0);
session_start();
require_once("../login/session.php");
include('../login/db_connection_class.php');
$obj = new DB_Connection_Class();
$obj->connection();

$model_printing_id = '';

if(isset($_GET['model_printing_id']))
{
   $model_printing_id=$_GET['model_printing_id'];
   $sql_for_model_printing="select * from model_defining_qc_standard_for_printing_process where `id`='$model_printing_id'";
   $result_for_model_printing= mysqli_query($con,$sql_for_model_printing) or die(mysqli_error($con));
   $row_for_model_printing = mysqli_fetch_array( $result_for_model_printing);
}

?>
<script type='text/javascript' src='process_program/defining_qc_standard_for_printing_process_form_validation.js'></script>
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



 function sending_data_of_edit_defining_qc_standard_for_model_printing_process_form_for_saving_in_database()
{
       var url_encoded_form_data = $("#defining_qc_standard_for_model_printing_process_form").serialize();

       $.ajax({
        url: 'auto_sync/edit_model_defining_qc_standard_for_printing_process_saving.php',
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

   


}//End of function sending_data_of_defining_qc_standard_for_model_printing_process_form_for_saving_in_database()



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

				<div class="panel-heading" style="color:#191970;"><b>Edit Model Defining Standard For Printing Process</b></div> 

				<div class="row" data-toggle="collapse" data-target="#search_form_collpapsible_div_1" onClick="change_up_down_arrow_icon_1(this.childNodes[5].childNodes[1].id)">

                    <div style="padding-right:13px;" id='test'> <i class="glyphicon glyphicon-chevron-up text-right"  id='panel_heading_icon_1'></i></div>

                </div>   

                <div id='search_form_collpapsible_div_1' class="collapse in"> 



                     <form class="form-horizontal" action="" style="margin-top:10px;" name="defining_qc_standard_for_model_printing_process_form_view" id="defining_qc_standard_for_model_printing_process_form_view" data-toggle="collapse" data-target="#search_form_collpapsible_div">
					
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
                                  $standard_for_which_process='Ready For Print';

                                  if(isset($model_printing_id))
                                  {
                                    $sql_for_model_printing = "SELECT * FROM `model_defining_qc_standard_for_printing_process` WHERE `id`='$model_printing_id'";
                                  }


                                  $res_for_model_printing = mysqli_query($con, $sql_for_model_printing);

                                  while ($row = mysqli_fetch_assoc($res_for_model_printing))
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

                                         <button type="submit" id="edit_model_printing" name="edit_model_printing"  class="btn btn-info btn-xs" onclick="load_page('auto_sync/edit_model_defining_qc_standard_for_printing_process.php?model_printing_id=<?php echo $row['id'] ?>')"> Edit </button>

			                             </td>
	                              <?php

	                              $s1++;
	                                }
	                             ?>
                           </tr>
                        </tbody>
                       </table>

                    </div>

               </form>    <!-- End of <form class="form-horizontal" action="" style="margin-top:10px;" name="defining_qc_standard_for_model_printing_process_form" id="defining_qc_standard_for_model_printing_process_form"> -->

	</div> <!-- End of <div class="panel-heading" style="color:#191970;"><b> model_printing Standard Process List</b></div>  -->

   <button type="button" class="btn btn-info" id="buttn_for_load_form" onclick="load_full_form('<?php echo $row_for_model_printing['customer_id']?>')">Load Form</button>




           <div class="full_page_load" id="full_page_load" style="display: none;">	



    <form class="form-horizontal" action="" style="margin-top:10px;" name="defining_qc_standard_for_model_printing_process_form" id="defining_qc_standard_for_model_printing_process_form">
						
						<input type="hidden" id="process_id" name="process_id"  value="proc_8">
			            <input type="hidden" id="test_method_id" name="test_method_id"  value="">
						<input type="hidden" id="checking_data" name="checking_data"  value="">
						
						<!-------------- for model standard (start) -------------->
						<input type="hidden" class="form-control" id="version_number" name="version_number" value="<?php echo $row_for_model_printing['version_number']; ?>">
						<input type="hidden" class="form-control" id="customer_id" name="customer_id" value="<?php echo $row_for_model_printing['customer_id']; ?>">
						<input type="hidden" class="form-control" id="customer_name" name="customer_name" value="<?php echo $row_for_model_printing['customer_name']; ?>">
						<input type="hidden" class="form-control" id="color_name" name="color_name" value="<?php echo $row_for_model_printing['color']; ?>">
						<input type="hidden" class="form-control" id="process_name" name="process_name" value="<?php echo $row_for_model_printing['process_name']; ?>">
						<input type="hidden" class="form-control" id="process_serial" name="process_serial" value="<?php echo $row_for_model_printing['process_serial']; ?>">
						<input type="hidden" class="form-control" id="process_technique_name" name="process_technique_name" value="<?php echo $row_for_model_printing['process_technique']; ?>">

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

 <!-- For rubbing_dry -->
 <div id="div_cf_to_rubbing" >

<div class="form-group form-group-sm">
    
    <!-- <div class="col-sm-1 text-center">
            
    </div> -->

    <div class="col-sm-3 text-center">
         <label class="control-label" for="cf_to_rubbing_dry_value" style="color:#00008B; margin-top:23px;"><span id="for_cf_to_rubbing_dry_test_name_label">Color Fastness to Rubbing</span> <span id="cf_to_rubbing_dry_test_method"></span></label>
    </div>
     
     <div class="col-sm-2 text-center">
          <!-- <label for="description_or_type" style="font-size:12px; color:#000066;">Description/Type</label> -->
          <label class="control-label" for="description_or_type" style="color:#00008B; margin-top:23px;"> Dry </label>
          <input type="hidden" class="form-control" id="test_method_for_cf_to_rubbing_dry" name="test_method_for_cf_to_rubbing_dry" value="ISO 105 X12">

     </div>


    
     <div class="col-sm-1 text-center">
            <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:35px;"/>
     </div>
        
         
  <div class="col-sm-1 text-center">
      <select  class="form-control" id="cf_to_rubbing_dry_tolerance_range_math_operator" name="cf_to_rubbing_dry_tolerance_range_math_operator" style="color:#00008B; margin-top:23px;" onchange="cf_to_rubbing_dry_cal()">
          <option value="">Select Color Fastness to Rubbing Dry Tolerance Range Math Operator</option>
          <?php
                              $cf_to_rubbing_dry_tolerance_range_math_operator = $row_for_model_printing['cf_to_rubbing_dry_tolerance_range_math_operator'];
                         
                                  if($cf_to_rubbing_dry_tolerance_range_math_operator=='≥')
                                  {
                               ?>
                                     <option value="≥" selected>≥</option>
                                     <option value="≤"> ≤ </option>
                                     <option value=">"> > </option>
                                     <option value="<"> < </option>
                              <?php
                                  }
                                  else if($cf_to_rubbing_dry_tolerance_range_math_operator=='≤')
                                  {
                                 ?>
                                  <option value="≥">≥</option>
                                  <option value="≤" selected> ≤ </option>
                                  <option value=">"> > </option>
                                  <option value="<"> < </option>
                               <?php
                                  }
                                  else if($cf_to_rubbing_dry_tolerance_range_math_operator=='>')
                                  {
                                 ?>
                                     <option value="≥">≥</option>
                                     <option value="≤"> ≤ </option>
                                     <option value=">" selected> > </option>
                                     <option value="<"> < </option>
                               <?php
                                  }
                                  else if($cf_to_rubbing_dry_tolerance_range_math_operator=='<')
                                  {
                                 ?>
                                     <option value="≥">≥</option>
                                     <option value="≤"> ≤ </option>
                                     <option value=">" > > </option>
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

    <input type="text" class="form-control" id="cf_to_rubbing_dry_tolerance_value" name="cf_to_rubbing_dry_tolerance_value" value="<?php echo $row_for_model_printing['cf_to_rubbing_dry_tolerance_value']?>"  required onchange="cf_to_rubbing_dry_cal()" style="color:#00008B; margin-top:23px;">

  </div>

  <div class="col-sm-1" for="unit">
      <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:35px;"/>
    <input type="hidden" id="uom_of_cf_to_rubbing_dry" name="uom_of_cf_to_rubbing_dry"  value="<?php echo $row_for_model_printing['uom_of_cf_to_rubbing_dry']?>">
  </div>

        
  <div class="col-sm-1 text-center" for="min_value">

      <input type="text" class="form-control" id="cf_to_rubbing_dry_min_value" name="cf_to_rubbing_dry_min_value" style="color:#00008B; margin-top:23px;" value="<?php echo $row_for_model_printing['cf_to_rubbing_dry_min_value']?>" required>
     
  </div>
          
  <div class="col-sm-1 text-center">
      
    <input type="text" class="form-control" id="cf_to_rubbing_dry_max_value" name="cf_to_rubbing_dry_max_value" style="color:#00008B; margin-top:23px;" value="<?php echo $row_for_model_printing['cf_to_rubbing_dry_max_value']?>" required>

   </div>
            
        

</div><!-- End of <div class="form-group form-group-sm" cf_to_rubbing_dry -->



<div class="form-group form-group-sm">
    
    <!-- <div class="col-sm-1 text-center">
            
    </div> -->

    <div class="col-sm-3 text-center">
         <label class="hidden" for="cf_to_rubbing_dry_value" style="color:#00008B;"><span id="for_cf_to_rubbing_wet_test_name_label" style="display: none;">Color Fastness to Rubbing <span id="cf_to_rubbing_wet_test_method" style="display: none;"></span></label>
    </div>
     
     <div class="col-sm-2 text-center">
          <!-- <label for="description_or_type" style="font-size:12px; color:#000066;">Description/Type</label> -->
          <label class="control-label" for="description_or_type" style="color:#00008B;"> Wet </label>
          <input type="hidden" class="form-control" id="test_method_for_cf_to_rubbing_wet" name="test_method_for_cf_to_rubbing_wet" value="ISO 105 X12">
          
     </div>

     
     <div class="col-sm-1 text-center">
            <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
          
     </div>
        
         
  <div class="col-sm-1 text-center">
      <select  class="form-control" id="cf_to_rubbing_wet_tolerance_range_math_operator" name="cf_to_rubbing_wet_tolerance_range_math_operator" onchange="cf_to_rubbing_wet_cal()">
              <option value="">Select Color Fastness to Rubbing Wet Tolerance Range Math Operator</option>
              <?php
                              $cf_to_rubbing_wet_tolerance_range_math_operator = $row_for_model_printing['cf_to_rubbing_wet_tolerance_range_math_operator'];
                         
                                  if($cf_to_rubbing_wet_tolerance_range_math_operator=='≥')
                                  {
                               ?>
                                     <option value="≥" selected>≥</option>
                                     <option value="≤"> ≤ </option>
                                     <option value=">"> > </option>
                                     <option value="<"> < </option>
                              <?php
                                  }
                                  else if($cf_to_rubbing_wet_tolerance_range_math_operator=='≤')
                                  {
                                 ?>
                                  <option value="≥">≥</option>
                                  <option value="≤" selected> ≤ </option>
                                  <option value=">"> > </option>
                                  <option value="<"> < </option>
                               <?php
                                  }
                                  else if($cf_to_rubbing_wet_tolerance_range_math_operator=='>')
                                  {
                                 ?>
                                     <option value="≥">≥</option>
                                     <option value="≤"> ≤ </option>
                                     <option value=">" selected> > </option>
                                     <option value="<"> < </option>
                               <?php
                                  }
                                  else if($cf_to_rubbing_wet_tolerance_range_math_operator=='<')
                                  {
                                 ?>
                                     <option value="≥">≥</option>
                                     <option value="≤"> ≤ </option>
                                     <option value=">" > > </option>
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

    <input type="text" class="form-control" id="cf_to_rubbing_wet_tolerance_value" name="cf_to_rubbing_wet_tolerance_value" value="<?php echo $row_for_model_printing['cf_to_rubbing_wet_tolerance_value']?>" onchange="cf_to_rubbing_wet_cal()" required>

  </div>

  <div class="col-sm-1" for="unit">
      <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/>
    <input type="hidden" id="uom_of_cf_to_rubbing_wet" name="uom_of_cf_to_rubbing_wet"  value="<?php echo $row_for_model_printing['uom_of_cf_to_rubbing_wet']?>">
  </div>

        
  <div class="col-sm-1 text-center" for="min_value">

      <input type="text" class="form-control" id="cf_to_rubbing_wet_min_value" name="cf_to_rubbing_wet_min_value" value="<?php echo $row_for_model_printing['cf_to_rubbing_wet_min_value']?>" required>
     
  </div>
          
  <div class="col-sm-1 text-center">
      
    <input type="text" class="form-control" id="cf_to_rubbing_wet_max_value" name="cf_to_rubbing_wet_max_value" value="<?php echo $row_for_model_printing['cf_to_rubbing_wet_max_value']?>" required>

   </div>
            
        

</div><!-- End of <div class="form-group form-group-sm" cf_to_rubbing_wet -->




</div>     <!--  End of <div id="div_cf_to_rubbing" style="display: none"> -->




<!-- *********************************** Designing Tabular Formar (Multi-Column Form Elements Here (End))*********************************** -->

						<div class="form-group form-group-sm">
								<div class="col-sm-offset-3 col-sm-5">
									<button type="button" class="btn btn-primary" onClick="sending_data_of_edit_defining_qc_standard_for_model_printing_process_form_for_saving_in_database()">Edit</button>
									<button type="reset" class="btn btn-success">Reset</button>
								</div>
						</div>

				</form>

		</div> <!-- End of <div class="panel panel-default"> -->

</div> <!-- End of <div class="col-sm-12 col-md-12 col-lg-12"> -->
