<?
header("Content-type: text/html; charset=utf-8"); 
$dir = $_SERVER["DOCUMENT_ROOT"];
include $dir."/inc/header/inc.php";
$db = new Dbcon();
		$db->table = "apply";
		$db->where="idx='".$_POST['id']."' and fidx='".$_POST['fidx']."'";
		$db->Delete();
?>
{"value":[{"idx":"<?=$_POST['id']?>"}]}
<?
unset($db);

?>