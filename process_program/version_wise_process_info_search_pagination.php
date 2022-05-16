<?php
session_start();
require_once("../login/session.php");
include('../login/db_connection_class.php');
$obj = new DB_Connection_Class();
$obj->connection();

$search=$_POST['search'];
$search=trim($search);

    $offset=10;
    $s1=0;




//  $sql_for_color = "SELECT * FROM adding_process_to_version where version_name='$search' 
// || pp_number='$search' || style_name='$search' || color='$search' || finish_width_in_inch='$search' || process_name='$search'
// ORDER BY row_id ASC  limit $offset,10";

$sql_for_color = "SELECT * FROM adding_process_to_version where version_name LIKE '%$search%' 
|| pp_number LIKE '%$search%' || style_name LIKE '%$search%' || color LIKE '%$search%' || finish_width_in_inch LIKE '%$search%' || process_name LIKE '%$search%'
ORDER BY row_id ASC  limit $offset,10";


$res_for_color = mysqli_query($con, $sql_for_color);
?>

<input type="hidden" class="form-control" value="<?php echo $search?>" id="search" name="search" placeholder="Search">

<form class="form-inline" action="" style="margin-top:10px;" name="search_for_item" id="search_for_item">

    <div class="form-group mx-sm-3 mb-2">

        <?php
        if(isset($search))
        {
            ?>
            <input type="text" class="form-control" id="search" name="search" value="<?php echo $search?>">

            <?php

        }
        else{
            ?>
            <input type="text" class="form-control" id="search" name="search" placeholder="Search">

            <?php

        }
        ?>
    </div>
    <button type="button" class="btn btn-primary btn-xs" onClick="sending_data()">Search</button>


