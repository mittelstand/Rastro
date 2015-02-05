<?
$dir = $_SERVER["DOCUMENT_ROOT"];
include $dir."/inc/header/inc.php";

$db = new Dbcon();
$db->table = "member";
$db->field = "idx";
$db->where = "email='".$_POST['email']."'";
$cnt = $db->TotalCnt();
$sel = $db->Select();
$row =mysql_fetch_array($sel);

if($cnt<=0){
	echo "fail";
}else{
$db->field = "email,dob,name,sex,idx,Ps,fbcode";
$db->where = "idx='".$row['idx']."'";
$db->ExportJson();
}
unset($db);
?>

