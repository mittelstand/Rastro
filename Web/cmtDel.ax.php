<?
header("Content-type: text/html; charset=utf-8"); 
$dir = $_SERVER["DOCUMENT_ROOT"];
include $dir."/inc/header/inc.php";
if((strlen($_POST['idx'])<=0) or (strlen($_POST['fidx'])<=0) or (strlen($_POST['tab'])<=0)){
	exit;
}
$db = new Dbcon();
$db->table = "comment";
$db->field = "writer";
$db->where = "idx = '".$_POST['idx']."'";
$sel = $db->Select();
$row = mysql_fetch_array($sel);
if($_SESSION['admin']){
	$db->Delete();
	echo "true";
}else if($_SESSION['id']==$row['writer']){
	$db->Delete();
	echo "true";
}
unset($db);




?>