<?
header("Content-type: text/html; charset=utf-8"); 
$dir = $_SERVER["DOCUMENT_ROOT"];
include $dir."/inc/header/inc.php";

$db = new Dbcon();
$db->table = "board";
$db->filed = "idx,header,type,title,content,name,pwd,count,mdate,cdate";
$db->keyfiled = "idx";
$db->orderBy = "idx desc";
$cnt = $db->TotalCnt();
$db->page  = $_GET['page'];	
$db->block = $_GET['block'];
$selete = $db->Select();
unset($db);
$i=0;
?>




{"value":[
<? while($row = mysql_fetch_array($selete)){ 
	$date = dateR($row['cdate'],3);
	$title = TextToHtml($row['title']);
	$text = TextToHtml($row['content']);
	$imgTag = ExtTag($text,"img");
	foreach($imgTag[0] as $val){
		$text = str_replace($val,"",$text);
	}

	if($imgTag[0][0]){
		$img = str_replace("\"","\\\"",$imgTag[0][0]);
	}else{
		$img = str_replace("\"","\\\"","<img src='/img/no-image.gif'>");
	}
	$text = strip_tags($text);
	$text = str_replace("&nbsp;"," ",$text);
	
?>
<?=($i>0) ? "," : "" ?>{"idx":"<?=$row['idx']?>","picture":"<?=$img?>","header":"<?=$row['header']?>","title":"<?=$title?>","date":"<?=$date?>","text":"<?=$text?>"}
<?$i++;
	} ?>

]}