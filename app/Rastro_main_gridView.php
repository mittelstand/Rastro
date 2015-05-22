<?
$dir = $_SERVER["DOCUMENT_ROOT"];
include $dir."/inc/header/inc.php";
$db = new Dbcon();
$db->block="";

$db->table = "personalList";
$db->field = "select count(idx) from presonalList where type='sc'";
$db->ExportJson();
}



unset($db);
  
?>
