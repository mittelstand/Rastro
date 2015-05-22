<?
$dir = $_SERVER["DOCUMENT_ROOT"];
include $dir."/inc/header/inc.php";
$db = new Dbcon();


$db->table = "personalList";
$db->field = "(select Count(idx) from presonalList) as a";
$db->where = "type='sc'";
$sel = $db->Select();
$row =mysql_fetch_array($sel);
echo $row['a'];
}



unset($db);
  
?>
