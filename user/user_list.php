<?php
session_start();
include('../login/db_connection_class.php');
$obj = new DB_Connection_Class();
$obj->connection();

?>


<style>

.form-group		/* This is for reducing Gap among Form's Fields */
{

	margin-bottom: 5px;

}

</style>




<div class="col-sm-12 col-md-12 col-lg-12">

   <div class="panel panel-default"> <!-- This div will create a block/panel for FORM -->

			    <nav aria-label="breadcrumb">
					  <ol class="breadcrumb">
					    <li class="breadcrumb-item active" aria-current="page">Home</li>
					     <li class="breadcrumb-item"><a onclick="load_page('user/user_list.php')">User List</a></li>
					  </ol>
				</nav>

        <form class="form-horizontal" action="POST" style="margin-top:10px;" name="user_list_form" id="user_list_form">
 	                    

 	                    
        <div class="form-group form-group-sm">
            <label class="control-label col-sm-12" style="font-size: 25px; text-align:center; padding-top:10px" for="search">User List</label>
	    </div> <!-- End of <div class="form-group form-group-sm" -->



				      <div class="form-group form-group-sm">
					        <table id="datatable-buttons" class="table table-striped table-bordered">
					         	<thead>
					                 <tr>
					                 <th>SI</th>
					                 <th>User Name</th>
					                 <th>Employee ID</th>
					                 <th>User Type</th>
					                 <th>Email</th>
					                 <th>Contact No.</th>
					                 <th>Department</th>
					                 <th>Designation</th>
					                 <th>status</th>
					                 <th>Action</th>
					                 </tr>
					            </thead>
					            <tbody>
					            <?php 
					                            $s1 = 1;
					                            $sql_for_user_list = "SELECT * FROM user_login";

					                            $res_for_user_list = mysqli_query($con, $sql_for_user_list);

					                            while ($row = mysqli_fetch_assoc($res_for_user_list)) 
					                            {
					             ?>

					             <tr>
					                <td><?php echo $s1; ?></td>
					                <td><?php echo $row['user_name']; ?></td>
					                <td><?php echo $row['user_id']; ?></td>
					                <td><?php echo $row['user_type']; ?></td>
					                <td><?php echo $row['email']; ?></td>
					                <td><?php echo $row['contact_no']; ?></td>
					                <td><?php echo $row['department']; ?></td>
					                <td><?php echo $row['designation']; ?></td>
					                <td><?php echo $row['status']; ?></td>
					                <td>
					                      
					                      <button type="submit" id="" name="" class="btn btn-primary btn-xs" onclick="load_page('user/edit_user.php?user_id=<?php echo $row['user_id']?>')"> Edit </button>


					                      <button type="submit" id="" name="" class="btn btn-danger btn-xs" onclick="load_page('user/user_deleting.php?user_id=<?php echo $row['user_id']?>')"> Delete </button>
					                     
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


						

			</form> <!-- End Of <form class="form-horizontal" action="POST" style="margin-top:10px;" name="user_list_form" id="user_list_form"> -->

		</div> <!-- End of <div class="panel panel-default"> -->

</div> <!-- End of <div class="col-sm-12 col-md-12 col-lg-12"> -->