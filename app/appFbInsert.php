<?
header("Content-type: text/html; charset=utf-8"); 
$dir = $_SERVER["DOCUMENT_ROOT"];
include $dir."/inc/header/inc.php";
include $dir.'/gmail/MAIL.php';
/*if($_POST['birthYear'] and $_POST['birthMonth'] and $_POST['birthDay']){
	$_POST['dob'] = $_POST['birthYear']."-".$_POST['birthMonth']."-".$_POST['birthDay'];
}*/

$email = $_POST['email'];
$name = $_POST['name'];
$dob = $_POST['dob']; //생년월일;
$db = new Dbcon();
$db->table = "member";
$db->where = "email='".$email."'";
$cnt=$db->TotalCnt();
if($cnt>0){
	echo "fail";
}else{
$db->field = "email,name,fbcode,dob";
$db->value="'".$email."','".$name."','".$_POST['id']."','".$dob."'";
$db->Insert();
echo "success";
}
unset($db);

?>
