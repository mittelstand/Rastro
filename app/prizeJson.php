<?
$dir = $_SERVER["DOCUMENT_ROOT"];
include $dir."/inc/header/inc.php";
$db = new Dbcon();
$db->block="";

$db->table = "prize";
if($_POST['div']=="pd"){
$db->where = "fidx='".$_POST['pidx']."' and idx='".$_POST['idx']."'";	
}else{
$db->where = "fidx='".$_POST['pidx']."'";	
}


$db->ExportJson();

unset($db);
  
?>
