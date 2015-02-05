<?
header("Content-type: text/html; charset=utf-8"); 
$dir = $_SERVER["DOCUMENT_ROOT"];
include $dir."/inc/header/inc.php";
$db = new Dbcon();
$db->table="member";
$db->field="id";
$db->where="id='".$_POST['id']."'";
$i = $db->TotalCnt();
unset($db);
?>
{"value":[{"chk":"<?=$i?>","id":"<?=$_POST['id']?>"}]}
