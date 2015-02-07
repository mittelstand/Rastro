<?
$dir = $_SERVER["DOCUMENT_ROOT"];
include $dir."/inc/header/inc.php";
$pwd = md5($_POST['pwd']);
$nopwd = md5($_POST['nowpwd']);

$db = new Dbcon();
$db->table = "member";
if($_POST['type']=="not"){
	$db->field = "pwd='".$pwd."'";
	$db->where = "idx='".$_POST['idx']."'";
	$db->Update();
	echo success;	
}else{
	$db->field ="pwd";
	$db->where = "idx='".$_POST['idx']."'";
	$sel = $db->Select();
	$row =mysql_fetch_array($sel);
	if($row!=$nopwd){
		echo fail;
	}else{
	$db->field = "pwd='".$pwd."'";
	$db->where = "idx='".$_POST['idx']."'";
	$db->Update();	
	echo success;
	}
}


unset($db);
  
?>
