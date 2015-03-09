<?
header("Content-type: text/html; charset=utf-8"); 
$dir = $_SERVER["DOCUMENT_ROOT"];
include $dir."/inc/header/inc.php";
include $dir.'/gmail/MAIL.php';
if($_POST['birthYear'] and $_POST['birthMonth'] and $_POST['birthDay']){
	$_POST['dob'] = $_POST['birthYear']."-".$_POST['birthMonth']."-".$_POST['birthDay'];
}
$email = $_POST['email'];

$code = get_random_string(6,'az').get_random_string(3,'09');

$m = new MAIL;
$m->From('yusng00@naver.com',"민유성");
$m->AddTo($email);
$m->Subject('라스트로 인증메일 입니다.');
$m->Html("<a href = 'http://rastro.kr/pwEmailAc.php?code=".$code."cod".$_SESSION["idx"]."'>인증하기</a>");
$c = $m->Connect('smtp.gmail.com', 465, 'ysmin0914@gmail.com', 'messagebox11', 'tls', 10, 'localhost', null, 'plain') or die(print_r($m->Result));
$m->Send($c);
$m->Disconnect();

$db = new Dbcon();
$db->table = "member";
$db->field = "tempEmail='".$email."',emailCode='".$code."'";
$db->where = "idx = '".$_SESSION["idx"]."'";
$i=$db->Update();

//$db->field = "email,name,pwd";
//$db->ExportJson();
unset($db);

?>
<script>
location.href = "/info";
</script>