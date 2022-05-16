<!DOCTYPE html>
<html lang="en">
<?php
//error_reporting(0);

include('../login/db_connection_class.php');
$obj = new DB_Connection_Class();
$obj->connection();

$date = new DateTime('now', new DateTimeZone('Asia/Dhaka'));

?>

<script>
  var d = new Date();
  var ye = new Intl.DateTimeFormat('en', { year: 'numeric' }).format(d);
  var mo = new Intl.DateTimeFormat('en', { month: '2-digit' }).format(d);
  var da = new Intl.DateTimeFormat('en', { day: '2-digit' }).format(d);

  function change_time_duration()
  {
        var date = document.getElementById('date').value;
        var from_time = document.getElementById('from_time').value;
        var to_time = document.getElementById('to_time').value;
        

        start = from_time.split(":");
        end = to_time.split(":");
        var startDate = new Date(0, 0, 0, start[0], start[1], 0);
        var endDate = new Date(0, 0, 0, end[0], end[1], 0);
        var diff = endDate.getTime() - startDate.getTime();
        var hours = Math.floor(diff / 1000 / 60 / 60);
        diff -= hours * 1000 * 60 * 60;
        var minutes = Math.floor(diff / 1000 / 60);

        var diffrance = ((hours * 60) + minutes) / 60;

        $( "#difference" ).show();

        document.getElementById('hours').innerHTML = hours;
        document.getElementById('minutes').innerHTML = minutes;

        document.getElementById('diff_hours').value = hours;
        document.getElementById('diff_minutes').value = minutes;
        document.getElementById('diffrance').value = diffrance;


        //shift calculation
        var problem_date_time = from_time;
        var splitted_time = problem_date_time.split(':');
        var hours_p = splitted_time[0];
        //alert(hours_p);
        var shift = '';
        if(hours_p >=6 && hours_p <14)
        {
            alert('A');
            shift = 'A';
            document.getElementById('shift_in').innerHTML = shift;
            document.getElementById('shift').value = shift;
        }
        else if(hours_p>=14 && hours_p<22)
        {
            shift = 'B';
            document.getElementById('shift_in').innerHTML = shift;
            document.getElementById('shift').value = shift;
        }
        else
        {
            shift = 'C';
            document.getElementById('shift_in').innerHTML = shift;
            document.getElementById('shift').value = shift;
        }
  }

  function sending_data_for_delete(id)
  {
      $.ajax({
            url: 'machine_stopage/machine_stopage_daily_data_input_deleting.php',
            dataType: 'text',
            type: 'post',
            contentType: 'application/x-www-form-urlencoded',
            data: {id:id},
            success: function( data, textStatus, jQxhr )
            {
                alert(data);
            },
            error: function( jqXhr, textStatus, errorThrown )
            {
                alert(errorThrown);
            }
        });  
  }

  function sending_machine_stopage_daily_input_form_for_saving_in_database()
  {
        var url_encoded_form_data = $("#partial_test_for_test_result_form").serialize(); 
        $.ajax({
            url: 'machine_stopage/machine_stopage_daily_data_input_saving.php',
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
        }); 
  }

</script>

</head>
<body class="nav-md">

