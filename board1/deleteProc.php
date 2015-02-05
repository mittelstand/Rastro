<?
header("Content-type: text/html; charset=utf-8"); 
$dir = $_SERVER["DOCUMENT_ROOT"];
include $dir."/inc/header/inc.php";

$db = new Dbcon();
$db->table = "board";
$db->keyfield = "idx";
if($_SESSION['amin']=="admin"){
	$db->where = "idx = '".$_POST['idx']."'";
}else{
	$db->where = "idx = '".$_POST['idx']."' and pwd='".md5($_POST['pwd'])."'";
}
$cnt = $db->TotalCnt();
if(($cnt <= 0) and ($_SESSION['amin']!="admin")){
	MsgBox("비밀번호가 일치하지 않습니다.","back")	;
	exit;
}
$db->Delete();
$db->table = "comment";
$db->where = "fkidx = '".$_POST['idx']."'";
$db->Delete();
MsgBox("삭제 되었습니다.","/board/index.php?page=".$_POST['page']."&type=".$_POST['type']);

unset($db);




?>