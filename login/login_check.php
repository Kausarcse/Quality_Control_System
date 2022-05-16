<?php
session_start();
require_once('db_connection_class.php');
$obj = new DB_Connection_Class();
$obj->connection();

$user_name= $_POST['user_name'];
/*$password   = md5($_POST['password']);*/
$password=$_POST['password'];

// cross-site scripting----------- [start]
$user_name = htmlentities($user_name);
$password = htmlentities($password);
// cross-site scripting------------[end]


// To prevent from mysql injection [start]

$user_name = stripcslashes($user_name);
$password = stripcslashes($password);

$user_name = mysqli_real_escape_string($con, $user_name);
$password = mysqli_real_escape_string($con, $password);

// To prevent from mysql injection [end]

$sql_for_user_privilege = "SELECT * 
                             FROM `user_login` 
                            WHERE user_name = '$user_name' 
                              AND password = '$password' 
                              AND status = 'Active'";
$res_for_user_privilege = mysqli_query($con, $sql_for_user_privilege) or die(mysqli_error($con));

if(mysqli_num_rows($res_for_user_privilege) > 0)
{
    while($row_for_user_privilege = mysqli_fetch_array($res_for_user_privilege))
    {    
        /********** Session Variable defined here **********/
      
        $_SESSION['user_id']       = $row_for_user_privilege['user_id'];   
        $_SESSION['user_name']     = $row_for_user_privilege['user_name'];   
        $_SESSION['password']      = $row_for_user_privilege['password'];   
        $_SESSION['first_name']    = $row_for_user_privilege['first_name'];           
        $_SESSION['last_name']     = $row_for_user_privilege['last_name'];           
        $_SESSION['middle_name']   = $row_for_user_privilege['middle_name'];           
        $_SESSION['user_type']     = $row_for_user_privilege['user_type'];
        $_SESSION['status']        = $row_for_user_privilege['status'];
        $_SESSION['last_activity'] = time();
    }
    
    header('Location:../framework.php');
}
else
{
    echo "<h3> Login Failed. Invalid username or password.</h3>";
    
    header('Location: logout.php');
}

$obj->disconnection();
?>