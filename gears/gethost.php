<?php
include "../cores/inc/config.php";
$host_department_id= intval($_GET['host_department_id']);
$sql="SELECT * FROM `employee_tbl` WHERE `department_id`='".$host_department_id."' AND `e_stats`='active'";
if ($result = mysqli_query($link,$sql)) {
    echo "<select>";
    echo '<option value='.' '.'selected disabled'.'>'.'Select Host Name'.'</option>';
    while ($row = mysqli_fetch_row($result)) {
        echo '<option value='.$row[0].'>'.$row[3].'&nbsp;'.$row[4].'</option>';
    }
    echo "</select>";
}
?>