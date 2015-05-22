<?
$dir = $_SERVER["DOCUMENT_ROOT"];
include $dir."/inc/header/inc.php";
$db = new Dbcon();
$db->block="";

$db->table = "personalList";
$db->where = "type='".$_POST['type']."' and midx='".$_POST['midx']."'";	
$db->ExportJson();




unset($db);
  
?>
