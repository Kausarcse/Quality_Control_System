<?php
error_reporting(0);
session_start();
require_once("../login/session.php");
include('../login/db_connection_class.php');
$obj = new DB_Connection_Class();
$obj->connection();

if(isset($_GET['bleaching_id']))
{
   $bleaching_process_id=$_GET['bleaching_id'];
   $sql_for_bleaching_process="select * from defining_qc_standard_for_bleaching_process where `id`='$bleaching_process_id'";
   $result_for_bleaching_process= mysqli_query($con,$sql_for_bleaching_process) or die(mysqli_error($con));
   $row_for_bleaching_process = mysqli_fetch_array( $result_for_bleaching_process);
}
else
{
   $standard_for_which_process='Bleaching';
   $pp_number = $_GET['pp_number'];
   $version_id = $_GET['version_number'];
   $sql_for_bleaching_process = "SELECT * FROM `defining_qc_standard_for_bleaching_process`
   WHERE `standard_for_which_process`='$standard_for_which_process' and `pp_number` = '$pp_number' and `version_id`='$version_id'  ORDER BY id ASC";
   $result_for_bleaching_process= mysqli_query($con,$sql_for_bleaching_process) or die(mysqli_error($con));
   $row_for_bleaching_process = mysqli_fetch_array( $result_for_bleaching_process);
}

?>
<script type='text/javascript' src='process_program/defining_qc_standard_for_bleaching_process_form_validation.js'></script>
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


function fill_all_value_for_table(row_num)
{ 
	$("#pp_"+row_num).val();


}




 function sending_data_of_defining_qc_standard_for_bleaching_process_form_for_saving_in_database()
 {


      //  var validate = Bleaching_Form_Validation();   
       var url_encoded_form_data = $("#defining_qc_standard_for_bleaching_process_form").serialize(); //This will read all control elements value of the form	

		  	 $.ajax({
			 		url: 'process_program/edit_defining_qc_standard_for_bleaching_process_form_saving.php',
			 		dataType: 'text',
			 		type: 'post',
			 		contentType: 'application/x-www-form-urlencoded',
			 		data: url_encoded_form_data,
			 		success: function( data, textStatus, jQxhr )
			 		{
			 				alert(data);
			 				/*$("#defining_qc_standard_for_bleaching_process_form_new").load("process_program/view_qc_standard_for_bleaching_process.php");*/
			 				
			 		},
			 		error: function( jqXhr, textStatus, errorThrown )
			 		{
			 				//console.log( errorThrown );
			 				alert(errorThrown);
			 		}
			 }); // End of $.ajax({

 }//End of function sending_data_of_defining_qc_standard_for_bleaching_process_form_for_saving_in_database()


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

 function delete_bleaching_process(bleaching_id)
{
    var value_for_data= 'bleaching_id='+bleaching_id;
    
/*    $('#version_number').html='<option>This is test </option>';
*/  /*document.getElementById('version_number').innerHTML='<option> option 1</option> <option> option 2</option> ';*/
            $.ajax({
                    url: 'process_program/deleting_bleaching_standard.php',
                    dataType: 'text',
                    type: 'post',
                    contentType: 'application/x-www-form-urlencoded',
                    data: value_for_data,
                          
                    success: function( data, textStatus, jQxhr )
                    {       
                            
                           alert(data);
                           alert(location.pathname);
                           if(data=='Bleaching Standard is successfully Deleted.')
                           {


                            success_alert(data,"process_program/defining_qc_standard_for_bleaching_process.php","Success!");

                            /* $('#for_full_form').load(document.URL + ' #for_full_form');*/
                             /*$('#for_full_form').load('process_program/quickly_defining_qc_standard_for_individual_process.php');*/
                           }
                           
                            
                    },
                    error: function( jqXhr, textStatus, errorThrown )
                    {       
                            //console.log( errorThrown );
                            alert(errorThrown);
                    }
            }); // End of $.ajax({
}   /*End of function Fill_Value_Of_Version_Number_Field(bleaching_id)*/


</script>
<div class="for_full_form"> 

