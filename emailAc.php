<?
$dir = $_SERVER["DOCUMENT_ROOT"];
include $dir."/inc/header/inc.php";
$db = new Dbcon();
$db->table = "member";
$db->keyfield = "idx";
$db->where = "email='".$_GET['mail']."' and emailCode='".$_GET['code']."'";
if($db->TotalCnt()>0){
	$db->field = "emailchk='y'";
	$db->Update();
}
?>
