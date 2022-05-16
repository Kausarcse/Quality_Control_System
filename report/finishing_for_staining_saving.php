<?php
session_start();
require_once("../login/session.php");
include('../login/db_connection_class.php');
$obj = new DB_Connection_Class();
$obj->connection();



$data_previously_saved = "No";
$data_insertion_hampering = "No";
/*$user_name ="Iftekhar";
$user_id ="Iftekhar";
$password ="1234";*/

$user_id = $_SESSION['user_id'];
$password = $_SESSION['password'];
$user_name = $_SESSION['user_name'];
/*
$sql = "select * from hrm_info.user_login where user_id='$user_id' and `password`='$password'";
$result = mysqli_query($con,$sql) or die(mysqli_error($con));

if( mysqli_num_rows($result) < 1 )
{

	header('Location:logout.php');

}
else
{
	while($row=mysql_fetch_array($result))
	{	
		 $user_name=$row['user_name'];	
	}
}

*/



$value=$_POST['value_for_staining'];

$splitted_value=explode("?fs?", $value);
$pp_number=$splitted_value[0];

$version_number=$splitted_value[1];
$customer_name=$splitted_value[2];
$style=$splitted_value[3];
$finish_width_in_inch=$splitted_value[4];
$before_trolley_number_or_batcher_number=$splitted_value[5];
$after_trolley_number_or_batcher_number=$splitted_value[6];


         /////// cf to washing //////////////
$acetate_cf_washing= $_POST['acetate_cf_washing'];
$cotton_cf_washing= $_POST['cotton_cf_washing'];
$mylon_cf_washing= $_POST['mylon_cf_washing'];
$polyester_cf_washing= $_POST['polyester_cf_washing'];
$acrylic_cf_washing= $_POST['acrylic_cf_washing'];
$wool_cf_washing= $_POST['wool_cf_washing'];

////////////////// cf to dry cleaning /////////////////////
$acetate_cf_to_dry_cleaning= $_POST['acetate_cf_to_dry_cleaning'];
$cotton_cf_to_dry_cleaning= $_POST['cotton_cf_to_dry_cleaning'];
$mylon_cf_to_dry_cleaning= $_POST['mylon_cf_to_dry_cleaning'];
$polyester_cf_to_dry_cleaning= $_POST['polyester_cf_to_dry_cleaning'];
$acrylic_cf_to_dry_cleaning= $_POST['acrylic_cf_to_dry_cleaning'];
$wool_cf_to_dry_cleaning= $_POST['wool_cf_to_dry_cleaning'];

////////////////// cf to perspiration acid //////////////////

$acetate_cf_to_perspiration_acid= $_POST['acetate_cf_to_perspiration_acid'];
$cotton_cf_to_perspiration_acid= $_POST['cotton_cf_to_perspiration_acid'];
$mylon_cf_to_perspiration_acid= $_POST['mylon_cf_to_perspiration_acid'];
$polyester_cf_to_perspiration_acid= $_POST['polyester_cf_to_perspiration_acid'];
$acrylic_cf_to_perspiration_acid= $_POST['acrylic_cf_to_perspiration_acid'];
$wool_cf_to_perspiration_acid= $_POST['wool_cf_to_perspiration_acid'];

////////////////// cf to perspiration alkali //////////////////

$acetate_cf_to_perspiration_alkali= $_POST['acetate_cf_to_perspiration_alkali'];
$cotton_cf_to_perspiration_alkali= $_POST['cotton_cf_to_perspiration_alkali'];
$mylon_cf_to_perspiration_alkali= $_POST['mylon_cf_to_perspiration_alkali'];
$polyester_cf_to_perspiration_alkali= $_POST['polyester_cf_to_perspiration_alkali'];
$acrylic_cf_to_perspiration_alkali= $_POST['acrylic_cf_to_perspiration_alkali'];
$wool_cf_to_perspiration_alkali= $_POST['wool_cf_to_perspiration_alkali'];

////////////////// cf to perspiration water //////////////////

$acetate_cf_to_water= $_POST['acetate_cf_to_water'];
$cotton_cf_to_water= $_POST['cotton_cf_to_water'];
$mylon_cf_to_water= $_POST['mylon_cf_to_water'];
$polyester_cf_to_water= $_POST['polyester_cf_to_water'];
$acrylic_cf_to_water= $_POST['acrylic_cf_to_water'];
$wool_cf_to_water= $_POST['wool_cf_to_water'];

////////////////// cf to perspiration saliva //////////////////

$acetate_cf_to_saliva= $_POST['acetate_cf_to_saliva'];
$cotton_cf_to_saliva= $_POST['cotton_cf_to_saliva'];
$mylon_cf_to_saliva= $_POST['mylon_cf_to_saliva'];
$polyester_cf_to_saliva= $_POST['polyester_cf_to_saliva'];
$acrylic_cf_to_saliva= $_POST['acrylic_cf_to_saliva'];
$wool_cf_to_saliva= $_POST['wool_cf_to_saliva'];

////////////////// cf to perspiration light //////////////////

$acetate_cf_to_artificial_day_light= $_POST['acetate_cf_to_artificial_day_light'];
$cotton_cf_to_artificial_day_light= $_POST['cotton_cf_to_artificial_day_light'];
$mylon_cf_to_artificial_day_light= $_POST['mylon_cf_to_artificial_day_light'];
$polyester_cf_to_artificial_day_light= $_POST['polyester_cf_to_artificial_day_light'];
$acrylic_cf_to_artificial_day_light= $_POST['acrylic_cf_to_artificial_day_light'];
$wool_cf_to_artificial_day_light= $_POST['wool_cf_to_artificial_day_light'];


