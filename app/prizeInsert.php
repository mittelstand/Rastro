<?
header("Content-type: text/html; charset=utf-8"); 
$dir = $_SERVER["DOCUMENT_ROOT"];
include $dir."/inc/header/inc.php";

$uploadDir = $dir."/file/";
$fileName = $_POST['fName'];
$uploadFile = $uploadDir.time().".jpg";


$db= new Dbcon();
$db->table="prize";
$db->field = "fidx,writer,pname,pinstitution,pdetail,src,cdate";
if($_POST['idx']){

$db->value="'".$_POST['idx']."','".$_POST['name']."','".$_POST['Pname']."','".$_POST['Pinst']."','".$_POST['Pdetails']."','".$uploadFile."',now()";
$i =$db->Insert();
$db ->field="idx,src";
$db->where = "idx='".$i."'";
$db->ExportJson();

move_uploaded_file($_FILES['uploadedfile']['tmp_name'],$uploadFile);
}
unset($db);
?>
