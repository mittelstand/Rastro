<?
header("Content-type: text/html; charset=utf-8"); 
$dir = $_SERVER["DOCUMENT_ROOT"];
include $dir."/inc/header/inc.php";
include $dir."/option.php";
$db= new Dbcon();
$db->table="apply";
$db->field="cs='n'";
$db->where="fidx='".$_POST['fidx']."' and writer='".$_POST['id']."'";
$db->Update();
unset($db);
?>