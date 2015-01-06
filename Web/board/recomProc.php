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
if($_COOKIE[("recom".$_POST['type'].$_POST['idx'])]){
}else{		
	setcookie(("recom".$_POST['type'].$_POST['idx']),"1",time()+3600,"/");
	$db = new Dbcon();
	$db->table = "board";	
	$db->field = "recom";
	$db->where = "idx='".$_POST['idx']."'";	
	$row = mysql_fetch_array($db->select());
	$recom = $row['recom'] + 1;
	$db->field = "recom='".$recom."'";
	$db->Update();
	unset($db);


}
?>
<script>
alert("추천 하였습니다. ")
location.href = "./detail.php?idx=<?=$_POST['idx']?>&type=<?=$_POST['type']?>&page=<?=$_POST['page']?>";
</script>