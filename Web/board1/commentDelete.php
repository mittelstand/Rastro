<?

header("Content-type: text/html; charset=utf-8"); 
$dir = $_SERVER["DOCUMENT_ROOT"];
include $dir."/inc/header/inc.php";

if(!$_POST){
	MsgBox("잘못된 접근입니다.","/index.php");
	exit;
}
if(strpos($_SERVER['HTTP_REFERER'],"solive.kr/board/detail.php") <= 0){
	MsgBox("잘못된 접근입니다.","/index.php");
	exit;
}

$db = new Dbcon();
$db->table = "comment";
$db->keyfield = "idx";
if($_SESSION['amin']=="admin"){
	$db->where = "idx='".$_POST['idx']."'";
}else{
	$db->where = "idx='".$_POST['idx']."' and pwd='".md5($_POST['pwd'])."'";
}
$cnt = $db->TotalCnt();
if($cnt > 0){
	$db->Delete();
	unset($db);
	MsgBox("삭제 되었습니다.","back");
}else{
	unset($db);
	MsgBox("비밀번호가 일치하지 않습니다.","back");
}




?>