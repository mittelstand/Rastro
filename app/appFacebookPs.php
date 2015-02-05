<?
header("Content-type: text/html; charset=utf-8"); 
$dir = $_SERVER["DOCUMENT_ROOT"];
include $dir."/inc/header/inc.php";

	$db = new Dbcon();
	$db->table = "member";
	$db->field="Ps";
	$db->where="idx='".$_POST['idx']."'";
	$sel = $db->Select();
	$row =mysql_fetch_array($sel);
	
	$db->field = "Ps='https://graph.facebook.com/".$_POST['fbcode']."/picture?type=large'";
	$db->where = "idx='".$_POST['idx']."'";
	$db->Update();

	

	




unset($db);
?>
