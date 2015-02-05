<?
header("Content-type: text/html; charset=utf-8"); 
$dir = $_SERVER["DOCUMENT_ROOT"];
include $dir."/inc/header/inc.php";

if(!$_POST){
	MsgBox("잘못된 접근입니다.","/index.php");
	exit();
}
if(strpos($_SERVER['HTTP_REFERER'],"solive.kr/board/detail.php") <= 0){
	MsgBox("잘못된 접근입니다.","/index.php");
	exit();
}

$con = nl2br($_POST['content']);
$con = HtmlToText($con);
$title = HtmlToText($_POST['title']);
$name = HtmlToText($_POST['name']);


$db = new Dbcon();
$db->table = "comment";
$db->field = "tab, fkidx, name, pwd, title, content, mdate, cdate";
$db->value = "'board','".$_POST['idx']."','".$name."','".md5($_POST['pwd'])."','".$title."','".$con."',now(),now()";
$db->Insert();
unset($db);
?>
<script>
location.href = "./detail.php?idx=<?=$_POST['idx']?>&type=<?=$_POST['type']?>&page=<?=$_POST['page']?>";
</script>