<script>


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

            <div class="panel-heading" style="color:#191970;"><b>Machine Stopage Daily Data Input</b></div> <!-- This will create a upper block for FORM (Just Beautification) -->
                       
            <br>
						 
            <form id='partial_test_for_test_result_form' name='partial_test_for_test_result_form'  action="" method="post" enctype="multipart/form-data" class="form-horizontal form-label-left" style="margin-bottom: 20px;">

                <div class="form-group form-group-sm" id="form-date">
                    <label class="control-label col-sm-3" for="date" style="color:#00008B;">Date: <span style="color:red">*</span> </label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" id="date" name="date" placeholder="Please Provide Date" required>
                    </div>
                    <div class="col-sm-1">
                        <i class="glyphicon glyphicon-remove" onclick="Remove_Value_Of_This_Element('date')"></i>
                    </div>
                </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_pp_creation_date"> -->

                <script>
                    $( function()
                    {
                        $( "#date" ).datepicker(
                        {
                            showWeek: true, // This is for Showing Week in Datepicker Calender.
                            //altField: "#alternate_partial_test_for_test_result_creation_date_time", // This is for Descriptive Date Showing in Alternative Field.
                            altFormat: "DD, d MM, yy" // This is for Descriptive Date Format in Alternative Field.
                        }
                        ); // End of $( "#pp_creation_date" ).datepicker(

                        $( "#date" ).datepicker( "option", "dateFormat", "dd/mm/yy" ); // This is for Date Format in Actual Date Field.
                        $( "#date" ).datepicker( "option", "showAnim", "drop" ); // This is for Datepicker Calender Animation in Actual Date Field.
                    }
                    ); // End of $( function()
                </script>

                    <div class="form-group form-group-sm" id="form-group_for_process_name">
                        <label class="control-label col-sm-3" for="process_name" style="margin-right:0px; color:#00008B;">Process Name: <span style="color:red">*</span> </label>
                        <div class="col-sm-5">
                            <select  class="form-control" id="process_name" name="process_name" >
                                <option select="selected" value="select">Select Process Name</option>
                                <?php 
                                    $sql = 'select * from `process_name` order by row_id ASC';
                                    $result= mysqli_query($con,$sql) or die(mysqli_error($con));
                                    while( $row = mysqli_fetch_array( $result))
                                    {
                                        echo '<option value="'.$row['process_name'].'">'.$row['process_name'].'</option>';
                                    }
                                ?>
                            </select>
                            <script>
                                $("#process_name").select2({
                                    placeholder: "Select Process Name",
                                    theme: "classic",
                                    selectOnClose: true,
                                    closeOnSelect: true,
                                    allowClear: true
                                });
                            </script>
                        </div>
                    </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_process_name"> -->


                    <div class="form-group form-group-sm" id="form-group_for_machine_name">
                        <label class="control-label col-sm-3" for="machine_name" style="margin-right:0px; color:#00008B;">Machine Name: <span style="color:red">*</span> </label>
                        <div class="col-sm-5">
                            <select  class="form-control" id="machine_name" name="machine_name" >
                                <option select="selected" value="select">Select Machine Name</option>
                                <?php 
                                    $sql = 'select * from `machine_name` order by row_id ASC';
                                    $result= mysqli_query($con,$sql) or die(mysqli_error($con));
                                    while( $row = mysqli_fetch_array( $result))
                                    {
                                        echo '<option value="'.$row['machine_name'].'">'.$row['machine_name'].'</option>';
                                    }
                                ?>
                            </select>
                            <script>
                                $("#machine_name").select2({
                                    placeholder: "Select Machine Name",
                                    theme: "classic",
                                    selectOnClose: true,
                                    closeOnSelect: true,
                                    allowClear: true
                                });
                            </script>
                        </div>
                    </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_machine_name"> -->


                    <div class="form-group form-group-sm" id="form-group_for_machine_name">
                        <label class="control-label col-sm-3" for="problem" style="margin-right:0px; color:#00008B;">Problem:  <span style="color:red">*</span></label>
                        <div class="col-sm-5">
                            <select class="form-control" id="problem" name="problem" >
                                <option value="select" select="selected">Select Problem</option>
                                <?php 
                                    $sql = 'select DISTINCT problem, problem_group from `problems_of_machine_stopage`';
                                    $result= mysqli_query($con,$sql) or die(mysqli_error($con));
                                    while( $row = mysqli_fetch_array( $result))
                                    {
                                        echo '<option value="'.$row['problem'].'?fs?'.$row['problem_group'].'">'.$row['problem'].'</option>';
                                    }
                                    ?>
                            </select>
                            <script>
                                $("#problem").select2({
                                    placeholder: "Select Problem",
                                    theme: "classic",
                                    selectOnClose: true,
                                    closeOnSelect: true,
                                    allowClear: true
                                });
                            </script>
                        </div>
                    </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_machine_name"> -->


                    <div class="form-group form-group-sm" id="form-from_time">
                        <label class="control-label col-sm-3" for="from_time" style="margin-right:0px; color:#00008B;">From Time:  <span style="color:red">*</span></label>
                        <div class="col-sm-5">
                            <input type="time" class="form-control" id="from_time" name="from_time" placeholder="Enter Before From Time">
                        </div>
                        <div class="col-sm-1">
                            <i class="glyphicon glyphicon-remove" onclick="Remove_Value_Of_This_Element('from_time')"></i>
                        </div>
                    </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_before_trolley_or_batcher_in_time"> -->

                    <div class="form-group form-group-sm" id="form-to_time">
                        <label class="control-label col-sm-3" for="to_time" style="margin-right:0px; color:#00008B;">To Time:  <span style="color:red">*</span></label>
                        <div class="col-sm-5">
                            <input type="time" class="form-control" id="to_time" name="to_time" placeholder="Enter To Time" required onchange="change_time_duration()">
                        </div>
                        <div class="col-sm-1">
                            <i class="glyphicon glyphicon-remove" onclick="Remove_Value_Of_This_Element('to_time')"></i>
                        </div>
                    </div> <!-- End of <div class="form-group form-group-sm" id="form-group_for_after_trolley_or_batcher_out_time"> -->

                    <div id="difference" style="display:none;">
                        <p>Difference: Hour:-<span id="hours"></span>, Minute:- <span id="minutes"></span></p>
                        <p>Shift: <span id="shift_in"></span></p>
                    </div>

                     <input type="hidden" class="form-control" id="diff_hours" name="diff_hours">      
                     <input type="hidden" class="form-control" id="diff_minutes" name="diff_minutes">      
                     <input type="hidden" class="form-control" id="shift" name="shift">      
                     <input type="hidden" class="form-control" id="diffrance" name="diffrance">      
            </div>	
							

			<div class="form-group" style="margin-bottom: 16px;">
					

                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                 
                  <button type="button" name="submit" id="submit" class="btn btn-primary" onClick="sending_machine_stopage_daily_input_form_for_saving_in_database()">Submit</button>
                  <button type="reset" name="reset" id="reset" class="btn btn-success">Reset</button>
                  
                </div>
            </div> <!--  End of <div class="form-group"> -->
					    
		</form>

                    