mysqli_query($con,"BEGIN");
mysqli_query($con,"START TRANSACTION") or die(mysqli_error($con));

	// $update_sql_statement="UPDATE `qc_result_for_finishing_process` SET `cf_to_washing_staining_value_for_acetate` = '$acetate_cf_washing' 
     // where customer_name='$customer_name' and pp_number='$pp_number' and version_number = '$version_number' and finish_width_in_inch='$finish_width_in_inch'";

	$update_sql_statement="UPDATE `qc_result_for_finishing_process` SET
         `cf_to_washing_staining_value_for_acetate`='$acetate_cf_washing',
         `cf_to_washing_staining_value_for_cotton`='$cotton_cf_washing',
         `cf_to_washing_staining_value_for_mylon`='$mylon_cf_washing',
         `cf_to_washing_staining_value_for_polyester`='$polyester_cf_washing',
         `cf_to_washing_staining_value_for_acrylic`='$acrylic_cf_washing',
         `cf_to_washing_staining_value_for_wool`='$wool_cf_washing',

         `cf_to_dry_cleaning_staining_value_for_acetate`='$acetate_cf_to_dry_cleaning',
         `cf_to_dry_cleaning_staining_value_for_cotton`='$cotton_cf_to_dry_cleaning',
         `cf_to_dry_cleaning_staining_value_for_mylon`='$mylon_cf_to_dry_cleaning',
         `cf_to_dry_cleaning_staining_value_for_polyester`='$polyester_cf_to_dry_cleaning',
         `cf_to_dry_cleaning_staining_value_for_acrylic`='$acrylic_cf_to_dry_cleaning',
         `cf_to_dry_cleaning_staining_value_for_wool`='$wool_cf_to_dry_cleaning', 

         `cf_to_perspiration_acid_staining_value_for_acetate`='$acetate_cf_to_perspiration_acid',
         `cf_to_perspiration_acid_staining_value_for_cotton`='$cotton_cf_to_perspiration_acid',
         `cf_to_perspiration_acid_staining_value_for_mylon`='$mylon_cf_to_perspiration_acid',
         `cf_to_perspiration_acid_staining_value_for_polyester`='$polyester_cf_to_perspiration_acid',
         `cf_to_perspiration_acid_staining_value_for_acrylic`='$acrylic_cf_to_perspiration_acid',
         `cf_to_perspiration_acid_staining_value_for_wool`='$wool_cf_to_perspiration_acid', 

         `cf_to_perspiration_alkali_staining_value_for_acetate`='$acetate_cf_to_perspiration_alkali',
         `cf_to_perspiration_alkali_staining_value_for_cotton`='$cotton_cf_to_perspiration_alkali',
         `cf_to_perspiration_alkali_staining_value_for_mylon`='$mylon_cf_to_perspiration_alkali',
         `cf_to_perspiration_alkali_staining_value_for_polyester`='$polyester_cf_to_perspiration_alkali',
         `cf_to_perspiration_alkali_staining_value_for_acrylic`='$acrylic_cf_to_perspiration_alkali',
         `cf_to_perspiration_alkali_staining_value_for_wool`='$wool_cf_to_perspiration_alkali', 

         `cf_to_water_staining_value_for_acetate`='$acetate_cf_to_water',
         `cf_to_water_staining_value_for_cotton`='$cotton_cf_to_water',
         `cf_to_water_staining_value_for_mylon`='$mylon_cf_to_water',
         `cf_to_water_staining_value_for_polyester`='$polyester_cf_to_water',
         `cf_to_water_staining_value_for_acrylic`='$acrylic_cf_to_water',
         `cf_to_water_staining_value_for_wool`='$wool_cf_to_water',

         `cf_to_saliva_staining_value_for_acetate`='$acetate_cf_to_saliva',
         `cf_to_saliva_staining_value_for_cotton`='$cotton_cf_to_saliva',
         `cf_to_saliva_staining_value_for_mylon`='$mylon_cf_to_saliva',
         `cf_to_saliva_staining_value_for_polyester`='$polyester_cf_to_saliva',
         `cf_to_saliva_staining_value_for_acrylic`='$acrylic_cf_to_saliva',
         `cf_to_saliva_staining_value_for_wool`='$wool_cf_to_saliva',
         
        `cf_to_artificial_day_light_value_for_acetate`='$acetate_cf_to_artificial_day_light',
        `cf_to_artificial_day_light_value_for_cotton`='$cotton_cf_to_artificial_day_light',
         cf_to_artificial_day_light_value_for_mylon='$mylon_cf_to_artificial_day_light',
        `cf_to_artificial_day_light_value_for_polyester`='$polyester_cf_to_artificial_day_light',
        `cf_to_artificial_day_light_value_for_acrylic`='$acrylic_cf_to_artificial_day_light',
        `cf_to_artificial_day_light_value_for_wool`='$wool_cf_to_artificial_day_light'

        where customer_name='$customer_name' and pp_number='$pp_number' and version_number = '$version_number' and finish_width_in_inch='$finish_width_in_inch'";

	mysqli_query($con,$update_sql_statement) or die(mysqli_error($con));

	if(mysqli_affected_rows($con)<>1)
	{
	
		$data_insertion_hampering = "Yes";
	
	}


if($data_previously_saved == "Yes")
{

	mysqli_query($con,"ROLLBACK");
	echo "Data is previously saved.";

}
else if($data_insertion_hampering == "No" )
{

	mysqli_query($con,"COMMIT");
	echo "Data is successfully saved.";

}
else
{

	mysqli_query($con,"ROLLBACK");
	echo "Data is not successfully saved.";

}

$obj->disconnection();

?>
