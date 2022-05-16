<!DOCTYPE html>
<html lang="en">
<?php
error_reporting(0);

include('../login/db_connection_class.php');
$obj = new DB_Connection_Class();
$obj->connection();



$t=time();


$date = new DateTime('now', new DateTimeZone('Asia/Dhaka'));

?>

<script type='text/javascript' src='trf/all_test_for_trf_info_form_validation.js'></script>

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



  function sending_data_for_delete(trf_id)
 {
      
       var url_encoded_form_data = 'trf_id='+trf_id;
       
         $.ajax({
          url: '../trf/deleting_partial_test_for_trf_info.php',
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

        

         
             <div class="form-group form-group-sm">
                 <label class="control-label col-sm-5" for="search">All Test(TRF) List</label>
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
                                  $sql_for_trf_for_all_test = "SELECT * FROM `partial_test_for_trf_info` ORDER BY partial_test_for_trf_id ASC";

                                  $res_for_trf_for_all_test = mysqli_query($con, $sql_for_trf_for_all_test);

                                  while ($row = mysqli_fetch_assoc($res_for_trf_for_all_test)) 
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
                      
                        <a href="trf/pdf_file_for_all_test_trf_washing_lab.php?customer_id=<?php echo $value; ?>">
                          <button type="button" id="pdf_file_for_all_test_trf_washing_lab" name="pdf_file_for_all_test_trf_washing_lab"  class="btn btn-success btn-xs">Generate pdf file(Washing)</button>
                        </a>               
                    </div>


                    <div class="col-sm-offset-3 col-sm-5">
                        <?php $value= $row['customer_id']."?fs?".$row['trf_id']."?fs?".$row['process_id']."?fs?".$row['pp_number']."?fs?".$row['version_id']?> 
                        <a href="trf/pdf_file_for_all_test_trf_r_and_d_lab.php?customer_id=<?php echo $value; ?>">
                            <button type="button" id="pdf_file_for_all_test_trf_r_and_d_lab" name="pdf_file_for_all_test_trf_r_and_d_lab"  class="btn btn-primary btn-xs">Generate pdf file(R&D)</button>
                          </a>
                         
                    </div>

                    <div class="col-sm-offset-3 col-sm-5">
                     <?php $value= $row['customer_id']."?fs?".$row['trf_id']."?fs?".$row['process_id']."?fs?".$row['pp_number']."?fs?".$row['version_id']?> 
                      <a href="trf/pdf_file_for_all_test_trf_physical_lab.php?customer_id=<?php echo $value; ?>">
                        <button type="button" id="pdf_file_for_all_test_trf_physical_lab" name="pdf_file_for_all_test_trf_physical_lab"  class="btn btn-warning btn-xs">Generate pdf file(Physical)</button>
                      </a>
                  
                    </div>
                </div>
             <button type="submit" id="" name=""  class="btn btn-info btn-xs" onclick="load_page('trf/edit_all_test_for_trf_info.php?trf_id=<?php echo $row['trf_id']; ?>')">Edit </button>
             <button type="submit" id="" name=""  class="btn btn-danger btn-xs" onclick="sending_data_for_delete('<?php echo $row['trf_id']; ?>')">Delete </button>
    
                           
                      
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


    </div>

	





	
</body>
</html>