<div class="col-sm-12 col-md-12 col-lg-12 full">

		<div class="panel panel-default"> <!-- This div will create a block/panel for FORM -->

				<div class="panel-heading" style="color:#191970;"><b>Edit Defining Qc Standard For Bleaching Process / Edit </b></div> <!-- This will create a upper block for FORM (Just Beautification) -->

                     

                      <div class="row" data-toggle="collapse" data-target="#search_form_collpapsible_div_1" onClick="change_up_down_arrow_icon_1(this.childNodes[5].childNodes[1].id)">
                         

                     	 <div align="right" style="padding-right:13px;" id='test'> <i class="glyphicon glyphicon-chevron-up text-right"  id='panel_heading_icon_1'></i>
	                    </div>


	                  </div>   <!-- End of <div class="row" data-toggle="collapse" data-target="#search_form_collpapsible_div" > -->

                      <div id='search_form_collpapsible_div_1' class="collapse in"> <!-- For Making Collapsible Section -->



					    <form class="form-horizontal" action="" style="margin-top:10px;" name="defining_qc_standard_for_bleaching_process_form_view" id="defining_qc_standard_for_bleaching_process_form_view" data-toggle="collapse" data-target="#search_form_collpapsible_div">

							  <div class="panel-heading" style="color:#191970;"><b> Bleaching Standard Process List</b></div> <!-- This will create a upper block for FORM (Just Beautification) -->

						        <div class="panel panel-default">
							         <table id="datatable-buttons" class="table table-striped table-bordered">
							         	<thead>
							                 <tr>
							                 <th>SI</th>
							                 <th>PP Number</th>
							                 <th>Version ID</th>
							                 <th>Version Name</th>
							                 <th>Customer Name</th>
							                 <th>Color</th>
                                      <th>Style</th>
							                 <th>Finish Width</th>
							                 <th>Action</th>
							                 </tr>
							            </thead>
							            <tbody>
							            <?php 
							                            $s1 = 1;
							                            $standard_for_which_process='Bleaching';
                                         
                                                if(isset($bleaching_process_id))
                                                {
                                                   $sql_for_bleaching = "SELECT * FROM `defining_qc_standard_for_bleaching_process` WHERE `id`='$bleaching_process_id'";
                                                }
                                                else
                                                {
                                                   $sql_for_bleaching = "SELECT * FROM `defining_qc_standard_for_bleaching_process`
                                                   WHERE `standard_for_which_process`='$standard_for_which_process' and `pp_number` = '$pp_number' and `version_id`='$version_id'  ORDER BY id ASC";
                                                }
                                          
							                            $res_for_bleaching = mysqli_query($con, $sql_for_bleaching);

							                            while ($row = mysqli_fetch_assoc($res_for_bleaching)) 
							                            {

                                                   $pp_number=$row['pp_number'];
                                                   $version_number=$row['version_number'];
                                                   $color=$row['color'];
                                                   $finish_width_in_inch=$row['finish_width_in_inch'];
                                   
                                                   $sql_for_pp_style = "SELECT style_name FROM adding_process_to_version WHERE pp_number = '$pp_number' AND version_name = '$version_number' AND 
                                                                        finish_width_in_inch ='$finish_width_in_inch' AND color = '$color' AND process_name = '$standard_for_which_process'";
                                                   $result_for_pp_style= mysqli_query($con,$sql_for_pp_style) or die(mysqli_error($con));
                                                   $row_for_pp_style=mysqli_fetch_assoc($result_for_pp_style);
      
                                                   //   echo $row_for_pp_style['style_name'];
							             ?>

							             <tr>
							                <td><?php echo $s1; ?></td>
							                <td width="300"><?php echo $row['pp_number']; ?></td>
							                <td><?php echo $row['version_id']; ?></td>
							                <td><?php echo $row['version_number']; ?></td>
							                <td><?php echo $row['customer_name']; ?></td>
							                <td><?php echo $row['color']; ?></td>
                                     <td><?php echo $row_for_pp_style['style_name']; ?></td>
							                <td><?php echo $row['finish_width_in_inch']; ?></td>
							                <td>
							                      
							                        
							                        <!-- <button type="submit" id="edit_bleaching" name="edit_bleaching"  class="btn btn-primary btn-xs" onclick="load_page('settings/edit_bleaching.php?bleaching_id=<?php echo $row['id'] ?>')"> Edit </button>
							                       <span>  </span> -->
							                         <?php
                                                        $id=$row['id'];
                                                     ?>
                                              <button type="submit" id="edit_bleaching" name="edit_bleaching"  class="btn btn-primary btn-xs" onclick="load_page('process_program/edit_defining_qc_standard_for_bleaching_process.php?bleaching_id=<?php echo $row['id'] ?>')"> Edit </button>
							                         <?php 
                                                   $version_id = $row['version_id'];
                                                   $pp_number = $row['pp_number'];
                                                   $finish_width_in_inch = $row['finish_width_in_inch']; 
                                                   $process_name = $standard_for_which_process;
                                                   //$process_id = $row['process_id']; 

                                                   $sql_for_pp_wise_version ="SELECT * FROM `partial_test_for_test_result_info` WHERE pp_number = '$pp_number' and version_id = '$version_id' and process_name = '$process_name' 
                                                            and finish_width_in_inch = '$finish_width_in_inch'";
                                                   $result_for_pp_wise_version =  mysqli_query($con, $sql_for_pp_wise_version);

                                                   $row_number_for_pp_wise_version = mysqli_num_rows($result_for_pp_wise_version);

                                                   if($row_number_for_pp_wise_version >0)
                                                   {
                                                         
                                                   }
                                                   else
                                                   {
                                                      ?>
                                                         <button type="button" id="delete_bleaching" name="delete_bleaching"  class="btn btn-danger btn-xs" onclick="delete_bleaching_process(<?php echo $id;?>)" > Delete </button>
                                                      <?php
                                                   } 
                                             ?>
                                              <!-- <button type="submit" id="delete_bleaching" name="delete_bleaching"  class="btn btn-danger btn-xs" onclick="delete_bleaching_process(<?php echo $id;?>)" > Delete </button> -->
                                                    
							                 </td>
							                <?php
							                              
							                $s1++;
							                                 }
							                 ?> 
							             </tr>
							          </tbody>
							         </table>

					          </div>

						</form>    <!-- End of <form class="form-horizontal" action="" style="margin-top:10px;" name="defining_qc_standard_for_bleaching_process_form" id="defining_qc_standard_for_bleaching_process_form"> -->

				     </div>


         <button type="button" class="btn btn-info" id="buttn_for_load_form" onclick="load_full_form('<?php echo $row_for_bleaching_process['customer_id']?>')">Load Form</button>

        
