<?
header("Content-type: text/html; charset=utf-8");
$dir = $_SERVER["DOCUMENT_ROOT"];
include $dir."/inc/header/inc.php";
$pw = md5($_POST['pw']);
$db= new Dbcon();
$db->table="board";
	$db->where="idx='".$_POST['idx']."' and pwd='".$pw."'";
	$cnt=$db->TotalCnt();
	if($cnt<=0){
	echo "비밀번호가 틀렸습니다.";
	}else{
	$db->Delete();
	echo "1";
	}

?>

<?
unset($db);
?>


