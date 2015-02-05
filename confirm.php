<?
$dir = $_SERVER["DOCUMENT_ROOT"];
include $dir."/inc/header/inc.php";
$db = new Dbcon();
$db->table = "member";
$db->field = "email";
$db->where = "email='".$_POST['email']."' and emailCode='".$_POST['code']."'";
$db->ExportJson();
?>