<!-- For Full Entry Form -->

           <div class="full_page_load" id="full_page_load" style="display: none;">    

				<form class="form-horizontal" action="" style="margin-top:10px;" name="defining_qc_standard_for_bleaching_process_form" id="defining_qc_standard_for_bleaching_process_form">

                        <label>PP Number :<?php echo $row_for_bleaching_process['pp_number']?><input type="hidden" class="form-control" id="pp_number" name="pp_number" value="<?php echo $row_for_bleaching_process['pp_number']?>" readonly></label>  ,
                        

                         <label>Version Name :<?php echo $row_for_bleaching_process['version_number']?><input type="hidden" id="version_number" name="version_number" value="<?php echo $row_for_bleaching_process['version_number']?>" >  </label>  ,
                        

                        <label>Customer Name :<?php echo $row_for_bleaching_process['customer_name']?><input type="hidden" id="customer_name" name="customer_name" value="<?php echo $row_for_bleaching_process['customer_name']?>"> </label>   ,
                        
                        <input type="hidden" id="customer_id" name="customer_id" value="<?php echo $row_for_bleaching_process['customer_id']?>">

                        <label>Color :<?php echo $row_for_bleaching_process['color']?><input type="hidden" id="color" name="color" value="<?php echo $row_for_bleaching_process['color']?>" > </label>    ,
                        
                        <input type="hidden" id="version_id" name="version_id" value="<?php echo $row_for_bleaching_process['version_id']?>" >

                        <label>Finish Width :<?php echo $row_for_bleaching_process['finish_width_in_inch']?><input type="hidden" id="finish_width_in_inch" name="finish_width_in_inch"  value="<?php echo $row_for_bleaching_process['finish_width_in_inch']?>"> </label>

                        <input type="hidden" id="standard_for_which_process" name="standard_for_which_process"  value="<?php echo $row_for_bleaching_process['standard_for_which_process']?>">

                        <!-- <input type="hidden" id="customer_name" name="customer_name" value=""> -->
                        <!-- <input type="hidden" id="customer_id" name="customer_id" value=""> -->
                        <!-- <input type="hidden" id="color" name="color" value="" > -->
                        <!-- <input type="hidden" id="finish_width_in_inch" name="finish_width_in_inch"  value=""> -->
                        <input type="hidden" id="process_id" name="process_id"  value="proc_3">
                        <input type="hidden" id="test_method_id" name="test_method_id"  value="">
						      <input type="hidden" id="checking_data" name="checking_data"  value="">

                     
						
