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
$sex = $_POST['sex'];
$db = new Dbcon();
$db->table = "member";
$db->field = "email='".$email."' , name='".$name."' , dob='".$dob."', sex='".$sex."'";
$db->where = "idx='".$_POST['idx']."'";
$db->Update();

echo "success";
unset($db);

?>
