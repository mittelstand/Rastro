<?
header("Content-type: text/html; charset=utf-8"); 
$dir = $_SERVER["DOCUMENT_ROOT"];
include $dir."/inc/header/inc.php";

$name		= HtmlToText($_POST['name']); 
$pwd		= md5($_POST['pwd']);
$title		= HtmlToText($_POST['title']);
$content	= nl2br($_POST['content']);
$content	= HtmlToText($_POST['content']);



$db = new Dbcon();
$db->table = "board";

if($_POST['idx'] <= 0){
	$db->field = "header,type,title,content,name,pwd,count,pcMode,mdate,cdate";
	$db->value = "'".$_POST['notice']."','".$_POST['type']."','".$title."','".$content."','".$name."','".$pwd."','0','y',now(),now()";
	$db->Insert();
	$idx = mysql_insert_id();
}else{
	$db->field = "header='".$_POST['notice']."',title = '".$title."',content = '".$content."',name = '".$name."',pwd= '".$pwd."',pcMode = 'y', mdate = now()";
	$db->where = "idx='".$_POST['idx']."'";
	$db->Update();
	$idx = $_POST['idx'];
}
unset($db);
?>

<script>
location.href = "./detail.php?idx=<?=$idx?>&page=<?=$_POST['page']?>&type=<?=$_POST['type']?>";
</script>