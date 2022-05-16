<?php
session_start();
require_once("../login/session.php");
include('../login/db_connection_class.php');
$obj = new DB_Connection_Class();
$obj->connection();

//print_r($_POST);
//exit;

$data_previously_saved = "No";
$data_insertion_hampering = "No";


$user_id = $_SESSION['user_id'];
$password = $_SESSION['password'];
$user_name = $_SESSION['user_name'];




 $pp_number= $_POST['pp_number'];
 $version_number= $_POST['version_number'];
 

 $customer_name= $_POST['customer_name'];
 $customer_id= $_POST['customer_id'];
 $color= $_POST['color'];
 $finish_width_in_inch= $_POST['finish_width_in_inch'];
 $standard_for_which_process= $_POST['standard_for_which_process'];


 
 $test_method_for_whiteness= $_POST['test_method_for_whiteness'];
 $whiteness_min_value= $_POST['whiteness_min_value'];
 $whiteness_max_value= $_POST['whiteness_max_value'];
 $uom_of_whiteness= $_POST['uom_of_whiteness'];


 $test_method_for_bowing_and_skew= $_POST['test_method_for_bowing_and_skew'];
 $bowing_and_skew_tolerance_range_math_operator= mysqli_real_escape_string($con,stripslashes(trim($_POST['bowing_and_skew_tolerance_range_math_operator'])));
 $bowing_and_skew_tolerance_value= $_POST['bowing_and_skew_tolerance_value'];
 $bowing_and_skew_min_value= $_POST['bowing_and_skew_min_value'];
 $bowing_and_skew_max_value= $_POST['bowing_and_skew_max_value'];
 $uom_of_bowing_and_skew= $_POST['uom_of_bowing_and_skew'];


 
 $test_method_for_ph= $_POST['test_method_for_ph'];
 $ph_min_value= $_POST['ph_min_value'];
 $ph_max_value= $_POST['ph_max_value'];
 $uom_of_ph= $_POST['uom_of_ph'];


mysqli_query($con,"BEGIN");
mysqli_query($con,"START TRANSACTION") or die(mysqli_error($con));

$select_sql_for_duplicacy="select * from `defining_qc_standard_for_ready_for_mercerize_process` 
							where 
								`pp_number`='$pp_number' and 
								`version_number`='$version_number' and 
								`customer_name`='$customer_name' and 
								`color`='$color' and 
								`finish_width_in_inch`=$finish_width_in_inch and 
								`standard_for_which_process`='$standard_for_which_process' AND
								
								`whiteness_min_value`='$whiteness_min_value' AND 
								`whiteness_max_value`= '$whiteness_max_value' AND

								`bowing_and_skew_tolerance_range_math_operator`=  '$bowing_and_skew_tolerance_range_math_operator' AND
								`bowing_and_skew_tolerance_value`='$bowing_and_skew_tolerance_value' AND
								`bowing_and_skew_min_value`= '$bowing_and_skew_min_value' AND
								`bowing_and_skew_max_value`='$bowing_and_skew_max_value' AND

								`ph_min_value`='$ph_min_value' AND
								`ph_max_value`= '$ph_max_value'";

$result = mysqli_query($con,$select_sql_for_duplicacy) or die(mysqli_error($con));

if(mysqli_num_rows($result)>0)
{

	$data_previously_saved="Yes";

}
else if( mysqli_num_rows($result) < 1)
{


	$update_sql_statement="UPDATE `defining_qc_standard_for_ready_for_mercerize_process` SET
	                      
	                       `whiteness_min_value`='$whiteness_min_value', 
	                       `whiteness_max_value`= '$whiteness_max_value',

	                       `bowing_and_skew_tolerance_range_math_operator`=  '$bowing_and_skew_tolerance_range_math_operator',
	                       `bowing_and_skew_tolerance_value`='$bowing_and_skew_tolerance_value',
	                       `bowing_and_skew_min_value`= '$bowing_and_skew_min_value',
	                       `bowing_and_skew_max_value`='$bowing_and_skew_max_value',

	                       `ph_min_value`='$ph_min_value', 
	                       `ph_max_value`= '$ph_max_value'

	                       WHERE
                           `pp_number`='$pp_number' and `version_number`='$version_number' and `customer_name`='$customer_name' and `color`='$color' and `finish_width_in_inch`=$finish_width_in_inch and 
                            `standard_for_which_process`='$standard_for_which_process' ";
  
	mysqli_query($con,$update_sql_statement) or die(mysqli_error($con));

	if(mysqli_affected_rows($con)<>1)
	{
	
		$data_insertion_hampering = "Yes";
	
	}

	$process_id= $_POST['process_id'];
	$version_id = $_POST['version_id'];

        $checking_data= $_POST['checking_data'];

        $test_method_id= $_POST['test_method_id'];
        $splitted_test_method_id=explode(',', $test_method_id);

        for($i=0 ; $i < count($splitted_test_method_id)-1 ; $i++)
        	{
			
			 	$sql_for_test_method_test = "SELECT * FROM data_for_all_standard 
											WHERE pp_number = '$pp_number' and
											version_number = '$version_number' and
											customer_id = '$customer_id' and
											color = '$color' and
											process_id = '$process_id' and test_method_id = '$splitted_test_method_id[$i]'";

			 	$result_for_test_method_test = mysqli_query($con,$sql_for_test_method_test) or die(mysqli_error($con));
				 $row_for_test_method_test = mysqli_fetch_assoc($result_for_test_method_test);
				
				 	 $test_method_id_for_selected = $row_for_test_method_test['test_method_id'];
					 if($test_method_id_for_selected == $splitted_test_method_id[$i])
					 {
						
					 }
					 else
					 {
						$insert_sql_statement_for_test_method="insert into `data_for_all_standard` 
                               ( 
                               `test_method_id`,
                               `pp_number`,
                               `version_id`,
                               `version_number`,
                               `customer_id`,
                               `color`,
                               `process_id`,
                               `checking_data`

                               ) 
								values 
								(
								'$splitted_test_method_id[$i]',
								'$pp_number',
								'$version_id',
                                '$version_number',
                                '$customer_id',
                                '$color',
                                '$process_id',
                                '$checking_data'
                                 )";

          				mysqli_query($con,$insert_sql_statement_for_test_method) or die(mysqli_error($con));
					 }
        	}

		
}

if($data_previously_saved == "Yes")
{

	mysqli_query($con,"ROLLBACK");
	echo "Data is previously saved.";

}
else if($data_insertion_hampering == "No" )
{

	mysqli_query($con,"COMMIT");
	echo "Data is successfully Updated.";

}
else
{

	mysqli_query($con,"ROLLBACK");
	echo "Data is not  Updated.";

}

$obj->disconnection();

?>
