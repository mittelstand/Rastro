<?
$dir = $_SERVER["DOCUMENT_ROOT"];
include $dir."/inc/header/inc.php";
$db = new Dbcon();
$db->block="";


$db->table = "test";
if($_POST['type']=="whole"){
	$db->ExportJson();
}else{
$db->where = "type='".$_POST['type']."'";
$db->ExportJson();
}
unset($db);
  
?>
