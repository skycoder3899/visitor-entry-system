
<?php
include "../cores/inc/config.php";
$db_handle = new DBController();
$q = intval($_GET['q']);

$sql="SELECT * FROM `country_tbl` WHERE `ct_id` = '".$q."'";
$faq2 = $db_handle->runQuery($sql);


if (is_array($faq2) || is_object($faq2))
            {
		  foreach($faq2 as $k=>$v) {
  echo "<tr>";
  echo "<td>" . $faq2[$k]["ct_code"] . "</td>";

  echo "</tr>";
}
}
echo "</table>";
?>
