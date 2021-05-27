<?php
include "../cores/inc/config.php";
$db_handle = new DBController();
$country = intval($_GET['country']);
$res="SELECT * FROM 'state_tbl' WHERE 'country_id'='".$country."'";
$faq2 = $db_handle->runQuery($res);
echo "<select>";
if (is_array($faq2) || is_object($faq2))
{
foreach($faq2 as $k=>$v) {
    $state = $faq2[$k]["state"];
    echo '<option value="'.$faq2[$k]["st_id"].'">'.$state.'</option>';
} 
}
echo "</select>";
?>