<!-- *********************************** Designing Tabular Formar (Multi-Column Form Elements Here (Start))*********************************** -->

                     <!-- start     <div class="form-group form-group-sm" id="form-group_for_yarn_count_warp_for_tolarance_value"> -->

  


        <div class="form-group form-group-sm">
		     
			    <!-- <div class="col-sm-1 text-center">
					
				</div> -->


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

 <div id="div_whiteness" >


		<div class="form-group form-group-sm" >
      

	      <div class="col-sm-3 text-center">
	         <label class="control-label"  style="color:#00008B;"><span id="test_name_for_whiteness">Whiteness-</span> <span id="whiteness_test_method">Berger</span> </label>
	      </div>
	       
	       <div class="col-sm-2 text-center">
	                <!-- <label for="description_or_type" style="font-size:12px; color:#000066;">Direction/Type</label> -->
	                <label class="control-label" for="description_or_type" style="color:#00008B;"> </label>
	                <input type="hidden" class="form-control" id="test_method_for_whiteness" name="test_method_for_whiteness" value="Berger">


	                <input type="hidden" id="test_id_for_whiteness" name="test_id_for_whiteness" >

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

	             (°)
	            <input type="hidden" id="uom_of_whiteness" name="uom_of_whiteness"  value="<?php echo $row_for_bleaching_process['uom_of_whiteness']?>">
	          </div>

	            
	          <div class="col-sm-1 text-center" for="min_value">

	            <input type="text" class="form-control" id="whiteness_min_value" name="whiteness_min_value" onblur="fill_all_value_for_table(1)"  value="<?php echo $row_for_bleaching_process['whiteness_min_value']?>" required>

	          </div>
	              
	          <div class="col-sm-1 text-center">
	              
	           <input type="text" class="form-control" id="whiteness_max_value" name="whiteness_max_value" onblur="fill_all_value_for_table(1)" value="<?php echo $row_for_bleaching_process['whiteness_max_value']?>" required>

	         </div>
                
       
     </div><!-- End of <div class="form-group form-group-sm" whiteness_max_value-->
</div>  <!-- End of <div id="div_whiteness" style="display: none"> -->


<!-- Start of residual_sizing_material -->
<div id="div_residual_sizing_material"> 						
     
     <div class="form-group form-group-sm" >
      

		      <div class="col-sm-3 text-center">
		         <label class="control-label"  style="color:#00008B;">Residual Sizing Material <span id="residual_sizing_material_test_method">(Drop test method)</span></label>
		      </div>

	       
		       <div class="col-sm-2 text-center">
		                <!-- <label for="description_or_type" style="font-size:12px; color:#000066;">Direction/Type</label> -->
		                <label class="control-label" for="description_or_type" style="color:#00008B;"> </label>
		                <input type="hidden" class="form-control" id="test_method_for_residual_sizing_material" name="test_method_for_residual_sizing_material" value="Drop test method">
		                

		                <input type="hidden" id="test_id_for_residual_sizing_material" name="test_id_for_residual_sizing_material" value="">
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
	            <input type="hidden" name="uom_of_residual_sizing_material" id="uom_of_residual_sizing_material" value="<?php echo $row_for_bleaching_process['uom_of_residual_sizing_material']?>">
	          </div>

	            
	          <div class="col-sm-1 text-center" for="min_value">

	           <input type="text" class="form-control" id="residual_sizing_material_min_value" name="residual_sizing_material_min_value" onblur="fill_all_value_for_table(2)" value="<?php echo $row_for_bleaching_process['residual_sizing_material_min_value']?>" required>

	          </div>
	              
	          <div class="col-sm-1 text-center">
	              
	           <input type="text" class="form-control" id="residual_sizing_material_max_value" name="residual_sizing_material_max_value" onblur="fill_all_value_for_table(2)" value="<?php echo $row_for_bleaching_process['residual_sizing_material_max_value']?>" required>

	         </div>
                
       
     </div><!-- End of <div class="form-group form-group-sm" bath_residual_sizing_material_max_value-->
                       
