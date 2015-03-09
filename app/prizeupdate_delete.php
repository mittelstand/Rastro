<?
header("Content-type: text/html; charset=utf-8"); 
$dir = $_SERVER["DOCUMENT_ROOT"];
include $dir."/inc/header/inc.php";
$uploadDir = $dir."/file/";
$fileName = $_POST['fName'];
$uploadFile = $uploadDir.time().".jpg";

$db= new Dbcon();
$db->table="prize";
if($_POST['division']=="del"){
	$db->where="fidx='".$_POST['fidx']."' and idx = '".$_POST['idx']."'";
	$sel=$db->Select();
	$row=mysql_fetch_array($sel);
	unlink($row['src']);
	$db->Delete();
	echo "del";
}else if($_POST['division']=="modify"){
	move_uploaded_file($_FILES['uploadedfile']['tmp_name'],$uploadFile);

	$db->field="pname='".$_POST['Pname']."',writer='".$_POST['name']."',pinstitution='".$_POST['Pinst']."',pdetail='".$_POST['Pdetails']."',src='".$uploadFile."',cdate=now()";
	$db->where="fidx='".$_POST['fidx']."' and idx = '".$_POST['idx']."'";
	$db->Update();
	echo "111";

}

unset($db);


?>
