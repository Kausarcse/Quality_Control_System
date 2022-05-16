<?php
session_start();
require_once("../login/session.php");
include('../login/db_connection_class.php');
$obj = new DB_Connection_Class();
$obj->connection();

 $offset=$_GET['offset'];

$s1=$offset;
if(isset($_GET['search'])) {
    $search = trim($_GET['search']);

  
    
    ?>
    <input type="hidden" class="form-control" value="<?php echo $search?>" id="search" name="search"
           placeholder="Search">

    <?php

//  echo   $sql_for_color = "SELECT * FROM adding_process_to_version where version_name=TRIM('$search') 
// || pp_number=TRIM('$search') || style_name=TRIM('$search') || color=TRIM('$search')|| 
// finish_width_in_inch=TRIM('$search') || process_name=TRIM('$search')
// ORDER BY row_id ASC  limit $offset,10";


$sql_for_color = "SELECT * FROM process_program_info where pp_creation_date  LIKE '%$search%' || pp_number LIKE '%$search%' || pp_description LIKE '%$search%' ||
customer_name LIKE '%$search%' || greige_demand_no LIKE '%$search%' ||
week_in_year LIKE '%$search' || design LIKE '%$search%'
ORDER BY row_id ASC  limit $offset,10";

} 
else
{
    $sql_for_color = "SELECT * FROM process_program_info ORDER BY row_id ASC limit $offset,10";

}



$res_for_color = mysqli_query($con, $sql_for_color);

?>

<form class="form-inline" action="" style="margin-top:10px;" name="search_for_item" id="search_for_item">

    <div class="form-group mx-sm-3 mb-2">
        <?php
        if(isset($_GET['search'])) {
            ?>
            <input type="text" class="form-control" id="search" name="search" value="<?php echo $search;?>">

            <?php
            }
        else
        {
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
<th>Sl</th>
				 <th>PP Creation Date</th>
                 <th>PP Number</th>
                 <th>PP Description</th>
                 <th>Customer Name</th>
                 <th>Greige Demand</th>
                 <th>Week in Year</th>
                 <th>Design</th>
                 <th>Total Quantity</th>
                 <th>Action</th>
</tr>
</thead>
<tbody>
<?php
while ($row = mysqli_fetch_assoc($res_for_color))
{
    $date=date_create($row['pp_creation_date']);
    $trf_creation_date = date_format($date,"d/m/Y");
    $s1=$s1+1;
    ?>
    <tr>
                <td><?php echo $s1; ?></td>
				<td><?php echo $trf_creation_date; ?></td>
                <td><?php echo $row['pp_number']; ?></td>
                <td><?php echo $row['pp_description']; ?></td>
                <td><?php echo $row['customer_name']; ?></td>
                <td><?php echo $row['greige_demand_no']; ?></td>
                <td><?php echo $row['week_in_year']; ?></td>
                <td><?php echo $row['design']; ?></td>

                <td>
                        
                    <?php 
                        $pp_number = $row['pp_number'];
                        $sql_for_color2 = "SELECT SUM(pp_quantity) total_quantity FROM pp_wise_version_creation_info WHERE pp_number = '$pp_number'";

                        $res_for_color2 = mysqli_query($con, $sql_for_color2);

                        $row2 = mysqli_fetch_assoc($res_for_color2);

                        echo $total_quantity = $row2['total_quantity'];
                    ?>

                </td>
        <td>
              
                        
        <button type="button" id="delete_pp_info" name="delete_pp_info"  class="btn btn-primary btn-xs" onclick="load_page('process_program/edit_process_program_info.php?pp_id=<?php echo $row['row_id'] ?>')"> Edit </button>
                     <span>  </span>


                      <button type="button" id="view_pp_info" name="view_pp_info"  class="btn btn-info btn-xs" onclick="load_page('process_program/process_program_info_preview.php?pp_num_id=<?php echo $row['pp_num_id'] ?>')"> View </button>
                     <span>  </span>
                     <?php
                             $pp_number = $row['pp_number'];
                             $sql_for_pp_wise_version ="SELECT * FROM `pp_wise_version_creation_info` WHERE pp_number = '$pp_number'";
                             $result_for_pp_wise_version =  mysqli_query($con, $sql_for_pp_wise_version);

                             $row_number_for_pp_wise_version = mysqli_num_rows($result_for_pp_wise_version);

                             if($row_number_for_pp_wise_version >0)
                             {
                                  
                             }
                             else
                             {
                                 ?>
                                      <button type="button" id="delete_pp_info" name="delete_pp_info"  class="btn btn-danger btn-xs" onclick="sending_data_for_delete('<?php echo $row['row_id'] ?>')"> Delete </button>
                                  <?php
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

        $cout="SELECT COUNT(row_id) as count FROM `process_program_info` WHERE 1";
        $count_f=mysqli_query($con,$cout);
        while ($count_row=mysqli_fetch_assoc($count_f)){
            $count=$count_row['count'];
        }
        $l=$_GET['pagi'];
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