</div>  <!-- End of <div id="div_residual_sizing_material" style="display: none"> 	 -->



<!-- Start of absorbency_test_method -->

<div id="div_absorbency_test_method" > 	



	 <div class="form-group form-group-sm" >
      

	      <div class="col-sm-3 text-center">
	         <label class="control-label"  style="color:#00008B;">Absorbency  <span id="absorbency_test_method">(Capillary Method)</span></label>
	      </div>
	       
	       <div class="col-sm-2 text-center">
	                <!-- <label for="description_or_type" style="font-size:12px; color:#000066;">Direction/Type</label> -->
	                <label class="control-label" for="description_or_type" style="color:#00008B;"> At 60 Sec</label>
	                <input type="hidden" class="form-control" id="test_method_for_absorbency" name="test_method_for_absorbency" value="Capillary Method">
	                

	                 <input type="hidden" id="test_id_for_absorbency" name="test_id_for_absorbency" value="">
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
	            <input type="hidden" name="uom_of_absorbency" id="uom_of_absorbency" value="<?php echo $row_for_bleaching_process['uom_of_absorbency']?>">
	          </div>

	            
	          <div class="col-sm-1 text-center" for="min_value">

	           <input type="text" class="form-control" id="absorbency_min_value" name="absorbency_min_value" onblur="fill_all_value_for_table(3)" value="<?php echo $row_for_bleaching_process['absorbency_min_value']?>" required>

	          </div>
	              
	          <div class="col-sm-1 text-center">
	              
	           <input type="text" class="form-control" id="absorbency_max_value" name="absorbency_max_value" onblur="fill_all_value_for_table(3)" value="<?php echo $row_for_bleaching_process['absorbency_max_value']?>" required>

	         </div>
	                
       
     </div><!-- End of <div class="form-group form-group-sm" bath_absorbency_max_value-->


</div> <!--  End of <div id="div_absorbency_test_method" style="display: none"> --> 

	
				
<!--  Start of resistance_to_surface_fuzzing_and_pilling -->    

