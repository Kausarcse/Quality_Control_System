<?php
error_reporting(0);
session_start();
require_once("../login/session.php");
include('../login/db_connection_class.php');
$obj = new DB_Connection_Class();
$obj->connection();


$sql_for_pp = 'select * from `pp_monitoring`';
$result_for_pp= mysqli_query($con,$sql_for_pp) or die(mysqli_error($con));
$row_for_pp=mysqli_fetch_array($result_for_pp);
$s1='1';

?>


<style>


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


function fill_pp_number(pp_number){

   $('#for_form_standard').load('pp_progress_report/pp_status_report.php?all_data='+encodeURIComponent(pp_number));

}
</script>

<script>
    
    

  $(document).ready(function() {
    
 
    /*var table = $('#data_table_for_pp').DataTable( {
       scrollY:        "300px",
        scrollX:        true,
        scrollCollapse: true,
        paging:         false,
        columnDefs: [
            { width: '20%', targets: 0 }
        ],
        fixedColumns: false
    } );
} );
*/
var table = $('#data_table_for_pp').DataTable( {
       scrollY:        "300px",
        scrollX:        true,
        scrollCollapse: true,
        paging:         false,
        columnDefs: [
            { width: '20%', targets: 0 }
        ],
        dom: 'Bfrtip',
        buttons: [
              'excel', 'pdf', 'print'
        ],
        fixedColumns: false,
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

   /* $('#data_table_for_pp').DataTable( {
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
                  } );*/
} );


</script>

  <script>
   
  </script>


<div class="col-sm-12 col-md-12 col-lg-12">



		<div class="panel panel-default"> <!-- This div will create a block/panel for FORM -->

				<div class="panel-heading" style="color:#191970;"><b>PP Monitoring</b></div> <!-- This will create a upper block for FORM (Just Beautification) -->

				   <nav aria-label="breadcrumb">
					  <ol class="breadcrumb">
					    <li class="breadcrumb-item active" aria-current="page">Home</li>
					     <li class="breadcrumb-item"><a onclick="load_page('pp_monitoring/pp_monitoring.php')">PP Monitoring</a></li>
					  </ol>
					</nav>

        <div id="div_table">
          <table id="data_table_for_pp" class="display" cellspacing="0" >
         	<thead>
                 <tr>
                 
                 <th>Current State</th>
                 <th>PP Number</th>
                 <th>Version Name</th>
                 <th>Customer</th>
                 <th>Design</th>
                 <th>Style Name</th>
                 <th>Color</th>
                 <th>Process Technique</th>
                 <th>Fiber Content</th>
                 <th>Finish Width</th>
                 <th>Current Status</th>
                 <th>PP Quantity</th>
                 <th>Process Quantity</th>
                 <th>Action</th>
                 <th>Edit Action</th>
                 </tr>
            </thead>

              <tfoot>
                 <tr>
                 
                 <th></th>
                 <th></th>
                 <th></th>
                 <th></th>
                 <th></th>
                 <th></th>
                 <th></th>
                 <th></th>
                 <th></th>
                 <th></th>
                 <th></th>
                 <th></th>
                 <th></th>
                 </tr>
            </tfoot>


            <tbody>

            	<?php
                   $sql_for_pp = 'SELECT * from `pp_monitoring` Order By pp_monitoring_id DESC';
					$result_for_pp= mysqli_query($con,$sql_for_pp) or die(mysqli_error($con));

					while($row_for_pp=mysqli_fetch_array($result_for_pp))
				  {     
                $pp_number=$row_for_pp['pp_number'];
                $version_number=$row_for_pp['version_number'];
                $style_name=$row_for_pp['style_name'];
                $finish_width_in_inch=$row_for_pp['finish_width_in_inch'];

                $sql_for_pp_color = "select pwvci.color,ppi.customer_name,ppi.design, pwvci.version_id, pwvci.version_name, pwvci.pp_quantity, pwvci.process_technique_name,
                pwvci.percentage_of_cotton_content, pwvci.percentage_of_polyester_content, pwvci.other_fiber_in_yarn, pwvci.percentage_of_other_fiber_content
                from `pp_wise_version_creation_info` pwvci
                 inner join process_program_info ppi on pwvci.pp_num_id=ppi.pp_num_id
                 where pwvci.pp_number='$pp_number' and pwvci.version_name='$version_number' and pwvci.style_name='$style_name' and pwvci.finish_width_in_inch='$finish_width_in_inch'";
                  $result_for_pp_color= mysqli_query($con,$sql_for_pp_color) or die(mysqli_error($con));
                  $row_for_pp_color=mysqli_fetch_array($result_for_pp_color);
                  $customer_name = $row_for_pp_color['customer_name'];
                  $design_name = $row_for_pp_color['design'];
                  $color_name = $row_for_pp_color['color'];
                  $version_id = $row_for_pp_color['version_id'];
                  if($pp_number != '' && $version_number != '' && $style_name != '' && $finish_width_in_inch !='' && $customer_name != '' && $design_name != '' && $color_name != '')
                  {
                  
              	 ?>
               <tr>
                 
                  <td><?php echo $row_for_pp['current_state'] ; ?></td>

                  <?php $value_for_sending_pp= $row_for_pp['pp_number'];?>

                  <td onclick="fill_pp_number('&quot;'<?php echo $value_for_sending_pp?>'&quot;')"><?php echo $row_for_pp['pp_number']  ?></td>

                  <td><?php echo $row_for_pp['version_number']  ?></td>
                  <td><?php echo $row_for_pp_color['customer_name']  ?></td>
                  <td><?php echo $row_for_pp_color['design']  ?></td>
                  <td><?php echo $row_for_pp['style_name']  ?></td>
                  <td><?php echo $row_for_pp_color['color']  ?></td>
                  <td><?php echo $row_for_pp_color['process_technique_name']  ?></td>
                  <td><?php 
                        if($row_for_pp_color['percentage_of_cotton_content']!= ' ' && $row_for_pp_color['percentage_of_cotton_content'] != 0)
                        {
                          echo 'Cotton: '.$row_for_pp_color['percentage_of_cotton_content'].'% ';
                        }
                        if($row_for_pp_color['percentage_of_polyester_content']!= ' ' && $row_for_pp_color['percentage_of_polyester_content'] != 0)
                        {
                          echo 'Polyester: '.$row_for_pp_color['percentage_of_polyester_content'].'% ';
                        }
                        if($row_for_pp_color['percentage_of_other_fiber_content']!= ' ' && $row_for_pp_color['percentage_of_other_fiber_content'] != 0)
                        {
                          echo $row_for_pp_color['other_fiber_in_yarn'].': '.$row_for_pp_color['percentage_of_other_fiber_content'].'% ';
                        }
                  // echo $row_for_pp_color['percentage_of_cotton_content'].'.'.$row_for_pp_color['percentage_of_polyester_content'].'.'.$row_for_pp_color['percentage_of_other_fiber_content']  ?>
                  </td>
                  <td><?php echo $row_for_pp['finish_width_in_inch']  ?></td>
                  <td><?php echo $row_for_pp['current_status']  ?></td>


                  <td><?php echo $row_for_pp_color['pp_quantity']  ?></td>

                <?php
                    // find out process wise qunatity from greige receiving table
                    $sql_for_greige_qty = "SELECT after_trolley_or_batcher_qty FROM partial_test_for_test_result_info  WHERE pp_number='$pp_number' and version_number='$version_number' and style='$style_name' and finish_width_in_inch='$finish_width_in_inch' AND
                      process_id = 'proc_20' and version_id = '$version_id'";
                  $result_for_greige_qty = mysqli_query($con,$sql_for_greige_qty) or die(mysqli_error($con));
                  $row_for_greige_qty=mysqli_fetch_array($result_for_greige_qty);
                ?>

                  <td><?php echo $row_for_greige_qty['after_trolley_or_batcher_qty'];  ?></td>


                  <td>
    
                <?php  
                  $pp = $row_for_pp['pp_number']; 
                  $ver_num = $row_for_pp['version_number'];
                  $finish_width_in_inch = $row_for_pp['finish_width_in_inch'];

                  $sql_for_pp_edit = "SELECT * from pp_wise_version_creation_info
                   where pp_number='$pp_number' and version_name='$version_number' and style_name='$style_name' and finish_width_in_inch='$finish_width_in_inch'";
                  $result_for_pp_edit= mysqli_query($con,$sql_for_pp_edit) or die(mysqli_error($con));
                  $row_for_pp_edit=mysqli_fetch_array($result_for_pp_edit);
                  
                $vers_id = $row_for_pp_edit['version_id'];
                $color = $row_for_pp_edit['color'];
                $pp_and_version = $pp.'?fs?'.$ver_num.'?fs?'.$vers_id.'?fs?'.$color.'?fs?'.$finish_width_in_inch;


                      //adding process with standard calculation
                      $sql_for_add_process_with_standard = "SELECT * from adding_process_to_version
                   where pp_number='$pp_number' and version_name='$version_number' and style_name='$style_name' and finish_width_in_inch='$finish_width_in_inch'";
                      $result_for_add_process_with_standard = mysqli_query($con,$sql_for_add_process_with_standard) or die(mysqli_error($con));
                      //$row_for_add_process_with_standard =mysqli_fetch_array($result_for_add_process_with_standard);

                      //if data in standard then show 1 and not then show 0
                      $done_or_not = array();
                      $count = 1;

                      while (  $row_for_add_process_with_standard = mysqli_fetch_array($result_for_add_process_with_standard) ) 
                      {
                          $process_name = $row_for_add_process_with_standard['process_name'];
                          $process_id = $row_for_add_process_with_standard['process_id'];

                          if ($process_name == 'Greige Receiving') 
                          {
                              $sql_table = 'defining_qc_standard_for_greige_receiving_process';
                          }
                          else if ($process_name == 'Singeing & Desizing') 
                          {
                              $sql_table = 'defining_qc_standard_for_singe_and_desize_process';
                          }
                          else if ($process_name == 'Bleaching') 
                          {
                              $sql_table = 'defining_qc_standard_for_bleaching_process';
                          }
                          else if ($process_name == 'Calander') 
                          {
                              $sql_table = 'defining_qc_standard_for_calendering_process';
                          }
                          else if ($process_name == 'Curing') 
                          {
                              $sql_table = 'defining_qc_standard_for_curing_process';
                          }
                          else if ($process_name == 'Desizing') 
                          {
                              $sql_table = 'defining_qc_standard_for_desizing_process';
                          }
                          else if ($process_name == 'Finishing') 
                          {
                              $sql_table = 'defining_qc_standard_for_finishing_process';
                          }
                          else if ($process_name == 'Mercerize') 
                          {
                              $sql_table = 'defining_qc_standard_for_mercerize_process';
                          }
                          else if ($process_name == 'Printing') 
                          {
                              $sql_table = 'defining_qc_standard_for_printing_process';
                          }
                          else if ($process_name == 'Raising') 
                          {
                              $sql_table = 'defining_qc_standard_for_raising_process';
                          }
                          else if ($process_name == 'Ready For Dyeing') 
                          {
                              $sql_table = 'defining_qc_standard_for_ready_for_dying_process';
                          }
                          else if ($process_name == 'Ready For Mercerize') 
                          {
                              $sql_table = 'defining_qc_standard_for_ready_for_mercerize_process';
                          }
                          else if ($process_name == 'Ready For Print') 
                          {
                              $sql_table = 'defining_qc_standard_for_ready_for_printing_process';
                          }
                          else if ($process_name == 'Ready For Raising') 
                          {
                              $sql_table = 'defining_qc_standard_for_ready_for_raising_process';
                          }
                          else if ($process_name == 'Sanforizing') 
                          {
                              $sql_table = 'defining_qc_standard_for_sanforizing_process';
                          }
                          else if ($process_name == 'Scouring & Bleaching') 
                          {
                              $sql_table = 'defining_qc_standard_for_scouring_bleaching_process';
                          }
                          else if ($process_name == 'Scouring') 
                          {
                              $sql_table = 'defining_qc_standard_for_scouring_process';
                          }
                          else if ($process_name == 'Singeing') 
                          {
                              $sql_table = 'defining_qc_standard_for_singeing_process';
                          }
                          else if ($process_name == 'Steaming') 
                          {
                              $sql_table = 'defining_qc_standard_for_steaming_process';
                          }
                          else if ($process_name == 'Washing') 
                          {
                              $sql_table = 'defining_qc_standard_for_washing_process';
                          }

                          //standard wise data
                          $sql_for_standard_data = "SELECT * FROM `$sql_table` WHERE pp_number='$pp_number' AND `version_number`='$version_number' AND
                                   `version_id`='$vers_id' AND `color`='$color'";

                          $result_for_standard_data = mysqli_query($con,$sql_for_standard_data) or die(mysqli_error($con));
                          $row_for_standard_data =mysqli_num_rows($result_for_standard_data);

                          if ($row_for_standard_data > 0) 
                          {
                              array_push($done_or_not, '1');
                              //print_r($done_or_not);
                          }
                          else
                          {
                              array_push($done_or_not, '0'); 
                          }
                          ++$count;
                      }

                      $all_data_for_standard = '0';

                      //echo count($done_or_not);

                      for ($i=1; $i <= $count; $i++) 
                      { 
                          if ($done_or_not[$i] == '1') 
                          {
                              $all_data_for_standard = '1';
                          }
                      }

                      if ( !($all_data_for_standard == '1') )
                      {
                          ?>
                              <button type="submit" id="deining_standard" class="btn btn-info btn-xs" data-toggle="modal" onclick='form_change_for_standard("<?php echo $pp_and_version; ?>")'>Define Standard</button>
                          <?php
                      }
                  ?>

                  <?php 

                      $sql_for_add_process = "SELECT * from adding_process_to_version
                   where pp_number='$pp_number' and version_name='$version_number' and style_name='$style_name' and finish_width_in_inch='$finish_width_in_inch'";
                      $result_for_add_process = mysqli_query($con,$sql_for_add_process) or die(mysqli_error($con));
                      $row_for_add_process =mysqli_num_rows($result_for_add_process);

                      if ( !($row_for_add_process > 0)) 
                      {
                          ?>
                              <button type="submit" id="adding_process" class="btn btn-success btn-xs" data-toggle="modal" onclick='form_change_for_process("<?php echo $pp_and_version; ?>")'>Adding Process</button>
                          <?php
                      }

                  ?>

                 
                 </td>

                 <td>
                  <button type="submit" id="edit_defining_standard" class="btn btn-info btn-xs" data-toggle="modal" onclick='form_change_for_edit_standard("<?php echo $pp_and_version; ?>")'>Edit Define Standard</button>

                  <?php 
                      if ( $row_for_add_process > 0) 
                      {
                          ?>
                              <button type="submit" id="edit_adding_process" class="btn btn-success btn-xs" data-toggle="modal" onclick='form_change_for_edit_process("<?php echo $pp_and_version; ?>")'>Edit Adding Process</button>
                          <?php
                      }
                  ?>

                 </td>
                  <?php
                    $s1++;
                      
                  }
                }

                ?>
               
             </tr>
          </tbody>
         </table>
        </div>  <!-- End of  <div id="div_table"> -->


      <!-- <form id="standard_and_process_form" enctype="multipart/form-data" class="form-horizontal form-label-left" style="margin-bottom: 20px;"> -->

        <div id="for_buttons">

           <button type="submit" id="copy_process" class="btn btn-success" data-toggle="modal" onclick='form_copy_process()'>Copy Process</button>
          
           <button type="submit" id="copy_standard_and_process" class="btn btn-primary" data-toggle="modal" onclick="form_copy_standard_and_process()">Copy Standard & Process</button>

          

          <button type="submit" id="copy_standard" class="btn btn-info" data-toggle="modal" onclick="form_copy_standard()">Copy Standard</button>


          <button type="submit" id="form_hide" class="btn btn-secondary" data-toggle="modal" onclick="form_hide()">Close Form</button>

        </div>

        <div id="for_form_standard" class=""></div>
        <div id="for_form_process" class=""></div>
        <div id="for_copy_process" class=""></div>
        <div id="for_copy_standard" class=""></div>
        <div id="for_copy_standard_process" class=""></div>

     <!--  </form> -->

      <script>

        function form_copy_standard_and_process()
        {
          $('#for_copy_standard_process').load('copy/multiple_copy_form.php');
          $('#for_copy_standard_process').show();
          $('#for_copy_process').hide();
          $('#for_form_process').hide();
          $('#for_form_standard').hide();
          $('#for_copy_standard').hide();
        }


        /*function form_copy_process(pp_number)
        {

           var value_for_data= 'pp_number_value='+pp_number;

                $.ajax({
                  url: 'copy_process/returning_version_number_details_in_table.php',
                  dataType: 'text',
                  type: 'post',
                  contentType: 'application/x-www-form-urlencoded',
                  data: value_for_data,
                        
                  success: function( data, textStatus, jQxhr )
                  {   
                            
                    var table_info=data;

                    $('#for_copy_process').load('copy_process/multiple_process_copy_form.php?pp_number='+pp_number+'?dataseperator?'+encodeURIComponent(table_info));

                        $('#for_copy_process').show();
                        $('#for_form_process').hide();
                        $('#for_form_standard').hide();
                        $('#for_copy_standard_process').hide();
                        $('#for_copy_standard').hide();
                   
                  },
                  error: function( jqXhr, textStatus, errorThrown )
                  {       
                      
                      alert(errorThrown);
                  }
              }); 
          
        }  */



        function form_copy_process()
                {
                  $('#for_copy_process').load('copy_process/multiple_process_copy_form.php');
                  $('#for_copy_process').show();
                  $('#for_form_process').hide();
                  $('#for_form_standard').hide();
                  $('#for_copy_standard_process').hide();
                  $('#for_copy_standard').hide();
                }  
        
        function form_copy_standard()
        {
          $('#for_copy_standard').load('standard_copy/multiple_copy_form.php');
          $('#for_copy_standard').show();
          $('#for_copy_process').hide();
          $('#for_form_process').hide();
          $('#for_form_standard').hide();
          $('#for_copy_standard_process').hide();
        }
        
        function form_change_for_standard(pp_details)
        {
          // alert(pp_details);
          var myArray = pp_details.split("?fs?");
          var pp_number = myArray[0];
          var version_id = myArray[2];
          var value_for_data= 'pp_number_value='+pp_number;
          // alert(value_for_data);
          // exit();
            $.ajax({
                        url: 'process_program/returning_version_number_details.php',
                        dataType: 'text',
                        type: 'post',
                        contentType: 'application/x-www-form-urlencoded',
                        data: value_for_data,
                              
                        success: function( data, textStatus, jQxhr )
                        {       
                           
                            // alert(data);
                            $('#for_form_standard').load('process_program/quickly_defining_qc_standard_for_individual_process.php?pp_number='+pp_number+'?vsp?'+version_id+'?dataseperator?'+encodeURIComponent(data));

                            //$('#for_form_standard').load('#pp_number_for_searching');

                             //document.getElementById('pp_number_for_searching').innerHTML=data;

                                                   
                            $('#for_form_standard').show();
                            $('#for_form_process').hide();
                            $('#for_copy_process').hide();
                            $('#for_copy_standard_process').hide();
                            $('#for_copy_standard').hide();
                            
                           
                        },
                        error: function( jqXhr, textStatus, errorThrown )
                        {       
                            //console.log( errorThrown );
                            alert(errorThrown);
                        }
                    }); // End of $.ajax({
          
        }

        function form_change_for_edit_standard(pp_details)
        {
          // alert(pp_details);
          var myArray = pp_details.split("?fs?");
          var pp_number = myArray[0];
          var version_id = myArray[2];

          var value_for_data= 'pp_number_value='+pp_number;
            $.ajax({
                        url: 'process_program/returning_version_number_details.php',
                        dataType: 'text',
                        type: 'post',
                        contentType: 'application/x-www-form-urlencoded',
                        data: value_for_data,
                              
                        success: function( data, textStatus, jQxhr )
                        {       
                           
                           
                            $('#for_form_standard').load('process_program/edit_quickly_defining_qc_standard_for_individual_process.php?pp_number='+pp_number+'?vsp?'+version_id+'?dataseperator?'+encodeURIComponent(data));

                            //$('#for_form_standard').load('#pp_number_for_searching');

                             //document.getElementById('pp_number_for_searching').innerHTML=data;

                                                   
                            $('#for_form_standard').show();
                            $('#for_form_process').hide();
                            $('#for_copy_process').hide();
                            $('#for_copy_standard_process').hide();
                            $('#for_copy_standard').hide();
                            
                           
                        },
                        error: function( jqXhr, textStatus, errorThrown )
                        {       
                            //console.log( errorThrown );
                            alert(errorThrown);
                        }
                    }); // End of $.ajax({
          
        }

        function form_change_for_process(pp_details)
        {

          var myArray = pp_details.split("?fs?");
          var pp_number = myArray[0];
          var version_name = myArray[1];
          var version_id = myArray[2];
          var color = myArray[3];
          var finish_width_in_inch = myArray[4];
          var value_for_data= 'pp_number_value='+pp_number;


          // //new work

          // $('#for_form_process').load('process_program/version_wise_process_info.php?pp_number='+pp_number+'?dataseperator?'+version_id);
                             
          // //$('#for_form_process').load('process_program/version_wise_process_info.php');
          // $('#for_form_process').show();
          // $('#for_form_standard').hide();
          // $('#for_copy_process').hide();
          // $('#for_copy_standard_process').hide();
          // $('#for_copy_standard').hide();



            $.ajax({
                        url: 'process_program/returning_version_number_details.php',
                        dataType: 'text',
                        type: 'post',
                        contentType: 'application/x-www-form-urlencoded',
                        data: value_for_data,
                              
                        success: function( data, textStatus, jQxhr )
                        {       
                            
                            //new work

                            $('#for_form_process').load('process_program/version_wise_process_info.php?pp_number='+pp_number+'?dataseperator?'+version_id);
                                               
                            //$('#for_form_process').load('process_program/version_wise_process_info.php');
                            $('#for_form_process').show();
                            $('#for_form_standard').hide();
                            $('#for_copy_process').hide();
                            $('#for_copy_standard_process').hide();
                            $('#for_copy_standard').hide();

                            
                            // $('#for_form_process').load('process_program/version_wise_process_info.php?pp_number='+pp_number+'?dataseperator?'+encodeURIComponent(data));
                             
                            // //$('#for_form_process').load('process_program/version_wise_process_info.php');
                            // $('#for_form_process').show();
                            // $('#for_form_standard').hide();
                            // $('#for_copy_process').hide();
                            // $('#for_copy_standard_process').hide();
                            // $('#for_copy_standard').hide();
                            
                           
                        },
                        error: function( jqXhr, textStatus, errorThrown )
                        {       
                            //console.log( errorThrown );
                            alert(errorThrown);
                        }
                    }); // End of $.ajax({


        }

        function form_change_for_edit_process(pp_and_version)
        {
        
          var split_pp_and_version = pp_and_version.split('?fs?');
          var pp_number = split_pp_and_version[0];
          var verion_number = split_pp_and_version[1];
          var verion_id = split_pp_and_version[2];
          
          // alert(verion_number);
          //  exit();

          var value_for_data= 'pp_number_value='+pp_number;
            $.ajax({
                        url: 'process_program/returning_version_number_details.php',
                        dataType: 'text',
                        type: 'post',
                        contentType: 'application/x-www-form-urlencoded',
                        data: value_for_data,
                              
                        success: function( data, textStatus, jQxhr )
                        {       
                              
                             // alert(data);
                            var split_version_id_for_edit = data.split('?ffss?');
                            var version_id_for_edit = split_version_id_for_edit[1];
                      
                                //alert(pp_and_version);
                           
                            $('#for_form_process').load('process_program/edit_version_wise_process_info.php?pp_and_version='+encodeURIComponent(pp_and_version));
                             
                            //$('#for_form_process').load('process_program/version_wise_process_info.php');
                            $('#for_form_process').show();
                            $('#for_form_standard').hide();
                            $('#for_copy_process').hide();
                            $('#for_copy_standard_process').hide();
                            $('#for_copy_standard').hide();
                            
                           
                        },
                        error: function( jqXhr, textStatus, errorThrown )
                        {       
                            //console.log( errorThrown );
                            alert(errorThrown);
                        }
                    }); // End of $.ajax({


        }

        function form_hide()
        {  
           $('#for_form_standard').hide();
           $('#for_form_process').hide();
           $('#for_copy_process').hide();
           $('#for_copy_standard_process').hide();
           $('#for_copy_standard').hide();
        }
      </script>


      </div>  <!-- End of <div class="panel panel-default"> -->

</div> <!-- End of <div class="col-sm-12 col-md-12 col-lg-12"> -->