</form>
<table  class="table table-striped table-bordered">

    <thead>
    <tr>
        <th>SI</th>
        <th>PP Number</th>
        <th>Version Name</th>
        <th>Style Name</th>
        <th>Color</th>
        <th>Finish Width</th>
        <th>Process Name</th>
        <th>Process Serial</th>
        <th>Action</th>
    </tr>
    </thead>
    <tbody>
    <?php
    while ($row = mysqli_fetch_assoc($res_for_color))
    {
        $s1=$s1+1;
        ?>
        <tr>
            <td><?php echo $s1; ?></td>
            <td><?php echo $row['pp_number']; ?></td>
            <td><?php echo $row['version_name']; ?></td>
            <td><?php echo $row['style_name']; ?></td>
            <td><?php echo $row['color']; ?></td>
            <td><?php echo $row['finish_width_in_inch']; ?></td>
            <td><?php echo $row['process_name']; ?></td>
            <td><?php echo $row['process_serial_no']; ?></td>
            <td>
                <?php
                $value=$row['process_id']."?fs?".$row['version_id'];
                $update_value=$row['pp_number']."?fs?".$row['version_id']."?fs?".$row['version_name']."?fs?".$row['color']."?fs?".$row['finish_width_in_inch'];
                ?>

                <button type="button" id="" name="update_pp_info"  class="btn btn-info btn-xs" onclick="sending_data_for_update('<?php echo $update_value; ?>')"> Edit </button>
                <?php
                $version_id = $row['version_id'];
                $pp_number = $row['pp_number'];
                $finish_width_in_inch = $row['finish_width_in_inch'];
                $style_name = $row['style_name'];
                $color = $row['color'];
                $process_name = $row['process_name'];
                $process_id = $row['process_id'];


                if($process_id == 'proc_20')
                {
                    $sql_for_pp_wise_version ="SELECT * FROM `defining_qc_standard_for_greige_receiving_process` WHERE pp_number = '$pp_number' and version_id = '$version_id' and color = '$color' 
														and finish_width_in_inch = '$finish_width_in_inch'";
                    $result_for_pp_wise_version =  mysqli_query($con, $sql_for_pp_wise_version);

                    $row_number_for_pp_wise_version = mysqli_num_rows($result_for_pp_wise_version);

                    if($row_number_for_pp_wise_version >0)
                    {

                    }
                    else
                    {
                        ?>
                        <button type="button" id="delete_pp_info" name="delete_pp_info"  class="btn btn-danger btn-xs" onclick="sending_data_for_delete('<?php echo $value; ?>')"> Delete </button>
                        <?php
                    }
                }

                else if($process_id == 'proc_1')
                {
                    $sql_for_pp_wise_version ="SELECT * FROM `defining_qc_standard_for_singe_and_desize_process` WHERE pp_number = '$pp_number' and version_id = '$version_id' and color = '$color' 
														and finish_width_in_inch = '$finish_width_in_inch'";
                    $result_for_pp_wise_version =  mysqli_query($con, $sql_for_pp_wise_version);

                    $row_number_for_pp_wise_version = mysqli_num_rows($result_for_pp_wise_version);

                    if($row_number_for_pp_wise_version >0)
                    {

                    }
                    else
                    {
                        ?>
                        <button type="button" id="delete_pp_info" name="delete_pp_info"  class="btn btn-danger btn-xs" onclick="sending_data_for_delete('<?php echo $value; ?>')"> Delete </button>
                        <?php
                    }
                }

                else if($process_id == 'proc_2')
                {
                    $sql_for_pp_wise_version ="SELECT * FROM `defining_qc_standard_for_scouring_process` WHERE pp_number = '$pp_number' and version_id = '$version_id' and color = '$color' 
														and finish_width_in_inch = '$finish_width_in_inch'";
                    $result_for_pp_wise_version =  mysqli_query($con, $sql_for_pp_wise_version);

                    $row_number_for_pp_wise_version = mysqli_num_rows($result_for_pp_wise_version);

                    if($row_number_for_pp_wise_version >0)
                    {

                    }
                    else
                    {
                        ?>
                        <button type="button" id="delete_pp_info" name="delete_pp_info"  class="btn btn-danger btn-xs" onclick="sending_data_for_delete('<?php echo $value; ?>')"> Delete </button>
                        <?php
                    }
                }

                else if($process_id == 'proc_3')
                {
                    $sql_for_pp_wise_version ="SELECT * FROM `defining_qc_standard_for_bleaching_process` WHERE pp_number = '$pp_number' and version_id = '$version_id' and color = '$color' 
														and finish_width_in_inch = '$finish_width_in_inch'";
                    $result_for_pp_wise_version =  mysqli_query($con, $sql_for_pp_wise_version);

                    $row_number_for_pp_wise_version = mysqli_num_rows($result_for_pp_wise_version);

                    if($row_number_for_pp_wise_version >0)
                    {

                    }
                    else
                    {
                        ?>
                        <button type="button" id="delete_pp_info" name="delete_pp_info"  class="btn btn-danger btn-xs" onclick="sending_data_for_delete('<?php echo $value; ?>')"> Delete </button>
                        <?php
                    }
                }

                else if($process_id == 'proc_4')
                {
                    $sql_for_pp_wise_version ="SELECT * FROM `defining_qc_standard_for_scouring_bleaching_process` WHERE pp_number = '$pp_number' and version_id = '$version_id' and color = '$color' 
														and finish_width_in_inch = '$finish_width_in_inch'";
                    $result_for_pp_wise_version =  mysqli_query($con, $sql_for_pp_wise_version);

                    $row_number_for_pp_wise_version = mysqli_num_rows($result_for_pp_wise_version);

                    if($row_number_for_pp_wise_version >0)
                    {

                    }
                    else
                    {
                        ?>
                        <button type="button" id="delete_pp_info" name="delete_pp_info"  class="btn btn-danger btn-xs" onclick="sending_data_for_delete('<?php echo $value; ?>')"> Delete </button>
                        <?php
                    }
                }

                else if($process_id == 'proc_5')
                {
                    $sql_for_pp_wise_version ="SELECT * FROM `defining_qc_standard_for_ready_for_mercerize_process` WHERE pp_number = '$pp_number' and version_id = '$version_id' and color = '$color' 
														and finish_width_in_inch = '$finish_width_in_inch'";
                    $result_for_pp_wise_version =  mysqli_query($con, $sql_for_pp_wise_version);

                    $row_number_for_pp_wise_version = mysqli_num_rows($result_for_pp_wise_version);

                    if($row_number_for_pp_wise_version >0)
                    {

                    }
                    else
                    {
                        ?>
                        <button type="button" id="delete_pp_info" name="delete_pp_info"  class="btn btn-danger btn-xs" onclick="sending_data_for_delete('<?php echo $value; ?>')"> Delete </button>
                        <?php
                    }
                }

                else if($process_id == 'proc_6')
                {
                    $sql_for_pp_wise_version ="SELECT * FROM `defining_qc_standard_for_mercerize_process` WHERE pp_number = '$pp_number' and version_id = '$version_id' and color = '$color' 
														and finish_width_in_inch = '$finish_width_in_inch'";
                    $result_for_pp_wise_version =  mysqli_query($con, $sql_for_pp_wise_version);

                    $row_number_for_pp_wise_version = mysqli_num_rows($result_for_pp_wise_version);

                    if($row_number_for_pp_wise_version >0)
                    {

                    }
                    else
                    {
                        ?>
                        <button type="button" id="delete_pp_info" name="delete_pp_info"  class="btn btn-danger btn-xs" onclick="sending_data_for_delete('<?php echo $value; ?>')"> Delete </button>
                        <?php
                    }
                }

                else if($process_id == 'proc_7')
                {
                    $sql_for_pp_wise_version ="SELECT * FROM `defining_qc_standard_for_ready_for_printing_process` WHERE pp_number = '$pp_number' and version_id = '$version_id' and color = '$color' 
														and finish_width_in_inch = '$finish_width_in_inch'";
                    $result_for_pp_wise_version =  mysqli_query($con, $sql_for_pp_wise_version);

                    $row_number_for_pp_wise_version = mysqli_num_rows($result_for_pp_wise_version);

                    if($row_number_for_pp_wise_version >0)
                    {

                    }
                    else
                    {
                        ?>
                        <button type="button" id="delete_pp_info" name="delete_pp_info"  class="btn btn-danger btn-xs" onclick="sending_data_for_delete('<?php echo $value; ?>')"> Delete </button>
                        <?php
                    }
                }

                else if($process_id == 'proc_8')
                {
                    $sql_for_pp_wise_version ="SELECT * FROM `defining_qc_standard_for_printing_process` WHERE pp_number = '$pp_number' and version_id = '$version_id' and color = '$color' 
														and finish_width_in_inch = '$finish_width_in_inch'";
                    $result_for_pp_wise_version =  mysqli_query($con, $sql_for_pp_wise_version);

                    $row_number_for_pp_wise_version = mysqli_num_rows($result_for_pp_wise_version);

                    if($row_number_for_pp_wise_version >0)
                    {

                    }
                    else
                    {
                        ?>
                        <button type="button" id="delete_pp_info" name="delete_pp_info"  class="btn btn-danger btn-xs" onclick="sending_data_for_delete('<?php echo $value; ?>')"> Delete </button>
                        <?php
                    }
                }

                else if($process_id == 'proc_9')
                {
                    $sql_for_pp_wise_version ="SELECT * FROM `defining_qc_standard_for_curing_process` WHERE pp_number = '$pp_number' and version_id = '$version_id' and color = '$color' 
														and finish_width_in_inch = '$finish_width_in_inch'";
                    $result_for_pp_wise_version =  mysqli_query($con, $sql_for_pp_wise_version);

                    $row_number_for_pp_wise_version = mysqli_num_rows($result_for_pp_wise_version);

                    if($row_number_for_pp_wise_version >0)
                    {

                    }
                    else
                    {
                        ?>
                        <button type="button" id="delete_pp_info" name="delete_pp_info"  class="btn btn-danger btn-xs" onclick="sending_data_for_delete('<?php echo $value; ?>')"> Delete </button>
                        <?php
                    }
                }

                else if($process_id == 'proc_11')
                {
                    $sql_for_pp_wise_version ="SELECT * FROM `defining_qc_standard_for_ready_for_dying_process` WHERE pp_number = '$pp_number' and version_id = '$version_id' and color = '$color' 
														and finish_width_in_inch = '$finish_width_in_inch'";
                    $result_for_pp_wise_version =  mysqli_query($con, $sql_for_pp_wise_version);

                    $row_number_for_pp_wise_version = mysqli_num_rows($result_for_pp_wise_version);

                    if($row_number_for_pp_wise_version >0)
                    {

                    }
                    else
                    {
                        ?>
                        <button type="button" id="delete_pp_info" name="delete_pp_info"  class="btn btn-danger btn-xs" onclick="sending_data_for_delete('<?php echo $value; ?>')"> Delete </button>
                        <?php
                    }
                }

                else if($process_id == 'proc_13')
                {
                    $sql_for_pp_wise_version ="SELECT * FROM `defining_qc_standard_for_washing_process` WHERE pp_number = '$pp_number' and version_id = '$version_id' and color = '$color' 
														and finish_width_in_inch = '$finish_width_in_inch'";
                    $result_for_pp_wise_version =  mysqli_query($con, $sql_for_pp_wise_version);

                    $row_number_for_pp_wise_version = mysqli_num_rows($result_for_pp_wise_version);

                    if($row_number_for_pp_wise_version >0)
                    {

                    }
                    else
                    {
                        ?>
                        <button type="button" id="delete_pp_info" name="delete_pp_info"  class="btn btn-danger btn-xs" onclick="sending_data_for_delete('<?php echo $value; ?>')"> Delete </button>
                        <?php
                    }
                }

                else if($process_id == 'proc_14')
                {
                    $sql_for_pp_wise_version ="SELECT * FROM `defining_qc_standard_for_ready_for_raising_process` WHERE pp_number = '$pp_number' and version_id = '$version_id' and color = '$color' 
														and finish_width_in_inch = '$finish_width_in_inch'";
                    $result_for_pp_wise_version =  mysqli_query($con, $sql_for_pp_wise_version);

                    $row_number_for_pp_wise_version = mysqli_num_rows($result_for_pp_wise_version);

                    if($row_number_for_pp_wise_version >0)
                    {

                    }
                    else
                    {
                        ?>
                        <button type="button" id="delete_pp_info" name="delete_pp_info"  class="btn btn-danger btn-xs" onclick="sending_data_for_delete('<?php echo $value; ?>')"> Delete </button>
                        <?php
                    }
                }

                else if($process_id == 'proc_15')
                {
                    $sql_for_pp_wise_version ="SELECT * FROM `defining_qc_standard_for_raising_process` WHERE pp_number = '$pp_number' and version_id = '$version_id' and color = '$color' 
														and finish_width_in_inch = '$finish_width_in_inch'";
                    $result_for_pp_wise_version =  mysqli_query($con, $sql_for_pp_wise_version);

                    $row_number_for_pp_wise_version = mysqli_num_rows($result_for_pp_wise_version);

                    if($row_number_for_pp_wise_version >0)
                    {

                    }
                    else
                    {
                        ?>
                        <button type="button" id="delete_pp_info" name="delete_pp_info"  class="btn btn-danger btn-xs" onclick="sending_data_for_delete('<?php echo $value; ?>')"> Delete </button>
                        <?php
                    }
                }

                else if($process_id == 'proc_16')
                {
                    $sql_for_pp_wise_version ="SELECT * FROM `defining_qc_standard_for_finishing_process` WHERE pp_number = '$pp_number' and version_id = '$version_id' and color = '$color' 
														and finish_width_in_inch = '$finish_width_in_inch'";
                    $result_for_pp_wise_version =  mysqli_query($con, $sql_for_pp_wise_version);

                    $row_number_for_pp_wise_version = mysqli_num_rows($result_for_pp_wise_version);

                    if($row_number_for_pp_wise_version >0)
                    {

                    }
                    else
                    {
                        ?>
                        <button type="button" id="delete_pp_info" name="delete_pp_info"  class="btn btn-danger btn-xs" onclick="sending_data_for_delete('<?php echo $value; ?>')"> Delete </button>
                        <?php
                    }
                }

                else if($process_id == 'proc_17')
                {
                    $sql_for_pp_wise_version ="SELECT * FROM `defining_qc_standard_for_calendering_process` WHERE pp_number = '$pp_number' and version_id = '$version_id' and color = '$color' 
														and finish_width_in_inch = '$finish_width_in_inch'";
                    $result_for_pp_wise_version =  mysqli_query($con, $sql_for_pp_wise_version);

                    $row_number_for_pp_wise_version = mysqli_num_rows($result_for_pp_wise_version);

                    if($row_number_for_pp_wise_version >0)
                    {

                    }
                    else
                    {
                        ?>
                        <button type="button" id="delete_pp_info" name="delete_pp_info"  class="btn btn-danger btn-xs" onclick="sending_data_for_delete('<?php echo $value; ?>')"> Delete </button>
                        <?php
                    }
                }

                else if($process_id == 'proc_18')
                {
                    $sql_for_pp_wise_version ="SELECT * FROM `defining_qc_standard_for_sanforizing_process` WHERE pp_number = '$pp_number' and version_id = '$version_id' and color = '$color' 
														and finish_width_in_inch = '$finish_width_in_inch'";
                    $result_for_pp_wise_version =  mysqli_query($con, $sql_for_pp_wise_version);

                    $row_number_for_pp_wise_version = mysqli_num_rows($result_for_pp_wise_version);

                    if($row_number_for_pp_wise_version >0)
                    {

                    }
                    else
                    {
                        ?>
                        <button type="button" id="delete_pp_info" name="delete_pp_info"  class="btn btn-danger btn-xs" onclick="sending_data_for_delete('<?php echo $value; ?>')"> Delete </button>
                        <?php
                    }
                }

                ?>



            </td>
        </tr>
        <?php
    }

    ?>

    <nav aria-label="Page navigation example">
        <ul class="pagination">

            <?php

            $cout="SELECT COUNT(row_id) as count FROM `adding_process_to_version` WHERE 1";
            $count_f=mysqli_query($con,$cout);
            while ($count_row=mysqli_fetch_assoc($count_f)){
                $count=$count_row['count'];
            }
            $l=1;
            $k=$offset;


            ?>
            <li class="page-item" id="<?php echo ($k-10)?>" value="<?php echo ($l-1)?>" class="page-item" onclick="pagination(this.id)" >
                <a class="page-link" href="#" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                </a>
            </li>
            <?php


            for ($i=0;$i<=100;$i=$i+10) {
                ?>
                <li id="<?php echo $k?>" value="<?php echo $l?>" class="page-item" onclick="pagination(this.id)"><a  class="page-link" href="#"
                    ><?php echo $l?></a></li>

                <?php
                $l++;
                $k=$k+10;
            }

            ?>

            <li class="page-item" id="<?php echo ($k)?>" value="<?php echo ($l)?>" class="page-item" onclick="pagination(this.id)" >
                <a class="page-link" href="#" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                </a>
            </li>
        </ul>
    </nav>

    </tbody>
</table>