<?
header("Content-type: text/html; charset=utf-8"); 
$dir = $_SERVER["DOCUMENT_ROOT"];
include $dir."/inc/header/inc.php";

$db = new Dbcon();
$db->table = "board";
foreach($_POST['number'] as $key=>$val){
	$db->where = "idx = '".$val."'";
	$db->Delete();
}
unset($db);
?>
<script>
location.href = "/board/index.php?page=<?=$_POST['page']?>&type=<?=$_POST['type']?>";
</script>