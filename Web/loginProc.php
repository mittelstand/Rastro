<?
$cookieTime = time()+(86400*365);
if(isset($_COOKIE['mit_login_id'])) {
	unset($_COOKIE['mit_login_id']);
	setcookie('mit_login_id','', -1);
}
if(isset($_COOKIE['mit_login_pwd'])) {
	unset($_COOKIE['mit_login_pwd']);
	setcookie('mit_login_pwd','', -1);
}
if(isset($_COOKIE['mit_login_auto'])) {
	unset($_COOKIE['mit_login_auto']);
	setcookie('mit_login_auto','', -1);
}
if(isset($_COOKIE['mit_check_auto'])) {
	unset($_COOKIE['mit_check_auto']);
	setcookie('mit_check_auto','', -1);
}
if(isset($_COOKIE['mit_check_id'])) {
	unset($_COOKIE['mit_check_id']);
	setcookie('mit_check_id','', -1);
}
if($_POST['autoLogin']){	
	setcookie("mit_login_id",$_POST['id'],$cookieTime,'/');
	setcookie("mit_login_pwd",md5($_POST['pwd']),$cookieTime,'/');
	setcookie("mit_login_auto","true",$cookieTime,"/");
	setcookie("mit_check_id","",time()-3600,"/");
	setcookie("mit_check_auto","",time()-3600,"/");
}else if($_POST['idSave']){
	if(isset($_COOKIE['mit_login_id'])) {
		unset($_COOKIE['mit_login_id']);
		setcookie('mit_login_id','', -1);
	}
	setcookie("mit_login_id",$_POST['id'],$cookieTime,"/");
	setcookie("mit_check_id","",time()-3600,"/");
	setcookie("mit_check_auto","false",$cookieTime,"/");
}else{
	setcookie("mit_login_id","",time()-3600,"/");
	setcookie("mit_login_pwd","",time()-3600,"/");
	setcookie("mit_login_auto","",time()-3600,"/");
	setcookie("mit_check_auto","false",$cookieTime,"/");
	setcookie("mit_check_id","false",$cookieTime,"/");
}


header("content-type:text/html; charset=utf-8");
$dir = $_SERVER["DOCUMENT_ROOT"];
include $dir."/inc/header/inc.php";
if(!$_POST){
	MsgBox("잘못된 접근입니다.","back");
	exit;
}
$db = new DbCon();
$db->table = "member";
$db->keyfield = "id";
$email = $_POST['email']."@".$_POST['emailFooter'];
if($_POST['email']=="admin"){
	$db->where = "e='".$_POST['email']."' and pwd='".md5($_POST['pwd'])."'";
}else{
	$db->where = "email='".$email."' and pwd='".md5($_POST['pwd'])."'";
}

$cnt = $db->TotalCnt();
if($cnt > 0){
	$db->field = "idx,id,name,email,authority";
	$row = mysql_fetch_array($db->Select());
	if($row['id']=="admin"){
	$_SESSION['id'] = $row['id'];
	$_SESSION['admin']=1;
	}else{
	$_SESSION['idx']=$row['idx'];
	$_SESSION['id'] = $row['name'];
	$_SESSION['auth'] = $row['authority'];
	}

	unset($db);
	if($_POST['returnUrl']){
?>
	<script>
	location.href = "<?=$_POST['returnUrl']?>";
	</script>	
<?

	}else{
?>
	<script>
	location.href = "index.php";
	</script>	
<?
	}
	exit;
}else{
	unset($db);
	MsgBox("아이디 또는 비밀번호를 다시 확인하세요","back");
	
}


?>