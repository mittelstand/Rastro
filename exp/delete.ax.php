<?
header("Content-type: text/html; charset=utf-8"); 
$dir = $_SERVER["DOCUMENT_ROOT"];
include $dir."/inc/header/inc.php";
$db = new Dbcon();
		$db->table = "exp";
		$db->where="idx='".$_POST['id']."' and type='".$_POST['type']."'";
		$db->Delete();
?>
{"value":[{"idx":"<?=$_POST['id']?>"}]}
<?
unset($db);

?>