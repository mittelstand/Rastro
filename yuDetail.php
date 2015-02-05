<?
header("Content-type: text/html; charset=utf-8"); 
$dir = $_SERVER["DOCUMENT_ROOT"];
include $dir."/inc/header/inc.php";
$bno = $_GET['bno'];


$db = new Dbcon();
$db->table = "board";
$db->field = "idx,type,title,content,mdate"; 
$db->where = "idx=".$bno;

//echo $db->TotalCnt();
$sel = $db->Select();
$row = mysql_fetch_assoc($sel);
	echo $row['content'];

?>
