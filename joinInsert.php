<?
header("Content-type: text/html; charset=utf-8"); 
$dir = $_SERVER["DOCUMENT_ROOT"];
include $dir."/inc/header/inc.php";
include $dir.'/gmail/MAIL.php';
if($_POST['birthYear'] and $_POST['birthMonth'] and $_POST['birthDay']){
	$_POST['dob'] = $_POST['birthYear']."-".$_POST['birthMonth']."-".$_POST['birthDay'];
}
$email = $_POST['email'];
$name = $_POST['name'];
$pwd = md5($_POST['pwd']);
$dob = $_POST['dob']; //생년월일;

$code = get_random_string(6,'az').get_random_string(3,'09');

$m = new MAIL;
$m->From('yusng00@naver.com',"민유성");
$m->AddTo($email);
$m->Subject('라스트로 인증메일 입니다.');
$m->Html("<a href = 'http://rastro.kr/emailAc.php'>인증하기</a>");
$c = $m->Connect('smtp.gmail.com', 465, 'ysmin0914@gmail.com', 'messagebox11', 'tls', 10, 'localhost', null, 'plain') or die(print_r($m->Result));
$m->Send($c);
$m->Disconnect();

$db = new Dbcon();
$db->table = "member";
$db->field = "email,name,pwd,sex,emailCode,dob";
$db->value= "'".$email."','".$name."','".$pwd."','".$_POST['sex']."','".$code."','".$dob."'";
$i=$db->Insert();
$_SESSION["idx"] = mysql_insert_id();
//$db->field = "email,name,pwd";
//$db->ExportJson();
unset($db);

?>
<script>
location.href = "/info.php";
</script>