</div>  <!-- end of <div class="panel panel-default"> -->
                    
              



<div class="panel panel-default">

   <div class="form-group form-group-sm">
            

   <div class="form-group form-group-sm">
            <label class="control-label col-sm-12" style="font-size: 25px; text-align:center; padding-top:10px" for="search">Machine Stopage Daily Input List</label>
        </div> 
   </div> <!-- End of <div class="form-group form-group-sm" -->


    <div class="form-group form-group-sm">

         <table id="datatable-buttons" class="table table-striped table-bordered">
            <thead>
                 <tr>
                 <th>SI</th>
                 <th>Date</th>
                 <th>Process Name</th>
                 <th>Machine Name</th>
                 <th>Problem</th>
                 <th>From Time</th>
                 <th>To Time</th>
                 <th>Action</th>
                 </tr>
            </thead>
            <tbody>
            <?php 
                $s1 = 1;
                $sql_for_color = "SELECT * FROM machine_stopage_daily_input ORDER BY id DESC";

                $res_for_color = mysqli_query($con, $sql_for_color);

                while ($row = mysqli_fetch_assoc($res_for_color)) 
                {
             ?>

             <tr>
                <td><?php echo $s1; ?></td>
                <td><?php echo $row['date']; ?></td>
                <td><?php echo $row['process_name']; ?></td>
                <td><?php echo $row['machine_name']; ?></td>
                <td><?php echo $row['problem']; ?></td>
                <td><?php echo $row['from_time']; ?></td>
                <td><?php echo $row['to_time']; ?></td>
                <td>
                      
                        <!-- <button type="submit" id="" name="" class="btn btn-primary btn-xs" onclick="load_page('settings/edit_customer.php?customer_id=<?php echo $row['customer_id']?>')"> Edit </button> -->

                        <button type="submit" id="" name="" class="btn btn-danger btn-xs" onclick="sending_data_for_delete('<?php echo $row['id']?>')"> Delete </button>
                    
                    </td>
                <?php     
                    $s1++;
                    }
                ?>
             </tr>
          </tbody>
         </table>

       </div> <!-- End of <div class="form-group form-group-sm" -->

        <script>
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

        </div>  <!-- end of <div class="panel panel-default"> -->

</div> <!-- End of <div class="col-sm-12 col-md-12 col-lg-12"> -->
      




</body>
</html>