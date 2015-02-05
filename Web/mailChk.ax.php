<?
$dir = $_SERVER["DOCUMENT_ROOT"];
include $dir."/inc/header/inc.php";
$db = new Dbcon();
$db->table = "member";
$db->keyfield = "idx";
$db->where = "email='".$_POST['email']."'";
if($db->TotalCnt() > 0){
	echo "{\"loginChk\":\"true\"}";
}else{
	echo "{\"loginChk\":\"false\"}";
}
unset($db);

?>

