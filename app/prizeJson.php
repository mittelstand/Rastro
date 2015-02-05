<?
$dir = $_SERVER["DOCUMENT_ROOT"];
include $dir."/inc/header/inc.php";
$db = new Dbcon();
$db->block="";

$db->table = "prize";

$db->where = "fidx='".$_POST['pidx']."'";
$db->ExportJson();

unset($db);
  
?>
