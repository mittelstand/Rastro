<?
header("Content-type: text/html; charset=utf-8"); 
$dir = $_SERVER["DOCUMENT_ROOT"];
include $dir."/inc/header/inc.php";
include $dir.'/gmail/MAIL.php';
if($_POST['birthYear'] and $_POST['birthMonth'] and $_POST['birthDay']){
	$_POST['dob'] = $_POST['birthYear']."-".$_POST['birthMonth']."-".$_POST['birthDay'];
}
$email = $_POST['email'];

$db = new Dbcon();
$db->table = "member";
$db->keyfield = "idx";
$db->where = "email='".$email."'";
$db->field = "fbcode,email";



if($db->TotalCnt() > 0){
	$row = mysql_fetch_array($db->Select());
	if($row['fbcode']){
		unset($db);
	?>
<script>
	location.href = "/findFResult";
</script>
	<?
		exit();
	}else{
		$code = get_random_string(8,'az').get_random_string(3,'09');
		$m = new MAIL;
		$m->From('yusng00@naver.com',"라스트로");
		$m->AddTo($email);
		$m->Subject('임시 비밀번호 입니다.');
		$m->Html($code);
		$c = $m->Connect('smtp.gmail.com', 465, 'ysmin0914@gmail.com', 'messagebox11', 'tls', 10, 'localhost', null, 'plain') or die(print_r($m->Result));
		$m->Send($c);
		$m->Disconnect();
		$db->field = "pwdTemp='".$code."'";
		$db->Update();
		unset($db);
	?>
<script>
	location.href = "/findFAResult";
</script>	
	<?
		exit();
	}
}else{	
	unset($db);
?>
<script>
	location.href = "/findSResult";
</script>
<?
	exit();
}


?>
