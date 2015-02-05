<?
header("Content-type: text/html; charset=utf-8"); 
$dir = $_SERVER["DOCUMENT_ROOT"];
include $dir."/inc/header/inc.php";
$db = new Dbcon();
$db->table = "member";
$db->keyfield = "idx";
$db->where = "idx='".$_SESSION['id']."' and pwd='".md5($_POST['pwd'])."'";
if($db->TotalCnt()>0){
echo "y";
}
?>