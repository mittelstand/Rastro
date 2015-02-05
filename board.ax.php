<?header("Content-type: text/html; charset=utf-8"); 
$dir = $_SERVER["DOCUMENT_ROOT"];
include $dir."/inc/header/inc.php";?>
<?
	$page = $_GET['page'];
	$block = $_GET['block'];
	$db = new Dbcon();
	$db->table = "board";
	$db->field = "title, content,mdate";
	$db->block = $block;
	$db->page = $page;
	$res = $db->Select();
	$abc = "";
?>{"value":[<?while($array = mysql_fetch_assoc($res)){?><?=$abc?>{"title":"<?= $array["title"]?>","con":"<?= $array["content"]?>","date":"<?= $array["mdate"]?>"}<? $abc = ",";}?>]}

