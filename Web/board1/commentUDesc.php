<?
header("Content-type: text/html; charset=utf-8"); 
$dir = $_SERVER["DOCUMENT_ROOT"];
include $dir."/inc/header/inc.php";

if(!$_POST){
	MsgBox("잘못된 접근입니다.","/index.php");
}
if(strpos($_SERVER['HTTP_REFERER'],"socialrainbow.kr/board/detail.php") <= 0){
	MsgBox("잘못된 접근입니다.","/index.php");
}

$con = nl2br($_POST['content']);
$con = HtmlToText($con);


$db = new Dbcon();
$db->table = "comment";
$db->field = "content = '".$con."', mdate=now()";
$db->where = "idx='".$_POST['idx']."'";
$db->Update();
unset($db);
?>
<script>
location.href = "./detail.php?idx=<?=$_POST['fkidx']?>";
</script>