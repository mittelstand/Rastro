<?
$dir = $_SERVER["DOCUMENT_ROOT"];
include $dir."/inc/header/inc.php";
$db = new Dbcon();
$db->table = "personalList";
$db->where = "type='sc'";
$cnt=$db->TotalCnt();
echo $cnt;





unset($db);
  
?>