<div id="div_resistance_to_surface_fuzzing_and_pilling"> 

      <div class="form-group form-group-sm" for="surface_fuzzing_and_pilling_value">
          

            <div class="col-sm-3 text-center">
                 <label class="control-label" for="surface_fuzzing_and_pilling_tolerance_range_math_operator" style="color:#00008B;"><span id="for_surface_fuzzing_and_pilling_test_name_label">Resistance to Surface Fuzzing & Pilling</span><span id="surface_fuzzing_and_pilling_test_method">(ISO 12945-2)</span></label>
            </div>
             
             <div class="col-sm-2 text-center">
                 
                  <!-- <label class="control-label" for="description_or_type" style="color:#00008B;">  </label> -->
                  <!-- <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/> -->

                  <select  class="form-control" id="description_or_type_for_surface_fuzzing_and_pilling" name="description_or_type_for_surface_fuzzing_and_pilling" >
                    <option value="">Select Direction/Type Surface Fuzzing and Pilling</option>

                    <?php
                                      $description_or_type_for_surface_fuzzing_and_pilling = $row_for_bleaching_process['description_or_type_for_surface_fuzzing_and_pilling'];
                                     ?>
                                     <?php 
                                          if($description_or_type_for_surface_fuzzing_and_pilling=='Before Wash')
                                          {
                                       ?>
                                          <option value="Before Wash" selected> Before Wash</option>
                                          <option value="After Wash">After Wash</option>
                                      <?php
                                          }
                                          else if($description_or_type_for_surface_fuzzing_and_pilling=='After Wash')
                                          {
                                       ?>
                                          <option value="Before Wash" > Before Wash</option>
                                          <option value="After Wash" selected>After Wash</option>
                                      <?php
                                          }
                                          else
                                          {
                                         ?>
                                          <option value="Before Wash" > Before Wash</option>
                                          <option value="After Wash" >After Wash</option>
                                       <?php
                                          }
                                       ?>
                    
                 </select>

                   <input type="hidden" class="form-control" id="test_method_for_resistance_to_surface_fuzzing_and_pilling" name="test_method_for_resistance_to_surface_fuzzing_and_pilling" value="ISO 12945-2">
                   <input type="hidden" class="form-control" id="test_id_for_resistance_to_surface_fuzzing_and_pilling" name="test_id_for_resistance_to_surface_fuzzing_and_pilling" value="0">
             </div>

            

             
                 
          <div class="col-sm-1 text-center">
              <select  class="form-control" id="surface_fuzzing_and_pilling_tolerance_range_math_operator" name="surface_fuzzing_and_pilling_tolerance_range_math_operator" onchange="surface_fuzzing_and_pilling_cal()">
                <option value="">Select Surface Fuzzing and Pilling Tolerance Range Math Operator</option>
               
                <?php
                                      $surface_fuzzing_and_pilling_tolerance_range_math_operator = $row_for_bleaching_process['surface_fuzzing_and_pilling_tolerance_range_math_operator'];
                                 
                                          if($surface_fuzzing_and_pilling_tolerance_range_math_operator=='≥')
                                          {
                                       ?>
                                             <option value="≥" selected>≥</option>
                                             <option value="≤"> ≤ </option>
                                             <option value=">"> > </option>
                                             <option value="<"> < </option>
                                      <?php
                                          }
                                          else if($surface_fuzzing_and_pilling_tolerance_range_math_operator=='≤')
                                          {
                                         ?>
                                          <option value="≥">≥</option>
                                          <option value="≤" selected> ≤ </option>
                                          <option value=">"> > </option>
                                          <option value="<"> < </option>
                                       <?php
                                          }
                                          else if($surface_fuzzing_and_pilling_tolerance_range_math_operator=='>')
                                          {
                                         ?>
                                             <option value="≥">≥</option>
                                             <option value="≤"> ≤ </option>
                                             <option value=">" selected> > </option>
                                             <option value="<"> < </option>
                                       <?php
                                          }
                                          else if($surface_fuzzing_and_pilling_tolerance_range_math_operator=='<')
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

              <select  class="form-control" id="surface_fuzzing_and_pilling_tolerance_value" name="surface_fuzzing_and_pilling_tolerance_value" onchange="surface_fuzzing_and_pilling_cal()">
                    <option value="">Select Surface Fuzzing and Pilling Tolerance Value</option>
                    
                <?php
                                      $surface_fuzzing_and_pilling_tolerance_value = $row_for_bleaching_process['surface_fuzzing_and_pilling_tolerance_value'];
                                     ?>
                                     <?php 
                                          if($surface_fuzzing_and_pilling_tolerance_value=='1.0')
                                          {
                                       ?>
                                            <option value="1.0" selected>1</option>
                                             <option value="1.5">1-2</option>
                                             <option value="2.0"> 2 </option>
                                             <option value="2.5"> 2-3 </option>
                                             <option value="3.0">3</option>
                                             <option value="3.5">3-4</option>
                                             <option value="4.0"> 4 </option>
                                             <option value="4.5"> 4-5 </option>
                                             <option value="5.0"> 5 </option>
                                      <?php
                                          }
                                          else if($surface_fuzzing_and_pilling_tolerance_value=='1.5')
                                          {
                                         ?>
                                         <option value="1.0">1</option>
                                          <option value="1.5" selected>1-2</option>
                                          <option value="2.0"> 2 </option>
                                          <option value="2.5"> 2-3 </option>
                                          <option value="3.0">3</option>
                                          <option value="3.5">3-4</option>
                                          <option value="4.0"> 4 </option>
                                          <option value="4.5"> 4-5 </option>
                                          <option value="5.0"> 5 </option>
                                       <?php
                                          }
                                          else if($surface_fuzzing_and_pilling_tolerance_value=='2.0')
                                          {
                                         ?>
                                             <option value="1.0">1</option>
                                             <option value="1.5">1-2</option>
                                             <option value="2.0" selected> 2 </option>
                                             <option value="2.5"> 2-3 </option>
                                             <option value="3.0">3</option>
                                             <option value="3.5">3-4</option>
                                             <option value="4.0"> 4 </option>
                                             <option value="4.5"> 4-5 </option>
                                             <option value="5.0"> 5 </option>
                                       <?php
                                          }
                                          else if($surface_fuzzing_and_pilling_tolerance_value=='2.5')
                                          {
                                          ?>
                                             <option value="1.0">1</option>
                                             <option value="1.5">1-2</option>
                                             <option value="2.0"> 2 </option>
                                             <option value="2.5" seleted> 2-3 </option>
                                             <option value="3.0">3</option>
                                             <option value="3.5">3-4</option>
                                             <option value="4.0"> 4 </option>
                                             <option value="4.5"> 4-5 </option>
                                             <option value="5.0"> 5 </option>
                                          <?php
                                          }
                                          else if($surface_fuzzing_and_pilling_tolerance_value=='3.0')
                                          {
                                             ?>
                                             <option value="1.0">1</option>
                                             <option value="1.5">1-2</option>
                                             <option value="2.0"> 2 </option>
                                             <option value="2.5"> 2-3 </option>
                                             <option value="3.0" seleted>3</option>
                                             <option value="3.5">3-4</option>
                                             <option value="4.0"> 4 </option>
                                             <option value="4.5"> 4-5 </option>
                                             <option value="5.0"> 5 </option>
                                          <?php
                                          }
                                          else if($surface_fuzzing_and_pilling_tolerance_value=='3.5')
                                          {
                                             ?>
                                             <option value="1.0">1</option>
                                             <option value="1.5">1-2</option>
                                             <option value="2.0"> 2 </option>
                                             <option value="2.5"> 2-3 </option>
                                             <option value="3.0">3</option>
                                             <option value="3.5" selected>3-4</option>
                                             <option value="4.0"> 4 </option>
                                             <option value="4.5"> 4-5 </option>
                                             <option value="5.0"> 5 </option>
                                          <?php
                                          }
                                          else if($surface_fuzzing_and_pilling_tolerance_value=='4.0')
                                          {
                                             ?>
                                             <option value="1.0">1</option>
                                             <option value="1.5">1-2</option>
                                             <option value="2.0"> 2 </option>
                                             <option value="2.5"> 2-3 </option>
                                             <option value="3.0">3</option>
                                             <option value="3.5">3-4</option>
                                             <option value="4.0" selected> 4 </option>
                                             <option value="4.5"> 4-5 </option>
                                             <option value="5.0"> 5 </option>
                                          <?php
                                          }
                                          else if($surface_fuzzing_and_pilling_tolerance_value=='4.5')
                                          {
                                             ?>
                                             <option value="1.0">1</option>
                                             <option value="1.5">1-2</option>
                                             <option value="2.0"> 2 </option>
                                             <option value="2.5"> 2-3 </option>
                                             <option value="3.0">3</option>
                                             <option value="3.5">3-4</option>
                                             <option value="4.0"> 4 </option>
                                             <option value="4.5" seleted> 4-5 </option>
                                             <option value="5.0"> 5 </option>
                                          <?php
                                          }
                                          else if($surface_fuzzing_and_pilling_tolerance_value=='5.0')
                                          {
                                             ?>
                                             <option value="1.0">1</option>
                                             <option value="1.5">1-2</option>
                                             <option value="2.0"> 2 </option>
                                             <option value="2.5"> 2-3 </option>
                                             <option value="3.0">3</option>
                                             <option value="3.5">3-4</option>
                                             <option value="4.0"> 4 </option>
                                             <option value="4.5" > 4-5 </option>
                                             <option value="5.0" seleted> 5 </option>
                                          <?php
                                          }
                                          else 
                                          {
                                             ?>
                                             
                                             <option value="1.0">1</option>
                                             <option value="1.5">1-2</option>
                                             <option value="2.0"> 2 </option>
                                             <option value="2.5"> 2-3 </option>
                                             <option value="3.0">3</option>
                                             <option value="3.5">3-4</option>
                                             <option value="4.0"> 4 </option>
                                             <option value="4.5"> 4-5 </option>
                                             <option value="5.0" > 5 </option>

                                             <?php
                                          }
                                       ?>
             </select>

          </div>


          <div class="col-sm-1 text-center">
             <input type="text" class="form-control" id="rubs_for_surface_fuzzing_and_pilling" name="rubs_for_surface_fuzzing_and_pilling" value="<?php echo $row_for_bleaching_process['rubs_for_surface_fuzzing_and_pilling']?>" required>
                 
          </div>
                

          <div class="col-sm-1" for="unit">
            RUBS
             <!-- <hr style="color:#FF0000;border-top: 2px dashed #FF0000; margin-top:13px;"/> -->
          </div>

                
          <div class="col-sm-1 text-center" for="min_value">

            <input type="text" class="form-control" id="surface_fuzzing_and_pilling_min_value" name="surface_fuzzing_and_pilling_min_value" value="<?php echo $row_for_bleaching_process['surface_fuzzing_and_pilling_min_value']?>" required>
          </div>
                  
          <div class="col-sm-1 text-center">
              
            <input type="text" class="form-control" id="surface_fuzzing_and_pilling_max_value" name="surface_fuzzing_and_pilling_max_value" value="<?php echo $row_for_bleaching_process['surface_fuzzing_and_pilling_max_value']?>" required>

           </div>
                    
            <input type="hidden" name="uom_of_resistance_to_surface_fuzzing_and_pilling" id="uom_of_resistance_to_surface_fuzzing_and_pilling" value="<?php echo $row_for_bleaching_process['uom_of_resistance_to_surface_fuzzing_and_pilling']?>">    

     </div><!-- End of <div class="form-group form-group-sm" surface_fuzzing_and_pilling-->


