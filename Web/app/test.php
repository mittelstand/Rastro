<?
header("Content-type: text/html; charset=utf-8"); 
$dir = $_SERVER["DOCUMENT_ROOT"];
include $dir."/inc/header/inc.php";
$uploadDir = $dir."/file/";
$fileName = $_POST['fName'];
echo $fileName;

$uploadFile = $uploadDir.time()."_".$_FILES['uploadedfile']['name'];
	$db = new Dbcon();
	$db->table = "member";
	$db->field="Ps";
	$db->where="idx='".$_POST['idx']."'";
	$sel = $db->Select();
	$row =mysql_fetch_array($sel);
	unlink($row['Ps']);
	$db->field = "Ps='".$uploadFile.$fileName."'";
	$db->where = "idx='".$_POST['idx']."'";
	$db->Update();

	

	

	
move_uploaded_file($_FILES['uploadedfile']['tmp_name'],$uploadFile);
	
	


unset($db);
?>
