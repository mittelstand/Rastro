<?
$dir = $_SERVER["DOCUMENT_ROOT"];
include $dir."/inc/header/inc.php";
$db = new Dbcon();
$db->block="";

$db->table = "prize";
if($_POST['div']=="pd"){
$db->where = "fidx='".$_POST['fidx']."' and idx='".$_POST['idx']."'";	
$db->ExportJson();
}else{
$db->where = "fidx='".$_POST['fidx']."'";
$db->ExportJson();
}



unset($db);
  
?>
