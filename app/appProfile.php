<?
$dir = $_SERVER["DOCUMENT_ROOT"];
include $dir."/inc/header/inc.php";
$db = new Dbcon();
$db->table = "member";
$db->where = "idx='".$_POST['idx']."'";
$db->ExportJson();

unset($db);
  
?>
