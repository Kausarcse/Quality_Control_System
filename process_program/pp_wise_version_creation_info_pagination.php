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
    <input type="text" class="form-control" value="<?php echo $search?>" id="search" name="search"
           placeholder="Search">

    <?php

//  echo   $sql_for_color = "SELECT * FROM adding_process_to_version where version_name=TRIM('$search') 
// || pp_number=TRIM('$search') || style_name=TRIM('$search') || color=TRIM('$search')|| 
// finish_width_in_inch=TRIM('$search') || process_name=TRIM('$search')
// ORDER BY row_id ASC  limit $offset,10";


// echo $sql_for_color = "
// SELECT * FROM pp_wise_version_creation_info 
// pwvci LEFT JOIN process_program_info ppi 
// ON ppi.pp_number = pwvci.pp_number 
// where pp_creation_date LIKE '%$search%'
//  || ppi.pp_number LIKE '%$search%'
//   || pwvci.version_name LIKE
//   '%$search%' || pwvci.style_name LIKE '%$search%' 
//    || pwvci.color LIKE '%$search%' ||
//     pwvci.construction_name LIKE '%$search%' || 
//     pwvci.greige_width_in_inch LIKE '%$search%' || 
//     pwvci.finish_width_in_inch LIKE '%$search%' || 
//     pwvci.process_technique_name LIKE '%$search%' ||
//      pwvci.pp_quantity LIKE '%$search%'
// ORDER BY pwvci.row_id ASC limit $offset,10";


 $sql_for_color = "
SELECT *
FROM pp_wise_version_creation_info 
pwvci LEFT JOIN process_program_info ppi 
ON ppi.pp_number = pwvci.pp_number 
where  ppi.pp_creation_date LIKE '%$search%'
 || pwvci.pp_number LIKE '%$search%'
  || pwvci.version_name LIKE
  '%$search%' || pwvci.style_name LIKE '%$search%' 
   || pwvci.color LIKE '%$search%' ||
    pwvci.construction_name LIKE '%$search%' || 
    pwvci.greige_width_in_inch LIKE '%$search%' || 
    pwvci.finish_width_in_inch LIKE '%$search%' || 
    pwvci.process_technique_name LIKE '%$search%' ||
     pwvci.pp_quantity LIKE '%$search%' 
ORDER BY pwvci.row_id ASC limit $offset,10";



} 
else
{
    $sql_for_color = " SELECT * FROM pp_wise_version_creation_info pwvci
    LEFT JOIN process_program_info ppi ON ppi.pp_number = pwvci.pp_number
    ORDER BY pwvci.row_id ASC limit $offset,10";
}



$res_for_color = mysqli_query($con, $sql_for_color);

?>

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

<th>Sl.</th> 
    <th>PP Creation Date</th>
    <th>PP Number</th>
    <th>Version </th>
    <th>Style </th>
    <th>Color</th>
    <th>Construction Name</th>
    <th>Greige Width</th>
    <th>Finish Width</th>
    <th>Process Technique</th>
    <th>Fiber Content</th>
    <th>PP Quantity</th>
    <th>Action</th>
</tr>
</thead>
<tbody>
<?php
while ($row = mysqli_fetch_assoc($res_for_color))
{
    $s1=$s1+1;
    $date=date_create($row['pp_creation_date']);
    $trf_creation_date = date_format($date,"d/m/Y");
    ?>
    <tr>
    <td width="10"><?php echo $s1; ?></td> 
                <td width="50"><?php echo $trf_creation_date; ?></td>
                <td width="50"><?php echo $row['pp_number']; ?></td>
                <td width="50"><?php echo $row['version_name']; ?></td>
                <td><?php echo $row['style_name']; ?></td>
                <td><?php echo $row['color']; ?></td>
                <td><?php echo $row['construction_name']; ?></td>
                <td><?php echo $row['greige_width_in_inch']; ?></td>
                <td><?php echo $row['finish_width_in_inch']; ?></td>
                <td><?php echo $row['process_technique_name']; ?></td>
                <td>
                <?php
                    if($row['percentage_of_cotton_content']!= ' ' && $row['percentage_of_cotton_content'] != 0)
                    {
                        echo 'Cotton: '.$row['percentage_of_cotton_content'].'% ';
                    }
                    if($row['percentage_of_polyester_content']!= ' ' && $row['percentage_of_polyester_content'] != 0)
                    {
                        echo 'Polyester: '.$row['percentage_of_polyester_content'].'% ';
                    }
                    if($row['percentage_of_other_fiber_content']!= ' ' && $row['percentage_of_other_fiber_content'] != 0)
                    {
                        echo $row['other_fiber_in_yarn'].': '.$row['percentage_of_other_fiber_content'].'% ';
                    }
                    ?>                </td>
                <td><?php echo $row['pp_quantity']; ?></td>
                <td>
                      
                        
                      
                      <?php
                             $pp_number = $row['pp_number'];
                             $version_id = $row['version_id'];
                             $sql_for_add_process_to_version ="SELECT * FROM adding_process_to_version WHERE pp_number = '$pp_number' AND version_id = '$version_id'";
                             $result_for_add_process_to_version =  mysqli_query($con, $sql_for_add_process_to_version);

                             $row_number_for_add_process_to_version = mysqli_num_rows($result_for_add_process_to_version);

                             if($row_number_for_add_process_to_version >0)
                             {
                                 ?>
                                     <!-- <button type="button" id="add_process_info" name="add_process_info"  class="btn btn-success btn-xs" onclick="load_page('process_program/version_wise_process_info_creation_from_pp.php?all_data=<?php echo $row['pp_number'].'?fs?'.$row['version_id'] ?>')"> Add Process  </button> -->
                                 <?php
                             }
                             else
                             {
                                 ?>
                                 <button type="button" id="edit_pp_info" name="edit_pp_info"  class="btn btn-primary btn-xs" onclick="load_page('process_program/edit_pp_wise_version_creation_info.php?version_id=<?php echo $row['version_id'] ?>')"> Edit </button>
                                     <span>  </span>
                         
                                 <button type="button" id="add_process_info" name="add_process_info"  class="btn btn-success btn-xs" onclick="load_page('process_program/version_wise_process_info_creation_from_pp.php?all_data=<?php echo $row['pp_number'].'?fs?'.$row['version_id'] ?>')"> Add Process  </button>
                             
                                 <button type="button" id="delete_pp_info" name="delete_pp_info"  class="btn btn-danger btn-xs" onclick="sending_data_for_delete('<?php echo $row['version_id'] ?>')"> Delete </button>
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

        $cout="SELECT COUNT(row_id) as count FROM `pp_wise_version_creation_info` WHERE 1";
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