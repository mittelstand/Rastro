<?
header("Content-type: text/html; charset=utf-8"); 
$dir = $_SERVER["DOCUMENT_ROOT"];
include $dir."/inc/header/inc.php";
$uploadDir = $dir."/file/";
$fileName = $_POST['fName'];
$uploadFile = $uploadDir.time().".jpg";

$db= new Dbcon();
$db->table="prize";
	$db->where="fidx='".$_POST['fidx']."' and idx = '".$_POST['idx']."'";
	$sel=$db->Select();
	$row=mysql_fetch_array($sel);
	unlink($row['src']);
	$db->Delete();
	echo "del";

	



unset($db);


?>
