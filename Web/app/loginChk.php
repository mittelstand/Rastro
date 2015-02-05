<?
$dir = $_SERVER["DOCUMENT_ROOT"];
include $dir."/inc/header/inc.php";
$pwd = md5($_POST['pwd']);
$email = $_POST['email'];

$db = new Dbcon();
$db->table = "member";
$db->field = "idx";
$db->where = "email='".$email."' and pwd='".$pwd."'";
$cnt = $db->TotalCnt();
$sel = $db->Select();
$row =mysql_fetch_array($sel);

if($cnt<=0){
	echo "fail";
}else{

$db->field = "email,dob,name,sex,idx,Ps";
$db->where = "idx='".$row['idx']."'";
$db->ExportJson();

}
unset($db);

?>

