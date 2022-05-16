<?php

include('../login/db_connection_class.php');
$obj = new DB_Connection_Class();
$obj->connection();
  $pp_number=$_POST['pp_number_value'];

  $option = '<div class="form-group form-group-sm">
		         <table id="datatable_for_copy" class="table table-striped table-bordered">
		         	<thead>
		                 <tr>
		                 <th>SI</th>
		                 <th>Selected/Not</th>
		                 <th>Version Name</th>
		                 <th>Design</th>
		                 <th>Customer</th>
		                 <th>Color</th>
		                 <th>Finish Width</th>
		                 <th>Style</th>
		                 </tr>
		            </thead>
		            <tbody>
		            ';

     

		 $sql = "select * FROM `process_program_info`,`pp_wise_version_creation_info` WHERE `process_program_info`.pp_number=`pp_wise_version_creation_info`.pp_number AND
`process_program_info`.pp_number='$pp_number'";

		 $result= mysqli_query($con,$sql) or die(mysqli_error());
         $s1 = 1;
		 while( $row = mysqli_fetch_array( $result))
		 {    
             $customer = $row['customer_name'];
             $customer_id = $row['customer_id'];
             $color = $row['color'];
             $finish_width_in_inch = $row['finish_width_in_inch'];
             $version_name = $row['version_name'];
             $style_name = $row['style_name'];
             $version_id = $row['version_id'];
             $design = $row['design'];
             $process_technique_name = $row['process_technique_name'];
             $construction_name = $row['construction_name'];
             $version_name = $row['version_name'];

             $option = $option. '<tr>';
             $option = $option. '<td width="50">'.$s1.'</td>';
		    $option = $option. '<td ><input class="form-check-input" type="checkbox" value="'.$version_id.'" name="check_box_select'.$s1.'"></td>';
		    $option = $option. '<td >'.$version_name.'</td>';
		    $option = $option. '<td >'.$design.'</td>';
		    $option = $option. '<td >'.$customer.'</td>';
		    $option = $option. '<td >'.$color.'</td>';
		    $option = $option. '<td >'.$finish_width_in_inch.'</td>';
		    $option = $option. '<td >'.$style_name.'</td>';
		    $option = $option. '</tr>';

             $s1++;

		 }
		 $option = $option. '<input type="hidden" value="'.$s1.'" name="total_number">';
		 $option = $option. '<input type="hidden" value="'.$customer_id.'" name="customer_id" id="customer_id">';
		 $option = $option. '<input type="hidden" value="'.$process_technique_name.'" name="process_technique_name" id="process_technique_name">';
		 $option = $option. '<input type="hidden" value="'.$construction_name.'" name="construction_name" id="construction_name">';
		 $option = $option. '<input type="hidden" value="'.$version_name.'" name="version_name" id="version_name">';
		 $option = $option. '</tr>
			           </tbody>
			          </table>
			         </div>';  

		 echo $option;


?>