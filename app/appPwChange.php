<?
$dir = $_SERVER["DOCUMENT_ROOT"];
include $dir."/inc/header/inc.php";
$pwd = md5($_POST['pwd']);
$db = new Dbcon();
$db->table = "member";
$db->field = "pwd='".$pwd."'";
$db->where = "idx='".$_POST['idx']."'";
$db->Update();
echo success;
unset($db);
  
?>
