<?header("Content-type: text/html; charset=utf-8"); 
$dir = $_SERVER["DOCUMENT_ROOT"];
include $dir."/inc/header/inc.php";?>
<?
	$sidx = $_GET['idx'];
	$num = $_GET['num'];
	$db = new Dbcon();
	$db->table = "file";
	$db->field = "src";
	$db->where = "sidx = ".$sidx." and ord=".$num;
	$res = $db->Select();
	$row = mysql_fetch_assoc($res);


?>
{"value":[{"src":"<?=preg_replace("/\/[A-Z]{1,}\/[a-z]{1,}\.[a-z]{1,}\/[a-zA-Z_]{1,}/", "", $row[src])?>"}]}

