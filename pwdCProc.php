<?
header("Content-type: text/html; charset=utf-8"); 
$dir = $_SERVER["DOCUMENT_ROOT"];
include $dir."/inc/header/inc.php";
$db = new Dbcon();
$db->table = "member";
$db->keyfield = "idx";
$db->where = "idx = '".$_SESSION['idx']."' and ((pwd = '".md5($_POST['nowPwd'])."') or (pwdTemp='".$_POST['nowPwd']."'))";

if(($db->TotalCnt() > 0)){
	$db->field = "pwd='".md5($_POST['pwd'])."'";
	$db->Update();
}else{
	
	$db->field = "fbcode";
	$db->where = "idx = '".$_SESSION['idx']."'";
	$row = mysql_fetch_array($db->Select());
	if($row['fbcode'] > 0){
		$db->field = "pwd='".md5($_POST['pwd'])."'";
		$db->Update();
	}else{
		MsgBox("현재 비밀번호가 틀립니다.","back");
		unset($db);
		exit();
	}
}
unset($db);
?>

<script>
	location.href="info";
</script>