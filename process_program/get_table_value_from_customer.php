<?php
session_start();
require_once("../login/session.php");
include('../login/db_connection_class.php');
$obj = new DB_Connection_Class();
$obj->connection();
/*
$user_id = $_SESSION['user_id'];
$password = $_SESSION['password'];

$sql="select * from hrm_info.user_login where user_id='$user_id' and `password`='$password'";

$result=mysqli_query($con,$sql) or die(mysqli_error()());
if(mysql_num_rows($result)<1)
{

	header('Location:logout.php');

}
*/
$customer_id=$_POST['customer_id'];

$sql_for_customer_id = "SELECT * FROM `test_method_for_customer` WHERE `customer_id`='$customer_id'";
$res_for_customer_id = mysqli_query($con, $sql_for_customer_id);

$row = mysqli_fetch_assoc($res_for_customer_id);

?>

            <div class="form-group form-group-sm" id="form-group_for_test_method_name">
                          <div class="col-sm-3">
                           <!-- For spacing -->
                           </div>
                          <div class="col-sm-6">
                            <table id="datatable-buttons" class="table table-striped table-bordered">
                            <thead>
                              <tr>
                                <th>Test Names</th>
                                <th>Test Method</th>
                                <th>Selection</th>

                              </tr>
                            </thead>
                            
                            <tbody>
                              <?php                                
                                $s1 = 1;
                                $customer_id=p1;
                                var_dump($customer_id);
                                $customer_name_check= $row['customer_name'] ;
                                $sql_for_test_method_name = "SELECT * FROM `test_method_for_customer`";
                                $res_for_test_method_name = mysqli_query($con, $sql_for_test_method_name);

                                while ($row = mysqli_fetch_assoc($res_for_test_method_name)) 
                                {
                              ?>
                              <tr>
                                                             
                                <td><?php echo $row['test_name'] ?></td>
                                <td><?php echo $row['test_method_name'] ?></td>

                                <td> <input id="test_method_name" class="form-check-input" type="checkbox"  name="test_method_name[]" value="<?php echo $row['test_id'].'fs'.$row['test_name'].'fs'.$row['test_method_name'].'fs'.$row['test_method_id'];?>" 

                                  <?php     
                                    $test_method_name=$row['test_method_name'];
                                    

                                   $sql_for_duplicate = "SELECT * FROM `test_method_for_customer` WHERE `test_method_name`='$test_method_name' AND `customer_name`='$customer_name_check' "; 
                                    $res_for_duplicate = mysqli_query($con, $sql_for_duplicate);
                                    $row_for_duplicate = mysqli_num_rows($res_for_duplicate);

                                       if ($row_for_duplicate >= 1) 
                                        {
                                          echo "checked='checked'";
                                    

                                        }
                                        else{
                                         
                                        }

                                   ?>
                                   >
                                   
                                </td> 
                                  
                                 
                              </tr>
                              <?php 
                                ++$s1;
                               }

                              ?>
                              
                            </tbody>
                          </table>
                        </div> <!-- End of <div class="col-sm-6"> -->
					</div>  <!-- End of <div class="form-group form-group-sm" id="form-group_for_test_method_name"> -->