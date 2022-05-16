<?php

include('../login/db_connection_class.php');
$obj = new DB_Connection_Class();
$obj->connection();

 $trf_id = $_POST['trf_id'];
 $pp_number = $_POST['pp_number'];

$version_number_all=$_POST['version_number'];
$splitted_version = explode('?fs?', $version_number_all);
$version_number = $splitted_version[0];


$customer_id = $_POST['customer_id'];
$finish_width_in_inch = $_POST['finish_width_in_inch'];
$color = $_POST['color'];
$style_name=$_POST['style_name'];
$design=$_POST['design'];

$process_name_all = $_POST['process_name'];
$splitted_process = explode('?fs?',$process_name_all);
$process_id = $splitted_process[0];
$process_name = $splitted_process[1];

$before_trolley_number_or_batcher_number = $_POST['before_trolley_number_or_batcher_number'];
$after_trolley_number_or_batcher_number = $_POST['after_trolley_number_or_batcher_number'];


$image_files= $_FILES['verified_signature'];

$verified_signature_name= $_FILES['verified_signature']["name"];

$verified_signature_type= $_FILES['verified_signature']["type"];
$verified_signature_tmp_name= $_FILES['verified_signature']["tmp_name"];
$verified_signature_error= $_FILES['verified_signature']["error"];
$verified_signature_size= $_FILES['verified_signature']["size"];





if(empty($image_files) || $verified_signature_name == "" || $verified_signature_type == "" || $verified_signature_tmp_name == "" || $verified_signature_error == 4)
{
	$error_msg = "Sorry, No Image file is attached!";
	$verified_signature_name = "default.png";
}
else
{   

	$target_file = move_uploaded_file($verified_signature_tmp_name,"../img/".$verified_signature_name);
	$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    
	if(file_exists($target_file))
	{
		
	    $error_msg = "Sorry, image file already exists!";
	    $verified_signature_name = "default.png";
	}
	else
	{
		 if($verified_signature_size > 10000000)
		{
			echo "not ok";
		    $error_msg = "Sorry, your image file is too large. Maximum size is 10MB!";
		    $verified_signature_name = "default.png";
		}
	}
}

mysqli_query($con,"BEGIN");
mysqli_query($con,"START TRANSACTION") or die(mysqli_error($con));

	 $update_sql_statement="UPDATE partial_test_for_test_result_info SET verified_signature = '$verified_signature_name'
            WHERE trf_id='$trf_id' or (pp_number = '$pp_number' AND process_id = '$process_id' and process_name = '$process_name' AND version_number = '$version_number' AND 
            design = '$design' AND customer_id = '$customer_id' and style = '$style_name' and finish_width_in_inch = '$finish_width_in_inch')";
	
	mysqli_query($con,$update_sql_statement) or die(mysqli_error($con));

	mysqli_query($con,"COMMIT");

    //  echo "Data is successfully Updated.";
$obj->disconnection();

?>
