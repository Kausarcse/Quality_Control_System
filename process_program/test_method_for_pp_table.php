 
<?php

include('../login/db_connection_class.php');
$obj = new DB_Connection_Class();
$obj->connection();
$customer_id=$_POST['customer_id'];


  




$table="<table id='datatable-buttons' class='table table-striped table-bordered'>
                            <thead>
                              <tr>
                                <th>Test Names</th>
                                <th>Test Method</th>
                                <th>Selection</th>

                              </tr>
                            </thead>
                            
                            <tbody>";
                                                            
                                $s1 = 1;
                                $sql_for_test_method_name = "SELECT * FROM `test_method_for_customer` WHERE `customer_id`='$customer_id'";
                                $res_for_test_method_name = mysqli_query($con, $sql_for_test_method_name);

                               while($row = mysqli_fetch_assoc($res_for_test_method_name))
                               {
                                $table.=   "<tr>
                                                             
                                <td>".$row['test_name']."</td>
                                <td>".$row['test_method_name']."</td>";
                              $abcd=$row['test_id'].'fs'.$row['test_name'].'fs'.$row['test_method_name'].'fs'.$row['test_method_id'];
                              
                              $table.= " <td> <input id='test_method_name' class='form-check-input' type='checkbox'  name='test_method_name[]' value='".$abcd."'></td>";
 
                              
                                    $test_method_name=$row['test_method_name'];
                                    

                                   $sql_for_duplicate = "SELECT * FROM `test_method_for_customer` WHERE `test_method_name`='$test_method_name' AND `customer_id`='$customer_id' "; 
                                    $res_for_duplicate = mysqli_query($con, $sql_for_duplicate);
                                    $row_for_duplicate = mysqli_num_rows($res_for_duplicate);

                                       if ($row_for_duplicate >= 1) 
                                        {
                                          
                                
                                        }
                                        else $table.="<td></td>";

                                   
                               $table.=" </tr>";
                                                           
                                ++$s1;
                               }

                          
                              
                          $table.=" </tbody>
                          </table>";



                          echo $table;


  ?>