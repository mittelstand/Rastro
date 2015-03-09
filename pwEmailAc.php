<?
header("Content-type: text/html; charset=utf-8"); 
$dir = $_SERVER["DOCUMENT_ROOT"];
include $dir."/inc/header/inc.php";
$exp = explode("-",$_GET['code']);


$db = new Dbcon();
$db->table = "member";
$db->field = "email = tempEmail , tempEmail = ''";
$db->where = "idx='".$exp[1]."' and emailCode='".$exp[0]."'";
$db->Update();






?>