</div>  <!-- End of <div id="div_resistance_to_surface_fuzzing_and_pilling" style="display: none">  -->





 <!-- For PH Start -->
<div id="div_ph" > 
	<div class="form-group form-group-sm" >
      

	      <div class="col-sm-3 text-center">
	         <label class="control-label"  style="color:#00008B;">pH (Drop test method)<span id="ph_test_method"></span> </label>
	      </div>

	       
	       <div class="col-sm-2 text-center">
	                <!-- <label for="description_or_type" style="font-size:12px; color:#000066;">Direction/Type</label> -->
	                <label class="control-label" for="description_or_type" style="color:#00008B;"> </label>
	                <input type="hidden" class="form-control" id="test_method_for_ph" name="test_method_for_ph" value="<?php echo $row_for_bleaching_process['test_method_for_ph']?>">


	                 <input type="hidden" id="test_id_for_ph" name="test_id_for_ph" value="">
	                
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
            <input type="hidden" name="uom_of_ph" id="uom_of_ph" value="<?php echo $row_for_bleaching_process['uom_of_ph']?>">
          </div>

	            
          <div class="col-sm-1 text-center" for="min_value">

           <input type="text" class="form-control" id="ph_min_value" name="ph_min_value" onblur="fill_all_value_for_table(5)"value="<?php echo $row_for_bleaching_process['ph_min_value']?>" required>

          </div>
	              
          <div class="col-sm-1 text-center">
              
           <input type="text" class="form-control" id="ph_max_value" name="ph_max_value" onblur="fill_all_value_for_table(5)" value="<?php echo $row_for_bleaching_process['ph_max_value']?>" required>

         </div>
                
       
     </div><!-- End of <div class="form-group form-group-sm" bath_ph_max_value-->

 </div>   <!-- End of <div id="div_ph" style="display: none"> --> 
              

              <div class="form-group form-group-sm">
                                <div class="col-sm-offset-3 col-sm-5">
                                    <button type="button" class="btn btn-primary" onClick="sending_data_of_defining_qc_standard_for_bleaching_process_form_for_saving_in_database()">Save</button>
                                    <button type="reset" class="btn btn-success">Reset</button>
                               </div>
              </div>



</div>    <!-- End of <div class="full_page_load" id="full_page_load" style="display: none;"> -->

					

						


						<div id="table"></div>

		</form>



		</div> <!-- End of <div class="panel panel-default"> -->



</div> <!-- End of <div class="col-sm-12 col-md-12 col-lg-12"> -->


</div>  <!-- End of <div class="for_full_form"> -->


